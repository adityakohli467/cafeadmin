	<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>
		<form class="form-horizontal" id="customer_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/suppliers/submit_suppliers" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Add Suppliers</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Save</button>
					<a href="<?php echo base_url(); ?>index.php/suppliers/manage_suppliers">
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
			        	<h3 class="panel-title">Business Info</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Supplier Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="supplier_name" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">ABN</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="abn" onkeypress='validate(event)' minlength="11" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-4 control-label">Website</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="website" autocomplete="off">
							</div>
						</div>
	          		</div>
        		</div>
	        
	        	<div class="panel pn">
	        		<div class="gradient"></div>
		            <div class="panel-heading">
						<h3 class="panel-title">Contact Info</h3>
					</div>
					<div class="panel-body">
						
						<div class="form-group">
							<label for="firstname" class="col-sm-4 control-label">First Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="lastname" class="col-sm-4 control-label">Last Name </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label">Email<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="email" id="email" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="cc" class="col-sm-4 control-label">CC </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="cc" id="cc" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-4 control-label">Contact Number<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="mobile" name="mobile" onkeypress='validate(event)'  maxlength="10" autocomplete="off">
							</div>
						</div>
	          			<div class="form-group">
							<label for="cc" class="col-sm-4 control-label">Fax</label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="fax" id="fax" autocomplete="off">
							</div>
						</div>
	                </div>
	            </div>
				<div class="panel pn">
						<div class="gradient"></div>
					<div class="panel-heading">
						<h3 class="panel-title">Primary Location</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="unit" class="col-sm-4 control-label">Unit No </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="unit" name="unit" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="street" class="col-sm-4 control-label">Street </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="street" name="street" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Suburb </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="suburb" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Postcode </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="postcode" name="postcode" onkeypress='validate(event)' minlength="4" autocomplete="off">
							</div>
						</div>						
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">State </label>
							<div class="col-sm-8">
								<select class="form-control" id="state" name="state">
								    <option value="">Select</option>
									<option value="victoria">QLD</option>
									<option value="victoria">NSW</option>
									<option value="victoria">VIC</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">Country</label>
							<div class="col-sm-8">
								<select class="form-control" id="state" name="country">
								    <option value="">Select</option>
									<option value="australia">Australia</option>
								</select>
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
						<div class="form-group">
							<label for="unit" class="col-sm-4 control-label">Category<span>*</span></label>
							<div class="col-sm-8">
							<!--<input type="text" class="form-control"  autocomplete="off">-->
							<!--<input type="hidden" name="category">-->
							<select name="category" class="form-control">
								<?php foreach($categories as $category){ ?>
									<option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
								<?php } ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="street" class="col-sm-4 control-label">Customer Number</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="customer_num" onkeypress='validate(event)' autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Minimum Order</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="min_order" onkeypress='validate(event)'  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Comments</label>
							<div class="col-sm-8">
							<textarea class="form-control" rows="5" name="comments" ></textarea>
							</div>
						</div>						
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Status</label>
							<div class="col-sm-8">
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="1"  checked>
								<span style="float:left;" class="inline-label">Active</span>
						        <input style="float:left;margin-top:10px;" type="radio" name="status" value="0"  >
						        <span style="float:left;" class="inline-label">Disabled</span>
							</div>
						</div>
	                </div>
	        	</div>
	        	
	        	<div class="panel pn">
	        		<div class="gradient"></div>
					<div class="panel-heading">
						<h3 class="panel-title">Supplier Weekly Budget</h3>
					</div>
					<div class="panel-body">
						<?php 
						$deactive = '';
						$branch_check = '';
						if($user_group == 'Admin'){
							$deactive = 'onclick="this.checked=true;"';
							$branch_check = "checked";
						}
						foreach($branches as $branch){?>
						<div class="form-group">
							<div class="col-sm-8">
								<input style="float:left; margin-top:10px;"  type="checkbox" value="<?php echo $branch->branch_id;?>" name="branch_access[]" <?php echo $branch_check;?> <?php echo $deactive;?> required>
								<span style="float:left;" class="inline-label"><?php echo $branch->branch_name;?></span>
								<input style="width:30%; float:left" type="text" class="form-control text-right" name="weekly_budget[]" value="0">
								<span style="float:left;" class="inline-label">per week</span>
								<div style="clear:both;"></div>
							</div>
						</div>
						<?php } ?>
	        	    </div>
	        	</div>
	        	
	        	<div class="panel pn" style="display:none">
	        		<div class="gradient"></div>
					<div class="panel-heading">
						<h3 class="panel-title">Delivery Schedule</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Monday">
								<span style="float:left;" class="inline-label">Monday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Sunday" >Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Tuesday">
								<span style="float:left;" class="inline-label">Tuesday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Wednesday">
								<span style="float:left;" class="inline-label">Wednesday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Thursday">
								<span style="float:left;" class="inline-label">Thursday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Friday">
								<span style="float:left;" class="inline-label">Friday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Saturday">
								<span style="float:left;" class="inline-label">Saturday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Sunday">
								<span style="float:left;" class="inline-label">Sunday</span>
							</div>
							<div class="col-sm-4">
								<select name="cutoff_day[]" class="form-control">
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="17:00">
							</div>
						</div>
						
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
	        firstname: {
	                required:true
	            }, 
	        email: {
	        	required:true,
                email: true
            },    
            mobile:{
            	required:true,
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
	                required:"Please provide supplier name"
	            },
	        abn:{
            	minlength:"Please enter minimum 11 characters"
            },    
	        firstname: {
	                required:"Please provide first name"
	            },    
	        email: {
	        	 required:"Please provide email",
                 email:"Please enter valid email"
                 },
            mobile:{
            	 required:"Please provide contact number",
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

