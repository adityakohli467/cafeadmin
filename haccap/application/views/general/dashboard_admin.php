
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
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <!-- start page title -->
        <div class="page-title bg-dark">
            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 text-white">Dashboard</h4>
    
                            <!--<div class="page-title-right">-->
                            <!--    <ol class="breadcrumb m-0">-->
                            <!--        <li class="breadcrumb-item">Dashboard</li>-->
                            <!--    </ol>-->
                            <!--</div>-->
    
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
         <!-- end page title -->           

                

     <div class="container-fluid">

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" >
        
        <!-- auth-page content -->
        
        <div class="auth-page-content dashboard_forms overflow-hidden">
            
         
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                       <h2 class="text-dark mt-3 mb-4 text-center">ADMIN FORMS</h2>
                        <div class="row d-flex justify-content-center" style="flex-wrap: wrap;">
                        <?php  $i = 0; $color = array('btn-soft-primary','btn-soft-secondary','btn-soft-success','btn-soft-info','btn-soft-warning','btn-soft-danger','btn-soft-dark'); ?>
                        <?php if($this->session->userdata('role') == 'Prep Area'){ ?>
                        <?php foreach($tablesRecord as $rec){ ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                            <a href="<?php echo base_url(); ?>index.php/forms/prepArea/<?php echo $rec['path']; ?>" class="btn btn-md <?php echo $color[$i]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span><strong><?php echo $rec['table_name']; ?></strong></span></a>
                        </div>
                        <?php $i++; if($i==7){ $i = 0; } ?>
                         <?php }  }else{ ?>
                         
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_temp_form" class="btn btn-md <?php echo $color[0]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Temperature</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_cold_form" class="btn btn-md <?php echo $color[1]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>OPENING AND CLOSING</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_dishwashing_form" class="btn btn-md <?php echo $color[2]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Dishwashing</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_retention_stock_form" class="btn btn-md <?php echo $color[3]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Retention Stock</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_production_record_time" class="btn btn-md <?php echo $color[4]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Production Record Time</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_calibration_form" class="btn btn-md <?php echo $color[5]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Calibration</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_food_wastage_report" class="btn btn-md <?php echo $color[6]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Food Wastage Report</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_kitchen_operational_closedown_checklist" class="btn btn-md <?php echo $color[0]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>KITCHEN OPERATIONAL CLOSE DOWN CHECKLIST</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_operational_incident_report" class="btn btn-md <?php echo $color[1]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>INCIDENT REPORT</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_mockrecall_record" class="btn btn-md <?php echo $color[2]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>MOCKRECALL RECORD</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_training_record" class="btn btn-md <?php echo $color[3]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Staff Training RECORD</strong></span></a></div>
                         <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/forms/prepArea/haccap_food_transfer_and_order_record" class="btn btn-md <?php echo $color[4]; ?> p-2 py-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Food Transfer & Order Record</strong></span></a></div>
                        <?php } ?>
                        </div>
                        <!-- end row -->
                      
                    </div>
                    <!-- end col -->

                </div>
                <?php if($this->session->userdata('role') != 'Prep Area'){ ?>
                <div class="row">
                    <div class="col-lg-12">
                       <h2 class="text-dark mt-3 mb-4 text-center">Menu Planner</h2>
                        <div class="row d-flex justify-content-center" style="flex-wrap: wrap;">
                        
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menuplanner/weekMenuList" class="btn btn-md <?php echo $color[0]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Menu Planner</strong></span></a></div>
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menuplanner/viewMenu" class="btn btn-md <?php echo $color[1]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>Setup Menu</strong></span></a></div>
                        
                        </div>
                        <!-- end row -->
                      
                    </div>
                    <!-- end col -->

                </div>
                <?php } ?>
                <?php if($this->session->userdata('role') != 'Prep Area'){ ?>
                <div class="row">
                    <div class="col-lg-12">
                       <h2 class="text-dark mt-3 mb-4 text-center">Recipe Builder</h2>
                        <div class="row d-flex" style="flex-wrap: wrap;">
                        
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menucard/viewRecipes/hotfood" class="btn btn-md <?php echo $color[0]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>HOT FOOD</strong></span></a></div>
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menucard/viewRecipes/salad" class="btn btn-md <?php echo $color[1]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>SALAD</strong></span></a></div>
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menucard/viewRecipes/coldfood" class="btn btn-md <?php echo $color[2]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>COLD FOOD</strong></span></a></div>
                         <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4"> <a href="<?php echo base_url(); ?>index.php/menucard/viewRecipes/sweets" class="btn btn-md <?php echo $color[3]; ?> p-2 py-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong>SWEETS</strong></span></a></div>
                       
                        </div>
                        <!-- end row -->
                      
                    </div>
                    <!-- end col -->

                </div>
                <?php } ?>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        
    </div>
    <!-- end auth-page-wrapper -->
    
    
    </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
