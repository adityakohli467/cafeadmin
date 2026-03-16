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
    background-color: #f36422 !important;
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
                                <div class="col-lg-6 p-5 bg-secondary">
                                    <div class="p-lg-5 p-4 h-100">
                                       
                                      

                                        <div class="p-lg-4 mt-4 mb-4 text-center ">
                                            <div class="mb-4">
                                                <h5 class=" text-white"><strong>Login to Admin portal!</strong></h5>
                                            </div>
                                            <!-- Buttons with Label -->
                                            <a href="<?php echo base_url(""); ?>index.php/auth/login/admin"><button type="button" class="btn btn-lg btn-dark btn-label waves-effect waves-light"><i class="ri-user-line label-icon align-middle fs-16 me-2"></i> Login</button></a>
                                        </div>

                                        
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6 p-5 auth-one-bg">
                                    <div class="p-lg-5 p-4 h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            
                                            <!--<div class="p-lg-4 mt-4 mb-4 text-center ">-->
                                            <!--    <div class="mb-4">-->
                                            <!--        <h5 class="text-white"><strong>Login to Admin portal!</strong></h5>-->
                                            <!--    </div>-->
                                                <!-- Buttons with Label -->
                                            <!--    <a href="<?php echo base_url(""); ?>index.php/auth/login/admin"><button type="button" class="btn btn-lg btn-warning btn-label waves-effect waves-light"><i class="ri-user-line label-icon align-middle fs-16 me-2"></i> Login</button></a>-->
                                            <!--</div>-->
                                            
                                        </div>
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

   
</body>
</html>