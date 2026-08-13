<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Cron extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        // Only allow CLI access
        if (!is_cli()) {
            show_error('Direct access not allowed', 403);
            exit;
        }
        
        $this->load->database();
        $this->load->model('orders_model');
    }

    /**
     * Process pending emails from the email_queue table.
     * Run via cron: php index.php cron process_email_queue
     * Recommended: every 1-2 minutes
     */
    public function process_email_queue() {
        $emails = $this->orders_model->get_pending_emails(10);
        
        if (empty($emails)) {
            echo "No pending emails.\n";
            return;
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Username   = 'info@cafeadmin.com.au';
        $mail->Password   = 'tyhw bjip baae pacc';
        $mail->Port       = 587;
        $mail->setFrom('info@cafeadmin.com.au', 'Cafeadmin');
        
     

        $mail->isHTML(true);

        $sent = 0;
        $failed = 0;

        foreach ($emails as $email) {
            try {
                $mail->clearAllRecipients();

                // Recipients may be stored separated by commas, semicolons OR
                // spaces (supplier records frequently hold several
                // space-separated addresses). Parse and validate robustly so a
                // formatting quirk no longer makes the entire send fail.
                $to_addresses = $this->parse_recipients($email->to_email);
                $cc_addresses = $this->parse_recipients($email->cc_email);

                if (empty($to_addresses)) {
                    // Retrying cannot fix a missing/invalid address, so fail it
                    // now with a clear reason the UI banner can surface.
                    $this->fail_email_permanently(
                        $email,
                        'No valid recipient email address (stored value: "' . $email->to_email . '")'
                    );
                    $failed++;
                    echo "Failed email #{$email->id}: no valid recipient in '{$email->to_email}'\n";
                    continue;
                }

                foreach ($to_addresses as $addr) { $mail->addAddress($addr); }
                foreach ($cc_addresses as $cc)   { $mail->addCC($cc); }

                $mail->Subject = $email->subject;
                $mail->Body    = $email->body;

                if ($mail->send()) {
                    // Delete sent emails to keep table small
                    $this->db->where('id', $email->id)->delete('email_queue');
                    // Update order mail_status if this email is linked to an order
                    if (!empty($email->order_id)) {
                        $this->orders_model->updateOrderDetails(array('mail_status' => 1), $email->order_id);
                    }
                    $sent++;
                    echo "Sent email #{$email->id} to {$email->to_email}\n";
                } else {
                    $this->orders_model->update_email_status($email->id, 'pending', $mail->ErrorInfo);
                    $failed++;
                    echo "Failed email #{$email->id}: {$mail->ErrorInfo}\n";
                }
            } catch (Exception $e) {
                $this->orders_model->update_email_status($email->id, 'pending', $e->getMessage());
                $failed++;
                echo "Exception email #{$email->id}: {$e->getMessage()}\n";
            }
        }

        // Mark emails that have exhausted retries as failed
        $exhausted = $this->db->where('status', 'pending')
                              ->where('attempts >=', 3)
                              ->get('email_queue')->result();
        foreach ($exhausted as $ex) {
            $fail_reason = !empty($ex->error_message)
                ? $ex->error_message
                : 'Delivery failed after maximum retry attempts';
            $this->db->where('id', $ex->id)->update('email_queue', array(
                'status'        => 'failed',
                'error_message' => $fail_reason
            ));
            if (!empty($ex->order_id)) {
                $this->orders_model->updateOrderDetails(array('mail_status' => 2), $ex->order_id);
                // Notify branch manager about the failed email
                $this->notify_manager_failed_email($mail, $ex->order_id, $ex->to_email);
            }
        }

        // Delete failed records older than 3 months
        $cutoff = date('Y-m-d H:i:s', strtotime('-1 months'));
        $this->db->where('created_at <', $cutoff)->delete('email_queue');

        echo "Done. Sent: {$sent}, Failed: {$failed}\n";
    }

    /**
     * Split a recipient string into a list of valid email addresses.
     * Accepts commas, semicolons or whitespace as separators and drops any
     * token that is not a syntactically valid address.
     */
    private function parse_recipients($raw) {
        if ($raw === null || trim($raw) === '') {
            return array();
        }
        $parts = preg_split('/[\s,;]+/', trim($raw));
        $valid = array();
        foreach ($parts as $p) {
            $p = trim($p);
            if ($p !== '' && filter_var($p, FILTER_VALIDATE_EMAIL)) {
                $valid[] = $p;
            }
        }
        return array_values(array_unique($valid));
    }

    /**
     * Mark a queued email as permanently failed (retrying will not help) with a
     * clear reason, and flag the linked order so the UI banner can surface it.
     */
    private function fail_email_permanently($email, $reason) {
        $this->db->where('id', $email->id)->update('email_queue', array(
            'status'        => 'failed',
            'error_message' => $reason
        ));
        if (!empty($email->order_id)) {
            $this->orders_model->updateOrderDetails(array('mail_status' => 2), $email->order_id);
        }
    }

    /**
     * Send notification to branch manager when a supplier order email fails after 5 attempts.
     */
    private function notify_manager_failed_email($mail, $order_id, $to_email) {
        try {
            $order = $this->orders_model->getOrderDetails($order_id);
            if (empty($order)) return;

            $branch_id = $order[0]->branch_id;
            $supplier_id = isset($order[0]->supplier_id) ? $order[0]->supplier_id : '';

            // Get branch manager email and location name
            $branch_info = $this->orders_model->get_branch_email($branch_id);
            if (empty($branch_info) || empty($branch_info[0]->email)) return;
            $manager_email = $branch_info[0]->email;
            $location_name = isset($branch_info[0]->branch_name) ? $branch_info[0]->branch_name : 'Unknown Location';

            // Get supplier name
            $supplier_name = 'Unknown Supplier';
            if (!empty($supplier_id)) {
                $supplier = $this->orders_model->get_supplier_details($supplier_id);
                if (!empty($supplier)) {
                    $supplier_name = $supplier[0]->supplier_name;
                }
            }

            $mail->ClearAddresses();
            $mail->ClearCCs();
            $mail->addAddress($manager_email);
            $mail->Subject = "Order Email Failed - Order #{$order_id}";
            $mail->Body = "
                <p>Hi Manager,</p>
                <p>This is to inform you that the order email for <strong>Order #{$order_id}</strong> to supplier <strong>{$supplier_name}</strong> ({$to_email}) has failed .</p>
                <p>Please follow up with the supplier directly to confirm the order.</p>
                <p>Regards,<br>Cafeadmin System</p>
            ";

            $mail->send();
            echo "Notified manager ({$manager_email}) about failed email for Order #{$order_id}\n";

            // Notify KJ about the failed email
            $mail->ClearAddresses();
            $mail->ClearCCs();
            $mail->addAddress('kaushika@aaria.com.au');
            $mail->Subject = "Order Email Failed - Order #{$order_id}";
            $mail->Body = "
                <p>HI KJ</p>
                <p>Email delivery failed for supplier system for order id <strong>#{$order_id}</strong> for location : <strong>{$location_name}</strong></p>
                <p>Regards,<br>Cafeadmin System</p>
            ";

            $mail->send();
            echo "Notified KJ (kaushika@aaria.com.au) about failed email for Order #{$order_id}\n";
        } catch (Exception $e) {
            echo "Could not notify manager for Order #{$order_id}: {$e->getMessage()}\n";
        }
    }
}
