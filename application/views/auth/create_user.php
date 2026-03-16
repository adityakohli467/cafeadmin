<div class="container content">
  <h1 class="page-header"><?php echo lang('create_user_heading');?></h1>
  <p><?php echo lang('create_user_subheading');?></p>
  <?php if($message){ ?>
  <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $message;?>
  </div>
  <?php } ?>
  <br/>
  <div class="col-md-4">  
  <form action="<?php echo base_url() ?>index.php/auth/create_user" method="post" class="form-horizontal" id="form_registration">
    <div class="control-group">
      <label class="control-label">Name</label>
      <div class="controls">
        <input type="text" name="name" id="name" class ='form-control' value="<?php echo $name;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email</label>
      <div class="controls">
        <input type="text" name="email" id="email" class ='form-control' value="<?php echo $email;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Password</label>
      <div class="controls">
        <input type="password" name="password" id="password" class ='form-control' value="<?php echo $password;?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Confirm Password</label>
      <div class="controls">
        <input type="password" name="password_confirm" id="password_confirm" class ='form-control' value="<?php echo $password_confirm;?>">
      </div>
    </div>
    <div class="form-actions">
       <input type="submit" class="btn btn-primary" value="Register">
    </div>
  </form>
  </div>
</div>
<style type="text/css">
  label.error{
    color:red;
  }
</style>
<script type="text/javascript">
  $('#form_registration').validate({
    rules:{
      name:{
        required:true
      },
      email:{
        required:true,
        email:true,
        remote:{type:'post',url:'<?php echo base_url() ?>index.php/auth/email_check',async:false}
      },
      password:{
        required : true
      },
      password_confirm:{
        required : true,
        equalTo : '#password'
      }
    },
    messages:{
      name:{
        required:"Please Enter Name"
      },
      email:{
        required:"Please Enter Email",
        email:"Invalid Email Id",
        remote :"Email is already Exist"
      },
      password:{
        required : "Please Enter Password"
      },
      password_confirm:{
        required : "Please Enter Confirm Password",
        equalTo : '#password'
      }
    }

  });
</script>