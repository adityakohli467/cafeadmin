<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Forms extends CI_Controller {

function __construct() { 
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('menuitems');
		$this->load->model('Forms_model');
		$this->load->model('menucard_model');
		$this->load->model('Ion_auth_model');
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
    }
    public function prepArea($table_name='haccap_cold_form'){
        if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	
             $type = $this->session->userdata('role');
            if($type == 'Prep Area'){
                
                $preparea = $this->Forms_model->getPrepAreas($this->session->userdata('user_email'),$branch_id);
                // echo $this->db->last_query();exit;
                // echo "<pre>";print_r($preparea);exit;
                $this->session->set_userdata('formPrepArea', $preparea[0]->prep_area_id);
    // 			echo $this->session->userdata('formPrepArea');	exit;
    			$this->session->set_userdata('prepAreaName', $preparea[0]->prep_area_name);
                redirect('forms/TempFormList/'.$table_name);
            }
            else{
    			$menu_items  = display_menu();
    			
    			$prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'1','');
    			
    			$tablesRecord = $this->Forms_model->getAllForms($table_name);
    			foreach($prepArea as $row){
    			    $table_ids = unserialize($row->prep_area_table);
    			    if(in_array($tablesRecord[0]->haccap_table_id,$table_ids)){
    			        $prepAreas[] = array(
    			            'prep_area_id'=> $row->prep_area_id,
    			            'prep_area_name'=> $row->prep_area_name,
    			        );
    			    }
    			}
    			if(!empty($prepAreas)){
    		    $data['prepArea'] = $prepAreas;  
    		    $hdata['menus'] = $menu_items;
    		        $data['table_name'] = $table_name;  
        		    
        		      // echo "<pre>";print_r($data);exit;
        			$this->load->view('general/header_general',$hdata);
        			$this->load->view('forms/prepArea',$data);
        			$this->load->view('general/footer');
    		   
    			}else{
    			     $this->session->unset_userdata('formPrepArea');
    			     $this->session->unset_userdata('prepAreaName');
    			     if($table_name == 'form1'){
    		            redirect('boh/form1');
        		    }else if($table_name == 'form11'){
        		         redirect('boh/form11');
        		    }else{
    			        redirect('forms/TempFormList/'.$table_name);
        		    }
    			}
            }
		}
    }
    public function prepAreaForm($id,$table_name){
        
		$branch_id = $this->session->userdata('branch_id');	
        $this->session->set_userdata('formPrepArea', $id);
		$prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'1',$id);
		$this->session->set_userdata('prepAreaName', $prepArea[0]->prep_area_name);
		if($table_name == 'form1'){
	        redirect('boh/form1');
	    }else if($table_name == 'form11'){
	         redirect('boh/form11');
	    }else{
		    redirect('forms/TempFormList/'.$table_name);
	    }
    }
public function temperature_form($table_name){
        
        if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');
			 
			$type = $this->session->userdata('role');;	
			$menu_items  = display_menu();
    		$data['table_name']  = $table_name;
    		if($table_name=="haccap_temp_form"){
    		 $data['heading']  = "Temperature Forms";   
    		}
    		else if($table_name == "haccap_dishwashing_form"){
    		    $data['heading']  = "Dishwasher Washing and Rinse Temperature Records"; 
    		    
    		}
    		else if($table_name == "haccap_retention_stock_form"){
    		    $data['heading']  = "Retention Stock Form"; 
    		}
    		else if($table_name == "haccap_production_record_time"){
    		    $data['heading']  = "Production Cooking & Chilling Time & Temperature Record Sheet"; 
    		}
    		else if($table_name == "haccap_calibration_form"){
    		    $data['heading']  = "CALIBRATION / SERVICE & RESULTS"; 
    		}
    		else if($table_name == "haccap_food_wastage_report"){
    		    $data['heading']  = "Food Wastage Report"; 
    		}
    		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
    		    $data['heading']  = "Kitchen Operational Closedown Checklist"; 
    		}
    		else if($table_name == "haccap_operational_incident_report"){
    		    $data['heading']  = "OPERATIONAL INCIDENT REPORT AND CORRECTIVE ACTION RECORD"; 
    		}
            else if($table_name == "haccap_mockrecall_record"){
                $data['heading']  = "Mockrecall RECORD"; 
            }
            else if($table_name == "haccap_training_record"){
                $data['heading']  = "Training RECORD";
                
            }
            else if($table_name == "food_allergen_menu"){
                $data['heading']  = "Food Allergen Menu"; 
            }
            else if($table_name == "haccap_food_transfer_and_order_record"){
                $data['heading']  = "Food Transfer & Order Record"; 
            }
    		else{
    		 $data['heading']  = "Opening and closing procedure";   
    		}
    		
		        $hdata['menus'] = $menu_items;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('forms/temperature_form',$data);
				$this->load->view('general/footer');
		}
    }
public function submit_temperature_form($table_name){
    
         $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
        //  echo "<pre>";print_r($_POST);exit;
         
         if($table_name=="haccap_temp_form"){
                foreach($weekdays as $title => $weekday_name) {
                         for($i=0;$i<sizeof($_POST[$title."_equipname"]); $i++){
                             if($_POST[$title."_equipname"][$i] !=''){
                             $tempData[$weekday_name][$i] = array(
                                 $title."_equipname" =>$_POST[$title."_equipname"][$i],
                                 $title."_AM_time" =>$_POST[$title."_AM_time"][$i],
                                 $title."_AM_temp" =>$_POST[$title."_AM_temp"][$i],
                                 $title."_PM_time" =>$_POST[$title."_PM_time"][$i],
                                 $title."_PM_temp" =>$_POST[$title."_PM_temp"][$i],
                                 $title."_entered_by" =>$_POST[$title."_entered_by"][$i]
                                 );
                             }
                         }
                }
         }
         
         else if($table_name == "haccap_cold_form"){
             for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                         if($_POST["product_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_AM_time" => $_POST["mon_AM_time"][$i],
                             "mon_PM_time" => $_POST["mon_PM_time"][$i],
                             "tue_AM_time" =>$_POST["tue_AM_time"][$i],
                             "tue_PM_time" =>$_POST["tue_PM_time"][$i],
                             "wed_AM_time" =>$_POST["wed_AM_time"][$i],
                             "wed_PM_time" =>$_POST["wed_PM_time"][$i],
                             "thu_AM_time" =>$_POST["thu_AM_time"][$i],
                             "thu_PM_time" =>$_POST["thu_PM_time"][$i],
                             "fri_AM_time" =>$_POST["fri_AM_time"][$i],
                             "fri_PM_time" =>$_POST["fri_PM_time"][$i],
                             "sat_AM_time" =>$_POST["sat_AM_time"][$i],
                             "sat_PM_time" =>$_POST["sat_PM_time"][$i],
                             "sun_AM_time" =>$_POST["sun_AM_time"][$i],
                             "sun_PM_time" =>$_POST["sun_PM_time"][$i],
                             "entered_by" =>$_POST["entered_by"][$i],
                             "signature" =>$_POST["signature"][$i],
                             );
                         }
                        
                     } 
                     $tempData['mon_data']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }else if($table_name == "haccap_retention_stock_form"){
             for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                         if($_POST["product_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_AM_time" => $_POST["mon_AM_time"][$i],
                             "mon_PM_time" => $_POST["mon_PM_time"][$i],
                             "mon_temp" => $_POST["mon_temp"][$i],
                             "tue_AM_time" =>$_POST["tue_AM_time"][$i],
                             "tue_PM_time" =>$_POST["tue_PM_time"][$i],
                             "tue_temp" =>$_POST["tue_temp"][$i],
                             "wed_AM_time" =>$_POST["wed_AM_time"][$i],
                             "wed_PM_time" =>$_POST["wed_PM_time"][$i],
                             "wed_temp" =>$_POST["wed_temp"][$i],
                             "thu_AM_time" =>$_POST["thu_AM_time"][$i],
                             "thu_PM_time" =>$_POST["thu_PM_time"][$i],
                             "thu_temp" =>$_POST["thu_temp"][$i],
                             "fri_AM_time" =>$_POST["fri_AM_time"][$i],
                             "fri_PM_time" =>$_POST["fri_PM_time"][$i],
                             "fri_temp" =>$_POST["fri_temp"][$i],
                             "sat_AM_time" =>$_POST["sat_AM_time"][$i],
                             "sat_PM_time" =>$_POST["sat_PM_time"][$i],
                             "sat_temp" =>$_POST["sat_temp"][$i],
                             "sun_AM_time" =>$_POST["sun_AM_time"][$i],
                             "sun_PM_time" =>$_POST["sun_PM_time"][$i],
                             "sun_temp" =>$_POST["sun_temp"][$i],
                             "entered_by" =>$_POST["entered_by"][$i],
                             "signature" =>$_POST["signature"][$i],
                             );
                         }
                        
                     } 
                     $tempData['mon_data']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }
         else if($table_name == "haccap_dishwashing_form"){
                 foreach($weekdays as $title => $weekday_name) {
                     for($i=0;$i<sizeof($_POST[$title."_name"]); $i++){
                         if($_POST[$title."_name"][$i] !=''){
                         $tempData[$weekday_name][$i] = array(
                             $title."_name" =>$_POST[$title."_name"][$i],
                             $title."_AM_time" =>$_POST[$title."_AM_time"][$i],
                             $title."_AM_field1" =>$_POST[$title."_AM_field1"][$i],
                             $title."_AM_field2" =>$_POST[$title."_AM_field2"][$i],
                             $title."_AM_field3" =>$_POST[$title."_AM_field3"][$i],
                             $title."_PM_time" =>$_POST[$title."_PM_time"][$i],
                             $title."_PM_field1" =>$_POST[$title."_PM_field1"][$i],
                             $title."_PM_field2" =>$_POST[$title."_PM_field2"][$i],
                             $title."_PM_field3" =>$_POST[$title."_PM_field3"][$i]
                             );
                         }
                     }
                 }
         }
         
          else if($table_name == "haccap_production_record_time"){
                 foreach($weekdays as $title => $weekday_name) {
                     for($i=0;$i<sizeof($_POST[$title."_name"]); $i++){
                         if($_POST[$title."_name"][$i] !=''){
                         $tempData[$weekday_name][$i] = array(
                             $title."_name" =>$_POST[$title."_name"][$i],
                             $title."_cooking_time" =>$_POST[$title."_cooking_time"][$i],
                             $title."_cooking_field1" =>$_POST[$title."_cooking_field1"][$i],
                             $title."_cooking_field2" =>$_POST[$title."_cooking_field2"][$i],
                             $title."_chilling_time" =>$_POST[$title."_chilling_time"][$i],
                            //  $title."_chilling_field1" =>$_POST[$title."_chilling_field1"][$i],
                             $title."_chilling_field2" =>$_POST[$title."_chilling_field2"][$i],
                             $title."_chilling_field3" =>$_POST[$title."_chilling_field3"][$i],
                             $title."_chilling_field4" =>$_POST[$title."_chilling_field4"][$i],
                             $title."_chilling_field5" =>$_POST[$title."_chilling_field5"][$i],
                             $title."_comments" =>$_POST[$title."_comments"][$i],
                             $title."_entered_by" =>$_POST[$title."_entered_by"][$i]
                             );
                         }
                     }
                 }
         }
          else if($table_name == "haccap_calibration_form"){
                 
                     for($i=0;$i<sizeof($_POST["caliberdate"]); $i++){
                         if($_POST["caliberdate"][$i] !=''){
                             
                         $formData[$_POST["name"][$i]] = array(
                             "caliberdate" =>$_POST["caliberdate"][$i],
                             "name" =>$_POST["name"][$i],
                             "hot" =>$_POST["hot"][$i],
                             "cold" =>$_POST["cold"][$i],
                             "difference" =>$_POST["difference"][$i],
                             "adjustment_required" =>$_POST["adjustment_required"][$i],
                             "final_result" =>$_POST["final_result"][$i],
                             "entered_by" =>$_POST["entered_by"][$i]
                             );
                         }
                     }
                    //  echo "<pre>";print_r($formData);exit;
                     $tempData['data_record']=serialize($formData);
                 
         }
         else if($table_name == "haccap_food_wastage_report"){
                $food_cost_wastage_amount = 0;
                     for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                         if($_POST["product_name"][$i] !=''){
                             $res = array($_POST["mon_field"][$i],$_POST["tue_field"][$i],$_POST["wed_field"][$i],$_POST["thu_field"][$i],$_POST["fri_field"][$i],$_POST["sat_field"][$i],$_POST["sun_field"][$i]);;
                             $total_no_of_units =  array_sum($res);
                             $total_wtd = $total_no_of_units * $_POST["price_per_unit"][$i];
                             
                         $weekly_product_wastage_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_field" => $_POST["mon_field"][$i],
                             "tue_field" =>$_POST["tue_field"][$i],
                             "wed_field" =>$_POST["wed_field"][$i],
                             "thu_field" =>$_POST["thu_field"][$i],
                             "fri_field" =>$_POST["fri_field"][$i],
                             "sat_field" =>$_POST["sat_field"][$i],
                             "sun_field" =>$_POST["sun_field"][$i],
                             "price_per_unit" =>$_POST["price_per_unit"][$i],
                             "total_no_units" =>$total_no_of_units,
                             "total_wtd" => $total_wtd,
                             "entered_by" =>$_POST["entered_by"][$i],
                             );
                         }
                         $food_cost_wastage_amount = $food_cost_wastage_amount  + $total_wtd;
                     }
        $tempData['food_cost_wastage_amount'] = $food_cost_wastage_amount;
        $tempData['product_wastage_data'] = serialize($weekly_product_wastage_record);
         }
         else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
             
                foreach($weekdays as $title => $weekday_name) {
                    
                        
                         $temp[$weekday_name] = array(
                             $title."_fridge_temp" =>isset($_POST[$title."_fridge_temp"])? '1' : '0',
                             $title."_dishwasher" =>isset($_POST[$title."_dishwasher"])? '1' : '0',
                             $title."_combi_oven" =>isset($_POST[$title."_combi_oven"])? '1' : '0',
                             $title."_cooktop_off" =>isset($_POST[$title."_cooktop_off"])? '1' : '0',
                             $title."_cooktop_washed" =>isset($_POST[$title."_cooktop_washed"])? '1' : '0',
                             $title."_hotplates" =>isset($_POST[$title."_hotplates"])? '1' : '0',
                             $title."_deep_fryers_off" =>isset($_POST[$title."_deep_fryers_off"])? '1' : '0',
                             $title."_dough_mixer_off" =>isset($_POST[$title."_dough_mixer_off"])? '1' : '0',
                             $title."_cool_room_off" =>isset($_POST[$title."_cool_room_off"])? '1' : '0',
                             $title."_chest_freeser_closed" =>isset($_POST[$title."_chest_freeser_closed"])? '1' : '0',
                             $title."_lights_off" =>isset($_POST[$title."_lights_off"])? '1' : '0',
                             $title."_exit_door_closed" =>isset($_POST[$title."_exit_door_closed"])? '1' : '0',
                             $title."_hot_boxes_washed" =>isset($_POST[$title."_hot_boxes_washed"])? '1' : '0',
                             $title."_mixer_off" =>isset($_POST[$title."_mixer_off"])? '1' : '0',
                             $title."_slicer_off" =>isset($_POST[$title."_slicer_off"])? '1' : '0',
                             $title."_benchtop_cleaned" =>isset($_POST[$title."_benchtop_cleaned"])? '1' : '0',
                             $title."_main_freezer_closed" =>isset($_POST[$title."_main_freezer_closed"])? '1' : '0',
                             $title."_wall_power_point_off" =>isset($_POST[$title."_wall_power_point_off"])? '1' : '0',
                             $title."_rubbish_bins_washed" =>isset($_POST[$title."_rubbish_bins_washed"])? '1' : '0',
                             $title."_kitchen_light_off" =>isset($_POST[$title."_kitchen_light_off"])? '1' : '0'
                             );
                             
                              $tempData[$title]=serialize($temp[$weekday_name]);
                         
                     
                 }
               
         }
         
         else if($table_name == "haccap_operational_incident_report"){
             
               
                         $tempData = array(
                             "correctiveaction" => $_POST['correctiveaction'],
                             "correctiveaction_date" => $_POST['correctiveaction_date'],
                             "correctiveaction_time" => $_POST['correctiveaction_time'],
                             "reason_for_non_conformance" => $_POST['reason_for_non_conformance'],
                             "organisation" => $_POST['organisation'],
                             "name_of_contact_person" => $_POST['name_of_contact_person'],
                             "contact_of_contact_person" => $_POST['contact_of_contact_person'],
                             "report" => $_POST['report'],
                             "reply_to" => $_POST['reply_to'],
                             "reply_to_date" => $_POST['reply_to_date'],
                             "incident_date" => $_POST['incident_date'],
                             "description_of_non_conformance" => $_POST['description_of_non_conformance'],
                             "detailed_description_of_event" => $_POST['detailed_description_of_event'],
                             "classification" => $_POST['classification'],
                             "reason_of_occurance" => $_POST['reason_of_occurance'],
                             "date_corrective_action_taken" => $_POST['date_corrective_action_taken'],
                             "verified_by" => $_POST['verified_by'],
                             "results" => $_POST['results'],
                             "satisfactory" => $_POST['satisfactory'],
                             "unsatisfactory" => $_POST['unsatisfactory'],
                             "followup" => $_POST['followup'],
                             "signed_by" => $_POST['signed_by']
                             
                             );
                             
               
         }
          else if($table_name == "haccap_mockrecall_record"){
             
                 $tempData = array(
                         "date_initiated" => $_POST['date_initiated'],
                         "time_initiated" => $_POST['time_initiated'],
                         "date_completed" => $_POST['date_completed'],
                         "time_completed" => $_POST['time_completed'],
                         "description_of_product" => $_POST['description_of_product'],
                         "description_of_scenario" => $_POST['description_of_scenario'],
                         "completed_by" => $_POST['completed_by'],
                         "completed_by_date" => $_POST['completed_by_date'],
                         "completed_by_time" => $_POST['completed_by_time'],
                         "reviewed_by" => $_POST['reviewed_by'],
                         "reviewed_by_date" => $_POST['reviewed_by_date'],
                         "reviewed_by_time" => $_POST['reviewed_by_time']
                         );
         }
          else if($table_name == "haccap_food_transfer_and_order_record"){
             for($i=0;$i<sizeof($_POST["item_name"]); $i++){
                         if($_POST["item_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["item_name"][$i]] = array(
                             "item_date" =>$_POST["item_date"][$i],
                             "item_name" =>$_POST["item_name"][$i],
                             "item_price" => $_POST["item_price"][$i],
                             "item_temp_loading" => $_POST["item_temp_loading"][$i],
                             "item_temp_unloading" =>$_POST["item_temp_unloading"][$i],
                             "item_delivery_location" =>$_POST["item_delivery_location"][$i],
                             "item_received_by" =>$_POST["item_received_by"][$i],
                             "item_deliver_by" =>$_POST["item_deliver_by"][$i],
                            
                             );
                         }
                        
                     } 
                     $tempData['data_record']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }
         else if($table_name == "haccap_training_record"){
                for($j=0;$j<sizeof($_POST["skill_name"]); $j++){
                    $training_records=array();
                        // $emp=$_POST["emp"][$j];
                         for($i=0;$i<sizeof($_POST["skill_name"]); $i++){
                             if($_POST["skill_name"][$i] !=''){
                                $training_records[$i] = array(
                                 "skill_name" =>$_POST["skill_name"][$i],
                                 "required_skill_level" =>$_POST["required_skill_level"][$i],
                                 "current_capability" =>$_POST["current_capability"][$i],
                                 "future_training_required" =>$_POST["future_training_required"][$i]
                                 );
                             }
                         }
                        //  $training = serialize($training_records);
                        //  $rec[$j] = array(
                        //      'role'   => $_POST["role"][$j],
                        //      'emp'   => $emp,
                        //      'training_record' => $training
                        //      );
                            
                }
                
                $tempData['training_record']=serialize($training_records);
                //  echo "<pre>";print_r($training_records);exit;
         }
         else{
             
         }
         if($table_name != "haccap_food_wastage_report" && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record" && $table_name != "haccap_calibration_form"){
         foreach($tempData as $temp => $tempDatavalue) {
             $tempData[$temp] = serialize($tempDatavalue);
         }
         }
        if(isset($_POST['cafe_name'])){ $tempData['cafe_name'] = $_POST['cafe_name']; }
        if(isset($_POST['prep_name'])){ $tempData['prep_name'] = $_POST['prep_name']; }
        if(isset($_POST['verified_by'])){ $tempData['verified_by'] = $_POST['verified_by']; }
        if(isset($_POST['sign_by'])){ $tempData['sign_by'] = $_POST['sign_by']; }
        if(isset($_POST['document_record_number'])){ $tempData['document_record_number'] = $_POST['document_record_number']; }
        if(isset($_POST['role'])){ $tempData['role'] = $_POST['role']; }
        if(isset($_POST['emp'])){ $tempData['emp'] = $_POST['emp']; }
        if(isset($_POST['start_date'])){ $tempData['start_date'] = date('Y-m-d', strtotime($_POST['start_date'])); }
        if(isset($_POST['end_date'])){ $tempData['end_date'] = date('Y-m-d', strtotime($_POST['end_date'])); }
         if(isset($_POST['date'])){ $tempData['date'] = date('Y-m-d', strtotime($_POST['date'])); }
         if(isset($_POST['form_note'])){ $tempData['form_note'] = $_POST['form_note']; }
         if(isset($_POST['form_comment'])){ $tempData['form_comment'] = $_POST['form_comment']; }
        $tempData['branch_id'] = $this->session->userdata('branch_id');
        
        // if($table_name == "haccap_calibration_form"){
        //      echo "<pre>";print_r($tempData);exit;
        // }
         $insert_id = $this->Forms_model->add($tempData,$table_name);
   
