
	<div class="row item">
			</div>
	<?php if(isset($details[0]->Jobkeeper_Nomination_Notice_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Jobkeeper_Nomination_Notice" enctype="multipart/form-data">
	<?php } else {?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Jobkeeper_Nomination_Notice" enctype="multipart/form-data">

	<?php } ?>	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>JOBKEEPER EMPLOYEE NOMINATION NOTICE INFORMATION</h3>
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
			        	<h3 class="panel-title"><b>JobKeeper Employee Nomination Notice Details</b></h3>
			        </div>
	          		<div class="panel-body">
	          		    
	          		    	<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Business Name:</label>
							
							<div class="col-lg-8 col-sm-12">
					     <input type="hidden" name= "Jobkeeper_Nomination_Notice_id" value="<?php if(isset($details[0]->Jobkeeper_Nomination_Notice_id)){ echo $details[0]->Jobkeeper_Nomination_Notice_id; } ?>">
				    <input type="hidden" name="emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">

						<input type="text" readonly class="form-control" name="business_name" autocomplete="off" required value="<?php if(isset($details[0]->business_name)){ echo $details[0]->business_name; } ?>" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Business ABN:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="business_abn" autocomplete="off" required value="<?php if(isset($details[0]->business_abn)){ echo $details[0]->business_abn; } ?>" >
							</div>
						</div>
						
					<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Employee Full Name:</label>
							
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="emp_full_name" autocomplete="off" required value="<?php if(isset($details[0]->emp_full_name)){ echo $details[0]->emp_full_name; } ?>" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label"> Date of Birth:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				<input type="text" readonly class="form-control datepicker"  name="dob"  autocomplete="off" required value="<?php if(isset($details[0]->dob)){ echo $details[0]->dob; } ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Street Address:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<textarea name="street_addr" rows="5" cols="50" required ><?php if(isset($details[0]->street_addr)){ echo $details[0]->street_addr; } ?></textarea>
							</div>
						</div>
						
							<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Contact Phone Number:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="phone_no"  autocomplete="off" required value="<?php if(isset($details[0]->phone_no)){ echo $details[0]->phone_no; } ?>">
							</div>
						</div>
						
					
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Contact Email:</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="contact_email" required value="<?php if(isset($details[0]->contact_email)){ echo $details[0]->contact_email; } ?>">
							</div>
						</div>
						
						<div class="col-lg-12 col-md-12">
	               <div class="panel pn">
        			
	          		<div class="panel-body">
						<div class="form-group">
							<div>
						    <p>You agree to be nominated as an eligible employee of the employer listed for the purposes of the JobKeeper Payment scheme
You have not agreed to be nominated by any other employer/entity and have not given another entity a nomination form for the purpose of the JobKeeper Payment scheme
You do not wish to be nominated for the JobKeeper Allowance
Employee eligibility requirements To be an eligible employee, you need to meet these requirements.</p>
<p>
    You are currently employed by the employer outlined in section A (including those stood down or re hired).
You were employed by the employer outlined in section A at 1 March 2020.
As at 1 March 2020, you were a permanent or fixed term employee, or a casual employee employed on a regular and systematic basis during the period of 12 months ending on 1 March 2020.
If you are a casual employee as mentioned above, you are not employed by any other employer on a permanent or fixed term basis, or you are only employed by any other employer on a casual basis.
You were at least 16 years of age as at 1 March 2020.
</p>
<p>
    As at 1 March 2020 you were residing in Australia and an Australian citizen or permanent resident, or, an Australian resident for income tax purposes and a Subclass 444 (Special Category) visa holder.
You are not in receipt of a JobKeeper payment as a sole trader, nor is another employer or eligible business in receipt of a JobKeeper payment for you.
You are not currently receiving parental leave pay or dad and partner pay, and you are not currently totally incapacitated for work and receiving payments under an Australian workers’ compensation law in respect of your total incapacity to work.
You meet the eligibility requirements of JobKeeper Payment

</p>


							<div class="checkbox">
								  <label><input type="checkbox" value="1" name="agree_terms_one" checked="">I declare that the information I have provided is true and correct.</label>
							</div>
							</div>	
						</div>
						
	          		</div>
        	  </div>
	  </div>
				<?php if(isset($details[0]->Jobkeeper_Nomination_Notice_id)){ ?>	
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
							<div class="btn-div col-lg-12 col-sm-12">
		
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Jobkeeper_Nomination_Notice">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		</div>
				
		
		<?php  } ?>
						
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
 
    </style>
</body>
</html>
