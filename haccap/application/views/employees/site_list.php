
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
                                    <h5 class="card-title mb-0">Branch Details</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/create_branch"><i class="ri-add-line align-bottom me-1"></i> Add Branch</a>
                                   
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
                                            
                                            <th class="sort" data-sort="branch_name">Branch Name</th>
                                            <th class="sort" data-sort="state">State</th>
                                            <th class="sort" data-sort="unit">Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($branches)){ ?>
                                    <tbody class="list form-check-all">
                                        <?php foreach($branches as $row){ ?>
                                        <tr>
                                           <td class="branch_name"><?php echo $row->branch_name; ?></td>
                                            <td class="state"><?php echo $row->state; ?></td>
                                            <td class="unit"><?php echo $row->unit; ?></td>
                                            
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/admin/create_branch/<?php echo $row->branch_id; ?>">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->branch_id ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($branches)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
                       
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Are you sure ?</h4>
                                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn w-sm btn-danger" rel="" id="delete-record">Yes, Delete It!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal -->
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
                url: "<?php echo base_url();?>index.php/admin/branch_delete",
                data:'id='+id,
                success: function(data){
                  if(data == 'deleted'){
                      Swal.fire({ 
                          title: "Deleted!", 
                          text: "Your record has been deleted.", 
                          icon: "success", 
                          confirmButtonClass: "btn btn-info w-xs mt-2", 
                          buttonsStyling: !1 
                      }).then(function (e) {
                            if (e.value) {
                                location.reload();
                            }
                        });
                  }
                  
                }
            });
            
        
              
          }
      })
});

</script> 
