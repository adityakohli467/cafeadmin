<?php
class General_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	
	function getBranchAccess($user_id, $i=null){ 
		$this->db->select('branches_access.branch_id,customer_branches.branch_name');
		$this->db->from('branches_access');
		$this->db->join('customer_branches','branches_access.branch_id = customer_branches.branch_id');
		$this->db->where('branches_access.customer_user_id',$user_id);
		$this->db->where('customer_branches.status',1);
		$query=$this->db->get();
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
			$this->getBranchAccess($user_id, $i);
		}else{
				$result = $query->result();
				return $result;
			}
	}
	
		function getallBranches(){ 
		    
		$this->db->select('customer_branches.branch_id,customer_branches.branch_name');
		$this->db->from('customer_branches');
	    $this->db->where('status','1');
	
		$query=$this->db->get();
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
			$this->getallBranches($user_id, $i);
		}else{
				$result = $query->result();
				return $result;
			}
	}
	function getBranchDetails($branch_id,  $i=null){
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('branch_id',$branch_id);
		$query=$this->db->get();
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
			$this->getBranchDetails($branch_id, $i);
		}else{
			$result = $query->result();
			return $result;
			}
	}

    function get_modules($v3, $i=null){  
	  $this->db->select('*');
	  $this->db->from('modules');
	  $this->db->where('moduleId',$v3);
	  $query=$this->db->get();
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
			$this->get_modules($v3, $i);
			}else{
				  $res9=$query->result();
				return $res9;
			}
  }
	function get_modules_name($i=null){  
	  $this->db->select('*');
	  $this->db->from('modules');
	  $query=$this->db->get();
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
			$this->get_modules_name($i);
			}else{
				  $res10=$query->result();
				return $res10;
			}
  }
  
    

}
?>