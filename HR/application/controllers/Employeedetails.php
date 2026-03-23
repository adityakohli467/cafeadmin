<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require 'vendor/autoload.php';
// require 'web.config.php';
// require 'CloudABIS/CloudABISConnector.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use CloudABISSampleWebApp_CloudABIS\CloudABISConnector;

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;


class Employeedetails extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('notification');
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
			  
    }
    
    // Lazy-load email libraries only when needed (not on every page load)
    protected function _init_email(){
        if(isset($this->_email_initialized)) return;
        $this->_email_initialized = true;
        
        $config = array(
              'protocol' => 'smtp', 
              'smtp_host' => 'smtp.gmail.com', 
              'smtp_port' => 587, 
              'smtp_user' => 'cafehrmanagement@gmail.com', 
                'smtp_pass' => 'wdpoqmfuizogwfsj',
                'mailtype' => 'html'
              );
              $this->load->library('email', $config);
              $this->email->initialize($config);
              
	$this->phpmailermail = new PHPMailer();
        $this->phpmailermail->isSMTP();
        $this->phpmailermail->Mailer = "smtp";
        $this->phpmailermail->Host     = $this->config->item('Host');
        $this->phpmailermail->SMTPAuth = $this->config->item('SMTPAuth');
        $this->phpmailermail->SMTPSecure = $this->config->item('SMTPSecure');
        $this->phpmailermail->Username = $this->config->item('Username');
        $this->phpmailermail->Password = $this->config->item('Password');
        $this->phpmailermail->Port     = $this->config->item('Port');
        $this->phpmailermail->setFrom($this->config->item('setFrom'), 'Cafeadmin');
    }
    
    public function index(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('admin', 'menu')){
			redirect('general/index');
		}else {
    		redirect('admin/manage_employee');
		}
    }
    
   function view_emp_evaluation() {
	    
	 
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
         

			   $data['role'] = $this->session->userdata('role');
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('emp_evaluation_form');
				
				$records = $this->pagination_data_buildup('emp_evaluation_form',$total_records,'Employeedetails/view_emp_evaluation');
				// echo "<pre>";
				// print_r($records);
				// exit;
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_emp_evaluation',$data);
				$this->load->view('general/footer');
          	
		}
	}
    
  public function emp_evaluation_form($emp_evaluation_form_id=''){
         
         	$branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
		   $role = $this->session->userdata('role');
			
			if(isset($_POST['contact_submit'])){
		       if($role !='employee'){
		      $rev_period_from = strtotime($this->input->post('rev_period_from'));
		      $rev_period_from = date('Y-m-d',$rev_period_from);
		      
              $rev_period_to = strtotime($this->input->post('rev_period_to'));
              $rev_period_to = date('Y-m-d',$rev_period_to);

              if($this->input->post('manager_sign_date') !=''){
              $manager_sign_date = strtotime($this->input->post('manager_sign_date'));
              $manager_sign_date = date('Y-m-d',$manager_sign_date);
              }
           
              
              
            $options=array(
                  'qw_exceeds_expectations' => $this->input->post('qw_exceeds_expectations'),
                  'qw_meets_expectations' => $this->input->post('qw_meets_expectations'),
                  'qw_needs_improvement' => $this->input->post('qw_needs_improvement'),
                  'qw_unacceptable' => $this->input->post('qw_unacceptable'),
                  
                  'ap_exceeds_expectations' => $this->input->post('ap_exceeds_expectations'),
                  'ap_meets_expectations' => $this->input->post('ap_meets_expectations'),
                  'ap_needs_improvement' => $this->input->post('ap_needs_improvement'),
                  'ap_unacceptable' => $this->input->post('ap_unacceptable'),
                  
                  'rd_exceeds_expectations' => $this->input->post('rd_exceeds_expectations'),
                  'rd_meets_expectations' => $this->input->post('rd_meets_expectations'),
                  'rd_needs_improvement' => $this->input->post('rd_needs_improvement'),
                  'rd_unacceptable' => $this->input->post('rd_unacceptable'),
                  
                  'cs_exceeds_expectations' => $this->input->post('cs_exceeds_expectations'),
                  'cs_meets_expectations' => $this->input->post('cs_meets_expectations'),
                  'cs_needs_improvement' => $this->input->post('cs_needs_improvement'),
                  'cs_unacceptable' => $this->input->post('cs_unacceptable'),
                  
                  'jdm_exceeds_expectations' => $this->input->post('jdm_exceeds_expectations'),
                  'jdm_meets_expectations' => $this->input->post('jdm_meets_expectations'),
                  'jdm_needs_improvement' => $this->input->post('jdm_needs_improvement'),
                  'jdm_unacceptable' => $this->input->post('jdm_unacceptable'),
                  
                  'if_exceeds_expectations' => $this->input->post('if_exceeds_expectations'),
                  'if_meets_expectations' => $this->input->post('if_meets_expectations'),
                  'if_needs_improvement' => $this->input->post('if_needs_improvement'),
                  'if_unacceptable' => $this->input->post('if_unacceptable'),
                  
                  'ct_exceeds_expectations' => $this->input->post('ct_exceeds_expectations'),
                  'ct_meets_expectations' => $this->input->post('ct_meets_expectations'),
                  'ct_needs_improvement' => $this->input->post('ct_needs_improvement'),
                  'ct_unacceptable' => $this->input->post('ct_unacceptable'),
                  
                  'kp_exceeds_expectations' => $this->input->post('kp_exceeds_expectations'),
                  'kp_meets_expectations' => $this->input->post('kp_meets_expectations'),
                  'kp_needs_improvement' => $this->input->post('kp_needs_improvement'),
                  'kp_unacceptable' => $this->input->post('kp_unacceptable'),
                  
                  'td_exceeds_expectations' => $this->input->post('td_exceeds_expectations'),
                  'td_meets_expectations' => $this->input->post('td_meets_expectations'),
                  'td_needs_improvement' => $this->input->post('td_needs_improvement'),
                  'td_unacceptable' => $this->input->post('td_unacceptable'),
                  
                  'ol_rating_opt1' => $this->input->post('ol_rating_opt1'),
			      'ol_rating_opt2' => $this->input->post('ol_rating_opt2'),
			      'ol_rating_opt3' => $this->input->post('ol_rating_opt3'),
			      'ol_rating_opt4' => $this->input->post('ol_rating_opt4'),
                );
            $options = serialize($options);
            $emp_name = $this->admin_model->get_emp_details_fieldwise($this->input->post('emp_id'),'first_name');
		   $data=array(
		    'branch_id' => $branch_id, 
			'emp_id' => $this->input->post('emp_id'),
			'emp_name' => $emp_name,
			'job_title' => $this->input->post('job_title'),
			'manager' => $this->input->post('manager'),
			'rev_period_from' => $rev_period_from,
			'rev_period_to' => $rev_period_to,
			'options_rating'    =>  $options,
			
			'qw_comments' => $this->input->post('qw_comments'),
			'ap_comments' => $this->input->post('ap_comments'),
			'rd_comments' => $this->input->post('rd_comments'),
			'cs_comments' => $this->input->post('cs_comments'),
			'jdm_comments' => $this->input->post('jdm_comments'),
			'if_comments' => $this->input->post('if_comments'),
			'ct_comments' => $this->input->post('ct_comments'),
			'kp_comments' => $this->input->post('kp_comments'),
			'td_comments' => $this->input->post('td_comments'),
			'performance_comments' => $this->input->post('performance_comments'),
			'ol_rating_comments' => $this->input->post('ol_rating_comments'),
			'manager_sign' => $this->input->post('manager_sign'),
			'manager_sign_date' => $manager_sign_date,

			);
			
			}else{
			    // in case of employee updating the form 
			   $emp_sign_date = strtotime($this->input->post('emp_sign_date'));
              $emp_sign_date = date('Y-m-d',$emp_sign_date); 
             
              $data=array(
            'acknowledgement' => $this->input->post('acknowledgement'),
            'emp_comments' => $this->input->post('emp_comments'),
			'emp_sign' => $this->input->post('emp_sign'),
			'emp_sign_date' => $emp_sign_date,
			);
			}

		  if($emp_evaluation_form_id !=''){
		     
		      $update_id = $this->EmployeesDeatils_model->update_table('emp_evaluation_form',$emp_evaluation_form_id,$data);
		  }
		  else{ 
		       $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('emp_evaluation_form',$data);
		 }
		
         redirect('Employeedetails/success/');
			}else{
			    
			 $branch_id = $this->session->userdata('branch_id');
			if($branch_id ==''){
		     $type='employee';
		   }else{
		     $type = 'admin';  
		   }
			$employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
			
			$data['employees'] = $employees;
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$hdata['role'] = $this->session->userdata('role');
		 
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/emp_evaluation_form',$data);
			$this->load->view('general/footer');
			}
     }
     public function edit_emp_evaluation_form($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		     
		        
		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		    if($branch_id ==''){
		     $type='employee';
		   }else{
		     $type = 'admin';  
		   }
		    $employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
			$data['employees'] = $employees;   
		    $result = $this->EmployeesDeatils_model->get_record_from_table('emp_evaluation_form',$id);  
		    $or = unserialize($result[0]->options_rating);
		  //  echo "<pre>";
		  //  print_r($result);
		  //  exit;
		    $data['options_rating'] =   $or;    
		    $data['details'] =   $result;
		    $data['role'] = $this->session->userdata('role');  

		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/emp_evaluation_form',$data);	
			
			$this->load->view('general/footer');
		    }
		    
			
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
			
				if(!empty($menus)){
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
    }
    
    public function file_upload_code($name_value=''){
        
        if(isset($name_value) && $name_value !=''){
                
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx';
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
            $config['base_url'] = base_url('index.php/').$link;
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
		 
		 $emp_id = '';
		 if(isset($table_name) && ($table_name=='memo' || $table_name=='document')){
		  
		    if($branch_id ==''){
		        	$user_email = $this->session->userdata('user_email');
	                $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
	                $branch_id = $this->admin_model->get_emp_details_fieldwise($emp_id,'branch_id');
	                
	               
		            $type='memo';  
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
		 
		 $params = array(
		     'table_name' => $table_name,
		     'branch_id' => $branch_id,
		     'limit' => $config["per_page"],
		     'start' => $this->uri->segment(3),
		     'type' => $type,
		     'role_id' => $role_id,
		     'emp_id' => $emp_id
		     );
		    
            $result_data  = $this->EmployeesDeatils_model->fetch_data($params);
            
           
            
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
         <p>HR Team.</p>
         </body> 
         </html>';
         
         return $html;
        
    }
    
    public function get_content_and_send_mail($emp_detail,$msg,$from_email=''){
        $this->_init_email();
        if($from_email==''){
            $from_email = 'admin@cafeadmin.com.au';
        }
                
			  
		       $email = $emp_detail['send_to'];
		      // $email = 'mqaddarkasikandar@gmail.com';
		            $subject = $emp_detail['subject'];
	                $this->email->set_newline("\r\n");
					$this->email->from($from_email, 'HRM'); 
					$this->email->to($email);
					$this->email->reply_to($from_email);
					$this->email->subject($subject);
					$this->email->message($msg);
			
					//Phpmailer ============================================================
					 $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $msg;
                     $this->phpmailermail->send();
					
			  return true;
    }
    public function add_covid(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
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
		    
		    // send email to manager if emp has covid symptoms
		    
		    if($this->input->post('temperature') == 1 || $this->input->post('Chills') == 1 || $this->input->post('Cough') == 1 || $this->input->post('sore_throat') == 1 ||$this->input->post('breath') == 1 ||$this->input->post('smell') == 1 ||$this->input->post('running_nose') == 1 ){
		        
		 
		    $to =  $this->getbranch_manager_email($branch_result[0]->branch_id);
		   
			
		     $emp_details = array(
			     'send_to' => $to,
			     'subject' =>  "Employee Covid Form Submission",
			     );
			 
             $msg = $empname.' has selected option Yes to one of the symptoms for Covid 19.</br>Kind Regards,</br> HR Team.';    
		     $msg=$this->create_mail_template($msg,'Dear Manager'); 
		     
		     $this->get_content_and_send_mail($emp_details,$msg);
		     
		    }
		
		
		     
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
	
	private function getbranch_manager_email($branchID){
	     $email = $this->admin_model->getbranch_manager_email($branchID);
	    
	     return $email[0]->manager_email;
	    
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
			redirect('auth/homepage');
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
		     
		      add_notification('feedback','manager',$emp_id);
		      
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
			redirect('auth/homepage');
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
		     
		      add_notification('self_assesment','manager',$emp_id);
		      
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
			redirect('auth/homepage');
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

 add_notification('reimbursement','manager',$emp_id);
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
	public function delete_timesheet(){
	    $status = array( 'status' => 0 );
	    $this->EmployeesDeatils_model->update_table('timesheet',$this->input->post('id'),$status);
	    $this->EmployeesDeatils_model->update_employee_timesheet($this->input->post('id'),$status);
	    echo "sucess"; exit;
	}
	
	public function delete_applicants_details(){
	    $this->EmployeesDeatils_model->delete_row('applicants_details','applicants_details_id',$this->input->post('id'));
	    echo "sucess"; exit;
	}
		public function delete_row(){
	    $this->EmployeesDeatils_model->delete_row('applicants_details','applicants_details_id',$this->input->post('id'));
	    echo "sucess"; exit;
	}
	
	public function update_applicants_details(){
	    $status = array( 'status' => 0 );
	    $this->EmployeesDeatils_model->update_table('applicants_details',$this->input->post('id'),$status);
	   $applicantdata =  $this->EmployeesDeatils_model->fetch_column('applicants_details','first_name',$this->input->post('id'));
	  
	    $msg='Thank you for applying for the job opportunity advertised at our company portal.<p> We have assessed the application of many prospectus applicants including yours. At this time your application is not successful. 
          </p><p>We wish you success in your future endeavours. Please feel free to apply for open positions with us in the future.</p>';
$emp_detail['subject'] = 'Update on your job application';
$emp_detail['send_to'] = $this->input->post('applicant_mail');
        $msg=$this->create_mail_template($msg,'Dear '.$applicantdata[0]['first_name'].','); 
	    $this->get_content_and_send_mail($emp_detail,$msg,'apply@cafeadmin.com.au');
	    echo "sucess"; exit;
	}
	
	
	public function update_ia_status(){
	    
	    $status = array( $this->input->post('status_type') => $this->input->post('status') );
	    $this->EmployeesDeatils_model->update_table('interview_assesment',$this->input->post('ia_id'),$status);
	    echo "sucess"; exit;
	}
	public function delete_ia(){
	    
	    $this->EmployeesDeatils_model->delete_row('interview_assesment','interview_assesment_id',$this->input->post('ia_id'));
	    echo "sucess"; exit;
	}
	public function interview_assesment(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $first_interviewer_signDate = $this->input->post('first_interviewer_signDate');
              $second_interviewer_signDate = $this->input->post('second_interviewer_signDate');
              $date_added = date('y-m-d');
              $branchId = $this->session->userdata('branch_id');
              
            
              $description =array(
			'rank' => $this->input->post('rank'),
			'sm_fi' => $this->input->post('sm_fi'),
			'sm_edu' => $this->input->post('sm_edu'),
			'sm_exp' => $this->input->post('sm_exp'),
			'sm_ta' => $this->input->post('sm_ta'),
			'sm_pers' => $this->input->post('sm_pers'),
			'sm_or' => $this->input->post('sm_or'),
			
			'hr_fi' => $this->input->post('hr_fi'),
			'hr_edu' => $this->input->post('hr_edu'),
			'hr_exp' => $this->input->post('hr_exp'),
			'hr_ta' => $this->input->post('hr_ta'),
			'hr_pers' => $this->input->post('hr_pers'),
			'hr_or' => $this->input->post('hr_or'),
			
			'education' => $this->input->post('education'),
			'decision' => $this->input->post('decision'),
			'cust_service' => $this->input->post('cust_service'),
			'team_work' => $this->input->post('team_work'),
			'flexibility' => $this->input->post('flexibility'),
			'communication' => $this->input->post('communication'),
			'computer_skills' => $this->input->post('computer_skills'),
			'result' => $this->input->post('result'),
			'int_two_result' => $this->input->post('int_two_result'),
			
			);
			 
		   $data=array(
		    'branch_id' => $branchId, 
			'applicant_name' => $this->input->post('applicant_name'),
			'job_applied_for' => $this->input->post('job_applied_for'),
			'worksite' => $this->input->post('worksite'),
			'rank' => $this->input->post('rank'),
			'sitemanager_comments' => $this->input->post('sitemanager_comments'),
			'sitemanager_sign' => $this->input->post('sitemanager_sign'),
			'expected_salary' => $this->input->post('expected_salary'),
			'Notice_Period' => $this->input->post('Notice_Period'),
		
			'first_interviewer_comment' => $this->input->post('first_interviewer_comment'),
			'first_interviewer_name' => $this->input->post('first_interviewer_name'),
			'first_interviewer_title' => $this->input->post('first_interviewer_title'),
			'first_interviewer_sign' => $this->input->post('first_interviewer_sign'),
			'first_interviewer_signDate' => $first_interviewer_signDate,
			
			'second_interviewer_comment' => $this->input->post('second_interviewer_comment'),
			'second_interviewer_name' => $this->input->post('second_interviewer_name'),
			'second_interviewer_title' => $this->input->post('second_interviewer_title'),
			'second_interviewer_sign' => $this->input->post('second_interviewer_sign'),
			'second_interviewer_signDate' => $second_interviewer_signDate,
			'description' => serialize($description),
		
			'date_added' => $date_added,

			);
		
		    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('interview_assesment',$data); 
		     redirect('Employeedetails/view_interview_assesment');
// 		    $branch_result = $this->employees_model->get_emp_update($emp_id);
// 		     $emp_details = array(
// 			     'send_to' =>  $emp_email,
// 			     'subject' =>  "New Incident Reported",
// 			     );
			 
//   $msg = 'Manager has reported a new incident. Please login to the HR portal to view and add comments to the report submitted.
// '.$empname.' will be notified via an email if any comments are added to the report.';    

//  add_notification('Incident_Report','employee',$emp_id);
 
// 		     $msg=$this->create_mail_template($msg,$empname);     
		     
// 		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
// 		    redirect('Employeedetails/success');
// 		      }
		    }else{
		      $branch_id = $this->session->userdata('branch_id');
		   
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$hdata['role'] = $this->session->userdata('role');
		 
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/interview_assesment');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
    public function Incident_Report() {
    if (!$this->ion_auth->logged_in()) {
        redirect('auth/homepage');
    }

    // ---------------------------
    // FORM SUBMISSION
    // ---------------------------
    if (isset($_POST['contact_submit'])) {

        $incident_date = $this->input->post('incident_date');
        $dob = $this->input->post('dob');
        $supervisor_sign_date = $this->input->post('supervisor_sign_date');
        $report_complete_signtaure_date = $this->input->post('report_complete_signtaure_date');
        $date_added = date('Y-m-d');

        $user_email = $this->session->userdata('user_email');

        // -------------------------------------------
        // emp_id MAY NOT BE SENT – handle it safely
        // -------------------------------------------
        $emp_id = $this->input->post('emp_id');

        $branchId = $this->session->userdata('branch_id');;
        $type = ($branchId == '') ? 'employee' : 'admin';
        $empname = null;
        $emp_email = null;

        if (!empty($emp_id)) {
            $branch_result = $this->employees_model->get_emp_update($emp_id);

            if (!empty($branch_result)) {
                foreach ($branch_result as $row) {
                    $branchId = $row->branch_id;
                    $empname = $row->first_name;
                    $emp_email = $row->email;
                }
            }
        }

        // -------------------------------------------
        // Build Insert Array (branch_id must not break)
        // -------------------------------------------
        $data = array(
            'branch_id'                     => $branchId ?? 0,  // default 0 or null
            'incident_effected_to'          => $this->input->post('incident_effected_to'),
            'surname'                       => $this->input->post('surname'),
            'firstname'                     => $this->input->post('firstname'),
            'initial'                       => $this->input->post('initial'),
            'address'                       => $this->input->post('address'),
            'postcode'                      => $this->input->post('postcode'),
            'dob'                           => $dob,
            'gender'                        => $this->input->post('gender'),
            'incident_by'                   => $this->input->post('incident_by'),
            'emp_id'                        => $emp_id ?? null,
            'incident_date'                 => $incident_date,
            'incident_time'                 => $this->input->post('incident_time'),
            'incident_place'                => $this->input->post('incident_place'),
            'incident_detail'               => $this->input->post('incident_detail'),
            'is_witness'                    => $this->input->post('is_witness'),

            'witness_name'                  => $this->input->post('witness_name'),
            'witness_position'              => $this->input->post('witness_position'),
            'witness_contact'               => $this->input->post('witness_contact'),
            'witness_Address'               => $this->input->post('witness_Address'),
            'witness_postcode'              => $this->input->post('witness_postcode'),

            'person_completing_report_name' => $this->input->post('person_completing_report_name'),
            'person_reporting_incident_sign'=> $this->input->post('person_reporting_incident_sign'),
            'report_complete_signtaure_date'=> $report_complete_signtaure_date,
            'is_acknowdledeged'             => $this->input->post('is_acknowdledeged'),
            'action_to_take'                => $this->input->post('action_to_take'),
            'date_added'                    => $date_added,
        );

        // -------------------------------------------
        // Insert into DB
        // -------------------------------------------
        $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('Incident_Report', $data);

        // -------------------------------------------
        // Send notification ONLY IF emp_id exists
        // -------------------------------------------
        
        
        
        if (!empty($emp_id) && !empty($emp_email) && $type =='employee') {

            add_notification('Incident_Report', 'employee', $emp_id);

            $emp_details = array(
                'send_to' => $emp_email,
                'subject' => "New Incident Reported",
            );

            $msg = 'Manager has reported a new incident. 
            Please login to the HR portal to view and add comments.

            ' . ($empname ?? 'Employee') . ' will be notified if comments are added.';

            $msg = $this->create_mail_template($msg, $empname);

            $this->get_content_and_send_mail($emp_details, $msg);
        }

        redirect('Employeedetails/success');
    }

    // ---------------------------
    // LOAD FORM VIEW
    // ---------------------------
    $branch_id = $this->session->userdata('branch_id');

    $type = ($branch_id == '') ? 'employee' : 'admin';

    $employees = $this->admin_model->get_employees_branchwise($branch_id, $type);
    $data['employees'] = $employees;

    $menu_items = $this->display_menu();
    $hdata['menus'] = $menu_items;
    $hdata['role']  = $this->session->userdata('role');

    $user_email = $this->session->userdata('user_email');
    $data['loggedn_emp_id'] = $this->admin_model->get_emp_details_fromemail($user_email);

    $this->load->view('general/header_general', $hdata);
    $this->load->view('Employeedetails/Incident_Report', $data);
    $this->load->view('general/footer');
}

	
	public function Injury_Report(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
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
			
		  //   $emp_details = array(
			 //    'send_to' =>$to,
			 //    'subject' =>  "New Injury Reported",
			    
			 //    );
			
            $email1 = 'hr@zoukiaccounts.com.au';
            $email2 = 'wang@zoukiaccounts.com.au';
			$email3 = 'kaushika@1800mycatering.com.au';
			
// 			$email2 = 'adityakohli467@gmail.com';
// 			$email3 = 'mqaddarkasikandar@gmail.com';
// $msg = $empname.' has reported a new injury. Please login to the HR portal to view and add comments to the report submitted.
// '.$empname.' will be notified via an email if any comments are added to the report.'; 

$branches = $this->admin_model->fetch_branches($branchId);
    
    $location = $branches[0]->branch_name;
$msg = 'Employee ('.$empname.') from location '.$location.' has submitted the injury report.';    
		     $msg=$this->create_mail_template($msg,'Hi Manager');     
		     
		      add_notification('Injury_Report','manager',$emp_id);
	
               $from_email = 'admin@cafeadmin.com.au';
               $this->_init_email();
                
		       $subject = 'New Injury Reported';
               $this->email->set_newline("\r\n");
				$this->email->from($from_email, 'HRM'); 
				$this->email->to($to);
				$this->email->reply_to($from_email);
				$this->email->subject($subject);
				$this->email->message($msg);
		
				//Phpmailer ============================================================
				 $this->phpmailermail->ClearAddresses();
				 $this->phpmailermail->isHTML(true);
				 $this->phpmailermail->addAddress($to);
				 $this->phpmailermail->addAddress($email1);
    			 $this->phpmailermail->addAddress($email2);
    		     $this->phpmailermail->addCC($email3);
                 $this->phpmailermail->Subject = $subject;
                 $this->phpmailermail->Body = $msg;
                 
		   if($this->phpmailermail->send()){ 
		       
		      //  if($this->get_content_and_send_mail($emp_details,$msg)){ 
		            
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
			redirect('auth/homepage');
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
		     
		        add_notification('Resignation_Letter','manager',$emp_id);
		        
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
			redirect('auth/homepage');
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
		    add_notification('Probationary_Period','manager',$emp_id);
		    
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
			redirect('auth/homepage');
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
		    
		     add_notification('Jobkeeper_Nomination_Notice','manager',$emp_id);
		     
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
			redirect('auth/homepage');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		    
		    if(isset($_POST['contact_submit'])){ 
		 
		    
		    
		    if($this->input->post('emp_email') !=''){
		         $result_explode = explode('|', $this->input->post('emp_email'));
                 $emp_email=$result_explode[0];
                 $emp_id=$result_explode[1];
                
		       $this->send_email_to_all_employee($branch_id,$emp_id,'Memo',$this->input->post('emp_email'));
		    }else{
		    if($this->input->post('role') == 14){
		        // for sending mail to all employee
		        $this->send_email_to_all_employee($branch_id,'','Memo');
		    }else{
		        // for sending mail to slected role id employee
		        $this->send_email_to_all_employee($branch_id,$this->input->post('role'),'Memo');
		    }
		    $emp_id = '';
		    }
		    
		     $data=array(
		    'branch_id' => $branch_id,
		    'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'role' => $this->input->post('role'),
			'emp_id' => $emp_id
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
		    $type='admin';
		    $employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
		    $data['employees'] = $employees;
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
			redirect('auth/homepage');
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
		    
		    if($this->input->post('role') == 14){
		        // for sending mail to all employee
		        $this->send_email_to_all_employee($branch_id,'','Document');
		    }else{
		        // for sending mail to slected role id employee
		        $this->send_email_to_all_employee($branch_id,$this->input->post('role'),'Document');
		    }
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
			redirect('auth/homepage');
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
		    
		  //  $all_future_roster = $this->admin_model->get_employees_roster($branch_id,'future');
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
    
    public function create_timesheet($viewAllRosterForAdmin=''){
        
        	if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
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
		    
		    //ftech all emp_id and roster_id and timesheet_id and insert in timsheet table and later update table when employee clockin and clockout
		       
		       foreach($this->input->post('roster_list') as $roster_group_ids){
		        
		        $this->find_roster_details($roster_group_ids,$insert_id);
		       
		       }

            $target_message ='The new timesheet is created.';
            
		   redirect('Employeedetails/success/'.$target_message);
		    }else{
		        
		    if($viewAllRosterForAdmin == ''){
		     $allroster = $this->admin_model->get_employees_roster($branch_id,'future');
		     $data['viewAllroster']  = false;
		    }else{
		      $allroster = $this->admin_model->get_employees_roster($branch_id); 
		       $data['viewAllroster']  = true;
		    }
		    
		 
		   
          
		    
		     $data['rosters'] =   $allroster;  
		     $data['role'] =   $this->session->userdata('role');
		     $data['branch_id'] =   $branch_id;
		  
		  
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('Employeedetails/create_timesheet',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
        
    }
    
    public function find_roster_details($roster_group_ids,$insert_id){
        
         $roster_details = $this->admin_model->get_emp_roster('',$roster_group_ids);
         //insert data in employee timesheet table in advance and later update
     
         foreach($roster_details as $roster_detail){
           $date = $roster_detail->start_date;
           
           // insert all 7 days roster detail in timesheet, so that from timesheet portal when user will clock in  in just update correposnding date field 
           for($i=0;$i<7;$i++){
              $all_seven_days_of_roster = date("Y-m-d", strtotime($date . ' + ' . $i . 'day')) . "<br>"; 
            $data = array(
          'employee_id' =>$roster_detail->emp_id,
          'roster_group_id' =>$roster_group_ids,
          'timesheet_id' =>$insert_id,
          'roster_id' => $roster_detail->roster_id,
          'date'   => $all_seven_days_of_roster
            );
         $this->admin_model->submit_employee_timesheet($data);
           }
               
         }
         
    
        
    }
    
    public function timesheet_in_out(){
        
        	if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
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
		    $all_timesheet = $this->admin_model->get_all_timesheet($branch_id,'future');
            
		   $todays_date = date('Y-m-d', time());
		   $data['timesheet_id'] = '';
		   $data['all_emps'] = '';
		   
		   // Auto-detect current week's timesheet or use the only available one
		   $auto_timesheet = null;
		   if(!empty($all_timesheet)){
		       if(count($all_timesheet) == 1){
		           $auto_timesheet = $all_timesheet[0];
		       } else {
		           $today_str = date("d-m-Y");
		           foreach($all_timesheet as $ts){
		               $ts_start = date("d-m-Y", strtotime($ts->start_date));
		               $ts_end = date("d-m-Y", strtotime($ts->end_date));
		               if(strtotime($today_str) >= strtotime($ts_start) && strtotime($today_str) <= strtotime($ts_end)){
		                   $auto_timesheet = $ts;
		                   break;
		               }
		           }
		       }
		   }
		   
		   if($auto_timesheet != null){
		       $roster_group_id = $auto_timesheet->roster_group_id;
		       $timesheet_id = $auto_timesheet->timesheet_id;
		       $timesheet_type = isset($auto_timesheet->timesheet_type) ? $auto_timesheet->timesheet_type : 's';
		       $data['timesheet_id'] = $timesheet_id;
		       $data['timesheet_type'] = $timesheet_type;
		       
		       // Fetch employees based on single or multiple roster (filtered by branch_id to prevent cross-branch data leakage)
		       if($timesheet_type == "m"){
		           $seralized = $this->employees_model->get_timesheetfor_multiple_roster($timesheet_id);
		           $all_roster_ids = unserialize($seralized[0]->multiple_roster_group_id);
		           $all_emps = $this->admin_model->fetch_employee_for_timsheet_bulk($all_roster_ids, $branch_id);
		       } else {
		           $all_emps = $this->admin_model->fetch_employee_for_timsheet($roster_group_id, $branch_id);
		       }
		       
		       if(!empty($all_emps)){
		           // Get today's day column name for shift check
		           $dayname = strtolower(date("D"));
		           if($dayname == "tue"){ $dayname = "tues_start_time"; }
		           elseif($dayname == "thu"){ $dayname = "thus_start_time"; }
		           else { $dayname = $dayname."_start_time"; }
		           
		           // Bulk fetch: all timesheet records and all shifts in 2 queries instead of N+1
		           $emp_ids = array();
		           $roster_ids = array();
		           foreach($all_emps as $emp){
		               $emp_ids[] = $emp->emp_id;
		               $roster_ids[] = $emp->roster_id;
		           }
		           $roster_ids = array_unique($roster_ids);
		           
		           $timesheet_rows = $this->admin_model->get_timesheet_bulk($emp_ids, $timesheet_id, $todays_date);
		           $shift_rows = $this->admin_model->get_shifts_bulk($roster_ids, $dayname);
		           
		           // Index timesheet data by emp_id+roster_id for fast lookup
		           $ts_map = array();
		           foreach($timesheet_rows as $row){
		               $ts_map[$row->employee_id.'_'.$row->roster_id] = $row;
		           }
		           
		           // Index shift data by roster_id
		           $shift_map = array();
		           foreach($shift_rows as $row){
		               $shift_map[$row->roster_id] = $row->$dayname;
		           }
		           
		           // Assign data to each employee (no DB queries in this loop)
		           foreach($all_emps as $all_emp){
		               $key = $all_emp->emp_id.'_'.$all_emp->roster_id;
		               if(isset($shift_map[$all_emp->roster_id]) && $shift_map[$all_emp->roster_id] == 'null'){
		                   $all_emp->status = "Disable";
		               } else {
		                   $all_emp->status = "Enable";
		               }
		               if(isset($ts_map[$key])){
		                   $all_emp->in_time = $ts_map[$key]->in_time;
		                   $all_emp->out_time = $ts_map[$key]->out_time;
		                   $all_emp->break_in_time = $ts_map[$key]->break_in_time;
		                   $all_emp->break_out_time = $ts_map[$key]->break_out_time;
		               }
		           }
		       }
		       
		       $data['all_emps'] = $all_emps;
		       $this->session->set_userdata('roster_id', $roster_group_id);
		   }
		   
		$data['all_timesheets'] =   $all_timesheet;
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
	
	function view_interview_assesment() {
	    
	 
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
         

			   $data['role'] = $this->session->userdata('role');
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('interview_assesment');
				
				$records = $this->pagination_data_buildup('interview_assesment',$total_records,'Employeedetails/view_interview_assesment');
				
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_interview_assesment',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_Incident_Report() {
	    
	 
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
            redirect('auth/homepage');
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
		      //  echo $roleId; exit;
				$records = $this->pagination_data_buildup('memo',$total_records,'Employeedetails/view_memo',$roleId);
                
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				foreach($data['record_data'] as $key => $recorddataat){
				  
				    $empname = $this->admin_model->get_emp_details_fieldwise($recorddataat->emp_id,'first_name');
				    $data['record_data'][$key]->emp_name = $empname;
 				    	
				}
				 
			
				
				$data['role'] = $this->session->userdata('role');
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_memo',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
	function view_document() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
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
// 	public function delete_timesheet(){
// 	    $data = array('status' => 0);
// 	    $this->EmployeesDeatils_model->update_table('timesheet',$this->input->post('id'),$data);
// 	    echo "sucess"; exit;
// 	}
	
	function view_timesheet() {
	    
	  
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/homepage');
        }else {
			
		 
			   $menu_items  = $this->display_menu();
				
		     	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->EmployeesDeatils_model->get_total('timesheet');
				
				$records = $this->pagination_data_buildup('timesheet',$total_records,'Employeedetails/view_timesheet');
				// echo "<pre>";
				// print_r($total_records);
				// exit;
        
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['role'] = $this->session->userdata('role');
				$branch_id = $this->session->userdata('branch_id');
				$data['branch_id'] = $branch_id;
				
				// get ex-employees
				$exEmployees = $this->admin_model->get_disbaled_employees($branch_id);
			
                $data['exEmployees'] = $exEmployees;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_timesheet',$data);
				$this->load->view('general/footer');
          	
		}
	}
	
  
	public function edit_emp_satisfaction_survey($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
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
			redirect('auth/homepage');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		       $reporting_date = $this->input->post('reporting_date');
              
		        
		    
			  
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
			redirect('auth/homepage');
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
			redirect('auth/homepage');
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
		    
			'receipt'=>$new_name,
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
	
	public function edit_interview_assesment($interview_assesment_id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $first_interviewer_signDate = $this->input->post('first_interviewer_signDate');
              $second_interviewer_signDate = $this->input->post('second_interviewer_signDate');
              $date_added = date('y-m-d');
              $branchId = $this->session->userdata('branch_id');
              
            
              $description =array(
			'rank' => $this->input->post('rank'),
			'sm_fi' => $this->input->post('sm_fi'),
			'sm_edu' => $this->input->post('sm_edu'),
			'sm_exp' => $this->input->post('sm_exp'),
			'sm_ta' => $this->input->post('sm_ta'),
			'sm_pers' => $this->input->post('sm_pers'),
			'sm_or' => $this->input->post('sm_or'),
			
			'hr_fi' => $this->input->post('hr_fi'),
			'hr_edu' => $this->input->post('hr_edu'),
			'hr_exp' => $this->input->post('hr_exp'),
			'hr_ta' => $this->input->post('hr_ta'),
			'hr_pers' => $this->input->post('hr_pers'),
			'hr_or' => $this->input->post('hr_or'),
			
			'education' => $this->input->post('education'),
			'decision' => $this->input->post('decision'),
			'cust_service' => $this->input->post('cust_service'),
			'team_work' => $this->input->post('team_work'),
			'flexibility' => $this->input->post('flexibility'),
			'communication' => $this->input->post('communication'),
			'computer_skills' => $this->input->post('computer_skills'),
			'result' => $this->input->post('result'),
			'int_two_result' => $this->input->post('int_two_result'),
			
			);
			 
		   $data=array(
		    'branch_id' => $branchId, 
			'applicant_name' => $this->input->post('applicant_name'),
			'job_applied_for' => $this->input->post('job_applied_for'),
			'worksite' => $this->input->post('worksite'),
			'rank' => $this->input->post('rank'),
			'sitemanager_comments' => $this->input->post('sitemanager_comments'),
			'sitemanager_sign' => $this->input->post('sitemanager_sign'),
			'expected_salary' => $this->input->post('expected_salary'),
			'Notice_Period' => $this->input->post('Notice_Period'),
		
			'first_interviewer_comment' => $this->input->post('first_interviewer_comment'),
			'first_interviewer_name' => $this->input->post('first_interviewer_name'),
			'first_interviewer_title' => $this->input->post('first_interviewer_title'),
			'first_interviewer_sign' => $this->input->post('first_interviewer_sign'),
			'first_interviewer_signDate' => $first_interviewer_signDate,
			
			'second_interviewer_comment' => $this->input->post('second_interviewer_comment'),
			'second_interviewer_name' => $this->input->post('second_interviewer_name'),
			'second_interviewer_title' => $this->input->post('second_interviewer_title'),
			'second_interviewer_sign' => $this->input->post('second_interviewer_sign'),
			'second_interviewer_signDate' => $second_interviewer_signDate,
			'description' => serialize($description),
		
			'date_added' => $date_added,

			);
		if($interview_assesment_id !=''){
		  $update_id = $this->EmployeesDeatils_model->update_table('interview_assesment',$interview_assesment_id,$data);
		}else{
	    $insert_id = $this->EmployeesDeatils_model->add_data_to_tble('interview_assesment',$data); 	    
		}
		 redirect('Employeedetails/view_interview_assesment');

		    }else{
		    $branch_id = $this->session->userdata('branch_id');
		    $result = $this->EmployeesDeatils_model->get_record_from_table('interview_assesment',$interview_assesment_id);   
		    $description =  unserialize($result[0]->description);
		  
		    $data['details'] =   $result;
		    $data['action'] =   $action;
		     $data['radion_btn_values'] =   $description;
		     $data['role'] = $this->session->userdata('role');  
	
		    
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
				if($action =="view"){
			$this->load->view('Employeedetails/interview_assesment',$data);
				}else{
			$this->load->view('Employeedetails/interview_assesment',$data);   
				}
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
	
	
	
	public function edit_Incident_Report($id='',$action=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		      $incident_date = $this->input->post('incident_date');
              $dob = $this->input->post('dob');
              $supervisor_sign_date = $this->input->post('supervisor_sign_date');
              $report_complete_signtaure_date = $this->input->post('report_complete_signtaure_date');
               
               
		        $user_email = $this->session->userdata('user_email');
			    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    	$branch_result = $this->employees_model->get_emp_update($emp_id);
			
			foreach($branch_result as $row){
				$branchId = $row->branch_id;
				$empname = $row->first_name;
			}
			
			  
		   $data=array(
		   
			'incident_effected_to' => $this->input->post('incident_effected_to'),
			'surname' => $this->input->post('surname'),
			'firstname' => $this->input->post('firstname'),
			'initial' => $this->input->post('initial'),
			'address' => $this->input->post('address'),
			'postcode' => $this->input->post('postcode'),
			'dob' => $dob,
			'gender' => $this->input->post('gender'),
			'incident_by' => $this->input->post('incident_by'),
			
			'incident_date' => $incident_date,
			'incident_time' => $this->input->post('incident_time'),
			'incident_place' => $this->input->post('incident_place'),
			'incident_detail' => $this->input->post('incident_detail'),
			'is_witness' => $this->input->post('is_witness'),
			
			
			'witness_name' => $this->input->post('witness_name'),
			'witness_position' => $this->input->post('witness_position'),
			'witness_contact' => $this->input->post('witness_contact'),
			'witness_Address' => $this->input->post('witness_Address'),
			'witness_postcode' => $this->input->post('witness_postcode'),
			
			
			'person_completing_report_name' => $this->input->post('person_completing_report_name'),
			'person_reporting_incident_sign' => $this->input->post('person_reporting_incident_sign'),
			'report_complete_signtaure_date' => $report_complete_signtaure_date,
			'is_acknowdledeged' => $this->input->post('is_acknowdledeged'),
			'action_to_take' => $this->input->post('action_to_take'),
			'supervisor_comments' => $this->input->post('supervisor_comments'),
			'supervisor_sign' => $this->input->post('supervisor_sign'),
			'supervisor_sign_date' => $supervisor_sign_date,

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
		         $branch_id = $this->session->userdata('branch_id');
		   	if($branch_id ==''){
		     $type='employee';
		   }else{
		     $type = 'admin';  
		   }
		  
			$employees = $this->admin_model->get_employees_branchwise($branch_id,$type);
			$data['employees'] = $employees;    
		    $result = $this->EmployeesDeatils_model->get_record_from_table('Incident_Report',$id);    
		        
		    $data['details'] =   $result;
		     $data['role'] = $this->session->userdata('role');  
		  //   echo $this->session->userdata('role'); exit;
		    
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
			redirect('auth/homepage');
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
		   
                          
            $msg = 'This email is to inform you that manager has added comments to the injury report submitted. Please login to the HR portal to view the update'; 

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
			redirect('auth/homepage');
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
			redirect('auth/homepage');
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
			redirect('auth/homepage');
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
			redirect('auth/homepage');
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
    
    public function send_email_to_all_employee($branch_id='',$role_id='',$type='',$emp_email=''){
  if($branch_id =='' && $role_id==''){
         $branch_id = $this->input->post('id', TRUE);
        $role_id = $this->input->post('role_id', TRUE); 
  }
     
       if($emp_email !=''){
           $field_name = 'emp_id';
       }else{
           $field_name = 'role';
       }
      
        $all_emp = $this->admin_model->get_employees_branchwise($branch_id,'admin',$role_id,$field_name);
     
        $msg = 'This email is to inform you that a new '.$type.' has been sent by the management. Please login to the HR portal to view the '.$type;
        if(!empty($all_emp)){
        foreach($all_emp as $emp){
            add_notification($type,'employee',$emp->emp_id);
            
            $rfr_to = 'Dear '.$emp->first_name.' ,';
             $html_msg = $this->create_mail_template($msg,$rfr_to);
             $emp_detail = array(
                 'send_to' =>$emp->email,
                  'subject' => $type.' from the Management'
                 );
                 
                  
			
             $this->get_content_and_send_mail($emp_detail,$html_msg);
            
        }
    }
        return true;
    }


public function fetch_employee_for_timsheet(){
    
    $roster_plus_timesheet_id = $_POST['roster_list'];
    $data_posted = explode('_', $roster_plus_timesheet_id);
    
    $branch_id = $this->session->userdata('branch_id');
	$role = $this->session->userdata('role');
	$all_timesheet = $this->admin_model->get_all_timesheet($branch_id,'future');
    
   $timesheet_id = '';
   $roster_group_id = '';
   
   if(empty($_POST)){
      $roster_group_id =  $all_timesheet[0]->roster_group_id;
      $timesheet_id =  $all_timesheet[0]->timesheet_id;
      $data['timesheet_id'] =  $timesheet_id; 
   }else{
     if(isset($data_posted[0]) && $data_posted[0] !=''){
        $roster_group_id= $data_posted[0];
        }  
        
    if(isset($data_posted[1]) && $data_posted[1] !=''){
    $timesheet_id= $data_posted[1];
     $data['timesheet_id'] =  $timesheet_id; 
        }else{
     // Fallback: get timesheet_id from the matching timesheet for this roster_group_id
     if(!empty($all_timesheet)){
         foreach($all_timesheet as $ts){
             if($ts->roster_group_id == $roster_group_id){
                 $timesheet_id = $ts->timesheet_id;
                 break;
             }
         }
         if($timesheet_id == '' && isset($all_timesheet[0])){
             $timesheet_id = $all_timesheet[0]->timesheet_id;
         }
     }
     $data['timesheet_id'] =  $timesheet_id;
        }    
   }
     
        
        // check if timesheet has single roster or multiple roster
      if(isset($data_posted[2]) && $data_posted[2] !=''){
         $timesheet_type= $data_posted[2];
         $data['timesheet_type'] =  $timesheet_type; 
        }else{
         $data['timesheet_type'] =  '';
         $timesheet_type = 's';
        }
     
     
    
     
  
    
    if($timesheet_type=="m"){
        
        //fetch all roster id so that we can find all the employees of those roster to be displayted in timesheet in out page
         $seralized_all_roster_forthis_timesheet = $this->employees_model->get_timesheetfor_multiple_roster($timesheet_id);
         $all_roster_forhtis_timesheets = unserialize($seralized_all_roster_forthis_timesheet[0]->multiple_roster_group_id);
         $all_emps = $this->admin_model->fetch_employee_for_timsheet_bulk($all_roster_forhtis_timesheets, $branch_id);
      
    }else{
         $all_emps = $this->admin_model->fetch_employee_for_timsheet($roster_group_id, $branch_id);
    }

		  	if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		    }else{
		    

		   $roster_id = $this->session->userdata('roster_id');

		   $todays_date = date('Y-m-d', time());
        
         $dayname = strtolower(date("D"));
         if($dayname == "tue"){
             $dayname = "tues_start_time";
         }elseif($dayname == "thu"){
              $dayname = "thus_start_time";
         }else{
             $dayname = $dayname."_start_time";
         }
		   // Bulk load timesheet data and shift data
		   $emp_ids = array();
		   $roster_ids = array();
		   foreach($all_emps as $emp){
		       $emp_ids[] = $emp->emp_id;
		       $roster_ids[] = $emp->roster_id;
		   }
		   $roster_ids = array_unique($roster_ids);
		   
		   $timesheet_rows = $this->admin_model->get_timesheet_bulk($emp_ids, $timesheet_id, $todays_date);
		   $shift_rows = $this->admin_model->get_shifts_bulk($roster_ids, $dayname);
		   
		   // Index by emp_id+roster_id
		   $ts_map = array();
		   foreach($timesheet_rows as $row){
		       $ts_map[$row->employee_id.'_'.$row->roster_id] = $row;
		   }
		   // Index shifts by roster_id
		   $shift_map = array();
		   foreach($shift_rows as $row){
		       $shift_map[$row->roster_id] = $row->$dayname;
		   }
		   
		   foreach($all_emps as $all_emp){
		       $key = $all_emp->emp_id.'_'.$all_emp->roster_id;
		       if(isset($shift_map[$all_emp->roster_id]) && $shift_map[$all_emp->roster_id] == 'null'){
		          $all_emp->status = "Disable";     
		       }else{
		          $all_emp->status = "Enable";   
		       }
		       if(isset($ts_map[$key])){
		           $all_emp->in_time = $ts_map[$key]->in_time;
		           $all_emp->out_time = $ts_map[$key]->out_time;
		           $all_emp->break_in_time = $ts_map[$key]->break_in_time;
		           $all_emp->break_out_time = $ts_map[$key]->break_out_time;
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
      $last_name= $this->admin_model->get_emp_details_fieldwise($row->emp_id,'last_name');
     $emp_name = $emp_name . ' ' .$last_name;
   $table .= '<tbody><tr><td class="start_end"><b></a>'. $emp_name .'</b></td>';
   
   for ($i = 0; $i < 7; $i++) {
     $table .='<td class="start_end"><table><tr><td class="child">Start</td> <td class="child">End</td> <td class="child">Break</td></tr><tr>';
      $start_nameofday = $week_days[$i].'_start_time';
      $end_nameofday = $week_days[$i].'_end_time';
      $break_nameofday = $week_days[$i].'_break_time';
    if(($row->$start_nameofday == 0 || $row->$start_nameofday == 'null') && ($row->$end_nameofday == 0 || $row->$end_nameofday == 'null')) { $start_day = "";  } else {   $start_day = date ('H:i A',strtotime($row->$start_nameofday)); }
    if(($row->$start_nameofday == 0 || $row->$start_nameofday == 'null') && ($row->$end_nameofday ==0 || $row->$end_nameofday == 'null')) { $end_day ="";  } else {   $end_day= date ('H:i A',strtotime($row->$end_nameofday)); } 
    if($row->$break_nameofday > 0) { $break_time = $row->$break_nameofday.' Mins';  } else {  $break_time =  ' '; }
      $table .='<td class="child start_height">'. $start_day.'</td>';
      $table .='<td class="child start_height">'. $end_day.'</td>';
      $table .='<td class="child start_height">'. $break_time.'</td>';
    $table .='</tr></table></td>';
   }
   
   $table .='<td><a htef="#" onclick=fetch_timesheet('.$row->emp_id.','.$row->roster_id.')>View Timesheet</a></td></tr></tbody>';
 } 
 $table .='</table>';
 echo $table;
   
 }
 
  public function fetch_roster_of_timesheet(){
      
      $roster_id = $this->input->post('roster_id', TRUE);
      $all_roster_of_branch = $this->admin_model->fetch_rosterfrom_roster_id($roster_id);
     
       
       $table = '';
       $week_days = array('mon','tues','wed','thus','fri','sat','sun');
    
    $table .= '<div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">EMPLOYEE</th> <th style="text-align: center;">MON</th>  <th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th>
     </tr></thead>';
    
    foreach($all_roster_of_branch as $row){ 
     $emp_name= $this->admin_model->get_emp_details_fieldwise($row->emp_id,'first_name'); 
      $last_name= $this->admin_model->get_emp_details_fieldwise($row->emp_id,'last_name');
     $emp_name = $emp_name . ' ' .$last_name;
   $table .= '<tbody><tr><td class="start_end"><b></a>'. $emp_name .'</b></td>';
   
   for ($i = 0; $i < 7; $i++) {
     $table .='<td class="start_end"><table><tr><td class="child">Start</td> <td class="child">End</td> <td class="child">Break</td></tr><tr>';
      $start_nameofday = $week_days[$i].'_start_time';
      $end_nameofday = $week_days[$i].'_end_time';
      $break_nameofday = $week_days[$i].'_break_time';
    if(($row->$start_nameofday == 0 || $row->$start_nameofday == 'null') && ($row->$end_nameofday == 0 || $row->$end_nameofday == 'null')) { $start_day = "";  } else {   $start_day = date ('H:i A',strtotime($row->$start_nameofday)); }
    if(($row->$start_nameofday == 0 || $row->$start_nameofday == 'null') && ($row->$end_nameofday ==0 || $row->$end_nameofday == 'null')) { $end_day ="";  } else {   $end_day= date ('H:i A',strtotime($row->$end_nameofday)); } 
    if($row->$break_nameofday > 0) { $break_time = $row->$break_nameofday.' Mins';  } else {  $break_time =  ' '; }
      $table .='<td class="child start_height">'. $start_day.'</td>';
      $table .='<td class="child start_height">'. $end_day.'</td>';
      $table .='<td class="child start_height">'. $break_time.'</td>';
    $table .='</tr></table></td>';
   }
   
  
 } 
 $table .='</table>';
 echo $table;
      
  }
 
    public function fetch_timesheet($emp_id='',$roster_group_id='',$call_type=''){
     
      $emp_id = $this->input->post('emp_id', TRUE);
      //its a roster_id 
      $roster_id = $this->input->post('roster_group_id', TRUE);
  
    //  $timesheet_of_employee = $this->admin_model->get_timesheet($emp_id,$roster_group_id);
    $timesheet_of_roster = $this->employees_model->get_employee_timesheet_from_roster_id($emp_id,$roster_id);
    
 
    $table = '';
    $week_days = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
     if(!empty($timesheet_of_roster)){
    $table .= '<div class="row weekday_line"><div class="ct-scroll">
     <table class="blueTable" ><thead><tr>
     <th style="text-align: center;">Employee Name</th>';
     for($count = 0;$count < 7;$count++ ) { 
        $table .= '<th style="text-align: center;"> '. date("d-m-Y", strtotime($timesheet_of_roster[$count]['date'])).'('.strtoupper(date('D', strtotime($timesheet_of_roster[$count]['date']))).')'; 
        $table .='</th>';
     }
          
     $table .='<th style="text-align: center;">Comments</th><th style="text-align: center;">Status</th></tr></thead>';
    
    
  
   
     $first_name= $this->admin_model->get_emp_details_fieldwise($timesheet_of_roster[0]['employee_id'],'first_name');
     $last_name= $this->admin_model->get_emp_details_fieldwise($timesheet_of_roster[0]['employee_id'],'last_name');
  
   $table .= '<tbody><tr><td class="start_end"><h4>'. $first_name .' '.$last_name .'</h4></td>';
 
   $loop_count = 0;
   for ($i = 0; $i < 7; $i++) {
       if($timesheet_of_roster[$i]['in_time'] !='' && $timesheet_of_roster[$i]['in_time'] !=0) { $in_time = date("g:i A", strtotime($timesheet_of_roster[$i]['in_time'])); }else { $in_time= ''; }
       if($timesheet_of_roster[$i]['out_time'] !='' && $timesheet_of_roster[$i]['out_time'] !=0) { $out_time = date("g:i A", strtotime($timesheet_of_roster[$i]['out_time'])); }else { $out_time= ''; }
       if($timesheet_of_roster[$i]['break_in_time'] !='' && $timesheet_of_roster[$i]['break_in_time'] !=0) { $breakin_time = date("g:i A", strtotime($timesheet_of_roster[$i]['break_in_time'])); }else { $breakin_time= ''; }
       if($timesheet_of_roster[$i]['break_out_time'] !='' && $timesheet_of_roster[$i]['break_out_time'] !=0) { $break_out_time = date("g:i A", strtotime($timesheet_of_roster[$i]['break_out_time'])); }else { $break_out_time= ''; }
       
      $table .='<td class="start_end"><table><tr>';
      $table .='<td class="child">In</td> <td class="child">Out</td> <td class="child">Break In</td><td class="child">Break Out</td><td class="child">Outlet</td></tr><tr>';
      $table .='<td class="child start_height">'. $in_time . '</td>';
      $table .='<td class="child start_height">'.$out_time.'</td>';
      $table .='<td class="child start_height">'.$breakin_time.'</td>';
      $table .='<td class="child start_height">'.$break_out_time .'</td>';
      $table .='<td class="child start_height">'. $timesheet_of_roster[$i]['outletname'].'</td>';
      $loop_count++;
      $table .='</tr></table></td>';
   }
   
   $table .='<td>'. $timesheet_of_roster[0]['comment'].'</td>';
   
    if($call_type == 'function_call'){
        if($timesheet_of_roster[0]['in_verify'] == 1){
          $table .='<td>Approved</td></tr></tbody>';
        }elseif($timesheet_of_roster[0]['in_verify'] == 2){
        $table .='<td>Rejected</td></tr></tbody>';
        }elseif($timesheet_of_roster[0]['in_verify'] == 3){
        $table .='<td>Comments</td></tr></tbody>';
        }else{
        $table .='<td>Pending</td></tr></tbody>';
        }
    }else{
        
      if($timesheet_of_roster[0]['in_verify'] == 1){
             $table .='<td><select class="status_chnage" onchange=update_timesheet_status('.$timesheet_of_roster[0]['employee_id'].','.$timesheet_of_roster[0]['employee_timesheet_id'].',this) name="timesheet_status"><option value="3" data-toggle="modal" >Comments</option><option value="0" >Pending</option><option value="1" selected="selected">Approve</option><option value="2">Reject</option></select></td></tr></tbody>'; 
        }elseif($timesheet_of_roster[0]['in_verify'] == 2){
            $table .='<td><select class="status_chnage" onchange=update_timesheet_status('.$timesheet_of_roster[0]['employee_id'].','.$timesheet_of_roster[0]['employee_timesheet_id'].',this) name="timesheet_status"><option value="3" data-toggle="modal" >Comments</option><option value="0" >Pending</option><option value="1">Approve</option><option value="2" selected="selected">Reject</option></select></td></tr></tbody>'; 
        }elseif($timesheet_of_roster[0]['in_verify'] == 3){
            $table .='<td><select class="status_chnage" onchange=update_timesheet_status('.$timesheet_of_roster[0]['employee_id'].','.$timesheet_of_roster[0]['employee_timesheet_id'].',this) name="timesheet_status"><option value="3" data-toggle="modal" selected="selected" >Comments</option><option value="0" >Pending</option><option value="1">Approve</option><option value="2">Reject</option></select></td></tr></tbody>'; 
        }else{
      $table .='<td class="status_timesheet">
      <select class="status_chnage" onchange=update_timesheet_status('.$timesheet_of_roster[0]['employee_id'].','.$timesheet_of_roster[0]['employee_timesheet_id'].',this) name="timesheet_status"><option value="3" data-toggle="modal" >Comments</option><option value="0" selected="selected">Pending</option><option value="1">Approve</option><option value="2">Reject</option></select>
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

public function fetch_complete_timesheet($id='',$roster_group_id='',$user_type='',$filter_value='',$sortType='',$FortnightText=''){
 
     if($user_type !="employee"){    
   $timesheet_of_rosters = $this->employees_model->get_complete_employee_timesheet($id,$roster_group_id,$filter_value);

    
     if(!empty($timesheet_of_rosters)) {
         
        if($sortType !=''){
            
            foreach ($timesheet_of_rosters as $key => $row) {
          $EmpNamee = $row->employee_name;    
          $EmpLastName = substr($EmpNamee, strpos($EmpNamee, " ") + 1); 
         $distance[$key] = $EmpLastName ?? '';
        }
        if($sortType == 'SORT_ASC'){
            array_multisort($distance, SORT_ASC, $timesheet_of_rosters); 
        }else{
           array_multisort($distance, SORT_DESC, $timesheet_of_rosters);  
        }
       
        }else{
        // sort array based on emploiyee name in asc order
          foreach ($timesheet_of_rosters as $key => $row) {
          $distance[$key] = $row->employee_name;
        } 
         array_multisort($distance, SORT_ASC, $timesheet_of_rosters);
        }
       
   $timesheet_emoployee_id = $this->employees_model->get_all_employeeid_ofthis_timesheet($id,$roster_group_id);
   
 
   
   $oneDimensionalArray = array_map('current', $timesheet_emoployee_id);
   $count = 0;
   if(!empty($timesheet_of_rosters)){
     foreach($timesheet_of_rosters as $timesheet_of_roster){
    
    // if(in_array($timesheet_of_roster->employee_id,$oneDimensionalArray)){
      
            $employee_weekly_timesheet_details[($FortnightText !='' ? $timesheet_of_roster->employee_id  : $timesheet_of_roster->roster_id)][]  = array(
            'employee_id' => $timesheet_of_roster->employee_id,
            'employee_timesheet_id' => $timesheet_of_roster->employee_timesheet_id,
            'employee_name' => $timesheet_of_roster->employee_name,
            'outletname' => $timesheet_of_roster->outletname,
            'timesheet_id' => $timesheet_of_roster->timesheet_id,
            'date'=> $timesheet_of_roster->date,
            'in_time' => $timesheet_of_roster->in_time,
            'out_time' => $timesheet_of_roster->out_time,
            'break_in_time' => $timesheet_of_roster->break_in_time,
            'break_out_time' => $timesheet_of_roster->break_out_time,
            'in_verify' => $timesheet_of_roster->in_verify,
            'out_verify' =>$timesheet_of_roster->out_verify,
            'roster_id' =>$timesheet_of_roster->roster_id,
            'date'     => $timesheet_of_roster->date,
            'comment'     => $timesheet_of_roster->comment
            );
            $count++;
    // }
}


return $employee_weekly_timesheet_details;

}else{
    return '';
}
}

}else{
    
    $employee_weekly_timesheet_details = $this->employees_model->get_employee_timesheet($id,$roster_group_id);
   
    if(!empty($employee_weekly_timesheet_details)){
      
        $employee_weekly_timesheet_details_employee[$roster_group_id] = $employee_weekly_timesheet_details;
    
        return $employee_weekly_timesheet_details_employee;  
    }else{
         return '';
    }
    
   
}
  
 }
public function timesheetFilter($filerData='',$timesheet_id='',$roster_group_id=''){
    
    if(isset($filerData['emp_name']) && $filerData['emp_name'] !='' && isset($filerData['employee_type']) && $filerData['employee_type'] !=''){ 
      $EmpIDs = $this->employees_model->employeeIDfromNameAndType($filerData);
       $EmpIDs = array_column($EmpIDs, 'emp_id');
    }elseif(isset($filerData['emp_name']) && $filerData['emp_name'] !=''){
      $EmpIDs = $this->employees_model->employeeIDfromName('first_name',$filerData['emp_name']);
       $EmpIDs = array_column($EmpIDs, 'emp_id');
    }elseif(isset($filerData['employee_type']) && $filerData['employee_type'] !=''){
       $EmpIDs = $this->employees_model->employeeIDfromName('employee_type',$filerData['employee_type']);  
        $EmpIDs = array_column($EmpIDs, 'emp_id');
    }elseif(isset($filerData['timesheet_status']) && $filerData['timesheet_status'] !=''){
     $EmpIDs = $this->employees_model->employeeIDTimesheetStatus($timesheet_id,$roster_group_id,$filerData['timesheet_status']);
     $EmpIDs = array_column($EmpIDs, 'employee_id');
    }
      return $EmpIDs; 
    
}
 public function edit_timesheet($timesheet_id,$roster_group_id='',$sortType='SORT_DESC',$filter_employee_type = ''){
     
    // code for filter in timehseet
    if (!$this->ion_auth->logged_in()) {
		redirect('auth/homepage');
		}
     $data['filter_emp_type'] = '';
     $data['filter_emp_name'] = '';
    if(!empty($_POST)){ 
         $EmpIDs = $this->timesheetFilter($_POST,$timesheet_id,$roster_group_id);
         $data['filter_emp_type']  = ($_POST['employee_type'] !='' ? $_POST['employee_type'] : '');
         $data['filter_emp_name']  = ($_POST['emp_name'] !='' ? $_POST['emp_name'] : '');
         $data['filter_ersult_empId'] = (!empty($EmpIDs) ? 'true' : 'false');

        }elseif($filter_employee_type !=''){
             $data['filter_emp_type']  = $filter_employee_type;
             $fData['employee_type'] = $filter_employee_type;
             $EmpIDs = $this->timesheetFilter($fData,$timesheet_id,$roster_group_id); 
             $data['filter_ersult_empId'] = (!empty($EmpIDs) ? 'true' : 'false');
        }else{
          $EmpIDs = array();  
        }
      $user_email = $this->session->userdata('user_email');
     
	 if(($this->session->userdata('role')) =='employee'){ 
	     
	     $employee_weekly_timesheet_details = $this->fetch_complete_timesheet($timesheet_id,$roster_group_id,'employee');
	     $employee_weekly_timesheet_hours = $this->calculate_employee_timesheet_hours($employee_weekly_timesheet_details);
	    
	     $data['employee_weekly_timesheet_details']  = $employee_weekly_timesheet_hours;
	 }else{
	      $employee_weekly_timesheet_details = $this->fetch_complete_timesheet($timesheet_id,$roster_group_id,'',$EmpIDs,$sortType);
	     
	      $employee_weekly_timesheet_hours = $this->calculate_employee_timesheet_hours($employee_weekly_timesheet_details);
	     
	     $data['employee_weekly_timesheet_details']  = $employee_weekly_timesheet_hours;
	     
	   
	     $data['user_id']  = $this->session->userdata('user_id');
	     
	     
	 }
	 $timesheet_name = $this->admin_model->get_timesheet_nameby_id($timesheet_id);
	 $data['timesheet_name'] = $timesheet_name[0]->timesheet_name;
	
	 // fetch this timsehett's roster start and end date 
    $result_date = $this->admin_model->fetch_emp_idofthisroster($roster_group_id);
    $data['roster_group_id'] = $roster_group_id;
    if(!empty($result_date)){
        if($timesheet_id == '1376'){
            
      $data['start_date'] = '2024-06-03';
        $data['end_date'] =   '2024-06-09';       
        }else{
      $data['start_date'] = $result_date[0]->start_date;
        $data['end_date'] =   $result_date[0]->end_date;       
            
        }
        
    }else{
         $dataarray = $this->print_date_range($timesheet_name);
         $data['start_date'] = $dataarray['start_date'];
         $data['end_date'] = $dataarray['end_date'];
    }
   
     $data['timesheet_id'] = $timesheet_id;
     $data['roster_group_id'] = $roster_group_id;
    //  $data['multiple'] = $multiple;
   
     $menu_items  = $this->display_menu();
	 $hdata['menus'] = $menu_items;

	 
	 $this->load->view('general/header_general',$hdata);
     $this->load->view('Employeedetails/view_emp_timesheet',$data);
     $this->load->view('general/footer');
 }
 
 function print_date_range($timesheet_name) {
    
        // Extract date from timesheet_name
        if (preg_match('/\d{2}\/\d{2}\/\d{4}/', $timesheet_name[0]->timesheet_name, $matches)) {
            $date_str = $matches[0];
            $start_date = DateTime::createFromFormat('d/m/Y', $date_str);
            $end_date = clone $start_date;
            $end_date->modify('+6 days');
        
        $dataarray['start_date'] =  $start_date->format('d-m-Y');
        $dataarray['end_date'] = $end_date->format('d-m-Y');
        return $dataarray;
            // return "( From " . $start_date->format('d-m-Y') . " To " . $end_date->format('d-m-Y') . " )<br>";
        }
    
}
 
 public function calculate_employee_timesheet_Fortnighthours($employee_weekly_timesheet_details,$type=''){
     

     foreach($employee_weekly_timesheet_details as $key=> $employee_weekly_timesheet_detail){
          $loop_count = 0;
          $total_hrs_ofthis_week =0;
          $total_braktime_ofthis_week = 0;
         for ($i = 0; $i < 14; $i++) {
             $today_hrs = 0;
             $today_break = 0;
         if(($employee_weekly_timesheet_detail[$loop_count]['in_time'] !='') && ($employee_weekly_timesheet_detail[$loop_count]['out_time'] !='')) { 
       
                $time1 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['in_time']);
                $time2 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['out_time']);
                $difference = $time2->diff($time1);
                $timedifferencehr_in_min = $difference->h * 60;
                $timedifferencehr_in_min += $difference->i;
                $today_hrs = $timedifferencehr_in_min;
                $total_hrs_ofthis_week = $total_hrs_ofthis_week + $timedifferencehr_in_min; // in and out difference 
               
         }
           if($employee_weekly_timesheet_detail[$loop_count]['break_in_time'] !='' && ($employee_weekly_timesheet_detail[$loop_count]['break_out_time'] !='')) { 
        
                $breaktime1 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['break_in_time']);
                $breaktime2 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['break_out_time']);
                $break_timedifference = $breaktime2->diff($breaktime1); 
                  $break_timedifferencehr_in_min = $break_timedifference->h * 60;
                  $break_timedifferencehr_in_min += $break_timedifference->i;
                  $today_break = $break_timedifferencehr_in_min;
                $total_braktime_ofthis_week = $total_braktime_ofthis_week + $break_timedifferencehr_in_min;  // break in and breakout diference
                }
           
            
            // per day calculate no of hrs employee worked
            $total_working_hrs_this_day = $today_hrs - $today_break;
            
            // echo $today_hrs; echo "</br>";
            //  echo $today_break; echo "</br>";
            //   echo $total_working_hrs_this_day; echo "</br>";
            //   echo "=====================================";echo "</br>";
            if($total_working_hrs_this_day > 0 ){
                $total_working_hrs_this_day = number_format($total_working_hrs_this_day / 60,2);
            }else{
               $total_working_hrs_this_day = 0; 
            }
            
            $employee_weekly_timesheet_details[$key][$loop_count]['total_hrsworked_this_day'] = $total_working_hrs_this_day;
             $loop_count++;
           
           
             
            
         }
        
         $total_working_hrs_this_week_ofthisemployee = $total_hrs_ofthis_week - $total_braktime_ofthis_week;
        // convert total mins worked in hrs
        

    //   $total_working_hrs_this_week_ofthisemployee_inhr = date('G:i', mktime(0, $total_working_hrs_this_week_ofthisemployee));
      
    if($type=='textfile'){
        // 30-03-2024
         $total_working_hrs_this_week_ofthisemployee_inhr = floor($total_working_hrs_this_week_ofthisemployee / 60).'.'.$total_working_hrs_this_week_ofthisemployee % 60;
        //   $total_working_hrs_this_week_ofthisemployee_inhr = number_format($total_working_hrs_this_week_ofthisemployee / 60,2);
          $employee_weekly_timesheet_details[$key]['total_hrsworked_this_week'] = $total_working_hrs_this_week_ofthisemployee_inhr;
    }else{
        $total_working_hrs_this_week_ofthisemployee = $this->hoursandmins($total_working_hrs_this_week_ofthisemployee, '%02d Hours, %02d Minutes');
    //  $total_working_hrs_this_week_ofthisemployee_inhr = date('G:i', mktime(0, $total_working_hrs_this_week_ofthisemployee));
        // $total_working_hrs_this_week_ofthisemployee_inhr = floor($total_working_hrs_this_week_ofthisemployee / 60).':'.($total_working_hrs_this_week_ofthisemployee -   floor($total_working_hrs_this_week_ofthisemployee / 60) * 60);  
        $employee_weekly_timesheet_details[$key]['total_hrsworked_this_week'] = $total_working_hrs_this_week_ofthisemployee;
    }
     }
    
    // exit;
    return $employee_weekly_timesheet_details;
     
 }
 
 public function calculate_employee_timesheet_hours($employee_weekly_timesheet_details,$type=''){
     
     $total_hrs_of_all_employees_of_this_timesheet = 0;
     foreach($employee_weekly_timesheet_details as $key=> $employee_weekly_timesheet_detail){
          $loop_count = 0;
          $total_hrs_ofthis_week =0;
          $total_braktime_ofthis_week = 0;
         for ($i = 0; $i < 7; $i++) {
             $today_hrs = 0;
             $today_break = 0;
         if(($employee_weekly_timesheet_detail[$loop_count]['in_time'] !='') && ($employee_weekly_timesheet_detail[$loop_count]['out_time'] !='')) { 
       
                $time1 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['in_time']);
                $time2 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['out_time']);
                $difference = $time2->diff($time1);
                $timedifferencehr_in_min = $difference->h * 60;
                $timedifferencehr_in_min += $difference->i;
                $today_hrs = $timedifferencehr_in_min;
                $total_hrs_ofthis_week = $total_hrs_ofthis_week + $timedifferencehr_in_min; // in and out difference 
               
         }
           if($employee_weekly_timesheet_detail[$loop_count]['break_in_time'] !='' && ($employee_weekly_timesheet_detail[$loop_count]['break_out_time'] !='')) { 
        
                $breaktime1 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['break_in_time']);
                $breaktime2 = new DateTime($employee_weekly_timesheet_detail[$loop_count]['break_out_time']);
                $break_timedifference = $breaktime2->diff($breaktime1); 
                  $break_timedifferencehr_in_min = $break_timedifference->h * 60;
                  $break_timedifferencehr_in_min += $break_timedifference->i;
                  $today_break = $break_timedifferencehr_in_min;
                $total_braktime_ofthis_week = $total_braktime_ofthis_week + $break_timedifferencehr_in_min;  // break in and breakout diference
                }
           
            
            // per day calculate no of hrs employee worked
            $total_working_hrs_this_day = $today_hrs - $today_break;
            
            if($total_working_hrs_this_day > 0 ){
                $total_working_hrs_this_day = number_format($total_working_hrs_this_day / 60,2);
            }else{
               $total_working_hrs_this_day = 0; 
            }
            
            $employee_weekly_timesheet_details[$key][$loop_count]['total_hrsworked_this_day'] = $total_working_hrs_this_day;
             $loop_count++;
            }
        
         $total_working_hrs_this_week_ofthisemployee = $total_hrs_ofthis_week - $total_braktime_ofthis_week;
         $total_hrs_of_all_employees_of_this_timesheet = $total_hrs_of_all_employees_of_this_timesheet + $total_working_hrs_this_week_ofthisemployee;
        // convert total mins worked in hrs
        
       
    //   $total_working_hrs_this_week_ofthisemployee_inhr = date('G:i', mktime(0, $total_working_hrs_this_week_ofthisemployee));
      
    if($type=='textfile'){
    $total_working_hrs_this_week_ofthisemployee_inhr = number_format($total_working_hrs_this_week_ofthisemployee / 60,2);
    $employee_weekly_timesheet_details[$key]['total_hrsworked_this_week'] = $total_working_hrs_this_week_ofthisemployee_inhr;
    }else{
      $total_working_hrs_this_week_ofthisemployee = $this->hoursandmins($total_working_hrs_this_week_ofthisemployee, '%02d Hours, %02d Minutes');
    //  $total_working_hrs_this_week_ofthisemployee_inhr = date('G:i', mktime(0, $total_working_hrs_this_week_ofthisemployee));
        // $total_working_hrs_this_week_ofthisemployee_inhr = floor($total_working_hrs_this_week_ofthisemployee / 60).':'.($total_working_hrs_this_week_ofthisemployee -   floor($total_working_hrs_this_week_ofthisemployee / 60) * 60);  
        $employee_weekly_timesheet_details[$key]['total_hrsworked_this_week'] = $total_working_hrs_this_week_ofthisemployee;
    }
     }
     $total_hrs_of_all_employees_of_this_timesheet = $this->hoursandmins($total_hrs_of_all_employees_of_this_timesheet, '%02d Hours, %02d Minutes');
    $employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet'] = $total_hrs_of_all_employees_of_this_timesheet;
    // exit;
    return $employee_weekly_timesheet_details;
     
 }
 
  function hoursandmins($time, $format = '%02d:%02d')
  {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
    public function save_record(){
     
    if (!$this->ion_auth->logged_in()) {
        echo 'sessionexpired';
        exit;
    }
    $in_time =  $this->input->post('in_time');
    
    // Server-side time safeguard: if client time differs by more than 2 minutes, use server time
    $server_time = date('H:i');
    $diff_seconds = abs(strtotime($in_time) - strtotime($server_time));
    if ($diff_seconds > 120) {
        $in_time = $server_time;
    }
    
    $type =  $this->input->post('type');
    
    // Whitelist allowed type values to prevent column injection
    if(!in_array($type, array('in_time', 'out_time'))){
        echo 'error';
        exit;
    }
    
    $roster_id =  $this->input->post('roster_id');
    $emp_id_outletname =  explode('_', $this->input->post('emp_id'));
    $emp_id = intval($emp_id_outletname[0]);
    $roster_and_timesheet_id =  $this->input->post('roster_group_id');
    $roster_and_timesheet_id = explode('_', $roster_and_timesheet_id);
    $timesheet_id = $roster_and_timesheet_id[1];
    
    // Verify roster belongs to logged-in user's branch
    $branch_id = $this->session->userdata('branch_id');
    if(!$this->admin_model->verify_roster_branch($roster_id, $branch_id)){
        echo 'error';
        exit;
    }
    
    // Validation: check current state before allowing the operation
    $existing = $this->admin_model->get_timesheet_entry($emp_id, $timesheet_id, $roster_id, date('Y-m-d'));
    
    if($type == 'in_time'){
        // Cannot clock in if already clocked in
        if(!empty($existing) && isset($existing->in_time) && $existing->in_time != '00:00:00'){
            echo 'already_recorded';
            exit;
        }
    }
    
    if($type == 'out_time'){
        // Cannot clock out if already clocked out
        if(!empty($existing) && isset($existing->out_time) && $existing->out_time != '00:00:00'){
            echo 'already_recorded';
            exit;
        }
        // Cannot clock out while on break (break_in recorded but no break_out)
        if(!empty($existing) && isset($existing->break_in_time) && $existing->break_in_time != '00:00:00'
           && (!isset($existing->break_out_time) || $existing->break_out_time == '00:00:00')){
            echo 'on_break';
            exit;
        }
    }
    
    // compare and round up the time and searlize the day wise in out time's array as we are storing it in a single field in db
//here in time is same name for in and out time
   $returned_data = $this->compare_time_logic($roster_id,$type,$in_time);
   
   // if employee arrives 15 mins before his rostered time restrict them from logging time (08-08-2021)
   if($returned_data['error'] == true){
       echo "Early";
       exit;
   }
    $in_time = $returned_data['in_time'];
    
   
     // setting session for roster group id
      $this->session->set_userdata('roster_id', $roster_id);
    
       $data = array(
         $type =>$in_time,
        );
         
      if(isset($emp_id_outletname[1]) && !empty($emp_id_outletname[1])){
        $outletname = $emp_id_outletname[1]; 
        $data['outletname'] = $outletname;
      }
       
        $result = $this->admin_model->update_employee_timesheet($data,$timesheet_id,$roster_id,'',$emp_id); 
        echo $result ? 'saved' : 'error';
 }
    public function compare_time_logic($roster_id,$type,$in_time){
     $error = false;
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
                    //up to 10 min early arrival is allowed for roundup else enter actual time as clockin time (old functioality as per new functioanlity if a employee arrives 15 mins or more , 
                    // before his rostered time he cant logg time)
                  if($hr_in_min > 15){
                     $new_in_time =  $in_time;
                    $error = true;
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
           
    return array(
        'in_time' => $new_in_time,
         'error' => $error
        );;
    
     
 }
    public function check_session_alive(){
        echo $this->ion_auth->logged_in() ? 'active' : 'expired';
        exit;
    }

    public function verify_pin(){
    if (!$this->ion_auth->logged_in()) {
        echo 'sessionexpired';
        exit;
    }    
     $emp_id =  $this->input->post('emp_id');   
     $emp_pin =  $this->input->post('emp_pin');
     
     // Verify employee belongs to logged-in user's branch
     $branch_id = $this->session->userdata('branch_id');
     $emp_branch = $this->admin_model->get_emp_details_fieldwise($emp_id, 'branch_id');
     if($emp_branch != $branch_id){
         echo 'error';
         exit;
     }
     
     $result= $this->EmployeesDeatils_model->verify_pin($emp_pin,$emp_id);
      echo $result;
      exit;
     }
 
    public function save_break_record(){
      
       if (!$this->ion_auth->logged_in()) {
           echo 'sessionexpired';
           exit;
       }
       $break_time =  $this->input->post('break_time');
       
       // Server-side time safeguard: if client time differs by more than 2 minutes, use server time
       $server_time = date('H:i');
       $diff_seconds = abs(strtotime($break_time) - strtotime($server_time));
       if ($diff_seconds > 120) {
           $break_time = $server_time;
       }
       
       $break_type =  $this->input->post('break_type');
       
       // Whitelist allowed break types to prevent column injection
       if(!in_array($break_type, array('break_in_time', 'break_out_time'))){
           echo 'error';
           exit;
       }
     
      $roster_and_timesheet_id =  $this->input->post('roster_group_id');
      $roster_and_timesheet_id = explode('_', $roster_and_timesheet_id);
      $roster_id =  $this->input->post('roster_id');
      $emp_id = intval($this->input->post('emp_id'));
      
      // Verify roster belongs to logged-in user's branch
      $branch_id = $this->session->userdata('branch_id');
      if(!$this->admin_model->verify_roster_branch($roster_id, $branch_id)){
          echo 'error';
          exit;
      }

      $roster_group_id = $roster_and_timesheet_id[0];
      $timesheet_id = $roster_and_timesheet_id[1];
       $date = date('Y-m-d');
       
      // Validation for break records: prevent duplicates
      $existing = $this->admin_model->get_timesheet_entry($emp_id, $timesheet_id, $roster_id, $date);
      
      if($break_type == 'break_in_time'){
          // Cannot record break_in if already recorded
          if(!empty($existing) && isset($existing->break_in_time) && $existing->break_in_time != '00:00:00'){
              echo 'already_recorded';
              exit;
          }
      }
      
      if($break_type == 'break_out_time'){
          // Cannot record break_out if already recorded
          if(!empty($existing) && isset($existing->break_out_time) && $existing->break_out_time != '00:00:00'){
              echo 'already_recorded';
              exit;
          }
      }
       
        $data = array(
         $break_type =>$break_time,
         'date'=> $date,
        );
        
        $result = $this->admin_model->update_employee_timesheet($data,$timesheet_id,$roster_id,'',$emp_id);
        echo $result ? 'saved' : 'error';
 }
 
    public function update_timesheet(){
     
      $employee_timesheet_id =  $this->input->post('employee_timesheet_id');
      $emp_id =  $this->input->post('emp_id');
      $status =  $this->input->post('status');
    
      if(!empty($this->input->post('comment'))){
          $comment =  $this->input->post('comment');
      }else{
          $comment ='';
      }

      $branch_result = $this->employees_model->get_emp_update($emp_id);
	  $to = $branch_result[0]->email;
	  $empname = $branch_result[0]->first_name;
      
        if($comment !=''){
          $data = array(
          'in_verify' => $status,
          'comment' => $comment
        );  
        }else{
            $data = array(
          'in_verify' => $status,
        );
            
        }
      
     $this->admin_model->update_employee_timesheet_data($data,$employee_timesheet_id);
     
     $data = array(
            'email' => $to,
            'empname' => $empname,
            'branch_id' => $this->session->userdata('branch_id')
        );

        $this->db->insert('timesheet_approval_mail_sent_status', $data);
     
// 		     $emp_details = array(
// 			     'send_to' =>$to,
// 			     'subject' =>  "An Update on the Timesheet",
// 			     );
			 
//      $msg = 'This email is to inform you that manager has an update on your timesheet.
// Please login to the HR portal to view the update. <br><a href="https://www.cafeadmin.com.au/HR">Click here to login your portal</a>'; 

//              $refer_to =  'Dear '.$empname.' ,';
// 		     $msg=$this->create_mail_template($msg,$refer_to);    
		     
// 		   if($this->get_content_and_send_mail($emp_details,$msg)){ 
// 		    return true;
// 		      }else{
// 		       return true; 
// 		    }
		    
     return true;
 }
 
//     function update_multiple_timesheet(){
   
//   $roster_id = $_POST['roster_id'][0];
// $timesheet_id = $_POST['timesheet_id'];
// $roster_group_id = $_POST['roster_group_id'];

// // Initialize an array to hold all the data updates
// $data_updates = array();

// foreach ($_POST as $key => $value) {
//     // Check if the key contains '@'
//     if (strpos($key, '@') !== false) {
//         $parts = explode('@', $key);
//         if (is_array($parts) && count($parts) == 2) {
//             $field_name = $parts[0];
//             $date = $parts[1];
//             $data = $value[0];
//             // Construct the update array
//             $data_updates[] = array(
//                 'roster_id' => $roster_id,
//                 'date' => $date,
//                 $field_name => $data
//             );
//         }
//     }
// }

// // echo "<pre>"; print_r($data_updates); exit;

// // Batch update using a single query
// foreach ($data_updates as $data_update) {
//     $this->db->where('roster_id', $data_update['roster_id']);
//     $this->db->where('date', $data_update['date']);
//     $this->db->update('employee_timesheet', $data_update);
// }

//     if(isset($_POST['ajaxSubmit'])){
//      echo "Success"; exit;   
//     }else
//     {
//     redirect('Employeedetails/edit_timesheet/'.$timesheet_id.'/'.$roster_group_id);    
//     }
   	
    
// }

function update_multiple_timesheet() {
    
        // Extract data from $_POST
        $employee_timesheet_id = $this->input->post('employee_timesheet_id');
        $in_time = $this->input->post('in_time');
        $out_time = $this->input->post('out_time');
        $break_in_time = $this->input->post('break_in_time');
        $break_out_time = $this->input->post('break_out_time');
        $outletname = $this->input->post('outletname');
        
        // Combine data into a single array for batch update
        $data_updates = array();
        for ($i = 0; $i < count($employee_timesheet_id); $i++) {
            $data_updates[] = array(
                'employee_timesheet_id' => $employee_timesheet_id[$i],
                'in_time' => $in_time[$i],
                'out_time' => $out_time[$i],
                'break_in_time' => $break_in_time[$i],
                'break_out_time' => $break_out_time[$i],
                'outletname' => $outletname[$i]
            );
        }
        
      
        // Perform batch update using update_batch() method
        $this->db->update_batch('employee_timesheet', $data_updates, 'employee_timesheet_id');
      
         if ($this->db->affected_rows() == count($employee_timesheet_id)) {
            echo "Success";
        } else {
          
         log_message('error', 'Batch update failed: ' . $this->db->last_query());
            log_message('error', 'Database Error: ' . $this->db->error());
            echo "Error: Batch update failed".$this->db->error();
            
        }

        // Respond with success message
       if(isset($_POST['ajaxSubmit'])){
     echo "Success"; exit;   
    }else
    {
    redirect('Employeedetails/edit_timesheet/'.$timesheet_id.'/'.$roster_group_id);    
    }
    
}








	function timesheet_filters($start_date,$end_date,$timesheet_name,$exEmployee){
	    
	  $branch_id = $this->session->userdata('branch_id');
	  
			$type='admin';
			
		   if($branch_id ==''){
		   $user_email = $this->session->userdata('user_email');
		   $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		   $branch_id = $emp_id;
		   $type='employee';
		   }
		   
		   if($timesheet_name !='' && $timesheet_name != 'unset'){
		       $timesheet_name = str_replace('%20', ' ', $timesheet_name);
		       
		   }
	        $timesheets = $this->EmployeesDeatils_model->timesheet_filters($start_date,$end_date,$branch_id,$timesheet_name,$exEmployee,$type); 
		   
        	 $menu_items  = $this->display_menu();
        	 $role = $this->session->userdata('role');	
        	 $total_records = $this->admin_model->get_total('roster',$branch_id,$type);
        	 $records = $this->pagination_data_buildup($branch_id,'roster',$type,$total_records,'admin/get_roster_weeks');
        	 $data['result_count']  = $records['result_count'];
        	 $data['record_data']  = $timesheets;
             $data['role'] = $role;           			
             $data['branch_id'] = $branch_id;           			
			  
			  // get ex-employees
				$exEmployees = $this->admin_model->get_disbaled_employees($branch_id);
				
				// echo "<pre>"; print_r($exEmployees); exit;
			
                $data['exEmployees'] = $exEmployees;
                $data['selected_exEmployees'] = $exEmployee;
                
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('Employeedetails/view_timesheet',$data);
				$this->load->view('general/footer');
	}
 
    function download_excel(){
	    
	  $reports_details = $this->EmployeesDeatils_model->get_approved_timesheet();
// 	  $reports_details = $this->calculate_timesheet_hours($reports_details);
      $week_days = array('mon','tues','wed','thus','fri','sat','sun');

          $size = sizeof($reports_details);

          $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

          $sheet = $spreadsheet->getActiveSheet();
          //set heading of excel
     
      $sheet->setCellValue('A1', 'Date');
      $sheet->setCellValue('B1', 'First Name');
      $sheet->setCellValue('C1', 'Last Name');
      $sheet->setCellValue('D1', 'Payroll Category');
      $sheet->setCellValue('E1', 'Units');

        $symbol = "$";
        $count = 0;
        for($x = 2; $count < $size; $x++){
            
        $date =  date('d-m-Y', strtotime($reports_details[$count]->date));
        $sheet->setCellValue('A'.$x, $date);
        $sheet->setCellValue('B'.$x, $reports_details[$count]->first_name);
        $sheet->setCellValue('C'.$x, $reports_details[$count]->last_name);
        $sheet->setCellValue('D'.$x,'Base hourly');
        $sheet->setCellValue('E'.$x, $reports_details[$count]->total_working_hrs_this_week_ofthisemployee_inhr);
        
        $count++;
        
          }
         
        $writer = new Xlsx($spreadsheet); 
        $filename = 'Approve timsheet';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;

	    
	}

    function download_textfile($tid,$rgid='',$type=''){
        
//         ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
        $content = "Date,First Name,Last Name,Payroll Category,Units";
        
        if($type !=''){ 
            $filterdata['employee_type'] = 'casual';
         $EmpIDs = $this->timesheetFilter($filterdata,$tid,$rgid);
        }else{
          $EmpIDs = array();  
        }
       
        $employee_weekly_timesheet_details = $this->fetch_complete_timesheet($tid,$rgid,'',$EmpIDs);
       
       
        $employee_weekly_timesheet_hours = $this->calculate_employee_timesheet_hours($employee_weekly_timesheet_details,'textfile');
        $content .= "\n"; 
           
     
          foreach($employee_weekly_timesheet_hours as $employee_weekly_timesheet_hour){
             if(isset($employee_weekly_timesheet_hour[0]['employee_id']) && $employee_weekly_timesheet_hour[0]['employee_id'] !=''){
                 
              $emp_details = $this->employees_model->get_emp_details($employee_weekly_timesheet_hour[0]['employee_id']);
               
              for($i=0;$i<7;$i++){
                
             //   EARLY START CODE 29-03-2024 START ==========================================================   
                  // Early start code between 1 Am and 6 Am
                  $date =  date('d/m/Y', strtotime($employee_weekly_timesheet_hour[$i]['date']));
                  $currentLoopdate =  date('d-m-Y', strtotime($employee_weekly_timesheet_hour[$i]['date']));
                  $publicHolidays =  $this->session->userdata('public_holidays');
                //   echo $publicHolidays; exit;
                  $holidaysArray = explode(',', $publicHolidays);
                  $resultEarlyHr = $this->isEarlyStart(($employee_weekly_timesheet_hour[$i]['in_time']),($employee_weekly_timesheet_hour[$i]['out_time']));
           
              if($resultEarlyHr['is_earlyStart'] == 1){   
              $text = 'Early Start';
              $minutes = $resultEarlyHr['earlyTotalHrs'];
              $earlyTotalHrs = number_format($minutes / 60,2);
              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$text.",".$earlyTotalHrs;    
              $content .= "\n"; 
         
              $nonEarlyHrs = $employee_weekly_timesheet_hour[$i]['total_hrsworked_this_day'];
              }else{
              $nonEarlyHrs = $employee_weekly_timesheet_hour[$i]['total_hrsworked_this_day'];    
              }
              $currentLoopdateString = strtotime($employee_weekly_timesheet_hour[$i]['date']);
              $text  ='Base Hourly';
              // check if todays date is weekend
              $currentDayOfWeek = date('w',$currentLoopdateString);
              if ($currentDayOfWeek == 6 || $currentDayOfWeek == 0) {
              $text = $emp_details[0]->levelType !='' ? $emp_details[0]->levelType : 'Base Hourly';      
                if ($currentDayOfWeek == 6 && $emp_details[0]->levelType == 'Level 3 Weekends') {
                 $text = 'Level 3 Saturday';    
                }else if($currentDayOfWeek == 0 && $emp_details[0]->levelType == 'Level 3 Weekends'){
                 $text = 'Level 3 Sunday';
                }
                if ($currentDayOfWeek == 6 && $emp_details[0]->levelType == 'Level 4 Weekends') {
                 $text = 'Level 4 Saturday';    
                }else if($currentDayOfWeek == 0 && $emp_details[0]->levelType == 'Level 4 Weekends'){
                 $text = 'Level 4 Sunday';
                }  
            }
               
               if (in_array($currentLoopdate, $holidaysArray)) {
               $text = $emp_details[0]->phType !='' ? $emp_details[0]->phType : 'Public Holiday';
               }

              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$text.",".$nonEarlyHrs;
              $content .= "\n";    
           
             
              
    //   ========================================== END EARLY START CODE ====================================================  
      
              }
              
              for($j=0;$j<7;$j++){
              $date =  date('d/m/Y', strtotime($employee_weekly_timesheet_hour[$j]['date']));
              if($employee_weekly_timesheet_hour[$j]['total_hrsworked_this_day'] == 0){
                  $ua = '0.00';
                  $uniform_allowance = 'Uniform Allowance';
              }else{
                  $ua = '1.00';
                //   $ua =  $emp_details[0]->uniform_allowance;
                   $uniform_allowance = 'Uniform Allowance';
              }
              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$uniform_allowance.",".$ua;
              $content .= "\n"; 
              }
              
             } 
          }
         
        
           if($type !=''){ 
               $file = "Approved_timesheet_Casual_data.txt";
           }else{
              $file = "Approved_timesheet_data.txt"; 
           }
         
         $txt = fopen($file, "w") or die("Unable to open file!");
         fwrite($txt, $content);
         fclose($txt);
          header('Content-Description: File Transfer');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          header("Content-Type: text/plain");
          readfile($file);
	
        
}

    function download_total_hours($tid='',$rgid='',$type=''){
        
        $content = "Name,Email,Total Hours";
      
        $TimehseetIds = explode(",", $_GET['TimehseetIds']);
        $RGIds = explode(",", $_GET['RGId']);
        $finalArrayForAllEmployees = array();
        if($type !=''){ 
            $filterdata['employee_type'] = 'casual';
         $EmpIDs = $this->timesheetFilter($filterdata,$tid,$rgid);
        }else{
          $EmpIDs = array();  
        }
         
      
        for($i=0;$i<count($TimehseetIds);$i++){
         if($i==0){
             $firstarry =  $this->fetch_complete_timesheet($TimehseetIds[$i],$RGIds[$i],'',$EmpIDs,'',true); 
          }else{
            $secondarry =  $this->fetch_complete_timesheet($TimehseetIds[$i],$RGIds[$i],'',$EmpIDs,'',true); 
             $allEmployeIDofBothTimehseet = array_values(array_unique(array_merge(array_keys($secondarry), array_keys($firstarry)))) ;
          }
          
         for($i=0;$i<count($allEmployeIDofBothTimehseet);$i++){
             
            if (array_key_exists($allEmployeIDofBothTimehseet[$i],$firstarry) && array_key_exists($allEmployeIDofBothTimehseet[$i],$secondarry)){
                 $finalArrayForAllEmployees[$allEmployeIDofBothTimehseet[$i]] = array_merge($firstarry[$allEmployeIDofBothTimehseet[$i]],$secondarry[$allEmployeIDofBothTimehseet[$i]]);
             }else if(array_key_exists($allEmployeIDofBothTimehseet[$i],$firstarry)){
                 $finalArrayForAllEmployees[$allEmployeIDofBothTimehseet[$i]] = $firstarry[$allEmployeIDofBothTimehseet[$i]];
             }else if(array_key_exists($allEmployeIDofBothTimehseet[$i],$secondarry)){
                  $finalArrayForAllEmployees[$allEmployeIDofBothTimehseet[$i]] = $secondarry[$allEmployeIDofBothTimehseet[$i]];
             }
             
         }
        }
        
       
        $employee_weekly_timesheet_hours = $this->calculate_employee_timesheet_Fortnighthours($finalArrayForAllEmployees,'textfile');
        


        $content .= "\n"; 
       
     
          foreach($employee_weekly_timesheet_hours as $employee_weekly_timesheet_hour){
              
             
            $emp_details = $this->employees_model->get_emp_details($employee_weekly_timesheet_hour[0]['employee_id']);
             $content .= $emp_details[0]->first_name." ". $emp_details[0]->last_name.",".$emp_details[0]->email.",".$employee_weekly_timesheet_hour['total_hrsworked_this_week'];
              $content .= "\n"; 
              }
           $file = "Employee_total_hours.txt";
         
         $txt = fopen($file, "w") or die("Unable to open file!");
         fwrite($txt, $content);
         fclose($txt);
          header('Content-Description: File Transfer');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          header("Content-Type: text/plain");
          readfile($file);
	
        
}
	
    function download_FortnightTextfile($tid='',$rgid='',$type=''){
        
        $content = "Date,First Name,Last Name,Payroll Category,Units";
      
        $TimehseetIds = explode(",", $_GET['TimehseetIds']);
        $RGIds = explode(",", $_GET['RGId']);
        $finalArrayForAllEmployees = array();
        
        $filterdata['employee_type'] = 'casual';
        $EmpIDs = $this->timesheetFilter($filterdata,$tid,$rgid); 
        
        
        foreach($TimehseetIds as $TimehseetId){
         $secondarry = array();
         $secondarry =  $this->fetch_complete_timesheet($TimehseetId,$RGIds[$i],'',$EmpIDs,'',true);
         foreach($secondarry as $empID => $value){

          if(isset($finalArrayForAllEmployees[$empID])){
          $finalArrayForAllEmployees[$empID] = array_merge($finalArrayForAllEmployees[$empID], $value);
          }else{
           $finalArrayForAllEmployees[$empID] = $value;   
          }
           $employee_timesheet_id = array_column($value, 'employee_timesheet_id');
           array_multisort($employee_timesheet_id, SORT_ASC, $value);
            }
        }
        
        

        // for($i=0;$i<count($TimehseetIds);$i++){
        //  if($i==0){
        //      $firstarry =  $this->fetch_complete_timesheet($TimehseetIds[$i],$RGIds[$i],'',$EmpIDs,'',true); 
        //   }else{
        //     $secondarry =  $this->fetch_complete_timesheet($TimehseetIds[$i],$RGIds[$i],'',$EmpIDs,'',true); 
           
        //     foreach($secondarry as $empID => $value){
        //         // echo $empID;
        //         if(isset($firstarry[$empID]) || isset($secondarry[$empID])){
        //             $newarr = $firstarry[$empID] ?? $secondarry[$empID];
        //           for($count=0;$count<7;$count++){
        //               array_push($newarr,$value[$count]); 
        //           }
        //           $employee_timesheet_id = array_column($newarr, 'employee_timesheet_id');

        //          array_multisort($employee_timesheet_id, SORT_ASC, $newarr);
        //       echo "<pre>"; print_r($newarr); exit;
        //          $finalArrayForAllEmployees[$empID] = $newarr;
              
        //           unset($newarr);
        //         }
                
        //     }
            
        //   }
        //  }

        $employee_weekly_timesheet_hours = $this->calculate_employee_timesheet_Fortnighthours($finalArrayForAllEmployees,'textfile');
        // Sort the array 
         $content .= "\n"; 
        
          foreach($employee_weekly_timesheet_hours as $employee_weekly_timesheet_hour){
              
          $emp_details = $this->employees_model->get_emp_details($employee_weekly_timesheet_hour[0]['employee_id']);
          for($iterration=0;$iterration<14;$iterration++){
               if(isset($employee_weekly_timesheet_hour[$iterration]['employee_id'])){   
            //   EARLY START CODE 29-03-2024 START ==========================================================   
                  // Early start code between 1 Am and 6 Am
                  $date =  date('d/m/Y', strtotime($employee_weekly_timesheet_hour[$iterration]['date']));
                  $currentLoopdate =  date('d-m-Y', strtotime($employee_weekly_timesheet_hour[$iterration]['date']));
                  $publicHolidays =  $this->session->userdata('public_holidays');
                //   echo $publicHolidays; exit;
                  $holidaysArray = explode(',', $publicHolidays);
                  $resultEarlyHr = $this->isEarlyStart(($employee_weekly_timesheet_hour[$iterration]['in_time']),($employee_weekly_timesheet_hour[$iterration]['out_time']));
           
              if($resultEarlyHr['is_earlyStart'] == 1){   
              $text = 'Early Start';
              $minutes = $resultEarlyHr['earlyTotalHrs'];
              $earlyTotalHrs = number_format($minutes / 60,2);
            // $earlyTotalHrs = floor($minutes / 60).'.'.$minutes % 60;
              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$text.",".$earlyTotalHrs;    
              $content .= "\n"; 
        //   $minutes = $resultEarlyHr['earlyTotalHrs'];
        //   $earlyTotalHrs = floor($minutes / 60).'.'.$minutes % 60;
              $nonEarlyHrs = $employee_weekly_timesheet_hour[$iterration]['total_hrsworked_this_day'];
              }else{
              $nonEarlyHrs = $employee_weekly_timesheet_hour[$iterration]['total_hrsworked_this_day'];    
              }
              $currentLoopdateString = strtotime($employee_weekly_timesheet_hour[$iterration]['date']);
              $text  ='Base Hourly';
              // check if todays date is weekend
              $currentDayOfWeek = date('w',$currentLoopdateString);
              if ($currentDayOfWeek == 6 || $currentDayOfWeek == 0) {
                 $text = $emp_details[0]->levelType !='' ? $emp_details[0]->levelType : 'Base Hourly';      
               
                if ($currentDayOfWeek == 6 && $emp_details[0]->levelType == 'Level 3 Weekends') {
                 $text = 'Level 3 Saturday';    
                }else if($currentDayOfWeek == 0 && $emp_details[0]->levelType == 'Level 3 Weekends'){
                 $text = 'Level 3 Sunday';
                }
                if ($currentDayOfWeek == 6 && $emp_details[0]->levelType == 'Level 4 Weekends') {
                 $text = 'Level 4 Saturday';    
                }else if($currentDayOfWeek == 0 && $emp_details[0]->levelType == 'Level 4 Weekends'){
                 $text = 'Level 4 Sunday';
                }  

               }
               
               if (in_array($currentLoopdate, $holidaysArray)) {
               $text = $emp_details[0]->phType !='' ? $emp_details[0]->phType : 'Public Holiday';
               }

              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$text.",".$nonEarlyHrs;
              $content .= "\n";    
           
             
              
    //   ========================================== END EARLY START CODE ====================================================  
          }
              }
          for($j=0;$j<14;$j++){
            if(isset($employee_weekly_timesheet_hour[$j]['employee_id'])){         
            $date =  date('d/m/Y', strtotime($employee_weekly_timesheet_hour[$j]['date']));
              if($employee_weekly_timesheet_hour[$j]['total_hrsworked_this_day'] == 0){
                  $ua = '0.00';
                  $uniform_allowance = 'Uniform Allowance';
              }else{
                  $ua = '1.00';
                //   $ua =  $emp_details[0]->uniform_allowance;
                   $uniform_allowance = 'Uniform Allowance';
              }
              $content .= $date.",".$emp_details[0]->first_name.",". $emp_details[0]->last_name.",".$uniform_allowance.",".$ua;
              $content .= "\n"; 
          }
              }
              
              
          }
           $file = "Approved_timesheet_dataFortnight.txt";
         
         $txt = fopen($file, "w") or die("Unable to open file!");
         fwrite($txt, $content);
         fclose($txt);
          header('Content-Description: File Transfer');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          header("Content-Type: text/plain");
          readfile($file);
	
        
}

function isEarlyStart($intime, $outTime) {
    
    $earlyStartHrsStartsAt = '1 AM';
    $earlyStartHrsEndsAt = '6 AM';
    // Convert time strings to DateTime objects
    $inTimeObj = DateTime::createFromFormat('H:i:s', $intime);
    $outTimeObj = DateTime::createFromFormat('H:i:s', $outTime);
    
    // Convert early start hours strings to DateTime objects
    $earlyStartHrsStartsAtObj = DateTime::createFromFormat('h A', $earlyStartHrsStartsAt);
    $earlyStartHrsEndsAtObj = DateTime::createFromFormat('h A', $earlyStartHrsEndsAt);

    // Check if the out time is less than the in time (next day scenario)
    if (isset($outTimeObj) && ($outTimeObj !='') &&  ($outTimeObj < $inTimeObj)) {
    
        $outTimeObj->modify('+1 day'); // Add one day
    }

    // Calculate the duration of early start hours between in time and out time
    $earlyStartMinutes = 0;
    if ($inTimeObj < $earlyStartHrsEndsAtObj && $outTimeObj > $earlyStartHrsStartsAtObj) {
        // Get the interval between the in time and out time
        $interval = min($outTimeObj, $earlyStartHrsEndsAtObj)->diff(max($inTimeObj, $earlyStartHrsStartsAtObj));

        // Calculate total minutes
        $totalMinutes = $interval->h * 60 + $interval->i;

        // Calculate early start minutes
        if ($inTimeObj < $earlyStartHrsStartsAtObj) {
            $earlyStartMinutes = min($totalMinutes, $earlyStartHrsEndsAtObj->diff($earlyStartHrsStartsAtObj)->h * 60 + $earlyStartHrsEndsAtObj->diff($earlyStartHrsStartsAtObj)->i);
        } else {
            $earlyStartMinutes = min($totalMinutes, $earlyStartHrsEndsAtObj->diff($inTimeObj)->h * 60 + $earlyStartHrsEndsAtObj->diff($inTimeObj)->i);
        }
    }

    // Check if there are any early start minutes
    $isEarlyStart = ($earlyStartMinutes > 0);

    return array(
        'is_earlyStart' => $isEarlyStart,
        'earlyTotalHrs' => $earlyStartMinutes
    );
}
function sortArrayBasedOnDate($element1, $element2) {
    $datetime1 = strtotime($element1['date']);
    $datetime2 = strtotime($element2['date']);
    return $datetime1 - $datetime2;
} 


}
