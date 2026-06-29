<div class="row item">
			</div>
	<form class="form-inline" role="form" method="post" id="hack_submit" enctype="multipart/form-data">	
	<input type="hidden" id="leavecontinueApproval" name="leavecontinueApproval" value="">
	<div  class="col-md-12 page-head border-bottom sticky-title">
	
			<span class="text-center">
				<h3>RECREATE ROSTER</h3>
			</span>
		
		<?php if($role !='employee') { ?>
		<a href="#" id="submit_roster_link" onclick="recreate()" >RECREATE </a>
		<?php  } ?>
	</div><!--.col-md-12 -->
<div class="container ctm-roster empRosterContainer">
  
  
  <div class="row ctm-ro-inner">
  <div class="form-group roster-nm">
      <label for="pwd"><b>Roster Name:</b></label>
      <div class='input-group '>
                    <input type='text' class="form-control" name="roster_name"  value="<?php echo $roster_name; ?>" style="height: 33px;" autocomplete="off" >
                  
                </div>
	</div>
    <div class="form-group roster-dt">
	<div class="dt-inner">
      <label for="pwd"><b>Start Date:</b></label>
      <div class='input-group  date datetimepicker1'>
                    <input type='text' class="form-control" style="height: 33px;" name="start_date" value="<?php echo date("d-m-Y", strtotime($start_date)); ?>" autocomplete="off"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>
	<div class="dt-inner">
      <label for="pwd"><b>End Date:</b></label>
      <div class='input-group date datetimepicker1'>
                    <input type='text' class="form-control" name="end_date" value="<?php echo date("d-m-Y", strtotime($end_date)); ?>" autocomplete="off"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
     </div>
     </div>
     
     <div class="dt-inner">
      <label for="pwd"><b>Month:</b></label>
      <div class='input-group'>
        <input type="text" class="form-control" name="month" readonly value="<?php echo date("F");; ?>" >
    	    
    	<!--<select class="form-control" name="month" style="height: 33px;">-->
    	<!--    <option value="January" <?php if($month == 'January'){ echo "selected";} ?>>January</option>-->
    	<!--    <option value="February" <?php if($month == 'February'){ echo "selected";} ?>>February</option>-->
    	<!--    <option value="March" <?php if($month == 'March'){ echo "selected";} ?>>March</option>-->
    	<!--    <option value="April" <?php if($month == 'April'){ echo "selected";} ?>>April</option>-->
    	<!--    <option value="May" <?php if($month == 'May'){ echo "selected";} ?>>May</option>-->
    	<!--    <option value="June" <?php if($month == 'June'){ echo "selected";} ?>>June</option>-->
    	<!--    <option value="July" <?php if($month == 'July'){ echo "selected";} ?>>July</option>-->
    	<!--    <option value="August" <?php if($month == 'August'){ echo "selected";} ?>>August</option>-->
    	<!--    <option value="September" <?php if($month == 'September'){ echo "selected";} ?>>September</option>-->
    	<!--    <option value="October" <?php if($month == 'October'){ echo "selected";} ?>>October</option>-->
    	<!--    <option value="November" <?php if($month == 'November'){ echo "selected";} ?>>November</option>-->
    	<!--    <option value="December" <?php if($month == 'December'){ echo "selected";} ?>>December</option>-->
    	<!--</select>-->
     </div>
     </div>
     
	</div>
	
		
	</div>
	<div class="row weekday_line_parent" style="margin-bottom:30px;">
	    <?php $count = 0 ;?>
	
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
                	    <?php foreach($roster as $row){  ?>
                	    
                        <tr class="employeeRole">
                        
                            <td class="ct-w colPadding0"> 
                            <input type='hidden' class="form-control roster_id" name="roster_id[]" value="<?php echo $row->roster_id; ?>" >
                    	<input type='hidden' class="form-control roster_group_id" name="roster_group_id" value="<?php echo $row->roster_group_id; ?>" >
                    	<input type='hidden' class="form-control roster_template" name="roster_template" value="<?php echo $roster_template; ?>" >
                                <table class="innerTable greenbackground">
                                   
                                    <tr>
                                    <td style="display: flex;">
                                        <select  name="emp_id[]" class="form-control select1 ct-emp-name" onChange="fetchRole(this)" id="emp_slt" required>
                                    	  <option value="">Select</option>
                                    	  <?php  foreach($employees as $row1){ $selectedempId =$row->emp_id; ?>
                                    	     <option value="<?php echo $row1->emp_id; ?>" <?php if($row->emp_id == $row1->emp_id){ echo "selected";} ?> ><?php echo $row1->first_name.' '. $row1->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
                                    	  <?php } ?>
                                    	  </select> 
                                    	  <input type="hidden" id="employeeIdSelected" value="<?php echo $selectedempId; ?>">
                                    	  <i class="material-icons" onclick="GetEmpAvailData(this)" style="cursor: pointer;" title="View employee availability">&#xf106;</i>
                                    
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                  <tr>
                                    <td>
                                        <input type="text" readonly name="role_name" title="Role" placeholder="Role" value="<?php echo $row->role_name; ?>" id="empRoleName" class="form-control roles_emp ct-emp-name">
                                        <input type="hidden" readonly name="role" value="<?php echo $row->role; ?>" id="empRoleId" class="form-control roles_emp ct-emp-name">
                                    </td>
                                    
                                </tr></table>
                            </td>
                                </tr>
                                </table>
                            </td> 
                            
                            <?php 
                            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                            $week_days_outlet_value = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                            for ($i = 0; $i < 7; $i++) {
                            $startName = $week_days[$i].'_start[]';
                            $startValue = $week_days[$i].'_start_time';
                            
                            $endName = $week_days[$i].'_end[]';
                            $endValue = $week_days[$i].'_end_time';
                            
                            $breakName = $week_days[$i].'_break[]';
                            $breakValue = $week_days[$i].'_break_time';
                            
                            $outletName = $week_days[$i].'_layout[]';
                            $outletValue = $week_days_outlet_value[$i].'_layout';
                            
                                
                            //   $time1 = strtotime($row->$startValue);
                            //   $time2 = strtotime($row->$endValue);
                            //   if($time2 !='' && $time1 !=''){
                            //       $difference = round(abs(($time2 - $time1)) / 3600,2);
                               
                            //   // convert hr in to min and substract min of break
                               
                            //   $difference = $difference*60;
                            //   $difference = $difference - $row->$breakValue;
                               
                            //   $h = floor($difference/60) ? floor($difference/60) .'' : '';
                            //   $m = $difference%60 ? $difference%60 .'' : '';
                            //   $hoursworked  = $h && $m ? $h.' : '.$m : $h.$m;   
                            //   }else{
                            //       $hoursworked = 0;
                            //   }
       
                            ?>
                              <td class="colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr>
                                        <td>  
                                        
                                         <div class='input-group date datetimepicker3'>
                                        <input type='text' class="form-control" name="<?php echo $startName;  ?>" value="<?php if(($row->$startValue == 0 && $row->$endValue ==0)) {  echo '';  }else { echo $row->$startValue; }; ?>">
                                         <span class="input-group-addon" >
                                         <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                            </div>
                                            
                                            
                                           
                                        </td> 
                                        <td>  
                                        
                                         <div class='input-group date datetimepicker3'>
                                        <input type='text' class="form-control" name="<?php echo $endName;  ?>" value="<?php if(($row->$endValue == 0 && $row->$startValue ==0)) {  echo '';  }else { echo $row->$endValue; }; ?>">
                                         <span class="input-group-addon" >
                                         <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                            </div>
                                            
                                           
                                        </td> 
                                        </tr><tr>
                                        <td>  
                                        
                                       
                                       <div class="input-group">
                                        <input type='text' class="form-control breakTime" title="Break" placeholder="Break" name="<?php echo $breakName;  ?>" value="<?php if(($row->$breakValue == 0 )) {  echo '';  }else { echo $row->$breakValue; }; ?>">
                                            </div>
                                             
                                        </td> 
                                        <td>  
                                           <div class='input-group '>
                                                <input type='text' title="Outlet" placeholder="Outlet" class="form-control outletwrap" name="<?php echo $outletName;  ?>" value="<?php if(empty($row->$outletValue)) {  echo '';  }else { echo $row->$outletValue; }; ?>">
                                            </div>
                                        </td>
                                        <!--<td>  -->
                                        <!--   <div class='input-group '>-->
                                        <!--        <input type="text" readonly value="<?php echo $hoursworked; ?>" class="form-control ct-emp-hours">-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        
                                    </tr> 
                                </table>
                              </td>   
                            
                            
                            <?php } ?>
                             
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                  <tr>
                                    <td>
                                        <input type="text" name="roster_department[]" value="<?php echo $row->roster_department; ?>" class="form-control ct-emp-name">
                                    </td>
                                    
                                </tr></table>
                            </td> 
                             <td class="colPadding0 actionCol">
                                <table class="innerTable greenbackground">
                                    <tr>
                                        <td>
                                            <div class="ct-col-right ct-btns">
                                             <span class="add_field_wrap"><a href="javascript:void(0)" class="add_field_button" >+</a></span>
                                             <?php  if($count != 0) { ?>
                                             <span><a href="#" class="remove_field_button">-</a></span>
                                             <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                              </td> 
                              
                        </tr>
                <?php $count ++; } ?>
                
                </tbody>

        </table>
</div>
</form>
 </div>	
 
        </div>
	 </div>
	 </div>
	</form>
	
  
</div>
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


	function recreate(){
	var form = $("#hack_submit");
	var formdata =  form.serialize();
	
	
	 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/submit_roster",
		        data:formdata,
		        success: function(data){
		        if(data=='Sucess'){
		        $msg = "Roster Recreated Succesfully";
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
                 buttons: {
                 continue: "Continue",
                 cancel: "Cancel",
                    },
          }).then((value) => {
          
    if(data=='Sucess'){
       window.location = "<?php echo $link; ?>";
       }else{
       
                  switch (value) {
                   case "continue":
                   $("#leavecontinueApproval").val("true");
                   recreate();
                   break;
                    }
                    }
       });
		  }
	       });
	
	}

