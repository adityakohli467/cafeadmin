<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Items extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('items_model');
		$this->load->model('Ion_auth_model');
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    }
    public function index($supplierId=''){
        
        // code to copy one suppliers product from one loction to another location
       
//          $branchId = $this->session->userdata('branch_id');
// 		$this->db->select('supplier_branch_access.supplier_id');
// 		$this->db->from('supplier_branch_access');
	
// 		$this->db->where('supplier_branch_access.branch_id',20);
		
// 		$query = $this->db->get();
		
// 		$re = $query->result();
		
// 		 for($i = 0; $i<52;$i++){
            
//             $data = array(
// 					'supplier_id' => $re[$i]->supplier_id,
// 					'branch_id' => 56,
// 					'weekly_budget' => 0,
// 					'customer_id' => 14,
					
					
// 				);
				
// 					$result = $this->db->insert('supplier_branch_access',$data);
            
//         }
		
		
// 		echo "<pre>";
// 		print_r($re);
// 		exit;
	
	
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				// echo "102"; exit;
				$hdata['menus'] = $menu_items;
				$hdata['trail_period'] = $remaining;
				/*menu items end */
				$group_id = $this->session->userdata('groupId');
				$group_details = $this->items_model->getUserGroupDetails($group_id);
				
				if($group_details[0]->name == 'Super Admin'){
			//$branch_suppliers = $this->items_model->get_item_suppliers();
			$branch_suppliers = $this->items_model->get_branch_suppliers();
				}else{
					$branch_id = $this->session->userdata('branch_id');
					$branch_suppliers = $this->items_model->get_branch_suppliers();
				}
					
				$items = array();
				if(!empty($branch_suppliers)){
					foreach($branch_suppliers as $supp){
					    if($supplierId !=''){
					    $supplier_details = $this->items_model->edit_suppliers($supplierId);
						$supplier_items = $this->items_model->supplier_items($supplierId);  
					    }else{
					    $supplier_details = $this->items_model->edit_suppliers($supp->supplier_id);
						$supplier_items = $this->items_model->supplier_items($supp->supplier_id);    
					    }
					
						if(!empty($supplier_items)){
							foreach($supplier_items as $k => $supItems){
								$supplier_items[$k]->group_name = $supplier_details[0]->name;
							}
							$items[] = $supplier_items;
						}
					}
				}
			
				// echo '<pre>';print_r($branch_suppliers);exit;
				// $items_category = $this->items_model->get_items_category();
				// $suppliers_category = $this->items_model->get_suppliers_category();
				//$supp_category = $this->items_model->getAllSuppliers();
				
				$finalSupplist =array();
				foreach($branch_suppliers as $key=>$supplier){
	            	if($supplier->supplier_name != ''){
	            		
            			$name1 = str_replace('(','',trim($supplier->supplier_name));
	            		$name = str_replace(')','',$name1);
	            		$finalSupplist[$key] = new StdClass;
	            		$finalSupplist[$key]->supplier_id = $supplier->supplier_id;
	            		$finalSupplist[$key]->supplier_name = $name;
	            	
	            	}
	            }
	            
	            $cat_category = $this->items_model->cat_autoSearch();
	            $finalCatlist = array();
				 foreach($cat_category as $key=>$emp){
	            	if($emp->category_name != ''){
	            		$name1 = str_replace('(','',trim($emp->category_name));
	            		$name = str_replace(')','',$name1);
	            		$finalCatlist[$key] = new StdClass;
	            		$finalCatlist[$key]->category_id = $emp->category_id;
	            		$finalCatlist[$key]->category_name = $name;
	            	}
	            }
	            
	            $item_cat_dropdown = $this->items_model->get_item_cat();
	            $item_suppliers = $this->items_model->get_item_suppliers();
	            
	            
	         	$data['suppliers'] = $finalSupplist;
	         	$data['selectedSupplierId'] =$supplierId;
	         
	         	$data['cat_result'] = $finalCatlist;
	         	
				// $data['items_category'] = $items_category;
				// $data['suppliers_category'] = $suppliers_category;
				$data['items'] = $items;
				$data['item_suppliers'] = $branch_suppliers;
				$data['item_cat_dropdown'] = $item_cat_dropdown;
				$data['user_group'] = $group_details[0]->name;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/manage_items',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
    public function updateItems(){
        echo "<pre>";
        print_r($this->input->post());exit;
        
    }
    
     public function importCsvToDb(){
    
		  	
	if($file = $_FILES['itemdata']['name']) {
	  
            $target_dir = 'images/SupplierItem/';
		  	$userfile_name = $_FILES['itemdata']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
		  	$file_name = 'items_'.rand(10000,99999);
		  	//$file_name = $_FILES["resume"]["name"];
		  	$i = ".";
            $final_file_name=$file_name.$i.$userfile_extn;
            
            $target_file = $target_dir . $final_file_name;
            $file = move_uploaded_file($_FILES["itemdata"]["tmp_name"], $target_file);
         
            
                $fileUploaded = fopen($target_file,"r");
                // $fileUploaded = fopen($target_dir.'/convertcsvFootsc.csv',"r");
                $i = 0;
                $numberOfFields = 5;
                $csvArr = array();
                
                while(! feof($fileUploaded))
                  {
                        $filedata = fgetcsv($fileUploaded,null, ',');
                        
                        $csvArr[$i]['supplierId'] = $filedata[0];
                        $csvArr[$i]['account'] = $filedata[3];
                        $csvArr[$i]['account_name'] = $filedata[4];
                        $csvArr[$i]['tax_code'] = $filedata[5];
                         $i++;
                    }

fclose($fileUploaded);
              
              
                $count = 0;
              
                foreach($csvArr as $Itemdata){
                    if($count > 0){
                        
                    $supplier_items = $this->items_model->supplier_items($Itemdata['supplierId']);
              
						if(!empty($supplier_items)){
						  
						    foreach($supplier_items as $supplier_item){
						       	$data = array(
				                  'account' => $Itemdata['account'],
				                  'account_name' => $Itemdata['account_name'],
				                  'tax_code' => $Itemdata['tax_code']
			                  	);
		   $Itemid = $supplier_item->itemId;
		  
		    $update_supplier = $this->items_model->update_items($data,$Itemid);
		    echo "Updated itemID=".$Itemid."</br>";
						    }
						}
                    }
                    $count++;
                }
                $this->session->set_flashdata('message', $count.' rows successfully added.');
                $this->session->set_flashdata('alert-class', 'alert-success');
          
	}else{
	   
	   $this->load->view('general/header_general',$hdata);
				$this->load->view('settings/importItemData',$data);
			 
	}
      
 
		
	}
	
    public function update_item_details_aditya(){
         	$branch_suppliers = $this->items_model->get_branch_suppliers();
				$items_new = array();
				if(!empty($branch_suppliers)){
					foreach($branch_suppliers as $supp){
						$supplier_items = $this->items_model->supplier_items($supp->supplier_id);
						if(!empty($supplier_items)){
						    foreach($supplier_items as $supplier_item){
						        $price = $supplier_item->price;
						        
						        
						        $myNumber = $price;
 
              //I want to get 10% of price.
$percentToGet = 10;
 
//Convert our percentage value into a decimal.
$percentInDecimal = $percentToGet / 100;
 
//Get the result.
$percent = $percentInDecimal * $myNumber;

                                  $new_price = $percent + $price;
						       
						        	$data = array(
				                  'price' => $new_price
			                  	);
		$id = $supplier_item->itemId;
		    $update_supplier = $this->items_model->update_items($data,$id);
						        echo $id; echo "</br>";
						             
						    }
							$items_new[] = $supplier_items;
						}
						
					}
				}
    }
    function export_product(){
	     if(isset($_POST['supplier_id'])){
	        $supplier_id = $_POST['supplier_id'];
	        $this->session->set_userdata('supplier_id', $supplier_id);
	    }
	  $supplier_id = $this->session->userdata('supplier_id');
		
        $items = $this->items_model->get_items_onchange($supplier_id);
	    $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
          //set heading of excel
     
      $sheet->setCellValue('A1', 'Product Name');
       $sheet->setCellValue('B1', 'Category Name');
      $sheet->setCellValue('C1', 'Price');
      $sheet->setCellValue('D1', 'Uom');
      $sheet->setCellValue('E1', 'Supplier Name');
      $size = count($items);
       
    $name = 0;
      for($x = 2; $x < $size+2; $x++){ 
        $sheet->setCellValue('A'.$x, $items[$name]->itemName);
        $sheet->setCellValue('B'.$x, $items[$name]->category_name);
        $sheet->setCellValue('C'.$x, $items[$name]->price);
        $sheet->setCellValue('D'.$x, $items[$name]->uom);
        $sheet->setCellValue('E'.$x, $items[$name]->supplier_name);
      
        $name++;
          }

        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        $filename = 'Sales-Report'; // set filename for excel file to be exported
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');	// download file
        //unset the session of report_id 
        $this->session->unset_userdata('report_id');
        exit;

	}
	
	
    
    //Manage Items
    public function getSupplierItems(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('items', 'menu')){
			redirect('general/index');
		}else{
			$supplier_id = $_POST['supplier_id'];
			$items = $this->items_model->get_items_onchange($supplier_id);
			//echo '<pre>';print_r($items);exit;
			if(!empty($items)){
			$msg = '';
			$check='';
				foreach($items as $item){
					if($item->user_access == "1"){ $check = "checked";  }
					$selected_GST ='';
					$selected_FREE = '';
					if($item->tax_code == 'GST'){
					    $selected_GST = 'selected';
					}if($item->tax_code == 'FREE'){
					    $selected_FREE = 'selected';
					}
					else{}
					$msg.='<tr class="tr">\n'
							.'<td class="text-center"><input type="checkbox" onclick="itemsInsert(this,'.$item->itemId.');" '.$check.'></td>'
							.'<td class="text-left">'.$item->itemCode.'</td>'
							.'<td class="text-left"><a type="button" onClick="edit_row('.$item->itemId.')" id="'.$item->itemId.'" class="update_user_button" >'.$item->itemName.'</a></td>'
							.'<td class="text-right"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong></span><input type="text" class="form-control m-width"  value="'.number_format($item->price,2,'.','').'"><span style="cursor:pointer" onclick="updatefieldofthisitem(this,'.$item->itemId.')"> Update</span><input type="hidden" value="price"><input type="hidden" id="item_unique_id" value="'.$item->itemId.'"></td>'
							.'<td class="text-left">'.$item->category_name.'</td>'
							.'<td class="text-left">'.$item->supplier_name.'</td>'
							.'<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><input type="text"  class="form-control" id="account" name="account[]" value="'.$item->account.'" ></td>'
						
						    .'<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><input type="text"  class="form-control" id="account_name" name="account_name[]" value="'.$item->account_name .'" ></td>'
						
						    .'<td class="text-left"><span class="update_alert" style="display:none; color:green;"> <strong> Field is Updated!</strong> </span><select class="form-control m-width" id="tax_code" name="tax_code[]"> <option value="">Select</option><option value="GST"'.$selected_GST.' >GST</option><option value="FREE" '.$selected_FREE.'>FREE</option></select></td>'
						.'<td class="text-center"><input type="text" class="form-control m-width"  value="'.$item->product_sort_order.'"><span style="cursor:pointer" onclick="updatefieldofthisitem(this,'.$item->itemId.')"> Update</span><input type="hidden" value="product_sort_order"></td><td class="text-center">';
							
							if($item->status == "1"){
								$msg.= "Active";
							}else{ 
								$msg.= "Inactive"; 
							}
							
							$msg.='</td><td class="text-center"></td></tr>';

			}
			
			echo $msg;
		}else{
			echo 'No Items available';
		}
		}
	}
    public function manage_items(){
		redirect('items/index');
	}
	
	//Item Categories
	
	public function item_categories(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkMenuLevel('items', 'menu')){
			redirect('general/index');
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
				$item_category = $this->items_model->get_item_cat();
				$data['item_category'] = $item_category;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/item_categories',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	public function add_item_cat(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$this->form_validation->set_rules('cat_name','cat_name','trim|required');
			$status = $this->input->post('status');
			if ($this->form_validation->run() == true) {
				$user_id = $this->session->userdata('customerId');
				$data = array(
				'customer_id' => $user_id,
				'category_name' => trim($this->input->post('cat_name')),
				'status' => $status,
				'date_added' => date("Y-m-d")
				);
				$add_item_cat = $this->items_model->add_item_cat($data);
				if($add_item_cat){
					$this->session->set_flashdata('sucess_msg', 'Item category sucessfully added');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add item category');
				}
				redirect('items/item_categories');
			}
		}
	}
	function edit_item_cat(){
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
            $id = $this->input->post('id');
            //echo $id;exit;
			$items = $this->items_model->edit_item_cat($id);
			echo json_encode($items[0]);
		}  
    }
    public function update_item_category(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$id = $this->input->post('id');
			$this->form_validation->set_rules('cat_name','cat_name','trim|required');
          
			if ($this->form_validation->run() == true) {
				$user_id = $this->session->userdata('customerId');
				$data = array(
				'customer_id' => $user_id,
				'category_name' => $this->input->post('cat_name'),
				'status' => $this->input->post('status'),
				'date_added' => date("Y-m-d")
				);
				$update_category = $this->items_model->update_item_category($data,$id);
				if($update_category){
					$this->session->set_flashdata('sucess_msg', 'Item category sucessfully updated');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to update item category');
				}
				redirect('items/item_categories');
			}
        }
	}
	function category_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res = $this->items_model->category_delete($id);
			redirect('items/item_categories');
		}
	}
	
	
	function items_delete() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id=$this->input->post('id');
			$res=$this->items_model->items_delete($id);
			redirect('items/manage_items');
			$this->load->view('general/footer');
		}
	}

	public function submit_items(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$this->form_validation->set_rules('supplier_id','supplier_id','trim|required');
			$this->form_validation->set_rules('item_name','item_name','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('price','price','trim|required');
		    if ($this->form_validation->run() == true) {
			    $user_id = $this->session->userdata('user_id');
			    $customer_id = $this->session->userdata('customerId');
			    $itemcode = str_replace(' ', '', $this->input->post('item_code'));
			   $itemName= str_replace( array( '\'', '"',',' , ';', '<', '>','%','^','*','#','@','/','$','&','(',')','{','}','-','_','!'), ' ', $this->input->post('item_name'));
				$data = array(
					'itemName' => $itemName,
					'price' => $this->input->post('price'),
					'category' => $this->input->post('category'),
					'supplierId' => $this->input->post('supplier_id'),
					'status' => $this->input->post('status'),
					'createdOn' => date("Y-m-d"),
					'customer_id' => $customer_id,
					'uom' => $this->input->post('uom'),
					'pack_quantity' => $this->input->post('pack_qnty'),
					'packs_per_case' => $this->input->post('packs_per_case'),
					'itemCode' => $itemcode,
					'type' => $this->input->post('type'),
					'account' => $this->input->post('account'),
					'account_name' => $this->input->post('account_name'),
					'tax_code' => $this->input->post('tax_code'),
					'product_sort_order' => $this->input->post('product_sort_order'),
					'min_order_qnty' => $this->input->post('min_order_qnty'),
					'min_order_type' => $this->input->post('min_order_type'),
					'updated_by' => $user_id
				);
			    $add_items = $this->items_model->submit_items($data);
			    if($add_items){
					$this->session->set_flashdata('sucess_msg', 'Item sucessfully added');
				}else{
					$this->session->set_flashdata('error_msg', 'Unable to add item');
				}
			    redirect('items');
			}
        }
	} 
    public function update_items(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$this->form_validation->set_rules('supplier_id','supplier_id','trim|required');
			$this->form_validation->set_rules('item_name','item_name','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('price','price','trim|required');
			$status = $this->input->post('status');
          if($status == '1'){
          	  $status = 1;
          }else{
          	  $status = 0;
          }
		  if ($this->form_validation->run() == true) {
			  
		  	$id = $this->input->post('id');
		    $user_id = $this->session->userdata('user_id');
		    $customer_id = $this->session->userdata('customerId');
			$data = array(
				'itemName' => $this->input->post('item_name'),
				'price' => $this->input->post('price'),
				'category' => $this->input->post('category'),
				'supplierId' => $this->input->post('supplier_id'),
				'status' => $status,
				'createdOn' => date("Y-m-d"),
				'customer_id' => $customer_id,
				'uom' => $this->input->post('uom'),
				'pack_quantity' => $this->input->post('pack_qnty'),
				'packs_per_case' => $this->input->post('packs_per_case'),
				'itemCode' => $this->input->post('item_code'),
				'type' => $this->input->post('type'),
				'account' => $this->input->post('account'),
				'account_name' => $this->input->post('account_name'),
				'tax_code' => $this->input->post('tax_code'),
				'product_sort_order' => $this->input->post('product_sort_order'),
				'min_order_qnty' => $this->input->post('min_order_qnty'),
				'min_order_type' => $this->input->post('min_order_type'),
				'updated_by' => $user_id
			);
		    $update_supplier = $this->items_model->update_items($data,$id);
		    if($update_supplier){
				$this->session->set_flashdata('sucess_msg', 'Item sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update item');
			}
			
		     redirect('items/index/'.$this->input->post('supplier_id'));
		}
      }
	}
	function edit_items(){
			if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
            }else {
            	$id = $this->input->post('id');
            	//echo $id;exit;
			$suppliers = $this->items_model->edit_supp_cat($id);
			echo json_encode($suppliers[0]);
		}  
    }
   
   //20-11-2017
   function items_update() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id=$this->input->post('id');
			$access=$this->input->post('access');
			$user_id = $this->session->userdata('user_id');
			$data = array(
				'user_access' => $access,
				'updated_by' => $user_id
				);
			$result=$this->items_model->items_update($id,$data);
			redirect('items/manage_items');
		}
	}
	
	/* manual stock */
	public function stock_entry(){
// 	 echo "dbajkcb"; exit;

          
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
					
				$branch_suppliers = $this->items_model->get_branch_suppliers();
				$data['outletmanagers'] = $this->items_model->get_outletmanagers();
				
				
	         	
				$data['suppliers'] = $branch_suppliers;
				
				$this->load->view('general/header_general',$hdata);
				
				$this->load->view('items/stock_entry',$data);
				
			$this->load->view('general/footer');
			
		
	}	
	
		public function stock_entry_outlet_manager(){
// 	 echo "dbajkcb"; exit;

            
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
					
				$branch_suppliers = $this->items_model->get_branch_suppliers();
			
				
				
	         	
				$data['suppliers'] = $branch_suppliers;
				
				$this->load->view('general/header_general',$hdata);
				
				$this->load->view('items/stock_entry_outlet_manager',$data);
				
			$this->load->view('general/footer');
			
		
	}
	
