	
	
	
	<div class="col-md-12 page-head border-bottom">
		<span class="span-20 left border-right">
			<h3><?php echo $supplier_name;  ?></h3>
		</span>
		<div class="btn-div">
			
			<!--<form action="<?php echo base_url();?>index.php/suppliers/uploadItemsData/<?php echo $supplier_id;?>" name="detailsForm" id="details_form" class="dropzone" method="post" >-->
			<!--</form>-->
			<a href="<?php echo base_url(); ?>index.php/items">
				<button type="button"  class="btn btn-success btn-ph">Edit Product</button>
			</a>
			<button type="button" class="btn btn-success btn-ph" id="importItems">Import Products</button>
			<!--<a href="<?php echo base_url();?>assets/docs/items.csv" class="btn btn-success" ></a>-->
			<a href="<?php echo base_url();?>assets/docs/items.csv">
				<button type="button"  class="btn btn-success btn-ph">Download Template</button>
			</a>
			<a href="<?php echo base_url(); ?>index.php/suppliers/manage_suppliers">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
		</div>
	</div><!--.col-md-12 -->
	
	<div class="container-fluid main-container">
	<div class="col-md-12">
		<div class="panel panel-default">
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
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Item Name</th>
						<th class="text-left">Price</th>
						<th class="text-left">Uom</th>
						<th class="text-left">Category</th>
						<th class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($suppliers as $row){ ?>
					<tr class="tr">
					   <td class="text-left"><?php echo $row->itemName ?></td>
						<td class="text-left">$<?php echo number_format($row->price,2,'.',''); ?></td>
						<td class="text-left"><?php echo $row->uom; ?></td>
						<td class="text-left"><?php echo $row->category_name; ?></td>
						<td class="text-center"><?php if($row->status == "1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			</div>
		</div>
		
		
		
		<div class="modal fade" id="importForm" role="dialog">
			<div class="modal-dialog">
				<form method='POST' class="form-horizontal" enctype='multipart/form-data' action="<?php echo base_url();?>index.php/suppliers/uploadItemsData/<?php echo $supplier_id;?>">
					<div class="modal-content">
						 <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Import Items</h4>
					     </div>
					     <div class="modal-body">
							<div class="panel-group">
					            <div class="panel panel-default">
					            	<!--<div class="panel-heading">Item Details</div>-->
				            		<div class="panel-body">
										<div class="form-group">
											<label for="file" class="col-sm-4 control-label">Upload CSV FILE: <span>*</span></label>
											<div class="col-sm-8">
												<input type="file" class="form-control" name="file" >
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success btncolor">Upload File</button>
				        	<button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
				        </div>
					</div>
				</form>
			</div>
		</div><!-- model end -->
		
	</div>
	</div><!--.container-->
	<!--.table-->
	<br>
	<!--.footer-->
	
	<script>
	$(document).ready(function(){
	    $("#importItems").click(function(){
	        $("#importForm").modal();
	    });
	});
</script>

	<script>
	// "myAwesomeDropzone" is the camelized version of the HTML element's ID
	// Dropzone.options.detailsForm = {
	//   paramName: "file", // The name that will be used to transfer the file
	//   renameFile: function (file) {
	//   	var ext = file.name.split('.').pop();
 //           return file.name ="import." + ext;
 //       },
	//   maxFilesize: 1, // MB
	//   dictDefaultMessage:"Drop your Details Form here",
	//   acceptedFiles :"text/csv"
	// };
	
	</script>
	
	<style>
		.dropzone{
			color:#236ea6;
			padding:0;
			min-height:0;
			float:left;
			margin-right:5px;
		}
	</style>