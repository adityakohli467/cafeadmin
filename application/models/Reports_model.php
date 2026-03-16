<?php
class Reports_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}
	public function get_branch_suppliers($i=null){
		$customerId = $this->session->userdata('customerId');
		$branchId = $this->session->userdata('branch_id');
		$this->db->select('supplier_branch_access.*, suppliers.supplier_name');
		$this->db->from('supplier_branch_access');
		$this->db->join('suppliers','supplier_branch_access.supplier_id = suppliers.supplier_id');
		$this->db->where('supplier_branch_access.branch_id',$branchId);
		$this->db->where('supplier_branch_access.customer_id',$customerId);
		$this->db->order_by('suppliers.supplier_name','ASC');
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
			$this->get_branch_suppliers($i);
		}else{
			return $query->result();
		}
		
	}
	
	public function getItemCategories($i=null){
		$customerId = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('customer_id', $customerId);
		$this->db->order_by('item_categories.category_name','ASC');
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
			$this->getSupplierCategories($i);
		}else{
			return $query->result();
		}
	}
	
	
	// public function getBranchOrders($start_date,$end_date,$i=null){
	// 		$branch_id = $this->session->userdata('branch_id');
	// 		$this->db->select('orders.*, suppliers.supplier_name');
	// 		$this->db->from('orders');
	// 		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
	// 		$this->db->where('order_date >=', $start_date);
	// 		$this->db->where('order_date <=', $end_date);
	// 		$this->db->where('orders.branch_id',$branch_id);
	// 		$query = $this->db->get();
		
		
	// 	$errors = $this->db->error();
	// 	if($errors['code'] != 0){
	// 		if($i == null){
	// 			$i = 1;
	// 		}else{
	// 			$i = $i+1;
	// 		}
			
	// 		if($i == 5){
	// 			show_error('error '+$i);
	// 		}
	// 		sleep(5);
	// 		$this->getBranchOrders($start_date,$end_date,$i);
	// 	}else{
	// 		return $query->result();
	// 	}
	// }
	
	public function getBranchOrders($start_date,$end_date,$supId,$catId,$i=null){
		$branch_id = $this->session->userdata('branch_id');
		$where = "orders.branch_id = $branch_id ";
		$where .= " AND orders.status = 1 ";
		if($supId !=''){
			$where.="AND orders.supplier_id = $supId "; 
		}
		if($start_date !=''){
			$where.="AND order_date BETWEEN '$start_date' AND '$end_date'"; 
		}
		$query =$this->db->query("SELECT orders.*,suppliers.supplier_name FROM orders JOIN suppliers ON orders.supplier_id = suppliers.supplier_id WHERE $where ");
	    //$query = $this->db->get();
	    $res = $query->result();
	    
	    	
	    
	    return $res;  
	}
	
	public function purchase_orders_submit($start_date,$end_date,$supId,$status,$i=null){
		$branch_id = $this->session->userdata('branch_id');
		$where = "orders.branch_id = $branch_id ";
		
		$where .=" AND orders.status = 1 ";
		if($supId !=''){
			$where.="AND orders.supplier_id = $supId "; 
		}
		if($start_date !=''){
			$where.="AND orders.order_date BETWEEN '$start_date' AND '$end_date'"; 
		}
		if($status !=''){
			$where.="AND orders.order_status='".$status."'"; 
		}
		$query =$this->db->query("SELECT orders.*,suppliers.supplier_name,suppliers.category_id,supplier_categories.category_name FROM orders JOIN suppliers ON orders.supplier_id = suppliers.supplier_id JOIN supplier_categories ON suppliers.category_id = supplier_categories.category_id WHERE $where ");
	    //$query = $this->db->get();
	    $res = $query->result();
	    return $res;  
	}
	
	public function getOrderItemDetails($id, $i=null){
		$this->db->select('order_details.*,items.itemName,items.price,items.uom');
		$this->db->from('order_details');
		$this->db->join('items','order_details.item_id=items.itemId');
		$this->db->where('order_details.order_id',$id);
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
			$this->getOrderItemDetails($id, $i);
		}else{
			return $query->result();
		}
	}
	public function getOrderItems($id, $i=null){
		$this->db->select('*');
		$this->db->from('order_details');
		$this->db->where('order_id',$id);
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
			$this->getOrderItems($id, $i);
		}else{
			$result = $query->result();
				return $result;
			exit;
			$itemDetails = array();
			if(!empty($result)){
				foreach($result as $key=>$res){
					if($res->item_id == 0){
						$m = 1;
						$price = ($res->amount/$res->quantity);
						$result[$key]->uom = 'pcs';
						$result[$key]->price = $price;
						$result[$key]->item_id = 'N'.$m;
						$itemDetails = $result;
						$m++;
					}else{
					    
					   
						$res = $this->getOrderItemDetails($id);
						$result[$key] = $res[0];
						
						 
						$itemDetails = $result;
					
						
					}
				}
			}
			
			
			return $result;
// 			return $itemDetails;
		}
	}
	
	public function getOrderItems_for_supplier($id, $i=null){
		$this->db->select('amount,order_id,quantity');
		$this->db->from('order_details');
		$this->db->where('order_id',$id);
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
			$this->getOrderItems_for_supplier($id, $i);
		}else{
			$result = $query->result();
				return $result;
			exit;
			$itemDetails = array();
			if(!empty($result)){
				foreach($result as $key=>$res){
					if($res->item_id == 0){
						$m = 1;
						$price = ($res->amount/$res->quantity);
						$result[$key]->uom = 'pcs';
						$result[$key]->price = $price;
						$result[$key]->item_id = 'N'.$m;
						$itemDetails = $result;
						$m++;
					}else{
					    
					   
						$res = $this->getOrderItemDetails($id);
						$result[$key] = $res[0];
						
						 
						$itemDetails = $result;
					
						
					}
				}
			}
			
			
			return $result;
// 			return $itemDetails;
		}
	}
	
	public function get_order_supplier_cat($sup_id){
		
		$query=$this->db->query("SELECT suppliers.category_id, supplier_categories.category_name FROM suppliers INNER JOIN supplier_categories ON suppliers.category_id = supplier_categories.category_id WHERE suppliers.supplier_id='.$sup_id.'");
		$res = $query->result();
		return $res;
	}
	public function getOrderItemsCategory($order_id){
		$this->db->select('*');
		$this->db->from('order_details');
		$this->db->where('order_id',$order_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getOrderItemCategory($itemId){
		$this->db->select('items.*,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.itemId',$itemId);
		$query = $this->db->get();
		return $query->result();
	}
    public function get_detail(){
		$this->db->select('*');
		$this->db->from('order_details');
		$query = $this->db->get();
		return $query->result();
	}
	
}
?>