//   echo $this->db->last_query();exit;
			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Form has been sucessfully saved');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the data');
			}
         redirect('forms/TempFormList/'.$table_name);
         
     }
public function update_temperature_form($table_name){
    // echo "<pre>";print_r($_POST);exit;
         $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
        
       
         if($table_name=="haccap_temp_form"){
         foreach($weekdays as $title => $weekday_name) {
             for($i=0;$i<sizeof($_POST[$title."_equipname"]); $i++){
                 if($_POST[$title."_equipname"][$i] !=''){
                 $tempData[$weekday_name][$i] = array(
                     $title."_equipname" =>$_POST[$title."_equipname"][$i],
                     $title."_AM_time" =>$_POST[$title."_AM_time"][$i],
                     $title."_AM_temp" =>$_POST[$title."_AM_temp"][$i],
                     $title."_PM_time" =>$_POST[$title."_PM_time"][$i],
                     $title."_PM_temp" =>$_POST[$title."_PM_temp"][$i],
                     $title."_entered_by" =>$_POST[$title."_entered_by"][$i]
                     );
                 }
             }
         }
         }
         else if($table_name == "haccap_cold_form"){
            // echo "<pre>";print_r($_POST);exit;
             for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                 
                         if($_POST["product_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_AM_time" => $_POST["mon_AM_time"][$i],
                             "mon_PM_time" => $_POST["mon_PM_time"][$i],
                             "tue_AM_time" =>$_POST["tue_AM_time"][$i],
                             "tue_PM_time" =>$_POST["tue_PM_time"][$i],
                             "wed_AM_time" =>$_POST["wed_AM_time"][$i],
                             "wed_PM_time" =>$_POST["wed_PM_time"][$i],
                             "thu_AM_time" =>$_POST["thu_AM_time"][$i],
                             "thu_PM_time" =>$_POST["thu_PM_time"][$i],
                             "fri_AM_time" =>$_POST["fri_AM_time"][$i],
                             "fri_PM_time" =>$_POST["fri_PM_time"][$i],
                             "sat_AM_time" =>$_POST["sat_AM_time"][$i],
                             "sat_PM_time" =>$_POST["sat_PM_time"][$i],
                             "sun_AM_time" =>$_POST["sun_AM_time"][$i],
                             "sun_PM_time" =>$_POST["sun_PM_time"][$i],
                             "entered_by" =>$_POST["entered_by"][$i],
                             "signature" =>$_POST["signature"][$i],
                             );
                         }
                        
                     } 
                     $tempData['mon_data']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }else if($table_name == "haccap_retention_stock_form"){
            // echo "<pre>";print_r($_POST);exit;
             for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                 
                         if($_POST["product_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_AM_time" => $_POST["mon_AM_time"][$i],
                             "mon_PM_time" => $_POST["mon_PM_time"][$i],
                             "mon_temp" => $_POST["mon_temp"][$i],
                             "tue_AM_time" =>$_POST["tue_AM_time"][$i],
                             "tue_PM_time" =>$_POST["tue_PM_time"][$i],
                             "tue_temp" =>$_POST["tue_temp"][$i],
                             "wed_AM_time" =>$_POST["wed_AM_time"][$i],
                             "wed_PM_time" =>$_POST["wed_PM_time"][$i],
                             "wed_temp" =>$_POST["wed_temp"][$i],
                             "thu_AM_time" =>$_POST["thu_AM_time"][$i],
                             "thu_PM_time" =>$_POST["thu_PM_time"][$i],
                             "thu_temp" =>$_POST["thu_temp"][$i],
                             "fri_AM_time" =>$_POST["fri_AM_time"][$i],
                             "fri_PM_time" =>$_POST["fri_PM_time"][$i],
                             "fri_temp" =>$_POST["fri_temp"][$i],
                             "sat_AM_time" =>$_POST["sat_AM_time"][$i],
                             "sat_PM_time" =>$_POST["sat_PM_time"][$i],
                             "sat_temp" =>$_POST["sat_temp"][$i],
                             "sun_AM_time" =>$_POST["sun_AM_time"][$i],
                             "sun_PM_time" =>$_POST["sun_PM_time"][$i],
                             "sun_temp" =>$_POST["sun_temp"][$i],
                             "entered_by" =>$_POST["entered_by"][$i],
                             "signature" =>$_POST["signature"][$i],
                             );
                         }
                        
                     } 
                     $tempData['mon_data']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }
         else if($table_name == "haccap_calibration_form"){
                 
                     for($i=0;$i<sizeof($_POST["caliberdate"]); $i++){
                         if($_POST["caliberdate"][$i] !=''){
                             
                         $formData[$_POST["name"][$i]] = array(
                             "caliberdate" =>$_POST["caliberdate"][$i],
                             "name" =>$_POST["name"][$i],
                             "hot" =>$_POST["hot"][$i],
                             "cold" =>$_POST["cold"][$i],
                             "difference" =>$_POST["difference"][$i],
                             "adjustment_required" =>$_POST["adjustment_required"][$i],
                             "final_result" =>$_POST["final_result"][$i],
                             "entered_by" =>$_POST["entered_by"][$i]
                             );
                         }
                     }
                    //  echo "<pre>";print_r($formData);exit;
                     $tempData['data_record']=serialize($formData);
                 
         }
          else if($table_name == "haccap_dishwashing_form"){
              
                 foreach($weekdays as $title => $weekday_name) {
                     for($i=0;$i<sizeof($_POST[$title."_name"]); $i++){
                         if($_POST[$title."_name"][$i] !=''){
                         $tempData[$weekday_name][$i] = array(
                             $title."_name" =>$_POST[$title."_name"][$i],
                             $title."_AM_time" =>$_POST[$title."_AM_time"][$i],
                             $title."_AM_field1" =>$_POST[$title."_AM_field1"][$i],
                             $title."_AM_field2" =>$_POST[$title."_AM_field2"][$i],
                             $title."_AM_field3" =>$_POST[$title."_AM_field3"][$i],
                             $title."_PM_time" =>$_POST[$title."_PM_time"][$i],
                             $title."_PM_field1" =>$_POST[$title."_PM_field1"][$i],
                             $title."_PM_field2" =>$_POST[$title."_PM_field2"][$i],
                             $title."_PM_field3" =>$_POST[$title."_PM_field3"][$i]
                             );
                         }
                     }
                 }
                //   echo "<pre>";print_r($_POST);exit;
         }
        //   else if($table_name == "haccap_retention_stock_form"){
        //          foreach($weekdays as $title => $weekday_name) {
        //              for($i=0;$i<sizeof($_POST[$title."_name"]); $i++){
        //                  if($_POST[$title."_name"][$i] !=''){
        //                  $tempData[$weekday_name][$i] = array(
        //                      $title."_name" =>$_POST[$title."_name"][$i],
        //                      $title."_AM_time" =>$_POST[$title."_AM_time"][$i],
        //                      $title."_AM_temp" =>$_POST[$title."_AM_temp"][$i],
        //                      $title."_entered_by" =>$_POST[$title."_entered_by"][$i]
        //                      );
        //                  }
        //              }
        //          }
        //  }
          else if($table_name == "haccap_production_record_time"){
                 foreach($weekdays as $title => $weekday_name) {
                     for($i=0;$i<sizeof($_POST[$title."_name"]); $i++){
                         if($_POST[$title."_name"][$i] !=''){
                         $tempData[$weekday_name][$i] = array(
                             $title."_name" =>$_POST[$title."_name"][$i],
                             $title."_cooking_time" =>$_POST[$title."_cooking_time"][$i],
                             $title."_cooking_field1" =>$_POST[$title."_cooking_field1"][$i],
                             $title."_cooking_field2" =>$_POST[$title."_cooking_field2"][$i],
                             $title."_chilling_time" =>$_POST[$title."_chilling_time"][$i],
                            //  $title."_chilling_field1" =>$_POST[$title."_chilling_field1"][$i],
                             $title."_chilling_field2" =>$_POST[$title."_chilling_field2"][$i],
                             $title."_chilling_field3" =>$_POST[$title."_chilling_field3"][$i],
                             $title."_chilling_field4" =>$_POST[$title."_chilling_field4"][$i],
                             $title."_chilling_field5" =>$_POST[$title."_chilling_field5"][$i],
                             $title."_comments" =>$_POST[$title."_comments"][$i],
                             $title."_entered_by" =>$_POST[$title."_entered_by"][$i]
                             );
                         }
                     }
                 }
         }
         
         else if($table_name == "haccap_food_wastage_report"){
            //   echo "<pre>"; print_r($_POST); exit;
                $food_cost_wastage_amount = 0;
                     for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                         if($_POST["product_name"][$i] !=''){
                             $res = array($_POST["mon_field"][$i],$_POST["tue_field"][$i],$_POST["wed_field"][$i],$_POST["thu_field"][$i],$_POST["fri_field"][$i],$_POST["sat_field"][$i],$_POST["sun_field"][$i]);;
                             $total_no_of_units =  array_sum($res);
                             $price_per_unit = floatval(ltrim($_POST["price_per_unit"][$i], '$'));
                             $total_wtd = $total_no_of_units * $price_per_unit;
                             
                         $weekly_product_wastage_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_field" => $_POST["mon_field"][$i],
                             "tue_field" =>$_POST["tue_field"][$i],
                             "wed_field" =>$_POST["wed_field"][$i],
                             "thu_field" =>$_POST["thu_field"][$i],
                             "fri_field" =>$_POST["fri_field"][$i],
                             "sat_field" =>$_POST["sat_field"][$i],
                             "sun_field" =>$_POST["sun_field"][$i],
                             "price_per_unit" =>$price_per_unit,
                             "total_no_units" =>$total_no_of_units,
                             "total_wtd" => $total_wtd,
                             "entered_by" =>$_POST["entered_by"][$i],
                             );
                         }
                         $food_cost_wastage_amount = $food_cost_wastage_amount  + $total_wtd;
                     }
                        //  echo "<pre>"; print_r($weekly_product_wastage_record); exit;
        $tempData['food_cost_wastage_amount'] = $food_cost_wastage_amount;
        $tempData['product_wastage_data'] = serialize($weekly_product_wastage_record);
         }
          else if($table_name == "haccap_food_wastage_report"){
                $food_cost_wastage_amount = 0;
                     for($i=0;$i<sizeof($_POST["product_name"]); $i++){
                         if($_POST["product_name"][$i] !=''){
                             $res = array($_POST["mon_field"][$i],$_POST["tue_field"][$i],$_POST["wed_field"][$i],$_POST["thu_field"][$i],$_POST["fri_field"][$i],$_POST["sat_field"][$i],$_POST["sun_field"][$i]);;
                             $total_no_of_units =  array_sum($res);
                             $total_wtd = $total_no_of_units * $_POST["price_per_unit"][$i];
                             
                         $weekly_product_wastage_record[$_POST["product_name"][$i]] = array(
                             "product_name" =>$_POST["product_name"][$i],
                             "mon_field" => $_POST["mon_field"][$i],
                             "tue_field" =>$_POST["tue_field"][$i],
                             "wed_field" =>$_POST["wed_field"][$i],
                             "thu_field" =>$_POST["thu_field"][$i],
                             "fri_field" =>$_POST["fri_field"][$i],
                             "sat_field" =>$_POST["sat_field"][$i],
                             "sun_field" =>$_POST["sun_field"][$i],
                             "price_per_unit" =>$_POST["price_per_unit"][$i],
                             "total_no_units" =>$total_no_of_units,
                             "total_wtd" => $total_wtd,
                             "entered_by" =>$_POST["entered_by"][$i],
                             );
                         }
                         $food_cost_wastage_amount = $food_cost_wastage_amount  + $total_wtd;
                     }
        $tempData['food_cost_wastage_amount'] = $food_cost_wastage_amount;
        $tempData['product_wastage_data'] = serialize($weekly_product_wastage_record);
         }
         else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
             
                foreach($weekdays as $title => $weekday_name) {
                    
                        
                         $temp[$weekday_name] = array(
                             $title."_fridge_temp" =>isset($_POST[$title."_fridge_temp"])? '1' : '0',
                             $title."_dishwasher" =>isset($_POST[$title."_dishwasher"])? '1' : '0',
                             $title."_combi_oven" =>isset($_POST[$title."_combi_oven"])? '1' : '0',
                             $title."_cooktop_off" =>isset($_POST[$title."_cooktop_off"])? '1' : '0',
                             $title."_cooktop_washed" =>isset($_POST[$title."_cooktop_washed"])? '1' : '0',
                             $title."_hotplates" =>isset($_POST[$title."_hotplates"])? '1' : '0',
                             $title."_deep_fryers_off" =>isset($_POST[$title."_deep_fryers_off"])? '1' : '0',
                             $title."_dough_mixer_off" =>isset($_POST[$title."_dough_mixer_off"])? '1' : '0',
                             $title."_cool_room_off" =>isset($_POST[$title."_cool_room_off"])? '1' : '0',
                             $title."_chest_freeser_closed" =>isset($_POST[$title."_chest_freeser_closed"])? '1' : '0',
                             $title."_lights_off" =>isset($_POST[$title."_lights_off"])? '1' : '0',
                             $title."_exit_door_closed" =>isset($_POST[$title."_exit_door_closed"])? '1' : '0',
                             $title."_hot_boxes_washed" =>isset($_POST[$title."_hot_boxes_washed"])? '1' : '0',
                             $title."_mixer_off" =>isset($_POST[$title."_mixer_off"])? '1' : '0',
                             $title."_slicer_off" =>isset($_POST[$title."_slicer_off"])? '1' : '0',
                             $title."_benchtop_cleaned" =>isset($_POST[$title."_benchtop_cleaned"])? '1' : '0',
                             $title."_main_freezer_closed" =>isset($_POST[$title."_main_freezer_closed"])? '1' : '0',
                             $title."_wall_power_point_off" =>isset($_POST[$title."_wall_power_point_off"])? '1' : '0',
                             $title."_rubbish_bins_washed" =>isset($_POST[$title."_rubbish_bins_washed"])? '1' : '0',
                             $title."_kitchen_light_off" =>isset($_POST[$title."_kitchen_light_off"])? '1' : '0'
                             );
                             
                              $tempData[$title]=serialize($temp[$weekday_name]);
                         
                     
                 }
               
         }
         else if($table_name == "haccap_operational_incident_report"){
             
               
                         $tempData = array(
                             "correctiveaction" => $_POST['correctiveaction'],
                             "correctiveaction_date" => $_POST['correctiveaction_date'],
                             "correctiveaction_time" => $_POST['correctiveaction_time'],
                             "reason_for_non_conformance" => $_POST['reason_for_non_conformance'],
                             "organisation" => $_POST['organisation'],
                             "name_of_contact_person" => $_POST['name_of_contact_person'],
                             "contact_of_contact_person" => $_POST['contact_of_contact_person'],
                             "report" => $_POST['report'],
                             "reply_to" => $_POST['reply_to'],
                             "reply_to_date" => $_POST['reply_to_date'],
                             "incident_date" => $_POST['incident_date'],
                             "description_of_non_conformance" => $_POST['description_of_non_conformance'],
                             "detailed_description_of_event" => $_POST['detailed_description_of_event'],
                             "classification" => $_POST['classification'],
                             "reason_of_occurance" => $_POST['reason_of_occurance'],
                             "date_corrective_action_taken" => $_POST['date_corrective_action_taken'],
                             "verified_by" => $_POST['verified_by'],
                             "results" => $_POST['results'],
                             "satisfactory" => $_POST['satisfactory'],
                             "unsatisfactory" => $_POST['unsatisfactory'],
                             "followup" => $_POST['followup'],
                             "signed_by" => $_POST['signed_by']
                             
                             );
                             
                              
                     
               
         }
         else if($table_name == "haccap_mockrecall_record"){
             
                 $tempData = array(
                         "date_initiated" => $_POST['date_initiated'],
                         "time_initiated" => $_POST['time_initiated'],
                         "date_completed" => $_POST['date_completed'],
                         "time_completed" => $_POST['time_completed'],
                         "description_of_product" => $_POST['description_of_product'],
                         "description_of_scenario" => $_POST['description_of_scenario'],
                         "completed_by" => $_POST['completed_by'],
                         "completed_by_date" => $_POST['completed_by_date'],
                         "completed_by_time" => $_POST['completed_by_time'],
                         "reviewed_by" => $_POST['reviewed_by'],
                         "reviewed_by_date" => $_POST['reviewed_by_date'],
                         "reviewed_by_time" => $_POST['reviewed_by_time']
                         );
         }
         if($table_name == "haccap_training_record"){
            //   echo "<pre>";print_r($_POST);exit;
                for($j=0;$j<sizeof($_POST["skill_name"]); $j++){
                    $training_records=array();
                        // $emp=$_POST["emp"][$j];
                         for($i=0;$i<sizeof($_POST["skill_name"]); $i++){
                             if($_POST["skill_name"][$i] !=''){
                                $training_records[$i] = array(
                                 "skill_name" =>$_POST["skill_name"][$i],
                                 "required_skill_level" =>$_POST["required_skill_level"][$i],
                                 "current_capability" =>$_POST["current_capability"][$i],
                                 "future_training_required" =>$_POST["future_training_required"][$i]
                                 );
                             }
                         }
                        //  $training = serialize($training_records);
                        //  $rec[$j] = array(
                        //      'role'   => $_POST["role"][$j],
                        //      'emp'   => $emp,
                        //      'training_record' => $training
                        //      );
                            
                }
                
                $tempData['training_record']=serialize($training_records);
                //  echo "<pre>";print_r($tempData);exit;
         }
         else if($table_name == "haccap_food_transfer_and_order_record"){
             for($i=0;$i<sizeof($_POST["item_name"]); $i++){
                         if($_POST["item_name"][$i] !=''){
                             
                             
                         $cold_form_record[$_POST["item_name"][$i]] = array(
                             "item_date" =>$_POST["item_date"][$i],
                             "item_name" =>$_POST["item_name"][$i],
                             "item_price" => $_POST["item_price"][$i],
                             "item_temp_loading" => $_POST["item_temp_loading"][$i],
                             "item_temp_unloading" =>$_POST["item_temp_unloading"][$i],
                             "item_delivery_location" =>$_POST["item_delivery_location"][$i],
                             "item_received_by" =>$_POST["item_received_by"][$i],
                             "item_deliver_by" =>$_POST["item_deliver_by"][$i],
                            
                             );
                         }
                        
                     } 
                     $tempData['data_record']=serialize($cold_form_record);
                    //  echo "<pre>";print_r($cold_form_record);exit;
         }
         else{
             
         }
         
         if($table_name != "haccap_food_wastage_report" && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record"){
         foreach($tempData as $temp => $tempDatavalue) {
             $tempData[$temp] = serialize($tempDatavalue);
         }
         }
         
         // if its recreate simply insert as new entry else update the existing row
         if($_POST['recreate'] == ""){ 
            
        $this->Forms_model->delete($_POST['id'],$table_name);
         $tempData['id'] = $_POST['id'];
         }
       
         if(isset($_POST['cafe_name'])){ $tempData['cafe_name'] = $_POST['cafe_name']; }
        if(isset($_POST['prep_name'])){ $tempData['prep_name'] = $_POST['prep_name']; }
        if(isset($_POST['verified_by'])){ $tempData['verified_by'] = $_POST['verified_by']; }
        if(isset($_POST['sign_by'])){ $tempData['sign_by'] = $_POST['sign_by']; }
        if(isset($_POST['document_record_number'])){ $tempData['document_record_number'] = $_POST['document_record_number']; }
        if(isset($_POST['role'])){ $tempData['role'] = $_POST['role']; }
        if(isset($_POST['emp'])){ $tempData['emp'] = $_POST['emp']; }
        if(isset($_POST['start_date'])){ $tempData['start_date'] = date('Y-m-d', strtotime($_POST['start_date'])); }
        if(isset($_POST['end_date'])){ $tempData['end_date'] = date('Y-m-d', strtotime($_POST['end_date'])); }
         if(isset($_POST['form_note'])){ $tempData['form_note'] = $_POST['form_note']; }
         if(isset($_POST['form_comment'])){ $tempData['form_comment'] = $_POST['form_comment']; }
        if(isset($_POST['date'])){ $tempData['date'] = date('Y-m-d', strtotime($_POST['date'])); }
         $tempData['branch_id'] = $this->session->userdata('branch_id');
        //  $table_name= 'haccap_temp_form';
        //   echo "<pre>"; print_r($tempData); 
         $insert_id = $this->Forms_model->add($tempData,$table_name);
        //  echo $this->db->last_query();
