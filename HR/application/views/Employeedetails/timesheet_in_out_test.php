
 
<div class="container ct-timesheet" ><div class="row">
   
      <form class="commonForm" name="myForm_fingerprint" id="myForm_fingerprint">
    	<input type="hidden" name="templateXML" id="templateXML" value="">
    	<input type="hidden" name="capture_time" id="capture_time" value="">
    	<input type="hidden" name="clockin_type" id="clockin_type" value="">
    	<input type="hidden" name="roster_id" id="roster_id" value="">
    	<input type="hidden" name="emp_id" id="emp_id" value="">
    	<input type="hidden" name="roster_group_id" id="roster_group_id" value="">
    	<input type="hidden" name="outletname" id="outletname" value="">
    	<input style="display:none" type="button" name="identify" value="Identify" id="identitiy_automatic_click">
    	</form>
	
<div class="col-5 ct-top mb-3 mt-3">
<div class="control-group">
      <label class="control-label label_timesheet"><b>Select Timesheet</b></label>
      <div class="controls">
          <form id="timsheet_form" action="<?php echo base_url();?>index.php/Employeedetails/fetch_employee_for_timsheet" method="post">
      
      <select name="roster_list" class ='form-control' id="roster_list" onchange="this.form.submit()">
           <option  selected="selected" > Select Timesheet</option>
         <?php if(isset($all_timesheets) && !empty($all_timesheets)) { foreach($all_timesheets as $all_timesheet) {  
          $start = date("d-m-Y", strtotime($all_timesheet->start_date));
          $end = date("d-m-Y", strtotime($all_timesheet->end_date));
         ?>
         
         
        <?php  if($all_timesheet->timesheet_id == $timesheet_id)  { ?>
         <option  selected="selected" value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
		<?php } else { ?>
		<?php
	
		$today_date = date("d-m-Y");
		if (strtotime($today_date) >= strtotime($start) && strtotime($today_date) <= strtotime($end)) {
		    $selected="selected";
		}else{
		    $selected = "";
		}
		?>
		<option <?php echo $selected; ?> value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
		<?php }  }} ?>
		
      </select>
      </form>
      </div>
    </div>
</div>
<div class="col-4 ct-top mt-4">
    <button onclick="RefreshLocalStorge()" class="btn btn-success">Refresh</button>
    </div>
<div class="col-lg-12">

<div class="ct-scroll timesheet_container_div" style="box-shadow: 4px 4px 4px #96a09f;">
<table border="1" class="ct-timeset">
  
    <thead>
        <tr class="ct-out-header">
            <th>Employee Name</th>
            <th>Outlet Name</th>
            <th><?php echo date("l")."  ( ".$today = date('d-m-Y')." )"; ?></th>
            
        </tr>
    </thead>
    <tbody>

	<?php if(!empty($all_emps)){ ?>
		<?php foreach($all_emps as $all_emp){ $outlet_name_without_space = str_replace(' ','',$all_emp->outlet_name); 
		if($all_emp->status == "Disable"){
		    continue;
		}
		?>
		
	<tr class="parent_row">
        <td class="inoutsection_employe"><?php echo ucfirst($all_emp->first_name).' '.ucfirst($all_emp->last_name);  ?><input type="hidden" class="employee_id" value="<?php echo $all_emp->emp_id; ?>">
        </td>
        <td class="inoutsection_employe"><?php echo ucfirst($all_emp->outlet_name);  ?></td>
       <?php
       if($all_emp->fingerprint_auth_status =='1'){
        ?>
	 <td class="inoutsection">
	     
	
      	
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
             <input type="button" name="biometricCapture"  class="btn btn-info" value="<?php echo date("H:i", strtotime($all_emp->in_time)); ?>">
           
            <?php } else { ?>
            
            <input type="button" name="biometricCapture" value="Clock IN" id="<?php echo $all_emp->roster_id; ?>_in_time" class="btn btn-info" onclick="captureBiometric('Identify','in_time',<?php echo $all_emp->emp_id; ?>,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">
         	<label id="serverResult"></label>
            <?php } ?>
            
          
             
           <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>
           <input type="button" name="biometricCapture"  class="btn btn-info" value="<?php echo date("H:i", strtotime($all_emp->break_in_time)); ?>">
            <?php } else { ?>
       <input type="button" name="biometricCapture" value="Break IN"  id="<?php echo $all_emp->roster_id; ?>_break_in_time" class="btn btn-info" onclick="captureBiometric('Identify','break_in_time',<?php echo $all_emp->emp_id; ?>,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">             	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
           <input type="button" name="biometricCapture"  class="btn btn-info" value="<?php echo date("H:i", strtotime($all_emp->break_out_time)); ?>">
           <?php }else{ ?>
     <input type="button" name="biometricCapture" value="Break Out"  id="<?php echo $all_emp->roster_id; ?>_break_out_time" class="btn btn-info" onclick="captureBiometric('Identify','break_out_time',<?php echo $all_emp->emp_id; ?>,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">            	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <input type="button" name="biometricCapture"  class="btn btn-info" value="<?php echo date("H:i", strtotime($all_emp->out_time)); ?>">
            <?php } else { ?>
        <input type="button" name="biometricCapture" value="Clock Out" id="<?php echo $all_emp->roster_id; ?>_out_time" class="btn btn-info" onclick="captureBiometric('Identify','out_time',<?php echo $all_emp->emp_id; ?>,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">            		
             <?php } ?>
 </td>
	   <?php }else{?>  
	   <td>
	       
	        <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="weekday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="weekday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal(<?php echo $all_emp->emp_id; ?>,this)">ENTER PIN</td>	
            <?php } ?>
            
          
             
           <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="weekday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="weekday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal(<?php echo $all_emp->emp_id; ?>,this)">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="weekday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="weekday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal(<?php echo $all_emp->emp_id; ?>,this)">ENTER PIN</td>	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none"  class="weekday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="weekday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal(<?php echo $all_emp->emp_id; ?>,this)">ENTER PIN</td>		
             <?php } ?>
            
            </tr></tbody>


            </table>
	       
	   </td>
	  <?php } ?>
    </tr>
    <?php }} ?>
    </tbody>
    
