<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeedetails extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
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
    }
    
    public function index(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('admin', 'menu')){
			redirect('general/index');
		}else {
    		redirect('admin/manage_employee');
		}
    }
    
    public function display_menu(){
        
        
        $menus = $this->ion_auth->getMenus();
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
    
    public function file_upload_code($name_value=''){
        
        if(isset($name_value) && $name_value !=''){
                
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
                 $config['max_size'] = 200000;
                 $config['max_width'] = 2000;
                 $config['max_height'] = 2000;
                 
                 $new_name = uniqid().'_'.$_FILES[$name_value]['name'];
                 
                 $new_name = preg_replace('/\s+/', '_', $new_name);
                 $config['file_name'] = $new_name;

                 $this->load->library('upload', $config);
                 
                 if (!$this->upload->do_upload($name_value, $new_name)) {
             
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error_msg', $error['error']);
                
                } 
        
        return $new_name;
                    
                }
    }

    public function pagination_data_buildup($table_name,$total_records,$link,$role_id=''){
         if ($total_records > 0) 
                   {
            // get current page records
           $branch_id = $this->session->userdata('branch_id');
         
            $config = array();
            $config['base_url'] = 'https://www.cafeadmin.com.au/HR/index.php/'.$link;
            $config['total_rows'] = $total_records;
            if($total_records > 10){
              $config["per_page"] = 10;  
            }else{
             $config["per_page"] = $total_records;   
            }
            
            $config["num_links"] = 3;
          
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
            
           
        if((int)$this->uri->segment(3) >=10){
                 $start= (int)$this->uri->segment(3) +1;
            }else{
                 $start= (int)$this->uri->segment(3) * $config['per_page']+1;
            }
       if((int)$this->uri->segment(3) >=10){         
          $end = ($this->uri->segment(3) == floor($config['total_rows']/ $config['per_page']))? $config['total_rows'] : (int)$this->uri->segment(3)  + $config['per_page'];
        }else{
        $end = ($this->uri->segment(3) == floor($config['total_rows']/ $config['per_page']))? $config['total_rows'] : (int)$this->uri->segment(3)  + $config['per_page'];
 
        }
           $result_count = "Showing ".$start." - ".$end." of ".$config['total_rows']." Results";
		 
		 if(isset($table_name) && ($table_name=='memo' || $table_name=='document')){
		  
		  if($branch_id ==''){
		         $type='memo';  
		         $branch_id = $role_id;
		    }else{
		        $branch_id = $branch_id;
		        $type='admin'; 
		    }
		  
		    
		 }else{
		     if($branch_id ==''){
		$user_email = $this->session->userdata('user_email');
	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
	    if($table_name=='timesheet'){
	       $branch_id = $this->admin_model->get_emp_details_fieldwise($emp_id,'branch_id');
	         
	        $type='showall_for_employee';  
	       
	    }else{
	        $branch_id = $emp_id;
	         $type='employee';  
	    }
		  
		   }else{
		       
		     $type='admin';  
		   }
		     
		 }
            $result_data  = $this->EmployeesDeatils_model->fetch_data($table_name,$branch_id,$config["per_page"], $this->uri->segment(3),$type);
            
           
            
           return  $result_array = array(
                'result_count' => $result_count,
                 'records_data' => $result_data
                
                );
            
            }
        
    }
    
    public function create_mail_template($msg='',$refer_to=''){
       
       $html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
    </head> 
    <body> 
    <p>'.$refer_to.'</p><p>'.$msg.'</p>
        <p>Kind Regards,</p>
         <p>HR Team</p>
         </body> 
         </html>';
         
         return $html;
        
    }
    
    public function get_content_and_send_mail($emp_detail=array(),$msg){
       
			  
		       $email = $emp_detail['send_to'];
		       $subject = $emp_detail['subject'];
		        // Set content-type header for sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                
               $headers .= "From: info@cafeadmin.com.au\r\n" .
               "Reply-To: info@cafeadmin.com.au\r\n" .
               "X-Mailer: PHP/" . phpversion();
             // send email
	         
			  mail($email, $subject, $msg, $headers);
			  return true;
    }
    public function add_covid(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $completed_date = strtotime($this->input->post('reporting_date'));
               $reporting_date = date('Y-m-d',$completed_date);
		        
		    $user_email = $this->session->userdata('user_email');    
			$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
		
			  
		   $data=array(
		    'branch_id' => $branchId,
		    'emp_id' => $emp_id,
		    'emp_name' => $empname,
		    'staff_name' => $this->input->post('staff_name'),
			'reporting_date' => $reporting_date,
			'reporting_time' => $this->input->post('reporting_time'),
			'temperature' => $this->input->post('temperature'),
			'Chills' => $this->input->post('Chills'),
			'Cough' => $this->input->post('Cough'),
			'sore_throat' => $this->input->post('sore_throat'),
			'breath' => $this->input->post('breath'),
			'running_nose' => $this->input->post('running_nose'),
			'smell' => $this->input->post('smell'),
		
			
			);
			
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('covid',$data);
		   redirect('Employeedetails/success');
		        
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/add_covid');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
    
    public function employee_filter($name,$email,$phone){
           
        $branch_id = $this->session->userdata('branch_id');
        $menu_items  = $this->display_menu();
		
	   $employees = $this->admin_model->filter_get_employees_branchwise($branch_id,$name,$email,$phone);
	   
	   	foreach($employees as $k => $employee){
					$i = 0;
					foreach($employee as $key => $val){
					if($val == ''){
						$i = $i+1;
					}
				}
				$employees[$k]->emptyclmn = $i;
				}
				$data['employees'] = $employees;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/manage_employee',$data);
				$this->load->view('general/footer');
    }
    
    public function emp_satisfaction_survey(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){    
		    $user_email = $this->session->userdata('user_email');    
			$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
		
			  
		   $data=array(
		    'branch_id' => $branchId,
		    'emp_id' => $emp_id,
		    'emp_name' => $empname,
			'compensation' => $this->input->post('compensation'),
			'oppurtinity' => $this->input->post('oppurtinity'),
			'benefits' => $this->input->post('benefits'),
			'work_environment' => $this->input->post('work_environment'),
			'training' => $this->input->post('training'),
			'performance_evaluation' => $this->input->post('performance_evaluation'),
			'guidance' => $this->input->post('guidance'),
			'job_satisfaction' => $this->input->post('job_satisfaction'),
			'emp_morale' => $this->input->post('emp_morale'),
			'recommendation' => $this->input->post('recommendation'),
			
			);
			//echo '<pre>';print_r($data);exit;
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('emp_satisfaction_survey',$data);
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Satisfaction Feedback Submitted",
			    
			     );
			 
$msg = $empname.' has submitted a new satisfaction feedback. Please login to the HR portal to view and add comments to the feedback submitted. '.$empname.' will be notified via an email if any comments are added to the feedback.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/emp_satisfaction_survey');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
   
    public function Self_Assessment(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
		        
		    $user_email = $this->session->userdata('user_email');    
			$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
			  
		   $data=array(
		    'branch_id' => $branchId,
		    'emp_id' => $emp_id,
			'emp_name' => $this->input->post('emp_name'),
			'completed_date' => $completed_date,
			'improve_on' => $this->input->post('improve_on'),
			'steps' => $this->input->post('steps'),
			'goals' => $this->input->post('goals'),
			
			);
			//echo '<pre>';print_r($data);exit;
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Employee_Self_Assessment',$data);
		    
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Self Assessment Submitted",
			    
			     );
			 
$msg = $empname.' has submitted a new employee self assessment. Please login to the HR portal to view and add comments to the self assessment submitted.
'.$empname.' will be notified via an email if any comments are added to the assessment.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		   
		        
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Self_Assessment');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
    public function Employee_reimbursement(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
               
                if(isset($_FILES['receipt']['name']) && $_FILES['receipt']['name'] !=''){
                  
                  $new_name = $this->file_upload_code('receipt');
               }else{
                   $receipt ='';
               }
               
               
		        $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			  
			$branch_result = $this->employees_model->get_emp_update($emp_id);
			
		
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
		   $data=array(
		      'branch_id' => $branchId,
		     'receipt' => $new_name,
		     'emp_id'=> $emp_id,
			'emp_name' => $this->input->post('emp_name'),
			'completed_date' => $completed_date,
			'total_reimbursement' => $this->input->post('total_reimbursement'),
			'reason' => $this->input->post('reason'),
			'business_manager' => $this->input->post('business_manager'),
			'br_date' => $br_date
			
			
			);
			//echo '<pre>';print_r($data);exit;
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Employee_reimbursement',$data); 
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Reimbursement Request Submitted",
			    
			     );
			 
$msg = $empname.' has submitted a new reimbursement. Please login to the HR portal to view and add comments to the reimbursement submitted.
'.$empname.' will be notified via an email if any comments are added.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Employee_reimbursement');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
    public function Incident_Report(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $incident_date = strtotime($this->input->post('incident_date'));
               $incident_date = date('Y-m-d',$incident_date);
               
               $er_date = strtotime($this->input->post('er_date'));
               $er_date = date('Y-m-d',$er_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
               
               
               
                // For File Upload
               if(isset($_FILES['incident_file']['name']) && $_FILES['incident_file']['name'] !=''){
                  
                    $new_name = $this->file_upload_code('incident_file');
               }else{
                   $new_name ='';
               }
               
               
               
		        $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    	$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
		   $data=array(
		    'branch_id' => $branchId, 
		    'incident_file' => $new_name,
			'work_area' => $this->input->post('work_area'),
			'emp_id'=> $emp_id,
			'incident_date' => $incident_date,
			'supervisor_on_duty' => $this->input->post('supervisor_on_duty'),
			'person_reporting_incident' => $this->input->post('person_reporting_incident'),
			'incident_time' => $this->input->post('incident_time'),
			 'incident_detail' => $this->input->post('incident_detail'),
			'investigation_result' => $this->input->post('investigation_result'),
			'action_to_take' => $this->input->post('action_to_take'),
			'emp_represntative' => $this->input->post('emp_represntative'),
			'er_date' => $er_date,
			'br_date' => $br_date,
			'business_manager' => $this->input->post('business_manager'),
			
			);
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Incident_Report',$data); 
		        
		        $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Incident Reported",
			    
			     );
			 
$msg = $empname.' has reported a new incident. Please login to the HR portal to view and add comments to the report submitted.
'.$empname.' will be notified via an email if any comments are added to the report.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Incident_Report');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function Injury_Report(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $injury_date = strtotime($this->input->post('injury_date'));
               $injury_date = date('Y-m-d',$injury_date);
               
               $er_date = strtotime($this->input->post('er_date'));
               $er_date = date('Y-m-d',$er_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
               
               
                // For File Upload
               if(isset($_FILES['injury_file']['name']) && $_FILES['injury_file']['name'] !=''){
                   
                  $new_name = $this->file_upload_code('injury_file');
               }else{
                   $new_name ='';
               }
               
               
		     $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    	$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}   
		   $data=array(
		     'branch_id' => $branchId,
		    'injury_file' => $new_name, 
		     'emp_id'=> $emp_id,
			'work_area' => $this->input->post('work_area'),
			'injury_date' => $injury_date,
			'supervisor_on_duty' => $this->input->post('supervisor_on_duty'),
			'team' => $this->input->post('team'),
			'employee_reporting_injury' => $this->input->post('employee_reporting_injury'),
			'injury_time' => $this->input->post('injury_time'),
			 'injury_detail' => $this->input->post('injury_detail'),
			'injury_time_details' => $this->input->post('injury_time_details'),
			'body_part_injured' => $this->input->post('body_part_injured'),
			'preventive_measures' => $this->input->post('preventive_measures'),
			'further_information' => $this->input->post('further_information'),
			'business_manager' => $this->input->post('business_manager'),
		     'br_date' => $br_date,
			);
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Injury_Report',$data); 
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Injury Reported",
			    
			     );
			 
$msg = $empname.' has reported a new injury. Please login to the HR portal to view and add comments to the report submitted.
'.$empname.' will be notified via an email if any comments are added to the report.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Injury_Report');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}

	public function Resignation_Letter(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $resign_date = strtotime($this->input->post('resign_date'));
               $resign_date = date('Y-m-d',$resign_date);
               
               // For File Upload
               if(isset($_FILES['resign_letter']['name']) && $_FILES['resign_letter']['name'] !=''){
                  
                   $new_name = $this->file_upload_code('resign_letter');
               }else{
                   $resign_letter ='';
               }
              
               

		        $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			 	$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}      
		   $data=array(
		      'branch_id' => $branchId,
			'subject' => $this->input->post('subject'),
			 'emp_id'=> $emp_id, 
			'resign_date' => $resign_date,
			'name' => $this->input->post('name'),
			'resign_note' => $this->input->post('resign_note'),
			'resign_letter' => $new_name,
			
			);
			
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Resignation_Letter',$data); 
		        $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "Resignation Letter",
			    
			     );
			 
