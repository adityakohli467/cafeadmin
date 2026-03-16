<?php 
// echo "<pre>"; print_r($details); exit;
// ?>
<div class="row item">
			</div>
		<?php if(isset($details[0]->id)){ ?>		
		<form class="form-horizontal" id="job_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/post_job/<?php echo $details[0]->id; ?>/<?php echo $type; ?>" enctype="multipart/form-data">
		    
	<?php } else {?>
	<form class="form-horizontal" id="job_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/post_job" enctype="multipart/form-data">

	<?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>POST NEW JOB</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
   
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-12">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title" style="text-align:center"><b>Job Details</b></h3>
			        </div>
	          		<div class="panel-body ctm-from">
	          		    <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
	          		 <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Job title *</label> <input id="form_name" <?php echo $disabled; ?> type="text" name="job_name" value="<?php if(isset($details[0]->job_name)){ echo $details[0]->job_name; } ?>" class="form-control"  required="required"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="start_date">Effective start date *</label> <input id="start_date" <?php echo $disabled; ?> type="date" class="form-control"  name="start_date" required="required" value="<?php  if(isset($details[0]->start_date)){ echo date("Y-m-d",strtotime($details[0]->start_date)); } ?>"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="salary">Salary *</label> <input id="salary" type="text" <?php echo $disabled; ?> name="salary"   value="<?php if(isset($details[0]->salary)){ echo $details[0]->salary; } ?>" class="form-control"  required="required"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Job type: *</label> <select id="form_need" <?php echo $disabled; ?> name="job_type" class="form-control" required="required">
                                               	<option selected="selected" value="full_time">Full Time</option>
								  	<option value="part_time">Part Time</option>
								     <option value="casual">Casual</option>
                                            </select> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="job_desc">Job description *</label> <textarea id="job_desc" <?php echo $disabled; ?>  class="form-control"  rows="4" required="required" name="job_desc"  ><?php if(isset($details[0]->job_desc)){ echo $details[0]->job_desc; } ?></textarea> </div>
                                    </div>
                                     
                                    
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group"> <label for="responsibilites">Responsibilities </label> <textarea id="responsibilites"  <?php echo $disabled; ?> class="form-control"   name="responsibilites" rows="4"  ><?php if(isset($details[0]->responsibilites)){ echo $details[0]->responsibilites; } ?></textarea> </div>
                                    </div>
                                     </div>
                                      <div class="row">
                                <div class="col-md-9">
                                        <div class="form-group"> <label for="additional_info">Additional info </label> <textarea id="additional_info" <?php echo $disabled; ?> class="form-control"   name="additional_info" rows="4" ><?php if(isset($details[0]->additional_info)){ echo $details[0]->additional_info; } ?></textarea> </div>
                                    </div>
                                   
                                     </div>
                                     
                                     <div class="row">
                                         <?php if($disabled == '') {  ?>
								<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
								 <?php } ?>
										<a href="<?php echo base_url(); ?>index.php/admin/manage_careers">
											<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
										</a>
							</div>
                                
                            </div>
						</div>
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
