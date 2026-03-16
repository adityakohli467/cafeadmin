
<style link="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css"> </style>
<style>
body {
    background: #222D32;
    font-family: 'Roboto', sans-serif;
}

.login-box {
    margin-top: 75px;
    height: auto;
    background: #1A2226;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.login-key {
    height: 100px;
    font-size: 80px;
    line-height: 100px;
    background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.login-title {
    margin-top: 15px;
    text-align: center;
    font-size: 30px;
    letter-spacing: 2px;
    margin-top: 15px;
    font-weight: bold;
    color: #ECF0F5;
}

.login-form {
    margin-top: 25px;
    text-align: left;
}

input[type=text] {
    background-color: #1A2226;
    border: none;
    border-bottom: 2px solid #0DB8DE;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 0px;
    color: #ECF0F5;
}

input[type=password] {
    background-color: #1A2226;
    border: none;
    border-bottom: 2px solid #0DB8DE;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    padding-left: 0px;
    margin-bottom: 20px;
    color: #ECF0F5;
}

.form-group {
    margin-bottom: 40px;
    outline: 0px;
}

.form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-bottom: 2px solid #0DB8DE;
    outline: 0;
    background-color: #1A2226;
    color: #ECF0F5;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0;
}

label {
    margin-bottom: 0px;
}

.form-control-label {
    font-size: 10px;
    color: #fdfdfd !important;
    font-weight: bold;
    letter-spacing: 1px;
}

.btn-outline-primary {
    border-color: #a1a1a1 !important;
    color: #fdfdfd !important;
    border-radius: 0px;
    font-weight: bold;
    letter-spacing: 1px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.btn-outline-primary:hover {
    background-color: #0DB8DE;
    right: 0px;
}

.login-btm {
    float: left;
}

.login-button {
    padding-right: 0px;
    text-align: right;
    margin-bottom: 25px;
}

.login-text {
    text-align: left;
    padding-left: 0px;
    color: #A2A4A4;
}

.loginbttm {
    padding: 0px;
}
</style>
<html>
    <head>
        <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portal Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    
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

    </head>
    <body style=" background: #222D32;
    font-family: 'Roboto', sans-serif;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                   	<?php if($login_type =="manager") { ?>
				Manager Portal
				<?php } elseif($login_type =="employee") { ?>
					Employee Portal
				<?php } elseif($login_type =="admin") { ?>
					Admin Portal
				<?php }else { ?>
					Timesheet Portal
				<?php } ?>
                </div>
                	<?php if($login_type =="employee") { ?>
                <p style="color: #e02c2c;"> Please complete Onboarding tasks before login to your HR portal </p>
	            <?php } ?>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
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
						
						
                     	<form id="login_form" role="form" method="post"  class="login_form" action="<?php echo base_url() ?>index.php/auth/login/<?php echo $login_type; ?>">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" id="pwd" class="form-control" >
                                <input type="hidden" name="login_type" value="<?php echo $login_type; ?>">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                   <a href="<?php echo base_url() ?>index.php/auth/homepage" class="btn btn-outline-primary">BACK</a>
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                    
                                </div>
                                  <div class="col-md-12 text-center" style="display:flex">
					        <p class="n-reg"><a href="<?php echo base_url() ?>index.php/auth/forgot_password" style="color: #e1e1e1;">Forgot Password ?</a></p>
					     
					    </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
</body>
</html>



