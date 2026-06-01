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
        $mail->Password   = 'hrqa brvz qbyz dext';
        $mail->Port       = 587;
        $mail->setFrom('info@cafeadmin.com.au', 'Cafeadmin');
        
     

        $mail->isHTML(true);

        $sent = 0;
        $failed = 0;

        foreach ($emails as $email) {
            try {
                $mail->ClearAddresses();
                $mail->ClearCCs();

                // Handle multiple comma-separated addresses
                $to_addresses = array_map('trim', explode(',', $email->to_email));
                foreach ($to_addresses as $addr) {
                    if (!empty($addr)) {
                        $mail->addAddress($addr);
                    }
                }

                if (!empty($email->cc_email)) {
                    $cc_addresses = array_map('trim', explode(',', $email->cc_email));
                    foreach ($cc_addresses as $cc) {
                        if (!empty($cc)) {
                            $mail->addCC($cc);
                        }
                    }
                }

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
                              ->where('attempts >=', 5)
                              ->get('email_queue')->result();
        foreach ($exhausted as $ex) {
            $this->db->where('id', $ex->id)->update('email_queue', array('status' => 'failed'));
            if (!empty($ex->order_id)) {
                $this->orders_model->updateOrderDetails(array('mail_status' => 2), $ex->order_id);
                // Notify branch manager about the failed email
                $this->notify_manager_failed_email($mail, $ex->order_id, $ex->to_email);
            }
        }

        // Delete failed records older than 3 months
        $cutoff = date('Y-m-d H:i:s', strtotime('-3 months'));
        $this->db->where('created_at <', $cutoff)->delete('email_queue');

        echo "Done. Sent: {$sent}, Failed: {$failed}\n";
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

            // Get branch manager email
            $branch_info = $this->orders_model->get_branch_email($branch_id);
            if (empty($branch_info) || empty($branch_info[0]->email)) return;
            $manager_email = $branch_info[0]->email;

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
        } catch (Exception $e) {
            echo "Could not notify manager for Order #{$order_id}: {$e->getMessage()}\n";
        }
    }
}
