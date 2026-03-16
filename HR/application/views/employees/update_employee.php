
	<link rel="stylesheet" href="https://www.cafeadmin.com.au/HR/assets/css/employee_update.css">
	 <script type="text/javascript">	
		$(document).ready(function() {
			//$('#example').DataTable();
			$('#example').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		    
		$('input[name=resident_type]').on("change",function(){
		        console.log("vallll",$(this).val())
	  if($(this).val() == 'working_holiday'){
	      $(".countryOfOrigin").css("display","block");
	  }else{
	      $(".countryOfOrigin").css("display","none");
	      $("#origin_country").val('');
	  }
	})
	
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
		function validateForm() {
		   
		    var agree_terms_one=document.getElementById("agree_terms_one").value;
		    var agree_terms_two=document.getElementById("agree_terms_two").value;
		    var agree_terms_three=document.getElementById("agree_terms_three").value;
		    
		    
	
		 if((agree_terms_one.checked==false ))
         {
         alert("Please agree to the Staff Induction Manual.");
         return false;
         }
         if((agree_terms_two.checked==false))
         {
         alert("Please agree to the Company Policies and Procedures Manual.");
         return false;
         }
         if(( agree_terms_three.checked==false))
         {
         alert("Please agree to the Job Descriptions Manual.");
         return false;
         }
        
       
        
    //      	if($(".check_tfn_type ").val() == 'tfn_number' && $("#tfn_number").val() == ''){
	   //     alert('Please enter TFN number.');
	   //     $("#tfn_number_error").show();
	   //     return false;
	   // }else if($(".check_tfn_type ").val() == 'tfn_type' && !$('input[name=tfn_type]:checked').length > 0){
	   //      alert('Please choose correct TFN option.');
	   //      $("#tfn_type_error").show();
	   //     return false;
	   // }
		}
		
	
	    
	</script>
		<form  role="form" id="myForm" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_update_employee" enctype="multipart/form-data">

	<!--<form  role="form" id="myForm" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_update_employee" enctype="multipart/form-data" onsubmit="return validateForm()">-->
	<div  class="col-md-12 page-head page-head-sticky border-bottom btns-row">
		
			<span class="text-center">
				<h3>EMPLOYEE INDUCTION</h3>
			</span>
		<span class="extra_icons" style="float:right;">
		    <!--<input type="submit" value="SAVE" name="contact_submit"  class="btn btn-success btn-ph">&nbsp;-->
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">SAVE</button>&nbsp;
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
						<button type="button"  class="btn btn-success btn-ph btn-ph-cancel">CANCEL</button>
					</a>
		</span>
      
	</div>
	
	<div class="loader" style="display:none"></div>
<div class="container-fluid main-container">
	
		<?php if(null !==$this->session->userdata('error_msg')) { ?>  
				<div class='hideMe alert alert-danger'>
					<?php echo $this->session->flashdata('error_msg'); ?>
				</div>
				<?php } ?>
				
	<?php foreach($employee as $row){ ?>
  		<div class="row">
  			<div class="col-lg-12">
  			    <div class="tabs_wrapper">
                        <ul class="tabs">
                          <li class="active" rel="personalDetails">Personal Details</li>
                          <li rel="emergencyDetails">Emergency Details</li>
                          <li rel="generalInfo">General Info</li>
                          <li rel="postalAddress">Home Address</li>
                          <li rel="bankDetails">Bank Details</li>
                          <li rel="taxDetails">Tax Details</li>
                          <li rel="ploceDeductions">Police Check</li>
                          <li rel="requiredFile">Required File Uploads</li>
                          <li rel="medicalHistory">Medical History</li>
                          <li rel="vaccinationCertificate">Vaccination Certificate</li>
                          <li rel="trainingUndertaken">Training Undertaken</li>
                          <li rel="superAnnuation">Super Annuation</li>
                          <li rel="staffInductionManual">Staff Induction Manual</li>
                          <li rel="companyPolicies">Company Policies and Procedures</li>
                          <li rel="jobDescription">Job Description</li>
                          <?php    if($role =='admin' || $userID == '265'){ ?>
                         
                           <li rel="contractTab">Contract</li>
                          <?php }  ?>
                          <li rel="resumeTab">Resume</li>
                          <li rel="qualificationsTab">Qualifications</li>
                        </ul>
                        <div class="tab_container">
                          <h3 class="d_active tab_drawer_heading" rel="personalDetails">Personal Details</h3>
                          <div id="personalDetails" class="tab_content">
                          <h2>Personal Details</h2>
                            <div class="panel-body ct-form-in">
	          		
	          			<input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
	          			
	          			<div class="form-row">
						<div class="form-group col-md-2">
							<label for="title" class="control-label">Title:<span>*</span></label>
							  <select class="form-control" id="title" name="title">
							  	<option value="">Select</option>
							  	<option value="Dr" <?php if($row->title == 'Dr'){ echo "selected"; } ?>>Dr</option>
							  	<option value="Mr" <?php if($row->title == 'Mr'){ echo "selected"; } ?>>Mr</option>
							  	<option value="Ms" <?php if($row->title == 'Ms'){ echo "selected"; } ?>>Ms</option>
							  	<option value="Mrs" <?php if($row->title == 'Mrs'){ echo "selected"; } ?>>Mrs</option>
							  	<option value="Miss" <?php if($row->title == 'Miss'){ echo "selected"; } ?>>Miss</option>
							  </select>
						</div>
						<div class="form-group col-md-5" >
							<label for="first_name" class=" control-label">First Name:<span>*</span></label>
							<input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
						</div>
						<div class="form-group col-md-5" >
							<label for="last_name" class=" control-label">Last Name:<span>*</span></label>
							<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
						</div>
						</div>
						
						<div class="form-row">
					    <div class="form-group col-md-6" >
						<label for="email" class="control-label">Email Address:<span>*</span></label>
						<input type="text" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>">
						</div>
						
						 <div class="form-group col-md-6" >
						<label for="password" class="control-label">Password:</label>
					  <input type="text" class="form-control" id="password" name="password" value="" placeholder="*******">
						</div>
					
						</div>
							
							
							
						<div class="form-row">
						    
						    
						      <div class="form-group col-md-2" >
					     <label class="control-label" for="pin">Pin:<span>*</span></label>
                        <div class="input-group" style="border: 1px solid #d3d1d1 !important; display: table;">
                   	<input type="password" class="form-control" id="pin" name="pin" value="<?php echo $row->pin; ?>" placeholder="****" style="border: none !important;" >
                      <div class="input-group-addon">
      <i class="material-icons" onclick="view_pin(<?php echo $row->pin; ?>)" style="cursor: pointer;" title="View PIN">&#xe417;</i>
                       </div>

                       </div> 
						</div>
						
					
						
						
						<div class="form-group col-md-5" >
							<label for="businessname" class="control-label">Contact Number:<span>*</span></label>
						<input type="text" class="form-control" name="phone" onkeypress='validate(event)' value="<?php echo $row->phone; ?>" autocomplete="off" >
						</div>
						<div class="form-group col-md-5">
							<label for="businessname" class="control-label">Date of Birth:<span>*</span></label>
						<input type="date" class="form-control datetime"  value="<?php echo date('Y-m-d',strtotime($row->dob)); ?>" name="dob" autocomplete="off" >
						</div>
						</div>
						
						<?php if($role =='admin' || $role =='manager'){ $col="col-md-4";?>
							<div class="form-row">	
							<div class="form-group col-md-4">
							<label for="abn" class="control-label">Role:<span>*</span></label>
								<select name="role" class="form-control">
									<?php if(isset($roles) && !empty($roles)) { foreach($roles as $rolee) { ?>
									<?php  if($row->role == $rolee->role_id){ ?>
									<option selected="selected" value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
									<?php } else { ?>
									<option value="<?php echo $rolee->role_id; ?>"><?php echo $rolee->role_name; ?></option>
									<?php } }}else{ $col="col-md-4"; } ?>
									</select>
						</div>
						
						<div class="form-group <?php echo $col; ?>">
							<label for="businessname" class="control-label">Effective Start Date:<span>*</span></label>
							<input type="date" class="form-control datetime"  value="<?php if($row->effective_start_date != '00-00-0000'){ echo $row->effective_start_date; }else{ echo ""; } ?>" name="effective_start_date" autocomplete="off" >
						</div>

						<div class="form-group <?php echo $col; ?>">
							<label for="abn" class="control-label">Employee Type:<span>*</span></label>
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
						
						<?php    if($role =='admin' || $userID == '265'){ ?>
						
						<div class="form-row">	
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Hourly Rate:<span>*</span></label>
							<input type="text" class="form-control" name="rate" onkeypress='validate(event)' value="<?php echo $row->rate; ?>" autocomplete="off" >
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Saturday Rate:</label>
						   <input type="text" class="form-control" name="Saturday_rate"  value="<?php echo $row->Saturday_rate; ?>" autocomplete="off" >
						
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Sunday Rate:</label>
							<input type="text" class="form-control" name="Sunday_rate" value="<?php echo $row->Sunday_rate; ?>" autocomplete="off" >
						</div>
						</div>
						
						
						<div class="form-row">	
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Public Holiday Rate:</label>
							<input type="text" class="form-control" name="holiday_rate"  value="<?php echo $row->holiday_rate; ?>" autocomplete="off" >
						
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Uniform Allowance:</label>
							<input type="text" class="form-control" name="uniform_allowance"  value="<?php echo $row->uniform_allowance; ?>" autocomplete="off" >
							
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Early Start:</label>
							<input type="text" class="form-control" name="early_start"  value="<?php echo $row->early_start; ?>" autocomplete="off" >
						
						</div>
						</div>
							
							
							<div class="form-row">	
						<div class="form-group col-md-6">
							<label for="businessname" class="control-label">Late Night:</label>
							<input type="text" class="form-control" name="late_night"  value="<?php echo $row->late_night; ?>" autocomplete="off" >
							</div>
						</div>
						
							<?php } ?>
								</div>
								</div>
                      
                          <!-- #tab1 -->
                            
                          <h3 class="tab_drawer_heading" rel="emergencyDetails">Emergency Details</h3>
                          <div id="emergencyDetails" class="tab_content">
                          <h2>Emergency Details</h2>
                        <div class="panel-body">
                            	    
                       	<div class="form-row">	     	    
						<div class="form-group col-md-6">
						<label for="businessname" class="control-label">Name:</label>
						<input type="text" class="form-control" name="nextkin_name_two" value="<?php echo $row->nextkin_name_two; ?>" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
						<label for="businessname" class="control-label">Email Address:</label>
						<input type="text" class="form-control" name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
						</div>
						</div>
						
						<div class="form-row">	     
						<div class="form-group col-md-6">
						<label for="Phone No" class="control-label">Phone No:</label>
						<input type="text" class="form-control" name="nextkin_phone_no" value="<?php echo $row->nextkin_phone_no; ?>" autocomplete="off" >
						</div>
						
					  <div class="form-group col-md-6">
						<label for="businessname" class="control-label">Relationship:</label>
						<input type="text" class="form-control" name="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" autocomplete="off" >
						</div>
						</div>
						
					<!--<div class="form-row">-->
     <!--                  <div class="form-group col-md-6">-->
					<!--	<label for="businessname" class="control-label">Name:</label>-->
					<!--	<input type="text" class="form-control" name="nextkin_name_one" value="<?php echo $row->nextkin_name_one; ?>" autocomplete="off">-->
					<!--	</div>-->
						
					<!--	<div class="form-group col-md-6">-->
					<!--	<label for="businessname" class="control-label">Email Address:</label>-->
					<!--	<input type="text" class="form-control" name="nextkin_email_one" value="<?php echo $row->nextkin_email_one; ?>" autocomplete="off" >-->
					<!--	</div>-->
					<!--	</div>-->
						
						
						<div class="form-row">
    					
    						<div class="form-group col-md-6">
    						<label for="businessname" class="control-label">Street address:</label>
    						<input type="text" class="form-control" name="nextkin_street" value="<?php echo $row->nextkin_street; ?>" autocomplete="off">
    						</div>
    						  <div class="form-group col-md-6">
    						<label for="businessname" class="control-label">Town/Suburb:</label>
    						<input type="text" class="form-control" name="nextkin_suburb" value="<?php echo $row->nextkin_suburb; ?>" autocomplete="off" >
    						</div>
    						
					    </div>
					    <div class="form-row">
					      
    						<div class="form-group col-md-6">
    						<label for="businessname" class="control-label">State:</label>
    						<input type="text" class="form-control" name="nextkin_state" value="<?php echo $row->nextkin_state; ?>" autocomplete="off" >
    						</div>
    						
    							<div class="form-group col-md-6">
    						<label for="businessname" class="control-label">Postcode:</label>
    						<input type="text" class="form-control" name="nextkin_postcode" value="<?php echo $row->nextkin_postcode; ?>" autocomplete="off" >
    						</div>
    					</div>
    					<div class="form-row">
    					
    					
    					</div>
	          		</div>
                         </div>
                           
                          <!-- #tab2 -->
                          <h3 class="tab_drawer_heading" rel="generalInfo">General Info</h3>
                          <div id="generalInfo" class="tab_content">
                          <h2>General Info</h2>
                        <div class="panel-body">
                               
                        <div class="form-row">      
	          			<div class="form-group col-md-6">
						<label for="businessname" class="control-label">Visa Status:<span>*</span></label>
						<input type="text" class="form-control" name="visa_status" value="<?php echo $row->visa_status; ?>"  autocomplete="off">
						</div>
						
						<!--<div class="form-group col-md-6">-->
						<!--<label for="businessname" class="control-label">TFN Number:<span>*</span></label>-->
						<!--<input type="text" class="form-control" name="tfn_number" value="<?php if($row->tfn_number != '0') echo $row->tfn_number; ?>" autocomplete="off">-->
						<!--</div>-->
							</div>
							<!-- hide for emplouyeees -->
							<?php if($role =='admin' || $role =='manager'){ ?>

						<div class="form-row">
						    
	 <div class="form-group col-md-3">
        <label for="level1Intro" class="control-label">Intro Weekend:<span>*</span></label>
        <input type="radio" id="level1Intro" class="form-control" name="levelType" value="Intro Weekend" <?php if ($row->levelType == 'Intro Weekend') echo 'checked'; ?>>
    </div>					    
    <div class="form-group col-md-3">
        <label for="level1" class="control-label">Level 1 Weekends:<span>*</span></label>
        <input type="radio" id="level1" class="form-control" name="levelType" value="Level 1 Weekends" <?php if ($row->levelType == 'Level 1 Weekends') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="level2" class="control-label">Level 2 Weekends:<span>*</span></label>
        <input type="radio" id="level2" class="form-control" name="levelType" value="Level 2 Weekends" <?php if ($row->levelType == 'Level 2 Weekends') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="level3" class="control-label">Level 3 Weekends:<span>*</span></label>
        <input type="radio" id="level3" class="form-control" name="levelType" value="Level 3 Weekends" <?php if ($row->levelType == 'Level 3 Weekends') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="level4" class="control-label">Level 4 Weekends:<span>*</span></label>
        <input type="radio" id="level4" class="form-control" name="levelType" value="Level 4 Weekends" <?php if ($row->levelType == 'Level 4 Weekends') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="16level-1" class="control-label">16 Yrs Intro Weekend:<span>*</span></label>
        <input type="radio" id="16level-1" class="form-control" name="levelType" value="16 Yrs Intro Weekend" <?php if ($row->levelType == '16 Yrs Intro Weekend') echo 'checked'; ?>>
    </div>
    
    <div class="form-group col-md-3">
        <label for="16level-1weekend" class="control-label">16 Yrs Level 1 Weekend:<span>*</span></label>
        <input type="radio" id="16level-1weekend" class="form-control" name="levelType" value="16 Yrs Level 1 Weekend" <?php if ($row->levelType == '16 Yrs Level 1 Weekend') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="16level-2weekend" class="control-label">16 Yrs Level 2 Weekend:<span>*</span></label>
        <input type="radio" id="16level-2weekend" class="form-control" name="levelType" value="16 Yrs Level 2 Weekend" <?php if ($row->levelType == '16 Yrs Level 2 Weekend') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="17level-1weekend" class="control-label">17 Yrs Intro Weekend:<span>*</span></label>
        <input type="radio" id="17level-1weekend" class="form-control" name="levelType" value="17 Yrs Intro Weekend" <?php if ($row->levelType == '17 Yrs Intro Weekend') echo 'checked'; ?>>
    </div>
    
    <div class="form-group col-md-3">
        <label for="17level-1weekend" class="control-label">17 Yrs Level 1 Weekend:<span>*</span></label>
        <input type="radio" id="17level-1weekend" class="form-control" name="levelType" value="17 Yrs Level 1 Weekend" <?php if ($row->levelType == '17 Yrs Level 1 Weekend') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="17level-2weekend" class="control-label">17 Yrs Level 2 Weekend:<span>*</span></label>
        <input type="radio" id="17level-2weekend" class="form-control" name="levelType" value="17 Yrs Level 2 Weekend" <?php if ($row->levelType == '17 Yrs Level 2 Weekend') echo 'checked'; ?>>
    </div>
     <div class="form-group col-md-3">
        <label for="18level-1weekend" class="control-label">18 Yrs Intro Weekend:<span>*</span></label>
        <input type="radio" id="17level-1weekend" class="form-control" name="levelType" value="18 Yrs Intro Weekend" <?php if ($row->levelType == '18 Yrs Intro Weekend') echo 'checked'; ?>>
    </div>
    
    <div class="form-group col-md-3">
        <label for="18level-1weekend" class="control-label">18 Yrs Level 1 Weekend:<span>*</span></label>
        <input type="radio" id="17level-1weekend" class="form-control" name="levelType" value="18 Yrs Level 1 Weekend" <?php if ($row->levelType == '18 Yrs Level 1 Weekend') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="18level-2weekend" class="control-label">18 Yrs Level 2 Weekend:<span>*</span></label>
        <input type="radio" id="18level-2weekend" class="form-control" name="levelType" value="18 Yrs Level 2 Weekend" <?php if ($row->levelType == '18 Yrs Level 2 Weekend') echo 'checked'; ?>>
    </div>
    
    <div class="form-group col-md-3">
        <label for="19level-Iweekend" class="control-label">19 Yrs Intro Weekend:<span>*</span></label>
        <input type="radio" id="19level-Iweekend" class="form-control" name="levelType" value="19 Yrs Intro Weekend" <?php if ($row->levelType == '19 Yrs Intro Weekend') echo 'checked'; ?>>
    </div>
    
    <div class="form-group col-md-3">
        <label for="19level-1weekend" class="control-label">19 Yrs Level 1 Weekend:<span>*</span></label>
        <input type="radio" id="19level-1weekend" class="form-control" name="levelType" value="19 Yrs Level 1 Weekend" <?php if ($row->levelType == '19 Yrs Level 1 Weekend') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="19level-2weekend" class="control-label">19 Yrs Level 2 Weekend:<span>*</span></label>
        <input type="radio" id="19level-2weekend" class="form-control" name="levelType" value="19 Yrs Level 2 Weekend" <?php if ($row->levelType == '19 Yrs Level 2 Weekend') echo 'checked'; ?>>
    </div>
    

</div>
                        <h3>Public Holidays</h3><br></br>
                        <div class="form-row">
                            
    <div class="form-group col-md-3">
        <label for="iph" class="control-label">Intro Public Holiday:<span>*</span></label>
        <input type="radio" id="iph" class="form-control" name="phType" value="Intro Public Holiday" <?php if ($row->phType == 'Intro Public Holiday') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="l1ph" class="control-label">Level 1 Public Holiday:<span>*</span></label>
        <input type="radio" id="l1ph" class="form-control" name="phType" value="Level 1 Public Holiday" <?php if ($row->phType == 'Level 1 Public Holiday') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="l2ph" class="control-label">Level 2 Public Holiday:<span>*</span></label>
        <input type="radio" id="l2ph" class="form-control" name="phType" value="Level 2 Public Holiday" <?php if ($row->phType == 'Level 2 Public Holiday') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="l3ph" class="control-label">Level 3 Public Holiday:<span>*</span></label>
        <input type="radio" id="l3ph" class="form-control" name="phType" value="Level 3 Public Holiday" <?php if ($row->phType == 'Level 3 Public Holiday') echo 'checked'; ?>>
    </div>
    <div class="form-group col-md-3">
        <label for="l4ph" class="control-label">Level 4 Public Holiday:<span>*</span></label>
        <input type="radio" id="l4ph" class="form-control" name="phType" value="Level 4 Public Holiday" <?php if ($row->phType == 'Level 4 Public Holiday') echo 'checked'; ?>>
    </div>
    
     <div class="form-group col-md-3">
        <label for="l4ph" class="control-label">Level 4 Public Holiday:<span>*</span></label>
        <input type="radio" id="l4ph" class="form-control" name="phType" value="Level 4 Public Holiday" <?php if ($row->phType == 'Level 4 Public Holiday') echo 'checked'; ?>>
    </div>
    
    <?php 
    
    $years = [
    "16 Yrs Intro PH",
    "16 Yrs Level 1 PH",
    "16 Yrs Level 2 PH",
    "17 Yrs Intro PH",
    "17 Yrs Level 1 PH",
    "17 Yrs Level 2 PH",
    "18 Yrs Intro PH",
    "18 Yrs Level 1 PH",
    "18 Yrs Level 2 PH",
    "19 Yrs Level Intro PH",
    "19 Yrs Level 1 PH",
    "19 Yrs Level 2 PH"
];

 foreach ($years as $year){ ?>
            <div class="form-group col-md-3">
                <label for="<?= str_replace(' ', '', $year) ?>" class="control-label"><?= $year ?>:<span>*</span></label>
                <input type="radio" id="<?= str_replace(' ', '', $year) ?>" class="form-control" name="phType" value="<?= $year ?>" <?php if ($row->phType == $year) echo 'checked'; ?>>
            </div>
    <?php  } ?>
    
   
</div>
						<?php }  ?>
		<!-- hide for emplouyeees -->				
						
						 <div class="form-row">
						<div class="form-group col-md-12">
							<label for="businessname" class="control-label">Highest Academic Achievements: </label>
							<textarea class="form-control" rows="5" name="heighest_acd_achmts"><?php echo $row->heighest_acd_achmts; ?></textarea>
						</div>
							</div>
						
						
						 <div class="form-row">
						     <div class="form-group col-md-12" style="margin-bottom:0 !important">
							<label for="businessname" class="control-label">Last 2 Previous Employments History:</label>
							</div>
						<div class="form-group col-md-6">
							
							<textarea class="form-control" rows="5" name="pre_emp_hstry_one" value="<?php echo $row->pre_emp_hstry_one; ?>" ><?php echo $row->pre_emp_hstry_one; ?></textarea><br>
						</div>
						<div class="form-group col-md-6">
							<textarea class="form-control" rows="5" name="pre_emp_hstry_two" value="<?php echo $row->pre_emp_hstry_two; ?>"><?php echo $row->pre_emp_hstry_two; ?></textarea><br>
						</div>
						</div>
						
	          		</div>
                          </div>
                          <!-- #tab3 -->
                          <h3 class="tab_drawer_heading" rel="postalAddress">Home Address</h3>
                          <div id="postalAddress" class="tab_content">
                          <h2>Home Address</h2>
                            <div class="panel-body">
                                
						 <div class="form-row">      
	          			<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Unit Number:<span>*</span></label>
							<input type="text" class="form-control" name="unit_number" value="<?php echo $row->unit_number; ?>" autocomplete="off">
						</div>
				
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Street Name:<span>*</span></label>
							<input type="text" class="form-control" name="street_name" value="<?php echo $row->street_name; ?>"  autocomplete="off" >
						
						</div>
					
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Street Number:<span>*</span></label>
							<input type="text" class="form-control" name="street" value="<?php echo $row->street; ?>"  autocomplete="off" >
						</div>
						</div>
						
						
						 <div class="form-row">      
	          			<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Suburb:<span>*</span></label>
							<input type="text" class="form-control" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Postcode:<span>*</span></label>
							<input type="text" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
						</div>
						
					<div class="form-group col-md-4">
							<label for="businessname" class="control-label">State:<span>*</span></label>
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
                          <!-- #tab4 --> 
                            <h3 class="tab_drawer_heading" rel="bankDetails">Bank Details</h3>
                          <div id="bankDetails" class="tab_content">
                          <h2>Bank Details</h2>
                           	<div class="panel-body">
					<div class="row">
					  <div class="col-md-12">
					  <h5>Account No 1</h5>
					     <div class="row">
						    <div class="col-lg-6 col-md-12">
							   <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_1" value="<?php echo $row->bank_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB:</label>
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
							<label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name:</label>
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
							<label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_2" value="<?php echo $row->bank_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB:</label>
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
							<label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_2" value="<?php echo $row->bank_branch_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_2" value="<?php echo $row->account_no_2; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name:</label>
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
							<label for="businessname" class="col-sm-4 control-label">Bank Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_3" value="<?php echo $row->bank_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">BSB:</label>
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
							<label for="businessname" class="col-sm-4 control-label">Branch Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="bank_branch_3" value="<?php echo $row->bank_branch_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account No:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_no_3" value="<?php echo $row->account_no_3; ?>" autocomplete="off">
							</div>
						  </div>
						  <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Account Name:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="account_name_3" value="<?php echo $row->account_name_3; ?>" autocomplete="off">
							</div>
						  </div>
							</div>
						 </div>
					  </div>
					  <div class="col-md-12">
					   I hereby authorize to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. I hereby agree not to hold responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.
					   </div>
					</div>						
	          		</div>
                          </div>
                           <!-- #tax tab --> 
                           <h3 class="tab_drawer_heading" rel="taxDetails">Tax Details</h3>
                          <div id="taxDetails" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Tax Declaration</h2>
                                <div class="section-wrap">
                               	     <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <script>
						                            function openThisTab(evt, selected_value,fieldname) {
                                                          // Declare all variables
                                                          var i, tabcontent, tablinks;
                                                        
                                                          // Get all elements with class="tabcontent" and hide them
                                                          tabcontent = document.getElementsByClassName("tabcontent_"+fieldname);
                                                          for (i = 0; i < tabcontent.length; i++) {
                                                            tabcontent[i].style.display = "none";
                                                          }
                                                        
                                                          // Get all elements with class="tablinks" and remove the class "active"
                                                          tablinks = document.getElementsByClassName("tablinks_"+fieldname);
                                                          for (i = 0; i < tablinks.length; i++) {
                                                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                                                          }
                                                        
                                                          // Show the current tab, and add an "active" class to the button that opened the tab
                                                          document.getElementById(selected_value).style.display = "block";
                                                          if(selected_value == 'No'){
                                                              $('.check_tfn_type').val('tfn_type');
                                                          }
                                                          else{
                                                              $('.check_tfn_type').val('tfn_number');
                                                          }
                                                          if(selected_value == 'noChanged'){
                                                              $('#previous_surname').val(selected_value);
                                                          }
                                                          if(selected_value == 'noChanged' || selected_value == 'yesChanged'){
                                                                $('.previous_surname_changed').val(selected_value);
                                                          }
                                                          document.getElementById(selected_value).style.display = "block";
                                                          evt.currentTarget.className += " active";
                                                       }
						                            </script>
						                            
						                            
						                            <p>Do Employee have TFN?</p>
						                            
						                            <div class="tab">
                                          <a class="tablinks tablinks_tfn <?php if($row->tfn_number != '0') echo 'active' ?>" onclick="openThisTab(event, 'Yes','tfn')">Yes</a>
                                          <a class="tablinks tablinks_tfn <?php if($row->tfn_number == '0') echo 'active' ?>" onclick="openThisTab(event, 'No','tfn')">No</a>
                                        
                                        </div>
                                        
                                        <!-- Tab content -->
                                        <div id="Yes" class="tabcontent tabcontent_tfn" style="display:<?php if($row->tfn_number != '0') echo 'block' ?>">
                                         <div class="form-row">	     	    
                    						<div class="form-group col-md-6">
                    						<label for="businessname" class="control-label">Enter Tax File Number:</label>
                    						<input type="text" class="form-control" id="tfn_number" name="tfn_number" value="<?php  echo $row->tfn_number; ?>" autocomplete="off">
                    						</div>
                    							</div>
                                       <input type="hidden" value="tfn_number" name="check_tfn_type" class="check_tfn_type">
                                        </div>
                                        
                                        <div id="No" class="tabcontent tabcontent_tfn"  style="display:<?php if($row->tfn_number == '0') echo 'block' ?>">
                                           <label><input type="radio" value="pendingTFN" name="tfn_type" <?php if($row->tfn_type == 'pendingTFN') echo 'checked' ?>> TFN is pending</label><br>
                                        <label><input type="radio" value="noTFN" name="tfn_type" <?php if($row->tfn_type == 'noTFN') echo 'checked' ?>> under 18 and don't have a TFN</label><br>
                                         <label><input type="radio" value="quotingTFN" name="tfn_type" <?php if($row->tfn_type == 'quotingTFN') echo 'checked' ?>> have an exemption from quoting a TFN (such as receiving a social security or service pension)</label>
                                        
                                        </div>
                                        </div>
                        						
						            </div> 
						            </div>
						            <div class="section-wrap">
						            <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>Have Employee changed his/her surname since you last dealt with the Australian Tax Office?</p>
						                            
						                             <div class="tab">
                                          <a class="tablinks tablinks_surname <?php if($row->have_surname_changed == 'yesChanged') echo 'active' ?>" onclick="openThisTab(event, 'yesChanged','surname')">Yes</a>
                                          <a class="tablinks tablinks_surname <?php if($row->have_surname_changed == 'noChanged') echo 'active' ?>" onclick="openThisTab(event, 'noChanged','surname')">No</a>
                                        
                                        </div>
                                        
                                        <!-- Tab content -->
                                        <div id="yesChanged" class="tabcontent tabcontent_surname" style="display:<?php if($row->have_surname_changed == 'yesChanged') echo 'block' ?>">
                                         <div class="form-row">	     	    
                    						<div class="form-group col-md-6">
                    						<label for="businessname" class="control-label">Enter Previous Surname:</label>
                    						<input type="text" class="form-control" id="previous_surname" name="previous_surname" value="<?php if($row->previous_surname != 'noChanged') echo $row->previous_surname; ?>" autocomplete="off">
                    					    
                    						</div>
                    							</div>
  
                                        </div>
                                        
                                        <div id="noChanged" class="tabcontent tabcontent_surname" style="display:<?php if($row->have_surname_changed == 'noChanged') echo 'block' ?>">
                                         
                                        </div>

                                        <input type="hidden" value="<?php echo $row->have_surname_changed; ?>" name="have_surname_changed" class="previous_surname_changed">
                                         </div>
                        						
						            </div> 
						            </div>
						            <div class="section-wrap">
						            <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>Are Employee an Australian resident for tax purposes or a working holiday maker?</p>
                        							<label><input type="radio" value="australian" name="resident_type" <?php if($row->resident_type == 'australian') echo 'checked' ?>> Australian resident for tax purposes</label><br>
                        							<label><input type="radio" value="foreign" name="resident_type" <?php if($row->resident_type == 'foreign') echo 'checked' ?>> Foreign resident</label><br>
                        							<label><input type="radio" value="working_holiday" name="resident_type" <?php if($row->resident_type == 'working_holiday') echo 'checked' ?>> Working holiday maker</label>
                            						
                        						</div>
                        						<?php  if($row->origin_country !='') { ?>
                        					<div class="form-group col-md-6 countryOfOrigin">
                                        						<label for="origin_country" class="control-label">Native Country:</label>
                                        						<input type="text" class="form-control" id="origin_country" name="origin_country" value="<?php echo $row->origin_country; ?>" autocomplete="off">
                                        			
                                        		</div>	
                                        		<?php }else{ ?>
                                        		<div class="form-group col-md-6 countryOfOrigin" style="display:none">
                                        			<label for="origin_country" class="control-label">Native Country:</label>
                                        			<input type="text" class="form-control" id="origin_country" name="origin_country"  autocomplete="off">
                                        		</div>	
                                        		<?php } ?>
						            </div>
						            </div>
						            <div class="section-wrap">
						            <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>Do Employee have any of the following outstanding debts or loans?</p>
						                            
                        							<label><input type="radio" value="higher_education" name="loan_type" <?php if($row->loan_type == 'higher_education') echo 'checked' ?>> Higher Education Loan Program (HELP)</label><br>
                        							<label><input type="radio" value="vet_student" name="loan_type" <?php if($row->loan_type == 'vet_student') echo 'checked' ?>> VET Student Loan (VSL)</label><br>
                        							<label><input type="radio" value="financial_supplement" name="loan_type" <?php if($row->loan_type == 'financial_supplement') echo 'checked' ?>> Financial Supplement (FS)</label><br>
                        							<label><input type="radio" value="student_loan" name="loan_type" <?php if($row->loan_type == 'student_loan') echo 'checked' ?>> Student Start-up Loan (SSL)</label><br>
                        							<label><input type="radio" value="trade_loan" name="loan_type" <?php if($row->loan_type == 'trade_loan') echo 'checked' ?>> Trade Support Loan (TSL)</label>
                            						
                        						</div>
                        						
						            </div>
						            </div>
						            <div class="section-wrap">
						            <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>Would Employee like to claim the tax-free threshold from this payer?</p>
						                            
                        							<label><input type="radio" value="yes" name="claim_tax_free" <?php if($row->claim_tax_free == 'yes') echo 'checked' ?>> Yes</label>
                        							<label><input type="radio" value="no" name="claim_tax_free" <?php if($row->claim_tax_free == 'no') echo 'checked' ?>> No</label>
                        						</div>
                        						
						            </div>
						            </div>
						            <div class="section-wrap">
						            <div class="form-row">
						                        <div class="checkbox-group col-md-12" >
						                            <p>On what basis are paid?</p>
						                            
                        							<label><input type="radio" value="full_time" name="job_type" <?php if($row->job_type == 'full_time') echo 'checked' ?>> Full-time</label><br>
                        							<label><input type="radio" value="part_time" name="job_type" <?php if($row->job_type == 'part_time') echo 'checked' ?>> Part-time</label><br>
                        							<label><input type="radio" value="labour_hire" name="job_type" <?php if($row->job_type == 'labour_hire') echo 'checked' ?>> Labour Hire</label><br>
                        							<label><input type="radio" value="superannuation" name="job_type" <?php if($row->job_type == 'superannuation') echo 'checked' ?>> Superannuation or annuity income stream</label><br>
                        							<label><input type="radio" value="casual" name="job_type" <?php if($row->job_type == 'casual') echo 'checked' ?>> Casual</label>
                            						
                        						</div>
                        						
						            </div>
						            </div>
						            
						          <div class="section-wrap"> 
						          <div class="form-row">
						            <p>Upload Tax File</p>
								<input type="file" class="form-control-file" name="taxFile" value="<?php if((isset($row->taxFile)) && ($row->taxFile !='')) { echo $row->taxFile;  } ?>">
								<?php 
							if((isset($row->taxFile)) && ($row->taxFile !='') && (file_exists("./uploaded_files/".$row->taxFile))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->taxFile; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
								</div>
                    			</div>
                            </div>
                          
                           <!-- #tab5 --> 
                            <h3 class="tab_drawer_heading" rel="ploceDeductions">Police Check</h3>
                          <div id="ploceDeductions" class="tab_content">
                          <h2>Police Check</h2>
                          <div class="panel-body">
                              
                              
					 <!--<div class="form-row">      -->
	     <!--     			<div class="form-group col-md-6">-->
						<!--	<label for="businessname" class="control-label">Entity:</label>-->
						<!--	<input type="text" class="form-control" name="entity" value="<?php echo $row->entity; ?>" autocomplete="off" >-->
						<!--</div>-->
						<!--<div class="form-group col-md-6">-->
						<!--	<label for="businessname" class="control-label">Last Name:</label>-->
						<!--	<input type="text" class="form-control" name="police_surname" value="<?php echo $row->police_surname; ?>" autocomplete="off" >-->
						<!--</div>-->
						<!--</div>-->
						
						
					<!--<div class="form-row">      -->
	    <!--      			<div class="form-group col-md-6">-->
					<!--		<label for="businessname" class="control-label">Given Name(s):</label>-->
					<!--		<input type="text" class="form-control" name="given_name" value="<?php echo $row->given_name; ?>" autocomplete="off" >-->
					<!--	</div>-->
						
					<!--	<div class="form-group col-md-6">-->
					<!--		<label for="businessname" class="control-label">Postal Address:</label>-->
					<!--		<input type="text" class="form-control" name="address" value="<?php echo $row->address; ?>" autocomplete="off" >-->
					<!--	</div>-->
					<!--</div>-->
						
						
						<!--<div class="form-group text-center">-->
						<!--	<label for="businessname" class="col-sm-4 control-label"></label>-->
						<!--	<div class="col-sm-8">-->
						<!--		(OR)-->
						<!--	</div>-->
						<!--</div>-->
						<hr>
						<!--<div class="col-sm-12 text-center">-->
						<!--		<p>I hereby authorize Zouki Group, to deduct an total amount of $32.00 from the next pay for the National Name Check conducted by the Victorian Police Department</p>-->
						<!--	</div>-->
					
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload Certificate</label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control-file" name="police" value="<?php if((isset($row->police_certificate)) && ($row->police_certificate !='')) { echo $row->police_certificate;  } ?>">
								<?php 
							if((isset($row->police_certificate)) && ($row->police_certificate !='') && (file_exists("./uploaded_files/".$row->police_certificate))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->police_certificate; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
						</div>
	          		       </div>
                          </div>
                           <!-- #tab6 --> 
                            <h3 class="tab_drawer_heading" rel="requiredFile">Required File Uploads</h3>
                          <div id="requiredFile" class="tab_content">
                          <h2>Required File Uploads</h2>
                          		<div class="panel-body">
                          		<div class="form-row">      
	          			<div class="form-group col-md-6">
							<label for="businessname" class="control-label">Advice of Tax File Number to Superannuation Fund:</label>
							<input type="file" class="form-control-file" name="advice_of_tax_file">
							<?php 
							if((isset($row->advice_of_tax_file)) && ($row->advice_of_tax_file !='') && (file_exists("./uploaded_files/".$row->advice_of_tax_file))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn bbtn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->advice_of_tax_file; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>	
						
						</div>
						<div class="form-group col-md-6">
							<label for="businessname" class="control-label">Quality Assurance/Food Safety Handling Certificate:</label>
							<input type="file" class="form-control-file" name="quality_assurance">
						<?php 
							if((isset($row->quality_assurance)) && ($row->quality_assurance !='') && (file_exists("./uploaded_files/".$row->quality_assurance))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->quality_assurance; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>		
						
						</div>
							</div>
						
						
						
						
	          		</div>
                          </div>
                           <!-- #tab7 --> 
                            <h3 class="tab_drawer_heading" rel="medicalHistory">Medical History</h3>
                          <div id="medicalHistory" class="tab_content">
                          <h2>Medical History</h2>
                          	<div class="panel-body">
        						<div class="form-group">
        							<div class="col-sm-12">
        								<b>Please provide details of any medical conditions that may affect your ability to perform your role.</b>
        							</div>
        						</div>
        						<div class="form-group">
        							<div class="col-sm-12">
        								<textarea type="text" class="form-control" name="medical_history" value="<?php echo $row->medical_history; ?>" rows="4"><?php echo $row->medical_history; ?></textarea>
        							</div>
        						</div>
        	          		</div>
                          </div>
                           <!-- #tab8 --> 
                            <h3 class="tab_drawer_heading" rel="vaccinationCertificate">Vaccination Certificate</h3>
                          <div id="vaccinationCertificate" class="tab_content">
                          <h2>Vaccination Certificate</h2>
                          	<div class="panel-body">
                			  	<div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Vaccination Certificate: </label>
                							<div class="col-sm-8">
                								<input type="file" class="form-control-file" name="vaccination_certificate">
                						<?php 
                							if((isset($row->vaccination_certificate)) && ($row->vaccination_certificate !='') && (file_exists("./uploaded_files/".$row->vaccination_certificate))) {  ?>
                							<div class="col-md-2" style="text-align:right;padding-right:0px;">
                						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->vaccination_certificate; ?>" target="_blank">View</a>
                					       </div> 
                					       <?php } ?>		
                							</div>
                						</div>
                			  	</div>
                          </div>
                           <!-- #tab9 --> 
                            <h3 class="tab_drawer_heading" rel="trainingUndertaken">Training Undertaken</h3>
                          <div id="trainingUndertaken" class="tab_content">
                          <h2>Training Undertaken</h2>
                          <div class="panel-body">
                              
        				<div class="form-row">      
	          			<div class="form-group col-md-6">
        				<label for="businessname" class="control-label">Fire/Emergency Training Completed Date:</label>
        				<input type="date" class="form-control datetime"  name="fire_emg_completed_date" value="<?php echo $row->fire_emg_completed_date; ?>" autocomplete="off">
        				</div>
        						
        			<div class="form-group col-md-6">
        				<label for="businessname" class="control-label">OH&S Training Completition Date:</label>
        				<input type="date" class="form-control datetime" name="oh_s_completed_date" value="<?php echo $row->oh_s_completed_date; ?>" autocomplete="off">
        			</div>
        			</div>
        			
        			
        			
        			
        					<div class="form-row">      
	          			<div class="form-group col-md-6">
        				<label for="businessname" class="control-label">Food Safety Supervisor – Training completed date:</label>
        				<input type="date" class="form-control datetime"  name="food_safety_completed_date" value="<?php echo $row->food_safety_completed_date; ?>" autocomplete="off">
        				</div>
        						
        			<div class="form-group col-md-6">
        				<label for="businessname" class="control-label">Food Handling Training – Training Completed Date:</label>
        				<input type="date" class="form-control datetime" name="food_handling_completed_date" value="<?php echo $row->food_handling_completed_date; ?>" autocomplete="off">
        			</div>
        			</div>
        			
        			
        			
        			
        			</div>
                </div>
                           <!-- #tab10 --> 
                           
                           <!-- #tab6 --> 
                            <h3 class="tab_drawer_heading" rel="superAnnuation">Super Annuation</h3>
                          <div id="superAnnuation" class="tab_content">
                      
                          <div class="panel-body">
                                 
                                  	<!--<a style="float:right;" class="btn btn-dark" href="https://www.cafeadmin.com.au/HR/assets/pdf/Superannuation.pdf" target="_blank">View Super Annuation Form</a>-->
            				        <h2>Super Annuation</h2>
            				        	
            				        <div class="section-wrap">
            				          <!--  <h3>Section A</h3>-->
            				          <!--  	<div class="form-row">-->
						                    <!--    <div class="checkbox-group col-md-12" >-->
						                    <!--        <p>Choice of superannuation (super) fund</p>-->
						                    <!--        <span>I request that all my future super contributions be paid to: (place an X in one of the boxes below)</span>-->
                        		<!--					<label>The APRA fund or retirement savings account (RSA) I nominate <input type="radio" value="apra_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'apra_fund') echo 'checked'; ?>> Complete items 2, 3 and 5</label>-->
                        		<!--					<label>The self-managed super fund (SMSF) I nominate <input type="radio" value="self_managed_fund" name="choice_super_fund" <?php if($row->choice_super_fund == 'self_managed_fund') echo 'checked'; ?>> Complete items 2, 4 and 5</label>-->
                        		<!--					<label>The super fund nominated by my employer (in section B) <input type="radio" value="fund_nom_emp" name="choice_super_fund" <?php if($row->choice_super_fund == 'fund_nom_emp') echo 'checked'; ?>> Complete items 2 and 5</label>-->
                            						
                        		<!--				</div>-->
                        						
						                    <!--</div>-->
						                    <div class="form-row">
						                        <div class="col-md-12" >
						                            <p>Your details</p>
						                            
                        						</div>
                        						<?php if( $row->nominatedByEmployer == 1) {  ?>
                        						<div class="form-group col-md-12" >
                        						<label style="color:#000;">
                        						    <input type="checkbox" id="nominatedByEmployer" class="form-control" name="nominatedByEmployer" value="<?php echo $row->nominatedByEmployer; ?>" checked="<?php echo ($row->nominatedByEmployer == 1 ? 'checked' : ''); ?> " >
                        						    The super fund nominated by my employer.
                        						    <span>*</span></label>
                        						</div>
                        						<?php } ?>
                        						<div class="form-group col-md-4" >
                        							<label for="name" class=" control-label">Name:<span>*</span></label>
                        							<input type="text" id="pdf_name" class="form-control" name="pdf_first_name" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_name_error"></span>
                        						</div>
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_name_error" class=" control-label">Employee identification number (if applicable)</label>
                        							<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_emp_id_no" value="<?php echo $row->pdf_emp_id_no; ?>" autocomplete="off" >
                        						    
                        						</div>
                        						<!--<div class="form-group col-md-4" >-->
                        						<!--	<label for="pdf_tax_file_number" class=" control-label">Tax file number (TFN)</label>-->
                        						<!--	<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_tax_file_number" value="<?php echo $row->pdf_tax_file_number; ?>" autocomplete="off" >-->
                        						    
                        						<!--</div>-->
						                    </div>
						                    <div class="form-row">
						                    <!--    <div class="col-md-12" >-->
						                    <!--        <p>Nominating your APRA fund or RSA</p>-->
						                    <!--        <span>You will need current details from your APRA regulated fund or RSA to complete this item. To do this you can contact your fund or RSA directly, or you can view your fund or RSA account details by logging into ATO online services via the ATO app or through myGov and selecting Super</span>-->
                        		<!--				</div>-->
                        						<div class="form-group col-md-4" >
                        							<label for="name" class=" control-label">Fund ABN</label>
                        							<input type="text" id="pdf_name" class="form-control" name="pdf_apra_fund_abh" value="<?php echo $row->pdf_apra_fund_abh; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_name_error"></span>
                        						</div>
                        						<div class="form-group col-md-8" >
                        							<label for="pdf_name_error" class=" control-label">Fund name</label>
                        							<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_apra_fund_name" value="<?php echo $row->pdf_apra_fund_name; ?>" autocomplete="off" >
                        						    
                        						</div>
                        						 </div>
                        		<!--				<div class="form-group col-md-12" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund address</label>-->
                        		<!--					<textarea id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_address" autocomplete="off" ><?php echo $row->pdf_apra_fund_address; ?></textarea>-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Suburb/town</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_town" value="<?php echo $row->pdf_apra_fund_town; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">State/territory</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_state" value="<?php echo $row->pdf_apra_fund_state; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Postcode</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_postcode" value="<?php echo $row->pdf_apra_fund_postcode; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund phone</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_phone" value="<?php echo $row->pdf_apra_fund_phone; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<div class="form-row">
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_tax_file_number" class=" control-label">Unique superannuation identifier (USI)</label>
                        							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_usi" value="<?php echo $row->pdf_apra_fund_usi; ?>" autocomplete="off" >
                        						    
                        						</div>
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Your account name (if applicable)</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_acc_no" value="<?php echo $row->pdf_apra_fund_acc_no; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_tax_file_number" class=" control-label">Your member number (if applicable)</label>
                        							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_apra_fund_member_no" value="<?php echo $row->pdf_apra_fund_member_no; ?>" autocomplete="off" >
                        						    
                        						</div>
						                    </div> 
						                    	</div>
						                    <!--<div class="form-row">-->
						                    <!--    <div class="col-md-12" >-->
						                    <!--        <p>Nominating your self-managed super fund (SMSF)</p>-->
						                    <!--        <span>You will need current details from your SMSF trustee to complete this item.</span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="name" class=" control-label">Fund ABN</label>-->
                        		<!--					<input type="text" id="pdf_name" class="form-control" name="pdf_self_fund" value="<?php echo $row->pdf_self_fund; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_name_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-8" >-->
                        		<!--					<label for="pdf_name_error" class=" control-label">Fund name</label>-->
                        		<!--					<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_self_fund_name" value="<?php echo $row->pdf_self_fund_name; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-12" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund address</label>-->
                        		<!--					<textarea id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_address" autocomplete="off" ><?php echo $row->pdf_self_fund_address; ?></textarea>-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Suburb/town</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_town" value="<?php echo $row->pdf_self_fund_town; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">State/territory</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_state" value="<?php echo $row->pdf_self_fund_state; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Postcode</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_postcode" value="<?php echo $row->pdf_self_fund_postcode; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund phone</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_phone" value="<?php echo $row->pdf_self_fund_phone; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-12" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund electronic service address (ESA)</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_esa" value="<?php echo $row->pdf_self_fund_esa; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Fund bank account name</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bank_acc_no" value="<?php echo $row->pdf_self_fund_bank_acc_no; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">BSB code (please include all six numbers)</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_bsb_code" value="<?php echo $row->pdf_self_fund_bsb_code; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Account number</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_acc_no" value="<?php echo $row->pdf_self_fund_acc_no; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="col-md-12" >-->
						                    <!--        <p>Required documentation</p>-->
						                            
                        		<!--				</div>-->
                        		<!--				<div class="checkbox-group col-md-12" >-->
						                           
                        		<!--					<label for="smsf_agree"><input type="checkbox" value="1" id="smsf_agree" name="" <?php if($row->smsf_agree == '1') echo 'checked'; ?>> I am the trustee, or a director of the corporate trustee of the SMSF and I declare that the SMSF will accept contributions from my employer</label>-->
                          <!--  						<span class="fieldError" id="smsf_agree_error"></span> -->
                        		<!--				</div>-->
						                    <!--</div>-->
						                    <!--<div class="form-row">-->
						                    <!--    <div class="col-md-12" >-->
						                    <!--        <p>Signature and date</p>-->
						                    <!--        <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        		<!--				</div>-->
                        		<!--				<div class="checkbox-group col-md-12" >-->
						                           
                        		<!--					<label><input type="checkbox" value="1" name="" <?php if($row->is_attached_rel_doc == '1') echo 'checked'; ?>> I have attached the relevant documentation.</label>-->
                            						
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-8" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Signature</label>-->
                        		<!--					<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_sign" value="<?php echo $row->pdf_self_fund_sign; ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_tax_file_number" class=" control-label">Date</label>-->
                        		<!--					<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_self_fund_date" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_self_fund_date)); } else { echo ''; } ?>" autocomplete="off" >-->
                        						    
                        		<!--				</div>-->
						                    <!--</div>-->
            				        </div>
            				        <!--<div class="section-wrap">-->
            				        <!--    <h3>Section B</h3>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Your details</p>-->
						                  <!--          <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Business name</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_business_name" value="<?php echo $row->pdf_business_name; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">ABN</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_abn" value="<?php echo $row->pdf_abn; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-8" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Signature</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_signture" value="<?php echo $row->pdf_signture; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-4" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Date</label>-->
                        <!--							<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_sign_date" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_sign_date)); } else { echo ''; } ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Your nominated super fund</p>-->
						                  <!--          <span>If an employee does not choose their own super fund, and the ATO has advised the employee does not have a stapled super fund (for new employees from 1 November 2021), you can meet your SG obligations by paying super guarantee contributions on their behalf to the fund you have nominated below or another fund that meets the choice requirements:</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Super fund name</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_name" value="<?php echo $row->pdf_super_fund_name; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Unique superannuation identifier (USI)</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_usi" value="<?php echo $row->pdf_super_fund_usi; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Phone (for the product disclosure statement for this fund)</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_super_fund_phone" value="<?php echo $row->pdf_super_fund_phone; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Super fund website address</label>-->
                        <!--							<input type="text" id="pdf_tax_file_number" class="form-control" name="pdf_fund_website_address" value="<?php echo $row->pdf_fund_website_address; ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--</div>-->
            				        <!--<div class="section-wrap">-->
            				        <!--    <h3>Section C</h3>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Record of choice acceptance</p>-->
						                  <!--          <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Date employee’s choice is received</label>-->
                        <!--							<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_date_emp_choice" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_date_emp_choice)); } else { echo ''; } ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_tax_file_number" class=" control-label">Date you act on your employee’s choice</label>-->
                        <!--							<input type="date" id="pdf_tax_file_number" class="form-control" name="pdf_date_act" value="<?php if($row->pdf_sign_date != '0000-00-00'){ echo date('d-m-Y',strtotime($row->pdf_date_act)); } else { echo ''; } ?>" autocomplete="off" >-->
                        						    
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--</div>-->
            				        
                    			</div>
                           
                            
                            <h3 class="tab_drawer_heading" rel="staffInductionManual">Staff Induction Manual</h3>
                          <div id="staffInductionManual" class="tab_content">
                          <h2>Staff Induction Manual</h2>
                        <div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
                					      <?php if($branch_id =='57') { ?>
                						<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" target="_blank">View</a>
                							<?php }elseif($branch_id =='55') { ?>
                							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" target="_blank">View</a>
                							<?php } elseif($branch_id =='69' || $branch_id =='70') { ?>
                							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_tarator.pdf" target="_blank">View</a>
                							<?php }  elseif($branch_id =='72') { ?>
                							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/AlloBeirutinduction_all.pdf" target="_blank">View</a>
                							<?php } else { ?>
                							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" target="_blank">View</a>
                							<?php } ?>
                							
                					</div>
                	   <div class="panel-body">
                						<div class="form-group">
                							<div style="height:400px;width:100%;">
                							      <?php if($branch_id =='57') { ?>
                							<iframe src="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" width="100%" height="100%"></iframe>
                								<?php }elseif($branch_id =='55') { ?>
                								<iframe src="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" width="100%" height="100%"></iframe>
                								<?php }elseif($branch_id =='69' || $branch_id =='70') { ?>
                								<iframe src="<?php echo base_url();?>assets/terms_docs/induction_tarator.pdf" width="100%" height="100%"></iframe>
                								<?php } elseif($branch_id =='72') { ?>
                									<iframe src="<?php echo base_url();?>assets/terms_docs/AlloBeirutinduction_all.pdf" width="100%" height="100%"></iframe>

                							<?php } else { ?>
                									<iframe src="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" width="100%" height="100%"></iframe>
                										<?php } ?>
                							<div class="checkbox" style="margin-top: 22px;">
                								  <label style="color:#000;padding: 23px;color:#000;font-size: 16px;"><input type="checkbox"   id="agree_terms_one" value="1" name="agree_terms_one" <?php if($row->agree_terms_one == '1'){ echo "checked"; } ?>>I read, understood and agree to the Staff Induction Manual.</label>
                							</div>
                							</div>	
                						</div>
                						
                	          		</div>
                            </div>
                           <!-- #tab11 --> 
                            <h3 class="tab_drawer_heading" rel="companyPolicies">Company Policies and Procedures</h3>
                     <div id="companyPolicies" class="tab_content">
    <h2>Company Policies and Procedures</h2>
    
    <div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
        <?php if($branch_id == '57') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } elseif($branch_id == '55') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } elseif($branch_id == '72') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/AlloBeirutPolicyProcedures.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } elseif($branch_id == '53') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_redbean.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } elseif($branch_id == '69' || $branch_id == '70') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_tarator.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } elseif($branch_id == '56' || $branch_id == '59' || $branch_id == '54' || $branch_id == '58') { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/ZoukiPolicyProcedures.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } else { ?>
            <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" target="_blank">View Policy</a>
            <a style="width:100%; margin-top: 5px;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" target="_blank">View Fair Work</a>
        <?php } ?>
    </div>
    
    <div class="panel-body">
        <div class="form-group">
            <div style="height:100%;width:100%;overflow-y:auto;">
                <?php if($branch_id == '57') { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } elseif($branch_id == '55') { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } elseif($branch_id ==  '72') { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/AlloBeirutPolicyProcedures.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } elseif($branch_id == '69' || $branch_id == '70') { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_tarator.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } elseif($branch_id == '56' || $branch_id == '59' || $branch_id == '54' || $branch_id == '58') { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/ZoukiPolicyProcedures.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } else { ?>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" width="100%" height="600px"></iframe>
                    <iframe src="<?php echo base_url();?>assets/terms_docs/Fair-Work-Information-Statement.pdf" width="100%" height="600px" style="margin-top: 10px;"></iframe>
                <?php } ?>
                <div class="checkbox" style="margin-top: 22px;">
                    <label style="color:#000;padding: 23px;color:#000;font-size: 16px;">
                        <input type="checkbox" value="1" id="agree_terms_two" name="agree_terms_two" <?php if(isset($row->agree_terms_two) && $row->agree_terms_two == '1'){ echo "checked"; } ?>>I read, understood and agree to the Company Policies and Procedures Manual.
                    </label>
                </div>
                <div class="checkbox" style="margin-top: 22px;">
                    <label style="color:#000;padding: 23px;color:#000;font-size: 16px;">
                        <input type="checkbox" value="1" id="agree_terms_fairwork" name="agree_terms_fairwork" <?php if(isset($row->agree_terms_fairwork) && $row->agree_terms_fairwork == '1'){ echo "checked"; } ?>>I read, understood and agree to the Fair Work Information.
                    </label>
                </div>
            </div>	
        </div>
    </div>
</div>
                           <!-- #tab12 --> 
                            <h3 class="tab_drawer_heading" rel="jobDescription">Job Description</h3>
                          <div id="jobDescription" class="tab_content">
                           <?php if($row->job_desc != ""){ ?>
                          <h2>Job Description</h2>
                          
            					<div class="col-md-2 job_desc_btn btn-position" style="text-align:right;padding-right:0px;">
            						<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" target="_blank">View</a>
            					<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>index.php/admin/edit_employee_job_desc/<?php echo $row->emp_id; ?>">Edit</a>
            					</div> 
            	          		<div class="panel-body">
            						<div class="form-group">
            							<div style="height:400px;width:100%;">
            							    <?php $file_parts = pathinfo($row->job_desc); 
            							    if($file_parts['extension'] == 'pdf'){ ?>
            							    
            							<iframe src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" width="100%" height="100%"></iframe>
            							
            							      <?php }else { ?>
            			<iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
            				<!--<object src="<?php //echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"><embed src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"></embed></object>-->
                  
            							
            								<?php } ?>
            							<div class="checkbox" style="margin-top: 22px;">
            								  <label style="color:#000;padding: 23px;color:#000;font-size: 16px;"><input type="checkbox" value="1"   id="agree_terms_three" name="agree_terms_three" <?php if($row->agree_terms_three == '1'){ echo "checked"; } ?>>I read, understood and agree to the Job Descriptions Manual.</label>
            							</div>
            							</div>	
            						</div>
            						
            	          		</div>
            	          		<?php } ?>
                           </div>
                           
                           <?php    if($role =='admin' || $userID == '265'){ ?>
                           <h3 class="tab_drawer_heading" rel="contractTab">Contract File</h3>
                          <div id="contractTab" class="tab_content">
                          <h2>Contract</h2>
                          <div class="panel-body">
						<div class="form-group">
							
							<div class="col-sm-8">
								<input type="file" class="form-control-file" name="contractfile" value="<?php if((isset($row->contractfile)) && ($row->contractfile !='')) { echo $row->contractfile;  } ?>">
								<?php 
							if((isset($row->contractfile)) && ($row->contractfile !='') && (file_exists("./uploaded_files/".$row->contractfile))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->contractfile; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
						</div>
	          		       </div>
                          </div>
                           <?php  } ?>
                           
                           <h3 class="tab_drawer_heading" rel="resumeTab">Resume</h3>
                          <div id="resumeTab" class="tab_content">
                          <h2>Resume</h2>
                          <div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload Resume</label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control-file" name="resume" value="<?php if((isset($row->resume)) && ($row->resume !='')) { echo $row->resume;  } ?>">
								<?php 
							if((isset($row->resume)) && ($row->resume !='') && (file_exists("./uploaded_files/".$row->resume))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->resume; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
						</div>
	          		       </div>
                          </div>
                          
                          <h3 class="tab_drawer_heading" rel="qualificationsTab">Qualifications </h3>
                          <div id="qualificationsTab" class="tab_content">
                          <h2>Qualifications</h2>
                          <div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload Qualifications Documents</label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control-file" name="qualifications" value="<?php if((isset($row->qualifications)) && ($row->qualifications !='')) { echo $row->qualifications;  } ?>">
								<?php 
							if((isset($row->qualifications)) && ($row->qualifications !='') && (file_exists("./uploaded_files/".$row->qualifications))) {  ?>
							<div class="col-md-2" style="text-align:right;padding-right:0px;">
						   <a style="margin-top:4px;padding: 5px 20px;" class="btn btn-dark" href="<?php echo base_url();?>uploaded_files/<?php echo $row->qualifications; ?>" target="_blank">View</a>
					       </div> 
					       <?php } ?>
								
							</div>
						</div>
	          		       </div>
                          </div>
                           
                           <br>
                           <div class="btn-div col-md-3">
                    			<button type="submit" name="contact_submit" id="btn1" class="btn btn-success btn-ph savebtn">SAVE</button>
                    					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
                    						<button type="button"  class="btn btn-success btn-ph">CANCEL</button>
                    					</a>
                    		</div>
                        </div>
                        <!-- .tab_container -->
                        </div>
  			</div>
  			<!--tab design end-->
        
	    
	    	
	</div>
	

  <?php } ?>
  
    
   </div>
  </form>   
  
  
  
  <br>


<script>
function view_pin(pin){
    console.log(pin);
    var pinType = $('#pin').attr('type');
    if(pinType == "password"){
        $('#pin').attr('type','text');
    }else{
         $('#pin').attr('type','password');
    }
    // if($("[name='pin']").val() == ''){
    //   $("[name='pin']").val(pin);  
    // }else{
    //   $("[name='pin']").val('');  
    // }
    
}
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    $(document).ready(function($){
	   
    //   $('.btn-success').on('click',function(e) {            
    //           $(".loader").show();                      
    //         })   
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

<script>
     // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    /*$(".tabs").css("margin-top", function(){ 
       return ($(".tab_container").outerHeight() - $(".tabs").outerHeight() ) / 2;
    });*/
    });
    $(".tab_container").css("min-height", function(){ 
      return $(".tabs").outerHeight() + 50;
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	/* Extra class "tab_last" 
	   to add border to bottom side
	   of last tab 
	$('ul.tabs li').last().addClass("tab_last");*/
	
</script>
