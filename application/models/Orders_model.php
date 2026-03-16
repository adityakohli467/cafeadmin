<?php
class Orders_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	
	public function copy_supp($supp_id='',$branch_id){
	     $this->db->select('*');
		$this->db->from('supplier_branch_access');
		if(isset($supp_id) && $supp_id !='all'){
		   $this->db->where('supplier_id',$supp_id); 
		}
		$this->db->where('branch_id',$branch_id);
		$query = $this->db->get();
	   return	$br = $query->result();
	}
	
	public function insert_supp_details($data){
	    
	   $res = $this->db->insert('suppliers',$data);
	   $insert_id = $this->db->insert_id();

      return  $insert_id;
	}
	
	public function insert_supp($data){
	    
	   $res = $this->db->insert('supplier_branch_access',$data);
	   return true;
	}
	public function insert_item($data){
	   unset($data['order_id']); 
	 
	   unset($data['quantity']); 
	   unset($data['amount']); 
	    
	   $data['itemName'] = $data['item_name'];
	   unset($data['item_name']);
// 	  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	    $data['uom'] = 'pcs';
	  
	   $res = $this->db->insert('items',$data);
	   $insert_id = $this->db->insert_id();

      return  $insert_id;
	}

	
	public function getSuppliers($sup_id='',$i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('suppliers');
		if(isset($sup_id) && $sup_id !=''){
		   $this->db->where('supplier_id',$sup_id);
		}else{
		  $this->db->where('customer_id',$user_id);
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
			$this->getSuppliers($i);
		}else{
			return $query->result();
		}
	}
	
	public function getSupplierItems($supId, $i=null){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('supplierId',$supId);
			$this->db->order_by('items.product_sort_order', 'ASC');
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
			$this->getSupplierItems($supId,$i);
		}else{
			return $query->result();
		}
	}
	
	public function getAllSupplierItems($i=null){
		$this->db->select('items.*,suppliers.supplier_name');
		$this->db->from('items');
		$this->db->join('suppliers','items.supplierId = suppliers.supplier_id');
			$this->db->order_by('items.product_sort_order', 'ASC');
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
			$this->getAllSupplierItems($i);
		}else{
			return $query->result();
		}
		
	}
	public function get_all_branch_suppliers($id='',$i=null){
		$customerId = $this->session->userdata('customerId');
		$branchId = $this->session->userdata('branch_id');
		$this->db->select('supplier_branch_access.*, suppliers.supplier_name');
		$this->db->from('supplier_branch_access');
		$this->db->join('suppliers','supplier_branch_access.supplier_id = suppliers.supplier_id');
		
		if(isset($id) && $id !=''){
		     $this->db->where('supplier_branch_access.branch_id',$id); 
		}else{
		    	$this->db->where('supplier_branch_access.branch_id',$branchId);
		$this->db->where('supplier_branch_access.customer_id',$customerId);
		    
		}
	    
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
			$this->get_branch_suppliers($id='',$i);
		}else{
			return $query->result();
		}
		
	}
	
	public function get_branch_suppliers($id='',$i=null){
		$customerId = $this->session->userdata('customerId');
		$branchId = $this->session->userdata('branch_id');
		$this->db->select('supplier_branch_access.*, suppliers.supplier_name');
		$this->db->from('supplier_branch_access');
		$this->db->join('suppliers','supplier_branch_access.supplier_id = suppliers.supplier_id');
		
		if(isset($id) && $id !=''){
		     $this->db->where('supplier_branch_access.branch_id',$id); 
		}else{
		    	$this->db->where('supplier_branch_access.branch_id',$branchId);
		$this->db->where('supplier_branch_access.customer_id',$customerId);
		    
		}
	    $this->db->where('suppliers.status',1);
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
			$this->get_branch_suppliers($id='',$i);
		}else{
			return $query->result();
		}
		
	}
	public function supplier_items($id, $i=null){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.customer_id',$user_id);
			$this->db->where('items.status',1);
		$this->db->where('items.supplierId',$id);
		$this->db->group_by('items.itemName');
// 		$this->db->order_by('items.itemName','ASC');
       $this->db->order_by('items.product_sort_order', 'ASC');
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
	public function fetch_supplier_items_byname($supplier_id, $search){
	    
	    $user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$supplier_id);
		$this->db->like('items.itemName', $search, 'both'); 
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
			$this->fetch_supplier_items_byname($supplier_id, $search, $i);
		}else{
			return $query->result();
		}
		
	}
	public function supplier_items_cat($id,$catid, $i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$id);
		$this->db->where('item_categories.category_id',$catid);
		$this->db->order_by('items.product_sort_order', 'asc');
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
			$this->supplier_items_cat($id, $catid, $i);
		}else{
			return $query->result();
		}
		
	}
	public function supplier_items_users($id, $i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$id);
		$this->db->where('items.user_access','1');
		$this->db->where('items.status','1');
			$this->db->group_by('items.itemName');
