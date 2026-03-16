
<div class="container content">
  <h1 class="page-header">Admin Login</h1>
 <!--  <p><?php echo lang('login_subheading');?></p> -->
  <br/>

  <?php if($message){ ?>
  <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $message;?>
      </div>
  <?php } ?>
<div class="col-md-4">
  <form action="<?php echo base_url() ?>index.php/auth/admin" method="post" class="form-horizontal" id="form_adminlogin">
    <div class="control-group">
      <label class="control-label"><b>EMAIL</b></label>
      <div class="controls">
        <input type="text" name="identity" id="identity" class ='form-control' value="<?php echo $identity;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label"><b>PASSWORD</b></label>
      <div class="controls">
        <input type="password" name="password" id="password" class ='form-control' value="">
      </div>
    </div>
    <!-- <div class="control-group">
      <div class="controls">
        <input type="checkbox" name="remember" id="remember" value="1">
        Remember me
      </div>
    </div> -->
    <br>
    <div class="form-actions">
      <input type="submit" class="btn btn-primary" value="<?php echo lang('login_submit_btn');?>">
    </div>
</form>
  <!-- <p><a href="<?php echo base_url() ?>index.php/auth/forgot_password"><?php echo lang('login_forgot_password');?></a></p> -->
  </div>
</div>
<script type="text/javascript">
  $('#form_adminlogin').validate({
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
        email:"The Email Id entered does not exist"
      },
      password:{
        required : "Please enter your password"
      }
    }

  });
</script>