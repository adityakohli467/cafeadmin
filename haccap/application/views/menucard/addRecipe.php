<?php if(isset($form_name) && $form_name == 'view'){ $disabled='disabled'; } ?>
  <style>
      .auth-one-bg .bg-overlay {
    background: none;
    background-color: #000000;
    opacity: 0.8;
}
.bg-secondary{ 
    background-color: #FFDB57 !important;
}
      .form-control.disabled {
                cursor: text;
            }
            select.form-control.disabled {
                appearance: none;
            }
            .field-row{
        display:flex;
    }
    .field-row label {
        word-break: break-all;
        white-space: nowrap;
        padding: 8px 0px;
        margin-right: 13px;
        font-weight: 600;
        margin-bottom: 0 !important;
    }
    .field-row .form-control {
        padding: 5px 0px;
        height: 30px;
        font-size: 13px;
    }
     input[type=checkbox], input[type=radio] {
        margin: 9px 10px 9px 0;
    }
    .field-row textarea.form-control,
    .field-row textarea.form-control:focus{
        height: auto;
        box-shadow: none;
        border-radius: 0;
        border: 1px solid #d3d1d1 !important;
        padding:5px;
    }
    
    input.disabled {
    pointer-events: none;
}
.parent_table td {
    padding: 5px !important; 
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
                    
                        <form action="<?php echo base_url() ?>index.php/menucard/submitRecipe" method="post" enctype='multipart/form-data' class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php echo $heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menucard/viewRecipes/<?php echo $recipe_type;?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    <?php if(isset($form_name) && $form_name == 'view'){ ?>
                                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/menucard/download_recipe/<?php echo $recipe[0]->haacp_recipe_id;?>"><i class="mdi mdi-download align-bottom me-1"></i> Download Excel</a>
                                    <?php } else if(isset($form_name) && $form_name == 'edit'){ ?>
                                        <input type="submit" class="btn btn-primary" value="Update Recipe">
                                    <?php } else if(isset($form_name) && $form_name == 'recreate'){ ?>
                                    
                                    <input type="submit" class="btn btn-primary" value="Recreate Recipe">
                                    <?php }else {  ?>
                                    <input type="submit" class="btn btn-primary" value="Create Recipe">
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
                                     <?php if(isset($recipe[0]->haacp_recipe_id)){  ?>
                                          <input class="form-control" type="hidden" name="haacp_recipe_id" value="<?php echo $recipe[0]->haacp_recipe_id;?>">
                                      <?php } ?>
                                       <input class="form-control" type="hidden" name="recipe_type" value="<?php echo $recipe_type;?>">
                                      <!--form name -->
                                      <?php if(isset($form_name)){  ?>
                                          <input class="form-control " type="hidden" name="form_name" value="<?php echo $form_name; ?>">
                                      <?php } ?>
                          
                                      <div class="row">
                                         <div class="col-12 col-md-2 ">
                                             <label>Recipe Name</label>
                                        <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="recipe_name" value="<?php if(isset($recipe[0]->recipe_name)){ echo $recipe[0]->recipe_name; } ?>" placeholder="Recipe Name">
                                        </div>
                                        <div class="col-12 col-md-2 ">
                                             <label>Serving Size</label>
                                             
                                        <select class="form-control <?php echo $disabled; ?>" name="serving_size_id" <?php echo $disabled; ?>>
                                            
                                            <?php if(!empty($ServingSize)){ ?>
                                                <option>Select Serving Size</option>
                                                            <?php foreach($ServingSize as $row){ ?>
                                                    <option value="<?php echo $row->haccap_ServingSize_id; ?>" <?php if($recipe[0]->serving_size_id == $row->haccap_ServingSize_id ){ echo "selected"; }?>><?php echo $row->serving_size_name; ?></option>
                                            <?php } }else{ ?>
                                            <option>No Serving Size Found</option>
                                            <?php } ?>
                                        </select>
                                        </div> 
                                        <?php if(isset($recipe[0]->recipe_image) && $form_name == 'view'){ ?>
                                          <div class="col-12 col-md-2 ">
                                        
                                            <label>Recipe Image</label>
                                              <a  class="btn btn-primary" target="_blank" href="<?php  echo "/haccap/assets/recipesAttachments/".$recipe[0]->recipe_image; ?>">View Recipe Image</a>
                                            
                                                  </div> 
                                                  
                                        <?php } ?>
                                         <?php if(isset($recipe[0]->haacp_recipe_id)){ 
                                                if(isset($form_name) && $form_name != 'view'){ ?>
                                         <div class="col-12 col-md-2 ">
                                             <label>Status</label>
                                        <select class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> name="status">
                                               
                                                <option value="1"  <?php if(isset($recipe[0]->status) && $recipe[0]->status == '1' ){ echo 'selected'; } ?>>Activate</option>
                                                <option value="0"  <?php if(isset($recipe[0]->status) && $recipe[0]->status == '0' ){ echo 'selected'; } ?>>Deactivate</option>
                                            </select>
                                        </div>
                                         
                                         <?php } } ?>
                                        
                                         
                                      
                                      </div>
                                      <?php $i="0"; ?>
                                      <div class="create_menu_wrap">
                                          <div class="">
                                              <div class="table-responsive mb-1 mt-4">
                                                     <table class="table align-middle parent_table">
                                                       <thead class="table-dark text-white">
                                                           <th class="innerTableColumn">Ingredient Name</th>
                                                           <th class="innerTableColumn">Preparation</th>
                                                           <th class="innerTableColumn">Serves</th>
                                                           <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                                           <th class="innerTableColumn"></th>
                                                           <?php } ?>
                                                       </thead>
                                                        <tbody>
                                                            <?php if(!empty($ingredients)){ 
                                                                
                                                                    foreach($ingredients as $ingredient){ ?>
                                                                    <tr class="menurow">
                                                                        <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['ingredient']; ?>" name="ingredient[]"  placeholder="Ingredients"></td>
                                                                        <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['preparation']; ?>" name="preparation[]"  placeholder="Preparation"></td>
                                                                        <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['serves']; ?>" name="serves[]" placeholder="Serves"></td>
                                                                        
                                                                        <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns" style="margin: 6px 0;">
                                                                            
                                                                            <?php if( $i == '0'){ ?>
                                                                                <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                
                                                                            <?php  $i= $i + 1; }else{ ?>
                                                                                <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                            <?php } ?>
                                                                             </div>
                                                                </td> <?php } ?>
                                                                    </tr>
                                                               <?php } }else{ ?>
                                                               
                                                          <tr class="menurow">
                                                               
                                                                    <td> <input class="form-control" type="text" name="ingredient[]"  placeholder="Ingredients"></td>
                                                                    <td> <input class="form-control" type="text" name="preparation[]"  placeholder="Preparation"></td>
                                                                    <td> <input class="form-control" type="text" name="serves[]" placeholder="Serves"></td>
                                                                  <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                                                  <td class="menubtns-width">
                                                                    <div class="ct-btns" style="margin: 6px 0;">
                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                            
                                                            </div>
                                                                </td> <?php } ?>
                                                            </tr>
                                                               <?php } ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                          
                                                    <table class="table align-middle mt-4">
                                                           <thead class="table-dark text-white">
                                                               <td class="innerTableColumn">Method</td>
                                                           </thead>
                                                            <tbody>
                                                                <tr class="menurow">
                                                                    
                                                                        <td> <textarea class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> rows="10" name="recipe_method" placeholder="Method"><?php if(isset($recipe[0]->recipe_method)){ echo $recipe[0]->recipe_method; } ?></textarea></td>
                                                                        
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                          </div>
                                          
                                          <?php if($form_type == 'recipe_with_allergens'){ ?>
                                               <div class="row recipeCheckbox mt-4"> 
                                                     <div class="col-12 col-md-12 ">
                                                        <div class="field-row no-border"> <label>Common allergens present</label></div>
                                                     
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Milk" type="checkbox" name="milk" <?php if($allergens['milk'] == '1'){ echo "checked"; } ?> ><label>Milk (dairy)</label>
                                                          </div>
                                                    </div>
                                                      
                                                      <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Egg" type="checkbox" name="egg" <?php if($allergens['egg'] == '1'){ echo "checked"; } ?> ><label>Egg</label>
                                                          </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Fish" type="checkbox" name="fish" <?php if($allergens['fish'] == '1'){ echo "checked"; } ?> ><label>Fish</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Crustacean" type="checkbox" name="crustacean" <?php if($allergens['crustacean'] == '1'){ echo "checked"; } ?> ><label>Crustacean</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Mollusc" type="checkbox" name="mollusc" <?php if($allergens['mollusc'] == '1'){ echo "checked"; } ?> ><label>Mollusc</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Sesame" type="checkbox" name="sesame" <?php if($allergens['sesame'] == '1'){ echo "checked"; } ?> ><label>Sesame</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Lupin" type="checkbox" name="lupin" <?php if($allergens['lupin'] == '1'){ echo "checked"; } ?> ><label>Lupin</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Soy" type="checkbox" name="soy" <?php if($allergens['soy'] == '1'){ echo "checked"; } ?> ><label>Soy</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Peanut" type="checkbox" name="peanut" <?php if($allergens['peanut'] == '1'){ echo "checked"; } ?> ><label>Peanut</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Wheat" type="checkbox" name="wheat" <?php if($allergens['wheat'] == '1'){ echo "checked"; } ?> ><label>Wheat</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Barley" type="checkbox" name="barley" <?php if($allergens['barley'] == '1'){ echo "checked"; } ?> ><label>Barley</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Oats" type="checkbox" name="oats" <?php if($allergens['oats'] == '1'){ echo "checked"; } ?> ><label>Oats</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Rye" type="checkbox" name="rye" <?php if($allergens['rye'] == '1'){ echo "checked"; } ?> ><label>Rye</label>
                                                          </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 ">
                                                         
                                                        <div class="field-row">
                                                              <input  class="<?php echo $disabled; ?>" value="Gluten" type="checkbox" name="gluten" <?php if($allergens['gluten'] == '1'){ echo "checked"; } ?> ><label>Gluten</label>
                                                          </div>
                                                    </div>
                                            </div>
                                            <div class="row recipeCheckbox mt-4">
                                               <div class="col-12 col-md-12 "> <div class="field-row no-border"> <label>Tree Nuts:</label></div></div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input  class="<?php echo $disabled; ?>" value="Almond" type="checkbox" name="almond" <?php if($allergens['almond'] == '1'){ echo "checked"; } ?> ><label>Almond</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input  class="<?php echo $disabled; ?>" value="Brazil nut" type="checkbox" name="brazil_nut" <?php if($allergens['brazil_nut'] == '1'){ echo "checked"; } ?> ><label>Brazil nut</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input  class="<?php echo $disabled; ?>" value="Cashew" type="checkbox" name="cashew" <?php if($allergens['cashew'] == '1'){ echo "checked"; } ?> ><label>Cashew</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input  class="<?php echo $disabled; ?>" value="Hazelnut" type="checkbox" name="hazelnut" <?php if($allergens['hazelnut'] == '1'){ echo "checked"; } ?> ><label>Hazelnut</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input  class="<?php echo $disabled; ?>" value="Macadamia" type="checkbox" name="macadamia" <?php if($allergens['macadamia'] == '1'){ echo "checked"; } ?> ><label>Macadamia</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input class="<?php echo $disabled; ?>" value="Pecan" type="checkbox" name="pecan" <?php if($allergens['pecan'] == '1'){ echo "checked"; } ?> ><label>Pecan</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input class="<?php echo $disabled; ?>" value="Pine nut" type="checkbox" name="pine_nut" <?php if($allergens['pine_nut'] == '1'){ echo "checked"; } ?> ><label>Pine nut</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input class="<?php echo $disabled; ?>" value="Pistachio" type="checkbox" name="pistachio" <?php if($allergens['pistachio'] == '1'){ echo "checked"; } ?> ><label>Pistachio</label>
                                                  </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                 
                                                <div class="field-row">
                                                      <input class="<?php echo $disabled; ?>" value="Walnut" type="checkbox" name="walnut" <?php if($allergens['walnut'] == '1'){ echo "checked"; } ?> ><label>Walnut</label>
                                                  </div>
                                            </div>
                                            
                                          </div>
                                        <?php  } ?>
                                      </div>
                                      
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-6 ">
                                        <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                            <label>Upload Image</label>
                                            <input class="form-control" type="file" name="recipe_image">
                                        <?php } ?>
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



<script>
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();
    
 var table = $( '.parent_table' );
       $( table ).delegate( '.add_field_button', 'click', function () {
    var thisRow = $( this ).closest( 'tr' )[0];
    
    $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
    var thisRowAddbtn = $( thisRow ).next('tr').find( '.add_field_button' );
    if (!$(thisRow).has(".remove_field_button").length) {
   $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
    } 
    });
    
  

</script> 

<script>

    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});
</script>