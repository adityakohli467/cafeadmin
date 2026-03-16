
	<div class="row item">
			</div>
			
	<?php if(isset($details[0]->emp_satisfaction_survey_id)){ ?>
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_emp_satisfaction_survey" enctype="multipart/form-data">
	<?php } else {?>
	
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/emp_satisfaction_survey" enctype="multipart/form-data">

	<?php } ?>
	
	
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>WORK SATISFACTION FEEDBACK</h3>
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
			        	<h3 class="panel-title"><b>Feedback Details </b>(Rate Between 1-10 with 10 being the best)</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Compensation to the Employees: <span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							    <input type="hidden" name="emp_satisfaction_survey_id" value="<?php if(isset($details[0]->emp_satisfaction_survey_id)){ echo $details[0]->emp_satisfaction_survey_id; } ?>">
							    <input type="hidden" name="emp_name" value="<?php if(isset($details[0]->emp_name)){ echo $details[0]->emp_name; } ?>">
								<input type="text" readonly class="form-control" name="compensation" autocomplete="off" required  value="<?php if(isset($details[0]->compensation)){ echo $details[0]->compensation; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Opportunity for Advancement:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" readonly class="form-control"  name="oppurtinity"  autocomplete="off" required value="<?php if(isset($details[0]->oppurtinity)){ echo $details[0]->oppurtinity; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Work Benefits: <span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="benefits"  autocomplete="off" required value="<?php if(isset($details[0]->benefits)){ echo $details[0]->benefits; } ?>">
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Friendly Work Environment: <span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="work_environment"  autocomplete="off" required value="<?php if(isset($details[0]->work_environment)){ echo $details[0]->work_environment; } ?>">
							</div>
						</div>
						
					
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Training: <span>*</span> </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="training" required value="<?php if(isset($details[0]->training)){ echo $details[0]->training; } ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Performance Evaluation: <span>*</span> </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="performance_evaluation" required value="<?php if(isset($details[0]->performance_evaluation)){ echo $details[0]->performance_evaluation; } ?>">
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Guidance to Perform your Job Effectively: <span>*</span> </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="guidance"  required value="<?php if(isset($details[0]->guidance)){ echo $details[0]->guidance; } ?>">
							</div>
						</div>
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Overall Satisfaction with Job: <span>*</span> </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="job_satisfaction" required value="<?php if(isset($details[0]->job_satisfaction)){ echo $details[0]->job_satisfaction; } ?>">
							</div>
						</div>
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">General Employee Morale: <span>*</span>  </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="emp_morale"  required value="<?php if(isset($details[0]->emp_morale)){ echo $details[0]->emp_morale; } ?>">
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Any Recommendations to Improve Employee Morale ? </label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="recommendation" value="<?php if(isset($details[0]->recommendation)){ echo $details[0]->recommendation; } ?>">
							</div>
						</div>
						<?php if(isset($details[0]->emp_satisfaction_survey_id)){ ?>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
					
					
						<?php } ?>
						
							<div class="btn-div col-lg-12 col-sm-12">
			              
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_emp_satisfaction_survey">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">Back</button>
					</a>
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
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
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
