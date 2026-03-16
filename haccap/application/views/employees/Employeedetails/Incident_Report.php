<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

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
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Incident Report Details</b></h3>
			        </div>
	          		<div class="panel-body">
	          		
	          			<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Evidence Of the Incident:</b></label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control" name="incident_file">
								<?php if((isset($details[0]->incident_file)) && ($details[0]->incident_file !='') && (file_exists("./uploaded_files/".$details[0]->incident_file))) {  ?>
							    <a style="width:20%;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $details[0]->incident_file; ?>" target="_blank">View</a>
								 <?php } ?>
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Work Area:</label>
							<div class="col-lg-8 col-sm-12">
						<input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
							<input type="hidden" name= "Incident_Report_id" value="<?php if(isset($details[0]->Incident_Report_id)){ echo $details[0]->Incident_Report_id; } ?>">
							<input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">	
								<input type="text" class="form-control" name="work_area" autocomplete="off" value="<?php if(isset($details[0]->work_area)){ echo $details[0]->work_area; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Supervisor on Duty:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" class="form-control"  name="supervisor_on_duty"  autocomplete="off" required value="<?php if(isset($details[0]->supervisor_on_duty)){ echo $details[0]->supervisor_on_duty; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Person Reporting the Incident:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="person_reporting_incident"  autocomplete="off" required value="<?php if(isset($details[0]->person_reporting_incident)){ echo $details[0]->person_reporting_incident; } ?>">
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Date of the Incident:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				         <input type="text" class="form-control datepicker"  name="incident_date"  autocomplete="off" required  value="<?php if(isset($details[0]->incident_date)){ echo $details[0]->incident_date; } ?>">
							</div>
						</div>
							<div class="form-group ">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Time of the Incident:<span>*</span></label>
							<div class="col-lg-8 col-sm-12  input-group date datetimepicker3">
								<span class="input-group-addon" style="padding: 6px 19px !important;">
                                 <span class="glyphicon glyphicon-time"></span>
                              </span>
								<input type="text" class="form-control" name="incident_time" style="z-index: 1 !important;" autocomplete="off" required value="<?php if(isset($details[0]->incident_time)){ echo $details[0]->incident_time; } ?>">
							
							</div>
						</div>
						
					
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Describe the Incident in Detail:</label>
							<div class="col-lg-8 col-sm-12">
                               <textarea  class="form-control" name="incident_detail" rows="8" cols="80" ><?php if(isset($details[0]->incident_detail)){ echo $details[0]->incident_detail; } ?></textarea>
							</div>
						</div>
						
							<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Results of the Investigation:</label>
							<div class="col-lg-8 col-sm-12">
				           <input type="text" class="form-control"  name="investigation_result"  autocomplete="off" value="<?php if(isset($details[0]->investigation_result)){ echo $details[0]->investigation_result; } ?>">
							</div>
						   </div>
						   
						   <div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Action Taken to Reduce Further Incidents:</label>
							<div class="col-lg-8 col-sm-12">
				           <input type="text" class="form-control"  name="action_to_take"  autocomplete="off" value="<?php if(isset($details[0]->action_to_take)){ echo $details[0]->action_to_take; } ?>">
							</div>
						   </div>
						   
						   <div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Employee Representative:</label>
							<div class="col-lg-8 col-sm-12">
				           <input type="text" class="form-control"  name="emp_represntative"  autocomplete="off" value="<?php if(isset($details[0]->emp_represntative)){ echo $details[0]->emp_represntative; } ?>">
							</div>
						   </div>
						   
						   	<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Date ER Signed:</label>
							<div class="col-lg-8 col-sm-12">
				         <input type="text" class="form-control datepicker"  name="er_date"  autocomplete="off" value="<?php if(isset($details[0]->er_date)){ echo $details[0]->er_date; } ?>">
							</div>
						</div>
						
						 <div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Business Manager:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				           <input type="text" class="form-control"  name="business_manager"  autocomplete="off" required value="<?php if(isset($details[0]->business_manager)){ echo $details[0]->business_manager; } ?>">
							</div>
						   </div>
							<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Date BR Signed:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				         <input type="text" class="form-control datepicker"  name="br_date"  autocomplete="off" required value="<?php if(isset($details[0]->br_date)){ echo $details[0]->br_date; } ?>">
							</div>
						</div>
						
						<?php if(isset($details[0]->Incident_Report_id)){ ?>	
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
							<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Incident_Report">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		</div>
		<?php } else { ?>
						   
						
							<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Incident_Report">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
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
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#contact_submit").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			work_area: {
	                required:true
	            },
	        supervisor_on_duty: {
	                required:true
	            }, 
	        person_reporting_incident: {
	        	required:true,
                
            },
	        incident_date: {
	                required:true
	            },
	        incident_time: {
	                required:true
	            }   
			},		
			messages: {
			work_area: {
	                required:"Please provide Work Area "
	            },
	        supervisor_on_duty: {
	                required:"Please provide Supervisor name"
	            },    
	        person_reporting_incident: {
	        	 required:"Please provide person reporting incident",
                
                 },
	        incident_date: {
	                required:"Please Provide incident date"
	            },
	        incident_time: {
	                required:"Please Provide incident time"
	            }   
			}

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
