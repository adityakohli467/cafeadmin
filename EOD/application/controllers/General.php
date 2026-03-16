<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('pagination');
		$this->load->model('general_model');
		$this->load->model('reports_model');
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
		}else {
		   
			$userlevel = $this->session->userdata('clearance_level');
			
			$menu_items = $this->display_menu();
		
			
				$hdata['menus'] = $menu_items;
				
				// echo "<pre>Menu ";print_r($hdata['menus']);exit;
				$hdata['trail_period'] = "";
			    
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
						$data['trail_period'] = "";
			            $this->load->view('general/general_branches',$data);
						$this->load->view('general/footer');
					}else{   
					    
						$this->session->set_userdata('branch_id', $branch_acc[0]->branch_id);
						$this->session->set_userdata('branch_name', $branch_acc[0]->branch_name);
						
						$timesheet_login = $this->session->userdata('timesheet_login');
			  		
	                         redirect('reports/list/eod_reports');
		                     
					
					    }
				        }
		
		}
	 }

	 function fetch_graphData(){
	     $branch_id = $this->session->userdata('branch_id');	
	     $records = $this->reports_model->getGraphData($branch_id);
	     $DaysName = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
	     $newGraphDateWiseData = [];
	     foreach($records as $record){
	         $dayName = strtotime($record->date);
	         $day = date('D', $dayName);
	        $indexofDay = array_search($day, $DaysName);
	        $newGraphDateWiseData[$indexofDay] = $record->total_income;
	     }
	     

	    ksort($newGraphDateWiseData);
	  
	   echo json_encode($newGraphDateWiseData);
	 }
	 public function display_menu(){
        
        
        if($this->session->userdata('supervisor') !='' || $this->session->userdata('is_haccap_user') == 1){ 
            
             $menus = $this->ion_auth->getMenusdynamic();
        }else{
          
            $menus = $this->ion_auth->getMenus(); 
           
        }
       
				$menu_items = array();
				 $userlevel = $this->session->userdata('clearance_level');
		
			
        	if(!empty($menus)){
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
	 }
        
       
        return $menu_items;
    }
	 
	public function setBranch(){
	 	$branch_id =  $this->uri->segment(3);
		$branch_name =  $this->uri->segment(4);
		
	
	
		$branchName = str_replace('_',' ',$branch_name);
		
	
	 	$this->session->set_userdata('branch_id', $branch_id);
	 	$this->session->set_userdata('branch_name', $branchName);
	 	
	    redirect('reports/list/eod_reports');
		
		
	}
	
	
	public function dashboard(){
       
		if (!$this->ion_auth->logged_in()) {
		     
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
		    
			redirect('settings/index');
		}else {
		    
		    $role = $this->session->userdata('role');
			$menu_items = $this->display_menu();
		
			$hdata['menus'] = $menu_items;
			if($role=='employee'){
			   $user_email = $this->session->userdata('user_email');
				
			 
			   $type = 'employee';
			}else{
			    $emp_id ='';
			    $type = 'admin';
			    $id = $this->session->userdata('branch_id');
			}
				$branch_id = $this->session->userdata('branch_id');	
			
            	
            // 	echo "<pre>";print_r($menuPlanner);exit;
			    $this->load->view('general/header_general',$hdata);
				if($type == 'admin'){
				    
				  $this->load->view('general/dashboard_admin',$data);  
				}else{
				    // if(isset($employee_hrs_records)){
				    //      $data['employee_hrs_records'] = $employee_hrs_records;
				    // }else{
				    //      $data['employee_hrs_records'] = '';
				    // }
				  
				   $this->load->view('general/dashboard',$data); 
				}
				
			   $this->load->view('general/footer');
				
			
		}
	}
	
	function removeElementWithValue($array, $key, $value){
	    $count = 1;
     foreach($array as $subKey => $subArray){
       
          if($subArray->$key == $value){
              if($count != 1){
                unset($array[$subKey]);
              }
              $count++;
          }
     }
     return $array;
}


}