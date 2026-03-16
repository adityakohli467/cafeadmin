<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Reports</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			
		</div>
	</div><!--.col-md-12 -->		



<div style="background-color:#fff" class="container-fluid main-container">
		
	<div class="col-md-12">
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
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
		<!--.table-->

				<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
					<thead>
						<tr>
	
							<th>Report Name</th>
							<!--<th>Description</th>-->
						</tr>
					</thead>
					<tbody>
					<tr class="tr">
					   <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/budget_reports">Budget Report</a></td>
					 </tr>
					    <tr class="tr">
					       <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/purchase_orders_reports">Purchase Orders Expenditure</a></td>
					   </tr>
						<tr class="tr">
						    <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">HACCP Programme</a></td>
							<!--<td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">HACCP Programme</a></td>-->
							<!--<td class="text-left">Business would like to check how much is the expenditure based on the supplier, category for a certain period</td>-->
						</tr>
						<tr class="tr">
						     <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">Fridge Temp Forms</a></td>
						
							<!--<td class="text-left">This is for the accounting team to cross check purchase orders and invoices</td>-->
						</tr> 
						
							<tr class="tr">
							      <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">Opening closing forms</a></td>
						
							<!--<td class="text-left">This is for the accounting team to cross check purchase orders and invoices</td>-->
						</tr> 
						
							<tr class="tr">
							      <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">Council Inspection Reports</a></td>
					
						</tr> 
						
						
							<tr class="tr">
							      <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">4 Week Rotation Menus</a></td>
					
						</tr> 
						
						
							<tr class="tr">
							      <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">Menu Card</a></td>
						</tr>
						
							<tr class="tr">
							      <td class="text-left"><a href="<?php echo base_url(); ?>index.php/Reports/generate_reports">Sop’s for BOH.d</a></td>
						</tr>
						
	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--.container-->
		
		<!--.table-->
		<br>
		
	<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete item')){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/items/items_delete",
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
			supplier_id: {
	                required:true
	            },
				item_name: {
	                required:true
	            },
	            category: {
	                required:true
	            },
	            price: {
	                required:true
	            }									
			
	},		
	messages: {
			supplier_id: {
                 required:"Please provide supplier"
            },
			item_name: {
                 required:"Please provide Product name"
            },
            category: {
                 required:"Please provide category"
            },
            price: {
                 required:"Please provide price"
            }	
	},

    });	
});
</script>

