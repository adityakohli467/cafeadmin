<?php
class Ocr_model extends CI_Model{
	function __construct() {
	parent::__construct();
	}
	
	public function get_item($itemCode){
		$user_id = $this->session->userdata('customerId');
		$this->db->select('items.account,items.account_name,items.tax_code');
		$this->db->join('suppliers','suppliers.supplier_id = items.supplierId');
		$this->db->from('items');
	    $this->db->where('items.status','1');
	    $this->db->where('suppliers.status','1');
	    
	   
	    
		$this->db->where('items.itemCode',$itemCode);
// 		$this->db->where('items.supplierId',$supplierId);
		$query = $this->db->get();
      
		return $query->result();
	}
	public function updateOrderStatus($poNumber){
	    $details['OCR_Status'] = 1;
	    $this->db->where('order_number', $poNumber);
		$result = $this->db->update('orders',$details);
// 		echo $this->db->last_query();
// 		exit;
	    
	}
	
		public function getBranchOCROrdersList(){
	   
	   $branch_id = $this->session->userdata('branch_id');
		$this->db->select('OcrResult.order_id,OcrResult.supplierName,OcrResult.invoiceTotal,OcrResult.invoiceDate,OcrResult.purchaseOrderNo,OcrResult.invoiceId, OcrResult.gst');
       $this->db->where('OcrResult.branch_id',$branch_id);
		$this->db->from('OcrResult');
		$query = $this->db->get();
	  return $query->result();
	    
	}
	
	public function viewOcrProcessedOrders($orderId){
	   // echo $orderId; exit;
		$this->db->select('*');
        $this->db->where('OcrResult.order_id',$orderId);
		$this->db->from('OcrResult');
		$query = $this->db->get();
	    return (array)$query->result()[0];
	    
	}
	
	public function fetchOcrProcessedOrdersItem($orderId){
	   
	  
		$this->db->select('OcrItem.itemCode,OcrItem.ItemsDescr,OcrItem.ItemsQty,OcrItem.ItemsUnitPrice,OcrItem.ItemsTax,OcrItem.account,OcrItem.account_name,OcrItem.tax_code');
        $this->db->where('OcrItem.order_id',$orderId);
		$this->db->from('OcrItem');
		$query = $this->db->get();
	  return (array)$query->result();
	    
	}
	
	public function insertOcrRecord($invoiceData){
	   
	   $this->db->replace('OcrResult', $invoiceData);
	    
	}
	public function insertOcrRecordItem($invoiceItemData,$orderId,$count){
	    // check if any old record for same order item exist of so, delete it and than insert new record
	    if($count == 0){
	    $this->db->where('order_id', $orderId);
        $this->db->delete('OcrItem');    
	    }
	    
    
	   $this->db->insert('OcrItem', $invoiceItemData);
	    
	}
	
	public function get_supplierId($poNumber){
	    
		$this->db->select('orders.supplier_id');
		$this->db->from('orders');
		$this->db->where('orders.order_number',$poNumber);
		$query = $this->db->get();
       
		return $query->result();
	}
	
}