$msg = $empname.' has submitted the letter of resignation. Please login to the HR portal to view and add comments to the letter submitted.
'.$empname.'> will be notified via an email if any comments are added to the request.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Resignation_Letter');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function Probationary_Period(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $start_date = strtotime($this->input->post('start_date'));
               $start_date = date('Y-m-d',$start_date);
               
               $end_date = strtotime($this->input->post('end_date'));
               $end_date = date('Y-m-d',$end_date);
               
              
		     $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    $branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}          
		   $data=array(
		    'branch_id' => $branchId,
			'name' => $this->input->post('name'),
			'emp_id'=> $emp_id,  
			'start_date' => $start_date,
			'end_date' => $end_date,
			'notes' => $this->input->post('notes'),
			
			
			);
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Probationary_Period',$data); 
		     redirect('Employeedetails/success');  
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Probationary_Period');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function Jobkeeper_Nomination_Notice(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $dob = strtotime($this->input->post('dob'));
               $dob = date('Y-m-d',$dob);
               
               
		    $user_email = $this->session->userdata('user_email');
			$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}                     
		   $data=array(
		    'branch_id' => $branchId,
		    'emp_id'=> $emp_id,    
			'business_name' => $this->input->post('business_name'),
			'dob' => $dob,
			'business_abn' => $this->input->post('business_abn'),
			'emp_full_name' => $this->input->post('emp_full_name'),
			'street_addr' => $this->input->post('street_addr'),
			'phone_no' => $this->input->post('phone_no'),
			'contact_email' => $this->input->post('contact_email'),
			'agree_terms_one' => $this->input->post('agree_terms_one')
			
			
			);
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Jobkeeper_Nomination_Notice',$data); 
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->manager_email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New JobKeeper Notification",
			    
			     );
			 
