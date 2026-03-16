<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
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

</style>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" >
        
        <!-- auth-page content -->
        
        <div class="auth-page-content overflow-hidden">
            <div class="mb-5 text-center"><img style="max-width: 270px;width:100%;" src="https://www.cafeadmin.com.au/haccap/images/image1.png"></div>
            <h1 class="text-dark mt-3 mb-4 text-center">Café Locations</h1>
         
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        
                            <div class="row d-flex" style="flex-wrap: wrap;">
                            <?php $i = 0; $color = array('btn-soft-primary','btn-soft-secondary','btn-soft-success','btn-soft-info','btn-soft-warning','btn-soft-danger','btn-soft-dark'); ?>
                            <?php foreach($branches_list as $branches){ 	?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                <a href="<?php echo base_url(); ?>index.php/general/setBranch/<?php echo $branches->branch_id;?>/<?php echo str_replace(' ', '_',$branches->branch_name);?>"class="btn btn-lg <?php echo $color[$i]; ?> p-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong><?php echo $branches->branch_name;?></strong></span></a>
                            </div>
                            <?php $i++; if($i==7){ $i = 0; } }?>
                            
                            </div>
                            <!-- end row -->
                      
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        
    </div>
    <!-- end auth-page-wrapper -->

   
</body>
</html>