<!DOCTYPE html>
<html>
<head>
    <style>
   /* #buttons_home{
        
         display: inline-block;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    background-color: #ffffff;
    padding: 20px 30px;
    font-size: 24px;
    border: 1px solid #2d6898;
    background-image: linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -o-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -moz-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -webkit-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -ms-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
 
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0, rgb(73,132,180)),
        color-stop(1, rgb(97,155,203))
    );
    width: 410px;
    
    margin-top: 250px;
    }*/
   
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
<body background="https://www.cafeadmin.com.au/assets/login/tsc1.jpeg">
	<div class="gradient"></div>

	<!--navigation-bar-->
	
	
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-lg-5 col-md-5 ct-left-home">
            <div class="ct-bg-overlay">
                
            </div>
        </div>
        <div class="col-lg-7 col-md-7 ct-right-home">
            <div class="ct-bg-overlay">
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
	<div class="ht">
	    <h3><img style="width:60%;max-width:300px;" src="https://www.cafeadmin.com.au/HR/images/image1.png"></h3>
	    </div>
	<div class="modules-box " id="buttons_home" >
	    
							 	    <a href="https://www.cafeadmin.com.au/index.php/auth/login2" >
							 	
							 			<p>SUPPLIER MANAGEMENT</p>
							 			</a>
							 	</div>
							 
							 	<div class="modules-box" id="buttons_home">
							 	    <a href="https://www.cafeadmin.com.au/HR" >
							 	
							 			<p>HR MANAGEMENT </p>
							 			</a>
							 	</div>
							 	
							 	
							 	<div class="modules-box" id="buttons_home">
							 	     <a href="https://www.cafeadmin.com.au/haccap" >
							 	
							 			<p>HACCAP</p>
							 			</a>
							 	</div>
							 	
							 	
        </div>
        </div>
        </div>
    </div>
    
</div>