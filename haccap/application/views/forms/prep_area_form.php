<?php if(isset($action) && $action == 'view') {  $disabled = 'disabled'; } else{ $disabled = ''; } ?>
<style>
    .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
input[type="checkbox"]:checked:disabled:after {
    
    content: '';
    width: 13px;
    height: 13px;
    position: absolute;
    left: 13px;
    top: 3px;
    border-radius: 3px;
    border:1px solid #000;
    color: #fff;
    background-color: #45cb85 !important;
    border-color: #45cb85;
}
input[type="checkbox"]:checked:disabled {
    appearance: none;
    margin-left:14px;
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
                    
                        <form action="<?php echo base_url() ?>index.php/forms/prep_area_form_submit" method="post" class="form-horizontal" id="form_registration">
                
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">
                                        <?php if(isset($action) && $action =='add') {  ?>
                    			    		Add New Prep. Area
                    			    	<?php } else if(isset($action) && $action =='edit') {  ?>
                    			    		Update Prep. Area
                    			    	<?php } else { ?>
                    			    		View Prep. Area
                    			    	<?php } ?>
                    			    	</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/forms/prep_area_list"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php if(isset($action) && $action =='edit') {  ?>
                                    <input type="hidden" class="form-control" name="prep_area_id" value="<?php echo $prep_area[0]->prep_area_id; ?>" >
                                    <input type="submit" class="btn btn-primary" value="Update Prep. Area">
                                    <?php } else if(isset($action) && $action =='add') { ?>
                                    <input type="submit" class="btn btn-primary" value="Add Prep. Area">
                                    <?php }else{}?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <?php echo validation_errors(); ?>
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
                                        <div class="col-md-12 mb-4">  
                                            <div class="control-group">
                                              <label class="control-label">Name</label>
                                              <div class="controls">
                                                 <input type="text" name="prep_area_name" <?php echo $disabled; ?> id="prep_area_name" class ='form-control' value="<?php if(isset($prep_area[0]->prep_area_name) && $prep_area[0]->prep_area_name !='') {  echo $prep_area[0]->prep_area_name; }else{ echo ''; }  ?>" >
                                              </div>
                                            </div>
                                          </div>
                                        
                                        <div class="col-md-12 mb-4"> 
                                            <div class="control-group">
                                              <label class="control-label">Email</label>
                                              <div class="controls">
                                                 <input type="text" name="prep_area_useremail" <?php echo $disabled; ?> id="prep_area_useremail" class ='form-control'  value="<?php if(isset($prep_area[0]->prep_area_useremail) && $prep_area[0]->prep_area_useremail !='') {  echo $prep_area[0]->prep_area_useremail; }else{ echo ''; }  ?>">
                                              </div>
                                            </div>
                                        </div>
                                       
                                        <?php if(isset($action) && $action != 'view') { ?>
                                        <div class="col-md-6 mb-4">
                                            <div class="control-group">
                                              <label class="control-label">Password</label>
                                              <div class="controls">
                                                 <input type="password" name="prep_area_password" id="prep_area_password" class ='form-control' >
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
                                        <?php } ?>
                                      </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="control-group">
                                                  <label class="control-label">Forms</label>
                                                   <div class="controls row">
                                                    <?php if(!empty($haccap_forms)){  
                                                       foreach($haccap_forms as $row) { 
                                                            if(in_array($row->haccap_table_id, $haccap_table_access)) { ?>
                                                                <div class="checkbox col-lg-12 col-sm-12 mb-2">
                                                                <input type="checkbox" name= "haccap_table_id[]" checked="checked" <?php echo $disabled; ?> value="<?php echo  $row->haccap_table_id; ?>" id="checkbox-<?php echo  $row->haccap_table_id; ?>" > <label for="checkbox-<?php echo  $row->haccap_table_id; ?>"><?php echo  $row->table_description; ?></label>
                                                                </div>
                                                           <?php } else {  ?>
                                                                <div class="checkbox col-lg-12 col-sm-12 mb-2">  
                                                                <input type="checkbox" name= "haccap_table_id[]" <?php echo $disabled; ?> value="<?php echo  $row->haccap_table_id; ?>" id="checkbox-<?php echo  $row->haccap_table_id; ?>" > <label for="checkbox-<?php echo  $row->haccap_table_id; ?>"><?php echo  $row->table_description; ?></label>
                                                                </div>
                                                           
                                                        <?php } } } ?>
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
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 
<script type="text/javascript">
 $('#form_registration').validate({
    rules:{
      prep_area_name:{
        required:true
      },
      prep_area_useremail:{
        required:true,
        prep_area_useremail:true,
        remote:{type:'post',url:'<?php echo base_url() ?>index.php/forms/email_check',async:false}
      },
      
      prep_area_password:{
        required : true
      },
      password_confirm:{
        required : true,
        equalTo : '#prep_area_password'
      }
     },
      
    messages:{
      prep_area_name:{
        required:"Please Prep Area Name"
      },
      prep_area_useremail:{
        required:"Please Enter Email",
        prep_area_useremail:"Invalid Email Id",
        remote :"Email is already Exist"
      },
      password:{
        required : "Please Enter Password"
      },
      password_confirm:{
        required : "Please Enter Confirm Password",
        equalTo : '#prep_area_password'
      }
    }

  });
</script> 