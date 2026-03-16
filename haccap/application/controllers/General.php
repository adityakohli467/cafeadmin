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
		$this->load->model('admin_model');
		$this->load->model('menucard_model');
		$this->load->model('Forms_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    
    function index() {
        
        //  $this->session->unset_userdata('email');
        // echo $this->ion_auth->logged_in(); exit;
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
			  		
	                    if($timesheet_login == 'true'){
		                      redirect('Employeedetails/timesheet_in_out');				    
		                    }else{
	                         redirect('general/dashboard');
		                     }
					
					    }
				        }
			// }else{
			// 	$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
			// 	redirect('settings/subscriptions');
			// }
		}
	 }
// 	 function test_mail(){
	     
// 	     $news = array( 
      
//          array( 
//              "name" => "Techonlogy", 
//         "href" => "https://www.carwale.com/new/", 
//         "postNews" => array( 
//          array(    
//         "link" => "Corona mobile App", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Car Tech", 
//         "updated_at"=> " last Update On Monday"
//         ),
        
//          array(    
//         "link" => "Corona mobile App2", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Car Tech", 
//         "updated_at"=> " last Update On Wedn"
//         ),
        
//          array(    
//         "link" => "Corona mobile App2", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Car Tech", 
//         "updated_at"=> " last Update On Thurs"
//         ),
//          ), 
//          ),
         
//          array(
//           "name" => "Sports", 
//         "href" => "https://www.carwale.com/new/", 
//         "postNews" => array( 
//             array( 
//         "link" => "Sports App", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Sports Tak", 
//          "updated_at"=> " last Update On friday"
//          ),
//           array(    
//         "link" => "Corona mobile App2", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Car Tech", 
//         "updated_at"=> " last Update On Tuesday"
//         ),
//          ), 
//          ),
         
//          array(
//           "name" => "Bollowood", 
//         "href" => "https://www.carwale.com/new/", 
//         "postNews" => array( 
//             array( 
//         "link" => "Bollywood App", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Bollywood Mirchi", 
//          "updated_at"=> "Monday"
//          ),
//           array(    
//         "link" => "Corona mobile App2", 
//         "image" => "https://imgd.aeplcdn.com/310x174/n/cw/ec/41645/tata-nexon-right-front-three-quarter3.jpeg?q=85", 
//         "title" => "Car Tech", 
//         "updated_at"=> "Monday"
//         ),
//          ), 
//          ),
     
// ); 
// $data['news'] = $news;
	     
// 	     $this->load->view('employees/test_mail.php',$data);
// 	 }
	 
	 
	 
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
	 	$timesheet_login = $this->session->userdata('timesheet_login');
			 //  echo $timesheet_login; exit;		
	    if($timesheet_login == 'true'){
		redirect('Employeedetails/timesheet_in_out');				    
		}else{
	    redirect('general/dashboard');
		}
		
	}
	public function fetch_roster(){
	    
	    $role = $this->session->userdata('role');
	    if($role='employee'){
			   $emp_id = $this->session->userdata('customerId');
			}else{
			    $emp_id ='';
			}
				 $menu_items  = $this->display_menu();
				$branch_id = $this->session->userdata('branch_id');
				$user_email = $this->session->userdata('user_email');
				
			 	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
			    
			
				 $data['role'] = $role;
				 
				 	$params = array();
                $limit_per_page = 5;
                
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->admin_model->get_total('roster');
				
				
				
				
		       if ($total_records > 0) 
                   {
            // get current page records
            
            $config = array();
            $config['base_url'] = 'https://www.cafeadmin.com.au/HR/index.php/admin/get_roster_weeks';
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
$data['result_count']= "Showing ".$start." - ".$end." of ".$config['total_rows']." Results";
		 
            $data['roster']  = $this->admin_model->get_roster_weeks($branch_id,'employee','',$config["per_page"], $this->uri->segment(3));
            
            }
				$hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('employees/roster_emp_table',$data);
				$this->load->view('general/footer');
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
				
			 	$id = $this->admin_model->get_emp_details_fromemail($user_email);
			   $type = 'employee';
			}else{
			    $emp_id ='';
			    $type = 'admin';
			    $id = $this->session->userdata('branch_id');
			}
				$branch_id = $this->session->userdata('branch_id');	
				$this->load->model('menuplanner_model');
            	$menuPlanner = $this->menuplanner_model->weekMenuList($branch_id);
            	$data['menuPlanners'] = $menuPlanner;
            	
            // 	echo "<pre>";print_r($menuPlanner);exit;
			    $this->load->view('general/header_general',$hdata);
				if($type == 'admin'){
				    if($role == 'Prep Area'){
				        
				        $preparea = $this->Forms_model->getPrepAreas($this->session->userdata('user_email'),$branch_id);
				        
                        
                        $this->session->set_userdata('formPrepArea', $preparea[0]->prep_area_id);
           
            			$this->session->set_userdata('prepAreaName', $preparea[0]->prep_area_name);
            			$tables = unserialize($preparea[0]->prep_area_table);
            // 			echo "<pre>";print_r($tables);exit;
            			foreach($tables as $row){
            			 //   echo $row;
            			    $preparea = $this->Forms_model->getForms($row);
            			    $tablesRecord[] = array(
            			        'path' => $preparea[0]->table_name,
            			        'table_name' => $preparea[0]->table_description,
            			        );
            			}
            		$data['tablesRecord'] = $tablesRecord;
				    }
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
	public function manage_employee(){
		$this->load->view('header_general');
		$this->load->view('manage_employee');
		$this->load->view('footer');
	}

}