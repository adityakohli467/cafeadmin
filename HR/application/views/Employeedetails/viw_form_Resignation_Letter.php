
	<div class="row item">
			</div>
<?php if(isset($details[0]->Resignation_Letter_id)){ ?>		
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_Resignation_Letter" enctype="multipart/form-data">
	<?php } else {?>
	<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/Resignation_Letter" enctype="multipart/form-data">

	<?php } ?>	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>RESIGNATION LETTER</h3>
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
			        	<h3 class="panel-title"><b>Resignation Details:</b></h3>
			        </div>
	          		<div class="panel-body">
	          		    
	          		    <div class="form-group">
							<label for="businessname" class="col-sm-4 control-label"><b>Upload File:</b></label>
							
							<div class="col-sm-8">
								<input type="file" class="form-control" name="resign_letter">
								<?php if((isset($details[0]->resign_letter)) && ($details[0]->resign_letter !='') && (file_exists("./uploaded_files/".$details[0]->resign_letter))) {  ?>
							    <a style="width:20%;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $details[0]->resign_letter; ?>" target="_blank">View</a>
								 <?php } ?>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Subject:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
			<input type="hidden" name= "emp_id" value="<?php if(isset($details[0]->emp_id)){ echo $details[0]->emp_id; } ?>">				    
			<input type="hidden" name= "Resignation_Letter_id" value="<?php if(isset($details[0]->Resignation_Letter_id)){ echo $details[0]->Resignation_Letter_id; } ?>">				    
								<input type="text" readonly class="form-control" name="subject" autocomplete="off" required value="<?php if(isset($details[0]->subject)){ echo $details[0]->subject; } ?>" >
							</div>
						</div>
						
					<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Name:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="name" autocomplete="off" required value="<?php if(isset($details[0]->name)){ echo $details[0]->name; } ?>" >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Date of Submission:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
				           <input type="text" readonly class="form-control datepicker"  name="resign_date"  autocomplete="off" required value="<?php if(isset($details[0]->resign_date)){ echo $details[0]->resign_date; } ?>">
							</div>
						</div>
					
					 <div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Reason for Leaving and Experience Working with Us:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
								<input type="text" readonly class="form-control" name="resign_note" autocomplete="off" required value="<?php if(isset($details[0]->resign_note)){ echo $details[0]->resign_note; } ?>">
							</div>
						</div>
						
						<?php if(isset($details[0]->Resignation_Letter_id)){ ?>	
						
						<div class="form-group">
							<label for="abn" class="col-lg-4 col-sm-12 control-label">Manager Comments</label>
							<div class="col-lg-8 col-sm-12">
                               <input type="text" readonly class="form-control" name="comment" value="<?php if(isset($details[0]->comment)){ echo $details[0]->comment; } ?>" >
							</div>
						</div>
						
							<div class="btn-div col-lg-12 col-sm-12">
			
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_Resignation_Letter">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">Back</button>
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
