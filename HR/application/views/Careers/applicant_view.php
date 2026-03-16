<div class="row item">
			</div>
		
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Applicant Data</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-12">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title" style="text-align: center;"><b>Applicant Details:</b></h3>
			        </div>
	          		<div class="panel-body">
	          		    <div class="form-row ">
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Name:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->first_name)){ echo $details[0]->first_name." ".$details[0]->last_name; } ?>"  >
							</div>
						</div>
						
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Email:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->email)){ echo $details[0]->email; } ?>" >
							</div>
						</div>
							</div>
							
							
							<div class="form-row ">
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Phone:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->mobile)){ echo $details[0]->mobile; } ?>"  >
							</div>
						</div>
						
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Experience:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->experience)){ echo $details[0]->experience; } ?>" >
							</div>
						</div>
							</div>
							
							 <div class="form-row ">
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">City:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->city)){ echo $details[0]->city; } ?>"  >
							</div>
						</div>
						
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">State:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->state)){ echo $details[0]->state; } ?>" >
							</div>
						</div>
							</div>
							
							
							<div class="form-row ">
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Education:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->education)){ echo $details[0]->education; } ?>" >
							</div>
						</div>
					
						
						<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Job applied for:</label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" class="form-control" value="<?php if(isset($details[0]->job_name)){ echo $details[0]->job_name; } ?>" >
							</div>
						</div>
							</div>
								<?php if(isset($details[0]->message_to_manager)){  ?>
							<div class="form-row ">
								<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Message:</label>
							<div class="col-lg-8 col-sm-12">
							    <textarea class="form-control" rows="4" > <?php if(isset($details[0]->message_to_manager)){ echo $details[0]->message_to_manager; } ?></textarea>
							</div>
						</div>	
							<div class="form-group col-md-6">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Effective start date:</label>
							<div class="col-lg-8 col-sm-12">
							   	<input type="text" disabled class="form-control" value="<?php if(isset($details[0]->start_date)){ echo date('d-m-Y',strtotime($details[0]->start_date)); } ?>" >
							</div>
						</div>	
							</div>
							<?php } ?>
						<div class="form-row ">
						    
			<a class="btn btn-ph btn-ph-cancel btn-success " href="https://www.cafeadmin.com.au/Careers/<?php echo $details[0]->resume; ?>" target="_blank">View Resume</a>
			<?php if(isset($details[0]->docs) && $details[0]->docs !='') { ?>
				<a class="btn btn-ph btn-ph-cancel btn-success " href="https://www.cafeadmin.com.au/Careers/<?php echo $details[0]->docs; ?>" target="_blank">View Additional Docs</a>
				<?php } ?>
			<a href="<?php echo base_url(); ?>index.php/admin/manage_applications">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>			
						
	          		</div>
        		</div>
	        </div>
	    </div>
	</div>
  
   </div>
 
  <br>
<script>
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    
    $(document).ready(function(){
       $("#role_memo").on("change",function(){
          
        if($(this).val() == "14"){
           $("#emp_slt").removeAttr("required");
        }else{
           $("#emp_slt").attr("required","required");  
        }
    }) 
        
    })
    
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
