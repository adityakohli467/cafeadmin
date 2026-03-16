
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
                   
                        <form action="<?php echo base_url() ?>index.php/forms/submit_temperature_form/<?php  echo $table_name; ?>" id="menu_add" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php echo $heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/forms/TempFormList/<?php  echo $table_name; ?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    
                                    
                                    <input type="submit" class="btn btn-primary" value="Save Form">
                                  
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
                             <div class="row mb-4">
									    
									    <?php 
										    if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_food_transfer_and_order_record"){
                                        ?>
									   <div class="col-12 col-md-2 ">
									       <label>Cafe Name</label>
										<input class="form-control " type="text" name="cafe_name" placeholder="Cafe Name">
										</div>
										<?php } ?>
										
										<?php 
										  //  if($table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "food_allergen_menu" && $table_name != "haccap_food_transfer_and_order_record"){
                                        ?>
										<div class="col-12 col-md-2 ">
									       <label>Prep Area Name</label>
										<input class="form-control " type="text" name="prep_area_name" placeholder="Prep Area Name" value="<?php echo $_SESSION['prepAreaName']; ?>" <?php if(isset($_SESSION['formPrepArea'])){ echo "readonly";  } ?> >
										<input type="hidden" name="prep_name" value="<?php echo $_SESSION['formPrepArea']; ?>">
										</div>
										<?php // } ?>
										
										<?php // if($table_name == "haccap_kitchen_operational_closedown_checklist"){ ?>
                                            <!--<input type="hidden" name="prep_name" value="<?php echo $_SESSION['formPrepArea']; ?>">-->
										<?php // } ?>
										
										<?php 
										    //if($table_name != "haccap_dishwashing_form"){
                                        ?>
										<!--<div class="col-12 col-md-2 ">-->
									 <!--       <label>Entered By</label>-->
									 <!--   	<input class="form-control " type="text" name="entered_by" placeholder="Entered By">-->
										<!--</div>-->
										<?php // } ?>
										
										<?php if($table_name != "haccap_training_record"){ ?>
										<div class="col-12 col-md-3 ">
									       <label>Document Record Number</label>
										<input class="form-control " type="text" name="document_record_number" placeholder="Document Record Number">
										</div>
										<?php } ?>
										
										<?php if($table_name == "haccap_training_record"){ ?>
									       <div class="col-lg-3">
                                                <label>Role</label>
                                               <input type="text" class="form-control role_select" name="role" placeholder="role">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Employee Name</label>
                                                <input type="text" class="form-control role_select" name="emp" placeholder="Employee Name">
                                            </div>
										<?php } ?>
										
										
										 <?php 
										    if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "food_allergen_menu"){
                                        ?>
										<div class="col-12 col-md-2 ">
									       <label>Verified By</label>
										<input class="form-control " type="text" name="verified_by" placeholder="Verified By">
										</div>
										<?php } ?>
										<?php 
										    if($table_name == "haccap_food_transfer_and_order_record"){
                                        ?>
										<div class="col-12 col-md-2 ">
									       <label>Sign By</label>
										<input class="form-control " type="text" name="sign_by" placeholder="Sign By">
										</div>
										<?php } ?>
										
									 <?php 
										    if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "food_allergen_menu"){
                                        ?>
										<div class="col-12 col-md-2">
										     <label>Date</label>
										     <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" type="text" name="start_date">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
											
										</div>
										<?php } ?>
										
										 <?php 
										    if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "food_allergen_menu"){
                                        ?>
                						<!--<div class="col-12 col-md-2">-->
                						<!--     <label>End Date</label>-->
                						<!--<div class="input-group  ">-->
                      <!--                      <input class="form-control date datetimepicker1" type="text" name="end_date">-->
                      <!--                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>-->
                      <!--                  </div>-->
                						
                						<!--</div>-->
                						<?php } ?>
                						
									   	
									
									</div>
									<?php $weekdays = array('mon'=>'Mon','tue'=>'Tue','wed'=>'Wed','thu'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun'); ?>
									<div class="create_menu_wrap">
									    <div class="row">
									        <?php if($table_name != "haccap_food_wastage_report" && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "food_allergen_menu" && $table_name != "haccap_cold_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_food_transfer_and_order_record"){ ?>
									         
									         <!--weekday tabs form-->
									         
									        <div class="col-lg-12">
									            <ul class="tabs">
                                                      <li class="disable"></li>
                                                      <li class="active" rel="Mon">Mon</li>
                                                      <li rel="Tue">Tue</li>
                                                      <li rel="Wed">Wed</li>
                                                      <li rel="Thu">Thu</li>
                                                      <li rel="Fri">Fri</li>
                                                      <li rel="Sat">Sat</li>
                                                      <li rel="Sun">Sun</li>
                                                    </ul>
                                                    <div class="tab_container">
                                                        <!-- #Mon -->
                                                        <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                      <h3 class="d_active tab_drawer_heading" rel="<?php echo $weekday_name; ?>"><?php echo $weekday_name; ?></h3>
                                                      <div id="<?php echo $weekday_name; ?>" class="tab_content">
                                                           <div class="ct-scroll">
                                                    <?php if( $table_name == "haccap_temp_form"){
                                                            ?>   
			                                                 <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                    <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">Equipment Name, Unit Identification</td>
                                                                           </tr>  
                                                                           <tr> 
                                                                           <td> <input class="form-control equipField" data-rel="equipField_1" data-count="1" onchange="setValue(this)" type="text" name="<?php echo $title; ?>_equipname[]"  placeholder="Equipment Name, Unit Identification"></td>
                                                                           </tr> 
                                                                             </table>
                                                                  </td>
                                                                         
                                                                         
                                                                          <td class="menuinput-width">
                                              <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">
                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                            <tr> 
                                                                                <td class="td_label_text">Time (AM)</td>
                                                                                <td class="td_label_text">Temp. (AM)</td>

                                                                           </tr> 
                                                                           <tr> 
                                                                               <td> <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" id="time" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            </td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_AM_temp[]"  placeholder="Temp."></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td>
                                                                          <td class="innerTableColumn">
                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                          <tr> 
                                                                                <td class="td_label_text">Time (PM)</td>
                                                                                <td class="td_label_text">Temp. (PM)</td>

                                                                           </tr> 
                                                                           <tr> 
                                                                               <td> <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" id="time" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            </td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_PM_temp[]"  placeholder="Temp."></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td> 
                                                                          <td class="innerTableColumn">
                                                                                <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                    <tr> 
                                                                                            <td class="td_label_text">Entered By</td>
            
                                                                                       </tr> 
                                                                                    <tr> 
                                                                                        <td> <input class="form-control " type="text" name="<?php echo $title; ?>_entered_by[]" placeholder="Entered By"></td>
        
                                                                                    </tr> 
                                                                                </table>
                                                                           </td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           </tr> 
                                                                             </table>
                                                                             </td>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                    </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php } ?>
                                                    <?php if($table_name == "haccap_dishwashing_form"){
                                                            ?>   
			                                                 <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                    <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn td_label_text">Dishwasher Name </td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> <textarea class="form-control category textfieldlarge row2 equipField" <?php echo $disabled; ?>  data-rel="equipField_1" data-count="1" onchange="setValue(this)" name="<?php echo $title; ?>_name[]"  placeholder="Dishwasher Name"></textarea></td>
                                                                           </tr> 
                                                                             </table>
                                                                  </td>
                                                                         
                                                                         
                                                                          <td class="menuinput-width">
                                                                            <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">
                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                                <td class="td_label_text">Time (AM)</td>
                                                                                <td class="td_label_text">Wash Cycle (AM)</td>
                                                                                <td class="td_label_text">Rinse Cycle (AM)</td>
                                                                                <td class="td_label_text">Signed (AM)</td>

                                                                           </tr> 
                                                                           <tr> 
                                                                                <td> 
                                                                                <div class="input-group date datetimepicker3">
                                                                                <input class="form-control " type="text" id="time" name="<?php echo $title; ?>_AM_time[]">
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                                </td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_AM_field1[]"  placeholder="Wash Cycle"></td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_AM_field2[]"  placeholder="Rinse Cycle"></td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_AM_field3[]"  placeholder="Signed"></td>
                                                                           </tr> 
                                                                             </table>
                                                                           </td>
                                                                          <td class="innerTableColumn">
                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                                <td class="td_label_text">Time (PM)</td>
                                                                                <td class="td_label_text">Wash Cycle (PM)</td>
                                                                                <td class="td_label_text">Rinse Cycle (PM)</td>
                                                                                <td class="td_label_text">Signed (PM)</td>

                                                                           </tr>
                                                                           <tr> 
                                                                                <td> 
                                                                                    <div class="input-group date datetimepicker3">
                                                                                    <input class="form-control " type="text" id="time" name="<?php echo $title; ?>_PM_time[]">
                                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                    </div>
                                                                                </td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_PM_field1[]"  placeholder="Wash Cycle"></td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_PM_field2[]"  placeholder="Rinse Cycle"></td>
                                                                                <td> <input class="form-control" type="text" name="<?php echo $title; ?>_PM_field3[]"  placeholder="Signed"></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td>
                                                                           
                                                                           </tr> 
                                                                           <tr> 
                                                                           </tr> 
                                                                             </table>
                                                                             </td>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                    </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php } ?>
                                                    <?php if($table_name == "haccap_production_record_time"){ ?>   
            			                                                 <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                                           
                                                                            <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                                <tr class="menurow">
                                                                                    
                                                                                    <td class="menuinput-width headCol">
                                                                                    <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       <td class="innerTableColumn"><br>
                                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                           <tr> 
                                                                                                <td class="td_label_text">Product Name &/ or internal Batch Code Allocated </td>
            
                                                                                           </tr>
                                                                                           <tr> 
                                                                                                <td> <input class="form-control equipField" type="text" data-rel="equipField_1" data-count="1" onchange="setValue(this)" name="<?php echo $title; ?>_name[]"  placeholder="Product Name"></td>
                                                                                           </tr> 
                                                                                       </table>
                                                                                       
                                                                                       </td>
                                                                                       </tr> 
                                                                                       
                                                                                         </table>
                                                                              </td>
                                                                                     
                                                                                     
                                                                                      <td class="menuinput-width">
                                                                                        <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       <td class="innerTableColumn">
                                                                                           <!--Cooking Time-->
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Time Started Cooking or Prep</td>
                                                                                            <td class="td_label_text">Time Finished Cooking or Prep</td>
                                                                                            
            
                                                                                       </tr>
                                                                                       
                                                                                       <tr> 
                                                                                            <td> <div class="input-group date datetimepicker3">
                                                                                                <input class="form-control " type="text" id="time" name="<?php echo $title; ?>_cooking_time[]"  >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td> <div class="input-group date datetimepicker3">
                                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_cooking_field1[]"   >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                                </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                           <td class="td_label_text" colspan="2">Temp Of Product At End Of Cooking or Prep</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                            <td colspan="2"> <input class="form-control" type="text" name="<?php echo $title; ?>_cooking_field2[]"  placeholder="Temp."></td>
                                                                                            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                      <td class="innerTableColumn">
                                                                                          <!--Chilling Process-->
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                             <tr> 
                                                                                            <td class="td_label_text">Time Chilling Process Started</td>
                                                                                            <td class="td_label_text" colspan="2">Temp Of Product At End Of First 4hrs</td>
                                                                                           
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td>
                                                                                               <div class="input-group date datetimepicker3">
                                                                                               <input class="form-control " type="text" id="time" name="<?php echo $title; ?>_chilling_time[]"   >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                           </td>
                                                                                          <td colspan="2"> <input class="form-control" type="text" name="<?php echo $title; ?>_chilling_field2[]"  placeholder="Temp."></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="td_label_text">Time Chilling Process started of 5<sup>th</sup> hr</td>
                                                                                            <td class="td_label_text">Temp Of Product At 5<sup>th</sup> hr Of Chilling</td>
                                                                                            <td class="td_label_text">Temp Of Product At End Of 6<sup>th</sup> hr</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td> 
                                                                                            <div class="input-group date datetimepicker3">
                                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_chilling_field3[]"    >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                            </div>
                                                                                            </td>
                                                                                            <td> <input class="form-control" type="text" name="<?php echo $title; ?>_chilling_field4[]"  placeholder="Temp."></td>
                                                                                            <td> <input class="form-control" type="text" name="<?php echo $title; ?>_chilling_field5[]"  placeholder="Temp."></td>
            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td> 
                                                                                       <td class="innerTableColumn" style="width:200px;"><br>
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                        <tr> 
                                                                                            <td class="td_label_text">Comments (Where did product go- Sandwich Display – Hot Food – Salad Display, Cool room etc...)</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" type="text" name="<?php echo $title; ?>_comments[]"  placeholder="Comments"></td>
                                                                                          
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Signature</td>
            
                                                                                       </tr>
                                                                                                <tr> 
                                                                                                    <td> <input class="form-control " type="text" name="<?php echo $title; ?>_entered_by[]" placeholder="Entered By"></td>
                    
                                                                                                </tr>
                                                                                         </table>
                                                                                       </td> 
                                                                                      
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       </tr> 
                                                                                         </table>
                                                                                         </td>
                                                                                      <td class="menubtns-width">
                                                                                        <div class="ct-btns">
                                                                                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                                
                                                                                </div>
                                                                                    </td>
                                                                                   
                                                                                </tr>
                                                                            </tbody>
                                                            </table>
                                                            <?php } ?>
                                                        
                                                  </div>
                                                      </div>
                                                 
                                                    
                                                     <?php } ?>
                                                       
                                                    </div>
									        </div>
									        <?php } ?>
									        
									        <!--without weekday tabs form-->
									        <?php 
                                                if($table_name == "haccap_food_wastage_report"){ ?>   
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn headCol">Product Name</td>
                                                               <?php foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;"><?php echo $title; ?></td>
                                                               <?php } ?>
                                                               <td class="innerTableColumn">Total Number of Units</td>
                                                               <td class="innerTableColumn">Price $ Per Unit</td>
                                                               <td class="innerTableColumn">TOTAL WTD</td>
                                                               <td class="innerTableColumn">Entered By</td>
                                                               <td class="innerTableColumn"></td>
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol">
                                                                        <textarea class="form-control textfieldlarge row1" name="product_name[]"  placeholder="Product Name"></textarea></td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td> <input class="form-control" type="text" name="<?php echo $title; ?>_field[]"  placeholder=""></td>
                                                                     
                                                                       <?php } ?>
                                                                        <td> <input class="form-control" type="text" name="total_no_units[]"  disabled placeholder="Total"></td>
                                                                        <td> <input class="form-control" type="text" name="price_per_unit[]"  placeholder="Price"></td>
                                                                        <td> <input class="form-control" type="text" name="total_wtd[]"  disabled placeholder="TOTAL"></td>
                                                                        <td> <input class="form-control" type="text" name="entered_by[]"  placeholder="Entered By"></td>
                                                                      
                                                                      <td class="menubtns-width">
                                                                        <div class="ct-btns" style="margin: 6px 0;">
                                                                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                
                                                                </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                            </tbody>
                                            </table>
                                            <?php } ?>
                                            
                                              <?php 
           if($table_name == "haccap_calibration_form"){ ?>   
            <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
            <thead>
                <td class="innerTableColumn">Date</td>
                 <td class="innerTableColumn" style="text-transform: uppercase;">Item (brand or ID)</td>
                 <td class="innerTableColumn">Hot +/-</td>
                 <td class="innerTableColumn">Cold +/-</td>
                 <td class="innerTableColumn">Difference +/-</td>
                 <td class="innerTableColumn">Adjustment required</td>
                 <td class="innerTableColumn">Final Result</td>
                 <td class="innerTableColumn">Signature</td>
                  <td class="innerTableColumn"></td>
                 </thead>
              <tbody>
                <tr class="menurow">
                <td class="menuinput-width">
                    <div class="input-group  ">
                        <input class="form-control date datetimepicker1" type="text" name="caliberdate[]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                 
                  </td>
                <td class="menuinput-width">
                <input class="form-control" type="text" name="name[]"  placeholder="Item (brand or ID)">
                </td>
                <td class="menuinput-width">
                 <input class="form-control" type="text" name="hot[]"  placeholder="Hot +/-">   
                </td>
                <td class="menuinput-width">
                 <input class="form-control" type="text" name="cold[]"  placeholder="Cold +/-">   
                </td>
                <td class="innerTableColumn">
                <input class="form-control" type="text" name="difference[]"  placeholder="Difference +/-">
                </td>
                <td class="innerTableColumn">
                <input class="form-control" type="text" name="adjustment_required[]"  placeholder="Adjustment required">
                 </td>
            
                <td class="innerTableColumn">
                <input class="form-control" type="text" name="final_result[]"  placeholder="Final Result">
                </td>
                                                                                           
                <td class="innerTableColumn">
                <input class="form-control " type="text" name="entered_by[]" placeholder="Entered By">
                </td>
                <td class="menubtns-width">
                <div class="ct-btns">
                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                </div>
                  </td>
                </tr> 
               </tbody>
                 </table>
                <?php } ?>
                
                 <?php if($table_name == "haccap_cold_form"){  ?>  
                    <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn headCol-small">Equipment Name, Unit Identification</td>
                                                               <?php foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;"><?php echo $title; ?></td>
                                                               <?php } ?>
                                                              
                                                               <td class="innerTableColumn">Name of checking person</td>
                                                               <td class="innerTableColumn">Signature</td>
                                                               <td class="innerTableColumn"></td>
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol-small">
                                                                        <textarea class="form-control textfieldlarge" name="product_name[]"  placeholder="Product Name"></textarea></td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <label class="smallLabel">AM Time</label>
                                                                            <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" id="time" type="text" name="<?php echo $title; ?>_AM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            <label class="smallLabel">PM Time</label>
                                                                            <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_PM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div>
                                                                        
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td> <textarea class="form-control textfieldlarge" name="entered_by[]"  placeholder="Entered By"></textarea></td>
                                                                        <td> <textarea class="form-control textfieldlarge" name="signature[]"  placeholder="signature By"></textarea></td>
                                                                      
                                                                      <td class="menubtns-width">
                                                                        <div class="ct-btns" style="margin: 6px 0;">
                                                                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                
                                                                </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                            </tbody>
                                            </table>
                <?php }    ?>   
                 <?php if($table_name == "haccap_retention_stock_form" ){  ?>  
                    <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn headCol-small">Equipment Name, Unit Identification</td>
                                                               <?php foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;"><?php echo $title; ?></td>
                                                               <?php } ?>
                                                              
                                                               <td class="innerTableColumn">Name of checking person</td>
                                                               <td class="innerTableColumn">Signature</td>
                                                               <td class="innerTableColumn"></td>
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol-small">
                                                                        <textarea class="form-control textfieldlarge row3" name="product_name[]"  placeholder="Product Name"></textarea>         
                                                                    </td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <label class="smallLabel">AM Time</label>
                                                                           <div class="input-group date datetimepicker3"> 
                                                                                <input class="form-control" id="time" type="text" name="<?php echo $title; ?>_AM_time[]"   >
                                                                                 <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                          </div>
                                                                          <label class="smallLabel">PM Time</label>
                                                                          <div class="input-group date datetimepicker3">
                                                                            <input class="form-control" type="text" name="<?php echo $title; ?>_PM_time[]"   >
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                          </div> 
                                                                          <label class="smallLabel">Temp</label>
                                                                        <input class="form-control" type="text" name="<?php echo $title; ?>_temp[]"  placeholder="Temp.">
                                                                        
                                                                        
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td>
                                                                            <textarea class="form-control textfieldlarge row3" name="entered_by[]"  placeholder="Entered By"></textarea>
                                                                        </td>
                                                                        <td> 
                                                                           <textarea class="form-control textfieldlarge row3" name="signature[]"  placeholder="signature By"></textarea>
                                                                        </td>
                                                                      
                                                                      <td class="menubtns-width">
                                                                        <div class="ct-btns" style="margin: 6px 0;">
                                                                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                
                                                                </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                            </tbody>
                                            </table>
                <?php }    ?>   
                  <?php if($table_name == "haccap_food_transfer_and_order_record"){ ?>
                   <table class="row-border table-condensed table-bordered menuTable parent_table thcolor">
                                                    <thead>
                                                        <tr>
                                    						
                                    						<td class="innerTableColumn">Date</td>
                                    						<td class="innerTableColumn">Item</td>
                                                            <td class="innerTableColumn">Price</td>
                                                            <td class="innerTableColumn">Temperature at Loading</td>
                                                            <td class="innerTableColumn">Temperature at unloading</td>
                                                            <td class="innerTableColumn">Delivery Location</td>  
                                                            <td class="innerTableColumn">Received By</td>
                                                            <td class="innerTableColumn">Deliver By</td>
                                                            <td class="innerTableColumn"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	
                                                        <tr class="menurow">
                                    						<td width="130px" >
                                    						    <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" type="text" name="item_date[]">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                    						    
                                    						</td> 
                                    						<td><input class="form-control" type="text" name="item_name[]" style="width: 200px;" placeholder="Item"></td>
                                    						<td><input class="form-control" type="text" name="item_price[]" style="width: 75px;" placeholder="Price"></td>
                                    						<td><input class="form-control" type="text" name="item_temp_loading[]" placeholder="Temperature at Loading"></td>
                                    						<td><input class="form-control" type="text" name="item_temp_unloading[]" placeholder="Temperature at unloading"></td>
                                    						<td><input class="form-control" type="text" name="item_delivery_location[]" style="width: 145px;" placeholder="Delivery Location"></td>
                                    						<td><input class="form-control" type="text" name="item_received_by[]" placeholder="Received By"></td>
                                    						<td><input class="form-control" type="text" name="item_deliver_by[]" style="width: 145px;" placeholder="Deliver By"></td>
                                    						
                                    					
                                                            <td class="menubtns-width">
                                                                <div class="ct-btns" style="margin: 6px 0;">
                                                                    <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                 <?php } ?>
                                            
                 <?php 
				if($table_name == "haccap_kitchen_operational_closedown_checklist"){
                                        ?>   
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn"></td>
                                                               <td class="innerTableColumn"></td>
                                                               <?php foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;"><?php echo $title; ?></td>
                                                               <?php } ?>
                                                               
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">1</td>
                                                                    <td class="menuinput-width">Ensure all the Fridge Temperature At 5˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_fridge_temp"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                 <tr class="menurow">
                                                                    <td class="menuinput-width">2</td>
                                                                    <td class="menuinput-width">Dishwasher Empty / Cleaned Down & Switched Off</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_dishwasher"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">3</td>
                                                                    <td class="menuinput-width">Combi Oven Off & Cleaned with Door Left Open</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_combi_oven"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">4</td>
                                                                    <td class="menuinput-width">Ensure Cook Top Gas all Switched to Off Position</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cooktop_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">5</td>
                                                                    <td class="menuinput-width">Ensure Cook Top Ovens Washed & Gas all Switched to Off Position</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cooktop_washed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">6</td>
                                                                    <td class="menuinput-width">Both Hot Plates ( Grill Top Off )</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_hotplates"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">7</td>
                                                                    <td class="menuinput-width">Ensue Deep Fryers Switched Off and Oil Filtered If Not Changed</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_deep_fryers_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">8</td>
                                                                    <td class="menuinput-width">Dough Mixer Ensure Switch Off At Power Point</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_dough_mixer_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">9</td>
                                                                    <td class="menuinput-width">Ensure Cool room Door & Light Closed & Temperature At 5˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cool_room_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">10</td>
                                                                    <td class="menuinput-width">Ensure Chest Freezer Doors Closed , Temperature At -18˚C or Below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_chest_freeser_closed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">11</td>
                                                                    <td class="menuinput-width">Lights Switched Off And door Left Jarred For Air Flow. Ensure Change rooms Storage Areas Clean & Lights Off
