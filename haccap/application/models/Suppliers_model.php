<?php
class Suppliers_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}

    public function get_branch_suppliers($branchId,$i=null){
	    
		$customerId = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('supplier_branch_access');
		$this->db->where('branch_id',$branchId);
// 		$this->db->where('customer_id',$customerId);
	
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
	public function fetch_suppliers($id,$i=null){
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