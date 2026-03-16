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
	
	<form id="contact_form" class="form-horizontal" action="<?php echo base_url(''); ?>index.php/settings/new_submit_update_users" method="post" >
	<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3">
			<?php if(null !==$this->session->userdata('limit_error_msg')) { ?> 
	          	<span class="span-30">
						<p class="page-head-p left">
							<span id="limit_message"><?php echo $this->session->flashdata('limit_error_msg'); ?></span>
            				<a href="<?php echo base_url(); ?>index.php/settings/subscriptions">add User</a>
						</p>
					</span>
	           <?php } ?>
		</div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Users</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Save</button>
		</div>
	</div><!--.col-md-12 -->
  
  <div class="container-fluid main-container">
        <div class="row item">
          <div class="col-md-12">
			
				<input type="hidden" id="deleteIds" name="deleteIds" value="">
			<?php
			
            if(!empty($users)){
            	$x = 1;
                foreach ($users as $row)
                {
                if($row->name == 'Super Admin'){
                	$readonly = 'readonly';
                	$branch_check = "checked";
                	$deactive = 'onclick="this.checked=true;"';
                }else{
                	$readonly = '';
                	$branch_check = "";
                	$deactive = '';
                }
                if($user_group == 'Admin'){
					$deactive = 'onclick="this.checked=true;"';
					$branch_check = "checked";
				}
            ?>
            	<div class="col-md-6 orders-form1">
				<div id="<?php echo $x;?>" class="panel pn recipe">
					<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><span id="firstname-<?php echo $x;?>"><?php echo $row->first_name;?></span>&nbsp;<span id="lastname-<?php echo $x;?>"><?php echo $row->last_name;?></span></h3>
			        	<?php if($row->password == ''){?>
			        	<span>Email not verified, <a onclick="resendLink(<?php echo $row->customer_user_id;?>)">click here</a> to verify</span>
			        	<?php } ?>
			        </div>
	          		<div class="panel-body">
	          			<div class="col-md-7">
							<div class="form-group">
								<label  class="col-sm-4 control-label letter">First Name <span>*</span> </label>
								<div class="col-sm-8">
									<input type="hidden"  name="customer_user_id[<?php echo $row->customer_user_id;?>]" value="<?php echo $row->customer_user_id; ?>">
									<input type="hidden" name="customer_id" value="<?php echo $row->customer_id; ?>">
									<input type="text" class="form-control firstname" name="first_name[<?php echo $row->customer_user_id; ?>]" onchange="saveToDatabase(this, `<?php echo $x;?>`)" value="<?php echo $row->first_name; ?>" autocomplete="off" <?php echo $readonly;?>>
	
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Last Name </label>
								<div class="col-sm-8">
									<input type="text" class="form-control lastname" name="last_name[<?php echo $row->customer_user_id; ?>]" onchange="saveToDatabase(this, `<?php echo $x;?>`)" value="<?php echo $row->last_name; ?>" autocomplete="off" <?php echo $readonly;?>>
								</div>
							</div>
							<div class="form-group">
								<label for="abn" class="col-sm-4 control-label">Email <span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="email[<?php echo $row->customer_user_id;?>]" value="<?php echo $row->email; ?>"  autocomplete="off" <?php echo $readonly;?>>
								</div>
							</div>
							<?php if($row->name == 'Super Admin'){ ?>
							<div class="form-group">
								<label for="abn" class="col-sm-4 control-label">User Type <span>*</span></label>
								<div class="col-sm-8">
									<select class="form-control" name="user_type[<?php  echo $row->customer_user_id; ?>]">
										<option value="7" selected >Super Admin</option>
									</select>
									<input type="hidden" name="status[<?php  echo $row->customer_user_id; ?>]" value="1">
								</div>
							</div>
							<?php }else{ ?>
							<div class="form-group">
								<label for="abn" class="col-sm-4 control-label">User Type <span>*</span></label>
								<div class="col-sm-8">
									<select class="form-control" name="user_type[<?php  echo $row->customer_user_id; ?>]">
										<option value="3" <?php if($row->group_id == "3"){ echo "selected";  } ?>>Admin</option>
										<option value="8" <?php if($row->group_id == "8"){ echo "selected";  } ?>>Manager</option>
										<option value="2" <?php if($row->group_id == "2"){ echo "selected";  } ?>>User</option>
										<option value="9" <?php if($row->group_id == "9"){ echo "selected";  } ?>>Accounts</option>
									</select>
								</div>
							</div>
							<?php if($row->password != ''){ ?>
							<div class="form-group">
								<label class="col-sm-4 control-label">Status <span>*</span></label>
								<div class="col-sm-8">
									<input style="float:left;margin-top:10px;" type="radio" name="status[<?php  echo $row->customer_user_id; ?>]" value="1" <?php if($row->active == '1'){ echo 'checked';}?>>
									<span style="float:left;" class="inline-label">Active</span>
									<input style="float:left;margin-top:10px;" type="radio" name="status[<?php  echo $row->customer_user_id; ?>]" value="0" <?php if($row->active == '0'){ echo 'checked';}?>>
									<span style="float:left;" class="inline-label">In Active</span>
								</div>
							</div>
							<?php }else{ ?>
							<input type="hidden" name="status[<?php  echo $row->customer_user_id; ?>]" value="0">
							<?php } ?>
							<?php } ?>
						</div>
						<div class="col-md-5">
							
							<div class="form-group">
								<label for="suburb" class="control-label">Sites <span>*</span></label><br>
								<div class="col-sm-8" >
								    <?php
								    $branch_acc = array();
								    foreach($row->branch_access as $result){
								    	array_push($branch_acc,$result->branch_id);
								    }
								    foreach($branches as $one){ ?>
									<input style="float:left; margin-top:10px;" type="checkbox" name="branches[<?php  echo $row->customer_user_id; ?>][]" value="<?php echo $one->branch_id; ?>" <?php if (in_array($one->branch_id,$branch_acc)){  echo "checked";  }?> <?php echo $branch_check;?> <?php echo $deactive;?> >
									<span style="float:left;" class="inline-label"><?php echo $one->branch_name; ?></span> 
									<div style="clear:both;"></div>
								    <?php } ?>
								    
								</div>
							</div>
							
						</div>
	          		</div>
        		</div>
			</div>	
			<?php
              $x++; }
            }
              ?>
					<div class="col-md-6 form-horizontal orders-form2">
						<div class="panel pn">
						<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><span id="firstname-<?php echo $x;?>">New</span>&nbsp;<span id="lastname-<?php echo $x;?>">User</span></h3>
			        </div>
	          		<div  id="new_row"  class="panel-body">
	          			<div class="col-md-7">
							<div class="form-group">
								<label class="col-sm-4 control-label">First Name<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control firstname"  onchange="saveToDatabase(this, `<?php echo $x;?>`)"  name="new_first_name[]"  autocomplete="off" >
								</div>
							</div>
							<div class="form-group">
								<label for="businessname" class="col-sm-4 control-label">Last Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control lastname"   onchange="saveToDatabase(this, `<?php echo $x;?>`)" name="new_last_name[]"  autocomplete="off" >
								</div>
							</div>
							<div class="form-group">
								<label for="abn" class="col-sm-4 control-label">Email <span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="new_email[]"    autocomplete="off">
								</div>
							</div>
							
							<div class="form-group">
								<label for="abn" class="col-sm-4 control-label">User Type <span>*</span></label>
								<div class="col-sm-8">
									<select class="form-control" name="new_user_type[]">
										
										<option value="3">Admin</option>
										<option value="8">Manager</option>
										<option value="2">User</option>
										<option value="9">Accounts</option>
									</select>
								</div>
							</div>
							<!--<div class="form-group">-->
							<!--	<label class="col-sm-4 control-label">Status <span>*</span></label>-->
							<!--	<div class="col-sm-8">-->
							<!--		<input type="radio" name="new_status[]" value="1" checked>&nbsp;Active-->
							<!--		<input type="radio" name="new_status[]" value="0" >&nbsp;In Active-->
							<!--	</div>-->
							<!--</div>-->
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="suburb" class="control-label">Sites <span>*</span></label><br>
								<div class="col-sm-8">
									<?php foreach($branches as $one){ ?>
									<input style="float:left; margin-top:10px;"type="checkbox" name="new_branches[]" value="<?php echo $one->branch_id; ?>"  <?php echo $branch_check;?> <?php echo $deactive;?>>
									<span style="float:left;" class="inline-label"><?php echo $one->branch_name; ?></span>
									<div style="clear:both;"></div>
								    <?php } ?>
								    <input type="hidden" nam="new_branche_ids[]">
								</div>
							</div>
						</div>
	          		</div>
        		</div>
				</div>
        	
        
        </div>
      </div> 
    </div>
