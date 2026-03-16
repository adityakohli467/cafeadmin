
	<div class="row item">
		<?php if(@$message){ ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $message;?>
		</div>
		<?php } ?>
	</div>
		
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-4"></div>
		<div class="col-md-3">
			<span class="text-center">
				<h3>Induction Form</h3>
			</span>
		</div>
		<div class="btn-div col-md-5">
			<button type="button" id="save_exit"  class="btn btn-success btn-ph">Save & Exit</button>
			<button type="button" id="save_continue" name="contact_submit"  class="btn btn-success btn-ph">Save & Continue</button>
		</div>
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
	<form class="form-horizontal" role="form" id="myForm" method="post" action="<?php echo base_url(); ?>index.php/employees/submit_emp_indection_reg" enctype="multipart/form-data">

<?php if(!empty($user_details)){ // echo "<pre>"; print_r($user_details); exit;?>
	<?php foreach($user_details as $row){  ?>
  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Personal Details</h3>
			        </div>
	          		<div class="panel-body">
	          			<input type="hidden" name="fname" value="<?php echo $row->first_name; ?>">
	          			<input type="hidden" name="lname" value="<?php echo $row->last_name; ?>">
	          			<input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Title:<span>*</span></label>
							<div class="col-sm-8">
							  <select class="form-control" name="title">
							  	<option value="">Select</option>
							  	<option value="Mr" <?php if($row->title == 'Mr'){ echo "selected"; } ?>>Mr</option>
							  	<option value="Ms" <?php if($row->title == 'Ms'){ echo "selected"; } ?>>Ms</option>
							  	<option value="Mrs" <?php if($row->title == 'Mrs'){ echo "selected"; } ?>>Mrs</option>
							  	<option value="Miss" <?php if($row->title == 'Miss'){ echo "selected"; } ?>>Miss</option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">First Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Last Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Email<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="email" value="<?php echo $row->email; ?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Phone<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="phone" onkeypress='validate(event)' value="<?php echo $row->phone; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Date of Birth<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="datepicker" value="<?php if($row->dob != '0000-00-00'){ echo $row->dob; }else{ echo ""; } ?>" name="dob" autocomplete="off" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Hourly Rate<span>*</span></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="rate" onkeypress='validate(event)' value="<?php echo $row->rate; ?>" autocomplete="off" >
							</div>
						</div>
						
	          		</div>
        		</div>
        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Address</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Unit Number<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="unit" value="<?php echo $row->unit_number; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Street<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="street" value="<?php echo $row->street; ?>"  autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Suburb<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Postcode<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="post" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">State<span>*</span></label>
							<div class="col-sm-8">
							<select class="form-control" name="state">
								<option value="">Select</option>
								<option value="nsw" <?php if($row->state == 'nsw'){ echo "selected"; } ?>>New South Wales</option>
								<option value="vic" <?php if($row->state == 'vic'){ echo "selected"; } ?>>Victoria</option>
								<option value="qld" <?php if($row->state == 'qld'){ echo "selected"; } ?>>Queensland</option>
								<option value="wa" <?php if($row->state == 'wa'){ echo "selected"; } ?>>Western Australia</option>
								<option value="sa"<?php if($row->state == 'sa'){ echo "selected"; } ?>>South Australia</option>
								<option value="tas" <?php if($row->state == 'tas'){ echo "selected"; } ?>>Tasmania</option>
								<option value="act" <?php if($row->state == 'act'){ echo "selected"; } ?>>Australian Capital Territory</option>
								<option value="nt" <?php if($row->state == 'nt'){ echo "selected"; } ?>>Northern Territory</option>
							</select>
							</div>
						</div>
	          		</div>
        		</div>
        		<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Bank Details</h3>
			        </div>
	          		<div class="panel-body">
					<div class="row">
					  <div class="col-md-12">
					  <h5>Account No 1</h5>
					     <div class="row">
						    <div class="col-md-6">
							   <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Bank</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_1" value="<?php echo $row->bank_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_1" value="<?php echo $row->bsb_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">%</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_1" value="<?php echo $row->percentage_1; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Branch</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_1" value="<?php echo $row->account_name_1; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
						 <h5>Account No 2</h5>
						 <div class="row">
						    <div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Bank</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_2" value="<?php echo $row->bank_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_2" value="<?php echo $row->bsb_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">%</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_2" value="<?php echo $row->percentage_2; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Branch</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_2" value="<?php echo $row->bank_branch_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_2" value="<?php echo $row->account_no_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_2" value="<?php echo $row->account_name_2; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
						 <h5>Account No 3</h5>
						 <div class="row">
						    <div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Bank</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_3" value="<?php echo $row->bank_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_3" value="<?php echo $row->bsb_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">%</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_3" value="<?php echo $row->percentage_3; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Branch</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_3" value="<?php echo $row->bank_branch_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_3" value="<?php echo $row->account_no_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_3" value="<?php echo $row->account_name_3; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
					  </div>
					  <div class="col-md-12">
					     I hereby authorize Zouki to initiate automatic deposits for my fortnightly wages to my balk account(s) as detalid above. also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. 
I hereby agree not to hold Zouki responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. 
This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until submit a new electronic banking form to Head Office.
					  </div>
					</div>						
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Medical History</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-12">
								Please provide details of any medical conditions that may affect your ability to perform your role at The Zouki Group of Companies
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<textarea type="text" class="form-control" name="medical_history" value="<?php echo $row->medical_history; ?>" rows="4"><?php echo $row->medical_history; ?></textarea>
							</div>
						</div>
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Training</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Fire/Emergency Training Completed Date</label>
							<div class="col-sm-8">
								<input type="text" class="form-control datepicker"  name="fire_emg_completed_date" value="<?php echo $row->fire_emg_completed_date; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">OH&S Training Completition Date</label>
							<div class="col-sm-8">
								<input type="text" class="form-control datepicker" name="oh_s_completed_date" value="<?php echo $row->oh_s_completed_date; ?>" autocomplete="off">
							</div>
						</div>
	          		</div>
        	  </div>
	        </div>
	       <div class="col-md-6">
	       	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Next of Kin</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_name_two" value="<?php echo $row->nextkin_name_two; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Email</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Relationship</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" autocomplete="off" >
							</div>
						</div><hr>
                       <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_name_one" value="<?php echo $row->nextkin_name_one; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Email</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_email_one" value="<?php echo $row->nextkin_email_one; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Relationship</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_relationship_one" value="<?php echo $row->nextkin_relationship_one; ?>" autocomplete="off" >
							</div>
						</div>
	          		</div>
        	  </div>
        	  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">General Info</h3>
			        </div>
	          		<div class="panel-body">
	          			<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Visa Status<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="visa_status" value="<?php echo $row->visa_status; ?>"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">TFN Number<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="tfn_no" value="<?php echo $row->tfn_number; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Super Fund Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="super_fund_name" value="<?php echo $row->super_fund_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Super Annuation Number<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="super_annua_no" value="<?php echo $row->super_annuation_no; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Highest Academic Achievements </label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="5" value="<?php echo $row->heighest_acd_achmts; ?>" name="heighest_acadamic_ach"><?php echo $row->heighest_acd_achmts; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Last 3 Previous Employ</label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="pre_emp_hstry_one" value="<?php echo $row->pre_emp_hstry_one; ?>" placeholder="Previous Employee 1"><?php echo $row->pre_emp_hstry_one; ?></textarea><br>
								<textarea class="form-control" rows="5" name="pre_emp_hstry_two" value="<?php echo $row->pre_emp_hstry_two; ?>" placeholder="Previous Employee 2"><?php echo $row->pre_emp_hstry_two; ?></textarea><br>
							</div>
						</div>
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Police Deductions</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Entity</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="entity" value="<?php echo $row->entity; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Surname</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="police_surname" value="<?php echo $row->police_surname; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Given Name(s)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="given_name" value="<?php echo $row->given_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Address</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="address" value="<?php echo $row->address; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"></label>
							<div class="col-sm-8">
								(OR)
							</div>
						</div>
						<hr>
						<div class="col-sm-12">
								<p>I hereby authorize Zouki Group, to deduct from my pay annual amount of $32.00, being payment fut
a ,National Name Check" conducted by the Victorian Police Department</p>
							</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload Certificate</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="police">
							</div>
						</div>
						<div class="form-group">
							
							
						</div>
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Files</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Tax Declaration Form</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="tax_declaration">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Completed Super Annuation Form</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="completed_super_annu">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Advice of Tax File Number to Superannuation Fund</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="advice_of_tax_file">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Quality Assurance/Food Safety Handling Certificate</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="quality_assurance">
							</div>
						</div>
	          		</div>
        	  </div>
			  <div class="panel pn">
        	  	   <div class="panel-heading">
			        	<h3 class="panel-title">Uniform Agreement</h3>
			        </div>
	          		<div class="panel-body">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>DESCRIPTION</th>
								<th>SIZE</th>
								<th>QTY</th>
								<th>COST PRICE</th>
								<th>TOTAL VALUE</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
							    <td rowspan="5">Green Polo Shirt</td>
								<td>S<input type="hidden"  name="green_polo_total_s_size" value="s"></td>
								<td><input type="text" class="form-control" name="green_polo_qty_s"></td>
								<td>$15.90 + GST</td>
								<td><input type="text" class="form-control" name="green_polo_total_s"></td>
							  </tr>
							  <tr>
								<td>M<input type="hidden"  name="green_polo_total_s_size" value="m"></td>
								<td><input type="text" class="form-control" name="green_polo_qty_m"></td>
								<td>$15.90 + GST</td>
								<td><input type="text" class="form-control" name="green_polo_total_m"></td>
							  </tr>
							  <tr>
								<td>L<input type="hidden"  name="green_polo_total_s_size" value="l"></td>
								<td><input type="text" class="form-control" name="green_polo_qty_l"></td>
								<td>$15.90 + GST</td>
								<td><input type="text" class="form-control" name="green_polo_total_l"></td>
							  </tr>
							  <tr>
								<td>XL<input type="hidden"  name="green_polo_total_s_size" value="xl"></td>
								<td><input type="text" class="form-control" name="green_polo_qty_xl"></td>
								<td>$15.90 + GST</td>
								<td><input type="text" class="form-control" name="green_polo_total_xl"></td>
							  </tr>
							  <tr>
								<td>XXL<input type="hidden"  name="green_polo_total_s_size" value="xxl"></td>
								<td><input type="text" class="form-control" name="green_polo_qty_xxl"></td>
								<td>$15.90 + GST</td>
								<td><input type="text" class="form-control" name="green_polo_total_xxl"></td>
							  </tr>
							  <tr>
							    <td rowspan="5">Contemporary Shirt(Choclate/Stone)</td>
								<td>S</td>
								<td><input type="text" class="form-control"></td>
								<td>$16.90 + GST</td>
								<td><input type="text" class="form-control"></td>
							  </tr>
							  <tr>
								<td>M</td>
								<td><input type="text" class="form-control"></td>
								<td>$16.90 + GST</td>
								<td><input type="text" class="form-control"></td>
							  </tr>
							  <tr>
								<td>L</td>
								<td><input type="text" class="form-control"></td>
								<td>$16.90 + GST</td>
								<td><input type="text" class="form-control"></td>
							  </tr>
							  <tr>
								<td>XL</td>
								<td><input type="text" class="form-control"></td>
								<td>$16.90 + GST</td>
								<td><input type="text" class="form-control"></td>
							  </tr>
							  <tr>
								<td>XXL</td>
								<td><input type="text" class="form-control"></td>
								<td>$16.90 + GST</td>
								<td><input type="text" class="form-control"></td>
							  </tr>
							  <tr>
							    <td>Cap Suede Twill Brown</td>
								<td>ONE SIZE</td>
								<td><input type="text" class="form-control" name="CapSuedeTwillBrown_qty"></td>
								<td>$6.24 + GST</td>
								<td><input type="text" class="form-control" name="CapSuedeTwillBrown_total"></td>
							  </tr>
							  <tr>
							    <td>Chef Hat Custom Brown</td>
								<td>ONE SIZE</td>
								<td><input type="text" class="form-control" name="ChefHatCustomBrown_qty"></td>
								<td>$6.15 + GST</td>
								<td><input type="text" class="form-control" name="ChefHatCustomBrown_total"></td>
							  </tr>
							  <tr>
							    <td>Bib Apron Custom Brown</td>
								<td>ONE SIZE</td>
								<td><input type="text" class="form-control" name="BibApronCustomBrown_qty"></td>
								<td>$13.06 + GST</td>
								<td><input type="text" class="form-control" name="BibApronCustomBrown_total"></td>
							  </tr>
							  <tr>
							    <td>Continental Apron Custom Brown</td>
								<td>ONE SIZE</td>
								<td><input type="text" class="form-control" name="ContinentalApron_qty"></td>
								<td>$10.75 + GST</td>
								<td><input type="text" class="form-control" name="ContinentalApron_total"></td>
							  </tr>
							</tbody>
						  </table>
	          		</div>
        	  </div>
	       </div>
	    </div>
	    	
	</div>
  <?php } ?>
    <?php } ?>
  </form>

	<div class="col-md-12"><br>
        	<div class="col-md-6">
        		<div class="panel pn">
        			<div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;">Staff Induction Guide</h3>
			    	</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/StaffInductionGuide.pdf" target="_blank">View</a>
					</div> <br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div>
							<iframe src="<?php echo base_url();?>assets/terms_docs/StaffInductionGuide.pdf" width="100%" height="100%"></iframe>
							<div class="checkbox">
								  <label><input type="checkbox" value="1" name="agree_terms_one" <?php if(!empty($user_details)){  if($user_details[0]->agree_terms_one == '1'){ echo "checked"; }} ?>>I Agree To Company Policies</label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>
	        </div>
	       <div class="col-md-6">
        	  <div class="panel pn">
        	  	   <div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;">Company Policies and Procedures</h3>
			    	</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/CompanyPolicies.pdf" target="_blank">View</a>
					</div><br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div>
							<iframe src="<?php echo base_url();?>assets/terms_docs/CompanyPolicies.pdf" width="100%" height="100%"></iframe>
						
							<div class="checkbox">
								  <label><input type="checkbox" value="1" name="agree_terms_two" <?php if(!empty($user_details)){ if($user_details[0]->agree_terms_two == '1'){ echo "checked"; }} ?>>I Agree To Roles and Policies</label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>

	       </div>
	    </div>    
   </div>
  
  
  <br>
