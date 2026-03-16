<?php require_once 'db.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require 'vendor/autoload.php';

session_start();

if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha']) {
    header("Location: index.php?success=captchaerror");
    exit();
}


// file upload code start here   ====================================================

if($_POST['branch_id'] == ''){
   echo "Please choose branch.";  exit;
}
$target_dir = "applicants_resume/";
$target_file = $target_dir . $_FILES["resume"]["name"]."_".rand();

$target_dir_other_docs = "supportive_docs/";
$target_file_other_docs = '';
if(isset($_FILES["docs"]["name"]) && $_FILES["docs"]["name"] !=''){
$target_file_other_docs = $target_dir_other_docs . $_FILES["docs"]["name"]."_".rand();
 move_uploaded_file($_FILES["docs"]["tmp_name"], $target_file_other_docs);   
}
$uploadOk = 1;

if ($_FILES["resume"]["size"] > 5000000) {
  echo "Sorry, your file is too large.Upload file less than 5 Mb.";
  $uploadOk = 0;
}
move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);



if ($uploadOk == 0) {
 header("Location: " . $base_url . "Careers/index.php?success=fileerror");
} 
// file upload code end ====================================================
($job_id = isset($_POST['job_id']) ? $_POST['job_id'] : '0');
$city = $_POST['city']; $branch_id = $_POST['branch_id']; $first_name = $_POST['first_name']; $last_name = $_POST['last_name']; $email = $_POST['email'];
$mobile = $_POST['mobile']; $city = $_POST['city']; $state = $_POST['state']; $experience = $_POST['experience']; $education = $_POST['education']; $message_to_manager = $_POST['message_to_manager'];

$sql = "insert into applicants_details (city,branch_id,first_name,last_name,email,mobile,state,experience,education,message_to_manager,resume,docs,job_id) 
values('$city',$branch_id,'$first_name','$last_name','$email',$mobile,'$state','$experience','$education','$message_to_manager','$target_file','$target_file_other_docs',$job_id)";
  
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
        // $to = 'kohliaditya@yahoo.com';
        $messageBody .= 'Dear Manager,<p>New Job application received</p>';
        $messageBody .= '<table border="0">';
        $messageBody .= '<tr><td>Name: </td><td>'.$first_name.' '.$last_name.'</td></tr>';
        $messageBody .= '<tr><td>Email: </td><td>'.$email.'</td></tr>';
        $messageBody .= '<tr><td>Mobile: </td><td>'.$mobile.'</td></tr>';
        $messageBody .= '<tr><td>City: </td><td>'.$city.'</td></tr>';
        $messageBody .= '<tr><td>State: </td><td>'.$state.'</td></tr>';
        $messageBody .= '<tr><td>Experience: </td><td>'.$experience.'</td></tr>';
        $messageBody .= '<tr><td>Education: </td><td>'.$education.'</td></tr>';
        $messageBody .= '<tr><td>Message to manager : </td><td>'.$message_to_manager.'</td></tr>';
        
        $messageBody .= '</table>';
        $mail = new PHPMailer(true); 
        $mail->isSMTP();
        $mail->Mailer = "smtp";
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'cafehrmanagement@gmail.com';
        $mail->Password = 'wdpoqmfuizogwfsj';
        $mail->Port     = 587;
        $mail->setFrom('cafehrmanagement@gmail.com', 'Cafeadmin');
        $mail->ClearAddresses();
        $mail->isHTML(true);
        // $mail->From = "admin@cafeadmin.com.au";
        $mail->addAddress('hr@zoukiaccounts.com.au'); 
        //  $mail->addAddress('adityakohli467@gmail.com'); 
        $mail->addAddress($manager_email);
        //  $mail->addAddress('mqaddarkasikandar@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = "New Job Application ";
        $mail->Body = $messageBody;
        try {
        if($mail->send()){
       header("Location: " . $base_url . "Careers/index.php?success=success1");        
        }else{
         header("Location: " . $base_url . "Careers/index.php?success=fail"); 
          }
        } catch (Exception $e) {
            header("Location: " . $base_url . "Careers/index.php?success=fail");
    //   echo "Form cannot be submitted due to mail error";
        //   exit;
         }

   
}

