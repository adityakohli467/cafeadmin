
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
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/boh/form11_report_download?date_from=<?php echo $date_filter; ?>"><i class="ri-save-line align-bottom me-1"></i> Download Excel</a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form id="menu_filters">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 control-label text-right">Verified By</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="form_11_verified_by" name="form_11_verified_by" required value="<?php if(isset($form_11_verified_by)){ echo $form_11_verified_by; } ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 control-label text-right">Signature</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="form_11_signature" name="form_11_signature" required value="<?php if(isset($form_11_signature)){ echo $form_11_signature; } ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-3">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 control-label text-right">Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="form_11_date" name="form_11_date" required value="<?php if(isset($form_11_date)){ echo $form_11_date; } ?>">
                                        </div>
                                    </div>
                                    </div>
                                
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
                                            <th>Date</th>
                                            <th>Item</th>
                                            <th>Invoice OR POD No:</th>
                                            <th>Temperature at Loading</th>
                                            <th>Temperature at unloading</th>
                                            <th>Delivery Location</th>  
                                            <th>Received By</th>
                                            <th>Deliver By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; if(!empty($result)){ ?>
                                    <tbody class="list form-check-all" id="formRow">
                                        <?php foreach($result as $row){ ?>
                                        <tr>
                                            <td width="130px" ><?php if(isset($row->order_date)){ echo date('d-m-Y',strtotime($row->order_date)); } ?></td>
                                            <td><?php if(isset($row->item_name)){ echo $row->item_name; } ?></td>
                                            <td><?php if(isset($row->order_number)){ echo $row->order_number; } ?></td>
                                            <td><input class="text form-control" type="text" id="temp_loading<?php echo $row->order_detail_id; ?>" name="form_11_temp_loading" value="<?php if(isset($row->form_11_temp_loading)){ echo $row->form_11_temp_loading; } ?>" style="width: 110px;"></td>
                                            <td><input class="text form-control" type="text" id="temp_unloading<?php echo $row->order_detail_id; ?>" name="form_11_temp_unloading" value="<?php if(isset($row->form_11_temp_unloading)){ echo $row->form_11_temp_unloading; } ?>" style="width: 110px;"></td>
                                            <td><?php if(isset($row->branch_name)){ echo $row->branch_name; } ?></td>
                                            <td><input class="text form-control" type="text" id="received_by<?php echo $row->order_detail_id; ?>" name="received_by" value="<?php if(isset($row->form_11_received_by)){ echo $row->form_11_received_by; } ?>" ></td>
                                            <td><input class="text form-control" type="text" id="deliver_by<?php echo $row->order_detail_id; ?>" name="deliver_by" value="<?php if(isset($row->form_11_deliver_by)){ echo $row->form_11_deliver_by; } ?>" style="width: 145px;"></td>
                                            
                                        
                                            <td><input type="button" onclick="update_order('<?php echo $row->order_detail_id; ?>','<?php echo $row->order_id; ?>')" class="btn btn-success btn-ph" value="Update" name="haccap_approve" id="<?php echo $row->order_detail_id; ?>" ></td>
                                        </tr>
                                        <?php }  ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($result)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
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



$( function() {
    $( "#datepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

 $( "#datepicker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
});


  } );

</script>
<script type="text/javascript">
    function update_order(order_detail_id,order_id){
        var form_11_verified_by = $('#form_11_verified_by').val();
        var form_11_signature = $('#form_11_signature').val();
        var form_11_date = $('#form_11_date').val();
          
        var form_11_received_by = $('#received_by'+order_detail_id).val();
        var form_11_deliver_by = $('#deliver_by'+order_detail_id).val();
        var form_11_temp_loading = $('#temp_loading'+order_detail_id).val();
        var form_11_temp_unloading = $('#temp_unloading'+order_detail_id).val();

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>",
            data: {"order_detail_id":order_detail_id,"order_id":order_id,"form_11_received_by":form_11_received_by,"form_11_deliver_by":form_11_deliver_by,"form_11_temp_loading":form_11_temp_loading,"form_11_temp_unloading":form_11_temp_unloading,"form_11_verified_by":form_11_verified_by,"form_11_signature":form_11_signature,"form_11_date":form_11_date},
            success: function(data){
                 
                //  location.reload();
            }
        });
        
    }

</script>