</table></div></div></div></div>
 
</div>
<div class="modal fade" id="pinModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter Your Pin Number</h4>
        </div>
        <div class="modal-body">
          <p><input type="password" id="employee_pin_entered" name="employee_pin" autocomplete="new-password"><input type="hidden" id="pin_emp_id">
          <input type="hidden" id="current_in_time">
          <input type="hidden" id="current_pin_time"></p>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="verify_pin()" class="btn btn-success btn-ph" id="pin_submit" data-dismiss="modal">Verify</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock In Time</h4>
        </div>
        <div class="modal-body">
          <p><button type="button" onclick="setTime_in_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLOCK IN TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text" id="display_in_time" name="in_time" style="font-size:30px;border:none;width:100%;">
		<input type="hidden" class="unique_roster_id" value="">
        <button type="button" onclick="save_record(this,'myModal')" class="btn btn-success btn-ph" id="in_time" data-dismiss="modal">Save</button>
          <input type="hidden" class="myModal">
         
        </div>
      </div>
    </div>  </div>
  
  
  
   <div class="modal fade" id="clockout" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock Out Time</h4>
        </div>
        <div class="modal-body">
         <p><button type="button" onclick="setTime_out_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLICK OUT TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text"  id="display_out_time" name="out_time" style="font-size:30px;border:none;width:100%">
			<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" id="out_time" onclick="save_record(this,'clockout')">Save</button>
          
           <input type="hidden" class="clockout">
        </div>
      </div>
    </div>
  </div>
  
  
  
   <div class="modal fade" id="break_time" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break In Time </h4>
        </div>
        <div class="modal-body">
        <button type="button" id="break_in" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">IN</button> 
       
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="break_in_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          
          
          <input type="hidden" class="break_time">
          <input type="hidden" id="type" value="break_in_time">
          
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="break_out_time" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break Out Time </h4>
        </div>
        <div class="modal-body">
       
        <button type="button" id="break_out" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">OUT</button>
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="display_break_out_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          <input type="hidden" class="break_time">
          <input type="hidden" id="type"  value="break_out_time">
        </div>
      </div>
    </div>
  </div>
  
  <script>
