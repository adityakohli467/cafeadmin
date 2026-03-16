<?php
class Items_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	
	//Manage suppliers
	public function get_items($i=null){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.customer_id',$user_id);
		$this->db->order_by('items.itemName','ASC');
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
			$this->get_items($i);
		}else{
			return $query->result();
		}
	}
	public function get_branch_suppliers($i=null){
		$customerId = $this->session->userdata('customerId');
		$branchId = $this->session->userdata('branch_id');
		$this->db->select('supplier_branch_access.*,suppliers.supplier_name');
		$this->db->from('supplier_branch_access');
		$this->db->join('suppliers','suppliers.supplier_id = supplier_branch_access.supplier_id');
		$this->db->where('supplier_branch_access.branch_id',$branchId);
		$this->db->where('suppliers.status',1);
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
	public function edit_suppliers($id, $i=null){
		$this->db->select('s.*,c.category_id,c.category_name,u.group_id,g.name');
		$this->db->from('suppliers as s');
		$this->db->join('supplier_categories as c','c.category_id = s.category_id');
		$this->db->join('customer_users_groups as u','s.updated_by = u.user_id');
		$this->db->join('customer_groups as g','u.group_id = g.id');
		$this->db->where('s.supplier_id',$id);
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
	public function supplier_items($id, $i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.supplierId',$id);
		$this->db->where('items.status',1);
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
			$this->supplier_items($id,$i);
		}else{
			return $query->result();
		}
	}
	//Item Categories
	
	public function get_item_cat($i=null){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('customer_id',$user_id);
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
			$this->get_item_cat($i);
		}else{
			return $query->result();
		}
	}
	
	function add_item_cat($data){
		return $this->db->insert('item_categories',$data);
	}
	public function edit_item_cat($id, $i=null){
		$this->db->select('*');
		$this->db->from('item_categories');
		$this->db->where('category_id',$id);
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
			$this->edit_item_cat($id,$i);
		}else{
			return $query->result();
		}
	}
	function update_item_category($data,$id,$i=null){
	    
		$this->db->where('category_id',$id);
		$result = $this->db->update('item_categories',$data);
		
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
			$this->update_item_category($data,$id,$i);
		}else{
			return $result;
		}
	}
	function category_delete($id,$i=null){
		$this->db->where('category_id',$id);
		$result = $this->db->delete('item_categories');
		
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
	
	// public function getAllSuppliers(){
	// 	$user_id = $this->session->userdata('customerId');
	// 	$this->db->select('supplier_id,supplier_name');
	// 	$this->db->from('suppliers');
	// 	$this->db->where('customer_id',$user_id);
	// 	$query = $this->db->get();
	// 	$res = $query->result();
	// 	return $res;
	// }
	// public function getAdminSuppliers(){
	// 	$user_id = $this->session->userdata('customerId');
	// 	$this->db->select('supplier_id,supplier_name');
	// 	$this->db->from('suppliers');
	// 	$this->db->where('customer_id',$user_id);
	// 	$query = $this->db->get();
	// 	$res = $query->result();
	// 	return $res;
	// }
	public function getAllSuppliers($i=null){
		$customer_id = $this->session->userdata('customerId');
		$this->db->select('s.*,c.category_id,c.category_name,u.group_id,g.name');
		$this->db->from('suppliers as s');
		$this->db->join('supplier_categories as c','c.category_id = s.category_id');
		$this->db->join('customer_users_groups as u','s.updated_by = u.user_id');
		$this->db->join('customer_groups as g','u.group_id = g.id');
		$this->db->where('s.customer_id',$customer_id);
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
			$this->getAllSuppliers($i);
		}else{
			return $query->result();
		}
	}
	
	public function cat_autoSearch($i=null){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('category_id,category_name');
		$this->db->from('item_categories');
		$this->db->where('customer_id',$user_id);
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
			$this->cat_autoSearch($i);
		}else{
			$res = $query->result();
			return $res;
		}
	}
	function items_delete($id,$i=null){
	
		$data['status'] = 0;
		 $this->db->where('itemId',$id);
	 $this->db->update('items',$data);
		
	return true;
		
	}
	function submit_items($data,$i=null){
	    
	   
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
			$this->submit_items($data,$i);
		}else{
			return $result;
		}
		
	}
	public function edit_items($id,$i=null){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('itemId',$id);
		$this->db->order_by('items.product_sort_order', 'asc');
		$query = $this->db->get();
		return $query->result();
		
		$query=$this->db->query("SELECT items.*,products.itemName FROM orders_detail INNER JOIN products ON products.itemId = orders_detail.itemId WHERE orders_detail.orderId='".$id."'");
        
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
			$this->edit_items($id,$i);
		}else{
			$res56=$query->result();
            return $res56;
		}
	}
	
	public function update_items($data,$id,$supplier_id='',$stock_quantityForOutlet=''){
	    
	 $this->db->where('itemId',$id);
	 $result = $this->db->update('items',$data);

		    if($this->session->userdata('is_outlet_manager') == 1){ 
		        $outlet_id = $this->session->userdata('user_id');
		        $this->db->select('*');
        		$this->db->from('stoke_outlet');
        		$this->db->where('item_id',$id);
        		$this->db->where('outlet_id',$outlet_id);
        		$query1 = $this->db->get();
        		$res1 = $query1->result();
        		  // echo "<pre>";print_r($res1); echo $stock_quantityForOutlet;exit; 
        		if(!empty($res1)){
        		     $data1 = array(
        		        'stock_qty' => $stock_quantityForOutlet,
    		        );
        // 		 echo "<pre>";print_r($data1); exit;   
        		    $this->db->where('stoke_outlet_id',$res1[0]->stoke_outlet_id);
	                $result = $this->db->update('stoke_outlet',$data1);
        		}
        		else{
        		     $data1 = array(
        		        'item_id' => $id,
        		        'outlet_id' => $outlet_id,
        		        'supplier_id' => $supplier_id,
        		        'stock_qty' => $stock_quantityForOutlet,
    		        );
    		          
        		    $result = $this->db->insert('stoke_outlet',$data1);
        		}
        		
		    }
		  //  echo $this->db->last_query(); exit;
			return $result;

	 
	}
	// public function get_items_category(){
	// 	$user_id = $this->session->userdata('customerId');
	// 	$this->db->select('*');
	// 	$this->db->from('item_categories');
	// 	$this->db->where('customer_id',$user_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	public function get_suppliers_category($i=null){
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
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
			$this->get_suppliers_category($i);
		}else{
			return $query->result();
		}
	}
	public function edit_supp_cat($id, $i=null){
		$this->db->select('items.*,suppliers.supplier_id,suppliers.supplier_name,item_categories.category_id,item_categories.category_name');
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		$this->db->where('items.itemId',$id);
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
			$this->edit_supp_cat($id,$i);
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
			$this->getUserGroupDetails($group_id,$i);
		}else{
			return $query->result();
		}
	}
	//20-11-2017
	public function items_update($id,$data,$i=null){
	 $this->db->where('itemId',$id);
	 $result = $this->db->update('items',$data);
	 
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
			$this->items_update($id,$data,$i);
		}else{
			return $result;
		}
	 
	}
		public function get_outletmanagers($i=null){
		
		$this->db->select('customer_user_id,username');
		$this->db->from('customer_users');
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('is_outlet_manager',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function fetch_outletmanagers($outlet_id='',$i=null){
		
		$this->db->select('*');
		$this->db->from('customer_users');
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('is_outlet_manager',1);
		if($outlet_id != ''){
		    $this->db->where('customer_user_id',$outlet_id);
		}
		$query = $this->db->get();
		return $query->result();
	}
	function delete_outlet($id,$i=null){
		$this->db->where('customer_user_id',$id);
		$result = $this->db->delete('customer_users');
		
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
			$this->delete_outlet($id);
		}else{
			return $result;
		}
		
	}
	public function get_item_suppliers($i=null){
		 $user_id = $this->session->userdata('customerId');
		//exit;
		//echo '<pre>';
		//print_r($_SESSION);
		//exit;
		//$branch_id = $this->session->userdata('branch_id');
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('customer_id',$user_id);
		$query = $this->db->get();
		//$query = $this->db->query("SELECT * FROM users;");
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
			$this->get_item_suppliers($i);
		}else{
			return $query->result();
		}
	}
	