//   exit;
			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Form has been sucessfully saved');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the data');
			}
         redirect('forms/TempFormList/'.$table_name);
         
     }

public function download_TempForm($id,$table_name){
            if($table_name == "haacp_recipe_form"){
             
             $tempFormData = $this->Forms_model->getAllRecipesrecord($id);   
            }
            else{
                $tempFormData = $this->Forms_model->tempFormView($id,$table_name);
            }
            if($table_name == "haccap_temp_form"){
    		    $spreadsheet = $this->haccap_temp_form($tempFormData);   
    		}
    		else if($table_name == "haccap_cold_form"){
    		    $spreadsheet = $this->haccap_cold_form($tempFormData);   
    		}
    		else if($table_name == "haccap_dishwashing_form"){
    		   $spreadsheet = $this->haccap_dishwashing_form($tempFormData); 
    		    
    		}
    		else if($table_name == "haccap_retention_stock_form"){
    		    $spreadsheet = $this->haccap_retention_stock_form($tempFormData); 
    		}
    		else if($table_name == "haccap_production_record_time"){
    		    $spreadsheet = $this->haccap_production_record_time($tempFormData); 
    		}
    		else if($table_name == "haccap_calibration_form"){
    		    $spreadsheet = $this->haccap_calibration_form($tempFormData); 
    		}
    		else if($table_name == "haccap_food_wastage_report"){
    		    $spreadsheet = $this->haccap_food_wastage_report($tempFormData);
    		}
    		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
    		    $spreadsheet = $this->haccap_kitchen_operational_closedown_checklist($tempFormData); 
    		}
    		else if($table_name == "haccap_operational_incident_report"){
    		    $spreadsheet = $this->haccap_operational_incident_report($tempFormData); 
    		}
             else if($table_name == "haacp_recipe_form"){
                $spreadsheet = $this->haacp_recipe_form($tempFormData); 
            }
            else if($table_name == "haccap_mockrecall_record"){
                $spreadsheet = $this->haccap_mockrecall_record($tempFormData); 
            }
            else if($table_name == "haccap_training_record"){
                $spreadsheet = $this->haccap_training_record($tempFormData); 
            }
            else if($table_name == "haccap_food_transfer_and_order_record"){
                $spreadsheet = $this->haccap_food_transfer_and_order_record($tempFormData); 
            }
    		else{
    		    $spreadsheet = $this->haccap_temp_form($tempFormData);
    		}
    // 	$writer = new Xlsx($spreadsheet); 
   
        // $filename = $table_name;
        // header('Content-Type: application/vnd.ms-excel'); 
        // header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        // header('Cache-Control: max-age=0');
        //  $writer->save('php://output');
        // exit;
       
    
}
public function TempFormList($table_name='haccap_cold_form'){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		   
			$branch_id = $this->session->userdata('branch_id');
			$menu_items  = display_menu();
			$prepforms = $this->Forms_model->getAllForms($table_name);
			if(!empty($prepforms)){
			    $prep_area_id = $this->session->userdata('formPrepArea');
			    	$data['tempFormList'] = $this->Forms_model->TempFormList($branch_id,$table_name,$prep_area_id);
			    	// echo $this->db->last_query();exit;
			}else{
			    	$data['tempFormList'] = $this->Forms_model->TempFormList($branch_id,$table_name);
			}
// 			echo $this->db->last_query();exit;
// 		echo "<pre>";print_r($data);exit;
			$data['table_name'] = $table_name;
			if($table_name=='haccap_cold_form'){
			   $data['heading'] = 'Opening and closing procedure';
			}
			else if($table_name == "haccap_dishwashing_form"){
    		    $data['heading']  = "Dishwasher Washing and Rinse Temperature Records"; 
    		}
    		else if($table_name == "haccap_retention_stock_form"){
    		    $data['heading']  = "Retention Stock Form"; 
    		}
    		else if($table_name == "haccap_production_record_time"){
    		    $data['heading']  = "Production Cooking & Chilling Time & Temperature Record Sheet"; 
    		}
    		else if($table_name == "haccap_calibration_form"){
    		    $data['heading']  = "CALIBRATION / SERVICE & RESULTS"; 
    		}
    		else if($table_name == "haccap_food_wastage_report"){
    		    $data['heading']  = "Food Wastage Report"; 
    		}
    		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
    		    $data['heading']  = "Kitchen Operational Closedown Checklist"; 
    		}
    		else if($table_name == "haccap_operational_incident_report"){
    		    $data['heading']  = "OPERATIONAL INCIDENT REPORT AND CORRECTIVE ACTION RECORD"; 
    		}
            else if($table_name == "haccap_mockrecall_record"){
                $data['heading']  = "Mockrecall RECORD"; 
            }
            else if($table_name == "haccap_food_transfer_and_order_record"){
                $data['heading']  = "Food Transfer & Order Record"; 
            }
            else if($table_name == "haccap_training_record"){
                $tempformdata = $data['tempFormList'];
                $data['tempFormList'] =array();
                foreach($tempformdata as $row){
                    $training_record = unserialize($row->training_record); 
                    
                    $data['tempFormList'][] = array(
                    'id' => $row->id,
                    'branch_id' => $row->branch_id,
                    'cafe_name' => $row->cafe_name,
                    'role' => $row->role,
                    'emp' => $row->emp,
                    // 'employee_name' => $training_record[0]['emp'],
                    'status' => $row->status,
                    ); 
                    
                    
                }
                // echo "<pre>";print_r($training_record);exit;
                $data['heading']  = "Training RECORD";
            }
			else{
			    $data['heading'] = 'Temperature Forms'; 
			}
// 			
				// echo "<pre>";print_r($data);exit;
		    $hdata['menus'] = $menu_items;
		    
			$this->load->view('general/header_general',$hdata);
		    $this->load->view('forms/tempFormList',$data);
		    $this->load->view('general/footer');
		}
	}
