<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
         $this->load->helper('menuitems'); 
		$this->load->model('reports_model');
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
		    
			$record = $this->reports_model->getData($table_name,$fields,$branch_id,'');
		  //  fetch columns to display for table and filter
		    $data = $this->$table_name('table_fields');
		   
		    $data['content'] = $this->$table_name('table_fields_data',$record);
		    
		    $data['table_name'] = $table_name;
		    
		    $hdata['menus'] = $menu_items;
		      //echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/listing',$data);
			$this->load->view('general/footer');
		}
	}
	
	public function add_record($table_name){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   
			
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
			$data = $this->$table_name('form_fields_data',$record);
			
			$data['table_name'] = $table_name;
			$data['form_type'] = 'add';
// 			echo $this->db->last_query();
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/add_'.$table_name,$data);
			$this->load->view('general/footer');
		}
	}
	
	public function add_document($id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/homepage');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		    if(isset($_POST['contact_submit'])){ 
		        
		        // For File Upload
               if(isset($_FILES['document_name']['name']) && $_FILES['document_name']['name'] !=''){
                   
                  $new_name = $this->file_upload_code('document_name');
               }else{
                   $new_name ='';
               }
		      $data=array(
		   'doc_name' =>$this->input->post('doc_name'),
			'document_name' => $new_name,
			);
			
		    $insert_id = $this->reports_model->add_data_to_tble('document',$data);
		    
            
                 $target_message ='Document have been uploaded succesfully';
		        redirect('reports/success/'.$target_message);
		    }else{
		    
		  //  if(isset($id) && $id !='') {
		  //  $result = $this->EmployeesDeatils_model->get_record_from_table('document',$id);    
		     
		  //  $data['documents'] =   $result; 
		    
		  //  }  
		    
		     $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/add_document',$data);
			$this->load->view('general/footer');
		    }
		    
			
		}
	}

	public function submit_eod_reports(){
  		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
		       
          $branch_id = $this->session->userdata('branch_id');
          $table_name = $this->input->post('table_name');
             if($this->input->post('form_type') == 'edit'){
		        
		        $id=$this->input->post('id');
		        
		        $count = count($this->input->post('till_name'));
		        $till_names = $this->input->post('till_name');
		        $main_cafe = $this->input->post('main_cafe');
		        $cash_read = $this->input->post('cash_read');
		        $cc_read = $this->input->post('cc_read');
		        $totalSales = $this->input->post('totalSales');
		        $cash_collected = $this->input->post('cash_collected');
		        $efptos_collected = $this->input->post('efptos_collected');
		        $smart_cards = $this->input->post('smart_cards');
		        $gst_read = $this->input->post('gst_read');
		        $amex_cost = $this->input->post('amex_cost');
		        $CRDR_Cost = $this->input->post('CRDR_Cost');

		     
		        for($i=0;$i<$count;$i++){
		            if($till_names[$i] != ''){
    		            if(in_array($till_names[$i],$main_cafe) ){
    		                $main_cafe_status = 1;
    		            }else{
    		                $main_cafe_status = 0;
    		            }
    		            $contentData[] = array(
        		            'location_till_id' => $till_names[$i],   
        		            'main_cafe' => $main_cafe_status,   
        		            'cash_read' => $cash_read[$i],   
        		            'cc_read' => $cc_read[$i],
        		            'totalSales' => $totalSales[$i],
        		            'cash_collected' => $cash_collected[$i],
        		            'efptos_collected' => $efptos_collected[$i],
        		            'smart_cards' => $smart_cards[$i],
        		            'gst_read' => $gst_read[$i],
        		            'amex_cost' => $amex_cost[$i],
        		            'CRDR_Cost' => $CRDR_Cost[$i],
        		        );
		            }
		        }
		        //  Total cash
		        $contentTotalCashData = array(
		          'main_cafe_cash_read_total'    => $this->input->post('main_cafe_cash_read_total'),
		          'catering_cash_read_total'    => $this->input->post('catering_cash_read_total'),
		          'cafeonline_cash_read_total'    => $this->input->post('cafeonline_cash_read_total'),
		          'Hc_cash_read_total'    => $this->input->post('Hc_cash_read_total'),
		          'Other_specify_cash_read_total'    => $this->input->post('Other_specify_cash_read_total'),
		          'total_cash_read_total'    => $this->input->post('total_cash_read_total'),
		          
		          'main_cafe_cc_read_total'    => $this->input->post('main_cafe_cc_read_total'),
		          'catering_cc_read_total'    => $this->input->post('catering_cc_read_total'),
		          'cafeonline_cc_read_total'    => $this->input->post('cafeonline_cc_read_total'),
		          'Hc_cc_read_total'    => $this->input->post('Hc_cc_read_total'),
		          'Other_specify_cc_read_total'    => $this->input->post('Other_specify_cc_read_total'),
		          'total_cc_read_total'    => $this->input->post('total_cc_read_total'),
		          
		          'main_cafe_totalSales_total'    => $this->input->post('main_cafe_totalSales_total'),
		          'catering_totalSales_total'    => $this->input->post('catering_totalSales_total'),
		          'cafeonline_totalSales_total'    => $this->input->post('cafeonline_totalSales_total'),
		          'Hc_totalSales_total'    => $this->input->post('Hc_totalSales_total'),
		          'Other_specify_totalSales_total'    => $this->input->post('Other_specify_totalSales_total'),
		          'total_totalSales_total'    => $this->input->post('total_totalSales_total'),
		          
		          'main_cafe_cash_collected_total'    => $this->input->post('main_cafe_cash_collected_total'),
		          'catering_cash_collected_total'    => $this->input->post('catering_cash_collected_total'),
		          'cafeonline_cash_collected_total'    => $this->input->post('cafeonline_cash_collected_total'),
		          'Hc_cash_collected_total'    => $this->input->post('Hc_cash_collected_total'),
		          'Other_specify_cash_collected_total'    => $this->input->post('Other_specify_cash_collected_total'),
		          'total_cash_collected_total'    => $this->input->post('total_cash_collected_total'),
		          
		          'main_cafe_efptos_collected_total'    => $this->input->post('main_cafe_efptos_collected_total'),
		          'catering_efptos_collected_total'    => $this->input->post('catering_efptos_collected_total'),
		          'cafeonline_efptos_collected_total'    => $this->input->post('cafeonline_efptos_collected_total'),
		          'Hc_efptos_collected_total'    => $this->input->post('Hc_efptos_collected_total'),
		          'Other_specify_efptos_collected_total'    => $this->input->post('Other_specify_efptos_collected_total'),
		          'total_efptos_collected_total'    => $this->input->post('total_efptos_collected_total'),
		          
		          
		          'main_cafe_over_total'    => $this->input->post('main_cafe_over_total'),
		          'catering_cash_over_total'    => $this->input->post('catering_cash_over_total'),
		          'cafeonline_over_total'    => $this->input->post('cafeonline_over_total'),
		          'Hc_over_total'    => $this->input->post('Hc_over_total'),
		          'Other_specifyover_total'    => $this->input->post('Other_specifyover_total'),
		          'total_over_total'    => $this->input->post('total_over_total'),
		          
		          'main_cafe_cc_over_total'    => $this->input->post('main_cafe_cc_over_total'),
		          'catering_cash_cc_over_total'    => $this->input->post('catering_cash_cc_over_total'),
		          'cafeonline_cc_over_total'    => $this->input->post('cafeonline_cc_over_total'),
		          'Hc_cc_over_total'    => $this->input->post('Hc_cc_over_total'),
		          'Other_specifycc_over_total'    => $this->input->post('Other_specifycc_over_total'),
		          'total_cc_over_total'    => $this->input->post('total_cc_over_total'),
		          
		          'main_cafe_smart_cards_total'    => $this->input->post('main_cafe_smart_cards_total'),
		          'catering_cash_smart_cards_total'    => $this->input->post('catering_cash_smart_cards_total'),
		          'cafeonline_smart_cards_total'    => $this->input->post('cafeonline_smart_cards_total'),
		          'Hc_smart_cards_total'    => $this->input->post('Hc_smart_cards_total'),
		          'Other_specifysmart_cards_total'    => $this->input->post('Other_specifysmart_cards_total'),
		          'total_smart_cards_total'    => $this->input->post('total_smart_cards_total'),
		          
		          'main_cafe_gst_read_total'    => $this->input->post('main_cafe_gst_read_total'),
		          'catering_cash_gst_read_total'    => $this->input->post('catering_cash_gst_read_total'),
		          'cafeonline_gst_read_total'    => $this->input->post('cafeonline_gst_read_total'),
		          'Hc_gst_read_total'    => $this->input->post('Hc_gst_read_total'),
		          'Other_specifygst_read_total'    => $this->input->post('Other_specifygst_read_total'),
		          'total_gst_read_total'    => $this->input->post('total_gst_read_total'),
		          
		          
		          'main_cafe_amex_total'    => $this->input->post('main_cafe_amex_total'),
		          'catering_amex_total'    => $this->input->post('catering_amex_total'),
		          'cafeonline_amex_total'    => $this->input->post('cafeonline_amex_total'),
		          'Hc_amex_total'    => $this->input->post('Hc_amex_total'),
		          'Other_specify_amex_total'    => $this->input->post('Other_specify_amex_total'),
		          'total_amex_total'    => $this->input->post('total_amex_total'),
		          
		          'main_cafe_crdr_total'    => $this->input->post('main_cafe_crdr_total'),
		          'catering_crdr_total'    => $this->input->post('catering_crdr_total'),
		          'cafeonline_crdr_total'    => $this->input->post('cafeonline_crdr_total'),
		          'Hc_crdr_total'    => $this->input->post('Hc_crdr_total'),
		          'Other_specify_crdr_total'    => $this->input->post('Other_specify_crdr_total'),
		          'total_crdr_total'    => $this->input->post('total_crdr_total'),
		          
		          
		          );
		      //  echo "<pre>"; print_r($contentTotalCashData); exit;
		        
		        //  banking details
		        $staff_name = $this->input->post('staff_name');
		        $reciept = $this->input->post('reciept');
		        $amount_deposited = $this->input->post('amount_deposited');
		        $bank_branch = $this->input->post('bank_branch');
		        $time = $this->input->post('time');
		        $last_month_safe_total = $this->input->post('last_month_safe_total');
		        $total_income = $this->input->post('total_income');
		        $total_in_Safe = $this->input->post('total_in_Safe');
		        $comment = $this->input->post('comment');
		        $manager_comment = $this->input->post('manager_comment');
		        
		        $contentBankingData = array(
    		            'staff_name' => $staff_name,   
    		            'reciept' => $reciept,   
    		            'amount_deposited' => $amount_deposited,
    		            'bank_branch' => $bank_branch,
    		            'time' => $time,
    		            'last_month_safe_total' => $last_month_safe_total,
    		            'total_income' => $total_income,
    		            'total_in_Safe' => $total_in_Safe,
    		            'comment' => $comment,
    		            'manager_comment' => $manager_comment,
    		    );
    		    
    		     //  invoice cash
    		    
    		    $countinvoice_paid_cash = count($this->input->post('invoice_paid_cash'));
		        $invoice_paid_cash = $this->input->post('invoice_paid_cash');
		        $total_inc_gst = $this->input->post('total_inc_gst');
		        
		      
		        for($i=0;$i<$countinvoice_paid_cash;$i++){
		            $contentInvoicePaidCashData[] = array(
    		            'invoice_paid_cash' => $invoice_paid_cash[$i],   
    		            'total_inc_gst' => $total_inc_gst[$i],
    		        );
		        }
		        
		        $postData = array(
		            'eod_name' => $this->input->post('eod_name'),   
		            'eod_date' => $this->input->post('eod_date'),   
		            'content' => serialize($contentData),
		            'content_total_cash' => serialize($contentTotalCashData),
		            'content_banking' => serialize($contentBankingData),
		            'content_invoice_paid_cash' => serialize($contentInvoicePaidCashData),
		        );
		     
		        $result = $this->reports_model->updateData($table_name,$postData,$id);
		        
		        if(!empty($this->session->userdata('eod_docs'))){
    		        foreach($this->session->userdata('eod_docs') as $doc){
    		            $eod_document = array(
    		                'eod_id' => $id,
    		                'uploaded_document_name' => $doc['uploaded_document_name'],
    		                'uploaded_file_name' => $doc['uploaded_file_name'],
    		                'status' => $doc['status'],
    		                'date_added' => date('Y-m-d'),
    		                );
    		          $this->reports_model->addData('eod_documents',$eod_document);
    		        }
    		        $this->session->unset_userdata('eod_docs');
		        }
		        
		        $graphArray = array(
		            'total_income' => $total_income,
		             'branch_id' => $branch_id, 
		           );
		        
		        $insert_graph_id = $this->reports_model->updateDataUsingAnotherCol('eod_graph_report',$graphArray,$id,'eod_report_id');
		        
		        if($result){
		            $this->session->set_flashdata('sucess_msg', 'Record has been sucessfully updated.');
    			}else{
    				$this->session->set_flashdata('error_msg', 'Unable to update record');
    			}

		    }else{
		       
		        $count = count($this->input->post('till_name'));
		        $till_names = $this->input->post('till_name');
		        $main_cafe = $this->input->post('main_cafe');
		        $cash_read = $this->input->post('cash_read');
		        $cc_read = $this->input->post('cc_read');
		        $totalSales = $this->input->post('totalSales');
		        $cash_collected = $this->input->post('cash_collected');
		        $efptos_collected = $this->input->post('efptos_collected');
		        $smart_cards = $this->input->post('smart_cards');
		        $gst_read = $this->input->post('gst_read');
		        $amex_cost = $this->input->post('amex_cost');
		        $CRDR_Cost = $this->input->post('CRDR_Cost');
		        
		      
		        for($i=0;$i<$count;$i++){
		            if($till_names[$i] != ''){
    		            if(in_array($till_names[$i],$main_cafe) ){
    		                $main_cafe_status = 1;
    		            }else{
    		                $main_cafe_status = 0;
    		            }
    		            $contentData[] = array(
        		            'location_till_id' => $till_names[$i],   
        		            'main_cafe' => $main_cafe_status,   
        		            'cash_read' => $cash_read[$i],   
        		            'cc_read' => $cc_read[$i],
        		            'totalSales' => $totalSales[$i],
        		            'cash_collected' => $cash_collected[$i],
        		            'efptos_collected' => $efptos_collected[$i],
        		            'smart_cards' => $smart_cards[$i],
        		            'gst_read' => $gst_read[$i],
        		            'amex_cost' => $amex_cost[$i],
        		            'CRDR_Cost' => $CRDR_Cost[$i],
        		        );
		            }
		        }
		        
		      //  Total cash
		      $contentTotalCashData = array(
		          'main_cafe_cash_read_total'    => $this->input->post('main_cafe_cash_read_total'),
		          'catering_cash_read_total'    => $this->input->post('catering_cash_read_total'),
		          'cafeonline_cash_read_total'    => $this->input->post('cafeonline_cash_read_total'),
		          'Hc_cash_read_total'    => $this->input->post('Hc_cash_read_total'),
		          'Other_specify_cash_read_total'    => $this->input->post('Other_specify_cash_read_total'),
		          'total_cash_read_total'    => $this->input->post('total_cash_read_total'),
		          
		          'main_cafe_cc_read_total'    => $this->input->post('main_cafe_cc_read_total'),
		          'catering_cc_read_total'    => $this->input->post('catering_cc_read_total'),
		          'cafeonline_cc_read_total'    => $this->input->post('cafeonline_cc_read_total'),
		          'Hc_cc_read_total'    => $this->input->post('Hc_cc_read_total'),
		          'Other_specify_cc_read_total'    => $this->input->post('Other_specify_cc_read_total'),
		          'total_cc_read_total'    => $this->input->post('total_cc_read_total'),
		          
		          'main_cafe_cash_collected_total'    => $this->input->post('main_cafe_cash_collected_total'),
		          'catering_cash_collected_total'    => $this->input->post('catering_cash_collected_total'),
		          'cafeonline_cash_collected_total'    => $this->input->post('cafeonline_cash_collected_total'),
		          'Hc_cash_collected_total'    => $this->input->post('Hc_cash_collected_total'),
		          'Other_specify_cash_collected_total'    => $this->input->post('Other_specify_cash_collected_total'),
		          'total_cash_collected_total'    => $this->input->post('total_cash_collected_total'),
		          
		          
		           'main_cafe_totalSales_total'    => $this->input->post('main_cafe_totalSales_total'),
		          'catering_totalSales_total'    => $this->input->post('catering_totalSales_total'),
		          'cafeonline_totalSales_total'    => $this->input->post('cafeonline_totalSales_total'),
		          'Hc_totalSales_total'    => $this->input->post('Hc_totalSales_total'),
		          'Other_specify_totalSales_total'    => $this->input->post('Other_specify_totalSales_total'),
		          'total_totalSales_total'    => $this->input->post('total_totalSales_total'),
		          
		          
		          'main_cafe_efptos_collected_total'    => $this->input->post('main_cafe_efptos_collected_total'),
		          'catering_efptos_collected_total'    => $this->input->post('catering_efptos_collected_total'),
		          'cafeonline_efptos_collected_total'    => $this->input->post('cafeonline_efptos_collected_total'),
		          'Hc_efptos_collected_total'    => $this->input->post('Hc_efptos_collected_total'),
		          'Other_specify_efptos_collected_total'    => $this->input->post('Other_specify_efptos_collected_total'),
		          'total_efptos_collected_total'    => $this->input->post('total_efptos_collected_total'),
		          
		           'main_cafe_over_total'    => $this->input->post('main_cafe_over_total'),
		          'catering_cash_over_total'    => $this->input->post('catering_cash_over_total'),
		          'cafeonline_over_total'    => $this->input->post('cafeonline_over_total'),
		          'Hc_over_total'    => $this->input->post('Hc_over_total'),
		          'Other_specifyover_total'    => $this->input->post('Other_specifyover_total'),
		          'total_over_total'    => $this->input->post('total_over_total'),
		          
		          'main_cafe_cc_over_total'    => $this->input->post('main_cafe_cc_over_total'),
		          'catering_cash_cc_over_total'    => $this->input->post('catering_cash_cc_over_total'),
		          'cafeonline_cc_over_total'    => $this->input->post('cafeonline_cc_over_total'),
		          'Hc_cc_over_total'    => $this->input->post('Hc_cc_over_total'),
		          'Other_specifycc_over_total'    => $this->input->post('Other_specifycc_over_total'),
		          'total_cc_over_total'    => $this->input->post('total_cc_over_total'),
		          
		          'main_cafe_smart_cards_total'    => $this->input->post('main_cafe_smart_cards_total'),
		          'catering_cash_smart_cards_total'    => $this->input->post('catering_cash_smart_cards_total'),
		          'cafeonline_smart_cards_total'    => $this->input->post('cafeonline_smart_cards_total'),
		          'Hc_smart_cards_total'    => $this->input->post('Hc_smart_cards_total'),
		          'Other_specifysmart_cards_total'    => $this->input->post('Other_specifysmart_cards_total'),
		          'total_smart_cards_total'    => $this->input->post('total_smart_cards_total'),
		          
		          'main_cafe_gst_read_total'    => $this->input->post('main_cafe_gst_read_total'),
		          'catering_cash_gst_read_total'    => $this->input->post('catering_cash_gst_read_total'),
		          'cafeonline_gst_read_total'    => $this->input->post('cafeonline_gst_read_total'),
		          'Hc_gst_read_total'    => $this->input->post('Hc_gst_read_total'),
		          'Other_specifygst_read_total'    => $this->input->post('Other_specifygst_read_total'),
		          'total_gst_read_total'    => $this->input->post('total_gst_read_total'),
		          
		          'main_cafe_amex_total'    => $this->input->post('main_cafe_amex_total'),
		          'catering_amex_total'    => $this->input->post('catering_amex_total'),
		          'cafeonline_amex_total'    => $this->input->post('cafeonline_amex_total'),
		          'Hc_amex_total'    => $this->input->post('Hc_amex_total'),
		          'Other_specify_amex_total'    => $this->input->post('Other_specify_amex_total'),
		          'total_amex_total'    => $this->input->post('total_amex_total'),
		          
		          'main_cafe_crdr_total'    => $this->input->post('main_cafe_crdr_total'),
		          'catering_crdr_total'    => $this->input->post('catering_crdr_total'),
		          'cafeonline_crdr_total'    => $this->input->post('cafeonline_crdr_total'),
		          'Hc_crdr_total'    => $this->input->post('Hc_crdr_total'),
		          'Other_specify_crdr_total'    => $this->input->post('Other_specify_crdr_total'),
		          'total_crdr_total'    => $this->input->post('total_crdr_total'),
		          
		          );
		        
		        
		        //  banking details
		        $staff_name = $this->input->post('staff_name');
		        $reciept = $this->input->post('reciept');
		        $amount_deposited = $this->input->post('amount_deposited');
		        $bank_branch = $this->input->post('bank_branch');
		        $time = $this->input->post('time');
		        $last_month_safe_total = $this->input->post('last_month_safe_total');
		        $total_income = $this->input->post('total_income');
		        $total_in_Safe = $this->input->post('total_in_Safe');
		         $comment = $this->input->post('comment');
		          $manager_comment = $this->input->post('manager_comment');
		        
		        $contentBankingData = array(
    		            'staff_name' => $staff_name,   
    		            'reciept' => $reciept,   
    		            'amount_deposited' => $amount_deposited,
    		            'bank_branch' => $bank_branch,
    		            'time' => $time,
    		            'last_month_safe_total' => $last_month_safe_total,
    		            'total_income' => $total_income,
    		            'total_in_Safe' => $total_in_Safe,
    		             'comment' => $comment,
    		            'manager_comment' => $manager_comment,
    		    );
    		    
    		  //  invoice cash
    		    
    		    $countinvoice_paid_cash = count($this->input->post('invoice_paid_cash'));
		        $invoice_paid_cash = $this->input->post('invoice_paid_cash');
		        $total_inc_gst = $this->input->post('total_inc_gst');
		         for($i=0;$i<$countinvoice_paid_cash;$i++){
		         $contentInvoicePaidCashData[] = array(
    		            'invoice_paid_cash' => $invoice_paid_cash[$i],   
    		            'total_inc_gst' => $total_inc_gst[$i],
    		            'uploaded_file_name' => '',
    		        );
		        }
		        
		        
		        
$files = array_filter($_FILES['invoice_doc']['name']); 
$total_count = count($_FILES['invoice_doc']['name']);
for( $i=0 ; $i < $total_count ; $i++ ) {
   $tmpFilePath = $_FILES['invoice_doc']['tmp_name'][$i];
   if ($tmpFilePath != ""){
      $newFilePath = "./uploaded_files_inv_paid/" . $_FILES['invoice_doc']['name'][$i];
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
       
         $contentInvoicePaidCashData[$i]['uploaded_file_name'] = $_FILES['invoice_doc']['name'][$i];
      }
   }
}


		        $postData = array(
		            'eod_name' => $this->input->post('eod_name'),   
		            'eod_date' => $this->input->post('eod_date'),   
		            'content' => serialize($contentData),
		            'content_total_cash' => serialize($contentTotalCashData),
		            'content_banking' => serialize($contentBankingData),
		            'content_invoice_paid_cash' => serialize($contentInvoicePaidCashData),
		            'branch_id' => $branch_id,   
		        );
		        $insert_id = $this->reports_model->addData($table_name,$postData);
		        
		        if(!empty($this->session->userdata('eod_docs'))){
    		        foreach($this->session->userdata('eod_docs') as $doc){
    		            $eod_document = array(
    		                'eod_id' => $insert_id,
    		                'uploaded_document_name' => $doc['uploaded_document_name'],
    		                'uploaded_file_name' => $doc['uploaded_file_name'],
    		                'status' => $doc['status'],
    		                'date_added' => date('Y-m-d'),
    		                );
    		          $this->reports_model->addData('eod_documents',$eod_document);
    		        }
    		        $this->session->unset_userdata('eod_docs');
		        }
		        $graphArray = array(
		            'eod_report_id' => $insert_id,
		            'total_income' => $total_income,
		            'date' => $this->input->post('eod_date'),
		            'month' => date('M'),
		           );
		        
		        $insert_graph_id = $this->reports_model->addData('eod_graph_report',$graphArray);
		        
			if($insert_id){
			  
				$this->session->set_flashdata('sucess_msg', 'New record has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add new record');
			}
		    }
		   
		}
		redirect('reports/list/'.$table_name);
      }
	}
	public function upload_doc(){
	    $files = array_filter($_FILES['document_file']['name']); 
        $total_count = count($_FILES['document_file']['name']);
        for( $i=0 ; $i < $total_count ; $i++ ) {
           $tmpFilePath = $_FILES['document_file']['tmp_name'][$i];
           if ($tmpFilePath != ""){
                $new_name = uniqid().'_'.$_FILES['document_file']['name'][$i];
                $new_name = preg_replace('/\s+/', '_', $new_name);
                
                $newFilePath = "./uploaded_files/" . $new_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
               
                    $document_files[]=array(
                         'uploaded_document_name' => $_POST['document_name'][$i],
                         'uploaded_file_name' => $new_name,
                         'status' => 1,
                    );
                  }
           }
        }
        $this->session->set_userdata('eod_docs',$document_files);
        redirect('reports/add_document');
	}
	public function recreate_record($table_name='',$id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    $branch_id = $this->session->userdata('branch_id');
		    
			$fields = $this->$table_name('sql_fields');
		    $whereid = array($table_name.'_id' => $id);
			$record = $this->reports_model->getData($table_name,$fields,$branch_id,$whereid);
		
            $data = $this->$table_name('form_fields_data',$record);
            
            // echo "<pre>".$record[0]->content;print_r($data);exit;
			
            $data['table_name'] = $table_name;
			$data['form_type'] = 'recreate';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
		
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/add_'.$table_name,$data);
			$this->load->view('general/footer');
		}
	
	}
	public function edit_record($table_name='',$id=''){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		    $branch_id = $this->session->userdata('branch_id');
		    
			$fields = $this->$table_name('sql_fields');
		    $whereid = array($table_name.'_id' => $id);
			$record = $this->reports_model->getData($table_name,$fields,$branch_id,$whereid);
			
            $data = $this->$table_name('form_fields_data',$record);
            
            // echo "<pre>".$record[0]->content;print_r($data);exit;
			$columnsDoc['sql_columns'] = array('*');
			$whereDocid = array('eod_id' => $id);
			$data['eod_documents'] = $this->reports_model->getData('eod_documents',$columnsDoc,'',$whereDocid);
			
            $data['table_name'] = $table_name;
			$data['form_type'] = 'edit';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
			
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/add_'.$table_name,$data);
			$this->load->view('general/footer');
		}
	
	}
	public function view_record($table_name,$id){
		if (!$this->ion_auth->logged_in()) {
		    
			redirect('auth/login');
		}else{
		    
		    $branch_id = $this->session->userdata('branch_id');
		    
		    $fields = $this->$table_name('sql_fields');
		    $whereid = array($table_name.'_id' => $id);
			$record = $this->reports_model->getData($table_name,$fields,$branch_id,$whereid);
			
			
			
            $data = $this->$table_name('form_fields_data',$record);
		    
		    $columnsDoc['sql_columns'] = array('*');
			$whereDocid = array('eod_id' => $id);
			$data['eod_documents'] = $this->reports_model->getData('eod_documents',$columnsDoc,'',$whereDocid);
			
			$data['table_name'] = $table_name;
			$data['form_type'] = 'view';
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			
            
            // echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('reports/add_'.$table_name,$data);
			$this->load->view('general/footer');
		}
	
	}
	
	public function submit_location_till(){
  		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
		       
          $branch_id = $this->session->userdata('branch_id');
          $table_name = $this->input->post('table_name');
            
           
		  
		    if($this->input->post('form_type') == 'edit'){
		        
		        $id=$this->input->post('id');
		        
		        
		        $postData = array(
		            'till_name' => $this->input->post('till_name'),   
		            'main_cafe' => $this->input->post('main_cafe'),
		            'account_number' => $this->input->post('account_number'),
		            'amex_account_number' => $this->input->post('amex_account_number'),
		            'date_updated' => date('Y-m-d'),
		        );
		     
		        $result = $this->reports_model->updateData($table_name,$postData,$id);
		        if($result){
		            $this->session->set_flashdata('sucess_msg', 'Record has been sucessfully updated.');
    			}else{
    				$this->session->set_flashdata('error_msg', 'Unable to update record');
    			}

		    }else{
		       
		        $postData = array(
		            'till_name' => $this->input->post('till_name'),   
		            'main_cafe' => $this->input->post('main_cafe'),
		            'account_number' => $this->input->post('account_number'),
		            'amex_account_number' => $this->input->post('amex_account_number'),
		            'date_created' => date('Y-m-d'),   
		            'branch_id' => $branch_id,   
		        );
		        
		        
		        $insert_id = $this->reports_model->addData($table_name,$postData);
		        
			if($insert_id){
			  
				$this->session->set_flashdata('sucess_msg', 'New record has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add new record');
			}
		    }
		   
		}
		redirect('reports/list/'.$table_name);
      }
	}

    public function eod_reports($type,$record=''){
        $columns['page_name'] = "Eod Reports";
         $branch_id = $this->session->userdata('branch_id');
        if($type == 'sql_fields'){
            
            $columns['sql_columns'] = array('*');
            $columns['sql_join'] = array();
            $columns['sql_join_columns'] = array();
            
        }else if($type == 'table_fields'){
            
            // $columns['table_columns'] = array('main_category','sub_category');
            $columns['table_columns'] = array('eod_name','eod_date');
            $columns['filter_columns'] = array('eod_name');
            $columns['action_columns'] = array('recreate','view','edit','delete');
            
        }else if($type == 'table_fields_data'){
            
            $columns_sql['sql_columns'] = array('sub_category_name');
            foreach($record as $rec){
            
                $columns['record'][]=array(
        			'eod_reports_id' => $rec->eod_reports_id,
        			'eod_name' => $rec->eod_name,
        			'eod_date' => date("d-m-Y",strtotime($rec->eod_date)),
        		);
             }
        }else if($type == 'form_fields_data'){
            $columns['location_till'] = $this->reports_model->getData('location_till','*',$branch_id,$whereid);
            $columns['record']=array(
    			'eod_reports_id' => $record[0]->eod_reports_id,
    			'eod_name' => $record[0]->eod_name,
    			'eod_date' => $record[0]->eod_date,
    			'content' => unserialize($record[0]->content),
    			'content_total_cash' => unserialize($record[0]->content_total_cash),
    			'content_banking' => unserialize($record[0]->content_banking),
    			'content_invoice_paid_cash' => unserialize($record[0]->content_invoice_paid_cash),
    			'credit_cards' => unserialize($record[0]->credit_cards),
    		);
        }else{}
        
        return $columns;
    }
    public function location_till($type,$record=''){
        $columns['page_name'] = "Locations/Tills";
         $branch_id = $this->session->userdata('branch_id');
        if($type == 'sql_fields'){
            
            $columns['sql_columns'] = array('*');
            $columns['sql_join'] = array();
            $columns['sql_join_columns'] = array();
            
        }else if($type == 'table_fields'){
            
            // $columns['table_columns'] = array('main_category','sub_category');
            $columns['table_columns'] = array('till_name','main_cafe');
            $columns['filter_columns'] = array('till_name');
            $columns['action_columns'] = array('view','edit','delete');
            
        }else if($type == 'table_fields_data'){
            
            foreach($record as $rec){
            if($rec->main_cafe == 1){
                $mainCafeHtml = 'Yes';
            }else{
                $mainCafeHtml = 'No';
            }
                $columns['record'][]=array(
        			'location_till_id' => $rec->location_till_id,
        			'till_name' => $rec->till_name,
        			'main_cafe' => $mainCafeHtml,
        		);
             }
        }else if($type == 'form_fields_data'){
            $columns['record']=array(
    			'location_till_id' => $record[0]->location_till_id,
    			'till_name' => $record[0]->till_name,
    			'main_cafe' => $record[0]->main_cafe,
    			'account_number' => $record[0]->account_number,
    			'amex_account_number' => $record[0]->amex_account_number,
    		);
        }else{}
        
        return $columns;
    }

	public function record_delete(){
	   
        $whereid = $this->input->post('id');
        
        $table_name = $this->input->post('table_name');
          
        $res = $this->reports_model->recordDelete($whereid,$table_name);
        if($table_name == 'eod_reports'){
            $resinner = $this->reports_model->recordDeleteUsingAnotherCol($whereid,'eod_report_id','eod_graph_report');
        }
         if($res){
             echo "deleted";
         }
         else{
             echo "error";
         }
    }
 
