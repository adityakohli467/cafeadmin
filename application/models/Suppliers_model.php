<?php
class Suppliers_model extends CI_Model{
	
	
	//Manage suppliers
	public function get_suppliers($i=null){
		$customerId = $this->session->userdata('customerId');
		$this->db->select('s.*,c.category_id,c.category_name,u.group_id,g.name');
		$this->db->from('suppliers as s');
		$this->db->join('supplier_categories as c','c.category_id = s.category_id');
		$this->db->join('customer_users_groups as u','s.updated_by = u.user_id');
		$this->db->join('customer_groups as g','u.group_id = g.id');
		$this->db->where('s.customer_id',$customerId);
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
			$this->get_suppliers($i);
		}else{
			return $query->result();
		}
	}
	function suppliers_delete($id,$i=null){
		$this->db->where('supplier_id',$id);
		$result = $this->db->delete('suppliers');
		
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
			$this->suppliers_delete($id,$i);
		}else{
			return $result;
		}
		
	}
	function submit_suppliers($data,$i=null){
		$res = $this->db->insert('suppliers',$data);
		$supplier_id = $this->db->insert_id();
		
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
			$this->submit_suppliers($data,$i);
		}else{
			return $supplier_id;
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
	public function supplier_items($id,$i=null){
		
		$user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$id);
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
			$this->supplier_items($id,$i);
		}else{
			return $query->result();
		}
	}
	public function update_suppliers($data,$id,$i=null){
		$this->db->where('supplier_id',$id);
		$result = $this->db->update('suppliers',$data);
		
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
			$this->update_suppliers($data,$id,$i);
		}else{
			return $result;
		}
		
	}
	public function cat_autoSearch($i=null){ 
		$user_id = $this->session->userdata('customerId');
		$this->db->select('category_id,category_name');
		$this->db->from('supplier_categories');
		$this->db->where('customer_id',$user_id);
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
			$this->cat_autoSearch($i);
		}else{
			$res = $query->result();
		    return $res;
		}
	}
	//Supplier Categories
	
	public function get_suppliers_cat($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('supplier_categories');
		$this->db->where('customer_id',$customer_id);
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
			$this->get_suppliers_cat($i);
		}else{
			return $query->result();
		}
	}
	
	function add_supp_cat($data,$i=null){
		$result = $this->db->insert('supplier_categories',$data);
		
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
			$this->add_supp_cat($data,$i);
		}else{
			return $result;
		}
		
	}
	public function edit_supp_cat($id,$i=null){
		$this->db->select('*');
		$this->db->from('supplier_categories');
		$this->db->where('category_id',$id);
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
			$this->edit_supp_cat($id,$i);
		}else{
			return $query->result();
		}
	}
	function update_supplier_category($data,$id,$i=null){
		$this->db->where('category_id',$id);
		$result = $this->db->update('supplier_categories',$data);
		
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
			$this->update_supplier_category($data,$id,$i);
		}else{
			return $result;
		}
		
	}
	function category_delete($id,$i=null){
		$this->db->where('category_id',$id);
		$result = $this->db->delete('supplier_categories');
		
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
			$this->category_delete($id,$i);
		}else{
			return $result;
		}
		
	}
	
	public function getBranches($i=null){
		$customerId = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('customer_branches');
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
			$this->getBranches($i);
		}else{
			return $query->result();
		}
	}
	function branches_checked_data($id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_branches');
		$this->db->where('branch_id',$id);
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
			$this->branches_checked_data($id,$i);
		}else{
			$result = $query->result();
		    return $result;
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
	
		public function get_suppliers_budget($branchId,$start_date='',$end_date='',$supplier_id='',$category=''){
	    
		$customerId = $this->session->userdata('customerId');
		$this->db->select('sb.*,s.*,sc.category_name');
	    $this->db->select('sb.*,s.*');
		$this->db->from('supplier_branch_access as sb');
		$this->db->join('suppliers as s','sb.supplier_id = s.supplier_id');
		$this->db->join('supplier_categories as sc','sc.category_id = s.category_id');
		$this->db->where('sb.branch_id',$branchId);
		$this->db->where('sb.customer_id',$customerId);
		if($supplier_id !=''){
		    
	     $this->db->where('sb.supplier_id',$supplier_id); 
	
		}
		
		if($category !=''){
		     $this->db->where('sc.category_id',$category); 
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
			sleep(5);
			$this->get_branch_suppliers($branchId,$i);
		}else{
			return $query->result();
		}
	}
	
	public function addSupplierBudget($data,$i=null){
		$result = $this->db->insert('supplier_branch_access',$data);
		
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
			$this->addSupplierBudget($data,$i);
		}else{
			return $result;
		}
		
	}
	
	public function getSupplierBranches($supId,$i=null){
		$this->db->select('*');
		$this->db->from('supplier_branch_access');
		$this->db->where('supplier_id',$supId);
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
			$this->getSupplierBranches($supId,$i);
		}else{
			return $query->result();
		}
	}
	
	public function deleteSupplierBranches($supId,$i=null){
		$this->db->where('supplier_id',$supId);
		$result = $this->db->delete('supplier_branch_access');
		
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
			$this->deleteSupplierBranches($supId,$i);
		}else{
			return $result;
		}
	}
	public function deleteSupplierSchedule($supId,$i=null){
		$this->db->where('supplier_id',$supId);
		$result = $this->db->delete('supplier_delivery_days');
		
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
			$this->deleteSupplierSchedule($supId,$i);
		}else{
			return $result;
		}
	}
	
	public function getUserGroupDetails($group_id,$i=null){
		$this->db->select('*');
		$this->db->from('customer_groups');
		$this->db->where('id',$group_id);
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
			$this->getUserGroupDetails($group_id,$i);
		}else{
			return $query->result();
		}
	}
	public function addDeliverySchedule($days){
		return $this->db->insert('supplier_delivery_days',$days);
	}
	
	public function getSupplierSchedule($supId,$i=null){
		$this->db->select('*');
		$this->db->from('supplier_delivery_days');
		$this->db->where('supplier_id',$supId);
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
			$this->getSupplierSchedule($supId,$i);
		}else{
			return $query->result();
		}
	}
	
	public function uploadBulkItems($data,$i=null){
		$result = $this->db->insert('items',$data);
		
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
			$this->uploadBulkItems($data,$i);
		}else{
			return $result;
		}
		
	}
	
	public function getItemCategories($i=null){
		$cId = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('customer_id',$cId);
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
			$this->getItemCategories($i);
		}else{
			return $query->result();
		}
	}
	
	public function createNewCategory($catName,$i=null){
		$data = array(
			'customer_id' => $this->session->userdata('customerId'),
			'category_name' => $catName,
			'date_added' => date('Y-m-d H:i:s'),
			'status'=> 1
		);
		$res = $this->db->insert('item_categories',$data);
		$result = $this->db->insert_id();
		
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
			$this->createNewCategory($catName,$i);
		}else{
			return $result;
		}
		
	}
}