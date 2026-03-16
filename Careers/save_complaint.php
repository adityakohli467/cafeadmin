<?php require_once 'db.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'vendor/autoload.php';



if($_POST['branch_id'] == ''){
   echo "Please choose branch.";  exit;
}

($job_id = isset($_POST['job_id']) ? $_POST['job_id'] : '0');
$branch_id = $_POST['branch_id']; $first_name = $_POST['first_name']; $last_name = $_POST['last_name']; $email = $_POST['email'];
$mobile = $_POST['mobile'];  $message = $_POST['message'];

$sql = "insert into hr_complaints(branch_id,first_name,last_name,email,mobile,message) 
values($branch_id,'$first_name','$last_name','$email',$mobile,'$message')";
  
// echo $sql; exit;
if ($con->query($sql) === TRUE) {
    // fetch email of manager of this location
     $sql_email = "select manager_email from customer_branches where branch_id = ".$_POST['branch_id'];
    $result = $con->query($sql_email);
    if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
      $manager_email = $row['manager_email'];
     }}else{
      $manager_email = "kaushika@1800mycatering.com.au";
    }
   
   
    
    // Mail send code using SMTP and phpmailer
        $messageBody = '';
        // $to = 'mqaddarkasikandar@gmail.com';
        $messageBody .= 'Dear Manager,<p>New Complaint received, please check the following details:</p>';
        
        $messageBody .= '<table border="0">';
        $messageBody .= '<tr><td>Name: </td><td>'.$first_name.' '.$last_name.'</td></tr>';
        $messageBody .= '<tr><td>Email: </td><td>'.$email.'</td></tr>';
        $messageBody .= '<tr><td>Mobile: </td><td>'.$mobile.'</td></tr>';
        $messageBody .= '<tr><td>Comment: </td><td>'.$message.'</td></tr>';
        $messageBody .= '</table>';
        $mail = new PHPMailer(true); 
        $mail->isSMTP();
        $mail->Mailer = "smtp";
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'cafehrmanagement@gmail.com';
        $mail->Password = 'Discoverf1y@123!!';
        $mail->Port     = 587;
        $mail->setFrom('cafehrmanagement@gmail.com', 'Cafeadmin');
        $mail->ClearAddresses();
        $mail->isHTML(true);
        // $mail->From = "adityakohli467@gmail.com";
        // $mail->From = "admin@cafeadmin.com.au";
        // $mail->addAddress('hr@zoukiaccounts.com.au'); 
        $mail->addAddress('kaushika@1800mycatering.com.au'); 
        //  $mail->addAddress('mqaddarkasikandar@gmail.com'); 
        // $mail->addAddress($manager_email);
        $mail->isHTML(true);
        $mail->Subject = "New HR Complaint";
        $mail->Body = $messageBody;
        try {
        if($mail->send()){
       header("Location: " . $base_url . "Careers/index.php?success=success2");        
        }else{
          header("Location: " . $base_url . "Careers/index.php?success=fail");   
          }
        } catch (Exception $e) {
            header("Location: " . $base_url . "Careers/index.php?success=fail");
    //   echo "Form cannot be submitted due to mail error";
    //       exit;
         }

   
}

