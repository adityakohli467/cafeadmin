<div class="row item">
    <div id='loader' style='display: none;'>
  <img src="<?php echo base_url() ?>images/ajax-loader.gif" width='32px' height='32px'>
</div>
			</div>
	<form class="form-inline" role="form" id="rosterUpdate" method="post" action="<?php echo base_url(); ?>index.php/admin/update_complete_roster" enctype="multipart/form-data">	
		<input type="hidden" id="leavecontinueApproval" name="leavecontinueApproval" value="">
	<div  class="col-md-12 page-head border-bottom sticky-title">
	
			<span class="text-center">
				<h3>EDIT ROSTER</h3>
			</span>
		
		<?php if($role !='employee') { ?>
		<a href="#" id="submit_roster_link" onclick="rosterUpdate()" >UPDATE </a>
		<?php  } ?>
	</div><!--.col-md-12 -->
<div class="container ctm-roster">
  
  
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
                    <input type='text' class="form-control" name="end_date" style="height: 33px;" value="<?php echo date("d-m-Y", strtotime($end_date)); ?>" autocomplete="off"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
     </div>
     </div>
	</div>
	
		
	</div>
	<div class="row weekday_line_parent" style="margin-bottom:30px;">
	    <?php $count = 0 ;?>
	<?php foreach($roster as $row){  ?>

	<div class="ct-row" style="display: initial;position: initial;">
	 <input type='hidden' class="form-control roster_id" name="roster_id[]" value="<?php echo $row->roster_id; ?>" >
	<input type='hidden' class="form-control roster_group_id" name="roster_group_id" value="<?php echo $row->roster_group_id; ?>" >
	    <div class="row" style="margin: 0 15px; padding-top:20px;clear: both;">

	  <div class="form-group">
      <label for="email"><b>Role:</b></label>
     	<select name="role" onChange="test(this)" class="form-control roles_emp ct-emp-name">
											<?php if(isset($roles) && !empty($roles)) { ?>
									<option  value="all">All roles</option>
								<?php	foreach($roles as $role) { ?>
									<option value="<?php echo $role->role_id; ?>"  <?php if($role->role_id == $row->emp_id){ echo "selected";} ?>><?php echo $role->role_name; ?></option>
									<?php }} ?>
		</select>						

	  </div>

	  <div class="form-group">
      <label for="email"><b>Employee:</b></label>
      <input type="hidden" value="<?php echo $row->emp_id; ?>" name="prev_emp[]">
      <select  id="emp_slt" name="emp_id[]" class="form-control select1 ct-emp-name" required>
	  <option value="">Select</option>
	  <?php foreach($employees as $row1){ ?>
	     <option value="<?php echo $row1->emp_id; ?>" <?php if($row->emp_id == $row1->emp_id){ echo "selected";} ?>><?php echo preg_replace('#[^\w()/.%\-&]#',"",$row1->first_name).' '.preg_replace('#[^\w()/.%\-&]#',"",$row1->last_name).' ('.str_replace('_', ' ', $row1->employee_type).'  )'; ?></option>
	  <?php } ?>
	  </select>
	  </div>

	</div>
		<div class="ct-col-left">
	<div class="ct-scroll">
	<table id="week_days" class="weekday_line">
  <thead>
  <tr> <th> </th><th> MON</th>   <th> TUE </th>  <th> WED </th>  <th> THU  </th>  <th> FRI </th>  <th> SAT </th>  <th> SUN </th>  </ tr>
    </thead>
    <tbody>
  <tr>
  
<td class="ct-w"> Start </td> 
<?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_start[]';
$value = $week_days[$i].'_start_time';
$end_value = $week_days[$i].'_end_time';
?>

<td>  
<div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="<?php echo $name;  ?>" value="<?php if(($row->$value == 0 && $row->$end_value ==0)) {  echo '';  }else { echo $row->$value; }; ?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
       </div>
       </td> 

<?php } ?>
    
</tr>

<tr>
<td class="ct-w"> End </td> 


<?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_end[]';
$value = $week_days[$i].'_end_time';
$end_value = $week_days[$i].'_start_time';
?>

<td>  
<div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="<?php echo $name;  ?>" value="<?php if(($row->$value == 0 && $row->$end_value ==0)) {  echo '';  }else { echo $row->$value; }; ?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
       </div>
       </td> 

<?php } ?>


 </tr>

<tr> <td class="ct-w"> Break </td>

<?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_break[]';
$value = $week_days[$i].'_break_time';
?>

<td>  
<div class='input-group '>
    <input type='text' class="form-control" name="<?php echo $name;  ?>" value="<?php if(($row->$value == 0 )) {  echo '';  }else { echo $row->$value; }; ?>">
  </div>
</td> 

<?php } ?>
</tr>


<tr> <td class="ct-w"> Outlet </td>

