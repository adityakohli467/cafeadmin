<?php 
    if(isset($form) && $form == 'view'){ $disable = 'disable';}else{ $disable = ''; }
?>
<div class="row item">
			</div>
		<form class="form-horizontal" id="resume_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/resume_form_submit" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>
				    <?php if(isset($form) && $form == 'view'){ echo 'View Resume'; }
				          else if(isset($form) && $form == 'edit'){ echo 'Edit Resume'; }
				          else { echo 'Add Resume'; }?>
				</h3>
			</span>
				
		</div>
		<div class="col-md-3">
		    <a href="<?php echo base_url('HR/index.php/admin/resumes'); ?>">
			<button type="button" class="btn btn-success btn-ph">Back</button></a>
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
			        	<h3 class="panel-title"><b>Resume Details</b></h3>
			        		<input type="hidden" name="resume_id" value="<?php if(isset($resume[0]->resume_id)){ echo $resume[0]->resume_id; }?>" >
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Name of candidate:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" <?php echo $disable; ?> class="form-control" name="candidate_name" value="<?php if(isset($resume[0]->candidate_name)){ echo $resume[0]->candidate_name; }?>" autocomplete="off" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Email:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" <?php echo $disable; ?> class="form-control" name="email"  value="<?php if(isset($resume[0]->email)){ echo $resume[0]->email; }?>" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Phone:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" <?php echo $disable; ?> class="form-control" name="phone" value="<?php if(isset($resume[0]->phone)){ echo $resume[0]->phone; }?>"  autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Job role:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" <?php echo $disable; ?> class="form-control" name="job_role"  value="<?php if(isset($resume[0]->job_role)){ echo $resume[0]->job_role; }?>" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label"><?php if(isset($form) && $form != 'view'){ echo "Upload"; } ?> Resume:</label>
						
							    <?php if(isset($form) && $form == 'view'){ ?>
							    <div class="col-lg-4 col-sm-12">
							        <a href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->resume; ?>" target="_blank" class="btn btn-success ">View Resume</a> 
							        </div>
							       <div class="col-lg-4 col-sm-12">
							        <a href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->resume; ?>" download class="btn btn-success ">Download Resume</a>
								</div>
								<?php } else{ ?>
								<div class="col-lg-8 col-sm-12">
								<input type="file" class="form-control" name="resume"  autocomplete="off">
								</div>
								<?php } ?>
							
						</div>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label"><?php if(isset($form) && $form != 'view'){ echo "Upload"; } ?> cover letter:</label>
							
							    <?php if(isset($form) && $form == 'view'){ ?>
							    <div class="col-lg-4 col-sm-12">
							        <a href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->cover_letter; ?>" target="_blank" class="btn btn-success">View Cover Letter</a>
							       </div>
							       <div class="col-lg-4 col-sm-12">
							        <a href="<?php echo base_url(); ?>assets/job_resumes/<?php echo $resume[0]->cover_letter; ?>" download class="btn btn-success">Download Cover Letter</a>
								</div>
								<?php } else{ ?>
								<div class="col-lg-8 col-sm-12">
								    <input type="file" class="form-control" name="cover_letter" autocomplete="off">
								    </div>
							    <?php } ?>
							
						</div>
					
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Notes:</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" <?php echo $disable; ?> class="form-control" name="notes" value="<?php if(isset($resume[0]->notes)){ echo $resume[0]->notes; }?>" >
							</div>
						</div>
						
						<?php if(isset($form) && $form == 'edit'){ ?>
						<div class="btn-div col-lg-12 col-sm-12">
			                <button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Update Resume</button>
					
		                </div>
						<?php }
				          else if(isset($form) && $form == 'add'){ ?>
				          <div class="btn-div col-lg-12 col-sm-12">
			                <button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Add New Resume</button>
					
		                </div>
				          <?php }
				          else { }?>
						
						
	          		</div>
        		</div>
	        </div>
	    </div>
	</div>
  
   </div>
  </form>
  <br>
<script type="text/javascript">

	$(document).ready(function() { 
	    <?php if(isset($form) && $form == 'add'){ ?>
	    $("#resume_form").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			
	        resume: {
	                required:true
	            },
	        cover_letter: {
	                required:true
	            }   
			},		
			messages: {
			resume: {
	                required:"Please upload resume"
	            },
	        cover_letter: {
	                required:"Please upload the cover letter"
	            },    
	          
			}

	    });	
	    <?php } ?>
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
