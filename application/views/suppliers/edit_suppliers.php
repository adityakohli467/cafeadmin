	<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>
<form class="form-horizontal" id="customer_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/suppliers/update_suppliers" enctype="multipart/form-data">	
	<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3><?php echo $suppliers[0]->supplier_name; ?></h3>
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
					<?php foreach($suppliers as $row){ ?>
					<input type="hidden" name="supplier_id" value="<?php echo $row->supplier_id; ?>">
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Supplier Name <span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="supplier_name" value="<?php echo $row->supplier_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">ABN</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="abn" onkeypress='validate(event)' value="<?php echo $row->abn; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-4 control-label">Website</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="website" value="<?php echo $row->website; ?>" autocomplete="off">
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
								<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row->first_name; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="lastname" class="col-sm-4 control-label">Last Name </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row->last_name; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label">Email<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="email" id="email" value="<?php echo $row->email; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="cc" class="col-sm-4 control-label">CC </label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="cc" id="cc" value="<?php echo $row->cc; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-4 control-label">Contact Number<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="mobile" name="mobile" onkeypress='validate(event)' value="<?php echo $row->mobile; ?>" onkeypress='numberValidate(event)' autocomplete="off">
							</div>
						</div>
	          			<div class="form-group">
							<label for="cc" class="col-sm-4 control-label">Fax</label>
							<div class="col-sm-8">
								<input type="text" class="form-control"  name="fax" id="fax" value="<?php echo $row->fax; ?>" autocomplete="off">
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
								<input type="text" class="form-control" id="unit" name="unit" value="<?php echo $row->unit_number; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="street" class="col-sm-4 control-label">Street </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="street" name="street" value="<?php echo $row->street; ?>" autocomplete="off">
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
								<input type="text" class="form-control" id="postcode" name="postcode" onkeypress='validate(event)' value="<?php echo $row->postcode; ?>" onkeypress='numberValidate(event)' maxlength="4" autocomplete="off">
							</div>
						</div>						
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">State </label>
							<div class="col-sm-8">
								<select class="form-control" id="state" name="state" value="<?php echo $row->state; ?>">
								    <option value="">Select</option>
									<option value="victoria" <?php if($row->state == "victoria"){ echo "selected"; } ?>>Victoria</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-4 control-label">Country</label>
							<div class="col-sm-8">
								<select class="form-control" id="state" name="country" value="<?php echo $row->country; ?>">
								    <option value="">Select</option>
									<option value="australia" <?php if($row->country == "australia"){ echo "selected"; } ?>>Australia</option>
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
								
							<select name="category" class="form-control">
								<?php foreach($categories as $category){ ?>
									<option value="<?php echo $category->category_id;?>" <?php if($category->category_id==$row->category_id){ echo "selected"; } ?>><?php echo $category->category_name;?></option>
								<?php } ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="street" class="col-sm-4 control-label">Customer Number</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="customer_num" onkeypress='validate(event)' value="<?php echo $row->customer_number; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="suburb" class="col-sm-4 control-label">Minimum Order</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="min_order" value="<?php if($row->minimum_order != '0'){echo $row->minimum_order;}else{ echo ""; } ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Comments</label>
							<div class="col-sm-8">
							<textarea class="form-control" rows="5" name="comments" value="<?php echo $row->comments; ?>" ><?php echo $row->comments; ?></textarea>
							</div>
						</div>						
						<div class="form-group">
							<label for="postcode" class="col-sm-4 control-label">Status</label>
							<div class="col-sm-8">
								<input style="float:left;margin-top:10px;" type="radio" name="status" value="1"  <?php if($row->status == '1'){ echo "checked"; } ?>>
								<span style="float:left;" class="inline-label">Active</span>
						        <input style="float:left;margin-top:10px;" type="radio" name="status" value="0"  <?php if($row->status == '0'){ echo "checked"; } ?>>
						        <span style="float:left;" class="inline-label">Disabled</span>
							</div>
						</div>
						
							<div class="form-group">
							<label for="street" class="col-sm-4 control-label">GL code</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="gl_code" onkeypress='validate(event)' value="<?php echo $row->gl_code; ?>" autocomplete="off">
							</div>
						</div>
						
							<div class="form-group">
							<label for="street" class="col-sm-4 control-label">GL category</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="gl_category" onkeypress='validate(event)' value="<?php echo $row->gl_code; ?>" autocomplete="off">
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
					    	<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Upload Haccp certificate:<span>*</span></label>
							<div class="col-lg-8 col-sm-6">
							    <input type="hidden" name="document_id" value="">
								<input type="file" class="form-control" name="haccp_certificate" value="" >
								<?php if($row->haccp_certificate != ''){ ?>  <a style="width:100%;margin-top: 5px;" class="btn btn-success" href="https://www.cafeadmin.com.au/uploaded_files/<?php echo $row->haccp_certificate; ?>" target="_blank">View</a> <?php } ?>
							</div>
							</div>
								    	<div class="form-group">
							 	<label for="businessname" class="col-lg-4 col-sm-12 control-label">HACCP Expiry Date:<span>*</span></label>  
							 		<div class="col-lg-8 col-sm-6">
							<input class="form-control datepicker" id="certificate_expiry_date" name="certificate_expiry_date" type="date" placeholder="HACCP Expiry Date" value="<?php if($row->haccp_expiry_date != '00-00-0000'){ echo $row->haccp_expiry_date; }else{ echo ""; } ?>">
							</div>
								</div>
								
								<div class="form-group">
							 	<label for="businessname" class="col-lg-4 col-sm-12 control-label">Council Food Registration Expiry Date:<span>*</span></label>  
							 		<div class="col-lg-8 col-sm-6">
<input class="form-control datepicker" id="cfr_expiry_date" name="cfr_expiry_date" type="date" placeholder="Council Food Registration Expiry Date" value="<?php if($row->cfr_expiry_date != '00-00-0000'){ echo $row->cfr_expiry_date; }else{ echo ""; } ?>">
							</div>
								</div>
								
						
						<?php 
						$deactive = '';
						$branch_check = '';
						foreach($branches as $branch){
						if(array_key_exists($branch->branch_id, $branch_access)){
							$checked = "checked";
							$weekly_budget = $branch_access[$branch->branch_id];
						}else{
							$checked = '';
							$weekly_budget = '';
						}
						if($user_group == 'Admin'){
							$deactive = 'onclick="this.checked=true;"';
							$branch_check = "checked";
						}
						?>
					
						<div class="form-group">
							<div class="col-sm-8">
								<input style="float:left; margin-top:10px;" type="checkbox" value="<?php echo $branch->branch_id;?>" <?php echo $checked;?> name="branch_access[<?php echo $branch->branch_id;?>]" <?php echo $branch_check;?> <?php echo $deactive;?>>
								<span style="float:left;" class="inline-label"><?php echo $branch->branch_name;?></span>
								<input style="width:30%; float:left" type="text" class="form-control text-right" name="weekly_budget[<?php echo $branch->branch_id;?>]" value="<?php echo $weekly_budget;?>">
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
								<?php 
								if(array_key_exists('Monday', $supplier_schedule)){
									$checked1 = 'checked';
									$cutt_off_time1 = date('H:i', strtotime($supplier_schedule['Monday']->cut_off_time));
									
								}else{
									$checked1 = '';
									$cutt_off_time1 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Monday" <?php echo $checked1;?>>
								<span style="float:left;" class="inline-label">Monday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Monday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Sunday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Sunday'){echo 'selected';}?>>Sunday</option>
									<option value="Saturday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
									<option value="Friday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									<option value="Thursday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									<option value="Wednesday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									<option value="Tuesday" <?php if($supplier_schedule['Monday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									
								</select>
								<?php }else{?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Sunday" >Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									
								</select>
							<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time1;?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Tuesday', $supplier_schedule)){
									$checked2 = 'checked';
									$cutt_off_time2 = date('H:i', strtotime($supplier_schedule['Tuesday']->cut_off_time));
									
								}else{
									$checked2 = '';
									$cutt_off_time2 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Tuesday" <?php echo $checked2;?>>
								<span style="float:left;" class="inline-label">Tuesday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Tuesday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Monday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
									<option value="Sunday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Sunday'){echo 'selected';}?>>Sunday</option>
									<option value="Saturday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
									<option value="Friday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									<option value="Thursday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									<option value="Wednesday" <?php if($supplier_schedule['Tuesday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time2;?>">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Wednesday', $supplier_schedule)){
									$checked3 = 'checked';
									$cutt_off_time3 = date('H:i', strtotime($supplier_schedule['Wednesday']->cut_off_time));
									
								}else{
									$checked3 = '';
									$cutt_off_time3 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Wednesday" <?php echo $checked3;?>>
								<span style="float:left;" class="inline-label">Wednesday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Wednesday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Tuesday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									<option value="Monday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
									<option value="Sunday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Sunday'){echo 'selected';}?>>Sunday</option>
									<option value="Saturday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
									<option value="Friday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									<option value="Thursday" <?php if($supplier_schedule['Wednesday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time3;?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Thursday', $supplier_schedule)){
									$checked4 = 'checked';
									$cutt_off_time4 = date('H:i', strtotime($supplier_schedule['Thursday']->cut_off_time));
									
								}else{
									$checked4 = '';
									$cutt_off_time4 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Thursday" <?php echo $checked4;?>>
								<span style="float:left;" class="inline-label">Thursday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Thursday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Wednesday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									<option value="Tuesday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									<option value="Monday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
									<option value="Sunday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Sunday'){echo 'selected';}?>>Sunday</option>
									<option value="Saturday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
									<option value="Friday" <?php if($supplier_schedule['Thursday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time4;?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Friday', $supplier_schedule)){
									$checked5 = 'checked';
									$cutt_off_time5 = date('H:i', strtotime($supplier_schedule['Friday']->cut_off_time));
									
								}else{
									$checked5 = '';
									$cutt_off_time5 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Friday" <?php echo $checked5;?>>
								<span style="float:left;" class="inline-label">Friday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Friday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Thursday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									<option value="Wednesday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									<option value="Tuesday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									<option value="Monday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
									<option value="Sunday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Sunday'){echo 'selected';}?>>Sunday</option>
									<option value="Saturday" <?php if($supplier_schedule['Friday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
									<option value="Saturday">Saturday</option>
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time5;?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Saturday', $supplier_schedule)){
									$checked6 = 'checked';
									$cutt_off_time6 = date('H:i', strtotime($supplier_schedule['Saturday']->cut_off_time));
									
								}else{
									$checked6 = '';
									$cutt_off_time6 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Saturday" <?php echo $checked6;?>>
								<span style="float:left;" class="inline-label">Saturday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Saturday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Friday" <?php if($supplier_schedule['Saturday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									<option value="Thursday" <?php if($supplier_schedule['Saturday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									<option value="Wednesday" <?php if($supplier_schedule['Saturday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									<option value="Tuesday" <?php if($supplier_schedule['Saturday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									<option value="Monday" <?php if($supplier_schedule['Saturday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
									<option value="Sunday">Sunday</option>
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time6;?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-3">
								<?php 
								if(array_key_exists('Sunday', $supplier_schedule)){
									$checked7 = 'checked';
									$cutt_off_time7 = date('H:i', strtotime($supplier_schedule['Sunday']->cut_off_time));
								}else{
									$checked7 = '';
									$cutt_off_time7 = '17:00';
								}
								?>
								<input style="float:left; margin-top:10px;" type="checkbox" name="delivery_day[]" value="Sunday" <?php echo $checked7;?>>
								<span style="float:left;" class="inline-label">Sunday</span>
							</div>
							<div class="col-sm-4">
								<?php 
								if(array_key_exists('Sunday', $supplier_schedule)){
								?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Saturday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Saturday'){echo 'selected';}?>>Saturday</option>
									<option value="Friday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Friday'){echo 'selected';}?>>Friday</option>
									<option value="Thursday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Thursday'){echo 'selected';}?>>Thursday</option>
									<option value="Wednesday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Wednesday'){echo 'selected';}?>>Wednesday</option>
									<option value="Tuesday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Tuesday'){echo 'selected';}?>>Tuesday</option>
									<option value="Monday" <?php if($supplier_schedule['Sunday']->cut_off_day == 'Monday'){echo 'selected';}?>>Monday</option>
								</select>
								<?php }else{ ?>
								<select name="cutoff_day[]" class="form-control">
									<option value="Saturday">Saturday</option>
									<option value="Friday">Friday</option>
									<option value="Thursday">Thursday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Monday">Monday</option>
								</select>
								<?php } ?>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="cutoff_time[]" value="<?php echo $cutt_off_time7;?>">
							</div>
						</div>
						
	                </div>
	        	</div>
	        	
	        </div>
			<?php } ?>
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
            postcode:{
            	minlength:4
            },
				category: {
	                required:true
	            }
			},		
			messages: {
				supplier_name: {
	                required:"Please enter Supplier name"
	            },
	            abn:{
            	minlength:"Please enter minimum 11 characters"
                },
                firstname: {
	                required:"Please enter Supplier name"
	            },
                 postcode:{
            	minlength:"Please enter minimum 4 characters"
                 },
				category: {
	                required:"Please enter Category name"
	             }
			}

	    });	
	});
</script>
