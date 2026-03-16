	<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>
	
	<form class="form-horizontal" id="branch_edit" role="form" method="post" action="<?php echo base_url(); ?>index.php/settings/branch_update" enctype="multipart/form-data">
<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3><?php echo $branches[0]->branch_name; ?></h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" class="btn btn-success btn-ph">Save</button>
					<a href="<?php echo base_url(); ?>index.php/settings/branches">
						<button type="button"  class="btn btn-ph btn-ph-cancel">Cancel</button>
					</a>
		</div>
	</div><!--.col-md-12 -->
<div class="container-fluid main-container">
	  <div class="row">
	  	<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Branch Info</h3>
			        </div>
	          		<div class="panel-body">
	          			<?php foreach($branches as $row){   ?>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Branch Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="hidden" name="branch_id" value="<?php echo $row->branch_id; ?>">
								<input type="text" class="form-control" name="branch_name" value="<?php echo $row->branch_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">Unit</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="unit" value="<?php echo $row->unit; ?>"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-4 control-label">Street</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="street"  value="<?php echo $row->street; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Suburb </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Postcode </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="postcode" value="<?php echo $row->postcode; ?>"  minlength="4" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Phone </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="phone" value="<?php echo $row->phone; ?>"  minlength="4" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">State </label>
							<div class="col-sm-8">
								<select class="form-control"  name="state" >
								    <option value="">Select</option>
									<option value="victoria" <?php if($row->state == "victoria"){ echo "selected";  } ?>>Victoria</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Branch Code </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="branch_code" value="<?php echo $row->branch_code; ?>"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Branch Budget </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="branch_budget" value="<?php echo $row->branch_budget; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Status </label>
							<div class="col-sm-8"> 
								<input type="hidden" name="old_status" value="<?php echo $row->status;?>">
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="1" <?php if($row->status == 1){ echo 'checked';}?>>
								<span style="float:left;" class="inline-label">Active</span>
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="0" <?php if($row->status == 0){ echo 'checked';}?>>
								<span style="float:left;" class="inline-label">In Active</span>
							</div>
						</div>
						<?php } ?>
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
						<?php foreach($suppliers as $supplier){
						if(array_key_exists($supplier->supplier_id, $branch_access)){
							$checked = "checked";
							$weekly_budget = $branch_access[$supplier->supplier_id];
						}else{
							$checked = '';
							$weekly_budget = '';
						}
						?>
						<div class="form-group">
							<div class="col-sm-8">
								<input style="float:left; margin-top:10px;" type="checkbox" value="<?php echo $supplier->supplier_id;?>" <?php echo $checked;?> name="branch_access[<?php echo $supplier->supplier_id;?>]">
								<span style="float:left;" class="inline-label"><?php echo $supplier->supplier_name;?></span>
								<input style="width:50%; float:right" type="text" class="form-control" name="weekly_budget[<?php echo $supplier->supplier_id;?>]" value="<?php echo $weekly_budget;?>">
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
	    $("#branch_edit").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			branch_name: {
	                required:true
	            }
			},		
			messages: {
			branch_name: {
	                required:"Please provide branch name"
	            }
			}

	    });	
	});
</script>
