<!DOCTYPE html>
<html>
<head>
	<title>Hr</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.jpg" />
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
	</script>
    
  
</head>
<body style="background-color:white;">
<div class="container-fluid" >
<form class="form-horizontal" role="form" id="myForm" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_employee_timesheet" enctype="multipart/form-data">	
  <input type="hidden" name="emp_id" value="<?php foreach($employees as $row){  echo $row->emp_id; } ?>">
  
  <div class="row">
    <div class="col-md-12"style="text-align:center;"><img style="width: 175px;" src="http://www.sugarinc.in/codiad/workspace/hr/images/image1.png"></img></div>
  </div>
  <div class="row">
  	<?php foreach($employees as $row){ ?>
  	<div class="col-md-12" style="text-align:center;">
  		<h3><?php echo $row->first_name; ?></h3>
  	</div>
  	<?php } ?>
  </div>
  <div class="row">
  	<div class="col-md-12" style="text-align:center;">
  		<h3><?php echo date("d-m-Y"); ?></h3>
  	</div>
  </div>
  <?php  if($time_record == 'inactive'){  ?>
  	<div class="row">
  	<div class="col-sm-6" style="text-align:center;">
  		<button type="button" onclick="setTime_in_time();" class="btn btn-info btn-lg" style="height:50px;font-size:20px;width:25%;">IN</button>
  	</div>	
  	<div class="col-md-6" style="text-align:center;">
  		<input type="text" id="in_time" name="in_time" style="font-size:30px;border:none;">
  	</div>

  </div><br> 

  <?php }else{ ?>
   <div class="row">
  	<div class="col-sm-6" style="text-align:center;">
  		<button type="button"  class="btn btn-info btn-lg" style="height:50px;font-size:20px;width:25%;">IN</button>
  	</div>
  	<input type="hidden" name="time_sheet_id" value="<?php echo $time_sheet_id; ?>">
  	<div class="col-md-6" style="text-align:center;">
  		<input type="text" value="<?php echo $time_in; ?>" name="field" style="font-size:30px;border:none;">
  	</div>

  </div><br>
  <?php 
  if($in_time == "in_time_exist"){
	if($time_out == '' || $time_out == '00:00:00'){
		$onclick = 'onclick="setTime_out_time();"';
	}else{
		$onclick = "";	
	}
  ?>
   <div class="row">
  	<div class="col-sm-6" style="text-align:center;">
  		<button type="button" <?php echo $onclick;?> class="btn btn-info btn-lg" style="height:50px;font-size:20px;width:25%;">OUT</button>
  	</div>	
  	<div class="col-md-6" style="text-align:center;">
  		<input type="text"  id="out_time" value="<?php echo $time_out;?>" name="out_time" style="font-size:30px;border:none;">
  	</div>
  </div>
   <?php  } 
   } ?>
  <br>
  <div class="row">
  	<div class="col-sm-3">
  	</div>	
  	<div class="col-sm-5" style="text-align:center;">
      <textarea class="form-control" rows="3" name="comments"  placeholder="comments"><?php echo $comments; ?></textarea>
  	</div>	
    <div class="col-sm-4">
  	</div>
  </div><br>
  <div class="row">
  	<div class="col-sm-3">
  	</div>	
  	<div class="col-sm-5" style="text-align:center;">
      <button type="submit" class="btn btn-info" value="submit">Submit</button>
  	</div>	
    <div class="col-sm-4">
  	</div>
  </div>
  </form>
</div>

</body>
<script>
function getTimeStamp_in_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())) + ':' + ((now.getSeconds() < 10) ? ("0" + now.getSeconds()) : (now.getSeconds())));
}

function setTime_in_time() {
    document.getElementById('in_time').value = getTimeStamp_in_time();
}
</script>
<script>
function getTimeStamp_out_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())) + ':' + ((now.getSeconds() < 10) ? ("0" + now.getSeconds()) : (now.getSeconds())));
}

function setTime_out_time() {
    document.getElementById('out_time').value = getTimeStamp_out_time();
}
</script>