// 	stock_outlet_entry
	public function stock_outlet_entry(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				
				$branch_suppliers = $this->items_model->get_branch_suppliers();
				// echo '<pre>';print_r($branch_suppliers);exit;
	         	
				$data['suppliers'] = $branch_suppliers;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/stock_entry',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
// 	outlet(sub location)

	public function edit_outlet($outlet_id){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				$data['outlet'] = $this->items_model->fetch_outletmanagers($outlet_id);
// 			echo "<pre>";print_r($data);exit;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/add_outlet',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	public function add_outlet(){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				
			
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/add_outlet');
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	public function view_outlet(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails() && $this->session->userdata('is_outlet_manager') != 1){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				
				$data['outletmanagers'] = $this->items_model->fetch_outletmanagers();
				
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/view_outlet',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	function delete_outlet() {
	   if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }else {
			$id = $this->input->post('id');
			$res = $this->items_model->delete_outlet($id);
			if($res){
			 echo "deleted";   
			}
// 			redirect('items/view_categories');
		}
	}
	public function save_outlet(){
	    $customer_id = $_POST['customer_id'];
	    $email = $_POST['email'];
	    $username = $_POST['username'];
	    $pass = $_POST['password'];
	    
	    if($customer_id != ''){
	        if($pass !=''){
	            $salt       = $this->store_salt ? $this->salt() : FALSE;
    		    $password   = $this->Ion_auth_model->hash_password($pass, $salt);
	        }else{
	            $password = '';
	        }
	        $result = $this->items_model->save_outlet($customer_id,$username,$email,$user_type,$branch_id,$password);
	    }else{
    		
    		$salt       = $this->store_salt ? $this->salt() : FALSE;
    		$password   = $this->Ion_auth_model->hash_password($pass, $salt);
    		
    		$user_type = 8;
    		$branch_id = $this->session->userdata('branch_id');
        	$result = $this->items_model->save_outlet($customer_id,$username,$email,$user_type,$branch_id,$password);
	    }
    	if($result){
    	    echo "success";
    	}else{
    	    echo "error";
    	}
	}
	
	public function getSupplierItemsStock(){
		$supplier_id = $_POST['supplier_id'];
	   // $outletID = ($_POST['outletID'] ? $_POST['outletID'] : ''); 
	    $productName = ($_POST['productName'] ? $_POST['productName'] : ''); 
	
		$items = $this->items_model->get_items_onchange($supplier_id,$productName);
	
		if(!empty($items)){
			$msg = '';
			$check='';
				foreach($items as $item){
				   if($this->session->userdata('is_outlet_manager') == 1 || $outletID !=''){
				       $qty =  $item->stock_qty;
				       
				    }else{
				         $qty =  $item->stock_quantity;
				    }
					$total = ($item->price)*($qty);
					$msg.='<tr class="tr">\n'
							.'<td><input  style="width: 75%;" type="text" name="stock_quantity['.$item->itemId.']" class="stock_quantity" onchange="calculateTotal(this,`'.$item->itemId.'`,`'.$item->price.'`);" value="'.$qty.'"></td>'
							.'<td class="text-left itemName">'.$item->itemName.'</td>'
							.'<td class="text-left">'.$item->category_name.'</td>'
							.'<td class="text-right">$'.number_format($item->price,2,'.','').'</td>' 
							.'<td class="text-right itemTotalAmount" id="totalAmount-'.$item->itemId.'">$'.number_format($total,2,'.','').'</td>';
							
			}
			
			echo $msg;
		}else{
			echo 'No Items available';
		}
	}
	
	public function getSupplierItemsStockAllOutlet(){
		$supplier_id = $_POST['supplier_id'];
	   // $outletID = ($_POST['outletID'] ? $_POST['outletID'] : ''); 
	   // $productName = ($_POST['productName'] ? $_POST['productName'] : ''); 
	
		$stock_data = $this->items_model->get_allOutletItems($supplier_id);
		  $outletmanagers = $this->items_model->get_outletmanagers();	
		 
// 	echo "<pre>"; print_r($stock_data); exit;
		if(!empty($stock_data)){
		    
		    // Create table header
    $html = '';

    $items = [];
    foreach ($stock_data as $data) {
        $items[$data['itemId']]['itemName'] = $data['itemName'];
        $items[$data['itemId']]['price'] = $data['price'];
        $items[$data['itemId']]['itemId'] = $data['itemId'];
        $items[$data['itemId']]['stoke_outlet_id'] = $data['stoke_outlet_id'];
        $items[$data['itemId']]['total_stock_qty'] = $data['total_stock_qty'];
        $items[$data['itemId']]['outlets'][$data['outlet_id']] = $data['stock_qty'];
    }

    // Create table body
    foreach ($items as $item) {
        $html .= '<tr>';
        $html .= '<td class="text-left itemName">' . $item['itemName'] . '</td>';
        $html .= '<td class="text-left price">' . ($item['price'] != '' ? '$ ' . $item['price'] : '') . '</td>';
        $totalQtyFromAlloutlet  = 0;
        foreach ($outletmanagers as $outletmanager) {
            $outlet_id = $outletmanager->customer_user_id;
            $stock_qty = isset($item['outlets'][$outlet_id]) ? $item['outlets'][$outlet_id] : 0;
            $stoke_outlet_id = isset($item['stoke_outlet_id']) ? $item['stoke_outlet_id'] : $outlet_id;
            $html .= '<td><input type="text"  style="width: 75%;" name="stock_quantity[' . $outlet_id . '][' . $item['itemId'] . '][]" class="stock_quantity" value="' . $stock_qty . '"></td>';
            // $html .= '<td><input type="text" style="width: 75%;" name="stock_quantity[' . $stoke_outlet_id . '][' . $item['itemId'] . ']" class="stock_quantity" value="' . $stock_qty . '"></td>';
          $totalQtyFromAlloutlet += $stock_qty;
            
        }
        $totalAmount = $totalQtyFromAlloutlet * $item['price'];
        $html .= '<td class="text-left">' . $item['total_stock_qty'] . '</td>';
        $html .= '<td class="text-left">' . ($totalAmount != '' ? '$ ' . $totalAmount : '') . '</td>';
        $html .= '</tr>';
    }

    

    // Send back the created HTML
    echo $html;
			
		}else{
			echo 'No Items available';
		}
	}
	
	public function updateItemsStockFromAdmin() {
    $postData = $_POST['stock_quantity'];
    $supplier_id = $_POST['supplier_id']; // Assume supplier_id is posted or retrieved
 
    $insert_data = [];
    $update_data = [];
 
    // Collect data for bulk operations
    foreach ($postData as $outlet_id => $items) {
        foreach ($items as $item_id => $stock_qty) {
            
            $this->db->where('outlet_id', $outlet_id);
            $this->db->where('item_id', $item_id);
            $this->db->where('supplier_id', $supplier_id);
            $query = $this->db->get('stoke_outlet');
           
        
            if ($query->num_rows() > 0) {
                // Entry exists, prepare data for update
                $result = $query->row_array();
                
                $this->db->where('stoke_outlet_id', $result['stoke_outlet_id']);
                $this->db->delete('stoke_outlet');
                
                $insert_data[] = [
                    'supplier_id' => $supplier_id,
                    'item_id' => $item_id,
                    'outlet_id' => $outlet_id,
                    'stock_qty' => $stock_qty[0]
                ];

            } else {
                $insert_data[] = [
                    'supplier_id' => $supplier_id,
                    'item_id' => $item_id,
                    'outlet_id' => $outlet_id,
                    'stock_qty' => $stock_qty[0]
                ];
            }
        }
    }
    // Perform bulk insert
    
    if (!empty($insert_data)) {
        $this->db->insert_batch('stoke_outlet', $insert_data);
    }



    // Set a success message or handle errors
   echo 'Stock updated successfully';
   
}

	
	
	public function updateItemsStock(){
	    
		$items = $_POST['stock_quantity'];
		$supplier_id = $_POST['supplier_id'];
		$this->db->select('SUM(stock_qty) AS totalstock_qty ,item_id');
        $this->db->from('stoke_outlet');
        $this->db->where('outlet_id !=',$this->session->userdata('user_id'));
        $this->db->group_by(array("item_id")); 
        $query1 = $this->db->get();
        $res1 = $query1->result();
        $StockQtyByOutlets = array_column($res1, 'totalstock_qty', 'item_id');
      
        // print_r($items); 
        // exit;
		foreach($items as $itemId => $item){
		   
		  //  if(isset($StockQtyByOutlets[$itemId]) && $StockQtyByOutlets[$itemId] > 0){
		  //      $totalQty = $item+$StockQtyByOutlets[$itemId];
		  //  }else{
		  //      $totalQty = $item;
		  //  }
		     $totalQty = $item;
			$data['stock_quantity'] = $totalQty;
			$stock_quantityForOutlet = $item;
			$this->items_model->update_items($data, $itemId,$supplier_id,$stock_quantityForOutlet);
		}
	}
	
	public function stockDetailedReport(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				
				$branch_suppliers = $this->items_model->get_branch_suppliers();
				
				if(!empty($branch_suppliers)){
					foreach($branch_suppliers as $key => $supp){
						$supplier_items = $this->items_model->supplier_items($supp->supplier_id);
						$cat_items = array();
						if(!empty($supplier_items)){
							foreach($supplier_items as $items){
								$cat_items[$items->category]['category_name'] = $items->category_name;
								$cat_items[$items->category]['items'][] = $items;
							}
						}
						$branch_suppliers[$key]->categories = $cat_items;
					}
				}
				// echo '<pre>';print_r($branch_suppliers);exit;
	         	
				$data['supplier_items'] = $branch_suppliers;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/stock_detail_report',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	public function exportStockDetailedReport(){
		//
		$branch_suppliers = $this->items_model->get_branch_suppliers();
				
		if(!empty($branch_suppliers)){
			foreach($branch_suppliers as $key => $supp){
				$supplier_items = $this->items_model->supplier_items($supp->supplier_id);
				$cat_items = array();
				if(!empty($supplier_items)){
					foreach($supplier_items as $items){
						$cat_items[$items->category]['category_name'] = $items->category_name;
						$cat_items[$items->category]['items'][] = $items;
					}
				}
				$branch_suppliers[$key]->categories = $cat_items;
			}
		}
		
		require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

		// Create new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

       // Set document properties
		$spreadsheet->getProperties()->setCreator('Webeasystep.com')
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

		foreach(range('A','D') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
		}
		// set the names of header cells
		// $spreadsheet->setActiveSheetIndex(0)
		// 		->setCellValue("A1",'Order Date')
		// 		->setCellValue("B1",'Supplier Name')
		// 		->setCellValue("C1",'Product Name')
		// 		->setCellValue("D1",'Quantity')
		// 		->setCellValue("E1",'Price')
		// 		->setCellValue("F1",'Total');

		//Add some data
		$x= 1;
	    foreach($branch_suppliers as $supplier){
	    	$spreadsheet->setActiveSheetIndex(0)->setCellValue("A$x", $supplier->supplier_name);
			
			$y = $x+1;
		    if(!empty($supplier->categories)){
				foreach($supplier->categories as $category){
					$spreadsheet->setActiveSheetIndex(0)
							->setCellValue("A$y",'('.$category['category_name'].') Item Name')
							->setCellValue("B$y",'Qty')
							->setCellValue("C$y",'Unit Cost')
							->setCellValue("D$y",'Current Value');
							
					$totalAmount = 0;
					$z = $y+1;
					if(!empty($category['items'])){
						foreach($category['items'] as $items){
							$amount = ($items->price * $items->stock_quantity);
							$totalAmount = $totalAmount+$amount;
							
							$tamount = '$'.number_format($amount, '2','.','');
							$price = '$'.number_format($items->price,'2','.','');
							
							$spreadsheet->setActiveSheetIndex(0)
							->setCellValue("A$z",$items->itemName)
							->setCellValue("B$z",$items->stock_quantity)
							->setCellValue("C$z",$price)
							->setCellValue("D$z",$tamount);
							
							$z++;
						}
						$spreadsheet->setActiveSheetIndex(0)->setCellValue("D$z",'$'.number_format($totalAmount, '2','.',''));
						$y = $z+1;
					}
					
					$x = $y+1;
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
		header('Content-Disposition: attachment;filename="stock_detailed_report.xlsx"');
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
		
	}
	
	
	
	
  public function download_stoke_entry_report($supplier_id) {
        // Fetch data
        $data = $this->fetch_stoke_data($supplier_id);
       
        // Generate Excel
        $fileName = $this->generate_excel_report($data);

        // Set headers to download file
        $this->load->helper('download');
        force_download($fileName, file_get_contents($fileName));
    }

    private function fetch_stoke_data($supplier_id) {
        $this->db->select('
            suppliers.supplier_name,
            customer_users.username AS outlet_name,
            items.itemName,
            items.price,
            stoke_outlet.stock_qty
        ');
        $this->db->from('stoke_outlet');
        $this->db->join('suppliers', 'stoke_outlet.supplier_id = suppliers.supplier_id');
        $this->db->join('customer_users', 'stoke_outlet.outlet_id = customer_users.customer_user_id');
        $this->db->join('items', 'stoke_outlet.item_id = items.itemId');
        $this->db->where('stoke_outlet.supplier_id', $supplier_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    private function generate_excel_report($data) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->setCellValue('A1', 'Supplier Name')
              ->setCellValue('B1', 'Outlet Name')
              ->setCellValue('C1', 'Item Name')
              ->setCellValue('D1', 'Item Price')
              ->setCellValue('E1', 'Stock Qty')
              ->setCellValue('F1', 'Date Entered');

        // Add data rows
        $row = 2;
        $date = date('Y-m-d');
        foreach ($data as $entry) {
            $sheet->setCellValue('A' . $row, $entry['supplier_name'])
                  ->setCellValue('B' . $row, $entry['outlet_name'])
                  ->setCellValue('C' . $row, $entry['itemName'])
                  ->setCellValue('D' . $row, $entry['price'])
                  ->setCellValue('E' . $row, $entry['stock_qty'])
                  ->setCellValue('F' . $row, $date);
            $row++;
        }

        $fileName = 'stoke_entry_report_' . date('d-m-Y') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);

        return $fileName;
    }
	
	
	public function stockSummaryReport(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else if(!$this->ion_auth->checkMenuLevel('items/manage_items', 'submenu')){
			redirect('general/index');
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
				
				$branch_suppliers = $this->items_model->get_branch_suppliers();
				
				if(!empty($branch_suppliers)){
					foreach($branch_suppliers as $key => $supp){
						$supplier_items = $this->items_model->supplier_items($supp->supplier_id);
						$cat_items = array();
						if(!empty($supplier_items)){
							foreach($supplier_items as $items){
								$totalAmount = $items->price * $items->stock_quantity;
								$cat_items[$items->category]['category_name'] = $items->category_name;
								$cat_items[$items->category]['items'][] = $totalAmount;
							}
						}
						$branch_suppliers[$key]->categories = $cat_items;
					}
				}
				// echo '<pre>';print_r($branch_suppliers);exit;
	         	
				$data['supplier_items'] = $branch_suppliers;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('items/stock_summary_report',$data);
				$this->load->view('general/footer');
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
	}
	
	public function exportStockSummaryReport(){
		$branch_suppliers = $this->items_model->get_branch_suppliers();
		if(!empty($branch_suppliers)){
			foreach($branch_suppliers as $key => $supp){
				$supplier_items = $this->items_model->supplier_items($supp->supplier_id);
				$cat_items = array();
				if(!empty($supplier_items)){
					foreach($supplier_items as $items){
						$totalAmount = $items->price * $items->stock_quantity;
						$cat_items[$items->category]['category_name'] = $items->category_name;
						$cat_items[$items->category]['items'][] = $totalAmount;
					}
				}
				$branch_suppliers[$key]->categories = $cat_items;
			}
		}
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

		foreach(range('A','B') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
		}
		// set the names of header cells
		// $spreadsheet->setActiveSheetIndex(0)
		// 		->setCellValue("A1",'Order Date')
		// 		->setCellValue("B1",'Supplier Name')
		// 		->setCellValue("C1",'Product Name')
		// 		->setCellValue("D1",'Quantity')
		// 		->setCellValue("E1",'Price')
		// 		->setCellValue("F1",'Total');

		//Add some data
		$x= 1;
	    foreach($branch_suppliers as $supplier){
	    	$spreadsheet->setActiveSheetIndex(0)->setCellValue("A$x", $supplier->supplier_name);
			$totalAmount = 0;
			$y = $x+1;
		    if(!empty($supplier->categories)){
		    	
				foreach($supplier->categories as $category){
				    
				    $amount = 0;
					foreach($category['items'] as $items){
						$amount = $amount+$items;
					}
					$totalAmount = $totalAmount+$amount;
					
					$spreadsheet->setActiveSheetIndex(0)
							->setCellValue("A$y", $category['category_name'])
							->setCellValue("B$y", '$'.number_format($amount, '2','.',''));
					
					$y++;
				}
				$spreadsheet->setActiveSheetIndex(0)
							->setCellValue("A$y", 'Group Total')
							->setCellValue("B$y", '$'.number_format($totalAmount, '2','.',''));
				
				$x = $y+2;
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
		header('Content-Disposition: attachment;filename="stock_summary_report.xlsx"');
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
		
	}
	function updatePriceofallitem(){
	      $productIdsAndPrices = json_decode($_POST['productIdsAndPrice']);
	   //  echo "<pre>";
	   //  print_r($productIdsAndPrices);
	   //  exit;
	      foreach($productIdsAndPrices as $item_id => $values){
	          if(isset($values->item_unit_price) && $values->item_unit_price !=''){
	               $data = array(
				'price' => $values->item_unit_price,
			
			);
	          }else{
	               $data = array(
			
				'account' => $values->account,
				'account_name' => $values->account_name,
				'tax_code' => $values->tax_code,
			);
	              
	          }
	      
		
         $update_supplier = $this->items_model->update_items($data,$item_id);  
          echo $this->db->last_query();
	      }
	     
	     echo "Updated";
		    exit;
	}
	
	function updatefieldofthisitem(){
	      $fieldname = $_POST['fieldname'];
	        $data = array(
				$fieldname => $_POST['field_new_value'],
			);
			$item_id = $_POST['item_id'];
		    $update_supplier = $this->items_model->update_items($data,$item_id);
		    echo "Updated";
		    exit;
	}
	
	/* end manual stock */
}