//   setInterval(function() {
//                   window.location.reload();
//                 }, 60000); 
                
  function show_modal(modal_id,emp_id,obj,roster_id,outletname=''){
      
       $("."+modal_id).val(emp_id+'_'+outletname);
      $("#"+modal_id).show();
     
      var new_class_to_enable = $(obj).attr('class');
      $(".unique_roster_id").val(roster_id);
      $("#current_in_time").val(new_class_to_enable);
      $("#breaktime_class").val(new_class_to_enable);
      $("#break_in_time,#break_out_time,#display_in_time,#display_out_time").val('');
  }
  
  function show_pin_modal(emp_id,class_to_enable){
      $("#pin_emp_id").val(emp_id);
      var new_class_to_enable = $(class_to_enable).prev('td').attr('class');
       var new_class_to_disable = $(class_to_enable).attr('class');
       $("#employee_pin_entered").val('');
      $("#current_in_time").val(new_class_to_enable);
       $("#current_pin_time").val(new_class_to_disable);
  }
  
  function verify_pin(){
     var emp_id= $("#pin_emp_id").val();
     var emp_pin= $("#employee_pin_entered").val();
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/verify_pin",
		method:"POST",
		data:{emp_id:emp_id,emp_pin:emp_pin},
	    success:function(data){
	        if(data=="verified"){
	           $class_to_enable = $("#current_in_time").val();
	           $class_to_disable = $("#current_pin_time").val();
	           $("."+$class_to_enable).show();
	           $("."+$class_to_disable).hide();
	           swal({
          text: "Your Pin has been Verified Succesfully",
          icon: "success",
          timer: 500
          }); 
	        }else{
	            
	            swal({
          text: "Incorrect Pin, Please contact your adminstrator.",
          icon: "warning",
          }); 
	        }

			}
	});
  }
  
  function save_record(obj,classname){
      
      var type = $(obj).attr("id");
      var roster_id = $(obj).prev(".unique_roster_id").val();

      var time = $(obj).val();
      var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
      var outletname = $("#outletname").val();
      
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_record",
		method:"POST",
		data:{in_time:time,type:type,emp_id:emp_id,roster_group_id:roster_group_id,outletname:outletname,roster_id:roster_id},
	    success:function(data){
	        if(data =='sessionexpired'){
	            swal({ text: "Your session has expired. Please login again.", icon: "error" }).then(function(){ window.location.href = "<?php echo base_url();?>index.php/auth/homepage"; });
	            return;
	        }else if(data =='Early'){
	            swal({ text: "Login time not must not exceed 15 mins as per your rosterd time.", icon: "warning", timer: 3300 });
	        }else if(data =='saved'){
	         $class_to_enable = $("#current_in_time").val();
	         $("."+$class_to_enable).html('');
	         $("."+$class_to_enable).removeAttr('data-toggle');
	         
	         if($("#out_time").val() !=''){
	           $("."+$class_to_enable).html($("#out_time").val());  
	         }else{
	            $("."+$class_to_enable).html($("#in_time").val());
	         }
	         
		  swal({
          text: "Time Recorded Successfully",
          icon: "success",
           timer: 500
          });
	        }else{
	            swal({ text: "Failed to save time. Please try again.", icon: "error" });
	        }
			},
		error:function(){
		    swal({ text: "Network error. Time was NOT saved. Please check your connection and try again.", icon: "error" });
		}
	});
  }
  
  function save_break_record(obj,classname,td_class_name){
       
      var roster_id = $(obj).prev(".unique_roster_id").val();
      var break_in_time = $("#break_in_time").val(); 
      console.log(break_in_time);
      if(break_in_time){
       var break_time = $("#break_in_time").val();    
      }else{
          var break_time = $("#display_break_out_time").val(); 
      }
      var break_type = $("#type").val(); 
      var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
       console.log(break_type);
      var break_time_to_display = (break_type == 'break_out_time') ? $("#display_break_out_time").val() : $("#break_in_time").val();
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_break_record",
		method:"POST",
		data:{break_time:break_time,break_type:break_type,roster_group_id:roster_group_id,roster_id:roster_id},
	    success:function(data){
	        if(data =='sessionexpired'){
	            swal({ text: "Your session has expired. Please login again.", icon: "error" }).then(function(){ window.location.href = "<?php echo base_url();?>index.php/auth/homepage"; });
	            return;
	        }else if(data =='saved'){
	            $("."+$class_to_enable).html(break_time_to_display);
	            $("."+$class_to_enable).removeAttr('data-toggle');
			swal({
              text: "Break Time Recorded Successfully",
              icon: "success",
              timer: 500
              });
	        }else{
	            swal({ text: "Failed to save break time. Please try again.", icon: "error" });
	        }
			},
		error:function(){
		    swal({ text: "Network error. Break time was NOT saved. Please check your connection and try again.", icon: "error" });
		}
	});
  }
  
  function setTime_in_time() {
    $("#display_in_time,#in_time").val(getTimeStamp_in_time()); 
}




function getTimeStamp_out_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

function setTime_out_time() {
    $("#display_out_time,#out_time").val(getTimeStamp_out_time());
}

