	 <script type="text/javascript">	
		$(document).ready(function() {
			//$('#example').DataTable();
			$('#example').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
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
	<form class="form-horizontal" role="form" id="myForm" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_update_employee" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		
			<span class="text-center">
				<h3>EMPLOYEE INDUCTION</h3>
			</span>
		<span class="extra_icons" style="float:right;">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">SAVE</button>&nbsp;
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
						<button type="button"  class="btn btn-success btn-ph btn-ph-cancel">CANCEL</button>
					</a>
		</span>
      
	</div>
	<style>
.loader {
      border: 16px solid #9e9e9e;
    border-radius: 50%;
    border-top: 16px solid #4caf50;
    border-bottom: 16px solid #4caf50;
    width: 120px;
    height: 120px;
    position: fixed;
    z-index: 9999;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    top: 50%;
    left: 50%;
}

/*body{*/
/*    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('landingpagepic.jpg');*/
/*  background-position: center top;*/
/*}*/
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
	<div class="loader" style="display:none"></div>
<div class="container-fluid main-container">
	
		<?php if(null !==$this->session->userdata('error_msg')) { ?>  
				<div class='hideMe alert alert-danger'>
					<?php echo $this->session->flashdata('error_msg'); ?>
				</div>
				<?php } ?>
				
	<?php foreach($employee as $row){ ?>
  		<div class="row">
  			
        	<div class="col-lg-6 col-md-12">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Personal Details</b></h3>
			        </div>
	          		<div class="panel-body ct-form-in">
	          			<input type="hidden" name="fname" value="<?php echo $row->first_name; ?>">
	          			<input type="hidden" name="lname" value="<?php echo $row->last_name; ?>">
	          			<input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Title:</b><span>*</span></label>
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
							<label for="businessname" class="col-sm-4 control-label"><b>First Name:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Last Name:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Email Address:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="email" value="<?php echo $row->email; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Password:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="password" value="" placeholder="*******">
							</div>
						</div>
							<?php if($role =='admin'){?>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Pin:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pin" value="" placeholder="****">
							</div>
						</div>
							<?php } ?>
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Contact Number:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="phone" onkeypress='validate(event)' value="<?php echo $row->phone; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Date of Birth:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="date" class="form-control datetime"  value="<?php if($row->dob != '00-00-0000'){ echo $row->dob; }else{ echo ""; } ?>" name="dob" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Effective Start Date:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="date" class="form-control datetime"  value="<?php if($row->effective_start_date != '00-00-0000'){ echo $row->effective_start_date; }else{ echo ""; } ?>" name="effective_start_date" autocomplete="off" >
							</div>
						</div>
							<?php if($role =='admin' || $role =='manager'){?>
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Role:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<select name="role" class="form-control">
								   
									<?php if(isset($roles) && !empty($roles)) { foreach($roles as $rolee) { ?>
									<?php  if($row->role == $rolee->role_id){ ?>
									<option selected="selected" value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
									<?php } else { ?>
									<option value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
									<?php } }} ?>
									</select>
								
							</div>
						</div>
						
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Employee Type:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<select name="employee_type" class="form-control">
								<?php  if($row->employee_type == "full_time"){ ?>
								  <option selected="selected" value="full_time">Full Time</option>
								  	<option value="part_time">Part Time</option>
								     <option value="casual">Casual</option>
								<?php } else if($row->employee_type == "part_time"){ ?>
								    <option value="full_time">Full Time</option>
								    <option selected="selected" value="part_time">Part Time</option>
								  	<option value="casual">Casual</option>
									<?php } else if($row->employee_type == "casual"){ ?>
								   <option value="full_time">Full Time</option>
								   <option value="part_time">Part Time</option>
								  <option selected="selected" value="casual">Casual</option>
								<?php }else {  ?>
								   <option value="full_time">Full Time</option>
								   <option value="part_time">Part Time</option>
								   <option  value="casual">Casual</option>
								  
								<?php } ?>
								</select>
								
							</div>
						</div>
						
							<?php } ?>
						<?php    if($role =='admin'){?>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Hourly Rate:</b><span>*</span></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="rate" onkeypress='validate(event)' value="<?php echo $row->rate; ?>" autocomplete="off" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Saturday Rate:</b></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="Saturday_rate"  value="<?php echo $row->Saturday_rate; ?>" autocomplete="off" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Sunday Rate:</b>
							</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="Sunday_rate" value="<?php echo $row->Sunday_rate; ?>" autocomplete="off" >
							</div>
						</div>
						
							<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Public Holiday Rate:</b></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="holiday_rate"  value="<?php echo $row->holiday_rate; ?>" autocomplete="off" >
							</div>
						</div>
					
						
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Uniform Allowance:</b></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="uniform_allowance"  value="<?php echo $row->uniform_allowance; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Early Start:</b></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="early_start"  value="<?php echo $row->early_start; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Late Night:</b></label>
								<div class="col-sm-8">
								<input type="text" class="form-control" name="late_night"  value="<?php echo $row->late_night; ?>" autocomplete="off" >
							</div>
						</div>
							<?php } ?>
						
	          		</div>
        		</div>
        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Postal Address</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Unit Number:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="unit" value="<?php echo $row->unit_number; ?>" autocomplete="off">
							</div>
						</div>
				
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Street Name:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="street_name" value="<?php echo $row->street_name; ?>"  autocomplete="off" >
							</div>
						</div>
					
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Street Number:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="street" value="<?php echo $row->street; ?>"  autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Suburb:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Postcode:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="post" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>State:</b><span>*</span></label>
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
			        	<h3 class="panel-title"><b>Bank Details</b></h3>
			        </div>
	          		<div class="panel-body">
					<div class="row">
					  <div class="col-md-12">
					  <h5><b>Account No 1</b></h5>
					     <div class="row">
						    <div class="col-lg-6 col-md-12">
							   <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Bank Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_1" value="<?php echo $row->bank_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>BSB:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_1" value="<?php echo $row->bsb_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">% to Deposit</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_1" value="<?php echo $row->percentage_1; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-lg-6 col-md-12">
							   <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Branch Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account No:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_1" value="<?php echo $row->account_name_1; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
						 <h5><b>Account No 2</b></h5>
						 <div class="row">
						    <div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Bank Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_2" value="<?php echo $row->bank_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>BSB:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_2" value="<?php echo $row->bsb_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">% to Deposit:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_2" value="<?php echo $row->percentage_2; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Branch Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_2" value="<?php echo $row->bank_branch_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account No:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_2" value="<?php echo $row->account_no_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_2" value="<?php echo $row->account_name_2; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
						 <h5><b>Account No 3</b></h5>
						 <div class="row">
						    <div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Bank Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_3" value="<?php echo $row->bank_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>BSB:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bsb_3" value="<?php echo $row->bsb_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">% to Deposit:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="percentage_3" value="<?php echo $row->percentage_3; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Branch Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_3" value="<?php echo $row->bank_branch_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account No:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_3" value="<?php echo $row->account_no_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Account Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_3" value="<?php echo $row->account_name_3; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
					  </div>
					  <div class="col-md-12">
					     I hereby authorize Zouki to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. 
I hereby agree not to hold Zouki responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. 
This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.
					  </div>
					</div>						
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Medical History</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-12">
								<b>Please provide details of any medical conditions that may affect your ability to perform your role at The Zouki Group of Companies</b>
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
			        	<h3 class="panel-title"><b>Training Undertaken</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Fire/Emergency Training Completed Date:</b></label>
							<div class="col-sm-8">
								<input type="date" class="form-control datetime"  name="fire_emg_completed_date" value="<?php echo $row->fire_emg_completed_date; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>OH&S Training Completition Date:</b></label>
							<div class="col-sm-8">
								<input type="date" class="form-control datetime" name="oh_s_completed_date" value="<?php echo $row->oh_s_completed_date; ?>" autocomplete="off">
							</div>
						</div>
	          		</div>
        	  </div>
			  
	        </div>
	       <div class="col-lg-6 col-md-12">
	       	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Next of Kin</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_name_two" value="<?php echo $row->nextkin_name_two; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Email Address:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="Phone No" class="col-sm-4 control-label"><b>Phone No:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_phone_no" value="<?php echo $row->nextkin_phone_no; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Relationship:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" autocomplete="off" >
							</div>
						</div><hr>
                       <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_name_one" value="<?php echo $row->nextkin_name_one; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Email Address:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_email_one" value="<?php echo $row->nextkin_email_one; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Relationship:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nextkin_relationship_one" value="<?php echo $row->nextkin_relationship_one; ?>" autocomplete="off" >
							</div>
						</div>
	          		</div>
        	  </div>
        	  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>General Info</b></h3>
			        </div>
	          		<div class="panel-body">
	          			<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Visa Status:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="visa_status" value="<?php echo $row->visa_status; ?>"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>TFN Number:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="tfn_no" value="<?php echo $row->tfn_number; ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Super Fund Name:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="super_fund_name" value="<?php echo $row->super_fund_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Super Annuation Number:</b><span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="super_annua_no" value="<?php echo $row->super_annuation_no; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Highest Academic Achievements:</b> </label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="5" value="<?php echo $row->heighest_acd_achmts; ?>" name="heighest_acadamic_ach"><?php echo $row->heighest_acd_achmts; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Last 2 Previous Employments History:</b></label>
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
			        	<h3 class="panel-title"><b>Police Deductions</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Entity:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="entity" value="<?php echo $row->entity; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Last Name:</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="police_surname" value="<?php echo $row->police_surname; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Given Name(s):</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="given_name" value="<?php echo $row->given_name; ?>" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Postal Address:</b></label>
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
								<p>I hereby authorize Zouki Group, to deduct an total amount of $32.00 from the next pay for the National Name Check conducted by the Victorian Police Department</p>
							</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Upload Certificate</b></label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control" name="police" value="<?php if((isset($row->police_certificate)) && ($row->police_certificate !='')) { echo $row->police_certificate;  } ?>">
								<?php 
							if((isset($row->police_certificate)) && ($row->police_certificate !='') && (file_exists("./uploaded_files/".$row->police_certificate))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->police_certificate; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
						</div>
						<div class="form-group">
							
							
						</div>
	          		</div>
        	  </div>
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Required File Uploads</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Tax Declaration Form:</b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="tax_declaration">
								<?php 
							if((isset($row->tax_declaration)) && ($row->tax_declaration !='') && (file_exists("./uploaded_files/".$row->tax_declaration))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->tax_declaration; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Completed Super Annuation Form:</b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="completed_super_annu">
									<?php 
							if((isset($row->completed_super_annu)) && ($row->completed_super_annu !='') && (file_exists("./uploaded_files/".$row->completed_super_annu))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->completed_super_annu; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Advice of Tax File Number to Superannuation Fund:</b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="advice_of_tax_file">
							<?php 
							if((isset($row->advice_of_tax_file)) && ($row->advice_of_tax_file !='') && (file_exists("./uploaded_files/".$row->advice_of_tax_file))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->advice_of_tax_file; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>	
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Quality Assurance/Food Safety Handling Certificate:</b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="quality_assurance">
						<?php 
							if((isset($row->quality_assurance)) && ($row->quality_assurance !='') && (file_exists("./uploaded_files/".$row->quality_assurance))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->quality_assurance; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>		
							</div>
						</div>
	          		</div>
        	  </div>
			  
			  
			  
			  
			  
			  
			  <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Vaccination Certificate <small style="color:red">*jpg, jpeg, pdf</small></b></h3>
			        </div>
	          		<div class="panel-body">
			  	<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Vaccination Certificate: </b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="vaccination_certificate">
						<?php 
							if((isset($row->vaccination_certificate)) && ($row->vaccination_certificate !='') && (file_exists("./uploaded_files/".$row->vaccination_certificate))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;width:200%;padding: 5px 20px;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->vaccination_certificate; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>		
							</div>
						</div>
			  	</div>
			  	</div>
			  
			  
			  
			   
	       </div>
	    
	    	
	</div>
	
	<div class="row">
	  <div class="col-lg-6 col-md-12">
	      <div class="panel pn">
        			<div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;"><b>Staff Induction Manual</b></h3>
			    	</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
					      <?php if($branch_id =='57') { ?>
						<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" target="_blank">View</a>
							<?php }elseif($branch_id =='55') { ?>
							<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" target="_blank">View</a>
							<?php }else { ?>
							<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" target="_blank">View</a>
							<?php } ?>
							
					</div> <br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div >
							      <?php if($branch_id =='57') { ?>
							<iframe src="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" width="100%" height="100%"></iframe>
								<?php }elseif($branch_id =='55') { ?>
								<iframe src="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" width="100%" height="100%"></iframe>
									<?php }else { ?>
									<iframe src="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" width="100%" height="100%"></iframe>
										<?php } ?>
							<div class="checkbox">
								  <label style="color:#000;"><input type="checkbox" value="1" name="agree_terms_one" <?php if($row->agree_terms_one == '1'){ echo "checked"; } ?>><b>I Agree to the Staff Induction Manual.</b></label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>
	  </div>
	  <div class="col-lg-6 col-md-12">
	     <div class="panel pn">
        	  	   <div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;"><b>Company Policies and Procedures</b></h3>
			    	</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
					     <?php if($branch_id =='57') { ?>
						<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" target="_blank">View</a>
							<?php }elseif($branch_id =='55') { ?>
						<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" target="_blank">View</a>
						<?php }else { ?>
						<a style="width:100%;" class="btn btn-success" href="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" target="_blank">View</a>
						<?php } ?>
					</div><br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div>
							    
							     <?php if($branch_id =='57') { ?>
							<iframe src="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" width="100%" height="100%"></iframe>
							<?php }elseif($branch_id =='55') { ?>
					<iframe src="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" width="100%" height="100%"></iframe>
						<?php }else { ?>
					<iframe src="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" width="100%" height="100%"></iframe>
						<?php } ?>
						

							<div class="checkbox">
								  <label style="color:#000;"><input type="checkbox" value="1" name="agree_terms_two" <?php if($row->agree_terms_two == '1'){ echo "checked"; } ?>><b>I Agree to the Company Policies and Procedures Manual.</b></label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>
	  </div>
	  <?php if($row->job_desc != ""){ ?>
	  <div class="col-lg-6 col-md-12">
	      <div class="panel pn">
        			<div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;"><b>Job Description</b></h3>
			    	</div>
					<div class="col-md-2 job_desc_btn" style="text-align:right;padding-right:0px;">
						<a style="width:100%;margin-left:8px;" class="btn btn-success" href="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" target="_blank">View</a>
					<a style="width:100%;margin-left:8px;" class="btn btn-success" href="<?php echo base_url();?>index.php/admin/edit_employee_job_desc/<?php echo $row->emp_id; ?>">Edit</a>
					</div> <br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div >
							    <?php $file_parts = pathinfo($row->job_desc); 
							    if($file_parts['extension'] == 'pdf'){ ?>
							    
							<iframe src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" width="100%" height="100%"></iframe>
							
							      <?php }else { ?>
			<iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
				<!--<object src="<?php //echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"><embed src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"></embed></object>-->
      
							
								<?php } ?>
							<div class="checkbox">
								  <label style="color:#000;"><input type="checkbox" value="1" name="agree_terms_three" <?php if($row->agree_terms_three == '1'){ echo "checked"; } ?>><b>I Agree to the Job Descriptions Manual.</b></label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>
	  </div>
	  <?php } ?>
	</div>
  <?php } ?>
  
    <div class="btn-div col-md-3">
			<button type="submit" name="contact_submit" id="btn1" class="btn btn-success btn-ph savebtn">SAVE</button>
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
						<button type="button"  class="btn btn-success btn-ph">CANCEL</button>
					</a>
		</div>
   </div>
  </form>   
  
  
  
  <br>


<script>
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    $(document).ready(function($){
	   
       $('.btn-success').on('click',function(e) {            
               $(".loader").show();                      
            })   
      });
</script>
<script>

$('#save_exit').click(function(){
		var data1 = $('#myForm').serialize();
		console.log(data1);
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
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

