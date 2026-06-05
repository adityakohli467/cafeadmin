<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Employees extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('notification');
		$this->load->model('employees_model');
		$this->load->model('admin_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
         $config = array(
              'protocol' => 'smtp', 
              'smtp_host' => 'smtp.gmail.com', 
              'smtp_port' => 587, 
              'smtp_user' => 'info@cafeadmin.com.au', 
              'smtp_pass' => 'tyhw bjip baae pacc',
              'mailtype' => 'html'
              );
              $this->load->library('email', $config);
              $this->email->initialize($config);
               $this->emp_id = $this->session->userdata('customerId');
                  //===========================================================phpmailer start =================================================
		$this->phpmailermail = new PHPMailer();
        $this->phpmailermail->isSMTP();
        // $this->phpmailermail->SMTPDebug = 2;
        $this->phpmailermail->Mailer = "smtp";
        $this->phpmailermail->Host     = $this->config->item('Host');
        $this->phpmailermail->SMTPAuth = $this->config->item('SMTPAuth');
        $this->phpmailermail->SMTPSecure = $this->config->item('SMTPSecure');
        $this->phpmailermail->Username = $this->config->item('Username');
        $this->phpmailermail->Password = $this->config->item('Password');
        $this->phpmailermail->Port     = $this->config->item('Port');
        $this->phpmailermail->setFrom($this->config->item('setFrom'), 'Cafeadmin');
				
			  //=========================================================php mailer end ======================================================
    }
    
    public function index(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('employees', 'menu')){
			redirect('general/index');
		}else {
    		redirect('employees/manage_employee');
		}
    }
    
    public function display_menu(){
        
        
       if($this->session->userdata('supervisor') !=''){ 
             $menus = $this->ion_auth->getMenusdynamic();
        }else{
            $menus = $this->ion_auth->getMenus(); 
        }
				$menu_items = array();
				$userlevel = $this->session->userdata('clearance_level');

				foreach($menus as $key=>$menu){
					if($userlevel >= $menu->level){
						$menu_items[$key] = $menu;
						$submenu_items = array();
						$sub_menus = $this->ion_auth->getSubMenus($menu->menu_id);
						if(!empty($sub_menus)){
							foreach($sub_menus as $key1 => $submenu){
								if($userlevel >= $submenu->level){
									$submenu_items[$key1] = $submenu;
								}
							}
						}
						$menu_items[$key]->submenus = $submenu_items;
					}
				}
        
        return $menu_items;
    }
    
    public function get_content_and_send_mail($emp_detail,$msg){
           $from_email = 'admin@cafeadmin.com.au';
		    $email = $emp_detail['send_to'];
		     $subject = $emp_detail['subject'];
		  //      // Set content-type header for sending HTML email 
    //             $headers = "MIME-Version: 1.0" . "\r\n";
    //             $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    //           $headers .= "From: info@cafeadmin.com.au\r\n" .
    //           "Reply-To: info@cafeadmin.com.au\r\n" .
    //           "X-Mailer: PHP/" . phpversion();
    //          // send email

			 // mail($email, $subject, $msg, $headers);
			  
			  
			  
			 //       $this->email->set_newline("\r\n");
				// 	$this->email->from($from_email, 'HRM'); 
				// 	$this->email->to($email);
				// 	$this->email->reply_to($from_email);
				// 	$this->email->subject($subject);
				// 	$body = $this->load->view('orders/order_email', $data,TRUE);
					$this->email->message($msg);
				// 	$send = $this->email->send();
					
					
				 //Phpmailer ============================================================
					 $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $msg;
                     $this->phpmailermail->send();
					
			  return true;
    }
    
    public function employee_delete(){
       
         
    	$id = $_POST['id'];
    
    	$this->load->model('employees_model');
    
     $this->employees_model->employee_delete($id);
    
     $branch_id = $this->session->userdata('branch_id');
       
    $this->db->select('*');
		$this->db->from('employee');
        $this->db->where('emp_id',$id);
		$query = $this->db->get();
		$employee_data = $query->result();
    $branches = $this->admin_model->fetch_branches($branch_id);
    
    $location = $branches[0]->branch_name;
    $empname = $employee_data[0]->first_name.' '.$employee_data[0]->last_name;
    // $empEmail = $employee_data[0]->email;
	      
	$html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
    </head> 
    <body> 
    <p>Hi HR team,</p>
    <p> Employee ('.$empname.') from location '.$location.' no longer works for the company.</p>
    
    <p><a href="'.base_url('index.php/auth/homepage').'">Click here to login your portal</a></p>
      <p>Kind Regards,<br></br>
      Cafeadmin</p>

     
         </body> 
         </html>'; 
  
    
        $email = 'kaushika@1800mycatering.com.au';
        $email1 = 'hr@zoukiaccounts.com.au';
        $email2 = 'wang@zoukiaccounts.com.au';
        // $email = 'mqaddarkasikandar@gmail.com';
        // $email = 'adityakohli467@gmail.com';
        $subject = "Employee Deleted";
             $this->phpmailermail->ClearAddresses();
			 $this->phpmailermail->isHTML(true);
			 //for testing
			 //$this->phpmailermail->addAddress($email);
			 
			 $this->phpmailermail->addAddress($email1);
			 $this->phpmailermail->addAddress($email2);
		     $this->phpmailermail->addCC($email);
             $this->phpmailermail->Subject = $subject;
             $this->phpmailermail->Body = $html;
             $this->phpmailermail->send();
       	    
         
    }
    public function revert_deleted_emp(){
        
    	$id = $_POST['id']; 
    
    	$this->load->model('employees_model');
        $this->employees_model->revert_deleted_emp($id);
         
    }
    
     public function fetch_employee_availability_for_next_week(){
         $emp_id    = $_POST['employee_id'];
         
    if($_POST['start_date'] == ''){
        echo  'error'; exit;
    }     
       $res = $this->employees_model->fetch_employee_availability($emp_id);
         if(!empty($res)){
            $emp_availability = unserialize($res[0]->emp_availability);
             echo json_encode($emp_availability);   
         }else{
           echo  'false';  
         }
        // 	$start_date = date('Y-m-d', strtotime($_POST['start_date']));
     
    //   if(is_array($emp_availability) && !empty($emp_availability)){
    //     for($i = 0 ;$i < 7; $i++){
    //       $date_next = date('d-m-Y', strtotime($_POST['start_date'] . ' +'.$i.' day'));
      
    //         if(in_array($date_next,$emp_availability)){
    //           $unavailabel = true;
    //         }
         
    //     }
        
    //   }else{
    //      $unavailabel = false;
    //   }
      
    //   if($unavailabel == true){
    //   echo json_encode($emp_availability);   
    //   }else{
    //     echo  'available';
    //   }
   
   
      
     }
     public function add_availability(){
       
        if(!empty($this->input->post())){
        
         $posted_data = $this->input->post();
        foreach($posted_data as $key=> $valuue){
         ($valuue !='' ? $avail_data[$key] = $valuue : '');
         }
        //  echo "<pre>";print_r($avail_data); exit;
         $res = $this->employees_model->update_employee_availability($this->emp_id,$avail_data);
         $data['success_message'] = 'Your update has been successful.';
        
        }
      
        $menu_items  = $this->display_menu();
	    $dates = new DateTime();
	    // get date for next Sunday as we will ask employee availability for coming week
	    $datee = $dates->modify('next monday');  $data['next_monday_date'] = $dates->format('Y-m-d');
        $data['Mondate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Tuedate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Weddate']=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $data['Thudate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Fridate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Satdate']=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $data['Sundate']=  $datee->format('d-m-Y');   
		$hdata['menus'] = $menu_items;
        
    
         $res = $this->employees_model->fetch_employee_availability($this->emp_id);
         if(!empty($res)){
            $data['emp_availability'] = unserialize($res[0]->emp_availability);
         }
       
        $this->load->view('general/header_general',$hdata);
		$this->load->view('employees/add_availability',$data);
		$this->load->view('general/footer');
       
    }
    public function leave_delete(){
    $id = $_POST['id'];
    $this->load->model('employees_model');
     $this->employees_model->leave_delete($id);
         
    }
    
   	public function email_verify($id){

		  $data['id'] = $id;	
		  $this->load->view('employees/reset_password',$data);
		  $this->load->view('general/footer');

      }
	
	public function email_verified_password(){
 
		  $id = $this->input->post('id');
		  $get_email = $this->employees_model->get_email($id);
		  $email = $get_email[0]->email;
		  $new = $this->input->post('password');
		  $data = array(
		  	'user_id' => $id,
		  	'empId' => '0',
		  	'group_id' => '2'
		  	);
		  $groups = $this->ion_auth_model->group_insert($data);
		  $data2 = array(
		  	'active' => '1',
		  	'status' => 'New',
		  	'email_verification' => '1'
		  	);
		  $users = 	$this->ion_auth_model->user_update($data2,$id);
		  $result = $this->ion_auth_model->email_verified_password($new,$id);
		  if($result){
		  		$this->session->set_flashdata('sucess_msg', 'Password sucessfully changed');
		  }else{
		  	    $this->session->set_flashdata('error_msg', 'Unable to change password');
		  }
		  $remember = '';
		 redirect('employees/thank_you_page', 'refresh');

      }
      function thank_you_page(){
          
          
           $this->load->view('employees/thank_you_page');
		   $this->load->view('general/footer');
          
      }
    function emp_dashboard() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
           $userlevel = $this->session->userdata('clearance_level');
				$menu_items  = $this->display_menu();
			
		   $hdata['menus'] = $menu_items;
		  $this->load->view('general/header_general',$hdata);
           $this->load->view('employees/employee_dashboard');
		   $this->load->view('general/footer');
		}
	} 
	
	function get_roster_weeks() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
			$branch_id = $this->session->userdata('branch_id');
		   
			    $userlevel = $this->session->userdata('clearance_level');
			    
			   
			    
			   $emp_id = $this->session->userdata('customerId'); 
			  
			   
			  $menu_items  = $this->display_menu();
				// $branch_id = $this->session->userdata('branch_id');
			
		
				$roster = $this->employees_model->get_roster_weeks($emp_id,$branch_id);
			
			
			    
				
                $data['roster'] = $roster;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
          	
		}
	}
	

	
	function emp_indection_reg() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else{
			$user_id = $this->session->userdata('user_id');
			
			
			$userlevel = $this->session->userdata('clearance_level');
			$menu_items  = $this->display_menu();
				
				                
        	$user_details = $this->employees_model->get_user_status($user_id);
        
        	
        
        	foreach($user_details as $row){
        		
        		$emp_id = $row->customer_id;
        	  }
        // 	 $employee_details = $this->employees_model->get_emp_update($emp_id);
        	   $employee_details = $this->employees_model->get_emp_details($emp_id);
        	   
        	   
        	   $get_docs = $this->employees_model->get_docs($emp_id);
        	   
        	   //echo '<pre>';print_r($employee_details);exit;
        	   
        	    $data['docs'] = $get_docs;
        	
        		$data['user_details'] = $employee_details;
				
			  
		        $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
        		$this->load->view('employees/emp_indection_reg',$data);
		        $this->load->view('general/footer');
		}
	}
	function submit_emp_indection_reg() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
    $this->form_validation->set_rules('title','title','trim|required');
          
      $dob = strtotime($this->input->post('dob'));


