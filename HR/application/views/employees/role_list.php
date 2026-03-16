
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
				<h3>Role Details</h3>
			</span>
		
			<a href="<?php echo base_url(); ?>index.php/admin/create_role">
			<button type="button" class="btn btn-success btn-ph">Add Role</button></a>
		
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container ct-section">
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
				<div class="ct-scroll">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Role Name</th>						
						
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php foreach($roles as $row){ 
				        
				?>
					<tr class="tr">
						<td class="text-left"><?php echo $row->role_name; ?></td>
					    
						<th class="text-center"><a><type="button" onClick="delete_row(<?php echo  $row->role_id ?>);"><span class="glyphicon glyphicon-remove"></span></a></th>
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
		if(confirm('Are you sure you want to delete this role')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/role_delete",
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
