
<style>
    .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}

</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
                
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
            <div class="page-content-inner">
                <div class="card" id="userList">
                    <?php if(isset($user_id) && $user_id !='' ) { ?>
                        <form action="<?php echo base_url() ?>index.php/admin/update_user" method="post" class="form-horizontal" >
                    <?php } else { ?>
                        <form action="<?php echo base_url() ?>index.php/admin/create_user" method="post" class="form-horizontal" id="form_registration">
                    <?php } ?>
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Users</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/users"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php if(isset($user_id) && $user_id !='' ) { ?>
                                    <input type="hidden"  name="customer_user_id" value="<?php echo $user_id?>">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                    <?php }else {  ?>
                                    <input type="submit" class="btn btn-primary" value="Register">
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div>
                            <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success" role="alert" style="font-size: 18px;">
                                 <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                           
                                <div class="row">
                                    <div class="col-lg-6 col-md-12"> 
                                      <div class="row">
                                        <div class="col-md-6 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Name</label>
                                              <div class="controls">
                                                <input type="text" name="username" id="name" class ='form-control' value="<?php if(isset($name) && $name !='') {  echo $name; }else{ echo ''; }  ?>" >
                                              </div>
                                            </div>
                                          </div>
                                        <div class="col-md-6 mb-4">  <div class="control-group">
                                                  <label class="control-label">Role</label>
                                                  <div class="controls">
                                                   <select name="role" class ='form-control'>
                                                       <?php if(isset($role) && $role =='admin') { ?>
                                                           <option value="admin" selected="selected" >Admin</option> 
                                                            <option value="manager">Manager</option>
                                                           <option value="staff">Staff</option>
                                                     <?php   }else if(isset($role) && $role =='staff'){ ?>
                                                     
                                                        <option value="admin" >Admin</option> 
                                                            <option value="manager">Manager</option>
                                                           <option value="staff" selected="selected" >Staff</option>
                                                       
                                                     <?php  } else if(isset($role) && $role =='manager'){  ?>
                                                       
                                                        <option value="admin" >Admin</option> 
                                                        <option value="manager" selected="selected">Manager</option>
                                                        <option value="staff"  >Staff</option> 
                                                       <?php  } else { ?>
                                                       
                                                        <option value="admin">Admin</option> 
                                                        <option value="manager" selected="selected">Manager</option>
                                                        <option value="staff">Staff</option>
                                                       
                                                        <?php  }  ?>
                                                       
                                                           
                                                       
                                                   </select>
                                                  </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6 mb-4"> 
                                            <div class="control-group">
                                              <label class="control-label">Email</label>
                                              <div class="controls">
                                                  
                                                <input type="text" name="email" id="email" class ='form-control'  value="<?php if(isset($email) && $email !='') {  echo $email; }else{ echo ''; }  ?>">
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4"> 
                                            <div class="control-group">
                                              <label class="control-label">Phone</label>
                                              <div class="controls">
                                                <input type="text" name="phone" id="phone" class ='form-control'  value="<?php if(isset($phone) && $phone !='') {  echo $phone; }else{ echo ''; }  ?>">
                                              </div>
                                            </div>
                                        </div>
                                        <?php if(isset($user_id) && $user_id =='' ) { ?>
                                        <div class="col-md-6 mb-4">
                                            <div class="control-group">
                                              <label class="control-label">Password</label>
                                              <div class="controls">
                                                <input type="password" name="password" id="password" class ='form-control' >
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="control-group">
                                              <label class="control-label">Confirm Password</label>
                                              <div class="controls">
                                                <input type="password" name="password_confirm" id="password_confirm" class ='form-control' >
                                              </div>
                                            </div>
                                        </div>
                                        <?php }else { ?>
                                        <div class="col-md-12 mb-4">
                                            <div class="control-group">
                                              <label class="control-label"> Password</label>
                                              <div class="controls">
                                                <input type="password" name="password" id="password" class ='form-control' >
                                              </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="control-group">
                                                  <label class="control-label">Branches</label>
                                                   <div class="controls row">
                                                      <?php $i=1; foreach($branches as $branch) {  ?>
                                                      <?php if(!empty($branch_access)){  ?>
                                                            
                                                        <?php if(in_array($branch->branch_id, $branch_access)) { ?>
                                                        <div class="checkbox col-lg-6 col-sm-12 mb-1">
                                                        <label for="branchAccess_<?php echo $i; ?>"><input id="branchAccess_<?php echo $i; ?>" type="checkbox" name= "branch[]" checked="checked" value="<?php echo  $branch->branch_id; ?>" > <?php echo  $branch->branch_name; ?></label>
                                                        </div>
                                                        <?php } else {  ?>
                                                        <div class="checkbox col-lg-6 col-sm-12 mb-1">  
                                                        <label for="branchAccess_<?php echo $i; ?>"><input id="branchAccess_<?php echo $i; ?>" type="checkbox" name= "branch[]" value="<?php echo  $branch->branch_id; ?>" > <?php echo  $branch->branch_name; ?></label>
                                                        </div>
                                                        <?php } } else { ?>
                                                        <div class="checkbox col-lg-6 col-sm-12 mb-1">
                                                        <label for="branchAccess_<?php echo $i; ?>"><input id="branchAccess_<?php echo $i; ?>" type="checkbox" name= "branch[]" value="<?php echo  $branch->branch_id; ?>" > <?php echo  $branch->branch_name; ?></label>
                                                         </div>
                                                        <?php } $i++; } ?>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="control-group">
                                                    <label class="control-label">Menus</label>
                                                    <div class="controls row">
                                                        <?php if(!empty($menus_list)){ $j=1;?>
                                                        <?php foreach($menus_list as $menus) { ?>
                                                        <div class="checkbox col-lg-6 col-sm-12 mb-1">  
                                                        <?php if(!empty($existing_menus_list) && in_array($menus->menu_id,$existing_menus_list)){  ?>
                                                        <label for="menuAccess_<?php echo $j; ?>"><input id="menuAccess_<?php echo $j; ?>" type="checkbox" checked="checked" name= "menus_list[]" value="<?php echo  $menus->menu_id; ?>" > <?php echo  $menus->description; ?></label>
                                                        <?php } else { ?>
                                                        <label for="menuAccess_<?php echo $j; ?>"><input id="menuAccess_<?php echo $j; ?>" type="checkbox" name= "menus_list[]" value="<?php echo  $menus->menu_id; ?>" > <?php echo  $menus->description; ?></label>
                                                        <?php }  ?>
                                                        </div>
                                                        <?php $j++; }} ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                            
                                             
                              </div>
                                </div>
                             
                              
                        </div>
                       
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <!--end col-->
     </div>
        <!--end row-->
       
        
        
    </div>
            <!-- container-fluid -->
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

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
