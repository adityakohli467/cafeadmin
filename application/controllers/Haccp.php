<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Haccp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
		$this->load->model('Haccp_model');
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
		}else if(!$this->ion_auth->checkUserDetails()){
			redirect('settings/index');
		}else {
		    echo "HACCP";
		}
    }
    
    public function add_document() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
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
        			'category'  => 'Admin'
    			    );
    			
    		    $insert_id = $this->Haccp_model->add_data_to_tble('document',$data);
    		  
    		   		redirect('haccp/view_document');
    		    }else{
    		    
    		    
    			$this->load->view('general/header_general',$hdata);
				$this->load->view('haccp/add_document',$data);
				$this->load->view('general/footer');
    		    }
		    	
			
			}else{
				$this->session->set_flashdata("subscription_msg","Your account has been expired"); 
				redirect('settings/subscriptions');
			}
		}
    }
     
    public function view_document() {
    	if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else if(!$this->ion_auth->checkUserDetails()){
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
				
				
					$params = array();
                $limit_per_page = 5;
           
                $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$total_records = $this->Haccp_model->get_total('document');
			

            
				$records = $this->pagination_data_buildup('document',$total_records,'haccp/view_document');

				$data['result_count']  = $records['result_count'];
				$data['record_data']  = $records['records_data'];
				
				$this->load->view('general/header_general',$hdata);
				$this->load->view('haccp/view_document',$data);
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
                 $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx|txt';
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
     public function pagination_data_buildup($table_name,$total_records,$link){
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
		 
	
		  $type='admin'; 
            $result_data  = $this->Haccp_model->fetch_data($table_name,$branch_id,$config["per_page"], $this->uri->segment(3),$type);
            
        //   echo "<pre>";print_r($result_data);exit;
            
           return  $result_array = array(
                'result_count' => $result_count,
                 'records_data' => $result_data
                
                );
            
            }
        
    }
    	public function delete_document(){

			  $id = $this->input->post('id');
			$delete = $this->Haccp_model->delete_document($id);
	}
	
}