function breaksetTime_in_time(obj) {
    var id = $(obj).attr("id");
    var id = id+"_time";
  
    if(id =="break_in_time"){
        $("#break_in_time").val(getTimeStamp_in_time());
    }else if(id =="break_out_time"){
      $("#display_break_out_time").val(getTimeStamp_in_time());  
    
      
    }
    
    $("#type").val(id);
}

  </script>
  <!--complete fingerprint JS code ..beaware befpre customization-->
  <script>
  
  var engineName = EnumEngines.FingerPrint;
     setInterval(function() {
                  window.location.reload();
                }, 300000); 
/*
* Biometric Capture
*/
function captureBiometric(buttonName,clockin_type,emp_id,roster_id,outletname) {
    
    //populate form with employee data
    
    $("#capture_time").val(getTimeStamp_in_time()); 
    $("#clockin_type").val(clockin_type);
    $("#roster_id").val(roster_id);
    $("#emp_id").val(emp_id);
    $("#outletname").val(outletname);
    $("#roster_group_id").val($("#roster_list_timesheet").val());
    
     
	// debugger
	document.getElementById('templateXML').value = '';

	$('.sresponse').hide();

	var deviceName = getCookieValue("CSDeviceName");
	var templateFormat = getCookieValue("CSTempalteFormat");
	engineName = getCookieValue("CABEngineName");


	var apiPath = "http://localhost:15896/";

	//Init CloudABIS Scanr
	CloudABISScanrInit(apiPath);
     var captureType = 'SingleCapture';
	var quickScan;

	if(buttonName=='Register' || buttonName=='Verify'|| buttonName=='Update' ){
	     quickScan = EnumFeatureMode.Disable;
     }
	else{

	quickScan = 'Enable';
	}

	/*API Call*/
	if (engineName == EnumEngines.FingerPrint) {
	
		FingerPrintCapture(deviceName, quickScan, templateFormat, captureType, EnumCaptureMode.TemplateOnly, EnumBiometricImageFormat.WSQ,
			EnumSingleCaptureMode.LeftFingerCapture, 180.0, EnumCaptureOperationName.ENROLL, CaptureResult,buttonName);
	}
	
	else if (engineName == EnumEngines.FingerVein)
		FingerVeinCapture(deviceName, quickScan, captureType, 180.0, EnumCaptureOperationName.ENROLL, CaptureResult,buttonName);
	else if (engineName == EnumEngines.Iris)
		IrisCapture(deviceName, quickScan, 180.0, EnumFeatureMode.Disable, CaptureResult,buttonName);
	else if (engineName == EnumEngines.Face)
		FaceCapture(quickScan, 180.0, EnumFeatureMode.Disable, EnumFaceImageFormat.Jpeg, EnumCaptureOperationName.ENROLL, CaptureResult,buttonName);
}

function getCookieValue(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

/*
* Hnadle capture data
*/
function CaptureResult(captureResponse,buttonName) {

	//debugger
// 	document.getElementById('serverResult').style.display = 'block';
	if (captureResponse.CloudScanrStatus != null && captureResponse.CloudScanrStatus.Success) {

		if (captureResponse.TemplateData != null && captureResponse.TemplateData.length > 0) {
			document.getElementById('templateXML').value = PHPEncodeHTML(captureResponse.TemplateData);
		}
		else if (engineName == 'IRIS01' && captureResponse.BioImageData != null && captureResponse.BioImageData.length > 0) {
			document.getElementById('templateXML').value = captureResponse.BioImageData;
		}
		else {
			document.getElementById('lblTemplate').style.display = 'none';
		}
	
	      var form_data = $('#myForm_fingerprint');
             $.ajax({
           type: "POST",
          url:"<?php echo base_url();?>index.php/Fingerprintapi/fingerprint_capture_api",
           data: form_data.serialize(), // serializes the form's elements.
           success: function(data)
           {  
               var result_array = JSON.parse(data);
               if(result_array.capture_time !=''){
                   $("#"+result_array.message).val(result_array.capture_time);
                   $("#"+result_array.message).prop( "onclick", null );
               }else{
                   alert(result_array.message);
               }
            
           }
         });
	
		

	}

}
function getTimeStamp_in_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

</script>

<script>
  
    
    window.onload = function() {
        reloadAfterTenHrs();
    };
    
    function reloadAfterTenHrs() {
    let timeUntilReload = 10 * 60 * 60 * 1000;
    
    setTimeout(function() {
        localStorage.removeItem("formSubmitted"); 
     location.reload();
    }, timeUntilReload);
}

function RefreshLocalStorge(){
   localStorage.removeItem("formSubmitted"); 
   setTimeout(function(){
    location.reload();   
   },2000)
}
</script>
