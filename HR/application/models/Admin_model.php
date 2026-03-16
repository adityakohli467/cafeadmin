<?php
class Admin_model extends CI_Model{
	protected $table = 'roster';
	
	public function checkAuth()
	{
	    $id = $this->session->userdata('UserId');

		$this->db->select('status');
		$this->db->from('employee');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
// 		echo $this->db->last_query();
		return $query->result();
	}
	
	public function fetch_employee_for_timsheet_bulk($roster_ids, $branch_id = '') {
   
    
         $outletname = date("l")."_layout";
	   
	   	$this->db->select('employee.emp_id,employee.first_name,employee.last_name,employee.fingerprint_auth_status,roster.roster_id,roster.'.$outletname.' as outlet_name');
		$this->db->from('roster');
	     $this->db->join('employee', 'roster.emp_id = employee.emp_id');
		$this->db->where_in('roster.roster_group_id', $roster_ids);
		if($branch_id != ''){
		    $this->db->where('roster.branch_id', $branch_id);
		}
		$this->db->order_by('employee.first_name',"ASC");
	   $query = $this->db->get();
	   return $query->result();
   }
    public function get_timesheet_bulk($emp_ids, $timesheet_id, $date) {
    $this->db->select('employee_id, roster_id, in_time, out_time, break_in_time, break_out_time');
    $this->db->from('employee_timesheet');
    $this->db->where_in('employee_id', $emp_ids);
    $this->db->where('timesheet_id', $timesheet_id);
    $this->db->where('date', $date);
    return $this->db->get()->result();
   }
   
   public function get_shifts_bulk($roster_ids, $dayname_column) {
   
        $this->db->select('roster_id, '.$dayname_column);
		$this->db->from('roster');
		$this->db->where_in('roster_id', $roster_ids);
		$query = $this->db->get();
		return $query->result();
   }


	
	public function get_employees($i=null){
		$this->db->select('*');
		$this->db->from('employee');
		$query = $this->db->get();
		$this->db->where('status',1);
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_employees($i);
		}else{
			return $query->result();
		}
	}
	
	public function give_branch_access_employee($branchAccessData){
	       $this->db->insert('branches_access', $branchAccessData);  
	}
	
	public function getbranch_manager_email($branchID,$i=null){
	  
	    $this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('branch_id',$branchID);
		$query = $this->db->get();
		$errors = $this->db->error();
		
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->getbranch_manager_email($i);
		}else{
			return $query->result();
		}
	}
	
	function submitResume($data,$resume_id,$type=''){
	    
	   if($resume_id == '' || $type == 'create'){
	    $this->db->insert('resumes',$data);   
	   }else{
	    $this->db->where('resume_id',$resume_id);
		$this->db->update('resumes',$data);
	   }
	    
	    return true;
	}
	public function get_resumes($resume_id='',$dataFilter=''){
	    
	    $branch_id = $this->session->userdata('branch_id');
		$this->db->select('*');
		$this->db->from('resumes');
		
		if($resume_id != ''){
		    $this->db->where('resume_id',$resume_id);
		    
		}
		if(isset($dataFilter['candidate_name']) && $dataFilter['candidate_name'] != ''){
           $this->db->like('candidate_name',$dataFilter['candidate_name']);
        }
        if(isset($dataFilter['phone']) && $dataFilter['phone'] != ''){
           $this->db->like('phone',$dataFilter['phone']);
        }
        if(isset($dataFilter['email']) && $dataFilter['email'] != ''){
            $this->db->like('email',$dataFilter['email']);
        }
		$this->db->where('branch_id',$branch_id);
		$query = $this->db->get();
		return $query->result();
		
	}	
	public function resume_del($resume_id){
	    
		$this->db->where('resume_id',$resume_id);
		return $this->db->delete('resumes');

	}
	function post_job($job_data,$id='',$type=''){
	    
	   if($id =='' || $type =='recreate'){
	    $this->db->insert('careers',$job_data);   
	   }else{
	      $this->db->where('id',$id);
		$this->db->update('careers',$job_data);
	   }
	    
	    return true;
	}
	
	function update_job_status($data,$id){
		 $this->db->where('id',$id);
		 return $this->db->update('careers',$data);
	}
	function update_interview_status($data,$id){
			 $this->db->where('interview_assesment_id',$id);
		 return $this->db->update('interview_assesment',$data);
	}
	function delete_job($id){
		$this->db->where('id',$id);
		return $this->db->delete('careers');
	}

	public function get_public_holidays($i=null){
		$this->db->select('date,branch_ids');
		$this->db->from('public_holidays');
			$this->db->where('status',1);
		$query = $this->db->get();
	
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_public_holidays($i);
		}else{
			return $query->result();
		}
	}
	
