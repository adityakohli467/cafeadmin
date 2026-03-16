<div class="row item">
			</div>
		<?php if(isset($details[0]->Incident_Report_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Incident_Report" enctype="multipart/form-data">
	<?php } else {?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Incident_Report" enctype="multipart/form-data">

	<?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>INCIDENT REPORT</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title" style="text-align: center;"><b>Incident Report Details</b></h3>
			        </div>
	          		<div class="panel-body ct-form-in">
	          			<h3 class="panel-title">The incident resulted in : </h3>
	          			<div class="ct-form-in">
	          				<div class="form-row">
	          			<div class="col-sm-3">
					<label class="radio-inline">
					 <input type="checkbox" value="injury" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="injury" ? 'checked' : '')?>> Injury to an individual
					 </label>
                      </div>
                      	<div class="col-sm-3">
                      <label class="radio-inline">
                      <input type="checkbox" value="damage" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="damage" ? 'checked' : '')?>> Damage to property
                      </label>
                      </div>
                      	<div class=" col-sm-3">
                      <label class="radio-inline">
                      <input type="checkbox" value="other" name="incident_effected_to" <?php echo  ($details[0]->incident_effected_to =="other" ? 'checked' : '')?>> other
                      </label>
                      </div>
						</div>
				</div>
						</br>
					<h3 class="panel-title">Personal details (of injured):	 : </h3>
						
						<div class="form-row">
						<div class="form-group col-md-2">
							<label for="businessname" class="col-lg-3 control-label">Surname:</label>
						
						<input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
							<input type="hidden" name= "Incident_Report_id" value="<?php if(isset($details[0]->Incident_Report_id)){ echo $details[0]->Incident_Report_id; } ?>">
							<input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">	
								<input type="text" class="form-control" name="surname" autocomplete="off" value="<?php if(isset($details[0]->surname)){ echo $details[0]->surname; } ?>">
							
						</div>
						
						<div class="form-group col-md-5">
							<label for="businessname" class="col-lg-2 control-label">First name:</label>
						
						<input type="text" class="form-control" name="firstname" autocomplete="off" value="<?php if(isset($details[0]->firstname)){ echo $details[0]->firstname; } ?>">
							
						</div>
						
							<div class="form-group col-md-4">
							<label for="businessname" class="col-lg-2 control-label">Initial:</label>
							
						<input type="text" class="form-control" name="initial" autocomplete="off" value="<?php if(isset($details[0]->initial)){ echo $details[0]->initial; } ?>">
							
						</div>
							</div>
							
							
							
							<div class="form-row">
							<div class="form-group col-md-5">
							<label for="businessname" class="col-lg-2 control-label">Address:</label>
						<input type="text" class="form-control" name="address" autocomplete="off" value="<?php if(isset($details[0]->address)){ echo $details[0]->address; } ?>">
						</div>
							<div class="form-group col-md-4">
							<label for="businessname" class="col-lg-2 control-label">Postcode:</label>
						<input type="text" class="form-control" name="postcode" autocomplete="off" value="<?php if(isset($details[0]->postcode)){ echo $details[0]->postcode; } ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="dob" class="col-lg-4 control-label"> Date of birth:<span>*</span></label>
				         <input type="date" class="form-control datetime"  name="dob"  autocomplete="off" required  value="<?php if(isset($details[0]->dob)){ echo $details[0]->dob; } ?>">
						</div>
							</div>



						
					<h3 class="panel-title">Gender : </h3>	
						<div class="form-row">
						<div class="form-group col-sm-4">
					<label class="radio-inline">
					 <input type="checkbox" value="male" name="gender" <?php echo  ($details[0]->gender =="male" ? 'checked' : '')?>> Male</label>
					 </div>
					 	<div class="form-group col-sm-4">
                      <label class="radio-inline">
                      <input type="checkbox" value="female" name="gender" <?php echo  ($details[0]->gender =="female" ? 'checked' : '')?>> Female	
                      </label>
                      	</div>
					</div>
						
						<h3 class="panel-title">Type : </h3>
						<div class="form-row">
						<div class="form-group col-sm-4">
					<label class="radio-inline">
					 <input type="checkbox" value="staff" name="incident_by" <?php echo  ($details[0]->incident_by =="staff" ? 'checked' : '')?> > Staff member</label>
					 </div>
					 	<div class="form-group col-sm-4">
                      <label class="radio-inline">
                      <input type="checkbox" value="customer" name="incident_by" <?php echo  ($details[0]->incident_by =="customer" ? 'checked' : '')?>> Customer	
                      </label>
                      </div>
                      	<div class="form-group col-sm-4">
                      <label class="radio-inline">
                      <input type="checkbox" value="other" name="incident_by" <?php echo  ($details[0]->incident_by =="other" ? 'checked' : '')?>> Other
                      </label>
					</div>
						</div>	
						
						
				<h3 class="panel-title">Incident details: </h3>	
				<div class="form-row">
				    	<div class="form-group col-md-6">
					<label for="abn" class="col-lg-4 control-label">Time incident occurred:<span>*</span></label>
					<div class="col-lg-2  input-group date datetimepicker3">
					<span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                    </span>
					<input type="text" class="form-control" name="incident_time" style="z-index: 1 !important;" autocomplete="off" required value="<?php if(isset($details[0]->incident_time)){ echo $details[0]->incident_time; } ?>">
					</div>
					</div>
					
				<div class="form-group col-md-6">
				<label for="businessname" class="col-lg-4  control-label"> Date incident occurred:<span>*</span></label>
				<input type="date" class="form-control datetime"  name="incident_date"  autocomplete="off" required  value="<?php if(isset($details[0]->incident_date)){ echo $details[0]->incident_date; } ?>">
				</div>
						
				
                   </div>
                   
                   
                   
                   
                   	<div class="form-row">
					<div class="form-group col-md-6">
					<label for="abn" class="col-lg-4  control-label">Where did the incident occur? (Please specify)</label>
                    <textarea  class="form-control" name="incident_place" rows="4" cols="80" ><?php if(isset($details[0]->incident_place)){ echo $details[0]->incident_place; } ?></textarea>
					</div>
					
					<div class="form-group col-md-6">
					<label for="incident_detail" class="col-lg-5  control-label"> What was the nature of, and injury resulting from, this incident? </br><small>(Please explain in your own words what had happened)</small> </label>
				    <textarea  class="form-control" name="incident_detail" rows="4" cols="80" ><?php if(isset($details[0]->incident_detail)){ echo $details[0]->incident_detail; } ?></textarea>
				   </div>
					</div>   
					
						   
					<h3 class="panel-title">Were there any witnesses? : </h3>
					<div class="form-row">
					<div class="form-group col-md-2">
					<label class="radio-inline">
					 <input type="checkbox" value="yes" name="is_witness" <?php echo  ($details[0]->is_witness =="yes" ? 'checked' : '')?>> Yes</label>
					 </div>	<div class="form-group col-md-2">
                      <label class="radio-inline">
                      <input type="checkbox" value="no" name="is_witness" <?php echo  ($details[0]->is_witness =="no" ? 'checked' : '')?>>No
                      </label>
					
				</div>
				<div class="form-group col-md-4">
				<label for="witness_name" class="col-lg-4 control-label">Name of witness/es:</label>
				<input type="text" class="form-control" name="witness_name" autocomplete="off" value="<?php if(isset($details[0]->witness_name)){ echo $details[0]->witness_name; } ?>">
				</div>
						
				<div class="form-group col-md-4">
				<label for="witness_position" class="col-lg-2 control-label">Position:</label>
				<input type="text" class="form-control" name="witness_position" autocomplete="off" value="<?php if(isset($details[0]->witness_position)){ echo $details[0]->witness_position; } ?>">
				</div>
				</div>
						
						
						
					<div class="form-row">
					<div class="form-group col-md-4">
					<label for="witness_contact" class="col-lg-4  control-label">Contact details:</label>
					<input type="text" class="form-control" name="witness_contact" autocomplete="off" value="<?php if(isset($details[0]->witness_contact)){ echo $details[0]->witness_contact; } ?>">
				</div>
				<div class="form-group col-md-4">
				<label for="witness_Address" class="col-lg-2 control-label">Address:</label>
			<input type="text" class="form-control" name="witness_Address" autocomplete="off" value="<?php if(isset($details[0]->witness_Address)){ echo $details[0]->witness_Address; } ?>">
			</div>
				<div class="form-group col-md-4">
				<label for="witness_postcode" class="col-lg-2  control-label">Postcode:</label>
				<input type="text" class="form-control" name="witness_postcode" autocomplete="off" value="<?php if(isset($details[0]->witness_postcode)){ echo $details[0]->witness_postcode; } ?>">
			</div>
			</div>
						
						
							<div class="form-row">
							<div class="form-group col-md-6">
						<label for="person_reporting_incident_sign" class="col-lg-5 control-label">Signature of person completing report:</label>
						<input type="text" class="form-control" name="person_reporting_incident_sign" autocomplete="off" value="<?php if(isset($details[0]->person_reporting_incident_sign)){ echo $details[0]->person_reporting_incident_sign; } ?>">
						</div>
						<div class="form-group col-md-6">
						<label for="person_reporting_incident" class="col-lg-5  control-label">Name of person completing report:</label>
						<input type="text" class="form-control" name="person_completing_report_name" autocomplete="off" value="<?php if(isset($details[0]->person_completing_report_name)){ echo $details[0]->person_completing_report_name; } ?>">
						</div>
						
						<div class="form-group col-md-2">
						<label for="report_complete_signtaure_date" class="col-lg-2 control-label"> Date :<span>*</span></label>
				         <input type="date" class="form-control datetime"  name="report_complete_signtaure_date"  autocomplete="off" required  value="<?php if(isset($details[0]->report_complete_signtaure_date)){ echo $details[0]->report_complete_signtaure_date; } ?>">
						</div>
						</div>
							
							
							
						<h3 class="panel-title">Has the hazard/incident been acknowledged by management? </h3>
							<div class="form-row">
						   <div class="checkbox form-group col-md-4">
					<label class="radio-inline">
					 <input type="checkbox" value="yes" name="is_acknowdledeged"  <?php echo  ($details[0]->is_acknowdledeged =="yes" ? 'checked' : '')?> > Yes</label>
                      <label class="radio-inline">
                      <input type="checkbox" value="no" name="is_acknowdledeged" <?php echo ($details[0]->is_acknowdledeged =="no" ? 'checked' : '')?> >No
                      </label>
					</div>
					
					<div class="form-group col-md-8">
							<label for="action_to_take" class="col-lg-5 control-label">Describe what has been done to resolve the hazard/incident:</label>
				           <input type="text" class="form-control"  name="action_to_take"  autocomplete="off" value="<?php if(isset($details[0]->action_to_take)){ echo $details[0]->action_to_take; } ?>">
						   </div>
						    </div>
						  
						<h3 class="panel-title">A copy of this report is be forwarded to your supervisor immediately.</h3>
					
							<div class="form-row">
						<div class="form-group col-md-5">
						<label for="comment" class="col-lg-4 control-label">Supervisor’s comments</label>
                        <input type="text" class="form-control" name="supervisor_comments" <?php echo ($role=='employee') ? 'disabled' : '' ?> value="<?php if(isset($details[0]->supervisor_comments)){ echo $details[0]->supervisor_comments; } ?>" >
						</div>
						<div class="form-group col-md-4">
						<label for="manager_sign" class="col-lg-4 control-label">Supervisor’s signature:</label>
                        <input type="text" class="form-control" name="supervisor_sign" "<?php echo ($role=='employee') ? 'disabled' : '' ?> value="<?php if(isset($details[0]->supervisor_sign)){ echo $details[0]->supervisor_sign; } ?>" >
						</div>
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-3 control-label">Date:</label>
				         <input type="date" class="form-control datetime"  name="supervisor_sign_date" <?php echo ($role=='employee') ? 'disabled' : '' ?>  autocomplete="off" value="<?php if(isset($details[0]->supervisor_sign_date)){ echo $details[0]->supervisor_sign_date; } ?>">
						</div>
						</div>
							
							<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Incident_Report">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		</div>
			</div>
						
	          		</div>
        	
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
    
     $(document).ready(function(){
             $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
             
              
            });
    
</script>

	<style>
 	label.error, label>span{
 		color:red;
 	}
 	.validation_text p{
 	 color: red;
    font-size: 15px;
    font-weight: 600;
 	}
    </style>
</body>
</html>
