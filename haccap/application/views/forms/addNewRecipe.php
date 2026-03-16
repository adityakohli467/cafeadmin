<?php if(isset($form_name) && $form_name == 'view'){ $disabled='disabled'; } ?>
	<style>
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
    .field-row{
        margin-bottom: 16px;
    }
    input.disabled {
    pointer-events: none;
}
	</style>
	
	<form action="<?php echo base_url(); ?>index.php/forms/submitRecipe" method="POST">
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
			<span class="text-center">
			    <h3><?php echo $heading; ?></h3>
			 <!--   <?php if(isset($recipe[0]->haacp_recipe_form_id) && $form_name == 'edit'){  ?>-->
			 <!--       <h3>Edit Recipe</h3>-->
			 <!--   <?php } else if(isset($form_name) && $form_name == 'recreate'){  ?>-->
			 <!--       <h3>Recreate Recipe</h3>-->
			 <!--   <?php } else if(isset($form_name) && $form_name == 'view'){  ?>-->
			 <!--       <h3>View Recipe</h3>-->
			 <!--   <?php } else { ?>-->
    <!--				<h3>Add Recipe</h3>-->
				<!--<?php } ?>-->
			</span>
			<?php if(isset($form_name) && $form_name != 'view'){ ?>
			<button type="submit" class="btn btn-success btn-ph">Save Recipe</button>
		    <?php } ?>
		    <?php if(isset($form_name) && $form_name == 'view'){ ?>
		        <a href="<?php echo base_url(); ?>index.php/forms/viewRecipes/<?php echo $recipe_type;?>" class="btn btn-success btn-ph">Back</a>
		        <a href="<?php echo base_url(); ?>index.php/forms/download_TempForm/<?php echo $recipe[0]->haacp_recipe_form_id;?>/haacp_recipe_form" class="btn btn-success btn-ph">Download Excel</a>
		    <?php } ?>
		
	</div>
	<!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container ct-mngemp">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
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
			      <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
						
							<div class="card-body">
							 <?php if(isset($recipe[0]->haacp_recipe_form_id)){  ?>
                			        <input class="form-control" type="hidden" name="haacp_recipe_form_id" value="<?php echo $recipe[0]->haacp_recipe_form_id;?>">
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
									       <label>Yield</label>
										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="yield" value="<?php if(isset($recipe[0]->yield)){ echo $recipe[0]->yield; } ?>" placeholder="Yield">
										</div>
										<div class="col-12 col-md-2 ">
									       <label>Portion size</label>
										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="portion_size" value="<?php if(isset($recipe[0]->portion_size)){ echo $recipe[0]->portion_size; } ?>" placeholder="Portion size">
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
										 <?php if(isset($recipe[0]->haacp_recipe_form_id)){ 
										        if(isset($form_name) && $form_name != 'view'){ ?>
										 <div class="col-12 col-md-2 ">
									       <label>Status</label>
										<select class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> name="status">
        								   
        								    <option value="1"  <?php if(isset($recipe[0]->status) && $recipe[0]->status == '1' ){ echo 'selected'; } ?>>Activate</option>
        								    <option value="0"  <?php if(isset($recipe[0]->status) && $recipe[0]->status == '0' ){ echo 'selected'; } ?>>Deactivate</option>
        								</select>
										</div>
										 
										 <?php } } ?>
										
									   <div class="col-12 col-md-2 ">
									       <label>Document Record Number</label>
										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="document_record_number" value="<?php if(isset($recipe[0]->document_record_number)){ echo $recipe[0]->document_record_number; } ?>" placeholder="Document Record Number">
										</div>
									
									</div>
									
									<div class="create_menu_wrap">
									    <div class="row">
									        <div class="ct-scroll">
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn text-center">Ingredients<br>(include brand)</td>
                                                               <td class="innerTableColumn text-center" colspan="2">
                                                                    <table>
                                                                    <tr><td colspan="2" class="innerTableColumn text-center">Amounts</td></tr>
                                                                    <tr><td class="innerTableColumn text-center">Quantity</td><td class="innerTableColumn text-center">Units</td></tr>
                                                                    </table></td>
                                                               <td class="innerTableColumn text-center">Common allergens present</td>
                                                                <td class="innerTableColumn text-center">Ingredient substitution options</td>
                                                               <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                                               <td class="innerTableColumn text-center"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            <tbody>
                                                                <?php if(!empty($ingredients)){ 
                                                                    $i="0";
                                                                        foreach($ingredients as $ingredient){ ?>
                                                                        <tr class="menurow">
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['ingredient']; ?>" name="ingredient[]"  placeholder="Ingredients"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['quantity']; ?>" name="quantity[]"  placeholder="Quantity"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['units']; ?>" name="units[]"  placeholder="Units"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['allergens_present']; ?>" name="allergens_present[]"  placeholder="Allergens Present"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" value="<?php echo $ingredient['ingredient_substitution_options']; ?>" name="ingredient_substitution_options[]" placeholder="Ingredient substitution options"></td>
                                                                            
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
                                                                   
                                                                       <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="ingredient[]"  placeholder="Ingredients"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="quantity[]"  placeholder="Quantity"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="units[]"  placeholder="Units"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="allergens_present[]"  placeholder="Allergens Present"></td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="ingredient_substitution_options[]" placeholder="Ingredient substitution options"></td>
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
                                                   <br>
                                                    <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn"colspan="3">Method</td>
                                                           </thead>
                                                            <tbody><?php if(!empty($recipe_method)){ 
                                                                     $i="0";
                                                                        foreach($recipe_method as $row){ ?>
                                                                <tr class="menurow">
                                                                    <tr class="menurow">
                                                                    
                                                                            <td style="width:100px;"> Step: </td>
                                                                            <td> <input class="form-control <?php echo $disabled; ?>" value="<?php echo $row ?>" type="text" name="recipe_method[]"></td>
                                                                      
                                                                      
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
                                                                      <?php } ?>  
                                                                        
                                                                </tr><?php } else { ?>
                                                                <tr class="menurow">
                                                                    <tr class="menurow">
                                                                    
                                                                            <td style="width:100px;"> Step : </td>
                                                                            <td> <input class="form-control" value="<?php echo $row ?>" type="text" name="recipe_method[]"></td>
                                                                      
                                                                      
                                                                      <?php if(isset($form_name) && $form_name != 'view'){ ?>
                                                                            <td class="menubtns-width">
                                                                                <div class="ct-btns" style="margin: 6px 0;">
                                                                                
                                                                               
                                                                                    <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                
                                                                                 </div>
                                                                    </td> <?php } ?>
                                                                </tr>
                                                                      <?php } ?>  
                                                                        
                                                                </tr>
                                                            </tbody>
                                            </table>
									    </div>
									    <br><br>
									    <div class="row">
    									   <div class="col-12 col-md-12 ">
    									      <div class="field-row"> <label>Common allergens present</label></div>
    										 
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Milk" type="checkbox" name="milk" <?php if($allergens[0]['milk'] == '1'){ echo "checked"; } ?> ><label>Milk (dairy)</label>
    									        </div>
    										</div>
    									    
    									    <div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Egg" type="checkbox" name="egg" <?php if($allergens[0]['egg'] == '1'){ echo "checked"; } ?> ><label>Egg</label>
    									        </div>
    										</div>
    										
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Fish" type="checkbox" name="fish" <?php if($allergens[0]['fish'] == '1'){ echo "checked"; } ?> ><label>Fish</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Crustacean" type="checkbox" name="crustacean" <?php if($allergens[0]['crustacean'] == '1'){ echo "checked"; } ?> ><label>Crustacean</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Mollusc" type="checkbox" name="mollusc" <?php if($allergens[0]['mollusc'] == '1'){ echo "checked"; } ?> ><label>Mollusc</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Sesame" type="checkbox" name="sesame" <?php if($allergens[0]['sesame'] == '1'){ echo "checked"; } ?> ><label>Sesame</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Lupin" type="checkbox" name="lupin" <?php if($allergens[0]['lupin'] == '1'){ echo "checked"; } ?> ><label>Lupin</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Soy" type="checkbox" name="soy" <?php if($allergens[0]['soy'] == '1'){ echo "checked"; } ?> ><label>Soy</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Peanut" type="checkbox" name="peanut" <?php if($allergens[0]['peanut'] == '1'){ echo "checked"; } ?> ><label>Peanut</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Wheat" type="checkbox" name="wheat" <?php if($allergens[0]['wheat'] == '1'){ echo "checked"; } ?> ><label>Wheat</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Barley" type="checkbox" name="barley" <?php if($allergens[0]['barley'] == '1'){ echo "checked"; } ?> ><label>Barley</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Oats" type="checkbox" name="oats" <?php if($allergens[0]['oats'] == '1'){ echo "checked"; } ?> ><label>Oats</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Rye" type="checkbox" name="rye" <?php if($allergens[0]['rye'] == '1'){ echo "checked"; } ?> ><label>Rye</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Gluten" type="checkbox" name="gluten" <?php if($allergens[0]['gluten'] == '1'){ echo "checked"; } ?> ><label>Gluten</label>
    									        </div>
    										</div>
    										</div>
    										<div class="row">
    										   <div class="col-12 col-md-12 "> <div class="field-row"> <label>Tree Nuts:</label></div></div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Almond" type="checkbox" name="almond" <?php if($allergens[0]['almond'] == '1'){ echo "checked"; } ?> ><label>Almond</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Brazil nut" type="checkbox" name="brazil_nut" <?php if($allergens[0]['brazil_nut'] == '1'){ echo "checked"; } ?> ><label>Brazil nut</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Cashew" type="checkbox" name="cashew" <?php if($allergens[0]['cashew'] == '1'){ echo "checked"; } ?> ><label>Cashew</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Hazelnut" type="checkbox" name="hazelnut" <?php if($allergens[0]['hazelnut'] == '1'){ echo "checked"; } ?> ><label>Hazelnut</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input  class="<?php echo $disabled; ?>" value="Macadamia" type="checkbox" name="macadamia" <?php if($allergens[0]['macadamia'] == '1'){ echo "checked"; } ?> ><label>Macadamia</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input class="<?php echo $disabled; ?>" value="Pecan" type="checkbox" name="pecan" <?php if($allergens[0]['pecan'] == '1'){ echo "checked"; } ?> ><label>Pecan</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input class="<?php echo $disabled; ?>" value="Pine nut" type="checkbox" name="pine_nut" <?php if($allergens[0]['pine_nut'] == '1'){ echo "checked"; } ?> ><label>Pine nut</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input class="<?php echo $disabled; ?>" value="Pistachio" type="checkbox" name="pistachio" <?php if($allergens[0]['pistachio'] == '1'){ echo "checked"; } ?> ><label>Pistachio</label>
    									        </div>
    										</div>
    										<div class="col-12 col-md-2 ">
    									       
        										<div class="field-row">
    									            <input class="<?php echo $disabled; ?>" value="Walnut" type="checkbox" name="walnut" <?php if($allergens[0]['walnut'] == '1'){ echo "checked"; } ?> ><label>Walnut</label>
    									        </div>
    										</div>
    										
    									</div>
    									<br><br>
    									<div class="row">
    									   <div class="col-12 col-md-2 ">
    									       <label>Name</label>
    										    <input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="name" value="<?php if(isset($recipe[0]->name)){ echo $recipe[0]->name; } ?>" placeholder="Name">
    										</div>
    										<div class="col-12 col-md-2 ">
    									       <label>Role</label>
    										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="role" value="<?php if(isset($recipe[0]->role)){ echo $recipe[0]->role; } ?>" placeholder="Role">
    										</div>
    										<div class="col-12 col-md-2 ">
    									       <label>Signed</label>
    										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="text" name="signed" value="<?php if(isset($recipe[0]->signed)){ echo $recipe[0]->signed; } ?>" placeholder="Signed">
    										</div>
    										<div class="col-12 col-md-2 ">
    									       <label>Date</label>
    										<input class="form-control <?php echo $disabled; ?>" <?php echo $disabled; ?> type="date" name="date" value="<?php if(isset($recipe[0]->date)){ echo $recipe[0]->date; } ?>" placeholder="Date">
    										</div>	
    									</div>
    									
									</div>
									<br><br>
									<div class="row">
								    <div class="col-12 col-md-12 ">
								        <div class="field-row">
								           <label style="width:100px;">Note</label>
									        <textarea class="form-control " rows="4" <?php if($form_name != 'add' && $form_name != 'recreate'){ echo "readonly disabled"; } ?> name="form_note"><?php echo $recipe[0]->form_note; ?></textarea>
								        </div>
								       
									</div>
									<div class="col-12 col-md-12 ">
								        <div class="field-row">
								           <label style="width:100px;">Comment</label>
									        <textarea class="form-control " rows="4" <?php if($form_name != 'add' && $form_name != 'recreate'){ echo "readonly disabled"; } ?> name="form_comment"><?php echo $recipe[0]->form_comment; ?></textarea>
								        </div>
								       
									</div>
								</div>
								</form>
							</div>
						</div> 
						
			
			
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		
		<!--.footer-->

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
    
  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");

</script> 

<script>

    function fetchmenu(obj){
        var menuPlannerID = $(obj).val();
        
        if(menuPlannerID == ''){
                    var selectInputcuisine=$(obj).closest(".menurow").find(".cuisine"); 
                     selectInputcuisine.val('');
                     
                     var selectInputcategory=$(obj).closest(".menurow").find(".category"); 
                     selectInputcategory.val('');
                     
                     var selectInputregular=$(obj).closest(".menurow").find(".regular"); 
                     selectInputregular.val('');
                     
                     var selectInputregular_color=$(obj).closest(".menurow").find(".regular_color"); 
                     selectInputregular_color.val('');
                     
                     var selectInputlarge=$(obj).closest(".menurow").find(".large"); 
                     selectInputlarge.val('');
                     
                     var selectInputlarge_color=$(obj).closest(".menurow").find(".large_color"); 
                     selectInputlarge_color.val('');
        }
        else{
            $.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/menuplanner/fetchMenu",
		    data: {"menuPlannerID":menuPlannerID},
		    success: function(data){
                 console.log(data);
                 var data1=JSON.parse(data)
                 $.each(data1, function(i, value) {
                     var selectInputcuisine=$(obj).closest(".menurow").find(".cuisine"); 
                     selectInputcuisine.val(value.cuisine);
                     
                     var selectInputcategory=$(obj).closest(".menurow").find(".category"); 
                     selectInputcategory.val(value.category);
                     
                     var selectInputregular=$(obj).closest(".menurow").find(".regular"); 
                     selectInputregular.val(value.regular);
                     
                     var selectInputregular_color=$(obj).closest(".menurow").find(".regular_color"); 
                     selectInputregular_color.val(value.regular_color);
                     
                     var selectInputlarge=$(obj).closest(".menurow").find(".large"); 
                     selectInputlarge.val(value.large);
                     
                     var selectInputlarge_color=$(obj).closest(".menurow").find(".large_color"); 
                     selectInputlarge_color.val(value.cuisine);
                });
                
		    }
		});
        }
    }
    
   
    
    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});
</script>