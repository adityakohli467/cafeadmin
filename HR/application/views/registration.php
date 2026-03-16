<!DOCTYPE html>
<html>
	<head>
	<title>Pantry</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" class="init">

	</script>
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
				<h3><img src="<?php echo base_url() ?>images/image1.png"></img></h3>
			   <div class="col-md-4 col-sm-4"></div>
			   <div class="col-md-4 col-sm-4 log">
			  	  
			  	<div class="panel">
			  		
			  		<div class="panel-body pan">
			  			<?php if($message){ ?>
					  <div class="alert alert-danger">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $message;?>
					      </div>
					  <?php } ?>
			  			<form id="register_form" role="form" method="post"  class="register_form" action="<?php echo base_url() ?>index.php/auth/registration">
					    
					    <div class="form-group">
					    	<label for="password">Package</label>
					    	<select name="package" class="form-control">
					    		<option value="">Select</option>
					    		<?php 
					    		if(!empty($packages)){
					    			foreach($packages as $pkg){ ?>
					    				<option value="<?php echo $pkg->package_id;?>"><?php echo $pkg->package_name;?></option>
					    		<?php
					    			}
					    		}?>
					    		
					    	</select>
					    </div>
					    <div class="form-group">
					    	<label for="name">Name</label>
					      <input type="text" name="name" class="form-control" id="name" placeholder="">
					    </div>
					    <div class="form-group">
					    	<label for="email">Email</label>
					      <input type="text" name="email" class="form-control" id="email" placeholder="">
					    </div>
					    <div class="form-group">
					    	<label for="password">Password</label>
					    	 <input type="password" name="password" class="form-control" id="pwd" placeholder="">
					    </div>
					    
					    
					    
					    <!-- <div class="pull-left">-->
					    <!--	<div class="form-group checkbox">-->
					    <!--		<label><input type="checkbox">Remember my email</label>-->
					    <!--	</div>-->
					      	
					    <!--</div>-->
					    <!--<div class="pull-right checkbox">-->
					    <!--	<a href="<?php echo base_url() ?>index.php/auth/forgot_password">Forgot password</a>-->
					    <!--</div>-->
					    
					    
					    <button type="submit" class="btn btn-success btn-block">Signup</button>
					    

					    <div class="col-md-12 text-right">
					        <p class="n-reg">Already have an account? <a href="<?php echo base_url() ?>index.php/auth/login">Login</a></p>
					    </div>
					    <!--<div class="col-md-6 text-left">-->
					    <!--	<p class="n-reg"><a href="<?php echo base_url() ?>index.php/auth/">Create account</a></p>-->
					    <!--</div>-->
					  </form>
			  		</div>
			  	</div>
			  
			  </div>
			  <div class="col-md-3 col-sm-4"></div>
			</div>
		</div>
			
<script type="text/javascript">
	$(document).ready(function() {
    $(".register_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
	    	name: {
                required:true
            },
			email: {
                required:true,
                email:true
            },
            password: {
                required:true
            },
            package: {
                required:true
            }
			
		},		
		messages: {
			name: {
                 required:"Please provide name"
            },
			email: {
                 required:"Please provide email",
                 email:"Please provide valid email"
            },
            password: {
                 required:"Please provide password"
            },
            package: {
                 required:"Please select package"
            }
		},

    });	

});
</script>
</body>
</html>
