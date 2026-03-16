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
	</style>

</head>
		<nav class="navbar nav-border" style="background-color:white;">
		<div class="container">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand brand" href="<?php echo base_url(); ?>index.php/general">Pantry</a>
		    </div>
	
		    <div class="navbar-header right">
		      <ul class="nav navbar-nav sub-nav">
		       
		      	 <li class="dropdown border">
		        <a class="dropdown-toggle dp" data-toggle="dropdown" href="#">Hi, <?php echo $this->session->userdata('username') ?>
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="<?php echo base_url(); ?>index.php/auth/change_password">Change Password</a></li>
		          <li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
		        </ul>
		      </li>
		      </ul>
		    </div>
		  </div><!--.container-fluid-->
		  </div><!--.container-->
		</nav>

<body>
	<div class="container main-container">

	<div class="row ht" id="myscrollspy">
				<h3 class="reset">Change Password</h3>
			  <div class="col-md-4 col-sm-3"></div>
			  <div class="col-md-4 col-sm-4 log">
			  	  
			  	<div class="panel auth">
			  		
			  		<div class="panel-body pan">
			  			<?php if($message){ ?>
					  <div class="alert alert-danger">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $message;?>
					      </div>
					  <?php } ?>
					  
			  			<form method="post" class="login_form auth-form" action="<?php echo base_url() ?>index.php/auth/change_password" id="form_changepwd">
					    <div class="form-group">
					      <label>Old Password</label>
					      <input type="password" name="old" id="old" class ='form-control' placeholder="" value="<?php echo $old;?>">
					    </div>
					    <div class="form-group">
					     	<label>New Password</label>
					      <input type="password" name="new" id="new" class ='form-control'  placeholder="" value="<?php echo $new;?>">
					    </div>
					    
					    <div class="form-group">
					     	<label>Confirm Password</label>
					      <input type="password" name="new_confirm" id="new_confirm" class ='form-control' placeholder="" value="<?php echo $cnf_password;?>">
					    </div>
					    
					    <div class="form-group">
					     
					      <input type="hidden" name="user_id" id="user_id" class ='form-control' value="<?php echo $this->session->userdata['user_id'] ?>">
					    </div>
					    
				
					 	<div class="auth-btn-div">
						    <button type="submit" class="btn btn-success">Save</button>
						    <a href="<?php echo base_url(); ?>index.php/general" class="btn btn-default" tabindex="-1">Cancel</a>
						</div>
					   
					    	<div class="clearfix"></div>
					    
					  </form>
					
			  		</div>
			  	</div>
			  
			  </div>
			 <div class="col-md-4 col-sm-3"></div>
			</div>
		</div>
		
	<div id="footer" class="foot-border">
		<div class="container">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand brand" tabindex="false">TSC</a>
		    </div>
		    <ul class="nav navbar-nav navbar-right foot-nav">
		      <li><a href="#" data-toggle="modal" data-target="#Modal">For application support please click here</a></li>
		      
		      </ul>
		  </div>
		</div><!--.container-->
		<div class="container-fluid foot-row">
			<div class="container">
			  	<div class="foot-left">
			  		<p class="text-muted credit">&copy; <?php echo Date('Y'); ?> Sugarinc NS Pvt Ltd.</p>
			  	</div>
			  	<div class="foot-right">
			  		<p class="text-muted credit">Application developed and maintained by AARIA</p>
			  	</div>
		  	</div>
		</div>
	
		<div class="gradient"></div>
		</div>
		  <div class="modal fade" id="Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
     <form  action="<?php echo base_url(''); ?>index.php/general/send_mail" class="form-horizontal" id="enquiry_form" method="post">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter your Query</h4>
      </div>
        <div class="modal-body">
         <div class="form-group">
			<label for="TSC" class="col-md-4 control-label">Company Name</label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="TSC" id="TSC" value="TSC"  placeholder="TSC" autocomplete="off" readonly>
		    </div>
		</div>
		<div class="form-group">
			<label for="userName" class="col-md-4 control-label">User Name</label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="userName" id="userName" value="<?php echo $this->session->userdata('username') ?>" placeholder="<?php echo $this->session->userdata('username') ?>" autocomplete="off" readonly>
		    </div>
		</div>
		<div class="form-group">
			<label for="email" class="col-md-4 control-label">Email</label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="email" id="email" value="<?php echo $this->session->userdata('email') ?>"  placeholder="<?php echo $this->session->userdata('email') ?>" autocomplete="off" readonly>
		    </div>
		</div>
		<div class="form-group">
		<label for="date" class="col-md-4 control-label">Date</label>
		<div class="col-md-8">
		<input type="text" class="form-control" name="date" id="date" value="<?php echo date('d-m-Y H:i:s'); ?>"   placeholder=" <?php echo "" . date("d/m/y") .""?>" autocomplete="off" readonly>
	    </div>																					
		</div>
		<div class="form-group">
			<label for="message" class="col-md-4 control-label">Description</label>
			<div class="col-md-8">
			<textarea class="form-control" name="message"  id="message" rows="5"  placeholder="Enter Description"></textarea>
		    </div>
		</div>
    </div>
    <div class="modal-footer">
	<button type="submit" class="btn btn-success">Send</button>
      <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
      </div>
    </form>
   </div>   
  </div>
 </div>
 
 <script>
 $('.datepicker-dob').datepicker({
	    dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '-55:-18'
 });
</script>
<script type="text/javascript">
	$('.datepicker-min').datepicker({
		dateFormat: 'dd-mm-yy',
		minDate: 1, // 0 days offset = today
	});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#enquiry_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			message: {
                required:true
            },	
          
	},		
	messages: {
			message: {
                 required:"Please enter message"
            },
		
	},

    });	
	
});
</script>	

		
<script type="text/javascript">
  $('#form_changepwd').validate({
    rules:{
      old:{
        required:true
      },
      'new':{
        required:true,
      },
      new_confirm:{
        required : true,
        equalTo:'#new'
      }
    },
    messages:{
      old:{
        required:"Please enter old password"
      },
      'new':{
        required:"Please enter new password"
      },
      new_confirm:{
        required : "Please enter confirm password",
        equalTo:"New password confirm password does not match"
      }
    }

  });
</script>
</body>
</html>
