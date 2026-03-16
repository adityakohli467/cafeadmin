<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   


class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('settings_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }

	function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			$user_id = $this->session->userdata('user_id');
			$user_details = $this->settings_model->getUserDetails($user_id);
			
			$customer_id = $user_details[0]->customer_id;
			$customer_details = $this->settings_model->getCustomerDetails($customer_id);
			// echo '<pre>';print_r($user_details);exit;
			$data['customer_details'] = $customer_details[0];
			$data['user_details'] = $user_details[0];
			$this->load->view('settings/company_details',$data);
		}else {
			redirect('general/index');
		}
	}
	
 
	
	public function updateCompanyDetails(){
		//get customer id
		$user_id = $this->input->post('user_id');
		$user_details = $this->settings_model->getUserDetails($user_id);
		$customer_id = $user_details[0]->customer_id;
		$customer_details = $this->settings_model->getCustomerDetails($customer_id);
		$details = array(
			'firstName' => $this->input->post('first_name'),
			'lastName' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'unit' => $this->input->post('unit'),
			'street' => $this->input->post('street'),
			'suburb' => $this->input->post('suburb'),
			'postcode' => $this->input->post('postcode'),
			'state' => $this->input->post('state'),
			'business_name' => $this->input->post('business_name'),
			'brand_name' => $this->input->post('brand_name'),
			'abn' => $this->input->post('abn'),
			'website' => $this->input->post('website'),
			);
		
		$result = $this->settings_model->updateCustomerDetail($details, $customer_id, $user_id);
		$this->session->set_flashdata('sucess_msg', 'Details Successfully updated');
		redirect('settings/customerDetails');
	}
	
	function customerDetails() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
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
				
				$user_id = $this->session->userdata('user_id');
				$user_details = $this->settings_model->getUserDetails($user_id);
	
				$customer_id = $user_details[0]->customer_id;
				$customer_details = $this->settings_model->getCustomerDetails($customer_id);
				// echo '<pre>';print_r($customer_details);exit;
				$data['customer_details'] = $customer_details[0];
				$data['user_details'] = $user_details[0];
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('settings/company_info',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	//05-10-2016
	//Branches start
	
	


	
	function branches() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else {
			$res = $this->ion_auth->subscription();
			$status = $res[0]->status;
			$remaining = 0;
			$trail_period = '';
			ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



		
		
    
		
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
				
				$branch_limit = $this->settings_model->getSubscriptionDetails();
				$branches = $this->settings_model->get_branches();
				$active_branches = $this->settings_model->get_active_branches();
				
				$limit = $branch_limit[0]->no_of_branches;
				$branch_count = $active_branches[0]->cnt;
				// echo $limit.'-'.$branch_count;exit;
				$data['branches'] = $branches;
				$data['max_limit'] = $limit;
				$data['branch_count'] = $branch_count;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('settings/branches',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	function add_branch() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
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
				$suppliers = $this->settings_model->get_suppliers();
				$data['suppliers'] = $suppliers;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('settings/add_branch',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	function edit_branch($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
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
				$branches = $this->settings_model->get_branch_detail($id);
				$branch_access = $this->settings_model->getSupplierBranches($id);
				//echo '<pre>';print_r($branch_access);exit;
				$sup_branch_acc = array();
				foreach($branch_access as $access){
					$sup_branch_acc[$access->supplier_id] = $access->weekly_budget;
					//array_push($sup_branch_acc, $access->branch_id);
				}
				
				$suppliers = $this->settings_model->get_suppliers();
			    // echo '<pre>';print_r($suppliers);exit;
				$data['branches'] = $branches;
				$data['branch_access'] = $sup_branch_acc;
				$data['suppliers'] = $suppliers;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('settings/edit_branch',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	function branch_insert() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else {
			
			$customer_id = $this->session->userdata('customerId');
			$branch_name = $this->input->post('branch_name');
			$unit = $this->input->post('unit');
			$suburb = $this->input->post('suburb');
			$street = $this->input->post('street');
			$postcode = $this->input->post('postcode');
			$state = $this->input->post('state');
			$branch_code = $this->input->post('branch_code');
			$branch_budget = $this->input->post('branch_budget');
			$status = $this->input->post('status');
			$phone = $this->input->post('phone');
			
			$branch_limit = $this->settings_model->getSubscriptionDetails();
			$active_branches = $this->settings_model->get_active_branches();
			
			$active_cnt = $active_branches[0]->cnt;
			$branch_cnt = $branch_limit[0]->no_of_branches;
			
			$balance = $branch_cnt - $active_cnt;
			if($balance >= $status){
			
				$details = array(
						'customer_id' => $customer_id,
						'branch_name' => $branch_name,
						'unit' => $unit,
						'street' => $street,
						'suburb' => $suburb,
						'postcode' => $postcode,
						'state' => $state,
						'branch_code' => $branch_code,
						'branch_budget' => $branch_budget,
						'status' => $status,
						'phone'  => $phone
						);
				// echo '<pre>';print_r($details);exit;
				$branche_id = $this->settings_model->add_branches($details);
				if($branche_id){
					$user_id = $this->session->userdata('user_id');
					$branch_access = $this->input->post('branch_access');
					$weekly_budget = $this->input->post('weekly_budget');
					if(!empty($branch_access)){
						foreach($branch_access as $key=>$branch){
							if($branch!=''){
								$branch_data = array(
									'branch_id' => $branche_id,
									'weekly_budget' => $weekly_budget[$key],
									'customer_id' => $user_id,
									'supplier_id' => $branch
								);
								
								$supplier_branch = $this->settings_model->addSupplierBudget($branch_data);
							}
						}
					}
					
					$this->session->set_flashdata('sucess_msg', 'Site sucessfully added');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add Site');
				}
			}else{
				$this->session->set_flashdata('limit_error_msg', 'No.of Site limit reached');
			}
			redirect('settings/branches');
		}
	}
	
	function branch_update() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else {
			
			// echo '<pre>';print_r($_POST);exit;
			$this->form_validation->set_rules('branch_name','branch_name','trim|required');
          
			if ($this->form_validation->run() == true) {
			$id = $this->input->post('branch_id');
			$customer_id = $this->session->userdata('customerId');;
			$branch_name = $this->input->post('branch_name');
			$unit = $this->input->post('unit');
			$suburb = $this->input->post('suburb');
			$street = $this->input->post('street');
			$postcode = $this->input->post('postcode');
			$state = $this->input->post('state');
			$branch_code = $this->input->post('branch_code');
			$branch_budget = $this->input->post('branch_budget');
			$status = $this->input->post('status');
			$old_status = $this->input->post('old_status');
			$phone = $this->input->post('phone');
			
			$branch_limit = $this->settings_model->getSubscriptionDetails();
			$active_branches = $this->settings_model->get_active_branches();
			
			$active_cnt = $active_branches[0]->cnt;
			$branch_cnt = $branch_limit[0]->no_of_branches;
			$branchLimit = 0;
			$balance_branches = $branch_cnt - $active_cnt;
			$details = array(
						'customer_id' => $customer_id,
						'branch_name' => $branch_name,
						'unit' => $unit,
						'street' => $street,
						'suburb' => $suburb,
						'postcode' => $postcode,
						'state' => $state,
						'branch_code' => $branch_code,
						'branch_budget' => $branch_budget,
						'phone' => $phone
					);
			if($status != $old_status){
				if($status == 1){
					if($balance_branches >= $status){
						$details['status'] = $status;
						$branchLimit = 1;
					}else{
						$branchLimit = 2;
					}
				}else{
					$details['status'] = $status;
					$branchLimit = 1;
				}
				
			}else{
				$branchLimit = 1;
			}
			
			$update_branch = $this->settings_model->update_branch($details,$id);
			if($update_branch){
				$user_id = $this->session->userdata('user_id');
				$this->settings_model->deleteSupplierBranches($id);
				$branch_access = $this->input->post('branch_access');
				$weekly_budget = $this->input->post('weekly_budget');
				if(!empty($branch_access)){
					foreach($branch_access as $key=>$branch){
						if($branch!=''){
							$branch_data = array(
								'branch_id' => $id,
								'weekly_budget' => $weekly_budget[$key],
								'customer_id' => $customer_id, 
								'supplier_id' => $branch
							);
							$supplier_branch = $this->settings_model->addSupplierBudget($branch_data);
						}
					}
				}
				if($branchLimit == 1){
					$this->session->set_flashdata('sucess_msg', 'Site sucessfully updated');
				}else if($branchLimit == 2){
					$this->session->set_flashdata('error_msg', 'Site Limit reached');
				}
				//$this->session->set_flashdata('sucess_msg', 'Branch sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update Site');
			}
			
		    redirect('settings/branches');
		  }	
		}
	}
	
	function branch_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			//echo $id;exit;
			$branch_delete = $this->settings_model->branch_delete($id);
			$supplier_branch_delete = $this->settings_model->supplier_branch_delete($id);
			redirect('settings/branches');
		}
	}
	
	 function new_submit_update_branches() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else {
		   	//echo '<pre>';print_r($_POST);exit;
	        $customer_id = $this->input->post('customer_id');
		    $branch_ids = $this->input->post('branch_id');
			$branch_name = $this->input->post('branch_name');
			$unit = $this->input->post('unit');
			$suburb = $this->input->post('suburb');
			$street = $this->input->post('street');
			$postcode = $this->input->post('postcode');
			$state = $this->input->post('state');
			$branch_code = $this->input->post('branch_code');
			$branch_budget = $this->input->post('branch_budget');
				
			if($branch_ids != ''){
				foreach($branch_ids as $key => $itemId){
					if($itemId != ''){
						$branchDetailId = $key;
						$details = array(
							'customer_id' => $customer_id,
							'branch_name' => $branch_name[$key],
							'unit' => $unit[$key],
							'street' => $street[$key],
							'suburb' => $suburb[$key],
							'postcode' => $postcode[$key],
							'state' => $state[$key],
							'branch_code' => $branch_code[$key],
							'branch_budget' => $branch_budget[$key]
							);
							//print_r($details);exit;
						$branch_update = $this->settings_model->edit_branches_detail_row_details($details, $branchDetailId);
						$this->session->set_flashdata('sucess_msg', 'Branch successfully added');
					}
				}
			}
		    $newbranch_ids = $this->input->post('new_branch_name');
			$new_branch_name = $this->input->post('new_branch_name');
			$new_unit = $this->input->post('new_unit');
			$new_suburb = $this->input->post('new_suburb');
			$new_street = $this->input->post('new_street');
			$new_postcode = $this->input->post('new_postcode');
			$new_state = $this->input->post('new_state');
			$new_branch_code = $this->input->post('new_branch_code');
			$new_branch_budget = $this->input->post('new_branch_budget');
			
			if( $newbranch_ids != ''){
			    foreach($newbranch_ids as $res => $itemId){
					if($itemId != ''){
						$details = array(
							'customer_id' => $customer_id,
							'branch_name' => $new_branch_name[$res],
							'unit' => $new_unit[$res],
							'street' => $new_street[$res],
							'suburb' => $new_suburb[$res],
							'postcode' => $new_postcode[$res],
							'state' => $new_state[$res],
							'branch_code' => $new_branch_code[$res],
							'branch_budget' => $new_branch_budget[$res]
							);
							//echo '<pre>';print_r($details);exit;
						$add_branches = $this->settings_model->add_branches($details);
						$this->session->set_flashdata('sucess_msg', 'Branch successfully added');
					}
			    }
			}
			redirect('settings/branches');
		}
	}
	
	// Users start
	function users_list() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('settings/users', 'submenu')){
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
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->settings_model->getUserGroupDetails($group_id);
			    
    				if($group_details[0]->name == "Super Admin"){
    					$users = $this->settings_model->get_users();
    					foreach($users as $res=>$row){
    						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
    						$users[$res]->branch_access = $branches_checked;
    					}
    					$branches = $this->settings_model->cust_branches();
    					
    					$active_cnt = count($users)-1;
    				}
    				else if($group_details[0]->name == "Admin"){
    					$final_users = $this->settings_model->get_users_admin();
    					$branch_id = $this->session->userdata('branch_id');
    					$users = array();
    					
    					foreach($final_users as $res=>$row){
    						$branch_acc = array();
    						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
    						if(!empty($branches_checked)){
    							foreach($branches_checked as $result){
    								array_push($branch_acc,$result->branch_id);
    							}
    						}
    						if(in_array($branch_id, $branch_acc)){
    							$users[$res] = $row;
    							$users[$res]->branch_access = $branches_checked;
    						}
    					}
    				    
    				    $branches = $this->settings_model->branches_checked_data($branch_id);
    				    
    				    $active_cnt = count($users);
    				}
    				
    				$no_of_users = $this->settings_model->getSubscriptionDetails();
    				$user_limit = $no_of_users[0]->no_of_users;
    				
    			 //   echo '<pre>';print_r($users);exit;
    				$data['user_group'] = $group_details[0]->name;
    				$data['branches'] = $branches;
    				$data['users'] = $users;
    				
    				$data['user_limit'] = $user_limit;
    				$data['active_users'] = $active_cnt;
    				
    				$this->load->view('general/header_general',$hdata);
    				$this->load->view('settings/users_list',$data);
    				$this->load->view('general/footer');
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	function users($userid='') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('settings/users', 'submenu')){
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
				
				if($userid != ''){
				    $pageTitle = "Edit User";
				}else{
				    $pageTitle = "Add User";
				}
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->settings_model->getUserGroupDetails($group_id);
			    $active_cnt = '';
			    $users = array();
    				if($group_details[0]->name == "Super Admin"){
    				    if($userid != ''){
    					$users = $this->settings_model->get_users($userid);
    					foreach($users as $res=>$row){
    						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
    						$users[$res]->branch_access = $branches_checked;
    					}
    					$active_cnt = count($users)-1;
    				    }
    					$branches = $this->settings_model->cust_branches();
    					
    					
    				}
    				else if($group_details[0]->name == "Admin"){
    				    $branch_id = $this->session->userdata('branch_id');
    				    if($userid != ''){
        					$final_users = $this->settings_model->get_users_admin();
        					
        					$users = array();
        					
        					foreach($final_users as $res=>$row){
        						$branch_acc = array();
        						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
        						if(!empty($branches_checked)){
        							foreach($branches_checked as $result){
        								array_push($branch_acc,$result->branch_id);
        							}
        						}
        						if(in_array($branch_id, $branch_acc)){
        							$users[$res] = $row;
        							$users[$res]->branch_access = $branches_checked;
        						}
        					}
        					$active_cnt = count($users);
    				    }
    				    $branches = $this->settings_model->branches_checked_data($branch_id);
    				    
    				    
    				}
    				
    				$no_of_users = $this->settings_model->getSubscriptionDetails();
    				$user_limit = $no_of_users[0]->no_of_users;
    				
    			    
    				$data['user_group'] = $group_details[0]->name;
    				$data['branches'] = $branches;
    				$data['users'] = $users;
    				
    				$data['user_limit'] = $user_limit;
    				$data['active_users'] = $active_cnt;
    				$data['pageTitle'] = $pageTitle;
    				// echo '<pre>';print_r($data);exit;
    				$this->load->view('general/header_general',$hdata);
    				$this->load->view('settings/users',$data);
    				$this->load->view('general/footer');
				
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	function user_view($userid='') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('settings/users', 'submenu')){
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
				
				
				    $pageTitle = "User Information";
				    $formType = "view";
				
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->settings_model->getUserGroupDetails($group_id);
			    $active_cnt = '';
			    $users = array();
    				if($group_details[0]->name == "Super Admin"){
    				    if($userid != ''){
    					$users = $this->settings_model->get_users($userid);
    					foreach($users as $res=>$row){
    						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
    						$users[$res]->branch_access = $branches_checked;
    					}
    					$active_cnt = count($users)-1;
    				    }
    					$branches = $this->settings_model->cust_branches();
    					
    					
    				}
    				else if($group_details[0]->name == "Admin"){
    				    $branch_id = $this->session->userdata('branch_id');
    				    if($userid != ''){
        					$final_users = $this->settings_model->get_users_admin();
        					
        					$users = array();
        					
        					foreach($final_users as $res=>$row){
        						$branch_acc = array();
        						$branches_checked = $this->settings_model->cust_branches_checked($row->customer_user_id);
        						if(!empty($branches_checked)){
        							foreach($branches_checked as $result){
        								array_push($branch_acc,$result->branch_id);
        							}
        						}
        						if(in_array($branch_id, $branch_acc)){
        							$users[$res] = $row;
        							$users[$res]->branch_access = $branches_checked;
        						}
        					}
        					$active_cnt = count($users);
    				    }
    				    $branches = $this->settings_model->branches_checked_data($branch_id);
    				    
    				    
    				}
    				
    				$no_of_users = $this->settings_model->getSubscriptionDetails();
    				$user_limit = $no_of_users[0]->no_of_users;
    				
    			    
    				$data['user_group'] = $group_details[0]->name;
    				$data['branches'] = $branches;
    				$data['users'] = $users;
    				
    				$data['user_limit'] = $user_limit;
    				$data['active_users'] = $active_cnt;
    				$data['pageTitle'] = $pageTitle;
    				$data['formType'] = $formType;
    				// echo '<pre>';print_r($data);exit;
    				$this->load->view('general/header_general',$hdata);
    				$this->load->view('settings/users',$data);
    				$this->load->view('general/footer');
				
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	function new_submit_update_users() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else {
			$this->load->library('email'); 
		  // 	echo '<pre>';print_r($_POST);
	        $customer_user_ids = $this->input->post('customer_user_id');
	        $customer_id = $this->input->post('customer_id');
	        
	        //userslimit
	        $no_of_users = $this->settings_model->getSubscriptionDetails();
			$user_limit = $no_of_users[0]->no_of_users;
	        
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
		    $email = $this->input->post('email');
		    $password = $this->input->post('password');
		    
			$user_type = $this->input->post('user_type');
			$branch_id = $this->input->post('branches');
			$status = $this->input->post('status');
			$cnt = 0;
			if($status == 1){ $cnt = $cnt+1; }
// foreach($status as $s){
// 				if($s == 1){
// 					$cnt = $cnt+1;
// 				}
// 			}
			$group_id = $this->session->userdata('groupId');
			$group_details = $this->settings_model->getUserGroupDetails($group_id);
		
			if($group_details[0]->name == "Super Admin"){
				$active_count = $cnt-1;
			}else{
				$active_count = $cnt;
			}
			$balance = $user_limit - $active_count;
				if($customer_user_ids != ''){
			// echo $user_limit.'/'.$active_count.'/'.$balance;exit;
			if($user_limit >= $active_count){
				// echo $cnt;exit;
			
							
				$branch_update = $this->settings_model->edit_users_detail_row_details($customer_user_ids,$first_name,$last_name,$email,$status,$user_type,$branch_id,$customer_id,$password);
				if($branch_update){
					$this->session->set_flashdata('sucess_msg', 'User successfully Updated');
				}else{
					$this->session->set_flashdata('error_msg', 'Please fill all required fields');
				}
				
				}else{
				$this->session->set_flashdata('limit_error_msg', 'No. of active users reached');
			}
				redirect('settings/users/'.$customer_user_ids);
			}else{
			
			$newuser_count = 1;
			
			if($balance > 0 && $balance >= $newuser_count-1){
			 //   $new_first_names = $this->input->post('new_first_name');
				// $new_last_name = $this->input->post('new_last_name');
				// $new_email = $this->input->post('new_email');
				// $new_status = $this->input->post('new_status');
				// $password = 'abcd1234';
				$password = $this->input->post('password');
				// $new_user_type = $this->input->post('new_user_type');
				// $new_branch_id = $this->input->post('new_branches');
	            $customer_id = 14;
				if( $first_name != ''){
				    // echo "ncdb";
							if($email == '' || $user_type == '' || empty($branch_id)){
								$this->session->set_flashdata('error_msg', 'Please fill all required fields');
							}else{
								$add_branches = $this->settings_model->add_users($first_name,$last_name,$email,$user_type,$branch_id,$customer_id,$password);
								if($add_branches){
									$activation_code = $this->settings_model->activation_code;
									$to = $email;
									$this->email->set_newline("\r\n");
									$this->email->from('admin@cafeadmin.com.au', 'Cafe Admin'); 
									$this->email->to($to);
									$this->email->subject('User Registration'); 
									$data['user_id'] = $add_branches;  
									$data['activation'] = $activation_code;
									$body = $this->load->view('settings/activate_email', $data,TRUE);
									$this->email->message($body);
									$send = $this->email->send();
									$this->session->set_flashdata('sucess_msg', 'User successfully added');
								}else{
								    $this->session->set_flashdata('error_msg', 'User not added');
								}
								
							}
					
				}
			}else{
				$this->session->set_flashdata('limit_error_msg', 'No. of active users reached');
			}
				redirect('settings/users');
			}
// 			exit;
			//$deleteIds = $this->input->post('deleteIds');
			//$this->settings_model->deleteUsers($deleteIds);
		
		}
	}
    
    public function resendActivation(){
    	$customer_id = $this->input->post('customer_user_id');
    	$user_details = $this->settings_model->getUserDetails($customer_id);
    	
    	if(!empty($user_details)){
			$details = $user_details[0];
			$this->email->set_newline("\r\n");
			$this->email->from('admin@cafeadmin.com.au', 'Cafe Admin'); 
			$this->email->to($details->email);
			$this->email->subject('Account Activation'); 
			$data = '';  
			$body = $this->load->view('settings/activate_email', $data,TRUE);
			$this->email->message($body);
			$send = $this->email->send();
			if($send){
				$this->settings_model->updateEmailVerification($customer_id);
			}
		}
		
		echo 'success';
    }
    
    public function subscriptions(){
    	$group_id = $this->session->userdata('groupId');
		$group_details = $this->settings_model->getUserGroupDetails($group_id);
		
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
		$packages = $this->settings_model->getPackages();
		$customer_package = $this->settings_model->getUserPackageDetails();
		$addons = $this->settings_model->getAddons($customer_package[0]->package_id);
		// echo '<pre>';print_r($customer_package);exit;
		$data['packages'] = $packages;
		$data['customer_package'] = $customer_package[0];
		$data['addons'] = $addons[0];
		
		$data['usertype'] = $group_details[0]->name;
    	$this->load->view('settings/header_settings',$hdata);
		$this->load->view('settings/subscription_info',$data);
		$this->load->view('general/footer');
    }
    
    public function subscription_update(){
    	// echo '<pre>';print_r($_POST);exit;
    	$package_id = $_POST['package'];
    	$package_details = $this->settings_model->getPackageDetails($package_id);
    	$customer_package = $this->settings_model->getUserPackageDetails();
    	$today = date('Ym');
    	$details = array();
    	
    	$details['package_id'] = $_POST['package'];
    	// $details['expiry'] = $_POST[''];
    	$details['base_amount'] = $_POST['package_total'];
    	// $details['status'] = $_POST[''];
    	
    	//user addon check
    	$user_updated_on = $customer_package[0]->user_updated_on;
  		$user_update = '';
  		if($user_updated_on != '0000-00-00 00:00:00'){
  			$user_update = date('Ym', strtotime($user_updated_on));
  		}
  		
  		$useraddon = $customer_package[0]->base_users + $_POST['user_addon'];
  		if($user_update == '' && $user_update != $today){
  			$details['no_of_users'] = $useraddon;
  			$details['u_amount'] = $_POST['user_monthly_amount'];
  			$details['user_updated_on'] = date('Y-m-d H:i:s');
  		}
  		
  		//branch check
    	$branch_updated_on = $customer_package[0]->branch_updated_on;
  		$branch_update = '';
  		if($branch_updated_on != '0000-00-00 00:00:00'){
  			$branch_update = date('Ym', strtotime($branch_updated_on));
  		}
  		$branchaddon = $customer_package[0]->base_branches + $_POST['branch_addon'];
  		if($branch_update == '' && $branch_update != $today){
  			$details['no_of_branches'] = $branchaddon;
  			$details['b_amount'] = $_POST['branch_monthly_amount'];
  			$details['branch_updated_on'] = date('Y-m-d H:i:s');
  		}
  		
  		//orders check
  		$order_updated_on = $customer_package[0]->order_updated_on;
  		$order_update = '';
  		if($order_updated_on != '0000-00-00 00:00:00'){
  			$order_update = date('Ym', strtotime($order_updated_on));
  		}
  		$orderaddon = $customer_package[0]->base_orders + $_POST['order_addon'];
  		if($order_update == '' && $order_update != $today){
  			$details['no_of_orders'] = $orderaddon;
  			$details['o_amount'] = $_POST['order_monthly_amount'];
  			$details['order_updated_on'] = date('Y-m-d H:i:s');
  		}
  		
  		// echo '<pre>';print_r($details);exit;
  		$order_update = $this->settings_model->updatePackage($details);
  		if($order_update){
  			$this->session->set_flashdata('subscription_msg', 'Subscription updated successfully');
  			redirect('settings/subscriptions');
  		}
    	
    }
    
    public function getPackageDetails(){
    	$package_id = $_POST['package_id'];
    	$package_details = $this->settings_model->getPackageDetails($package_id);
    	$customer_package = $this->settings_model->getUserPackageDetails();
    	$addons = $this->settings_model->getAddons($package_id);
    	
    	$users_panel = '';
    	$branch_panel = '';
    	$orders_panel = '';
    	$total_panel = '';
    	
    	//users panel
    	$additional_users = $customer_package[0]->no_of_users - $package_details[0]->no_of_users;
  		if($additional_users > 0){
  			$ext_users = $additional_users;
  		}else{
  			$ext_users = 0;
  		}
    	$users_panel.='<span>$'.$addons[0]->u_amount.' / '.$addons[0]->users.' Users</span>';
    	$users_panel.='<div class="handle-counter">
						  <button type="button" class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`user`,`'.$addons[0]->u_amount.'`,`'.$addons[0]->users.'`)" >-</button>
						  <input class="order" type="text" value="'.$ext_users.'" id="user_addon" name="user_addon">
						  <button type="button" class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`user`,`'.$addons[0]->u_amount.'`,`'.$addons[0]->users.'`)">+</button>
						</div>
						<div>
							Monthly cost <span id="user_monthly_cost">$'. (($ext_users/$addons[0]->users) * $addons[0]->u_amount).'</span>
							<input type="hidden" id="user_monthly_amount" value="'.(($ext_users/$addons[0]->users) * $addons[0]->u_amount).'" name="user_monthly_amount">
						</div>';
    	//branch panel
    	$additional_branches = $customer_package[0]->no_of_branches - $package_details[0]->no_of_branches;
  		if($additional_branches > 0){
  			$ext_branches = $additional_branches;
  		}else{
  			$ext_branches = 0;
  		}
          				
    	$branch_panel.='<span>$'.$addons[0]->b_amount.' / '.$addons[0]->branches.' Branches</span>';
    	$branch_panel.='<div class="handle-counter">
						  <button type="button" class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`branch`,`'.$addons[0]->b_amount.'`,`'.$addons[0]->branches.'`)" >-</button>
						  <input class="order" type="text" value="'.$ext_branches.'" id="branch_addon" name="branch_addon">
						  <button type="button" class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`branch`,`'.$addons[0]->b_amount.'`,`'.$addons[0]->branches.'`)">+</button>
						</div>
						<div>
							Monthly cost <span id="branch_monthly_cost">$'. (($ext_branches/$addons[0]->branches) * $addons[0]->b_amount).'</span>
							<input type="hidden" id="branch_monthly_amount" value="'.(($ext_branches/$addons[0]->branches) * $addons[0]->b_amount).'" name="branch_monthly_amount">
						</div>';
    	
    	//orders panel
    	$additional_orders = $customer_package[0]->no_of_orders - $package_details[0]->no_of_orders;
  		if($additional_orders > 0){
  			$ext_orders = $additional_orders;
  		}else{
  			$ext_orders = 0;
  		}
  		
    	$orders_panel.='<span>$'.$addons[0]->o_amount.' / '.$addons[0]->orders.' Orders</span>';
    	$orders_panel.='<div class="handle-counter">
						  <button type="button" class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`order`,`'.$addons[0]->o_amount.'`,`'.$addons[0]->orders.'`)" >-</button>
						  <input class="order" type="text" value="'.$ext_orders.'" id="order_addon" name="order_addon">
						  <button type="button" class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`order`,`'.$addons[0]->o_amount.'`,`'.$addons[0]->orders.'`)">+</button>
						</div>
						<div>
							Monthly cost <span id="order_monthly_cost">$'. (($ext_orders/$addons[0]->orders) * $addons[0]->o_amount).'</span>
							<input type="hidden" id="order_monthly_amount" value="'.(($ext_orders/$addons[0]->orders) * $addons[0]->o_amount).'" name="order_monthly_amount">
						</div>';
						
		//total panel
		$basetotal = $package_details[0]->amount;
		$user = ($ext_users / $addons[0]->users) * $addons[0]->u_amount;
		$branch = ($ext_branches/$addons[0]->branches) * $addons[0]->b_amount;
		$orders = ($ext_orders/$addons[0]->orders) * $addons[0]->o_amount;
		$total = $basetotal+$user+$branch+$orders;
		$total_panel.='<div>Total Amount
							<h3 id="total_plan">$'.number_format($total, '2','.','').'</h3>
							<input type="hidden" name="total_plan_amount" id="total_plan_amount" value="'.$total.'">
						</div>';
    	
    	$data['user_panel'] = $users_panel;
    	$data['branch_panel'] = $branch_panel;
    	$data['orders_panel'] = $orders_panel;
    	$data['total_panel'] = $total_panel;
    	$data['package_amount'] = $package_details[0]->amount;
    	
    	echo json_encode($data);
    	
    }
    public function updateDetails(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
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
				$customer_details = $this->settings_model->customer_details();
				// echo '<pre>';print_r($customer_details);exit;
				$data['details'] = $customer_details;
				$hdata['menus'] = $menu_items;
				$hdata['trail_period'] = $remaining;
				/*menu items end */
				
				$data[''] = '';
				$this->load->view('general/header_general',$hdata);
				$this->load->view('settings/update_user_details',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    
    //change password
    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
		
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
        	
            //display the form
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            // $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            
            // $data['old'] = $this->form_validation->set_value('old');
            // $data['new'] = $this->form_validation->set_value('new');
            // $data['cnf_password'] = $this->form_validation->set_value('new_confirm');
			
			$this->session->set_flashdata('message', $data);
            
        } else {
            $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message_success', $this->ion_auth->messages());
                //$this->logout();
                // redirect('general', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                // redirect('auth/change_password', 'refresh');
            }
        }
        
        redirect('settings/updateDetails');
    }
    function update_profile() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$data = array(
				'first_name' =>$this->input->post('first_name'),
				'last_name' =>$this->input->post('last_name'),
				'phone' =>$this->input->post('mobile')
				);
				//echo '<pre>';print_r($data);exit;
			$update_profile = $this->settings_model->update_profile($data);	
			if($update_profile){
				$this->session->set_flashdata('success_message','Profile sucessfully updated');
			}else {
                $this->session->set_flashdata('error_message','Unable to update profile');
                // redirect('auth/change_password', 'refresh');
            }
			redirect('settings/updateDetails');
		}
	}
    function customer_branch_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id=$this->input->post('id');
			//echo $id;exit;
			$res=$this->settings_model->customer_branch_delete($id);
			redirect('settings/branches');
		}
	}
	
}