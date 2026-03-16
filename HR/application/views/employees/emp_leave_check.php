
	<div class="row item">
			</div>
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_leave_manager" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Leave Management</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Save</button>

		</div>
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
	<?php echo validation_errors(); ?>
	<?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
				<div class='hideMe'>
					<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
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
			<?php foreach($leaves as $row){ ?>
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Leave Info</h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Status<span>*</span></label>
							<div class="col-sm-8">
								<select name="leave_status" class="form-control" onchange="yesnoCheck(this);">
									<option value="">Select</option>
									<option value="Pending" <?php if($row->leave_status == 'Pending'){ echo "selected";} ?>>Pending</option>
									<option value="Approve" <?php if($row->leave_status == 'Approve'){ echo "selected";} ?>>Approve</option>
									<option value="Reject" <?php if($row->leave_status == 'Reject'){ echo "selected";} ?>>Reject</option>
									<option value="Comment" <?php if($row->leave_status == 'Comment'){ echo "selected";} ?>>Add Comments</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="leave_id" value="<?php echo $leave_id; ?>">
						
						<?php if($row->comments != ''){ ?>
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Comment<span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="comment" rows="4"><?php echo $row->comments; ?></textarea>
							</div>
						</div>
						<?php }else{ ?>
							<div id="ifYes" style="display: none;">
						<div class="form-group">
							<label for="businessname" class="col-sm-4 control-label">Comment<span>*</span></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="comment"  rows="4"></textarea>
							</div>
						</div>
						</div>
						<?php } ?>
	          		</div>
        		</div>
	        </div>
			<div class="col-md-6">
			<?php if($row->medical_certificate != ''){  ?>
        	  <div class="panel pn">
        	  	   <div class="panel-heading">
			        	<div class="col-md-6">
			    	<h3 class="panel-title" style="float:left;">Medical Certificate</h3>
			    	</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/leave_certificates/<?php echo $row->medical_certificate; ?>" target="_blank">View</a>
					</div><br>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<div>
							<iframe src="<?php echo base_url();?>assets/leave_certificates/<?php echo $row->medical_certificate; ?>" width="100%" height="100%"></iframe>
							</div>	
						</div>
						
	          		</div>
        	  </div>
			<?php } } ?>           
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
			leave_status: {
	                required:true
	            }
			},		
			messages: {
			leave_status: {
	                required:"Please provide leave status"
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
        if (that.value == "Comment") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>

</body>
</html>