// 		$this->db->order_by('items.itemName','ASC');
$this->db->order_by('items.product_sort_order', 'ASC');
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
			$this->supplier_items_users($id, $i);
		}else{
			return $query->result();
		}
		
	}
	public function supplier_items_cat_users($id,$catId, $i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$id);
		$this->db->where('item_categories.category_id',$catId);
		$this->db->where('items.user_access','1');
		$this->db->order_by('items.product_sort_order', 'ASC');
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
			$this->supplier_items_cat_users($id, $catId, $i);
		}else{
			return $query->result();
		}
		
	}
	
	public function placeOrder($data,$i=null){
		$res = $this->db->insert('orders',$data);
		$order_id = $this->db->insert_id();
		
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
			$this->placeOrder($data,$i);
		}else{
			return $order_id;
		}
	}
	public function placeOrderItems($details,$i=0){
	    
	  $result = $this->db->insert('order_details',$details);
		
		return $result;
		
	}
	
	public function get_supplier_details($supId, $i=null){
		$this->db->select('*');
		$this->db->from('suppliers');
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
			$this->get_supplier_details($supId, $i);
		}else{
			return $query->result();
		}
	}
	public function getUserGroupDetails($group_id, $i=null){
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
			$this->getUserGroupDetails($group_id, $i);
		}else{
			return $query->result();
		}
	}
		public function getBranchOrdersList($filterData,$order_status='',$i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.branch_id,orders.order_id,orders.order_date,orders.order_status,orders.delivery_date, orders.order_total,orders.supplier_id,orders.order_number,orders.supplier_comments,orders.mail_status, orders.approval_status,suppliers.supplier_name');
//   $this->db->select('orders.order_id, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.status',1);
		if($order_status !=''){
		  //  $this->db->where('orders.order_status !=',$order_status);
		     $this->db->where('orders.order_status =','Received');
		}
		
			
		if(isset($filterData['filterstatus'])){
		    $str = implode('","',$filterData['filterstatus']);
		    $this->db->where('orders.order_status in ("'.$str.'")');
		   
		}
// 		echo $str;
		if(isset($filterData['fromDate']) && isset($filterData['toDate'])){
		    $fromDate = $filterData['fromDate'];
		    $toDate = $filterData['toDate'];
		    $this->db->where("order_date BETWEEN '$fromDate' AND '$toDate'");
		}
		$this->db->order_by('orders.order_id','DESC');
	
		$query = $this->db->get();

		$errors = $this->db->error();
		return $query->result();
	}
	   
	
	public function getBranchOrders($filterData,$order_status='',$i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
//   $this->db->select('orders.order_id, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.status',1);
		if($order_status !=''){
		  //  $this->db->where('orders.order_status !=',$order_status);
		     $this->db->where('orders.order_status =','Received');
		}
		
			
		if(isset($filterData['filterstatus'])){
		    $str = implode('","',$filterData['filterstatus']);
		    $this->db->where('orders.order_status in ("'.$str.'")');
		   
		}
// 		echo $str;
		if(isset($filterData['fromDate']) && isset($filterData['toDate'])){
		    $fromDate = $filterData['fromDate'];
		    $toDate = $filterData['toDate'];
		    $this->db->where("order_date BETWEEN '$fromDate' AND '$toDate'");
		}
		$this->db->order_by('orders.order_id','DESC');
	
		$query = $this->db->get();
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
			return $query->result();
		}
	}
	public function getLastOrder($i=null){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->order_by('order_id','DESC');
		$this->db->limit('1');
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
			$this->getLastOrder($i);
		}else{
			return $query->result();
		}
	}
	
	public function getSupplierSchedule($supId, $i=null){
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
			$this->getSupplierSchedule($supId, $i);
		}else{
			return $query->result();
		}
	}
	public function getOrderDetails($orderId, $i=null){
		$this->db->select('o.*,c.first_name,c.last_name,c.phone');
		$this->db->from('orders as o');
		$this->db->where('o.order_id',$orderId);
		$this->db->join('customer_users as c', 'o.order_by = c.customer_user_id');
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
			$this->getOrderDetails($orderId, $i);
		}else{
			return $query->result();
		}
	}
	public function getOrderItemDetails($id, $i=null){
		$this->db->select('order_details.*,items.itemName,items.price,items.uom');
		$this->db->from('order_details');
		$this->db->join('items','order_details.item_id=items.itemId');
		$this->db->where('order_details.order_id',$id);
			$this->db->order_by('items.product_sort_order', 'ASC');
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
	    
	    
	    
	    
	    $this->db->select('order_details.*, items.itemCode,items.itemName as item_name,items.uom');
		$this->db->from('order_details');
		$this->db->join('items', 'order_details.item_id = items.itemId');
    // 	$where = '(order_details.status!="Rejected" or order_details.status IS NULL)';
        // $this->db->where($where);
        

		$this->db->where('order_details.order_id',$id);
		$this->db->order_by('items.product_sort_order', 'ASC');
		$query = $this->db->get();
		
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
			$this->getOrderItems($id, $i);
		}else{
			$result = $query->result();
		

			$result1 = array();
			$itemDetails = array();
			if(!empty($result)){
			    $i = 0;
				foreach($result as $key=>$res){
					if($res->item_id == 0){
						$m = 1;
						$price = ($res->amount/$res->quantity);
						$res->uom = 'pcs';
						$res->price = $price;
						$res->item_id = 'N'.$m;
						$itemDetails[] = $res;
						$m++;
					}else{
					   
						$itemDetails[] = $res;
					}
				}
			}
			
		
			
			return $itemDetails;
		}
	}
	
	
	public function getonlyOrderItems($id, $i=null){
	    $this->db->select('order_details.*, items.itemCode,items.uom');
		$this->db->from('order_details');
		$this->db->join('items', 'order_details.item_id = items.itemId');
	    
		$this->db->where('order_details.order_id',$id);
			$this->db->order_by('items.product_sort_order', 'ASC');
		$query = $this->db->get();
		
		$errors = $this->db->error();
	$result = $query->result();
// 	echo $this->db->last_query();
			if(!empty($result)){
			 return $result;
			}
	}
	public function getSupplierScheduleByDay($supId, $day, $i=null){
		$this->db->select('*');
		$this->db->from('supplier_delivery_days');
		$this->db->where('supplier_id',$supId);
		$this->db->where('delivery_day',$day);
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
			$this->getSupplierScheduleByDay($supId, $day, $i);
		}else{
			return $query->result();
		}
	}
	
	public function getWeekOrderTotal($supId, $start, $end, $i=null){
		$this->db->select('SUM(order_total) as orderTotal');
		$this->db->from('orders');
		$this->db->where('supplier_id', $supId);
		$this->db->where('order_date >=', $start);
		$this->db->where('order_date <=', $end);
		$this->db->group_by('supplier_id');
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
			$this->getWeekOrderTotal($supId, $start, $end, $i);
		}else{
			return $query->result();
		}
		
	}
	
	public function getWeeklyBudget($supId, $i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('*');
		$this->db->from('supplier_branch_access');
		$this->db->where('supplier_id',$supId);
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
			sleep(5);
			$this->getWeeklyBudget($supId, $i);
		}else{
			return $query->result();
		}
	}
	
	public function get_branch_budget($branch_id, $i=null){
		
		$this->db->select('*');
		$this->db->from('customer_branches');
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
			sleep(5);
			$this->get_branch_budget($branch_id, $i);
		}else{
			return $query->result();
		}
	}
	
	public function get_branch_orders($start, $end, $i=null){
	    $branch_id = $this->session->userdata('branch_id');
		$this->db->select('SUM(order_total) as orderTotal');
		$this->db->from('orders');
		$this->db->where('order_date >=', $start);
		$this->db->where('order_date <=', $end);
		$this->db->where('branch_id =', $branch_id);
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
			$this->get_branch_orders($start, $end, $i);
		}else{
			return $query->result();
		}
		
	}
	
	public function get_branch_orders_as_per_deliveryDate($current_week){
	    $branch_id = $this->session->userdata('branch_id');

//         $date_start = strtotime('Monday');
//         $week_start = date('Y-m-d', $date_start);
// $date_end = strtotime('next Sunday');
// $week_end = date('Y-m-d', $date_end);

// to get the nearby monday and sunday of delivery date
$timestamp = strtotime($current_week);
$day = date('D', $timestamp);
if($day == 'Mon'){
    $week_start = date('Y-m-d', strtotime($current_week));
    $week_end = date('Y-m-d', strtotime('next Sunday '.$current_week));
}elseif($day == 'Sun'){
      $week_start = date('Y-m-d', strtotime('previous Monday '.$current_week));
        $week_end = date('Y-m-d', strtotime($current_week));
}else{
    $week_start = date('Y-m-d', strtotime('previous Monday '.$current_week));
 $week_end = date('Y-m-d', strtotime('next Sunday '.$current_week)); 
}





// echo " select SUM(order_total) as orderTotal from orders WHERE  delivery_date >= '".$week_start ."' AND delivery_date <= '".$week_end ."' AND branch_id =".$branch_id." AND status = 1"; exit; 
// 	$sql = $this->db->query("select SUM(order_total) as orderTotal from orders WHERE  delivery_date >= '".$week_start ."' AND delivery_date <= '".$week_end ."' AND branch_id =".$branch_id." AND status = 1");
// 		$res = $sql->result();
// 		return $res;



		$this->db->select('SUM(order_total) as orderTotal');
		$this->db->from('orders');
	    $this->db->where('delivery_date >=', $week_start);
       $this->db->where('delivery_date <=', $week_end);
      $this->db->where('branch_id =', $branch_id);
        $this->db->where('status =', 1);
        // print_r($this->db->last_query());  exit;
     
		$query = $this->db->get();
			 //echo  $this->db->last_query(); exit;
		return $query->result();
		
	
		
		
		
	}
	
	
	public function getAllOrders($start_date, $end_date,$i=null){
	   
		$cusId = $this->session->userdata('customerId');
	
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.customer_id', $cusId);
		$this->db->where('order_date >=', $start_date);
		$this->db->where('order_date <=', $end_date);
		$this->db->order_by('orders.order_id','DESC');
		$query = $this->db->get();
// 		echo $this->db->last_query(); exit;
if (!$query) {
    $error = $this->db->error();
    echo 'Query error: ' . $error['message'];
} else {
    return $query->result();
}
		
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
// 			$this->getAllOrders($start_date, $end_date, $i);
// 		}else{
// 		    echo $this->db->last_query(); exit; 
		
// 		}
	}
	public function getSubscriptionDetails($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('customer_subscription_relation');
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
			$this->getSubscriptionDetails($i);
		}else{
			return $query->result();
		}
	}
	
	public function cancelorder($details,$orderId){
	  
		$this->db->where('order_id', $orderId);
	
		$result = $this->db->update('orders',$details);
		
	
		
	return $result;
		
	}
		public function updateOrderDetailsApprovereject($status,$ItemId,$OrderId,$i=null){
		    	$details['status'] = $status;
		$this->db->where('order_id', $OrderId);
			$this->db->where('item_id', $ItemId);
		$result = $this->db->update('order_details',$details);
		
	
		
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
			$this->updateOrderDetailsApprovereject($status,$ItemId,$OrderId,$i);
		}else{
			return $result;
		}
		
	}
	public function updateOrderDetails($details,$orderId,$i=null){
		$this->db->where('order_id', $orderId);
		$result = $this->db->update('orders',$details);
		
	
		
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
			$this->updateOrderDetails($details,$orderId,$i);
		}else{
			return $result;
		}
		
	}
	
	public function deleteOrderItems($orderId,$i=null){
	   
	    
		$this->db->where('order_id', $orderId);
		
		 $result = $this->db->delete('order_details');  
		
	
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
			$this->deleteOrderItems($orderId,$i);
		}else{
			return $result;
		}
		
	}
	public function update_product_in_order($orderId,$orderitemId='',$details='',$i=null){
	    if(isset($orderitemId) && $orderitemId !=''){
	        
	       	$this->db->where('item_id', $orderitemId); 
	    }
	    
	    
		$this->db->where('order_id', $orderId);
		
		 if(isset($details) && $details !=''){
		     
		     
		   $details = $details[0];
		   
		   
		   $result = $this->db->update('order_details',$details);
		     
		  
		 }else{
		   $result = $this->db->delete('order_details');  
		 }
		
		
	if(isset($orderitemId) && $orderitemId !=''){	
  	$items_left =  $this->getOrderItems($orderId);
		
		$order_total = 0;
		foreach($items_left as $items_lef){
		    $order_total  = $order_total + $items_lef->amount;
		}
		
	         $order = array(
	    		'order_total' => $order_total,
	    		);
	
		$this->updateOrderDetails($order, $orderId);
		
	}
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
			$this->update_product_in_order($orderId,$orderitemId='',$type='',$i);
		}else{
			return $result;
		}
		
	}
	
	public function get_customer_details($customer_id,$i=null){
		$this->db->select('*');
		$this->db->from('customers');
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
			$this->get_customer_details($customer_id,$i);
		}else{
			return $query->result();
		}
	}
	
	public function updateOrderStatus($order_id,$i=null){
		$details['order_status'] = 'Viewed';
		$this->db->where('order_id', $order_id);
		$result = $this->db->update('orders',$details);
		
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
			$this->updateOrderStatus($order_id,$i);
		}else{
			return $result;
		}
		
	}
	
		public function modifyOrderStatus($purchaseOrderNo,$OrderStatus,$i=null){
		$details['order_status'] = $OrderStatus;
		$this->db->where('order_number', $purchaseOrderNo);
		$result = $this->db->update('orders',$details);
		
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
			$this->modifyOrderStatus($purchaseOrderNo,$OrderStatus,$i);
		}else{
			return true;
		}
		
	}
	
	
	public function getFavouriteOrders($i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.favourite_order',1);
		$this->db->where('orders.status',1);
		$this->db->order_by('orders.order_id','DESC');
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
	public function getStandingOrders($i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.standing_order',1);
		$this->db->where('orders.status',1);
		$this->db->order_by('orders.order_id','DESC');
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
			$this->getStandingOrders($i);
		}else{
			return $query->result();
		}
	}
	public function fav_order_update($id,$i=null){
		$data = array(
			  'favourite_order' => "0"	
			);
		//	echo $id;exit;
			//echo '<pre>';print_r($data);exit;
		$this->db->where('order_id', $id);
		$result = $this->db->update('orders',$data);
		
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
			$this->fav_order_update($id,$i);
		}else{
			return $result;
		}
		
	}
	
	public function standing_order_update($id,$i=null){
		$data = array(
			  'standing_order' => "0"	
			);
			//echo $id;exit;
			//echo '<pre>';print_r($data);exit;
		$this->db->where('order_id', $id);
		$result = $this->db->update('orders',$data);
		
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
			$this->standing_order_update($id,$i);
		}else{
			return $result;
		}
		
	}
	
	public function updateInvoice($details, $order_id, $i=null){
		$this->db->where('order_id', $order_id);
		$result = $this->db->update('orders',$details);
		
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
			$this->updateInvoice($details, $order_id, $i);
		}else{
			return $result;
		}
		
		
		
	}
	
	public function getItemCategories($i=null){
	        $branch_id = $this->session->userdata('branch_id');
		$customerId = $this->session->userdata('customerId');
		//echo "SELECT p.category, p.customer_id, s.supplier_id, t.category_id , t.category_name FROM   item_categories AS t JOIN   items AS p ON p.category = t.category_id JOIN   supplier_branch_access AS s ON s.supplier_id = p.supplierId WHERE  s.branch_id = '".$branch_id ."' AND t.customer_id = '".$customerId ."' GROUP BY t.category_name";
		$sql = $this->db->query("SELECT DISTINCT t.category_name,p.category, p.customer_id, s.supplier_id, t.category_id , t.category_name FROM   item_categories AS t JOIN   items AS p ON p.category = t.category_id JOIN   supplier_branch_access AS s ON s.supplier_id = p.supplierId WHERE  s.branch_id = '".$branch_id ."' AND t.customer_id = '".$customerId ."' order by t.category_name ASC");
		$res = $sql->result();
		return $res;
	}
	
	public function getItemCategoriesByItemID($itemID){
	  $sql = $this->db->query("SELECT DISTINCT ic.category_name FROM   item_categories AS ic JOIN   items AS it ON it.category = ic.category_id  WHERE  it.itemId = '".$itemID ."'");
		$res = $sql->result_array()[0]['category_name'];
		return $res;  
	}
	
	//
	public function get_monthly_branch_orders($start, $end, $i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('ROUND(SUM(order_total), 2) as orderTotal');
		$this->db->from('orders');
		$this->db->where('order_date >=', $start);
		$this->db->where('order_date <=', $end);
		$this->db->where('branch_id', $branch_id);
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
			$this->get_monthly_branch_orders($start, $end, $i);
		}else{
			return $query->result();
		}
		
	}
	public function getAllMonthlyOrders($start_date, $end_date,$i=null){
		$cusId = $this->session->userdata('customerId');
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.customer_id', $cusId);
		$this->db->where('orders.order_date >=', $start_date);
		$this->db->where('orders.order_date <=', $end_date);
		$this->db->where('orders.branch_id', $branch_id);
		$this->db->where('orders.status', 1);
		$this->db->order_by('orders.order_id','DESC');
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
			$this->getAllMonthlyOrders($start_date, $end_date, $i);
		}else{
			return $query->result();
		}
	}
	public function getMonthlyOrderItems($order_id){
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
		$this->db->order_by('items.product_sort_order', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function insert_credits($data,$order_id){
		$this->db->where('order_id',$order_id);
		return $this->db->update('orders',$data);
	}
    public function submit_book_keeping($start_date,$end_date,$supId,$status){
		$branch_id = $this->session->userdata('branch_id');
		$where = "orders.branch_id = $branch_id ";
		if($supId !=''){
			$where.="AND orders.supplier_id = $supId "; 
		}
		if($start_date !=''){
			$where.="AND orders.order_date BETWEEN '$start_date' AND '$end_date'"; 
		}
		if($status !=''){
			$where.="AND orders.order_status='".$status."' and  orders.status != 0"; 
		}else{
		   	$where.="AND orders.status != 0"; 
		}
		//echo "SELECT orders.*,suppliers.supplier_name FROM orders JOIN suppliers ON orders.supplier_id = suppliers.supplier_id JOIN WHERE $where";exit;
		$query =$this->db->query("SELECT orders.*,suppliers.supplier_name FROM orders JOIN suppliers ON orders.supplier_id = suppliers.supplier_id WHERE $where");
	    //$query = $this->db->get();
	    $res = $query->result();
	    return $res;  
	}
	public function change_status_book($data,$order_id){
		$this->db->where('order_id',$order_id);
		return $this->db->update('orders',$data);
	}
	public function getBranchOrders_received($i=null){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('orders.*, suppliers.supplier_name');
		$this->db->from('orders');
		$this->db->join('suppliers', 'orders.supplier_id = suppliers.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.status',1);
		$this->db->where('orders.order_status',"Received");
		$this->db->order_by('orders.order_id','DESC');
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
	public function get_branch_email($branch_id, $i=null){
		$this->db->select('*');
		$this->db->from('customer_branches');
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
			sleep(5);
			$this->get_branch_email($branch_id, $i);
		}else{
			return $query->result();
		}
	}
	public function get_item_price($item_id,$i=null){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('itemId',$item_id);
			$this->db->order_by('items.product_sort_order', 'ASC');
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
			$this->get_item_price($item_id,$i);
		}else{
			return $query->result();
		}
	}
	public function updateOrderItemStatus($order_id,$item_id,$details,$i=null){
		
		$this->db->where('order_id', $order_id);
		$this->db->where('item_id', $item_id);
		$result = $this->db->update('order_details',$details);
		
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
			$this->updateOrderStatus($order_id,$item_id,$details,$i);
		}else{
			return $result;
		}
		
	}
}