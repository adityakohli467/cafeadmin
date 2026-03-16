<!DOCTYPE html>
<html>
<head>
	<title>Pantry</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	
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
		<nav class="navbar navbar-default nav-border">
		  <div class="container-fluid">
		    <div class="navbar-header border-right">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
    			</button>
		    
		    	<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/skyward_logo.JPG"></img> </a>
		    	
		    </div>
		    
		    
		  </div><!--.container-fluid-->
		</nav>
		
	<div class="col-md-12 page-head border-bottom">
		<span class="span-20 left border-right">
			<h3>Unable to connect</h3>
		</span>
		
		<span class="span-30">
			<p class="page-head-p left">
				<span id="limit_message"></span>
			</p>
		</span>
        
	</div><!--.col-md-12 -->
	
	<div class="container-fluid main-container">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<p style="text-align:center; font-size:16px;">Oops looks like there is an issue with your netowrk connection, <a href="javascript:history.go(-1)">click here</a> to try agian</p>
				</div>
			</div>
		</div>
	</div>
		
		
	<br>
	<footer class="footer">
		<div id="footer" class="foot-border">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/skyward_logo.JPG"></img> </a>
		    </div>
		    <ul class="nav navbar-nav navbar-right foot-nav">
		      <!--<li><a href="#" data-toggle="modal" data-target="#Modal">For application support please click here</a></li>-->
		      
		      </ul>
		  </div>
		<div class="container-fluid foot-row">
			  	<div class="foot-left">
			  		<p class="text-muted credit">&copy; <?php echo Date('Y'); ?> Skyward One</p>
			  	</div>
			  	<div class="foot-right">
			  		<p class="text-muted credit">Application developed and maintained by Skyward One</p>
			  	</div>
		</div>
		<div class="gradient"></div>
		</div>
	</footer>
	
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
</body>
</html>
