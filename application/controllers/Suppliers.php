<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Suppliers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('suppliers_model');
		$this->load->model('general_model');
		$this->load->model('orders_model');
		$this->load->model('items_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    public function index(){
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('suppliers', 'menu')){
			redirect('general/index');
		}else {
    		redirect('suppliers/manage_suppliers');
		}
    }
    
    public function display_menu(){
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
				return $menu_items;
    }
    // copy supliers from one location to another
    
    public function fetch_suppliers(){
        if(isset($_POST['suupid']) && $_POST['suupid'] !=''){
            $this->load->model('orders_model');
         $branch_suppliers = $this->orders_model->get_branch_suppliers($_POST['suupid']);
         
       
         echo json_encode($branch_suppliers);
         exit;
            
        }
        
    }
    
    function export_suppliers(){
	   $branch_id = $this->session->userdata('branch_id');
		$branch_suppliers = $this->suppliers_model->get_branch_suppliers($branch_id);
			if(!empty($branch_suppliers)){
		foreach($branch_suppliers as $supp){
		$supplier_details = $this->suppliers_model->edit_suppliers($supp->supplier_id);
		if(!empty($supplier_details[0])){
		$suppliers[] = $supplier_details[0]; 
		}
		}
		}
	
	  $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
     $sheet = $spreadsheet->getActiveSheet();
     $sheet->setCellValue('A1', 'Supplier Name');
      $sheet->setCellValue('B1', 'Contact Name');
      $sheet->setCellValue('C1', 'Contact No.');
      $sheet->setCellValue('D1', 'Email');
    
      $size = count($suppliers);
       
      $index = 0;
      for($x = 2; $x < $size+2; $x++){ 
        $sheet->setCellValue('A'.$x, $suppliers[$index]->supplier_name);
        $sheet->setCellValue('B'.$x, $suppliers[$index]->first_name.' '.$suppliers[$index]->last_name);
        $sheet->setCellValue('C'.$x, $suppliers[$index]->mobile);
        $sheet->setCellValue('D'.$x, $suppliers[$index]->email);
        $index++;
          }

        $writer = new Xlsx($spreadsheet); 
        $filename = 'Approved Suppliers';
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;

	}
    
    public function copy_suppliers(){
        
        if(isset($_POST['copy_from']) && isset($_POST['copy_to'])){
            
             
            
             $this->load->model('orders_model');
         $br = $this->orders_model->copy_supp($_POST['suppliers_list'],$_POST['copy_from']);
         
        
         if(!empty($br)){
         foreach($br as $b){
            
           
            $suppliers_details = $this->orders_model->getSuppliers($b->supplier_id);
            
            $suppliers_data = array(
                 
                 'supplier_id' => '',
                 'supplier_name' => $suppliers_details[0]->supplier_name,
                 'abn'=> $suppliers_details[0]->abn,
                 'website' => $suppliers_details[0]->website,
                 'first_name'=> $suppliers_details[0]->first_name,
                 'last_name' => $suppliers_details[0]->last_name,
                 'email'=> $suppliers_details[0]->email,
                 'cc' => $suppliers_details[0]->cc,
                 'mobile'=> $suppliers_details[0]->mobile,
                 'unit_number' => $suppliers_details[0]->unit_number,
                 'street'=> $suppliers_details[0]->street,
                 'suburb' =>$suppliers_details[0]->suburb,
                 'abn'=> $suppliers_details[0]->abn,
                 'postcode' => $suppliers_details[0]->postcode,
                 'state'=> $suppliers_details[0]->state,
                 'category_id' => $suppliers_details[0]->category_id,
                 'customer_number'=> $suppliers_details[0]->customer_number,
                 'minimum_order' => $suppliers_details[0]->minimum_order,
                 'status'=> $suppliers_details[0]->status,
                 'customer_id' =>$suppliers_details[0]->customer_id,
                 'created_date' => $suppliers_details[0]->created_date,
                 'country'=> $suppliers_details[0]->country,
                 'updated_by' =>$suppliers_details[0]->updated_by,
                 'fax' =>$suppliers_details[0]->fax
                 
                 
                 );
           
           $suuplier_id= $this->orders_model->insert_supp_details($suppliers_data);
           
            $data = array(
                 'supplier_branch_id'=>'',
                 'supplier_id' => $suuplier_id,
                 'branch_id' => $_POST['copy_to'],
                 'weekly_budget'=> $b->weekly_budget,
                 'customer_id' => $b->customer_id
                 
                 );
               
             
            $this->orders_model->insert_supp($data);
            
            $suppliers_products = $this->orders_model->getSupplierItems($b->supplier_id);
            
            
        
            if(!empty($suppliers_products)){
            foreach($suppliers_products as $suppliers_product){
                
             $productdata = array(
                 
                 'itemName' => $suppliers_product->itemName,
                 'price'=> $suppliers_product->price,
                 'category' => $suppliers_product->category,
                 'supplierId' => $suuplier_id,
                 'status' => $suppliers_product->status,
                   'createdOn' => date("Y-m-d"),
                 'customer_id'=> $suppliers_product->customer_id,
                 'uom' => $suppliers_product->uom,
                 'pack_quantity' => $suppliers_product->pack_quantity,
                 'packs_per_case' => $suppliers_product->packs_per_case,
                 'itemCode'=> $suppliers_product->itemCode,
                 'account'=> $suppliers_product->account,
                 'account_name'=> $suppliers_product->account_name,
                 'tax_code'=> $suppliers_product->tax_code,
                 'type' => $suppliers_product->type,
                 'min_order_qnty'=> $suppliers_product->min_order_qnty,
                 'min_order_type' => $suppliers_product->min_order_type,
                  'updated_by' => $suppliers_product->updated_by
                 );
               
               
                 
                 $res=  $this->items_model->submit_items($productdata);
                //  echo "<pre>";
                //  print_r($res);
                //  exit;
            }
         }
            
            
         }
        echo "Copied";
        exit;
        }
        }else {
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
					}
				}
				
				$menu_items= $this->display_menu();
				$hdata['menus'] = $menu_items;
			
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/copy_suppliers',$data);
				$this->load->view('general/footer');
        
        }
    }
    //Manage suppliers
    
    public function manage_suppliers(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('suppliers/manage_suppliers', 'submenu')){
			redirect('general/index');
		}else{
			$res = $this->ion_auth->subscription();
			$status = $res[0]->status;
			$remaining = 0;
			$trail_period = '';
		
// 			if($status == 'Trail'){
// 				$exp_date = date('Y-m-d H:i:s', strtotime($res[0]->expiry));
// 				$today = time();
// 				$expdate = strtotime($exp_date);
// 				if($expdate >= $today){
// 					$trail_period = 'available';
// 					$diff = $today - $expdate;
// 					$remaining = (floor($diff / (60 * 60 * 24))) * -1;
// 				}else{
// 					$trail_period = 'Expired';
// 				}
// 			}
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
				
				$group_details = $this->suppliers_model->getUserGroupDetails($group_id);
				
				$suppliers = array();
				$branches = array();
				// if($group_details[0]->name == 'Super Admin'){
				// 	$branches = $this->suppliers_model->getBranches();
				// 	$allSuppliers = $this->suppliers_model->get_suppliers();
				// 	$suppliers = $allSuppliers;
					
				// }else{
					$branch_id = $this->session->userdata('branch_id');
					$branch_suppliers = $this->suppliers_model->get_branch_suppliers($branch_id);
					 //echo '<pre>';print_r($branch_suppliers);exit;
					if(!empty($branch_suppliers)){
					  foreach($branch_suppliers as $supp){
							$supplier_details = $this->suppliers_model->edit_suppliers($supp->supplier_id);
							if(!empty($supplier_details[0])){
							   $suppliers[] = $supplier_details[0]; 
							}
							}
				}
				//  echo '<pre>';print_r($suppliers);exit;
				
				// $hdata['cat_result'] = $finalCatlist;
				$data['suppliers'] = $suppliers;
				$data['branches'] = $branches;
				$data['user_group'] = $group_details[0]->name;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/manage_suppliers',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	public function getBranchSuppliers(){
		$branch_id = $_POST['branch_id'];
		$branch_suppliers = $this->suppliers_model->get_branch_suppliers($branch_id);
		if(!empty($branch_suppliers)){
			foreach($branch_suppliers as $supp){
				$supplier_details = $this->suppliers_model->edit_suppliers($supp->supplier_id);
				$suppliers[] = $supplier_details[0];
			}
		}
		$res = '';
		if(!empty($suppliers)){
			foreach($suppliers as $supplier){
				$res.= '<tr class="tr">
						<td class="text-left"><a  href="'. base_url().'index.php/suppliers/edit_suppliers/'.$supplier->supplier_id.'" >'.$supplier->supplier_name.'</a></td>
						<td class="text-left">'.$supplier->first_name.'</td>
						<td class="text-center">'.$supplier->mobile.'</td>
						<td class="text-left">'.$supplier->email.'</td>
						<td class="text-center"><a href="'.base_url().'index.php/suppliers/supplier_items/'.$supplier->supplier_id.'">items</td>
						<td class="text-center">
							<!--<a type="button" onClick="delete_row(<?php //echo  $row->supplier_id; ?>);"><span class="glyphicon glyphicon-trash"></span></a>-->
						</td>
					</tr>';
			}
		}else{
			$res.='<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';
		}
		
		echo $res;
		// echo '<pre>';print_r($branch_suppliers);exit;
	}
	
	public function add_suppliers(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else{
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
				$group_details = $this->suppliers_model->getUserGroupDetails($group_id);
				
				$cat_category = $this->suppliers_model->cat_autoSearch();
				if($group_details[0]->name == "Super Admin"){
					$branches = $this->suppliers_model->getBranches();
				}else if($group_details[0]->name == "Admin"){
					$branch_id = $this->session->userdata('branch_id');
					$branches = $this->suppliers_model->branches_checked_data($branch_id);
				}
				
				$data['categories'] = $cat_category;
				$data['branches'] = $branches;
				$data['user_group'] = $group_details[0]->name;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/add_suppliers',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	function suppliers_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res=$this->suppliers_model->suppliers_delete($id);
			redirect('suppliers/manage_suppliers');
		}
	}
	
	public function submit_suppliers(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			//echo '<pre>';print_r($_POST);exit;
			$this->form_validation->set_rules('supplier_name','supplier_name','trim|required');
			$this->form_validation->set_rules('firstname','firstname','trim|required');
			$this->form_validation->set_rules('email','email','trim|required');
			$this->form_validation->set_rules('mobile','mobile','trim|required');
			$user_id = $this->session->userdata('user_id');
			$customer_id = $this->session->userdata('customerId');
			
			if ($this->form_validation->run() == true) {
				$data = array(
				'supplier_name' => $this->input->post('supplier_name'),
				'abn' => $this->input->post('abn'),
				'website' => $this->input->post('website'),
				'first_name' => $this->input->post('firstname'),
				'last_name' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'cc' => $this->input->post('cc'),
				'mobile' => $this->input->post('mobile'),
				'unit_number' => $this->input->post('unit'),
				'street' => $this->input->post('street'),
				'suburb' => $this->input->post('suburb'),
				'postcode' => $this->input->post('postcode'),
				'fax' => $this->input->post('fax'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'category_id' => $this->input->post('category'),
				'customer_number' => $this->input->post('customer_num'),
				'minimum_order' => $this->input->post('min_order'),
				'comments' => $this->input->post('comments'),
				'status' => $this->input->post('status'),
				'created_date' => date("Y-m-d"),
				'customer_id' => $customer_id,
				'updated_by' => $user_id,
				);
				$add_supplier = $this->suppliers_model->submit_suppliers($data);
				if($add_supplier){
					//branches access
					$branch_access = $this->input->post('branch_access');
					$weekly_budget = $this->input->post('weekly_budget');
					if(!empty($branch_access)){
						foreach($branch_access as $key=>$branch){
							if($branch!=''){
								$branch_data = array(
									'branch_id' => $branch,
									'weekly_budget' => $weekly_budget[$key],
									'customer_id' => $customer_id,
									'supplier_id' => $add_supplier
								);
								
								$supplier_branch = $this->suppliers_model->addSupplierBudget($branch_data);
							}
						}
					}
					//delivery schedule
					$delivery_days = $this->input->post('delivery_day');
					$cuttoff_days = $this->input->post('cutoff_day');
					$cuttoff_time = $this->input->post('cutoff_time');
					if(!empty($delivery_days)){
						foreach($delivery_days as $k => $day){
							$days = array(
									'customer_id' => $customer_id,
									'supplier_id' => $add_supplier,
									'delivery_day'=> $day,
									'cut_off_day' => $cuttoff_days[$k],
									'cut_off_time' => $cuttoff_time[$k],
								);
							$schedule = $this->suppliers_model->addDeliverySchedule($days);
						}
					}
					$this->session->set_flashdata('sucess_msg', 'Supplier sucessfully added');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add supplier');
				}
					redirect('suppliers/manage_suppliers');
			}
		}
	} 

	function edit_suppliers($id){
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
				
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->suppliers_model->getUserGroupDetails($group_id);
				
				$suppliers = $this->suppliers_model->edit_suppliers($id);
				
				$cat_category = $this->suppliers_model->cat_autoSearch();
				
				$branch_access = $this->suppliers_model->getSupplierBranches($id);
				
				if($group_details[0]->name == "Super Admin"){
					$branches = $this->suppliers_model->getBranches();
				}else if($group_details[0]->name == "Admin"){
					$branch_id = $this->session->userdata('branch_id');
					$branches = $this->suppliers_model->branches_checked_data($branch_id);
				}
				
				// 	echo '<pre>';print_r($branches);exit;
				
				$sup_branch_acc = array();
				foreach($branch_access as $access){
					$sup_branch_acc[$access->branch_id] = $access->weekly_budget;
				}
				
				//supplier schedule
				$sup_schedule = $this->suppliers_model->getSupplierSchedule($id);
				$delivery_days = array();
				foreach($sup_schedule as $schedule){
					$delivery_days[$schedule->delivery_day] = $schedule;
				}
				
				$data['categories'] = $cat_category;
				$data['branches'] = $branches;
				$data['suppliers'] = $suppliers;
				$data['branch_access'] = $sup_branch_acc;
				$data['user_group'] = $group_details[0]->name;
				$data['supplier_schedule'] = $delivery_days;
				// echo "<pre>";
				// print_r($suppliers);
				// exit;
				
			
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/edit_suppliers',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
	function supplier_items($id){
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
				
				$supplier_details = $this->suppliers_model->edit_suppliers($id);
				$suppliers = $this->suppliers_model->supplier_items($id);
				//echo '<pre>';print_r($suppliers);exit;
				$data['supplier_id'] = $id;
				$data['suppliers'] = $suppliers;
				$data['supplier_name'] = $supplier_details[0]->supplier_name;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/supplier_item',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    
    public function file_upload_code($name_value=''){
        
        if(isset($name_value) && $name_value !=''){
                
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx';
                 $config['max_size'] = 200000;
                 $config['max_width'] = 2000;
                 $config['max_height'] = 2000;
                 
                 $new_name = uniqid().'_'.$_FILES[$name_value]['name'];
                 
                 $new_name = preg_replace('/\s+/', '_', $new_name);
                 $config['file_name'] = $new_name;

                 $this->load->library('upload', $config);
                 
                 if (!$this->upload->do_upload($name_value, $new_name)) {
            
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error_msg', $error['error']);
                
                } 
        
        return $new_name;
                    
                }
    }
    public function update_suppliers(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			// echo '<pre>';print_r($_POST);exit;
			$this->form_validation->set_rules('supplier_name','supplier_name','trim|required');
            $this->form_validation->set_rules('firstname','firstname','trim|required');
            $this->form_validation->set_rules('email','email','trim|required');
            $this->form_validation->set_rules('mobile','mobile','trim|required');
		  if ($this->form_validation->run() == true) {
		  	$id = $this->input->post('supplier_id');
		    $user_id = $this->session->userdata('user_id');
		    $customer_id = $this->session->userdata('customerId');
		    
		    
		    
		    
		      if(isset($_FILES['haccp_certificate']['name']) && $_FILES['haccp_certificate']['name'] !=''){
                   
                  $haccp_certificate_name = $this->file_upload_code('haccp_certificate');
               }else{
                   $haccp_certificate_name ='';
               }
               	// 	$exp_date = date('Y-m-d H:i:s', strtotime($this->input->post('certificate_expiry_date')));
               	// 	$cfr_expiry_date = date('Y-m-d H:i:s', strtotime($this->input->post('cfr_expiry_date')));
               
                     $exp_date = strtotime($this->input->post('certificate_expiry_date'));
                     $exp_date = date('Y-m-d',$exp_date);
                     
                      $cfr_expiry_date = strtotime($this->input->post('cfr_expiry_date'));
                     $cfr_expiry_date = date('Y-m-d',$cfr_expiry_date);


			$data = array(
				'supplier_name' => $this->input->post('supplier_name'),
				'abn' => $this->input->post('abn'),
				'website' => $this->input->post('website'),
				'gl_code' => $this->input->post('gl_code'),
				'gl_category' => $this->input->post('gl_category'),
				'first_name' => $this->input->post('firstname'),
				'last_name' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'cc' => $this->input->post('cc'),
				'mobile' => $this->input->post('mobile'),
				'unit_number' => $this->input->post('unit'),
				'street' => $this->input->post('street'),
				'suburb' => $this->input->post('suburb'),
				'postcode' => $this->input->post('postcode'),
				'fax' => $this->input->post('fax'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'category_id' => $this->input->post('category'),
				'customer_number' => $this->input->post('customer_num'),
				'minimum_order' => $this->input->post('min_order'),
				'comments' => $this->input->post('comments'),
				'status' => $this->input->post('status'),
				'created_date' => date("Y-m-d"),
				'customer_id' => $customer_id,
				'haccp_certificate' => $haccp_certificate_name,
				'haccp_expiry_date' => $exp_date,
				'cfr_expiry_date' => $cfr_expiry_date,
				'updated_by' => $user_id,
			);
		    $update_supplier = $this->suppliers_model->update_suppliers($data,$id);
			if($update_supplier){
				$this->suppliers_model->deleteSupplierBranches($id);
				$branch_access = $this->input->post('branch_access');
				$weekly_budget = $this->input->post('weekly_budget');
				if(!empty($branch_access)){
					foreach($branch_access as $key=>$branch){
						if($branch!=''){
							$branch_data = array(
								'branch_id' => $branch,
								'weekly_budget' => $weekly_budget[$key],
								'customer_id' => $customer_id,
								'supplier_id' => $id
							);
							//echo '<pre>';print_r($branch_data);exit;
							$supplier_branch = $this->suppliers_model->addSupplierBudget($branch_data);
						}
					}
				}
				//delivery schedule
				$this->suppliers_model->deleteSupplierSchedule($id);
				
				$delivery_days = $this->input->post('delivery_day');
				$cuttoff_days = $this->input->post('cutoff_day');
				$cuttoff_time = $this->input->post('cutoff_time');
				if(!empty($delivery_days)){
					foreach($delivery_days as $k => $day){
						$days = array(
								'customer_id' => $customer_id,
								'supplier_id' => $id,
								'delivery_day'=> $day,
								'cut_off_day' => $cuttoff_days[$k],
								'cut_off_time' => $cuttoff_time[$k],
							);
						$schedule = $this->suppliers_model->addDeliverySchedule($days);
					}
				}
				
				$this->session->set_flashdata('sucess_msg', 'Supplier sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update supplier');
			}
		    redirect('suppliers/manage_suppliers');
		}
      }
	}
	
	//Supplier Categories
	
	public function suppliers_categories(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
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
				
				$sup_category = $this->suppliers_model->get_suppliers_cat();
				//echo '<pre>';print_r($sup_category);exit;
				$data['sup_category'] = $sup_category;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('suppliers/suppliers_categories',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	public function add_supp_cat(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			
			$this->form_validation->set_rules('cat_name','cat_name','trim|required');
          $status = $this->input->post('status');
          
		  if ($this->form_validation->run() == true) {
		    $customerId = $this->session->userdata('customerId');
			$data = array(
			'customer_id' => $customerId,
			'category_name' => $this->input->post('cat_name'),
			'status' => $status,
			'date_added' => date("Y-m-d")
			);
		    $add_supp_cat = $this->suppliers_model->add_supp_cat($data);
		    if($add_supp_cat){
				$this->session->set_flashdata('sucess_msg', 'Supplier category sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add supplier category');
			}
		    redirect('suppliers/suppliers_categories');
		}
      }
	}
	function edit_supp_cat(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
            	$id = $this->input->post('id');
            	//echo $id;exit;
			$suppliers = $this->suppliers_model->edit_supp_cat($id);
			echo json_encode($suppliers[0]);
		}  
    }
    public function update_supplier_category(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$id = $this->input->post('id');
			$this->form_validation->set_rules('cat_name','cat_name','trim|required');
          
		  if ($this->form_validation->run() == true) {
		    $customerId = $this->session->userdata('customerId');
			$data = array(
				'customer_id' => $customerId,
				'category_name' => $this->input->post('cat_name'),
				'status' => $this->input->post('status'),
				'date_added' => date("Y-m-d")
			);
		    $update_supplier = $this->suppliers_model->update_supplier_category($data,$id);
		    if($update_supplier){
				$this->session->set_flashdata('sucess_msg', 'Supplier category sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update supplier category');
			}
		    redirect('suppliers/suppliers_categories');
		}
      }
	}
	function category_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res = $this->suppliers_model->category_delete($id);
			redirect('suppliers/manage_suppliers');
		}
	}
	
	public function uploadItemsData($supId){
		
		$config['upload_path'] = 'assets/docs/';
        $config['allowed_types'] = 'csv';
        $config['max_size']             = 1024;
        $config['max_width']            = 2000;
        $config['max_height']           = 3000;
        $config['file_name'] = $_FILES['file']['name'];

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            //$picture = $uploadData['file_name'];
        }else{
            //$picture = '';
        }
		// print_r($_FILES);exit;
		// if(isset($_POST['submit'])){
			
			if($_FILES['file']['name']){
				$arrFileName = explode('.',$_FILES['file']['name']);
				if($arrFileName[1] == 'csv'){
					
					
					$handle = fopen(base_url().'assets/docs/'.$_FILES['file']['name'], 'r');
					fgetcsv($handle);
					while (($data = fgetcsv($handle)) !== FALSE) {
						//echo '<pre>';print_r($data);exit;
						$category = strtolower($data[3]);
						$category_id = '';
						$item_categories = $this->suppliers_model->getItemCategories();
						foreach($item_categories as $item_category){
							$item_cat_name = strtolower($item_category->category_name);
							if($category == $item_cat_name){
							  
								$category_id = $item_category->category_id;
							}
						}
						if($category_id == '' && $category != ''){
							//echo $category;
							$newCat = $this->suppliers_model->createNewCategory($category);
							$category_id = $newCat;//need to set cat id
						}
						$details = array(
							'itemCode' => $data[11],
							'itemName' => trim($data[1]),
							'price' => $data[2],
							'category' => $category_id,
							'supplierId' => $supId,
							'uom' => $data[8],
							'status' => 1,
							'createdOn' => date('Y-m-d H:i:s'),
							'customer_id' => $this->session->userdata('customerId'),
							'pack_quantity' => $data[9],
							'packs_per_case' => $data[10],
							'min_order_qnty' => $data[13],
							'min_order_type'=> $data[14],
							'user_access' => 1
						);
						
						$res = $this->suppliers_model->uploadBulkItems($details);
					}
					
					fclose($handle);
					$this->session->set_flashdata('sucess_msg', 'Items successfully imported');
					redirect('suppliers/supplier_items/'.$supId);
				}
			}
		// }
	}
	
	
	
}