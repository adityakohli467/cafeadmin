<?php
class Filter_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}

	function filter_report($filter,$branch_id){
	     
	     $this->db->select('*');
		$this->db->from('orders');
		 $this->db->join('suppliers', 'suppliers.supplier_id = orders.supplier_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.order_status','Received');
		$this->db->order_by("order_date", "desc");
		
		if(isset($filter['name']) && $filter['name'] != ''){
		  //  	$this->db->where('orders.branch_id',$filter['name']);
		}
		if(isset($filter['po_number']) && $filter['po_number'] != ''){
		    	$this->db->where('orders.order_number',$filter['po_number']);
		}
	
	   if(isset($filter['date_from']) && $filter['date_from'] !='' && isset($filter['date_to']) && $filter['date_to'] !=''){
		    $myinput=$filter['date_from']; 
		    $date_from=date('Y-m-d',strtotime($myinput));
		    
		    $myinput2=$filter['date_to']; 
		    $date_to=date('Y-m-d',strtotime($myinput2));
		   
		    $this->db->where("orders.order_date BETWEEN '$date_from' AND '$date_to'");
		}

   
		$query = $this->db->get();
		
			return $query->result();;		
	}
	function filter_report_f11($filter,$branch_id){
	     
	    $this->db->select('*');
		$this->db->from('orders');
// 		$this->db->join('suppliers', 'suppliers.supplier_id = orders.supplier_id');
        
        $this->db->join('order_details', 'order_details.order_id = orders.order_id');
        $this->db->join('customer_branches', 'customer_branches.branch_id = orders.branch_id');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.order_status','Received');
		$this->db->order_by("order_date", "desc");
		
		if(isset($filter['date_filter']) && $filter['date_filter'] !=''){
		    $myinput=$filter['date_filter']; 
		    $date_filter=date('Y-m-d',strtotime($myinput));
		   
		    $this->db->where("orders.order_date",$date_filter);
		}

   
		$query = $this->db->get();
		
			return $query->result();;		
	}
		function fetch_record($filter,$branch_id){
	     
	    $this->db->select('*');
		$this->db->from('orders');
		$this->db->where('orders.branch_id',$branch_id);
		$this->db->where('orders.order_status','Received');
		$this->db->where('orders.form_11_verified_by !=','');
		$this->db->where('orders.form_11_signature !=','');
		if(isset($filter['date_filter']) && $filter['date_filter'] !=''){
		    $myinput=$filter['date_filter']; 
		    $date_filter=date('Y-m-d',strtotime($myinput));
		   
		    $this->db->where("orders.order_date",$date_filter);
		}

   
		$query = $this->db->get();
		
			return $query->result();;		
	}
	function update_order($order_id,$data,$table_name,$column_name){
	    
	    $this->db->where($column_name, $order_id);
	
		$result = $this->db->update($table_name,$data);
	}
// 	function update_order_details($order_detail_id,$data){
	    
// 	    $this->db->where('order_detail_id', $order_detail_id);
	
// 		$result = $this->db->update('orders',$data);
// 	}
}
?>