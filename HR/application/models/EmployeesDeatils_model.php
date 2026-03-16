<?php
class EmployeesDeatils_model extends CI_Model{
	
	public function get_total($table_name) 
    {
        return $this->db->count_all($table_name);
    }
 
	public function add_data_to_tble($table_name,$data=array()){
	    $this->db->insert($table_name,$data);
		 $insert_id = $this->db->insert_id();
		 
		 return  $insert_id;
	}
	public function delete_row($table_name,$unique_id_col_name,$unique_id_col_val){
	    $this->db->where($unique_id_col_name,$unique_id_col_val);   
		$this->db->delete($table_name);
	}
		public function fetch_column($table_name,$col_name,$where){
	    	$this->db->select($col_name);
			$this->db->from($table_name); 
			 $this->db->where('applicants_details_id',$where);
			 	$query = $this->db->get();
			 		return $query->result_array();
	}
	
// 	public function fetch_data($params,$i=null){

// 	   $table_name = $params['table_name'];
// 	   $limit = $params['limit'];  $start = $params['start']; $branch_id = $params['branch_id']; $role_id = $params['role_id'];  $type =  $params['type']; $emp_id = $params['emp_id'];
// 		if($table_name == "timesheet"){
// 		$this->db->distinct();   
// 		$this->db->select('timesheet.timesheet_id,timesheet.timesheet_name,roster.start_date,roster.end_date,timesheet.roster_group_id,multiple_roster_group_id');
// 		$this->db->from($table_name);   
// 		$this->db->join('roster', 'timesheet.roster_group_id = roster.roster_group_id','left'); 
// 		if($this->session->userdata('role') == 'employee'){
// 		   $this->db->join('employee_timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id'); 
// 		   $id = $this->session->userdata('UserId');
// 		   $this->db->where('employee_timesheet.employee_id',$id); 
// 		}
// 		 $this->db->where('timesheet.status',1);
// 		}else{
// 		$this->db->select('*'); 
// 		$this->db->from($table_name);
// 		}
// 		$this->db->limit($limit, $start);
// 		if($type =='employee'){
// 		$this->db->where('emp_id',$branch_id); 
// 		}elseif($type =='memo'){
// 		    if($table_name=='document'){
// 		      $this->db->where('role',$role_id);  
// 		      $this->db->or_where('role', "14");
// 		       $this->db->where('branch_id',$branch_id);
// 		    }else{
// 		  //   echo $branch_id; exit;
// 		    $this->db->where('role',$role_id); 
// 		    $this->db->or_where('role', "14"); 
		   
// 		    if($emp_id !=''){ 
// 		        $this->db->where('emp_id',$emp_id);
// 		        $this->db->or_where('emp_id',0);
// 		        }else{ 
// 		      $this->db->or_where('role', "14"); 
// 		      }
// 		       $this->db->where('branch_id',$branch_id);
// 		    }
// 			}else{
		    
// 		if($table_name == "timesheet"){
// 		    $this->db->where('timesheet.branch_id',$branch_id);
// 		}else{
// 		    $this->db->where('branch_id',$branch_id);
// 		}
// 			}
		
// 		$this->db->order_by($table_name.'_id',"DESC");
	
// 		$query = $this->db->get();
		 
// 		$errors = $this->db->error();

// 		if($errors['code'] != 0){
// 			if($i == null){
// 				$i = 1;
// 			}else{
// 				$i = $i+1;
// 			}
			
// 			if($i == 5){
// 				show_error('error '+$i);
// 			}
// 			sleep(5);
// 			$this->fetch_data($table_name,$branch_id,$limit,$start,$i=null);
// 		}else{
		   
// 			return $query->result();
// 		}
	    
// 	}

public function fetch_data($params, $i = null) {

    $table_name = $params['table_name'];
    $limit = $params['limit'];
    $start = $params['start'];
    $branch_id = $params['branch_id'];
    $role_id = $params['role_id'];
    $type = $params['type'];
    $emp_id = $params['emp_id'];

    if ($table_name == "timesheet") {
        $this->db->distinct();
        $this->db->select('timesheet.timesheet_id, timesheet.timesheet_name, roster.start_date, roster.end_date, timesheet.roster_group_id, multiple_roster_group_id');
        $this->db->from($table_name);
        $this->db->join('roster', 'timesheet.roster_group_id = roster.roster_group_id', 'left');
        if ($this->session->userdata('role') == 'employee') {
            $this->db->join('employee_timesheet', 'employee_timesheet.timesheet_id = timesheet.timesheet_id');
            $id = $this->session->userdata('UserId');
            $this->db->where('employee_timesheet.employee_id', $id);
        }
        $this->db->where('timesheet.status', 1);
    } else {
        $this->db->select('*');
        $this->db->from($table_name);
    }

    $this->db->limit($limit, $start);

    if ($type == 'employee') {
        $this->db->where('emp_id', $branch_id);
    } elseif ($type == 'memo') {
        if ($table_name == 'document') {
            $this->db->where('role', $role_id);
            $this->db->or_where('role', "14");
            $this->db->where('branch_id', $branch_id);
        } else {
            $this->db->where('role', $role_id);
            $this->db->or_where('role', "14");

            if ($emp_id != '') {
                $this->db->where('emp_id', $emp_id);
                $this->db->or_where('emp_id', 0);
            } else {
                $this->db->or_where('role', "14");
            }
            $this->db->where('branch_id', $branch_id);
        }
    } else {
        if ($table_name == "timesheet") {
            $this->db->where('timesheet.branch_id', $branch_id);
        } else {
            $this->db->where('branch_id', $branch_id);
        }
    }

    $this->db->order_by($table_name . '_id', "DESC");

    $query = $this->db->get();

    // Print the query
    // echo $this->db->last_query(); exit;

    $errors = $this->db->error();

    if ($errors['code'] != 0) {
        if ($i == null) {
            $i = 1;
        } else {
            $i = $i + 1;
        }

        if ($i == 5) {
            show_error('error ' + $i);
        }
        sleep(5);
        $this->fetch_data($params, $i);
    } else {
        return $query->result();
    }
}

	
    public function verify_pin($emp_pin,$emp_id) 
    {
         $this->db->select('*');
		$this->db->from('employee');
		$this->db->where('emp_id',$emp_id);
		$this->db->where('pin',$emp_pin);
		$result = $this->db->get();
	
       if ($result->num_rows() > 0) {
        return "verified";
       } else {
         return "Notverified";
         }
    }
	
