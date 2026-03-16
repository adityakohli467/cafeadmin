<!DOCTYPE html>
<html>
<head>
	<title>Cafe Admin</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.jpg" />
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	 <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	 <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	 <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>res/css/theme.css">
	
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false,
		    } );
		} );
	</script>

  
</head>
<body>
	<div class="gradient"></div>

	<!--navigation-bar-->
		<nav class="navbar navbar-default nav-border">
		  <div class="container-fluid">
		    <div class="navbar-header border-right">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
    			</button>
		    
		    	<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img> </a>
		    	
		    </div>
		    
		    <div class="collapse navbar-collapse" id="myNavbar">
		    
				<ul class="nav navbar-nav sub-nav right">
				
					<li class="dropdown border-left account-btn">
						<a class="dropdown-toggle dp" style="padding: 15px;" data-toggle="dropdown" href="#">Hi, <?php echo $this->session->userdata('username');?><?php echo $this->session->userdata('branch_name');?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<!--<li><a href="<?php echo base_url(); ?>index.php/settings/updateDetails">My Details</a></li>-->
							<li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
		    </div>
		      

		  </div><!--.container-fluid-->
		</nav>