public function tempFormEdit($id,$type='',$table_name=''){
	    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{

			$menu_items  = display_menu();
		  // echo $id.$table_name;exit;
			$tempFormData = $this->Forms_model->tempFormView($id,$table_name);
			
			
		if($table_name !='haccap_food_wastage_report' && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record"){
			if(!empty($tempFormData)){
			    foreach($tempFormData as $tempForm){
	            $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                 foreach($weekdays as $title => $weekday_name) {
                     $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
                 }
			$data['TempFormData']=array(
			            'id'  =>  $tempForm->id,
			            'cafe_name'  =>  $tempForm->cafe_name,
			            'start_date'   => $tempForm->start_date,
			            'end_date' =>  $tempForm->end_date,
			            'prep_name'   =>  $tempForm->prep_name,
			            'document_record_number'   =>  $tempForm->document_record_number,
			            'entered_by'   =>  $tempForm->entered_by,
			            'verified_by'   =>  $tempForm->verified_by,
			            'form_note'   =>  $tempForm->form_note,
			            'form_comment'   =>  $tempForm->form_comment
			           
			            );
			            $data['rowData']=$tempdata;
			    }
			}
		}
		else if($table_name == "haccap_cold_form" || $table_name == "haccap_retention_stock_form"){
		    if(!empty($tempFormData)){
		      //  echo "<pre>";print_r($tempFormData);
			    foreach($tempFormData as $tempForm){
	                $record = unserialize($tempForm->mon_data);
                    //  echo "<pre>";print_r($record);exit;
        			$data['TempFormData']=array(
        			            'id'  =>  $tempForm->id,
        			            'cafe_name'  =>  $tempForm->cafe_name,
        			            'prep_name'   =>  $tempForm->prep_name,
        			            'document_record_number'  =>  $tempForm->document_record_number,
        			            'start_date' =>  $tempForm->start_date,
        			            'end_date' =>  $tempForm->end_date,
        			            'verified_by'   =>  $tempForm->verified_by,
        			            'form_note'   =>  $tempForm->form_note,
			                    'form_comment'   =>  $tempForm->form_comment
        			           
        			            );
        			            $data['rowData']=$record;
        			    }
        			     //echo "<pre>";print_r($data);exit; 
			}
		}	
		else if($table_name == "haccap_calibration_form"){
		    if(!empty($tempFormData)){
		      //  echo "<pre>";print_r($tempFormData);
			    foreach($tempFormData as $tempForm){
	                $record = unserialize($tempForm->data_record);
                    //  echo "<pre>";print_r($record);exit;
        			$data['TempFormData']=array(
        			            'id'  =>  $tempForm->id,
        			            'cafe_name'  =>  $tempForm->cafe_name,
        			            'prep_name'   =>  $tempForm->prep_name,
        			            'document_record_number'  =>  $tempForm->document_record_number,
        			            'start_date' =>  $tempForm->start_date,
        			            'end_date' =>  $tempForm->end_date,
        			            'verified_by'   =>  $tempForm->verified_by,
        			            'form_note'   =>  $tempForm->form_note,
			                    'form_comment'   =>  $tempForm->form_comment
        			           
        			            );
        			            $data['rowData']=$record;
        			    }
        			     //echo "<pre>";print_r($data);exit; 
			}
		}
		else if($table_name == "haccap_food_transfer_and_order_record"){
		    
		    if(!empty($tempFormData)){
		      //  echo "<pre>";print_r($tempFormData);
			    foreach($tempFormData as $tempForm){
	                $record = unserialize($tempForm->data_record);
                    //  echo "<pre>";print_r($record);exit;
        			$data['TempFormData']=array(
        			            'id'  =>  $tempForm->id,
        			            'sign_by'  =>  $tempForm->sign_by,
        			            'document_record_number'  =>  $tempForm->document_record_number,
        			            'start_date' =>  $tempForm->start_date,
        			            'verified_by'   =>  $tempForm->verified_by,
        			            'form_note'   =>  $tempForm->form_note,
			                    'form_comment'   =>  $tempForm->form_comment
        			           
        			            );
        			            $data['rowData']=$record;
        			    }
        			     //echo "<pre>";print_r($data);exit; 
			}
		}
		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
		  
             if(!empty($tempFormData)){
			    foreach($tempFormData as $tempForm){
	            $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                 foreach($weekdays as $title => $weekday_name) {
                     $tempdata[$title] = ($tempForm->$title !='' ?  unserialize($tempForm->$title) : '');
                 }
        			$data['TempFormData']=array(
        			            'id'  =>  $tempForm->id,
        			            'cafe_name'  =>  $tempForm->cafe_name,
        			            'document_record_number'  =>  $tempForm->document_record_number,
        			            'start_date' =>  $tempForm->start_date,
        			            'end_date' =>  $tempForm->end_date,
        			            'verified_by'   =>  $tempForm->verified_by,
        			            'form_note'   =>  $tempForm->form_note,
			                    'form_comment'   =>  $tempForm->form_comment
        			           
        			            );
        			            $data['rowData']=$tempdata;
        			    }
			}
            
               
         }
         else if($table_name == "haccap_operational_incident_report"){
		  
             if(!empty($tempFormData)){
			    foreach($tempFormData as $tempForm){
	            
                 
        			$data['TempFormData']=array(
        			            'id'  =>  $tempForm->id,
        			            "correctiveaction" => $tempForm->correctiveaction,
                                 "correctiveaction_date" => $tempForm->correctiveaction_date,
                                 "correctiveaction_time" => $tempForm->correctiveaction_time,
                                 "reason_for_non_conformance" => $tempForm->reason_for_non_conformance,
                                 "organisation" => $tempForm->organisation,
                                 "name_of_contact_person" => $tempForm->name_of_contact_person,
                                 "contact_of_contact_person" => $tempForm->contact_of_contact_person,
                                 "report" => $tempForm->report,
                                 "reply_to" => $tempForm->reply_to,
                                 "reply_to_date" => $tempForm->reply_to_date,
                                 "incident_date" => $tempForm->incident_date,
                                 "description_of_non_conformance" => $tempForm->description_of_non_conformance,
                                 "detailed_description_of_event" => $tempForm->detailed_description_of_event,
                                 "classification" => $tempForm->classification,
                                 "reason_of_occurance" => $tempForm->reason_of_occurance,
                                 "date_corrective_action_taken" => $tempForm->date_corrective_action_taken,
                                 "verified_by" => $tempForm->verified_by,
                                 "results" => $tempForm->results,
                                 "satisfactory" => $tempForm->satisfactory,
                                 "unsatisfactory" => $tempForm->unsatisfactory,
                                 "followup" => $tempForm->followup,
                                 "signed_by" => $tempForm->signed_by,
        			             "document_record_number"   =>  $tempForm->document_record_number,
        			             'form_note'   =>  $tempForm->form_note,
			                    'form_comment'   =>  $tempForm->form_comment
        			            );
        			           
        			    }
			}
            
               
         }
         else if($table_name == "haccap_mockrecall_record"){
             
                 $data['TempFormData'] = array(
                     'id'  =>  $tempFormData[0]->id,
                         "date_initiated" => $tempFormData[0]->date_initiated,
                         "time_initiated" => $tempFormData[0]->time_initiated,
                         "date_completed" => $tempFormData[0]->date_completed,
                         "time_completed" => $tempFormData[0]->time_completed,
                         "description_of_product" => $tempFormData[0]->description_of_product,
                         "description_of_scenario" => $tempFormData[0]->description_of_scenario,
                         "completed_by" => $tempFormData[0]->completed_by,
                         "completed_by_date" => $tempFormData[0]->completed_by_date,
                         "completed_by_time" => $tempFormData[0]->completed_by_time,
                         "reviewed_by" => $tempFormData[0]->reviewed_by,
                         "reviewed_by_date" => $tempFormData[0]->reviewed_by_date,
                         "reviewed_by_time" => $tempFormData[0]->reviewed_by_time,
                         "document_record_number"   =>  $tempFormData[0]->document_record_number,
                         "form_note"   =>  $tempFormData[0]->form_note,
                         "form_comment"   =>  $tempFormData[0]->form_comment
                         );
         }
         else if($table_name == "haccap_training_record"){
            
		        $training_records=unserialize($tempFormData[0]->training_record);
		        
		        
		        $data['TempFormData'] = array(
		            'id'  =>  $tempFormData[0]->id,
		            'cafe_name'  =>  $tempFormData[0]->cafe_name,
		            'role'  =>  $tempFormData[0]->role,
		            'emp'  =>  $tempFormData[0]->emp,
		            'training_records'  => $training_records
                        );
                        // echo "<pre>";print_r($training_records);exit;
                        // echo "<pre>";print_r($data);exit;
                        // echo "<pre>";print_r($data['TempFormData'][0]['training_records']);exit;
         }
		else{
		   
		  //	echo "<pre>";print_r($data);exit;
		    $data['TempFormData']=array(
			            'id'  =>  $tempFormData[0]->id,
			            'cafe_name'  =>  $tempFormData[0]->cafe_name,
			            'document_record_number'  =>  $tempFormData[0]->document_record_number,
			            'start_date'   => $tempFormData[0]->start_date,
			            'end_date' =>  $tempFormData[0]->end_date,
			            'prep_name'   =>  $tempFormData[0]->prep_name,
			            'food_cost_wastage_amount'   =>  $tempFormData[0]->food_cost_wastage_amount,
			            'product_wastage_data' => unserialize($tempFormData[0]->product_wastage_data),
			            'verified_by'   =>  $tempFormData[0]->verified_by,
			            'form_note'   =>  $tempForm->form_note,
			             'form_comment'   =>  $tempForm->form_comment
			           
			            );
		 
		    
		}
		
	            if($type == 'view'){
	                $data['disabled'] = "disabled";
	                 $data['recreate'] = "";
	            }elseif($type == 'recreate'){
	                $data['disabled'] = "";
	                 $data['recreate'] = "recreate";
	            }else{
	                  $data['disabled'] = "";
	                 $data['recreate'] = "";
	            }
	            $data['table_name'] = $table_name;
		        $hdata['menus'] = $menu_items;
		        
		        
    		      if($table_name=="haccap_temp_form"){
        		 $data['heading']  = "Temperature Forms";   
        		}
        		else if($table_name == "haccap_dishwashing_form"){
        		    $data['heading']  = "Dishwasher Washing and Rinse Temperature Records"; 
        		}
        		else if($table_name == "haccap_retention_stock_form"){
    		    $data['heading']  = "Retention Stock Form"; 
    		}
    		else if($table_name == "haccap_production_record_time"){
    		    $data['heading']  = "Production Cooking & Chilling Time & Temperature Record Sheet"; 
    		}
    		else if($table_name == "haccap_calibration_form"){
    		    $data['heading']  = "CALIBRATION / SERVICE & RESULTS"; 
    		}
    		else if($table_name == "haccap_food_wastage_report"){
    		    $data['heading']  = "Food Wastage Report"; 
    		}
    		
    		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
    		    $data['heading']  = "Kitchen Operational Closedown Checklist"; 
    		}
    		else if($table_name == "haccap_operational_incident_report"){
    		    $data['heading']  = "OPERATIONAL INCIDENT REPORT AND CORRECTIVE ACTION RECORD"; 
    		}
            else if($table_name == "haccap_mockrecall_record"){
                $data['heading']  = "Mockrecall RECORD"; 
            }
             else if($table_name == "haccap_training_record"){
                $data['heading']  = "Training RECORD"; 
            }
            else if($table_name == "haccap_food_transfer_and_order_record"){
                $data['heading']  = "Food Transfer & Order Record"; 
            }
        		else{
        		 $data['heading']  = "Opening and closing procedure";   
        		}
        // 	echo "<pre>";print_r($data);exit;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/tempFormEdit',$data); 
		    $this->load->view('general/footer');
		}
	}
	
public function tempFormView($id,$type='',$table_name=''){
    if (!$this->ion_auth->logged_in()) {
		redirect('auth/login');
	}else{

		$menu_items  = display_menu();
	  // echo $id.$table_name;exit;
		$tempFormData = $this->Forms_model->tempFormView($id,$table_name);
		
		
	if($table_name !='haccap_food_wastage_report' && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record"){
		if(!empty($tempFormData)){
		    foreach($tempFormData as $tempForm){
            $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
     
             foreach($weekdays as $title => $weekday_name) {
                 $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
             }
		$data['TempFormData']=array(
		            'id'  =>  $tempForm->id,
		            'cafe_name'  =>  $tempForm->cafe_name,
		            'start_date'   => $tempForm->start_date,
		            'end_date' =>  $tempForm->end_date,
		            'prep_name'   =>  $tempForm->prep_name,
		            'document_record_number'   =>  $tempForm->document_record_number,
		            'entered_by'   =>  $tempForm->entered_by,
		            'verified_by'   =>  $tempForm->verified_by,
		            'form_note'   =>  $tempForm->form_note,
		            'form_comment'   =>  $tempForm->form_comment
		           
		            );
		            $data['rowData']=$tempdata;
		    }
		}
	}
	else if($table_name == "haccap_cold_form" || $table_name == "haccap_retention_stock_form"){
	    if(!empty($tempFormData)){
	      //  echo "<pre>";print_r($tempFormData);
		    foreach($tempFormData as $tempForm){
                $record = unserialize($tempForm->mon_data);
                //  echo "<pre>";print_r($record);exit;
    			$data['TempFormData']=array(
    			            'id'  =>  $tempForm->id,
    			            'cafe_name'  =>  $tempForm->cafe_name,
    			            'prep_name'   =>  $tempForm->prep_name,
    			            'document_record_number'  =>  $tempForm->document_record_number,
    			            'start_date' =>  $tempForm->start_date,
    			            'end_date' =>  $tempForm->end_date,
    			            'verified_by'   =>  $tempForm->verified_by,
    			            'form_note'   =>  $tempForm->form_note,
		                    'form_comment'   =>  $tempForm->form_comment
    			           
    			            );
    			            $data['rowData']=$record;
    			    }
    			     //echo "<pre>";print_r($data);exit; 
		}
	}	
	else if($table_name == "haccap_calibration_form"){
	    if(!empty($tempFormData)){
	      //  echo "<pre>";print_r($tempFormData);
		    foreach($tempFormData as $tempForm){
                $record = unserialize($tempForm->data_record);
                //  echo "<pre>";print_r($record);exit;
    			$data['TempFormData']=array(
    			            'id'  =>  $tempForm->id,
    			            'cafe_name'  =>  $tempForm->cafe_name,
    			            'prep_name'   =>  $tempForm->prep_name,
    			            'document_record_number'  =>  $tempForm->document_record_number,
    			            'start_date' =>  $tempForm->start_date,
    			            'end_date' =>  $tempForm->end_date,
    			            'verified_by'   =>  $tempForm->verified_by,
    			            'form_note'   =>  $tempForm->form_note,
		                    'form_comment'   =>  $tempForm->form_comment
    			           
    			            );
    			            $data['rowData']=$record;
    			    }
    			     //echo "<pre>";print_r($data);exit; 
		}
	}
	else if($table_name == "haccap_food_transfer_and_order_record"){
	    
	    if(!empty($tempFormData)){
	      //  echo "<pre>";print_r($tempFormData);
		    foreach($tempFormData as $tempForm){
                $record = unserialize($tempForm->data_record);
                //  echo "<pre>";print_r($record);exit;
    			$data['TempFormData']=array(
    			            'id'  =>  $tempForm->id,
    			            'sign_by'  =>  $tempForm->sign_by,
    			            'document_record_number'  =>  $tempForm->document_record_number,
    			            'start_date' =>  $tempForm->start_date,
    			            'verified_by'   =>  $tempForm->verified_by,
    			            'form_note'   =>  $tempForm->form_note,
		                    'form_comment'   =>  $tempForm->form_comment
    			           
    			            );
    			            $data['rowData']=$record;
    			    }
    			     //echo "<pre>";print_r($data);exit; 
		}
	}
	else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
	  
         if(!empty($tempFormData)){
		    foreach($tempFormData as $tempForm){
            $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
     
             foreach($weekdays as $title => $weekday_name) {
                 $tempdata[$title] = ($tempForm->$title !='' ?  unserialize($tempForm->$title) : '');
             }
    			$data['TempFormData']=array(
    			            'id'  =>  $tempForm->id,
    			            'cafe_name'  =>  $tempForm->cafe_name,
    			            'document_record_number'  =>  $tempForm->document_record_number,
    			            'start_date' =>  $tempForm->start_date,
    			            'end_date' =>  $tempForm->end_date,
    			            'verified_by'   =>  $tempForm->verified_by,
    			            'form_note'   =>  $tempForm->form_note,
		                    'form_comment'   =>  $tempForm->form_comment
    			           
    			            );
    			            $data['rowData']=$tempdata;
    			    }
		}
        
           
     }
     else if($table_name == "haccap_operational_incident_report"){
	  
         if(!empty($tempFormData)){
		    foreach($tempFormData as $tempForm){
            
             
    			$data['TempFormData']=array(
    			            'id'  =>  $tempForm->id,
    			            "correctiveaction" => $tempForm->correctiveaction,
                             "correctiveaction_date" => $tempForm->correctiveaction_date,
                             "correctiveaction_time" => $tempForm->correctiveaction_time,
                             "reason_for_non_conformance" => $tempForm->reason_for_non_conformance,
                             "organisation" => $tempForm->organisation,
                             "name_of_contact_person" => $tempForm->name_of_contact_person,
                             "contact_of_contact_person" => $tempForm->contact_of_contact_person,
                             "report" => $tempForm->report,
                             "reply_to" => $tempForm->reply_to,
                             "reply_to_date" => $tempForm->reply_to_date,
                             "incident_date" => $tempForm->incident_date,
                             "description_of_non_conformance" => $tempForm->description_of_non_conformance,
                             "detailed_description_of_event" => $tempForm->detailed_description_of_event,
                             "classification" => $tempForm->classification,
                             "reason_of_occurance" => $tempForm->reason_of_occurance,
                             "date_corrective_action_taken" => $tempForm->date_corrective_action_taken,
                             "verified_by" => $tempForm->verified_by,
                             "results" => $tempForm->results,
                             "satisfactory" => $tempForm->satisfactory,
                             "unsatisfactory" => $tempForm->unsatisfactory,
                             "followup" => $tempForm->followup,
                             "signed_by" => $tempForm->signed_by,
    			             "document_record_number"   =>  $tempForm->document_record_number,
    			             'form_note'   =>  $tempForm->form_note,
		                    'form_comment'   =>  $tempForm->form_comment
    			            );
    			           
    			    }
		}
        
           
     }
     else if($table_name == "haccap_mockrecall_record"){
         
             $data['TempFormData'] = array(
                 'id'  =>  $tempFormData[0]->id,
                     "date_initiated" => $tempFormData[0]->date_initiated,
                     "time_initiated" => $tempFormData[0]->time_initiated,
                     "date_completed" => $tempFormData[0]->date_completed,
                     "time_completed" => $tempFormData[0]->time_completed,
                     "description_of_product" => $tempFormData[0]->description_of_product,
                     "description_of_scenario" => $tempFormData[0]->description_of_scenario,
                     "completed_by" => $tempFormData[0]->completed_by,
                     "completed_by_date" => $tempFormData[0]->completed_by_date,
                     "completed_by_time" => $tempFormData[0]->completed_by_time,
                     "reviewed_by" => $tempFormData[0]->reviewed_by,
                     "reviewed_by_date" => $tempFormData[0]->reviewed_by_date,
                     "reviewed_by_time" => $tempFormData[0]->reviewed_by_time,
                     "document_record_number"   =>  $tempFormData[0]->document_record_number,
                     "form_note"   =>  $tempFormData[0]->form_note,
                     "form_comment"   =>  $tempFormData[0]->form_comment
                     );
     }
     else if($table_name == "haccap_training_record"){
        
	        $training_records=unserialize($tempFormData[0]->training_record);
	        
	        
	        $data['TempFormData'] = array(
	            'id'  =>  $tempFormData[0]->id,
	            'cafe_name'  =>  $tempFormData[0]->cafe_name,
	            'role'  =>  $tempFormData[0]->role,
	            'emp'  =>  $tempFormData[0]->emp,
	            'training_records'  => $training_records
                    );
                    // echo "<pre>";print_r($training_records);exit;
                    // echo "<pre>";print_r($data);exit;
                    // echo "<pre>";print_r($data['TempFormData'][0]['training_records']);exit;
     }
	else{
	   
	  //	echo "<pre>";print_r($data);exit;
	    $data['TempFormData']=array(
		            'id'  =>  $tempFormData[0]->id,
		            'cafe_name'  =>  $tempFormData[0]->cafe_name,
		            'document_record_number'  =>  $tempFormData[0]->document_record_number,
		            'start_date'   => $tempFormData[0]->start_date,
		            'end_date' =>  $tempFormData[0]->end_date,
		            'prep_name'   =>  $tempFormData[0]->prep_name,
		            'food_cost_wastage_amount'   =>  $tempFormData[0]->food_cost_wastage_amount,
		            'product_wastage_data' => unserialize($tempFormData[0]->product_wastage_data),
		            'verified_by'   =>  $tempFormData[0]->verified_by,
		            'form_note'   =>  $tempForm->form_note,
		             'form_comment'   =>  $tempForm->form_comment
		           
		            );
	 
	    
	}
	
            if($type == 'view'){
                $data['disabled'] = "disabled";
                 $data['recreate'] = "";
            }elseif($type == 'recreate'){
                $data['disabled'] = "";
                 $data['recreate'] = "recreate";
            }else{
                  $data['disabled'] = "";
                 $data['recreate'] = "";
            }
            $data['table_name'] = $table_name;
	        $hdata['menus'] = $menu_items;
	        
	        
		      if($table_name=="haccap_temp_form"){
    		 $data['heading']  = "Temperature Forms";   
    		}
    		else if($table_name == "haccap_dishwashing_form"){
    		    $data['heading']  = "Dishwasher Washing and Rinse Temperature Records"; 
    		}
    		else if($table_name == "haccap_retention_stock_form"){
		    $data['heading']  = "Retention Stock Form"; 
		}
		else if($table_name == "haccap_production_record_time"){
		    $data['heading']  = "Production Cooking & Chilling Time & Temperature Record Sheet"; 
		}
		else if($table_name == "haccap_calibration_form"){
		    $data['heading']  = "CALIBRATION / SERVICE & RESULTS"; 
		}
		else if($table_name == "haccap_food_wastage_report"){
		    $data['heading']  = "Food Wastage Report"; 
		}
		
		else if($table_name == "haccap_kitchen_operational_closedown_checklist"){
		    $data['heading']  = "Kitchen Operational Closedown Checklist"; 
		}
		else if($table_name == "haccap_operational_incident_report"){
		    $data['heading']  = "OPERATIONAL INCIDENT REPORT AND CORRECTIVE ACTION RECORD"; 
		}
        else if($table_name == "haccap_mockrecall_record"){
            $data['heading']  = "Mockrecall RECORD"; 
        }
         else if($table_name == "haccap_training_record"){
            $data['heading']  = "Training RECORD"; 
        }
        else if($table_name == "haccap_food_transfer_and_order_record"){
            $data['heading']  = "Food Transfer & Order Record"; 
        }
    		else{
    		 $data['heading']  = "Opening and closing procedure";   
    		}
    // 	echo "<pre>";print_r($data);exit;
		$this->load->view('general/header_general',$hdata);
		$this->load->view('forms/tempFormView',$data); 
	    $this->load->view('general/footer');
	}
}
	
	
public function tempForm_delete(){
        $id = $this->input->post('id');
        $tablename = $this->input->post('tablename');
        $this->Forms_model->delete($id,$tablename);
          
    }

