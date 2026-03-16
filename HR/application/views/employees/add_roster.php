

<div class="row item">
<div id='loader' style='display: none;'>
  <img src="<?php echo base_url() ?>images/ajax-loader.gif" width='32px' height='32px'>
</div>
			</div>
<form class="form-inline" role="form" method="post" id="hack_submit" action="<?php echo base_url(); ?>index.php/admin/submit_roster" enctype="multipart/form-data">
	
	
<div  class="col-md-12 page-head border-bottom sticky-title">
	<span class="text-center">
	<h3>CREATE ROSTER</h3>
	</span>
<a href="#" id="submit_roster_link" onclick="hack()" >CREATE </a>
	</div>
<div class="container"><div class="row"><div class="col-lg-12"><div class="ct-fltr">
    <input type="hidden" name="roster_template" value="0">
     <div class="ctm-ro-inner">
	 <div class="form-group roster-nm">
      <label for="pwd"> <b> Roster Name: </b> </label>
      <div class='input-group'>
        <input type='text' class="form-control" name="roster_name" style="height: 33px;" autocomplete="off" required>
    </div>
</div>

	 <div class="form-group roster-dt">
	 <div class="dt-inner">
      <label for="pwd"><b>Start Date:</b></label>
     <div class='input-group date datetimepicker1'>
    <input type='text' class="form-control" name="start_date" style="height: 33px;" autocomplete="off" required >
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
    </span>
    </div>
    </div>
    
	<div class="dt-inner">
      <label for="pwd"><b>End Date:</b></label>
      <div class='input-group date datetimepicker1'>
        <input type='text' class="form-control" name="end_date" style="height: 33px;" autocomplete="off" required>
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
        </span>
     </div>
     </div>
     </div>
	</div>
	</div>
	</div>
	</div>
	
	<div class="row employee_select">
	<div class="col-lg-12">
	  <div class="form-group">
      <label for="email"><b>Role:</b></label>
     	<select name="role" onChange="test(this)" class="form-control roles_emp ct-emp-name">
		<?php if(isset($roles) && !empty($roles)) { ?>
		<option selected="selected" value="all">All roles</option>
		<?php	foreach($roles as $role) { ?>
		<option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
		<?php }} ?>
	</select>
	  </div>
	
	  <div class="form-group">
      <label for="email"><b>Employee:</b></label>
      <select  name="emp_id[]" class="form-control select1 ct-emp-name" id="emp_slt" required>
	  <option value="">Select</option>
	  <?php foreach($employees as $row){ ?>
	     <option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
	  <?php } ?>
	  </select>
	  </div>
	</div>
	</div>

		<div class="row weekday_line_parent" style="margin-bottom:30px;">		
		<div class="ct-row">
		<div class="ct-col-left">
		<div class="ct-scroll">
        <table id="week_days" class="weekday_line">
	<thead>
	<tr> <th> </th><th> MON</th>   <th> TUE </th>  <th> WED </th>  <th> THU  </th>  <th> FRI </th>  <th> SAT </th>  <th> SUN </th>  </tr>
		</thead>
		<tbody>
	<tr>
	
<td class="ct-w"> Start </td> 

<?php 
$week_days = array('mon','tues','wed','thus','fri','sat','sun');

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_start[]';

?>

<td>  
<div class='input-group date datetimepicker3'>
<input type='text' class="form-control" name="<?php echo $name;  ?>">
<span class="input-group-addon" >
<span class="glyphicon glyphicon-time"></span>
</span>
</div>
       </td> 

<?php } ?>

</tr>

<tr>
<td class="ct-w">End</td> 

<?php 

for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_end[]';
$value = $week_days[$i].'_end_time';
?>

<td>  
<div class='input-group date datetimepicker3'>
<input type='text' class="form-control" name="<?php echo $name;  ?>">
<span class="input-group-addon">
<span class="glyphicon glyphicon-time"></span>
</span>
       </div>
       </td> 