<script>
$(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
</script>

<script>
$(function() {
        $('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
        });
    });
</script>
<script>

$('#save_exit').click(function(){
		var data1 = $('#myForm').serialize();
		console.log(data1);
		$.ajax({
			type: "POST",
		    url: "<?php echo base_url(); ?>index.php/employees/submit_save_exit_emp_indection_reg",
		    data: data1,
		    success: function(data){
                   //alert(data);
                 location.reload();
		    }
		});
		
	});

$('#save_continue').click(function(){
		$('#myForm').submit();
	});

</script>
<script type="text/javascript">
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

<script type="text/javascript">
	function delete_row(str){
if(confirm('Are you sure you   want to delete file')){
		$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/employees/deletefiles",
				data:"id="+str,
				success: function(data){
					location.reload();
				}
			});   
}	
	}
	</script>
<script>
Dropzone.options.invoice = {
	  paramName: "file", // The name that will be used to transfer the file
	  renameFile: function (file) {
	  	var ext = file.name.split('.').pop();
            return file.name ="induction-." + ext;
        },
	  maxFilesize: 1, // MB
	  dictDefaultMessage:"Drop Files here",
	  acceptedFiles :"image/jpg,image/jpeg,image/png,application/pdf",
	  success: function(file, response){
                $('#display_images').html(response);
            }
	};
