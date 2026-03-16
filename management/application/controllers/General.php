<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

    function __construct() {
        date_default_timezone_set('Australia/Melbourne');
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('general_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    
    function index() {
    //   echo "session_set_cpanel =".$this->session->unset_userdata('email'); exit;
   
		if (!$this->ion_auth->logged_in()) {
		    
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  //  echo "Dashboard";
		  //  exit;
		  $userlevel = $this->session->userdata('clearance_level');
			redirect('general/orders');
				// $this->load->view('general/header_general',$hdata);
	   //         $this->load->view('general/dashboard');
			 //   $this->load->view('general/footer');
		}
	 }
	 public function orders(){
	     	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('orders', 'menu')){
			redirect('general/index');
		}else {
		   
		    $filterData =array();
		    if(isset($_POST['branch_id'])){
		        
		        $filterData['branch_id']=$_POST['branch_id'];
				$data['branch_id'] = $filterData['branch_id']; 
		    }
		     if(isset($_POST['supplier_id']) && isset($_POST['supplier_id']) !=''){
		        
		        $filterData['supplier_id']=$_POST['supplier_id'];
				$data['supplier_id'] = $filterData['supplier_id']; 
		    }
		    if(isset($_POST['from-date']) && $_POST['to-date']){
		        $filterData['fromDate']=$_POST['from-date'];
		        $filterData['toDate']=$_POST['to-date'];
		        $data['fromDate'] = $filterData['fromDate'];
				$data['toDate'] = $filterData['toDate'];
		    }
		    
		    if(isset($_POST['order_status']) && $_POST['order_status'] != ''){
		        $filterData['order_status']=$_POST['order_status'];
		        $data['order_status'] = $filterData['order_status'];
		    }
		   
		  //  echo $fromDate.$toDate;
		  //  exit;
		 
				$branches_list = array();
			
				$list = $this->general_model->getAllBranchDetails();
						
				$data['branches_list'] = $list;
				
				// echo "<pre>";print_r($data['branches_list']);exit;
				
					$branch_suppliers = $this->general_model->get_branch_suppliers($filterData['branch_id']);
					 //echo '<pre>';print_r($branch_suppliers);exit;
					if(!empty($branch_suppliers)){
					  
						foreach($branch_suppliers as $supp){
							$supplier_details = $this->general_model->edit_suppliers($supp->supplier_id);
							if(!empty($supplier_details[0])){
							   $suppliers[] = $supplier_details[0]; 
						}
							
				// 		}
					}
				}
				     $data['suppliers'] = $suppliers;
				    if(isset($_POST['branch_id'])){
				   	$orders = $this->general_model->getBranchOrders($filterData);     
				    }
			
				
				// echo "<pre>";
				// print_r($orders);
				// exit;
				$data['orders'] = $orders;
				$total=0;
				// foreach($orders as $order){
				//     $total = $total + $order->order_total;
				// }
				$data['total'] = $orders[0]['total'];
				$this->load->view('general/header_general.php', $hdata);
				$this->load->view('general/order_history',$data);
				$this->load->view('general/footer');
		
		}
	 }
	 public function fetchSuppliers(){
	     $branch_id=$_POST['id'];
	     	$branch_suppliers = $this->general_model->get_branch_suppliers($branch_id);
					 //echo '<pre>';print_r($branch_suppliers);exit;
					if(!empty($branch_suppliers)){
					  
						foreach($branch_suppliers as $supp){
							$supplier_details = $this->general_model->edit_suppliers($supp->supplier_id);
							if(!empty($supplier_details[0])){
							   $suppliers[] = $supplier_details[0]; 
						}
							
				// 		}
					}
				}
				echo json_encode(($suppliers), true);
	 }
	public function setBranch(){
	 	$branch_id =  $this->uri->segment(3);
		$branch_name =  $this->uri->segment(4);
		$branchName = str_replace('_',' ',$branch_name);
	 	$this->session->set_userdata('branch_id', $branch_id);
	 	$this->session->set_userdata('branch_name', $branchName);
		redirect('general/dashboard');
	}
	
	public function home_redirect(){
	    
	    	redirect('auth/login2');
	   // $this->load->view('general/home_page');
				// 		$this->load->view('general/footer');
	}
	 

	
	public function dashboard(){
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
				
				//last five orders
				$last_orders = $this->general_model->getBranchOrders();
				$fav_orders = $this->general_model->getFavouriteOrders();
				// echo '<pre>';print_r($last_orders);exit;
				
				$data['last_orders'] = $last_orders;
				$data['fav_orders'] = $fav_orders;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('general/dashboard',$data);
				$this->load->view('general/footer');
				
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}

}