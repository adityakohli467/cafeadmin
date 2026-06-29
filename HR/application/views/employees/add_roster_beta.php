<div id="loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.85); z-index:99999; justify-content:center; align-items:center; flex-direction:column;">
  <div style="width:50px; height:50px; border:5px solid #e0e0e0; border-top:5px solid #3498db; border-radius:50%; animation:rosterSpin 0.8s linear infinite;"></div>
  <p style="margin-top:15px; font-size:15px; color:#555; font-weight:500;">Processing roster...</p>
</div>
<style>@keyframes rosterSpin { 0%{transform:rotate(0deg)} 100%{transform:rotate(360deg)} }</style>
<form class="form-inline" role="form" method="post" id="newRoster" action="<?php echo base_url(); ?>index.php/admin/submit_roster" enctype="multipart/form-data">
	
	
<div  class="col-md-12 page-head border-bottom sticky-title" id="stickyTitle">
	<span class="text-center">
	<h3>CREATE ROSTER</h3>
	</span>
<a href="#" id="submit_roster_link" onclick="submitnewRoster()" >CREATE </a>
	</div>
<div class="container empRosterContainer"><div class="row"><div class="col-lg-12"><div class="ct-fltr">
    <input type="hidden" name="roster_template" value="1">
     <div class="ctm-ro-inner">
	 <div class="form-group roster-nm">
      <label for="pwd"> <b> Roster Name: </b><span>*</span> </label>
      <div class='input-group'>
        <input type='text' class="form-control" name="roster_name" autocomplete="off" required>
    </div>
