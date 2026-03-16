<!DOCTYPE html>
<html>
<head>
	<title>Application</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
	</head>
<div class="container content">
  <h1 class="page-header"><?php echo lang('login_heading');?></h1>
  <p><?php echo lang('login_subheading');?></p>
  <br/>
  <?php if($message){ ?>
  <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $message;?>
      </div>
  <?php } ?>
<div class="col-md-4">
  <form action="<?php echo base_url() ?>index.php/auth/login" method="post" class="form-horizontal" id="form_login">
    <div class="control-group">
      <label class="control-label">EMAILff</label>
      <div class="controls">
        <input type="text" name="identity" id="identity" class ='form-control' value="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">PASSWORD</label>
      <div class="controls">
        <input type="password" name="password" id="password" class ='form-control' value="">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <input type="checkbox" name="remember" id="remember" value="1">
        REMEMBER LOGIN
      </div>
    </div>
    
    <div class="control-group">
      <div class="controls">
        <input type="checkbox" name="timesheet" id="timesheet" value="1">
        TIMESHEET LOGIN
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-primary" value="<?php echo lang('login_submit_btn');?>">
    </div>
</form>
  <p><a href="<?php echo base_url() ?>index.php/auth/forgot_password"><?php echo lang('login_forgot_password');?></a></p>
  </div>
</div>
<script type="text/javascript">
  $('#form_login').validate({
    rules:{
      identity:{
        required:true,
        email:true
      },
      password:{
        required : true
      }
    },
    messages:{
      identity:{
        required:"Please enter your email address",
        email:"The email entered does not exist"
      },
      password:{
        required : "Please enter your password"
      }
    }

  });
</script>