<?php } ?>

 </tr>

<tr> <td class="ct-w"> Break </td>

<?php 
for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_break[]';
?>
<td>  
<div class='input-group'>
   <input type='text' class="form-control" name="<?php echo $name;?>">                 
</div>
</td> 

<?php } ?>

 </tr>
 
 <tr> <td class="ct-w"> Outlet </td>

<?php 


for ($i = 0; $i < 7; $i++) {
$name = $week_days[$i].'_layout[]';

?>

<td>  
<div class='input-group '>
<input type='text' class="form-control" name="<?php echo $name;  ?>" >

       </div>
       </td> 

<?php } ?>

 </tr>

<tbody>
<tfoot>
 <tr>
      <td class="ct-w">Hours</td>
      <td>
       <div class='input-group '>
     <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     <td>
       <div class='input-group '>
     <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     <td>
       <div class='input-group '>
      <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     <td>
       <div class='input-group '>
      <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     <td>
       <div class='input-group '>
    <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
    
    <td>
       <div class='input-group '>
      <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     <td>
       <div class='input-group '>
      <div class="form-control" style="width: 100px;"></div>
     </div>
     </td>
     
    
 </tr>
</tfoot>
</table></div>
</form></div><div class="ct-col-right ct-btns">
 <span class=""><a href="javascript:void(0)" class="add_field_button" >+</a></span>

 </div>	
 </div>	
	
</div></div></div>
	<script type="text/javascript">
	
	function hack(){
	
	var form = $("#hack_submit");
	var formdata =  form.serialize();
	
	     $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/submit_roster",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
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
	
$(document).on("click", ".add_field_button" , function() {
	 var wrapper  = $(".weekday_line_parent");
	
$(wrapper).append('<div style="margin-bottom:30px;"><div class="col-lg-12"> <div class="employee_select" style="margin: 0 15px; padding-top:20px;clear: both;"><div class="form-group"><label for="email"><b>Role:</b></label><select onChange="test(this)" name="role" class="form-control roles_emp ct-emp-name"><option selected="selected" value="all">All roles</option>'+
	'<?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?><option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>	<?php }} ?></select> </div>'+
'<div class="form-group"><label for="email">Employee:</label><select  id="emp_slt" name="emp_id[]" class="form-control select1 ct-emp-name" required>'+
   '<option value="">Select</option><?php foreach($employees as $emp){ ?><option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->first_name.' '. $emp->last_name.' ('.str_replace('_', ' ', $emp->employee_type).'  )'; ?></option><?php } ?></select>'+
   '</div></div></div>'+
   '<div class="ct-row"><div class="ct-col-left"><div class="ct-scroll"><table id="week_days" class="weekday_line"><thead>'+
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
'<span><a href="#" class="remove_field_button">-</a></span></div></div>');

 $('.datetimepicker3').datetimepicker({
    format: 'HH:mm A'
    });
    });
        
$(document).on("click", ".remove_field_button" , function() {
    $(this).parent().parents('.ct-row').prev().prev().remove();
    $(this).parent().parents('.ct-row').prev().remove();
    $(this).parent().parents('.ct-row').remove();
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

function test(obj){
   
  var role_id = $(obj).val();

      $.ajax({
		url:"<?php echo base_url();?>index.php/admin/fetch_employee_for_roles",
		method:"POST",
		data:{role_id:role_id},
	    success:function(resp){
	       var prePopulat = JSON.parse(resp)
	       
	 var mySelect = $(obj).closest(".employee_select").find("#emp_slt");
	 mySelect.html('');
$.each(prePopulat, function(val, text) {
    
    mySelect.append(
        $('<option></option>').val(text.emp_id).html(text.first_name)
    );
});

			}
	});
}
	
$('.select1').on( "change", function() {
    var op = $( this ).val();
    $('.select2 option').prop('disabled', false);
    $('.select2 option[value='+op+']').prop('disabled', true);
});
</script>

</body>
</html>