$msg = $empname.' has submitted the job keeper request. Please login to the HR portal to view and add comments to the request submitted.
'.$empname.'> will be notified via an email if any comments are added to the request.
';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/Jobkeeper_Nomination_Notice');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function add_memo($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 
		      $data=array(
		    'branch_id' => $branch_id,
		    'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'role' => $this->input->post('role')
			);
			
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('memo',$data);
            $role_id = $this->input->post('role');
                 $target_message ='memo';
		        redirect('Employeedetails/success/'.$target_message.'/'.$branch_id.'/'.$role_id);
		    }else{
		        
		    $result = $this->EmployeesDeatils_model->get_record_from_table('memo',$id);    
		    $role = $this->session->userdata('role');   
		    $data['details'] =   $result; 
		    $data['role'] =   $role;
		  
		    
		    $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles;
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/add_memo',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function add_document($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 
		        
		        // For File Upload
               if(isset($_FILES['document_name']['name']) && $_FILES['document_name']['name'] !=''){
                   
                  $new_name = $this->file_upload_code('document_name');
               }else{
                   $new_name ='';
               }
		      $data=array(
		   'doc_name' =>$this->input->post('doc_name'),
		    'branch_id' => $branch_id,
			'document_name' => $new_name,
			'role' => $this->input->post('role')
			);
			
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('document',$data);
            $role_id = $this->input->post('role');
                 $target_message ='Compliance Document have been uploaded succesfully';
		        redirect('Employeedetails/success/'.$target_message.'/'.$branch_id.'/'.$role_id);
		    }else{
		    
		    if(isset($id) && $id !='') {
		    $result = $this->EmployeesDeatils_model->get_record_from_table('document',$id);    
		     
		    $data['documents'] =   $result; 
		    
		    }  
		    
		     $role = $this->session->userdata('role'); 
		     $data['role'] =   $role;  
		    
		    $roles=$this->admin_model->fetch_role($branch_id);
		    $data['roles'] = $roles;
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/add_document',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function approve_timesheet(){
        
        	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 

		   $data=array(
		    'branch_id' => $branch_id,
			'roster_group_id' => $this->input->post('roster_list'),
			'timesheet_name' => $this->input->post('timesheet_name')
			);
			
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('timesheet',$data);
           
            $target_message ='TimeSheet Created Succesfully';
            
		   redirect('Employeedetails/success/'.$target_message);
		    }else{
		    
		    $all_future_roster = $this->admin_model->get_employees_roster($branch_id);
		   
          
		     $role = $this->session->userdata('role'); 
		     $data['rosters'] =   $all_future_roster;  
		     $data['role'] =   $role;
		     $data['branch_id'] =   $branch_id;
		    
		  
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/approve_timesheet',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
        
    }
    
    public function create_timesheet(){
        
        	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 
		        
		         $no_of_rosters=  count($this->input->post('roster_list'));
		  
		    if($no_of_rosters == 1){
		         $data=array(
		    'branch_id' => $branch_id,
			'roster_group_id' => $this->input->post('roster_list')[0],
			'timesheet_name' => $this->input->post('timesheet_name'),
			'timesheet_type' => "s"
			);
		       
		    }else{
		       $all_roster_group_ids= serialize($this->input->post('roster_list'));
		       
		         $data=array(
		    'branch_id' => $branch_id,
			'multiple_roster_group_id' => $all_roster_group_ids,
			'roster_group_id' => $this->input->post('roster_list')[0],
			'timesheet_name' => $this->input->post('timesheet_name'),
				'timesheet_type' => "m"
			);
		        
		    }

		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('timesheet',$data);
           
            $target_message ='The new timesheet is created.';
            
		   redirect('Employeedetails/success/'.$target_message);
		    }else{
		    
		    $all_future_roster = $this->admin_model->get_employees_roster($branch_id);
		   
          
		     $role = $this->session->userdata('role'); 
		     $data['rosters'] =   $all_future_roster;  
		     $data['role'] =   $role;
		     $data['branch_id'] =   $branch_id;
		    
		  
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/create_timesheet',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
        
    }
    
    
    public function timesheet_in_out(){
        
        	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 

		   $data=array(
		    'branch_id' => $branch_id,
			'roster_group_id' => $this->input->post('roster_list'),
			'timesheet_name' => $this->input->post('timesheet_name')
			);
			
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('timesheet',$data);
           
            $target_message ='The new timesheet is now created successfully.';
            
		   redirect('Employeedetails/success/'.$target_message);
		    }else{
		    $role = $this->session->userdata('role');
		    $all_timesheet = $this->admin_model->get_all_timesheet($branch_id);

		   $roster_id = $this->session->userdata('roster_id');
		   
		   $all_emps = $this->admin_model->get_employees_branchwise($branch_id,'admin');
		   $todays_date = date('Y-m-d', time());
        
		   
		   if(isset($roster_id) && $roster_id !=''){
		   foreach($all_emps as $all_emp){
		       
		       $timeseet_detail_of_this_employee = $this->admin_model->get_timesheet($all_emp->emp_id,$roster_id,$todays_date);
		       if(!empty($timeseet_detail_of_this_employee)){
		       $all_emp->in_time = $timeseet_detail_of_this_employee[0]->in_time;
		       $all_emp->out_time = $timeseet_detail_of_this_employee[0]->out_time;
		       $all_emp->break_in_time = $timeseet_detail_of_this_employee[0]->break_in_time;
		       $all_emp->break_out_time = $timeseet_detail_of_this_employee[0]->break_out_time;
		       if(isset($timeseet_detail_of_this_employee[0]->timesheet_id) && $timeseet_detail_of_this_employee[0]->timesheet_id !=''){
		           $data['timesheet_id'] =   $timeseet_detail_of_this_employee[0]->timesheet_id;
		       }else{
		           $data['timesheet_id'] =  '';
		       }
		       
		       }
		   }
		   }else{
		     $data['timesheet_id'] =  '';  
		   }
		
            
		
		     $data['all_timesheets'] =   $all_timesheet;
		  //   $data['all_emps'] =   $all_emps;
		  
		      $data['all_emps'] =   '';
		     $data['role'] =   $role;
		     $data['branch_id'] =   $branch_id;
		    
		  
// 		    $menu_items  = $this->display_menu();
			$hdata['timesheet_login'] = 'timesheet_login';
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/timesheet_in_out',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
        
    }
	
	// Listing of records from here
	
	function view_covid() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('covid');
				
				$records = $this->pagination_data_buildup('covid',$total_records,'Employeedetails/view_covid');
                
                
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_covid',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_emp_satisfaction_survey() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {

			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('emp_satisfaction_survey');
				
				$records = $this->pagination_data_buildup('emp_satisfaction_survey',$total_records,'Employeedetails/view_emp_satisfaction_survey');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_emp_satisfaction_survey',$data);
				$this->load->view('general/footer');
          	
		}
	}
	function view_Self_Assessment() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		    $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Employee_Self_Assessment');
				
				$records = $this->pagination_data_buildup('Employee_Self_Assessment',$total_records,'Employeedetails/view_Self_Assessment');
				
			
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Self_Assessment',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Employee_reimbursement() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		      $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Employee_reimbursement');
				
				$records = $this->pagination_data_buildup('Employee_reimbursement',$total_records,'Employeedetails/view_Employee_reimbursement');
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Employee_reimbursement',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Incident_Report() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
            
			   $data['role'] = $this->session->userdata('role');
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Incident_Report');
				
				$records = $this->pagination_data_buildup('Incident_Report',$total_records,'Employeedetails/view_Incident_Report');
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Incident_Report',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Injury_Report() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		       $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Injury_Report');
				
				$records = $this->pagination_data_buildup('Injury_Report',$total_records,'Employeedetails/view_Injury_Report');
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Injury_Report',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Resignation_Letter() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		       $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Resignation_Letter');
				
				$records = $this->pagination_data_buildup('Resignation_Letter',$total_records,'Employeedetails/view_Resignation_Letter');
				
			
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Resignation_Letter',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Probationary_Period() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		       $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Probationary_Period');
				
				$records = $this->pagination_data_buildup('Probationary_Period',$total_records,'Employeedetails/view_Probationary_Period');
				
			
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Probationary_Period',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Jobkeeper_Nomination_Notice() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			   
		       $data['role'] = $this->session->userdata('role');
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('Jobkeeper_Nomination_Notice');
				
				$records = $this->pagination_data_buildup('Jobkeeper_Nomination_Notice',$total_records,'Employeedetails/view_Jobkeeper_Nomination_Notice');
				
			
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_Jobkeeper_Nomination_Notice',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_memo() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {

			    $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('memo');
				$user_email = $this->session->userdata('user_email');    
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    $branch_result = $this->employees_model->get_emp_update($emp_id);
			
			if(!empty($branch_result)){
			foreach($branch_result as $row){
				$roleId = $row->role;
			
			}}else{
			    $roleId = '';
			}
		
				$records = $this->pagination_data_buildup('memo',$total_records,'Employeedetails/view_memo',$roleId);
                
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_memo',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_document() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {

			    $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('document');
				$user_email = $this->session->userdata('user_email');    
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    $branch_result = $this->employees_model->get_emp_update($emp_id);
			
			if(!empty($branch_result)){
			   foreach($branch_result as $row){
				$roleId = $row->role;
			
			} 
			}else{
			    $roleId = '';
			}
			
		
				$records = $this->pagination_data_buildup('document',$total_records,'Employeedetails/view_document',$roleId);

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_document',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_timesheet() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('timesheet');
				
				$records = $this->pagination_data_buildup('timesheet',$total_records,'Employeedetails/view_timesheet');
                
                
         
                
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_timesheet',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
  
	public function edit_emp_satisfaction_survey($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		         $emp_id = $this->input->post('emp_id');
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
		        $empname = $this->input->post('emp_name');
		  
		   $data=array(

			'compensation' => $this->input->post('compensation'),
			'oppurtinity' => $this->input->post('oppurtinity'),
			'benefits' => $this->input->post('benefits'),
			'work_environment' => $this->input->post('work_environment'),
			'training' => $this->input->post('training'),
			'performance_evaluation' => $this->input->post('performance_evaluation'),
			'guidance' => $this->input->post('guidance'),
			'job_satisfaction' => $this->input->post('job_satisfaction'),
			'emp_morale' => $this->input->post('emp_morale'),
			'recommendation' => $this->input->post('recommendation'),
			'comment' => $this->input->post('comment')
			
			);
		
		
			$table="emp_satisfaction_survey";
		    $table_id = $this->input->post('emp_satisfaction_survey_id');
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Feedback Submitted",
			    
			     );
			 
             
