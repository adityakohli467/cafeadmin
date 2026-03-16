<?php
class General_model extends CI_Model{
	function __construct() {
	parent::__construct();
	date_default_timezone_set('Australia/Melbourne');
	}
	
	function getBranchAccess($user_id, $i=null){
	   // echo $user_id;
	    //exit;
		$this->db->select('branches_access.branch_id,customer_branches.branch_name');
		$this->db->from('branches_access');
		$this->db->join('customer_branches','branches_access.branch_id = customer_branches.branch_id');
		$this->db->where('branches_access.customer_user_id',$user_id);
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
		function getAllBranchDetails($i=null){
		  
		$this->db->select('*');
		$this->db->from('customer_branches');
		$query=$this->db->get();
// 	echo $this->db->last_query();
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
			$this->getBranchDetails($i);
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
  
  	public function getBranchOrders($filterData,$i=null){
		
// 		echo "<pre>";
// 		print_r($filterData);
// 		exit;

		
		$sql = "SELECT SUM(o.order_total) as total,o.order_status, s.supplier_name FROM `orders` o JOIN suppliers s ON o.supplier_id = s.supplier_id Where o.status = 1 AND o.branch_id=".$filterData['branch_id'];
		
		if(isset($filterData['supplier_id'])){
		    $sql .= " AND o.supplier_id=".$filterData['supplier_id'];
		}

		if(isset($filterData['order_status'])){
		    $sql .= " AND o.order_status=".$filterData['order_status'];
		  
		}
		if(isset($filterData['fromDate']) && isset($filterData['toDate'])){
		    $fromDate = $filterData['fromDate'];
		    $toDate = $filterData['toDate'];
		  $sql .= " AND o.order_date BETWEEN '".$fromDate."' AND '".$toDate."'";
		}

		$query = $this->db->query($sql);
// 		echo $this->db->last_query(); exit;
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
		    
		  //  echo "<pre>";
		  //  print_r($query->result());
		  //  exit;
			return $query->result_array();
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
	public function get_branch_suppliers($branchId,$i=null){
	    
		$customerId = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('supplier_branch_access');
		$this->db->where('branch_id',$branchId);
		$this->db->where('customer_id',$customerId);
	
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
			$this->get_branch_suppliers($branchId,$i);
		}else{
			return $query->result();
		}
	}
	public function edit_suppliers($id,$i=null){
		$this->db->select('s.*,c.category_id,c.category_name,u.group_id,g.name');
		$this->db->from('suppliers as s');
		$this->db->join('supplier_categories as c','c.category_id = s.category_id');
		$this->db->join('customer_users_groups as u','s.updated_by = u.user_id');
		$this->db->join('customer_groups as g','u.group_id = g.id');
		$this->db->where('s.supplier_id',$id);
		$this->db->where('s.status',1);
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
			$this->edit_suppliers($id,$i);
		}else{
			return $query->result();
		}
	}
}
?>