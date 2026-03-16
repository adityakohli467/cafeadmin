<?php 
function add_notification($type,$for,$emp_id='',$status=1){
    
   $CI =& get_instance();
   	$CI->load->model('admin_model');
   	
    $emp_first_name = $CI->admin_model->get_emp_details_fieldwise($emp_id,'first_name');
    
   if($type=='leave_apply'){
      $desc = $emp_first_name.' has applied for leave'; 
   }else if($type=='emp_update'){
      $desc = $emp_first_name.' updated employee details'; 
   }else if($type=='feedback'){
      $desc = $emp_first_name.' submitted feedback'; 
   }
   else if($type=='self_assesment'){
      $desc = $emp_first_name.' submitted self assesment'; 
   }
    else if($type=='reimbursement'){
      $desc = $emp_first_name.' submitted reimbursement'; 
   }
   else if($type=='Incident_Report'){
      $desc = $emp_first_name.' submitted incident report'; 
   }
    else if($type=='Injury_Report'){
      $desc = $emp_first_name.' submitted injury report'; 
   }
    else if($type=='Resignation_Letter'){
      $desc = $emp_first_name.' submitted resignation letter'; 
   }
   else if($type=='Probationary_Period'){
      $desc = $emp_first_name.' submitted Probationary period details.'; 
   }
    else if($type=='Jobkeeper_Nomination_Notice'){
      $desc = $emp_first_name.' submitted Jobkeeper nomination notice.'; 
   }else if($type =='leave_update_to_emp'){
        $desc = $emp_first_name.' , There is a update on your leave request.'; 
   }
   else if($type =='roster_added'){
        $desc = $emp_first_name.' , you have been added in a roster.'; 
   }
   else if($type =='Document'){
        $desc = 'New document uploaded.'; 
   }
   else if($type =='Memo'){
        $desc = 'New memo sent by manager.'; 
   }
    
	    $data  = array(
	       'description' => $desc,
	       'type' => $type,
	       'send_to' => $for,
	        'emp_id' => $emp_id,
	        'date_added' => date('Y-m-d'),
	        'status' => $status
	        );
	     
	        $CI->admin_model->add_notification($data);
	   
	    return true;
}

?>