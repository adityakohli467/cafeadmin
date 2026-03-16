<style>
.form-control {
    padding: 6px 0px;
}
.form-inline .form-group input {
    width:70px;
}
.input-group.datetimepicker3{
	margin-bottom:4px;
	text-align:center;
}
</style>
	<div class="row item">
			</div>
	<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_roster" enctype="multipart/form-data">	
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Roster</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/employees/roster_history"><button type="button" name="contact_submit"  class="btn btn-success btn-ph">Back</button></a>
					
		</div>
	</div><!--.col-md-12 -->
<div class="container">
  
  
  <div class="row">
    <div class="form-group">
      <label for="pwd">Start Date:</label>
      <div class='input-group date'>
	  
                    <input type='text' class="form-control" name="start_date" style="text-align:center;" value="<?php echo date("d-m-Y", strtotime($start_date)); ?>" autocomplete="off" readonly>
                </div>
	</div>
    <div class="form-group">
      <label for="pwd">End Date:</label>
      <div class='input-group date'>
                    <input type='text' class="form-control" name="end_date" style="text-align:center;" value="<?php echo date("d-m-Y", strtotime($end_date)); ?>" autocomplete="off" readonly>
     </div>
	</div>
	</div><br>
	<?php foreach($roster as $row){ ?>
	<div class="row">
      <div class="col-md-2">
	  <h5 style="text-align:center;">Monday</h5>
         <div class='input-group date datetimepicker3'>
		            
                    <input type='text' class="form-control" name="monday_start[]" style="text-align:center;" value="<?php if($row->mon_start_time == "0"){ echo "";}else{ echo $row->mon_start_time; } ?>" placeholder="Mond Start" readonly>
       </div>
	  <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="monday_end[]" style="text-align:center;" value="<?php if($row->mon_end_time == "00:00:00"){ echo "";}else{ echo $row->mon_end_time; }?>" placeholder="Mond End" readonly>
       </div>
	  <input type="text" class="form-control"  placeholder="Mond break time" style="text-align:center;" value="<?php echo $row->mon_break_time ?>"  name="monday_break[]" autocomplete="off" readonly>
	  </div>      
	  <div class="col-md-10">
        <div class="row">
          <div class="col-md-2">
		  <h5 style="text-align:center;">Tuesday</h5>
		      <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="tuesday_start[]" style="text-align:center;" value="<?php  if($row->tues_start_time == "00:00:00"){ echo "";}else{ echo $row->tues_start_time; } ?>" placeholder="Tues Start" readonly>
       </div>
	   <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="tuesday_end[]" style="text-align:center;" value="<?php if($row->tues_end_time == "00:00:00"){ echo "";}else{ echo $row->tues_end_time; } ?>" placeholder="Tues End" readonly>
       </div>
	   <input type="text" class="form-control" placeholder="Tues break" name="tuesday_break[]" style="text-align:center;" value="<?php echo $row->tues_break_time; ?>" autocomplete="off" readonly>
		  </div>
          <div class="col-md-2">
		  <h5 style="text-align:center;">Wednesday</h5>
		     <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="wed_start[]" style="text-align:center;" value="<?php  if($row->wed_start_time == "00:00:00"){ echo "";}else{ echo $row->wed_start_time; } ?>" placeholder="Wed Start" readonly>
       </div>
	   <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="wed_end[]" style="text-align:center;" value="<?php  if($row->wed_end_time == "00:00:00"){ echo "";}else{ echo $row->wed_end_time; } ?>" placeholder="Wed End" readonly>
       </div>
	   <input type="text" class="form-control" placeholder="Wed break" name="wed_break[]" style="text-align:center;" value="<?php echo $row->wed_break_time; ?>" autocomplete="off" readonly>
		  </div>
          <div class="col-md-2">
		  <h5 style="text-align:center;">Thusday</h5>
		      <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="thus_start[]" style="text-align:center;" value="<?php  if($row->thus_start_time == "00:00:00"){ echo "";}else{ echo $row->thus_start_time; } ?>" placeholder="Thus Start" readonly>
       </div>
	  <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="thus_end[]" style="text-align:center;"  value="<?php if($row->thus_end_time == "00:00:00"){ echo "";}else{ echo $row->thus_end_time; }  ?>" placeholder="Thus End" readonly>
       </div>
	  <input type="text" class="form-control"  placeholder="Thus break time" style="text-align:center;" name="thus_break[]" value="<?php echo $row->thus_break_time; ?>" autocomplete="off" readonly>
		  </div>
          <div class="col-md-2">
		  <h5 style="text-align:center;">Friday</h5>
		     <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="fri_start[]" style="text-align:center;" value="<?php if($row->fri_start_time == "00:00:00"){ echo "";}else{ echo $row->fri_start_time; } ?>" placeholder="Fri Start" readonly>
       </div>
	   <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="fri_end[]" style="text-align:center;" value="<?php if($row->fri_end_time == "00:00:00"){ echo "";}else{ echo $row->fri_end_time; } ?>" placeholder="Fri End" readonly>
       </div>
	   <input type="text" class="form-control" placeholder="Fri break" name="fri_break[]" style="text-align:center;" value="<?php echo $row->fri_break_time; ?>" autocomplete="off" readonly>
		  </div>
          <div class="col-md-2">
		  <h5 style="text-align:center;">Saturday</h5>
		     <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="sat_start[]" style="text-align:center;" value="<?php if($row->sat_start_time == "00:00:00"){ echo "";}else{ echo $row->sat_start_time; } ?>" placeholder="Sat Start" readonly>
       </div>
	   <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="sat_end[]" style="text-align:center;" value="<?php if($row->sat_end_time == "00:00:00"){ echo "";}else{ echo $row->sat_end_time; } ?>" placeholder="Sat End" readonly>
       </div>
	   <input type="text" class="form-control" placeholder="Sat break" name="sat_break[]" style="text-align:center;" value="<?php  echo $row->sat_break_time ?>" autocomplete="off" readonly>
		  </div>
          <div class="col-md-2">
		  <h5 style="text-align:center;">Sunday</h5>
		     <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="sun_start[]" style="text-align:center;" value="<?php if($row->sun_start_time == "00:00:00"){ echo "";}else{ echo $row->sun_start_time; } ?>" placeholder="Sun Start" readonly>
       </div>
	   <div class='input-group date datetimepicker3'>
                    <input type='text' class="form-control" name="sun_end[]" style="text-align:center;" value="<?php if($row->sun_end_time == "00:00:00"){ echo "";}else{ echo $row->sun_end_time; } ?>" placeholder="Sun End" readonly>
       </div>
	   <input type="text" class="form-control" placeholder="Sun break" name="sun_break[]" style="text-align:center;" value="<?php echo $row->sun_break_time ?>" autocomplete="off" readonly>
		  </div>
        </div>
      </div>
    </div>
	<hr>
	<?php } ?> 
	<br>
	<div class="col-md-12 input_fields_wrap"></div>
  
</div>
</form>
  <br>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
</body>
</html>
