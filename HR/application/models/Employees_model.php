<?php
class Employees_model extends CI_Model{
	
	
	//Manage suppliers
	
	public function get_employees($i=null){
		$this->db->select('*');
		$this->db->from('employee');
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
			sleep(5);
			$this->get_employees($i);
		}else{
			return $query->result();
		}
	}
	
		public function employeeIDfromName($field_name,$where){
	    $branch_id = $this->session->userdata('branch_id');
	   // echo "SELECT emp_id FROM employee where branch_id =".$branch_id." AND status =1 AND ".$field_name."LIKE '%".$where."%'";  exit;
	   $query = $this->db->query("SELECT emp_id FROM employee where branch_id =".$branch_id."  AND ".$field_name." LIKE '%".$where."%'");
	  return $query->result();

	}
	
		public function employeeIDfromNameAndType($data){
	    $branch_id = $this->session->userdata('branch_id');
	  
	   //echo "SELECT emp_id FROM employee where branch_id =".$branch_id." AND status =1 AND `first_name` LIKE '%".$data['emp_name']."%' OR `last_name` LIKE '%".$data['emp_name']."%' AND `employee_type` LIKE '%".$data['employee_type']."%'"; exit;
	   $query = $this->db->query("SELECT emp_id FROM employee where branch_id =".$branch_id." AND status = 1 AND `employee_type` LIKE '%".$data['employee_type']."%' AND `first_name` LIKE '%".$data['emp_name']."%' OR `last_name` LIKE '%".$data['emp_name']."%'");
	  return $query->result();

	}
	public function employeeIDTimesheetStatus($timesheet_id='',$roster_group_id='',$where=''){
// 	 echo "SELECT employee_id FROM employee_timesheet where timesheet_id =".$timesheet_id." AND roster_group_id =".$roster_group_id." AND in_verify =".$where; exit;
	    $query = $this->db->query("SELECT distinct employee_id FROM employee_timesheet where timesheet_id =".$timesheet_id." AND  in_verify =".$where);
        return $query->result();

	}

	
	function add_employee($data){
		 $this->db->insert('employee',$data);
		 $insert_id = $this->db->insert_id();
		 return  $insert_id;
	}
	
	function add_user($data_user){
	    $this->db->insert('customer_users',$data_user);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	public function fetch_employee_availability($emp_id){
	   
    
		$this->db->select('emp_availability');
		$this->db->from('employee');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get();
		return $query->result();
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
			sleep(5);
			$this->get_emp_update($id,$i);
		}else{
			return $query->result();
		}
	}
	
	function update_employee($data,$id){
		 $this->db->where('emp_id',$id);
		 return $this->db->update('employee',$data);
	}
	
	function update_employee_availability($EmpId,$avail_data){
	    $data['emp_availability'] = serialize($avail_data);
	    $this->db->where('emp_id',$EmpId);
		 return $this->db->update('employee',$data);
	}
	
	function update_user($data_user,$id){
		 $this->db->where('customer_id',$id);
		 return $this->db->update('customer_users',$data_user);
	}
	
	function employee_delete($id){
	   $emps = $this->get_emp_details($id);
       $email = $emps[0]->email.'_ex';
       
	    $status = array(
	        'email' => $email,
		    'status' => 0
		 );
	
		 $this->db->where('emp_id',$id);
// 		 $this->db->delete('employee');
		 $this->db->update('employee',$status);
		 
		 echo "deleted";
	}
	function revert_deleted_emp($id){
	   
	   $emps = $this->get_emp_details($id);
       $email = substr($emps[0]->email,0,-3);
         
	    $status = array(
    	    'email' => $email,
    	    'status' => 1
    	);
	
		 $this->db->where('emp_id',$id);
// 		 $this->db->delete('employee');
		 $this->db->update('employee',$status);
		 
		 echo "revert";
	}
	
	function leave_delete($id){
		 $this->db->where('leave_id',$id);
		 $this->db->delete('leave_management');
		 echo "deleted";
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
			sleep(5);
			$this->get_user_status($user_id,$i);
		}else{
			return $query->result();
		}
	}
	function get_emp_details($emp_id,$i=null){
	    
	  
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id',$emp_id);
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
			sleep(5);
			$this->get_emp_details($emp_id,$i);
		}else{
			return $query->result();
		}
	}
	
	 function get_roster_weeks($emp_id='',$branch_id=''){
	    
		$this->db->select('*');
		$this->db->from('roster');
		$this->db->where('emp_id',$emp_id);
		$this->db->where('branch_id',$branch_id);
		   
		 
		$this->db->order_by('roster_id',"ASC");
		
		$query = $this->db->get();
		    
		    
		return $query->result();
		    
		    
	
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
			sleep(5);
			$this->get_email($id,$i);
		}else{
			return $query->result();
		}
	}
	
	

	public function get_employee_timesheet($id,$roster_group_id='',$i=null){
	    //fetch all in and out of this employee for a particular roster week(this date to that date)
	     $user_email = $this->session->userdata('user_email');
	    $emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
	    
		$this->db->select('employee_timesheet.*,CONCAT(employee.first_name, '.', employee.last_name) AS employee_name');
		$this->db->from('employee_timesheet');
		$this->db->join('employee', 'employee_timesheet.employee_id = employee.emp_id');
         $this->db->where('employee_timesheet.timesheet_id',$id);
         $this->db->where('employee_timesheet.employee_id',$emp_id);
// 		$this->db->where('employee_timesheet.roster_group_id',$roster_group_id);
		$this->db->order_by("date", "ASC");
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
			sleep(5);
			$this->get_employee_timesheet($id,$roster_group_id='',$i);
		}else{
			return $query->result_array();
		}
	}
		public function get_employee_timesheet_from_roster_id($id,$roster_id='',$i=null){
		    
		    
	    //fetch all in and out of this employee for a particular roster week(this date to that date)
		$this->db->select('employee_timesheet.*,CONCAT(employee.first_name, '.', employee.last_name) AS employee_name');
		$this->db->from('employee_timesheet');
		$this->db->join('employee', 'employee_timesheet.employee_id = employee.emp_id');
        $this->db->where('employee_timesheet.employee_id',$id);
		$this->db->where('employee_timesheet.roster_id',$roster_id);
		
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
			sleep(5);
		$this->get_employee_timesheet_from_roster_id($id,$roster_id='',$i);
		}else{
			return $query->result_array();
		}
	}
	
	public function get_emp_details_for_this_week($emp_id,$timesheet_id='',$i=null){
	    //fetch all in and out of this employee for a particular roster week(this date to that date)
	         
		$this->db->select('date');
		$this->db->from('employee_timesheet');
        $this->db->where('employee_id',$emp_id);
		$this->db->where('timesheet_id',$timesheet_id);
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
			sleep(5);
			$this->get_employee_timesheet($emp_id,$timesheet_id='',$i);
		}else{
			return $query->result();
		}
	}
	
	public function get_timesheetfor_multiple_roster($timesheet_id,$i=''){
	    
	     $this->db->distinct();    
		$this->db->select('multiple_roster_group_id');
		$this->db->from('timesheet');
		$this->db->where('timesheet_id',$timesheet_id);
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
			sleep(5);
			$this->get_timesheetfor_multiple_roster($timesheet_id,$i);
		}else{
			return $query->result();
		}
	}
	
    public function get_all_employeeid_ofthis_timesheet($timesheet_id,$roster_group_id,$i=null){
        
	    //fetch all in and out of this employee for a particular roster week(this date to that date)
	     $this->db->distinct();    
		$this->db->select('employee_id');
		$this->db->from('employee_timesheet');
        $this->db->where('roster_group_id',$roster_group_id);
		$this->db->where('timesheet_id',$timesheet_id);
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
			sleep(5);
			$this->get_all_employeeid_ofthis_timesheet($timesheet_id,$roster_group_id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_complete_employee_timesheet($id,$roster_group_id='',$filter_value=array()){
	    //fetch all in and out of this employee for a particular roster week(this date to that date)
	  
// 	  echo "<pre>";
// 	    print_r($filter_value);
// 	    exit;
		$this->db->select('employee_timesheet.*,CONCAT(employee.first_name,"  ",employee.last_name) AS employee_name');
		$this->db->from('employee_timesheet');
		$this->db->join('employee', 'employee_timesheet.employee_id = employee.emp_id');
	    $this->db->where('timesheet_id',$id);
	    if(!empty($filter_value) ){
	       // echo "Fd";
	  
	         $this->db->where_in('employee_timesheet.employee_id',$filter_value);
	    }
// 		$this->db->where('roster_group_id',$roster_group_id);
		$this->db->order_by("date", "ASC");
		$query = $this->db->get();
		
			return $query->result();
	}
	function submit_employee_timesheet($data){
		 $this->db->insert('employee_timesheet',$data);
		 $insert_id = $this->db->insert_id();
		 return  $insert_id;
	}
	public function update($data,$emp_id){
	   $this->db->insert('docs',$data);
	   
	    $this->db->select('*');
		$this->db->from('docs');
		$this->db->where('employee_id',$emp_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_docs($emp_id,$i=null){
		$this->db->select('*');
		$this->db->from('docs');
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
			sleep(5);
			$this->get_docs($emp_id,$i);
		}else{
			return $query->result();
		}
	}
		public function get_docs_name($id,$i=null){
		$this->db->select('*');
		$this->db->from('docs');
		$this->db->where('doc_id',$id);
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
			sleep(5);
			$this->get_docs_name($id,$i);
		}else{
			return $query->result();
		}
	}
	public function delete_doc($id){
	    $this->db->where('doc_id',$id);
		$this->db->delete('docs');
	}
	function add_induction_form($data,$emp_id){
		$this->db->where('emp_id',$emp_id);
		return $this->db->update('employee',$data);
	}
	function add_uniform($values){
      return $this->db->insert('employee_uniforms',$values);
	 }
	 
	 function getleaves($params,$emp_id,$i=''){
	     
	   
	  
	    $branch_id = $this->session->userdata('branch_id');
		$this->db->select('*');
		$this->db->from('leave_management');
		$this->db->where('leave_management.emp_id',$emp_id);
		
			if(!empty($params))
		     {
		         
		       if(isset($params['end_date'])){
		    
		        $this->db->where('leave_management.end_date',$params['end_date']);
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
			sleep(5);
			$this->getleaves($params,$emp_id,$i);
		}else{
			return $query->result();
		}
		
			
	}
	 function add_leave($data){
      return $this->db->insert('leave_management',$data);
	 }
	 function get_emp_leave_details($emp_id,$i=null){
		$this->db->select('*');
		$this->db->from('leave_management');
		$this->db->where('emp_id',$emp_id);
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
			sleep(5);
			$this->get_emp_leave_details($emp_id,$i);
		}else{
			return $query->result();
		}
	}
	function get_roster_emp($emp_id,$i=null){
		$this->db->select('*');
		$this->db->from('roster');
		$this->db->where('emp_id',$emp_id);
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
			sleep(5);
			$this->get_roster_emp($emp_id,$i);
		}else{
			return $query->result();
		}
	}
	public function get_employees_branchwise($branch_id,$i=null){
		$this->db->select('*');
		$this->db->from('employee');
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
			sleep(5);
			$this->get_employees($branch_id,$i);
		}else{
			return $query->result();
		}
	}
	
	function emp_week_roster($emp_id,$date,$i=null){
	    
        $this->db->select('*');
		$this->db->from('roster');
		$this->db->where('emp_id',$emp_id);
		$this->db->where('start_date',$date);
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
	    sleep(5);
	   $this->emp_week_roster($emp_id,$date,$i);
		}else{
	  return $query->result();
		}		
	}
	
}