public function GlobalFormSubmit(){
     
     if(isset($_POST['formSubmit'])){
         $table_name = $_POST['table_name']; unset($_POST['table_name']);  unset($_POST['formSubmit']); $_POST['branch_id'] = $this->session->userdata('branch_id');
         $formfieldsName = array_keys($_POST);
        
         for($i=0;$i<=count($formfieldsName);$i++){
          $this->form_validation->set_rules($formfieldsName[$i], ucfirst($formfieldsName[$i]), 'required');   
         }
        if ($this->form_validation->run() == FALSE)
         {
         $msg ="Please fill all form fields carefully";
          $this->session->set_flashdata('message', $msg);
          	redirect('forms/ReviewForm');
        }
        else
        {
         $this->db->insert($table_name, $_POST);
       $msg ="Data added succesfully";
        $this->session->set_flashdata('message', $msg);
          	redirect('forms/reviewDatesAdd');
        }
         
       
     }
   
 }

public function update_review_form(){
      $table_name = $_POST['table_name']; unset($_POST['table_name']);  $id = $_POST['id'];  unset($_POST['id']); unset($_POST['formSubmit']); 
     $review_data = $this->Forms_model->update_table_data($_POST,$id,$table_name);
     
     $msg ="Data updated succesfully";
        $this->session->set_flashdata('message', $msg);
          	redirect('forms/reviewDatesAdd');
 }
public function delete_review(){
       $table_name = $_POST['table_name'];
       $id = $_POST['id'];
         $this->Forms_model->delete($id,$table_name);
         echo "success"; exit;
  }
public function view_review($id="",$edit=''){
     $params = array(
         'table_name' => 'haccap_review_form',
         'conditions' =>array(
             'id' =>$id
             ),
         );

     $review_data = $this->Forms_model->get_table_data($params); 
     if($edit=='edit'){
         $data['disabled'] = '';
     }else{
          $data['disabled'] = 'disabled';
     }
   
     $data['tablename'] = 'haccap_review_form';
		    $data['fields'] = array(
		        array('type' => 'text', 'label' => 'Activity', 'name' => 'activity', 'required' => '1','value' => (isset($review_data[0]->activity) ? $review_data[0]->activity : '')),
		        array('type' => 'text', 'label' => 'Description', 'name' => 'description', 'required' => '1' ,'value' => (isset($review_data[0]->description) ? $review_data[0]->description : '')),
		        array('type' => 'date', 'label' => 'When Recorded', 'name' => 'whenRecorded', 'required' => '1' ,'value' => (isset($review_data[0]->whenRecorded) ? $review_data[0]->whenRecorded : '')),
		        array('type' => 'text', 'label' => 'Who Recorded', 'name' => 'whoRecorded', 'required' => '1', 'value' => (isset($review_data[0]->whoRecorded) ? $review_data[0]->whoRecorded : '')),
		        array('type' => 'text', 'label' => 'Where Recorded', 'name' => 'whereRecorded', 'required' => '1'  ,'value' => (isset($review_data[0]->whereRecorded) ? $review_data[0]->whereRecorded : ''))
		        );
		     $data['id'] = $id;
		    
		    $data['page_heading'] = 'Update Activity';
// 			$data['controller_name'] = 'forms/reviewDateAdd';
			$data['cancel'] = 'forms/reviewDatesAdd';
     
     
     
     
    $hdata['menus'] = display_menu();
    $this->load->view('general/header_general',$hdata);
	$this->load->view('forms/edit_form',$data);
	$this->load->view('general/footer');
 }
 
public function ReviewForm(){
     
      $data['tablename'] = 'haccap_review_form';
		    $data['fields'] = array(
		        array('type' => 'text', 'label' => 'Activity', 'name' => 'activity', 'required' => '1'),
		        array('type' => 'text', 'label' => 'Description', 'name' => 'description', 'required' => '1'),
		        array('type' => 'date', 'label' => 'When Recorded', 'name' => 'whenRecorded', 'required' => '1'),
		        array('type' => 'text', 'label' => 'Who Recorded', 'name' => 'whoRecorded', 'required' => '1'),
		        array('type' => 'text', 'label' => 'Where Recorded', 'name' => 'whereRecorded', 'required' => '1')
		        );
		    
		    
		    $data['page_heading'] = 'Add Activity';
// 			$data['controller_name'] = 'forms/reviewDateAdd';
			$data['cancel'] = 'forms/reviewDatesAdd';
			
		    
		    $this->getForm($data);
		    
 }
    
public function reviewDatesAdd(){
      
        if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
	    
		$config = array();
        $config["base_url"] = base_url() . "index.php/forms/reviewDatesAdd";
        $config["total_rows"] = $this->Forms_model->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['prev_link'] = '&lt; Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next &gt;</i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $this->pagination->initialize($config);

		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
		$data['tablename'] = 'haccap_review_form';
		$data["page_heading"] = 'Review List';
		$data["button_heading"] = 'Add Review';
		$data["controller_name"] = 'forms/ReviewForm';
        $data['reviews'] = $this->Forms_model->get_data($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $hdata['menus'] = display_menu();
        $this->load->view('general/header_general',$hdata);
        $this->load->view('forms/list', $data);
		$this->load->view('general/footer');    
		}
    }
public function getForm($data){
        
          	$branch_id = $this->session->userdata('branch_id');
          	
		    $hdata['menus'] = display_menu();
		    
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/form',$data);
			$this->load->view('general/footer');
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
public function delete_document(){

			 $id = $this->input->post('id');
			   $tablename = $this->input->post('tablename');
			$delete = $this->Document_model->delete_document($id,$tablename);
	}


// 	recipe forms
public function viewRecipes($recipe_type){
    
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	

			$menu_items  = display_menu();
			
			$data['recipe_type']  = $recipe_type;
    	
    		$data['heading']  = "Recipes";
    		
			$Recipes = $this->Forms_model->getAllRecipes($branch_id,$recipe_type,'');
		    $data['recipes'] = $Recipes;
		    $data['table_name'] = 'haacp_recipe_form';
		    
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('forms/viewRecipes',$data);
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
		    
    		$data['heading']  = "Add Recipe";   
    		
		    $ServingSize = $this->menucard_model->getServingSizes($branch_id,'');
		    $data['ServingSize'] = $ServingSize;
		     $data['form_name'] = 'add';
		     
			$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/addNewRecipe',$data);
			$this->load->view('general/footer');
		}
	}
public function submitRecipe(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		  //  echo "<pre>";print_r($this->input->post());exit;
		   if ($this->input->post()) {
		       
            $branch_id = $this->session->userdata('branch_id');
            $recipe_type=$this->input->post('recipe_type');
		   
		   //update
		    if($this->input->post('haacp_recipe_form_id') && $_POST["form_name"] != 'recreate'){
		        
        		      //   echo "<pre>";print_r($this->input->post());exit;
        		        $id=$this->input->post('haacp_recipe_form_id');
        		         $status=$this->input->post('status');
        		         
        		         for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                               if($_POST["ingredient"][$i] !=''){      
                                     $tempData[$i] = array(
                                        'ingredient' =>$_POST["ingredient"][$i],
                                        'quantity' =>$_POST["quantity"][$i],
                                        'units' =>$_POST["units"][$i],
                                        'allergens_present' =>$_POST["allergens_present"][$i],
                                        'ingredient_substitution_options' =>$_POST["ingredient_substitution_options"][$i],
                                 );
                              }
                        }
        		        $ingredients= serialize($tempData);  
        		        
        		        $recipe_method= serialize($_POST["recipe_method"]);
        		        
        		        
                              
                                     $allergens_data[$i] = array(
                                         
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
            			'recipe_type' => $recipe_type,
            			'yield' => $this->input->post('yield'),
            			'portion_size' => $this->input->post('portion_size'),
            			'serving_size_id' => $this->input->post('serving_size_id'),
            			'ingredients' => $ingredients,
            			'recipe_method' => $recipe_method,
            			'allergens' => $allergens,
            			'name' => $this->input->post('name'),
            			'role' => $this->input->post('role'),
            			'signed' => $this->input->post('signed'),
            			'date' => $this->input->post('form_note'),
            			'branch_id' => $branch_id,
            			'status' => $status,
            			'document_record_number' => $this->input->post('document_record_number'),
            			'form_comment' => $this->input->post('form_comment'),
            			'form_note' => $this->input->post('form_note')
            			);
        // 			echo "<pre>";print_r($allergens_data);exit;
        		        $this->Forms_model->updateRecipe($data,$id);

		    }
		    else if($_POST["form_name"] == 'recreate'){
		      //  recreate
		        $status=$this->input->post('status');
		        
		         for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                       if($_POST["ingredient"][$i] !=''){      
                             $tempData[$i] = array(
                                'ingredient' =>$_POST["ingredient"][$i],
                                'quantity' =>$_POST["quantity"][$i],
                                'units' =>$_POST["units"][$i],
                                'allergens_present' =>$_POST["allergens_present"][$i],
                                'ingredient_substitution_options' =>$_POST["ingredient_substitution_options"][$i],
                         );
                      }
                }
		        $ingredients= serialize($tempData);  
		        
		        $recipe_method= serialize($_POST["recipe_method"]);
		        
		        
                     
                             $allergens_data[$i] = array(
                                 
                                   'milk' => ($_POST["milk"] != '' ? '1' : '0'),
                                   'egg' => ($_POST["allergens"] != '' ? '1' : '0'),
                                   'fish' => ($_POST["allergens"] != '' ? '1' : '0'),
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
    			'recipe_type' => $recipe_type,
    			'yield' => $this->input->post('yield'),
    			'portion_size' => $this->input->post('portion_size'),
    			'serving_size_id' => $this->input->post('serving_size_id'),
    			'ingredients' => $ingredients,
    			'recipe_method' => $recipe_method,
    			'allergens' => $allergens,
    			'name' => $this->input->post('name'),
    			'role' => $this->input->post('role'),
    			'signed' => $this->input->post('signed'),
    			'date' => $this->input->post('date'),
    			'branch_id' => $branch_id,
    			'status' => '1',
    			'document_record_number' => $this->input->post('document_record_number'),
    			'form_comment' => $this->input->post('form_comment'),
    			'form_note' => $this->input->post('form_note')
    			);
    // 			echo "<pre>";print_r($data);exit;
    		    $insert_id = $this->Forms_model->addRecipe($data);
    
    			if($insert_id){
    				$this->session->set_flashdata('sucess_msg', 'Recipe has been sucessfully recreated');
    			}else{
    				$this->session->set_flashdata('error_msg', 'Unable to recreate the Recipe');
    			}
		    }else{
		       //add
		        for($i=0;$i<sizeof($_POST["ingredient"]); $i++){
                       if($_POST["ingredient"][$i] !=''){      
                             $tempData[$i] = array(
                                'ingredient' =>$_POST["ingredient"][$i],
                                'quantity' =>$_POST["quantity"][$i],
                                'units' =>$_POST["units"][$i],
                                'allergens_present' =>$_POST["allergens_present"][$i],
                                'ingredient_substitution_options' =>$_POST["ingredient_substitution_options"][$i],
                         );
                      }
                }
		        $ingredients= serialize($tempData);  
		        
		        $recipe_method= serialize($_POST["recipe_method"]);
		        
		        
                            
                             $allergens_data[] = array(
                                 
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
    			'recipe_type' => $recipe_type,
    			'yield' => $this->input->post('yield'),
    			'portion_size' => $this->input->post('portion_size'),
    			'serving_size_id' => $this->input->post('serving_size_id'),
    			'ingredients' => $ingredients,
    			'recipe_method' => $recipe_method,
    			'allergens' => $allergens,
    			'name' => $this->input->post('name'),
    			'role' => $this->input->post('role'),
    			'signed' => $this->input->post('signed'),
    			'date' => $this->input->post('date'),
    			'branch_id' => $branch_id,
    			'status' => '1',
    			'document_record_number' => $this->input->post('document_record_number'),
    			'form_comment' => $this->input->post('form_comment'),
    			'form_note' => $this->input->post('form_note')
    			);
// 			echo "<pre>";print_r($allergens_data);exit;
		    $insert_id = $this->Forms_model->addRecipe($data);

			if($insert_id){
				$this->session->set_flashdata('sucess_msg', 'Recipe has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Recipe');
			}
		    }
		    redirect('forms/viewRecipes/'.$recipe_type);
		}else{
			 $menu_items  = display_menu();
				$hdata['menus'] = $menu_items;
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/addRecipe');
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
			$recipe = $this->Forms_model->getAllRecipes($branch_id,$recipe_type,$id);
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    $data['ingredients']=$ingredients;
		  
		    $recipe_method=unserialize($recipe[0]->recipe_method);
		    $data['recipe_method']=$recipe_method;
		    
		    $allergens=unserialize($recipe[0]->allergens);
		    $data['allergens']=$allergens;
		   
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		$data['heading']  = "Recipes";
		  
		   $data['form_name'] = 'edit';
		        $hdata['menus'] = $menu_items;
		        
		        
		      //   echo "<pre>";print_r($data);exit;
		         
				$this->load->view('general/header_general',$hdata);
				$this->load->view('forms/addNewRecipe',$data);
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
			$recipe = $this->Forms_model->getAllRecipes($branch_id,$recipe_type,$id);
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    
		    $data['ingredients']=$ingredients;
		  //  echo "<pre>";print_r($ingredients);exit;
		  
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		$data['heading']  = "Recipes";
    		
		  $data['form_name'] = 'recreate';
		        $hdata['menus'] = $menu_items;
		       
				$this->load->view('general/header_general',$hdata);
				$this->load->view('forms/addNewRecipe',$data);
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
		    
			$recipe = $this->Forms_model->getAllRecipes($branch_id,$recipe_type,$id);
			
		    $data['recipe'] = $recipe;
		    
		    $ingredients=unserialize($recipe[0]->ingredients);
		    
		    $data['ingredients']=$ingredients;
		  
		    $recipe_method=unserialize($recipe[0]->recipe_method);
		    $data['recipe_method']=$recipe_method;
		    
		    $allergens=unserialize($recipe[0]->allergens);
		    $data['allergens']=$allergens;
		    
		   
		  $recipe_type  = $recipe[0]->recipe_type;
		  $data['recipe_type']  = $recipe_type;
		    
    		$data['heading']  = "Recipes";
    		
		  $data['form_name'] = 'view';
		        $hdata['menus'] = $menu_items;
		      // echo "<pre>";print_r($data);exit;
				$this->load->view('general/header_general',$hdata);
				$this->load->view('forms/addNewRecipe',$data);
				$this->load->view('general/footer');
		}
	}
public function record_delete(){
	   
        $id = $this->input->post('id');
        
          $tablename = $this->input->post('tablename');
          
       $this->Forms_model->record_delete($id,$tablename);
         
    }
// recipe forms ends