public function fetch_manager_notifications(){
		 $branch_id = $this->session->userdata('branch_id');
		
		$table ='notification';
		$condition = ' send_to ="manager" AND  status = 1 AND branch_id ='.$branch_id;
		$query = $this->db->query('SELECT * FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition." order by id desc");
			return $query->result();
	}
public function fetch_notifications_count(){
     $branch_id = $this->session->userdata('branch_id');
		
		$table ='notification';
		$condition = ' send_to ="manager" AND status = 1 AND branch_id ='.$branch_id;
		$query = $this->db->query('SELECT COUNT(id) as total_count FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
	
			return $query->result_array();
}
	
	public function fetch_notifications_count_emp(){
		 $emp_id = $this->session->userdata('UserId');
		
		$table ='notification';
		$condition = ' send_to = "employee" AND status = 1 AND emp_id ='.$emp_id;
		$query = $this->db->query('SELECT COUNT(id) as total_count FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
			return $query->result_array();
	}
	
public function fetch_employee_notifications(){
		 $emp_id = $this->session->userdata('UserId');

		$table ='notification';
		$condition = ' send_to ="employee" AND status = 1 AND emp_id ='.$emp_id;
         $query = $this->db->query('SELECT * FROM '.$table.'  WHERE `date_added` BETWEEN DATE_SUB(NOW(), INTERVAL 16 DAY) AND NOW() AND '.$condition);
       
       
			return $query->result();
	}
	
	function employee_roster_reports($start_date='',$end_date='',$empID=''){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->db->select('*');
		$this->db->from('roster');
	  
	    $this->db->where('emp_id',$empID);
	     if($start_date !=''){
	    $this->db->where('start_date >=',$start_date);
	     }
	    if($end_date !=''){
	       $this->db->where('start_date <=',$end_date);   
	    }
	  $query = $this->db->get();
	  return $query->result();		
	}
	
	
   function roster_weekly_reports($start_date,$end_date, $i=null){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->db->select('*');
		$this->db->from('weekly_roster_report');
	
	    $this->db->where('branch_id',$branch_id);
	    $this->db->where('start_date',$start_date);
	       $this->db->where('end_date',$end_date);
	    
	    
		    $query = $this->db->get();
		    $errors = $this->db->error();
		
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->roster_weekly_reports('','',$i);
		}else{
			return $query->result();
		}		
	}
	
	function save_weekly_report($start_date,$end_date,$week_roster_name,$report_data){
	    $branch_id = $this->session->userdata('branch_id');
	    $data  = array(
	       'start_date' => $start_date,
	       'end_date' => $end_date,
	       'branch_id' => $branch_id,
	       'roster_data' => serialize($report_data)
	        );
	    $this->db->insert('weekly_roster_report',$data);
	    return true;
	}
	
	function add_notification($data){
	    	$this->load->model('employees_model');
	   $branch_result = $this->employees_model->get_emp_update($data['emp_id']);

			foreach($branch_result as $row){
				$branchId = $row->branch_id;
			}
			
	$data['branch_id'] = $branchId;
	   if($this->db->insert('notification',$data)){
	         return true;
	   }else{
	    return true;
	   }
	 
	}
	
	public function week_roster($id='',$emp_id='',$filter=false,$i=null){ 
         $this->db->select('*');
		$this->db->from('roster');
	if($filter == true){
	    
	    $this->db->where_in('roster_group_id',$id);
	  $this->db->where('emp_id',$emp_id); 
		
	}else{
	 $this->db->where('roster_group_id',$id);
		$role = $this->session->userdata('role');	
		if($role =="employee"){
		    $this->db->where('emp_id',$emp_id);
		}   
	}
		
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->week_roster($id,$emp_id,$i);
		}else{
			return $query->result();
		}		
	}
	public function week_roster_beta($id='',$emp_id='',$filter=false,$i=null){ 
         $this->db->select('*');
		$this->db->from('roster');
		$this->db->join('employee', 'roster.emp_id = employee.emp_id ','left');
		$this->db->join('role', 'employee.role = role.role_id ','left');
	if($filter == true){
	    
	    $this->db->where_in('roster.roster_group_id',$id);
	  $this->db->where('roster.emp_id',$emp_id); 
		
	}else{
	 $this->db->where('roster.roster_group_id',$id);
		$role = $this->session->userdata('role');	
		if($role =="employee"){
		    $this->db->where('employee.emp_id',$emp_id);
		}   
	}
	$this->db->order_by("roster.roster_department", "asc");	
		$query = $this->db->get();
		
			return $query->result();		
	}
		public function week_roster_betaNew($id='',$emp_id='',$filter=false,$i=null){ 
         $this->db->select('roster.*,employee.emp_id,employee.first_name,employee.last_name,employee.department,employee.role,employee.employee_type,employee.email');
		$this->db->from('roster');
		$this->db->join('employee', 'roster.emp_id = employee.emp_id ','left');
		$this->db->join('role', 'employee.role = role.role_id ','left');
	if($filter == true){
	    
	    $this->db->where_in('roster.roster_group_id',$id);
	  $this->db->where('roster.emp_id',$emp_id); 
		
	}else{
	 $this->db->where('roster.roster_group_id',$id);
		$role = $this->session->userdata('role');	
		if($role =="employee"){
		    $this->db->where('employee.emp_id',$emp_id);
		}   
	}
	$this->db->order_by("employee.first_name", "asc");	
		$query = $this->db->get();
		
			return $query->result();		
	}
	public function check_shift($roster_id,$dayname){
	    
	  
	     $this->db->select($dayname);
		 $this->db->from('roster');
	    $this->db->where('roster_id',$roster_id);
	
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function verify_roster_branch($roster_id, $branch_id){
	    $this->db->select('roster_id');
	    $this->db->from('roster');
	    $this->db->where('roster_id', $roster_id);
	    $this->db->where('branch_id', $branch_id);
	    return $this->db->get()->num_rows() > 0;
	}
	
	public function fetch_role($branch_id,$i=null){
		$this->db->select('*');
		$this->db->from('role');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_role($branch_id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function get_disbaled_employees($branch_id){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('branch_id',$branch_id);
        $this->db->where('status',0);
		$this->db->order_by('first_name','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_employees_branchwise($branch_id, $type = '', $id = '', $field_name = '', $fieldsToFetch = '*') {
    // Select fields
    $this->db->select($fieldsToFetch);
    $this->db->from('employee');

    // Common conditions for 'admin' and 'manager'
    if ($type == 'admin' || $type == 'manager') {
        $this->db->where('branch_id', $branch_id);
        $this->db->where('status', 1);
    } else {
        // For other types, assume $branch_id refers to emp_id
        $this->db->where('emp_id', $branch_id);
        $this->db->where('status', 1);
    }

    // Check if $id is provided and not empty
    if (!empty($id)) {
        $this->db->where($field_name, $id);
    }

    // Order results by first name
    $this->db->order_by('first_name', 'ASC');
    
    // Execute query
    $query = $this->db->get();

    return $query->result();
}

	
	public function filter_get_employees_branchwise($branch_id='',$name='',$phone='',$email='',$i=null){
	 
	    	$this->db->select('*');
		$this->db->from('employee');
		if(isset($name) && $name !='unset'){
		    $this->db->like('first_name', $name);
		    
		}
		if(isset($email) && $email !='unset'){
		   
		    $this->db->where('email',$email);
		}
		if(isset($phone) && $phone !='unset'){
		    
		    $this->db->where('phone',$phone);
		}
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->filter_get_employees_branchwise($branch_id,$name,$phone,$email,$i);
		}else{
			return $query->result();
		}
	    
	}
	
	public function filter_get_disabled_employees_branchwise($branch_id='',$name='',$phone='',$email='',$i=null){
	 
	    	$this->db->select('*');
		$this->db->from('employee');
		if(isset($name) && $name !='unset'){
		    $this->db->like('first_name', $name);
		    
		}
		if(isset($email) && $email !='unset'){
		   
		    $this->db->where('email',$email);
		}
		if(isset($phone) && $phone !='unset'){
		    
		    $this->db->where('phone',$phone);
		}
		$this->db->where('branch_id',$branch_id);
		$this->db->where('status',0);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->filter_get_disabled_employees_branchwise($branch_id,$name,$phone,$email,$i);
		}else{
			return $query->result();
		}
	    
	}
	function add_employee($data){
	    
		 $this->db->insert('employee',$data);
		 $insert_id = $this->db->insert_id();
		 $data2=array(
			'id' => $insert_id,
			);
		 $this->db->insert('emp_uniform',$data2);
		 return  $insert_id;
	}
	
    function add_report($data){
	    
		 $this->db->insert('reports',$data);
		 $insert_id = $this->db->insert_id();
// 		 $data2=array(
// 			'id' => $insert_id,
// 			);
// 		 $this->db->insert('emp_uniform',$data2);
		 return  $insert_id;
	}
	
	function add_role($data){
	    
		 $this->db->insert('role',$data);
		 $insert_id = $this->db->insert_id();
		 
		 return  $insert_id;
	}
	
	function add_user($data_user){
	    $this->db->insert('customer_users',$data_user);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	function user_group_insert($data_user_groups){
	    $this->db->insert('customer_users_groups',$data_user_groups);
	}
	public function get_emp_update($id,$i=null){
	   
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
		
	
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_emp_update($id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function get_emp_uniform($id,$i=null){
	   
		$this->db->select('*');
		$this->db->from('emp_uniform');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_emp_update($id,$i);
		}else{
			return $query->result();
		}
	}
	
	function update_employee($data_user,$id){
		 $this->db->where('emp_id',$id);
		 return $this->db->update('employee',$data_user);
	}
	
	function update_employee_uniform($data_user,$id){
	    
		$this->db->where('id',$id);
        $q = $this->db->get('emp_uniform');

        if ( $q->num_rows() > 0 ) 
       {
         $this->db->where('id',$id);
         $this->db->update('emp_uniform',$data_user);
        } else {
        $this->db->set('id', $id);
        $this->db->insert('emp_uniform',$data_user);
        }

	}
	
	function update_employee_job_desc($data_job_desc,$id){
		 $this->db->where('emp_id',$id);
		 
	
		 return $this->db->update('employee',$data_job_desc);
	}
	
	function update_complete_roster($data,$roster_id){

		$this->db->where('roster_id',$roster_id);
		return $this->db->update('roster',$data);
	}
	
	function update_user($id,$data_user,$branch_data=array()){
	 
	 	$this->db->where('customer_user_id',$id);
		$this->db->delete('branches_access');
	     
	    foreach($branch_data as $bd){
	      $data2 = array(
	     'branch_id' => $bd,
	     'customer_user_id' => $id
	     );
	 
	 $this->db->insert('branches_access',$data2);  
	    }
		 $this->db->where('customer_user_id',$id);
		 
		
		 return $this->db->update('customer_users',$data_user);
	}
	
	function update_branch($id,$data_user){
		 $this->db->where('branch_id',$id);
		 return $this->db->update('customer_branches',$data_user);
	}
	
	function employee_delete($id){
		$this->db->where('emp_id',$id);
		$this->db->delete('employee');
	}
	
	function user_delete($id){
	  
		$this->db->where('customer_user_id',$id);
		$this->db->delete('customer_users');
	}
	
	function role_delete($id){
	  
		$this->db->where('role_id',$id);
		$this->db->delete('role');
	}
	
	function add_branch($data){
	    
	 $this->db->insert('customer_branches',$data);
	 
	 $data2 = array(
	     'branch_id' => $this->db->insert_id(),
	     'customer_user_id' => $this->session->userdata('user_id')
	     );
	 
	 $this->db->insert('branches_access',$data2);
	 return true;
	 
	}
	function branch_delete($id){
	 
	  
	    $this->db->where('branch_id',$id);
		$this->db->delete('branches_access');
		
		$this->db->where('branch_id',$id);
		$this->db->delete('customer_branches');
	}
	
	function fetch_users($user_id = '',$i=null){
	   $branch_id = $this->session->userdata('branch_id');
	   $this->db->select('*');
	   $this->db->from('customer_users');
	   if(isset($user_id) && $user_id !=''){
	     $this->db->where('customer_user_id',$user_id);  
	   }
	      
	    $this->db->where('branch_id',$branch_id); 
	   $query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_users('',$i);
		}else{
			return $query->result();
		}
	    
	}
	function fetch_careers($id=''){
	   $branch_id = $this->session->userdata('branch_id');
	   $this->db->select('*');
	   $this->db->from('careers');
	   if($id !=''){
	    $this->db->where('id',$id);   
	   }
	   $this->db->where('branch_id',$branch_id); 
	  $this->db->order_by('id','DESC');
	   $query = $this->db->get();
		return $query->result();
	    
	}
	
	function fetch_applications($id=''){
	  
	     $branch_id = $this->session->userdata('branch_id');
	   $this->db->select('applicants_details.*,careers.job_name,careers.start_date');
	   $this->db->from('applicants_details');
	   $this->db->join('careers', 'applicants_details.job_id = careers.id ','left');
	   if($id !=''){
	    $this->db->where('applicants_details.applicants_details_id',$id);   
	   }
	   $this->db->where('applicants_details.branch_id',$branch_id); 
	   // $this->db->where('applicants_details.status',1); 
	  $this->db->order_by('applicants_details.applicants_details_id','DESC');
	   $query = $this->db->get();
	    return $query->result();
	 if($query !== FALSE && $query->num_rows() == 1) // if the affected number of rows is one
     {
      return $query->result();
     }
     else
    {
      return true;
    }
	}
	
	function fetch_roles($user_id = '',$i=null){
	    $branch_id = $this->session->userdata('branch_id');
	   $this->db->select('*');
	   $this->db->from('role');
	    $this->db->where('branch_id',$branch_id); 
	   $query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_roles('',$i);
		}else{
			return $query->result();
		}
	    
	}
	
	function fetch_branches($branch_id = '',$i=null){
	    
	   $this->db->select('*');
	   $this->db->from('customer_branches');
	   if(isset($branch_id) && $branch_id !=''){
	     $this->db->where('branch_id',$branch_id);  
	   }
	 
	   $query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_branches('',$i);
		}else{
			return $query->result();
		}
	    
	}
	function fetch_branches_basedonuser($i=null){
	  
	   $this->db->select('*');
	   $this->db->from('customer_branches');
	   $this->db->join('branches_access', 'branches_access.branch_id = customer_branches.branch_id','left');
	   $this->db->where('branches_access.customer_user_id',$this->session->userdata('user_id'));
	 
	   $query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_branches_basedonuser($i);
		}else{
			return $query->result();
		}
	    
	}
	function get_user_status($user_id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_users');
		$this->db->where('customer_user_id',$user_id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_user_status($user_id,$i);
		}else{
			return $query->result();
		}
	}
	function get_emp_details($emp_id,$i=null){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id',$emp_id);
		$this->db->order_by('first_name','ASC');
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_emp_details($emp_id,$i);
		}else{
			return $query->result();
		}
	}
	function add_induction_form($data,$emp_id){
		$this->db->where('emp_id',$emp_id);
		return $this->db->update('employee',$data);
	}
	function status_update($data_user,$user_id){
		$this->db->where('customer_user_id',$user_id);
		return $this->db->update('customer_users',$data_user);
	}
	function get_email($id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_users');
		$this->db->where('customer_user_id',$id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_email($id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_employee_timesheet($id,$i=null){
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_employee_timesheet($id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_timesheet($id='',$timesheet_id='',$date='',$roster_id='',$i=null){

		$this->db->select('*');
		$this->db->from('employee_timesheet');
		if(isset($date) && $date !=''){
		 $this->db->where('date',$date); 
		}
		if(isset($id) && $id !=''){
		 $this->db->where('employee_id',$id);   
		}
		if(isset($timesheet_id) && $timesheet_id !=''){
		    $this->db->where('timesheet_id',$timesheet_id);
		}
		
		
		if($roster_id !=''){
		    $this->db->where('roster_id',$roster_id);
		}
		
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_timesheet($id,$roster_id,$date,$roster_id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_all_timesheet($branch_id='',$future='',$i=null){
	    
	    $currentDate = date('Y-m-d');
        $thisMonday = date('Y-m-d', strtotime('monday this week', strtotime($currentDate)));
        $thisSunday = date('Y-m-d', strtotime('sunday this week', strtotime($currentDate)));

		$this->db->distinct();
		$this->db->select('timesheet.*,roster.start_date,roster.end_date');
		$this->db->from('timesheet');
		$this->db->join('roster', 'roster.roster_group_id = timesheet.roster_group_id','left');
		$this->db->where('timesheet.branch_id',$branch_id);
		$this->db->where('timesheet.status',1);
		$this->db->where('timesheet.roster_group_id !=', 0);
	   	$todays_date = date('Y-m-d');
	   	 // check this thing
	   //	  $this->db->where('roster.start_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
	   	  
	   	if($future !=''){
// 		 $this->db->where('roster.end_date >= ',$todays_date); commented on 15-07-2024
         $this->db->where('roster.start_date', $thisMonday);
         $this->db->where('roster.end_date', $thisSunday);
	   	}
		
// 		 $this->db->where('roster.start_date >=',$todays_date);
		 $this->db->order_by('roster.start_date',"ASC");
	
	
		$query = $this->db->get();
	
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_all_timesheet($branch_id,$i);
		}else{
		return $query->result();
		}
	}
	
	public function getthis_timesheet_details($timesheet_id,$roster_id,$type){
	    
	    
		$this->db->select($type);
		$this->db->from('employee_timesheet');
		$this->db->where('roster_id',$roster_id);
		$this->db->where('timesheet_id',$timesheet_id);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	public function get_timesheet_id($id,$i=null){
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('employee_timesheet');
		$this->db->where('date',$date);
		$this->db->where('timesheet_id',$id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_timesheet_id($id,$i);
		}else{
			return $query->result();
		}
	}
	function submit_employee_timesheet($data){
		 return $this->db->insert('employee_timesheet',$data);
	}
	
  public function get_timesheet_nameby_id($timesheet_id){
      $this->db->select('timesheet_name');
		$this->db->from('timesheet');
		$this->db->where('timesheet_id',$timesheet_id);
			$query = $this->db->get();
			return $query->result();
  }
  
    public function get_timesheet_by_roster_group_id($roster_group_id){
      $this->db->select('timesheet_id');
		$this->db->from('employee_timesheet');
		$this->db->where('roster_group_id',$roster_group_id);
		$this->db->where('status',1);
			$this->db->where('timesheet_id !=',0);
			$query = $this->db->get();
			return $query->result();
  }
	
	
	function fetch_emp_idofthisroster($roster_group_id){
	    
	    $this->db->select('emp_id,start_date,end_date');
		 $this->db->from('roster');
	    $this->db->where('roster_group_id',$roster_group_id);
	
		$query = $this->db->get();
		
		return $query->result();
	}
	function update_employee_timesheet($data_out,$timesheet_id,$roster_id,$outlet=''){
	    
	    if(isset($timesheet_id) && $timesheet_id !=''){
	       $this->db->where('timesheet_id',$timesheet_id); 
	    }
	    $date = date('Y-m-d');
	    
	    $this->db->where('date = ', $date);
	    
		$this->db->where('roster_id',$roster_id);
	     
	    
		return $this->db->update('employee_timesheet',$data_out);
	}	
	function update_employee_timesheet_emps($prev_emp,$emp_id,$timesheet_id){
	    $data = array(
	        'employee_id' => $emp_id,
	        );
	       
	    
	    if($prev_emp !='' && $timesheet_id !=''){
	       $this->db->where('employee_id',$prev_emp); 
	  
	       $this->db->where('timesheet_id',$timesheet_id); 
	        return $this->db->update('employee_timesheet',$data);
	       
	    }
	    
		
	}
	
	function update_employee_timesheet_data($data_out,$employee_timesheet_id){
	    
	 $this->db->where('employee_timesheet_id',$employee_timesheet_id); 
	    
	 return $this->db->update('employee_timesheet',$data_out);
	}
	
	public function check_insert_or_update($emp_id,$timesheet_id,$date){
	    $this->db->select('*');
		$this->db->from('employee_timesheet');
		$this->db->where('date',$date);
		$this->db->where('timesheet_id',$timesheet_id);
		$this->db->where('employee_id',$emp_id);
		$query = $this->db->get();
		
			$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->check_insert_or_update($emp_id,$timesheet_id,$date);
		}else{
			return "found";
		}
	
	    
	}
	function add_job_applicant($data){
		return $this->db->insert('job_application',$data);
	}
	function getleaves($params,$i=''){
	    
	  
	    $branch_id = $this->session->userdata('branch_id');
		$this->db->select('leave_management.*, employee.first_name');
		$this->db->from('leave_management');
		$this->db->join('employee', 'leave_management.emp_id = employee.emp_id');
		$this->db->where('leave_management.branch_id',$branch_id);
		
			if(!empty($params))
		     {
		       if(isset($params['first_name'])){
		    
		        $this->db->like('employee.first_name',$params['first_name']);
		      } 
		    
           if(isset($params['start_date'])){
		     $this->db->where('leave_management.start_date',$params['start_date']);   
		    }
		    
		  
	
		     if(isset($params['status'])){
		     $this->db->where('leave_management.leave_status',$params['status']);   
		    }
			
		    
		}
	
		$this->db->order_by('leave_id',"DESC");
		$query = $this->db->get();
		
		
		
		$errors = $this->db->error();
	
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->getleaves($params,$i);
		}else{
			return $query->result();
		}
		
			
	}
	function get_leaves($i=null){

		$branch_id = $this->session->userdata('branch_id');
		
		$this->db->select('leave_management.*, employee.first_name');
		$this->db->from('leave_management');
		$this->db->join('employee', 'leave_management.emp_id = employee.emp_id');
		$this->db->where('leave_management.branch_id',$branch_id);
		$this->db->order_by('leave_management.leave_id',"desc");
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_leaves($i);
		}else{
			return $query->result();
		}
		
	}
	
	function get_leavesdate_all_emps($emp_id,$start_date,$end_date,$i=''){

	    $branch_id = $this->session->userdata('branch_id');
		$this->db->select('leave_management.start_date,leave_management.end_date');
		$this->db->from('leave_management');
		$this->db->where('leave_management.branch_id',$branch_id);
		$this->db->where('leave_management.leave_status','Approve');
		$this->db->where('leave_management.emp_id',$emp_id);
		
		
		$query = $this->db->get();
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_leavesdate_all_emps($emp_id,$start_date,$end_date);
		}else{
			return $query->result();
		}
	}
	function get_leaves_manager_update($id,$i=null){
	    
        $this->db->select('*');
		$this->db->from('leave_management');
		$this->db->where('leave_id',$id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_leaves_manager_update($id,$i);
		}else{
			return $query->result();
		}
		
	}
	function update_leave_manager($data,$leave_id){
		$this->db->where('leave_id',$leave_id);
		return $this->db->update('leave_management',$data);
	}
	function insert_roster($data){
		  $this->db->insert('roster',$data);
		  $insert_id = $this->db->insert_id();
          return  $insert_id;
	}
	function update_rostergroup_id($roster_id){
	    $data = array(
	        'roster_group_id' => $this->session->userdata('rostergroup_id')
	        );
	    $this->db->where('roster_id',$roster_id);
		return $this->db->update('roster',$data);
	}
	function get_employees_roster($branch_id='',$future='',$i=null){
	     $this->db->distinct();
         $this->db->select('roster_group_id,start_date,end_date,roster_name');
		 $this->db->from('roster');
	
		if(isset($branch_id) && $branch_id != ''){
		   
		 $this->db->where('branch_id',$branch_id);
		 $todays_date = date('Y-m-d');
		if($future !=''){
		  //$this->db->where('roster.start_date ');
		     $this->db->where('roster.end_date >=',$todays_date);
		}else{
		    $this->db->where('start_date BETWEEN DATE_SUB(NOW(), INTERVAL 21 DAY) AND NOW()');
		}
		 
		 
		}
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_employees_roster($branch_id,$future,$i);
		}else{
			return $query->result();
		}
		
	}
	function get_emp_roster($id,$roster_group_id='',$i=null){
         $this->db->select('*');
		$this->db->from('roster');
		if($roster_group_id !=''){
		   $this->db->where('roster_group_id',$roster_group_id); 
		}else{
		   $this->db->where('emp_id',$id); 
		}
		
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_emp_roster($id,$roster_group_id,$i);
		}else{
			return $query->result();
		}		
	}
	
				// start 6Jan 2021 work
				
				
// 	function get_emps_roster_week($emp_id,$start_date,$end_date,$i=''){
// 	     $this->db->select('DISTINCT(emp_id)');
// 		$this->db->from('roster');
		
// 		if($start_date !='' && $end_date !=''){
// 		    $condition = "(start_date BETWEEN '" . $start_date . "'" . " AND " . "'" . $end_date . "' or end_date BETWEEN '" . $start_date . "'" . " AND '" . $end_date . "')";
// 		   $this->db->where($condition); 
// 		}
// 		if($emp_id !=''){
// 		   $this->db->where('emp_id',$emp_id); 
// 		}
		
// 		$query = $this->db->get();
// 		 	$errors = $this->db->error();
// 		if($errors['code'] != 0){
// 			if($i == null){
// 				$i = 1;
// 			}else{
// 				$i = $i+1;
// 			}
			
// 			if($i == 5){
// 				show_error('error '+$i);
// 			}
// 			log_message('error', 'DB error in Admin_model');
// 			$this->get_emps_roster_week($emp_id,$start_date,$end_date);
// 		}else{
// 			return $query->result();
// 		}
		 
// 	}
// function get_emps_roster_week_time($emp_id,$start_date,$end_date,$i=''){
// 	     $this->db->select('*');
// 		$this->db->from('roster');
		
// 		if($start_date !='' && $end_date !=''){
// 		    $condition = "(start_date BETWEEN '" . $start_date . "'" . " AND " . "'" . $end_date . "' or end_date BETWEEN '" . $start_date . "'" . " AND '" . $end_date . "')";
// 		   $this->db->where($condition); 
// 		}
// 		if($emp_id !=''){
// 		   $this->db->where('emp_id',$emp_id); 
// 		}
		
// 		$query = $this->db->get();
// 		 	$errors = $this->db->error();
// 		if($errors['code'] != 0){
// 			if($i == null){
// 				$i = 1;
// 			}else{
// 				$i = $i+1;
// 			}
			
// 			if($i == 5){
// 				show_error('error '+$i);
// 			}
// 			log_message('error', 'DB error in Admin_model');
// 			$this->get_emps_roster_week($emp_id,$start_date,$end_date);
// 		}else{
// 			return $query->result();
// 		}
		 
// 	}
			// End 6Jan 2021 work
	
	function update_roster($data,$roster_id){
		$this->db->where('roster_group_id',$roster_id);
		return $this->db->update('roster',$data);
	}
	function delete_roster($id,$emp_id=""){
	   
		$this->db->where('roster_group_id',$id);
		if($emp_id !=''){
		$this->db->where('emp_id',$emp_id);   
		}
		$this->db->delete('roster');
	}
	
	function delete_document($id,$emp_id=""){
	   
		$this->db->where('document_id',$id);
		if($emp_id !=''){
		$this->db->where('emp_id',$emp_id);   
		}
		$this->db->delete('document');
	}
	public function delete_single_roster($roster_group_id,$roster_id){
	    
	    $this->db->where('roster_group_id',$roster_group_id);
	
		$this->db->where('roster_id',$roster_id);   

		$this->db->delete('roster');
		
		// delete this roster from timesheet also when updating
		

		$this->db->where('roster_id',$roster_id);   

		$this->db->delete('employee_timesheet');
		
		
		
		
	}
	
	public function fetch_employee_for_timsheet($roster_group_id, $branch_id = ''){
	    
	 
	   $outletname = date("l")."_layout";
	   
	   	$this->db->select('employee.emp_id,employee.first_name,employee.last_name,employee.fingerprint_auth_status,roster.roster_id,roster.'.$outletname.' as outlet_name');
		$this->db->from('roster');
	     $this->db->join('employee', 'roster.emp_id = employee.emp_id');
		$this->db->where('roster.roster_group_id',$roster_group_id);
		if($branch_id != ''){
		    $this->db->where('roster.branch_id', $branch_id);
		}
		$this->db->order_by('employee.first_name',"ASC");
	   $query = $this->db->get();
	   $errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_employee_for_timsheet($roster_group_id);
		}else{
		    
		   
			return $query->result();
		}
	}
	
	 public function get_roster_weeks_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }
	public function get_roster_weeks($id,$type='',$dash='',$limit='', $start='',$i=null){
	    
       $this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('roster');
		$this->db->group_by("roster_group_id");
			if($type == 'admin'){
		 $this->db->where('branch_id',$id);   
		}
		elseif($type == 'roster_mail'){
		   
		    $this->db->where('roster_group_id',$id);
		 }else{
		  $this->db->where('emp_id',$id);
		  $this->db->where('roster_status',1);
		}
		if($dash != '')
        {
         $this->db->limit(4);
         }		
		$this->db->order_by('start_date',"DESC");
	
		$query = $this->db->get();
		
	
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_roster_weeks($id,$type='',$dash,$i);
		}else{
		   
			return $query->result();
		}
	}
	
		public function get_roster_weekss($id,$type='',$dash='',$limit='', $start='',$i=null){
	    
       $this->db->limit($limit, $start);
    //   $this->db->group_by("roster_group_id");
		$this->db->select('*');
// 		
		$this->db->from('roster');
		$this->db->group_by("roster_group_id");
		if($type == 'admin'){
		 $this->db->where('branch_id',$id);   
		}
	
		$this->db->order_by('start_date',"DESC");
	
		$query = $this->db->get();
	return $query->result();
	}
	
		public function get_dashboard_roster($id,$type='',$dash=''){
	    
		
		$this->db->select('DISTINCT(roster_group_id),roster_id, start_date,end_date,roster_name');
       $this->db->group_by('roster_group_id'); 
	
		$query = $this->db->get('roster');
		if($dash != '')
       {
         $this->db->limit(4);
      }		
        
		$this->db->order_by('start_date',"DESC");
	
		
		
	return $query->result();
	}
	
	public function get_total($table_name,$id,$type) 
    {
        if($type == 'employee'){
             $this->db->where('emp_id',$id); 
		   
		}else{
		   $this->db->where('branch_id',$id); 
		}
        $this->db->from($table_name);
        return $this->db->count_all_results();      
       
    }
	
	function get_emp_details_fieldwise($emp_id,$fieldname='rate',$find_byemail=''){
	    
	    $this->db->select($fieldname);
        
		$this->db->from('employee');
		$this->db->where('status',1);
		if($find_byemail == ''){
		    $this->db->where('emp_id',$emp_id);
		}else{
		    // here emp_id has email id not emp id
		    $this->db->where('email',$emp_id);
		}
		
		
		
		$query = $this->db->get();
	
     if(isset($query->result()[0]->$fieldname) && !empty($query->result()[0]->$fieldname)){
           return $query->result()[0]->$fieldname;
       }else{
           
           return '';
       }
	
		
	}
	
	
		function get_emp_details_fromemail($empemail_id){
	    
	    $this->db->select('emp_id');
        
		$this->db->from('employee');
		
		$this->db->where('email',$empemail_id);
		
		
		$query = $this->db->get();
	
     if(isset($query->result()[0]->emp_id) && !empty($query->result()[0]->emp_id)){
           return $query->result()[0]->emp_id;
       }else{
           
           return '';
       }
	
		
	}
		function week_hour_worked_price($rate,$roster_id,$emp_id){
		    
		   
		    
         $this->db->select('TIMESTAMPDIFF( MINUTE , mon_start_time, mon_end_time ) * ( '.$rate.' / 60 ) as mon');
         $this->db->select('TIMESTAMPDIFF( MINUTE , tues_start_time, tues_end_time ) * ( '.$rate.' / 60 ) as tues');
          $this->db->select('TIMESTAMPDIFF( MINUTE , wed_start_time, wed_end_time ) * ( '.$rate.' / 60 ) as wed');
          $this->db->select('TIMESTAMPDIFF( MINUTE , thus_start_time, thus_end_time ) * ( '.$rate.' / 60 ) as thus');
            $this->db->select('TIMESTAMPDIFF( MINUTE , fri_start_time, fri_end_time ) * ( '.$rate.' / 60 ) as fri'); 
            $this->db->select('TIMESTAMPDIFF( MINUTE , sat_start_time, sat_end_time ) * ( '.$rate.' / 60 ) as sat');
            $this->db->select('TIMESTAMPDIFF( MINUTE , sun_start_time, sun_end_time ) * ( '.$rate.' / 60 ) as sun');
		$this->db->from('roster');
		
		$this->db->where('roster_id',$roster_id);
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get();
		
	return $query->result();
		

		
 
	
		
	}
	
		function week_hour_break($roster_id,$emp_id){
		    
         $this->db->select('sum(mon_break_time + tues_break_time + wed_break_time +	thus_break_time + fri_break_time + sat_break_time + sun_break_time) as total_break');
        
		$this->db->from('roster');
		
		$this->db->where('roster_id',$roster_id);
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get();
	
       if(isset($query->result()[0]->total_break) && !empty($query->result()[0]->total_break)){
           return $query->result()[0]->total_break;
       }else{
           
           return '';
       }
				
	}
	
	function roster_filter($start_date,$end_date,$branch_id,$roster_name,$type,$i=null){
	    
	     $this->db->select('*');
		$this->db->from('roster');
		if($type=='employee'){
		   $this->db->where('emp_id',$branch_id);
		}else{
		  $this->db->where('branch_id',$branch_id);
		}
	
	
		
		
		if(isset($start_date) && $start_date !='unset'){
		    $myinput=$start_date; $start_date=date('Y-m-d',strtotime($myinput)); 
		    $this->db->where('start_date >=',$start_date);
		    
		}
		if(isset($end_date) && $end_date !='unset'){
		     $myinput=$end_date; $end_date=date('Y-m-d',strtotime($myinput)); 
		    $this->db->where('end_date <=',$end_date);
		    
		}

		
		if(isset($roster_name) && $roster_name !='unset'){
		     
		    $this->db->where('roster_name',$roster_name);
		    
		}
		$this->db->group_by("roster_group_id");
		$query = $this->db->get();
		
		  
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->roster_filter($start_date,$end_date,$roster_name,$branch_id,$i);
		}else{
			return $query->result();
			
		}		
	}
	
	
		function roster_filter_for_report($start_date,$end_date,$branch_id){
	    
	     $this->db->select('*');
		$this->db->from('roster');
		$this->db->where('branch_id',$branch_id);
	
	   if(isset($start_date) && $start_date !=''){
		    $myinput=$start_date; 
		    $start_date=date('Y-m-d',strtotime($myinput));
		   
		    $this->db->where('start_date =',$start_date);
		    
		}
		if(isset($end_date) && $end_date !=''){
		     $myinput2=$end_date; 
		     
		     $end_date=date('Y-m-d',strtotime($myinput2)); 
		   
		    $this->db->where('end_date =',$end_date);
		    
		}
    //   $this->db->group_by("roster_group_id");
   
		$query = $this->db->get();
		
			return $query->result();		
	}
	function fetch_reports($i=null){ 
	     $branch_id = $this->session->userdata('branch_id');
        $this->db->select('*');
		$this->db->from('reports');
	    $this->db->where('branch_id',$branch_id);
	    $this->db->order_by('report_id','DESC');
		$query = $this->db->get();
		$errors = $this->db->error();
		
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_reports($i);
		}else{
			return $query->result();
		}		
	}
		function report_filter($start_date,$end_date, $i=null){ 
		    
	     $branch_id = $this->session->userdata('branch_id');
	     
        $this->db->select('*');
		$this->db->from('reports');
	
	    $this->db->where('branch_id',$branch_id);
	    
	    if(isset($start_date) && $start_date !=''){
		    $myinput=$start_date; 
		    $start_date=date('Y-m-d',strtotime($myinput));
		   
		    //$this->db->where('start_date =',$start_date);
		    
		}
		if(isset($end_date) && $end_date !=''){
		     $myinput2=$end_date; 
		     
		     $end_date=date('Y-m-d',strtotime($myinput2)); 
		   
		  // $this->db->where('end_date =',$end_date);
		    
		}
           $condition = "start_date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'"." or end_date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
            
	        $this->db->where($condition);
		    $query = $this->db->get();
		    $errors = $this->db->error();
		
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_reports($i);
		}else{
			return $query->result();
		}		
	}
	function view_details_reports($report_id='',$i=null){ 
	     
        $this->db->select('*');
		$this->db->from('reports');
		if(isset($report_id) && $report_id !=''){
		 $this->db->where('report_id',$report_id);   
		}
	    
		$query = $this->db->get();
		$errors = $this->db->error();
		
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_reports($i);
		}else{
		  
			return (array)$query->result();
		}		
	}
	function emp_roster($date,$branch_id='',$i=null){
         $this->db->select('*');
		$this->db->from('roster');
		$this->db->where('start_date',$date);
		if(isset($branch_id) && $branch_id !=''){
		  $this->db->where('branch_id',$branch_id);  
		}
		
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->emp_roster($date,$branch_id,$i);
		}else{
			return $query->result();
		}
		
	}
	function fetch_rosterfrom_roster_id($roster_id='',$i=null){
         $this->db->select('*');
		$this->db->from('roster');
		$this->db->where('roster_id',$roster_id);
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->fetch_rosterfrom_roster_id($roster_id,$i);
		}else{
			return $query->result();
		}
		
	}
	
		public function get_employeesbyrole($role_id,$i=null){
		$this->db->select('*');
		$this->db->from('employee');
		$branch_id = $this->session->userdata('branch_id');
		 $this->db->where('branch_id',$branch_id);
		$this->db->where('status',1);
		
     	if($role_id !='all'){
	     $this->db->where('role',$role_id);
	    }
		$this->db->order_by('first_name','ASC');
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_employeesbyrole($role_id,$i);
		}else{
			return $query->result();
		}
	}
	public function fetch_emp_role($emp_id,$i=null){
	    
	    $branch_id = $this->session->userdata('branch_id');
	    
		$this->db->select('employee.role,role.role_name');
		$this->db->from('employee');
		$this->db->join('role', 'employee.role = role.role_id ','left');
		$this->db->where('employee.branch_id',$branch_id);
		$this->db->where('employee.status',1);
	    $this->db->where('employee.emp_id',$emp_id);
	 
		$query = $this->db->get();
		
		$errors = $this->db->error();
		if($errors['code'] != 0){
			if($i == null){
				$i = 1;
			}else{
				$i = $i+1;
			}
			
			if($i == 5){
				show_error('error '+$i);
			}
			log_message('error', 'DB error in Admin_model');
			$this->get_employeesbyrole($role_id,$i);
		}else{
			return $query->result();
		}
	}
	function save_survey($data){
		 return $this->db->insert('emp_survey',$data);
	}
	function get_survey($id){
		 $this->db->select('*');
		$this->db->from('emp_survey');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	function get_all_survey($branch_id){
		 $this->db->select('*');
		$this->db->from('emp_survey');
		
		$this->db->join('employee', 'emp_survey.emp_id = employee.emp_id ','left');
		$this->db->where('emp_survey.branch_id',$branch_id);
		$query = $this->db->get();
	
// 		echo $this->db->last_query();exit;
		return $query->result();
		 	
	}
	function email_view_update($id,$updateData){
	    
		 $this->db->where('emp_id',$id);
		 return $this->db->update('employee',$updateData);
	}
}