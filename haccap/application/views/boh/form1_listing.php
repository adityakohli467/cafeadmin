
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
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/boh/form1_report_download?date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>"><i class="ri-save-line align-bottom me-1"></i> Download Excel</a>
                                   
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
                                            <input type="text" class="form-control" id="form_1_verified_by" name="form_1_verified_by" required value="<?php if(isset($result[0]->form_1_verified_by)){ echo $result[0]->form_1_verified_by; } ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 control-label text-right">Signature</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="form_1_signature" name="form_1_signature" required value="<?php if(isset($result[0]->form_1_signature)){ echo $result[0]->form_1_signature; } ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-3">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 control-label text-right">Date</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="form_1_date" name="form_1_date" required value="<?php if(isset($result[0]->form_1_date)){ echo $result[0]->form_1_date; } ?>">
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
                                            <th>Supplier Name</th>
                                            <th>Invoice OR POD No:</th>
                                            <th>Temperature of product.</th>
                                            <th>Comments</th>  
                                            <!--<th>Signature</th>-->
                                            <th>Order Status</th>
                                            <th>Received By</th>
                                            <!--<th>Deliver By</th>-->
                                            <!--<th>Date</th>-->
                                            <!--<th>Time</th>-->
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; if(!empty($result)){ ?>
                                    <tbody class="list form-check-all" id="formRow">
                                        <?php foreach($result as $row){ ?>
                                        <tr>
                                            <td width="130px" ><?php if(isset($row->order_date)){ echo date('d-m-Y',strtotime($row->order_date)); } ?></td>
                                            <td><?php if(isset($row->supplier_name)){ echo $row->supplier_name; } ?></td>
                                            <td><?php if(isset($row->order_number)){ echo $row->order_number; } ?></td>
                                            <td><?php if(isset($row->temp_recording)){ echo $row->temp_recording; } ?></td>
                                            <td><?php if(isset($row->comments)){ echo $row->comments; } ?></td>
                                            <!--<td><?php if(isset($row->signature)){ echo $row->signature; } ?></td>-->
                                            <td><?php if(isset($row->order_status)){ echo $row->order_status; } ?></td>
                                            <td><input class="text form-control" type="text" id="received_name<?php echo $row->order_id; ?>" name="received_name" value="<?php if(isset($row->signature)){ echo $row->signature; } ?>" ></td>
                                            <!--<td><input class="text" type="text" id="deliver_by<?php echo $row->order_id; ?>" name="deliver_by" value="<?php if(isset($row->deliver_by)){ echo $row->deliver_by; } ?>" style="width: 145px;"></td>-->
                                            
                                            
                                            <!--<td><input class="text" type="date" id="received_date<?php echo $row->order_id; ?>" name="received_date" value="<?php if(isset($row->received_date)){ echo $row->received_date; } ?>" style="width: 145px;"></td>-->
                                            <!--<td><input class="text" type="time" id="received_time<?php echo $row->order_id; ?>" name="received_time" value="<?php if(isset($row->received_time)){ echo $row->received_time; } ?>" style="width: 110px;"></td>-->
                                        
                                            <td><input type="button" onclick="update_order('<?php echo $row->order_id; ?>')" class="btn btn-success btn-ph" value="Update" name="haccap_approve" id="<?php echo $row->order_id; ?>" ></td>
                                           
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
    function update_order(order_id){
        
        var form_1_verified_by = $('#form_1_verified_by').val();
        var form_1_signature = $('#form_1_signature').val();
        var form_1_date = $('#form_1_date').val();
        
        var received_name = $('#received_name'+order_id).val();
        var deliver_by = $('#deliver_by'+order_id).val();
        // var received_date = $('#received_date'+order_id).val();
        // var received_time = $('#received_time'+order_id).val();
//      var haccap_approve='';
//           if($('#' + order_id).is(":checked")){
//             haccap_approve=1;
//           }
//           else{
//             haccap_approve=0;
//           }
        //   console.log(order_id);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>",
            data: {"order_id":order_id,"received_name":received_name,"deliver_by":deliver_by,"form_1_verified_by":form_1_verified_by,"form_1_signature":form_1_signature,"form_1_date":form_1_date},
            success: function(data){
                 
                 location.reload();
            }
        });
        
    }

</script>