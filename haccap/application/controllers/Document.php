<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
		$this->load->model('Document_model');
		 $this->load->helper('menuitems');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    
//     public function index() {
//     	if (!$this->ion_auth->logged_in()) {
// 			redirect('auth/login');
// 		}else if(!$this->ion_auth->checkUserDetails()){
// 			redirect('settings/index');
// 		}else {
		    
// 		}
//     }
    
    public function add_program() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		   
				$hdata['menus'] = display_menu();
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
        			'branch_id' => $branch_id,
        			'category'  => 'Program'
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('document',$data);
    		  
    		   		redirect('document/view_program');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD PROGRAMME';
				$data['controller_name'] = 'document/add_program';
				$data['cancel'] = 'document/view_program';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    		
		}
    }
     
    public function view_program() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		   
				$hdata['menus'] = display_menu();
			

				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('document');
			
				$records = $this->pagination_data_buildup('document',$total_records,'document/view_document','Program');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'HACCAP PROGRAM';
				$data['button_heading'] = 'ADD PROGRAMME';
				$data['controller_name'] = 'document/add_program';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
			
		}
		
    }
    
    // Staff Education Portal
    
    public function add_educationPortal() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		   
			
				$hdata['menus'] = display_menu();

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
        		    'doc_url' => $this->input->post('doc_url'),
        			'document_name' => $new_name,
        			'branch_id' => $branch_id,
        			'category'  => 'Education Portal'
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('document',$data);
    		       if($insert_id){
    		         	redirect('document/view_educationPortal');  
    		       }else{
    		           echo "Error adding document";
    		       }
    		   	
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_educationPortal';
				$data['cancel'] = 'document/view_educationPortal';
					
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
			
		}
    }
     
    public function view_educationPortal() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		     	$hdata['menus'] = display_menu();
			
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('document');
			
				$records = $this->pagination_data_buildup('document',$total_records,'document/view_document','Education Portal');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'EDUCATION PORTAL';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_educationPortal';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    
     public function add_sops() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    
			$hdata['menus'] = display_menu();

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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('council_manager',$data);
    		  
    		   		redirect('document/view_council_manager');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD SOPS';
				$data['controller_name'] = 'document/add_sops';
				$data['cancel'] = 'document/view_sops';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
			
		}
    }
     
    public function view_sops() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		 
				$hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('sops');
			
				$records = $this->pagination_data_buildup('sops',$total_records,'document/view_sops','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'SOPS';
				$data['table_name'] = 'sops';
				$data['button_heading'] = 'ADD SOPS';
				$data['controller_name'] = 'document/add_sops';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    
    // sops/chefs
    public function add_chefs() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		 
			    $hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('chefs',$data);
    		  
    		   		redirect('document/view_chefs');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD CHEFS';
				$data['controller_name'] = 'document/add_chefs';
				$data['cancel'] = 'document/view_chefs';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
		}
    }
     
    public function view_chefs() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
				$hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('chefs');
			

            
				$records = $this->pagination_data_buildup('chefs',$total_records,'document/view_chefs','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'CHEFS';
				$data['table_name'] = 'chefs';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_chefs';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    // sops/chefs end
    
    //sops boh
    public function add_boh() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('boh',$data);
    		  
    		   		redirect('document/view_boh');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD BOH';
				$data['controller_name'] = 'document/add_boh';
				$data['cancel'] = 'document/view_boh';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }

		}
    }
     
    public function view_boh() {
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
				
			$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('boh');
			

            
				$records = $this->pagination_data_buildup('boh',$total_records,'document/view_boh','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'BOH';
				$data['table_name'] = 'boh';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_boh';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
			
		}
		
    }
    //sops boh ends
    
    //sops foh
    public function add_foh() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		   $hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('foh',$data);
    		  
    		   		redirect('document/view_foh');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD BOH';
				$data['controller_name'] = 'document/add_foh';
				$data['cancel'] = 'document/view_foh';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
		
		}
    }
     
    public function view_foh() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  $hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('foh');
			
				$records = $this->pagination_data_buildup('foh',$total_records,'document/view_foh','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'FOH';
				$data['table_name'] = 'foh';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_foh';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    //sops foh ends
    
    
    // menu builder Allergen Matrix
    public function add_allergen_matrix() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    
			$hdata['menus'] = display_menu();

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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('allergen_matrix',$data);
    		  
    		   		redirect('document/view_allergen_matrix');
    		    }else{
    		    
    		    $data['page_heading'] = 'Add Allergen Matrix';
				$data['controller_name'] = 'document/add_allergen_matrix';
				$data['cancel'] = 'document/view_allergen_matrix';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
			
		}
    }
     
    public function view_allergen_matrix() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		 
				$hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('allergen_matrix');
			
				$records = $this->pagination_data_buildup('allergen_matrix',$total_records,'document/view_allergen_matrix','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'Allergen Matrix';
				$data['table_name'] = 'allergen_matrix';
				$data['button_heading'] = 'Add Allergen Matrix';
				$data['controller_name'] = 'document/add_allergen_matrix';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    // pest control map
    
    
    public function add_pest_control_map() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('pest_control_map',$data);
    		  
    		   		redirect('document/view_pest_control_map');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD Pest Control Map';
				$data['controller_name'] = 'document/add_pest_control_map';
				$data['cancel'] = 'document/view_pest_control_map';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }

		}
    }
     
    public function view_pest_control_map() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
				
			$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('pest_control_map');
			

            
				$records = $this->pagination_data_buildup('pest_control_map',$total_records,'document/view_pest_control_map','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'Pest Control Map';
				$data['table_name'] = 'pest_control_map';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_pest_control_map';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
			
		}
		
    }
    // pest control map end
    
    
     // product Disclosure
    
    
    public function add_product_disclosure() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('product_disclosure',$data);
    		  
    		   		redirect('document/view_product_disclosure');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD Product Disclosure';
				$data['controller_name'] = 'document/add_product_disclosure';
				$data['cancel'] = 'document/view_product_disclosure';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }

		}
    }
     
    public function view_product_disclosure() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
				
			$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('product_disclosure');
			

            
				$records = $this->pagination_data_buildup('product_disclosure',$total_records,'document/view_product_disclosure','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'Product Disclosure';
				$data['table_name'] = 'product_disclosure';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_product_disclosure';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
			
		}
		
    }
    // product Disclosure end
    
     // Monthly Audit Report
    
    
    public function add_monthly_audit_report() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('monthly_audit_report',$data);
    		  
    		   		redirect('document/view_monthly_audit_report');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD Monthly Audit Report';
				$data['controller_name'] = 'document/add_monthly_audit_report';
				$data['cancel'] = 'document/view_monthly_audit_report';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }

		}
    }
     
    public function view_monthly_audit_report() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
			$hdata['menus'] = display_menu();
				
			$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('monthly_audit_report');
			

            
				$records = $this->pagination_data_buildup('monthly_audit_report',$total_records,'document/view_monthly_audit_report','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'Monthly Audit Report';
				$data['table_name'] = 'monthly_audit_report';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_monthly_audit_report';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
			
		}
		
    }
    // Monthly Audit Report end
    
     public function file_upload_code($name_value=''){
        
        if(isset($name_value) && $name_value !=''){
               
                 $config['upload_path'] = './uploaded_files/';
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx|txt';
                 $config['max_size'] = 2000000;
                 $config['max_width'] = 20000;
                 $config['max_height'] = 20000;
                 
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
     public function pagination_data_buildup($table_name,$total_records,$link,$category){
         if ($total_records > 0) 
        {      
            $branch_id = $this->session->userdata('branch_id');
            $config = array();
            $config['base_url'] = base_url().$link;
            $config['total_rows'] = $total_records;
            if($total_records > 10){
              $config["per_page"] = 10;  
            }else{
             $config["per_page"] = $total_records;   
            }
            
            $config["num_links"] = 3;
          
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
            
           
        if((int)$this->uri->segment(3) >=10){
                 $start= (int)$this->uri->segment(3) +1;
            }else{
                 $start= (int)$this->uri->segment(3) * $config['per_page']+1;
            }
       if((int)$this->uri->segment(3) >=10){         
          $end = ($this->uri->segment(3) == floor($config['total_rows']/ $config['per_page']))? $config['total_rows'] : (int)$this->uri->segment(3)  + $config['per_page'];
        }else{
        $end = ($this->uri->segment(3) == floor($config['total_rows']/ $config['per_page']))? $config['total_rows'] : (int)$this->uri->segment(3)  + $config['per_page'];
 
        }
           $result_count = "Showing ".$start." - ".$end." of ".$config['total_rows']." Results";
		 
	
		  //$type='admin'; 
            $result_data  = $this->Document_model->fetch_data($table_name,$branch_id,$config["per_page"], $this->uri->segment(3),$category);
            
        //   echo "<pre>";print_r($result_data);exit;
            
           return  $result_array = array( 
                'result_count' => $result_count,
                 'records_data' => $result_data
                
                );
            
            }
        
    }
    	public function delete_document(){

			 $id = $this->input->post('id');
			   $tablename = $this->input->post('tablename');
			$delete = $this->Document_model->delete_document($id,$tablename);
	}
	public function view_council_manager() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		 
				$hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('council_manager');
			
				$records = $this->pagination_data_buildup('council_manager',$total_records,'document/view_document','');
                // echo "<pre>";print_r($records);exit;
                
				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'COUNCIL REPORTS';
				$data['table_name'] = 'council_manager';
				$data['button_heading'] = 'ADD';
				$data['controller_name'] = 'document/add_council_manager';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    public function add_council_manager() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    
			$hdata['menus'] = display_menu();

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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('council_manager',$data);
    		  
    		   		redirect('document/view_council_manager');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD COUNCIL REPORTS';
				$data['controller_name'] = 'document/add_council_manager';
				$data['cancel'] = 'document/view_council_manager';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
			
		}
    }
    
    // guideline
    public function add_guidelines() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		 
			    $hdata['menus'] = display_menu();
			
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
        			'branch_id' => $branch_id,
    			    );
    			
    		    $insert_id = $this->Document_model->add_data_to_tble('haccap_guidelines',$data);
    		  
    		   		redirect('document/view_guidelines');
    		    }else{
    		    
    		    $data['page_heading'] = 'ADD guidelines';
				$data['controller_name'] = 'document/add_guidelines';
				$data['cancel'] = 'document/view_guidelines';
				
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('document/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
		}
    }
     
    public function view_guidelines() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		  
				$hdata['menus'] = display_menu();
				$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Document_model->get_total('haccap_guidelines');
			

            
				$records = $this->pagination_data_buildup('haccap_guidelines',$total_records,'document/view_guidelines','');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				$data['page_heading'] = 'guidelines';
				$data['table_name'] = 'haccap_guidelines';
				$data['button_heading'] = 'ADD DOCUMENT';
				$data['controller_name'] = 'document/add_guidelines';
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('document/view_document',$data);
				$this->load->view('general/footer');
		
		}
		
    }
    // guideline end
	
}