</div>

	 <div class="form-group roster-dt">
	 <div class="dt-inner">
      <label for="pwd"><b>Start date of the week :</b><span>*</span></label>
     <div class='input-group date datetimepicker1'>
    <input type='text' class="form-control" name="start_date" autocomplete="off" required >
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
    </span>
    </div>
    </div>
    
	<div class="dt-inner">
      <label for="pwd"><b>End date of the week :</b><span>*</span></label>
      <div class='input-group date datetimepicker1'>
        <input type='text' class="form-control" name="end_date"autocomplete="off" required>
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
        </span>
     </div>
     </div>
     
     <div class="dt-inner">
      <label for="pwd"><b>Month:</b></label>
      <div class='input-group date datetimepicker1'>
        <?php
        $months = array('January','February','March','April','May','June','July','August','September','October','November','December');
        $current_month = date('F');
        ?>
        <select class="form-control" name="month">
            <?php foreach($months as $m){ ?>
    	    <option value="<?php echo $m; ?>" <?php if($m == $current_month) echo 'selected'; ?>><?php echo $m; ?></option>
    	    <?php } ?>
    	</select>
     </div>
     </div>
     </div>
	</div>
	</div>
	</div>
	</div>
	
	
		<div class="row weekday_line_parent" style="margin-bottom:30px;">		
		<div class="ct-row">
	
		<div class="ct-scroll">
        <table id="week_days" class="weekday_line rosterEmp">
                <thead>
                    <tr class="signleCol"> 
                    	<th> </th>
                    	<th> Monday</th>   
                    	<th> Tuesday </th>  
                    	<th> Wednesday </th>  
                    	<th> Thursday  </th>  
                    	<th> Friday </th>  
                    	<th> Saturday </th>  
                    	<th> Sunday </th>  
                    	<th></th>  
                    	<th></th>   
                    </tr>
                
                </thead>
                	<tbody class="rosterRecord">
                	    <tr>
                	        <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr> 
                                	<th>Employee</th>
                                
                            	    </tr>
                                    </table>
                            </td> 
                            <?php 
                            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                            
                            for ($i = 0; $i < 7; $i++) {
                            ?>
                            <td class="colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr><th>Start</th><th>Finish</th></tr>
                                </table>
                            </td> 
                            <?php } ?>
                            <!--<td class="ct-w colPadding0"> -->
                            <!--    <table class="innerTable greenbackground">-->
                            <!--        <tr> -->
                            <!--    	<th>Role</th>-->
                                
                            <!--	    </tr>-->
                            <!--        </table>-->
                            <!--</td> -->
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr> 
                                	<th>Department</th>
                                
                            	    </tr>
                                    </table>
                            </td> 
                            <td><table class="innerTable greenbackground emptyTable"><tr><th></th></tr></table></td>
                	    </tr>
                        <tr class="employeeRole">
                        
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                  <tr>
                                    <td style="display: flex;">
                                        <select  name="emp_id[]" class="form-control select1 ct-emp-name" onChange="fetchRole(this)" id="emp_slt" required>
                                    	  <option value="">Select</option>
                                    	  <?php foreach($employees as $row){ ?>
                                    	     <option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
                                    	  <?php } ?>
                                    	  </select>
                                    	  <input type="hidden" id="employeeIdSelected">
                                    	  <i class="material-icons" onclick="GetEmpAvailData(this)" style="cursor: pointer;" title="View employee availability">&#xf106;</i>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" readonly name="role_name" value="" title="Role" placeholder="Role" id="empRoleName" class="form-control roles_emp ct-emp-name role-dept">
                                        <input type="hidden" readonly name="role[]" value="" id="empRoleId" class="form-control roles_emp ct-emp-name">
                                    </td>
                                    
                                </tr></table>
                            </td> 
                            
                            <?php 
                            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                            
                            for ($i = 0; $i < 7; $i++) {
                            $startName = $week_days[$i].'_start[]';
                            $endName = $week_days[$i].'_end[]';
                            // $value = $week_days[$i].'_end_time';
                            $break = $week_days[$i].'_break[]';
                            $layout = $week_days[$i].'_layout[]';
                            ?>
                              <td class="colPadding0"> 
                                <table class="innerTable greenbackground">
                                   <tr>
                                        <td>  
                                        <div class='input-group date datetimepicker3'>
                                        <input type='text' class="form-control" name="<?php echo $startName;  ?>">
                                         <span class="input-group-addon" >
                                         <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                            </div>

                                           
                                        </td> 
                                        <td> 
                                        <div class='input-group date datetimepicker3'>
                                        <input type='text' class="form-control" name="<?php echo $endName;  ?>">
                                         <span class="input-group-addon" >
                                         <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                            </div>
                                            
                                        </td> </tr><tr>
                                        <td> 
                                       <div class='input-group'>
                                         <input type='text' class="form-control breakTime" title="Break" placeholder="Break" name="<?php echo $break;?>">                 
                                               </div>
                                        </td> 
                                        <td>  
                                           <div class="input-group">
                                                <input type="text" class="form-control outletwrap" title="Outlet" placeholder="Outlet" name="<?php echo $layout;  ?>" >
                                            </div>
                                        </td>
                                        
                                    </tr> 
                                </table>
                              </td>  <?php } ?>
                            <!--   <td class="ct-w colPadding0"> -->
                            <!--    <table class="innerTable greenbackground">-->
                            <!--      <tr>-->
                            <!--        <td>-->
                            <!--            <input type="text" readonly name="role_name" value="" id="empRoleName" class="form-control roles_emp ct-emp-name role-dept">-->
                            <!--            <input type="hidden" readonly name="role[]" value="" id="empRoleId" class="form-control roles_emp ct-emp-name">-->
                            <!--        </td>-->
                                    
                            <!--    </tr></table>-->
                            <!--</td> -->
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                  <tr>
                                    <td>
                                        <input type="text" name="roster_department[]" value="" class="form-control ct-emp-name role-dept">
                                    </td>
                                    
                                </tr></table>
                            </td> 
                            
                             <td class="colPadding0 actionCol">
                                <table class="innerTable greenbackground">
                                    <tr>
                                        <td>
                                            <div class="ct-col-right ct-btns">
                                             <span class="add_field_wrap"><a href="javascript:void(0)" class="add_field_button" >+</a></span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                              </td> 
                              
                        </tr>
                
                
                </tbody>

        </table>
