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
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('menuitems');
		$this->load->model('Suppliers_model');
		$this->load->model('Ion_auth_model');
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
		}else{
		    $menu_items  = display_menu();
		    $branch_id = $this->session->userdata('branch_id');
		    
			$branch_suppliers = $this->Suppliers_model->get_branch_suppliers($branch_id);
			 //echo '<pre>';print_r($branch_suppliers);exit;
			if(!empty($branch_suppliers)){
			  foreach($branch_suppliers as $supp){
					$supplier_details = $this->Suppliers_model->fetch_suppliers($supp->supplier_id);
					if(!empty($supplier_details[0])){
					   $suppliers[] = $supplier_details[0]; 
					}
				}
		    }
    		
    		
    		$data['suppliers'] = $suppliers; 
    		$hdata['menus'] = $menu_items;
    		$this->load->view('general/header_general',$hdata);
    		$this->load->view('suppliers/listing',$data);
    		$this->load->view('general/footer');
		}
    }
	
}