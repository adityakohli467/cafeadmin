<!DOCTYPE html>
<html>
<head>
	<title>Hr</title>
	<meta charset="utf-8">
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
</head>
<body>
	<div class="gradient"></div>
	
	<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>
		<form class="form-horizontal" id="activate_password" role="form" method="post" action="<?php echo base_url(); ?>index.php/employees/email_verified_password" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Reset Password</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Save</button>

		</div>
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
	
  		<div class="row">
  			<div class="col-md-12">
  				<div class="col-md-3">
  				</div>	
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Set Password To Activate Your Account</h3>
			        </div>
			        <input type="hidden" name="id" value="<?php echo $id; ?>">
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">New Password<span>*</span></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Confirm Password<span>*</span></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="con_password" id="confirm_password" autocomplete="off" >
							</div>
						</div>
	          		</div>
        		</div>
	        </div>
	    </div>
	</div>
  
   </div>
  </form>
  <br>
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>

