<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>EOD</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="HACCP MANAGEMENT" name="description" />
    <meta content="HACCP MANAGEMENT" name="author" />
    

    <!-- Layout config Js -->
    <script src="<?php echo base_url(""); ?>haccp-assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(""); ?>haccp-assets/css/style.css" rel="stylesheet" type="text/css" />
<style>
    .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
.auth-one-bg {
    background-image: url(<?php echo base_url(""); ?>haccp-assets/images/small/img-2.jpg);
}
</style>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper bg-soft-dark py-5 d-flex justify-content-center align-items-center min-vh-100" >
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <h1 class="text-white mb-3 text-center">EOD Reports</h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row justify-content-center g-0">
                                
                                <div class="col-lg-6 p-5 auth-one-bg">
                                    <div class="p-lg-5 p-4 h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            
                                            <div class="p-lg-4 mt-4 mb-4 text-center ">
                                                <img style="max-width: 300px;width:100%;" src="<?php echo base_url('images/logo-white.png'); ?>">
                                                <div class="mb-4 mt-4">
                                                    <?php if($login_type =="manager") { ?>
                                    				    <h3 class="text-white">Manager Portal</h3>
                                    				<?php } elseif($login_type =="employee") { ?>
                                    					<h3 class="text-white">Employee Portal</h3>
                                    				<?php } elseif($login_type =="admin") { ?>
                                    					<h3 class="text-white">Admin Portal</h3>
                                    				<?php }else { ?>
                                    					<h3 class="text-white">Timesheet Portal</h3>
                                    				<?php } ?>
                                                    
                                                </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6 p-5 bg-dark">
                                    <div class="py-5 p-2 h-100">
                                        <?php if($message){ ?>
                                        <div class="alert alert-danger alert-dismissible shadow fade show mb-xl-0" role="alert">
                                                     <?php echo $message;?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                    					  
                    					  <?php } ?>
                    					  <?php if(null !==$this->session->userdata('sucess_msg')) { ?>
                    					   <div class="alert alert-success shadow mb-xl-0 mb-2" role="alert"><?php echo $this->session->flashdata('sucess_msg'); ?></div>
                    					
                    						<?php } ?>
                    						<?php if(null !==$this->session->userdata('error_msg')) { ?>  
                    						 <div class="alert alert-danger shadow mb-xl-0 mb-2" role="alert"><?php echo $this->session->flashdata('error_msg'); ?></div>
                    						<?php } ?>
                                               
                                       <form id="login_form" role="form" method="post"  class="login_form" action="<?php echo base_url() ?>index.php/auth/login">
                    					    <div class="form-group">
                    					    	<label for="email" class="mb-0 text-white">EMAIL ID</label>
                    					      <input type="text" name="email" class="form-control" required id="email" placeholder="">
                    					    </div>
                    					   
                    					    <div class="form-group mt-3">
                    					    	<label for="password" class="mb-0 text-white">PASSWORD</label>
                    					    	 <input type="password" name="password" required class="form-control" id="pwd" placeholder="">
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
                    					    
                    					    
                                            <button type="submit" class="mt-4 btn btn-success btn-sm w-100 waves-effect waves-light"><i class="mdi mdi-login align-middle fs-16 me-2"></i>LOGIN</button>
                                            
                    					    
                    					    
                    
                    					    <!--<div class="col-md-12 text-end">-->
                    					    <!--    <p class="n-reg"><a class="text-danger" href="<?php // echo base_url() ?>index.php/auth/forgot_password">Password Incorrect, Please contact the admin</a></p>-->
                    					     
                    					    <!--</div>-->
                    					    <a href="<?php echo base_url() ?>index.php/auth/homepage"><button type="button" class="btn btn-sm btn-primary w-100 waves-effect waves-light"><i class="mdi mdi-reply align-middle fs-16 me-2"></i> Go Back</button></a>
                    					    
                    					  </form>
                                    </div>
                                </div>
                                <!-- end col -->
                                
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-white">&copy;
                                CAFEADMIN @Maintained by AARIA
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
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