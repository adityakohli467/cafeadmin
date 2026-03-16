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
  <div class="row">
    <div class="col-md-12"style="text-align:center;"><img style="width: 175px;" src="http://www.sugarinc.in/codiad/workspace/hr/images/image1.png"></img></div>
  </div>
  <div class="row">
  	<div class="col-md-12" style="text-align:center;">
  		<h3>Select Employee</h3>
  	</div>
  </div>
  
  		<?php foreach($employees as $row){ ?>
  		<div class="row">
  	<div class="col-md-12" style="text-align:center;">
  		<a href="<?php echo base_url(); ?>index.php/admin/emp_timesheet/<?php echo $row->emp_id ?>"><button type="button" class="btn btn-info btn-lg" style="height:50px;width:35%;font-size:20px;color:white;"><?php echo $row->first_name; ?></button></a>
  		</div>
  </div><br>
  		<?php } ?>
  	
</div>

</body>