<?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');
$week_days_outlet_value = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_layout[]';
$value = $week_days_outlet_value[$i].'_layout';
?>

<td>  
<div class='input-group '>
    <input type='text' class="form-control" name="<?php echo $name;  ?>" value="<?php if(empty($row->$value)) {  echo '';  }else { echo $row->$value; }; ?>">
  </div>
</td> 

<?php } ?>
</tr>

<tbody>
<tfoot>
 <tr>
      <td class="ct-w">Hours</td>
      <?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_hours[]';


         $start_nameofday = $week_days[$i].'_start_time';
         $end_nameofday = $week_days[$i].'_end_time';
        $break_nameofday = $week_days[$i].'_break_time';
        
      $time1 = strtotime($row->$start_nameofday);
      $time2 = strtotime($row->$end_nameofday);
       if($time2 !='' && $time1 !=''){
           $difference = round(abs(($time2 - $time1)) / 3600,2);
       
       // convert hr in to min and substract min of break
       
       $difference = $difference*60;
       $difference = $difference - $row->$break_nameofday;
       
       $h = floor($difference/60) ? floor($difference/60) .'' : '';
       $m = $difference%60 ? $difference%60 .'' : '';
       $hoursworked  = $h && $m ? $h.' : '.$m : $h.$m;   
       }else{
           $hoursworked = 0;
       }
    
 
?>

<td>  
<div class='input-group '>
                   
                 <div class="form-control" style="width: 100px;"><?php echo $hoursworked; ?></div>  
                       
       </div>
       </td> 

<?php } ?>
     
    
 </tr>
</tfoot>
</table>
</div>
</div>
<div class="ct-col-right ct-btns">
 <span><a href="javascript:void(0)" class="add_field_button" > + </a></span>
 <!-- hide minus sign from forst row -->
 <?php // if($count != 0) { ?>
  <span><a href="javascript:void(0)" class="remove_field_button" > - </a></span>
 <?php // } ?>
 </div>  
        </div>
	<?php $count ++; } ?>
	</div>
	 </div>
	 </div>
	</form>
	
  
</div>

	<script type="text/javascript"> 

    var codeBlock= '<div class="ct-row" style="display: initial;position: initial;">'+
   '<div class="row" style="margin: 0 15px; padding-top:20px;clear: both;"><div class="form-group"><label for="email"><b>Role:</b></label><select onChange="test(this)" name="role" class="form-control roles_emp ct-emp-name"><option selected="selected" value="all">All roles</option>'+
	'<?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?><option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>	<?php }} ?></select> </div><div class="form-group"><label for="email">Employee:</label><select id="emp_slt" name="emp_id[]" class="form-control select1 ct-emp-name" required>'+
   '<option value="">Select</option><?php foreach($employees as $emp){ ?><option value="<?php echo $emp->emp_id; ?>"><?php echo preg_replace('#[^\w()/.%\-&]#',"",$emp->first_name).' '. preg_replace('#[^\w()/.%\-&]#',"",$emp->last_name).' ('.str_replace('_', ' ', $emp->employee_type).'  )';; ?></option><?php } ?></select>'+
   '</div></div>'+
   
   
   '<div class="ct-col-left"><div class="ct-scroll"><table id="week_days" class="weekday_line"><thead>'+
	'<tr> <th> </th><th> MON</th><th> TUE </th>  <th> WED </th>  <th> THU  </th>  <th> FRI </th>  <th> SAT </th>  <th> SUN </th>  </ tr>'+
		'</thead><tbody><tr><td class="ct-w"> Start </td>'+ 
		'<td>'+
	'<div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="mon_start[]" >'+
'<span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span>'+
'</span>'+
'</div>'+
'</td>'+
'<td>'+
'<div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="tues_start[]" >'+
'<span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span>'+
'</span>'+
'</div>'+

'</td>'+

'<td>'+
'<div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="wed_start[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+
'<td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="thus_start[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>'+
'</div></td><td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="fri_start[]" ><span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span></span></div></td><td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="sat_start[]" >'+
'<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td><td> <div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="sun_start[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td></tr>'+

'<tr><td class="ct-w"> End </td><td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="mon_end[]" ><span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span></span></div></td><td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="tues_end[]" ><span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span></span></div></td><td><div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="wed_end[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+
'<td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="thus_end[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>'+
'</div></td><td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="fri_end[]" ><span class="input-group-addon">'+
'<span class="glyphicon glyphicon-time"></span></span></div></td><td><div class="input-group date datetimepicker3">'+
'<input type="text" class="form-control" name="sat_end[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+
'<td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="sun_end[]" ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>'+
'</div></td></tr>'+

