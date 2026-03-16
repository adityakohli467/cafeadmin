<link rel="stylesheet" type="text/css" href="<?php echo base_url('HR/assets/css/onboarding.css'); ?>">
    
    <div id='loader' style='display: none;'>
  <img src="<?php echo base_url() ?>images/ajax-loader.gif" width='32px' height='32px'>
</div>
	
	
	<div  class="col-md-12 page-head page-head-sticky border-bottom btns-row survey-header">
		
			<span class="text-center">
				<h3>Survey</h3>
			</span>
		<?php if($survey[0]->status == 1){ ?>
		    <a href="<?php echo base_url(); ?>index.php/admin/survey_list">
			<button type="button" class="btn btn-success btn-ph">Back</button></a>
		<?php } ?>
      
	</div>
	
<div class="container main-container survey">
    <form  role="form" id="surveyForm" method="post" action="" enctype="multipart/form-data">
		<div class="row">
  			<div class="col-lg-12">
          <h3>Please complete this employee questionnaire as conducted by (Zouki). All information will be kept confidential. Any concerns can be communicated to the Human Resources manager. Thank you for your time and cooperation.</h3>
  			  <p>Answer the following questions by circling the most appropriate answer</p>  
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>1. You have the resources necessary to do your job well</p>
                            
                          <label for="disagree-input"><input type="radio" id="disagree-input" value="disagree" name="resources" <?php if($survey[0]->resources == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="neutral-input"><input type="radio" id="neutral-input" value="neutral" name="resources" <?php if($survey[0]->resources == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="agree-input"><input type="radio" id="agree-input" value="agree" name="resources" <?php if($survey[0]->resources == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="resources-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>2. Help and Support are easily accessed.</p>
                            
                          <label for="support-disagree-input"><input type="radio" id="support-disagree-input" value="disagree" name="support" <?php if($survey[0]->support == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="support-neutral-input"><input type="radio" id="support-neutral-input" value="neutral" name="support" <?php if($survey[0]->support == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="support-agree-input"><input type="radio" id="support-agree-input" value="agree" name="support" <?php if($survey[0]->support == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="support-error"></span>
                        </div>
                                
                    </div>
            </div>


            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>3. Training options are offered.</p>
                            
                          <label for="trainingOptions-disagree-input"><input type="radio" id="trainingOptions-disagree-input" value="disagree" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="trainingOptions-neutral-input"><input type="radio" id="trainingOptions-neutral-input" value="neutral" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="trainingOptions-agree-input"><input type="radio" id="trainingOptions-agree-input" value="agree" name="trainingOptions" <?php if($survey[0]->trainingOptions == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="trainingOptions-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>What types of training would you like to see?</p>
                            <input type="text" id="trainingType-agree-input" class="form-control" name="trainingType" value="<?php echo $survey[0]->trainingType; ?>">
                            <span class="fieldError" id="trainingType-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>4. Your working conditions are safe and non- hazardous</p>
                            
                          <label for="workingConditions-disagree-input"><input type="radio" id="workingConditions-disagree-input" value="disagree" name="workingConditions" <?php if($survey[0]->workingConditions == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="workingConditions-neutral-input"><input type="radio" id="workingConditions-neutral-input" value="neutral" name="workingConditions" <?php if($survey[0]->workingConditions == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="workingConditions-agree-input"><input type="radio" id="workingConditions-agree-input" value="agree" name="workingConditions" <?php if($survey[0]->workingConditions == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="workingConditions-error"></span>
                        </div>
                                
                    </div>
            </div>

            

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>5. You have been given instructions on emergency safety procedures</p>
                            
                          <label for="emergencyInst-disagree-input"><input type="radio" id="emergencyInst-disagree-input" value="disagree" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="emergencyInst-neutral-input"><input type="radio" id="emergencyInst-neutral-input" value="neutral" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="emergencyInst-agree-input"><input type="radio" id="emergencyInst-agree-input" value="agree" name="emergencyInst" <?php if($survey[0]->emergencyInst == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="emergencyInst-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>6. Requirements of your job are clear</p>
                            
                          <label for="clearRequirements-disagree-input"><input type="radio" id="clearRequirements-disagree-input" value="disagree" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="clearRequirements-neutral-input"><input type="radio" id="clearRequirements-neutral-input" value="neutral" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="clearRequirements-agree-input"><input type="radio" id="clearRequirements-agree-input" value="agree" name="clearRequirements" <?php if($survey[0]->clearRequirements == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="clearRequirements-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>7. Communication with other employees/managers is easy</p>
                            
                          <label for="communication-disagree-input"><input type="radio" id="dcommunication-isagree-input" value="disagree" name="communication" <?php if($survey[0]->communication == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="communication-neutral-input"><input type="radio" id="communication-neutral-input" value="neutral" name="communication" <?php if($survey[0]->communication == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="communication-agree-input"><input type="radio" id="communication-agree-input" value="agree" name="communication" <?php if($survey[0]->communication == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="communication-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>8. Your manager is approachable and supportive</p>
                            
                          <label for="approachableManager-disagree-input"><input type="radio" id="approachableManager-disagree-input" value="disagree" name="approachableManager" <?php if($survey[0]->approachableManager == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="approachableManager-neutral-input"><input type="radio" id="approachableManager-neutral-input" value="neutral" name="approachableManager" <?php if($survey[0]->approachableManager == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="approachableManager-agree-input"><input type="radio" id="approachableManager-agree-input" value="agree" name="approachableManager" <?php if($survey[0]->approachableManager == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="resources-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>9. The following acts are unlawful and may end your employment immediately: Bullying, Sexual harassment, Discrimination. </p>
                            
                          <label for="unlawfulAct-disagree-input"><input type="radio" id="unlawfulAct-disagree-input" value="disagree" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="unlawfulAct-neutral-input"><input type="radio" id="unlawfulAct-neutral-input" value="neutral" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="unlawfulAct-agree-input"><input type="radio" id="unlawfulAct-agree-input" value="agree" name="unlawfulAct" <?php if($survey[0]->unlawfulAct == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="unlawfulAct-error"></span>
                        </div>
                                
                    </div>
            </div>

            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>10. The company policies and procedures are updated on the HR portal and it’s my responsibility to read them and adhere to all policies </p>
                            
                          <label for="updatedPolicies-ddisagree-input"><input type="radio" id="updatedPolicies-disagree-input" value="disagree" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="updatedPolicies-neutral-input"><input type="radio" id="updatedPolicies-neutral-input" value="neutral" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="updatedPolicies-agree-input"><input type="radio" id="updatedPolicies-agree-input" value="agree" name="updatedPolicies" <?php if($survey[0]->updatedPolicies == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="updatedPolicies-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>11. It’s my responsibility to report any accident while on duty:</p>
                            
                          <label for="reportAccident-disagree-input"><input type="radio" id="reportAccident-disagree-input" value="disagree" name="reportAccident" <?php if($survey[0]->reportAccident == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="reportAccident-neutral-input"><input type="radio" id="reportAccident-neutral-input" value="neutral" name="reportAccident" <?php if($survey[0]->reportAccident == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="reportAccident-agree-input"><input type="radio" id="reportAccident-agree-input" value="agree" name="reportAccident" <?php if($survey[0]->reportAccident == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="reportAccident-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>12. Abuse alcohol or drugs whilst on Zouki premises may terminate your employment immediately:</p>
                            
                          <label for="terminate-disagree-input"><input type="radio" id="terminate-disagree-input" value="disagree" name="terminate" <?php if($survey[0]->terminate == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="terminate-neutral-input"><input type="radio" id="terminate-neutral-input" value="neutral" name="terminate" <?php if($survey[0]->terminate == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="terminate-agree-input"><input type="radio" id="terminate-agree-input" value="agree" name="terminate" <?php if($survey[0]->terminate == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="terminate-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>13. I feel valued and affirmed at work:</p>
                            
                          <label for="feelValued-disagree-input"><input type="radio" id="feelValued-disagree-input" value="disagree" name="feelValued" <?php if($survey[0]->feelValued == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="feelValued-neutral-input"><input type="radio" id="feelValued-neutral-input" value="neutral" name="feelValued" <?php if($survey[0]->feelValued == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="feelValued-agree-input"><input type="radio" id="feelValued-agree-input" value="agree" name="feelValued" <?php if($survey[0]->feelValued == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="feelValued-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>14. My values fit with the organizational values:</p>
                            
                          <label for="organizationalValues-disagree-input"><input type="radio" id="organizationalValues-disagree-input" value="disagree" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="organizationalValues-neutral-input"><input type="radio" id="organizationalValues-neutral-input" value="neutral" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="organizationalValues-agree-input"><input type="radio" id="organizationalValues-agree-input" value="agree" name="organizationalValues" <?php if($survey[0]->organizationalValues == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="organizationalValues-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>15. Creativity and innovation are supported:</p>
                            
                          <label for="creativity-disagree-input"><input type="radio" id="creativity-disagree-input" value="disagree" name="creativity" <?php if($survey[0]->creativity == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="creativity-neutral-input"><input type="radio" id="creativity-neutral-input" value="neutral" name="creativity" <?php if($survey[0]->creativity == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="creativity-agree-input"><input type="radio" id="creativity-agree-input" value="agree" name="creativity" <?php if($survey[0]->creativity == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="creativity-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>16. My manager reviews my progress:</p>
                            
                          <label for="progresReviewed-sdisagree-input"><input type="radio" id="progresReviewed-disagree-input" value="disagree" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="progresReviewed-neutral-input"><input type="radio" id="progresReviewed-neutral-input" value="neutral" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="progresReviewed-agree-input"><input type="radio" id="progresReviewed-agree-input" value="agree" name="progresReviewed" <?php if($survey[0]->progresReviewed == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="progresReviewed-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>17. I am fairly compensated:</p>
                            
                          <label for="compensated-disagree-input"><input type="radio" id="compensated-disagree-input" value="disagree" name="compensated" <?php if($survey[0]->compensated == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="compensated-neutral-input"><input type="radio" id="compensated-neutral-input" value="neutral" name="compensated" <?php if($survey[0]->compensated == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="compensated-agree-input"><input type="radio" id="compensated-agree-input" value="agree" name="compensated" <?php if($survey[0]->compensated == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="compensated-error"></span>
                        </div>
                                
                    </div>
            </div>
            <div class="section-wrap">
                  <div class="form-row">
                        <div class="checkbox-group col-md-12" >
                            <p>18. Zouki always expects its employee’s treating colleagues in a professional manner:</p>
                            
                          <label for="professional-disagree-input"><input type="radio" id="professional-disagree-input" value="disagree" name="professional" <?php if($survey[0]->professional == 'disagree') echo"checked"; ?>> Disagree</label>
                          <label for="professional-neutral-input"><input type="radio" id="professional-neutral-input" value="neutral" name="professional" <?php if($survey[0]->professional == 'neutral') echo"checked"; ?>> Neutral</label>
                          <label for="professional-agree-input"><input type="radio" id="professional-agree-input" value="agree" name="professional" <?php if($survey[0]->professional == 'agree') echo"checked"; ?>> Agree</label>
                            <span class="fieldError" id="professional-error"></span>
                        </div>
                                
                    </div>
            </div>
            <?php if($survey[0]->status != 1){ ?>
            	<input type="button" name="survey-submit" id="survey_submit" class="btn btn-success btn-ph" value="Submit">
            	<?php } ?>
        </div>
  		</div>
  			</form>
        
	    
	    	
	</div>
<script>
    	$('#survey_submit').click(function(){
    
        var data1 = $('#surveyForm').serialize();
        
        $.ajax({
            type: "POST",
        	enctype: 'multipart/form-data',
        	url: "<?php echo base_url(); ?>index.php/admin/submit_survey_form/",
        	data: data1,
        	beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
        	success: function(data){ console.log(data); 
        	    if(data=='success'){
		        $msg = "Thank you for submitting Survey.";
		        $icon = "success";
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
                  window.location = "<?php echo base_url(); ?>index.php/admin/survey_form/<?php echo $survey[0]->emp_id;?>";
                   }
               });
               
        	}
        	
        }); 
		
	});
	
	
</script>