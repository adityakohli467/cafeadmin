<div class="row item">
			</div>
			
		<?php if(isset($details[0]->memo_id)){ ?>	
		<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_memo" enctype="multipart/form-data">
	   <?php } else { ?>
	   <form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/add_memo" enctype="multipart/form-data">

	    <?php } ?>
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>ADD MEMO</h3>
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
			        	<h3 class="panel-title" style="text-align: center;"><b>Memo Details:</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Subject:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							    <input type="hidden" name="memo_id" value="<?php if(isset($details[0]->memo_id)){ echo $details[0]->memo_id; } ?>">
								<input type="text" class="form-control" name="subject" value="<?php if(isset($details[0]->subject)){ echo $details[0]->subject; } ?>" autocomplete="off" required >
							</div>
						</div>
						
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Message:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
	<textarea  class="form-control" name="message" rows="13" cols="80" autocomplete="off" required><?php if(isset($details[0]->message)){ echo $details[0]->message; } ?></textarea>
							</div>
						</div>
			<?php if($role=='admin' || $role=='manager') { ?>			
		<div class="form-group">
      <label class="control-label col-lg-4 col-sm-12">Role</label>
      <div class="controls col-lg-8 col-sm-12">
       <select name="role" class ='form-control' id="role_memo">
           <option value="">-- Select Role -- </option>
            <option value="14" selected="selected">All Staff </option>
         <?php if(isset($roles) && !empty($roles)) { foreach($roles as $role) { ?>
         <?php if(isset($details[0]->role) && $details[0]->role == $role->role_id) { ?>
         <option value="<?php echo $role->role_id; ?>" selected="selected"><?php echo $role->role_name; ?></option>
         <?php } else {?>
         <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
		<?php }}} ?>
       </select>
      </div>
    </div>
    
    
    <div class="form-group">
      <label class="control-label col-lg-4 col-sm-12" for="email"><b>Employee:</b></label>
      <div class="controls col-lg-8 col-sm-12">
      <select  name="emp_email" class="form-control" id="emp_slt" required>
            <option value="">-- Select Employee --</option>
	  <option value="" selected="selected">All Employees</option>
	  <?php foreach($employees as $row){ ?>
	     <option value="<?php echo $row->email."|".$row->emp_id; ?>"><?php echo $row->first_name.' '. $row->last_name.' ('.str_replace('_', ' ', $row->employee_type).'  )'; ?></option>
	  <?php } ?>
	  </select>
	  </div>
	   </div>
	</div>
	</div>
	
    <div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_memo">
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