</script>
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#myForm").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			title: {
	                required:true
	            },
	        name: {
	                required:true
	            }, 
	        surname: {
	                required:true
	            },    
	        email: {
	        	required:true,
                email: true
            },
            phone: {
	                required:true
	            },
	        dob: {
	                required:true
	            },
	        unit: {
	                required:true
	            },
	        street: {
	                required:true
	            },
	        suburb: {
	                required:true
	            },
	        post: {
	                required:true
	            },
	        state: {
	                required:true
	            },
	        tfn_no: {
	                required:true
	            },
	        super_fund_name: {
	                required:true
	            },
	        super_annua_no: {
	                required:true
	            },
	        visa_status: {
	                required:true
	            },
	          agree_terms_one: {
	                required:true
	            },
	          agree_terms_two: {
	                required:true
	            },  
			},		
			messages: {
			title: {
	                required:"Please provide title"
	            },
	        name: {
	                required:"Please provide name"
	            },
	        surname: {
	                required:"Please provide surname"
	            },    
	        email: {
	        	 required:"Please provide email",
                 email:"Please enter valid email"
                 },
            phone:{
            	 required:"Please provide contact number",
            	 minlength:"Please enter minimum 10 characters"
              },
            dob: {
	                required:"Please provide Date of birth"
	            },
	        unit: {
	                required:"Please provide unit number"
	            },
	        street: {
	                required:"Please provide street"
	            },
	        suburb: {
	                required:"Please provide suburb"
	            },
	        post: {
	                required:"Please provide post code"
	            },
	        state: {
	                required:"Please provide state"
	            },
	        tfn_no: {
	                required:"Please provide tfn number"
	            },
	        super_fund_name: {
	                required:"Please provide super fund name"
	            },
	        super_annua_no: {
	                required:"Please provide super annuation number"
	            },
	        visa_status: {
	                required:"Please provide visa status"
	            },
	        agree_terms_one: {
	                required:"Please agree company policies"
	            },
	        agree_terms_two: {
	                required:"Please agree roles and policies"
	            }    
			}

	    });	
	});
</script>
