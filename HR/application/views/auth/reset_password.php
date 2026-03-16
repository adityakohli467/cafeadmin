<!DOCTYPE html>
<html lang="en">
<head>
	<title>HRM</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
		<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<style>
	label.error{
		color:red !important;
	}
	</style>
</head>
<body background="<?php echo base_url(); ?>assets/login/tsc1.jpg"  data-spy="scroll" data-target=".row" data-offset="50" background-position="center;">
	<div class="gradient"></div>
	<div class="container">

			<div class="row ht" id="myscrollspy">
				<h3>Reset Password</h3>
			  
			   <div class="col-md-4" style="left: 34%;">
			  	  
			  	<div class="panel">
			  		
			  		<div class="panel-body pan">
						<?php if($message){ ?>
						  <div class="alert alert-danger">
						      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						      <?php echo $message;?>
						      </div>
						  <?php } ?>
			  			<form id="resetpwd_form" role="form" method="post"  class="login_form" action="<?php echo base_url() ?>index.php/auth/reset_password/<?php echo $code;?>">
			  				 
			  				
					    <div >
					    	<label for="new"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
								<input type="password" name="new_pwd" value="" class="form-control" id="new" pattern="^.{8}.*$">
						</div>
					   
					    <div >
					    	<label for="new_confirm"><?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?></label>
							<input type="password" name="new_confirm" class="form-control" value="" id="new_confirm" pattern="^.{8}.*$">
					    </div>
					    

							<?php echo form_input($user_id);?>
							<?php echo form_hidden($csrf); ?>
							<div class="auth-btn-div" style="margin-top: 10px;">
								<input type="submit" class="btn btn-success" name="submit" value="Save" style="height: 30px;">
								<a href="<?php echo base_url(); ?>index.php/auth/login" class="btn btn-default" tabindex="-1" style="height: 30px;margin-left: 10px;">Cancel</a>
							</div>
					  </form>
			  		</div>
			  	</div>
			  
			  </div>
			  <div class="col-md-3 col-sm-4"></div>
			</div>
		</div>
			


<script type="text/javascript">
	$(document).ready(function() { 
    $("#resetpwd_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			new_pwd: {
                required:true
            },
            new_confirm: {
                required:true,
                equalTo:'#new'
            }
			
		},		
		messages: {
			new_pwd: {
                required:"Please enter new password"
            },
            new_confirm: {
                required:"Please enter confirm password",
                equalTo:"New Password and Confirm Password does not match"
            }
		},

    });	

});
</script>

</body>
</html>