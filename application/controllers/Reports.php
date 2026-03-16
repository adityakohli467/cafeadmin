<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('reports_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    
    public function index() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('reports/manage_reports');
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	//pdf
		public function view_reports(){
		$data['data'] = '';
        $html=$this->load->view('reports/view_pdf',$data, true);
		  //load mPDF library
      	$this->load->library('pdf');
        $mpdf = $this->pdf->load();
       
		$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		
		$header = '
		<div class="header" style="height:40mm;">
			
			</div>';
		$headerE = '
			<div class="header" style="height:40mm;">

			</div>';
		
		$footer = '	<div class="footer" style="height:30mm;">
		
			</div>';
				
		$footerE = '	<div class="footer" style="height:30mm;">
		
			</div>';
				
		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLHeader($headerE,'E');
		$mpdf->SetHTMLFooter($footer);
		$mpdf->SetHTMLFooter($footerE,'E');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, "I");

    }
    
    //23-02-2018
    
    public function generate_reports() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				
				$suppliers_list = $this->reports_model->get_branch_suppliers();
				
				
				$categories_list = $this->reports_model->getItemCategories();
				// echo '<pre>';print_r($categories_list);exit;
				$data['suppliers'] = $suppliers_list;
				$data['categories'] = $categories_list;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('reports/generate_reports',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
    
    
    public function purchase_orders_reports() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				
				$suppliers_list = $this->reports_model->get_branch_suppliers();
				$categories_list = $this->reports_model->getItemCategories();
				//echo '<pre>';print_r($categories_list);exit;
				$data['suppliers'] = $suppliers_list;
				$data['categories'] = $categories_list;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('reports/purchase_orders_report',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	public function budget_reports() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
			$res = $this->ion_auth->subscription();
			$status = $res[0]->status;
			$this->load->model('suppliers_model');
			
			$branch_id = $this->session->userdata('branch_id');
			
			$branch_suppliers = $this->suppliers_model->get_branch_suppliers($branch_id);
			
			$categories_list = $this->reports_model->getItemCategories();
					
		 
		  
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
				
				$suppliers_list = $this->reports_model->get_branch_suppliers();
				
				//echo '<pre>';print_r($categories_list);exit;
				$data['suppliers'] = $suppliers_list;
				$data['categories'] = $categories_list;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('reports/budget_report',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
    
    public function reports_submit() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				$category = $this->input->post('category');
				$time_period = $this->input->post('time_period');
				
				//custom date
				if( $time_period == 'custom'){
					$s_date = $this->input->post('start_date');
					if($s_date != ''){
						$start_date = date("Y-m-d", strtotime($s_date) );	
					}
					
	                $e_date = $this->input->post('end_date');
	                if($e_date != ''){
						$end_date = date("Y-m-d", strtotime($e_date) );	
					}
				}
				//all time
				if( $time_period == 'alltime'){
					$start_date = "";
					$end_date = "";
				}
				//last week
				if( $time_period == 'lastweek'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    //echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			$start_date = $prev_date;
			    			break;
			    		}
			    	}
				}
				// fortnight
				if( $time_period == 'fortnight'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
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
			    			for($l=1; $l<=7; $l++){
				    			$pre_pre_date = date('Y-m-d', strtotime("$prev_date -$l day"));
				    	    	$pre_pre_week = date('l', strtotime($pre_pre_date));
				    			if($pre_pre_week == 'Monday'){
					    			$start_date = $pre_pre_date;
					    			break;
				    			}
			    			}
			    		}
			    	}
				}
				//last month
				if( $time_period == 'lastmonth'){
					$start_date = date('Y-m-d', strtotime('first day of last month'));
				    $end_date = date('Y-m-d', strtotime('last day of last month'));
					
				}
                
				
				
				$orders = $this->reports_model->getBranchOrders($start_date,$end_date,$supplier_id,$category);
			
				$items = array();
				foreach($orders as $key => $row){
					$order_id = $row->order_id;
					$items[$key]['supplier_name'] = $row->supplier_name;
					$items[$key]['order_date'] = $row->order_date;
					$items[$key]['order_id'] = $row->order_id;
					
					if($category != ''){
						$cat_items = array();
						$cat_order_items = $this->reports_model->getOrderItemsCategory($order_id);
						
						 
			    		foreach($cat_order_items as $ord_items){
			    			if($ord_items->item_id  != 0){
			    				$item_cat = $this->reports_model->getOrderItemCategory($ord_items->item_id);
			    				
			    				if($category == $item_cat[0]->category){
			    					$price = $ord_items->amount/$ord_items->quantity;
			    					$ord_items->price = $price;
			    					$cat_items[] = $ord_items;
			    				}
			    			}
			    		}
			    		$items[$key]['items'] = $cat_items;
					}else{
					   
						$items[$key]['items'] = $this->reports_model->getOrderItems($order_id);
					
							
					}
					
				}
				
				
				$msg="<table class='row-border table-condensed datatable' cellspacing='0' width='100%'>
						<thead>
							<tr>
							    <th class='text-center'>Order Id</th>
								<th class='text-center'>Order Date</th>
								<th class='text-left'>Supplier Name</th>
								<th class='text-left'>Product Name</th>
								<th class='text-center'>Quantity</th>
								<th class='text-right'>Price</th>
								<th class='text-right'>Total</th>
							</tr>
						</thead>
						<tbody>";
	   //      echo '<pre>';print_r($items);
				//  exit;
			$total_amount = 0;
		    foreach($items as $item){
		    	if(!empty($item['items'])){
			    	foreach($item['items'] as $row){
						$total = $row->quantity*$row->price;
						$total_amount = $total_amount+$total;
						$msg.="
						<tr>
						<td class='text-center'>".$item['order_id']."</td>
						<td class='text-center'>".date('d-m-Y', strtotime($item['order_date']))."</td>
						<td class='text-left'>".$item['supplier_name']."</td>
						<td class='text-left'>".$row->item_name."</td>
						<td class='text-center'>".$row->quantity."</td>
						<td class='text-right'>$".number_format($row->price,2,'.','')."</td>
						<td class='text-right'>$".number_format($total,2,'.','')."</td>
						</tr>";
			    	}
		    	}
		    }
		    
		    $msg.='</tbody><tfoot>';
		    $msg.='<tr><th colspan="7" class="text-right">$'.number_format($total_amount,'2','.','').'</th></tr>';
		    $msg.='<tfoot></table>';
			echo $msg;

			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
    
    public function budget_orders_submit() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				$category = $this->input->post('category');
				$time_period = $this->input->post('time_period');
				
				if( $time_period == 'custom'){
					$s_date = $this->input->post('start_date');
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->input->post('end_date');
	                $end_date = date("Y-m-d", strtotime($e_date) );
				}
				if( $time_period == 'alltime'){
				
					$start_date = "";
					$end_date = "";
				}
				if( $time_period == 'lastweek'){
					//echo $time_period;exit;
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			$start_date = $prev_date;
			    			break;
			    		}
			    	}
				}
				//
				if( $time_period == 'fortnight'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			for($l=0; $l<=6; $l++){
				    			$pre_pre_date = date('Y-m-d', strtotime("$prev_date -$l day"));
				    	    	$pre_pre_week = date('l', strtotime($pre_pre_date));
				    			if($pre_pre_week == 'Monday'){
					    			$start_date = $pre_pre_date;
					    			break;
				    			}
			    			}
			    				
			    		}
			    	}
				}
				
				if( $time_period == 'lastmonth'){
					$start_date = date('Y-m-d', strtotime('first day of last month'));
				    $end_date = date('Y-m-d', strtotime('last day of last month'));
				}
				
            $this->load->model('suppliers_model');
            $this->load->model('reports_model');
			
			$branch_id = $this->session->userdata('branch_id');
			$branch_suppliers = $this->suppliers_model->get_suppliers_budget($branch_id,$start_date,$end_date,$supplier_id,$category);
			
		
		
			$budget_report = array();
			
			foreach($branch_suppliers as $key => $branch_supplier){
			  
			$orders = $this->reports_model->getBranchOrders($start_date,$end_date,$branch_supplier->supplier_id,$category);
		
			if(!empty($orders)){
			
			$i = 0;
			$spent_by_this_supliier = 0;
			
		
			
			foreach($orders as $order){
			    
			 //   $spent = $this->reports_model->getOrderItems($order->order_id);
			    
			    
			 //   if(isset($overall_spent_on_orders) && $overall_spent_on_orders > 0 ){
			 //      $spent_on_this_order =  $overall_spent_on_orders;
			 //   }else{
			        
			 //       $spent_on_this_order = 0;
			 //   }
			    
			 //   	foreach($spent as $spent_now){
			 //   	    $spent_on_this_order =  $spent_on_this_order + $spent_now->amount;
			 //   	    $overall_spent_on_orders = $spent_on_this_order;
			 //   	}
			   
			   $spent_by_this_supliier =  $spent_by_this_supliier  + $order->order_total;
			  
			   
			   $overall_spent_on_orders = $spent_by_this_supliier;
		      
			}
			   
			   
			     $budget_report[$key]['supplier_id'] = $branch_supplier->supplier_id;
			     $budget_report[$key]['supplier_name'] = $branch_supplier->supplier_name;
			     $budget_report[$key]['category_name'] = $branch_supplier->category_name;
			     $budget_report[$key]['supplier_budget'] = $branch_supplier->weekly_budget;
			     $budget_report[$key]['supplier_spent'] = $overall_spent_on_orders;
			     $i++;
			

			}
			}
			

				$total_budget1 = 0;
				$total_spent1 =0;
				$total_balance1 = 0;
				
			
				
				 foreach($budget_report as $res){
			    	
			    	$balance1 = $res['supplier_budget'] - $res['supplier_spent'];
			    	$total_budget1 = $total_budget1 + $res['supplier_budget'];
			    	$total_spent1 = $total_spent1 + $res['supplier_spent'];
			    	$total_balance1 = $total_balance1 + $balance1;
			    	
				 }
				
				$msg = '<table style="
    border: 2px solid;text-align: center;
