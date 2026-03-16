<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<div class="row item">
			</div>
			
	<?php if(isset($details[0]->covid_id)){ ?>
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_covid" enctype="multipart/form-data">
	<?php } else {?>
	
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/add_covid" enctype="multipart/form-data">

	<?php } ?>
	
	
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>COVID CHECKLIST</h3>
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
			        	<h3 class="panel-title"><b>COVID CHECKLIST</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Staff Name: <span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							   
							    <input type="hidden" name="covid_id" value="<?php if(isset($details[0]->covid_id)){ echo $details[0]->covid_id; } ?>">
							     <input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
								<input type="text" class="form-control" name="staff_name" autocomplete="off" required  value="<?php if(isset($details[0]->staff_name)){ echo $details[0]->staff_name; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Date:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
		
			<input type="date" class="form-control datetime"  name="reporting_date"  autocomplete="off" required  value="<?php if(isset($details[0]->reporting_date)){ echo $details[0]->reporting_date; } ?>">
							</div>
						</div>
						
						<div class="form-group ">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Time :<span>*</span></label>
							<div class="col-lg-8 col-sm-12  input-group date datetimepicker3">
								<span class="input-group-addon" style="padding: 6px 19px !important;">
                                 <span class="glyphicon glyphicon-time"></span>
                              </span>
								<input type="text" class="form-control" name="reporting_time"  style="z-index: 1 !important;" required value="<?php if(isset($details[0]->reporting_time)){ echo $details[0]->reporting_time; } ?>">
							
							</div>
						</div>
						<div class="form-group">
							
					<div class="checkbox">
					<p>1) Fever (If you have a thermometer, take your own temperature. You are considered to have a fever if above 37°5C)</p>
					<label class="checkbox-inline">
					    
                       <input type="checkbox" value="1" name="temperature"  <?php if(isset($details[0]->temperature) && $details[0]->temperature == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="temperature" <?php if(isset($details[0]->temperature) && $details[0]->temperature == 0){  ?>checked="checked" <?php } ?>> No
                      </label>
                      
                      
					</div>
					
						</div>
						
						
						<div class="form-group">
							
					<div class="checkbox">
					<p>2) Chills</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="Chills" <?php if(isset($details[0]->Chills) && $details[0]->Chills == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="Chills" <?php if(isset($details[0]->Chills) && $details[0]->Chills == 0){  ?>checked="checked" <?php } ?>> No
                      </label>
                      
                      
					</div>
					
						</div>
						
						
						<div class="form-group">
							
					<div class="checkbox">
					<p>3) Cough</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="Cough" <?php if(isset($details[0]->Cough) && $details[0]->Cough == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="Cough" <?php if(isset($details[0]->Cough) && $details[0]->Cough == 0){  ?>checked="checked" <?php } ?>> No
                      </label>
                      
                      
					</div>
					
						</div>
						
						
				<div class="form-group">
							
					<div class="checkbox">
					<p>4) Sore throat</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="sore_throat" <?php if(isset($details[0]->sore_throat) && $details[0]->sore_throat == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="sore_throat" <?php if(isset($details[0]->sore_throat) && $details[0]->sore_throat == 0){  ?>checked="checked" <?php } ?>> No
                      </label>
                      
                      
					</div>
					
				</div>
						
						
				<div class="form-group">
					<div class="checkbox">
					<p>5)Shortness of breath</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="breath" <?php if(isset($details[0]->breath) && $details[0]->breath == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="breath" <?php if(isset($details[0]->breath) && $details[0]->breath == 0){  ?>checked="checked" <?php } ?>> No
                      </label>

					</div>
			</div>
			
				<div class="form-group">
					<div class="checkbox">
					<p>6) Runny nose</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="running_nose" <?php if(isset($details[0]->running_nose) && $details[0]->running_nose == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="running_nose" <?php if(isset($details[0]->running_nose) && $details[0]->running_nose == 0){  ?>checked="checked" <?php } ?>> No
                      </label>

					</div>
			</div>
			
			<div class="form-group">
					<div class="checkbox">
					<p>7) Loss of sense of smell</p>
					<label class="checkbox-inline">
                       <input type="checkbox" value="1" name="smell" <?php if(isset($details[0]->smell) && $details[0]->smell == 1){  ?>checked="checked" <?php } ?>> Yes </label>
                      <label class="checkbox-inline">
                      <input type="checkbox" value="0" name="smell" <?php if(isset($details[0]->smell) && $details[0]->smell == 0){  ?>checked="checked" <?php } ?>> No
                      </label>

					</div>
			</div>
						
							
						
					
						
					
							
						<?php if(isset($details[0]->covid_id)){ ?>
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label"> Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
						<div class="btn-div col-lg-12 col-sm-12">
			               <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
					
						<?php } else { ?>
						
					<div class="btn-div col-lg-12 col-sm-12">
			               <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
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

<style>
.checkbox p{
    color:black !important;
    font-weight:600;
    
}

.checkbox-inline{
    
    text-align: center !important;
}
</style>
</body>
</html>
