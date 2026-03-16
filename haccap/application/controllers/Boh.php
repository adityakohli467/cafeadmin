<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Boh extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
		$this->load->model('Filter_model');
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
			
				// $branch_id = $this->session->userdata('branch_id');
    		    $data['page_heading'] = 'BOH';
				$data['controller_name'] = 'boh';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('boh/boh',$data);
				$this->load->view('general/footer');
    		   
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		
		}
    }
     public function form1() {
       
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
			
				// $branch_id = $this->session->userdata('branch_id');
    		    $data['page_heading'] = 'Incoming Goods Record';
				$data['controller_name'] = 'boh/form1_report';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('filter/filter',$data);
				$this->load->view('general/footer');
    		   
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		
		}
    }
    public function form11() {
       
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
			
				// $branch_id = $this->session->userdata('branch_id');
    		    $data['page_heading'] = 'Food Van Temp Record';
				$data['controller_name'] = 'boh/form11_report';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('filter/filter_date',$data);
				$this->load->view('general/footer');
    		   
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		
		}
    }
  	public function form1_report(){
	        
	 	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    $filter=array();
		    
        	if(isset($_POST['date_from']) && $_POST['date_from']!=''){
        	    $filter['date_from'] =  $_POST['date_from'];
        	}
        	if(isset($_POST['date_to']) && $_POST['date_to']!=''){
        	    $filter['date_to'] =  $_POST['date_to'];
        	}
        	if(isset($_POST['name']) && $_POST['name']!=''){
        	    $filter['name'] =  $_POST['name'];
        	}
        	if(isset($_POST['po_number']) && $_POST['po_number']!=''){
        	    $filter['po_number'] =  $_POST['po_number'];
        	}
        // 	echo "<pre>";print_r($filter);
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
        	    $result = $this->Filter_model->filter_report($filter,$branch_id);
        	   if($result){
        	       $data['result']=$result;
        	   }
        	    
    		    $data['page_heading'] = 'Incoming Goods Record RESULT';
				$data['controller_name'] = 'boh/update_order';
				$data['date_from'] = $filter['date_from'];
				$data['date_to'] = $filter['date_to'];
				// echo "<pre>";print_r($data);exit;
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('boh/form1_listing',$data);
				$this->load->view('general/footer');
    		   
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		
		}
	      
	    
	}
	public function form11_report(){
	        
	 	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    $filter=array();
		    if(isset($_POST['date_filter'])){
		        $filter['date_filter']=$_POST['date_filter'];
		    }
		    else{
		        $filter['date_filter']='';
		    }
        	
        // 	echo "<pre>";print_r($filter);
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
				
				$result1 = $this->Filter_model->fetch_record($filter,$branch_id);
        	   //   echo "<pre>";print_r($result1);exit;
        	   if($result1){
        	      
        	       $data['form_11_verified_by']=$result1[0]->form_11_verified_by;
        	       $data['form_11_signature']=$result1[0]->form_11_signature;
        	       $data['form_11_date']=$result1[0]->form_11_date;
        	   }
				
        	    $result = $this->Filter_model->filter_report_f11($filter,$branch_id);
        	    
        	   if($result){
        	       $data['result']=$result;
        	   }
        	   // echo "<pre>";print_r($result);exit;
    		    $data['page_heading'] = 'Food Van Temp Record RESULT';
				$data['controller_name'] = 'boh/update_order_details';
				$data['date_filter'] = $filter['date_filter'];
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('boh/form11_listing',$data);
				$this->load->view('general/footer');
    		   
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		
		}
	      
	    
	}
	public function update_order(){
	    
	    
	        if(isset($_POST['form_1_verified_by']) && $_POST['form_1_verified_by'] !=''){
        	    $form_1_verified_by =  $_POST['form_1_verified_by'];
        	}
        	else{
        	    $form_1_verified_by='';
        	}
        		if(isset($_POST['form_1_signature']) && $_POST['form_1_signature'] !=''){
        	    $form_1_signature =  $_POST['form_1_signature'];
        	}
        	else{
        	    $form_1_signature='';
        	}
        		if(isset($_POST['form_1_date']) && $_POST['form_1_date'] !=''){
        	    $form_1_date =  $_POST['form_1_date'];
        	}
        	else{
        	    $form_1_date='';
        	}
		   
        	if(isset($_POST['order_id']) && $_POST['order_id']!=''){
        	    $order_id =  $_POST['order_id'];
        	}
        	if(isset($_POST['received_name']) && $_POST['received_name']!=''){
        	    $received_name =  $_POST['received_name'];
        	}
        	else{
        	    $received_name='';
        	}
        	
        	if(isset($_POST['deliver_by']) && $_POST['deliver_by']!=''){
        	    $deliver_by =  $_POST['deliver_by'];
        	}
        	else{
        	    $deliver_by='';
        	}
        	
        // 	if(isset($_POST['received_date']) && $_POST['received_date']!=''){
        // 	    $received_date =  $_POST['received_date'];
        // 	}
        // 	else{
        // 	    $received_date='';
        // 	}
        // 	if(isset($_POST['received_time']) && $_POST['received_time']!=''){
        // 	    $received_time =  $_POST['received_time'];
        // 	}
        // 	else{
        // 	    $received_time = '';
        // 	}
        	
        	
        	
        	    
        	    $data = array(
            		'received_name' => $received_name,
            		'deliver_by' => $deliver_by,
            // 		'received_date' => $received_date,
            // 		'received_time' => $received_time,
                    'form_1_verified_by' => $form_1_verified_by,
            		'form_1_signature' => $form_1_signature,
            		'form_1_date' => $form_1_date,
    			
    		    );
     
        // 	 $result = $this->Filter_model->update_order($order_id,$data);
        	 $result = $this->Filter_model->update_order($order_id,$data,'orders','order_id');
      
	}
	public function update_order_details(){
	        
		   
        	if(isset($_POST['order_id']) && $_POST['order_id']!=''){
        	    $order_id =  $_POST['order_id'];
        	}
        	if(isset($_POST['order_detail_id']) && $_POST['order_detail_id']!=''){
        	    $order_detail_id =  $_POST['order_detail_id'];
        	}
        	
        	
        	if(isset($_POST['form_11_verified_by']) && $_POST['form_11_verified_by'] !=''){
        	    $form_11_verified_by =  $_POST['form_11_verified_by'];
        	}
        	else{
        	    $form_11_verified_by='';
        	}
        		if(isset($_POST['form_11_signature']) && $_POST['form_11_signature'] !=''){
        	    $form_11_signature =  $_POST['form_11_signature'];
        	}
        	else{
        	    $form_11_signature='';
        	}
        		if(isset($_POST['form_11_date']) && $_POST['form_11_date'] !=''){
        	    $form_11_date =  $_POST['form_11_date'];
        	}
        	else{
        	    $form_11_date='';
        	}
        	
        	
        	
        	if(isset($_POST['form_11_temp_loading']) && $_POST['form_11_temp_loading'] !=''){
        	    $form_11_temp_loading =  $_POST['form_11_temp_loading'];
        	}
        	else{
        	    $form_11_temp_loading='';
        	}
        	if(isset($_POST['form_11_temp_unloading']) && $_POST['form_11_temp_unloading']!=''){
        	    $form_11_temp_unloading =  $_POST['form_11_temp_unloading'];
        	}
        	else{
        	    $form_11_temp_unloading='';
        	}
        	if(isset($_POST['form_11_received_by']) && $_POST['form_11_received_by']!=''){
        	    $form_11_received_by =  $_POST['form_11_received_by'];
        	}
        	else{
        	    $form_11_received_by = '';
        	}
        	if(isset($_POST['form_11_deliver_by']) && $_POST['form_11_deliver_by']!=''){
        	    $form_11_deliver_by =  $_POST['form_11_deliver_by'];
        	}
        	else{
        	    $form_11_deliver_by = '';
        	}
        	
        	
        	
        	    
        	   
        	 
        	 $data2 = array(
            		'form_11_temp_loading' => $form_11_temp_loading,
            		'form_11_temp_unloading' => $form_11_temp_unloading,
            		'form_11_received_by' => $form_11_received_by,
            		'form_11_deliver_by' => $form_11_deliver_by,
    			
    		    );
    //   echo "<pre>";print_r($data2);exit;
        	 $result2 = $this->Filter_model->update_order($order_detail_id,$data2,'order_details','order_detail_id');
        // 	 echo "<pre>";print_r($result2);exit;
                
                     $data = array(
            		'form_11_verified_by' => $form_11_verified_by,
            		'form_11_signature' => $form_11_signature,
            		'form_11_date' => $form_11_date,
    			
    		    );
     
        	 $result = $this->Filter_model->update_order($order_id,$data,'orders','order_id');
                
	}
	public function form1_report_download(){
	 
		    $filter=array();
		 
        	if(isset($_GET['date_from']) && $_GET['date_from']!=''){
        	    $filter['date_from'] =  $_GET['date_from'];
        	}
        	if(isset($_GET['date_to']) && $_GET['date_to']!=''){
        	    $filter['date_to'] =  $_GET['date_to'];
        	}
        
         	
        	$branch_id = $this->session->userdata('branch_id');
        	
        	 $result = $this->Filter_model->filter_report($filter,$branch_id);
        	   
        	   //	echo "<pre>"; print_r($result); exit;
        	   
                $spreadsheet = new Spreadsheet(); 
                
                $sheet = $spreadsheet->getActiveSheet();
              
                $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                $sheet->getStyle('A7:G7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                $sheet->getStyle('A6:G6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getStyle('A6:G6')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                
                $sheet->setCellValue('A6', 'Date');
                $sheet->setCellValue('B6', 'Supplier Name');
                $sheet->setCellValue('C6', 'Invoice OR POD No:');
                $sheet->setCellValue('D6', 'Temperature of product.');
                $sheet->setCellValue('E6', 'Comments');
                $sheet->setCellValue('F6', 'Order Status');
                $sheet->setCellValue('G6', 'Received By');
              
        		
        		
        		$sheet->setCellValue('A1', 'Verified By: '.$result[0]->form_1_verified_by);
        		$sheet->setCellValue('A2', 'Signature: '.$result[0]->form_1_signature);
        		$sheet->setCellValue('A3', 'Date: '.date('d-m-Y',strtotime($result[0]->form_1_date)));
        		
        		$sheet->setCellValue('A4', 'Date From: '.date('d-m-Y',strtotime($filter['date_from'])));
        		$sheet->setCellValue('A5', 'Date To: '.date('d-m-Y',strtotime($filter['date_to'])));
        		
        	
        		$x = 7;	
        	   
        	
        		if(is_array($result)){
        		       	   
        		       	foreach($result as $value){
        		       	    
        		       	  //  	echo "<pre>"; print_r($value); exit;
        		       	  $sheet->getRowDimension($x)->setRowHeight(35);
        		       	  $sheet->getStyle('A'.$x.':G'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
        		       	   
        		       	    $sheet->setCellValue('A'.$x, date('d-m-Y',strtotime($value->order_date)));
        		       	    $sheet->setCellValue('B'.$x, $value->supplier_name);
                            $sheet->setCellValue('C'.$x, $value->order_number);
                            $sheet->setCellValue('D'.$x, $value->temp_recording);
                            $sheet->setCellValue('E'.$x, $value->comments);
                            $sheet->setCellValue('F'.$x, $value->order_status);
                            $sheet->setCellValue('G'.$x, $value->received_name);
                            
                            $x++;
                }
        	
        		}
        		
        		
        		 
              $writer = new Xlsx($spreadsheet); 
              $filename = 'Incoming Goods Record '.date('dS M Y',strtotime($filter['date_from'])).' to '.date('dS M Y',strtotime($filter['date_to']));
                
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                 $writer->save('php://output');
                exit;
	}
	
	public function form11_report_download(){
	        

		    $filter=array();
		  
		  if(isset($_GET['date_from']) && $_GET['date_from']!=''){
        	    $filter['date_filter'] =  $_GET['date_from'];
        	}
        
        
         	
        	$branch_id = $this->session->userdata('branch_id');
        	
        	$result1 = $this->Filter_model->fetch_record($filter,$branch_id);
        	   //   echo "<pre>";print_r($result1);exit;
        	   if($result1){
        	      
        	       $data['form_11_verified_by']=$result1[0]->form_11_verified_by;
        	       $data['form_11_signature']=$result1[0]->form_11_signature;
        	       $data['form_11_date']=$result1[0]->form_11_date;
        	   }
				
        	    $result = $this->Filter_model->filter_report_f11($filter,$branch_id);
        	   
        	   //	echo "<pre>"; print_r($result); exit;
        	   
                $spreadsheet = new Spreadsheet(); 
                
                $sheet = $spreadsheet->getActiveSheet();
              
                $sheet->getStyle('A1:A3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getStyle('A5:H5')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                
                $sheet->setCellValue('A5', 'Date');
                $sheet->setCellValue('B5', 'Item');
                $sheet->setCellValue('C5', 'Invoice OR POD No:');
                $sheet->setCellValue('D5', 'Temperature at Loading');
                $sheet->setCellValue('E5', 'Temperature at unloading');
                $sheet->setCellValue('F5', 'Delivery Location');
                $sheet->setCellValue('G5', 'Received By');
                $sheet->setCellValue('H5', 'Deliver By');
              
        		$sheet->setCellValue('A1', 'Verified By: '.$result1[0]->form_11_verified_by);
        		$sheet->setCellValue('A2', 'Signature: '.$result1[0]->form_11_signature);
        		$sheet->setCellValue('A3', 'Date: '.$result1[0]->form_11_date);
        		
        		
        	
        		$x = 6;	
        	   
        	
        		if(is_array($result)){
        		       	   
        		       	foreach($result as $value){
        		       	    
        		       	  //  	echo "<pre>"; print_r($value); exit;
        		       	  $sheet->getRowDimension($x)->setRowHeight(35);
        		       	  $sheet->getStyle('A'.$x.':H'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
        		       	   
        		       	    $sheet->setCellValue('A'.$x, date('d-m-Y',strtotime($value->order_date)));
        		       	    $sheet->setCellValue('B'.$x, $value->item_name);
                            $sheet->setCellValue('C'.$x, $value->order_number);
                            $sheet->setCellValue('D'.$x, $value->form_11_temp_loading);
                            $sheet->setCellValue('E'.$x, $value->form_11_temp_unloading);
                            $sheet->setCellValue('F'.$x, $value->branch_name);
                            $sheet->setCellValue('G'.$x, $value->form_11_received_by);
                            $sheet->setCellValue('H'.$x, $value->form_11_deliver_by);
                            
                            $x++;
                }
        	
        		}
        		
        		
        		 
              $writer = new Xlsx($spreadsheet); 
              $filename = 'Food Van Temp Record '.date('dS M Y',strtotime($filter['date_filter']));
                
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                 $writer->save('php://output');
                exit;
	}
	
}