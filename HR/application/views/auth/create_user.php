<style>
.control-group {
    margin-bottom: 8px;
}
</style>
<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3> <?php if(isset($user_id) && $user_id !='' ) { echo "Update User"; }else{ echo "Create User"; } ?></h3>
			</span>
		</div>
	
	</div>
<div class="container content">
  
  
 
 
  <br/>
  
 
  <div class="col-md-12">  
  <div class="Userpanel">
      <div class="Userpanel-body">
          
      
          <?php if(isset($user_id) && $user_id !='' ) { ?>
          <form action="<?php echo base_url() ?>index.php/admin/update_user" method="post" class="form-horizontal" >
          <?php } else { ?>
          <form action="<?php echo base_url() ?>index.php/admin/create_user" method="post" class="form-horizontal" id="form_registration">
          <?php } ?>
          <div class="row createUser">
          <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Name</label>
              <div class="controls">
                <input type="text" name="username" id="name" class ='form-control' value="<?php if(isset($name) && $name !='') {  echo $name; }else{ echo ''; }  ?>" >
              </div>
            </div>
            </div>
            
            
            <div class="col-md-6">
             <div class="control-group">
              <label class="control-label">Role</label>
              <div class="controls">
               <select name="role" class ='form-control'>
                   <?php if(isset($role) && $role =='admin') { ?>
                       <option value="admin" selected="selected" >Admin</option> 
                        <option value="manager">Manager</option>
                       <option value="employee">Employee</option>
                        <option value="timesheet">Timesheet</option>
                 <?php   }else if(isset($role) && $role =='employee'){ ?>
                 
                    <option value="admin" >Admin</option> 
                        <option value="manager">Manager</option>
                       <option value="employee" selected="selected" >Employee</option>
                        <option value="timesheet">Timesheet</option>
                   
                 <?php  } else if(isset($role) && $role =='manager'){  ?>
                   
                    <option value="admin" >Admin</option> 
                    <option value="manager" selected="selected">Manager</option>
                    <option value="employee"  >Employee</option>
                     <option value="timesheet">Timesheet</option>
                   <?php  } else { ?>
                   
                    <option value="admin" >Admin</option> 
                    <option value="manager" selected="selected">Manager</option>
                    <option value="employee"  >Employee</option>
                     <option value="timesheet" selected="selected">Timesheet</option>
                   
                    <?php  }  ?>
                   
                       
                   
               </select>
              </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Email</label>
              <div class="controls">
                  
                <input type="text" name="email" id="email" class ='form-control'  value="<?php if(isset($email) && $email !='') {  echo $email; }else{ echo ''; }  ?>">
              </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Phone</label>
              <div class="controls">
                <input type="text" name="phone" id="phone" class ='form-control'  value="<?php if(isset($phone) && $phone !='') {  echo $phone; }else{ echo ''; }  ?>">
              </div>
            </div>
            </div>
            
            <div class="col-md-12">
            <div class="control-group checkboxSup">
              <div class="checkbox">
                <input type="checkbox" name="supervisor" value="1"><b>Supervisor</b>
                 </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Branches</label>
              <div class="controls checkboxGroup">
              <?php foreach($branches as $branch) { ?>
              <?php if(!empty($branch_access)){  ?>
        	  
        	  <?php if(in_array($branch->branch_id, $branch_access)) { ?>
        	  <div class="checkbox">
        	  <input type="checkbox" name= "branch[]" checked="checked" value="<?php echo  $branch->branch_id; ?>"   ><?php echo  $branch->branch_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	  </div>
        	  <?php } else {  ?>
        	 <div class="checkbox">  
        	<input type="checkbox" name= "branch[]" value="<?php echo  $branch->branch_id; ?>"   ><?php echo  $branch->branch_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	 </div>
        	<?php } } else { ?>
        	 <div class="checkbox">
                <input type="checkbox" name= "branch[]" value="<?php echo  $branch->branch_id; ?>"   ><?php echo  $branch->branch_name; ?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                 </div>
                  <?php }} ?>
              </div>
            </div>
            </div>
            
            <div class="col-md-6">
             <div class="control-group">
              <label class="control-label">Menus</label>
              <div class="controls checkboxGroup">
            <?php if(!empty($menus_list)){  ?>
              <?php foreach($menus_list as $menus) { ?>
              <div class="checkbox" >  
              <?php if(!empty($existing_menus_list) && in_array($menus->menu_id,$existing_menus_list)){  ?>
        	  <input type="checkbox" checked="checked" name= "menus_list[]" value="<?php echo  $menus->menu_id; ?>"   ><?php echo  $menus->description; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	  <?php } else { ?>
        	   <input type="checkbox" name= "menus_list[]" value="<?php echo  $menus->menu_id; ?>"   ><?php echo  $menus->description; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	  <?php }  ?>
        	 </div>
                  <?php }} ?>
              </div>
            </div>
            </div>
            
             <?php if(isset($user_id) && $user_id =='' ) { ?>
             <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Password</label>
              <div class="controls">
                <input type="password" name="password" id="password" class ='form-control' >
              </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="control-group">
              <label class="control-label">Confirm Password</label>
              <div class="controls">
                <input type="password" name="password_confirm" id="password_confirm" class ='form-control' >
              </div>
            </div>
            </div>
             <?php }else { ?>
             <div class="col-md-6">
                <div class="control-group">
              <label class="control-label"> Password</label>
              <div class="controls">
                <input type="password" name="password" id="password" class ='form-control' >
              </div>
            </div>
            </div>
            <?php } ?>
            
            <div class="col-md-6">
                
            </br></br>
            <div class="form-actions">
                <?php if(isset($user_id) && $user_id !='' ) { ?>
                <input type="hidden"  name="customer_user_id" value="<?php echo $user_id?>">
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