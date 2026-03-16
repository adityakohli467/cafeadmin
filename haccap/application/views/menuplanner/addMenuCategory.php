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
                    <?php if(isset($action) && $action =='edit') {  ?>
                        <form action="<?php echo base_url() ?>index.php/menuplanner/submitupUpdateMenuCategory" method="post" class="form-horizontal" >
                    <?php } else { ?>
                        <form action="<?php echo base_url() ?>index.php/menuplanner/submitMenuCategory" method="post" class="form-horizontal" >
                    <?php } ?>
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">
                                         <?php if(isset($action) && $action =='edit') {  ?>
                    			    		Update Menu Category
                    			    	<?php } else { ?>
                    			    		Add New Menu Category
                    			    	<?php } ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menuplanner/viewMenuCategory"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                   <?php if(isset($action) && $action =='edit') {  ?>
                                        <input type="submit" class="btn btn-primary" value="Update  Category">
                                    
                                    <?php }else {  ?>
                                    <input type="submit" class="btn btn-primary" value="Add  Category">
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
                                     <?php if(isset($action) && $action =='edit') {  ?>
                                         <input type="hidden" class="form-control" name="category_id" value="<?php echo $menuCategoryDetails->category_id; ?>" >
                                      <?php } ?>
                                       
                          </div>
                  <div class="row">
                     <div class="col-12 col-md-6 ">
                         <label>Category *</label>
                            <input type="text" class="form-control" name="category" autocomplete="off" value="<?php echo (isset($menuCategoryDetails->name) && $menuCategoryDetails->name  !='' ? $menuCategoryDetails->name : '') ?>" required >
                    </div>
                    
                    
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