$msg = 'This email is to inform you that manager has added comments to the employee satisfaction feedback submitted.
Please login to the HR portal to view the update. '; 

             $refer_to =  'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$refer_to);   
		    
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		  
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('emp_satisfaction_survey',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			if($action=="view"){
			  $this->load->view('Employeedetails/view_form_emp_satisfaction_survey',$data);  
			}else{
			  $this->load->view('Employeedetails/emp_satisfaction_survey',$data);  
			}
			
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_covid($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
		        
		    
			  
		   $data=array(
		   
		    'staff_name' => $this->input->post('staff_name'),
			'reporting_date' => $reporting_date,
			'reporting_time' => $this->input->post('reporting_time'),
			'temperature' => $this->input->post('temperature'),
			'Chills' => $this->input->post('Chills'),
			'Cough' => $this->input->post('Cough'),
			'sore_throat' => $this->input->post('sore_throat'),
			'breath' => $this->input->post('breath'),
			'running_nose' => $this->input->post('running_nose'),
			'smell' => $this->input->post('smell'),
			'comment' => $this->input->post('comment'),
			
			);
			
			$table="covid";
		    $table_id = $this->input->post('covid_id');
		    
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    $emp_id = $this->input->post('emp_id');
		     $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Covid ",
			    
			     );
			 
                          
                     $msg = 'This email is to inform you that manager has added comments to Covid details submitted.
                     Please login to the HR portal to view the update'; 
              
             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('covid',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/add_covid',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Self_Assessment($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
		  $empname = $this->input->post('emp_name');
			  
		   $data=array(
			'completed_date' => $completed_date,
			'improve_on' => $this->input->post('improve_on'),
			'steps' => $this->input->post('steps'),
			'goals' => $this->input->post('goals'),
			'comment' => $this->input->post('comment'),
			
			);
			
			$table="Employee_Self_Assessment";
		    $table_id = $this->input->post('Employee_Self_Assessment_id');
		    
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    $emp_id = $this->input->post('emp_id');
		     $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Self Assessment Submitted",
			    
			     );
			 
                          
                     $msg = 'This email is to inform you that manager has added comments to the employee self assessment submitted
                     Please login to the HR portal to view the update'; 
              
             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Employee_Self_Assessment',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			
				if($action =="view"){
				   
			$this->load->view('Employeedetails/view_form_Self_Assessment',$data);
				}else{
			$this->load->view('Employeedetails/Self_Assessment',$data);    
				}
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Employee_reimbursement($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		         $emp_id = $this->input->post('emp_id');
		       $completed_date = strtotime($this->input->post('completed_date'));
               $completed_date = date('Y-m-d',$completed_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
		        $empname =$this->input->post('emp_name');
		   
			
			 if(isset($_FILES['receipt']['name']) && $_FILES['receipt']['name'] !=''){
                 
                   $new_name = $this->file_upload_code('receipt');
               }else{
                   $new_name ='';
               }
			  
		   $data=array(
		    
			'file'=>'',
			'completed_date' => $completed_date,
			'total_reimbursement' => $this->input->post('total_reimbursement'),
			'reason' => $this->input->post('reason'),
			'business_manager' => $this->input->post('business_manager'),
			'br_date' => $br_date,
			'comment' => $this->input->post('comment')
			
			);
			
			
			$table="Employee_reimbursement";
		    $table_id = $this->input->post('Employee_reimbursement_id');
		    
		   
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		     $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		     $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Reimbursement Submitted",
			    
			     );
			 
                          
                     $msg = 'This email is to inform you that manager has added comments to the reimbursement submitted.
                     Please login to the HR portal to view the update'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Employee_reimbursement',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
				if($action =="view"){
			$this->load->view('Employeedetails/view_form_Employee_reimbursement',$data);
				}else{
			$this->load->view('Employeedetails/Employee_reimbursement',$data);	    
				}
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Incident_Report($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $incident_date = strtotime($this->input->post('incident_date'));
               $incident_date = date('Y-m-d',$incident_date);
                $emp_id = $this->input->post('emp_id');
               $er_date = strtotime($this->input->post('er_date'));
               $er_date = date('Y-m-d',$er_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
               
               $emp_id = $this->input->post('emp_id');
               $branch_result = $this->employees_model->get_emp_update($emp_id);
               $to = $branch_result[0]->email;
               
                // For File Upload
               if(isset($_FILES['incident_file']['name']) && $_FILES['incident_file']['name'] !=''){
                  
                    $new_name = $this->file_upload_code('incident_file');
               }else{
                   $incident_file ='';
               }
		    
			
			  
		   $data=array(
		   
		    'incident_file' => $new_name,
			'work_area' => $this->input->post('work_area'),
			
			'incident_date' => $incident_date,
			'supervisor_on_duty' => $this->input->post('supervisor_on_duty'),
			'person_reporting_incident' => $this->input->post('person_reporting_incident'),
			'incident_time' => $this->input->post('incident_time'),
			 'incident_detail' => $this->input->post('incident_detail'),
			'investigation_result' => $this->input->post('investigation_result'),
			'action_to_take' => $this->input->post('action_to_take'),
			'emp_represntative' => $this->input->post('emp_represntative'),
			'er_date' => $er_date,
			'br_date' => $br_date,
			'business_manager' => $this->input->post('business_manager'),
			'comment' => $this->input->post('comment')
			
			);
			
			
			$table="Incident_Report";
		    $table_id = $this->input->post('Incident_Report_id');
		    
		   
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		   $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
			$empname = $branch_result[0]->first_name;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Incident Report",
			    
			     );
			 
                          
                     $msg = 'This email is to inform you that manager has added comments to the incident reported. Please login to the HR portal to view the update'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Incident_Report',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
				if($action =="view"){
			$this->load->view('Employeedetails/view_form_Incident_Report',$data);
				}else{
			$this->load->view('Employeedetails/Incident_Report',$data);	    
				}
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Injury_Report($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $injury_date = strtotime($this->input->post('injury_date'));
               $injury_date = date('Y-m-d',$injury_date);
               
               $er_date = strtotime($this->input->post('er_date'));
               $er_date = date('Y-m-d',$er_date);
               
               $br_date = strtotime($this->input->post('br_date'));
               $br_date = date('Y-m-d',$br_date);
                $emp_id = $this->input->post('emp_id');
               
                // For File Upload
               if(isset($_FILES['injury_file']['name']) && $_FILES['injury_file']['name'] !=''){
                  
                   $new_name = $this->file_upload_code('injury_file');
               }else{
                   $injury_file ='';
               }
		        
		     $emp_id = $this->input->post('emp_id');
		   
               $branch_result = $this->employees_model->get_emp_update($emp_id);
               $to = $branch_result[0]->email;
			  	$empname = $branch_result[0]->first_name;
			
			  
		   $data=array(
		   
		    'injury_file' => $new_name, 
		   
			'work_area' => $this->input->post('work_area'),
			'injury_date' => $injury_date,
			'supervisor_on_duty' => $this->input->post('supervisor_on_duty'),
			'team' => $this->input->post('team'),
			'employee_reporting_injury' => $this->input->post('employee_reporting_injury'),
			'injury_time' => $this->input->post('injury_time'),
			 'injury_detail' => $this->input->post('injury_detail'),
			'injury_time_details' => $this->input->post('injury_time_details'),
			'body_part_injured' => $this->input->post('body_part_injured'),
			'preventive_measures' => $this->input->post('preventive_measures'),
			'further_information' => $this->input->post('further_information'),
			'business_manager' => $this->input->post('business_manager'),
		     'br_date' => $br_date,
			'comment' => $this->input->post('comment')
			
			);
			
			
			$table="Injury_Report";
		    $table_id = $this->input->post('Injury_Report_id');
		    
		   
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "New Update on the Injury Reported",
			    
			     );
			  $emp_id = $this->input->post('emp_id');
		   
                          
            $msg = 'TThis email is to inform you that manager has added comments to the injury report submitted. Please login to the HR portal to view the update'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Injury_Report',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			if($action=='view'){
			   	$this->load->view('Employeedetails/view_form_Injury_Report',$data); 
			}else{
				$this->load->view('Employeedetails/Injury_Report',$data);    
			}
		
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Resignation_Letter($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		     $resign_date = strtotime($this->input->post('resign_date'));
               $resign_date = date('Y-m-d',$resign_date);
               
               // For File Upload
               if(isset($_FILES['resign_letter']['name']) && $_FILES['resign_letter']['name'] !=''){
                  
                    $new_name = $this->file_upload_code('resign_letter');
               }else{
                   $resign_letter ='';
               }
		        
		    
			$emp_id = $this->input->post('emp_id');
			  
		   $data=array(
		    
			'subject' => $this->input->post('subject'),
			
			'resign_date' => $resign_date,
			'name' => $this->input->post('name'),
			'resign_note' => $this->input->post('resign_note'),
			'resign_letter' => $new_name,
			'comment' => $this->input->post('comment')
			
			);
			
			
			$table="Resignation_Letter";
		    $table_id = $this->input->post('Resignation_Letter_id');
		    
		    $emp_id = $this->input->post('emp_id');
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		     $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  " A new update on the Resignation Letter Submitted",
			    
			     );
			  $msg = 'This email is to inform you that manager has added comments to the resignation letter submitted. Please login to the HR portal to view the update.'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Resignation_Letter',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			if($action =='view'){
			$this->load->view('Employeedetails/viw_form_Resignation_Letter',$data);	    
			}else{
			$this->load->view('Employeedetails/Resignation_Letter',$data);	    
			}
		
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Probationary_Period($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $start_date = strtotime($this->input->post('start_date'));
               $start_date = date('Y-m-d',$start_date);
               
               $end_date = strtotime($this->input->post('end_date'));
               $end_date = date('Y-m-d',$end_date);
               
		     $emp_id = $this->input->post('emp_id');
		      $branch_result = $this->employees_model->get_emp_update($emp_id);
              $to = $branch_result[0]->email;
			  	$empname = $branch_result[0]->first_name;
		   $data=array(
		    
			'start_date' => $start_date,
			'end_date' => $end_date,
			'notes' => $this->input->post('notes'),
			'comment' => $this->input->post('comment')
			
			);
			
		
			$table="Probationary_Period";
		    $table_id = $this->input->post('Probationary_Period_id');
		    
		  
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  " A new update on the Probationary Period",
			    
			     );
			  $msg = 'This email is to inform you that manager has added comments to the Probationary Period submitted. Please login to the HR portal to view the update.'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		  redirect('Employeedetails/success');     
		   }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Probationary_Period',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			if($action =='view'){
			 	$this->load->view('Employeedetails/view_form_Probationary_Period',$data);   
			}else{
			$this->load->view('Employeedetails/Probationary_Period',$data);    
			}
			
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_Jobkeeper_Nomination_Notice($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		     $dob = strtotime($this->input->post('dob'));
               $dob = date('Y-m-d',$dob);
		   
			  
		   $data=array(
		    
			'business_name' => $this->input->post('business_name'),
			'dob' => $dob,
			'business_abn' => $this->input->post('business_abn'),
			'emp_full_name' => $this->input->post('emp_full_name'),
			'street_addr' => $this->input->post('street_addr'),
			'phone_no' => $this->input->post('phone_no'),
			'contact_email' => $this->input->post('contact_email'),
			'agree_terms_one' => $this->input->post('agree_terms_one'),
			'comment' => $this->input->post('comment')
			
			);
			
		
			$table="Jobkeeper_Nomination_Notice";
		    $table_id = $this->input->post('Jobkeeper_Nomination_Notice_id');
		    $emp_id = $this->input->post('emp_id');
		  
		    $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		    $branch_result = $this->employees_model->get_emp_update($emp_id);
			$to = $branch_result[0]->email;
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "A New Update on the Job Keeper Request Submitted",
			    
			     );
			  $msg = 'This email is to inform you that manager has added comments to the job keeper notice submitted. Please login to the HR portal to view the update'; 

             $rfr_to = 'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$rfr_to);     
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    redirect('Employeedetails/success');
		      }
		        
		    }else{
		       
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Jobkeeper_Nomination_Notice',$id);    
		        
		    $data['details'] =   $result;
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			if($action =='view'){
		$this->load->view('Employeedetails/view_form_Jobkeeper_Nomination_Notice',$data);	    
			}else{
		$this->load->view('Employeedetails/Jobkeeper_Nomination_Notice',$data);	    
			}
			
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	public function edit_memo($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
         $branch_id = $this->session->userdata('branch_id');
		  $data=array(
		    'branch_id' => $branch_id,
		    'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'role' => $this->input->post('role')
			);
			
		    
            $role_id = $this->input->post('role');
            $target_message ='memo';
		   	$table="memo";
		    $table_id = $this->input->post('memo_id');
		    
		      $insert_id = $this->EmployeesDeatils_model->update_table($table,$table_id,$data);
		      redirect('Employeedetails/success/'.$target_message.'/'.$branch_id.'/'.$role_id);
		    }
		    
			
		}
	}

    public function success(){
            $target_msg = $this->uri->segment(3); 
            if(!empty($this->uri->segment(4))){
                 $branch =  $this->uri->segment(4);
            }
            if(!empty($this->uri->segment(5))){
                 $role_id =  $this->uri->segment(5);
            }
           
           if(isset($target_msg) && $target_msg !=''){
               
               if($target_msg=='role'){
                  $data['msg'] = 'Role Added Succesfully !' ;
               }elseif($target_msg=='memo'){
                  $data['msg'] = 'Memo Added Succesfully !' ;
                  $data['branch_id'] = $branch;
                  $data['role_id'] = $role_id;
               }else{
                   $data['msg'] = urldecode($target_msg);
               }

                }else{
                    $data['msg'] = 'The compliance request has been sent/updated successfully';
                }
            $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
            $this->load->view('general/header_general',$hdata);
            $data['link'] =  base_url()."index.php/general/dashboard";
            // if($target_msg=='memo'){
            // $this->load->view('Employeedetails/memo_success',$data);
            // }
            // else{
            $this->load->view('Employeedetails/success',$data);
            // }
		
			$this->load->view('general/footer');
    }
    
    public function send_email_to_all_employee(){

        $branch_id = $this->input->post('id', TRUE);
        $role_id = $this->input->post('role_id', TRUE); 

        $all_emp = $this->admin_model->get_employees_branchwise($branch_id,'admin',$role_id);
        $msg = 'This email is to inform you that a new memo has been sent by the management. Please login to the HR portal to view the MEMO';
        if(!empty($all_emp)){
        foreach($all_emp as $emp){
            $rfr_to = 'Dear '.$emp->first_name.' ,';
             $html_msg = $this->create_mail_template($msg,$rfr_to);
             $emp_detail = array(
                 'send_to' =>$emp->email,
                  'subject' => 'Memo from the Management'
                 );
                 
                  
			
             $this->get_content_and_send_mail($emp_detail,$html_msg);
            
        }
    }
        return true;
    }