// prep area
public function prep_area_list(){
    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	

			$menu_items  = display_menu();
			
			$prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'','');
		    $data['prepArea'] = $prepArea;  
		    $hdata['menus'] = $menu_items;
		       
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/prep_area_list',$data);
			$this->load->view('general/footer');
		}
}
public function prep_area_form_view($prep_area_id=''){
    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	

			$menu_items  = display_menu();
			$haccap_forms = $this->Forms_model->getAllForms();
			$prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'',$prep_area_id);
		    $data['prep_area'] = $prepArea;
		    $data['haccap_table_access'] = unserialize($prepArea[0]->prep_area_table);
		    $data['action'] = 'view';
		    $hdata['menus'] = $menu_items;
		    $data['haccap_forms'] = $haccap_forms;
		       
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/prep_area_form',$data);
			$this->load->view('general/footer');
		}
}
public function prep_area_form($prep_area_id=''){
    if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
			$branch_id = $this->session->userdata('branch_id');	
	

			$menu_items  = display_menu();
			$data = array();
			$haccap_forms = $this->Forms_model->getAllForms();
			
			if($prep_area_id && $prep_area_id != ''){
			    $prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'',$prep_area_id);
		        $data['prep_area'] = $prepArea;
		        $data['haccap_table_access'] = unserialize($prepArea[0]->prep_area_table);
		        $data['action'] = 'edit';
			}else{
			    $data['action'] = 'add';
			}
		    $data['haccap_forms'] = $haccap_forms;
		    
		    $hdata['menus'] = $menu_items;
		       
			$this->load->view('general/header_general',$hdata);
			$this->load->view('forms/prep_area_form',$data);
			$this->load->view('general/footer');
		}
}
public function prep_area_form_submit(){
   		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}else{
		    
		  //  echo "<pre>";print_r($this->input->post());exit;
		  
		       
            $branch_id = $this->session->userdata('branch_id');
		   
		   //update
		    if($this->input->post('prep_area_id') && $this->input->post('prep_area_id') != ''){
		        
        		      
        		        $id = $this->input->post('prep_area_id');
        		       $prepArea = $this->Forms_model->getAllPrepAreas($branch_id,'',$id);
        		       $old_email = $prepArea[0]->prep_area_useremail;
        		      $haccap_table_id = $this->input->post('haccap_table_id');
        		        
        		       if($this->input->post('prep_area_password') != ''){
        		        $prep_area_password = $this->Ion_auth_model->hash_password($this->input->post('prep_area_password'));
        		       }
        		         
        		        $prep_area_table= serialize($haccap_table_id);  
        		       
                        if(isset($prep_area_password)){
                            $data=array(
            			
                			'prep_area_name' => $this->input->post('prep_area_name'),
                			'prep_area_useremail' => $this->input->post('prep_area_useremail'),
                // 			'prep_area_password' => $prep_area_password,
                			'prep_area_table' => $prep_area_table,
                			'updated_date' => date('Y-m-d')
                			
                			);
                			$userdata=array(
            			
                			'username' => $this->input->post('prep_area_name'),
                			'email' => $this->input->post('prep_area_useremail'),
                			'password' => $prep_area_password
                			
                			);
                        }else{
                            $data=array(
            			
                			'prep_area_name' => $this->input->post('prep_area_name'),
                			'prep_area_useremail' => $this->input->post('prep_area_useremail'),
                			'prep_area_table' => $prep_area_table,
                			'updated_date' => date('Y-m-d')
                			
                			);
                			$userdata=array(
            			
                			'username' => $this->input->post('prep_area_name'),
                			'email' => $this->input->post('prep_area_useremail')
                			
                			);
                        }
        		       
        		        
    
        		        $res = $this->Forms_model->updatePrepArea($data,$userdata,$id,$old_email);
        		        
            if($res){
				$this->session->set_flashdata('sucess_msg', 'Prep Area has been sucessfully updated');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to update the Prep Area');
			}
		    }else{
		       //add
		        $haccap_table_id = $this->input->post('haccap_table_id');
        	    $prep_area_password = $this->Ion_auth_model->hash_password($this->input->post('prep_area_password'));
        		         
        		         
        		$prep_area_table= serialize($haccap_table_id);  
        		       
                         
        		       
        		$data=array(
        			'branch_id' => $branch_id,
        			'prep_area_name' => $this->input->post('prep_area_name'),
        			'prep_area_useremail' => $this->input->post('prep_area_useremail'),
        // 			'prep_area_password' => $prep_area_password,
        			'prep_area_table' => $prep_area_table,
        			'created_date' => date('Y-m-d')
    			);
// 			echo "<pre>";print_r($data);exit;
		    $insert_id = $this->Forms_model->addPrepArea($data);

			if($insert_id){
			    $menu = array( "18" );
			    $username = strtolower($data['prep_area_name']);
                $email = $data['prep_area_useremail'];
                $phone = '';
                $password = $this->input->post('prep_area_password');
                $role = 'Prep Area';
                $supervisor = '';
                $menus_list = $menu;
                $branch = array($branch_id);
                
                
                
                // echo "branche<pre>";print_r($branch);exit;
            $res = $this->ion_auth->register($username, $password, $email,$role,$phone,$branch,$menus_list,$supervisor);
            
				$this->session->set_flashdata('sucess_msg', 'Prep Area has been sucessfully added');
			}else{
				$this->session->set_flashdata('error_msg', 'Unable to add the Prep Area');
			}
		    }
		    redirect('forms/prep_area_list/');
		
      }
	}
public function delete_prep_area(){
	   
    $id = $this->input->post('id');
    
      
   $res = $this->Forms_model->delete_prep_area($id);
        if($res){
	        echo "deleted";
	   }else{
	       echo "error";
	   }
}
public function update_prep_area_status(){
	   
    $id = $this->input->post('prep_area_id');
    $prep_area_status = $this->input->post('prep_area_status');
    $data = array(
        'prep_area_status' => $prep_area_status,
    );
      
   $res = $this->Forms_model->updatePrepAreaStatus($data,$id);
//          if($res){
// 				$this->session->set_flashdata('sucess_msg', 'Prep Area Status has been sucessfully updated');
// 		}else{
// 			$this->session->set_flashdata('error_msg', 'Unable to update the Prep Area Status');
// 		}

}
public function filterPrepArea(){
    $branch_id = $this->session->userdata('branch_id');
			
			$filter = array();
			
		    if(isset($_POST['prep_area_name']) && $_POST['prep_area_name']!=''){
        	    $filter['prep_area_name'] =  $_POST['prep_area_name'];
        	}
        	else{
        	    $filter['prep_area_name']='';
        	}
        	$preparea = $this->Forms_model->getPrepAreaFilter($filter,$branch_id);
            
            $html = '';
			if(!empty($preparea)){
        	foreach($preparea as $row){
        	    if(isset($row->prep_area_status) && $row->prep_area_status == '1'){ $checked = "checked"; }else{ $checked = ""; }
        			    $html.= '<tr">
        						<td class="prepName">'.$row->prep_area_name .'</td>
        						<td class="email">'.$row->prep_area_useremail.'</td>	
        						<td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="'.$row->prep_area_id.'" '.$checked.'>
                                                    
                                                </div></td>
        						<td><ul class="list-inline hstack gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="'.base_url().'index.php/forms/prep_area_form_view/'.$row->prep_area_id .'">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="'.base_url().'index.php/forms/prep_area_form/'.$row->prep_area_id.'">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="'.$row->prep_area_id.'" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
        						</td>
        					
        						
        					</tr>';
        					
    			    }
    		}else{
			    $html.='<tr><td colspan="4">No Record Found</td></tr>';
			}
		echo $html; 
}
public function email_check(){
           
        $email = $_POST['email'];
        
        $res = $this->Forms_model->email_check($email);
        
        // print_r($res);exit;
        if($res){
            echo 'false';
        }else{
            echo 'true';
        }
    }
// prep area ends


