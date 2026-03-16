
	<div class="row item">
			</div>
			
		<?php if(isset($details[0]->Employee_Self_Assessment_id)){ ?>	
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Self_Assessment" enctype="multipart/form-data">
	   <?php } else { ?>
	   <form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Self_Assessment" enctype="multipart/form-data">

	    <?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>PERFORMANCE SELF ASSESSMENT</h3>
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
			        	<h3 class="panel-title"><b>Assessment Details:</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Employee Name:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							    <input type="hidden" name="Employee_Self_Assessment_id" value="<?php if(isset($details[0]->Employee_Self_Assessment_id)){ echo $details[0]->Employee_Self_Assessment_id; } ?>">
								<input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
								<input type="text" class="form-control" name="emp_name" value="<?php if(isset($details[0]->emp_name)){ echo $details[0]->emp_name; } ?>" autocomplete="off" required >
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Date Completed:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" class="form-control datepicker"  name="completed_date"  value="<?php if(isset($details[0]->completed_date)){ echo $details[0]->completed_date; } ?>" autocomplete="off" required>
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">What could you Improve On?<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="improve_on"  value="<?php if(isset($details[0]->improve_on)){ echo $details[0]->improve_on; } ?>"   autocomplete="off" required>
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">What Steps will you take to Achieve this?<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="steps"  value="<?php if(isset($details[0]->steps)){ echo $details[0]->steps; } ?>"   autocomplete="off" required>
							</div>
						</div>
						
					
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">What are your Goals at the Company Moving Forward?</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="goals" value="<?php if(isset($details[0]->goals)){ echo $details[0]->goals; } ?>" >
							</div>
						</div>
						<?php if(isset($details[0]->Employee_Self_Assessment_id)){ ?>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
						<div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Self_Assessment">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		            </div>
		
		
						<?php }else {  ?>
							<div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Self_Assessment">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		</div>
				<?php }  ?>		
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
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#contact_submit").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			emp_name: {
	                required:true
	            },
	        improve_on: {
	                required:true
	            }, 
	        completed_date: {
	        	required:true,
                
            },
	        steps: {
	                required:true
	            },
	        goals: {
	                required:true
	            }   
			},		
			messages: {
			emp_name: {
	                required:"Please provide employee name"
	            },
	        improve_on: {
	                required:"Please provide improve upon "
	            },    
	        completed_date: {
	        	 required:"Please provide completed date",
                
                 },
	        steps: {
	                required:"Please Provide steps"
	            },
	        goals: {
	                required:"Please Provide goals"
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
