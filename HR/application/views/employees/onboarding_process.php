<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>HRM - ONBOARDING</title>
  <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>">
  <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
      <!--header menu design -->
   <link rel="stylesheet" href="<?php echo base_url('assets/menu_design/css/bootstrap.min.css'); ?>">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/menu_design/fonts/icomoon/style.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/menu_design/css/owl.carousel.min.css'); ?>">
 <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/menu_design/css/style.css'); ?>">
    
    <!--end menu design -->   
 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
 
    

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css'); ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.min.css'); ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/perfect-scrollbar.css'); ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/util.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
  
   <!-- script file for fingerprint-->
  <script src="<?php echo base_url('assets/js/scripts/CloudABIS-ScanR.js'); ?>"></script>
  <!--<script src="assets/js/scripts/CloudABIS-Helper.js"></script>-->
    
    
  <!--====-->
    <script src="<?php echo base_url('assets/js/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.validation.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/handleCounter.js'); ?>"></script>
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dropzone.css'); ?>">
  <script type="text/javascript" src="<?php echo base_url('assets/js/dropzone.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/app.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/onboarding.css'); ?>">
  
  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  
  
  <!--<script src="vendor/jquery/jquery-3.2.1.min.js"></script>-->
<!--===============================================================================================-->
  <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>