// 	public function filterData($table_name){
// 	    $branch_id = $this->session->userdata('branch_id');
// 		$table_fields = $this->$table_name('table_fields');

// 	    foreach($table_fields['filter_columns'] as $col){
// 	        $whereid[$col] =$this->input->post($col);
// 	    }
	   
// 	    $fields = array('*');
	    
// 		$record = $this->records_model->getFilterData($table_name,$fields,$branch_id,$whereid);
	    
// 	  //  fetch columns to display for table and filter
// 	    $data = $this->$table_name('table_fields');
	   
// 	    $html='';
// 	    if(!empty($record)){
// 	    foreach($record as $row){
//             $html .='<tr>';
//                  if(!empty($data['table_columns'])){ foreach($data['table_columns'] as $table_col){ 
//                     $html .='<td class="'. $table_col.'"> '.$row->$table_col.'</td>';
//                  } } 
                
//                 $html .='<td>
//                     <ul class="list-inline hstack gap-2 mb-0">';
//                         $id=$table_name.'_id'; if(!empty($data['action_columns']) && in_array('view',$data['action_columns'])){ 
//                         $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
//                             <a class="text-success d-inline-block edit-item-btn" href="'. base_url().' index.php/records/view_record/'. $table_name.'/'.$row->$id.' ">
//                                 <i class="ri-eye-fill fs-16"></i>
//                             </a>
//                         </li>';
//                          } 
//                          if(!empty($data['action_columns']) && in_array('edit',$data['action_columns'])){ 
//                         $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
//                             <a class="text-success d-inline-block edit-item-btn" href=" '. base_url().'index.php/records/edit_record/'. $table_name.'/'.$row->$id.' ">
//                                 <i class="ri-pencil-fill fs-16"></i>
//                             </a>
//                         </li>';
//                          } 
//                          if(!empty($data['action_columns']) && in_array('delete',$data['action_columns'])){ 
//                         $html .='<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
//                             <a class="text-danger d-inline-block remove-item-btn" data-rel-id="'.  $row->$id.'" href="javascript:void(0)">
//                                 <i class="ri-delete-bin-5-fill fs-16"></i>
//                             </a>
//                         </li>';
//                          } 
//                     $html .='</ul>
//                 </td>
//             </tr>';
//              }
//         echo $html;
// 	}else{
// 	    echo "norecord";
// 	}
// 	}

    public function fetchMainCafe(){
        $id=$this->input->post('id');
        $whereid = array('location_till_id' => $id);
	    $record = $this->reports_model->getData('location_till','main_cafe','',$whereid);
	    
	    if(!empty($record)){
	        echo $record[0]->main_cafe;
	    }else{
	        echo 'Norecord';
	    }
    }

}