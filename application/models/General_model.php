<?php
class General_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	
	function getBranchAccess($user_id, $i=null){
	   // echo $user_id;
	   // exit;
		$this->db->select('branches_access.branch_id,customer_branches.branch_name');
		$this->db->from('branches_access');
		$this->db->join('customer_branches','branches_access.branch_id = customer_branches.branch_id');
		$this->db->where('branches_access.customer_user_id',$user_id);
		$query=$this->db->get();
// 	echo	 $this->db->last_query(); exit;
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

  function select_employee_type($email, $i=null){
	  $this->db->select('id');
	  $this->db->from('com_users');
	  $this->db->where('email',$email);
	  $query=$this->db->get();
	  $res4=$query->result();
	  foreach($res4 as $a=>$b){
	  	$id=$b->id;
	  }
	  $this->db->select('moduleId');
	  $this->db->from('module_access');
	  $this->db->where('userId',$id);
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
			$this->select_employee_type($email, $i);
			}else{
				  $res1=$query->row_array();
				  //$res1=(array)$res1[0];
				  return $res1;
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
  
  	public function getBranchOrders($i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.status','1');
		$this->db->order_by('orders.order_id','DESC');
		$this->db->limit(5);
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
			$this->getBranchOrders($i);
			}else{
				return $query->result();
			}
	}
	
	public function getFavouriteOrders($i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.favourite_order',1);
		$this->db->order_by('orders.order_id','DESC');
		$this->db->limit(5);
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
			$this->getFavouriteOrders($i);
		}else{
			return $query->result();
		}
	}

}
?>