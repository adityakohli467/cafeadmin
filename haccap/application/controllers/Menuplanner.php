<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Menuplanner extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
         $this->load->helper('menuitems'); 
		$this->load->model('menuplanner_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    public function download_menuplanner($id){
    	$branch_id = $this->session->userdata('branch_id');
    	$menuPlanner = $this->menuplanner_model->weekMenuView($branch_id,$id);
    		if(!empty($menuPlanner)){
			    foreach($menuPlanner as $menuPlan){
			        $monMenuIDs = unserialize($menuPlan->mon);
			        foreach($monMenuIDs as $monMenuID){
			             $data['monMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$monMenuID);
			        }
			        
			        $tueMenuIDs = unserialize($menuPlan->tue);
			        foreach($tueMenuIDs as $tueMenuID){
			             $data['tueMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$tueMenuID);
			        }
			        
			        $wedMenuIDs = unserialize($menuPlan->wed);
			        foreach($wedMenuIDs as $wedMenuID){
			             $data['wedMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$wedMenuID);
			        }
			        
			        $thuMenuIDs = unserialize($menuPlan->thu);
			        foreach($thuMenuIDs as $thuMenuID){
			             $data['thuMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$thuMenuID);
			        }
			        
			        $friMenuIDs = unserialize($menuPlan->fri);
			        foreach($friMenuIDs as $friMenuID){
			             $data['friMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$friMenuID);
			        }
			        
			        $satMenuIDs = unserialize($menuPlan->sat);
			        foreach($satMenuIDs as $satMenuID){
			             $data['satMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$satMenuID);
			        }
			        
			        $sunMenuIDs = unserialize($menuPlan->sun);
			        foreach($sunMenuIDs as $sunMenuID){
			             $data['sunMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$sunMenuID);
			        }
			     //   $data['menuWeekplanner']=array(
			            
			     //       'week_menu_name'  =>  $menuPlan->week_menu_name,
			     //       'week_start_date'   => $menuPlan->week_start_date,
			     //       'week_end_date' =>  $menuPlan->week_end_date,
			     //       'week_menu_month'   =>  $menuPlan->week_menu_month
			            
			     //       );
			    }
			}
    
    
	if(!empty($data)){
	
	   $weekdays = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
         
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet();
      
        $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
        $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
        $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
       $sheet->getStyle('A5:H5')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
   

   

        $sheet->setCellValue('A5', 'Day');
        $sheet->setCellValue('B5', 'Menu');
        $sheet->setCellValue('C5', 'Cuisine');
        $sheet->setCellValue('D5', 'Category');
        $sheet->setCellValue('E5', 'Regular');
        $sheet->setCellValue('F5', 'Regular Color');
         $sheet->setCellValue('G5', 'Large');
          $sheet->setCellValue('H5', 'Large Color');
      
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        
       
        
		$sheet->setCellValue('A1', 'Menu Name : '.$menuPlan->week_menu_name);
		$sheet->setCellValue('A2', 'Start Date : '.date('d-m-Y', strtotime($menuPlan->week_start_date)));
		$sheet->setCellValue('A3', 'End Date : '.date('d-m-Y', strtotime($menuPlan->week_end_date)));
		$sheet->setCellValue('A4', 'Month : '.$menuPlan->week_menu_month);
	
		$x = 6;	
	  $count =0;
		foreach($data as $dayname => $dayData){
		    $sheet->setCellValue('A'.$x, $weekdays[$count]." (".date("d-m-Y",strtotime($menuPlan->week_start_date."+ ".$count." DAY")).") ");
		   if(is_array($dayData)){
		       	
		       	foreach($dayData as $key => $value){
		       	  //  	echo "<pre>"; print_r($value); exit;
		       	  $sheet->getRowDimension($x)->setRowHeight(35);
		       	  $sheet->getStyle('A'.$x.':H'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
		       	    $sheet->setCellValue('B'.$x, $value[0]->menu);
		       	    $sheet->setCellValue('C'.$x, $value[0]->cuisine);
                    $sheet->setCellValue('D'.$x, $value[0]->name);
                    $sheet->setCellValue('E'.$x, $value[0]->regular);
                    $sheet->setCellValue('F'.$x, $value[0]->regular_color);
                    $sheet->setCellValue('G'.$x, $value[0]->large);
                    $sheet->setCellValue('H'.$x, $value[0]->large_color);
                    $x++;
        $spreadsheet->getActiveSheet()->getStyle('A'.$x.':H'.$x)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		}
		$spreadsheet->getActiveSheet()->getStyle('A'.$x.':H'.$x)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
	
   
    
		} 
		$count++;
		}
	
		} 
       $writer = new Xlsx($spreadsheet); 
       $filename = 'Menu Planner '.$menuPlan->week_menu_name.' '.date('d-m-Y', strtotime($menuPlan->week_start_date)).' to '.date('d-m-Y', strtotime($menuPlan->week_end_date)).' '.$menuPlan->week_menu_month;
        
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
    
}
    
    public function viewMenu(){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');;	
	
		  // if($branch_id ==''){
		  //   	$user_email = $this->session->userdata('user_email');
		 //	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		  //    $branch_id = $emp_id;
		  // }

			$menu_items  = display_menu();
		
			$menuPlanner = $this->menuplanner_model->getMenuPlanner($branch_id);
		    $data['menuPlanners'] = $menuPlanner;
		        $hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/viewMenu',$data);
				$this->load->view('general/footer');
		}
	}
	
	
	public function addMenu(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
		  //  $roles=$this->admin_model->fetch_role($branch_id);
		  //  $data['roles'] = $roles;
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			 $data['menuPlanner_category'] = $this->menuplanner_model->menuPlanner_category();
			 //echo"<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menuplanner/addMenu',$data);
			$this->load->view('general/footer');
		}
	}
	
	public function submitMenu(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
           $branch_id = $this->session->userdata('branch_id');

		   $data=array(
		  
			'cuisine' => $this->input->post('cuisine'),
			'category' => $this->input->post('category'),
			'menu' => $this->input->post('menu'),
			'regular' => $this->input->post('regular'),
			'regular_color' => $this->input->post('regular_color'),
			'large' => $this->input->post('large'),
			'large_color' => $this->input->post('large_color'),
			'branch_id' => $branch_id,
			'status' => 1
			);
		
		    $insert_id = $this->menuplanner_model->add_menu($data);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Menu has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Menu');
			}
		    redirect('menuplanner/viewMenu');
		}else{
			 $menu_items  = display_menu();
				$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menuplanner/addMenu');
			$this->load->view('general/footer');
		}
      }
	}
	
	public function update_menu($id){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		     
          $menuplannerDetails = $this->menuplanner_model->getMenuPlanner($branch_id,$id);
        //   $role = $this->session->userdata('role');
      
        
          $menu_items  = display_menu();
          $data['branch_id'] = $branch_id;
		  $hdata['menus'] = $menu_items;
          $data['menuplannerDetails'] = $menuplannerDetails[0];
           $data['menuPlanner_category'] = $this->menuplanner_model->menuPlanner_category();
          $data['menuPlanner_subCategory'] = $this->menuplanner_model->fetchMenuCategory($branch_id,$menuplannerDetails[0]->menu_category_id);
              
          $data['action'] = 'edit';
          $this->load->view('general/header_general',$hdata);
		  $this->load->view('menuplanner/addMenu',$data);
		  $this->load->view('general/footer');
		}
      }
	
	public function update_menuplanner_status(){
	    
	    	  $status = $this->input->post('status');
			  $menuPlannerID = $this->input->post('menuPlannerID');
			$data = array(
            'status' => $status
            );
			$updated = $this->menuplanner_model->update_menuplanner($data,$menuPlannerID);
			echo "Success";
	}
		public function submitupUpdateMenu(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
          
            $menuPlannerID = $this->input->post('menuPlannerID');
		   $data=array(
		  
			'cuisine' => $this->input->post('cuisine'),
			'category' => $this->input->post('category'),
			'menu' => $this->input->post('menu'),
			'regular' => $this->input->post('regular'),
			'regular_color' => $this->input->post('regular_color'),
			'large' => $this->input->post('large'),
			'large_color' => $this->input->post('large_color'),
		   );
		
		    $insert_id = $this->menuplanner_model->update_menuplanner($data,$menuPlannerID);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Menu has been sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update the Menu');
			}
		    redirect('menuplanner/viewMenu');
		}else{
			 $this->session->set_flashdata('error_msg', 'Unable to update the Menu');
			
		    redirect('menuplanner/viewMenu');
		}
      }
	}
	public function viewMenuCategory(){
    	    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');;	
	
		  // if($branch_id ==''){
		  //   	$user_email = $this->session->userdata('user_email');
		 //	$emp_id = $this->admin_model->get_emp_details_fromemail($user_email);
		  //    $branch_id = $emp_id;
		  // }

			$menu_items  = display_menu();
		
			$menuCategory = $this->menuplanner_model->getMenuCategory($branch_id);
		    $data['menuCategory'] = $menuCategory;
		        $hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/viewMenuCategory',$data);
				$this->load->view('general/footer');
		}
	}
	public function addMenuCategory(){
	    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
		  //  $roles=$this->admin_model->fetch_role($branch_id);
		  //  $data['roles'] = $roles;
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			 //$data['menuPlanner_category'] = $this->menuplanner_model->menuPlanner_category();
			 //echo"<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menuplanner/addMenuCategory');
			$this->load->view('general/footer');
		}
	}
	public function submitMenuCategory(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
           $branch_id = $this->session->userdata('branch_id');

		   $data=array(
		  
			'name' => $this->input->post('category'),
			'branch_id' => $branch_id,
			'status' => 1
			);
		
		    $insert_id = $this->menuplanner_model->add_menuPlanner_category($data);
            // echo "<pre>";print_r($data);exit;
			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Category has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Category');
			}
		    redirect('menuplanner/viewMenuCategory');
		}else{
			 $menu_items  = display_menu();
				$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menuplanner/addMenuCategory');
			$this->load->view('general/footer');
		}
      }
	}
	public function updateMenuCategory($id){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $branch_id = $this->session->userdata('branch_id');
		     
          $menuCategoryDetails = $this->menuplanner_model->getMenuCategory($branch_id,$id);
        //   $role = $this->session->userdata('role');
      
        
          $menu_items  = display_menu();
          $data['branch_id'] = $branch_id;
		  $hdata['menus'] = $menu_items;
          $data['menuCategoryDetails'] = $menuCategoryDetails[0];
           $data['menuPlanner_category'] = $this->menuplanner_model->menuPlanner_category();
            //   echo "<pre>"; print_r($data['menuplannerDetails']); exit;
          $data['action'] = 'edit';
          $this->load->view('general/header_general',$hdata);
		  $this->load->view('menuplanner/addMenuCategory',$data);
		  $this->load->view('general/footer');
		}
      }
	
	public function update_menuCategory_status(){
	    
	    	  $category_status = $this->input->post('status');
			  $category_id = $this->input->post('category_id');
			$data = array(
            'status' => $category_status
            );
			$updated = $this->menuplanner_model->update_menuCategory($data,$category_id);
			echo "Success";
	}
		public function submitupUpdateMenuCategory(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
          
            $subcategory_id = $this->input->post('category_id');
		   $data=array(
		 
			'name' => $this->input->post('category'),
		   );
		
		    $insert_id = $this->menuplanner_model->update_menuCategory($data,$subcategory_id);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Category has been sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update the Category');
			}
		    redirect('menuplanner/viewMenuCategory');
		}else{
			 $this->session->set_flashdata('error_msg', 'Unable to update the Category');
			
		    redirect('menuplanner/viewMenuCategory');
		}
      }
	}
	public function deleteMenuCategory(){
        $id = $this->input->post('id');
       $this->menuplanner_model->deleteMenuCategory($id);
         
    }
	
	public function fetchMenuCategory(){
	  
	        $category_id = $this->input->post('category_id');
	    	$branch_id = $this->session->userdata('branch_id');
	        $menuCategory = $this->menuplanner_model->fetchMenuCategory($branch_id,$category_id);
	       // echo "<pre>";print_r($menuCategory);exit;
		    if($menuCategory){
		        echo json_encode(($menuCategory), true);
		    }
		    else{
		        echo "No record";
		    }
		    
	}
	
	
	 public function menuplanner_delete(){
        $id = $this->input->post('id');
       $this->menuplanner_model->menuplanner_delete($id);
         
    }
    public function createWeekMenu(){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');;	
	

			$menu_items  = display_menu();
    // 		$menuPlanner = $this->menuplanner_model->getMenuPlanner($branch_id);
    		 $menuPlanner = $this->menuplanner_model->menuPlanner_category();
    		$data['menuPlanners'] = $menuPlanner;
		  //  echo "<pre>";print_r($data);exit;
		        $hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/createMenu',$data);
				$this->load->view('general/footer');
		}
	}
	public function fetchMenus(){
	   
	        $menuPlannerID = $this->input->post('menuPlannerID');
	    	$branch_id = $this->session->userdata('branch_id');
	        $menuPlanner = $this->menuplanner_model->getMenuPlannerMenus($branch_id,$menuPlannerID);
		    if($menuPlanner){
		        echo json_encode(($menuPlanner), true);
		    }
		    else{
		        echo "No record";
		    }
		    
	}
	public function fetchMenu(){
	   
	        $menuPlannerID = $this->input->post('menuPlannerID');
	    	$branch_id = $this->session->userdata('branch_id');
	        $menuPlanner = $this->menuplanner_model->getMenuPlannerData($branch_id,$menuPlannerID);
		    
		    echo json_encode(($menuPlanner), true);
	}
	public function saveWeekMenu(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			
		
			
		  	if(!empty($this->input->post('monWeek'))){
		  	    foreach($this->input->post('monWeek') as $week){
		  	        if($week != ''){
		  	            $monWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	  if(isset($monWeeks)){
		  	      $monWeek = serialize($monWeeks);  
		  	    }
			    else{
			    $monWeek='';
		     	}
			    
			}
			
			
			if(!empty($this->input->post('tueWeek'))){
			     foreach($this->input->post('tueWeek') as $week){
		  	        if($week != ''){
		  	            $tueWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($tueWeeks)){
		  	      $tueWeek = serialize($tueWeeks);  
		  	    }
			    else{
			        $tueWeek='';
			    }
			}
			
			
			if(!empty($this->input->post('WedWeek'))){
			    foreach($this->input->post('WedWeek') as $week){
		  	        if($week != ''){
		  	            $wedWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($wedWeeks)){
		  	      $wedWeek = serialize($wedWeeks);  
		  	    }
			    else{
			        $wedWeek='';
			    }
			    
			}
			
			
			if(!empty($this->input->post('thuWeek'))){
			     foreach($this->input->post('thuWeek') as $week){
		  	        if($week != ''){
		  	            $thuWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($thuWeeks)){
		  	      $thuWeek = serialize($thuWeeks);  
		  	    }
			    	else{
			    $thuWeek='';
			    }
			}
		
			
			
			if(!empty($this->input->post('friWeek'))){
			    foreach($this->input->post('friWeek') as $week){
		  	        if($week != ''){
		  	            $friWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($friWeeks)){
		  	      $friWeek = serialize($friWeeks);  
		  	    }
			  	else{
			    $friWeek='';
			    } 
			}
		
			
			if(!empty($this->input->post('satWeek'))){
			    foreach($this->input->post('satWeek') as $week){
		  	        if($week != ''){
		  	            $satWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($satWeeks)){
		  	     $satWeek = serialize($satWeeks);  
		  	    }
			    else{
			    $satWeek='';
			    }
			}
			
			
			if(!empty($this->input->post('sunWeek'))){
			    foreach($this->input->post('sunWeek') as $week){
		  	        if($week != ''){
		  	            $sunWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($sunWeeks)){
		  	      $sunWeek = serialize($sunWeeks); 
		  	    }
			    else{
			        $sunWeek='';
			    }
			}
			
				   

		    $data=array(
		    'branch_id'    => $branch_id,  
			'week_menu_name' => $this->input->post('week_menu_name'),
			'week_end_date' => $this->input->post('week_end_date'),
			'week_start_date' => $this->input->post('week_start_date'),
			'week_menu_month' => $this->input->post('week_menu_month'),
			'mon'   =>  $monWeek,
			'tue'   =>  $tueWeek,
		    'wed'   =>  $wedWeek,
		    'thu'   =>  $thuWeek,
		    'fri'   =>  $friWeek,
		    'sat'   =>  $satWeek,
		    'sun'   =>  $sunWeek
			);
		
		
		    $insert_id = $this->menuplanner_model->saveWeekMenu($data);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Menu has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Menu');
			}
		    redirect('menuplanner/weekMenuList');
		}
	}
	public function weekMenuList(){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			
			$menu_items  = display_menu();
		
			$menuPlanner = $this->menuplanner_model->weekMenuList($branch_id);
		    $data['menuPlanners'] = $menuPlanner;
		    
		    
		        $hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/weekMenuList',$data);
				$this->load->view('general/footer');
		}
	}
	public function weekMenuView($week_menu_id){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$data['id'] = $week_menu_id;
			$menu_items  = display_menu();
		    
			$menuPlanner = $this->menuplanner_model->weekMenuView($branch_id,$week_menu_id);
// 			echo "<pre>";print_r($menuPlanner);exit;
			if(!empty($menuPlanner)){
			    foreach($menuPlanner as $menuPlan){
			        $monMenuIDs = unserialize($menuPlan->mon);
			        foreach($monMenuIDs as $monMenuID){
			             $data['monMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$monMenuID);
			        }
			        
			        $tueMenuIDs = unserialize($menuPlan->tue);
			        foreach($tueMenuIDs as $tueMenuID){
			             $data['tueMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$tueMenuID);
			        }
			        
			        $wedMenuIDs = unserialize($menuPlan->wed);
			        foreach($wedMenuIDs as $wedMenuID){
			             $data['wedMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$wedMenuID);
			        }
			        
			        $thuMenuIDs = unserialize($menuPlan->thu);
			        foreach($thuMenuIDs as $thuMenuID){
			             $data['thuMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$thuMenuID);
			        }
			        
			        $friMenuIDs = unserialize($menuPlan->fri);
			        foreach($friMenuIDs as $friMenuID){
			             $data['friMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$friMenuID);
			        }
			        
			        $satMenuIDs = unserialize($menuPlan->sat);
			        foreach($satMenuIDs as $satMenuID){
			             $data['satMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$satMenuID);
			        }
			        
			        $sunMenuIDs = unserialize($menuPlan->sun);
			        foreach($sunMenuIDs as $sunMenuID){
			             $data['sunMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$sunMenuID);
			        }
			        $data['menuWeekplanner']=array(
			            'week_menu_id'  =>  $menuPlan->week_menu_id,
			            'week_menu_name'  =>  $menuPlan->week_menu_name,
			            'week_start_date'   => $menuPlan->week_start_date,
			            'week_end_date' =>  $menuPlan->week_end_date,
			            'week_menu_month'   =>  $menuPlan->week_menu_month
			            
			            );
			    }
			}
		  // echo "<pre>";print_r($data);exit;
		        $hdata['menus'] = $menu_items;
		        $menuPlanner = $this->menuplanner_model->getMenuPlanner($branch_id);
    		    $data['menuPlanners'] = $menuPlanner;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/weekMenuView',$data);
				$this->load->view('general/footer');
		}
	}
		public function weekMenuRecreate($week_menu_id){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			
			$menu_items  = display_menu();
		    
			$menuPlanner = $this->menuplanner_model->weekMenuView($branch_id,$week_menu_id);
			if(!empty($menuPlanner)){
			    foreach($menuPlanner as $menuPlan){
			        $monMenuIDs = unserialize($menuPlan->mon);
			        foreach($monMenuIDs as $monMenuID){
			             $data['monMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$monMenuID);
			        }
			        
			        $tueMenuIDs = unserialize($menuPlan->tue);
			        foreach($tueMenuIDs as $tueMenuID){
			             $data['tueMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$tueMenuID);
			        }
			        
			        $wedMenuIDs = unserialize($menuPlan->wed);
			        foreach($wedMenuIDs as $wedMenuID){
			             $data['wedMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$wedMenuID);
			        }
			        
			        $thuMenuIDs = unserialize($menuPlan->thu);
			        foreach($thuMenuIDs as $thuMenuID){
			             $data['thuMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$thuMenuID);
			        }
			        
			        $friMenuIDs = unserialize($menuPlan->fri);
			        foreach($friMenuIDs as $friMenuID){
			             $data['friMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$friMenuID);
			        }
			        
			        $satMenuIDs = unserialize($menuPlan->sat);
			        foreach($satMenuIDs as $satMenuID){
			             $data['satMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$satMenuID);
			        }
			        
			        $sunMenuIDs = unserialize($menuPlan->sun);
			        foreach($sunMenuIDs as $sunMenuID){
			             $data['sunMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$sunMenuID);
			        }
			        $data['menuWeekplanner']=array(
			            'week_menu_id'  =>  $menuPlan->week_menu_id,
			            'week_menu_name'  =>  $menuPlan->week_menu_name,
			            'week_start_date'   => $menuPlan->week_start_date,
			            'week_end_date' =>  $menuPlan->week_end_date,
			            'week_menu_month'   =>  $menuPlan->week_menu_month
			            
			            );
			    }
			}
		  // echo "<pre>";print_r($data);exit;
		        $hdata['menus'] = $menu_items;
		        $menuPlanner = $this->menuplanner_model->getMenuPlanner($branch_id);
    		    $data['menuPlanners'] = $menuPlanner;
    		    
    		    $menuCategory = $this->menuplanner_model->menuPlanner_category();
    		    $data['menuCategory'] = $menuCategory;
    		    
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/weekMenuRecreate',$data);
				$this->load->view('general/footer');
		}
	}
		public function weekMenuEdit($week_menu_id){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			
			$menu_items  = display_menu();
		     $menuCategory = $this->menuplanner_model->menuPlanner_category();
			$menuPlanner = $this->menuplanner_model->weekMenuView($branch_id,$week_menu_id);
			if(!empty($menuPlanner)){
			    foreach($menuPlanner as $menuPlan){
			        $monMenuIDs = unserialize($menuPlan->mon);
			        foreach($monMenuIDs as $monMenuID){
			             $data['monMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$monMenuID);
			        }
			        
			        $tueMenuIDs = unserialize($menuPlan->tue);
			        foreach($tueMenuIDs as $tueMenuID){
			             $data['tueMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$tueMenuID);
			        }
			        
			        $wedMenuIDs = unserialize($menuPlan->wed);
			        foreach($wedMenuIDs as $wedMenuID){
			             $data['wedMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$wedMenuID);
			        }
			        
			        $thuMenuIDs = unserialize($menuPlan->thu);
			        foreach($thuMenuIDs as $thuMenuID){
			             $data['thuMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$thuMenuID);
			        }
			        
			        $friMenuIDs = unserialize($menuPlan->fri);
			        foreach($friMenuIDs as $friMenuID){
			             $data['friMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$friMenuID);
			        }
			        
			        $satMenuIDs = unserialize($menuPlan->sat);
			        foreach($satMenuIDs as $satMenuID){
			             $data['satMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$satMenuID);
			        }
			        
			        $sunMenuIDs = unserialize($menuPlan->sun);
			        foreach($sunMenuIDs as $sunMenuID){
			             $data['sunMenus'][] = $this->menuplanner_model->getMenuPlannerData($branch_id,$sunMenuID);
			        }
			        $data['menuWeekplanner']=array(
			            'week_menu_id'  =>  $menuPlan->week_menu_id,
			            'week_menu_name'  =>  $menuPlan->week_menu_name,
			            'week_start_date'   => $menuPlan->week_start_date,
			            'week_end_date' =>  $menuPlan->week_end_date,
			            'week_menu_month'   =>  $menuPlan->week_menu_month
			            
			            );
			    }
			}
		  // echo "<pre>";print_r($data);exit;
		        $hdata['menus'] = $menu_items;
		        $menuPlanner = $this->menuplanner_model->getMenuPlanner($branch_id);
    		    $data['menuPlanners'] = $menuPlanner;
    		    $data['menuCategory'] = $menuCategory;
    		  //  echo "<pre>";print_r($data);exit;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menuplanner/weekMenuEdit',$data);
				$this->load->view('general/footer');
		}
	}
	public function updateWeekMenu(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			
		  	if(!empty($this->input->post('monWeek'))){
		  	    foreach($this->input->post('monWeek') as $week){
		  	        if($week != ''){
		  	            $monWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	  if(isset($monWeeks)){
		  	      $monWeek = serialize($monWeeks);  
		  	    }
			    else{
			    $monWeek='';
		     	}
			    
			}
			
			
			if(!empty($this->input->post('tueWeek'))){
			     foreach($this->input->post('tueWeek') as $week){
		  	        if($week != ''){
		  	            $tueWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($tueWeeks)){
		  	      $tueWeek = serialize($tueWeeks);  
		  	    }
			    else{
			        $tueWeek='';
			    }
			}
			
			
			if(!empty($this->input->post('WedWeek'))){
			    foreach($this->input->post('WedWeek') as $week){
		  	        if($week != ''){
		  	            $wedWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($wedWeeks)){
		  	      $wedWeek = serialize($wedWeeks);  
		  	    }
			    else{
			        $wedWeek='';
			    }
			    
			}
			
			
			if(!empty($this->input->post('thuWeek'))){
			     foreach($this->input->post('thuWeek') as $week){
		  	        if($week != ''){
		  	            $thuWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($thuWeeks)){
		  	      $thuWeek = serialize($thuWeeks);  
		  	    }
			    	else{
			    $thuWeek='';
			    }
			}
		
			
			
			if(!empty($this->input->post('friWeek'))){
			    foreach($this->input->post('friWeek') as $week){
		  	        if($week != ''){
		  	            $friWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($friWeeks)){
		  	      $friWeek = serialize($friWeeks);  
		  	    }
			  	else{
			    $friWeek='';
			    } 
			}
		
			
			if(!empty($this->input->post('satWeek'))){
			    foreach($this->input->post('satWeek') as $week){
		  	        if($week != ''){
		  	            $satWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($satWeeks)){
		  	     $satWeek = serialize($satWeeks);  
		  	    }
			    else{
			    $satWeek='';
			    }
			}
			
			
			if(!empty($this->input->post('sunWeek'))){
			    foreach($this->input->post('sunWeek') as $week){
		  	        if($week != ''){
		  	            $sunWeeks[]=$week;
		  	        }
		  	        
		  	    }
		  	    if(isset($sunWeeks)){
		  	      $sunWeek = serialize($sunWeeks); 
		  	    }
			    else{
			        $sunWeek='';
			    }
			}
			
				   
            $id=$this->input->post('week_menu_id');
		    $data=array(
		    'branch_id'    => $branch_id,  
			'week_menu_name' => $this->input->post('week_menu_name'),
			'week_end_date' => $this->input->post('week_end_date'),
			'week_start_date' => $this->input->post('week_start_date'),
			'week_menu_month' => $this->input->post('week_menu_month'),
			'mon'   =>  $monWeek,
			'tue'   =>  $tueWeek,
		    'wed'   =>  $wedWeek,
		    'thu'   =>  $thuWeek,
		    'fri'   =>  $friWeek,
		    'sat'   =>  $satWeek,
		    'sun'   =>  $sunWeek
			);
		
// 		echo "<pre>";print_r($data);exit;
		    $insert_id = $this->menuplanner_model->updateWeekMenu($data,$id);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Menu has been sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update the Menu');
			}
		    redirect('menuplanner/weekMenuList');
		}
	}
	 public function menuWeek_delete(){
        $id = $this->input->post('id');
        $this->menuplanner_model->menuWeek_delete($id);
          
    }
     public function filterMenuPlanner() {
      
			$branch_id = $this->session->userdata('branch_id');
			
			$filter = array();
			
		    if(isset($_POST['cuisine']) && $_POST['cuisine']!=''){
        	    $filter['cuisine'] =  $_POST['cuisine'];
        	}
        	else{
        	    $filter['cuisine']='';
        	}
        	if(isset($_POST['category']) && $_POST['category']!=''){
        	    $filter['category'] =  $_POST['category'];
        	}
        	else{
        	    $filter['category'] = '';
        	}
        	if(isset($_POST['menu']) && $_POST['menu']!=''){
        	    $filter['menu'] =  $_POST['menu'];
        	}
        	 else{
        	     $filter['menu']='';
        	 }
        	
        	
        // 	echo "<pre>";print_r($filter);
			$menuPlanner = $this->menuplanner_model->filterMenuPlanner($branch_id,$filter);
// 			echo "<pre>";print_r($menuPlanner);exit;
			$html = '';
			if(!empty($menuPlanner)){
			foreach($menuPlanner as $row){
			    $html.= '<tr class="tr" style="height: 49px !important;">
						<td class="text-left">' .$row->cuisine .'</td>
						<td class="text-left">'. $row->subcategory_name .'</td>
						<td class="text-center">'. $row->menu .'</td>
						<td class="text-center">'. $row->regular .'</td>
						<td class="text-center">'. $row->regular_color .'</td>
					    <td class="text-center">'. $row->large .'</td>
						<td class="text-center">'. $row->large_color .'</td>	
						<td  class="text-center" style="width:150px;">';
                        if(isset($row->status) && $row->status ==1) {
                           $html.='<input type="checkbox" class="toggle-demo" id="'. $row->menuPlannerID .'" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">';
                         } else {
                           $html.='<input type="checkbox" class="toggle-demo" id="'. $row->menuPlannerID .'"  data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">';
                        }
						$html.='</td>
						<td class="text-left"><a style="text-decoration: underline;" href="'. base_url() .'index.php/menuplanner/update_menu/'. $row->menuPlannerID .'"><span class="glyphicon glyphicon-pencil"></span></a>
						/
						<a><type="button" onClick="delete_row('.  $row->menuPlannerID .');"><span class="glyphicon glyphicon-trash"></span></a>	</td>
					
			
					</tr>';
			    }
			}
			else{
			    $html.='<tr><td colspan="9">No Record Found</td></tr>';
			}
		echo $html;   
    }
}