</div>
</form>
 </div>	</div></div>
	
</div></div></div>
<div id="employee_availability" class="modal fade">
		<div class="modal-dialog" style="max-width: 70%;width: 70%;">
			<div class="modal-content">
			
					<div class="modal-header" style="border-bottom:none !important">						
						<h4 class="modal-title">Employee Availability</h4><br></br>
					
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 34px;opacity: .75;">&times;</button>
					</div>
					<div class="modal-body append_employee_availability">
  					
					</div>
					<div class="modal-footer">

					</div>
				
			</div>
		</div>
	</div>
	 <script src="<?php echo base_url(); ?>assets/js/roster.js"></script>
	<script type="text/javascript">
	
	
	
	// clone row for wrap
    
    $(document).on( 'click', '.add_field_button', function () {
        
    var thisRow = $( this ).closest( '.employeeRole' );
    
    $( thisRow ).clone().insertAfter( thisRow ).find('.form-control').val( '' );
    var thisRowAddbtn = $( thisRow ).next('.employeeRole').find( '.add_field_wrap' );
    if (!$(thisRow).has(".remove_field_button").length) {
   $('<span><a href="#" class="remove_field_button">-</a></span>').insertAfter(thisRowAddbtn);
    } 
    
    $('.datetimepicker3').datetimepicker({
    format: 'HH:mm A'
    });
    
    
    });
    
// $(document).on("click", ".add_field_button" , function() {
// 	 var wrapper  = $(".rosterRecord");
// 	var html='<tr class="newRecord"><td class="ct-w colPadding0"><table class="innerTable greenbackground employeeRole"><tr><td><select  name="emp_id[]" class="form-control select1 ct-emp-name" onChange="fetchRole(this)" id="emp_slt" required>'+
//                 	  '<option value="">Select</option><?php foreach($employees as $row){ ?><option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option><?php } ?></select></td><td><input type="text" readonly name="role_name" value="" id="empRoleName" class="form-control roles_emp ct-emp-name"><input type="hidden" readonly name="role" value="" id="empRoleId" class="form-control roles_emp ct-emp-name">'+
//                 '</td></tr></table></td><?php $week_days = array('mon','tues','wed','thus','fri','sat','sun');for ($i = 0; $i < 7; $i++) { $startName = $week_days[$i].'_start[]';$endName = $week_days[$i].'_end[]';$break = $week_days[$i].'_break[]';?><td class="colPadding0"><table class="innerTable greenbackground">'+
//                 '<tr><td><div class="input-group"><input type="time" class="form-control" name="<?php echo $startName;  ?>"></div></td><td><div class="input-group"><input type="time" class="form-control" name="<?php echo $endName;  ?>"></div></td><td>'+
//                         '<div class="input-group"><input type="text" class="form-control" name="<?php echo $break;?>"></div></td></tr></table></td><?php } ?><td class="colPadding0 actionCol twobtns"><table class="innerTable greenbackground"><tr><td class="colPadding0 actionInnerCol"><div class="ct-col-right ct-btns"><span class=""><a href="javascript:void(0)" class="add_field_button" >+</a></span><span><a href="#" class="remove_field_button">-</a></span></div></td></tr></td></tr>';
// $(wrapper).append(html);


//     });
        
$(document).on("click", ".remove_field_button" , function() {
    $(this).closest('.employeeRole').remove();
});
        
$(document).ready(function(){
$('.datetimepicker3').datetimepicker({
    format: 'HH:mm A'
    });
});
 </script>
	<script type="text/javascript">
            $(function () {
                $('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY'
				});

				// When start_date changes, validate it's a Monday and auto-fill end_date
				$('input[name="start_date"]').closest('.datetimepicker1').on('dp.change', function(e) {
				    if (!e.date) return;
				    var day = e.date.day(); // moment day: 0=Sun, 1=Mon
				    if (day !== 1) {
				        alert('Start date must be a Monday. Please select a Monday.');
				        $(this).data('DateTimePicker').clear();
				        $('input[name="end_date"]').closest('.datetimepicker1').data('DateTimePicker').clear();
				        return;
				    }
				    // Auto-set end date to the coming Sunday (+6 days)
				    var endDate = e.date.clone().add(6, 'days');
				    $('input[name="end_date"]').closest('.datetimepicker1').data('DateTimePicker').date(endDate);
				});
            });
            
           
        </script>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
	<script>


  
  

	
