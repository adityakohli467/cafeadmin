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
            }
        }

        // Delete failed records older than 3 months
        $cutoff = date('Y-m-d H:i:s', strtotime('-3 months'));
        $this->db->where('created_at <', $cutoff)->delete('email_queue');

        echo "Done. Sent: {$sent}, Failed: {$failed}\n";
    }
}
