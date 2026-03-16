<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3> <?php if(isset($branch_id) && $branch_id !='' ) { echo "Update Branch"; }else{ echo "Create Branch"; } ?></h3>
			</span>
		</div>
	
</div>

<div class="container content">
 
  <div class="col-md-12">  
  <div class="Userpanel">
      <div class="Userpanel-body">
            
  
          <?php if(isset($branch_id) && $branch_id !='' ) { ?>
          <form action="<?php echo base_url() ?>index.php/admin/update_branch" method="post" class="form-horizontal" >
          <?php } else { ?>
          <form action="<?php echo base_url() ?>index.php/admin/create_branch" method="post" class="form-horizontal" id="form_registration">
          <?php } ?>
           <div class="row createUser">
            <div class="col-md-6">
                <div class="control-group">
                  <label class="control-label">Branch Name</label>
                  <div class="controls">
                    <input type="text" name="branch_name" id="branch_name" class ='form-control' value="<?php if(isset($branch_name) && $branch_name !='') {  echo $branch_name; }else{ echo ''; }  ?>" >
                  </div>
                </div>
            </div>
            
            
            
             
            
            <!--<div class="control-group">-->
            <!--  <label class="control-label">Unit</label>-->
            <!--  <div class="controls">-->
                  
            <!--    <input type="text" name="unit" id="unit" class ='form-control'  value="<?php //if(isset($unit) && $unit !='') {  echo $unit; }else{ echo ''; }  ?>">-->
            <!--  </div>-->
            <!--</div>-->
            
            <!--<div class="control-group">-->
            <!--  <label class="control-label">Street</label>-->
            <!--  <div class="controls">-->
            <!--    <input type="text" name="street" id="street" class ='form-control'  value="<?php if(isset($street) && $street !='') {  echo $street; }else{ echo ''; }  ?>">-->
            <!--  </div>-->
            <!--</div>-->
            
            <!-- <div class="control-group">-->
            <!--  <label class="control-label">Suburb</label>-->
            <!--  <div class="controls">-->
            <!--    <input type="text" name="suburb" id="suburb" class ='form-control' value="<?php //if(isset($suburb) && $suburb !='') {  echo $suburb; }else{ echo ''; }  ?>">-->
            <!--  </div>-->
            <!--</div>-->
            
            <!-- <div class="control-group">-->
            <!--  <label class="control-label">Postcode</label>-->
            <!--  <div class="controls">-->
            <!--    <input type="text" name="postcode" id="postcode" class ='form-control' value="<?php //if(isset($postcode) && $postcode !='') {  echo $postcode; }else{ echo ''; }  ?>">-->
            <!--  </div>-->
            <!--</div>-->
            
            <!-- <div class="control-group">-->
            <!--  <label class="control-label">State</label>-->
            <!--  <div class="controls">-->
            <!--    <input type="text" name="state" id="state" class ='form-control' value="<?php //if(isset($state) && $state !='') {  echo $state; }else{ echo ''; }  ?>">-->
            <!--  </div>-->
            <!--</div>-->
            <div class="col-md-6">
               <div class="control-group">
                  <label class="control-label">Weekly Proj. sales</label>
                  <div class="controls">
                    <input type="text" name="budget" id="budget" class ='form-control' value="<?php if(isset($budget) && $budget !='') {  echo $budget; }else{ echo ''; }  ?>">
                  </div>
                </div>
            </div>
            
            
            
            <?php $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
            
            
            <?php  foreach($weekdays as $weekday){ if(${$weekday.'_budget'} !='') { $week_budg = ${$weekday.'_budget'}; }else{ $week_budg = ''; } ?>
             <div class="col-md-6">
                 <div class="control-group">
                 <label class="control-label"><?php echo $weekday; ?> Proj. sales</label>
                  <div class="controls">
                <input type="text" name="<?php echo $weekday; ?>_budget" id="<?php echo $weekday; ?>_budget" class ='form-control' value="<?php  echo $week_budg;   ?>">
                  </div>
                  </div>
              </div>
            <?php } ?>
            
            
            
            <div class="col-md-6">
             <div class="control-group">
              <label class="control-label">Gross salary weekly</label>
              <div class="controls">
                <input type="text" name="gross_salary_weekly" id="gross_salary_weekly" class ='form-control' value="<?php if(isset($gross_salary_weekly)) {  echo $gross_salary_weekly; }else{ echo ''; }  ?>">
              </div>
            </div>
            </div>
            
            
            <div class="col-md-6">
             <div class="control-group">
                      <label class="control-label">Early start from</label>
                    <div class="input-group date datetimepicker3">
                <input type="text" class="form-control" name="early_start_from" value="<?php if(isset($early_start_from)) {  echo $early_start_from; }else{ echo ''; }  ?>">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
                </span>
                       </div>
                    </div>
            </div>
            
            <div class="col-md-6">
             <div class="control-group">
              <label class="control-label">Early start to</label>
            <div class="input-group date datetimepicker3">
        <input type="text" class="form-control" name="early_start_to" value="<?php if(isset($early_start_to)) {  echo $early_start_to; }else{ echo ''; }  ?>">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
        </span>
               </div>
            </div>
            </div>
            
            
        <!--    <div class="col-md-6">-->
        <!--     <div class="control-group">-->
        <!--      <label class="control-label">Late night start from</label>-->
        <!--    <div class="input-group date datetimepicker3">-->
        <!--<input type="text" class="form-control" name="late_night_from" value="<?php if(isset($late_night_from)) {  echo $late_night_from; }else{ echo ''; }  ?>">-->
        <!--<span class="input-group-addon">-->
        <!--<span class="glyphicon glyphicon-time"></span>-->
        <!--</span>-->
        <!--       </div>-->
        <!--    </div>-->
        <!--    </div>-->
            
            
        <!--    <div class="col-md-6">-->
        <!--     <div class="control-group">-->
        <!--      <label class="control-label">Late night start to</label>-->
        <!--    <div class="input-group date datetimepicker3">-->
        <!--<input type="text" class="form-control" name="late_night_to" value="<?php if(isset($late_night_to)) {  echo $late_night_to; }else{ echo ''; }  ?>">-->
        <!--<span class="input-group-addon">-->
        <!--<span class="glyphicon glyphicon-time"></span>-->
        <!--</span>-->
        <!--       </div>-->
        <!--    </div>-->
        <!--    </div>-->
            
            <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
               <select name="status" class ='form-control'>
                   <?php if(isset($status) && $status =='1') { ?>
                       <option value="1" selected="selected" >Enable</option> 
                        <option value="0">Disable</option>
                      
                 <?php   }else if(isset($status) && $status =='0'){ ?>
                 
                   <option value="1" >Enable</option> 
                   <option value="0" selected="selected" >Disable</option>
                   
                 <?php  } else {  ?>
                   <option value="1" >Enable</option> 
                   <option value="0" selected="selected" >Disable</option>
                   <?php  }  ?>
                   
                       
                   
               </select>
              </div>
            </div>
            </div>
            
             <div class="col-md-6">
             <div class="control-group">
              <label class="control-label">Public holidays</label>
              <div class="controls">
            <textarea name="public_holidays" id="public_holidays" placeholder="Enter date in comma seprated(24-12-2024..)" class ='form-control' ><?php if(isset($public_holidays)) {  echo $public_holidays; }else{ echo ''; }  ?></textarea>
              </div>
            </div>
            </div>
            
            <div class="col-md-12">
          
            </br></br>
                <div class="form-actions">
                    <?php if(isset($branch_id) && $branch_id !='' ) { ?>
                    <input type="hidden"  name="branch_id" value="<?php echo $branch_id?>">
                    <input type="submit" class="btn btn-primary btn-ph" value="Update">
                    <?php }else {  ?>
                    <input type="submit" class="btn btn-primary btn-ph" value="Register">
                    <?php }?>
                   
                </div>
            </div>
            </div>
          </form>
          </div>
  </div>
  </div>
</div> 
<style type="text/css">
  label.error{
    color:red;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){
$('.datetimepicker3').datetimepicker({
    format: 'HH:mm A'
    });
});
  $('#form_registration').validate({
    rules:{
      name:{
        required:true
      },
      email:{
        required:true,
        email:true,
        remote:{type:'post',url:'<?php echo base_url() ?>index.php/auth/email_check',async:false}
      },
      password:{
        required : true
      },
      password_confirm:{
        required : true,
        equalTo : '#password'
      }
    },
    messages:{
      name:{
        required:"Please Enter Name"
      },
      email:{
        required:"Please Enter Email",
        email:"Invalid Email Id",
        remote :"Email is already Exist"
      },
      password:{
        required : "Please Enter Password"
      },
      password_confirm:{
        required : "Please Enter Confirm Password",
        equalTo : '#password'
      }
    }

  });
</script>