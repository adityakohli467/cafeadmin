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
    body{
        background-color: #000;
    }
   .ht {
    padding: 0px 0 30px;
}
.main-container>.row {
    display: flex;
    align-items: center;
    justify-content: center;
}
    .container-fluid{
        text-align:center;
        min-height: 100% !important;
        margin-bottom: 0 !important;
        height:100vh;
    }
    .row{
    height:100%;
    }
.modules-box {
    padding: 15px;
    width: 33.33%;
}
.row-module{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.module-content {
    background-color:#fff;
    padding: 18px 15px;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-radius: 6px;
}
.module-content p {
    margin: 0 0 5px 0;
    font-size: 18px;
    line-height: 1.15;
    font-weight: 600;
    text-transform: uppercase;
}
.module-content span{
    margin: 0 0 8px 0;
    font-size: 12px;
    line-height: 1.15;
    font-weight: 400;
}
.module-content a {
    background-color: #000;
    color: #fff;
    border: 2px solid #000;
    font-size: 14px;
    font-weight: 600;
    padding: 4px 15px;
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 8px auto 0;
}
.module-content a:hover,.module-content a:focus{
    background-color: #000;
    border-color:#000;
    color:#fff;
    text-decoration:none;
}
.module-img {
    max-width: 170px;
    width: 100%;
    margin: 0 auto 35px;
}
.ct-bg-overlay {
    width: 100%;
    height: 100%;
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
}
.main-container {
    background-color: #000;
    /*background-image: url(<?php echo base_url(); ?>images/white-shape-bg.png);*/
    /*background-size: cover;*/
    overflow-x: hidden;
}
.sup-module a{
    background-color: #6b578c;
    border-color: #6b578c;
}
.hr-module a{
    background-color: #449d44;
    border-color: #449d44;
}
.haccap-module a{
    background-color: #FFDB57;
    border-color: #FFDB57;
}
.eod-module a{
    background-color: #f36422;
    border-color: #f36422;
}
.career-module a{
    background-color: #125E76;
    border-color: #125E76;
}
.management-module a{
    background-color: #B51B3D;
    border-color: #B51B3D;
}
.ct-inner-home {
    padding: 0 !important;
}
@media(max-width:1024px){
    .modules-box {
        width: 33.33%;
    }
}
@media(max-width:767px){
    .modules-box {
        width: 50%;
    }
    .container-fluid{
        height:unset;
    }
    .main-container>.row {
        display: block;
    }
}
@media(max-width:567px){
    .modules-box {
        width: 100%;
    }
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

<div class="container-fluid main-container">
    <div class="row">
        
        <div class="col-lg-12 col-md-12 ">
            <div class="ct-bg-overlay">
            <div class="ct-inner-home">
                	<div class="ht">
	    <h3><img style="width:60%;max-width:300px;" src="<?php echo base_url(); ?>images/logo-white.png"></h3>
	    </div>
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
	                <div class="container">
	                    <div class="row row-module">
	                            <div class="modules-box hr-module">
							 	   
							 	    <div class="module-content">
							 	        <p>Human Resources (HR)</p>
							 	        <a href="<?php echo base_url('HR'); ?>">Login</a>
							 			</a>
							 	    </div>
							 	    
							 	</div>
							 		<div class="modules-box career-module" >
							 	   
							 	     <div class="module-content">
							 	         <p>Careers</p>
							 	         <span>Apply with Us</span>
							 	        <a href="<?php echo base_url('Careers'); ?>" >Apply</a>
							 	     </div>
							 	    
							 	</div>
	                            <div class="modules-box sup-module">
	                               <!--<div class="module-img">-->
	                               <!--     <img style="width:60%;max-width:300px;" src="<?php echo base_url('images/image1.png'); ?>">-->
	                               <!--</div>-->
    	                           
    	                           <div class="module-content">
    	                               <p>Suppliers</p>
							 	   <a href="<?php echo base_url('index.php/auth/login2'); ?>" >Login</a>
    	                           </div>
    	                           
							 	</div>
							 	
							 	<div class="modules-box haccap-module" >
							 	   
							 	     <div class="module-content">
							 	         <p>HACCP</p>
							 	        <a href="<?php echo base_url('haccap'); ?>" >Login</a>
							 	     </div>
							 	    
							 	</div>
							
							 	<div class="modules-box eod-module" >
							 	   
							 	     <div class="module-content">
							 	         <p>EOD Reports</p>
							 	        <a href="<?php echo base_url('EOD/'); ?>" >Login</a>
							 	     </div>
							 	    
							 	</div>
							 <div class="modules-box management-module" >
							 	   
							 	     <div class="module-content">
							 	         <p>Management Corner</p>
							 	        <a href="<?php echo base_url('management/index.php/auth/login2'); ?>" >Login</a>
							 	     </div>
							 	    
							 	</div>
							 
						</div>
					</div>
							 	
        </div>
        </div>
        </div>
    </div>
    
</div>