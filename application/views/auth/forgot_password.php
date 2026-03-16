<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cafe Admin</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.jpg" />
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" class="init">

	</script>
</head>
<body background="<?php echo base_url(); ?>assets/login/tsc1.jpg"  data-spy="scroll" data-target=".row" data-offset="50" background-position="center;">

	<div class="gradient"></div>
	<div class="container">

			<div class="row ht" id="myscrollspy">
				<h3><?php echo lang('login_forgot_password');?></h3>
			
			   <div class="col-md-4 col-sm-4"></div>
			   <div class="col-md-4 col-sm-4 log">
			  	  
			  	<div class="panel">
			  		
			  		<div class="panel-body pan">
			  			
			  		 <?php if($message){ ?>
					  <div class="alert alert-success">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $message;?>
					  </div>
					  <?php } ?>
			  		  <form action="<?php echo base_url() ?>index.php/auth/forgot_password" method="post" class="login_form" id="form_forgotpwd">
			  				<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
			  			
					    <div class="form-group control-group">
					    	<label for="email"><b>Email</b></label>
					    	<div class="controls">
					    		<input type="text" name="email" id="email" class="form-control" value="">
					    	</div>
					    </div>
					   
					    <div class="form-actions auth-btn-div">
					      <input type="submit" class="btn btn-success " value="<?php echo lang('forgot_password_submit_btn');?>">
					      <a href="<?php echo base_url(); ?>index.php/auth/login" class="btn btn-default" tabindex="-1">Cancel</a>
					    </div>
					    <div class="clearfix"></div>
					    
					  </form>
			  		</div>
			  	</div>
			  
			  </div>
			  <div class="col-md-3 col-sm-4"></div>
			</div>
		</div>
			


<script type="text/javascript">
  $('#form_forgotpwd').validate({
    rules:{
      email:{
        required:true,
        email : true,
        remote : {type:'post',url:'<?php echo base_url() ?>index.php/auth/forgot_email_check',async:false}
      }
    },
    messages:{
      email:{
        required:"Please enter email",
        email:"Invalid email id",
        remote:"Please enter registered email"
      }
    }

  });
</script>
<style>
	label.error{
		color:red !important;
	}
	</style>
</body>
</html>