'<tr> <td class="ct-w"> Break </td><td> <div class="input-group "><input type="text" class="form-control" name="mon_break[]" >'+
'</span></div></td>'+
'<td> <div class="input-group "><input type="text" class="form-control" name="tues_break[]" autocomplete="off">'+
'</div></td><td><div class="input-group">'+
'<input type="text" class="form-control" name="wed_break[]" autocomplete="off"></div>'+
'</td> <td> <div class="input-group"><input type="text" class="form-control" name="thus_break[]" autocomplete="off">'+
'</div></td> <td><div class="input-group"><input type="text" class="form-control" name="fri_break[]" autocomplete="off">'+
'</div></td> <td> <div class="input-group"><input type="text" class="form-control" name="sat_break[]" autocomplete="off">'+
'</div></td><td> <div class="input-group"><input type="text" class="form-control" style="width:100% !important;" name="sun_break[]" autocomplete="off">'+
'</div></td> </tr>'+

'<tr> <td class="ct-w"> Outlet </td><td> <div class="input-group "><input type="text" class="form-control" name="mon_layout[]" >'+
'</span></div></td>'+
'<td> <div class="input-group "><input type="text" class="form-control" name="tues_layout[]" autocomplete="off">'+
'</div></td><td><div class="input-group">'+
'<input type="text" class="form-control" name="wed_layout[]" autocomplete="off"></div>'+
'</td> <td> <div class="input-group"><input type="text" class="form-control" name="thus_layout[]" autocomplete="off">'+
'</div></td> <td><div class="input-group"><input type="text" class="form-control" name="fri_layout[]" autocomplete="off">'+
'</div></td> <td> <div class="input-group"><input type="text" class="form-control" name="sat_layout[]" autocomplete="off">'+
'</div></td><td> <div class="input-group"><input type="text" class="form-control" style="width:100% !important;" name="sun_layout[]" autocomplete="off">'+
'</div></td> </tr>'+

'<tbody>'+

'<tfoot><tr><td class="ct-w">Hours</td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="mon_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="tues_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="wed_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="thus_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="fri_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="sat_hours[]" autocomplete="off"></div></td>'+
'<td> <div class="input-group "><input type="text"  class="form-control"  name="sun_hours[]" autocomplete="off"></div></td>'+

'</td></tr></tfoot></table></div></div><div class="ct-col-right ct-btns ct-btns1"><span><a href="javascript:void(0)" class="add_field_button" >+</a></span>'+
'<span><a href="#" class="remove_field_button">-</a></span></div>';

  
  function rosterUpdate(){
	var form = $("#rosterUpdate");
	var formdata =  form.serialize();
	
	
	 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/update_complete_roster",
		        data:formdata,
		      //   contentType: false,  // Set to false when using FormData
        //         processData: false,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
		        success: function(data){
		            var data = JSON.parse(data);
		            console.log(data.result);
		        if(data.result=='Sucess'){
		        $msg = "Roster Updated Succesfully";
		        $icon = "success";
		        }else if(data.result=='validation'){
		         $msg = "Ensure all mandatory fields are populated";
		         $icon = "warning";
		        }
		         else if(data.result=='leaveValidation'){
		         $msg = data.emp_name+" is on leave during the selected shift time. Please ensure this employee is not rostered for the leave days.";
		         $icon = "warning";
		        }else{
		        $msg = "Shift Timings are overlapping for the employee selected";
		         $icon = "warning";
		        }
		        swal({
		            
                text: $msg,
                 icon: $icon,
          }).then((value) => {
                    if(data.result=='Sucess'){
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



	$(document).on("click", ".add_field_button" , function() {
	var target =  $(this).parents('.ct-row');
	$(target).after(codeBlock);

 $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm'
                });
  
    });
        
       $(document).on("click", ".remove_field_button" , function() {
           
           if (window.confirm("Deleting this employee will delete from the timesheet aswell if the timesheet is created already for this week. Would you like to continue?")) {
               
         var roster_id =  $(this).parent().parents('.ct-row').find('.roster_id').val();
         var roster_group_id = $(this).parent().parents('.ct-row').find('.roster_group_id').val();
         var no_of_roster = $(".weekday_line_parent .ct-row").length
        if(no_of_roster < 3){
          $(".remove_field_button").css("display","none");
        }else{
             $(".remove_field_button").css("display","block");
        }
         $(this).parent().parents('.ct-row').remove();
         
         
          $.ajax({
		url:"<?php echo base_url();?>index.php/admin/delete_single_roster",
		method:"POST",
		data:{
		    roster_id:roster_id,
		    id:roster_group_id
		    },
	    success:function(resp){
	    console.log("Deleted");
	}
       
        
        });
        
        
        
       }

});
        
         $(function () {
                $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
            });
           
        </script>
	<script type="text/javascript">
            $(function () {
                $('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY',
					<!--minDate:new Date()-->
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
   var empname = text.first_name.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
   var emplastname = text.last_name.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
    mySelect.append(
        $('<option></option>').val(text.emp_id).html(empname+' '+emplastname)
    );
});

			}
	});
}
</script>
</body>
</html>
