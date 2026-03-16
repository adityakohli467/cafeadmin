
<div class="row item">
			</div>
		<?php if(isset($details[0]->emp_evaluation_form_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/emp_evaluation_form/<?php echo $details[0]->emp_evaluation_form_id; ?>" enctype="multipart/form-data">
		    
	<?php } else {?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/emp_evaluation_form" enctype="multipart/form-data">

	<?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Employee Evaluation Form</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-12">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>Employee Evaluation Form</b></h3>
			        </div>
	          		<div class="panel-body ctm-from">
	          		
	          		
	          		<h5><b>EMPLOYEE INFORMATION:</b></h5>
	          		 
	          		<div class="form-group">
							<label class="col-sm-4 control-label">Employee Name</label>
							
							<div class="col-sm-8">
								<select class="form-control" name="emp_id" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
								    <option value="">Select Employee</option>
								    <?php foreach($employees as $emp){
								    
								        if($emp->emp_id == $details[0]->emp_id){
								    ?>
								    <option value="<?php echo $emp->emp_id; ?>" selected><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
								    <?php } else{?>
								    
								    <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->first_name.' '. $emp->last_name; ?></option>
								    <?php } } ?>
								</select> 
							
							</div>
					</div>
	          		<div class="form-group">
							<label class="col-sm-4 control-label">Job Title</label>
							
							<div class="col-sm-8">
								<input type="text" class="form-control" name="job_title" value="<?php if(isset($details[0]->job_title)){ echo $details[0]->job_title; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
							</div>
					</div>
					
					<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager/ Supervisor</label>
							<div class="col-lg-8 col-sm-12">
                              <input type="text" class="form-control" name="manager" value="<?php if(isset($details[0]->manager)){ echo $details[0]->manager; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
							</div>
					</div>
					<h5>Review Period</h5>
	          		<div class="form-group">
							<label class="col-sm-4 control-label">From</label>
							
							<div class="col-sm-8">
							<input type="date" class="form-control"  name="rev_period_from"  autocomplete="off" value="<?php if(isset($details[0]->rev_period_from)){ echo $details[0]->rev_period_from; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
							</div>
					</div>
					<div class="form-group">
							<label class="col-sm-4 control-label">To</label>
							
							<div class="col-sm-8">
							<input type="date" class="form-control"  name="rev_period_to"  autocomplete="off" value="<?php if(isset($details[0]->rev_period_to)){ echo $details[0]->rev_period_to; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
							</div>
					</div>

					<h2>CORE VALUES AND OBJECTIVES</h2>
					 

					<h5>Quality of Work</h5>
					<h6>Work is completed accurately (few or no errors), efficiently and within deadlines with minimal supervision</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="qw_exceeds_expectations" class="col-sm-6">	<input type="checkbox"  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_exceeds_expectations" class="form-control" name="qw_exceeds_expectations" value="1" <?php if(isset($options_rating['qw_exceeds_expectations']) && $options_rating['qw_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="qw_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_meets_expectations" class="form-control" name="qw_meets_expectations" value="1" <?php if(isset($options_rating['qw_meets_expectations']) && $options_rating['qw_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="qw_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_needs_improvement" class="form-control" name="qw_needs_improvement" value="1" <?php if(isset($options_rating['qw_needs_improvement']) && $options_rating['qw_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="qw_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qw_unacceptable" class="form-control" name="qw_unacceptable" value="1" <?php if(isset($options_rating['qw_unacceptable']) && $options_rating['qw_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="qw_comments" rows="4" cols="40" ><?php if(isset($details[0]->qw_comments)){ echo $details[0]->qw_comments; } ?></textarea>
							</div>
					</div>


                     

					<h5>Attendance & Punctuality</h5>
					<h6>Reports for work on time, provides advance notice of need for absence</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="ap_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_exceeds_expectations" class="form-control" name="ap_exceeds_expectations" value="1" <?php if(isset($options_rating['ap_exceeds_expectations']) && $options_rating['ap_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="ap_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="qwOpt2" class="form-control" name="ap_meets_expectations" value="1" <?php if(isset($options_rating['ap_meets_expectations']) && $options_rating['ap_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="ap_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_needs_improvement" class="form-control" name="ap_needs_improvement" value="1" <?php if(isset($options_rating['ap_needs_improvement']) && $options_rating['ap_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="ap_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ap_unacceptable" class="form-control" name="ap_unacceptable" value="1" <?php if(isset($options_rating['ap_unacceptable']) && $options_rating['ap_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?>  class="form-control" name="ap_comments" rows="4" cols="40" ><?php if(isset($details[0]->ap_comments)){ echo $details[0]->ap_comments; } ?></textarea>
							</div>
					</div>
					
					
					 

					<h5>Reliability/Dependability</h5>
					<h6>Consistently performs at a high level; manages time and workload effectively to meet responsibilities</h6>
					<div class="form-group">
							<label class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="rd_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_exceeds_expectations" class="form-control" name="rd_exceeds_expectations" value="1" <?php if(isset($options_rating['rd_exceeds_expectations']) && $options_rating['rd_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="rd_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_meets_expectations" class="form-control" name="rd_meets_expectations" value="1" <?php if(isset($options_rating['rd_meets_expectations']) && $options_rating['rd_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="rd_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_needs_improvement" class="form-control" name="rd_needs_improvement" value="1" <?php if(isset($options_rating['rd_needs_improvement']) && $options_rating['rd_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="rd_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="rd_unacceptable" class="form-control" name="rd_unacceptable" value="1" <?php if(isset($options_rating['rd_unacceptable']) && $options_rating['rd_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="rd_comments" rows="4" cols="40" ><?php if(isset($details[0]->rd_comments)){ echo $details[0]->rd_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Communication Skills</h5>
					<h6>Written and oral communications are clear, organized, and effective; listens and comprehends well  </h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="cs_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_exceeds_expectations" class="form-control" name="cs_exceeds_expectations" value="1" <?php if(isset($options_rating['cs_exceeds_expectations']) && $options_rating['cs_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="cs_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_meets_expectations" class="form-control" name="cs_meets_expectations" value="1" <?php if(isset($options_rating['cs_meets_expectations']) && $options_rating['cs_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="cs_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_needs_improvement" class="form-control" name="cs_needs_improvement" value="1" <?php if(isset($options_rating['cs_needs_improvement']) && $options_rating['cs_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="cs_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="cs_unacceptable" class="form-control" name="cs_unacceptable" value="1" <?php if(isset($options_rating['cs_unacceptable']) && $options_rating['cs_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?>  class="form-control" name="cs_comments" rows="4" cols="40" ><?php if(isset($details[0]->cs_comments)){ echo $details[0]->cs_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Judgment & Decision-Making</h5>
					<h6>Makes thoughtful, well-reasoned decisions; exercises good judgment, resourcefulness, and creativity in problem-solving</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="jdm_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_exceeds_expectations" class="form-control" name="jdm_exceeds_expectations" value="1" <?php if(isset($options_rating['jdm_exceeds_expectations']) && $options_rating['jdm_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="jdm_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_meets_expectations" class="form-control" name="jdm_meets_expectations" value="1" <?php if(isset($options_rating['jdm_meets_expectations']) && $options_rating['jdm_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="jdm_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_needs_improvement" class="form-control" name="jdm_needs_improvement" value="1" <?php if(isset($options_rating['jdm_needs_improvement']) && $options_rating['jdm_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="jdm_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="jdm_unacceptable" class="form-control" name="jdm_unacceptable" value="1" <?php if(isset($options_rating['jdm_unacceptable']) && $options_rating['jdm_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="jdm_comments" rows="4" cols="40" ><?php if(isset($details[0]->jdm_comments)){ echo $details[0]->jdm_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Initiative & Flexibility</h5>
					<h6>Demonstrates initiative, often seeking out additional responsibility; identifies problems and solutions; thrives on new challenges and adjusts to unexpected changes</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="if_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_exceeds_expectations" class="form-control" name="if_exceeds_expectations" value="1" <?php if(isset($options_rating['if_exceeds_expectations']) && $options_rating['if_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="if_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_meets_expectations" class="form-control" name="if_meets_expectations" value="1" <?php if(isset($options_rating['if_meets_expectations']) && $options_rating['if_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="if_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_needs_improvement" class="form-control" name="if_needs_improvement" value="1" <?php if(isset($options_rating['if_needs_improvement']) && $options_rating['if_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="if_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="if_unacceptable" class="form-control" name="if_unacceptable" value="1" <?php if(isset($options_rating['if_unacceptable']) && $options_rating['if_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="if_comments" rows="4" cols="40" ><?php if(isset($details[0]->if_comments)){ echo $details[0]->if_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					
					 

					<h5>Cooperation & Teamwork</h5>
					<h6>Respectful of colleagues when working with others and makes valuable contributions to help the group achieve its goals</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="ct_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_exceeds_expectations" class="form-control" name="ct_exceeds_expectations" value="1" <?php if(isset($options_rating['ct_exceeds_expectations']) && $options_rating['ct_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="ct_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_meets_expectations" class="form-control" name="ct_meets_expectations" value="1" <?php if(isset($options_rating['ct_meets_expectations']) && $options_rating['ct_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="ct_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_needs_improvement" class="form-control" name="ct_needs_improvement" value="1" <?php if(isset($options_rating['ct_needs_improvement']) && $options_rating['ct_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="ct_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ct_needs_improvement" class="form-control" name="ct_needs_improvement" value="1" <?php if(isset($options_rating['ct_unacceptable']) && $options_rating['ct_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="ct_comments" rows="4" cols="40" ><?php if(isset($details[0]->ct_comments)){ echo $details[0]->ct_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Knowledge of Position:</h5>
					<h6>Possesses required skills, knowledge, and abilities to competently perform the job</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="kp_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_exceeds_expectations" class="form-control" name="kp_exceeds_expectations" value="1" <?php if(isset($options_rating['kp_exceeds_expectations']) && $options_rating['kp_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="kp_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_meets_expectations" class="form-control" name="kp_meets_expectations" value="1" <?php if(isset($options_rating['kp_meets_expectations']) && $options_rating['kp_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="kp_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_needs_improvement" class="form-control" name="kp_needs_improvement" value="1" <?php if(isset($options_rating['kp_needs_improvement']) && $options_rating['kp_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="kp_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="kp_unacceptable" class="form-control" name="kp_unacceptable" value="1" <?php if(isset($options_rating['kp_unacceptable']) && $options_rating['kp_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="kp_comments" rows="4" cols="40" ><?php if(isset($details[0]->kp_comments)){ echo $details[0]->kp_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					
					 

					<h5>Training & Development</h5>
					<h6>Continually seeks ways to strengthen performance and regularly monitors new developments in field of work</h6>
					<div class="form-group">
							<label for="businessname" class="col-sm-12 control-label">Rating:</label>
							 
							<div class="col-sm-8 inner-label">
							    <label for="td_exceeds_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_exceeds_expectations" class="form-control" name="td_exceeds_expectations" value="1" <?php if(isset($options_rating['td_exceeds_expectations']) && $options_rating['td_exceeds_expectations'] == 1){ echo 'checked'; } ?>> Exceeds expectations  </label>
								<label for="td_meets_expectations" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_meets_expectations" class="form-control" name="td_meets_expectations" value="1" <?php if(isset($options_rating['td_meets_expectations']) && $options_rating['td_meets_expectations'] == 1){ echo 'checked'; } ?>> Meets expectations </label>
								<label for="td_needs_improvement" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_needs_improvement" class="form-control" name="td_needs_improvement" value="1" <?php if(isset($options_rating['td_needs_improvement']) && $options_rating['td_needs_improvement'] == 1){ echo 'checked'; } ?>> Needs improvement  </label>
								<label for="td_unacceptable" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="td_unacceptable" class="form-control" name="td_unacceptable" value="1" <?php if(isset($options_rating['td_unacceptable']) && $options_rating['td_unacceptable'] == 1){ echo 'checked'; } ?>> Unacceptable </label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comments and Examples</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="td_comments" rows="4" cols="40" ><?php if(isset($details[0]->td_comments)){ echo $details[0]->td_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>PERFORMANCE GOALS (Set objectives and outline steps to improve in problem areas or further employee development)</h5>
					<h6>Work is completed accurately (few or no errors), efficiently and within deadlines with minimal supervision</h6>
					
					<div class="form-group">
							
							<div class="col-lg-12 col-sm-12">
                               <textarea  <?php echo ($role == 'employee' ? 'disabled' : ''); ?> class="form-control" name="performance_comments" rows="4" cols="40" ><?php if(isset($details[0]->performance_comments)){ echo $details[0]->performance_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Overall Rating </h5>
					<div class="form-group">
							<div class="col-sm-8 inner-label label-desc">
							    <label for="ol_rating_opt1" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt1" class="form-control" name="ol_rating_opt1" value="1" <?php if(isset($options_rating['ol_rating_opt1']) && $options_rating['ol_rating_opt1'] == 1){ echo 'checked'; } ?>> <span>Exceeds expectations <h6>Employee consistently performs at a high level that exceeds expectations</h6> </span> </label>
								<label for="ol_rating_opt2" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt2" class="form-control" name="ol_rating_opt2" value="1" <?php if(isset($options_rating['ol_rating_opt2']) && $options_rating['ol_rating_opt2'] == 1){ echo 'checked'; } ?>> <span>Meets expectations <h6>Employee satisfies all essential job requirements; may exceed expectations periodically; demonstrates likelihood of eventually exceeding expectations</h6> </span></label>
								<label for="ol_rating_opt3" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt3" class="form-control" name="ol_rating_opt3" value="1" <?php if(isset($options_rating['ol_rating_opt3']) && $options_rating['ol_rating_opt3'] == 1){ echo 'checked'; } ?>> <span>Needs improvement <h6>Employee consistently performs below required standards/expectations for the position; training or other action is necessary to correct performance</h6> </span></label>
								<label for="ol_rating_opt4" class="col-sm-6">	<input type="checkbox" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> id="ol_rating_opt4" class="form-control" name="ol_rating_opt4" value="1" <?php if(isset($options_rating['ol_rating_opt4']) && $options_rating['ol_rating_opt4'] == 1){ echo 'checked'; } ?>><span> Unacceptable <h6>Employee is unable or unwilling to perform required duties according to company standards; immediate improvement must be demonstrated</h6></span></label>
							</div>
					</div>

					<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label">Comment on the overall performance</label>
							<div class="col-lg-12 col-sm-12">
                               <textarea  class="form-control" <?php echo ($role == 'employee' ? 'disabled' : ''); ?> name="ol_rating_comments" rows="4" cols="40" ><?php if(isset($details[0]->ol_rating_comments)){ echo $details[0]->ol_rating_comments; } ?></textarea>
							</div>
					</div>
					
					
					
					 

					<h5>Employee Comments (optional)</h5>
					
					<div class="form-group">
							
							<div class="col-lg-12 col-sm-12">
                               <textarea  class="form-control" name="emp_comments" rows="4" cols="40" ><?php if(isset($details[0]->emp_comments)){ echo $details[0]->emp_comments; } ?></textarea>
							</div>
					</div>
                     
                    <h5>Acknowledgement</h5>
                    <h6><label for="acknowledgement"> <input type="checkbox" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> name="acknowledgement"  id="acknowledgement" <?php echo (isset($details[0]->acknowledgement) && $details[0]->acknowledgement !='' ? 'checked': '');?>  >I acknowledge that I have had the opportunity to discuss this performance evaluation with my manager/ supervisor and I have received a copy of this evaluation.</label></h6>
					<div class="form-group col-lg-5">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Employee Signature</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="emp_sign" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> autocomplete="off"  value="<?php if(isset($details[0]->emp_sign)){ echo $details[0]->emp_sign; } ?>">
							</div>
					</div>
						<div class="col-lg-2"></div>
					<div class="form-group col-lg-5">
							<label class="col-lg-2 col-sm-12 control-label"> Date</label>
							<div class="col-lg-10 col-sm-12">
				         <input type="date" class="form-control"  name="emp_sign_date"  autocomplete="off" <?php echo ($role == 'employee' ? 'required' : 'disabled'); ?> value="<?php if(isset($details[0]->emp_sign_date)){ echo $details[0]->emp_sign_date; } ?>">
							</div>
					</div>
					 
					<div class="form-group col-lg-5">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager/ Supervisor Signature</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="manager_sign"  autocomplete="off"  value="<?php if(isset($details[0]->manager_sign)){ echo $details[0]->manager_sign; } ?>" <?php echo ($role == 'employee' ? 'disabled' : 'required'); ?>>
							</div>
					</div>
					<div class="col-lg-2"></div>
					<div class="form-group col-lg-5">
							<label for="businessname" class="col-lg-2 col-sm-12 control-label"> Date</label>
							<div class="col-lg-10 col-sm-12">
				         <input type="date" class="form-control"  name="manager_sign_date"  autocomplete="off"  value="<?php if(isset($details[0]->manager_sign_date)){ echo $details[0]->manager_sign_date; } ?>" <?php echo ($role == 'employee' ? 'disabled' : ''); ?>>
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
