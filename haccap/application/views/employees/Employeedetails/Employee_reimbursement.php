
	<div class="row item">
			</div>
	<?php if(isset($details[0]->Employee_reimbursement_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Employee_reimbursement" enctype="multipart/form-data">
	<?php } else { ?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Employee_reimbursement" enctype="multipart/form-data">

	<?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>REIMBURSEMENT REQUEST</h3>
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
			        	<h3 class="panel-title"><b>Reimbursement Details</b></h3>
			        </div>
	          		<div class="panel-body">
	          		    
	          		    	<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Receipts:</b></label>
							
							<div class="col-sm-8">
							    <input type="file" class="form-control" name="receipt">
							    <?php if((isset($details[0]->receipt)) && ($details[0]->receipt !='') && (file_exists("./uploaded_files/".$details[0]->receipt))) {  ?>
							    <a style="width:20%;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $details[0]->receipt; ?>" target="_blank">View</a>
								 <?php } ?>
								
								
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Employee Name:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							    <input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">
		                        <input type="hidden" name="Employee_reimbursement_id" value="<?php if(isset($details[0]->Employee_reimbursement_id)){ echo $details[0]->Employee_reimbursement_id; } ?>">
								<input type="text" class="form-control" name="emp_name" autocomplete="off" required value="<?php if(isset($details[0]->emp_name)){ echo $details[0]->emp_name; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Select Date:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" class="form-control datepicker"  name="completed_date"  autocomplete="off" required value="<?php if(isset($details[0]->completed_date)){ echo $details[0]->completed_date; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Total Reimbursement:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="total_reimbursement"  autocomplete="off" required value="<?php if(isset($details[0]->total_reimbursement)){ echo $details[0]->total_reimbursement; } ?>">
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Reason:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" name="reason"  autocomplete="off" required value="<?php if(isset($details[0]->reason)){ echo $details[0]->reason; } ?>">
							</div>
						</div>
						
					
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Approved Business Manager:</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="business_manager" value="<?php if(isset($details[0]->business_manager)){ echo $details[0]->business_manager; } ?>">
							</div>
						</div>
						
							<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Date BR Signed:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" class="form-control datepicker"  name="br_date"  autocomplete="off" required value="<?php if(isset($details[0]->br_date)){ echo $details[0]->br_date; } ?>">
							</div>
						</div>
						
						<?php if(isset($details[0]->Employee_reimbursement_id)){ ?>	
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Employee_reimbursement">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
					<?php } else { ?>
						
							<div class="btn-div col-lg-12 col-sm-12">
			<button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Employee_reimbursement">
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