	public function get_record_from_table($table_name,$id){
	    
	     $this->db->select('*');
		$this->db->from($table_name);
	
		$this->db->where($table_name.'_id',$id);
	
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
			$this->fetch_data($table_name,$branch_id,$limit,$start,$i=null);
		}else{
		   
			return $query->result();
		}
	
	    
	}
	
	public function update_table($table_name,$id,$data=array()){
	   
	    $this->db->where($table_name.'_id',$id);
	  
		 return $this->db->update($table_name,$data);
	}
		public function update_employee_timesheet($id,$data=array()){
	   
	    $this->db->where('timesheet_id',$id);
	  
		 return $this->db->update('employee_timesheet',$data);
	}
	
	function timesheet_filters($start_date,$end_date,$branch_id,$timesheet_name,$exEmployee,$type,$i=null){
	  	if((isset($start_date) && $start_date !='unset') || (isset($end_date) && $end_date !='unset')){
		    
		   $roster_group_ids = $this->fetch_rostergroup_id($start_date,$end_date,$branch_id);
		}
       

		$this->db->select('timesheet.timesheet_id,timesheet.timesheet_name,roster.start_date,roster.end_date,timesheet.roster_group_id,timesheet.multiple_roster_group_id');
	    $this->db->from('timesheet');
		$this->db->join('roster', 'timesheet.roster_group_id = roster.roster_group_id'); 
		

		
	   if(isset($timesheet_name) && $timesheet_name !='unset'){
// 		$this->db->where('timesheet.timesheet_name',$timesheet_name);
    //   echo $timesheet_name; exit;
      $this->db->like('timesheet.timesheet_name', $timesheet_name);
	
	   }
	   	if(!empty($roster_group_ids)){
		foreach($roster_group_ids as $roster_group_id){
		    $this->db->or_where('timesheet.roster_group_id', $roster_group_id->roster_group_id); 
		}
	}
	
	   if($exEmployee != '' && $exEmployee != 'unset'){
	       $this->db->or_where('roster.emp_id',$exEmployee);
	      
	   }
		   
	
	   $this->db->where('timesheet.branch_id',$branch_id);
       	$this->db->group_by("timesheet.timesheet_id");
       	$query = $this->db->get();
       	return $query->result();
       	
	}
	function fetch_rostergroup_id($start_date,$end_date,$branch_id){
	    
	       $this->db->select('roster_group_id');
		     $this->db->from('roster');  
		     
		     
		 if(isset($start_date) && $start_date !='unset'){
		    $myinput=$start_date;
		    $start_date=date('Y-m-d',strtotime($myinput)); 
		    $this->db->where('start_date >=',$start_date);
		    
		}
	
		if(isset($end_date) && $end_date !='unset'){
		     $myinput=$end_date;
		     $end_date=date('Y-m-d',strtotime($myinput)); 
		    $this->db->where('end_date <=',$end_date);
		    
		}
		 $this->db->where('branch_id',$branch_id);
		 	$this->db->group_by("roster_group_id");
  	   $query = $this->db->get();
  	   
  	   return (array)$query->result();
  	   
  	 
		
	    
	}
	
	public function get_approved_timesheet($i=null){
	    
	    $branch_id = $this->session->userdata('branch_id');
	    
	    $this->db->select('employee_timesheet.in_time,employee_timesheet.out_time,employee_timesheet.break_in_time,employee_timesheet.break_out_time,employee_timesheet.in_verify,employee_timesheet.timesheet_id,employee_timesheet.roster_id,employee_timesheet.date,employee.first_name,employee.last_name');
		$this->db->from('employee_timesheet');
	    $this->db->join('employee', 'employee.emp_id = employee_timesheet.employee_id','left');
	    $this->db->join('timesheet', 'timesheet.timesheet_id = employee_timesheet.timesheet_id','left');
		$this->db->where('timesheet.branch_id',$branch_id);
		$this->db->where('employee_timesheet.in_verify',1);
		
		
	
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
			$this->get_approved_timesheet($i=null);
		}else{
		   
			return $query->result();
		}
	
	    
	}
	
	public function get_approved_timesheet_timedifference($roster_id,$emp_ts_id,$i=null){
	  
	    $this->db->select('TIMEDIFF(out_time, in_time) as in_out_diff ,TIMEDIFF(break_out_time, break_in_time) as break_diff,employee_timesheet_id');
		$this->db->from('employee_timesheet');
	   
		$this->db->where('roster_id',$roster_id);
		$this->db->where('employee_timesheet_id',$emp_ts_id);
		
		
	
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
			$this->get_approved_timesheet_timedifference($roster_id,$i=null);
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
	
}