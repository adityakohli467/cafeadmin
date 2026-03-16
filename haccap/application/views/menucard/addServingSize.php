<?php if(isset($form_name) && $form_name == 'view'){ $disabled='disabled'; } ?>
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
                    
                        <form action="<?php echo base_url() ?>index.php/menucard/submitServingSize" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">
                                         <?php if(isset($ServingSize[0]->haccap_ServingSize_id)){?>
                                             Edit Serving Size
                                          <?php } else { ?>
                                             Add Serving Size
                                        <?php } ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menucard/viewServingSize"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                   <?php if(isset($ServingSize[0]->haccap_ServingSize_id)){?>
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    
                                    <?php }else {  ?>
                                    <input type="submit" class="btn btn-primary" value="Create">
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                     <?php if(isset($ServingSize[0]->haccap_ServingSize_id)){  ?>
                                          <input class="form-control" type="hidden" name="haccap_ServingSize_id" value="<?php echo $ServingSize[0]->haccap_ServingSize_id;?>">
                                      <?php } ?>
                                       
                          </div>
                  <div class="row">
                     <div class="col-12 col-md-6 ">
                         <label>Serving Size Name *</label>
                            <input type="text" class="form-control" name="serving_size_name" value="<?php if(isset($ServingSize[0]->serving_size_name)){ echo $ServingSize[0]->serving_size_name; } ?>"  required >
                    </div>
                    <?php if(isset($ServingSize[0]->haccap_ServingSize_id)){?>
                     <div class="col-12 col-md-6 ">
                         <label>Serving Size Status</label>
                            <select class="form-control" name="status">
                   
                            <option value="1"  <?php if(isset($ServingSize[0]->status) && $ServingSize[0]->status == '1' ){ echo 'selected'; } ?>>Activate</option>
                            <option value="0"  <?php if(isset($ServingSize[0]->status) && $ServingSize[0]->status == '0' ){ echo 'selected'; } ?>>Deactivate</option>
                        </select>
                    </div>
                    <?php } ?>
                    
                    </div>
                    
                  
                  </div>
                 
                
                  
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
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



