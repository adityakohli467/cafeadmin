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
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Roster</h3>
			</span>
		</div>
		
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
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
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left">Start Date</th>						
						<th class="text-left">End Date</th>
						<th class="text-center">View</th>
						
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php foreach($roster as $row){ ?>
					<tr class="tr">
						<td class="text-left"><?php echo date("d-m-Y", strtotime($row->start_date)); ?></td>
						<td class="text-left"><?php echo date("d-m-Y", strtotime($row->end_date)); ?></td>
						<td class="text-center"><a href="<?php echo base_url(); ?>index.php/employees/emp_week_roster/<?php echo $row->start_date ?>">View roster</a></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete Employee')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/employees/employee_delete",
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
