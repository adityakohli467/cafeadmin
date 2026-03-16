<!DOCTYPE html>
<html>
<head>
    <style>
        .container-fluid{
        text-align:center;
        height:100%;
            margin-bottom: 0 !important;
    }
    .row{
    height:100%;
    }
    </style>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CAFEADMIN</title>
	
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
	</script> 
  
</head>
<body>
	<div class="gradient"></div>

	<!--navigation-bar-->
	
	
<div class="container-fluid main-container main_home_page">
    <div class="row">
        <div class="col-lg-7 col-md-7 ct-left-home1">
             <div class="ct-inner-home">
                <?php if(null !==$this->session->flashdata('permissionmessage')) { ?>  
    <div id='hideMe'>
       <p class="alert alert-danger"><?php echo $this->session->flashdata('permissionmessage'); ?></p>
    </div>
    <?php } ?>
    <?php if(null !==$this->session->userdata('feedback')) { ?>
	<div class="alert alert-success" id="success-alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $this->session->flashdata('feedback'); ?>
    </div>
    <?php } ?> 
  
	<?php if(null !==$this->session->userdata('email_sent')) { ?>  
	<div id='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('email_sent'); ?></p>
	</div>
	<?php } ?>
 	<?php if(null !==$this->session->userdata('email_notsent')) { ?>  
	<div id='hideMe'>
		<p class="alert alert-danger"><?php echo $this->session->flashdata('email_notsent'); ?></p>
	</div>
 	<?php } ?>
	 	
	<?php if(null !==$this->session->userdata('message_success')) { ?>
	  <div class="alert alert-success">
	      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <?php echo $this->session->userdata('message_success');?>
      </div>
	<?php } ?>
	<div class="ht ct-ht">
	    <h3>HR MANAGEMENT</h3>
	    </div>
	<div class="modules-box " id="buttons_home" >
	    
							 	    <a href="<?php echo base_url(""); ?>index.php/auth/login/manager" >
							 	
							 			<p>MANAGER PORTAL</p>
							 			</a>
							 	</div>
							 
							 	<div class="modules-box" id="buttons_home">
							 	    <a href="<?php echo base_url(""); ?>index.php/auth/login/employee" >
							 	
							 			<p>EMPLOYEE LOGIN</p>
							 			</a>
							 	</div>
							 	
							 		<div class="modules-box"  id="buttons_home">
							 	    <a href="<?php echo base_url(""); ?>index.php/auth/login/timesheet" >
							 	
							 			<p>TIMESHEET PORTAL
							 			<br>
							 			<small style="font-weight:400; font-size:12px"> For Manager Use Only </small></p>
							 			</a>
							 	</div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 ct-right-home1">
               <div class="ct-inner-home">
    
    
							 	
							 	<div class="modules-box" id="buttons_home">
							 	    <a href="<?php echo base_url(""); ?>index.php/auth/login/admin" >
							 	
							 			<p>ADMIN</p>
							 			</a>
							 	</div>
</div>
</div>
</div></div>