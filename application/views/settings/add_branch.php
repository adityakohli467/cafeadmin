<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>

	
	<form class="form-horizontal" id="customer_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/settings/branch_insert" enctype="multipart/form-data">
		
		<div class="col-md-12 page-head border-bottom">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<span class="text-center">
					<h3>Add Site</h3>
				</span>
			</div>
			<div class="btn-div col-md-3">
				<button type="submit" class="btn btn-success btn-ph">Save</button>
				<a href="<?php echo base_url(); ?>index.php/settings/branches">
					<button type="button"  class="btn btn-ph btn-ph-cancel">Cancel</button>
				</a>
			</div>
		</div><!--.col-md-12 -->
	<div class="container main-container">
		<div class="col-md-12">
  		<div class="row">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Branch Info</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Branch Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="branch_name"  autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">Unit</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="unit"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-4 control-label">Street</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="street"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Suburb </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="suburb"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Postcode </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="postcode"   minlength="4" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">phone </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="phone"   minlength="4" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">State </label>
							<div class="col-sm-8">
								<select class="form-control"  name="state" >
								    <option value="">Select</option>
							                <option value="">Select</option>
									<option value="VIC">VIC</option>
									<option value="NSW">NSW</option>
									<option value="QLD">QLD</option>
									<option value="TAS">TAS</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Branch Code </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="branch_code"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Branch Budget </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="branch_budget"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Status </label>
							<div class="col-sm-8">
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="1" checked>
								<span style="float:left;" class="inline-label">Active</span>
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="0">
								<span style="float:left;" class="inline-label">In Active</span>
							</div>
						</div>
	          		</div>
        		</div>
	        
	        </div>
			<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
					<div class="panel-heading">
						<h3 class="panel-title">Supplier Info</h3>
					</div>
					<div class="panel-body">
						<?php foreach($suppliers as $row){?>
						<div class="form-group">
							<div class="col-sm-8">
								<input style="float:left; margin-top:10px;" type="checkbox" value="<?php echo $row->supplier_id;?>" name="branch_access[]">
								<span style="float:left;" class="inline-label"><?php echo $row->supplier_name;?></span>
								<input style="width:50%; float:right" type="text" class="form-control" name="weekly_budget[]" >
							<div style="clear:both;"></div>	
							</div>
						</div>
						<?php } ?>
	                </div>
	        	</div>
	        	
	        </div>
	    </div>
	</div>	
  	
</div>
</form>
<br>
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#customer_add").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			supplier_name: {
	                required:true
	            },
	        abn:{
            	minlength:11
            },    
	        email: {
                email: true
            },
            mobile:{
            	minlength:10
            },
            postcode:{
            	minlength:4
            },
			category: {
	                required: true
	            }
			},		
			messages: {
				supplier_name: {
	                required:"Please enter supplier name"
	            },
	        abn:{
            	minlength:"Please enter minimum 11 characters"
            },
	        email: {
                 email:"Please enter valid email"
                 },
            mobile:{
            	 minlength:"Please enter minimum 10 characters"
            }, 
            postcode:{
            	minlength:"Please enter minimum 4 characters"
            },
		    category: {
	                required:"Please enter category name",
	            }
			}

	    });	
	});
</script>
