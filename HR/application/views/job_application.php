
<!DOCTYPE html>
<html>
<head>
	<title>Hr</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.jpg" />
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	
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
	<style>
	.head_custom {
    margin-bottom: 20px;
    background-color: #B4CF40;
    color: #fff;
    height: 102px;
    text-align: center;
	}
    .title_custom {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 22px;
    font-weight:bold;
    color: inherit;
    text-align:center;
    text-decoration:underline;
    }
	</style>
</head>
	<div class="row item">
			</div>
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/add_job_applicant" enctype="multipart/form-data">
	<div class="head_custom border-bottom">
		
		<div class="col-md-2 col-md-offset-5">
			<span class="text-center">
				<img src="<?php echo base_url(""); ?>images/img_logo2.jpg" width="180" height="100">
			</span>
		</div>

	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
	
	<?php echo validation_errors(); ?>
	<?php if(null !==$this->session->userdata('sucess_msg')) { ?>
	                    <br>  
						<div class='hideMe'>
							<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
						</div>
						<?php } ?>
						<?php if(null !==$this->session->userdata('error_msg')) { ?>  
						<div class='hideMe'>
							<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
						</div>
						<?php } ?>
	  		<div class="row">
  			<div class="col-md-12">
  				<div class="col-md-2">
  				</div>
        	<div class="col-md-8">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading" style="padding-bottom:0px;">
			        	<h3 class="title_custom">Careers</h3>
			        	<p>Zouki has over thirty years of experience in the hospitality industry, more than ten of those in public
health, producing unsurpassed standards of quality and management. Our companies have become
industry leaders, with our cafe and retail developments as well as our function catering providing
benchmarks for others across Victoria and interstate.</p>
                        <h3 class="title_custom">Apply Now</h3><br>
			        </div>
	          		<div class="panel-body">
	          			
	          			<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">Position<span>*</span></label>
							<div class="col-sm-8">
								<select name="position" class="form-control">
									<option value="">Select</option>
									<option value="Manager">Manager</option>
									<option value="Chef">Head Chef</option>
									<option value="Chef">Chef</option>
									<option value="Barista">Barista</option>
									<option value="F&B attendant">Food and Beverages Attendant</option>
									<option value="Counter Hand">Counter Hand</option>
									<option value="Cook">Cook</option>
									<option value="Kitchen Hand">Kitchen Hand</option>
									<option value="Supervisor">Supervisor</option>
									<option value="Cleaner">Cleaner</option>

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Cafe Location<span>*</span></label>
							<div class="col-sm-8">
								<textarea type="text" class="form-control" rows="4" name="cafe_location"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Title<span>*</span></label>
							<div class="col-sm-8">
							  <select class="form-control" name="title">
							  	<option value="">Select</option>
							  	<option value="Mr">Mr</option>
							  	<option value="Ms">Ms</option>
							  	<option value="Mrs">Mrs</option>
							  	<option value="Miss">Miss</option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">First Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="first_name" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Last Name<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="last_name" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">Email<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="email"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Phone<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="phone" onkeypress='validate(event)' autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Date of birth<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="datepicker" name="dob" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="visa_status" class="col-sm-4 control-label">Visa Status<span>*</span></label>
							<div class="col-sm-8">
								<select name="visa_status" class="form-control">
									<option value="">Select</option>
									<option value="Student">Student</option>
									<option value="Citizen">Citizen</option>
									<option value="Working Visa">Working Visa</option>
									<option value="Permanent Residency">Permanent Residency</option>
									<option value="Temporary Residency">Temporary Residency</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Availability<span>*</span></label>
							<div class="col-sm-8">
								<textarea type="text" class="form-control" rows="4" name="availability"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Experience<span>*</span></label>
							<div class="col-sm-8">
								<textarea type="text" class="form-control" rows="4" name="experience"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Qualification<span>*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="qualification" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Notes</label>
							<div class="col-sm-8">
								<textarea type="text" class="form-control" rows="4" name="notes"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload a Resume<span>*</span></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="resume" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload a Cover Letter</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="coverletter" autocomplete="off" >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-success" style="background-color:#B4CF40;border-color:#B4CF40;">Submit</button>
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
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#employee_add").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
		    title: {
	                required:true
	            },
	       cafe_location: {
	                required:true
	            },     
		    position: {
	                required:true
	            },	
			first_name: {
	                required:true
	            },
	        last_name: {
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
	        visa_status: {
	                required:true
	            },
	        availability: {
	                required:true
	            },
	         experience: {
	                required:true
	            },
	         qualification: {
	                required:true
	            },
	         resume: {
	                required:true
	            }   
			},		
			messages: {
			title: {
	                required:"Please select title"
	            },
	       cafe_location: {
	                required:"Please provide cafe location"
	            },     
			position: {
	                required:"Please select Position"
	            },	
			first_name: {
	                required:"Please provide first name"
	            },
	        last_name: {
	                required:"Please provide last name"
	            },    
	        email: {
	        	 required:"Please provide email",
                 email:"Please enter valid email"
                 },
	        phone: {
	                required:"Please provide phone number"
	            },
	         dob: {
	                required:"Please provide date of birth"
	            },
	         visa_status: {
	                required:"Please select visa status"
	            },
	         availability: {
	                required:"Please provide availability"
	            },
	         experience: {
	                required:"Please provide experience"
	            },
	          qualification: {
	                required:"Please provide qualification"
	            },
	          resume: {
	                required:"Please upload resume"
	            },
			}

	    });	
	});
</script>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
</body>
</html>