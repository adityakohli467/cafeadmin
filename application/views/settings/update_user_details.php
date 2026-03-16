	
  <?php if(null !==$this->session->userdata('subscription_msg')) { ?>  
	<div class='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('subscription_msg'); ?></p>
	</div>
  <?php } ?>
    
    
	<div class="col-md-12 page-head border-bottom">
		<span class="span-20 left border-right">
			<h3>My Details</h3>
		</span>
		<div class="btn-div">
			<!--<button type="submit" class="btn btn-success">Save</button>-->
		</div>
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
		<?php $today = date('Ym'); ?>
		<div class="row">
			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Profile Edit</h3>
			        </div>
	          		<div class="panel-body">
	          				<?php if(null !==$this->session->userdata('success_message')){ ?>
						  <div class="alert alert-success">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $this->session->userdata('success_message');?>
					      </div>
					  <?php } ?>
					  <?php if(null !==$this->session->userdata('error_message')){ ?>
					  <div class="alert alert-danger">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo implode('',$this->session->userdata('error_message'));?>
					      </div>
					  <?php } ?>
					  <?php foreach($details as $row){ ?>
			  			<form method="post" class="login_form form-horizontal" action="<?php echo base_url() ?>index.php/settings/update_profile">
						    <div class="form-group">
						      <label class="col-sm-4 control-label">First Name</label>
						      <div class="col-sm-8">
						      <input type="text" name="first_name"  class ='form-control' placeholder="" value="<?php echo $row->first_name; ?>" >
						     </div>
						    </div>
						    <div class="form-group">
						     	<label class="col-sm-4 control-label">Last Name</label>
						     <div class="col-sm-8">
						      <input type="text" name="last_name"  class ='form-control'  placeholder="" value="<?php echo $row->last_name; ?>" >
						    </div>
						    </div>
						    <div class="form-group">
						     	<label class="col-sm-4 control-label">Email</label>
						     <div class="col-sm-8">
						      <input type="text" name="email"  class ='form-control' value="<?php echo $row->email; ?>" readonly>
						    </div>
						    </div>
						    <div class="form-group">
						     	<label class="col-sm-4 control-label">Mobile</label>
						      <div class="col-sm-8">
						      <input type="text" name="mobile"  class ='form-control' placeholder="" value="<?php echo $row->phone; ?>" >
						    </div>
						    </div>
						     
						 	<div class="auth-btn-div">
							    <button type="submit" class="btn btn-success btncolor">Save</button>
							</div>
						    <div class="clearfix"></div>
					    </form>
					    <?php } ?>
	          		</div>
        		</div>
	        </div>
	        
	        <div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Change Password</h3>
			        </div>
	          		<div class="panel-body">
	          			<?php if(null !==$this->session->userdata('message_success')){ ?>
						  <div class="alert alert-success">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo $this->session->userdata('message_success');?>
					      </div>
					  <?php } ?>
					  <?php if(null !==$this->session->userdata('message')){ ?>
					  <div class="alert alert-danger">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <?php echo implode('',$this->session->userdata('message'));?>
					      </div>
					  <?php } ?>
					  
			  			<form method="post" class="login_form form-horizontal" id="change_password" action="<?php echo base_url() ?>index.php/settings/change_password">
						    <div class="form-group">
						      <label class="col-sm-4 control-label">Old Password<span>*</span></label>
						      <div class="col-sm-8">
						      <input type="password" name="old" id="old" class ='form-control' placeholder="" >
						    </div>
						     </div>
						    <div class="form-group">
						     	<label class="col-sm-4 control-label">New Password<span>*</span></label>
						      <div class="col-sm-8">
						      <input type="password" name="new" id="new" class ='form-control'  placeholder="" >
						    </div>
						     </div>
						    <div class="form-group">
						     	<label class="col-sm-4 control-label">Confirm Password<span>*</span></label>
						      <div class="col-sm-8">
						      <input type="password" name="new_confirm" id="new_confirm" class ='form-control' placeholder="">
						    </div>
						     </div>
						    
						 	<div class="auth-btn-div">
						 		<input type="hidden" name="user_id" id="user_id" class ='form-control' value="<?php echo $this->session->userdata['user_id'] ?>">
							    <button type="submit" class="btn btn-success btncolor">Save</button>
							</div>
						    <div class="clearfix"></div>
					    </form>
	          		</div>
        		</div>
	        </div>
	        </div>
	    </div>
</div><!--.container-->
<br>
<script type="text/javascript">
	$(document).ready(function() { 
	    $("#change_password").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			old: {
	                required:true
	            },
	         new: {
	                required:true
	            },
	         new_confirm: {
	                required:true
	            }   
			},		
			messages: {
			old: {
	                required:"Please provide old password"
	            },
	         new: {
	                required:"Please provide new password"
	            },
	         new_confirm: {
	                required:"Please provide confirm password"
	            }   
			}

	    });	
	});
</script>