
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
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                   
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Prep. Area</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12"> 
                             <div class="row d-flex" style="flex-wrap: wrap;">
                                <?php $i = 0; $color = array('btn-soft-primary','btn-soft-warning','btn-soft-secondary','btn-soft-success','btn-soft-info','btn-soft-danger','btn-soft-dark'); ?>
                                <?php foreach($prepArea as $row){ 	?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                    <a href="<?php echo base_url(); ?>index.php/forms/prepAreaForm/<?php echo $row['prep_area_id'].'/'.$table_name;?>" class="btn btn-lg <?php echo $color[$i]; ?> p-4 w-100 h-100 d-flex justify-content-center align-items-center"><span ><strong><?php echo $row['prep_area_name'];?></strong></span></a>
                                </div>
                                <?php $i++; if($i==7){ $i = 0; } }?>
                                
                                </div>
                                <!-- end row -->
                            </div> 
                           
                        </div>
                     
                    </div>
                    
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

