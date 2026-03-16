<?php
ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Orders extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('orders_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $errors = $this->db->error();
        // $this->output->enable_profiler(TRUE);
        
		if($errors['code'] != 0){
			show_error();
		}
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
         
        //PHPMailer is lazy-loaded via _init_email() when needed
	  
          
         
               
    }
    
    private function _init_email() {
        if (!empty($this->phpmailermail)) return;
        $this->phpmailermail = new PHPMailer();
        $this->phpmailermail->isSMTP();
        $this->phpmailermail->Host     = 'smtp.gmail.com';
        $this->phpmailermail->SMTPAuth = TRUE;
        $this->phpmailermail->SMTPSecure = 'tls';
        $this->phpmailermail->Username = 'cafeorders1@gmail.com';
        $this->phpmailermail->Password = 'pahuepfjvhrovoga';
        $this->phpmailermail->Port     = 587;
        $this->phpmailermail->setFrom('cafeorders1@gmail.com', 'Cafeadmin');
    }

    /**
     * Compress an uploaded image (JPEG/PNG) to reduce file size.
     * Resizes to max 1920px on longest side, converts to JPEG at quality 75.
     * PDFs are left untouched.
     */
    private function _compress_image($file_path) {
        if (!file_exists($file_path)) return;
        
        $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png'])) return; // skip PDFs
        
        $info = getimagesize($file_path);
        if ($info === false) return;
        
        $mime = $info['mime'];
        $orig_w = $info[0];
        $orig_h = $info[1];
        
        // Create image resource
        switch ($mime) {
            case 'image/jpeg': $img = imagecreatefromjpeg($file_path); break;
            case 'image/png':  $img = imagecreatefrompng($file_path); break;
            default: return;
        }
        if (!$img) return;
        
        // Resize if larger than 1920px on any side
        $max_dim = 1920;
        $new_w = $orig_w;
        $new_h = $orig_h;
        if ($orig_w > $max_dim || $orig_h > $max_dim) {
            if ($orig_w >= $orig_h) {
                $new_w = $max_dim;
                $new_h = (int)round($orig_h * ($max_dim / $orig_w));
            } else {
                $new_h = $max_dim;
                $new_w = (int)round($orig_w * ($max_dim / $orig_h));
            }
            $resized = imagecreatetruecolor($new_w, $new_h);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $new_w, $new_h, $orig_w, $orig_h);
            imagedestroy($img);
            $img = $resized;
        }
        
        // Save as JPEG at quality 75
        imagejpeg($img, $file_path, 75);
        imagedestroy($img);
    }

    public function update_category_idfunctiolity(){
        
        $this->db->select('items.itemId,items.category,item_categories.category_id,item_categories.category_name ');
		$this->db->from('items');
		$this->db->join('item_categories','`item_categories` ic on items.category = item_categories.category_name');
		$this->db->where('items.itemId >',17041);
		
			$query = $this->db->get();
			$ress = $query->result();
			foreach($ress as $res){
			    $data = array(
			        'category' => $res->category_id
			        );
			        
		$this->db->where('itemId',$res->itemId);
		$result = $this->db->update('items',$data);
		echo "updated".$res->itemId."</br>";
		
			}
			
		
    }
    public function sendEmail(){
        
          $config = array(
            'protocol' =>  'smtp', 
            'smtp_host' => 'smtp.gmail.com',
            'smtp_crypto' => 'tls',
            'smtp_port' => 587, 
            'smtp_user' => 'cafeadorders@gmail.com', 
            'smtp_pass' => 'Discoverf1y@123!!'
            );

           ini_set('display_errors', 1);
           ini_set('display_startup_errors', 1);
           error_reporting(E_ALL);

//     $to = 'kaushika@kjcreate.com.au';  
//     $this->load->library('email', $config);
//     $this->email->initialize($config);    
// 	$this->email->set_newline("\r\n");
// 	$this->email->to($to);
// 	$this->email->from('cafeadorders@gmail.com', 'Test'); 
// 	$this->email->reply_to($to);
// 	$this->email->subject('Aditya test Gsuite');
// 	$this->email->message('Test email with test content');
// 	$send = $this->email->send();


     //phpmailer test =================================
            
//         $this->phpmailermail = new PHPMailer();
//         $this->phpmailermail->isSMTP();
//         $this->phpmailermail->SMTPDebug = 1;
//         $this->phpmailermail->Host     = 'smtp.gmail.com';
//         $this->phpmailermail->SMTPAuth = TRUE;
//         $this->phpmailermail->SMTPSecure = 'tls';
//   //   $this->phpmailermail->Username = 'kjcafe111149@gmail.com';
//   //    $this->phpmailermail->Password = 'Kjc@2021#';
//         $this->phpmailermail->Username = 'cafeadorders@gmail.com';
//         $this->phpmailermail->Password = 'Discoverf1y@123!!';
//         $this->phpmailermail->Port     = 587;
//         $this->phpmailermail->setFrom('cafeadorders@gmail.com', 'Cafeadmin');

    //                 $this->phpmailermail->isHTML(true);
				// 	 $this->phpmailermail->addAddress($to);
    //                  $this->phpmailermail->Subject = 'test Gsuitet';
    //                  $this->phpmailermail->Body = 'Test email with test content';
    //                  $this->phpmailermail->send();
        
        //=============================================================

	                
	
        // echo "<pre>";print_r($this->email);
        // if($send){
        //  echo 'success';
        // }else{
        //     mail($to,"eTest",'aditya test htmail');
        //  echo 'failed';
        // }
    }
    public function index(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
		  $branch_id = $this->session->userdata('branch_id');
		     
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				/*menu items end */ 
				
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->orders_model->getUserGroupDetails($group_id);

			
				$branch_suppliers = $this->orders_model->get_branch_suppliers();
			
				
				$balance = $this->branchBudgetBalance();
				// $brahchBudgetData = $this->branchBudgetBalance(true);
			
			
				//get month orders
				// $start_date = date('Y-m-01');
				// $end_date = date('Y-m-t');;
				$start_date = date('Y-m-01');
                 $end_date = date('Y-m-t');
		
				$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
				$orders_count = count($total_orders);
				
				$subscription = $this->orders_model->getSubscriptionDetails();
				$orders_limit = $subscription[0]->no_of_orders;
				// echo $orders_count.'-'.$orders_limit;exit;
				
				$items = array();
				if(!empty($branch_suppliers)){
					foreach($branch_suppliers as $supp){
						if($group_details[0]->name == 'User'){
							$supplier_items = $this->orders_model->supplier_items_users($supp->supplier_id);
							if(!empty($supplier_items)){
								$items[] = $supplier_items;
							}
						}else{
							$supplier_items = $this->orders_model->supplier_items($supp->supplier_id);
							if(!empty($supplier_items)){
								$items[] = $supplier_items;
							}
						}
					}
				}
				
				$item_categories = $this->orders_model->getItemCategories();
			
				$data['suppliers'] =        $items;
				$data['branch_budget'] =    $balance;
				// $data['balanceThisWeek'] =   (isset($brahchBudgetData['balance']) ? $brahchBudgetData['balance'] : 0);
				// $data['budgetThisWeek'] =    (isset($brahchBudgetData['budget']) ? $brahchBudgetData['budget'] : 0);
				$data['orders_limit'] =     $orders_limit;
				$data['orders_count'] =     $orders_count;
				$data['categories'] =       $item_categories;
				$data['branch_suppliers'] = $branch_suppliers;
				
				$this->load->view('general/header_general.php', $hdata);
				$this->load->view('orders/place_orders',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    
    public function getBranchOrderTotalFromDeliverDate(){
        	$delivery_date = $_POST['delivery_date'];
      
        	$balanceBudgetData = $this->branchBudgetBalance($delivery_date);
        	echo $balanceBudgetData;
        
        	exit;
    }
    
    
    public function getSupplierSchedule(){
    	$supplier_id = $_POST['supplier_id'];
    	$suppliers = $this->orders_model->getSupplierSchedule($supplier_id);
    	$days = array();
    	$delivery_dates = array();
    	foreach($suppliers as $supplier){
    		array_push($days, $supplier->delivery_day);
    	}
    	
    	$today_date = date('Y-m-d');
    	$today_day = date('l', strtotime($today_date));
    	$today_time = date('H:i');
    	
    	
    	if(in_array($today_day, $days)){
    		$schedule = $this->orders_model->getSupplierScheduleByDay($supplier_id, $today_day);
    		$cutoff_day = $schedule[0]->cut_off_day;
    		$cutoff_time = date('H:i', strtotime($schedule[0]->cut_off_time));
    		
    		for($k=0; $k<=6; $k++){
	    		$prev_date = date('Y-m-d', strtotime("$today_date -$k day"));
	    		$prev_week = date('l', strtotime($prev_date));
	    		if($prev_week == $cutoff_day){
	    			$cutoff_date = $prev_date;
	    			break;
	    		}
	    	}
	    	
    		if($cutoff_date == $today_date){
    			if($today_time < $cutoff_time){
    				$start = 0;
    				$end = 6;
    			}else{
    				$start = 1;
    				$end = 7;
    			}
    		}else{
    			$start = 1;
    			$end = 7;
    		}
    	}else{
    		$start = 1;
    		$end = 7;
    	}
    	
    	
    	for($i=$start; $i<=$end; $i++){
    		$date = date('Y-m-d', strtotime("$today_date +$i day"));
    		$week = date('l', strtotime($date));
    		
    		if(in_array($week, $days)){
    			// array_push($delivery_dates, $date);
    			$delivery_dates[$week] = $date;
    		}
    	}
    	
    	$options = '';
    	if(!empty($delivery_dates)){
    		foreach($delivery_dates as $key => $delivery_date){
    			$del_date = date('d-m-Y', strtotime($delivery_date));
	    		$options.='<option value="'.$delivery_date.'">'.$key.' - '.$del_date.'</option>';
	    	}
    	}
    	echo $options;
    }
    
    public function placeOrders(){
        
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
    
        
    	$orders = json_decode($_POST['order']);
    	$supplier = $_POST['supplier_id'];
    	$delivery_date = $_POST['delivery_date'];
    	$order_date = $_POST['order_date'];
    	$comments = $_POST['comments'];
    	$fav_order = $_POST['fav_order'];
    	$stand_order = $_POST['standing_order'];
    	$supp_order = $orders->$supplier;
    	
    	$supplier_cc = json_decode($_POST['supp_cc']);
    	$supplier_email = $_POST['supp_email'];
    	$items = $supp_order->item;
    	$qty = $supp_order->qty;
    	$amount = $supp_order->amount;
    	$itemName = $supp_order->itemName;
    	
    	
    	
    	
    	//echo '<pre>';print_r($amount);exit;
    	$user_id = $this->session->userdata('user_id');
    	$customer_id = $this->session->userdata('customerId');
    	$branch_id = $this->session->userdata('branch_id');
    	$total = 0;
    	foreach($amount as $amnt){
    		$total = $total+$amnt;
    	}
    	//echo $total;exit;
    	$supplier_balance = $this->getSupplierBudgetBalance($supplier);
    	$branch_balance = $this->branchBudgetBalance();
    	
    $updated_at_IP = $_SERVER['REMOTE_ADDR'];
    	
    	if($supplier_balance >= $total){
    		// Use DB transaction to ensure order + items are atomic
    		$this->db->trans_start();
    		
    		$last_order = $this->orders_model->getLastOrder();
    		if(count($last_order)>0){
    			$last_ord_no = $last_order[0]->order_number;
    		}else{
    			$last_ord_no = 0;
    		}
    		$order_number = (int)$last_ord_no + 1;
	    	$order = array(
	    			'order_date' => date('Y-m-d', strtotime($order_date)),
	    			'order_status' => 'Sent',
	    			'order_by' => $user_id,
	    			'delivery_date' => date('Y-m-d', strtotime($delivery_date)),
	    			'comments' => $comments,
	    			'supplier_id' => $supplier,
	    			'order_total' => $total,
	    			'customer_id' => $customer_id,
	    			'branch_id' => $branch_id,
	    			'order_number' => '000'.$order_number,
	    			'favourite_order' => $fav_order,
	    			'standing_order' => $stand_order,
	    			'store_force_comment' => $_POST['store_force_comment'],
	    			'updated_by_ip' => $updated_at_IP
	    		);
	    	
	    	$order_id = $this->orders_model->placeOrder($order);
	    	
	    	if($order_id){
	    		foreach($items as $key => $item){
	    			if(is_numeric($item)){
	    				$item_id = $item;
	    			}else{
	    				$item_id = 0;
	    			}
	    			$item_price = $this->orders_model->get_item_price($item_id);
	    			foreach($item_price as $row1){
	    			    $price1 = $row1->price;
	    			}
		    		$order_details = array(
		    			'order_id' => $order_id,
		    			'item_id' => $item_id,
		    			'item_name' => $itemName[$key],
		    			'customer_id' => $customer_id,
		    			'quantity' => $qty[$key],
		    			'amount' => $amount[$key],
		    			'price' => $price1
		    		);
		    		$order_details = $this->orders_model->placeOrderItems($order_details);
		    	}
		    
		    	$this->db->trans_complete();
		    	
		    	if ($this->db->trans_status() === FALSE) {
		    		$data['message'] = 'fail';
		    		echo json_encode($data);
		    		return;
		    	}
		    
		    	// ======= Queue emails instead of sending synchronously =======
		    	$supplier_details = $this->orders_model->get_supplier_details($supplier);
		    	$branch_budget = $this->orders_model->get_branch_budget($branch_id);
		        $branchId = $this->session->userdata('branch_id');
                $branch_email = $this->orders_model->get_branch_email($branch_id);
		        foreach($branch_email as $email){
		               if($supplier == 107 || $supplier == 705 || $supplier == 418 || $supplier == 70 || $supplier == 129|| $supplier == 202|| $supplier == 389|| $supplier == 453|| $supplier == 524 || $supplier == 615){
		                    $AsahiNo = (!empty($email->AsahiNo) ? $email->AsahiNo : '');
		               }else{
		                   $AsahiNo = '';
		               }
		               $email_subject = (!empty($email->email_subject) ? $email->email_subject.' '.$AsahiNo.' New Order' : 'New Order');
		               $manager_emaill = $email->email;
				}
				
			if($branchId == 20){
				    $data['branch_id_text'] = 'All the delivery drivers must register with hospital security at the Hospital Main entry before the drop off.
All the delivery drivers must wear the mask before the café entry.
All the delivery drivers must sign with Victorian Government QR Code (QR code is on the Kitchen Back door or Front Red Bean Café front Entry). This is separate to hospital registration.
Please inform your delivery driver, Zouki staff may ask for evidence for registrations.
Our delivery instructions given according to the hospital delivery guidelines.
Thank you so much for your support and understanding';
				}

				$suppName = (isset($supplier_details[0]->supplier_name) ? $supplier_details[0]->supplier_name : '');

				// 1) Queue supplier order email
				if($supplier_email != ''){
					$data['order_id'] = $order_id;
					$data['order_number'] = '000'.$order_number;
					$data['branch_details'] = $branch_budget[0];
					$data['supplier_details'] = $supplier_details[0];
					$data['cc_mail'] = 'not_cc';
					$body = $this->load->view('orders/order_email', $data, TRUE);
					
					$this->orders_model->queue_email($supplier_email, '', $email_subject, $body, $order_id);
				}
				
				// 2) Queue CC supplier email
				if(!empty($supplier_cc)){
					$supplier_to = trim(implode(',', $supplier_cc), ', ');
					if($supplier_to != '') {
						$data['order_id'] = $order_id;
						$data['order_number'] = '000'.$order_number;
						$data['branch_details'] = $branch_budget[0];
						$data['supplier_details'] = $supplier_details[0];
						$data['cc_mail'] = 'cc';
						$body = $this->load->view('orders/order_email', $data, TRUE);
						
						$this->orders_model->queue_email($supplier_to, '', $email_subject, $body);
					}
				}

				// 3) Queue manager notification email
				if(isset($branch_budget[0]->email) && $branch_budget[0]->email != ''){
					$manager_cc = (isset($branch_budget[0]->ccEmail) && $branch_budget[0]->ccEmail != '') ? $branch_budget[0]->ccEmail : '';
					$this->orders_model->queue_email(
						$branch_budget[0]->email,
						$manager_cc,
						$suppName." Order Placed - Email Queued",
						"Order #000".$order_number." has been placed for ".$suppName.". Supplier email is queued for delivery."
					);
				}

				// 4) Queue force order admin notification
				if($_POST['store_force_comment'] != ''){
					$this->orders_model->queue_email(
						'kaushika@1800mycatering.com.au',
						'',
						"Supplier, Force Order Placed",
						"Hi Admin, A force order has been placed by ".$manager_emaill
					);
				}
				
				// Mark mail_status = 0 (queued, will be updated by cron after sending)
				$orderDataa = array('mail_status' => 0);
				$this->orders_model->updateOrderDetails($orderDataa, $order_id);
					
				//get branch budget
				$today_date = date('Y-m-d');
	    	
		    	//end date - cmng sunday
		    	for($k=0; $k<=6; $k++){
		    		$next_date = date('Y-m-d', strtotime("$today_date +$k day"));
		    		$next_week = date('l', strtotime($next_date));
		    		if($next_week == 'Sunday'){
		    			$end_date = $next_date;
		    			break;
		    		}
		    	}
		    	//start date - monday
		    	for($i=0; $i<=6; $i++){
		    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
		    		$prev_week = date('l', strtotime($prev_date));
		    		if($prev_week == 'Monday'){
		    			$start_date = $prev_date;
		    			break;
		    		}
		    	}
		    	
		    	$current_branch_id = $this->session->userdata('branch_id');
				$branch_budget = $this->orders_model->get_branch_budget($current_branch_id);
				$branch_orders = $this->orders_model->get_branch_orders($start_date,$end_date);
				
				$budget = $branch_budget[0]->branch_budget;
				$order_total = $branch_orders[0]->orderTotal;
				
				//get month orders
				$start_date = date('Y-m-01');
				$end_date = date('Y-m-t');
				$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
				$orders_count = count($total_orders);
				
				$balance = $budget - $order_total;
				
				$data['balance'] = $balance;
				$data['orders_balance'] = $orders_count;
				$data['message'] = 'success';
				
	    	}else{
	    		$this->db->trans_complete();
	    		$data['message'] = 'fail';
	    	}
    	}else{
    		$data['message'] = 'budget reached';
    	}
    	
    		
    	echo json_encode($data);
    }
    public function received_orders(){
	    $this->orderHistory('Received');
	}
	
    //order history
    public function orderHistory($order_Status=''){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
		    $filterData =array();
		    $data['filterstatus'] = array();
		    if(isset($_POST['from-date']) && $_POST['to-date']){
		        $filterData['fromDate']=$_POST['from-date'];
		        $filterData['toDate']=$_POST['to-date'];
		        $data['fromDate'] = $filterData['fromDate'];
				$data['toDate'] = $filterData['toDate'];
		    }
		    
		    if(isset($_POST['filterstatus']) && $_POST['filterstatus'] != ''){
		        $filterData['filterstatus']=$_POST['filterstatus'];
		        $data['filterstatus'] = $filterData['filterstatus'];
		    }
		   
		  //  echo "<pre>";print_r($filterData);exit;
		    
		   
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				/*menu items end */
				
				$orders = $this->orders_model->getBranchOrdersList($filterData,$order_Status);
// 			$this->output->enable_profiler(TRUE);
		
				//  	echo "<pre>";
				// print_r($orders);
				// exit;
				 $branch_budget = $this->orders_model->get_branch_budget($this->session->userdata('branch_id'));
    		    if(!empty($branch_budget)){
            		    $data['budget'] = $branch_budget[0]->branch_budget;
            		}
    			$branchBudgetBalance = $this->branchBudgetBalance(date('y-m-d'));
    		 
			
			     $data['orders'] = $orders;
			      $data['branchBudgetBalance'] = $branchBudgetBalance;
			      $data['spentsofarthisweek'] = $branch_budget[0]->branch_budget - $branchBudgetBalance;
				$this->load->view('general/header_general.php', $hdata);
				$this->load->view('orders/order_history',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    
    
    public function orderDetails($order_id){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			/*menu items end */ 
			$data['branch_id'] = $this->session->userdata('branch_id');
			$orderItems = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	    	$order_items = $this->orders_model->getOrderItems($order_id);
	   // 	echo '<pre>';print_r($order_items);exit;
	    	
	    	foreach($order_items as $order_item){
	    		$orderItems[$order_item->item_id] = $order_item->quantity;
	    		$order_item->Item_category  = $this->orders_model->getItemCategoriesByItemID($order_item->item_id);
	    	   
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
			
			//balance
			$supplier_balance = $this->getSupplierBudgetBalance($orders[0]->supplier_id);
    	
    		
    			$balance = $this->branchBudgetBalance();
				// $brahchBudgetData = $this->branchBudgetBalance(true);
				
				
    		
    		//get month orders to check orders limit
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');;
			$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
			$orders_count = count($total_orders);
			
			$subscription = $this->orders_model->getSubscriptionDetails();
			$orders_limit = $subscription[0]->no_of_orders;
			
			// echo '<pre>';print_r($branch_balance);exit;
			// echo '<pre>';print_r($items);exit;
			$data['suppliers'] = $items;
			$data['supplier_name'] = $supplier_details[0]->supplier_name;
			
			$data['supplier_budget'] = $supplier_balance;
			$data['branch_budget'] = $balance;
// 			$data['balanceThisWeek'] =   (isset($brahchBudgetData['balance']) ? $brahchBudgetData['balance'] : 0);
// 			$data['budgetThisWeek'] =   (isset($brahchBudgetData['budget']) ? $brahchBudgetData['budget'] : 0);
				
				
			$data['orders_count'] = $orders_count;
			$data['orders_limit'] = $orders_limit;
			
	    	$data['orderQty'] = $orderItems;
	    	$data['orders'] = $orders[0];
	    	$order_items = json_decode(json_encode($order_items), True);
	    	$data['order_items'] = json_encode($order_items,JSON_HEX_APOS);
	    	
			$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/order_details',$data);
			$this->load->view('general/footer');
		}
    }
    
    // function get_order_history(){
    // 	$id = $this->input->post('id');
    // 	$orders = $this->orders_model->get_order_history($id);
    // 	echo json_encode($orders[0]);
    // }
    
    public function orderSession(){
    	// $this->session->unset_userdata('suppliers');
    	// $this->session->unset_userdata('order_items');
    	$orders = $_POST['order'];
    	$suppliers = $_POST['suppliers'];
    	$this->session->set_userdata('order_items', $orders);
    	$this->session->set_userdata('suppliers', $suppliers);
    	
    }
    public function clearSession(){
    	$supId = $_POST['supplier_id'];
    	
    	$orders = json_decode($this->session->userdata('order_items'));
    	$suppliers = json_decode($this->session->userdata('suppliers'));
    	
		unset($orders->$supId);
    	unset($suppliers->$supId);
    	
    	$orders_obj = json_encode($orders);
    	$suppliers_obj = json_encode($suppliers,JSON_HEX_APOS);
    	
    	$this->session->set_userdata('order_items', $orders_obj);
    	$this->session->set_userdata('suppliers', $suppliers_obj);
    }
    
    public function getSupplierBudget(){
    	$supId = $_POST['supplier_id'];
    	$balance = $this->getSupplierBudgetBalance($supId);
    	$supplier_details = $this->orders_model->get_supplier_details($supId);
    	$data['supplier_email'] = $supplier_details[0]->email;
    	$data['supplier_cc'] = $supplier_details[0]->cc;
    	$data['contact_name'] = $supplier_details[0]->first_name;
    	$data['contact_number'] = $supplier_details[0]->mobile;
    	$data['balance'] = number_format($balance,2);
    	echo json_encode($data);
    }
    
    public function getSupplierBudgetBalance($supId){
    	
    	$today_date = date('Y-m-d');
    	
    	//end date - cmng sunday
    	for($k=0; $k<=6; $k++){
    		$next_date = date('Y-m-d', strtotime("$today_date +$k day"));
    		$next_week = date('l', strtotime($next_date));
    		if($next_week == 'Sunday'){
    			$end_date = $next_date;
    			break;
    		}
    	}
    	//start date - monday
    	for($i=0; $i<=6; $i++){
    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
    		$prev_week = date('l', strtotime($prev_date));
    		if($prev_week == 'Monday'){
    			$start_date = $prev_date;
    			break;
    		}
    	}
    	//get order total
    	$total = 0;
    	$order_total = $this->orders_model->getWeekOrderTotal($supId, $start_date,$end_date);
    	if(!empty($order_total)){
    		$total = $order_total[0]->orderTotal;
    	}
    	
    	$budget = 0;
    	$supBudget = $this->orders_model->getWeeklyBudget($supId);
    	if(!empty($supBudget)){
    		$budget = $supBudget[0]->weekly_budget;
    	}
    	
    	$balance = $budget - $total;
    	return $balance;
    }
    
    public function branchBudgetBalance($current_week=''){
        
    	//get branch budget
		$today_date = date('Y-m-d');
    	//end date - cmng sunday
    	for($k=0; $k<=6; $k++){
    		$next_date = date('Y-m-d', strtotime("$today_date +$k day"));
    		$next_week = date('l', strtotime($next_date));
    		if($next_week == 'Sunday'){
    			$end_date = $next_date;
    			break;
    		}
    	}
    	//start date - monday
    	for($i=0; $i<=6; $i++){
    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
    		$prev_week = date('l', strtotime($prev_date));
    		if($prev_week == 'Monday'){
    			$start_date = $prev_date;
    			break;
    		}
    	}
    
    	
    	$current_branch_id = $this->session->userdata('branch_id');
    	
		$branch_budget = $this->orders_model->get_branch_budget($current_branch_id);
		
	
		$branch_orders = $this->orders_model->get_branch_orders($start_date,$end_date);
		
		
	
	
		
		$order_total = 0;
		$budget = 0;
		
		if(!empty($branch_budget)){
			$budget = $branch_budget[0]->branch_budget;
		}
		if(!empty($branch_orders)){
			$order_total = $branch_orders[0]->orderTotal;
		}
		
	
		if($current_week !=''){
		    
		  // get order total amount of current week 
		$branch_currentWeekOrders = $this->orders_model->get_branch_orders_as_per_deliveryDate($current_week);
		
		$balance = $budget - ($branch_currentWeekOrders[0]->orderTotal !='' ? $branch_currentWeekOrders[0]->orderTotal : 0 );
// 			echo "<pre>";
// 				print_r($branch_currentWeekOrders);
// 				exit;
// 		 echo $balance; exit;
		return $balance;
		
		}else{
		    $balance = $budget - $order_total;
		    	return $balance;
		}
	

	
    }
    
    public function getproducts_suppliers(){
        	$supplier_id = $_POST['supplier_id'];
        	$search = $_POST['search'];
        	
        $supplieritems = $this->orders_model->fetch_supplier_items_byname($supplier_id, $search);
        
        if(!empty($supplieritems)){
		foreach($supplieritems as $items){
	
	 $table .= '<tr class="tr">';
	  $table .= '<td class="text-left">'. $items->itemCode.'</td>';
	 $table .= '<td class="text-left">'.$items->itemName.'<br><small>'. $items->supplier_name.'</small></td>';
	 $table .= '<td class="text-left">'.$items->category_name.'</td>';
	 $table .= '<td class="text-right">$'.number_format($items->price,2,'.','').'/'. $items->uom.'</td>
	 <td class="text-center">
	<div class="handle-counter">';
	 $table .= '<button class="counter-minus btn abc order" onclick="counterMinus(this,`'. $items->itemId.'`,`'. $items->supplierId.'`,`'. number_format($items->price,2,".","").'`,`'. $items->supplier_name.'`,`'. $items->itemName.'`)" tabindex="-1" >-</button>';
	$table .= '<input class="order" type="text"  value="0" id="'. $items->itemId.'" onchange="addItemToCart(this,`'. $items->itemId.'`,`'. $items->supplierId.'`,`'. number_format($items->price,2,'.','').'`,`'. $items->supplier_name.'`,`'. $items->itemName.'`)">';
	$table .= '<button class="counter-plus btn abc order " onclick="counterAdd(this,`'. $items->itemId.'`,`'. $items->supplierId.'`,`'. number_format($items->price,2,'.','').'`,`'. $items->supplier_name.'`,`'. $items->itemName.'`)" tabindex="-1" >+</button>';
	$table .= '</div>
	</td>
	</tr>';
										 }} 
										 echo $table;   
										 exit;
      
        
    }
    public function getSupplierItems(){
      
    	$supplier_id = $_POST['supplier_id'];
    	$category_id = $_POST['category_id'];
    	
    	$group_id = $this->session->userdata('groupId');
		$group_details = $this->orders_model->getUserGroupDetails($group_id);
		
    	if($supplier_id != 'all' && $category_id != 'all'){ //11
	    	if($group_details[0]->name == 'User'){
				$supplier_items = $this->orders_model->supplier_items_cat_users($supplier_id, $category_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}else{
				$supplier_items = $this->orders_model->supplier_items_cat($supplier_id, $category_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}
    	}else if($supplier_id == 'all' && $category_id != 'all'){ //01
    		$branch_suppliers = $this->orders_model->get_branch_suppliers();
			
			$items = array();
			if(!empty($branch_suppliers)){
				foreach($branch_suppliers as $supp){
					if($group_details[0]->name == 'User'){
						$supplier_items = $this->orders_model->supplier_items_cat_users($supp->supplier_id, $category_id);
						if(!empty($supplier_items)){
							$items[] = $supplier_items;
						}
					}else{
						$supplier_items = $this->orders_model->supplier_items_cat($supp->supplier_id, $category_id);
						if(!empty($supplier_items)){
							$items[] = $supplier_items;
						}
					}
				}
			}
    		
    	}else if($supplier_id != 'all' && $category_id == 'all'){ //10
    		if($group_details[0]->name == 'User'){
    		   
				$supplier_items = $this->orders_model->supplier_items_users($supplier_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}else{
			      
				$supplier_items = $this->orders_model->supplier_items($supplier_id);
				if(!empty($supplier_items)){
					$items[] = $supplier_items;
				}
			}
    	}else if($supplier_id == 'all' && $category_id == 'all'){//00
    		$branch_suppliers = $this->orders_model->get_branch_suppliers();
			
			$items = array();
			if(!empty($branch_suppliers)){
				foreach($branch_suppliers as $supp){
					if($group_details[0]->name == 'User'){
					  
						$supplier_items = $this->orders_model->supplier_items_users($supp->supplier_id);
						if(!empty($supplier_items)){
							$items[] = $supplier_items;
						}
					}else{
					 
						$supplier_items = $this->orders_model->supplier_items($supp->supplier_id);
						if(!empty($supplier_items)){
							$items[] = $supplier_items;
						}
					}
				}
			}
    	}
// 		echo '<pre>';print_r($items);exit;
		
		if(!empty($items)){
			$msg = '';
			foreach($items as $supplier_item){
				foreach($supplier_item as $item){
					$msg.='<tr class="tr">\n'
							.'<td class="text-left">'.$item->itemCode.'</td>'
							.'<td class="text-left">'.$item->itemName.'<br><small>'.$item->supplier_name.'</small></td>'
							.'<td class="text-left">'.$item->category_name.'</td>'
							.'<td class="text-right">'.number_format($item->price,2,'.','').'/'. $item->uom .'</td>'
							.'<td class="text-left">'
							.'<div class="handle-counter">'
								  .'<button class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`'.$item->itemId.'`,`'.$item->supplierId.'`,`'.number_format($item->price,2,'.','').'`,`'.$item->supplier_name.'`,`'.$item->itemName.'`)" >-</button>'
								  .'<input class="order" type="text" value="0" id="'.$item->itemId.'">'
								  .'<button class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`'.$item->itemId.'`,`'.$item->supplierId.'`,`'.number_format($item->price,2,'.','').'`,`'.$item->supplier_name.'`,`'.$item->itemName.'`)">+</button>'
								.'</div>'
							.'</td>'
						.'</tr>';
				}
			}
			
			echo $msg;
		}else{
			echo 'No Items available';
		}
		
		
    }
    
    public function updateOrder(){
    	$orders = json_decode($_POST['order']);
    	$supplier = $_POST['supplier_id'];
    	$order_number = $_POST['order_number'];
    	// print_r($orders);exit;
    	$orderId = $_POST['order_id'];
    	$delivery_date = date('Y-m-d', strtotime( $_POST['delivery_date']));
    	$comments = $_POST['comments'];
    	$supp_order = $orders->$supplier;
    	
    	$items = $supp_order->item;
    	$qty = $supp_order->qty;
    	$amount = $supp_order->amount;
    	
    	$user_id = $this->session->userdata('user_id');
    	$customer_id = $this->session->userdata('customerId');
    	$branch_id = $this->session->userdata('branch_id');
    	$total = 0;
    	foreach($amount as $amnt){
    		$total = $total+$amnt;
    	}
    	
    	$supplier_balance = $this->getSupplierBudgetBalance($supplier);
    // 	$branch_balance = $this->branchBudgetBalance();
    // 	$brahchBudgetData = $this->branchBudgetBalance(true);
    // 	$branch_balance =  (isset($brahchBudgetData['balance']) ? $brahchBudgetData['balance'] : 0);
    
    	
    
    		
	    	$order = array(
	    			'order_date' => date('Y-m-d H:i:s'),
	    			'order_status' => 'Sent',
	    			'order_by' => $user_id,
	    			'delivery_date' => $delivery_date,
	    			'comments' => $comments,
	    			'supplier_id' => $supplier,
	    			'order_total' => $total,
	    			'customer_id' => $customer_id,
	    			'branch_id' => $branch_id,
	    			'store_force_comment' => $_POST['store_force_comment']
	    		);
	    		
	    	$update_order_id = $this->orders_model->updateOrderDetails($order, $orderId);
	    	
	    	if($update_order_id){
	    		
	    		//remove existing and adding updated items
	    		$order_details = $this->orders_model->deleteOrderItems($orderId);
	    		
	    		foreach($items as $key => $item){
	    		    $item_price = $this->orders_model->get_item_price($item);
	    			foreach($item_price as $row1){
	    			    $price1 = $row1->price;
	    			}
		    		$order_details = array(
		    			'order_id' => $orderId,
		    			'item_id' => $item,
		    			'customer_id' => $customer_id,
		    			'quantity' => $qty[$key],
		    			'amount' => $amount[$key],
		    			'price' => $price1
		    		
		    		);
		    		
		    		$order_details = $this->orders_model->placeOrderItems($order_details);
		    	}
		    	
		    	$supplier_details = $this->orders_model->get_supplier_details($supplier);
		    	$supDetails = $supplier_details[0];
		    	$branch_budget = $this->orders_model->get_branch_budget($branch_id);
                 $branch_email = $this->orders_model->get_branch_email($branch_id);
		          foreach($branch_email as $email){
		               $EmailCurrentBranch = (isset($email->email) ? $email->email : 'kaushika_jinna@yahoo.com');
		              
		               if($supplier == 107 || $supplier == 705 || $supplier == 418 || $supplier == 70 || $supplier == 129|| $supplier == 202|| $supplier == 389|| $supplier == 453|| $supplier == 524 || $supplier == 615){
		                    $AsahiNo = (!empty($email->AsahiNo) ? $email->AsahiNo : '');
		               }else{
		                   $AsahiNo = '';
		               }
		               $email_subject = (!empty($email->email_subject) ? $email->email_subject.' '.$AsahiNo.' New Order' : 'New Order');
		              
		                 $manager_emaill = $email->email;
				}
		    	
				if($branch_id == 20){
				    
				    $data['branch_id_text'] = 'All the delivery drivers must register with hospital security at the Hospital Main entry before the drop off.
All the delivery drivers must wear the mask before the café entry.
All the delivery drivers must sign with Victorian Government QR Code (QR code is on the Kitchen Back door or Front Red Bean Café front Entry). This is separate to hospital registration.
Please inform your delivery driver, Zouki staff may ask for evidence for registrations.
Our delivery instructions given according to the hospital delivery guidelines.
Thank you so much for your support and understanding';
				}
				$from_email = 'cafeadorders@gmail.com';
				if($supDetails->email != ''){
					$to = $supDetails->email;
					$cc = $supDetails->cc;
				// 	$this->email->set_newline("\r\n");
				// 	$this->email->from($from_email, 'Zouki'); 
				// 	$this->email->to($to);
				// 	$this->email->cc($cc);
				// 	$this->email->subject('Update Order');
					$data['order_id'] = $orderId;
					$data['order_number'] = $order_number;
					$data['branch_details'] = $branch_budget[0];
					$data['supplier_details'] = $supplier_details[0];
					$body = $this->load->view('orders/order_email', $data,TRUE);
				// 	$this->email->message($body);
				// 	$send = $this->email->send();
					
					 $this->_init_email();
					 $this->phpmailermail->isHTML(true);
					 $this->phpmailermail->addAddress($to);
                     $this->phpmailermail->Subject = 'Update Order Recieved';
                     $this->phpmailermail->Body = $body;
                     
                   
                     
                     
                     
                      // for notifying Managers if mail sent to supplier successfull or not 
                     $suppName =   (isset($supplier_details[0]->supplier_name) ? $supplier_details[0]->supplier_name : '' );
                     if($this->phpmailermail->send()){
                 
                     $this->phpmailermail->ClearAddresses();
                     $this->phpmailermail->addAddress($branch_budget[0]->email);
                     if(isset($branch_budget[0]->ccEmail) && $branch_budget[0]->ccEmail !=''){
                     $this->phpmailermail->addAddress($branch_budget[0]->ccEmail);    
                     }
                    // $this->phpmailermail->addAddress("kohliaditya@yahoo.com");
					 $this->phpmailermail->Subject = $suppName." Email sent Successful";
					 $this->phpmailermail->Body ="Order Email Sent Succesfully To ".$suppName;
                     $this->phpmailermail->send();
                     
                       // fopr sending force order mail
                     if($_POST['store_force_comment'] !=''){
                     $this->phpmailermail->ClearAddresses();
                     $this->phpmailermail->addAddress('kaushika@1800mycatering.com.au');
					 $this->phpmailermail->Subject = "Supplier,Force Order Placed";
					 $this->phpmailermail->Body ="Hi Admin, A force order has been placed by ".$manager_emaill;
                     $this->phpmailermail->send(); 
                     }
                       
                         
                     }else{
                     $this->phpmailermail->ClearAddresses();
                     $this->phpmailermail->addAddress($branch_budget[0]->email);
					$this->phpmailermail->Subject = $suppName." Email sent Failed";
					$this->phpmailermail->Body ="Unable To Send Mail To ".$suppName;
                    $this->phpmailermail->send();     
                         
                     }
				}
				
				$msg = 'success';
				
	    	}else{
	    		$msg = 'fail';
	    	}
    
    	
    	echo $msg;
    	
    }
    
    public function viewSupplierOrder($order_id,$type=''){
    	$orders = $this->orders_model->getOrderDetails($order_id);
    	
    	if($orders[0]->status == 0){
    	    
    	    echo "<h3>Your Order has been canceled,Please contact us for more information. Thanks !</h3>";
    	    exit;
    	}
    
	    $order_items = $this->orders_model->getOrderItems($order_id);
	   // echo "<pre>";print_r($order_items);exit;
	    $supplier_details = $this->orders_model->get_supplier_details($orders[0]->supplier_id);
	    $customer_details = $this->orders_model->get_customer_details($orders[0]->customer_id);
	    $branch_details = $this->orders_model->get_branch_budget($orders[0]->branch_id);
	    
	    //update order status to viewed
	  
	    if($orders[0]->order_status == 'Sent' && ($type == 'not_cc' || $type == '')){
	      
	    	$this->orders_model->updateOrderStatus($order_id);
	    }
	    
	    // echo '<pre>';print_r($orders);exit;
	    
	    $data['order'] = $orders[0];
	    $data['order_items'] = $order_items;
	    $data['supplier'] = $supplier_details[0];
	    $data['customer'] = $customer_details[0];
	    $data['branch_details'] = $branch_details[0];
    	
		$this->load->view('orders/supplier_order_details', $data);
		
    }
    
    public function modifyOrderStatus(){
        if($_POST['order_number']){
           
           $res = $this->orders_model->modifyOrderStatus($_POST['order_number'],$_POST['order_status']);
        	if($res){
        	    echo "success";
        	}else{
        	    echo "failed";
        	}
        	
        }else{
            
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
            
            
            
            
          $this->load->view('general/header_general.php', $hdata);
         	$this->load->view('auth/modifyStatus');   
        }
        	
    }
    
    public function confirmOrder(){
    	$order_id = $_POST['order_id'];
    	$comments = $_POST['comments'];
    	$supplier_comments = $_POST['supplier_comments'];
    	$details['comments'] = $comments;
    	$details['supplier_comments'] = $supplier_comments;
    	$details['order_status'] = 'Confirmed';
    	$details['order_confirmed_on'] = date('Y-m-d H:i:s');
    	
    	$update = $this->orders_model->updateOrderDetails($details, $order_id);
    	if($update){
    		$this->session->set_flashdata("update_sucess_msg","Order has been confirmed."); 
    		redirect('orders/viewSupplierOrder/'.$order_id);
    	}else{
    		$this->session->set_flashdata("update_error_msg","Unable to confirm order"); 
    		redirect('orders/viewSupplierOrder/'.$order_id);
    	}
    }
    
    //favouriteOrders
    public function favouriteOrders(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				/*menu items end */
				$orders = $this->orders_model->getFavouriteOrders();
				//echo '<pre>';print_r($orders);exit;
				$data['orders'] = $orders;
				$this->load->view('general/header_general.php', $hdata);
				$this->load->view('orders/favourite_orders',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    public function favOrderDetails($order_id){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			/*menu items end */ 
			$orderItems = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	    	$order_items = $this->orders_model->getOrderItems($order_id);
	    	
	    	foreach($order_items as $order_item){
	    		$orderItems[$order_item->item_id] = $order_item->quantity;
	    	}
	    	// echo '<pre>';print_r($order_items);exit;
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
			
			//balance
			$supplier_balance = $this->getSupplierBudgetBalance($orders[0]->supplier_id);
    		$branch_balance = $this->branchBudgetBalance();
    		
    		//get month orders to check orders limit
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');;
			$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
			$orders_count = count($total_orders);
			
			$subscription = $this->orders_model->getSubscriptionDetails();
			$orders_limit = $subscription[0]->no_of_orders;
			
			// echo '<pre>';print_r($branch_balance);exit;
			// echo '<pre>';print_r($order_items);exit;
			$data['suppliers'] = $items;
			$data['supplier_name'] = $supplier_details[0]->supplier_name;
			
			$data['supplier_budget'] = $supplier_balance;
			$data['branch_budget'] = $branch_balance;
			$data['orders_count'] = $orders_count;
			$data['orders_limit'] = $orders_limit;
			
	    	$data['orderQty'] = $orderItems;
	    	$data['orders'] = $orders[0];
	    	$order_items = json_decode(json_encode($order_items), True);
	    	$data['order_items'] = json_encode($order_items,JSON_HEX_APOS);
			$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/fav_order_details',$data);
			$this->load->view('general/footer');
		}
    }
    
    public function placeNewOrders(){
        
//         ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    	$orders = json_decode($_POST['order']);
    	$supplier = $_POST['supplier_id'];
    	$delivery_date = $_POST['delivery_date'];
    	$order_date = $_POST['order_date'];
    	$comments = $_POST['comments'];
    	$supp_order = $orders->$supplier;
    	
    	$supplier_cc = json_decode($_POST['supp_cc']);
    	$supplier_email = $_POST['supp_email'];
    	
    	$items = $supp_order->item;
    	
    	$qty = $supp_order->qty;
    	$amount = $supp_order->amount;
    	$itemName = $supp_order->itemName;
    	
    	$user_id = $this->session->userdata('user_id');
    	$customer_id = $this->session->userdata('customerId');
    	$branch_id = $this->session->userdata('branch_id');
    	$total = 0;
    	foreach($amount as $amnt){
    		$total = $total+$amnt;
    	}
    	
    	$supplier_balance = $this->getSupplierBudgetBalance($supplier);
    	$branch_balance = $this->branchBudgetBalance();
    	
    	if($supplier_balance >= $total && $branch_balance >= $total){
    		$last_order = $this->orders_model->getLastOrder();
    		$last_ord_no = $last_order[0]->order_number;
    		$order_number = (int)$last_ord_no + 1;
	    	$order = array(
	    			'order_date' => date('Y-m-d', strtotime($order_date)),
	    			'order_status' => 'Sent',
	    			'order_by' => $user_id,
	    			'delivery_date' => date('Y-m-d', strtotime($delivery_date)),
	    			'comments' => $comments,
	    			'supplier_id' => $supplier,
	    			'order_total' => $total,
	    			'customer_id' => $customer_id,
	    			'branch_id' => $branch_id,
	    			'order_number' => '000'.$order_number
	    		);
	    	
	    	$order_id = $this->orders_model->placeOrder($order);
	    	if($order_id){
	    		foreach($items as $key => $item){
	    			if(is_numeric($item)){
	    				$item_id = $item;
	    			}else{
	    				$item_id = 0;
	    			}
                    $item_price = $this->orders_model->get_item_price($item_id);
	    			foreach($item_price as $row1){
	    			    $price1 = $row1->price;
	    			}	    			
		    		$order_details = array(
		    			'order_id' => $order_id,
		    			'item_id' => $item_id,
		    			'item_name' => $itemName[$key],
		    			'customer_id' => $customer_id,
		    			'quantity' => $qty[$key],
		    			'amount' => $amount[$key],
		    			'price' => $price1
		    		);
		    		
		    		$order_details = $this->orders_model->placeOrderItems($order_details);
		    	}
		    	
		    	$supplier_details = $this->orders_model->get_supplier_details($supplier);
		    	$branch_budget = $this->orders_model->get_branch_budget($branch_id);
				
				$from_email = 'cafeadorders@gmail.com';
				
				if($branch_id == 20){
				    
				    $data['branch_id_text'] = 'All the delivery drivers must register with hospital security at the Hospital Main entry before the drop off.
All the delivery drivers must wear the mask before the café entry.
All the delivery drivers must sign with Victorian Government QR Code (QR code is on the Kitchen Back door or Front Red Bean Café front Entry). This is separate to hospital registration.
Please inform your delivery driver, Zouki staff may ask for evidence for registrations.
Our delivery instructions given according to the hospital delivery guidelines.
Thank you so much for your support and understanding';
				}
				
				if($supplier_email != ''){
					$to = $supplier_email;
					$cc = implode(',', $supplier_cc);
				// 	$this->email->set_newline("\r\n");
				// 	$this->email->from($from_email, 'Zouki'); 
				// 	$this->email->to($to);
				// 	$this->email->cc($cc);
				// 	$this->email->subject('New Order');
					$data['order_id'] = $order_id;
					$data['order_number'] = '000'.$order_number;
					$data['branch_details'] = $branch_budget[0];
					$data['supplier_details'] = $supplier_details[0];
					$body = $this->load->view('orders/order_email', $data,TRUE);
				
				// 	$send = $this->email->send();
				
				$branch_email = $this->orders_model->get_branch_email($branch_id);
		          foreach($branch_email as $email){
		               
		               if($supplier == 107 || $supplier == 705 || $supplier == 418 || $supplier == 70 || $supplier == 129|| $supplier == 202|| $supplier == 389|| $supplier == 453|| $supplier == 524 || $supplier == 615){
		                    $AsahiNo = (!empty($email->AsahiNo) ? $email->AsahiNo : '');
		               }else{
		                   $AsahiNo = '';
		               }
		               $email_subject = (!empty($email->email_subject) ? $email->email_subject.' '.$AsahiNo.' New Order' : 'New Order');
		              
		               $manager_emaill = $email->email;
				}
				
				
				     $this->phpmailermail->isHTML(true);
				     $this->phpmailermail->Subject = $email_subject;
					 $this->phpmailermail->addAddress($to);
					 $this->phpmailermail->AddCC($cc);
                     $this->phpmailermail->Body = $body;
                     
                    $suppName =   (isset($supplier_details[0]->supplier_name) ? $supplier_details[0]->supplier_name : '' );
                    
                     if($this->phpmailermail->send()){
                         
                     $this->phpmailermail->ClearAddresses();
                     $this->phpmailermail->ClearCCs();
                     $this->phpmailermail->addAddress($branch_budget[0]->email);
                     if(isset($branch_budget[0]->ccEmail) && $branch_budget[0]->ccEmail !=''){
                     $this->phpmailermail->addAddress($branch_budget[0]->ccEmail);    
                     }
                     
					 $this->phpmailermail->Subject = $suppName." Email sent Successful";
					 $this->phpmailermail->Body ="Order Email Sent Succesfully To ".$suppName;
                     $this->phpmailermail->send();

                     }else{
                         
                    $this->phpmailermail->ClearAddresses();
                    $this->phpmailermail->ClearCCs();
                    $this->phpmailermail->addAddress($branch_budget[0]->email);
					$this->phpmailermail->Subject = $suppName." Email sent Failed";
					$this->phpmailermail->Body ="Unable To Send Mail To ".$suppName;
                    $this->phpmailermail->send();     
                         
                     }
                     
				}
				$message = 'success';
				
	    	}else{
	    		$message = 'fail';
	    	}
    	}else{
    		$message = 'budget reached';
    	}
    	
    	echo $message;
    }
    
    //standingOrders
    public function standingOrders(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				/*menu items end */
				$orders = $this->orders_model->getStandingOrders();
				//echo '<pre>';print_r($orders);exit;
				$data['orders'] = $orders;
				$this->load->view('general/header_general.php', $hdata);
				$this->load->view('orders/standing_orders',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    
    public function standingOrderDetails($order_id){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			/*menu items end */ 
			$orderItems = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	    	$order_items = $this->orders_model->getOrderItems($order_id);
	    	
	    	foreach($order_items as $order_item){
	    		$orderItems[$order_item->item_id] = $order_item->quantity;
	    	}
	    	// echo '<pre>';print_r($orderItems);exit;
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
			
			//balance
			$supplier_balance = $this->getSupplierBudgetBalance($orders[0]->supplier_id);
    		$branch_balance = $this->branchBudgetBalance();
    		
    		//get month orders to check orders limit
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');;
			$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
			$orders_count = count($total_orders);
			
			$subscription = $this->orders_model->getSubscriptionDetails();
			$orders_limit = $subscription[0]->no_of_orders;
			
			// echo '<pre>';print_r($branch_balance);exit;
			// echo '<pre>';print_r($order_items);exit;
			$data['suppliers'] = $items;
			$data['supplier_name'] = $supplier_details[0]->supplier_name;
			
			$data['supplier_budget'] = $supplier_balance;
			$data['branch_budget'] = $branch_balance;
			$data['orders_count'] = $orders_count;
			$data['orders_limit'] = $orders_limit;
			
	    	$data['orderQty'] = $orderItems;
	    	$data['orders'] = $orders[0];
	    	$order_items = json_decode(json_encode($order_items), True);
	    	$data['order_items'] = json_encode($order_items,JSON_HEX_APOS);
			$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/standing_order_details',$data);
			$this->load->view('general/footer');
		}
    }
    
    
    function fav_order_update() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res=$this->orders_model->fav_order_update($id);
			redirect('orders/favouriteOrders');
		}
	}
	
	function standing_order_update() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res=$this->orders_model->standing_order_update($id);
			redirect('orders/standingOrders');
		}
	}
	
	public function receiveOrder($order_id){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			/*menu items end */ 
			
			$orderItems = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	   // 	$order_items = $this->orders_model->getonlyOrderItems($order_id);
	    		$order_items = $this->orders_model->getOrderItems($order_id);
	    
	    	
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
			
			//balance
			$supplier_balance = $this->getSupplierBudgetBalance($orders[0]->supplier_id);
    		$branch_balance = $this->branchBudgetBalance();
    		
    		//get month orders to check orders limit
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');;
			$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
			$orders_count = count($total_orders);
			
			$subscription = $this->orders_model->getSubscriptionDetails();
			$orders_limit = $subscription[0]->no_of_orders;
			
			// echo '<pre>';print_r($branch_balance);exit;
// 			echo '<pre>';print_r($order_items);exit;
			$data['suppliers'] = $items;
			$data['supplier_name'] = $supplier_details[0]->supplier_name;
			
			$data['supplier_budget'] = $supplier_balance;
			$data['branch_budget'] = $branch_balance;
			$data['orders_count'] = $orders_count;
			$data['orders_limit'] = $orders_limit;
			
	    	
	    	$data['orderQty'] = $orderItems;
	    	$data['orders'] = $orders[0];
	    	$data['order_id'] = $order_id;
	    	
	    	
	    	$order_items = json_decode(json_encode($order_items), True);
	   
	      
	   // echo '<pre>';print_r($order_items);exit;
	    	
	    	$data['order_items'] = json_encode($order_items,JSON_HEX_APOS);
	    	
	    	
	    	
	      
	    	
			$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/receive_orders',$data);
			$this->load->view('general/footer');
		}
    }
    
    public function cancelorder(){
      
      $order_id = $_POST['order_id'];
      
      $order = array(
          
    			'status' => 0,
    			
    		);
    		
    		
    		
    	$update_order_id = $this->orders_model->cancelorder($order, $order_id);  
    	
    	redirect('orders/orderHistory/');
    	
    
        
    }
    
   public function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}
public function updateOrderDetailsApprovereject($status,$ItemId,$OrderId){
    	$update_order_id = $this->orders_model->updateOrderDetailsApprovereject($status,$ItemId,$OrderId);
}
    public function updateReceiveOrder(){
        
        
        // approve or reject items data save =======================17-08-2021
    	$orders = json_decode($_POST['selected_item_for_approved_rejected']);
    	$all_checked_itesm = explode(",",$_POST['selected_item_for_approved_rejected']);

    if(is_array($all_checked_itesm)){
    	foreach($all_checked_itesm as $key => $all_checked_item){
        if(isset($all_checked_item) && $all_checked_item !=''){
         $statusdetails = explode("_",$all_checked_item);
       $this->updateOrderDetailsApprovereject($statusdetails[0],$statusdetails[1],$_POST['order_id']);
          }

    	  }
    }
    
    // End =========================================================
    	$supplier = $_POST['supplier_id'];
    	$orderId = $_POST['order_id'];
    	$received_date = $_POST['received_date'];
    	
    		$Any_return = $_POST['Any_return'];
    		$Packaged_according_to_food = $_POST['Packaged_according_to_food'];
    		$Any_breakage = $_POST['Any_breakage'];
    		
    	$comments = $_POST['comments'];
    	$received_items = json_decode($_POST['received_items']);
    	$temp_recording = $_POST['temp_record'];
    	$signature = $_POST['signature'];
    	$credits = $_POST['credits'];
    	$paid = $_POST['paid'];
    	$supp_order = $orders->$supplier;
    	
    	
    		$order = array(
    			'order_status' => 'Received',
    			'received_on' => date('Y-m-d', strtotime($received_date)),
    			'order_status_received_chnaged_date' => date('Y-m-d'),
    			'comments' => $comments,
    			'temp_recording' => $temp_recording,
    			'signature' => $signature,
    			'credits' => $credits,
    			'paid' => $paid,
    			'Any_return' => $Any_return,
    			'Packaged_according_to_food' => $Packaged_according_to_food,
    			'Any_breakage' => $Any_breakage,
    		);
    	
    	
	    
    	$update_order_id = $this->orders_model->updateOrderDetails($order, $orderId);
    	
    // 	$items = $supp_order->item;
    // 	$itemName = $supp_order->itemName;
    // 	$qty = $supp_order->qty;
    // 	$amount = $supp_order->amount;
    	
    // 	$user_id = $this->session->userdata('user_id');
    // 	$customer_id = $this->session->userdata('customerId');
    // 	$branch_id = $this->session->userdata('branch_id');
    // 	$total = 0;
    // 	foreach($amount as $amnt){
    // 		$total = $total+$amnt;
    // 	}
    	
    // 	$supplier_balance = $this->getSupplierBudgetBalance($supplier);
    // 	$branch_balance = $this->branchBudgetBalance();
    	
    // 	$msg ='';
    // 	$order = array(
    // 			'order_status' => 'Received',
    // 			'received_on' => date('Y-m-d', strtotime($received_date)),
    // 			'comments' => $comments,
    // 			'order_total' => $total,
    // 			'temp_recording' => $temp_recording,
    // 			'signature' => $signature,
    // 			'credits' => $credits,
    // 			'paid' => $paid
    // 		);
    	
    	
	    
    // 	$update_order_id = $this->orders_model->updateOrderDetails($order, $orderId);
    	
    	
    // 	if($update_order_id){
    // 		//remove existing and adding updated items
    		
    // 		$order_details = $this->orders_model->deleteOrderItems($orderId);
    		
    		
    	
    // 		foreach($items as $key => $item){
	   // 		if(is_numeric($item)){
    // 				$item_id = $item;
    // 			}else{
    // 				$item_id = 0;
    // 			}
    // 			if(in_array($item, $received_items)){
    // 				$rec = 1;
    // 			}else{
    // 				$rec = 0;
    // 			}
    // 			$item_price = $this->orders_model->get_item_price($item_id);
	   // 			foreach($item_price as $row1){
	   // 			    $price1 = $row1->price;
	   // 			}
	   // 		$order_details = array(
	   // 			'order_id' => $orderId,
	   // 			'item_id' => $item_id,
	   // 			'item_name' => $itemName[$key],
	   // 			'customer_id' => $customer_id,
	   // 			'quantity' => $qty[$key],
	   // 			'amount' => $amount[$key],
	   // 			'price' => $price1,
	   // 			'items_received' => $rec
	   // 		);
	    		
	    		
	    		
	   // 		$order_details = $this->orders_model->placeOrderItems($order_details);
	   // 	}
	    	
	    	
	   // 	$msg = 'success';
	   // 	$this->session->set_flashdata("sucess_msg","Order updated successfully"); 
			
    // 	}else{
    // 		$msg = 'fail';
    // 		$this->session->set_flashdata("error_msg","Unable to update order"); 
    // 	}
    	
    // 	echo $msg;
    echo 'success';
    }
    
     
    public function copy_supp(){
         ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
          $this->load->model('orders_model');
         $br = $this->orders_model->copy_supp();
         
         foreach($br as $b){
             $data = array(
                 'supplier_id' => $b->supplier_id,
                 'branch_id' => 59,
                 'weekly_budget'=> $b->weekly_budget,
                 'customer_id' => 14
                 
                 );
             
            $this->orders_model->insert_supp($data); 
            echo "inserted ".$b->supplier_id;
         }
       
	exit;
		
    }
     public function uploadInvoice(){
    	$invoice_id = $this->uri->segment(3);
    	$orderId = $this->uri->segment(4);
    	
    	// Map invoice type to upload folder and DB field
    	$invoice_map = array(
    	    'invoice_copy'   => 'assets/docs/invoices/',
    	    'invoice_copy_1' => 'assets/docs/invoices_1/',
    	    'invoice_copy_2' => 'assets/docs/invoices_2/',
    	    'invoice_copy_3' => 'assets/docs/invoices_3/'
    	);
    	
    	if (!isset($invoice_map[$invoice_id])) return;
    	
    	$upload_path = $invoice_map[$invoice_id];
    	
		$config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 10000;
        $config['max_width']     = 5000;
        $config['max_height']    = 5000;
        $config['file_name'] = $_FILES['file']['name'];

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $picture = $uploadData['file_name'];
            
            // Compress uploaded image (skips PDFs)
            $this->_compress_image($uploadData['full_path']);
        }else{
            $picture = '';
        }
        $filename = str_replace(' ','_',$_FILES['file']['name']);

        $data = array(
            $invoice_id => $filename,
        );
        $res = $this->orders_model->updateInvoice($data, $orderId);
  
    }
    
    public function upload_damaged_file($orderId){
    	$config['upload_path'] = 'assets/docs/damaged_file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']             = 10000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
        $config['file_name'] = $_FILES['file']['name'];
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $picture = $uploadData['file_name'];
            
            // Compress uploaded image (skips PDFs)
            $this->_compress_image($uploadData['full_path']);
        }else{
            $picture = '';
        }
        
        $filename = str_replace(' ','_',$_FILES['file']['name']);
        
        $data = array(
            'damaged_goods_file' => $filename,
            );
            //echo $orderId;exit;
        //echo '<pre>';print_r($data);exit;    
        $res = $this->orders_model->updateInvoice($data, $orderId);
        $msg = "<div class='panel-heading ph-dash'>
					<div class='col-md-6'>
					<h3 class='' style='float:left;'>Damaged Goods</h3>
					</div>
					<div class='col-md-2' style='text-align:right;padding-right:0px;'>
						<a style='margin-top:4px;width:100%' class='btn btn-success' href=".base_url('').'assets/docs/damaged_file/'.$filename." target='_blank'>View</a>
					</div>
					<div class='col-md-2' style='text-align:right;padding-right:0px;'>
						<a type='button' style='margin-top:4px;width:100%' class='btn btn-success' onClick='delete_row_damaged(".$orderId.");'>Delete</a>
					</div>
					<div style='clear:both;'></div>
			    </div>
			    <div class='panel-body'>
			    	<div class='row'>
			    		<div class='col-md-12'>
						<embed src=".base_url('').'assets/docs/damaged_file/'.$filename." style='width:100%;min-height:600px;' alt='image1' class='upload-file'>
			    		</div>
			    	  </div>
			    	<div>
			    </div>
			   </div>";
        
        //echo $msg;
    }
    public function deleteInvoice(){
    	$order_id = $_POST['order_id'];
    	$field_name = $_POST['field_name'];
    	$foldername = $_POST['foldername'];
    	
    	$orders = $this->orders_model->getOrderDetails($order_id);
    	$invoice = $orders[0]->$field_name;
    	$file = FCPATH.'assets/docs/'.$foldername.'/'.$invoice;
    	// echo $file;exit;
    	unlink($file);
    	
    	$data = array(
            $field_name => '',
            );
        $res = $this->orders_model->updateInvoice($data, $order_id);
    }
    public function deleteInvoice_damaged(){
    	$order_id = $_POST['order_id'];
    	$orders = $this->orders_model->getOrderDetails($order_id);
    	$invoice = $orders[0]->damaged_goods_file;
    	$file = FCPATH.'assets/docs/damaged_file/'.$invoice;
    	// echo $file;exit;
    	unlink($file);
    	
    	$data = array(
            'damaged_goods_file' => '',
            );
        $res = $this->orders_model->updateInvoice($data, $order_id);
    }
    public function receiveOrderDetails($order_id){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
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
			/*menu items end */ 
			
			$orderItems = array();
	    	$orders = $this->orders_model->getOrderDetails($order_id);
	    	$order_items = $this->orders_model->getonlyOrderItems($order_id);
	    	
	    		
	   // 	echo $order_id; exit;
	   // 	echo '<pre>';print_r($order_items);exit;
	    	
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
			
			//balance
			$supplier_balance = $this->getSupplierBudgetBalance($orders[0]->supplier_id);
    		$branch_balance = $this->branchBudgetBalance();
    		
    		//get month orders to check orders limit
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-t');;
			$total_orders = $this->orders_model->getAllOrders($start_date, $end_date);
			$orders_count = count($total_orders);
			
			$subscription = $this->orders_model->getSubscriptionDetails();
			$orders_limit = $subscription[0]->no_of_orders;
			
			// echo '<pre>';print_r($branch_balance);exit;
// 			echo '<pre>';print_r($order_items);exit;
			$data['suppliers'] = $items;
			$data['supplier_name'] = $supplier_details[0]->supplier_name;
			
			$data['supplier_budget'] = $supplier_balance;
			$data['branch_budget'] = $branch_balance;
			$data['orders_count'] = $orders_count;
			$data['orders_limit'] = $orders_limit;
		
	    	$data['orderQty'] = $orderItems;
	    	$data['orders'] = $orders[0];
	    	
	    	$order_items = json_decode(json_encode($order_items), True);
	    	
	    	
	    
	    	
	    	$data['order_items'] = json_encode($order_items,JSON_HEX_APOS);
	   // 		echo '<pre>';print_r($data['order_items']);exit;
			$this->load->view('general/header_general.php', $hdata);
			$this->load->view('orders/receive_order_details',$data);
			$this->load->view('general/footer');
		}
    }
    public function updateOrderItemStatus(){
     	$order_id = $_POST['order_id'];
     	$status = $_POST['status'];
     	
     	if(isset($_POST['ids'])){
     	    $item_ids = explode(",",$_POST['ids']);
     	    $details = array(
         	    'status'    =>  $status
         	 );
         	 
     	    foreach($item_ids as $item_id){
     	        
         	    $group_details = $this->orders_model->updateOrderItemStatus($order_id,$item_id,$details);
     	    }
     	}else{
         	$item_id = $_POST['item_id'];
         	$status = $_POST['status'];
         	$details = array(
         	    'status'    =>  $status
         	    );
         	$group_details = $this->orders_model->updateOrderItemStatus($order_id,$item_id,$details);
     	}
    }
    public function getLastYearOrders(){
        return true;
    	for ($i = 0; $i <= 11; $i++) {
		    $months[] = date("Y-m-01", strtotime( date( 'Y-m-01' )." -$i months"));
		}
		// print_r($months);
		foreach($months as $month){
			$start_date = $month;
			$end_date = date('Y-m-30', strtotime($month));
			$label = date('M - y', strtotime($month));
			$weeks[] = $label;
			$order_totals = $this->orders_model->get_monthly_branch_orders($start_date,$end_date);
			if($order_totals[0]->orderTotal != ''){
				$orders[] = $order_totals[0]->orderTotal;
			}else{
				$orders[] = 0;
			}
		}
		//echo '<pre>';print_r($orders);
		//echo round($orders, 2);
		$data['labels'] = array_reverse($weeks);
		$data['order'] = array_reverse($orders);
		echo json_encode($data);
    }
    
    public function getSupplierLastMonth(){
        return true;
    	$start_date = date('Y-m-01');
    	$end_date = date('Y-m-30');
    	$orders = $this->orders_model->getAllMonthlyOrders($start_date,$end_date);
    	$supp_orders = array();
    	
    	foreach($orders as $order){
    		$supp_orders[$order->supplier_id]['supplier_name'] = $order->supplier_name;
    		$supp_orders[$order->supplier_id]['items'][] = $order;
    	}
    	
    	$final_suppliers = array(['Supplier', 'Order total']);
    	
    	foreach($supp_orders as $supp_items){
    		$final_totals = array();
    		$order_totals = 0;
    		// $final_suppliers[] = $supp_items['supplier_name'];
    		foreach($supp_items['items'] as $items){
    			$order_totals = $order_totals + $items->order_total;
    		}
    		$final_totals[0] = $supp_items['supplier_name'];
    		$final_totals[1] = $order_totals;
    		
    		array_push($final_suppliers, $final_totals);
    	}
    	// print_r($final_suppliers);exit;
    	$data['order_totals'] = $final_suppliers;
    	
    	echo json_encode($data);
    }
    
    public function getPurchaseOrdersByCategory(){
    	$start_date = date('Y-m-01');
    	$end_date = date('Y-m-30');
    	$orders = $this->orders_model->getAllMonthlyOrders($start_date,$end_date);
    	$item_amount = array();
    	if(!empty($orders)){
    		foreach($orders as $order){
	    		$order_items = $this->orders_model->getMonthlyOrderItems($order->order_id);
	    		foreach($order_items as $items){
	    			if($items->item_id  != 0){
	    				$item_cat = $this->orders_model->getOrderItemCategory($items->item_id);
	    				$item_cat_name[] = $item_cat[0]->category_name;
	    				$item_amount[$item_cat[0]->category_name][] = $items->amount;
	    			}
	    		}
	    	}
    	}
    	
    	$categories = array(['category', 'total']);
    	if(!empty($item_amount)){
	    	foreach($item_amount as $key => $cat){
	    		$amounts = array();
	    		$sum = array_sum($cat);
	    		$amounts[0] = $key;
	    		$amounts[1] = $sum;
	    		
	    		array_push($categories, $amounts);
	    	}
    	}
    	
    	$data['categories'] = $categories;
    	echo json_encode($data);
    }
    function insert_credits(){
    	$order_id = $this->input->post('order_id');
    	$data = array(
    		'credits' => $this->input->post('credits')
    		);
    	$res = $this->orders_model->insert_credits($data,$order_id);
    	if($res){
    		$this->session->set_flashdata("sucess_msg","Order updated successfully");
    	}else{
    		$this->session->set_flashdata("error_msg","Unable to update order");
    	}
    	redirect('orders/receiveOrderDetails/'.$order_id);
    }
    function book_keeping(){
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				if($this->session->userdata('start_date') != ''){
					$start_date = $this->session->userdata('start_date');
					$end_date = $this->session->userdata('end_date');
					$sup_id = $this->session->userdata('sup_id_book');
				}else{
					$start_date ="";
					$end_date ="";
					$sup_id ="";
				}
				$suppliers_list = $this->orders_model->get_all_branch_suppliers();
				$categories_list = $this->orders_model->getItemCategories();
				//echo '<pre>';print_r($categories_list);exit;
				$data['start_date'] = $start_date;
				$data['end_date'] = $end_date;
				$data['sup_id_book'] = $sup_id;
				$data['suppliers'] = $suppliers_list;
				$data['categories'] = $categories_list;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('orders/book_keeping',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
    }
    public function submit_book_keeping(){
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				
				$supplier_id = $this->input->post('supplier');
				
				    $s_date = $this->input->post('start_date');
				    //echo $s_date;exit;
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->input->post('end_date');
	                $end_date = date("Y-m-d", strtotime($e_date) );
				    $status = "Received";
				  $this->session->set_userdata('start_date',$start_date);
				    $this->session->set_userdata('end_date',$end_date);
				    $this->session->set_userdata('sup_id_book',$supplier_id);    
				  if($s_date == "" && $e_date == ""){
                      $start_date = $this->session->userdata('start_date');
				    	$end_date = $this->session->userdata('end_date');
				    	$supplier_id = $this->session->userdata('sup_id_book');
				    	$status = "Received";				  	
				  }
				$orders = $this->orders_model->submit_book_keeping($start_date,$end_date,$supplier_id,$status);
				
				//echo '<pre>';print_r($orders);exit;
				$msg='<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						        <th class="text-center">Order Date</th>
						        	<th class="text-left">Date Uploaded</th>
								<th class="text-center">Purchase order No.</th>
								<th class="text-left">Supplier</th>
							
								<th class="text-right">Order Total</th>
								<th class="text-center">Order Status</th>
								<th></th>
					</tr>
				</thead>
				<tbody id="results">';
			    foreach($orders as $row){
			       
			    	if($row->book_keeping == 'Entered'){
								$color = "style='background-color:#319346;width:100%;padding:5px 8px;'";
							}else{
								$color = "style='background-color:#337ab7;width:100%;padding:5px 8px;'";
							}
					$msg.="
					      <tr class='tr'>
								<td class='text-center'>
									<a href=".base_url('').'index.php/orders/receiveOrderDetails/'.$row->order_id."     class='update_user_button'>".date('d/m/Y',strtotime($row->order_date))."</a>
								</td>
									<td class='text-left'>".date('d/m/Y',strtotime($row->order_status_received_chnaged_date))."</td>
								<td class='text-center'>
									<a href=".base_url('').'index.php/orders/receiveOrderDetails/'.$row->order_id." class='update_user_button'>".$row->order_number."</a>
								</td>
								<td class='text-left'>".$row->supplier_name."</td>
								
								<td class='text-right'>$".number_format($row->order_total,2,'.','')."</td>
								<td class='text-center'><div class='status-color' style='background-color:#319346;width:100%;padding:5px 8px;'>".$row->order_status."</div></td>
								<td class='text-center'><a type='button' onclick='change_status(".$row->order_id.");'><div ".$color." class='status-color'>".$row->book_keeping."</div></a></td>
							</tr>";
			    }
			    $msg.='</tbody><tfoot>';
			    $msg.='<tfoot></table>';
				echo $msg;

			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
    }
    
    public function change_status_book(){
    	$order_id = $this->input->post('order_id');
    	$data = array(
    		'book_keeping' => 'Entered'
    		);
    	$res = $this->orders_model->change_status_book($data,$order_id);
    	
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				/*menu items end */
			 	    $supplier_id = $this->input->post('supplier');
				    $s_date = $this->input->post('start_date');
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->input->post('end_date');
	                $end_date = date("Y-m-d", strtotime($e_date) );
				    $status = "Received";
				    if($s_date == "" && $e_date == ""){
                      $start_date = $this->session->userdata('start_date');
				    	$end_date = $this->session->userdata('end_date');
				    	$supplier_id = $this->session->userdata('sup_id_book');
				    	$status = "Received";				  	
				  }
				$orders = $this->orders_model->submit_book_keeping($start_date,$end_date,$supplier_id,$status);
				$msg='<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						        <th class="text-center">Order Date</th>
								<th class="text-center">Purchase order No.</th>
								<th class="text-left">Supplier</th>
								<th class="text-right">Order Total</th>
								<th class="text-center">Order Status</th>
								<th></th>
					</tr>
				</thead>
				<tbody id="results">';
			    foreach($orders as $row){
			    if($row->book_keeping == 'Entered'){
								$color = "style='background-color:#319346;'";
							}else{
								$color = "style='background-color:#337ab7;'";
							}
					$msg.="
					      <tr class='tr'>
								<td class='text-center'>
									<a href=".base_url('').'index.php/orders/receiveOrderDetails/'.$row->order_id."     class='update_user_button'>".date('d-m-Y',strtotime($row->order_date))."</a>
								</td>
								<td class='text-center'>
									<a href=".base_url('').'index.php/orders/receiveOrderDetails/'.$row->order_id." class='update_user_button'>".$row->order_number."</a>
								</td>
								<td class='text-left'>".$row->supplier_name."</td>
								<td class='text-right'>$".number_format($row->order_total,2,'.','')."</td>
								<td class='text-center'><div class='status-color' style='background-color:#319346;'>".$row->order_status."</div></td>
								<td class='text-center'><a type='button' onclick='change_status(".$row->order_id.");'><div ".$color." class='status-color'>".$row->book_keeping."</div></a></td>
							    
							</tr>";
			    }
			    $msg.='</tbody><tfoot>';
			    $msg.='<tfoot></table>';
				echo $msg;
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
    }
    public function bookkeeping_download()  {
         
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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
				
				$sup_id = $this->uri->segment(6);
				if($sup_id != 'false'){
					$supplier_id = $sup_id;
				}else{
					$supplier_id = '';
				}

					$s_date = $this->uri->segment(3);
					//echo $s_date;
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->uri->segment(4);
	                //echo $e_date;exit;
	                $end_date = date("Y-m-d", strtotime($e_date) );
	                //echo $start_date;
	                //echo $end_date;exit;
                    $status = "Received";
				$orders = $this->orders_model->submit_book_keeping($start_date,$end_date,$supplier_id,$status);
				//echo '<pre>';print_r($orders);exit;
		require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';
		// Create new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
       // Set document properties
		$spreadsheet->getProperties()->setCreator('Webeasystep.com ')
				->setLastModifiedBy('Ahmed Fakhr')
				->setTitle('Phpecxel codeigniter tutorial')
				->setSubject('integrate codeigniter with PhpExcel')
				->setDescription('this is the file test');
		// add style to the header
		$styleArray = array(
				'font' => array(
						'bold' => true,
				),
		);
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
		foreach(range('A','F') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
		}
		// set the names of header cells
		$spreadsheet->setActiveSheetIndex(0)
				->setCellValue("A1",'Order Date')
				->setCellValue("B1",'Order Number')
				->setCellValue("C1",'Supplier Name')
				->setCellValue("D1",'Order Total')
				->setCellValue("E1",'Order Status')
				->setCellValue("F1",'Book keeping status');

		//Add some data
		$x= 2;
		foreach($orders as $row){
		    //$total = $row->quantity*$row->price;
			$spreadsheet->setActiveSheetIndex(0)
					->setCellValue("A$x",date('d-m-Y', strtotime($row->order_date)))
					->setCellValue("B$x",$row->order_number)
					->setCellValue("C$x",$row->supplier_name)
					->setCellValue("D$x",number_format($row->order_total,2,'.',''))
					->setCellValue("E$x",$row->order_status)
					->setCellValue("F$x",$row->book_keeping);
			$x++;
		  }
		$spreadsheet->getActiveSheet()->setTitle('Users Information');

       // set right to left direction
        //		$spreadsheet->getActiveSheet()->setRightToLeft(true);

       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="subscribers_sheet.xlsx"');
		header('Cache-Control: max-age=0');
       // If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		$writer->save('php://output');
		exit;

		//  create new file and remove Compatibility mode from word title

			}
	}
	public function submit_book_keeping_reload(){
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
			// echo $remaining;exit;
			if($status != 'Expired' && $trail_period !='Expired'){
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

				    	$start_date = $this->session->userdata('start_date');
				    	$end_date = $this->session->userdata('end_date');
				    	$supplier_id = $this->session->userdata('sup_id_book');
				    	$status = "Received";
				$orders = $this->orders_model->submit_book_keeping($start_date,$end_date,$supplier_id,$status);
				$suppliers_list = $this->orders_model->get_branch_suppliers();
				$data['suppliers'] = $suppliers_list;
                $data['orders'] = $orders;
                $this->load->view('general/header_general.php', $hdata);
				$this->load->view('orders/book_keeping_reload',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
    }
    
    public function update_product_in_order(){
        
        	$order_item_id = $_POST['order_item_id'];
    	    $orderId = $_POST['order_id'];
    	     if(isset($_POST['product_details']) && !empty($_POST['product_details'])) {
    	     $order_details = $this->orders_model->update_product_in_order($orderId,$order_item_id,$_POST['product_details']);
    	        
    	    }else{
    	        
    	        $order_details = $this->orders_model->update_product_in_order($orderId,$order_item_id);
    	    }
    	      
    }
    
       public function addNewProduct(){
        
    	     if(isset($_POST['product_details']) && !empty($_POST['product_details'])) {
    	         
    	      $item_id = $this->orders_model->insert_item($_POST['product_details'][0]);
    	      $_POST['product_details'][0]['item_id']  =$item_id;
    	     
    	     $order_details = $this->orders_model->placeOrderItems($_POST['product_details'][0]);
    	     
    	     $this->db->select('order_total');
		$this->db->from('orders');
		$this->db->where('order_id', $_POST['product_details'][0]['order_id']);
		$query = $this->db->get();
    	 $order_total = $query->result();
    	$order_total = $order_total[0]->order_total + $_POST['product_details'][0]['amount'];
    	
    	
    	     $details = array(
    	         'order_total' => $order_total
    	         );
    	      $order_details = $this->orders_model->updateOrderDetails($details,$_POST['product_details'][0]['order_id']);
    	        
    	    }
    	    echo "added";
    	      
    }
   
}