</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_lights_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">12</td>
                                                                    <td class="menuinput-width">Ensure Back Exit Door Closed & Locked</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_exit_door_closed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">13</td>
                                                                    <td class="menuinput-width">Ensure Hot Boxes Washed / Switched Off & Doors Left Open</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_hot_boxes_washed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">14</td>
                                                                    <td class="menuinput-width">Mixer Turned Off At P/P & Cleaned</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_mixer_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">15</td>
                                                                    <td class="menuinput-width">Slicer Turned Off At P/P & Cleaned</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_slicer_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">16</td>
                                                                    <td class="menuinput-width">Bench Tops Cleaned & Clear</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_benchtop_cleaned"></td>
                                                                    <?php } ?>
                                                                </tr>
                                    
                                                               
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">17</td>
                                                                    <td class="menuinput-width">Ensure Main Freezer Door & Light Closed & Temperature At -18˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_main_freezer_closed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">18</td>
                                                                    <td class="menuinput-width">All Wall Power Points Switched Off</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_wall_power_point_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">19</td>
                                                                    <td class="menuinput-width">Washed and Relined Rubbish Bins</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_rubbish_bins_washed"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">20</td>
                                                                    <td class="menuinput-width">Ensure Lights Switched Off In Kitchen</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_kitchen_light_off"></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                            </tbody>
                                            </table>
                                            <?php } ?>
               <?php 
				if($table_name == "haccap_operational_incident_report"){ ?>   
                                            	
                                            	<div class="haccap-form-wrap">
                                                    	<div class="col-12 col-md-6 ">
                									        <div class="field-row">
                									           <label>Corrective Action (Operational)</label>
                										        <input class="form-control " type="text" name="correctiveaction">
                									        </div>
                									       
                										</div>
                									    
                									    <div class="col-12 col-md-3">
                									        <div class="field-row">
                    										    <label>Date</label>
                    										    <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" type="text" name="correctiveaction_date">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                    										
                											</div>
                										</div>
                										 
                										 <div class="col-12 col-md-3">
                									        <div class="field-row">
                    										    <label>Time</label>
                    										    <div class="input-group date datetimepicker3">
                                                                    <input class="form-control " type="text" name="correctiveaction_time">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                </div>
                    											
                											</div>
                										</div>
                										
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Reason for Non-conformance</label>
                										        <input class="form-control " type="text" name="reason_for_non_conformance">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Name of Company/Organisation</label>
                										        <input class="form-control " type="text" name="organisation">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-6 ">
                									        <div class="field-row">
                									           <label>Name of Contact Person</label>
                										        <input class="form-control " type="text" name="name_of_contact_person">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-6 ">
                									        <div class="field-row">
                									           <label>Contact Number</label>
                										        <input class="form-control " type="text" name="contact_of_contact_person">
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Report</label>
                										        <textarea class="form-control " rows="4" name="report"></textarea>
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-6 ">
                									        <div class="field-row">
                									           <label>Reply To</label>
                										        <input class="form-control " type="text" name="reply_to" >
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-3 ">
                									        <div class="field-row">
                									           <label>Date</label>
                									           <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" type="text" name="reply_to_date">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                										        
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-3 ">
                									        <div class="field-row">
                									           <label>Incident Date</label>
                									           <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" type="text" name="incident_date">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                										        
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Description of Non-conformance:</label>
                										        <label>Internal C/O </label><input value="internal" type="radio" name="description_of_non_conformance">
                										        <label>OH&S </label><input value="ohs" type="radio" name="description_of_non_conformance">
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Detailed Description of Event</label>
                										        <textarea class="form-control " rows="4" name="detailed_description_of_event"></textarea>
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Classification:</label>
                										        <label>Urgent</label><input value="urgent" type="radio" name="classification">
                										        <label>Non-urgent</label><input value="nonurgent" type="radio" name="classification">
                										        <label>Ongoing</label><input value="ongoing" type="radio" name="classification">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Reason of Occurance & Outcome</label>
                										        <textarea class="form-control " rows="4" name="reason_of_occurance"></textarea>
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-6">
                									        <div class="field-row">
                									           <label>Date Corrective Action Taken</label>
                									           <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" type="text" name="date_corrective_action_taken">
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                										        
                									        </div>
                									       
                										</div>
                											<div class="col-12 col-md-6 ">
                									        <div class="field-row">
                									           <label>Verified By</label>
                										        <input class="form-control " type="text" name="verified_by">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-12 ">
                									        <div class="field-row">
                									           <label>Results (office use only)</label>
                										        <input class="form-control " type="text" name="results">
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-3">
                									        <div class="field-row">
                									           <label>Satisfactory</label>
                										        <input class="form-control " type="text" name="satisfactory">
                									        </div>
                									       
                										</div>
                										<div class="col-12 col-md-3">
                									        <div class="field-row">
                									           <label>Un-satisfactory</label>
                										        <input class="form-control " type="text" name="unsatisfactory">
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-3">
                									        <div class="field-row">
                									           <label>Followup</label>
                										        <input class="form-control " type="text" name="followup">
                									        </div>
                									       
                										</div>
                										
                										<div class="col-12 col-md-3">
                									        <div class="field-row">
                									           <label>Signed By</label>
                										        <input class="form-control " type="text" name="signed_by">
                									        </div>
                									       
                										</div>
                                            </div>
                                            <?php } ?>

                <?php 
				if($table_name == "food_allergen_menu"){ ?>
                 <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <tr>
                                                                   <td class="innerTableColumn"></td>
                                                                   <td class="innerTableColumn" colspan="9"></td>
                                                                   <td class="innerTableColumn" colspan="9" style="text-transform: uppercase;">Tree nuts</td>
                                                                   <td class="innerTableColumn" colspan="5" style="text-transform: uppercase;">Gluten containing cereals</td>
                                                                   <td></td>
                                                               </tr>
                                                               <tr>
                                                                   <td class="innerTableColumn">Menu item</td>
                                                                   <td class="innerTableColumn">Milk (dairy)</td>
                                                                   <td class="innerTableColumn">Egg</td>
                                                                   <td class="innerTableColumn">Fish</td>
                                                                   <td class="innerTableColumn">Crustacean</td>
                                                                   <td class="innerTableColumn">Mollusc</td>
                                                                   <td class="innerTableColumn">Sesame</td>
                                                                   <td class="innerTableColumn">Lupin</td>
                                                                   <td class="innerTableColumn">Peanut</td>
                                                                   <td class="innerTableColumn">Soy</td>
                                                                   <td class="innerTableColumn">Almond</td>
                                                                   <td class="innerTableColumn">Brazil nut</td>
                                                                   <td class="innerTableColumn">Cashew</td>
                                                                   <td class="innerTableColumn">Hazelnut</td>
                                                                   <td class="innerTableColumn">Macadamia</td>
                                                                   <td class="innerTableColumn">Pecan</td>
                                                                   <td class="innerTableColumn">Pine nut</td>
                                                                   <td class="innerTableColumn">Pistachio</td>
                                                                   <td class="innerTableColumn">Walnut</td>
                                                                   <td class="innerTableColumn">Wheat</td>
                                                                   <td class="innerTableColumn">Gluten</td>
                                                                   <td class="innerTableColumn">Barley</td>
                                                                   <td class="innerTableColumn">Oats</td>
                                                                   <td class="innerTableColumn">Rye</td>
                                                                   <td></td>
                                                               </tr>
                                                               
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width"><input type="text" class="form-control" name="menu_item[]" placeholder="Menu Item"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="milk[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="egg[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="fish[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="crustacean[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="mollusc[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="sesame[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="lupin[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="peanut[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="soy[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="almond[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="brazil_nut[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="cashew[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="hazelnut[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="macadamia[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="pecan[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="pine_nut[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="pistachio[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="walnut[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="wheat[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="gluten[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="barley[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="oats[]"></td>
                                                                    <td class="menuinput-width"><input type="checkbox" value="1" name="rye[]"></td>
                                                                    <td class="menubtns-width">
                                                                        <div class="ct-btns" style="margin: 6px 0;">
                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                                 
                                                                
                                                            </tbody>
                                            </table>
                 <?php } ?>
                    <?php 
                  if($table_name == "haccap_mockrecall_record"){ ?>   
                                              
                                              <div class="haccap-form-wrap">
                                                 
                                      
                                      <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Date Initiated</label>
                                            <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" type="text" name="date_initiated">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                          
                                      </div>
                                    </div>
                                     
                                     <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Time Initiated</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="time_initiated">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Date Completed</label>
                                            <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" type="text" name="date_completed">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                         
                                      </div>
                                    </div>
                                     
                                     <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Time Completed</label>
                                            <div class="input-group date datetimepicker3">
                                            <input class="form-control " type="text" name="time_completed">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Description of Product or Raw Material</label>
                                            <textarea class="form-control " rows="4" name="description_of_product"></textarea>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Description of Scenario</label>
                                            <textarea class="form-control " rows="4" name="description_of_scenario"></textarea>
                                          </div>
                                         
                                    </div>


                                    <div class="col-12 col-md-4 ">
                                          <div class="field-row">
                                             <label>Completed By</label>
                                            <input class="form-control " type="text" name="completed_by">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Date</label>
                                            <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" type="text" name="completed_by_date">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                          
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Time</label>
                                            <div class="input-group date datetimepicker3">
                                            <input class="form-control " type="text" name="completed_by_time">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>

                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Reviewed by:</label>
                                            <label>Management </label><input value="management" type="radio" name="reviewed_by">
                                            <label>Team </label><input value="team" type="radio" name="reviewed_by">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Date</label>
                                            <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" type="text" name="reviewed_by_date">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                          
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Time</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="reviewed_by_time">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>




                                    
                                            </div>
                                            <?php } ?>
                 <?php 
                if($table_name == "haccap_training_record"){ ?>   
                  <div class="record_wrap">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-12"><p>Key: 0. Not Applicable/Training not required 1. Can Do Under Supervision  2. Can do without supervision 3. Can trouble shoot the risk 4. Can train others</p></div>
                                                        
                                                        <div class="col-lg-12 record_table_wrap">
                                                             <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" cellspacing="0" width="100%">
                                                               <thead>
                                                                   <td class="innerTableColumn" style="text-align:center;">Skill or Training requirements</td>
                                                                   <td class="innerTableColumn" style="text-align:center;">Required Skill Level</td>
                                                                   <td class="innerTableColumn" style="text-align:center;">Current Capability</td>
                                                                   <td class="innerTableColumn" style="text-align:center;">Future Training required?</td>
                                                                   
                                                                   <td class="innerTableColumn"></td>
                                                                   
                                                               </thead>
                                                                <tbody>
                                                                    
                                                                           
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width">
                                                                            <input class="form-control" type="text" name="skill_name[]"  placeholder="Skill or Training requirements" ></td>
                                                                        
                                                                            <td> <input class="form-control" type="text" name="required_skill_level[]" placeholder="Required Skill Level"></td>
                                                                            <td> <input class="form-control" type="text" name="current_capability[]" placeholder="Current Capability"></td>
                                                                            <td> <select class="form-control" name="future_training_required[]">
                                                                                <option>Future Training required?</option>
                                                                                <option value="1">YES</option>
                                                                                <option value="0">NO</option>
                                                                            </select></td> 
                                                                           
                                                                           
                                                                              <td class="menubtns-width">
                                                                                <div class="ct-btns">
                                                                         <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                         
                                                                        </div>
                                                                            </td>
                                                                          
                                                                        </tr>
                                                                         
                                                                </tbody>
                                                        </table>
                                                        <!--<div class="menubtns-width-wrap" style="margin-left:6px">-->
                                                        <!--    <div class="ct-btns">-->
                                                        <!--     <a href="javascript:void(0)" class="btn add_wrap_button" style="background-color:#16b708;color:#fff;">+</a>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        </div>
                                                    </div>
                                            </div>
                  <?php } ?>          
									    </div>
									</div>
									
									
								</form>
								<?php 
                                    if($table_name != "haccap_training_record"){ ?>
								<br><br>
								<div class="row">
								    <div class="col-12 col-md-12 ">
								        <div class="field-row">
								           <label style="width:100px;">Notes</label>
									        <textarea class="form-control " rows="4" name="form_note"></textarea>
								        </div>
								       
									</div>
									<div class="col-12 col-md-12 ">
								        <div class="field-row">
								           <label style="width:100px;">Comments</label>
									        <textarea class="form-control " rows="4" name="form_comment"></textarea>
								        </div>
								       
									</div>
								</div>
								<?php } ?>
							</div>
							
							
						</div> 
						
			<!--end-->
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

    function setValue(that){
        var equipRel = $(that).attr('data-rel');
        var equipVal = $(that).val();
        $('[data-rel='+equipRel+']').val(equipVal);
    }
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();
    
 var table = $( '.parent_table' );
       $( table ).on( 'click', '.add_field_button', function () {
    var thisRow = $( this ).closest( 'tbody' )[0];
    
    
    if($( thisRow ).find( '.equipField' ).length != 0){
       
        var contentBodyCount = $( thisRow ).attr('data-count');
       
        var weekddays = ['mon','tue','wed','thu','fri','sat','sun'];
        for(var i=0;i<7;i++){
            
            var contentBodyCountnext = contentBodyCount;
            $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).clone().insertAfter( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).find( 'input:text,textarea' ).val( '' );
        
        
        var thisRowAddbtn = $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).next('tbody').find( '.add_field_button' );
            if (!$(thisRow).has(".remove_field_button").length) {
           $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
            } 
            
            var rowcount = $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).find( '.equipField' ).attr('data-count');
            var tempRow = $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).nextAll('tbody');
            tempRow.each(function() {
            
            contentBodyCountnext = parseInt(contentBodyCountnext) + 1;
            
            $(this).attr('data-count',contentBodyCountnext);
            $(this).attr('data-rel',weekddays[i]+'_contentBody_'+contentBodyCountnext);
            
            rowcount = parseInt(rowcount) + 1;
            var equipVal = $('[data-rel=equipField_'+rowcount+']').val();
            $(this).find( '.equipField' ).attr('data-count',rowcount);
            $(this).find( '.equipField' ).attr('data-rel','equipField_'+rowcount);
           
            
            $(this).find( '.equipField' ).val(equipVal);
            
        });
        }
        
    }else{
       
        $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text,textarea' ).val( '' );
    
            var thisRowAddbtn = $( thisRow ).next('tbody').find( '.add_field_button' );
            if (!$(thisRow).has(".remove_field_button").length) {
                $('<a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
            } 
    }
    
    
    
        $('.datetimepicker3').datetimepicker({
            format: 'HH:mm A'
        });
    });
    
    // clone row for wrap
    
    var wrap = $('.record_wrap' );
       $(document).on( 'click', '.add_wrap_button', function () {
        
    var thisRow = $( this ).closest( '.record_wrap' );
    
    $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
    var thisRowAddbtn = $( thisRow ).next('.record_wrap').find( '.add_wrap_button' );
    if (!$(thisRow).has(".remove_wrap_button").length) {
   $('<a href="javascript:void(0)" class="btn remove_wrap_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>').insertAfter(thisRowAddbtn);
    } 
    
        $('.datetimepicker3').datetimepicker({
            format: 'HH:mm A'
        });
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
    var thisRow = $( this ).closest( '.contentBody' );
   
    if($( thisRow ).find( '.equipField' ).length != 0){
        var contentBodyCount = $( thisRow ).attr('data-count');
        
        var weekddays = ['mon','tue','wed','thu','fri','sat','sun'];
        for(var i=0;i<7;i++){
            
            var contentBodyCountnext = contentBodyCount;
            $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).remove();
            
            var rowcount = $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).find( '.equipField' ).attr('data-count');
            var tempRow = $( '[data-rel='+weekddays[i]+'_contentBody_'+contentBodyCount+']' ).nextAll('tbody');
            tempRow.each(function() {
            
            
            
            $(this).attr('data-count',contentBodyCountnext);
            $(this).attr('data-rel',weekddays[i]+'_contentBody_'+contentBodyCountnext);
            
            
            // var equipVal = $('[data-rel=equipField_'+rowcount+']').val();
            $(this).find( '.equipField' ).attr('data-count',rowcount);
            $(this).find( '.equipField' ).attr('data-rel','equipField_'+rowcount);
        
        contentBodyCountnext = parseInt(contentBodyCountnext) + 1;
        rowcount = parseInt(rowcount) + 1;
            });
        }
    }else{
    $(this).parent().parents('.menurow').remove();
    }
});
// remove wrap
 $(document).on("click", ".remove_wrap_button" , function() {
     
    
        $(this).parent().parents('.record_wrap').remove();
    
});


$(document).ready(function(){
     
    $('.datetimepicker3').datetimepicker({
        format: 'HH:mm A'
    });
    
$(document).on("click" , function() {
$('.datetimepicker1').datetimepicker({
	format: 'DD-MM-YYYY',
	<!--minDate:new Date()-->
});});
});
</script>