public function fetch_employee_for_timsheet(){
    
    $roster_plus_timesheet_id = $_POST['roster_list'];
    $data_posted = explode('_', $roster_plus_timesheet_id);
    if(!empty($data_posted)){
        if(isset($data_posted[0]) && $data_posted[0] !=''){
            $roster_group_id= $data_posted[0];
        }
        
    if(isset($data_posted[1]) && $data_posted[1] !=''){
    $timesheet_id= $data_posted[1];
     $data['timesheet_id'] =  $timesheet_id; 
        }else{
     $data['timesheet_id'] =  '';
        }
        
        // check if timesheet has single roster or multiple roster
    if(isset($data_posted[2]) && $data_posted[2] !=''){
    $timesheet_type= $data_posted[2];
     $data['timesheet_type'] =  $timesheet_type; 
        }else{
     $data['timesheet_type'] =  '';
        }
     
     
    }else{
        $roster_group_id= '';
     $timesheet_id= '';
     $data['timesheet_id'] =  '';
    }
     
  
    
    if($timesheet_type=="m"){
        
        //fetch all roster id so that we can find all the employees of those roster to be displayted in timesheet in out page
         $seralized_all_roster_forthis_timesheet = $this->employees_model->get_timesheetfor_multiple_roster($timesheet_id);
         $all_roster_forhtis_timesheets = unserialize($seralized_all_roster_forthis_timesheet[0]->multiple_roster_group_id);
       $all_emps = array();
      
         foreach($all_roster_forhtis_timesheets as $all_roster_forhtis_timesheet){
           
            $emps = $this->admin_model->fetch_employee_for_timsheet($all_roster_forhtis_timesheet);
           
           foreach($emps as $emp){
                array_push($all_emps,$emp);
           }
           }
      
    }else{
         $all_emps = $this->admin_model->fetch_employee_for_timsheet($roster_group_id);
    }

	
		  	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		   
		    $role = $this->session->userdata('role');
		    $all_timesheet = $this->admin_model->get_all_timesheet($branch_id);

		   $roster_id = $this->session->userdata('roster_id');

		   $todays_date = date('Y-m-d', time());
        
		   foreach($all_emps as $all_emp){
		       
		     
		       $timeseet_detail_of_this_employee = $this->admin_model->get_timesheet($all_emp->emp_id,$timesheet_id,$todays_date);
		       
		       
		       if(!empty($timeseet_detail_of_this_employee)){
		       $all_emp->in_time = $timeseet_detail_of_this_employee[0]->in_time;
		       $all_emp->out_time = $timeseet_detail_of_this_employee[0]->out_time;
		       $all_emp->break_in_time = $timeseet_detail_of_this_employee[0]->break_in_time;
		       $all_emp->break_out_time = $timeseet_detail_of_this_employee[0]->break_out_time;
		      
		       
		       }
		   }
		 
            
		
		     $data['all_timesheets'] =   $all_timesheet;
		     $data['all_emps'] =   $all_emps;
		     $data['role'] =   $role;
		     $data['branch_id'] =   $branch_id;
		    
		  	$hdata['timesheet_login'] = 'timesheet_login';

			$hdata['timesheet_login'] = 'timesheet_login';
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/timesheet_in_out',$data);
			$this->load->view('general/footer');
		   
		    
			
		}
  
            
    
}
    public function fetch_roster(){
     
     $roster_group_id = $this->input->post('roster_group_id', TRUE);
       $branch_id = $this->input->post('branch_id', TRUE);
     $all_roster_of_branch = $this->admin_model->week_roster($roster_group_id);
    $table = '';
    $week_days = array('mon','tues','wed','thus','fri','sat','sun');
    
    $table .= '<div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">EMPLOYEE</th> <th style="text-align: center;">MON</th>  <th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th>
     <th style="text-align: center;">ACTION</th></tr></thead>';
    
    foreach($all_roster_of_branch as $row){ 
     $emp_name= $this->admin_model->get_emp_details_fieldwise($row->emp_id,'first_name');    
  
   $table .= '<tbody><tr><td class="start_end"><b></a>'. $emp_name .'</b></td>';
   
   for ($i = 0; $i < 7; $i++) {
     $table .='<td class="start_end"><table><tr><td class="child">Start</td> <td class="child">End</td> <td class="child">Break</td></tr><tr>';
      $start_nameofday = $week_days[$i].'_start_time';
      $end_nameofday = $week_days[$i].'_end_time';
      $break_nameofday = $week_days[$i].'_break_time';
    if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { $start_day = "";  } else {   $start_day = date ('H:i A',strtotime($row->$start_nameofday)); }
    if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { $end_day ="";  } else {   $end_day= date ('H:i A',strtotime($row->$end_nameofday)); } 
    if($row->$break_nameofday > 0) { $break_time = $row->$break_nameofday.' Mins';  } else {  $break_time =  ' '; }
      $table .='<td class="child start_height">'. $start_day.'</td>';
      $table .='<td class="child start_height">'. $end_day.'</td>';
      $table .='<td class="child start_height">'. $break_time.'</td>';
    $table .='</tr></table></td>';
   }
   $table .='<td><a htef="#" onclick=fetch_timesheet('.$row->emp_id.','.$row->roster_group_id.')>View Timesheet</a></td></tr></tbody>';
 
 } 
 $table .='</table>';
 echo $table;
   
 }
 
 
 
    public function fetch_timesheet($emp_id='',$roster_group_id='',$call_type=''){
     
     if($call_type != 'function_call'){
      $emp_id = $this->input->post('emp_id', TRUE);
      $roster_group_id = $this->input->post('roster_group_id', TRUE);
     }
  
    //  $timesheet_of_employee = $this->admin_model->get_timesheet($emp_id,$roster_group_id);
    $timesheet_of_roster = $this->employees_model->get_employee_timesheet($emp_id,$roster_group_id);
     
    $table = '';
    $week_days = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
    
    $table .= '<div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">Employee Name</th> <th style="text-align: center;">MON</th>  <th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th>
     <th style="text-align: center;">Action</th></tr></thead>';
    
   if(!empty($timesheet_of_roster)){
      foreach($timesheet_of_roster as $timesheet_of_ros){
          $nameOfDay[] = date('D', strtotime($timesheet_of_ros->date));
      }
        
    
     $emp_name= $this->admin_model->get_emp_details_fieldwise($timesheet_of_roster[0]->employee_id,'first_name');    
  
   $table .= '<tbody><tr><td class="start_end"><h4>'. $emp_name .'</h4></td>';
   $loop_count = 0;
   for ($i = 0; $i < 7; $i++) {
       $table .='<td class="start_end"><table><tr>';
    
      if (in_array($week_days[$i], $nameOfDay)){
           
      $table .='<td class="child">In</td> <td class="child">Out</td> <td class="child">Break In</td><td class="child">Break Out</td></tr><tr>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->in_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->out_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->break_in_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->break_out_time.'</td>';
      $loop_count++;
      }
      
    $table .='</tr></table></td>';
   }
   
    if($call_type == 'function_call'){
        if($timesheet_of_roster[0]->in_verify == 1){
    $table .='<td>Approved</td></tr></tbody>';
        }elseif($timesheet_of_roster[0]->in_verify == 2){
            $table .='<td>Rejected</td></tr></tbody>';
        }else{
        $table .='<td>Pending</td></tr></tbody>';
             
        }
    }else{
        if($timesheet_of_roster[0]->in_verify == 1){
            $table .='<td>Approved</a></td></tr></tbody>'; 
        }elseif($timesheet_of_roster[0]->in_verify == 2){
        $table .='<td>Rejected</a></td></tr></tbody>'; 
        }else{
      $table .='<td class="status_timesheet"><a htef="#" onclick=update_timesheet('.$timesheet_of_roster[0]->timesheet_id.','.$timesheet_of_roster[0]->employee_id.',1)>Approve </a>
      <a htef="#" onclick=update_timesheet('.$timesheet_of_roster[0]->timesheet_id.','.$timesheet_of_roster[0]->employee_id.',2)>/ Reject</a>
      </td></tr></tbody>';
    }
     
    }
 
 
 }
 
 $table .='</table>';
 if($call_type == 'function_call'){
     return $table;
 }else{
   echo $table;   
 }
 

   
 }
 
 public function fetch_multiple_timesheet($timesheet_id='',$roster_group_id='',$call_type=''){
     
  $timesheet_of_roster = $this->employees_model->get_complete_employee_timesheet($timesheet_id,$roster_group_id);



    $table = '';
    $week_days = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
    
    $table .= '<div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">Employee Name</th> <th style="text-align: center;">MON</th>  <th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th><th style="text-align: center;">Status</th>
     </tr></thead>';
    
  if(!empty($timesheet_of_roster)){
        $table .= '<tbody>';
        $current_index=0;
         $arr_length = count($timesheet_of_roster);
       
     
      foreach($timesheet_of_roster as $timesheet_of_ros){
      
      if(($current_index +1) < $arr_length){
          
          if(isset($timesheet_of_roster[$current_index]->employee_id) && isset($timesheet_of_roster[$current_index+1]->employee_id)){
              
         
          
          
          if($current_index !=0){
          if($timesheet_of_roster[$current_index]->employee_id != $timesheet_of_roster[$current_index+1]->employee_id){ 
          $strt = true;
          }else{
          $strt = false;
          }
            }else{
              $strt  = true;
          } }
          else{
            $strt = true;   
          }
         
         
          
      if($strt == true){ 
         
        $this_week_details =  $this->employees_model->get_emp_details_for_this_week($timesheet_of_ros->employee_id,$timesheet_of_ros->timesheet_id);
        foreach($this_week_details as $this_week_detail){
            $nameOfDay[] = date('D', strtotime($this_week_detail->date));
        }

    
     $emp_name= $this->admin_model->get_emp_details_fieldwise($timesheet_of_ros->employee_id,'first_name');    
  
  $table .= '<tr><td class="start_end">'. $emp_name .'</td>';
  $loop_count = 0;
  for ($i = 0; $i < 7; $i++) {
      $table .='<td class="start_end"><table><tr>';
    
      if (in_array($week_days[$i], $nameOfDay)){
           
      $table .='<td class="child">In</td> <td class="child">Out</td> <td class="child">Break In</td><td class="child">Break Out</td></tr><tr>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->in_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->out_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->break_in_time.'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$loop_count]->break_out_time.'</td>';
      $loop_count++;
      }
      
    $table .='</tr></table></td>';
  }
   
  if($timesheet_of_ros->in_verify == 0){
          $table .='<td>Pending</td>';
      }elseif($timesheet_of_ros->in_verify == 1){
         $table .='<td>Approved</td>'; 
      }else{
         $table .='<td>Rejected</td>'; 
      }
      
      }
      $current_index++;
      }
      
      
      }
      
    $table .='</tr></tbody>';
 
 
 }
 
 $table .='</table>';
 if($call_type == 'function_call'){
     return $table;
 }else{
  echo $table;   
 }
 

   
 }