$dob = date('Y-m-d',$dob);

		  if ($this->form_validation->run() == true) {
            $emp_id = $this->input->post('emp_id');
		    $data = array(
		    	'first_name' => $this->input->post('first_name'),
		    	'last_name' => $this->input->post('last_name'),
		    	'email' => $this->input->post('email'),
		    	'phone' => $this->input->post('phone'),
		    	'title' => $this->input->post('title'),
		    	'name' => $this->input->post('name'),
		    	'surname' => '',
		    	'email' => $this->input->post('email'),
		    	'dob' => $dob,
		    	'unit_number' => $this->input->post('unit'),
		    	'street' => $this->input->post('street'),
		    	'suburb' => $this->input->post('suburb'),
		    	'postcode' => $this->input->post('post'),
		    	'state' => $this->input->post('state'),
		    	'tfn_number' => $this->input->post('tfn_no'),
		    	'super_fund_name' => $this->input->post('super_fund_name'),
				'super_annuation_no' => $this->input->post('super_annua_no'),
				'heighest_acd_achmts' => $this->input->post('heighest_acadamic_ach'),
				'pre_emp_hstry_one' => $this->input->post('pre_emp_hstry_one'),
				'pre_emp_hstry_two' => $this->input->post('pre_emp_hstry_two'),
				'pre_emp_hstry_three' => $this->input->post('pre_emp_hstry_three'),
				'visa_status' => $this->input->post('visa_status'),
				'nextkin_name_one' => $this->input->post('nextkin_name_one'),
				'nextkin_email_one' => $this->input->post('nextkin_email_one'),
				'nextkin_relationship_one' => $this->input->post('nextkin_relationship_one'),
				'nextkin_name_two' => $this->input->post('nextkin_name_two'),
				'nextkin_email_two' => $this->input->post('nextkin_email_two'),
				'nextkin_relationship_two' => $this->input->post('nextkin_relationship_two'),
				'agree_terms_one' => $this->input->post('agree_terms_one'),
				'agree_terms_two' => $this->input->post('agree_terms_two')
				);
				
			
			$result = $this->employees_model->add_induction_form($data,$emp_id);
            $data_user = array(
            	'status' => 'Complete'
            	);
            $user_id = $this->session->userdata('user_id');	
            $user = $this->employees_model->status_update($data_user,$user_id);	
			if($result){
				$this->session->set_flashdata('sucess_msg', 'All the information has been successfully added. Cafe manager will be in touch for any further information required.');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add Induction');
			}
			redirect('employees/emp_dashboard');
		}else{
			redirect('employees/emp_indection_reg');
		}
		}
	}
	function submit_save_exit_emp_indection_reg() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
            $emp_id = $this->input->post('emp_id');
		
			$itemname = $this->input->post('itemname');
			$uniform_arr = [];

			foreach($itemname as $item){
					
					$uniforms = $_REQUEST['uniform']["'$item'"];

					foreach($uniforms as $key => $details){
						$exp = explode('_',$key);
						if($details != '' && $exp[1] == 'qty'){
							$data['name'] = $item;
							$data['size'] = $exp[0];
							$data['qty'] = $uniforms[$exp[0]."_qty"];
							$data['total'] = $uniforms[$exp[0]."_total"];

							array_push($uniform_arr, $data);
						}
					}	
				}
				//echo '<pre>';print_r($uniform_arr);exit;
				foreach($uniform_arr as $uniform){
					$values['employee_id'] = $emp_id;
					$values['item_name'] = $uniform['name'];
					$values['item_size'] = $uniform['size'];
					$values['quantity'] = $uniform['qty'];
					$values['total'] = $uniform['total'];

					$add_uniform = $this->employees_model->add_uniform($values);
				}
    
			 $dob = strtotime($this->input->post('dob'));


