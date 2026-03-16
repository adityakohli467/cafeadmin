	<div class="row item">
			</div>
		<form class="form-horizontal"  role="form" method="post" action="<?php echo base_url(); ?>index.php/employees/submit_leave" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom ct-header">
		<span class="text-center">
				<h3>ADD NEW LEAVE REQUEST</h3>
			</span>
		<div class="ct-top-btn">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/employees/emp_dashboard">
						<button type="button"  class="btn btn-success btn-ph btn-ph-cancel">CANCEL</button>
					</a>
					</div>
		
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
	<?php echo validation_errors(); ?>
	<?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
				<div class='hideMe'>
					<p class="alert alert-success"><?php echo 'Your Leave Request has been sent'; ?></p>
				</div>
				<?php } ?>
				<?php if(null !==$this->session->userdata('error_msg')) { ?>  
				<div class='hideMe'>
					<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
				</div>
				<?php } ?>
	  		<div class="row">
			
  			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">LEAVE DETAILS</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Leave Type:<span>*</span></label>
							<div class="col-sm-8">
								<select name="leave_type" class="form-control" onchange="yesnoCheck(this);" required>
									<option value="">Select</option>
									<option value="Annual">Annual Leave</option>
									<option value="Sick">Sick Leave</option>
									<option value="Long Service Leave">Long Service Leave</option>
									<option value="Day Off">Day Off</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
						<div id="ifYes" style="display: none;">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Upload Medical Certificate<span>*</span></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="med_certificate"  >
							</div>
						</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Start Date:<span>*</span></label>
							<div class="col-sm-8">
						<input type="date" class="form-control datetime" name="start_date" placeholder='Start Date' autocomplete="off" required>
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-sm-4 control-label">End Date:<span>*</span></label>
							<div class="col-sm-8">
							<input type="date" class="form-control datetime" name="end_date" placeholder='End Date' autocomplete="off" required>
							</div>
						</div>
							<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/employees/emp_dashboard">
					
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
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#employee_add").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			leave_type: {
	                required:true
	            },
			med_certificate: {
	                required:true
	            },	
	        start_date: {
	                required:true
	            }, 	       
	        end_date: {
	                required:true
	            }    
			},		
			messages: {
			leave_type: {
	                required:"Please provide the leave type"
	            },
			med_certificate: {
	                required:"Please upload the medical certificate"
	            },	
	        start_date: {
	                required:"Please select the start date"
	            },    
	        end_date: {
	                required:"Please select the end date"
	            }    
			}

	    });	
	});
</script>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
		<script>
    function yesnoCheck(that) {
        if (that.value == "Sick") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>
	<script type="text/javascript">
$(document).ready(function(){
 
  $('#datepicker').datepicker({
   format: "d-m-Y",
   startDate: '-1y -1m',
   endDate: '+2m +10d'
  });

  $('#datepicker2').datepicker({
   format: "d-m-Y",
   startDate: '-1m',
   endDate: '+10d'
  }); 
});
</script>
</body>
</html>
