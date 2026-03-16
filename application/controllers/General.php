<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

    function __construct() {
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
		}else if(!$this->ion_auth->checkUserDetails() && $this->session->userdata('is_outlet_manager') != 1){
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
				
				$user_id = $this->session->userdata('user_id');
				$branch_acc = $this->general_model->getBranchAccess($user_id);
				$branches_list = array();
				if(!empty($branch_acc)){
					if(count($branch_acc) > 1){
						$this->session->unset_userdata('branch_id');
						$this->session->unset_userdata('branch_name');
						foreach($branch_acc as $key => $branch){
							$list = $this->general_model->getBranchDetails($branch->branch_id);
							$branches_list[] = $list[0];
						}
						$data['branches_list'] = $branches_list;
						$data['trail_period'] = $remaining;
				// 		echo "<pre>";
				// 		print_r($branches_list);
				// 		exit;
			            $this->load->view('general/general_branches',$data);
						$this->load->view('general/footer');
					}else{
						$this->session->set_userdata('branch_id', $branch_acc[0]->branch_id);
						$this->session->set_userdata('branch_name', $branch_acc[0]->branch_name);
						redirect('general/dashboard');
					}
				}
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
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
	    
	    $this->load->view('general/home_page');
	// 	$this->load->view('general/footer');
	}
	 

	
	public function dashboard(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails() && $this->session->userdata('is_outlet_manager') != 1){
			redirect('settings/index');
		}else if($this->session->userdata('is_outlet_manager') == 1){
			redirect('items/stock_entry_outlet_manager');
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