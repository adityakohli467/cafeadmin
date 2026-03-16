<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
</style>	
	
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		
			<span class="text-center">
				<h3>MANAGE LEAVE</h3>
			</span>
		
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container ct-leave">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			    <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="order_filters">
									<div class="row">
									    
									    
										
										<div class="col-12 col-md-2">
											<input class="form-control" id="first_name" type="text" placeholder="Employee Name">
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control datepicker" id="start_date" type="date" placeholder="Start Date">
										</div>
									
										<div class="col-12 col-md-2">
											<input class="form-control " id="leave_status" type="text" placeholder="Status">
										</div>
										<div class="col-12 col-md-1">
												<button class="btn btn-primary">Go</button>
											</div>
									</div>
									
								
								</form>
							</div>
						</div>
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
				<div class="ct-scroll">
			<!--<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%">-->
			<table class="row-border table-condensed table table-striped table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Employee Name</th>						
						<th class="text-left">Leave Type</th>
						<th class="text-left">New Nominated Person</th>
						<th class="text-center">Start Date</th>
						<th class="text-center">End Date</th>
						<th class="text-center ct-status">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php  foreach($leaves as $row){ 
				            if($row->leave_status == 'Pending'){
								$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block' style='background-color: #009688;'";								
								$btn_name = "Pending";
							}else if($row->leave_status == 'Approve'){
								$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block' style='background-color: #449d44;'";
								$btn_name = "Approved"; 
							}
							else if($row->leave_status == 'Comment'){
								$color = "class='btn btn-warning cxs-btn c-btn btn-xs btn-block' style='background-color: #FF5722;'";
								$btn_name = "Comments Added";
							}
							else if($row->leave_status == 'Reject'){
								$color = "class='btn btn-warning cxs-btn c-btn btn-xs btn-block' style='background-color: #eb1e18;'";
								$btn_name = "Rejected";
							}
				?>
					<tr class="tr">
						<td class="text-left"><a href="<?php echo base_url(); ?>index.php/admin/manager_leave_update/<?php echo $row->leave_id ?>"><?php echo $row->first_name; ?></a></td>						
						<td class="text-left"><?php echo $row->leave_type; ?></td>
						<td class="text-left"><?php echo $row->new_nominated_person; ?></td>
						<td class="text-center"><?php echo  date('d-m-Y',strtotime($row->start_date)); ?></td>
						<td class="text-center"><?php echo date('d-m-Y',strtotime($row->end_date)); ?></td>
						<td class="text-center ct-status"><div <?php echo $color; ?> class="status-color"><?php echo $btn_name;  ?></div></td>
						<td class="text-center"><a><type="button" onClick="delete_row(<?php echo  $row->leave_id ?>);"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		
		<!--.footer-->
<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete leave')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/employees/leave_delete",
		        data:'id='+str,
		        success: function(data){
		          location.reload();
		        }
	       });
		}	
	}
</script>	

<script type="text/javascript">
$(document).ready(function() { 
    $("#contact_form").validate({
		ignore: "input[type='text']:hidden",
		rules: {
			route: {
				required:true
			}									
		},		
		messages: {
			route: {
				required:"Please enter route name"
			}	
		},

    });	
    
    	$(".datepicker").datetimepicker({
		format:'YYYY-MM-DD'
	})
});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#contact_form_edit").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			route: {
                required:true
            }									
			
	},		
	messages: {
			route: {
                 required:"Please enter route name"
            }	
	},

    });	
});

$("#order_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#first_name").val())=='')
			first_name='unset';
		else first_name=$("#first_name").val();
		if($.trim($("#start_date").val())=='')
			start_date='unset';
		else start_date=$("#start_date").val();
		if($.trim($("#leave_status").val())=='')
			status='unset';
		else status=$("#leave_status").val();
		
	window.location.href="<?php echo base_url(); ?>index.php/admin/manager_leave_filter/"+first_name+"/"+start_date+"/"+status;

		
});

</script>
<script>
	function getBranchSuppliers(e){
		var branch_id = $(e).val();
		if(branch_id == 'all'){
			location.reload();
		}else{
			$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/getBranchSuppliers",
		        data:'branch_id='+branch_id,
		        success: function(data){
		        	// alert(data);
		        	$('#branch_suppliers').html(data);
		        }
	        });
		}
		
	}
</script>
