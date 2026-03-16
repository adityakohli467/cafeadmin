<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>HRM</title>
	
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
  <style>
      .page-head {
    z-index: 999;
}
  </style>
</head>
<body class="branch-main">
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
		    
		    	<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img></a>
		    	
		    </div>
		    
		    <div class="collapse navbar-collapse" id="myNavbar">
		    	
				<ul class="nav navbar-nav sub-nav right">
					<?php if($trail_period > 0){ ?>
			      	<li><a><?php echo $trail_period;?> days remaining</a></li>
			      	<?php } ?>
					<li class="dropdown border-left account-btn">
						<a class="dropdown-toggle dp" style="padding: 5px 15px;" data-toggle="dropdown" href="#">Hi, <?php echo $this->session->userdata('username');?><br><?php echo $this->session->userdata('branch_name');?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?php echo base_url(); ?>index.php/settings/updateDetails">My Details</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
		    </div>
		      

		  </div><!--.container-fluid-->
		</nav>

<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Café Locations</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
		</div>
</div><!--.col-md-12 -->
	
<div class="container-fluid main-container branch-outer">
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
	<div class="col-md-12">
		<div class="row item">
	        <div class="col-md-12">
	        	<div class="panel pn">
	          		<div class="panel-body gen-branch genbrancges1 ">
	          			<div class="modules-wrapper">
	          			    
							<?php foreach($branches_list as $branches){ 
							    
						
							
							
							?>
							<a href="<?php echo base_url(); ?>index.php/general/setBranch/<?php echo $branches->branch_id;?>/<?php echo str_replace(' ', '_',$branches->branch_name);?>" class="modules">
							 	<div class="modules-box">
							 		<img class="modules-images" src="<?php echo base_url(); ?>images/modules/shop2.png">
							 	</div>
							 	<p><?php echo $branches->branch_name;?></p>
							</a>
							<?php }?>
						</div>
	          		</div>
	          	</div>
	        </div>
	    </div>
	</div>
</div>
