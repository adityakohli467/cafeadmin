<!DOCTYPE html>
<html>
	<head>
	<title>HRM</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
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
	.text-center .n-goback{
	        box-shadow: 2px 2px #6e6262;
    background-color: #4CAF50;
    
        height: 40px;
    width: 80px;
    margin-top: 12px;
    text-decoration: none;
	}
	.text-center .n-goback p{
	    color: #fffbfb !important;
	        font-weight: 600;
	        
	}
	</style>
</head>
<body background="<?php echo base_url(); ?>assets/login/tsc1.jpg"  data-spy="scroll" data-target=".row" data-offset="50" background-position="center;">
    
	<div class="gradient"></div>
		<div class="container">

			<div class="row ht" id="myscrollspy">
				<h3><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img></h3>
				<?php if($login_type =="manager") { ?>
				<h3>Manager Portal</h3>
				<?php } elseif($login_type =="employee") { ?>
					<h3>Employee Portal</h3>
				<?php } elseif($login_type =="admin") { ?>
					<h3>Admin Portal</h3>
				<?php }else { ?>
					<h3>Timesheet Portal</h3>
				<?php } ?>
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
					  <?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
						<div class='hideMe'>
							<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
						</div>
						<?php } ?>
						<?php if(null !==$this->session->userdata('error_msg')) { ?>  
						<div class='hideMe'>
							<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
						</div>
						<?php } ?>
			  			<form id="login_form" role="form" method="post"  class="login_form" action="<?php echo base_url() ?>index.php/auth/login">
					    <div class="form-group">
					    	<label for="email">EMAIL ID</label>
					      <input type="text" name="email" class="form-control" id="email" placeholder="">
					    </div>
					   
					    <div class="form-group">
					    	<label for="password">PASSWORD</label>
					    	 <input type="password" name="password" class="form-control" id="pwd" placeholder="">
					    	 <input type="hidden" name="login_type" value="<?php echo $login_type; ?>">
					      
					    </div>
					    
					    <!-- <div class="pull-left">-->
					    <!--	<div class="form-group checkbox">-->
					    <!--		<label><input type="checkbox" name="remember">REMEMBER MY LOGIN</label>-->
					    <!--	</div>-->
					      	
					    <!--</div>-->
					
					    <!--<div class="pull-right checkbox">-->
					    <!--	<a href="<?php echo base_url() ?>index.php/auth/forgot_password">Forgot password</a>-->
					    <!--</div>-->
					    
					    
					    <button type="submit" class="btn btn-success btn-block " style="border-radius: 5px;padding: 5px 19px;">LOGIN</button>
					    

					    <div class="col-md-12 text-center" style="display:flex">
					        <p class="n-reg"><a href="<?php echo base_url() ?>index.php/auth/forgot_password">Forgot Password</a></p>
					        <p a class="n-reg"><a href="<?php echo base_url() ?>index.php/auth/homepage">Go Back</a></p>
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
    $("#login_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			email: {
                required:true,
                email:true
            },
            password: {
                required:true
            }
			
		},		
		messages: {
			email: {
                 required:"Please enter your email address.",
                 email:"The email address entered does not exist."
            },
            password: {
                 required:"Please enter your password."
            }
		},

    });	

});
</script>
</body>
</html>
