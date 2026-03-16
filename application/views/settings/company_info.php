<?php  ?>
<?php if(null !==$this->session->userdata('sucess_msg')){ ?>
	  <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $this->session->userdata('sucess_msg');?>
      </div>
  <?php } ?>

<form method="post" class="additional_form form-horizontal" action="<?php echo base_url() ?>index.php/settings/updateCompanyDetails" id="additional_form">
	<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Company Info</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" class="btn btn-success btn-ph">Save</button>
		</div>
	</div><!--.col-md-12 -->
<div class="container-fluid main-container">
               
	<div class="row">
		
	   <div class="col-md-12">
		   <div class="col-md-6">	   
		  	<div class="panel pn">
		  		<div class="gradient"></div>
		        <div class="panel-heading">
		        	<h3 class="panel-title">Company Info</h3>
		        </div>
		  		<div class="panel-body">
					    <div class="form-group">
						<label for="abn" class="col-sm-4 control-label">First Name</label>
					      <div class="col-sm-8">
					        <input type="text" name="first_name" id="first_name" value="<?php echo $customer_details->firstName;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						<label class="col-sm-4 control-label">Last Name</label>
					      <div class="col-sm-8">
					        <input type="text" name="last_name" id="last_name" value="<?php echo $customer_details->lastName;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						  <label class="col-sm-4 control-label">Email</label>
					      <div class="col-sm-8">
					        <input type="text" name="email" id="email" value="<?php echo $customer_details->email;?>" class ='form-control' readonly>
					      </div>
					      <?php if($customer_details->email_verification == "0"){ ?>
					      <div class="col-sm-4">
					        <a onclick="resendLink(<?php echo $this->session->userdata('user_id');?>)">click here</a> To resend link
					      </div>
					      <?php } ?>
					    </div>
					    <div class="form-group">
						  <label class="col-sm-4 control-label">Mobile</label>
					      <div class="col-sm-8">
					        <input type="text" name="mobile" id="mobile" value="<?php echo $customer_details->mobile;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						  <label class="col-sm-4 control-label">Business Name<span>*</span></label>
					      <div class="col-sm-8">
					        <input type="text" name="business_name" id="branch_name" value="<?php echo $customer_details->business_name;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						 <label class="col-sm-4 control-label">Brand Name</label>
					      <div class="col-sm-8">
					        <input type="text" name="brand_name" id="brand_name" value="<?php echo $customer_details->brand_name;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						 <label class="col-sm-4 control-label">ABN</label>
					      <div class="col-sm-8">
					        <input type="text" name="abn" id="abn" value="<?php echo $customer_details->abn;?>" class ='form-control'>
					      </div>
					    </div>
					    <div class="form-group">
						 <label class="col-sm-4 control-label">Website</label>
					      <div class="col-sm-8">
					        <input type="text" name="website" id="website" value="<?php echo $customer_details->website;?>" class ='form-control'>
					      </div>
					    </div>
				    </div>
				  </div>
				</div>
				<div class="col-md-6">
						<div class="panel pn">
							<div class="gradient"></div>
					        <div class="panel-heading">
					        	<h3 class="panel-title">Address</h3>
					        </div>
					  		<div class="panel-body">
								<div class="form-group">
								 <label class="col-sm-4 control-label">Unit No.</label>
							      <div class="col-sm-8">
							        <input type="text" name="unit" id="unit" value="<?php echo $customer_details->unit;?>" class ='form-control' placeholder="" value="">
							      </div>
							    </div>
							    <div class="form-group">
								  <label class="col-sm-4 control-label">Street</label>
							      <div class="col-sm-8">
							        <input type="text" name="street" id="street" value="<?php echo $customer_details->street;?>" class ='form-control' placeholder="" value="">
							      </div>
							    </div>
							    <div class="form-group">
								  <label class="col-sm-4 control-label">Suburb</label>
							      <div class="col-sm-8">
							        <input type="text" name="suburb" id="suburb" value="<?php echo $customer_details->suburb;?>" class ='form-control' placeholder="" value="">
							      </div>
							    </div>
							    <div class="form-group">
								 <label class="col-sm-4 control-label">Postcode</label>
							      <div class="col-sm-8">
							        <input type="text" name="postcode" id="postcode" value="<?php echo $customer_details->postcode;?>" class ='form-control' placeholder="" value="">
							      </div>
							    </div>
							    <div class="form-group">
							     	<label class="col-sm-4 control-label">State</label>
									<div class="col-sm-8">
							        <select name="state" id="state" class ='form-control'>
							        	<option value="victoria" <?php if($customer_details->state == 'victoria'){ echo "selected"; } ?> >Victoria</option>
							        </select>
							        <input type="hidden" name="user_id" id="user_id" class ='form-control' value="<?php echo $this->session->userdata['user_id'] ?>">
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
 $('.datepicker-dob').datepicker({
	    dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '-55:-18'
 });
</script>
<script type="text/javascript">
	$('.datepicker-min').datepicker({
		dateFormat: 'dd-mm-yy',
		minDate: 1, // 0 days offset = today
	});
</script>
<script type="text/javascript">

function resendLink(cusId){
    	$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/settings/resendActivation",
	        data:'customer_user_id='+cusId,
	        success: function(data){
	          alert(data);
	        }
        });
    }
</script>	

		
<script type="text/javascript">


$('.additional_form').validate({
    rules:{
      business_name:{
        required:true
      }
      
    },
    messages:{
      business_name:{
        required:"Please enter business name"
      }
    }

  });
  
	
</script>

