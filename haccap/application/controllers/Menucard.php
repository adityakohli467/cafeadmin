<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Menucard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
         $this->load->helper('menuitems');
		$this->load->model('menucard_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    
    public function download_recipe($id){
    	$branch_id = $this->session->userdata('branch_id');
    
			$recipe_type='';
            $recipe = $this->menucard_model->getAllRecipes($branch_id,$recipe_type,$id);
            
			$ingredients=unserialize($recipe[0]->ingredients);
			$allergens=unserialize($recipe[0]->allergens);
		  	
		  //echo "<pre>";print_r($recipe);exit;
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet();
      
        $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
        $sheet->getStyle('A3:C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
        $sheet->getStyle('A3:C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('A3:C3')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        
       

        

        $sheet->setCellValue('A3', 'Ingredient Name');
        $sheet->setCellValue('B3', 'Preparation');
        $sheet->setCellValue('C3', 'Serves');
      
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);

		$sheet->setCellValue('A1', 'Recipe Name : '.$recipe[0]->recipe_name);
		$sheet->setCellValue('A2', 'Serving Size : '.$recipe[0]->serving_size_name);
		
		
	
		$x = 4;	
	   
		
		if(is_array($ingredients)){
		       	
		       	foreach($ingredients as $key => $value){
		       	  //  	echo "<pre>"; print_r($value); exit;
		       	  $sheet->getRowDimension($x)->setRowHeight(35);
		       	  $sheet->getStyle('A'.$x.':C'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
		       	    $sheet->setCellValue('A'.$x, $value['ingredient']);
		       	    $sheet->setCellValue('B'.$x, $value['preparation']);
                    $sheet->setCellValue('C'.$x, $value['serves']);
                    $x++;
        $spreadsheet->getActiveSheet()->getStyle('A'.$x.':C'.$x)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		}
	
		}
		
		 $sheet->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('A'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
	    $sheet->getStyle('B'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('B'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
	    $sheet->getStyle('c'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('c'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
	
    	$sheet->setCellValue('A'.$x, 'Method');
    	
    	$x++;
    	$sheet->getColumnDimension('A'.$x)->setWidth(25, 'pt');
        $sheet->getRowDimension('A'.$x)->setRowHeight(50);
        $sheet->getStyle('A'.$x)->getAlignment()->setWrapText(true);
    	$sheet->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
    	$sheet->getStyle('B'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
    	$sheet->getStyle('C'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
		$sheet->setCellValue('A'.$x, $recipe[0]->recipe_method);
		$x++;
		$sheet->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('A'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->getStyle('B'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('B'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
	    $sheet->getStyle('C'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $sheet->getStyle('C'.$x)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
	
    	$sheet->setCellValue('A'.$x, 'Allergens');
    	$x++;
		 	foreach($allergens as $key => $value){
		 	    $field = str_replace('_',' ',$key);
		 	    if($value == 1){
		 	       $val = 'Yes';
		 	    }else{
		 	         $val = 'No';
		 	    }
		       	  //  	echo "<pre>"; print_r($value); exit;
		       	  $sheet->getRowDimension($x)->setRowHeight(35);
		       	  $sheet->getStyle('A'.$x.':C'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
		       	    $sheet->setCellValue('A'.$x, strtoupper($field));
		       	    $sheet->setCellValue('B'.$x, $val);
                    
        $spreadsheet->getActiveSheet()->getStyle('A'.$x.':C'.$x)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$x++;
		 	    
		 	}
      $writer = new Xlsx($spreadsheet); 
      $filename = $recipe[0]->recipe_type.'_recipe_'.$recipe[0]->recipe_name;
        
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
    
}
    // serving size controller
    public function viewServingSize(){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');;	
	

			$menu_items  = display_menu();
		
			$ServingSize = $this->menucard_model->getServingSize($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		    $data['table_name'] = 'haccap_ServingSize';
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/viewServingSize',$data);
				$this->load->view('general/footer');
		}
	}
	
	public function addServingSize(){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
		    $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menucard/addServingSize',$data);
			$this->load->view('general/footer');
		}
	}
	public function submitServingSize(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   if ($this->input->post()) {
		       
           $branch_id = $this->session->userdata('branch_id');

		   
		    if($this->input->post('haccap_ServingSize_id')){
		        
		        $id=$this->input->post('haccap_ServingSize_id');
		        
		        $data=array(
    			'serving_size_name' => $this->input->post('serving_size_name'),
    			'branch_id' => $branch_id,
    			'status' => $this->input->post('status')
    			);
			
		        $this->menucard_model->updateServingSize($data,$id);

		    }else{
		        
		        $data=array(
        			'serving_size_name' => $this->input->post('serving_size_name'),
        			'branch_id' => $branch_id,
        			'status' => '1'
        			);
			
		    $insert_id = $this->menucard_model->addServingSize($data);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Serving Size has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Serving Size');
			}
		    }
		    redirect('menucard/viewServingSize');
		}else{
			 $menu_items  = display_menu();
				$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menucard/addServingSize');
			$this->load->view('general/footer');
		}
      }
	}
	public function editServingSize($id){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');
			
			$menu_items  = display_menu();
		  //  $id='';
			$ServingSize = $this->menucard_model->getServingSize($branch_id,$id);
		    $data['ServingSize'] = $ServingSize;
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/addServingSize',$data);
				$this->load->view('general/footer');
		}
	}
	
// 	recipe

 public function viewRecipes($recipe_type){
    
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	

			$menu_items  = display_menu();
			
			$data['recipe_type']  = $recipe_type;
    		if($recipe_type=="hotfood"){
    		 $data['heading']  = "Hotfood Recipes";   
    		}
    		else if($recipe_type == "salad"){
    		    $data['heading']  = "Salad Recipes"; 
    		    
    		}
    		else if($recipe_type == "coldfood"){
    		    $data['heading']  = "Cold Food Recipes"; 
    		}
    		else if($recipe_type == "sweets"){
    		    $data['heading']  = "Sweets Recipes"; 
    		}
    		else{
    		 $data['heading']  = "Recipes";   
    		}
    		
    		
			$Recipes = $this->menucard_model->getAllRecipes($branch_id,$recipe_type,'');
		    $data['recipes'] = $Recipes;
		    $data['table_name'] = 'haacp_recipe';
		    
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/viewRecipes',$data);
				$this->load->view('general/footer');
		}
	}
	
	public function addRecipe($recipe_type){
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
		    $menu_items  = display_menu();
		    
		    $data['recipe_type']  = $recipe_type;
		    
    		if($recipe_type=="hotfood"){
    		 $data['heading']  = "Add Hotfood"; 
    		 $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "salad"){
    		    $data['heading']  = "Add Salad"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		    
    		}
    		else if($recipe_type == "coldfood"){
    		    $data['heading']  = "Add Cold Food"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "sweets"){
    		    $data['heading']  = "Add Sweets"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
   
    		else{
    		 $data['heading']  = "Add Recipe";  
    		  $data['form_type'] = 'recipe_without_allergens';
    		}
    		
    		
		    $ServingSize = $this->menucard_model->getServingSizes($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		     $data['form_name'] = 'add';
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menucard/addRecipe',$data);
			$this->load->view('general/footer');
		}
	}
	public function submitRecipe(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    $recipe_file_name = '';
		   if ($this->input->post()) {
		    $target_dir = 'assets/recipesAttachments/';
            $branch_id = $this->session->userdata('branch_id');
            $recipe_type=$this->input->post('recipe_type');
		  // echo "<pre>";print_r($this->input->post());exit;
		    if($this->input->post('haacp_recipe_id') && $_POST["form_name"] != 'recreate'){
		      
		        $id=$this->input->post('haacp_recipe_id');
		         $status=$this->input->post('status');
		         
		         if($_FILES['recipe_image']['name'] != ''){
               
    		  	$userfile_name = $_FILES['recipe_image']['name'];
                $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name = 'recipe_'.rand('10000','99999');
    		  	$i = ".";
                $recipe_file_name=$file_name.$i.$userfile_extn;
                $target_file = $target_dir . $recipe_file_name;
                $file = move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_file);
               
            }
            
		         for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                       if($_POST["ingredient"][$i] !=''){      
                             $tempData[$i] = array(
                                'ingredient' =>$_POST["ingredient"][$i],
                                'preparation' =>$_POST["preparation"][$i],
                                'serves' =>$_POST["serves"][$i],
                         );
                      }
                }
		        $ingredients= serialize($tempData);  
		       $allergens_data = array(
                                         
                                           'milk' => ($_POST["milk"] != '' ? '1' : '0'),
                                           'egg' => ($_POST["egg"] != '' ? '1' : '0'),
                                           'fish' => ($_POST["fish"] != '' ? '1' : '0'),
                                           'crustacean' => ($_POST["crustacean"] != '' ? '1' : '0'),
                                           'mollusc' => ($_POST["mollusc"] != '' ? '1' : '0'),
                                           'sesame' => ($_POST["sesame"] != '' ? '1' : '0'),
                                           'lupin' => ($_POST["lupin"] != '' ? '1' : '0'),
                                           'soy' => ($_POST["soy"] != '' ? '1' : '0'),
                                           'peanut' => ($_POST["peanut"] != '' ? '1' : '0'),
                                           'wheat' => ($_POST["wheat"] != '' ? '1' : '0'),
                                           'barley' => ($_POST["barley"] != '' ? '1' : '0'),
                                           'oats' => ($_POST["oats"] != '' ? '1' : '0'),
                                           'rye' => ($_POST["rye"] != '' ? '1' : '0'),
                                           'gluten' => ($_POST["gluten"] != '' ? '1' : '0'),
                                           'almond' => ($_POST["almond"] != '' ? '1' : '0'),
                                           'brazil_nut' => ($_POST["brazil_nut"] != '' ? '1' : '0'),
                                           'cashew' => ($_POST["cashew"] != '' ? '1' : '0'),
                                           'hazelnut' => ($_POST["hazelnut"] != '' ? '1' : '0'),
                                           'macadamia' => ($_POST["macadamia"] != '' ? '1' : '0'),
                                           'pecan' => ($_POST["pecan"] != '' ? '1' : '0'),
                                           'pine_nut' => ($_POST["pine_nut"] != '' ? '1' : '0'),
                                           'pistachio' => ($_POST["pistachio"] != '' ? '1' : '0'),
                                           'walnut' => ($_POST["walnut"] != '' ? '1' : '0')
                                        
                                 );
                              
                     
        		$allergens= serialize($allergens_data); 
		        $data=array(
    			'recipe_name' => $this->input->post('recipe_name'),
    			'serving_size_id' => $this->input->post('serving_size_id'),
    			'ingredients' => $ingredients,
    			'recipe_method' => $this->input->post('recipe_method'),
    			'allergens' => $allergens,
    			'branch_id' => $branch_id,
    			'status' => $status
    			);
    			if($recipe_file_name != ''){
    			   $data['recipe_image'] = $recipe_file_name;
    			}
// 			echo "<pre>";print_r($data);exit;
		        $this->menucard_model->updateRecipe($data,$id);

		    }
		    else if($_POST["form_name"] == 'recreate'){
		        if($_FILES['recipe_image']['name'] != ''){
               
    		  	$userfile_name = $_FILES['recipe_image']['name'];
                $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name = 'recipe_'.rand('10000','99999');
    		  	$i = ".";
                $recipe_file_name=$file_name.$i.$userfile_extn;
                $target_file = $target_dir . $recipe_file_name;
                $file = move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_file);
               
            }
		        $status=$this->input->post('status');
		        
		        for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                       if($_POST["ingredient"][$i] !=''){      
                             $tempData[$i] = array(
                                'ingredient' =>$_POST["ingredient"][$i],
                                'preparation' =>$_POST["preparation"][$i],
                                'serves' =>$_POST["serves"][$i],
                         );
                      }
                }
		        $ingredients= serialize($tempData);
		      $allergens_data = array(
                                         
                                           'milk' => ($_POST["milk"] != '' ? '1' : '0'),
                                           'egg' => ($_POST["egg"] != '' ? '1' : '0'),
                                           'fish' => ($_POST["fish"] != '' ? '1' : '0'),
                                           'crustacean' => ($_POST["crustacean"] != '' ? '1' : '0'),
                                           'mollusc' => ($_POST["mollusc"] != '' ? '1' : '0'),
                                           'sesame' => ($_POST["sesame"] != '' ? '1' : '0'),
                                           'lupin' => ($_POST["lupin"] != '' ? '1' : '0'),
                                           'soy' => ($_POST["soy"] != '' ? '1' : '0'),
                                           'peanut' => ($_POST["peanut"] != '' ? '1' : '0'),
                                           'wheat' => ($_POST["wheat"] != '' ? '1' : '0'),
                                           'barley' => ($_POST["barley"] != '' ? '1' : '0'),
                                           'oats' => ($_POST["oats"] != '' ? '1' : '0'),
                                           'rye' => ($_POST["rye"] != '' ? '1' : '0'),
                                           'gluten' => ($_POST["gluten"] != '' ? '1' : '0'),
                                           'almond' => ($_POST["almond"] != '' ? '1' : '0'),
                                           'brazil_nut' => ($_POST["brazil_nut"] != '' ? '1' : '0'),
                                           'cashew' => ($_POST["cashew"] != '' ? '1' : '0'),
                                           'hazelnut' => ($_POST["hazelnut"] != '' ? '1' : '0'),
                                           'macadamia' => ($_POST["macadamia"] != '' ? '1' : '0'),
                                           'pecan' => ($_POST["pecan"] != '' ? '1' : '0'),
                                           'pine_nut' => ($_POST["pine_nut"] != '' ? '1' : '0'),
                                           'pistachio' => ($_POST["pistachio"] != '' ? '1' : '0'),
                                           'walnut' => ($_POST["walnut"] != '' ? '1' : '0')
                                        
                                 );
                              
                     
        		        $allergens= serialize($allergens_data);
    		    $data=array(
    		    'recipe_type' => $recipe_type,
    			'recipe_name' => $this->input->post('recipe_name'),
    			'serving_size_id' => $this->input->post('serving_size_id'),
    			'ingredients' => $ingredients,
    			'recipe_method' => $this->input->post('recipe_method'),
    			'allergens' => $allergens,
    			'branch_id' => $branch_id,
    			'status' => $status
    			);
    			if($recipe_file_name != ''){
    			   $data['recipe_image'] = $recipe_file_name;
    			}
    // 			echo "<pre>";print_r($data);exit;
    		    $insert_id = $this->menucard_model->addRecipe($data);
    
    			if($insert_id){
    				$this->session->set_flashdata('sucess_msg', 'Recipe has been sucessfully recreated');
    			}else{
    				$this->session->set_flashdata('error_msg', 'Unable to recreate the Recipe');
    			}
		    }else{
		        
            if($_FILES['recipe_image']['name'] != ''){
               
    		  	$userfile_name = $_FILES['recipe_image']['name'];
                $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
    		  	$file_name = 'recipe_'.rand('10000','99999');
    		  	$i = ".";
                $recipe_file_name=$file_name.$i.$userfile_extn;
                $target_file = $target_dir . $recipe_file_name;
                $file = move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_file);
               
            }
		     
		        for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                       if($_POST["ingredient"][$i] !=''){      
                             $tempData[$i] = array(
                                'ingredient' =>$_POST["ingredient"][$i],
                                'preparation' =>$_POST["preparation"][$i],
                                'serves' =>$_POST["serves"][$i],
                         );
                      }
                }
                
              
		       $ingredients= serialize($tempData);
		       $allergens_data = array(
                                         
                                           'milk' => ($_POST["milk"] != '' ? '1' : '0'),
                                           'egg' => ($_POST["egg"] != '' ? '1' : '0'),
                                           'fish' => ($_POST["fish"] != '' ? '1' : '0'),
                                           'crustacean' => ($_POST["crustacean"] != '' ? '1' : '0'),
                                           'mollusc' => ($_POST["mollusc"] != '' ? '1' : '0'),
                                           'sesame' => ($_POST["sesame"] != '' ? '1' : '0'),
                                           'lupin' => ($_POST["lupin"] != '' ? '1' : '0'),
                                           'soy' => ($_POST["soy"] != '' ? '1' : '0'),
                                           'peanut' => ($_POST["peanut"] != '' ? '1' : '0'),
                                           'wheat' => ($_POST["wheat"] != '' ? '1' : '0'),
                                           'barley' => ($_POST["barley"] != '' ? '1' : '0'),
                                           'oats' => ($_POST["oats"] != '' ? '1' : '0'),
                                           'rye' => ($_POST["rye"] != '' ? '1' : '0'),
                                           'gluten' => ($_POST["gluten"] != '' ? '1' : '0'),
                                           'almond' => ($_POST["almond"] != '' ? '1' : '0'),
                                           'brazil_nut' => ($_POST["brazil_nut"] != '' ? '1' : '0'),
                                           'cashew' => ($_POST["cashew"] != '' ? '1' : '0'),
                                           'hazelnut' => ($_POST["hazelnut"] != '' ? '1' : '0'),
                                           'macadamia' => ($_POST["macadamia"] != '' ? '1' : '0'),
                                           'pecan' => ($_POST["pecan"] != '' ? '1' : '0'),
                                           'pine_nut' => ($_POST["pine_nut"] != '' ? '1' : '0'),
                                           'pistachio' => ($_POST["pistachio"] != '' ? '1' : '0'),
                                           'walnut' => ($_POST["walnut"] != '' ? '1' : '0')
                                        
                                 );
                              
                    
        	$allergens= serialize($allergens_data); 
		    $data=array(
		    'recipe_type' => $recipe_type,
			'recipe_name' => $this->input->post('recipe_name'),
// 			'recipe_image' => $recipe_file_name,
			'serving_size_id' => $this->input->post('serving_size_id'),
			'ingredients' => $ingredients,
			'recipe_method' => $this->input->post('recipe_method'),
			'allergens' => $allergens,
			'branch_id' => $branch_id,
			'status' => '1'
			);
			if($recipe_file_name != ''){
    			   $data['recipe_image'] = $recipe_file_name;
    			}
// 			echo "<pre>";print_r($data);exit;
		    $insert_id = $this->menucard_model->addRecipe($data);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Recipe has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Recipe');
			}
		    }
		    redirect('menucard/viewRecipes/'.$recipe_type);
		}else{
			 $menu_items  = display_menu();
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('menucard/addRecipe');
			$this->load->view('general/footer');
		}
      }
	}
	public function editRecipe($id){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');
			
			$menu_items  = display_menu();
			
		    $ServingSize = $this->menucard_model->getServingSizes($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		    
		    $recipe_type='';
			$recipe = $this->menucard_model->getAllRecipes($branch_id,$recipe_type,$id);
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    $data['ingredients']=$ingredients;
		  //  echo "<pre>";print_r($ingredients);exit;
		  $allergens=unserialize($recipe[0]->allergens);
		    $data['allergens']=$allergens;
		  
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		if($recipe_type=="hotfood"){
    		 $data['heading']  = "Edit Hotfood"; 
    		 $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "salad"){
    		    $data['heading']  = "Edit Salad"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		    
    		}
    		else if($recipe_type == "coldfood"){
    		    $data['heading']  = "Edit Cold Food"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "sweets"){
    		    $data['heading']  = "Edit Sweets"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
   
    		else{
    		 $data['heading']  = "Edit Recipe";  
    		  $data['form_type'] = 'recipe_without_allergens';
    		}
		  
		  
		   $data['form_name'] = 'edit';
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/addRecipe',$data);
				$this->load->view('general/footer');
		}
	}
	
		public function recreateRecipe($id){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');
			
			$menu_items  = display_menu();
			
		    $ServingSize = $this->menucard_model->getServingSizes($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		    
		    $recipe_type='';
			$recipe = $this->menucard_model->getAllRecipes($branch_id,$recipe_type,$id);
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    
		    $data['ingredients']=$ingredients;
		  //  echo "<pre>";print_r($ingredients);exit;
		  
		  $allergens=unserialize($recipe[0]->allergens);
		    $data['allergens']=$allergens;
		    
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		if($recipe_type=="hotfood"){
    		 $data['heading']  = "Recreate Hotfood"; 
    		 $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "salad"){
    		    $data['heading']  = "Recreate Salad"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		    
    		}
    		else if($recipe_type == "coldfood"){
    		    $data['heading']  = "Recreate Cold Food"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "sweets"){
    		    $data['heading']  = "Recreate Sweets"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
   
    		else{
    		 $data['heading']  = "Recreate Recipe";  
    		  $data['form_type'] = 'recipe_without_allergens';
    		}
    		
		  $data['form_name'] = 'recreate';
		        $hdata['menus'] = $menu_items;
		      //   echo "<pre>";print_r($data);exit;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/addRecipe',$data);
				$this->load->view('general/footer');
		}
	}
	
	public function viewRecipe($id){
    
 
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			$type = $this->session->userdata('role');
			
			$menu_items  = display_menu();
			
		    $ServingSize = $this->menucard_model->getServingSizes($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		    
		    $recipe_type='';
			$recipe = $this->menucard_model->getAllRecipes($branch_id,$recipe_type,$id);
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    
		    $data['ingredients']=$ingredients;
		  //  echo "<pre>";print_r($ingredients);exit;
		  
		  $allergens=unserialize($recipe[0]->allergens);
		    $data['allergens']=$allergens;
		    
		    
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		if($recipe_type=="hotfood"){
    		 $data['heading']  = "Hotfood"; 
    		 $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "salad"){
    		    $data['heading']  = "Salad"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		    
    		}
    		else if($recipe_type == "coldfood"){
    		    $data['heading']  = "Cold Food"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
    		else if($recipe_type == "sweets"){
    		    $data['heading']  = "Sweets"; 
    		    $data['form_type'] = 'recipe_with_allergens';
    		}
   
    		else{
    		 $data['heading']  = "Recipe";  
    		  $data['form_type'] = 'recipe_without_allergens';
    		}
    		
    		
		  $data['form_name'] = 'view';
		        $hdata['menus'] = $menu_items;
		      //  echo "<pre>";print_r($data);exit;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('menucard/addRecipe',$data);
				$this->load->view('general/footer');
		}
	}
	
	 public function record_delete(){
	   
        $id = $this->input->post('id');
        
          $tablename = $this->input->post('tablename');
          
      $res = $this->menucard_model->record_delete($id,$tablename);
         if($res){
             echo "deleted";
         }
         else{
             echo "error";
         }
    }
    
	public function fetchMenu(){
	   
	        $menuPlannerID = $this->input->post('menuPlannerID');
	    	$branch_id = $this->session->userdata('branch_id');
	        $menuPlanner = $this->menuplanner_model->getMenuPlannerData($branch_id,$menuPlannerID);
		    
		    echo json_encode(($menuPlanner), true);
	}


	
     public function filterForm() {
      
			$branch_id = $this->session->userdata('branch_id');
			
			$filter = array();
			
		    if(isset($_POST['recipe_name']) && $_POST['recipe_name']!=''){
        	    $filter['recipe_name'] =  $_POST['recipe_name'];
        	}
        	else{
        	    $filter['recipe_name']='';
        	}
        
        	 
        	 
        	 if(isset($_POST['recipe_type']) && $_POST['recipe_type']!=''){
        	    $recipe_type=  $_POST['recipe_type'];
        	}
        	$tempFormList = $this->menucard_model->filterFormList($branch_id,$filter,$recipe_type);
// 			$data['table_name'] = $table_name;
        	
        // 	echo "<pre>";print_r($filter);
        
			$html = '';
			if(!empty($tempFormList)){
			   
			   foreach($tempFormList as $row){
			       
			       if($row->status == '1'){ $status='Active'; }else{  $status='Deactive'; }
			       
        			    
        					$html.= '<tr>
                               <td class="recipename">'.$row->recipe_name.'</td>
                                <td class="status">'.$status.'</td>
                                <td><a class="btn btn-success" href="'.base_url(). 'index.php/menucard/recreateRecipe/'. $row->haacp_recipe_id . '/">Recreate</a></td>
                                
                                <td>
                                    <ul class="list-inline hstack gap-2 mb-0">
                                       
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                            <a class="text-success d-inline-block edit-item-btn" href="'.base_url().'index.php/menucard/viewRecipe/'.$row->haacp_recipe_id.'">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                            <a class="text-success d-inline-block edit-item-btn" href="'.base_url(). 'index.php/menucard/editRecipe/' . $row->haacp_recipe_id .'/edit/">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                            <a class="text-danger d-inline-block remove-item-btn" data-rel-id="'.$row->haacp_recipe_id.'" href="javascript:void(0)">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>';
    			    }
			    
			    
			}
			else{
			    $html.='<tr><td colspan="4">No Record Found</td></tr>';
			}
		echo $html;   
    }
}