"><thead>
        <tr style="
    border: 2px solid;
"><th style="
    border: 2px solid;
">Total budget</th>
         <th style="
    border: 2px solid;
" >Total Spent</th>
         <th style="
    border: 2px solid;
">Total Balance</th>
        </tr></thead>
        <tbody>
             <tr><td style="
    border: 2px solid;
">$'.$total_budget1.'</td>
          <td style="
    border: 2px solid;
">$'.$total_spent1.'</td>
          <td style="
    border: 2px solid;
">$'.$total_balance1.'</td>
            </tr></tbody>
        
        </table>';
				$msg.='<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
			
						<th class="text-left">Supplier Name</th>
						<th class="text-left">Category</th>
						<th class="text-right"> Total Budget</th>
						<th class="text-center">Spent So far</th>
						<th class="text-center">Balance</th>
					</tr>
				</thead>
				<tbody id="results">';
	
				$total = 0;
				$total_budget = 0;
				$total_spent =0;
				$total_balance = 0;
			    foreach($budget_report as $row){
			    	
			    	$balance = $row['supplier_budget'] - $row['supplier_spent'];
			    	$total_budget = $total_budget + $row['supplier_budget'];
			    	$total_spent = $total_spent + $row['supplier_spent'];
			    	$total_balance = $total_balance + $balance;
			    	
			    	if($row['supplier_spent']  > $row['supplier_budget'] ){ 
			    	    
			    	    $msg.="
					<td class='text-left'>".$row['supplier_name']."</td>
					<td class='text-left'>".$row['category_name']."</td>
					<td class='text-right'>$".$row['supplier_budget']."</td>
					<td class='text-center'>$".$row['supplier_spent']."</td>
					<td class='text-center' style='color: red;'>$".$balance."</td>
					</tr>";
			    	}else{
			    	    
			    	    
			    	     $msg.="
					<td class='text-left'>".$row['supplier_name']."</td>
					<td class='text-left'>".$row['category_name']."</td>
					<td class='text-right'>$".$row['supplier_budget']."</td>
					<td class='text-center'>$".$row['supplier_spent']."</td>
					<td class='text-center' >$".$balance."</td>
					</tr>";
			    	}
			    	
			    }
			    $msg.='</tbody><tfoot>';
			    $msg.='<tr><th colspan="5" class="text-right">$'.number_format($total,'2','.','').'</th><th></th></tr>';
			    $msg.='<tfoot></table>';
				echo $msg;

			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
    
    public function purchase_orders_submit() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
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
				$category = $this->input->post('category');
				$time_period = $this->input->post('time_period');
				
				if( $time_period == 'custom'){
					$s_date = $this->input->post('start_date');
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->input->post('end_date');
	                $end_date = date("Y-m-d", strtotime($e_date) );
				}
				if( $time_period == 'alltime'){
				
					$start_date = "";
					$end_date = "";
				}
				if( $time_period == 'lastweek'){
					//echo $time_period;exit;
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			$start_date = $prev_date;
			    			break;
			    		}
			    	}
				}
				//
				if( $time_period == 'fortnight'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			for($l=0; $l<=6; $l++){
				    			$pre_pre_date = date('Y-m-d', strtotime("$prev_date -$l day"));
				    	    	$pre_pre_week = date('l', strtotime($pre_pre_date));
				    			if($pre_pre_week == 'Monday'){
					    			$start_date = $pre_pre_date;
					    			break;
				    			}
			    			}
			    				
			    		}
			    	}
				}
				
				if( $time_period == 'lastmonth'){
					$start_date = date('Y-m-d', strtotime('first day of last month'));
				    $end_date = date('Y-m-d', strtotime('last day of last month'));
				}
                //echo $category;exit;
				$orders = $this->reports_model->purchase_orders_submit($start_date,$end_date,$supplier_id,$category);
				
				//echo '<pre>';print_r($orders);exit;
				$msg='<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-center">Order Number</th>
						<th class="text-center">Order Date</th>
						<th class="text-left">Supplier Name</th>
						<th class="text-left">Category</th>
						<th class="text-right">Order Total</th>
						<th class="text-center">Credits</th>
						<th class="text-center">Order Status</th>
					</tr>
				</thead>
				<tbody id="results">';
	
				$total = 0;
			    foreach($orders as $row){
			    	$total = $total+($row->order_total);
		              	if($row->order_status == 'Sent'){
								$color = "style='background-color:#e96166;'";
							}else if($row->order_status == 'Viewed'){
								$color = "style='background-color:#4b799d;'";
							}else if($row->order_status == 'Confirmed'){
								$color = "style='background-color:#c3a428;'";
							}else{
								$color = "style='background-color:#319346;'";
							}
					$msg.="
					<tr><td class='text-center'>".$row->order_number."</td>
					<td class='text-center'>".date('d-m-Y', strtotime($row->order_date))."</td>
					<td class='text-left'>".$row->supplier_name."</td>
					<td class='text-left'>".$row->category_name."</td>
					<td class='text-right'>$".number_format($row->order_total,2,'.','')."</td>
					<td class='text-center'>".$row->credits."</td>
					<td class='text-center'><div ".$color." class='status-color'>".$row->order_status."</div></td>
					</tr>";
			    }
			    $msg.='</tbody><tfoot>';
			    $msg.='<tr><th colspan="5" class="text-right">$'.number_format($total,'2','.','').'</th><th></th></tr>';
			    $msg.='<tfoot></table>';
				echo $msg;

			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	// Excel starts
   
	public function download()  {
         
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
				$cat_id = $this->uri->segment(7);
				$time_period = $this->uri->segment(3);
				
				if($sup_id != 'false'){
					$supplier_id = $sup_id;
				}else{
					$supplier_id = '';
				}
				if($cat_id != 'false'){
					$category = $cat_id;
				}else{
					$category = '';
				}
				//custom date
				if( $time_period == 'custom'){
					$s_date = $this->uri->segment(4);
					if($s_date != ''){
						$start_date = date("Y-m-d", strtotime($s_date) );	
					}
					
	                $e_date = $this->uri->segment(5);
	                if($e_date != ''){
						$end_date = date("Y-m-d", strtotime($e_date) );	
					}
				}
				//all time
				if( $time_period == 'alltime'){
					$start_date = "";
					$end_date = "";
				}
				//last week
				if( $time_period == 'lastweek'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    //echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			$start_date = $prev_date;
			    			break;
			    		}
			    	}
				}
				// fortnight
				if( $time_period == 'fortnight'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
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
			    			for($l=1; $l<=7; $l++){
				    			$pre_pre_date = date('Y-m-d', strtotime("$prev_date -$l day"));
				    	    	$pre_pre_week = date('l', strtotime($pre_pre_date));
				    			if($pre_pre_week == 'Monday'){
					    			$start_date = $pre_pre_date;
					    			break;
				    			}
			    			}
			    		}
			    	}
				}
				//last month
				if( $time_period == 'lastmonth'){
					$start_date = date('Y-m-d', strtotime('first day of last month'));
				    $end_date = date('Y-m-d', strtotime('last day of last month'));
					
				}
                
				
				
				$orders = $this->reports_model->getBranchOrders($start_date,$end_date,$supplier_id,$category);
				//echo '<pre>';print_r($orders);exit;
				$items = array();
				foreach($orders as $key => $row){
					$order_id = $row->order_id;
					//echo $order_id;
					$items[$key]['supplier_name'] = $row->supplier_name;
					$items[$key]['order_date'] = $row->order_date;
					
					if($category != ''){
						//echo 'cat';
						$cat_items = array();
						$cat_order_items = $this->reports_model->getOrderItemsCategory($order_id);
						//echo '<pre>';print_r($cat_order_items);
			    		foreach($cat_order_items as $ord_items){
			    			if($ord_items->item_id  != 0){
			    				$item_cat = $this->reports_model->getOrderItemCategory($ord_items->item_id);
			    				//echo '<pre>';print_r($item_cat);
			    				if($category == $item_cat[0]->category){
			    					$price = $ord_items->amount/$ord_items->quantity;
			    					$ord_items->price = $price;
			    					$cat_items[] = $ord_items;
			    				}
			    			}
			    		}
			    		$items[$key]['items'] = $cat_items;
					}else{
						//echo 'no cat';
						$items[$key]['items'] = $this->reports_model->getOrderItems($order_id);
						//echo '<pre>';print_r($items[$key]['items']);
					}
					
				}
        
              //echo '<pre>';print_r($items);exit;
        
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
				->setCellValue("B1",'Supplier Name')
				->setCellValue("C1",'Product Name')
				->setCellValue("D1",'Quantity')
				->setCellValue("E1",'Price')
				->setCellValue("F1",'Total');

		//Add some data
		$x= 2;
	    foreach($items as $item){
		    	if(!empty($item['items'])){
		foreach($item['items'] as $row){
		    $total = $row->quantity*$row->price;
			$spreadsheet->setActiveSheetIndex(0)
					->setCellValue("A$x",$item['order_date'])
					->setCellValue("B$x",$item['supplier_name'])
					->setCellValue("C$x",$row->item_name)
					->setCellValue("D$x",$row->quantity)
					->setCellValue("E$x",$row->price)
					->setCellValue("F$x",$total);
			$x++;
		  }
		 }
	    }

       // Rename worksheet
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
	
	public function purchase_download()  {
         
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
				$cat_id = $this->uri->segment(7);
				$time_period = $this->uri->segment(3);
				if($sup_id != 'false'){
					$supplier_id = $sup_id;
				}else{
					$supplier_id = '';
				}
				if($cat_id != 'false'){
					$category = $cat_id;
				}else{
					$category = '';
				}
				if( $time_period == 'custom'){
					$s_date = $this->uri->segment(4);
	                $start_date = date("Y-m-d", strtotime($s_date) );
	                $e_date = $this->uri->segment(5);
	                $end_date = date("Y-m-d", strtotime($e_date) );
				}
				if( $time_period == 'alltime'){
				
					$start_date = "";
					$end_date = "";
				}
				if( $time_period == 'lastweek'){
					//echo $time_period;exit;
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			$start_date = $prev_date;
			    			break;
			    		}
			    	}
				}
				//
				if( $time_period == 'fortnight'){
					$today_date = date('Y-m-d');
					for($k=0; $k<=6; $k++){
			    		$next_date = date('Y-m-d', strtotime("$today_date -$k day"));
			    		$next_week = date('l', strtotime($next_date));
			    		if($next_week == 'Sunday'){
			    			$end_date = $next_date;
			    			break;
			    		}
		    	    }
		    	    	//echo $end_date;exit;
			    	//start date - monday
			    	for($i=0; $i<=6; $i++){
			    		$prev_date = date('Y-m-d', strtotime("$end_date -$i day"));
			    		$prev_week = date('l', strtotime($prev_date));
			    		if($prev_week == 'Monday'){
			    			for($l=0; $l<=6; $l++){
				    			$pre_pre_date = date('Y-m-d', strtotime("$prev_date -$l day"));
				    	    	$pre_pre_week = date('l', strtotime($pre_pre_date));
				    			if($pre_pre_week == 'Monday'){
					    			$start_date = $pre_pre_date;
					    			break;
				    			}
			    			}
			    				
			    		}
			    	}
				}
				
				if( $time_period == 'lastmonth'){
					$start_date = date('Y-m-d', strtotime('first day of last month'));
				    $end_date = date('Y-m-d', strtotime('last day of last month'));
				}
                //echo $supplier_id;exit;
				$orders = $this->reports_model->purchase_orders_submit($start_date,$end_date,$supplier_id,$category);
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
				->setCellValue("A1",'Order Number')
				->setCellValue("B1",'Order Date')
				->setCellValue("C1",'Supplier Name')
				->setCellValue("D1",'Category')
				->setCellValue("E1",'Order Total')
				->setCellValue("F1",'Order Status');

		//Add some data
		$x= 2;
		foreach($orders as $row){
		    //$total = $row->quantity*$row->price;
			$spreadsheet->setActiveSheetIndex(0)
					->setCellValue("A$x",$row->order_number)
					->setCellValue("B$x",date('d-m-Y', strtotime($row->order_date)))
					->setCellValue("C$x",$row->supplier_name)
					->setCellValue("D$x",$row->category_name)
					->setCellValue("E$x",number_format($row->order_total,2,'.',''))
					->setCellValue("F$x",$row->order_status);
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
	
	//Excel Ends
    
}