
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
                                    <h5 class="card-title mb-0"><?php echo $page_heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>"><i class="ri-add-line align-bottom me-1"></i> <?php echo $button_heading; ?></a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="card-body border-bottom-dashed border-bottom">-->
                        <!--<form>-->
                        <!--    <div class="row g-3">-->
                        <!--        <div class="col-xl-12">-->
                        <!--            <div class="search-box">-->
                        <!--                <input type="text" class="form-control search" placeholder="Search for Username, email, phone ...">-->
                        <!--                <i class="ri-search-line search-icon"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                                <!--end col-->
                                
                            <!--</div>-->
                            <!--end row-->
                        <!--</form>-->
                    <!--</div>-->
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
                            <div class="table-responsive table-card mb-1">
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-dark text-white">
                                        <tr>
                                            
                                            <th class="sort" data-sort="document_name">Document Name</th>
                                            <th class="sort" data-sort="document_file">Document File</th>
                                            <th class="sort" data-sort="document_id">Document ID</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($record_data)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($record_data as $row){ ?>
                                        <tr>
                                           <td class="document_name"><?php echo $row->doc_name; ?></td>
                                            <?php if((isset($row->document_name)) && ($row->document_name !='')) {  ?>
                                             <td class="document_file">
                                                <a class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->document_name; ?>" target="_blank">View</a>
                							</td>
                                            <?php }else{ ?>
                                             <td class="document_file">
                                               <a class="btn btn-success" href="<?php echo $row->doc_url; ?>" target="_blank">View</a>
                							</td>
                                            <?php } ?>
                                           
                                            <td class="document_id"><?php echo $row->document_id; ?></td>
                                            
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                  
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->document_id ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                        <input type="hidden" value="<?php echo $table_name; ?>" id="table_name">
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($record_data)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We did not find any record for you search.</p>
                                    </div>
                                </div>
                               
                            </div>
                            <!--<div class="d-flex justify-content-end">-->
                            <!--    <div class="pagination-wrap hstack gap-2">-->
                            <!--        <a class="page-item pagination-prev disabled" href="#">-->
                            <!--            Previous-->
                            <!--        </a>-->
                            <!--        <ul class="pagination listjs-pagination mb-0"></ul>-->
                            <!--        <a class="page-item pagination-next" href="#">-->
                            <!--            Next-->
                            <!--        </a>-->
                            <!--    </div>-->
                            <!--</div>-->
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

<script type="text/javascript">
$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    var tablename = $("#table_name").val();
    Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: !0,
          confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
          cancelButtonClass: "btn btn-danger w-xs mt-2",
          confirmButtonText: "Yes, delete it!",
          buttonsStyling: !1,
          showCloseButton: !0,
      }).then(function (e) {
          if (e.value) {
              
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/document/delete_document",
                data:{"id":id,"tablename":tablename},
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});

</script> 
