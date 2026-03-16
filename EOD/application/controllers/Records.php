<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Records extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
         $this->load->helper('menuitems');
		$this->load->model('records_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    
    // serving size controller
    public function List($table_name){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');	
	

			$menu_items  = display_menu();
		    
		    $fields = $this->$table_name('sql_fields');
		    
			$record = $this->records_model->getData($table_name,$fields,$branch_id,'');
		    
		  //  fetch columns to display for table and filter
		    $data = $this->$table_name('table_fields');
		   
		    $data['content'] = $this->$table_name('table_fields_data',$record);
		    $data['table_name'] = $table_name;
		    
		    $hdata['menus'] = $menu_items;
		      //echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('pages/listing',$data);
			$this->load->view('general/footer');
		}
	}
	
	public function add_record($table_name){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   
		    $data['form_fields'] = $this->$table_name('form_fields');
		    
			$data['table_name'] = $table_name;
			$data['form_type'] = 'add';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
			
			
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('pages/add_record',$data);
			$this->load->view('general/footer');
		}
	}
    
	public function submit_suppliers_category(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
		       
           $branch_id = $this->session->userdata('branch_id');
           $table_name = $this->input->post('table_name');
            
           
		  
		    if($this->input->post('form_type') == 'edit'){
		        
		        $id=$this->input->post('id');
    		       $postData = array(
    		            'main_category' => $this->input->post('main_category'),
    		            'associated_supplier' => serialize($this->input->post('associated_supplier')),
		        );
		        $result = $this->records_model->updateData($table_name,$postData,$id);
		        if($result){
		          //  add new sub category when edit record
		         $postDataSub = explode(",",$this->input->post('sub_category_name'));
    			   foreach($postDataSub as $row){
        			   $postData1 =array(
                            'sub_category_name' => $row,
                            'suppliers_category_id' => $id,
                            'branch_id' => $branch_id
                        );
                        $this->records_model->addData('supplier_sub_category',$postData1);
    		        
    			   }
    			   
    			 //  edit old category 
		          $i = 0;
		          $category_id=$this->input->post('sub_category_id');
		          $sub_category=$this->input->post('sub_category');
		          
		         foreach($category_id as $field){
		             if($sub_category[$i] != ''){
		                $data = array('sub_category_name' => $sub_category[$i]);
		             }else{
		                 $data = array('status' => 0);
		             }
		             $result = $this->records_model->updateData('supplier_sub_category',$data,$field);
		             $i++;
		         }
		       
		        }

		    }else{
		        $postData = array(
		            'main_category' => $this->input->post('main_category'), 
		            'associated_supplier' => serialize($this->input->post('associated_supplier')),
		            'branch_id' => $branch_id,   
		        );
		        $insert_id = $this->records_model->addData($table_name,$postData);
		        
			if($insert_id){
			   $postDataSub = explode(",",$this->input->post('sub_category_name'));
			   foreach($postDataSub as $row){
    			   $postData1 =array(
                        'sub_category_name' => $row,
                        'suppliers_category_id' => $insert_id,
                        'branch_id' => $branch_id
                    );
                    $this->records_model->addData('supplier_sub_category',$postData1);
		        
			   }
		        
				$this->session->set_flashdata('sucess_msg', 'New record has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add new record');
			}
		    }
		   
		}
		redirect('records/list/'.$table_name);
      }
	}
	public function submit_supplier_cost(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
		       
           $branch_id = $this->session->userdata('branch_id');
           $table_name = $this->input->post('table_name');
            
           
		  
		    if($this->input->post('form_type') == 'edit'){
		        
		        $id=$this->input->post('id');
		      $count = count($this->input->post('supplier_name'));
		        $supplier_name = $this->input->post('supplier_name');
		        $input_supplier_name = $this->input->post('input_supplier_name');
		        $supplier_cost = $this->input->post('supplier_cost');
		        for($i=0;$i<$count;$i++){
		            $contentData[] = array(
    		            'supplier_name' => $supplier_name[$i],   
    		            'input_supplier_name' => $input_supplier_name[$i],   
    		            'supplier_cost' => $supplier_cost[$i],    
    		        );
		        }
		        
		      //  bill
		      
		      $count = count($this->input->post('main_category'));
		        $main_category = $this->input->post('main_category');
		        $supplier_id = $this->input->post('supplier_id');
		       
		        for($i=0;$i<$count;$i++){
		            $price_id_name = 'price_id_'.$i;
		            $price_name = 'price_'.$i;
		            
		            $price_id = $this->input->post($price_id_name);
		            $price = $this->input->post($price_name);
		            $j=0;
		            $postDataSub = [];
		            foreach($price_id as $pid){
		                $postDataSub[] = array(
        		            'supplier_sub_category_id' => $pid,   
        		            'price' => $price[$j],  
        		        );
        		        $j++;
        	        }
        	       //  echo "postDataSub<pre>";print_r($postDataSub);
		            $bill[] = array(
    		            'main_category' => $main_category[$i],   
    		            'supplier_id' => $supplier_id[$i],       
    		            'bill' => $postDataSub,       
    		        );
    		        
		        }
		      //  echo "bill<pre>";print_r($bill);exit;
		        $postData = array(
		            'eod_name' => $this->input->post('eod_name'),   
		            'eod_date' => $this->input->post('eod_date'),   
		            'content' => serialize($contentData),   
		            'bill' => serialize($bill),
		        );
		       
		     
		        $result = $this->records_model->updateData($table_name,$postData,$id);
		        if($result){
		  
		        }

		    }else{
		        
		        $count = count($this->input->post('supplier_name'));
		        $supplier_name = $this->input->post('supplier_name');
		        $input_supplier_name = $this->input->post('input_supplier_name');
		        $supplier_cost = $this->input->post('supplier_cost');
		        for($i=0;$i<$count;$i++){
		            $contentData[] = array(
    		            'supplier_name' => $supplier_name[$i],   
    		            'input_supplier_name' => $input_supplier_name[$i],   
    		            'supplier_cost' => $supplier_cost[$i]
    		        );
		        }
		        //  bill
		      
		      $count = count($this->input->post('main_category'));
		        $main_category = $this->input->post('main_category');
		        $supplier_id = $this->input->post('supplier_id');
		       
		        for($i=0;$i<$count;$i++){
		            $price_id_name = 'price_id_'.$i;
		            $price_name = 'price_'.$i;
		            
		            $price_id = $this->input->post($price_id_name);
		            $price = $this->input->post($price_name);
		            $j=0;
		            foreach($price_id as $pid){
		                $postDataSub[] = array(
        		            'supplier_sub_category_id' => $pid,   
        		            'price' => $price[$j],  
        		        );
        		        $j++;
        	        }
		            $bill[] = array(
    		            'main_category' => $main_category[$i],   
    		            'supplier_id' => $supplier_id[$i],       
    		            'bill' => $postDataSub,       
    		        );
		        }
		        
		        $postData = array(
		            'eod_name' => $this->input->post('eod_name'),   
		            'eod_date' => $this->input->post('eod_date'),   
		            'content' => serialize($contentData),   
		            'bill' => serialize($bill),
		            'branch_id' => $branch_id,   
		        );
		        
		        
		        $insert_id = $this->records_model->addData($table_name,$postData);
		        
			if($insert_id){
			  
				$this->session->set_flashdata('sucess_msg', 'New record has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add new record');
			}
		    }
		   
		}
		redirect('records/list/'.$table_name);
      }
	}
	public function edit_record($table_name='',$id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		  //  echo $table_name;
		    $branch_id = $this->session->userdata('branch_id');
		    
		    $data['form_fields'] = $this->$table_name('form_fields','');
		    
			$fields = $this->$table_name('sql_fields');
		    $whereid = array($table_name.'_id' => $id);
			$record = $this->records_model->getData($table_name,$fields,$branch_id,$whereid);
			
// 			echo "vbfdhb";
			
			$data['form_fields_data'] = $this->$table_name('form_fields_data',$record);
            
            $data['table_name'] = $table_name;
			$data['form_type'] = 'edit';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('pages/add_record',$data);
			$this->load->view('general/footer');
		}
	
	}
	public function view_record($table_name,$id){
		if (!$this->ion_auth->logged_in()) {
		    
			redirect('auth/login');
		}else{
		    
		    $branch_id = $this->session->userdata('branch_id');
		    
		    $data['form_fields'] = $this->$table_name('form_fields');
		    
			$fields = $this->$table_name('sql_fields');
		    $whereid = array($table_name.'_id' => $id);
		    
			$record = $this->records_model->getData($table_name,$fields,$branch_id,$whereid);
			
			$data['form_fields_data'] = $this->$table_name('form_fields_data',$record);
		    
			$data['table_name'] = $table_name;
			$data['form_type'] = 'view';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
            
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('pages/add_record',$data);
			$this->load->view('general/footer');
		}
	
	}
	
    public function suppliers_category($type,$record=''){
        $columns['page_name'] = "Suppliers Category";
         $branch_id = $this->session->userdata('branch_id');
        if($type == 'sql_fields'){
            
            $columns['sql_columns'] = array('*');
            $columns['sql_join'] = array();
            $columns['sql_join_columns'] = array();
            
        }else if($type == 'table_fields'){
            
            // $columns['table_columns'] = array('main_category','sub_category');
            $columns['table_columns'] = array('main_category','sub_category_name','suppliers');
            $columns['filter_columns'] = array('main_category');
            $columns['action_columns'] = array('view','edit','delete');
            
        }else if($type == 'table_fields_data'){
            
            $columns_sql['sql_columns'] = array('sub_category_name');
            foreach($record as $rec){
                $tmp =[];
                $supp =[];
                $whereidsub = array('suppliers_category_id' => $rec->suppliers_category_id,'status' => 1);
                $record_sub_category = $this->records_model->getData('supplier_sub_category',$columns_sql,'',$whereidsub); 
                foreach($record_sub_category as $names){ $tmp[] = $names->sub_category_name; }
                
                if(!empty($tmp)){
                    $sub_category_name = implode(', ',$tmp);
                }else{
                    $sub_category_name = '';
                }
                $suppids = unserialize($rec->associated_supplier);
                // get suppliers
                
                foreach($suppids as $suppid){
                    $where_fields = array('supplier_id' => $suppid);
                    $dataSupplier = $this->records_model->getsupplierManagementData('suppliers','',$where_fields);
                   $supp[]=$dataSupplier[0]->supplier_name;
                }
               if(!empty($supp)){
                    $suppliers = implode(', ',$supp);
                }else{
                    $suppliers = '';
                }
                $columns['record'][]=array(
        			'suppliers_category_id' => $rec->suppliers_category_id,
        			'main_category' => $rec->main_category,
        			'sub_category_name' => $sub_category_name,
        			'suppliers' => $suppliers,
        		);
              }
        }else if($type == 'form_fields_data'){
            
            $columns_sql['sql_columns'] = array('*');
            $whereidsub = array('suppliers_category_id' => $record[0]->suppliers_category_id,'status' => 1);
          
            $record_sub_category = $this->records_model->getData('supplier_sub_category',$columns_sql,'',$whereidsub); 
         
            foreach($record_sub_category as $row){
                $sub_category[] = array(
                    'supplier_sub_category_id' => $row->supplier_sub_category_id,
                    'sub_category_name' => $row->sub_category_name
                    );
            }
            $columns['record']=array(
    			'suppliers_category_id' => $record[0]->suppliers_category_id,
    			'main_category' => $record[0]->main_category,
    			'sub_category' => $sub_category,
    			'associated_supplier' => unserialize($record[0]->associated_supplier)
    		);
        }else if($type == 'form_fields'){
            
            $columns['field_data'][] = array(
                'field_name' => 'main_category',
                'field_type' => 'text',
                'field_content' => '',
                'field_content_from' => '',
                'table_name' => ''
            );
            $columns['field_data'][] = array(
                'field_name' => 'sub_category_name',
                'field_type' => 'text_multiple',
                'field_content' => '',
                'field_content_from' => '',
                'table_name' => 'supplier_sub_category',
                'helping_text' => 'Add multiple sub categories separated by a (,)comma',
            );
            $columns['field_data'][] = array(
                'field_name' => 'associated_supplier',
                'field_type' => 'multiple_dropdown_opt',
                'field_content' => 'suppliers',
                'field_content_from' => ''
            );
            
            $columns['from_field_type'] = "";
            
            
            $fields = array('supplier_id,supplier_name');
           
            // $where_fields = array('branch_id' => $branch_id);
            $dataSupplier = $this->records_model->getsupplierManagementData('suppliers',$fields,''); //tablename, fields, wherefields
            
            foreach($dataSupplier as $row){
                $columns['suppliers'][] = array(
                    'id' => $row->supplier_id,
                    'name' => $row->supplier_name,
                );
            }
             
        }else{}
        
        return $columns;
    } 
    public function supplier_cost($type,$record=''){
        $columns['page_name'] = "Supplier Eod Summary";
         $branch_id = $this->session->userdata('branch_id');
        if($type == 'sql_fields'){
            
            $columns['sql_columns'] = array('*');
            $columns['sql_join'] = array();
            $columns['sql_join_columns'] = array();
            
        }else if($type == 'table_fields'){
            
            // $columns['table_columns'] = array('main_category','sub_category');
            $columns['table_columns'] = array('eod_name','eod_date');
            $columns['filter_columns'] = array('eod_name');
            $columns['action_columns'] = array('view','edit','delete');
            
        }else if($type == 'table_fields_data'){
            
            $columns_sql['sql_columns'] = array('sub_category_name');
            foreach($record as $rec){
            
                $columns['record'][]=array(
        			'supplier_cost_id' => $rec->supplier_cost_id,
        			'eod_name' => $rec->eod_name,
        			'eod_date' => date("d-m-Y",strtotime($rec->eod_date)),
        		);
             }
        }else if($type == 'form_fields_data'){
            $bill = unserialize($record[0]->bill);
            
            $columns_sql['sql_columns'] = array('*');
            $totalCashBill = 0;
            foreach($bill as $billpriceList){
                
                //  echo "<pre>";print_r($bill);
                
                $sub_category =[];
                foreach($billpriceList['bill'] as $row){
                    $whereid = array('supplier_sub_category_id' => $row['supplier_sub_category_id'], 'status' => 1);
                
                $record_sub_category = $this->records_model->getData('supplier_sub_category',$columns_sql,'',$whereid);
                $sub_category[] = array(
                    'supplier_sub_category_id' => $row['supplier_sub_category_id'],
                    'sub_category_name' => $record_sub_category[0]->sub_category_name,
                    'price' => $row['price']
                    );
                $totalCashBill = $totalCashBill + $row['price'];
              
            }
             $whereid = array('suppliers_category_id' => $billpriceList['main_category'], 'status' => 1);
                 $associated_supplier = $this->records_model->getData('suppliers_category',$columns_sql,'',$whereid);
                // $associated_supplier = unserialize($associated_supplier->associated_supplier);
                $pricelist[] = array(
                    'main_category' => $billpriceList['main_category'],
                    'supplier_id' => $billpriceList['supplier_id'],
                    'associated_supplier' => unserialize($associated_supplier[0]->associated_supplier),
                    'sub_category' => $sub_category,
                );
                
                
                 
            }
            
    //   echo "<pre>";print_r($sub_category);exit;
            
            $columns['record']=array(
    			'supplier_cost_id' => $record[0]->supplier_cost_id,
    			'eod_name' => $record[0]->eod_name,
    			'eod_date' => $record[0]->eod_date,
    			'content' => unserialize($record[0]->content),
    			'bill' => $pricelist,
    			'totalCashBill' => $totalCashBill,
    		);
    		
        }else if($type == 'form_fields'){
            
            $columns['field_data'][] = array(
                'field_name' => 'eod_name',
                'field_type' => 'text',
                'field_content' => '',
                'field_content_from' => '',
                'table_name' => '',
            );
            $columns['field_data'][] = array(
                'field_name' => 'eod_date',
                'field_type' => 'date',
                'field_content' => '',
                'field_content_from' => '',
                'table_name' => '',
            );
            
            $columns['field_data_repeat'][] = array(
                'field_name' => 'supplier_name',
                'field_type' => 'dropdownautocomplete',
                'field_content' => 'suppliers',
                'field_content_from' => '',
                'table_name' => '',
            );
            $columns['field_data_repeat'][] = array(
                'field_name' => 'supplier_cost',
                'field_type' => 'number',
                'field_content' => '',
                'field_content_from' => '',
                'table_name' => '',
            );
            
            $columns['field_data_bottom'][] = array(
                'field_name' => 'main_category',
                'field_type' => 'dropdown_table',
                'field_content' => 'main_category',
                'field_content_from' => '',
                'field_content_to' => 'price',
                'table_name' => '',
                'sub_table_name' => 'supplier_sub_category',
            );
            
            
            $columns['form_field_type'] = "multiRows";
            
           
            // $where_fields = array(
            //     array('branch_id' => $branch_id)
            //     );
           $fields = array('suppliers_category_id,main_category');
			$main_category = $this->records_model->getData('suppliers_category',$fields,$branch_id,'');
			foreach($main_category as $row){
			$columns['main_category'][] = array(
			    'id' => $row->suppliers_category_id,
			    'name' => $row->main_category,
			    );
			}
			$fields1 = array('supplier_id,supplier_name');
            // $where_fields = array('branch_id' => $branch_id);
            
            $dataSupplier = $this->records_model->getsupplierManagementData('suppliers',$fields1,''); //tablename, fields, wherefields
            
            foreach($dataSupplier as $row1){
                $columns['suppliers'][] = array(
                    'id' => $row1->supplier_id,
                    'name' => $row1->supplier_name,
                );
            }
        }else{}
        
        return $columns;
    }
    public function fetchData(){
        $id=$this->input->post('id');
        $branch_id = $this->session->userdata('branch_id');
        $sub_category = $this->records_model->fetchData('supplier_sub_category',$branch_id,$id);
		if(!empty($sub_category)){
			foreach($sub_category as $row){
			$data[] = array(
			    'id' => $row->supplier_sub_category_id,
			    'name' => $row->sub_category_name,
			    'price' => $row->price,
			    );
			}
			echo json_encode(($data), true);
        }else{ echo "Norecord"; }
    } 
    public function fetchSuppliers(){
        $id=$this->input->post('id');
        $branch_id = $this->session->userdata('branch_id');
        
        
        $columns_sql['sql_columns'] = array('*');
        $whereid = array('suppliers_category_id' => $id);
        
        $recordcategory = $this->records_model->getData('suppliers_category',$columns_sql,'',$whereid);
            
        $supp = unserialize($recordcategory[0]->associated_supplier);
       
        $fields1 = array('supplier_id,supplier_name');
        
        foreach($supp as $suppid){
            $where_fields = array('supplier_id' => $suppid);
            
            $dataSupplier = $this->records_model->getsupplierManagementData('suppliers',$fields1,$where_fields); //tablename, fields, wherefields
            
            foreach($dataSupplier as $row1){
                $columns[] = array(
                    'id' => $row1->supplier_id,
                    'name' => $row1->supplier_name,
                );
            }
        }
        if(!empty($columns)){
			echo json_encode(($columns), true);
        }else{ echo "Norecord"; }
    }
    public function fetchAllSuppliers(){
        $fields1 = array('supplier_id,supplier_name');
       $dataSupplier = $this->records_model->getsupplierManagementData('suppliers',$fields1,''); //tablename, fields, wherefields
            
            foreach($dataSupplier as $row1){
                $columns[] = $row1->supplier_name;
            }
        
        if(!empty($columns)){
			echo json_encode(($columns), true);
        }else{ echo "Norecord"; }
    }
	public function record_delete(){
	   
        $whereid = $this->input->post('id');
        
          $table_name = $this->input->post('table_name');
          
      $res = $this->records_model->recordDelete($whereid,$table_name);
      
         if($res){
             echo "deleted";
         }
         else{
             echo "error";
         }
    }
	public function filterData($table_name){
	    $branch_id = $this->session->userdata('branch_id');
		$table_fields = $this->$table_name('table_fields');

	    foreach($table_fields['filter_columns'] as $col){
	        $whereid[$col] =$this->input->post($col);
	    }
	   
	    $fields = array('*');
	    
		$record = $this->records_model->getFilterData($table_name,$fields,$branch_id,$whereid);
	    
	  //  fetch columns to display for table and filter
	    $data = $this->$table_name('table_fields');
	   
	    $html='';
	    if(!empty($record)){
	    foreach($record as $row){
            $html .='<tr>';
                 if(!empty($data['table_columns'])){ foreach($data['table_columns'] as $table_col){ 
                    $html .='<td class="'. $table_col.'"> '.$row->$table_col.'</td>';
                 } } 
                
                $html .='<td>
                    <ul class="list-inline hstack gap-2 mb-0">';
                        $id=$table_name.'_id'; if(!empty($data['action_columns']) && in_array('view',$data['action_columns'])){ 
                        $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                            <a class="text-success d-inline-block edit-item-btn" href="'. base_url().' index.php/records/view_record/'. $table_name.'/'.$row->$id.' ">
                                <i class="ri-eye-fill fs-16"></i>
                            </a>
                        </li>';
                         } 
                         if(!empty($data['action_columns']) && in_array('edit',$data['action_columns'])){ 
                        $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                            <a class="text-success d-inline-block edit-item-btn" href=" '. base_url().'index.php/records/edit_record/'. $table_name.'/'.$row->$id.' ">
                                <i class="ri-pencil-fill fs-16"></i>
                            </a>
                        </li>';
                         } 
                         if(!empty($data['action_columns']) && in_array('delete',$data['action_columns'])){ 
                        $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                            <a class="text-danger d-inline-block remove-item-btn" data-rel-id="'.  $row->$id.'" href="javascript:void(0)">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                        </li>';
                         } 
                    $html .='</ul>
                </td>
            </tr>';
             }
        echo $html;
	}else{
	    echo "norecord";
	}
	}
	
}