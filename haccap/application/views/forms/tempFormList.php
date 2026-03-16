<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
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
                                    <h5 class="card-title mb-0"><?php echo $heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/forms/temperature_form/<?php  echo $table_name; ?>"><i class="ri-add-line align-bottom me-1"></i> Add Form</a>
                                   
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
                            <div class="table-responsive table-card mb-1" id="contactList">
                                
                                <table class="table align-middle" id="customerTable">
                                    <thead class="table-dark text-white">
                                       <?php if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record"){ ?> 
            					<tr style="height: 49px !important;">
            					    <?php if($table_name != "haccap_food_transfer_and_order_record"){ ?>
            						<th class="sort custom_sort" data-custom-sort="cafe_name">Cafe name </th>
            						<?php } ?>
            						<?php if($table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_food_transfer_and_order_record"){ ?>
            							<th class="no-sort">Prep. Area name </th>
            						<?php } ?>
            						<?php if($table_name == "haccap_food_transfer_and_order_record"){ ?>
            						<th class="sort">Document Number</th>
            						<th class="sort">Verified By </th>
            						<th class="sort">Sign</th>
            						
            						<?php } ?>
            						<th  class="sort custom_sort" data-custom-sort="start_date">Date </th>
            						<!--<th class="text-center">End Date </th>-->
            						
            						<!--<?php if($table_name == "haccap_kitchen_operational_closedown_checklist"){ ?>-->
            						<!--<th class="text-center">Date </th>-->
            						<!--<?php } ?>-->
            						
            						<th class="no-sort text-center">Recreate </th>
            				        <th class="no-sort text-center">Action</th>
            					
            					</tr>
            					
            					<?php } else if($table_name == "haccap_mockrecall_record"){ ?>
            					 <tr style="height: 49px !important;">
            						<th class="text-left">Document Number</th>
            						<th class="text-left">Description of Product</th>
            						<th class="sort custom_sort" data-custom-sort="date_initiated">Date Initiated</th>
            						<th class="sort custom_sort" data-custom-sort="date_completed">Date Completed</th>
            						<th class="text-center recreateBtn">Recreate</th>
            				        <th class="text-center">Action</th>
            					
            					</tr>
            					
            					<?php }else if($table_name == "haccap_training_record") { ?>
            					<tr style="height: 49px !important;">
            						<th class="sort custom_sort" data-custom-sort="cafe_name">Cafe Name</th>
            						<th class="sort custom_sort" data-custom-sort="job_role">Job Role</th>
            						<th class="sort custom_sort" data-custom-sort="employee_training">Employee Name</th>
            						<th class="text-center recreateBtn">Recreate</th>
            				        <th class="text-center">Action</th>
            					<?php }else { ?>
            					    <tr style="height: 49px !important;">
            						<th class="text-left">Corrective Action</th>
            						<th class="text-center">Classification</th>
            						<th class="sort custom_sort" data-custom-sort="start_date">Date </th>
            						<th class="text-center recreateBtn">Recreate</th>
            				        <th class="text-center">Action</th>
            					
            					</tr>
            					    <?php } ?>
                                                </thead>
                                                <?php $i = 0; if(!empty($tempFormList)){ ?>
                                                <tbody class="list form-check-all" id="formRow">
                                                    <?php foreach($tempFormList as $row){  	?>
                                        		        <tr class="tr" style="height: 49px !important;">
                                        		           <?php if($table_name == "haccap_training_record"){ ?>
                                						    <td class="cafe_name"><?php echo $row['cafe_name']; ?></td>
                                						    <td class="job_role"><?php echo $row['role']; ?></td>
                                						    <td class="employee_training"><?php echo $row['emp']; ?></td>
                                						    <td class="text-center"><a class="btn btn-success" href="<?php echo base_url(); ?>index.php/forms/tempFormEdit/<?php echo $row['id'] ?>/recreate/<?php echo $table_name ?>">Recreate</a></td>
                                    						<td class="text-center action-icons">
                                						     <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                                    <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/forms/tempFormView/<?php echo $row['id'] ?>/view/<?php echo $table_name ?>">
                                                                    <i class="ri-eye-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                                <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/forms/tempFormEdit/<?php echo $row['id'] ?>/edit/<?php echo $table_name ?>">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                                <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row['id'] ?>" href="javascript:void(0)">
                                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                </a>
                                                            </li>
                        						 </td>
    					
						<?php } else{ ?>
		                        <?php if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_food_transfer_and_order_record"){ ?>
		                            <td class="cafe_name"><?php echo $row->cafe_name; ?></td>
        						    <?php if($table_name != "haccap_kitchen_operational_closedown_checklist"){ ?>
        							    <td class="text-left"><?php echo $_SESSION['prepAreaName']; ?></td>	<?php } ?>
        						        <td class="start_date"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->start_date)) ?></span><?php echo date('d-m-Y',strtotime($row->start_date)); ?></td>
        						        <!--<td class="text-center"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->end_date)) ?></span><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>-->
        					
        					 <!--   <?php if($table_name == "haccap_kitchen_operational_closedown_checklist"){ ?>-->
        						<!--<td class="text-center"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->date)) ?></span><?php echo date('d-m-Y',strtotime($row->date)); ?></td>-->
        						<!--<?php } ?>-->
        						
        				<?php } else if($table_name == "haccap_mockrecall_record"){ ?>
        							<td class="text-left"><?php echo $row->document_record_number; ?></td>
        							<td class="text-left"><?php echo $row->description_of_product; ?></td>
        							<td class="date_initiated"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->date_initiated)) ?></span><?php echo date('d-m-Y',strtotime($row->date_initiated)) ?></td>
        						<td class="date_completed"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->date_completed)) ?></span><?php echo date('d-m-Y',strtotime($row->date_completed)) ?></td>
        						
						<?php } else if($table_name == "haccap_food_transfer_and_order_record"){ ?>
						        <td class="text-left"><?php echo $row->document_record_number; ?></td>
						        <td class="text-left"><?php echo $row->verified_by; ?></td>
        						<td class="text-left"><?php echo $row->sign_by; ?></td>
        						<td class="start_date"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->start_date)) ?></span><?php echo date('d-m-Y',strtotime($row->start_date)) ?></td>
						<?php } else{ ?>
						
        						<td class="text-left"><?php echo $row->correctiveaction; ?></td>
        						<td class="text-center"><?php echo $row->classification; ?></td>
        						<td class="start_date"><span class="d-none"><?php echo date('Y-m-d',strtotime($row->correctiveaction_date)) ?><?php echo date('d-m-Y',strtotime($row->correctiveaction_date)); ?></td>
        						
						<?php } ?>
						
    					    <td class="text-center"><a class="btn btn-success" href="<?php echo base_url(); ?>index.php/forms/tempFormEdit/<?php echo $row->id ?>/recreate/<?php echo $table_name ?>">Recreate</a></td>
    						<td class="text-center action-icons">
    						     <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                        <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/forms/tempFormView/<?php echo $row->id ?>/view/<?php echo $table_name ?>">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                            <a class="text-success d-inline-block edit-item-btn" href="<?php echo base_url(); ?>index.php/forms/tempFormEdit/<?php echo $row->id ?>/edit/<?php echo $table_name ?>">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                            <a class="text-danger d-inline-block remove-item-btn" data-rel-id="<?php echo  $row->id ?>" href="javascript:void(0)">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
    						 </td>
    						<?php } ?>
				</tr>
				<?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                                
                                <div class="noresult" <?php if(!empty($tempFormList)){ ?>style="display: none" <?php } else{ ?>style="display: block" <?php } ?> >
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We did not find any record for you search.</p>
                                    </div>
                                </div>
                             
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
<input type="hidden" value="<?php echo $table_name ?>" id="table_name">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<?php if(empty($tempFormList)){ ?>
<style>
    div#customerTable_filter {
    display: none;
}
</style>
<script>
    $(document).ready(function () {
    $('#customerTable').DataTable({
        paging: false,
        info: false,
        order: [],
        "columnDefs": [{
              "targets"  : 'no-sort',
              "orderable": false
            }]
    });
});
</script>
<?php }else{ ?>
<script>
    $(document).ready(function () {
    $('#customerTable').DataTable({
        order: [],
        "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false,
              
            }]
    });
});
</script>
<?php } ?>
<script type="text/javascript">
$('.remove-item-btn').click(function(){
    var id = $(this).attr('data-rel-id');
    var tablename = $('#table_name').val();
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
                url: "<?php echo base_url();?>index.php/forms/tempForm_delete",
               data: {"id":id,"tablename":tablename},
               
                success: function(data){
                  location.reload();
                  
                }
            });
            
        
              
          }
      })
});

  $("#filterBtn").click(function(){
    if($.trim($("#cafe_name").val())=='')
			cafe_name='';
		else cafe_name=$("#cafe_name").val();
		
	    if($.trim($("#employee_name").val())=='')
			employee_name='';
		else employee_name=$("#employee_name").val();
		
		if($.trim($("#prep_name").val())=='')
			prep_name='';
		else prep_name=$("#prep_name").val();
		
		if($.trim($("#start_date").val())=='')
			start_date='';
		else start_date=$("#start_date").val();
		
		if($.trim($("#end_date").val())=='')
			end_date='';
		else end_date=$("#end_date").val();
		
		
		if($.trim($("#correctiveaction").val())=='')
			correctiveaction='';
		else correctiveaction=$("#correctiveaction").val();
		
		if($.trim($("#classification").val())=='')
			classification='';
		else classification=$("#classification").val();
		
		if($.trim($("#correctiveaction_date").val())=='')
			correctiveaction_date='';
		else correctiveaction_date=$("#correctiveaction_date").val();
		
		
		var table_name = "<?php echo $table_name ?>";
		
    
    $.ajax({
        type: "POST",
            url: "<?php echo base_url(); ?>index.php/forms/filterForm",
            data:'cafe_name='+cafe_name+'&employee_name='+employee_name+'&prep_name='+prep_name+'&start_date='+start_date+'&end_date='+end_date+'&table_name='+table_name+'&correctiveaction='+correctiveaction+'&classification='+classification+'&correctiveaction_date='+correctiveaction_date,
            success: function(data){
            $("#formRow").html('');
            $("#formRow").append(data);
            }
          });

});

</script> 