</form>
<script>
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
<script>
    function saveToDatabase(e, count){
    	if($(e).hasClass('firstname')){
    		var fname = e.value;
    		$('#firstname-'+count).html(fname);
    	}
    	if($(e).hasClass('lastname')){
    		var lname = e.value;
    		$('#lastname-'+count).html(lname);
    	}
    	
     	var id = $(e).parent().parent().parent().parent().attr('id');	
        if(id == 'new_row'){
			var cnt = Number(count) + 1;
			$(e).parent().parent().parent().parent().attr('id','');  
					  
			var msg ='<div class="col-md-6 form-horizontal orders-form2">\n'
						+'<div class="panel pn"><div class="panel-heading"><h3 class="panel-title"><span id="firstname-'+cnt+'">New</span>&nbsp;<span id="lastname-'+cnt+'">User</span></h3></div>\n'
	          		+'<div  id="new_row"  class="panel-body"><div class="col-md-7">\n'
						+'<div class="form-group">\n'
							+'<label for="businessname" class="col-sm-4 control-label">First Name <span>*</span></label>\n'
							+'<div class="col-sm-8">\n'
								+'<input type="text" class="form-control firstname" onchange="saveToDatabase(this,`'+cnt+'`)" name="new_first_name[]"  autocomplete="off" >\n'
							+'</div>\n'
						+'</div>\n'
						+'<div class="form-group">\n'
							+'<label for="businessname" class="col-sm-4 control-label">Last Name <span>*</span></label>\n'
							+'<div class="col-sm-8">\n'
								+'<input type="text" class="form-control lastname" onchange="saveToDatabase(this,`'+cnt+'`)"  name="new_last_name[]"  autocomplete="off" >\n'
							+'</div>\n'
						+'</div>\n'
						+'<div class="form-group">\n'
							+'<label for="abn" class="col-sm-4 control-label">Email</label>\n'
							+'<div class="col-sm-8">\n'
								+'<input type="text" class="form-control" name="new_email[]"    autocomplete="off">\n'
							+'</div>\n'
						+'</div>\n'
							+'<div class="form-group"><label for="abn" class="col-sm-4 control-label">User Type</label><div class="col-sm-8"><select class="form-control" name="new_user_type[]">\n'
						+'<option value="">Select</option><option value="3">Admin</option><option value="8">Manager</option><option value="2">User</option><option value="9">Accounts</option></select></div></div>\n'
						+'</div><div class="col-md-5"><div class="form-group">\n'
						+'<label for="suburb" class="col-sm-4 control-label">Sites</label>\n'
						+'<div class="col-sm-8">\n';
						<?php foreach($branches as $one){ ?>
							msg+='<input type="checkbox"  name="new_branches[]" value="<?php echo $one->branch_id; ?>"  <?php echo $branch_check;?> <?php echo $deactive;?>><?php echo $one->branch_name; ?><br>\n';
						<?php } ?>	
						msg+='</div></div></div>\n'
						+'</div></div></div>\n';		  
                  $(e).parent().parent().parent().parent().parent().parent().parent().append(msg);
      	}
     }
    </script>