// clone row for wrap
    
    $(document).on( 'click', '.add_field_button', function () {
        
    var thisRow = $( this ).closest( '.employeeRole' );
    
    $( thisRow ).clone().insertAfter( thisRow ).find('.form-control').val( '' );
    var thisRowAddbtn = $( thisRow ).next('.employeeRole').find( '.add_field_wrap' );
    if (!$(thisRow).has(".remove_field_button").length) {
   $('<span><a href="#" class="remove_field_button">-</a></span>').insertAfter(thisRowAddbtn);
    } 
    
     $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm'
                });
    });
    
// 	$(document).on("click", ".add_field_button" , function() {
// 	var target =  $(this).parents('.ct-row');
// 	$(target).after(codeBlock);

//  $('.datetimepicker3').datetimepicker({
//                     format: 'HH:mm'
//                 });
  
//     });
        
       $(document).on("click", ".remove_field_button" , function() {
        //  var roster_id =  $(this).parent().parents('.ct-row').find('.roster_id').val();
        //  var roster_group_id = $(this).parent().parents('.ct-row').find('.roster_group_id').val();
        
          $(this).closest('.employeeRole').remove();
         
 <!--         $.ajax({-->
	<!--	url:"<?php echo base_url();?>index.php/admin/delete_single_roster",-->
	<!--	method:"POST",-->
	<!--	data:{-->
	<!--	    roster_id:roster_id,-->
	<!--	    id:roster_group_id-->
	<!--	    },-->
	<!--    success:function(resp){-->
	<!--    console.log("Deleted");-->
	<!--}-->
       
        
 <!--       });-->

});
        
         $(function () {
                $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
            });
           
        </script>
	<script type="text/javascript">
            $(function () {
                $("input[name='start_date']").closest('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY',
					daysOfWeekDisabled: [0,2,3,4,5,6]
				});
                $("input[name='end_date']").closest('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY',
					daysOfWeekDisabled: [1,2,3,4,5,6]
				});
                $("input[name='start_date']").closest('.datetimepicker1').on('dp.change', function(e){
                    if(e.date){
                        var end = e.date.clone().add(6,'days');
                        $("input[name='end_date']").closest('.datetimepicker1').data('DateTimePicker').date(end);
                    }
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



function test(obj){
   
  var role_id = $(obj).val();
  
   
      $.ajax({
		url:"<?php echo base_url();?>index.php/admin/fetch_employee_for_roles",
		method:"POST",
		data:{role_id:role_id},
	    success:function(resp){
	       var prePopulat = JSON.parse(resp)
	       
	 var mySelect = $(obj).closest(".row").find("#emp_slt");
	 mySelect.html('');
$.each(prePopulat, function(val, text) {
    
    mySelect.append(
        $('<option></option>').val(text.emp_id).html(text.first_name)
    );
});

			}
	});
}
</script>
</body>
</html>
