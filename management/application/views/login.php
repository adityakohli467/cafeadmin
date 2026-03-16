<!DOCTYPE html>
<html>
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
	<style>
	label.error{
		color:red !important;
	}
	.container {
    height: 100vh;
    display: flex;
    align-items: center;
    max-width: 800px;
    width: 100%;
}
.ht .btn-success, .ht .btn-success:hover {
    background-color: #000000;
    border-color: #000000;
    color: #fff;
}
body{
    background-color:#000;
}
@media(max-width:767px){
    .hide-small{
        display:none;
    }
    body {
    background-color: #fff;
    }
    .panel-body.pan{
        padding:10px !important;
    }
}
	</style>
</head>
 <!--background="<?php echo base_url(); ?>assets/login/tsc1.jpg" -->
<body data-spy="scroll" data-target=".row" data-offset="50" background-position="center;">
    
	<div class="gradient"></div>
		<div class="container">

			<div class="row ht" id="myscrollspy" style="width:100%">
				
			   <div class="col-md-6 col-sm-6 hide-small" style="background-image:url(<?php echo base_url('images/Picture1.jpg'); ?>);background-size:cover;height:430px">
			       
			   </div>
			   <div class="col-md-6 col-sm-6 log" style="height:430px">
			  	  
			  	<div class="panel" style="height: 100%;border-radius:0">
			  		
			  		<div class="panel-body pan" style="padding: 45px;">
			  		    <h3><img style="width:60%;max-width:300px;" src="<?php echo base_url() ?>images/image1.png"></img></h3>
			  			<?php if($message){ ?>
					  <div class="alert alert-danger">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $message;?>
					      </div>
					  <?php } ?>
			  			<form id="login_form" role="form" method="post"  class="login_form" action="<?php echo base_url() ?>index.php/auth/login2">
					    <div class="form-group">
					    	<label for="email">Email</label>
					      <input type="text" name="email" class="form-control" id="email" placeholder="">
					    </div>
					   
					    <div class="form-group">
					    	<label for="password">Password</label>
					    	 <input type="password" name="password" class="form-control" id="pwd" placeholder="">
					      
					    </div>
					    
					     <div class="pull-left">
					    	<div class="form-group checkbox">
					    		<label><input type="checkbox">Remember my email</label>
					    	</div>
					      	
					    </div>
					    <!--<div class="pull-right checkbox">-->
					    <!--	<a href="<?php echo base_url() ?>index.php/auth/forgot_password">Forgot password</a>-->
					    <!--</div>-->
					    
					    
					    <button type="submit" class="btn btn-success btn-block">Login</button>
					    

					    <!--<div class="col-md-12 text-center">-->
					    <!--    <p class="n-reg"><a href="<?php echo base_url() ?>index.php/auth/forgot_password">Forgot password</a></p>-->
					    <!--</div>-->
					    
					  </form>
			  		</div>
			  	</div>
			  
			  </div>
			  
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
                 required:"Please enter email",
                 email:"Please enter valid email"
            },
            password: {
                 required:"Please enter password"
            }
		},

    });	

});
</script>
</body>
</html>
