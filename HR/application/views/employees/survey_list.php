
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
				<h3>Survey List</h3>
			</span>
		
			
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container ct-section">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
				
				<div class="ct-scroll">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Employee Name</th>						
						<th class="text-center">Date</th>
					
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php foreach($survey as $row){ 
				        
				?>
					<tr class="tr">
						<td class="text-left"><?php echo $row->first_name.' '.$row->last_name; ?></td>
						<td class="text-center"><?php echo date("d-m-Y", strtotime($row->submitted_at)); ?></td>
					    
						<th class="text-center"><a href="<?php echo base_url(); ?>index.php/admin/view_survey_form/<?php echo $row->emp_id;?>"><span class="glyphicon glyphicon-eye-open"></span></a></th>
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