$('.select1').on( "change", function() {
    var op = $( this ).val();
    $('.select2 option').prop('disabled', false);
    $('.select2 option[value='+op+']').prop('disabled', true);
});
</script>


<script>

function submitnewRoster(){
	if (!validateRosterDates()) {
        return false;
    }
	
	
	var form = $("#newRoster");
	var formdata =  form.serialize();
	
	     $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/submit_roster",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").css('display','flex');
                 },
                complete:function(){
                $("#loader").hide();
                 },
		        success: function(data){
		        console.log(data);
		        if(data=='Sucess'){
		        $msg = "Roster Added Succesfully";
		        $icon = "success";
		        }else if(data=='validation'){
		         $msg = "Ensure all mandatory fields are populated";
		         $icon = "warning";
		        }else if(data=='weekvalidation'){
		         $msg = "Roster must be exactly one week: start on Monday and end on Sunday.";
		         $icon = "warning";
		        }
		         <!--start 6Jan 2021 work-->
		         
		         // else if(data=='alreadyAssigned'){
		         // $msg = "Shift Timings are already assigned for the selected employee";
		         // $icon = "warning";
		        //  }
		        
		         <!--End 6Jan 2021 work-->
		        else if(data=='leaveValidation'){
		         $msg = "One of the employees is on leave during the selected shift time. Please ensure the employee is not rostered for the leave days.";
		         $icon = "warning";
		        }else{
		         $msg = "Shift Timings are overlapping for the employee selected";
		         $icon = "warning";
		        } 
		        swal({
		            
                text: $msg,
                 icon: $icon,
          }).then((value) => {
          if(data=='Sucess'){
       window.location = "<?php echo $link; ?>";
       }
       });
		  }
	       });
	}
 function validateRosterDates() {

    const startInput = document.querySelector('input[name="start_date"]');
    const endInput   = document.querySelector('input[name="end_date"]');

    if (!startInput.value || !endInput.value) {
        alert('Start date and End date are required.');
        return false;
    }

    // ✅ Parse DD-MM-YYYY safely
    function parseDDMMYYYY(value) {
        const parts = value.split('-'); // DD-MM-YYYY
        if (parts.length !== 3) return null;

        const day   = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1; // JS months are 0-based
        const year  = parseInt(parts[2], 10);

        return new Date(year, month, day);
    }

    const startDate = parseDDMMYYYY(startInput.value);
    const endDate   = parseDDMMYYYY(endInput.value);

    if (!startDate || isNaN(startDate)) {
        alert('Invalid start date.');
        startInput.value = '';
        return false;
    }

    if (!endDate || isNaN(endDate)) {
        alert('Invalid end date.');
        endInput.value = '';
        return false;
    }

    console.log("startDate =", startDate, "Day =", startDate.getDay());
    console.log("endDate =", endDate, "Day =", endDate.getDay());

    // ✅ Monday = 1
    if (startDate.getDay() !== 1) {
        alert('Start date must be a Monday.');
        startInput.value = '';
        endInput.value = '';
        return false;
    }

    // ✅ Sunday = 0
    if (endDate.getDay() !== 0) {
        alert('End date must be a Sunday.');
        endInput.value = '';
        return false;
    }

    // ✅ Must be exactly 6 days apart
    const diffDays = Math.round(
        (endDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24)
    );

    if (diffDays !== 6) {
        alert('Date range must be exactly Monday to Sunday.');
        endInput.value = '';
        return false;
    }

    return true;
}

</script>


</body>
</html>