$dob = date('Y-m-d',$dob);
		    $data = array(
		    	'first_name' => $this->input->post('first_name'),
		    	'last_name' => $this->input->post('last_name'),
		    	'email' => $this->input->post('email'),
		    	'phone' => $this->input->post('phone'),
		    	'title' => $this->input->post('title'),
		    	'name' => $this->input->post('name'),
		    	'surname' => '',
		    	'email' => $this->input->post('email'),
		    	'dob' => $dob,
		    	'unit_number' => $this->input->post('unit'),
		    	'street' => $this->input->post('street'),
		    	'suburb' => $this->input->post('suburb'),
		    	'postcode' => $this->input->post('post'),
		    	'state' => $this->input->post('state'),
		    	'tfn_number' => $this->input->post('tfn_no'),
		    	'super_fund_name' => $this->input->post('super_fund_name'),
				'super_annuation_no' => $this->input->post('super_annua_no'),
				'heighest_acd_achmts' => $this->input->post('heighest_acadamic_ach'),
				'pre_emp_hstry_one' => $this->input->post('pre_emp_hstry_one'),
				'pre_emp_hstry_two' => $this->input->post('pre_emp_hstry_two'),
				'pre_emp_hstry_three' => $this->input->post('pre_emp_hstry_three'),
				'visa_status' => $this->input->post('visa_status'),
				'nextkin_name_one' => $this->input->post('nextkin_name_one'),
				'nextkin_email_one' => $this->input->post('nextkin_email_one'),
				'nextkin_relationship_one' => $this->input->post('nextkin_relationship_one'),
				'nextkin_name_two' => $this->input->post('nextkin_name_two'),
				'nextkin_email_two' => $this->input->post('nextkin_email_two'),
				'nextkin_relationship_two' => $this->input->post('nextkin_relationship_two'),
				'agree_terms_one' => $this->input->post('agree_terms_one'),
				'agree_terms_two' => $this->input->post('agree_terms_two'),
				'bank_1' => $this->input->post('bank_1'),
				'bank_branch_1' => $this->input->post('bank_branch_1'),
				'bsb_1' => $this->input->post('bsb_1'),
				'account_no_1' => $this->input->post('account_no_1'),
				'percentage_1' => $this->input->post('percentage_1'),
				'account_name_1' => $this->input->post('account_name_1'),
				'bank_2' => $this->input->post('bank_2'),
				'bank_branch_2' => $this->input->post('bank_branch_2'),
				'bsb_2' => $this->input->post('bsb_2'),
				'account_no_2' => $this->input->post('account_no_2'),
				'percentage_2' => $this->input->post('percentage_2'),
				'account_name_2' => $this->input->post('account_name_2'),
				'bank_3' => $this->input->post('bank_3'),
				'bank_branch_3' => $this->input->post('bank_branch_3'),
				'bsb_3' => $this->input->post('bsb_3'),
				'account_no_3' => $this->input->post('account_no_3'),
				'percentage_3' => $this->input->post('percentage_3'),
				'account_name_3' => $this->input->post('account_name_3'),
				'entity' => $this->input->post('entity'),
				'police_surname' => $this->input->post('police_surname'),
				'given_name' => $this->input->post('given_name'),
				'address' => $this->input->post('address'),
				'medical_history' => $this->input->post('medical_history'),
				'fire_emg_completed_date' => $this->input->post('fire_emg_completed_date'),
				'oh_s_completed_date' => $this->input->post('oh_s_completed_date'),
				'police_certificate' => $final_file_name
				);
			$result = $this->employees_model->add_induction_form($data,$emp_id);
            // $this->ion_auth->logout();
		}
	}
	function open_timesheet() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
          $result = $this->employees_model->get_employees();
          $data['employees'] = $result;
          $this->load->view('employees/open_timesheet',$data);
		}
	}
	
   public function manager_leave_filter($endate='',$date='',$status=''){
	     $user_email = $this->session->userdata('user_email');
			 $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			 
	    $params=array();
			if($endate!=''&&$endate!='unset')
				$params['end_ate']=$endate;
				
			if($date!=''&&$date!='unset')
				$params['start_date']=$date;
			if($status!=''&&$status!='unset')
				$params['status']=$status;
	

	    			
	$leaves = $this->employees_model->getleaves($params,$emp_id);	
	
	

	$menu_items  = $this->display_menu();
				
			
				$data['leaves'] = $leaves;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/leave_history',$data);
				$this->load->view('general/footer');

	}
	
	function emp_timesheet($id) {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
          $result = $this->employees_model->get_employee_timesheet($id);
          $data['employees'] = $result;
          $this->load->view('employees/employee_timesheet',$data);
		}
	}
	function submit_employee_timesheet() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
          if ($this->form_validation->run() == true) {
            $data = array(
            	'employee_id' => $this->input->post('emp_id'),
            	'date' => date('Y-m-d'),
            	'in_time' => $this->input->post('emp_id'),
            	'out_time' => $this->input->post('emp_id')
            	);
          $result = $this->employees_model->submit_employee_timesheet($data); 	
		}else{
			 
		 }
		 redirect('employees/open_timesheet');
		}
	}
	public function upload($emp_id){
		
		// echo '<pre>';print_r($_FILES);exit;
		
		$file_name = 'induction_'.rand(10000,99999);
    	$config['upload_path'] = 'assets/docs/emp_uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']             = 1024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
        $config['file_name'] = $file_name;

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $picture = $uploadData['file_name'];
        }else{
            $picture = '';
        }
        //echo $picture;exit;
        $path = 'assets/docs/emp_uploads/'.str_replace(' ','_',$picture);
        $filename = $_FILES['file']['name'];
        // echo $filename;exit;
        
        $data = array(
        	'employee_id' => $emp_id,
        	'file_type' => $_FILES['file']['type'],
            'file_name' => $picture,
            'path' => $path
            );
        $res = $this->employees_model->update($data,$emp_id);
        //echo "<pre>";print_r($res);exit;
        $msg="";
						
			foreach($res as $row){
						$msg.="<div class='col-sm-3'>
	       	    <img src=".base_url('').'assets/docs/emp_uploads/'.$row->file_name." style='width:100%;min-height:200px;' alt='image1' class='upload-file'>
		<button  class='btn btn-info' ><a href=".base_url('').'assets/docs/emp_uploads/'.$row->file_name." style='text-decoration:none;' target='_blank'>View</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button target='_blank' class='btn btn-info'><a type='button' style='text-decoration:none;' onClick='delete_row(".$row->doc_id.");' id='$emp_id'>Delete</a></button>	
	    </div>";
			   }

        
	    echo $msg;
    }
    public function deletefiles(){
        
    	$id = $_POST['id'];
    	$result = $this->employees_model->get_docs_name($id);
    	$path = $result[0]->path;
    	$file = FCPATH.$path;
    	// echo $file;exit;
    	unlink($file);
    	$result = $this->employees_model->delete_doc($id);
    }
    
     
    
	public function leave_management(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
		$userlevel = $this->session->userdata('clearance_level');
    	$menu_items  = $this->display_menu();
		   $hdata['menus'] = $menu_items;
		   $user_id = $this->session->userdata('user_id');
             $user_email = $this->session->userdata('user_email');
			 $id = $this->admin_model->get_emp_details_fromemail($user_email);
			
			  $data['emp_id'] = $id;
		   $this->load->view('general/header_general',$hdata);
           $this->load->view('employees/leave_mng',$data);
		   $this->load->view('general/footer');
       }
	}
	public function submit_leave(){
	    
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
            
			$emp_id = $this->input->post('emp_id');
			$branch_result = $this->employees_model->get_emp_update($emp_id);

			foreach($branch_result as $row){
				$branchId = $row->branch_id;
			}
			//echo $branchId;exit;
			if($_FILES['med_certificate']['name'] != ''){
			$target_dir = 'assets/leave_certificates/';
		  	$userfile_name = $_FILES['med_certificate']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'leave_'.rand(10000,99999);
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["med_certificate"]["tmp_name"], $target_file);
			}else{
				$final_file_name = "";
			}
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$s_date = date('Y-m-d', strtotime($start_date));
			$e_date = date('Y-m-d', strtotime($end_date));
		$data = array(
		   'emp_id' => $emp_id,
		   'leave_type' => $this->input->post('leave_type'),
		   'start_date' => $s_date,
		   'end_date' => $e_date,
		   'leave_status' => 'Pending',
		   'medical_certificate' => $final_file_name,
		   'comments' => '',
		   'branch_id' => $branchId
		);
		//echo '<pre>';print_r($data);exit;
		$result = $this->employees_model->add_leave($data);
		if($result){
		    // send notifaction to manager when emp apply for leave using a helper function
         add_notification('leave_apply','manager',$emp_id);
         
		    $to = $branch_result[0]->manager_email;
		       
		  $msg = ' 
    <html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

        <title></title> 
    </head> 
    <body> 
        Hi Manager,
'.$branch_result[0]->first_name.' has requested leave. Please login to the HR portal to approve/reject/add more comments for the leave request. '.$branch_result[0]->first_name.' will be notified of the outcome.
 <p>Kind Regards,</p>
        <p>HR Team</p>
         </body> 
         </html>';  
        
    
     
            
            
            $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "Leave Requested by ".$branch_result[0]->first_name,
			    
			     );  
		      //if(mail($to, $subject, $msg, $headers)){  
		      if($this->get_content_and_send_mail($emp_details,$msg)){    
				$this->session->set_flashdata('sucess_msg', '-	Your Leave Request has been sent to the manager for Review. An email notification will be sent once the manager has an update on the request.');
				redirect('employees/leave_management');
		      }
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to send your leave request. Contact your Manager.');
				redirect('employees/leave_management');
			}
			
       }
	}
	public function leave_history(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
			    $userlevel = $this->session->userdata('clearance_level');
				$menu_items  = $this->display_menu();
				$user_id = $this->session->userdata('UserId');
				// $user_details = $this->employees_model->get_user_status($user_id);
				// foreach($user_details as $row){
				// 	$emp_id = $row->customer_id;
				//   }
			
				$leaves = $this->employees_model->get_emp_leave_details($user_id);
				//echo '<pre>';print_r($leaves);exit;
				$data['leaves'] = $leaves;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/leave_history',$data);
				$this->load->view('general/footer');
		}
	}
	public function emp_leave_check($id){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
			    $userlevel = $this->session->userdata('clearance_level');
			$menu_items  = $this->display_menu();
				$leaves = $this->employees_model->get_leaves_manager_update($id);
				//echo '<pre>';print_r($leaves);exit;
				$data['leaves'] = $leaves;
				$data['leave_id'] = $id;
				//echo '<pre>';print_r($leaves);exit;
				$data['leaves'] = $leaves;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/leave_history',$data);
				$this->load->view('general/footer');
		}
	}
	function roster_history() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
                $branch_id = $this->session->userdata('branch_id');
			    $userlevel = $this->session->userdata('clearance_level');
			$menu_items  = $this->display_menu();
				$user_id = $this->session->userdata('user_id');
				$user_details = $this->employees_model->get_user_status($user_id);
				foreach($user_details as $row){
					$emp_id = $row->customer_id;
				  }
				$roster = $this->employees_model->get_roster_emp($emp_id);
				//echo '<pre>';print_r($roster);exit;
                $data['roster'] = $roster;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/emp_roster_history',$data);
				$this->load->view('general/footer');
		}
	}
		function emp_week_roster($date) {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
			    $branch_id = $this->session->userdata('branch_id');
			    $userlevel = $this->session->userdata('clearance_level');
				$menu_items  = $this->display_menu();
				$user_id = $this->session->userdata('user_id');
				$user_details = $this->employees_model->get_user_status($user_id);
				foreach($user_details as $row){
					$emp_id = $row->customer_id;
				  }
				$employees = $this->employees_model->get_employees_branchwise($branch_id);				
				$roster = $this->employees_model->emp_week_roster($emp_id,$date);
				foreach($roster as $row){
					$s_date = $row->start_date;
					$e_date = $row->end_date;
				}
				$data['employees'] = $employees;
                $data['roster'] = $roster;
				$data['start_date'] = $s_date;
                $data['end_date'] = $e_date;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/emp_rost_detail_view',$data);
				//$this->load->view('general/footer');
          	
		}
	}
}
