
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
                    <?php if(isset($branch_id) && $branch_id !='' ) { ?>
                        <form action="<?php echo base_url() ?>index.php/admin/update_branch" method="post" class="form-horizontal" >
                    <?php } else { ?>
                        <form action="<?php echo base_url() ?>index.php/admin/create_branch" method="post" class="form-horizontal" id="form_registration">
                    <?php } ?>
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php if(isset($branch_id) && $branch_id !='' ) { echo "Edit Branch Details"; }else{ echo "Create Branch"; }?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/admin/branches"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php if(isset($branch_id) && $branch_id !='' ) { ?>
                                    <input type="hidden"  name="branch_id" value="<?php echo $branch_id?>">
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
                                    <div class="col-md-6"> 
                                      <div class="row">
                                        <div class="col-md-12 mb-12">  
                                            <div class="control-group">
                                              <label class="control-label">Branch Name</label>
                                              <div class="controls">
                                                <input type="text" name="branch_name" id="branch_name" class ='form-control' value="<?php if(isset($branch_name) && $branch_name !='') {  echo $branch_name; }else{ echo ''; }  ?>" >
                                              </div>
                                            </div>
                                          </div>
                                        
                                      </div>
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="control-group">
                                                  <label class="control-label">Status</label>
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
                                      
                                            
                                             
                              </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-6"> 
                                        <div class="control-group">
                                          <label class="control-label">Weekly Proj. sales</label>
                                          <div class="controls">
                                            <input type="text" name="budget" id="budget" class ='form-control' value="<?php if(isset($budget) && $budget !='') {  echo $budget; }else{ echo ''; }  ?>">
                                          </div>
                                        </div>
                                         
                                    </div>
                                    <?php $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); 
                                          foreach($weekdays as $weekday){ if(${$weekday.'_budget'} !='') { $week_budg = ${$weekday.'_budget'}; }else{ $week_budg = ''; } ?>
                                    <div class="col-lg-3 col-md-6"> 
                                        <div class="control-group">
                                          <label class="control-label"><?php echo $weekday; ?> Proj. sales</label>
                                          <div class="controls">
                                           <input type="text" name="<?php echo $weekday; ?>_budget" id="<?php echo $weekday; ?>_budget" class ='form-control' value="<?php  echo $week_budg;   ?>">
                                          </div>
                                        </div>
                                         
                                    </div> 
                                    <?php } ?>
                                   
                                   
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
