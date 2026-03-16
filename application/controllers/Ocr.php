<?php

  class Ocr extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->model('orders_model');
		$this->load->model('ocr_model');
        $this->load->database();
         $this->lang->load('auth');
  }
   function menuDisplay(){
       	$res = $this->ion_auth->subscription();
			$status = $res[0]->status;
			$remaining = 0;
			$trail_period = '';
		
			if($status == 'Trail'){
				$exp_date = date('Y-m-d H:i:s', strtotime($res[0]->expiry));
				$today = time();
				$expdate = strtotime($exp_date);
				if($expdate >= $today){
					$trail_period = 'available';
					$diff = $today - $expdate;
					$remaining = (floor($diff / (60 * 60 * 24))) * -1;
				}else{
					$trail_period = 'Expired';
				}
			}
	    	/*menu items */
			$userlevel = $this->session->userdata('clearance_level');
			$menus = $this->ion_auth->getMenus();
			$menu_items = array();
			foreach($menus as $key=>$menu){
				if($userlevel >= $menu->level){
					$menu_items[$key] = $menu;
					$submenu_items = array();
					$sub_menus = $this->ion_auth->getSubMenus($menu->menu_id);
					if(!empty($sub_menus)){
						foreach($sub_menus as $key1 => $submenu){
							if($userlevel >= $submenu->level){
								$submenu_items[$key1] = $submenu;
							}
						}
					}
					$menu_items[$key]->submenus = $submenu_items;
				}
			}
			$hdata['menus'] = $menu_items;
			$hdata['trail_period'] = $remaining;
			return $hdata;
   }
     
     public function fileUploadPage($order_id){
              $hdata = $this->menuDisplay();
              $data['order_id'] = $order_id;
         	$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/uploadInvoiceOcr',$data);  
     }
     public function fetchOrderDetails($order_id){
        if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
		
			
			$orderItems = array();
			$orderDetails = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	    	$order_items = $this->orders_model->getonlyOrderItems($order_id);
	    	
	    	
	    	foreach($order_items as $order_item){
	    		$orderItems[$order_item->item_id] = $order_item->quantity;
	    	}
	    	
	    	$supplier_details = $this->orders_model->get_supplier_details($orders[0]->supplier_id);
	    	
	    	$group_id = $this->session->userdata('groupId');
			$group_details = $this->orders_model->getUserGroupDetails($group_id);
		
	    	if($group_details[0]->name == 'User'){
				$supplier_items = $this->orders_model->supplier_items_users($orders[0]->supplier_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}else{
				$supplier_items = $this->orders_model->supplier_items($orders[0]->supplier_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}
		
			$orderDetails['suppliers'] = $items;
			$orderDetails['supplier_name'] = $supplier_details[0]->supplier_name;
			$orderDetails['gl_code'] = $supplier_details[0]->gl_code;
			$orderDetails['gl_category'] = $supplier_details[0]->gl_category;
			$orderDetails['orderQty'] = $orderItems;
	    	$orderDetails['orders'] = $orders[0];
	    
	    	$order_items = json_decode(json_encode($order_items), True);
	    	$orderDetails['order_items'] = json_encode($order_items,JSON_HEX_APOS);
	       return $orderDetails;
		
		}
    }
    
     public function uploadInvoiceToLocalSyetm(){
        
    	$orderId = $this->uri->segment(3);
        $target_dir = "assets/Ocr/";
        $randomCode = rand();
        $target_file = $target_dir . $randomCode.'_'.basename($_FILES["invoice"]["name"]);
        $uploadOk = 1;
     if (move_uploaded_file($_FILES["invoice"]["tmp_name"], $target_file)) {
      $data['targetFile'] = $target_file;
      $data['order_id'] = $orderId;
      $data['sucessMsg'] = 'File has been successfully uploaded';
     } else {
      $data['errorFileUpload'] = "Sorry, there was an error uploading your file.";
    }
  
             $hdata = $this->menuDisplay();
         	$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/uploadInvoiceOcr',$data);
    }
    
     public function getAccessToken(){
       $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://auth.sypht.com/oauth2/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "client_id=hj5jh6oofdene5ec4rj43e298&grant_type=client_credentials",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Basic aGo1amg2b29mZGVuZTVlYzRyajQzZTI5ODoxMjZmYWNvZG9pNWplaWtobWdrN2EycDlkcjhzZTNhaTY3YXBuNnZwdjZjbmF0ODZybnNq",
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: a34cd70f-5309-9a50-75e8-755214b1f8c0"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    
     
  return json_decode($response)->access_token;
}


     }
     
     public function UploadApiToOcr($order_id=''){
      

        $target_file = $_POST['targetFile']; 
        $orderDataa = array(
                         'ocr_upload_inv_name' => $target_file
                         );
        $update_order_id = $this->orders_model->updateOrderDetails($orderDataa, $order_id);
        
   $accessToken =  $this->getAccessToken();
//   $target_file = fopen($target_filePath, "r");
  
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sypht.com/fileupload",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('fileToUpload'=> new CURLFILE($target_file),'products' => '["zouki-invoice"]'),
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: multipart/form-data",
    "Authorization: Bearer ".$accessToken
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$fileId = '';
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $obj = json_decode($response);
  
  if(isset($obj->fileId)){
    $fileId = $obj->fileId;  
  }else{
      echo "Error Processing you request, Please try again after some time.";
      exit;
  }
  
}
if($fileId !== ''){
  $this->extractInvoiceFromOcr($fileId,$order_id);  
}else{
    echo "OCR processing failed,Please try again";
    exit;
}


     }
     
     public function extractInvoiceFromOcr($documentId,$orderId){
         
          $accessToken =  $this->getAccessToken();
          
        //  echo $accessToken;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sypht.com/result/final/".$documentId,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Bearer ".$accessToken,
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 57ba8db6-9080-ad7d-abbb-0d3f9a820951"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $result = json_decode($response);
}
if(isset($result->results->fields)){
  $this->processExtractedInvoiceData($result->results->fields,$orderId,$documentId);  
}else{
    echo "Unbale to extract data from OCR, Please try after some time";
    exit;
}


         
     }
     
     function processExtractedInvoiceData($invResult,$orderId,$OcrUploadedfileId){
         //existing order data
         $orderDetails = $this->fetchOrderDetails($orderId);
         
            $data['suppliers'] = $orderDetails['suppliers'];
			$data['supplier_name'] = $orderDetails['supplier_name'];
			$data['orderQty'] = $orderDetails['orderQty'];
	    	$data['orders'] = $orderDetails['orders'];
	    	$data['order_items'] = $orderDetails['order_items'];
	    	$data['targetFile'] = $orderDetails['orders']->ocr_upload_inv_name;
           
         $invoiceData = array();
         $orderOCRData = array();
         $supplierId = '';
         foreach($invResult as $field){
          
            if($field->name == 'issuer.name'){
                 $invoiceData['supplierName']  =  $field->value;
                 $orderOCRData['supplierName']  =  $field->value; 
                }
                
            if($field->name == 'invoice.total'){
                $invoiceData['invoiceTotal']  =  $field->value;
                $orderOCRData['invoiceTotal']  =  $field->value;
                }
                
            if($field->name == 'document.date'){
                 $invoiceData['invoiceDate']  =  $field->value;
                  $orderOCRData['invoiceDate']  =  $field->value;
                }
            if($field->name == 'invoice.purchaseOrderNo'){
             $invoiceData['purchaseOrderNo']  =  $field->value;
             $poNumbers = str_replace('PO-', '', $field->value);
             $orderOCRData['purchaseOrderNo']  =  $poNumbers;
              $this->ocr_model->updateOrderStatus('000'.$poNumbers);
            
              
                }
                
           if($field->name == 'document.referenceNo'){
                $invoiceData['invoiceId']  =  $field->value; 
                $orderOCRData['invoiceId']  =  $field->value;
                }  
                
           if($field->name == 'invoice.gst'){
                $invoiceData['gst']  =  $field->value;
                 $orderOCRData['gst']  =  $field->value;
                }  
            
             
            
            // processing the line items
            if($field->name == 'invoice.lineitems:3'){
                
                 foreach($field->value->items as $AllCatergoryItemsOCR){
                  foreach($AllCatergoryItemsOCR->columns as $CatergoryColumns){   
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='id'){
                  $arrayItems = $CatergoryColumns->cells;
                  $Itemcodes = array();
                 
                  if(!empty($arrayItems)){
                     
                  foreach($arrayItems as $itemCode){
                      
                      if(isset($itemCode->text)){
                      array_push($Itemcodes,$itemCode->text);    
                      }
                     
                  }
                  }
                }
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='description'){
                  $arrayItemsDescription = $CatergoryColumns->cells;
                  
                  $ItemsDescr = array();
                  if(!empty($arrayItemsDescription)){
                  foreach($arrayItemsDescription as $arrayItemsDescr){
                      if(isset($arrayItemsDescr->text)){
                      array_push($ItemsDescr,$arrayItemsDescr->text);    
                      }
                  }
                  }
                }
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='quantity'){
                  $arrayItemsQty = $CatergoryColumns->cells;
                  
                  $ItemsQty = array();
                  if(!empty($arrayItemsQty)){
                  foreach($arrayItemsQty as $arrayItemsQuantity){
                      if(isset($arrayItemsQuantity->text)){
                      array_push($ItemsQty,$arrayItemsQuantity->text);    
                      }
                  }
                  }
                }
                
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='Total'){
                  $arrayItemsTotal = $CatergoryColumns->cells;
                  
                  $ItemsTotal = array();
                  if(!empty($arrayItemsTotal)){
                  foreach($arrayItemsTotal as $arrayItemstotalAmount){
                      if(isset($arrayItemstotalAmount->text)){
                      array_push($ItemsTotal,$arrayItemstotalAmount->text);    
                      }
                  }
                  }
                }
                
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='unitPrice'){
                  $arrayItemsUnitPrice = $CatergoryColumns->cells;
                  
                  $ItemsUnitPrice = array();
                  if(!empty($arrayItemsUnitPrice)){
                  foreach($arrayItemsUnitPrice as $arrayItemsUp){
                      if(isset($arrayItemsUp->text)){
                      array_push($ItemsUnitPrice,$arrayItemsUp->text);    
                      }
                  }
                  }
                }
                if(isset($CatergoryColumns->category) && $CatergoryColumns->category =='tax'){
                  $arrayItemsTax = $CatergoryColumns->cells;
                  
                  $ItemsTax = array();
                  if(!empty($arrayItemsTax)){
                  foreach($arrayItemsTax as $arrayItemTax){
                      if(isset($arrayItemTax->text)){
                      array_push($ItemsTax,$arrayItemTax->text);    
                      }
                  }
                  }
                }
                
                 }
            }
                
                $itemDetailsData = array();
                if(!empty($Itemcodes)){
                     
                    foreach($Itemcodes as $index=> $UnqiueItemcode){
                       
                        if(isset($UnqiueItemcode) && $UnqiueItemcode !==''){
                      $itemDetails[0]->order_id = (isset($orderId) && $orderId !='' ? $orderId : '');        
                      $itemDetails[0]->itemCode = (isset($UnqiueItemcode) && $UnqiueItemcode !='' ? $UnqiueItemcode : '');     
                      $itemDetails = $this->ocr_model->get_item($UnqiueItemcode);
                      if(isset($ItemsDescr[$index]) && $ItemsDescr[$index] !='' && !empty($itemDetails)){
                         $itemDetails[0]->ItemsDescr = $ItemsDescr[$index]; 
                      }
                      if(isset($ItemsQty[$index]) && $ItemsQty[$index] !='' && !empty($itemDetails)){
                         $itemDetails[0]->ItemsQty = $ItemsQty[$index]; 
                      }
                       if(isset($ItemsTotal[$index]) && $ItemsTotal[$index] !='' && !empty($itemDetails)){
                         $itemDetails[0]->ItemsTotal = $ItemsTotal[$index]; 
                      }
                      if(isset($ItemsUnitPrice[$index]) && $ItemsUnitPrice[$index] !='' && !empty($itemDetails)){
                         $itemDetails[0]->ItemsUnitPrice = $ItemsUnitPrice[$index]; 
                      }
                      if(isset($ItemsTax[$index]) && $ItemsTax[$index] !='' && !empty($itemDetails)){
                         $itemDetails[0]->ItemsTax = $ItemsTax[$index]; 
                      }
                      
                      if(!empty($itemDetails)){
                    $invoiceData['Items'][$UnqiueItemcode] = $itemDetails[0]; 
                      }
                     }
                    }
                }
               
            }
            
            
         }
        
          
             // Update our database with OCR api response 
            
            $orderOCRData['order_id'] = $orderId;
            $orderOCRData['branch_id'] = $this->session->userdata('branch_id');
            $orderOCRData['fileId'] = $OcrUploadedfileId;
            $this->ocr_model->insertOcrRecord($orderOCRData);
            $Odetails['order_status'] = 'OCR processed';
             $this->orders_model->cancelorder($Odetails,$orderId);
             $count = 0;
            foreach($invoiceData['Items'] as $ItemsData){
            $this->ocr_model->insertOcrRecordItem($ItemsData,$orderId,$count);
            $count++;  
            }

            $data['viewPage'] = false;
            $data['invoiceData'] = $invoiceData;
            $hdata = $this->menuDisplay();
         	$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/scanInvoice',$data);
         
     }
     
     function orderListing(){
            $orders = $this->ocr_model->getBranchOCROrdersList();
            
            $hdata = $this->menuDisplay();
            $data['orders'] = $orders;
         	$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/ocrListing',$data); 
     }
     function viewOcrProcessedOrders($orderId){
         
         $orderDetails = $this->fetchOrderDetails($orderId);
         
            $data['suppliers'] = $orderDetails['suppliers'];
			$data['supplier_name'] = $orderDetails['supplier_name'];
			$data['orderQty'] = $orderDetails['orderQty'];
	    	$data['orders'] = $orderDetails['orders'];
	    	$data['order_items'] = $orderDetails['order_items'];
	    	$data['gl_code'] = $orderDetails['gl_code'];
	    	$data['gl_category'] = $orderDetails['gl_category'];
	    	$data['targetFile'] = $orderDetails['orders']->ocr_upload_inv_name;
	    
	    	
         $orders = $this->ocr_model->viewOcrProcessedOrders($orderId);
         $orders['Items'] = $this->ocr_model->fetchOcrProcessedOrdersItem($orderId);
         
        // echo "<pre>"; print_r($orders); exit;
            
            $hdata = $this->menuDisplay();
           
            $data['invoiceData'] = $orders;
            $data['viewPage'] = true;
         	$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/scanInvoice',$data); 
     }
     
      public function updateReceiveOrderFromScanOcrPage(){
        
    // End =========================================================
    
    	$orderId = $_POST['order_id'];
    	$received_date = $_POST['received_date'];
    	
    		$Any_return = $_POST['Any_return'];
    		$Packaged_according_to_food = $_POST['Packaged_according_to_food'];
    		$Any_breakage = $_POST['Any_breakage'];
    		
    	$comments = $_POST['comments'];
    	$supplier_comments = $_POST['supplier_comments'];
    	$received_items = json_decode($_POST['received_items']);
    	$temp_recording = $_POST['temp_record'];
    	$signature = $_POST['signature'];
    	$credits = $_POST['credits'];
    	$paid = $_POST['paid'];
    	
    	
    	
    		$order = array(
    			'received_on' => date('Y-m-d', strtotime($received_date)),
    			'order_status_received_chnaged_date' => date('Y-m-d'),
    			'comments' => $comments,
    			'supplier_comments' => $supplier_comments,
    			'temp_recording' => $temp_recording,
    			'signature' => $signature,
    			'credits' => $credits,
    			'paid' => $paid,
    			'Any_return' => $Any_return,
    			'Packaged_according_to_food' => $Packaged_according_to_food,
    			'Any_breakage' => $Any_breakage,
    		);
    	
    	
	    
    	$update_order_id = $this->orders_model->updateOrderDetails($order, $orderId);
    
    echo 'success';
    }
}
    ?>