<!--===============================================================================================-->
  <script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
    <div class="overlayplaceorder" id='overlayplaceorder'></div>
	<style>
    .tab_drawer_heading {
        opacity: 0.2; 
        cursor: not-allowed;
        pointer-events:none;
    }
    .tab_drawer_heading.d_active,
    .tab_drawer_heading.prev{
        opacity: 1;
        cursor: pointer;
        pointer-events: unset;
    }
    .tab_drawer_heading{
        background-color:#000;
    }
    .tab_drawer_heading:hover {
          background: #4caf50;
    	}
    	.d_active {
    		background: #4caf50;
    }
	</style>
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

	<div  class="col-md-12 page-head page-head-sticky border-bottom btns-row">
		
			<span class="text-center">
				<h3>onboarding</h3>
			</span>
		
      
	</div>
	
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
                          <li class="prev active" rel="personalDetails"><span class="material-icons">perm_identity</span> Personal Details</li>
                          <li rel="emergencyDetails"><span class="material-icons">perm_phone_msg</span> Emergency details</li>
                          <li rel="bankDetails"><span class="material-icons">account_balance</span> Bank Details</li>
                          <li rel="taxDetails"><span class="material-icons">attach_money</span> Tax Details</li>
                          <li rel="taxForm"><span class="material-icons">attach_money</span> Tax Form</li>
                          <li rel="superAnnuation"><span class="material-icons">insert_drive_file</span> Super Annuation</li>
                          <li rel="policeClearance"><span class="material-icons">grain</span> Police Clearance</li>
                          <li rel="privacyPolicy"><span class="material-icons">lock_outline</span>  Policies</li>
                          <li rel="resumeTab"><span class="material-icons">lock_outline</span>  Resume</li>
                          <li rel="qualificationsTab"><span class="material-icons">lock_outline</span>  Qualifications</li>
                          
                        </ul>
                        <div class="tab_container">
                          <h3 class="prev d_active tab_drawer_heading" rel="personalDetails"><span class="material-icons">perm_identity</span>Personal Details</h3>
                          <div id="personalDetails" class="tab_content">
                         
                            <div class="panel-body ct-form-in">
                	          		 <h2>Personal Details</h2>
                	          		 	<form  role="form" id="personalDetailsForm" method="post" action="" enctype="multipart/form-data">
                	          			<input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                	          			
                	          			<div class="form-row">
                						<div class="form-group col-md-2">
                							<label for="title" class="control-label">Title:<span>*</span></label>
                							  <select class="form-control" id="title" name="title">
                							  	<option value="">Select</option>
                							  	<option value="Mr" <?php if($row->title == 'Mr') echo'selected';?>>Mr</option>
                							  	<option value="Ms" <?php if($row->title == 'Ms') echo'selected';?>>Ms</option>
                							  	<option value="Mrs" <?php if($row->title == 'Mrs') echo'selected';?>>Mrs</option>
                							  	<option value="Miss" <?php if($row->title == 'Miss') echo'selected';?>>Miss</option>
                							  </select>
                							  <span class="fieldError" id="title_error"></span>
                						</div>
                						<div class="form-group col-md-5" >
                							<label for="first_name" class=" control-label">First Name:<span>*</span></label>
                							<input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $row->first_name; ?>" autocomplete="off" >
                						    <span class="fieldError" id="first_name_error"></span>
                						</div>
                						<div class="form-group col-md-5" >
                							<label for="last_name" class=" control-label">Last Name:<span>*</span></label>
                							<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row->last_name; ?>" autocomplete="off" >
                						    <span class="fieldError" id="last_name_error"></span>
                						</div>
                						</div>
                						
                						<div class="form-row">
                    					    <div class="form-group col-md-4" >
                    						<label for="email" class="control-label">Email Address:<span>*</span></label>
                    						<input type="text" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>">
                    						<span class="fieldError" id="email_error"></span>
                    						</div>
                    						<div class="form-group col-md-4" >
                    							<label for="phone" class="control-label">Contact Number:<span>*</span></label>
                    						    <input type="text" class="form-control" id="phone" name="phone" onkeypress='validate(event)' autocomplete="off" value="<?php echo $row->phone; ?>">
                    						    <span class="fieldError" id="phone_error"></span>
                    						</div>
                						    <div class="form-group col-md-4">
                    							<label for="dob" class="control-label">Date of Birth:<span>*</span></label>
                    					    	<input type="date" class="form-control datetime" id="dob" name="dob" autocomplete="off" value="<?php echo $row->dob; ?>">
                    						    <span class="fieldError" id="dob_error"></span>
                    						</div>
                					  
                						</div>
                						
                						<div class="form-row">
                						    <div class="form-group col-md-12">
                    							<label for="businessname" class="control-label">Highest Academic Achievements: </label>
                    							<textarea class="form-control" rows="5" name="heighest_acd_achmts"><?php echo $row->heighest_acd_achmts; ?></textarea>
                    						</div>
                						</div>
                					
                          <h2>Home Address</h2>
                            <div class="panel-body">
                                
						 <div class="form-row">      
	          			<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Unit Number:<span>*</span></label>
							<input type="text" class="form-control" id="unit_number" name="unit_number" value="<?php echo $row->unit_number; ?>" autocomplete="off">
							 <span class="fieldError" id="Unit_error"></span>
						</div>
				
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Street Name:<span>*</span></label>
							<input type="text" class="form-control" id="street_name" name="street_name" value="<?php echo $row->street_name; ?>"  autocomplete="off" >
							 <span class="fieldError" id="streetname_error"></span>
						
						</div>
					
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Street Number:<span>*</span></label>
							<input type="text" class="form-control" id="street" name="street" value="<?php echo $row->street; ?>"  autocomplete="off" >
								 <span class="fieldError" id="street_error"></span>
						</div>
						</div>
						
						
						 <div class="form-row">      
	          			<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Suburb:<span>*</span></label>
							<input type="text" class="form-control"  id="suburb" name="suburb" value="<?php echo $row->suburb; ?>" autocomplete="off" >
								 <span class="fieldError" id="suburb_error"></span>
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="control-label">Postcode:<span>*</span></label>
							<input type="text" id="postcode" class="form-control" name="postcode" onkeypress='validate(event)' value="<?php if($row->postcode != "0"){ echo $row->postcode; }else{ echo ""; }  ?>" autocomplete="off" maxlength="4">
							 <span class="fieldError" id="postcode_error"></span>
						</div>
						
					<div class="form-group col-md-4">
							<label for="businessname" class="control-label">State:<span>*</span></label>
							 <span class="fieldError" id="state_error"></span>
							<select class="form-control" name="state" id="state">
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
                         
                						
                						<!--button-->
                							<input type="button" rel="emergencyDetails" name="contact_submit" id="save_continue_personal" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
								</div>
								</div>
                      
                          <!-- #tab2 -->
                            
                          <h3 class="tab_drawer_heading" id="mb-emergencyDetails" rel="emergencyDetails"><span class="material-icons">perm_phone_msg</span>Emergency Details</h3>
                          <div id="emergencyDetails" class="tab_content">
                          
                        <div class="panel-body">
                            
                            	    <h2>Emergency Details</h2>
                            	    <form  role="form" id="emergencyDetailsForm" method="post" action="" enctype="multipart/form-data">
                            	        <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                                           	<div class="form-row">	     	    
                    						<div class="form-group col-md-6">
                    						<label for="businessname" class="control-label ">Name:<span>*</span></label>
                    						<input type="text" id="nextkin_name_two" class="form-control required" value="<?php echo $row->nextkin_name_two; ?>" name="nextkin_name_two" autocomplete="off">
                    						<span class="fieldError" id="nextkin_name_two_error"></span>
                    						</div>
                    						<div class="form-group col-md-6">
                    						<label for="businessname"   class="control-label ">Relationship:<span>*</span></label>
                    						<input type="text" class="form-control required"  id="nextkin_relationship_two" value="<?php echo $row->nextkin_relationship_two; ?>" name="nextkin_relationship_two" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_relationship_two_error"></span>
                    						</div>
                    						<div class="form-group col-md-6">
                    						<label for="businessname" class="control-label">Email Address:</label>
                    						<input type="text" class="form-control " name="nextkin_email_two" value="<?php echo $row->nextkin_email_two; ?>" autocomplete="off" >
                    						
                    						</div>
                    							     
                    						<div class="form-group col-md-6">
                    						<label for="Phone No"  class="control-label ">Phone No:<span>*</span></label>
                    						<input type="text" id="nextkin_phone_no" class="form-control required" value="<?php echo $row->nextkin_phone_no; ?>" name="nextkin_phone_no" autocomplete="off" >
                    							<span class="fieldError" id="nextkin_phone_no_error"></span>
                    						</div>
                    						
                    					  
                    						</div>
                    						
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
                    					
                    					<!--button-->
                							<input type="button" rel="bankDetails" name="contact_submit" id="save_continue_emergency" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
	          		</div>
                         </div>
                           
                         
                          <!-- #tab 3--> 
                            <h3 class="tab_drawer_heading" id="mb-bankDetails" rel="bankDetails"><span class="material-icons">account_balance</span>Bank Details</h3>
                          <div id="bankDetails" class="tab_content">
                         
                           	<div class="panel-body"> 
                           	<h2>Bank Details</h2>
                           	<form  role="form" id="bankDetailsForm" method="post" action="" enctype="multipart/form-data">
                           	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                					<div class="row">
                					  <div class="col-md-12">
                					  <h5>Account No 1</h5>
                					     <div class="row">
                						    <div class="col-lg-6 col-md-12">
                							   <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Bank Name:<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="bank_1" class="form-control required" value="<?php echo $row->bank_1; ?>" name="bank_1" autocomplete="off">
                								<span class="fieldError" id="bank_1_error"></span>
                							</div>
                						  </div>
                						  <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">BSB:<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="bsb_1" class="form-control required" name="bsb_1" value="<?php echo $row->bsb_1; ?>" autocomplete="off">
                								<span class="fieldError" id="bsb_1_error"></span>
                							</div>
                						  </div>
                						  <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">% to Deposit<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="percentage_1" class="form-control required" name="percentage_1" value="<?php echo $row->percentage_1; ?>" autocomplete="off">
                								<span class="fieldError" id="percentage_1_error"></span>
                							</div>
                						  </div>
                							</div>
                							<div class="col-lg-6 col-md-12">
                							   <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Branch Name:<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="bank_branch_1" class="form-control required" name="bank_branch_1" value="<?php echo $row->bank_branch_1; ?>" autocomplete="off">
                								<span class="fieldError" id="bank_branch_1_error"></span>
                							</div>
                						  </div>
                						  <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Account No:<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="account_no_1" class="form-control required" name="account_no_1" value="<?php echo $row->account_no_1; ?>" autocomplete="off">
                								<span class="fieldError" id="account_no_1_error"></span>
                							</div>
                						  </div>
                						  <div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Account Name:<span>*<span></label>
                							<div class="col-sm-8">
                								<input type="text" id="account_name_1" class="form-control required" name="account_name_1" value="<?php echo $row->account_name_1; ?>" autocomplete="off">
                								<span class="fieldError" id="account_name_1_error"></span>
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
                					      <?php 
                					      
                					      if($row->branch_id == 55){
                					        $location='RPA PTY LTD ';
                					      }
                					      else if($row->branch_id == 53){
                					          $location='Lionshare Pty Ltd.';
                					      }
                					      else if($row->branch_id == 57){
                					          $location='Ipswich Holdings';
                					      }
                					      else{
                					          $location='Zouki ';
                					      }
                					      
                					      ?>
                					    I hereby authorize to initiate automatic deposits for my fortnightly wages to my bank account(s) as detailed above and also authorise for adjustments to be deducted from my wage in the event that a payment is made in error. I hereby agree not to hold responsible for any delay or loss of funds due to incorrect or incomplete information supplied by me or by my financial institution authorise for any bank charges incurred as a result of incorrect information, closed accounts, etc to be debited from my wage. This agreement will remain in effect until I provide written notice of cancellation from me or my financial institution, or until update the new banking details.  </div>
                					</div>	
                					
                					<!--button-->
                							<input type="button" rel="taxDetails" name="contact_submit" id="save_continue_bank" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
	          		</div>
                          </div>
                          
                          
                           
                           <!-- #tab4--> 
                            <h3 class="tab_drawer_heading" id="mb-taxDetails" rel="taxDetails"><span class="material-icons">attach_money</span>Tax Details</h3>
                          <div id="taxDetails" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Tax Declaration</h2>
                               	<form  role="form" id="taxDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
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
                                                          if(selected_value == 'NoSuper'){
                                                              $('.check_super_type').val('no');
                                                          }else{
                                                              $('.check_super_type').val('yes');
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
						                            
						                            
						                            <p>Do you have your TFN?</p>
						                            
						                            <div class="tab">
                                                          <a class="tablinks tablinks_tfn active" onclick="openThisTab(event, 'Yes','tfn')">Yes</a>
                                                          <a class="tablinks tablinks_tfn" onclick="openThisTab(event, 'No','tfn')">No</a>
                                                        
                                                        </div>
                                                        
                                                    <!-- Tab content -->
                                                    <div id="Yes" class="tabcontent tabcontent_tfn" style="display:block;">
                                                     <div class="form-row">	     	    
                                						<div class="form-group col-md-6">
                                						<label for="businessname" class="control-label">Enter Tax File Number:<span>*</span></label>
                                						<input type="text" class="form-control" id="tfn_number" name="tfn_number" value="<?php echo $row->tfn_number; ?>" autocomplete="off">
                                						<span class="fieldError" id="tfn_number_error">Please Enter TFN Number</span>
                                						</div>
                                							</div>
              
                                                    </div>
                                                    
                                                    <div id="No" class="tabcontent tabcontent_tfn">
                                                       <label><input type="radio" value="pendingTFN" name="tfn_type" <?php if($row->tfn_type == 'pendingTFN') echo"checked"; ?>> My TFN is pending</label><br>
                                                    <label><input type="radio" value="noTFN" name="tfn_type" <?php if($row->tfn_type == 'noTFN') echo"checked"; ?>>  I'm under 18 and don't have a TFN</label><br>
                                                     <label><input type="radio" value="quotingTFN" name="tfn_type" <?php if($row->tfn_type == 'quotingTFN') echo"checked"; ?>> I have an exemption from quoting a TFN (such as receiving a social security or service pension)</label>
                                                    	<span class="fieldError" id="tfn_type_error">Please choose correct option.</span>
                                                    </div>
                                                     <input type="hidden" value="tfn_number" name="check_tfn_type" class="check_tfn_type">
                                                    </div>
                                    						
            						            </div>
            						        </div>
            						        <div class="section-wrap">
                    						            <div class="form-row">
                    						                <div class="checkbox-group col-md-12" >
                    						                            <p>Have you changed your surname since you last dealt with the Australian Tax Office?</p>
                    						                             <div class="tab">
                                                              <a class="tablinks tablinks_surname  if($row->have_surname_changed == 'yesChanged'){ echo 'active';} ?>" onclick="openThisTab(event, 'yesChanged','surname')">Yes</a>
                                                              <a class="tablinks tablinks_surname <?php if($row->have_surname_changed == ''){ echo 'active'; } ?> <?php if($row->have_surname_changed == 'noChanged'){ echo 'active';} ?>" onclick="openThisTab(event, 'noChanged','surname')">No</a>
                                                            
                                                            </div>
                                                            <!-- Tab content -->
                                                            <div id="yesChanged" class="tabcontent tabcontent_surname" <?php if($row->have_surname_changed == 'yesChanged'){ ?>style="display:block;" <?php } ?>>
                                                             <div class="form-row">	     	    
                                        						<div class="form-group col-md-6">
                                        						<label for="businessname" class="control-label">Enter Previous Surname:</label>
                                        						<input type="text" class="form-control" id="previous_surname" name="previous_surname" value="<?php if( $row->previous_surname != 'noChanged'){echo $row->previous_surname;} ?>" autocomplete="off">
                                        					    
                                        						</div>
                                        							</div>
                      
                                                            </div>
                                                            <div id="noChanged" class="tabcontent tabcontent_surname" <?php if($row->have_surname_changed == 'noChanged'){ echo 'style="display:block;"';} ?>>
                                                            </div>
                    
                                                            <input type="hidden" value="<?php echo $row->have_surname_changed; ?>" name="have_surname_changed" class="previous_surname_changed ">
                                                            
                    
                    						                            
                                            					
                                            						
                                            						</div>
                                            						
                    						            </div>
                    						    </div>
						            
            						<div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Are you an Australian resident for tax purposes or a working holiday maker?</p>
    						                            
                            							<label><input type="radio" value="australian" name="resident_type" <?php if($row->resident_type == 'australian') echo "checked"; ?>> Australian resident for tax purposes</label><br>
                            							<label><input type="radio" value="foreign" name="resident_type" <?php if($row->resident_type == 'foreign') echo "checked"; ?>> Foreign resident</label><br>
                            							<label><input type="radio" value="working_holiday" name="resident_type" <?php if($row->resident_type == 'working_holiday') echo "checked"; ?>> Working holiday maker</label>
                                							<span class="fieldError" id="resident_type_error"></span>
                            						</div>
                            						<div class="form-group col-md-6 countryOfOrigin" style="display:none">
                                        						<label for="origin_country" class="control-label">Native Country:</label>
                                        						<input type="text" class="form-control" id="origin_country" name="origin_country" value="<?php echo $row->origin_country; ?>" autocomplete="off">
                                        			<span class="fieldError" id="origin_country_error">Please Enter Your Native Country</span>
                                        		</div>

    						            </div> 
						            </div>
            						<div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Do you have any of the following outstanding debts or loans?</p>
    						                            
                            							<label><input type="radio" value="higher_education" name="loan_type" <?php if($row->loan_type == 'higher_education') echo"checked"; ?>> Higher Education Loan Program (HELP)</label><br>
                            							<label><input type="radio" value="vet_student" name="loan_type" <?php if($row->loan_type == 'vet_student') echo"checked"; ?>> VET Student Loan (VSL)</label><br>
                            							<label><input type="radio" value="financial_supplement" name="loan_type" <?php if($row->loan_type == 'financial_supplement') echo"checked"; ?>> Financial Supplement (FS)</label><br>
                            							<label><input type="radio" value="student_loan" name="loan_type" <?php if($row->loan_type == 'student_loan') echo"checked"; ?>> Student Start-up Loan (SSL)</label><br>
                            							<label><input type="radio" value="trade_loan" name="loan_type" <?php if($row->loan_type == 'trade_loan') echo"checked"; ?>> Trade Support Loan (TSL)</label>
                                						<span class="fieldError" id="loan_type_error"></span>
                            						</div>
                            						
    						            </div>
    						      </div>
            					  <div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>Would you like to claim the tax-free threshold from this payer?</p>
    						                            
                            							<label><input type="radio" value="yes" name="claim_tax_free" <?php if($row->claim_tax_free == 'yes') echo"checked"; ?>> Yes</label>
                            							<label><input type="radio" value="no" name="claim_tax_free" <?php if($row->claim_tax_free == 'no') echo"checked"; ?>> No</label>
                            								<span class="fieldError" id="claim_tax_free_error"></span>
                            						</div>
                            						
    						            </div>
						           </div>
            					   <div class="section-wrap">
    						            <div class="form-row">
    						                        <div class="checkbox-group col-md-12" >
    						                            <p>On what basis are you paid?</p>
    						                            
                            							<label><input type="radio" value="full_time" name="job_type" <?php if($row->job_type == 'full_time') echo"checked"; ?>> Full-time</label><br>
                            							<label><input type="radio" value="part_time" name="job_type" <?php if($row->job_type == 'part_time') echo"checked"; ?>> Part-time</label><br>
                            							<label><input type="radio" value="labour_hire" name="job_type" <?php if($row->job_type == 'labour_hire') echo"checked"; ?>> Labour Hire</label><br>
                            							<label><input type="radio" value="superannuation" name="job_type" <?php if($row->job_type == 'superannuation') echo"checked"; ?>> Superannuation or annuity income stream</label><br>
                            							<label><input type="radio" value="casual" name="job_type" <?php if($row->job_type == 'casual') echo"checked"; ?>> Casual</label>
                            								<span class="fieldError" id="job_type_error"></span>
                                						
                            						</div>
                            						
    						            </div>
						            </div>
						            
						  <!--          <div class="section-wrap"> -->
						            
						  <!--        <div class="form-row">-->
						  <!--          <p>Upload Tax File</p>-->
								<!--<input type="file" class="form-control-file" name="taxFile">-->
								<!--</div>-->
								
								<!--</div>-->
            						       
						             <!--button-->
                							<input type="button" value="SAVE AND CONTINUE" rel="taxForm" name="contact_submit" id="save_continue_tax" class="btn btn-success btn-ph">
                						</form>
                    			</div>
                            </div>
                            
                          <h3 class="tab_drawer_heading" id="mb-taxForm" rel="taxForm"><span class="material-icons">grain</span> Tax Form</h3>
                          <div id="taxForm" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Tax Form</h2>
                               <p style="color:#28a745;font-size: 15px;font-weight: 800">Please upload the scanned copy of the government Tax Formâ€¦ this upload form is mandatory.</p>
                               	<a href="<?php echo base_url();?>assets/terms_docs/TFN_declaration_form_N3092.pdf" download="taxFile.pdf"><button class="btn btn-warning">Download Template</button></a>
        
    
                               	<form  role="form" id="taxFileForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
        				           <div class="form-row mt-5">
						                        
                        				<div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Upload<span>*</span></label>
                							
                							<div class="col-sm-8">
                							     <input type="file" id="taxFile" name="taxFile" class="form-control required"   />
                							     <span class="fieldError" id="taxFile_error"></span>
                							</div>
                						</div>
						            </div> 
						           <input type="button" rel="superAnnuation" name="contact_submit" id="save_continue_taxform" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
                    			</div>
                            </div>    
                            
                            <!-- #tab6 --> 
                            <h3 class="tab_drawer_heading" id="mb-superAnnuation" rel="superAnnuation"><span class="material-icons">insert_drive_file</span>Super Annuation</h3>
                            
                          <div id="superAnnuation" class="tab_content">
                      
                          <div class="panel-body">
                                 
                                  	<!--<a style="float:right;" class="btn btn-dark" href="<?php echo base_url('HR/assets/pdf/Superannuation.pdf'); ?>" target="_blank">View Super Annuation Form</a>-->
            				        <h2>Super Annuation</h2>
            				         <!--<p style="color:#28a745;font-size: 15px;font-weight: 800;">Please fill in Only Section A and Sign It.</p>-->
            				        	<form  role="form" id="annuationDetailsForm" method="post" action="" enctype="multipart/form-data">
            				        	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
            				        <div class="section-wrap">
            				            <div class="checkbox-group col-md-12" >
						                         
						                            
						                            
						                            <p style="color:black;font-size: 16px;font-weight: 600;">Do you have an existing superannuation account?</p>
						                            
						                            <div class="tab">
                                                          <a class="tablinks tablinks_superAnnuation active" onclick="openThisTab(event, 'YesSuper','superAnnuation')">Yes</a>
                                                          <a class="tablinks tablinks_superAnnuation" onclick="openThisTab(event, 'NoSuper','superAnnuation')">No</a>
                                                         <input type="hidden" value="yes" name="check_super_type" class="check_super_type">
                                                        </div>
                                                         </div>
            				            <!--<h3>Section A</h3>-->
            				          <!--  	<div class="form-row">-->
						                    <!--    <div class="checkbox-group sqr-raio-box col-md-12" >-->
						                    <!--        <p>Choice of superannuation (super) fund<label><span>*</span></label></p>-->
						                    <!--        <span>I request that all my future super contributions be paid to: (place select one of the option below)</span>-->
                        		<!--					<label class="label-ctm"><span class="label-text">The APRA fund or retirement savings account (RSA) I nominate</span> <input type="radio" value="apra_fund" name="choice_super_fund"> <span class="labelcontent">Complete items 2, 3 and 5</span></label></br>-->
                        		<!--					<label class="label-ctm"><span class="label-text">The self-managed super fund (SMSF) I nominate</span> <input type="radio" value="self_managed_fund" name="choice_super_fund"> <span class="labelcontent">Complete items 2, 4 and 5</span></label></br>-->
                        		<!--					<label class="label-ctm"><span class="label-text">The super fund nominated by my employer (in section B)</span> <input type="radio" value="fund_nom_emp" name="choice_super_fund"> <span class="labelcontent">Complete items 2 and 5</span></label>-->
                            						
                        		<!--				</div>-->
                        		<!--				<span class="fieldError" id="choice_super_fund_error"></span>-->
                        						
						                    <!--</div>-->
						            <div id="YesSuper" class="tabcontent tabcontent_superAnnuation" style="display:block;">
						                    <div class="form-row">
						                        <div class="col-md-12" >
						                            <p>Your details</p>
						                            
                        						</div>
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_name" class=" control-label">Name:</label>
                        							<input type="text" id="pdf_name" class="form-control required" name="pdf_first_name" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_name_error"></span>
                        						</div>
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_name_error" class=" control-label">Employee identification number (if applicable)</label>
                        							<input type="text" id="pdf_emp_id_no" class="form-control" name="pdf_emp_id_no" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >

                        						</div>
                        						<!--<div class="form-group col-md-4" >-->
                        						<!--	<label for="pdf_tax_file_number" class=" control-label">Tax file number (TFN)</label>-->
                        						<!--	<input type="text" id="pdf_tax_file_number" class="form-control required" value="<?php echo $row->pdf_first_name; ?>" name="pdf_tax_file_number" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_tax_file_number_error"></span>-->
                        						<!--</div>-->
						                    </div>
						                    <div class="form-row">
						                        <!--<div class="col-md-12" >-->
						                        <!--    <p>Nominating your APRA fund or RSA</p>-->
						                        <!--    <span>You will need current details from your APRA regulated fund or RSA to complete this item. To do this you can contact your fund or RSA directly, or you can view your fund or RSA account details by logging into ATO online services via the ATO app or through myGov and selecting Super</span>-->
                        						    
                        						<!--</div>-->
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_apra_fund_abh" class=" control-label">Fund ABN</label>
                        							<input type="text" id="pdf_apra_fund_abh" class="form-control required" name="pdf_apra_fund_abh" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_abh_error"></span>
                        						</div>
                        						<div class="form-group col-md-8" >
                        							<label for="pdf_apra_fund_name" class=" control-label">Fund name</label>
                        							<input type="text" id="pdf_apra_fund_name" class="form-control required" name="pdf_apra_fund_name" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_name_error"></span>
                        						</div>
                        						<!--<div class="form-group col-md-12" >-->
                        						<!--	<label for="pdf_apra_fund_address" class=" control-label">Fund address</label>-->
                        						<!--	<textarea id="pdf_apra_fund_address" class="form-control required" name="pdf_apra_fund_address" autocomplete="off" ><?php echo $row->pdf_first_name; ?></textarea>-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_address_error"></span>-->
                        						<!--</div>-->
                        						<!--<div class="form-group col-md-3" >-->
                        						<!--	<label for="pdf_apra_fund_town" class=" control-label">Suburb/town</label>-->
                        						<!--	<input type="text" id="pdf_apra_fund_town" class="form-control required" name="pdf_apra_fund_town" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_town_error"></span>-->
                        						<!--</div>-->
                        						<!--<div class="form-group col-md-3" >-->
                        						<!--	<label for="pdf_apra_fund_state" class=" control-label">State/territory</label>-->
                        						<!--	<input type="text" id="pdf_apra_fund_state" class="form-control required" name="pdf_apra_fund_state" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_state_error"></span>-->
                        						<!--</div>-->
                        						<!--<div class="form-group col-md-3" >-->
                        						<!--	<label for="pdf_apra_fund_postcode" class=" control-label">Postcode</label>-->
                        						<!--	<input type="text" id="pdf_apra_fund_postcode" class="form-control required" name="pdf_apra_fund_postcode" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_postcode_error"></span>-->
                        						<!--</div>-->
                        						<!--<div class="form-group col-md-3" >-->
                        						<!--	<label for="pdf_apra_fund_phone" class=" control-label">Fund phone</label>-->
                        						<!--	<input type="text" id="pdf_apra_fund_phone" class="form-control required" name="pdf_apra_fund_phone" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_phone_error"></span>-->
                        						<!--</div>-->
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_apra_fund_usi" class=" control-label">Unique superannuation identifier (USI)<span>*</span></label>
                        							<input type="text" id="pdf_apra_fund_usi" class="form-control required" name="pdf_apra_fund_usi" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_usi_error"></span>
                        						</div>
                        						<!--<div class="form-group col-md-4" >-->
                        						<!--	<label for="pdf_apra_fund_acc_no" class=" control-label">Your account name (if applicable)</label>-->
                        						<!--	<input type="text" id="pdf_apra_fund_acc_no" class="form-control" name="pdf_apra_fund_acc_no" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >-->
                        						<!--    <span class="fieldError" id="pdf_apra_fund_acc_no_error"></span>-->
                        						<!--</div>-->
                        						<div class="form-group col-md-4" >
                        							<label for="pdf_apra_fund_member_no" class=" control-label">Your member number (if applicable)</label>
                        							<input type="text" id="pdf_apra_fund_member_no" class="form-control" name="pdf_apra_fund_member_no" value="<?php echo $row->pdf_first_name; ?>" autocomplete="off" >
                        						    <span class="fieldError" id="pdf_apra_fund_member_no_error"></span>
                        						</div>
						                    </div> 
						                    <!--<div class="form-row">-->
						                    <!--    <div class="col-md-12" >-->
						                    <!--        <p>Nominating your self-managed super fund (SMSF)</p>-->
						                    <!--        <span>You will need current details from your SMSF trustee to complete this item.</span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_self_fund" class=" control-label">Fund ABN</label>-->
                        		<!--					<input type="text" id="pdf_self_fund" class="form-control required" name="pdf_self_fund" value="<?php echo $row->pdf_self_fund; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-8" >-->
                        		<!--					<label for="pdf_self_fund_name" class=" control-label">Fund name</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_name" class="form-control required" name="pdf_self_fund_name" value="<?php echo $row->pdf_self_fund_name; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_name_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-12" >-->
                        		<!--					<label for="pdf_self_fund_address" class=" control-label">Fund address</label>-->
                        		<!--					<textarea id="pdf_self_fund_address" class="form-control required" name="pdf_self_fund_address" autocomplete="off" ><?php echo $row->pdf_self_fund_address; ?></textarea>-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_address_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_self_fund_town" class=" control-label">Suburb/town</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_town" class="form-control required" name="pdf_self_fund_town" value="<?php echo $row->pdf_self_fund_town; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_town_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_self_fund_state" class=" control-label">State/territory</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_state" class="form-control required" name="pdf_self_fund_state" value="<?php echo $row->pdf_self_fund_state; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_state_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_self_fund_postcode" class=" control-label">Postcode</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_postcode" class="form-control required" name="pdf_self_fund_postcode" value="<?php echo $row->pdf_self_fund_postcode; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_postcode_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-3" >-->
                        		<!--					<label for="pdf_self_fund_phone" class=" control-label">Fund phone</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_phone" class="form-control required" name="pdf_self_fund_phone" value="<?php echo $row->pdf_self_fund_phone; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_phone_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-12" >-->
                        		<!--					<label for="pdf_self_fund_esa" class=" control-label">Fund electronic service address (ESA)</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_esa" class="form-control required" name="pdf_self_fund_esa" value="<?php echo $row->pdf_self_fund_esa; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_esa_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_self_fund_bank_acc_no" class=" control-label">Fund bank account name</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_bank_acc_no" class="form-control required" name="pdf_self_fund_bank_acc_no" value="<?php echo $row->pdf_self_fund_bank_acc_no; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_bank_acc_no_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_self_fund_bsb_code" class=" control-label">BSB code (please include all six numbers)</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_bsb_code" class="form-control required" name="pdf_self_fund_bsb_code" value="<?php echo $row->pdf_self_fund_bsb_code; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_bsb_code_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_self_fund_acc_no" class=" control-label">Account number</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_acc_no" class="form-control required" name="pdf_self_fund_acc_no" value="<?php echo $row->pdf_self_fund_acc_no; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_acc_no_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-12" >-->
						                    <!--        <p>Required documentation</p>-->
						                            
                        		<!--				</div>-->
                        		<!--				<div class="cform-group heckbox-group col-md-12" >-->
						                           
                        		<!--					<label for="smsf_agree"><input type="checkbox" value="1" id="smsf_agree" name="smsf_agree"> I am the trustee, or a director of the corporate trustee of the SMSF and I declare that the SMSF will accept contributions from my employer<span>*</span></label>-->
                          <!--  						<span class="fieldError" id="smsf_agree_error"></span> -->
                        		<!--				</div>-->
						                    <!--</div>-->
						                    <!--<div class="form-row">-->
						                    <!--    <div class="col-md-12" >-->
						                    <!--        <p>Signature and date</p>-->
						                    <!--        <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        		<!--				</div>-->
                        		<!--				<div class="checkbox-group col-md-12" >-->
						                           
                        		<!--					<label for="is_attached_rel_doc"><input type="checkbox" id="is_attached_rel_doc" value="1" name="is_attached_rel_doc" <?php if($row->is_attached_rel_doc == '1') echo 'checked'; ?>> I have attached the relevant documentation.<span>*</span></label>-->
                            						
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-8" >-->
                        		<!--					<label for="pdf_self_fund_sign" class=" control-label">Signature</label>-->
                        		<!--					<input type="text" id="pdf_self_fund_sign" class="form-control required" name="pdf_self_fund_sign" value="<?php echo $row->pdf_self_fund_sign; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_sign_error"></span>-->
                        		<!--				</div>-->
                        		<!--				<div class="form-group col-md-4" >-->
                        		<!--					<label for="pdf_self_fund_date" class=" control-label">Date</label>-->
                        		<!--					<input type="date" id="pdf_self_fund_date" class="form-control required" name="pdf_self_fund_date" value="<?php echo $row->pdf_self_fund_date; ?>" autocomplete="off" >-->
                        		<!--				    <span class="fieldError" id="pdf_self_fund_date_error"></span>-->
                        		<!--				</div>-->
						                    <!--</div>-->
            				        </div>
            				        <div id="NoSuper" class="tabcontent tabcontent_superAnnuation">
            				            <input  id="nominatedByEmployer" type="hidden" value="0" name="nominatedByEmployer" >

            				    	<div class="checkbox">
                            			<label style="color:#000;">
                            			    <input type="checkbox"  value="1" id="select_nominatedByEmployer"
     onchange="document.getElementById('nominatedByEmployer').value = this.checked ? 1 : 0">The super fund nominated by my employer.<span>*</span></label>
                            		<span class="fieldError" id="nominatedByEmployer_error"></span> 
                            							</div>
                                                    </div>
            				        <!--<div class="section-wrap">-->
            				        <!--    <h3>Section B</h3>-->
            				        <!--     <p style="color:#28a745;font-size: 15px;font-weight: 800">This section must be completed by the Employer.</p>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Your details</p>-->
						                  <!--          <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_business_name" class=" control-label">Business name</label>-->
                        <!--							<input type="text" id="pdf_business_name" class="form-control required" name="pdf_business_name" value="<?php echo $row->pdf_business_name; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_business_name_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_abn" class=" control-label">ABN</label>-->
                        <!--							<input type="text" id="pdf_abn" class="form-control required" name="pdf_abn" value="<?php echo $row->pdf_abn; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_abn_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-8" >-->
                        <!--							<label for="pdf_signture" class=" control-label">Signature</label>-->
                        <!--							<input type="text" id="pdf_signture" class="form-control required" name="pdf_signture" value="<?php echo $row->pdf_signture; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_signture_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-4" >-->
                        <!--							<label for="pdf_sign_date" class=" control-label">Date</label>-->
                        <!--							<input type="date" id="pdf_sign_date" class="form-control required" name="pdf_sign_date" value="<?php echo $row->pdf_sign_date; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_sign_date_error"></span>-->
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Your nominated super fund</p>-->
						                  <!--          <span>If an employee does not choose their own super fund, and the ATO has advised the employee does not have a stapled super fund (for new employees from 1 November 2021), you can meet your SG obligations by paying super guarantee contributions on their behalf to the fund you have nominated below or another fund that meets the choice requirements:</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_super_fund_name" class=" control-label">Super fund name</label>-->
                        <!--							<input type="text" id="pdf_super_fund_name" class="form-control required" name="pdf_super_fund_name" value="<?php echo $row->pdf_super_fund_name; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_super_fund_name_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_super_fund_usi" class=" control-label">Unique superannuation identifier (USI)</label>-->
                        <!--							<input type="text" id="pdf_super_fund_usi" class="form-control required" name="pdf_super_fund_usi" value="<?php echo $row->pdf_super_fund_usi; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_super_fund_usi_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_super_fund_phone" class=" control-label">Phone (for the product disclosure statement for this fund)</label>-->
                        <!--							<input type="text" id="pdf_super_fund_phone" class="form-control required" name="pdf_super_fund_phone" value="<?php echo $row->pdf_super_fund_phone; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_super_fund_phone_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_fund_website_address" class=" control-label">Super fund website address</label>-->
                        <!--							<input type="text" id="pdf_fund_website_address" class="form-control required" name="pdf_fund_website_address" value="<?php echo $row->pdf_fund_website_address; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_fund_website_address_error"></span>-->
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--</div>-->
            				        <!--<div class="section-wrap">-->
            				        <!--    <h3>Section C</h3>-->
            				        <!--      <p style="color:#28a745;font-size: 15px;font-weight: 800">This section must be completed by the Employer.</p>-->
            				        <!--    	<div class="form-row">-->
            				        <!--    	    <div class="col-md-12" >-->
						                  <!--          <p>Record of choice acceptance</p>-->
						                  <!--          <span>If you have nominated your own fund in Item 3 or 4, check you have attached the required documentation and then tick the box below.</span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_date_emp_choice" class=" control-label">Date employeeâ€™s choice is received</label>-->
                        <!--							<input type="date" id="pdf_date_emp_choice" class="form-control required" name="pdf_date_emp_choice" value="<?php echo $row->pdf_date_emp_choice; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_date_emp_choice_error"></span>-->
                        <!--						</div>-->
                        <!--						<div class="form-group col-md-6" >-->
                        <!--							<label for="pdf_date_act" class=" control-label">Date you act on your employeeâ€™s choice</label>-->
                        <!--							<input type="date" id="pdf_date_act" class="form-control required" name="pdf_date_act" value="<?php echo $row->pdf_date_act; ?>" autocomplete="off" >-->
                        <!--						    <span class="fieldError" id="pdf_date_act_error"></span>-->
                        <!--						</div>-->
            				        <!--    	</div>-->
            				        <!--</div>-->
            				        <!--button-->
            				        </div>
                							<input type="button" rel="policeClearance" name="contact_submit" id="save_continue_annuation" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
                    			</div>
                            </div>
                            
                            <!-- #tab5--> 
                          <h3 class="tab_drawer_heading" id="mb-policeClearance" rel="policeClearance"><span class="material-icons">grain</span> Police Clearance</h3>
                          <div id="policeClearance" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Police Clearance</h2>
                               <p style="color:#28a745;font-size: 15px;font-weight: 800">Police clearance certificate is mandatory to commence work. Please upload your certificate.</p>
                               	<form  role="form" id="policeDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
        				           <div class="form-row">
						                        
                        				<div class="form-group">
                							<label for="businessname" class="col-sm-4 control-label">Upload Certificate<span>*</span></label>
                							
                							<div class="col-sm-8">
                							     <input type="file" id="police" name="police" class="form-control required"   />
                							     <span class="fieldError" id="police_error"></span>
                							</div>
                						</div>
						            </div> 
						           <input type="button" rel="resumeTab" name="contact_submit" id="save_continue_police" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
                    			</div>
                            </div>
                            
                            
                            
                            <h3 class="tab_drawer_heading" id="mb-resumeTab" rel="resumeTab"><span class="material-icons">grain</span> Resume</h3>
                          <div id="resumeTab" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Resume</h2>
                               <p style="color:#28a745;font-size: 15px;font-weight: 800">Resume is mandatory to commence work. Please upload your resume.</p>
                               	<form  role="form" id="resumeTabForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
        				           <div class="form-row">
						                        
                        				<div class="form-group">
                							
                							
                							<div class="col-sm-8">
                							     <input type="file" id="resume" name="resume" class="form-control-file required"   />
                							     <span class="fieldError" id="resume_error"></span>
                							</div>
                						</div>
						            </div> 
						           <input type="button" rel="qualificationsTab" name="contact_submit" id="save_continue_resume" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
                						</form>
                    			</div>
                            </div>
                            
                            <h3 class="tab_drawer_heading" id="mb-qualificationsTab" rel="qualificationsTab"><span class="material-icons">grain</span> Qualifications</h3>
                          <div id="qualificationsTab" class="tab_content">
                         
                          <div class="panel-body">
                               <h2>Qualifications</h2>
                               <p style="color:#28a745;font-size: 15px;font-weight: 800">Qualifications documents is mandatory to commence work. Please upload your qualifications doc.</p>
                               
                               
<form role="form" id="qualificationsTabForm" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">

    <!-- Existing qualifications upload -->
    <div class="form-row">
        <div class="form-group">
            <div class="col-sm-8">
                <label for="qualifications">Upload Qualifications Documents <span class="text-danger">*</span></label>
                <input type="file" id="qualifications" name="qualifications" class="form-control-file required" />
                <span class="fieldError text-danger" id="qualifications_error"></span>
            </div>
        </div>
    </div>

    <!-- ==== NEW VISA SECTION ==== -->
    <div class="form-row">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="on_temp_visa" name="on_temp_visa" value="1">
                        Are you on Student Visa or Temporary Visa?
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- These fields are hidden by default -->
    <div id="visa_details" style="display:none;">
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="visa_expiry_date">Visa Expiry Date <span class="text-danger">*</span></label>
                    <input type="date" id="visa_expiry_date" name="visa_expiry_date" class="form-control" />
                    <span class="fieldError text-danger" id="visa_expiry_error"></span>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-8">
                    <label for="visa_photo">Upload Visa Photo <span class="text-danger">*</span></label>
                    <input type="file" id="visa_photo" name="visa_photo" class="form-control-file" />
                    <span class="fieldError text-danger" id="visa_photo_error"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ==== END VISA SECTION ==== -->

    <input type="button" id="save_continue_qualifications" class="btn btn-success btn-ph" value="SAVE AND CONTINUE">
</form>                    			
                    			
                    			</div>
                            </div>
                            
                            
                          
                           <!-- #tab7 --> 
                            <h3 class="tab_drawer_heading" id="mb-privacyPolicy" rel="privacyPolicy"><span class="material-icons">lock_outline</span> Policy</h3>
                          <div id="privacyPolicy" class="tab_content">
                              <div class="panel-body">
                               <h2>Policy</h2>
                                <p style="color:#28a745;font-size: 15px;font-weight: 800">You must read and agree to below attached company policies, staff induction and job description policies before submitting the form.</p>
                               	<form  role="form" id="privacyDetailsForm" method="post" action="" enctype="multipart/form-data">
                               	    <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                                        <div class="col-lg-3">
                                      <h3>Staff Induction Manual</h3>
                                    <div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
                            					      <?php if($branch_id =='57') { ?>
                            						<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" target="_blank">View</a>
                            							<?php }elseif($branch_id =='55') { ?>
                            							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" target="_blank">View</a>
                            							<?php }elseif($branch_id =='69' || $branch_id =='70') { ?>
                            							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_tarator.pdf" target="_blank">View</a>
                            							<?php }else { ?>
                            							<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" target="_blank">View</a>
                            							<?php } ?>
                            							
                            					</div><br>
                            	   
                            						<div class="form-group">
                            							<div class="pdf-view-wrap">
                            							      <?php if($branch_id =='57') { ?>
                            							<iframe src="<?php echo base_url();?>assets/terms_docs/induction_ipswich.pdf" width="100%" height="100%"></iframe>
                            								<?php }elseif($branch_id =='55') { ?>
                            								<iframe src="<?php echo base_url();?>assets/terms_docs/induction_rpa.pdf" width="100%" height="100%"></iframe>
                            									<?php }elseif($branch_id =='69' || $branch_id =='70') { ?>
                            									<iframe src="<?php echo base_url();?>assets/terms_docs/induction_tarator.pdf" width="100%" height="100%"></iframe>
                            									<?php }else { ?>
                            									<iframe src="<?php echo base_url();?>assets/terms_docs/induction_all.pdf" width="100%" height="100%"></iframe>
                            										<?php } ?>
                            							<div class="checkbox">
                            								  <label style="color:#000;"><input id="agree_terms_one" type="checkbox" value="1" name="agree_terms_one" >I read, understood and agree to the the Staff Induction Manual.<span>*</span></label>
                            							<span class="fieldError" id="agree_terms_one_error"></span> 
                            							</div>
                            							</div>	
                            						</div>
                            					
                            	         </div>
                                        <div class="col-lg-3">
                                                <h3>Company Policies and Procedures</h3>
                                           
                        					<div class="col-md-2 btn-position" style="text-align:right;padding-right:0px;">
                        					     <?php if($branch_id =='57') { ?>
                        						<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" target="_blank">View</a>
                        							<?php }elseif($branch_id =='55') { ?>
                        						<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" target="_blank">View</a>
                        						<?php }elseif($branch_id =='69' || $branch_id =='70') { ?>
                        						<a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_tarator.pdf" target="_blank">View</a>
                        						<?php }else{  ?>
                        					  <a style="width:100%;" class="btn btn-dark" href="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" target="_blank">View</a>
                        						<?php } ?>
                        					</div><br>
                        	          		
                        						<div class="form-group">
                        							<div class="pdf-view-wrap">
                        							    
                        						   <?php if($branch_id =='57') { ?>
                        							<iframe src="<?php echo base_url();?>assets/terms_docs/policy_ipswich.pdf" width="100%" height="100%"></iframe>
                        							<?php }elseif($branch_id =='55') { ?>
                        					<iframe src="<?php echo base_url();?>assets/terms_docs/policy_rpa.pdf" width="100%" height="100%"></iframe>
                        					<?php }elseif($branch_id =='69' || $branch_id =='70') { ?>
                        						<iframe src="<?php echo base_url();?>assets/terms_docs/policy_tarator.pdf" width="100%" height="100%"></iframe>
                        					
                        						<?php }else { ?>
                        					<iframe src="<?php echo base_url();?>assets/terms_docs/policy_all.pdf" width="100%" height="100%"></iframe>
                        						<?php } ?>
                        						
                        
                        							<div class="checkbox">
                        								  <label style="color:#000;"><input type="checkbox" id="agree_terms_two" value="1" name="agree_terms_two">I read, understood and agree to the  Company Policies and Procedures Manual.<span>*</span></label>
                        							    <span class="fieldError" id="agree_terms_two_error"></span> 
                        							</div>
                        							</div>	
                        					
                        	          		</div>
                    	          		</div>
                                        <div class="col-lg-3">
                                       <?php if($row->job_desc != ""){ ?>
                                      <h3>Job Description</h3>
                                      
                        					<div class="col-md-2 job_desc_btn btn-position" style="text-align:right;padding-right:0px;">
                        						<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" target="_blank">View</a>
                        					<!--<a style="width:100%;margin-left:8px;" class="btn btn-dark" href="<?php echo base_url();?>index.php/admin/edit_employee_job_desc/<?php echo $row->emp_id; ?>">Edit</a>-->
                        					</div> <br>
                        	          		
                        						<div class="form-group">
                        							<div class="pdf-view-wrap">
                        							    <?php $file_parts = pathinfo($row->job_desc); 
                        							    if($file_parts['extension'] == 'pdf'){ ?>
                        							    
                        							<iframe src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>" width="100%" height="100%"></iframe>
                        							
                        							      <?php }else { ?>
                        			<iframe src="https://docs.google.com/viewer?url=<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>&embedded=true" width="100%" height="100%"> </iframe>				      
                        				<!--<object src="<?php //echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"><embed src="<?php echo base_url();?>assets/job_desc/<?php echo $row->job_desc; ?>"></embed></object>-->
                              
                        							
                        								<?php } ?>
                        							<div class="checkbox">
                        								  <label style="color:#000;"><input type="checkbox" id="agree_terms_three" value="1" name="agree_terms_three" >I read, understood and agree to the Job Descriptions Manual.<span>*</span></label>
                                                         <span class="fieldError" id="agree_terms_three_error"></span>                        							
                        							</div>
                        							</div>	
                        						
                        						
                        	          		</div>
                        	          		<?php } ?>
                        	          		</div>
                        	      <!--    	 <div class="col-lg-3">-->
                               <!--                 <h3>Food Handling Certificate</h3>	-->
                        	      <!--    		<div class="checkbox">-->
                        							<!--	  <label style="color:#000;"><input type="checkbox" id="FoodHandlingCertificate" value="1" name="FoodHandlingCertificate">Food Handling Certificate.<span>*</span></label>-->
                        							<!--    <span class="fieldError" id="FoodHandlingCertificate_error"></span> -->
                        							<!--</div>-->
                        	      <!--    		</div>-->
                        	          		<!--button-->
                							<input type="button"  name="contact_submit" id="save_continue_privacy" value="Submit" class="btn btn-success btn-ph">
                						</form>
                                </div>
                           </div>
                           
                           
                        </div>
                        <!-- .tab_container -->
                        </div>
  			</div>
  			<!--tab design end-->
        
	    
	    	
	</div>
	

  <?php } ?>
  
   
   </div>
    
  
  
  
  <br>


