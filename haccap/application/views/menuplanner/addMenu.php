
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
                    <?php if(isset($action) && $action =='edit') {  ?>
                        <form action="<?php echo base_url() ?>index.php/menuplanner/submitupUpdateMenu" id="menu_add" method="post" class="form-horizontal" >
                    <?php } else { ?>
                        <form action="<?php echo base_url() ?>index.php/menuplanner/submitMenu" id="menu_add" method="post" class="form-horizontal" >
                    <?php } ?>
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">
                                        <?php if(isset($action) && $action =='edit') {  ?>
                    			    		Update Menu
                    			    	<?php } else { ?>
                    			    		Add New Menu
                    			    	<?php } ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menuplanner/viewMenu"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    
                                    <?php if(isset($action) && $action =='edit') {  ?>
                                        <input type="submit" class="btn btn-primary" value="Update Menu">
                                    <?php }else {  ?>
                                    <input type="submit" class="btn btn-primary" value="Add New Menu">
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
                           
                                <div class="row">
                                     <?php if(isset($menuplannerDetails->menuPlannerID)){  ?>
                                         <input type="hidden" class="form-control" name="menuPlannerID" value="<?php echo $menuplannerDetails->menuPlannerID; ?>" >
                                      <?php } ?>
                                       
                          
                  <div class="row">
                     <div class="col-12 col-md-4 mb-4">
                         <label>Menu Category :<span>*</span></label>
                            <select class="form-control" name="category" required onchange="fetchMenuCategory(this);">
							     <option value="">-- Select Menu Category --</option>
							    <?php foreach($menuPlanner_category as $row){  
							    if($row->category_id == $menuplannerDetails->category_id){ ?>
							        <option value="<?php echo $row->category_id; ?>" selected><?php echo $row->name; ?></option>
							    <?php }else{ ?>
							        <option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
							    <?php } } ?>
							</select>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <label>Cuisine :<span>*</span></label>
                         
                        <input type="text" class="form-control" required name="cuisine" autocomplete="off" value="<?php echo ($menuplannerDetails->cuisine !='' ? $menuplannerDetails->cuisine : '') ?>" >
                    </div>
                     
                     <div class="col-12 col-md-4 mb-4">
                        <label>Menu :<span>*</span></label>
                        <input type="text" class="form-control" required name="menu"  autocomplete="off" value="<?php echo ($menuplannerDetails->menu !='' ? $menuplannerDetails->menu : '') ?>" >
                    </div>
                    
                    <div class="col-12 col-md-3 mb-4">
                        <label>Regular</label>
                        <input type="text" class="form-control" name="regular"  autocomplete="off" value="<?php echo ($menuplannerDetails->regular !='' ? $menuplannerDetails->regular : '') ?>" >
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <label>Traffic Light Regular</label>
                        <select class="form-control" name="regular_color">
							<option value="">Select</option>
							<option value="Amber" <?php echo ($menuplannerDetails->regular_color =='Amber' ? 'selected' : '') ?> >Amber</option>
							<option value="Green" <?php echo ($menuplannerDetails->regular_color =='Green' ? 'selected' : '') ?> >Green</option>
							<option value="Red" <?php echo ($menuplannerDetails->regular_color =='Red' ? 'selected' : '') ?> >Red</option>
						</select>
                    </div>
                    <div class="col-12 col-md-3 mb-4">
                        <label>Large</label>
                        <input type="text" class="form-control" name="large"  autocomplete="off" value="<?php echo ($menuplannerDetails->large !='' ? $menuplannerDetails->large : '') ?>" >
                    </div>
                    <div class="col-12 col-md-3 mb-4">
                        <label>Traffic Light Large</label>
                        <select class="form-control" name="large_color">
							<option value="">Select</option>
							<option value="Amber" <?php echo ($menuplannerDetails->large_color =='Amber' ? 'selected' : '') ?> >Amber</option>
							<option value="Green" <?php echo ($menuplannerDetails->large_color =='Green' ? 'selected' : '') ?> >Green</option>
							<option value="Red" <?php echo ($menuplannerDetails->large_color =='Red' ? 'selected' : '') ?> >Red</option>
						</select>
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
	$(document).ready(function() { 
	    $("#menu_add").validate({
	      	ignore: "input[type='text']:hidden",
		    rules: {
			cuisine: {
	                required:true
	            },
	        category: {
	                required:true
	            }, 
	        menu: {
	        	required:true
            
            },
	       // regular: {
	       //         required:true
	       //     },
	       // large: {
	       //         required:true
	       //     }   
			},		
			messages: {
			cuisine: {
	                required:"Please Provide the Cuisine Name"
	            },
	        category: {
	                required:"Please Provide the Category Name"
	            },    
	        menu: {
	        
                 required:"Please Provide the menu name"
                 },
	       // regular: {
	       //        required:"Please Provide the regular value"
	       //     },
	       // large: {
	       //       required:"Please Provide the large value"
	       //     }   
			}

	    });	
	});
	
	
	function fetchMenuCategory(obj){
        var category_id = $(obj).val();
        var menuOptions='';
        if(category_id == ''){
                var selectmenuwrap=$("#subCategorywrap"); 
                selectmenuwrap.css('display','none');
        }
        else{
            $.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/menuplanner/fetchMenuCategory",
		    data: {"category_id":category_id},
		    success: function(data){
                 console.log(data);
                 if(data != 'No record'){
                     var data1=JSON.parse(data)
                     menuOptions+='<option value="">Select Category</option>';
                 $.each(data1, function(i, value) {
                     menuOptions+='<option value="'+value.subcategory_id+'">'+value.subcategory_name+'</option>';
                     
                     
                });
                
                 }
                 else{
                     menuOptions+='<option value="">No Category</option>';
                 }
                 console.log(menuOptions);
                var selectmenuwrap=$("#subCategorywrap");
                var selectmenu=$("#subCategory");
                selectmenu.html(menuOptions);
                selectmenuwrap.css('display','block');
		    }
		});
        }
    }
    
</script>