public function get_items_onchange($supplier_id,$productName='',$outletID=''){
                $this->db->select('outlet_id');
        		$this->db->from('stoke_outlet');
        		$this->db->where('outlet_id',$this->session->userdata('user_id'));
        		$this->db->where('supplier_id',$supplier_id);
        		$query1 = $this->db->get();
        		$res1 = $query1->result();
        		if(!empty($res1)){
        		    $OldOutletuser = true;
        		}else{
        		     $OldOutletuser = false;
        		}
    
    
		$user_id = $this->session->userdata('customerId');
			if($this->session->userdata('is_outlet_manager') == 1 && $OldOutletuser){
		$this->db->select('items.*,suppliers.supplier_name,stoke_outlet.stock_qty,item_categories.category_name');
			}else{
			    	if($outletID !=''){
		$this->db->select('items.*,suppliers.supplier_name,stoke_outlet.stock_qty,item_categories.category_name');
			    	}else{
			    	$this->db->select('items.*,suppliers.supplier_name,item_categories.category_name');	    	    
			    	}
		
			}
		$this->db->from('items');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->join('item_categories','item_categories.category_id = items.category');
		if($this->session->userdata('is_outlet_manager') == 1 && $OldOutletuser){
		$this->db->join('stoke_outlet','stoke_outlet.item_id = items.itemId');
		$this->db->where('stoke_outlet.outlet_id',$this->session->userdata('user_id'));
			}
			if($outletID !=''){
		$this->db->join('stoke_outlet','stoke_outlet.item_id = items.itemId');
		$this->db->where('stoke_outlet.outlet_id',$outletID);    
			}
	
		$this->db->where('items.customer_id',$user_id);
		$this->db->where('items.supplierId',$supplier_id);
		$this->db->where('items.status',1);
		if($productName != ''){
		  //  $this->db->where('items.itemName',$productName);
		  $this->db->like('items.itemName',$productName);
		}
		$this->db->group_by('items.itemName');
		$this->db->order_by('items.itemName','ASC');
		$query = $this->db->get();
// 	echo $this->db->last_query();
	    return $query->result();
	}
	