<script>
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    // $(document).ready(function($){
	   
    //   $('.btn-success').on('click',function(e) {            
    //           $(".loader").show();  
    //           setTimeout(function(){ 
    //               $(".loader").hide();  
    //           }, 2000);
               
    //         })   
    //   });
      
     
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

$('#save_continue_personal').click(function(e){
    var err=0;
    if($('#title').val() == ''){ $('#title_error').html('Please select title');err=1;}
    if($('#first_name').val() == ''){ $('#first_name_error').html('Please fill first name');err=1;}
    if($('#last_name').val() == ''){ $('#last_name_error').html('Please fill last name');err=1;}
    if($('#email').val() == ''){ $('#email_error').html('Please fill email address'); err=1; } 
    if($('#password').val() == ''){ $('#password_error').html('Please fill password'); err=1; }
    if($('#phone').val() == ''){ $('#phone_error').html('Please fill phone number'); err=1; }
    if($('#dob').val() == ''){ $('#dob_error').html('Please fill date of birth'); err=1; }
    
    if($('#unit_number').val() == ''){ $('#Unit_error').html('Please fill unit number'); err=1; }
    if($('#street_name').val() == ''){ $('#streetname_error').html('Please fill street name'); err=1; }
    // if($('#street').val() == ''){ $('#street_error').html('Please fill street'); err=1; }
    if($('#state').val() == ''){ $('#state_error').html('Please select state'); err=1; }
     if($('#suburb').val() == ''){ $('#suburb_error').html('Please fill suburb'); err=1; }
      if($('#postcode').val() == ''){ $('#postcode_error').html('Please fill postcode'); err=1; }
    
    
    if(err == '0'){
        $("#overlayplaceorder").show();
        var data1 = $('#personalDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	success: function(data){  changetab('save_continue_personal'); $("#overlayplaceorder").hide(); }
        }); e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	
	
// 	emergency form submit
	$('#save_continue_emergency').click(function(e){
    var err=0;
    $('.fieldError').html('');
      $('#emergencyDetailsForm').find('.required').each(function() {
        
          if($(this).val() == "") {
               
              err = 1;
              var fieldID=$(this).attr('id');
            //   console.log(fieldID);
              $('#'+fieldID+'_error').html('This field should not be empty');
          }
        });
    
    
    if(err == '0'){
        $("#overlayplaceorder").show();
        var data1 = $('#emergencyDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	success: function(data){ console.log(data); changetab('save_continue_emergency'); $("#overlayplaceorder").hide();}
        }); e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	
	// 	bank form submit
	$('#save_continue_bank').click(function(e){
    var err=0;
    $('.fieldError').html('');
   
    $('#bankDetailsForm').find('.required').each(function() {
        
          if($(this).val() == "") {
               
              err = 1;
              var fieldID=$(this).attr('id');
            //   console.log(fieldID);
              $('#'+fieldID+'_error').html('This field should not be empty');
          }
        });
    
    if(err == '0'){
        $("#overlayplaceorder").show();
        var data1 = $('#bankDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	success: function(data){ changetab('save_continue_bank'); $("#overlayplaceorder").hide();}
        }); e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	

	// 	tax form submit
	$('input[name=resident_type]').on("change",function(){
	  if($(this).val() == 'working_holiday'){
	      $(".countryOfOrigin").css("display","block");
	  }else{
	      $(".countryOfOrigin").css("display","none");
	  }
	})
	$('#save_continue_tax').click(function(e){
	    if($(".check_tfn_type ").val() == 'tfn_number' && $("#tfn_number").val() == ''){
	        alert('Please enter TFN number.');
	        $("#tfn_number_error").show();
	        return false;
	    }else if($(".check_tfn_type ").val() == 'tfn_type' && !$('input[name=tfn_type]:checked').length > 0){
	         alert('Please choose correct TFN option.');
	         $("#tfn_type_error").show();
	        return false;
	    }
	    console.log("nccc",$('input[name=resident_type]:checked').val())
	    if($('input[name=resident_type]:checked').val() == 'working_holiday' && $("#origin_country").val() == ''){
	      alert('Please enter  your native country');
	      $("#origin_country_error").show();
	        return false;   
	    }
    var err=0;
    
     var allradio_tax = [];
   
    $('#taxDetailsForm').find('input[type="radio"]').each(function() {
            var fieldName=$(this).attr('name');
           
           if(fieldName !='loan_type' && fieldName != 'tfn_type'){
            if(!allradio_tax.includes(fieldName)){
                if (!$('input[name='+fieldName+']:checked').length > 0) {
             
                $('#'+fieldName+'_error').html('This field should not be empty');
                err=1; 
                   }
            }
           
           allradio_tax.push(fieldName);
           }
           
        });
        
        
        // return false;
    // err=1; 
    if(err == '0'){
        $("#overlayplaceorder").show();
        var data1 = $('#taxDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	success: function(data){ changetab('save_continue_tax'); $("#overlayplaceorder").hide();}
        }); e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});	
	
	// 	ppolice form submit
	$('#save_continue_police').click(function(e){
    var err=0;
    $('.fieldError').html('');
    
    var data1 = new FormData(document.getElementById("policeDetailsForm"));
    if ($("#police").get(0).files.length === 0) {
        err = 1;
        $('#police_error').html('Please upload police clearance certificate.');
    }
    if(err == '0'){
        $("#overlayplaceorder").show();
       
        
        $.ajax({
            type: "POST",
            
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	contentType:false,data: data1,
        	cache:false,                // To unable request pages to be cached  
            processData:false,
        	success: function(data){ console.log(data); 
        	if(data == 'success'){
        	    changetab('save_continue_police');  $("#overlayplaceorder").hide();
        	}
        	else{ alert('File not uploaded. please try again...'); $("#overlayplaceorder").hide(); return false; }
        	    
        	}
        // 		success: function(data){ console.log(data); changetab('save_continue_police'); }
        }); 
        e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	
	$('#save_continue_taxform').click(function(e){
    var err=0;
    $('.fieldError').html('');
    
    var data1 = new FormData(document.getElementById("taxFileForm"));
    if ($("#taxFile").get(0).files.length === 0) {
        err = 1;
        $('#taxFile_error').html('Please upload tax form.');
    }
    if(err == '0'){
        $("#overlayplaceorder").show();
       
        
        $.ajax({
            type: "POST",
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	contentType:false,data: data1,
        	cache:false,                // To unable request pages to be cached  
            processData:false,
        	success: function(data){ console.log(data); 
        	if(data == 'success'){
        	    changetab('save_continue_taxform');  $("#overlayplaceorder").hide();
        	}
        	else{ alert('File not uploaded. please try again...'); $("#overlayplaceorder").hide(); return false; }
        	    
        	}
        // 		success: function(data){ console.log(data); changetab('save_continue_police'); }
        }); 
        e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	
   // 	annuation

	$('#save_continue_annuation').click(function(e){
    $('.fieldError').html('');
    var err=0;
    if($(".check_super_type").val() == 'no'){
    if($('#select_nominatedByEmployer').is(":checked")){}else{ $('#nominatedByEmployer_error').html('Please check the checkbox'); err=1; }     
    }
    
   
   $('#annuationDetailsForm').find('.required').each(function() {
        
        //   if($(this).val() == "") {
               
        //       err = 1;
        //       var fieldID=$(this).attr('id');
        //     //   console.log(fieldID);
        //       $('#'+fieldID+'_error').html('This field should not be empty');
        //   }
        });
    
    if(err == '0'){
        $("#overlayplaceorder").show();
        var data1 = $('#annuationDetailsForm').serialize();
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	success: function(data){ changetab('save_continue_annuation'); $("#overlayplaceorder").hide();}
        }); e.preventDefault();
    }
    else{
        alert('Please fill all the mandatory fields');
        return false;
    }
		
	});
	
	$('#save_continue_resume').click(function(e){
    var err=0;
    $('.fieldError').html('');
    
    var data1 = new FormData(document.getElementById("resumeTabForm"));
    if ($("#resume").get(0).files.length === 0) {
        err = 1;
        $('#resume_error').html('Please upload resume.');
    }
    if(err == '0'){
        $("#overlayplaceorder").show();
         
        $.ajax({
            type: "POST",
            
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	contentType:false,data: data1,
        	cache:false,                // To unable request pages to be cached  
            processData:false,
        	success: function(data){ console.log(data); 
        	if(data == 'success'){
        	    changetab('save_continue_resume');  $("#overlayplaceorder").hide();
        	}
        	else{ alert('File not uploaded. please try again...'); $("#overlayplaceorder").hide(); return false; }
        	    
        	}
        // 		success: function(data){ console.log(data); changetab('save_continue_police'); }
        }); 
        e.preventDefault();
    }
    else{ alert('Please fill all the mandatory fields'); return false; }
	});
	
	$(document).ready(function () {

    // Show/Hide visa fields when checkbox is changed
    $('#on_temp_visa').change(function () {
        if ($(this).is(':checked')) {
            $('#visa_details').slideDown();
        } else {
            $('#visa_details').slideUp();
            // Clear fields and errors when unchecked
            $('#visa_expiry_date').val('');
            $('#visa_photo').val('');
            $('#visa_expiry_error, #visa_photo_error').html('');
        }
    });

    // Main Save & Continue button click
    $('#save_continue_qualifications').click(function (e) {
        var err = 0;
        $('.fieldError').html('');

        // ---- Existing Qualifications Document ----
        if ($("#qualifications").get(0).files.length === 0) {
            err = 1;
                       $('#qualifications_error').html('Please upload qualifications documents.');
        }

        // ---- Visa Validation (only if checkbox is ticked) ----
        if ($('#on_temp_visa').is(':checked')) {
            // Visa Expiry Date
            if ($('#visa_expiry_date').val().trim() === '') {
                err = 1;
                $('#visa_expiry_error').html('Please enter visa expiry date.');
            }

            // Visa Photo Upload
            if ($("#visa_photo").get(0).files.length === 0) {
                err = 1;
                $('#visa_photo_error').html('Please upload visa photo.');
            }
        }

        // If any error â†’ stop submission
        if (err == 1) {
            alert('Please fill all the mandatory fields');
            return false;
        }

        // All good â†’ submit via AJAX
        $("#overlayplaceorder").show();

        var data1 = new FormData(document.getElementById("qualificationsTabForm"));

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
            data: data1,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $("#overlayplaceorder").hide();

                if (data.trim() == 'success') {
                    changetab('save_continue_qualifications');
                } else {
                    alert('File not uploaded. Please try again...');
                }
            },
            error: function () {
                $("#overlayplaceorder").hide();
                alert('An error occurred. Please try again.');
            }
        });

        e.preventDefault();
    });
});
	
	$('#save_continue_privacy').click(function(){
    var err=0;
    
    if($('#agree_terms_one').is(":checked")){}else{ $('#agree_terms_one_error').html('Please agree the terms'); err=1; }
    if($('#agree_terms_two').is(":checked")){}else{ $('#agree_terms_two_error').html('Please agree the terms'); err=1; }
    if($('#agree_terms_three').is(":checked")){}else{ $('#agree_terms_three_error').html('Please agree the terms'); err=1; }
    // if($('#FoodHandlingCertificate').is(":checked")){}else{ $('#FoodHandlingCertificate_error').html('Please check food handling certificate'); err=1; }
    
    if(err == '0'){
      
        var data1 = $('#privacyDetailsForm').serialize();
        
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_onboarding_process",
        	data: data1,
        	beforeSend: function(){
                $("#overlayplaceorder").show();
                 },
                complete:function(data){
                $("#overlayplaceorder").hide();
                 },
        	success: function(data){ console.log(data); 
        	    if(data=='success'){
		        $msg = "Thank you for submitting your onboarding application. You will receive an email shortly with the HR employee portal login process. Please contact your manager if any issues.";
		        $icon = "success";
		        $("#overlayplaceorder").hide();
		        }
		        else{
		         $msg = "Form not submitted.";
		         $icon = "warning";
		        } 
        	    swal({
		         text: $msg,
                 icon: $icon,
                  }).then((value) => {
                  if(data=='success'){
                  window.location = "<?php echo base_url(); ?>index.php/auth/login/employee";
                   }
               });
               
        	}
        	
        }); 
    }
    else{
        alert('Please fill all the mandatory fields');
        return false;
    }
		
	});
	

    function changetab(id){
        $(".tab_content").hide();
                var d_activeTab = $('#'+id).attr("rel"); 
                      $("#"+d_activeTab).fadeIn();
                	  console.log(d_activeTab);
                	  console.log('#mb-'+d_activeTab);
                	  
                	  $(".tab_drawer_heading").removeClass("d_active");
                      $('#mb-'+d_activeTab).addClass("prev d_active");
                	  
                	  $("ul.tabs li").removeClass("active");
                	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("prev active");
    }
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

<!-- Modified CSS to remove opacity and pointer restrictions -->
<style>
    .tab_drawer_heading {
        opacity: 1; /* Changed from 0.2 to 1 */
        cursor: pointer; /* Changed from not-allowed to pointer */
        pointer-events: unset; /* Changed from none to unset */
        background-color:#000;
    }
    
    /* Keep the same styling for active and previous tabs */
    .tab_drawer_heading.d_active,
    .tab_drawer_heading.prev{
        opacity: 1;
        cursor: pointer;
        pointer-events: unset;
    }
    
    .tab_drawer_heading:hover {
        background: #4caf50;
    }
    
    .d_active {
        background: #4caf50;
    }
    
    /* Make all tabs in the list always clickable */
    ul.tabs li {
        opacity: 1;
        cursor: pointer;
        pointer-events: unset;
    }
</style>

<!-- Modified JavaScript - Remove the restriction classes -->
<script>
$(document).ready(function() {
    // Remove the prev class requirement from all li elements
    $("ul.tabs li").removeClass("prev");
    
    // Remove the prev class requirement from all tab drawer headings
    $(".tab_drawer_heading").removeClass("prev");
    
    // Make all tabs clickable by default
    $("ul.tabs li").css({
        'opacity': '1',
        'cursor': 'pointer',
        'pointer-events': 'unset'
    });
    
    $(".tab_drawer_heading").css({
        'opacity': '1',
        'cursor': 'pointer',
        'pointer-events': 'unset'
    });
});
</script>

<!-- Update the initial tab HTML structure -->
<!-- Replace this line in the tabs: -->
<!-- OLD: <li class="prev active" rel="personalDetails"> -->
<!-- NEW: <li class="active" rel="personalDetails"> -->

<!-- Also update the first tab drawer heading: -->
<!-- OLD: <h3 class="prev d_active tab_drawer_heading" rel="personalDetails"> -->
<!-- NEW: <h3 class="d_active tab_drawer_heading" rel="personalDetails"> -->

</body></html>
