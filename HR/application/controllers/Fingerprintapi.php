<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
require 'web.config.php';
require 'CloudABIS/CloudABISConnector.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CloudABISSampleWebApp_CloudABIS\CloudABISConnector;


class Fingerprintapi extends CI_Controller {
    
    
      function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		$this->load->model('EmployeesDeatils_model');
		$this->load->model('employees_model');
		$this->load->model('general_model');
		$this->load->model('admin_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->LoadCloudABISToken();
    }
    
     function LoadCloudABISToken()
        {
            $cloudABISConnector = new CloudABISConnector(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL, CloudABISCustomerKey, ENGINE_NAME);

            $token = $cloudABISConnector->GetCloudABISToken();
            if ( ! is_null($token) && isset($token->access_token) != "" )
            {
                $_SESSION['access_token'] = $token->access_token;
               
            }
            else
            {
                echo "CloudABIS Not Authorized!. Please check credentails";
            }
        }
        //method for Identify created by Aditya 
    public function fingerprint_capture_api(){
       
          
        $this->LoadCloudABISToken();
      
        if (isset($_POST['templateXML']) && $_POST['templateXML'] != "") {

                $templateXML = $_POST['templateXML'];
                if (isset($_COOKIE['CSTempalteFormat'])) {
                    $templateFormat = $_COOKIE['CSTempalteFormat'];
                }

                try
                { 
                    if ($templateXML != "") {
                        //get all form data to popultae in employee timsheet table
                         $capture_time = $_POST['capture_time'];
                         $clockin_type = $_POST['clockin_type'];
                         $roster_id = $_POST['roster_id'];
                         $emp_id = $_POST['emp_id'];
                         $roster_group_id = $_POST['roster_group_id'];
                         $outletname = $_POST['outletname'];
                        
                        if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
                            $cloudABISConnector = new CloudABISConnector(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL, CloudABISCustomerKey, ENGINE_NAME);
                            // id match found id will be returned else a failure message 
                            $id = $cloudABISConnector->Identify($templateXML, $_SESSION['access_token'], $templateFormat);
                    //   echo $id;
                    //   echo "</br>";
                    //   echo $emp_id;
                    //   exit;
                          if($id==$emp_id){
                             
                             $res = $this->save_record($capture_time,$clockin_type,$roster_id,$emp_id,$roster_group_id,$outletname);
                             $dataresult = array(
                                 'capture_time' => $capture_time,
                                 'message' => $roster_id."_".$clockin_type
                                 );
                             echo json_encode($dataresult);
                          }else{
                              
                              $dataresult = array(
                                 'capture_time' => '',
                                 'message' => "Fingerprint mismatch,Please place your correct finger !"
                                 );
                             echo json_encode($dataresult);
                          }
                            // SetStatus($lblMessageText);
                        } else {
                            $dataresult = array(
                                 'capture_time' => '',
                                 'message' => "Fingerprint Capture Failed!"
                                 );
                             echo json_encode($dataresult);
                             
                        }
                    } else {
                        
                        $dataresult = array(
                                 'capture_time' => '',
                                 'message' => "Problem in biometric template data"
                                 );
                             echo json_encode($dataresult);
                       
                    }
                } catch (Exception $ex) {
                    echo $ex->Message();
                }
           
        }else {
                echo "Please place your finger properly.";
            }
        
    }
        public function RegisterFingerPrint(){
            $this->load->view('general/header_general');
        $this->load->view('RegisterFingerPrint');
         
        
    }
     public function registerfinger(){
         $data = array();
          if (isset($_POST['register'])) {
            if ($_POST['registrationID'] != "") {
                $regID = $_POST['registrationID'];
                $templateXML = $_POST['templateXML'];
                if (isset($_COOKIE['CSTempalteFormat'])) {
                    $templateFormat = $_COOKIE['CSTempalteFormat'];
                }

                try
                {
                    if ($regID != "" && $templateXML != "") {
                        $regID = trim($regID);
                        if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
                            $cloudABISConnector = new CloudABISConnector(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL, CloudABISCustomerKey, ENGINE_NAME);
                            $lblMessageText = $cloudABISConnector->Register($templateXML, $regID, $_SESSION['access_token'], $templateFormat);
                          
                            $data['msg']  = $lblMessageText;
                        } else {
                            $data['msg'] = "Token Mismatch";
                        }
                    } else {
                        $data['msg'] =  "Please give an ID";
                    }

                } catch (Exception $ex) {
                    SetStatus($ex->Message());
                }
            } else {
                $data['msg'] = "Please put registration id";
            }
        }
         	$this->load->view('general/header_general');
         $this->load->view('RegisterFingerPrintform',$data);
        
        
        
     }
     
      public function deltefngr()
    {
        $this->LoadCloudABISToken();
        
        $data= array();
        
       if (isset($_POST['delete'])) {
            if ($_POST['delete'] != "") {
                $deleteID = $_POST['deleteID'];

                try
                {
                    if ($deleteID != "") {
                        if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
                            $cloudABISConnector = new CloudABISConnector(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL, CloudABISCustomerKey, ENGINE_NAME);
                            $lblMessageText = $cloudABISConnector->RemoveID($deleteID, $_SESSION['access_token']);
                            $data['msg'] = $lblMessageText;
                        } else {
                            $data['msg'] = "Invalid Page";
                        }
                    } else {
                        $data['msg'] = "Invalid Page";
                    }

                } catch (Exception $ex) {
                   $data['msg'] = "Invalid Page";
                }
            } else {
               $data['msg'] = "Invalid Page";
            }
        }
        
        $this->load->view('general/header_general');
         $this->load->view('DeleteID',$data);

    }
    
     
     public function isregistred(){
         $data= array();
         
          if ( isset($_POST['submit']) ) {
                if ( $_POST['txtID'] != "" ) {
                    $regID = $_POST['txtID'];
                    try
                    {
                        if ( $regID != "" )
                        {
                            $regID = trim($regID);

                            if ( isset($_SESSION['access_token']) && $_SESSION['access_token'] != "" ) 
                            {
                                $cloudABISConnector = new CloudABISConnector(CloudABISAppKey, CloudABISSecretKey, CloudABIS_API_URL, CloudABISCustomerKey, ENGINE_NAME);
                                
                                $lblMessageText = $cloudABISConnector->IsRegister($regID, $_SESSION['access_token']);
                                $data['msg'] =  $lblMessageText;
                            }
                            else
                            {
                               $data['msg'] = "Invalid Page";
                            }
                        }
                        else $data['msg'] =  "Please give an ID";
                    }
                    catch (Exception $ex)
                    {
                        $data['msg'] = $ex->Message();
                    }
                }
                else {
                    $data['msg'] = "Please put registration id";
                }
            }
            
            	$this->load->view('general/header_general');
         $this->load->view('isregistredform',$data);
     }
     
     // record employee timsheet data like clockin and clockout time etc...
      public function save_record($in_time,$type,$roster_id,$emp_id,$roster_group_id,$outletname=''){
     

    $roster_and_timesheet_id =  $roster_group_id;
    $roster_and_timesheet_id = explode('_', $roster_and_timesheet_id);
    $timesheet_id = $roster_and_timesheet_id[1];
   
    $in_time = $this->compare_time_logic($roster_id,$type,$in_time);
    
   
     // setting session for roster group id
      $this->session->set_userdata('roster_id', $roster_id);
    
       $data = array(
         $type =>$in_time,
        );
         
      if(isset($outletname) && ($outletname !='')){
       
        $data['outletname'] = $outletname;
      }
        
        $this->admin_model->update_employee_timesheet($data,$timesheet_id,$roster_id); 
        
    
 }
 
  public function compare_time_logic($roster_id,$type,$in_time){
     // for roundup compare time with roster and cloclkin time
      $dayname = date('D');
      
      if($type !="in_time"){ 
    
      if($dayname=="Tue"){
         $dayname = "tues_end_time"; 
      }elseif($dayname=="Thu"){
       $dayname = "thus_end_time";    
      }else{
          $dayname = strtolower($dayname);
          $dayname = $dayname."_end_time";
      }
      }else{
         
           if($dayname=="Tue"){
         $dayname = "tues_start_time"; 
      }elseif($dayname=="Thu"){
       $dayname = "thus_start_time";    
      }else{
          $dayname = strtolower($dayname);
          $dayname = $dayname."_start_time";
      }
      
      }
      
      
      
     $this_timesheet_details  = $this->admin_model->check_shift($roster_id,$dayname);
     
                $round_up_time =  $this_timesheet_details[0]->$dayname;
                $time2 = strtotime($this_timesheet_details[0]->$dayname);
                 
                $time1 = strtotime($in_time);
                $difference = round(abs(($time2 - $time1)) / 3600,2);
                $hr_in_min = $difference* 60;
                 
                 
                 // check if clockin time is less than roster in time
    if($type == "in_time"){
                if($time2 > $time1){
                    //up to 10 min early arrival is allowed for roundup else enter actual time as clockin time
                  if($hr_in_min > 10){
                     $new_in_time =  $in_time;
                  }else{
                   $new_in_time =  date("H:i", strtotime($round_up_time));   
                   }
                }else{
                   
                    //for late there is relaxation of 5 min else enter actual clockin time
                     if($hr_in_min > 5){
                     $new_in_time =  $in_time;
                  }else{
                       $new_in_time =  date("H:i", strtotime($round_up_time));
                  }
                    
                }
 }else{
     
      if($time2 > $time1){
                    //up to 10 min early arrival is allowed for roundup else enter actual time as clockin time
                  if($hr_in_min > 5){
                     $new_in_time =  $in_time;
                  }else{
                   $new_in_time =  date("H:i", strtotime($round_up_time));   
                   }
                }else{
                    //for late there is relaxation of 5 min else enter actual clockin time
                     if($hr_in_min > 10){
                     $new_in_time =  $in_time;
                  }else{
                       $new_in_time =  date("H:i", strtotime($round_up_time));
                  }
                    
                }
     
 }
           
    return $new_in_time;
    
     
 }
     
     
    
}