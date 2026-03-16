
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
                                    <h5 class="card-title mb-0">Menu Category</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menuplanner/addMenuCategory"><i class="ri-add-line align-bottom me-1"></i> Add Menu</a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form id="prep_filters">
                            <div class="row g-3">
                                <div class="col-xl-3">
                                    <input class="form-control " id="menu" type="text" placeholder="Menu Category">
                                </div>
                                <!--end col-->
                                
                                <div class="col-xl-2">
                                    <button type="button" id="filterBtn" class="btn btn-success">Go</button>
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
                                            
                                            <th class="sort" data-sort="CategoryName">Category Name</th>
                                            <th class="sort" data-sort="status">Status</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; if(!empty($menuCategory)){ ?>
                                    <tbody class="list form-check-all" id="formRow">
                                        <?php foreach($menuCategory as $row){ ?>
                                        <tr>
                                           <td class="CategoryName"><?php echo $row->name; ?></td>
                                           <td><div class="form-check form-switch form-switch-custom form-switch-success">
                                                    <input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $row->category_id ?>" <?php if(isset($row->status) && $row->status == '1'){ echo 'checked'; }?>>
                                                    
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                   
                                                   
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/menuplanner/updateMenuCategory/<?php echo $row->category_id ?>">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                        <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->category_id ?>" href="javascript:void(0)">
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
                                
                                <div class="noresult" <?php if(!empty($menuCategory)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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
                url: "<?php echo base_url();?>index.php/menuplanner/deleteMenuCategory",
                data: 'id='+id,
               
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

  $("#filterBtn").click(function(){
    // e.preventDefault();
   if($.trim($("#cuisine").val())=='')
			cuisine='';
		else cuisine=$("#cuisine").val();
	
		if($.trim($("#category").val())=='')
			category='';
		else category=$("#category").val();
		
		if($("#menu").val()=='')
			menu='';
		else menu=$("#menu").val();
  
    
    $.ajax({
        type: "POST",
            url: "<?php echo base_url();?>index.php/menuplanner/filterMenuPlanner",
		        data:'cuisine='+cuisine+'&category='+category+'&menu='+menu,
            success: function(data){
            $("#formRow").html('');
            $("#formRow").append(data);
            }
          });

});
$(function() {
    $('.toggle-demo').on('change',function() {
         var category_id = $(this).attr('id')
     if($(this).prop('checked')){
         var status = 1;
     }else{
         var status = 0;
     }
     
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
        url: "<?php echo base_url(); ?>index.php/menuplanner/update_menuCategory_status",
        data: {"status":status,"category_id":category_id},
        success: function(data){
                 console.log(data);
                //  location.reload();
        }
    });
    
    
    })
  });
</script> 
