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
				<h3>Employees</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/suppliers/add_suppliers">
			<button type="button" class="btn btn-success btn-ph" id="myBtn">Add New Employee</button></a>
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
						<th class="text-left">Employee Name</th>
						<th class="text-left">Email</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php foreach($employees as $row){ ?>
					<tr class="tr">
						<td class="text-left"><?php echo $row->employee_name; ?></td>
						<td class="text-left"><?php echo $row->email; ?></td>
						<th class="text-center"></th>
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
		if(confirm('Are you sure you want to delete supplier')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/suppliers_delete",
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