public function fetch_complete_timesheet($timesheet_id='',$roster_group_id='',$call_type=''){
     
   $timesheet_of_rosters = $this->employees_model->get_complete_employee_timesheet($timesheet_id,$roster_group_id);
   $timesheet_emoployee_id = $this->employees_model->get_all_employeeid_ofthis_timesheet($timesheet_id,$roster_group_id);
   $oneDimensionalArray = array_map('current', $timesheet_emoployee_id);
  
if(!empty($timesheet_of_rosters)){
     foreach($timesheet_of_rosters as $timesheet_of_roster){
    
    if(in_array($timesheet_of_roster->employee_id,$oneDimensionalArray)){
       
        
        $employee_weekly_timesheet_details[$timesheet_of_roster->employee_id][]  = array(
            
            'employee_id' => $timesheet_of_roster->employee_id,
            'timesheet_id' => $timesheet_of_roster->timesheet_id,
            'date'=> $timesheet_of_roster->date,
            'in_time' => $timesheet_of_roster->in_time,
            'out_time' => $timesheet_of_roster->out_time,
            'break_in_time' => $timesheet_of_roster->break_in_time,
            'break_out_time' => $timesheet_of_roster->break_out_time,
            'in_verify' => $timesheet_of_roster->in_verify,
            'out_verify' =>$timesheet_of_roster->out_verify,
            'comment' =>  $timesheet_of_roster->comment,

            );
    }
}
}

 
    $table = '';
    $week_days = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');

 $table .= '<div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">Employee Name</th> <th style="text-align: center;">MON</th>  <th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th><th style="text-align: center;">Status</th>
     </tr></thead>';
  if(!empty($employee_weekly_timesheet_details)){
       $table .= '<tbody>';
       
      
    
       foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet_detail){
         
        $emp_name= $this->admin_model->get_emp_details_fieldwise($employee_weekly_timesheet_detail[0]['employee_id'],'first_name');
        $table .= '<tr><td class="start_end emp_name"><b>'. $emp_name .'</b></td>';
        
        foreach($employee_weekly_timesheet_detail as $this_week_detail){
            $nameOfDay[] = date('D', strtotime($this_week_detail['date']));
        }
        
    
        $loop_count = 0;
      for ($i = 0; $i < 7; $i++) {
          
        $table .='<td class="start_end"><table><tr>';

      if (in_array($week_days[$i], $nameOfDay)){
         
    
      $table .='<td class="child">In</td> <td class="child">Out</td> <td class="child">Break In</td><td class="child">Break Out</td></tr><tr>';
      $table .='<td class="child start_height">'. $employee_weekly_timesheet_detail[$loop_count]['in_time'].'</td>';
      $table .='<td class="child start_height">'. $employee_weekly_timesheet_detail[$loop_count]['out_time'].'</td>';
      $table .='<td class="child start_height">'. $employee_weekly_timesheet_detail[$loop_count]['break_in_time'].'</td>';
      $table .='<td class="child start_height">'. $employee_weekly_timesheet_detail[$loop_count]['break_out_time'].'</td>';
       $loop_count++;
      }
      
       $table .='</tr></table></td>';
      }
      
    if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){
          $table .='<td><select onchange="update_timesheet_status('.$employee_weekly_timesheet_detail[0]['employee_id'].','.$employee_weekly_timesheet_detail[0]['timesheet_id'].',this)" name="timesheet_status"><option value="0" selected="selected">Pending</option><option value="1">Approve</option><option value="2">Reject</option></select></td>';
      }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 1){
        $table .='<td><select class="status_chnage" onchange="update_timesheet_status('.$employee_weekly_timesheet_detail[0]['employee_id'].','.$employee_weekly_timesheet_detail[0]['timesheet_id'].',this)" name="timesheet_status"><option value="0" >Pending</option><option value="1" selected="selected">Approve</option><option value="2">Reject</option></select></td>';
      }else{
          $table .='<td><select class="status_chnage" onchange="update_timesheet_status('.$employee_weekly_timesheet_detail[0]['employee_id'].','.$employee_weekly_timesheet_detail[0]['timesheet_id'].',this)" name="timesheet_status"><option value="0" >Pending</option><option value="1" >Approve</option><option value="2" selected="selected">Reject</option></select></td>';
      }
           
         $table .='</tr>'; 
         $nameOfDay = array();
         
       }
       $table .='</tbody>';  
       
  }
 $table .='</table>';
