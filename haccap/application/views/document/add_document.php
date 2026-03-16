
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
                    
                        <form action="<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>" id="document_add" method="post" class="form-horizontal" enctype="multipart/form-data">
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($page_heading) && $page_heading != '' ){ echo $page_heading; } else{ echo "Document  Details:"; } ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/<?php echo $cancel; ?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    
                                    <input type="submit" name="contact_submit" class="btn btn-primary" value="Submit">
                                  
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
                                    <div class="col-md-3"></div> 
                                    <div class="col-md-6"> 
                                      <div class="row">
                                        <div class="col-md-12 mb-3">  
                                            <div class="control-group">
                                              <label class="control-label">Document Name<span>*</span></label>
                                              <div class="controls">
                                                <input type="text" class="form-control" name="doc_name" value="<?php if(isset($details[0]->doc_name)){ echo $details[0]->doc_name; } ?>"  required >
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">  
                                            <div class="control-group">
                                              <label class="control-label">Upload File:<span>*</span></label>
                                              <div class="controls">
                                                <input type="hidden" name="document_id" value="<?php if(isset($details[0]->document_id)){ echo $details[0]->document_id; } ?>">
                                                    <input type="file" class="form-control" name="document_name" value="<?php if(isset($details[0]->document_name)){ echo $details[0]->document_name; } ?>"   >
                                                  <span style="font-size: 11px;color: #e80e0e;font-weight: 500;">only upload jpg/jpeg/png/pdf file</span>
                                              </div>
                                            </div>
                                          </div>
                                          
                                           <div class="col-md-12 mb-3">  
                                            <div class="control-group">
                                              <label class="control-label">Document Url<span></span></label>
                                              </br><small>Add either document Url or upload a file<small>
                                              <div class="controls">
                                                <input type="text" class="form-control" name="doc_url" value="<?php if(isset($details[0]->doc_url)){ echo $details[0]->doc_url; } ?>"   >
                                              </div>
                                            </div>
                                        </div>
                                        
                                      </div>
                                    </div> 
                                    <div class="col-lg-3"></div>
                                             
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
