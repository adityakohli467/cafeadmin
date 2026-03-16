<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
		$this->load->model('admin_model');
		$this->load->model('general_model');
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
              'smtp_user' => 'cafehrmanagement@gmail.com', 
                'smtp_pass' => 'Discoverf1y@123!!',
                'mailtype' => 'html'
              );
              $this->load->library('email', $config);
              $this->email->initialize($config);
              
              	//===========================================================phpmailer start =================================================
	    $this->phpmailermail = new PHPMailer();
               
        $this->phpmailermail->isSMTP();
        // $this->phpmailermail->SMTPDebug = 2;
         $this->phpmailermail->Mailer = "smtp";
        $this->phpmailermail->Host     = 'smtp.gmail.com';
        $this->phpmailermail->SMTPAuth = true;
        $this->phpmailermail->SMTPSecure = 'tls';
        $this->phpmailermail->Username = 'cafehrmanagement@gmail.com';
        $this->phpmailermail->Password = 'Discoverf1y@123!!';
        $this->phpmailermail->Port     = 587;
        $this->phpmailermail->setFrom('cafehrmanagement@gmail.com', 'Cafeadmin');
				
			  //=========================================================php mailer end ======================================================
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
        
        if($this->session->userdata('supervisor') !='' || $this->session->userdata('is_haccap_user') == 1){ 
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
    public function selectEmployeeName(){
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
       $keyword = $this->input->post('keyword');
       $branchid = $this->session->userdata('branch_id');
        $branchempResult = $this->admin_model->filter_get_employees_branchwise($branchid,$keyword,'unset','unset');
        
        if(!empty($branchempResult)) { ?>

<ul id="emp-list">
<?php
foreach($branchempResult as $branchemp) {
?>
<li onClick="selectEmployeeName('<?php echo $branchemp->emp_id .'_'.$branchemp->first_name .' '.$branchemp->last_name; ?>');"><?php echo $branchemp->first_name; ?>  <?php echo ' '.$branchemp->last_name; ?></li>
<?php } ?>
</ul>
<?php }  ?>

 <?php        
   // enndddddd   of method
    }
    
    public function get_content_and_send_mail($emp_detail=array(),$body){
       
		       $email = $emp_detail['send_to'];
		       $subject = $emp_detail['subject'];
		      //  // Set content-type header for sending HTML email 
        //       $headers = "MIME-Version: 1.0" . "\r\n";
        //       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        //       $headers .= "From: info@cafeadmin.com.au\r\n" .
        //       "Reply-To: info@cafeadmin.com.au\r\n" .
        //       "X-Mailer: PHP/" . phpversion();
               // send email
               
                    $from_email = 'admin@cafeadmin.com.au';
               		$this->email->set_newline("\r\n");
				// 	$this->email->from($from_email, $subject); 
				// 	$this->email->to($email);
				// 	$this->email->reply_to($from_email);
				// 	$this->email->subject($subject);
				// 	$this->email->message($body);
				// 	$send = $this->email->send();
					
					//Phpmailer ============================================================
					 $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $body;
                     $this->phpmailermail->send();
					
			 //  mail($email, $subject, $body, $headers);
			   return true;
    }
    
    public function pagination_data_buildup($branch_id,$table_name,$type,$total_records,$link){
         if ($total_records > 0) 
        {
            // get current page records
            $config = array();
            $config['base_url'] = 'https://www.cafeadmin.com.au/HR/index.php/'.$link;
            $config['total_rows'] = $total_records;
            $config['uri_segment'] = 3;
            if($total_records > 20){
              $config["per_page"] = 20;  
            }else{
             $config["per_page"] = $total_records;   
            }
           
           
            
        $config["num_links"] = 5;  
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
    
           if($type=="employee"){
               $result_data  = $this->admin_model->get_roster_weeks($branch_id,$type,'',$config["per_page"], $this->uri->segment(3));
           }else{
               $result_data  = $this->admin_model->get_roster_weekss($branch_id,$type,'',$config["per_page"], $this->uri->segment(3));
           }
        
          return  $result_array = array(
                'result_count' => $result_count,
                 'records_data' => $result_data
                
                );
                  }
        
    }
    
  
    
    public function create_branch($branch_id=''){
        
         if(isset($branch_id) && $branch_id !='') {
           $data['title'] = "Update Branch";
           $branches = $this->admin_model->fetch_branches($branch_id);
           $menu_items = $this->display_menu();
		   $hdata['menus'] = $menu_items;
		   
		    $data['branch_id'] = $branches[0]->branch_id;
            $data['branch_name'] = $branches[0]->branch_name;
            // $data['unit'] = $branches[0]->unit;
            // $data['street'] = $branches[0]->street;
             
            //  $data['suburb'] = $branches[0]->suburb; 
            //  $data['postcode'] = $branches[0]->postcode;
            //  $data['state'] = $branches[0]->state;
             $data['status'] = $branches[0]->status;
             $data['budget'] = $branches[0]->budget;
            
             $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
             foreach($weekdays as $weekday){
                 $index_name = $weekday.'_budget';
                 $data[$weekday.'_budget'] = $branches[0]->$index_name;
             }
             
            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->load->view('general/header_general',$hdata);
            $this->load->view('auth/create_branch', $data);
            
           
       }else{
          $data['title'] = "Create Branch";
          $data['branch_id'] = $branch_id;
          
           // validate form input
        $this->form_validation->set_rules('branch_name', $this->lang->line('create_user_validation_fname_label'), 'required');

        if ($this->form_validation->run() == true) { 
           $res = $this->admin_model->add_branch($this->input->post());
           if($res){
                $this->session->set_flashdata('sucess_msg', 'Branch successfully created');
                redirect("admin/branches", 'refresh');
           }else{
               $this->session->set_flashdata('error_msg', 'Something went wrong... Try again');
                redirect("admin/branches", 'refresh');
           }
        }
            $menu_items = $this->display_menu();
    		$hdata['menus'] = $menu_items;
            $this->load->view('general/header_general',$hdata);
            $this->load->view('auth/create_branch', $data);
        
        
       }
    }
    
    
    public  function update_branch($branch_id =''){
    
            $branch_id = $this->input->post('branch_id');

            $users = $this->admin_model->update_branch($branch_id,$this->input->post());
            
             redirect("admin/branches", 'refresh');
    
}  
    
    public  function branches() {
        
         $data['title'] = "Site List";
       
        if($this->session->userdata('role') == "manager"){
            
           $branches = $this->admin_model->fetch_branches_basedonuser(); 
     
        }else{
           $branches = $this->admin_model->fetch_branches(); 
        }
     
        
        $data['branches'] = $branches;
    
      $menu_items  = $this->display_menu();    
       $hdata['menus'] = $menu_items;
        
	$this->load->view('general/header_general',$hdata);
	$this->load->view('employees/site_list',$data);
	$this->load->view('general/footer');
        
    }
    
    function branch_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			
			$res=$this->admin_model->branch_delete($id);
		echo "deleted";
		}
	}
    
    public  function users() {
         $data['title'] = "Users List";
      

        $users = $this->admin_model->fetch_users();
        
        $data['users'] = $users;
   
    $menu_items  = $this->display_menu();    
       $hdata['menus'] = $menu_items;
	$this->load->view('general/header_general',$hdata);
	 
	$this->load->view('employees/user_list',$data);

	$this->load->view('general/footer');
        
    }
    
    
     public  function view_role() {
        $data['title'] = "Users List";
        $roles = $this->admin_model->fetch_roles();
        $data['roles'] = $roles;
    
    $menu_items  = $this->display_menu();    
    $hdata['menus'] = $menu_items;
	$this->load->view('general/header_general',$hdata);
	$this->load->view('employees/role_list',$data);
	$this->load->view('general/footer');
        
    }
    public  function create_user($user_id ='') {
        
      $branches = $this->general_model->getallBranches();
   
     $data['branches'] = $branches;
     $menu_items = $this->display_menu();

       if(isset($user_id) && $user_id !='') {
          
           $data['title'] = "Update User";
           $users = $this->admin_model->fetch_users($user_id);
           
          
           $branch_access = $this->general_model->getBranchAccess($user_id);
           $hdata['menus'] = $menu_items;
	      $data['menus_list'] = $menu_items;

		  //   $data['name'] = $menu_items;
            $data['name'] = $users[0]->username;
            $data['role'] = $users[0]->role;
            $data['email'] = $users[0]->email;
            $data['phone'] = $users[0]->phone;
            $data['password'] = $users[0]->password;
            $data['user_id'] = $users[0]->customer_user_id;
            $data['existing_menus_list'] = unserialize($users[0]->menu_access);
            $data['is_haccap_user'] = '1';
             foreach($branch_access as $branch) {
                 $data['branch_access'][] = $branch->branch_id;
             }
            
		    $this->load->view('general/header_general',$hdata);
            $this->load->view('auth/create_user', $data);
            
       }else{
          
          $data['title'] = "Create User";
          $data['user_id'] = $user_id;
         
           // validate form input
        $this->form_validation->set_rules('username', $this->lang->line('create_user_validation_fname_label'), 'required');
        //$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        // $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        // $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {   
            $username = strtolower($this->input->post('username'));
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $password = $this->input->post('password');
            $role = $this->input->post('role');
             $supervisor = $this->input->post('supervisor');
            $branch = $this->input->post('branch');
            $menus_list = $this->input->post('menus_list');
            // echo "<pre>"; print_r($menus_list);
           
        }
        // echo "form_validation";exit;
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email,$role,$phone,$branch,$menus_list,$supervisor)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('msg', 'User successfully created');
            // $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("admin/create_user", 'refresh');
        } else {
            
            
			    $hdata['menus'] = $menu_items;
                $data['menus_list'] = $menu_items;
                //   echo "<pre>"; print_r($menu_items); exit;
            //display the create user form
            //set the flash data error message if there is one
              //$this->_render_page('auth/create_user', $this->data);
           $this->load->view('general/header_general',$hdata);
            $this->load->view('auth/create_user', $data);
            // $this->load->view('footer');
        } 
           
       }
    }
    
    public function send_credential_email($emp_id=''){
        $this->db->select('*');
		$this->db->from('employee');
	   // mail('adityakohli467@gmail.com','testhr','HRM');
	   // exit;
// 		$this->db->where('status',1);
// 		$this->db->where('branch_id',57);
        $this->db->where('emp_id',$emp_id);
// 		$this->db->where('email','kaushika@kjcreate.com.au');
		$query = $this->db->get();
		$footscray_users = $query->result();

	    $i=0;
        foreach($footscray_users as $footscray_user){ 
        $html = '<html> <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <title></title> 
    </head> 
    <body> 
    <p>Hello '. $footscray_user->first_name.' ,</p>
    <p> Welcome to your new HR Portal for Zouki.</p>
    In this portal you will be able to check your rosters and timesheets,<br>
    communicate with the management, update your employee and leave details as<br>
    well as submit any compliance forms required by Zouki.
   <br></br>
      <span>The login information for your employee portal is as follows:</span><br></br><br></br>
     Link <a href="https://www.cafeadmin.com.au">www.cafeadmin.com.au</a><br></br>
       <span>=> Select HR Management</span><br></br>
        <span>=> Select Employee Portal</span><br></br>
         <p><span><b>Login Details  </b></span></p>
          <p><span>Username : '.$footscray_user->email.'</span></p>
           <p><span>Password: <a href="https://www.cafeadmin.com.au/HR/index.php/auth/forgot_password"> Reset your password here</a> </span></p>
           
           <p>Please contact your manager if you have any queries.</p>
        <span>Kind Regards,</span><br></br>
         <span>HR Team</span>
         </body> 
         </html>';
         
                $email = $footscray_user->email;
		        $subject = "Cafe Admin - Welcome to HR management";
	
             // send email
    //          $from_email = 'admin@cafeadmin.com.au';
    //          $this->email->set_newline("\r\n");
				// 	$this->email->from($from_email, 'HRM'); 
				// 	$this->email->to($email);
				// 	$this->email->reply_to($from_email);
				// 	$this->email->subject($subject);
				// 	$body = $this->load->view('orders/order_email', $data,TRUE);
				// 	$this->email->message($html);
				// 	$send = $this->email->send();
				
				//Phpmailer ============================================================
					  $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = $subject;
                     $this->phpmailermail->Body = $html;
                     $this->phpmailermail->send();
					
			 
			   echo "Sent";
			 
			  $i++;
        }
		exit;	  
         
    }
  
   
    
    public function create_role(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    if(isset($_POST['contact_submit'])){
		        
		    $branch_id = $this->session->userdata('branch_id');
			  
		   $data=array(
		    'branch_id' => $branch_id,
			'role_name' => $this->input->post('role_name'),
			);
		     $target_message ='role';
		    $insert_id = $this->admin_model->add_role($data);
		     redirect('Employeedetails/success/'.$target_message);
		        
		    }else{
		        
		        
		    $branch_id = $this->session->userdata('branch_id');
		    $menu_items  = $this->display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('employees/create_role');
			$this->load->view('general/footer');
		    }
		    
			
		}
	}
    
    
    public  function update_user($user_id =''){
        
           $user_data = array(
                'username' =>strtolower($this->input->post('username')),
                 'email' => $this->input->post('email'),
                 'phone' => $this->input->post('phone'),
                'role' => $this->input->post('role'),
                'password' => $this->input->post('password'),
                 'menu_access' => serialize($this->input->post('menus_list'))
                );
                
           $branch_data = $this->input->post('branch');
           $user_id = $this->input->post('customer_user_id');
           $this->ion_auth->update($user_id, $user_data);
           redirect("admin/users", 'refresh');
    
}    
    
   	function user_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			//echo $id;exit;
			$res=$this->admin_model->user_delete($id);
		echo "deleted";
		}
	}
	
		function role_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
		
			$res=$this->admin_model->role_delete($id);
		echo "deleted";
		}
	}
	
	function careers(){
		$this->load->view('job_application');
	}
	
	function add_job_applicant(){
		$this->form_validation->set_rules('position','position','trim|required');
		  if ($this->form_validation->run() == true) {
		  	$target_dir = 'assets/resume/';
		  	$userfile_name = $_FILES['resume']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'resume_'.rand('10000','99999');
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
            $cover = $this->input->post('coverletter');
            //cover letter
            $target_dir1 = 'assets/cover_letter/';
		  	$userfile_name1 = $_FILES['coverletter']['name'];
            $userfile_extn1 = substr($userfile_name1, strrpos($userfile_name1, '.')+1);
		  	$file_name1 = 'coverletter_'.rand('10000','99999');
		  	$i = ".";
            $final_file_name1=$file_name1.$i.$userfile_extn1;
            $target_file1 = $target_dir1 . $final_file_name1;
            $file = move_uploaded_file($_FILES["coverletter"]["tmp_name"], $target_file1);
            
            if($final_file_name1 == ""){
            	$final_file_name1 = "";
            }
            $fname = $this->input->post('first_name');
            $position = $this->input->post('position');
            $lname = $this->input->post('last_name');
            $email_posted = $this->input->post('email');
            $mobile = $this->input->post('phone');
            $date = $this->input->post('dob');
            $visa = $this->input->post('visa_status');
            $avail = $this->input->post('availability');
            $exp = $this->input->post('experience');
            $qualify = $this->input->post('qualification');
            
            //echo $final_file_name;exit; 
		    $data = array(
		    	'position' => $this->input->post('position'),
		    	'cafe_location' => $this->input->post('cafe_location'),
		    	'title' => $this->input->post('title'),
		    	'first_name' => $this->input->post('first_name'),
		    	'last_name' => $this->input->post('last_name'),
		    	'email' => $this->input->post('email'),
		    	'mobile' => $this->input->post('phone'),
		    	'date_of_birth' => $this->input->post('dob'),
		    	'visa_status' => $this->input->post('visa_status'),
		    	'availability' => $this->input->post('availability'),
		    	'experience' => $this->input->post('experience'),
		    	'qualification' => $this->input->post('qualification'),
		    	'notes' => $this->input->post('notes'),
		    	'resume' => $final_file_name,
		    	'coverletter' => $final_file_name1
				);
			$result = $this->admin_model->add_job_applicant($data);
		
		      $email = "careers@cafeadmin.com.au";   
		      $msg = "First name : ".$fname."<br>Last name : ".$lname."<br>Email : ".$email_posted."<br>Phone number : ".$mobile."<br> Date of birth : ".$date."<br>Visa status : ".$visa."<br>Availability : ".$avail."<br>Experience : ".$exp."<br>Qualification : ".$qualify."";
			
			  $this->email->from('info@cafeadmin.com.au', "Cafe Admin HRM");
			  $this->email->to($email);
			  $this->email->subject("New Job Applicant ".$position."");
			  $this->email->message($msg);
			  $attched_file= FCPATH."/assets/resume/".$final_file_name;
			  $attched_file1= FCPATH."/assets/cover_letter/".$final_file_name1;
			  //echo $attched_file;exit;
        //       $this->email->attach($attched_file);
        //       $this->email->attach($attched_file1);
	       //   $this->email->send();
	          
	          	//Phpmailer ============================================================
					  $this->phpmailermail->ClearAddresses();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($email);
                     $this->phpmailermail->Subject = "New Job Applicant ".$position."";
                      $this->phpmailermail->addAttachment($attched_file);
                      $this->phpmailermail->addAttachment($attched_file1);
                     $this->phpmailermail->Body = $msg;
                     $this->phpmailermail->send();
	          
	          
	          
	          
	          
	          
			if($result){
				$this->session->set_flashdata('sucess_msg', 'Thank you for submitting your application! One of our Staff will contact you shortly');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to submit Job Application');
			}
			redirect('admin/careers');
		}else{
			redirect('admin/careers');
		}
	}
	function leave_management(){
		$this->load->view('job_application');
	}
	

		public function delete_single_roster(){

			  $roster_group_id = $this->input->post('id');
			  $roster_id = $this->input->post('roster_id');  
			  
			  
			$delete = $this->admin_model->delete_single_roster($roster_group_id,$roster_id);
	}
	
	
	

	


	function send_email(){
	    
	      $roster_group_id = $this->input->post('roster_group_id');
	      $Emaildata['loginlink'] = base_url()."index.php/auth/login";
		  $msg = $this->load->view('emails/roster_update',$Emaildata,true);
		  $subject = "Manager has an update on your roster";

	     $rosterGroupIds = @unserialize($roster_group_id);
	     // check if there are multiple roster group id or just one in case of view all roster we can have multple roster grp ids
         if ($rosterGroupIds !== false) {
             
         foreach($rosterGroupIds as $rosterGroupId){
        $roster = $this->admin_model->week_roster($rosterGroupId,'');
        $this->MailSendRosterUpdate($roster,$msg,$subject); 
          }
         } else {
          
        $roster = $this->admin_model->week_roster($roster_group_id,'');
        $this->MailSendRosterUpdate($roster,$msg,$subject);
          }
         
     echo "success"; exit;
	 	}
	
	
	
	function roster_filter($start_date,$end_date,$roster_name){
	    
	  $branch_id = $this->session->userdata('branch_id');
			$type='admin';
		   if($branch_id ==''){
		   $user_email = $this->session->userdata('user_email');
		   $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		   $branch_id = $emp_id;
		     $type='employee';
		   }
		   
	
	  $roster = $this->admin_model->roster_filter($start_date,$end_date,$branch_id,$roster_name,$type); 
	  
	  $menu_items  = $this->display_menu();
	  $role = $this->session->userdata('role');	
 $data['user_id']  = $this->session->userdata('user_id');
                $data['role'] =   $role;			
			    $data['roster'] = $roster;
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
	}

	
		public function reports()
	{
			  $menu_items  = $this->display_menu();
		       $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/reports');
				$this->load->view('general/footer');
		
	}

	function generate_report(){
	      $start_date =  $_POST['date_from'];
	      $end_date =  $_POST['date_to'];
	      $branch_id = $this->session->userdata('branch_id');
	 
	      $roster = $this->admin_model->roster_filter_for_report($start_date,$end_date,$branch_id); 
	     
	            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
				$week_earning =  0;
	            $total_hrs_of_employee_daywise =  array();
	            $j=0;
	            
	            if(!empty($roster)){

				foreach($roster as $key => $ros){
				 $rate = $this->admin_model->get_emp_details_fieldwise($ros->emp_id,'rate');
				  if($rate == ''){  $rate = 1;  }
				    $total_hrs_of_this_employee = 0;
				     for ($i = 0; $i < 7; $i++) {
				         $start_nameofday = $week_days[$i].'_start_time';
				         $end_nameofday = $week_days[$i].'_end_time';
				         $break_nameofday = $week_days[$i].'_break_time';
				         $difference = 0;
				         $break_hrs = $ros->$break_nameofday;
				         
				         if((isset($start_nameofday) && $start_nameofday !='') && (isset($end_nameofday) && $end_nameofday !='')){
                         $time1 = strtotime($ros->$start_nameofday);
                         $time2 = strtotime($ros->$end_nameofday);
if($time1 !='' && $time2 !=''){
                         $difference = round(abs(($time2 - $time1)) / 3600,2);
                         $hr_in_min = intval($difference* 60);
                         //hour worked worked on that minus break taken on that day
                         $difference = $hr_in_min - $break_hrs;
}else{
    $difference = 0;
}
                         // convert per hour rate to per min rate and multply to no of min worked
                         
                         $total_pay = (($rate)/60) * $difference;
                         $total_hrs_of_employee_daywise[$key][$week_days[$i]][] =  $difference; 
                         $average_rate_of_employee_daywise[$key][$week_days[$i]][] =  $rate; 
                         $total_earning_of_employee_daywise[$key][$week_days[$i]][] =  $total_pay;     
				     
				         }
				     } 
				}  
				
			   $no_of_emp = count($roster);
			
			   
			   for($j=0;$j<7;$j++){
				      $start_val = 0;
				      $start_val_cost =0;
				       $start_val_average_rate =0;
				      $total_hrs_inmin  = 0;
				      for($i=0; $i < count($total_hrs_of_employee_daywise); $i++){ 
				       
				      $start_val = $total_hrs_of_employee_daywise[$i][$week_days[$j]][0] + $start_val;
				      $start_val_average_rate = $average_rate_of_employee_daywise[$i][$week_days[$j]][0] + $start_val_average_rate;
				      $start_val_cost = $total_earning_of_employee_daywise[$i][$week_days[$j]][0] + $start_val_cost;

				  }
				    // convert total mins worked in hrs
				  $total_hrs_inmin = $start_val;
                  $start_val = $this->hoursandmins($start_val, '%02d Hrs, %02d Mins');
				  $total_hrs[$week_days[$j]] = $start_val;
				  $total_cost[$week_days[$j]] = $start_val_cost;
				  $total_hrs_min[$week_days[$j]] = $total_hrs_inmin;
				  $averate_rate[$week_days[$j]] = number_format($start_val_average_rate/$no_of_emp,2);
				  }
				
			
				$total_hrsof_all_day = array_sum($total_hrs_min);
			
		$data['total_hrs'] = $total_hrs;
        $data['total_hrsof_all_day'] = $this->hoursandmins($total_hrsof_all_day, '%02d Hrs, %02d Mins');
        $data['total_cost'] = $total_cost;
        $data['averate_rate'] = $averate_rate;
        }
                else{
                    $data['blank'] = "Yes";
                }
                $data['start_date'] = $start_date;
                $data['end_date'] = $end_date;
     
	            $menu_items  = $this->display_menu();
	            $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/generate_reports',$data);
				$this->load->view('general/footer');
	    
	}
	
		function add_report(){
		    
		 $week_days = array('mon','tues','wed','thus','fri','sat','sun'); 
		$branch_id = $this->session->userdata('branch_id');
		   foreach($week_days as $week_day){
		       
		       if(!empty($_POST[$week_day.'_sales'])){
		         $sales[$week_day] = $_POST[$week_day.'_sales'];  
		     }else{
		       $sales[$week_day] = 00.00;   
		     }
		     
		    
		   }
		   if($_POST['total_sales'] == ''){
		        $total_sales = array_sum($sales);
		   }else{
		       $total_sales = $_POST['total_sales'];
		   }
		  
		   $sales['total_sales'] = $total_sales;
		 foreach($week_days as $week_day){
		     if(!empty($_POST[$week_day.'_sales_gst'])){
		         $sales_gst[$week_day] = $_POST[$week_day.'_sales_gst']; 
		     }else{
		       $sales_gst[$week_day] = 00.00;   
		     }
		     
		   }
		  
		    if($_POST['total_sales_gst'] == ''){
		       $total_sales_gst = array_sum($sales_gst);
		   }else{
		       $total_sales_gst = $_POST['total_sales_gst'];
		   }
		   $sales_gst['total_sales_gst'] = $total_sales_gst;
		 foreach($week_days as $week_day){
		     
		     
		     if(!empty($_POST[$week_day.'_hrs'])){
		         $hrs[$week_day] = $_POST[$week_day.'_hrs']; 
		     }else{
		         $hrs[$week_day] = 00.00;   
		     }
		   }
		
		   $hrs['total_hrs'] = $_POST['total_hrs'];;
		 foreach($week_days as $week_day){
		      
		     if(!empty($_POST[$week_day.'_avg_rate'])){
		      $averate_rate[$week_day] = $_POST[$week_day.'_avg_rate'];
		     }else{
		         $averate_rate[$week_day] = 00.00;   
		     }
		   }
		   $total_averate_rate = array_sum($averate_rate);
		   $averate_rate['total_averate_rate'] = $total_averate_rate;
		   
		   foreach($week_days as $week_day){
		       
		        if(!empty($_POST[$week_day.'_total_cost'])){
		       $total_cost[$week_day] = $_POST[$week_day.'_total_cost']; 
		        $labour_cost_of_day = $_POST[$week_day.'_total_cost'];
		     }else{
		         $total_cost[$week_day] = 00.00;   
		          $labour_cost_of_day = 00.00;
		     }
		     
		      if(!empty($_POST[$week_day.'_sales'])){
		       $sales_of_day = $_POST[$week_day.'_sales'];
		     }else{
		         $sales_of_day = 00.00;   
		     }
		     
		     if($sales_of_day > 0 && $labour_cost_of_day > 0){
		       $total_cost_percentage[$week_day] = ($labour_cost_of_day/$sales_of_day)*100;  
		     }else{
		           $total_cost_percentage[$week_day] = 0;
		     }
		      
		     
		   }
		   $grandtotal_cost = array_sum($total_cost);
		   if($grandtotal_cost > 0){
		    
		   $total_cost['total_labour_cost'] = $grandtotal_cost;
		   $total_cost_percentage['total_percentage'] = ($grandtotal_cost/$total_sales)*100;      
		   }else{
		       $total_cost_percentage = 00.00;
		   }
		   
	       
	       
	       foreach($week_days as $week_day){

		     if(!empty($_POST[$week_day.'_catering_sales'])){
		      $catering_sales[$week_day] = $_POST[$week_day.'_catering_sales'];
		     }else{
		         $catering_sales[$week_day] = 00.00;   
		     }
		   }
		   if($_POST['total_catering_sales'] == ''){
		       $total_catering_sales = array_sum($catering_sales);
		   }else{
		       $total_catering_sales = $_POST['total_catering_sales'];
		   }
		   
		   $catering_sales['total_catering_sales'] = $total_catering_sales;
		   
		   
		   foreach($week_days as $week_day){

		      if(!empty($_POST[$week_day.'_totals'])){
		      $totals[$week_day] = $_POST[$week_day.'_totals']; 
		     }else{
		         $totals[$week_day] = 00.00;   
		     }
		   }
		   $total_totals = array_sum($totals);
		   $totals['total_totals'] = $total_totals;
		   

		   $sales =  serialize($sales);
		   $sales_gst = serialize($sales_gst);
		   $hrs = serialize($hrs);
		   $labour_cost = serialize($total_cost);
		   $total_labour_cost_percentage = serialize($total_cost_percentage);
		   $averate_rate = serialize($averate_rate);
		   
		   $totals = serialize($totals);
		   $catering_sales = serialize($catering_sales);
		   
		   $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
		   $end_date =  date('Y-m-d', strtotime($this->input->post('end_date')));
		   $report_name = $this->input->post('report_name');

		    
		    $data=array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'report_name' => $report_name,
			'sales' => $sales,
			'sales_gst' => $sales_gst,
			'average_hours' => $averate_rate,
			'labour_cost' => $labour_cost,
			'labour_percent' => $total_labour_cost_percentage,
			'hours' => $hrs,
			'catering_sales' => $catering_sales,
			'totals' => $totals,
			'branch_id' => $branch_id,
			);
			
		    $insert_id = $this->admin_model->add_report($data);
		    if($insert_id){
		       	redirect('admin/view_details_reports/'.$insert_id);
		    }
		    
		}
		function view_reports(){
		       
		      
		        $reports = $this->admin_model->fetch_reports();
		        $i=0;
		         
		        foreach($reports as $report){
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		         
		          $i++;
		        }
		  
			    $data['reports'] = $reports;
		        $menu_items  = $this->display_menu();
		        $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/listing.php',$data);
				$this->load->view('general/footer'); 
		}
		function report_filter($start_date,$end_date){
	    $reports = $this->admin_model->report_filter($start_date,$end_date); 
	   
		        $i=0;
		      
		        foreach($reports as $report){
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		         
		          $i++;
		        }
		  
			    $data['reports'] = $reports;
		        $menu_items  = $this->display_menu();
		        $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/listing.php',$data);
				$this->load->view('general/footer'); 
	    }
		function view_details_reports($report_id='',$purpose=''){
		       
		      
		        $reports = $this->admin_model->view_details_reports($report_id);
		  //      echo "<pre>";
			 //   print_r($reports);
			 //   exit;
		        $i=0;
		         
		        foreach($reports as $report){
		            
		          $reports[$i]->sales = unserialize($report->sales); 
		          $reports[$i]->sales_gst = unserialize($report->sales_gst);
		          $reports[$i]->average_hours = unserialize($report->average_hours);
		          $reports[$i]->hours = unserialize($report->hours);
		          $reports[$i]->labour_cost = unserialize($report->labour_cost);
		          $reports[$i]->labour_percent = unserialize($report->labour_percent); 
		          
		          if(!empty($report->catering_sales)){
		           $reports[$i]->catering_sales = unserialize($report->catering_sales);   
		          }
		          
		           if(!empty($report->totals)){
		           $reports[$i]->totals = unserialize($report->totals);   
		           }
		          
		         
		          $i++;
		        }
		        
		        if($purpose=="called_to_get_export_data"){
		           return  (array)$reports[0];
		        }
			    $data['reports'] = (array)$reports[0];
			    
			    $data['report_id'] = $report_id;
			    $data['report_name'] = $reports[0]->report_name;
		        $menu_items  = $this->display_menu();
		        $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/view_details_reports.php',$data);
				$this->load->view('general/footer'); 
		}
		function view_all_reports(){
		       
		       if(isset($_POST['options'])){         
	      foreach( $_POST['options'] as $report_id){
	      
	     $reports[$report_id] =  $this->admin_model->view_details_reports($report_id);
	     
	      }
	        }
	          
		        $i=0;
		        foreach($reports as $key=> $report){
		          $reports_data[$i]->report_id = $report[0]->report_id;
			      $reports_data[$i]->report_name = $report[0]->report_name;
			      $reports_data[$i]->start_date = $report[0]->start_date;
			      $reports_data[$i]->end_date = $report[0]->end_date;
		          $reports_data[$i]->sales = unserialize($report[0]->sales); 
		          $reports_data[$i]->sales_gst = unserialize($report[0]->sales_gst);
		          $reports_data[$i]->average_hours = unserialize($report[0]->average_hours);
		          $reports_data[$i]->hours = unserialize($report[0]->hours);
		          $reports_data[$i]->labour_cost = unserialize($report[0]->labour_cost);
		          $reports_data[$i]->labour_percent = unserialize($report[0]->labour_percent); 
		          
		          if(!empty($reports_data->catering_sales)){
		           $reports_data[$i]->catering_sales = unserialize($report[0]->catering_sales);   
		          }
		          
		           if(!empty($reports_data->totals)){
		           $reports_data[$i]->totals = unserialize($report[0]->totals);   
		           }
		          
		         
		          $i++;
		        }
		 
		      
			    $data['all_reports'] = (array)$reports_data;
			 //    echo "<pre>";
			 //   print_r($data['all_reports']);
		  //      exit;
			   
		        $menu_items  = $this->display_menu();
		        $hdata['menus'] = $menu_items;
		        $this->load->view('general/header_general',$hdata);
				$this->load->view('employees/view_all_detail_reports.php',$data);
				$this->load->view('general/footer'); 
		}
	
	function export_report(){
	    
	    if(isset($_POST['report_id'])){
	        $report_id = $_POST['report_id'];
	        $this->session->set_userdata('report_id', $report_id);
	    }
	  $report_id = $this->session->userdata('report_id');
	  
	  $report_details  = $this->view_details_reports($report_id,"called_to_get_export_data");
	  

	  
	      $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
       
    
        $spreadsheet->getActiveSheet()->getStyle('A1:A8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('70878c');
        $spreadsheet->getActiveSheet()->getStyle('J2:J8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffef8a');
         $spreadsheet->getActiveSheet()->getStyle('K2:K8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
         $spreadsheet->getActiveSheet()->getStyle('B5:I5')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
       
        
          //set heading of excel
      $sheet->setCellValue('A1', '');
      $sheet->setCellValue('A2', 'Sales');
       $sheet->setCellValue('A3', 'Catering Sales');
      $sheet->setCellValue('A4', 'Sales Less Gst');
      $sheet->setCellValue('A5', 'Hours');
      $sheet->setCellValue('A6', 'Average Hr');
      $sheet->setCellValue('A7', 'Labour Cost');
      $sheet->setCellValue('A8', 'Labour %');
     
  
      $sheet->setCellValue('B1', 'Monday');
      $sheet->setCellValue('C1', 'Tuesday');
      $sheet->setCellValue('D1', 'Wednesday');
      $sheet->setCellValue('E1', 'Thursday');
      $sheet->setCellValue('F1', 'Friday');
      $sheet->setCellValue('G1', 'Saturday');
      $sheet->setCellValue('H1', 'Sunday');
       $sheet->setCellValue('I1', 'Total');
       $sheet->setCellValue('J1', 'Totals');
       $sheet->setCellValue('K1', 'Value');
       
       
     $totals_values = array('','','Sales','Catering Sales','Totals','Sales Less Gst','Labour Cost','','');
     $total_sale_plus_catering =  $report_details['sales']['total_sales'] + $report_details['catering_sales']['total_catering_sales'];
     $totals_values_value = array('','',$report_details['sales']['total_sales'],$report_details['catering_sales']['total_catering_sales'],$total_sale_plus_catering,$report_details['sales_gst']['total_sales_gst'],$report_details['labour_cost']['total_labour_cost'],'','');
       $name = "sales";
       $total ="total_sales";
       $symbol = "$";
      for($x = 2; $x < 9; $x++){ 
        $sheet->setCellValue('B'.$x, $symbol.$report_details[$name]['mon']);
        $sheet->setCellValue('C'.$x, $symbol.$report_details[$name]['tues']);
        $sheet->setCellValue('D'.$x, $symbol.$report_details[$name]['wed']);
        $sheet->setCellValue('E'.$x, $symbol.$report_details[$name]['thus']);
        $sheet->setCellValue('F'.$x, $symbol.$report_details[$name]['fri']);
        $sheet->setCellValue('G'.$x, $symbol.$report_details[$name]['sat']);
        $sheet->setCellValue('H'.$x, $symbol.$report_details[$name]['sun']);
        $sheet->setCellValue('I'.$x, $symbol.$report_details[$name][$total]); 
        $sheet->setCellValue('J'.$x, $totals_values[$x]); 
        $sheet->setCellValue('K'.$x, $symbol.$totals_values_value[$x]); 
         
         if($x == 2){
           $name = "catering_sales";
           $total ="total_catering_sales";
           $symbol = "$";
         }elseif($x == 3){
              $name = "sales_gst";
           $total ="total_sales_gst";
           $symbol = "$";
          
         }elseif($x == 4){
                $name = "hours";
           $total ="total_hrs";
           $symbol = "";
          
         }elseif($x == 5){
              $name = "average_hours";
           $total ="total_averate_rate";
           $symbol = "";
          
         }elseif($x == 6){
               $name = "labour_cost";
           $total ="total_labour_cost";
           $symbol = "$";
          
         }elseif($x == 7){
                $name = "labour_percent";
           $total ="total_percentage";  
            $symbol = "";
          
         }
          }

       $writer = new Xlsx($spreadsheet); 
        $filename = 'Reports data';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
	    
	    
	}
	
	
}
