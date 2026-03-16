
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
                                    <h5 class="card-title mb-0 txt-uppercase"><?php echo $page_name; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/records/add_record/<?php echo $table_name; ?>"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form id="menu_filters" method="post" action="" role="form">
                            <div class="row g-3">
                                <?php if(!empty($filter_columns)){ foreach($filter_columns as $filter_column){ ?>
                                <div class="col-xl-2">
                                    <input class="form-control " name="<?php echo $filter_column; ?>" id="<?php echo $filter_column; ?>" type="text" placeholder="<?php echo strtoupper(str_replace("_"," ",$filter_column)); ?>">
                                </div>
                                <?php } } ?>
                                <!--end col-->
                                <div class="col-xl-2">
                                    <input type="button" id="filterBtn" class="btn btn-success" value="Go">
                                </div>
                                <!--end col-->
                                
                            </div>
                            <!--end row-->
                        </form>
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
                            <div class="table-responsive table-card mb-1">
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-dark text-white">
                                        <tr>
                                            <?php if(!empty($table_columns)){ foreach($table_columns as $table_column){ ?>
                                            <th class="sort" data-sort="<?php echo $table_column; ?>"><?php echo strtoupper(str_replace("_"," ",$table_column)); ?></th>
                                            <?php } } ?>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; if(!empty($content['record'])){ ?>
                                    <tbody class="list form-check-all" id="formRow">
                                        <?php foreach($content['record'] as $row){ ?>
                                        <tr>
                                            <?php if(!empty($table_columns)){ foreach($table_columns as $table_col){ ?>
                                                <td class="<?php echo $table_col; ?>"><?php echo $row[$table_col]; ?></td>
                                            <?php } } ?>
                                            
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                   <?php $id=$table_name.'_id'; if(!empty($action_columns) && in_array('view',$action_columns)){ ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/records/view_record/<?php echo $table_name.'/'.$row[$id]; ?>">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if(!empty($action_columns) && in_array('edit',$action_columns)){ ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/records/edit_record/<?php echo $table_name.'/'.$row[$id]; ?>">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if(!empty($action_columns) && in_array('delete',$action_columns)){ ?>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row[$id]; ?>" href="javascript:void(0)">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($content['record'])){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
<input type="hidden" value="<?php echo $table_name; ?>" class="table_name">

<script type="text/javascript">
$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    var table_name = $('.table_name').val();
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
                url: "<?php echo base_url();?>index.php/records/record_delete",
                data: 'id='+id+'&table_name='+table_name,
               
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

  $("#filterBtn").click(function(e){
      
    var table_name = $('.table_name').val();
    var data1 = $('#menu_filters').serialize();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/records/filterData/"+table_name,
        data: data1,
        success: function(data){
            if(data != 'norecord'){
                $("#formRow").html('');
                $("#formRow").append(data);
            }else{
                $("#formRow").html('');
                $(".noresult").css('display','block');
            }
        }
      });

});

</script> 
