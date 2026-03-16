<div class="row item">
			</div>
		<?php if(isset($details[0]->interview_assesment_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_interview_assesment/<?php echo $details[0]->interview_assesment_id; ?>" enctype="multipart/form-data">
	<?php } else {?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/interview_assesment" enctype="multipart/form-data">

	<?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Interview Assesment Form</h3>
			</span>
		</div>
		<div class="col-md-3"><a class="btn btn-primary" href="#" onclick="window.print()">Print</a></div>
	</div>


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        
	          		<div class="panel-body incident-form ct-form-in">
	          		           
					<h3 class="panel-title">Interview Assesment Details </h3>
						 
						<div class="form-row">
						<div class="form-group col-md-4">
							<label for="businessname" class="col-lg-3 control-label">Applicant's Name:</label>
						<input type="text" class="form-control" name="applicant_name" autocomplete="off" value="<?php if(isset($details[0]->applicant_name)){ echo $details[0]->applicant_name; } ?>">
							
						</div>
						
						<div class="form-group col-md-4">
							<label for="businessname" class="col-lg-2 control-label">Job Applied For:</label>
						
						<input type="text" class="form-control" name="job_applied_for" autocomplete="off" value="<?php if(isset($details[0]->job_applied_for)){ echo $details[0]->job_applied_for; } ?>">
							
						</div>
						
							<div class="form-group col-md-4">
						<label for="businessname" class="col-lg-2 control-label">Worksite:</label>
						<input type="text" class="form-control" name="worksite" autocomplete="off" value="<?php if(isset($details[0]->worksite)){ echo $details[0]->worksite; } ?>">
						</div>
							</div>
						</br>	
					<h3 class="panel-title">Rank : </h3>
	          		<div class="form-row">
	          		<div class="col-sm-3">
					<label class="radio-inline">
					 <input type="radio" value="excellent" name="rank" <?php echo  ($radion_btn_values['rank'] =="excellent" ? 'checked' : '')?>> Excellent
					 </label>
                      </div>
                      	<div class="col-sm-3">
                      <label class="radio-inline">
                      <input type="radio" value="vgood" name="rank" <?php echo  ($radion_btn_values['rank'] =="vgood" ? 'checked' : '')?>> Very Good
                      </label>
                      </div>
                      	<div class=" col-sm-3">
                      <label class="radio-inline">
                      <input type="radio" value="average" name="rank" <?php echo  ($radion_btn_values['rank'] =="average" ? 'checked' : '')?>> Average
                      </label>
                      </div>
                      	<div class=" col-sm-3">
                      <label class="radio-inline">
                      <input type="radio" value="poor" name="rank" <?php echo  ($radion_btn_values['rank'] =="poor" ? 'checked' : '')?>> Poor
                      </label>
                      </div>
						</div>
						
						<div class="form-row">
					 	<div class="form-group col-sm-12">
					<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Description</th>
      <th scope="col">Site Manager</th>
      <th scope="col">HR</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><b>First Impressions:</b></br> 
      Appearance, physical build, bearing, speech.</td>
      <td>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">4</th>
      <th scope="col">3</th>
      <th scope="col">2</th>
      <th scope="col">1</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_fi" <?php echo  ($radion_btn_values['sm_fi'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_fi" <?php echo  ($radion_btn_values['sm_fi'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_fi" <?php echo  ($radion_btn_values['sm_fi'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_fi" <?php echo  ($radion_btn_values['sm_fi'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table>
</td>
      <td>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">4</th>
      <th scope="col">3</th>
      <th scope="col">2</th>
      <th scope="col">1</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_fi" <?php echo  ($radion_btn_values['hr_fi'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_fi" <?php echo  ($radion_btn_values['hr_fi'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_fi" <?php echo  ($radion_btn_values['hr_fi'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_fi" <?php echo  ($radion_btn_values['hr_fi'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table></td>
    </tr>
    <tr>
    <th scope="row">2</th>
      <td><b>Education: </b></td>
      <td><table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_edu" <?php echo  ($radion_btn_values['sm_edu'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_edu" <?php echo  ($radion_btn_values['sm_edu'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_edu" <?php echo  ($radion_btn_values['sm_edu'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_edu" <?php echo  ($radion_btn_values['sm_edu'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      <td> <table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_edu" <?php echo  ($radion_btn_values['hr_edu'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_edu" <?php echo  ($radion_btn_values['hr_edu'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_edu" <?php echo  ($radion_btn_values['hr_edu'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_edu" <?php echo  ($radion_btn_values['hr_edu'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      
    </tr>
     <tr>
    <th scope="row">3</th>
      <td><b>Experience: </b></br>
      Level of achievement in previous jobs, overseas employment.</td>
      <td><table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_exp" <?php echo  ($radion_btn_values['sm_exp'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_exp" <?php echo  ($radion_btn_values['sm_exp'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_exp" <?php echo  ($radion_btn_values['sm_exp'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_exp" <?php echo  ($radion_btn_values['sm_exp'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      <td> <table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_exp" <?php echo  ($radion_btn_values['hr_exp'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_exp" <?php echo  ($radion_btn_values['hr_exp'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_exp" <?php echo  ($radion_btn_values['hr_exp'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_exp" <?php echo  ($radion_btn_values['hr_exp'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      
    </tr>
    <tr>
    <th scope="row">4</th>
      <td><b>Technical Ability: </b></br>
      Adequacy of the candidate to meet the level of technical or other specialized skills required by the post.</td>
      <td><table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_ta" <?php echo  ($radion_btn_values['sm_ta'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_ta" <?php echo  ($radion_btn_values['sm_ta'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_ta" <?php echo  ($radion_btn_values['sm_ta'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_ta" <?php echo  ($radion_btn_values['sm_ta'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      <td> <table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_ta" <?php echo  ($radion_btn_values['hr_ta'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_ta" <?php echo  ($radion_btn_values['hr_ta'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_ta" <?php echo  ($radion_btn_values['hr_ta'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_ta" <?php echo  ($radion_btn_values['hr_ta'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      
    </tr>
    <tr>
    <th scope="row">5</th>
      <td><b>Personality, Disposition and Temperament:</b> </br>
      Compatibility, initiative, drive, determination, energy, dependability, self-reliance, readiness to accept responsibility, acceptability and influence as a member of his/her working group.</td>
      <td><table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_pers" <?php echo  ($radion_btn_values['sm_pers'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_pers" <?php echo  ($radion_btn_values['sm_pers'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_pers" <?php echo  ($radion_btn_values['sm_pers'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_pers" <?php echo  ($radion_btn_values['sm_pers'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      <td> <table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_pers" <?php echo  ($radion_btn_values['hr_pers'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_pers" <?php echo  ($radion_btn_values['hr_pers'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_pers" <?php echo  ($radion_btn_values['hr_pers'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_pers" <?php echo  ($radion_btn_values['hr_pers'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      
    </tr>
    <tr>
    <th scope="row">6</th>
      <td><b>Overall rating: </b></td>
      <td><table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="sm_or" <?php echo  ($radion_btn_values['sm_or'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="sm_or" <?php echo  ($radion_btn_values['sm_or'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="sm_or" <?php echo  ($radion_btn_values['sm_or'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="sm_or" <?php echo  ($radion_btn_values['sm_or'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
      <td> <table class="table">
  <tbody>
    <tr>
     <td><input type="radio" value="4" name="hr_or" <?php echo  ($radion_btn_values['hr_or'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="hr_or" <?php echo  ($radion_btn_values['hr_or'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="hr_or" <?php echo  ($radion_btn_values['hr_or'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="hr_or" <?php echo  ($radion_btn_values['hr_or'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table> </td>
    </tr>
  </tbody>
</table>
</div>
</div>
	<div class="form-row">
	<div class="form-group col-sm-6">
	    <label for="businessname" class="col-lg-2 control-label">Site Manager Comments:</label>
	<textarea class="form-control" name="sitemanager_comments" autocomplete="off" rows="8" cols="60"><?php if(isset($details[0]->sitemanager_comments)){ echo $details[0]->sitemanager_comments; } ?></textarea>
	</div>
	<div class="form-group col-sm-6">
	    <label for="businessname" class="col-lg-2 control-label">Site Manager’s Signature :</label>
		<input type="text" class="form-control" name="sitemanager_sign" autocomplete="off" value="<?php if(isset($details[0]->sitemanager_sign)){ echo $details[0]->sitemanager_sign; } ?>">
		</div>
</div>
	<h3 class="panel-title">Does the candidate meet the requirements of the job specification?  To be filed by HR </h3></br>
	
	  <div class="form-row">
            <div class="form-group col-sm-12">
          <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Description</th>
      <th scope="col">Exceeds</th>
      <th scope="col">Fully Meet</th>
      <th scope="col">Not Fully</th>
      <th scope="col">Below</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><b>Education / Experience:</b></td>
       <td><input type="radio" value="4" name="education" <?php echo  ($radion_btn_values['education'] =="4" ? 'checked' : '')?>></td>
        <td><input type="radio" value="3" name="education" <?php echo  ($radion_btn_values['education'] =="3" ? 'checked' : '')?>></td>
         <td><input type="radio" value="2" name="education" <?php echo  ($radion_btn_values['education'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="education" <?php echo  ($radion_btn_values['education'] =="1" ? 'checked' : '')?>></td>
      
     
    </tr>
    <tr>
    <th scope="row">2</th>
      <td><b>Decision Making Initiator : </b></td>
       <td><input type="radio" value="4" name="decision" <?php echo  ($radion_btn_values['decision'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="decision" <?php echo  ($radion_btn_values['decision'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="decision" <?php echo  ($radion_btn_values['decision'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="decision" <?php echo  ($radion_btn_values['decision'] =="1" ? 'checked' : '')?>></td>
      
      
    </tr>
     <tr>
    <th scope="row">3</th>
      <td><b>Customer Service : </b></td>
      <td><input type="radio" value="4" name="cust_service" <?php echo  ($radion_btn_values['cust_service'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="cust_service" <?php echo  ($radion_btn_values['cust_service'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="cust_service" <?php echo  ($radion_btn_values['cust_service'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="cust_service" <?php echo  ($radion_btn_values['cust_service'] =="1" ? 'checked' : '')?>></td>
      
      
    </tr>
    <tr>
    <th scope="row">4</th>
      <td><b>Team Work & Cooperation :</b></td>
      <td><input type="radio" value="4" name="team_work" <?php echo  ($radion_btn_values['team_work'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="team_work" <?php echo  ($radion_btn_values['team_work'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="team_work" <?php echo  ($radion_btn_values['team_work'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="team_work" <?php echo  ($radion_btn_values['team_work'] =="1" ? 'checked' : '')?>></td>
      
      
    </tr>
    <tr>
    <th scope="row">5</th>
      <td><b>Flexibility / Adaptability:</b> 
       <td><input type="radio" value="4" name="flexibility" <?php echo  ($radion_btn_values['flexibility'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="flexibility" <?php echo  ($radion_btn_values['flexibility'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="flexibility" <?php echo  ($radion_btn_values['flexibility'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="flexibility" <?php echo  ($radion_btn_values['flexibility'] =="1" ? 'checked' : '')?>></td>
     
      
    </tr>
    <tr>
    <th scope="row">6</th>
      <td><b>Communication Skills: </b></td>
       <td><input type="radio" value="4" name="communication" <?php echo  ($radion_btn_values['communication'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="communication" <?php echo  ($radion_btn_values['communication'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="communication" <?php echo  ($radion_btn_values['communication'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="communication" <?php echo  ($radion_btn_values['communication'] =="1" ? 'checked' : '')?>></td>
    </tr>
    
     <tr>
    <th scope="row">7</th>
      <td><b>Computer Skills: </b></td>
       <td><input type="radio" value="4" name="computer_skills" <?php echo  ($radion_btn_values['computer_skills'] =="4" ? 'checked' : '')?>></td>
      <td><input type="radio" value="3" name="computer_skills" <?php echo  ($radion_btn_values['computer_skills'] =="3" ? 'checked' : '')?>></td>
      <td><input type="radio" value="2" name="computer_skills" <?php echo  ($radion_btn_values['computer_skills'] =="2" ? 'checked' : '')?>></td>
      <td><input type="radio" value="1" name="computer_skills" <?php echo  ($radion_btn_values['computer_skills'] =="1" ? 'checked' : '')?>></td>
    </tr>
  </tbody>
</table>
</div>
</div>
</br><h3 style="text-align: center;">Evaluation Result </h3></br>
<h3 class="panel-title"><b> Interviewer (1) - HR</b></h3>
	<div class="form-row">
	          		<div class="col-sm-4">
					<label class="radio-inline">
					 <input type="radio" value="recommended" name="result" <?php echo  ($radion_btn_values['result'] =="recommended" ? 'checked' : '')?>> Recommended
					 </label>
                      </div>
                      	<div class="col-sm-4">
                      <label class="radio-inline">
                      <input type="radio" value="slisted" name="result" <?php echo  ($radion_btn_values['result']  =="slisted" ? 'checked' : '')?>> Short Listed  
                      </label>
                      </div>
                      	<div class=" col-sm-4">
                      <label class="radio-inline">
                      <input type="radio" value="rejected" name="result" <?php echo  ($radion_btn_values['result'] =="rejected" ? 'checked' : '')?>> Rejected
                      </label>
                      </div>
                      
						</div>
	<div class="form-row">
					<div class="form-group col-md-4">
						<label for="businessname" class="col-lg-2 control-label">Expected Salary:</label>
						<input type="text" class="form-control" name="expected_salary" autocomplete="off" value="<?php if(isset($details[0]->expected_salary)){ echo $details[0]->expected_salary; } ?>">
						</div>
						<div class="form-group col-md-4">
						<label for="businessname" class="col-lg-2 control-label">Notice Period: </label>
						<input type="text" class="form-control" name="Notice_Period" autocomplete="off" value="<?php if(isset($details[0]->Notice_Period)){ echo $details[0]->Notice_Period; } ?>">
						</div>
					
					</div>
						<div class="form-row">
						<div class="form-group col-md-12">
						<label for="businessname" class="col-lg-2 control-label">Comments:</label>
					  <textarea class="form-control" name="first_interviewer_comment" autocomplete="off" rows="8" cols="60"><?php if(isset($details[0]->first_interviewer_comment)){ echo $details[0]->first_interviewer_comment; } ?></textarea>
						
						</div>
							</div>
								<div class="form-row">
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-3 control-label">Name:</label>
						<input type="text" class="form-control" name="first_interviewer_name" autocomplete="off" value="<?php if(isset($details[0]->first_interviewer_name)){ echo $details[0]->first_interviewer_name; } ?>">
						</div>
						
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Job Title  :</label>
						<input type="text" class="form-control" name="first_interviewer_title" autocomplete="off" value="<?php if(isset($details[0]->first_interviewer_title)){ echo $details[0]->first_interviewer_title; } ?>">
						</div>
						
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Signature  :</label>
						<input type="text" class="form-control" name="first_interviewer_sign" autocomplete="off" value="<?php if(isset($details[0]->first_interviewer_sign)){ echo $details[0]->first_interviewer_sign; } ?>">
						</div>
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Date  :</label>
						<input type="date" class="form-control" name="first_interviewer_signDate" autocomplete="off" value="<?php if(isset($details[0]->first_interviewer_signDate)){ echo $details[0]->first_interviewer_signDate; } ?>">
						</div>
							</div>
							<h3 class="panel-title"><b> Interviewer (2) </b></h3>
	<div class="form-row">
	          		<div class="col-sm-4">
					<label class="radio-inline">
					 <input type="radio" value="int_recommended" name="int_two_result" <?php echo  ($radion_btn_values['int_two_result'] =="int_recommended" ? 'checked' : '')?>> Recommended
					 </label>
                      </div>
                      	<div class="col-sm-4">
                      <label class="radio-inline">
                      <input type="radio" value="slisted" name="int_two_result" <?php echo  ($radion_btn_values['int_two_result'] =="slisted" ? 'checked' : '')?>> Short Listed  
                      </label>
                      </div>
                      	<div class=" col-sm-4">
                      <label class="radio-inline">
                      <input type="radio" value="rejected" name="int_two_result" <?php echo  ($radion_btn_values['int_two_result'] =="rejected" ? 'checked' : '')?>> Rejected
                      </label>
                      </div>
                      
						</div>
	<div class="form-row">
	<div class="form-group col-md-4">
	<label for="businessname" class="col-lg-2 control-label">Comments:</label>
	<textarea class="form-control" name="second_interviewer_comment" autocomplete="off" rows="8" cols="60"><?php if(isset($details[0]->second_interviewer_comment)){ echo $details[0]->second_interviewer_comment; } ?></textarea>
	</div>
	</div>
	<div class="form-row">
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-3 control-label">Name:</label>
						<input type="text" class="form-control" name="second_interviewer_name" autocomplete="off" value="<?php if(isset($details[0]->second_interviewer_name)){ echo $details[0]->second_interviewer_name; } ?>">
						</div>
						
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Job Title  :</label>
						<input type="text" class="form-control" name="second_interviewer_title" autocomplete="off" value="<?php if(isset($details[0]->second_interviewer_title)){ echo $details[0]->second_interviewer_title; } ?>">
						</div>
						
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Signature  :</label>
						<input type="text" class="form-control" name="second_interviewer_sign" autocomplete="off" value="<?php if(isset($details[0]->second_interviewer_sign)){ echo $details[0]->second_interviewer_sign; } ?>">
						</div>
						<div class="form-group col-md-3">
						<label for="businessname" class="col-lg-2 control-label">Date  :</label>
						<input type="date" class="form-control" name="second_interviewer_signDate" autocomplete="off" value="<?php if(isset($details[0]->second_interviewer_signDate)){ echo $details[0]->second_interviewer_signDate; } ?>">
						</div>
							</div>
<?php if($action !='view') { ?>
	<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
				<?php }  ?>
			<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_interview_assesment">
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
<script type="text/javascript">
	$(document).ready(function() { 
	  
	});
</script>
	<style>
	
	@media print
{    
    a,.btn
    {
        display: none !important;
    }
}

 	label.error, label>span{
 		color:red;
 	}
 	.validation_text p{
 	 color: red;
    font-size: 15px;
    font-weight: 600;
 	}
 	.radio-inline input{
 	  margin-right: 6px !important;  
 	}
 	
    </style>
</body>
</html>