public function get_allOutletItems($supplier_id){
           $sql = "
            SELECT 
    items.itemName,
    items.price,
    items.itemId,
    stoke_outlet.outlet_id,
    stoke_outlet.stoke_outlet_id,
    customer_users.username AS outletname,
    COALESCE(stoke_outlet.stock_qty, 0) AS stock_qty,
    SUM(COALESCE(stoke_outlet.stock_qty, 0)) OVER (PARTITION BY stoke_outlet.item_id) AS total_stock_qty
FROM 
    items
LEFT JOIN 
    stoke_outlet ON items.itemId = stoke_outlet.item_id AND stoke_outlet.supplier_id = ".$supplier_id."
LEFT JOIN 
    customer_users ON customer_users.customer_user_id = stoke_outlet.outlet_id
LEFT JOIN 
    suppliers ON suppliers.supplier_id = stoke_outlet.supplier_id
WHERE 
    items.supplierId = ".$supplier_id." AND items.status = 1
   
ORDER BY 
    stoke_outlet.stock_qty DESC;

        ";
        
        $query = $this->db->query($sql, array($supplier_id));
        

        return $query->result_array();
	}
		
// 	outlet

    public function save_outlet($customer_id='',$username='',$email='',$new_user_type='',$new_branch_id='',$pwd='',$i=null){
		 
		
		//   echo '<pre>';print_r($data);exit;
		
		if($customer_id != ''){
		    if($pwd != ''){
		        $data = array(
        		  'email' => $email,
        		  'username' => $username,
        		  'password' => $pwd,
    		    );
		    }else{
		        $data = array(
        		  'email' => $email,
        		  'username' => $username,
    		    );
		    }
		     
		    $this->db->where('customer_user_id',$customer_id);
		    $res =$this->db->update('customer_users',$data);
		    if($res){
		     return true;   
		    }else{
		        return false;  
		    }
		}else{
		    $data = array(
    		  'email' => $email,
    		  'username' => $username,
    		  'password' => $pwd,
    		  'active' => 1,
    		  'status' => "New",
    		  'customer_id' => 14,
    		  'branch_id' => $new_branch_id,
    		  'is_outlet_manager' => 1,
		); 
		    $this->db->insert('customer_users',$data);
            $id = $this->db->insert_id();
               
            $details = array(
        	    	'user_id' => $id,
        	    	'group_id' => $new_user_type
        	);
        	$this->db->insert('customer_users_groups', $details);
        	    
        	//foreach($new_branch_id as $branch){
        	    $details_data = array(
		    	'branch_id' => $new_branch_id,
		    	'customer_user_id' => $id,
		    	);
		    //}
			$this->db->insert('branches_access', $details_data);
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
				$this->save_outlet($customer_id='',$username,$new_user_type,$new_branch_id,$pwd,$i=null);
			}else{
				return $id;
			}
		}
   
	 
    }
    
}