// 	spreadsheet code
// form sheets
        public function haccap_temp_form($tempFormData){
            
            
            if(!empty($tempFormData)){
			    foreach($tempFormData as $tempForm){
	                $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        foreach($weekdays as $title => $weekday_name) {
                             $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
                        }
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:G6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        $sheet->setCellValue('A6', 'Day');
                        $sheet->setCellValue('B6', 'Equipment name');
                        $sheet->setCellValue('C6', 'AM Time');
                        $sheet->setCellValue('D6', 'AM Temp.');
                        $sheet->setCellValue('E6', 'PM Time');
                        $sheet->setCellValue('F6', 'PM Temp.');
                        $sheet->setCellValue('G6', 'Entered By');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);	
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                	
                		$x = 7;	
                	$count =0;
                		foreach($tempdata as $dayname => $dayData){
                		    $sheet->setCellValue('A'.$x, ucfirst($dayname)." (".date("d-m-Y",strtotime($tempForm->start_date."+ ".$count." DAY")).") ");
                		   if(is_array($dayData)){
                		       	foreach($dayData as $key => $value){
                		       	    $sheet->setCellValue('B'.$x, $value[$dayname."_equipname"]);
                		       	    $sheet->setCellValue('C'.$x, $value[$dayname."_AM_time"]);
                                    $sheet->setCellValue('D'.$x, $value[$dayname."_AM_temp"]);
                                    $sheet->setCellValue('E'.$x, $value[$dayname."_PM_time"]);
                                    $sheet->setCellValue('F'.$x, $value[$dayname."_PM_temp"]);
                                    $sheet->setCellValue('G'.$x, $value[$dayname."_entered_by"]);
                                    $x++;
                		        }
                		    } 
                		    $count++;
                		}
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Temp form '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        
        public function haccap_cold_form($tempFormData){
            
            
            if(!empty($tempFormData)){
                
			    foreach($tempFormData as $tempForm){
			        $data =unserialize($tempForm->mon_data);
			       
			        
			        
	                
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:Q6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        $sheet->setCellValue('A6', 'Prouct Name');
                        $sheet->setCellValue('B6', 'Mon AM Time');
                        $sheet->setCellValue('C6', 'Mon PM Time');
                        $sheet->setCellValue('D6', 'Tue AM Time');
                        $sheet->setCellValue('E6', 'Tue PM Time');
                        $sheet->setCellValue('F6', 'Wed AM Time');
                        $sheet->setCellValue('G6', 'Wed PM Time');
                        $sheet->setCellValue('H6', 'Thu AM Time');
                        $sheet->setCellValue('I6', 'Thu PM Time');
                        $sheet->setCellValue('J6', 'Fri AM Time');
                        $sheet->setCellValue('K6', 'Fri PM Time');
                        $sheet->setCellValue('L6', 'Sat AM Time');
                        $sheet->setCellValue('M6', 'Sat PM Time');
                        $sheet->setCellValue('N6', 'Sun AM Time');
                        $sheet->setCellValue('O6', 'Sun PM Time');
                        $sheet->setCellValue('P6', 'Entered By');
                        $sheet->setCellValue('Q6', 'Signature');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);	
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                	
                		$x = 7;	
                	$count =0;
                	
                		  if(is_array($data)){
                		       	foreach($data as $key => $value){
                		       	    $sheet->setCellValue('A'.$x, $value["product_name"]);
                		       	    $sheet->setCellValue('B'.$x, $value["mon_AM_time"]);
                		       	    $sheet->setCellValue('C'.$x, $value["mon_PM_time"]);
                                    $sheet->setCellValue('D'.$x, $value["tue_AM_time"]);
                                    $sheet->setCellValue('E'.$x, $value["tue_PM_time"]);
                                    $sheet->setCellValue('F'.$x, $value["wed_AM_time"]);
                                    $sheet->setCellValue('G'.$x, $value["wed_PM_time"]);
                                    $sheet->setCellValue('H'.$x, $value["thu_AM_time"]);
                                    $sheet->setCellValue('I'.$x, $value["thu_PM_time"]);
                                    $sheet->setCellValue('J'.$x, $value["fri_AM_time"]);
                                    $sheet->setCellValue('K'.$x, $value["fri_PM_time"]);
                                    $sheet->setCellValue('L'.$x, $value["sat_AM_time"]);
                                    $sheet->setCellValue('M'.$x, $value["sat_PM_time"]);
                                    $sheet->setCellValue('N'.$x, $value["sun_AM_time"]);
                                    $sheet->setCellValue('O'.$x, $value["sun_PM_time"]);
                                    $sheet->setCellValue('P'.$x, $value["entered_by"]);
                                    $sheet->setCellValue('Q'.$x, $value["signature"]);
                                    $x++;
                		        }
                		    } 
                	
                	
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Opening and closing procedure '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        
        public function haccap_dishwashing_form($tempFormData){
            
            if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempdata);exit;
			    foreach($tempFormData as $tempForm){
	                $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        foreach($weekdays as $title => $weekday_name) {
                             $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
                        }
                        
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:J6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        
                        $sheet->setCellValue('A6', 'Day');
                        $sheet->setCellValue('B6', 'Dishwasher Name');
                        $sheet->setCellValue('C6', 'AM Time');
                        $sheet->setCellValue('D6', 'Wash Cycle (AM)');
                        $sheet->setCellValue('E6', 'Rinse Cycle (AM)');
                        $sheet->setCellValue('F6', 'Signed (AM)');
                        $sheet->setCellValue('G6', 'PM Time');
                        $sheet->setCellValue('H6', 'Wash Cycle (PM)');
                        $sheet->setCellValue('I6', 'Rinse Cycle (PM)');
                        $sheet->setCellValue('J6', 'Signed (PM)');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                		$x = 7;	
                	$count =0;
                		foreach($tempdata as $dayname => $dayData){
                		   $sheet->setCellValue('A'.$x, ucfirst($dayname)." (".date("d-m-Y",strtotime($tempForm->start_date."+ ".$count." DAY")).") ");
                		   if(is_array($dayData)){
                		       	foreach($dayData as $key => $value){
                		       	    $sheet->setCellValue('B'.$x, $value[$dayname."_name"]);
                		       	    $sheet->setCellValue('C'.$x, $value[$dayname."_AM_time"]);
                                    $sheet->setCellValue('D'.$x, $value[$dayname."_AM_field1"]);
                                    $sheet->setCellValue('E'.$x, $value[$dayname."_AM_field2"]);
                                    $sheet->setCellValue('F'.$x, $value[$dayname."_AM_field3"]);
                                    $sheet->setCellValue('G'.$x, $value[$dayname."_PM_time"]);
                                    $sheet->setCellValue('H'.$x, $value[$dayname."_PM_field1"]);
                                    $sheet->setCellValue('I'.$x, $value[$dayname."_PM_field2"]);
                                    $sheet->setCellValue('J'.$x, $value[$dayname."_PM_field3"]);
                                    $x++;
                		        }
                		    } 
                		    $count++;
                		}
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Dishwasher Washing and Rinse Temperature Records '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_retention_stock_form($tempFormData){
            
            if(!empty($tempFormData)){
                
			    foreach($tempFormData as $tempForm){
			        $data =unserialize($tempForm->mon_data);
			       
			        
			        
	                
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:X6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        $sheet->setCellValue('A6', 'Prouct Name');
                        $sheet->setCellValue('B6', 'Mon AM Time');
                        $sheet->setCellValue('C6', 'Mon PM Time');
                        $sheet->setCellValue('D6', 'Mon Temp');
                        $sheet->setCellValue('E6', 'Tue AM Time');
                        $sheet->setCellValue('F6', 'Tue PM Time');
                        $sheet->setCellValue('G6', 'Tue Temp');
                        $sheet->setCellValue('H6', 'Wed AM Time');
                        $sheet->setCellValue('I6', 'Wed PM Time');
                        $sheet->setCellValue('J6', 'Wed Temp');
                        $sheet->setCellValue('K6', 'Thu AM Time');
                        $sheet->setCellValue('L6', 'Thu PM Time');
                        $sheet->setCellValue('M6', 'Thu Temp');
                        $sheet->setCellValue('N6', 'Fri AM Time');
                        $sheet->setCellValue('O6', 'Fri PM Time');
                        $sheet->setCellValue('P6', 'Fri Temp');
                        $sheet->setCellValue('Q6', 'Sat AM Time');
                        $sheet->setCellValue('R6', 'Sat PM Time');
                        $sheet->setCellValue('S6', 'Sat Temp');
                        $sheet->setCellValue('T6', 'Sun AM Time');
                        $sheet->setCellValue('U6', 'Sun PM Time');
                        $sheet->setCellValue('V6', 'Sun Temp');
                        $sheet->setCellValue('W6', 'Entered By');
                        $sheet->setCellValue('X6', 'Signature');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);	
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                	
                		$x = 7;	
                	$count =0;
                	
                		  if(is_array($data)){
                		       	foreach($data as $key => $value){
                		       	    $sheet->setCellValue('A'.$x, $value["product_name"]);
                		       	    $sheet->setCellValue('B'.$x, $value["mon_AM_time"]);
                		       	    $sheet->setCellValue('C'.$x, $value["mon_PM_time"]);
                		       	    $sheet->setCellValue('D'.$x, $value["mon_temp"]);
                                    $sheet->setCellValue('E'.$x, $value["tue_AM_time"]);
                                    $sheet->setCellValue('F'.$x, $value["tue_PM_time"]);
                                    $sheet->setCellValue('G'.$x, $value["tue_temp"]);
                                    $sheet->setCellValue('H'.$x, $value["wed_AM_time"]);
                                    $sheet->setCellValue('I'.$x, $value["wed_PM_time"]);
                                    $sheet->setCellValue('J'.$x, $value["wed_temp"]);
                                    $sheet->setCellValue('K'.$x, $value["thu_AM_time"]);
                                    $sheet->setCellValue('L'.$x, $value["thu_PM_time"]);
                                    $sheet->setCellValue('M'.$x, $value["thu_temp"]);
                                    $sheet->setCellValue('N'.$x, $value["fri_AM_time"]);
                                    $sheet->setCellValue('O'.$x, $value["fri_PM_time"]);
                                    $sheet->setCellValue('P'.$x, $value["fri_temp"]);
                                    $sheet->setCellValue('Q'.$x, $value["sat_AM_time"]);
                                    $sheet->setCellValue('R'.$x, $value["sat_PM_time"]);
                                    $sheet->setCellValue('S'.$x, $value["sat_temp"]);
                                    $sheet->setCellValue('T'.$x, $value["sun_AM_time"]);
                                    $sheet->setCellValue('U'.$x, $value["sun_PM_time"]);
                                    $sheet->setCellValue('V'.$x, $value["sun_temp"]);
                                    $sheet->setCellValue('W'.$x, $value["entered_by"]);
                                    $sheet->setCellValue('X'.$x, $value["signature"]);
                                    $x++;
                		        }
                		    } 
                	
                	
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Retention Stock Form '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_production_record_time($tempFormData){
            
           if(!empty($tempFormData)){
			    foreach($tempFormData as $tempForm){
	                $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        foreach($weekdays as $title => $weekday_name) {
                             $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
                        }
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:L6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(60, 'pt');
                        
                        $sheet->getColumnDimension('K')->setWidth(100, 'pt');
                        $sheet->setCellValue('A6', 'Day');
                        $sheet->setCellValue('B6', 'Product Name &/ or internal Batch Code Allocated');
                        $sheet->setCellValue('C6', 'Time Started Cooking or Prep');
                        $sheet->setCellValue('D6', 'Time Finished Cooking or Prep');
                        $sheet->setCellValue('E6', 'Temp Of Product At End Of Cooking or Prep');
                        $sheet->setCellValue('F6', 'Time Chilling Process Started');
                        $sheet->setCellValue('G6', 'Temp Of Product At End Of First 4hrs');
                        $sheet->setCellValue('H6', 'Time Chilling Process started of 5th hr');
                        $sheet->setCellValue('I6', 'Temp Of Product At 5th hr Of Chilling');
                        $sheet->setCellValue('J6', 'Temp Of Product At End Of 6th hr');
                        $sheet->setCellValue('K6', 'Comments (Where did product go- Sandwich Display – Hot Food – Salad Display, Cool room etc...)');
                        $sheet->setCellValue('L6', 'Entered By');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                		$x = 7;	
                	$count =0;
                		foreach($tempdata as $dayname => $dayData){
                		    
                		   $sheet->setCellValue('A'.$x, ucfirst($dayname)." (".date("d-m-Y",strtotime($tempForm->start_date."+ ".$count." DAY")).") ");
                		   if(is_array($dayData)){
                		       	foreach($dayData as $key => $value){
                		       	    
                		       	    $sheet->setCellValue('B'.$x, $value[$dayname."_name"]);
                		       	    $sheet->setCellValue('C'.$x, $value[$dayname."_cooking_time"]);
                		       	    $sheet->setCellValue('D'.$x, $value[$dayname."_cooking_field1"]);
                                    $sheet->setCellValue('E'.$x, $value[$dayname."_cooking_field2"]);
                                    $sheet->setCellValue('F'.$x, $value[$dayname."_chilling_time"]);
                		       	    $sheet->setCellValue('G'.$x, $value[$dayname."_chilling_field2"]);
                                    $sheet->setCellValue('H'.$x, $value[$dayname."_chilling_field3"]);
                                    $sheet->setCellValue('I'.$x, $value[$dayname."_chilling_field4"]);
                                    $sheet->setCellValue('J'.$x, $value[$dayname."_chilling_field5"]);
                                    $sheet->setCellValue('K'.$x, $value[$dayname."_comments"]);
                                    $sheet->setCellValue('L'.$x, $value[$dayname."_entered_by"]);
                                    $x++;
                		        }
                		    }
                		    $count++;
                		}
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Production Record Time-Temperature Cooking Record Sheet '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_calibration_form($tempFormData){
            
            //   echo "<pre>";print_r($tempFormData);exit;
              
              $data_record = unserialize($tempFormData[0]->data_record);
                //  echo "<pre>";print_r($data_record);exit;
            if(!empty($tempFormData)){
             
	               // $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        // foreach($weekdays as $title => $weekday_name) {
                        //      $tempdata[$title] = ($tempForm->$weekday_name !='' ?  unserialize($tempForm->$weekday_name) : '');
                        // }
                        
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:H6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        $sheet->setCellValue('A6', 'Date');
                        $sheet->setCellValue('B6', 'Item (brand or ID)');
                        $sheet->setCellValue('C6', 'Hot +/-');
                        $sheet->setCellValue('D6', 'Cold +/-');
                        $sheet->setCellValue('E6', 'Difference +/-');
                        $sheet->setCellValue('F6', 'Adjustment required');
                        $sheet->setCellValue('G6', 'Final Result');
                        $sheet->setCellValue('H6', 'Entered By');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempFormData[0]->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempFormData[0]->prep_name);
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempFormData[0]->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempFormData[0]->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempFormData[0]->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                		$x = 7;	
                	$count =0;
                		
                		       	foreach($data_record as $key => $value){
                		       	    $sheet->setCellValue('A'.$x, date('d-m-Y', strtotime($value["caliberdate"])));
                		       	    $sheet->setCellValue('B'.$x, $value["name"]);
                		       	    $sheet->setCellValue('C'.$x, $value["hot"]);
                		       	    $sheet->setCellValue('D'.$x, $value["cold"]);
                                    $sheet->setCellValue('E'.$x, $value["difference"]);
                                    $sheet->setCellValue('F'.$x, $value["adjustment_required"]);
                		       	    $sheet->setCellValue('G'.$x, $value["final_result"]);
                                    $sheet->setCellValue('H'.$x, $value["entered_by"]);
                                    $x++;
                		        }
                		   
                		
                			$sheet->setCellValue('A'.$x, 'Note: '.$tempFormData[0]->form_note);
                    		$x++;
                    		$sheet->setCellValue('A'.$x, 'Comment: '.$tempFormData[0]->form_comment);
			    
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Calibration-Service and Results '.$tempFormData[0]->cafe_name.' '.$tempFormData[0]->prep_name.' '.date('dS M Y', strtotime($tempFormData[0]->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_food_wastage_report($tempFormData){
                // echo "<pre>";print_r($tempFormData);exit;
            if(!empty($tempFormData)){
             
			    foreach($tempFormData as $tempForm){
	                $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        $tempdata['product_wastage_data'] = unserialize($tempForm->product_wastage_data);
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:L6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        $sheet->setCellValue('A6', 'Product Name');
                        $sheet->setCellValue('B6', 'MON ('.date('d-m-Y',strtotime($tempForm->start_date)).')');
                        $sheet->setCellValue('C6', 'TUE ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 1 DAY')).')');
                        $sheet->setCellValue('D6', 'WED ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 2 DAY')).')');
                        $sheet->setCellValue('E6', 'THU ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 3 DAY')).')');
                        $sheet->setCellValue('F6', 'FRI ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 4 DAY')).')');
                        $sheet->setCellValue('G6', 'SAT ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 5 DAY')).')');
                        $sheet->setCellValue('H6', 'SUN ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 6 DAY')).')');
                        $sheet->setCellValue('I6', 'Total Number of Units');
                        $sheet->setCellValue('J6', 'Price $ Per Unit');
                        $sheet->setCellValue('K6', 'TOTAL WTD');
                        $sheet->setCellValue('L6', 'Entered By');
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Prep. Area Name : '.$tempForm->prep_name);
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A5', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A5', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                		$x = 7;	
                // 	  echo "<pre>";print_r($tempdata['product_wastage_data']);exit;
                		foreach($tempdata['product_wastage_data'] as $product_wd){
                		    	 // echo "<pre>";print_r($product_wd['mon_field']);exit;
                		  
                		       	    $sheet->setCellValue('A'.$x, $product_wd['product_name']);
                		       	    $sheet->setCellValue('B'.$x, $product_wd['mon_field']);
                		       	    $sheet->setCellValue('C'.$x, $product_wd['tue_field']);
                                    $sheet->setCellValue('D'.$x, $product_wd['wed_field']);
                                    $sheet->setCellValue('E'.$x, $product_wd['thu_field']);
                		       	    $sheet->setCellValue('F'.$x, $product_wd['fri_field']);
                                    $sheet->setCellValue('G'.$x, $product_wd['sat_field']);
                                    $sheet->setCellValue('H'.$x, $product_wd['sun_field']);
                                    $sheet->setCellValue('I'.$x, $product_wd['price_per_unit']);
                                    $sheet->setCellValue('J'.$x, $product_wd['total_no_units']);
                                    $sheet->setCellValue('K'.$x, $product_wd['total_wtd']);
                                    $sheet->setCellValue('L'.$x, $product_wd['entered_by']);
                                    $x++;
                		       
                		}
                		
                			$sheet->setCellValue('A'.$x, 'Note: '.$tempFormData[0]->form_note);
                    		$x++;
                    		$sheet->setCellValue('A'.$x, 'Comment: '.$tempFormData[0]->form_comment);
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Food Wastage Report '.$tempForm->cafe_name.' '.$tempForm->prep_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
        }
        public function haccap_kitchen_operational_closedown_checklist($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempdata);exit;
               
                  
			    foreach($tempFormData as $tempForm){
	                $weekdays = array('mon'=>'mon_data','tue'=>'tue_data','wed'=>'wed_data','thu'=>'thu_data','fri'=>'fri_data','sat'=>'sat_data','sun'=>'sun_data');
         
                        foreach($weekdays as $title => $weekday_name) {
                             $tempdata[$title] = ($tempForm->$title !='' ?  unserialize($tempForm->$title) : '');
                        }
                        // echo "<pre>";print_r($tempdata);exit;
                        $all_fields_name = array(
                            
                           'fridge_temp'=> 'Ensure all the Fridge Temperature At 5˚C or below',
                           'dishwasher'=> 'Dishwasher Empty / Cleaned Down & Switched Off	',
                           'combi_oven'=> 'Combi Oven Off & Cleaned with Door Left Open',
                            'cooktop_off'=>'Ensure Cook Top Gas all Switched to Off Position',
                            'cooktop_washed'=> 'Ensure Cook Top Ovens Washed & Gas all Switched to Off Position',
                            'hotplates'=> 'Both Hot Plates ( Grill Top Off )',
                            'deep_fryers_off'=>'Ensue Deep Fryers Switched Off and Oil Filtered If Not Changed	',
                            'dough_mixer_off'=>'Dough Mixer Ensure Switch Off At Power Point',
                            'cool_room_off'=> 'Ensure Cool room Door & Light Closed & Temperature At 5˚C or below	',
                            'chest_freeser_closed'=>'Ensure Chest Freezer Doors Closed , Temperature At -18˚C or Below	',
                            'lights_off'=>'Lights Switched Off And door Left Jarred For Air Flow. Ensure Change rooms Storage Areas Clean & Lights Off	',
                            'exit_door_closed'=>'Ensure Back Exit Door Closed & Locked	',
                            'hot_boxes_washed'=>'Ensure Hot Boxes Washed / Switched Off & Doors Left Open',
                            'mixer_off'=>'Mixer Turned Off At P/P & Cleaned',
                            'slicer_off'=>'Slicer Turned Off At P/P & Cleaned	',
                            'benchtop_cleaned'=>'Bench Tops Cleaned & Clear	',
                            'main_freezer_closed'=>'Ensure Main Freezer Door & Light Closed & Temperature At -18˚C or below	',
                            'wall_power_point_off'=>'All Wall Power Points Switched Off',
                            'rubbish_bins_washed'=>'Washed and Relined Rubbish Bins',
                            'kitchen_light_off'=>'Ensure Lights Switched Off In Kitchen',
                            
                            );
                        
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A6:H6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        $sheet->setCellValue('A6', 'Name');
                        $sheet->setCellValue('B6', 'Monday ('.date('d-m-Y',strtotime($tempForm->start_date)).')');
                        $sheet->setCellValue('C6', 'Tuesday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 1 DAY')).')');
                        $sheet->setCellValue('D6', 'Wednesday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 2 DAY')).')');
                        $sheet->setCellValue('E6', 'Thursday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 3 DAY')).')');
                        $sheet->setCellValue('F6', 'Friday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 4 DAY')).')');
                        $sheet->setCellValue('G6', 'Saturday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 5 DAY')).')');
                        $sheet->setCellValue('H6', 'Sunday ('.date('d-m-Y',strtotime($tempForm->start_date.'+ 6 DAY')).')');
                     
                      
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                
                		$sheet->setCellValue('A1', 'Cafe Name : '.$tempForm->cafe_name);
                		$sheet->setCellValue('A2', 'Verified By : '.$tempForm->verified_by);
                		$sheet->setCellValue('A3', 'Document Record Number : '.$tempForm->document_record_number);
                		$sheet->setCellValue('A4', 'Date : '.date('d-m-Y', strtotime($tempForm->start_date)));
                // 		$sheet->setCellValue('A4', 'End Date : '.date('d-m-Y', strtotime($tempForm->end_date)));
                		$x = 7;	
                	  
                		foreach($all_fields_name as $fieldname => $fieldvalue){
                		foreach($weekdays as $wekday_shortname => $weekday_name) {
                		 $sheet->setCellValue('A'.$x, $fieldvalue);
                		for ($alpha = 66; $alpha <= 72; $alpha++) {
                		  //  echo chr($alpha).$x;exit;
                		  // var_dump($tempdata[$wekday_shortname][$wekday_shortname.'_'.$fieldname]); exit;
                        $sheet->setCellValue(chr($alpha).$x, ($tempdata[$wekday_shortname][$wekday_shortname.'_'.$fieldname] == '1' ? 'Done' : ''));
                		 }

                		  }
                        $x++;

                		}
                		
			    }
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Kitchen Operational Closedown Checklist '.$tempForm->cafe_name.' '.date('dS M Y', strtotime($tempForm->start_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_operational_incident_report($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempFormData);exit;
               
                       
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A23')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $spreadsheet->getActiveSheet()->getStyle('B1:B23')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e7e7e7');
                
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                        
                        $sheet->setCellValue('A1', 'Document Record Number');
                		$sheet->setCellValue('A2', 'Corrective Action (Operational)');
                		$sheet->setCellValue('A3', 'Date');
                		$sheet->setCellValue('A4', 'Time');
                		$sheet->setCellValue('A5', 'Reason for Non-conformance');
                		$sheet->setCellValue('A6', 'Name of Company/Organisation');
                		$sheet->setCellValue('A7', 'Name of Contact Person');
                		$sheet->setCellValue('A8', 'Contact Number');
                		$sheet->setCellValue('A9', 'Report');
                		$sheet->setCellValue('A10', 'Reply To');
                		$sheet->setCellValue('A11', 'Date');
                		$sheet->setCellValue('A12', 'Incident Date');
                		$sheet->setCellValue('A13', 'Description of Non-conformance');
                		$sheet->setCellValue('A14', 'Detailed Description of Event');
                		$sheet->setCellValue('A15', 'Classification');
                		$sheet->setCellValue('A16', 'Reason of Occurance & Outcome');
                		$sheet->setCellValue('A17', 'Date Corrective Action Taken');
                		$sheet->setCellValue('A18', 'Verified By');
                		$sheet->setCellValue('A19', 'Results (office use only)');
                		$sheet->setCellValue('A20', 'Satisfactory');
                		$sheet->setCellValue('A21', 'Un-satisfactory');
                		$sheet->setCellValue('A22', 'Followup');
                		$sheet->setCellValue('A23', 'Signed By');
                		
                		$sheet->setCellValue('B1', $tempFormData[0]->document_record_number);
                		$sheet->setCellValue('B2', $tempFormData[0]->correctiveaction);
                		$sheet->setCellValue('B3', date('d-m-Y', strtotime($tempFormData[0]->correctiveaction_date)));
                		$sheet->setCellValue('B4', $tempFormData[0]->correctiveaction_time);
                		$sheet->setCellValue('B5', $tempFormData[0]->reason_for_non_conformance);
                		$sheet->setCellValue('B6', $tempFormData[0]->organisation);
                		$sheet->setCellValue('B7', $tempFormData[0]->name_of_contact_person);
                		$sheet->setCellValue('B8', $tempFormData[0]->contact_of_contact_person);
                		$sheet->setCellValue('B9', $tempFormData[0]->report);
                		$sheet->setCellValue('B10', $tempFormData[0]->reply_to);
                		$sheet->setCellValue('B11', date('d-m-Y', strtotime($tempFormData[0]->reply_to_date)));
                		$sheet->setCellValue('B12', date('d-m-Y', strtotime($tempFormData[0]->incident_date)));
                		$sheet->setCellValue('B13', $tempFormData[0]->description_of_non_conformance);
                		$sheet->setCellValue('B14', $tempFormData[0]->detailed_description_of_event);
                		$sheet->setCellValue('B15', $tempFormData[0]->classification);
                		$sheet->setCellValue('B16', $tempFormData[0]->reason_of_occurance);
                		$sheet->setCellValue('B17', date('d-m-Y', strtotime($tempFormData[0]->date_corrective_action_taken)));
                		$sheet->setCellValue('B18', $tempFormData[0]->verified_by);
                		$sheet->setCellValue('B19', $tempFormData[0]->results);
                		$sheet->setCellValue('B20', $tempFormData[0]->satisfactory);
                		$sheet->setCellValue('B21', $tempFormData[0]->unsatisfactory);
                		$sheet->setCellValue('B22', $tempFormData[0]->followup);
                        $sheet->setCellValue('B23', $tempFormData[0]->signed_by);
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Operational Incident Report And Corrective Action Record '.$tempFormData[0]->correctiveaction.' '.date('dS M Y', strtotime($tempFormData[0]->correctiveaction_date));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haacp_recipe_form($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempFormData);exit;
               
                       $ingredients=unserialize($tempFormData[0]->ingredients);
            		  
            		    $recipe_method=unserialize($tempFormData[0]->recipe_method);
            		    
            		    $allergens=unserialize($tempFormData[0]->allergens);
		    
                        //   echo "<pre>";print_r($allergens);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                         $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                        $spreadsheet->getActiveSheet()->getStyle('A7:E7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        
                        $sheet->setCellValue('A7', 'Ingredients (include brand)');
                        $sheet->setCellValue('B7', 'Amounts (Quantity)');
                        $sheet->setCellValue('C7', 'Amounts (Units)');
                        $sheet->setCellValue('D7', 'Common allergens present');
                        $sheet->setCellValue('E7', 'Ingredient substitution options');
                        
                        
                        
                        
                        
                        $sheet->getDefaultColumnDimension()->setWidth(30, 'pt');
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                        
                        
                		$sheet->setCellValue('A1', 'Recipe Name : '.$tempFormData[0]->recipe_name);
                		$sheet->setCellValue('A2', 'Yield : '.$tempFormData[0]->yield);
                		$sheet->setCellValue('A3', 'Portion size : '.$tempFormData[0]->portion_size);
                		$sheet->setCellValue('A4', 'Serving Size : '.$tempFormData[0]->serving_size_name);
                		$sheet->setCellValue('A5', 'Document Record Number : '.$tempFormData[0]->document_record_number);
                		
                		$x = 8;	
                	
                		foreach($ingredients as $rec){
                		    
                		       	    $sheet->setCellValue('A'.$x, $rec['ingredient']);
                		       	    $sheet->setCellValue('B'.$x, $rec['quantity']);
                                    $sheet->setCellValue('C'.$x, $rec['units']);
                                    $sheet->setCellValue('D'.$x, $rec['allergens_present']);
                                    $sheet->setCellValue('E'.$x, $rec['ingredient_substitution_options']);
                                    $x++;
                		        
                		    
                		}
                		$x++;
                		$spreadsheet->getActiveSheet()->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                		$sheet->setCellValue('A'.$x, 'METHOD');
                                    $x++;
                                    $j=1;
                		foreach($recipe_method as $rec1){
                		    
                		       	    $sheet->setCellValue('A'.$x, 'Step '.$j.':'.$rec1);
                                    $x++;
                                     $j++;
                		        
                		    
                		}
                		$x++;
                		$spreadsheet->getActiveSheet()->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                		$spreadsheet->getActiveSheet()->getStyle('B'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                		$sheet->setCellValue('A'.$x, 'Common Allergens Present');
                		
                		$x++;
                		$sheet->setCellValue('A'.$x, 'Milk (dairy)');
                		$sheet->setCellValue('B'.$x, ($allergens[1]['milk'] == '1')? 'YES' : 'NO');
                		$x++;
                        $sheet->setCellValue('A'.$x, 'Egg');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['egg'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Fish');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['fish'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Crustacean');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['crustacean'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Mollusc');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['mollusc'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Sesame');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['sesame'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Lupin');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['lupin'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Soy');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['soy'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Peanut');
                        $sheet->setCellValue('B'.$x, ($allergens[1]['peanut'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Wheat'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['wheat'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Barley'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['barley'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Oats'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['oats'] == '1')? 'YES' : 'NO');
                        $x++;
                         
                        $sheet->setCellValue('A'.$x, 'Rye'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['rye'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Gluten'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['gluten'] == '1')? 'YES' : 'NO');
                        $x++;
                	    
                	    $spreadsheet->getActiveSheet()->getStyle('A'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                		$spreadsheet->getActiveSheet()->getStyle('B'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                		
                		$sheet->setCellValue('A'.$x, 'TREE NUTS:'); 
                		$sheet->setCellValue('B'.$x, '');
                		$x++;
                		 
                		$sheet->setCellValue('A'.$x, 'Almond'); 
                		$sheet->setCellValue('B'.$x, ($allergens[1]['almond'] == '1')? 'YES' : 'NO');
                		$x++;
                        $sheet->setCellValue('A'.$x, 'Brazil nut'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['brazil_nut'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Cashew'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['cashew'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Hazelnut'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['hazelnut'] == '1')? 'YES' : 'NO');
                        $x++;
                    
                        $sheet->setCellValue('A'.$x, 'Macadamia'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['macadamia'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Pecan'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['pecan'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Pine nut'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['pine_nut'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Pistachio'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['pistachio'] == '1')? 'YES' : 'NO');
                        $x++;
                        $sheet->setCellValue('A'.$x, 'Walnut'); 
                        $sheet->setCellValue('B'.$x, ($allergens[1]['walnut'] == '1')? 'YES' : 'NO');
                        $x++;
                        
                        
                       
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Recipe '.$tempFormData[0]->recipe_name;
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_mockrecall_record($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempFormData);exit;
               
                       
                        //   echo "<pre>";print_r($tempdata);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                        
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                        
                        $sheet->setCellValue('A1', 'Document Record Number : '.$tempFormData[0]->document_record_number);
                		$sheet->setCellValue('A2', 'Date Initiated');
                		$sheet->setCellValue('A3', 'Time Initiated');
                		$sheet->setCellValue('A4', 'Date Completed');
                		$sheet->setCellValue('A5', 'Time Completed');
                		$sheet->setCellValue('A6', 'Description of Product or Raw Material');
                		$sheet->setCellValue('A7', 'Description of Scenario');
                		$sheet->setCellValue('A8', 'Completed By');
                		$sheet->setCellValue('A9', 'Date');
                		$sheet->setCellValue('A10', 'Time');
                		$sheet->setCellValue('A11', 'Reviewed by');
                		$sheet->setCellValue('A12', 'Date');
                		$sheet->setCellValue('A13', 'Time');
                		$sheet->setCellValue('A14', 'Note');
                		$sheet->setCellValue('A15', 'Comment');
                		
                		
                		$sheet->setCellValue('B2', date('d-m-Y', strtotime($tempFormData[0]->date_initiated)));
                		$sheet->setCellValue('B3', $tempFormData[0]->time_initiated);
                		$sheet->setCellValue('B4', date('d-m-Y', strtotime($tempFormData[0]->date_completed)));
                		$sheet->setCellValue('B5', $tempFormData[0]->time_completed);
                		$sheet->setCellValue('B6', $tempFormData[0]->description_of_product);
                		$sheet->setCellValue('B7', $tempFormData[0]->description_of_scenario);
                		$sheet->setCellValue('B8', $tempFormData[0]->completed_by);
                		$sheet->setCellValue('B9', date('d-m-Y', strtotime($tempFormData[0]->completed_by_date)));
                		$sheet->setCellValue('B10', $tempFormData[0]->completed_by_time);
                		$sheet->setCellValue('B11', $tempFormData[0]->reviewed_by);
                		$sheet->setCellValue('B12', date('d-m-Y', strtotime($tempFormData[0]->reviewed_by_date)));
                		$sheet->setCellValue('B13', $tempFormData[0]->reviewed_by_time);
                		$sheet->setCellValue('B14', $tempFormData[0]->form_note);
                		$sheet->setCellValue('B15', $tempFormData[0]->form_comment);
                		
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Mockrecall Record '.date('dS M Y', strtotime($tempFormData[0]->date_initiated)).'-'.date('dS M Y', strtotime($tempFormData[0]->date_completed));
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_training_record($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempFormData);exit;
                        $rec=array();
                       $training_records=unserialize($tempFormData[0]->training_record);
        		        
        		        
        		      //  $data['TempFormData'] = array(
        		      //      'cafe_name'  =>  $tempFormData[0]->cafe_name,
        		      //      'training_records'  => $rec
                //         );
                        
                        
                        //   echo "<pre>";print_r($training_records);exit;
                        $spreadsheet = new Spreadsheet(); 
            
                        $sheet = $spreadsheet->getActiveSheet();
                        $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                       
                
                        $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                        $sheet->getColumnDimension('A')->setAutoSize(true);
                        $sheet->getColumnDimension('B')->setAutoSize(true);
                        
                        $sheet->setCellValue('A1', 'Cafe Name : '.$tempFormData[0]->cafe_name);
                        $sheet->setCellValue('A2', 'Role : '.$tempFormData[0]->role);
                        $sheet->setCellValue('A3', 'Employee : '.$tempFormData[0]->emp);
                        
                        
                		$x=4;
                        
                    		 $spreadsheet->getActiveSheet()->getStyle('A'.$x.':'.'D'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e7e7e7');
                    		$sheet->setCellValue('A'.$x, 'Skill or Training requirments');
                    		$sheet->setCellValue('B'.$x, 'Required Skill Level');
                    		$sheet->setCellValue('C'.$x, 'Current Capability');
                    		$sheet->setCellValue('D'.$x, 'Future Training required?');
                    		$x=$x+1;
                    		foreach($training_records as $training_record){
                    		   
                    		    $sheet->setCellValue('A'.$x, $training_record['skill_name']);
                    		    $sheet->setCellValue('B'.$x, $training_record['required_skill_level']);
                    		    $sheet->setCellValue('C'.$x, $training_record['current_capability']);
                    		    $sheet->setCellValue('D'.$x, ($training_record['future_training_required'] == '1')? 'YES' : 'NO');
                    		    $x=$x+1;
                    		}
                    		$x=$x+2;
                    		
                        
                		
            }
    // 		return $spreadsheet;
    $writer = new Xlsx($spreadsheet); 
   
        $filename = 'Staff Training Record '.$tempFormData[0]->cafe_name;
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
         $writer->save('php://output');
        exit;
             
        }
        public function haccap_food_transfer_and_order_record($tempFormData){
           	if(!empty($tempFormData)){
                // echo "<pre>";print_r($tempFormData);exit;
                        $rec=array();
                       $training_records=unserialize($tempFormData[0]->data_record);
                       
                    //   echo "<pre>";print_r($tempFormData);exit;
                       
        	   
        	   //	echo "<pre>"; print_r($result); exit;
        	   
                $spreadsheet = new Spreadsheet(); 
                
                $sheet = $spreadsheet->getActiveSheet();
              
                $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('aaadab');
                $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCFFCC');
                $sheet->getDefaultColumnDimension()->setWidth(25, 'pt');
                $sheet->getStyle('A5:H5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getStyle('A5:H5')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                
                $sheet->setCellValue('A5', 'Date');
                $sheet->setCellValue('B5', 'Item');
                $sheet->setCellValue('C5', 'Price');
                $sheet->setCellValue('D5', 'Temperature at Loading');
                $sheet->setCellValue('E5', 'Temperature at unloading');
                $sheet->setCellValue('F5', 'Delivery Location');
                $sheet->setCellValue('G5', 'Received By');
                $sheet->setCellValue('H5', 'Deliver By');
              
        		$sheet->setCellValue('A1', 'Verified By: '.$tempFormData[0]->verified_by);
        		$sheet->setCellValue('A2', 'Signature: '.$tempFormData[0]->sign_by);
        		$sheet->setCellValue('A3', 'Date: '.date('d-m-Y', strtotime($tempFormData[0]->start_date)));
        		$sheet->setCellValue('A4', 'Document Number: '.$tempFormData[0]->document_record_number);
        		
        		
        	
        		$x = 6;	
        	   
        	
        		if(is_array($training_records)){
        		       	   
        		       	foreach($training_records as $value){
        		       	    
        		       	  //  	echo "<pre>"; print_r($value); exit;
        		       	  $sheet->getRowDimension($x)->setRowHeight(35);
        		       	  $sheet->getStyle('A'.$x.':H'.$x)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('eff5f5');
        		       	   
        		       	    $sheet->setCellValue('A'.$x, date('d-m-Y',strtotime($value['item_date'])));
        		       	    $sheet->setCellValue('B'.$x, $value['item_name']);
                            $sheet->setCellValue('C'.$x, $value['item_price']);
                            $sheet->setCellValue('D'.$x, $value['item_temp_loading']);
                            $sheet->setCellValue('E'.$x, $value['item_temp_unloading']);
                            $sheet->setCellValue('F'.$x, $value['item_delivery_location']);
                            $sheet->setCellValue('G'.$x, $value['item_received_by']);
                            $sheet->setCellValue('H'.$x, $value['item_deliver_by']);
                            
                            $x++;
                        }
        	
        		}
        		$sheet->setCellValue('A'.$x, 'Note: '.$tempFormData[0]->form_note);
        		$x++;
        		$sheet->setCellValue('A'.$x, 'Comment: '.$tempFormData[0]->form_comment);
        		
        		 
              $writer = new Xlsx($spreadsheet); 
              $filename = 'Food Transfer and Order Record '.date('dS M Y',strtotime($tempFormData[0]->start_date));
                
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
                 $writer->save('php://output');
                exit;
           	}
        }
	    public function filterForm() {
      
			$branch_id = $this->session->userdata('branch_id');
			
			$filter = array();
			
		    if(isset($_POST['cafe_name']) && $_POST['cafe_name']!=''){
        	    $filter['cafe_name'] =  $_POST['cafe_name'];
        	}
        	else{
        	    $filter['cafe_name']='';
        	}
        	if(isset($_POST['employee_name']) && $_POST['employee_name']!=''){
        	    $employee_name =  $_POST['employee_name'];
        	}
        	else{
        	    $employee_name='';
        	}
        	if(isset($_POST['prep_name']) && $_POST['prep_name']!=''){
        	    $filter['prep_name'] =  $_POST['prep_name'];
        	}
        	else{
        	    $filter['prep_name'] = '';
        	}
        	if(isset($_POST['start_date']) && $_POST['start_date']!=''){
        	    $filter['start_date'] =  $_POST['start_date'];
        	}
        	 else{
        	     $filter['start_date']='';
        	 }
        	 if(isset($_POST['end_date']) && $_POST['end_date']!=''){
        	    $filter['end_date'] =  $_POST['end_date'];
        	}
        	 else{
        	     $filter['end_date']='';
        	 }
        	 
        	 if(isset($_POST['correctiveaction']) && $_POST['correctiveaction']!=''){
        	    $filter['correctiveaction'] =  $_POST['correctiveaction'];
        	}
        	else{
        	    $filter['correctiveaction'] = '';
        	}
        	if(isset($_POST['classification']) && $_POST['classification']!=''){
        	    $filter['classification'] =  $_POST['classification'];
        	}
        	 else{
        	     $filter['classification']='';
        	 }
        	 if(isset($_POST['correctiveaction_date']) && $_POST['correctiveaction_date']!=''){
        	    $filter['correctiveaction_date'] =  $_POST['correctiveaction_date'];
        	}
        	 else{
        	     $filter['correctiveaction_date']='';
        	 }
        	 
        	 
        	 if(isset($_POST['table_name']) && $_POST['table_name']!=''){
        	    $table_name=  $_POST['table_name'];
        	}
        	$tempFormList = $this->Forms_model->filterFormList($branch_id,$filter,$table_name);
// 			$data['table_name'] = $table_name;
        	
        // 	echo "<pre>";print_r($filter);
        
			$html = '';
			if(!empty($tempFormList)){
			    if($table_name == 'haccap_training_record'){
    			    
                    foreach($tempFormList as $row){
                        $training_record = unserialize($row->training_record); 
                        if( $training_record[0]['emp'] == $employee_name){
                            $tempformdata[] = array(
                                'id' => $row->id,
                                'branch_id' => $row->branch_id,
                                'cafe_name' => $row->cafe_name,
                                'employee_name' => $training_record[0]['emp'],
                                'status' => $row->status,
                                ); 
                        }
                        
                        
                        
                    }
                    // echo "<pre>";print_r($tempformdata);exit;
        			foreach($tempformdata as $row){
        			    $html.= '<tr class="tr" style="height: 49px !important;">
        						<td class="text-left">' .$row['cafe_name'] .'</td>
        						<td class="text-left">'. $row['employee_name'] .'</td>
        						<td class="text-center"><a class="btn btn-success" href="'.base_url(). 'index.php/forms/tempFormEdit/'. $row['id'] . '/recreate/' . $table_name . '">Recreate</a></td>
            						<td class="text-center action-icons">
            						    <a class="edit" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row['id'] .'/edit/' . $table_name . '"><span class="glyphicon glyphicon-pencil"></span></a>
            						    <a class="view" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row['id'] . '/view/' . $table_name . '"><span class="glyphicon glyphicon-eye-open"></span></a>
            						    <a class="delete"><type="button" onClick="delete_row(\'' . $row['id'] .'\',\'' . $table_name . '\')"><span class="glyphicon glyphicon-trash"></span></a>
            						</td>
        					
        						
        					</tr>';
    			    }
			    
			    } else if($table_name != 'haccap_operational_incident_report'){
			    
        			foreach($tempFormList as $row){
        			    $html.= '<tr class="tr" style="height: 49px !important;">
        						<td class="text-left">' .$row->cafe_name .'</td>
        						<td class="text-left">'. $row->prep_name .'</td>
        						<td class="text-center">'. date('d-m-Y',strtotime($row->start_date )) .'</td>
        						<td class="text-center">'. date('d-m-Y',strtotime($row->end_date)) .'</td>
        						<td class="text-center"><a class="btn btn-success" href="'.base_url(). 'index.php/forms/tempFormEdit/'. $row->id . '/recreate/' . $table_name . '">Recreate</a></td>
            						<td class="text-center action-icons">
            						    <a class="edit" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row->id .'/edit/' . $table_name . '"><span class="glyphicon glyphicon-pencil"></span></a>
            						    <a class="view" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row->id . '/view/' . $table_name . '"><span class="glyphicon glyphicon-eye-open"></span></a>
            						    <a class="delete"><type="button" onClick="delete_row(\'' . $row->id .'\',\'' . $table_name . '\')"><span class="glyphicon glyphicon-trash"></span></a>
            						</td>
        					
        						
        					</tr>';
    			    }
			    
			    } else{
			        foreach($tempFormList as $row){
    			    $html.= '<tr class="tr" style="height: 49px !important;">
    						<td class="text-left">' .$row->correctiveaction .'</td>
    						<td class="text-left">'. $row->classification .'</td>
    						<td class="text-center">'. date('d-m-Y',strtotime($row->correctiveaction_date )) .'</td>
    						
    						<td class="text-center"><a class="btn btn-success" href="'.base_url(). 'index.php/forms/tempFormEdit/'. $row->id . '/recreate/' . $table_name . '">Recreate</a></td>
        						<td class="text-center action-icons">
        						    <a class="edit" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row->id .'/edit/' . $table_name . '"><span class="glyphicon glyphicon-pencil"></span></a>
        						    <a class="view" href="'.base_url(). 'index.php/forms/tempFormEdit/' . $row->id . '/view/' . $table_name . '"><span class="glyphicon glyphicon-eye-open"></span></a>
        						    <a class="delete"><type="button" onClick="delete_row(\'' . $row->id .'\',\'' . $table_name . '\')"><span class="glyphicon glyphicon-trash"></span></a>
        						</td>
    					
    						
    					</tr>';
    			    }
			    }
			}
			else{
			    $html.='<tr><td colspan="9">No Record Found</td></tr>';
			}
		echo $html;   
    }
    
        
}