return $table;
   
 }
 
 public function edit_timesheet($timesheet_id,$roster_group_id='',$multiple=''){
     
     
     $user_email = $this->session->userdata('user_email');

	 
	 if(($this->session->userdata('role')) =='employee'){ 
	     $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
	      $timsheet_table = $this->fetch_timesheet($emp_id,$roster_group_id,'function_call');
	 }else{
	     
	     if($multiple !=""){
	       
	        $timsheet_table = $this->fetch_multiple_timesheet($timesheet_id,$roster_group_id,'function_call');  
	     }else{
	         $timsheet_table = $this->fetch_complete_timesheet($timesheet_id,$roster_group_id,'function_call');
	     }
	    
	    
	 }
    
     $data['timesheet_html']  = $timsheet_table;
     $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
     $this->load->view('Employeedetails/view_emp_timesheet',$data);
     $this->load->view('general/footer');
 }
 public function save_record(){
     
    $in_time =  $this->input->post('in_time');
    $type =  $this->input->post('type');
    $emp_id_outletname =  explode('_', $this->input->post('emp_id'));
    $roster_and_timesheet_id =  $this->input->post('roster_id');
    $roster_and_timesheet_id = explode('_', $roster_and_timesheet_id);


      $emp_id = $emp_id_outletname[0];
      if(isset($emp_id_outletname[1]) && !empty($emp_id_outletname[1])){
        $outletname = $emp_id_outletname[1];  
      }else{
          $outletname = '';
      }
      
      
      $roster_id = $roster_and_timesheet_id[0];
      $timesheet_id = $roster_and_timesheet_id[1];
     
      $this->session->set_userdata('roster_id', $roster_id);
    $date = date('Y-m-d');
    $data = array(
        'employee_id' =>$emp_id,
         $type =>$in_time,
         'date'=> $date,
         'roster_id' =>$roster_id,
         'timesheet_id' =>$timesheet_id,
         'outletname' =>$outletname
        );
        if($type=="out_time"){
          $this->admin_model->update_employee_timesheet($data,$timesheet_id,$emp_id);  
        }else{
            $this->admin_model->submit_employee_timesheet($data);
        }
    
 }
 public function verify_pin(){
     $emp_id =  $this->input->post('emp_id');   
     $emp_pin =  $this->input->post('emp_pin');
     $result= $this->EmployeesDeatils_model->verify_pin($emp_pin,$emp_id);
      echo $result;
      exit;
 }
 
  public function save_break_record(){
      
       $break_time =  $this->input->post('break_time');   
       $break_type =  $this->input->post('break_type');
     
      $roster_and_timesheet_id =  $this->input->post('roster_id');
      $roster_and_timesheet_id = explode('_', $roster_and_timesheet_id);
      
      

      $roster_id = $roster_and_timesheet_id[0];
      $timesheet_id = $roster_and_timesheet_id[1];
      $emp_id =  $this->input->post('emp_id');
       $date = date('Y-m-d');
        
        $insert_or_update = $this->admin_model->check_insert_or_update($emp_id,$timesheet_id,$date);
        
        
        $data = array(
         'employee_id' =>$emp_id,
         $break_type =>$break_time,
         'roster_id' =>$roster_id,
         'timesheet_id' =>$timesheet_id,
         'date'=> $date,
        );
        
        if($insert_or_update == "found"){
        $this->admin_model->update_employee_timesheet($data,$timesheet_id,$emp_id);
         }else{
        $this->admin_model->submit_employee_timesheet($data);     
         }
   
 }
 
 public function update_timesheet(){
     $timesheet_id =  $this->input->post('timesheet_id');
      $emp_id =  $this->input->post('emp_id');
      $status =  $this->input->post('status');
      
      $branch_result = $this->employees_model->get_emp_update($emp_id);
	   $to = $branch_result[0]->email;
	   $empname = $branch_result[0]->first_name;
      
        if($status=='approve'){
          $data = array(
          'in_verify' => $status,
        );  
        }else{
            $data = array(
          'in_verify' => $status,
        );
            
        }
     $this->admin_model->update_employee_timesheet($data,$timesheet_id,$emp_id);
     
    
		     $emp_details = array(
			     'send_to' =>$to,
			     'subject' =>  "An Update on the Timesheet",
			    
			     );
			 
$msg = 'This email is to inform you that manager has an update on your timesheet.
Please login to the HR portal to view the update. '; 

             $refer_to =  'Dear '.$empname.' ,';
		     $msg=$this->create_mail_template($msg,$refer_to);    
		     
		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
		    return true;
		      }else{
		       return true; 
		    }
		    
     return true;
 }
 

	
 	
}