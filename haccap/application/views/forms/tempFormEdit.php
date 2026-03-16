
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
                   
                        <form action="<?php echo base_url() ?>index.php/forms/update_temperature_form/<?php echo $table_name; ?>" id="menu_add" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><?php echo $heading; ?></h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/forms/TempFormList/<?php echo $table_name; ?>"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    
                                    <?php if($disabled == '' && $recreate == 'recreate') { ?>
                                     <input type="submit" class="btn btn-primary" value="Recreate Form">
                                    <?php }else if($disabled == '') {  ?>
                                     <input type="submit" class="btn btn-primary" value="Update Form">
                                     <?php  }else if($disabled == 'disabled') {  ?>
                                      <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/forms/download_TempForm/<?php echo $TempFormData['id']; ?>/<?php echo $table_name; ?>"><i class="mdi mdi-download align-bottom me-1"></i> Download Excel</a>
                                       <?php } ?>
                                   
                                    <input type="hidden" name="id" value="<?php echo $TempFormData['id']; ?>">
       <input type="hidden" name="recreate" value="<?php echo $recreate; ?>">
                                  
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
                    <input class="form-control" type="text" <?php echo $disabled; ?> name="cafe_name" placeholder="Cafe Name" value="<?php echo $TempFormData['cafe_name']; ?>" >
                    </div>
                      <?php } ?>
                    
                    <?php 
                       // if($table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" &&$table_name != "haccap_training_record" && $table_name != "haccap_food_transfer_and_order_record"){
                                        ?>
                    <div class="col-12 col-md-2 ">
                         <label>Prep Area Name</label>
                    <input class="form-control " type="text" name="prep_area_name" placeholder="Prep Area Name" value="<?php echo $_SESSION['prepAreaName']; ?>" readonly>
                      <input type="hidden" name="prep_name" value="<?php echo $_SESSION['formPrepArea']; ?>">
                    </div>
                    <?php //} ?>
                    <?php //if($table_name == "haccap_kitchen_operational_closedown_checklist"){ ?>
                                            <!--<input type="hidden" name="prep_name" value="<?php echo $_SESSION['formPrepArea']; ?>">-->
                    <?php //} ?>
                    
                    <?php 
                        if($table_name != "haccap_dishwashing_form" && $table_name != "haccap_training_record"){
                                        ?>
                    <!--  <div class="col-12 col-md-2 ">-->
                   <!--      <label>Entered By</label>-->
                    <!--<input class="form-control " type="text" name="entered_by" <?php echo $disabled; ?> placeholder="Entered By" value="<?php echo $TempFormData['entered_by']; ?>">-->
                    <!--</div>-->
                    
                    <?php } ?>
                    <?php if($table_name != "haccap_training_record"){ ?>
                    <div class="col-12 col-md-3 ">
                         <label>Document Record Number</label>
                    <input class="form-control " type="text" name="document_record_number" <?php echo $disabled; ?> placeholder="Document Record Number" value="<?php echo $TempFormData['document_record_number']; ?>">
                    </div>
                    <?php } ?>
                    
                    <?php if($table_name == "haccap_training_record"){ ?>
                         <div class="col-lg-3">
                                                <label>Role</label>
                                               <input type="text" class="form-control role_select" name="role" placeholder="role" value="<?php echo $TempFormData['role']; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Employee Name</label>
                                                <input type="text" class="form-control role_select" name="emp" placeholder="Employee Name" value="<?php echo $TempFormData['emp']; ?>">
                                            </div>
                    <?php } ?>
                     <?php 
                        if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record"){
                                        ?>
                    <div class="col-12 col-md-2 ">
                         <label>Verified By</label>
                    <input class="form-control " type="text" name="verified_by" <?php echo $disabled; ?> placeholder="Verified By" value="<?php echo $TempFormData['verified_by']; ?>">
                    </div>
                    <?php } ?>
                    <?php 
                        if($table_name == "haccap_food_transfer_and_order_record"){
                                        ?>
                    <div class="col-12 col-md-2 ">
                         <label>Sign By</label>
                    <input class="form-control " type="text" name="sign_by" <?php echo $disabled; ?> placeholder="Sign By" value="<?php echo $TempFormData['sign_by']; ?>">
                    </div>
                    <?php } ?>
                   <?php 
                        if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" ){
                                        ?>
                    <div class="col-12 col-md-2">
                         <label>Date</label>
                         <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($TempFormData['start_date'])); ?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                      
                    </div>
                      <?php } ?>
                    
                   <?php 
                        if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record"){
                                        ?>
                            <!--<div class="col-12 col-md-2">-->
                            <!--     <label>End Date</label>-->
                            <!--<div class="input-group  ">-->
                      <!--                      <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="end_date" value="<?php echo $TempFormData['end_date']; ?>">-->
                      <!--                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>-->
                      <!--                  </div>-->
                            
                            <!--</div>-->
                  
                      <?php } ?>
                    
                  
                  </div>
                  <?php $weekdays = array('mon'=>'Mon','tue'=>'Tue','wed'=>'Wed','thu'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun'); ?>
                  <div class="create_menu_wrap">
                      <div class="row">
                          <div class="col-lg-12">
                              <?php if($table_name != "haccap_food_wastage_report" && $table_name != "haccap_kitchen_operational_closedown_checklist" && $table_name != "haccap_operational_incident_report" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_training_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record"){ ?> 
                              <ul class="tabs">
                                                      <li class="disable"></li>
                                                      <li class="active Mon_table" rel="Mon">Mon (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'])); ?> )</li>
                                                      <li class="Tue_table" rel="Tue">Tue (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 1 day')); ?> )</li>
                                                      <li class="Wed_table" rel="Wed">Wed (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 2 day')); ?> )</li>
                                                      <li class="Thu_table" rel="Thu">Thu (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 3 day')); ?> )</li>
                                                      <li class="Fri_table" rel="Fri">Fri (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 4 day')); ?> )</li>
                                                      <li class="Sat_table" rel="Sat">Sat (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 5 day')); ?> )</li>
                                                      <li class="Sun_table" rel="Sun">Sun (<?php echo date('d-m-Y',strtotime($TempFormData['start_date'].' + 6 day')); ?> )</li>
                                                      
                                                    </ul>
                                                    <?php } ?>
                                                    
                                                    <?php if($table_name != "haccap_operational_incident_report" && $table_name != "haccap_training_record" && $table_name != "haccap_mockrecall_record" && $table_name != "haccap_cold_form" && $table_name != "haccap_calibration_form" && $table_name != "haccap_retention_stock_form" && $table_name != "haccap_food_transfer_and_order_record"){ ?> 
                                                    <div class="tab_container">
                                                        <!-- #Mon --> 
                                                        <?php $dayInc = 0; foreach($weekdays as $title => $weekday_name) {  ?>
                                                      <h3 class="d_active tab_drawer_heading" rel="<?php echo $weekday_name; ?>"><?php echo $weekday_name.' ('.date('d-m-Y',strtotime($TempFormData['start_date'].' + '.$dayInc.' day')).')'; ?></h3>
                                                      <?php $dayInc++; ?>
                                                      <div id="<?php echo $weekday_name; ?>" class="tab_content">
                                                           <div class="ct-scroll">
                                                             <?php 
                                            if($table_name == "haccap_temp_form"){
                                                            ?>  
                                                       <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                                 <?php if(isset($rowData[$title]) && !empty($rowData[$title])) { $count = 1;?>
                                                                     <?php foreach($rowData[$title] as $key => $value) {  ?>
                                                                <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_<?php echo $count; ?>" data-count="<?php echo $count; ?>">
                                                                    <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                                                            <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">Equipment Name, Unit Identification</td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> 
                                                                                <?php if($disabled !=''){ ?>
                                                                                    <div class="quipname"><?php echo $value[$title."_equipname"]; ?></div>
                                                                                <?php } else{ ?>
                                                                                   <input class="form-control category equipField" <?php echo $disabled; ?> type="text" data-rel="equipField_<?php echo $count; ?>" data-count="<?php echo $count; ?>" onchange="setValue(this)" name="<?php echo $title; ?>_equipname[]" value="<?php echo $value[$title."_equipname"]; ?>" placeholder="Equipment Name, Unit Identification">
                                                                                <?php } ?>
                                                                            </td>
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
                                                                                <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_time[]"  value="<?php echo ($recreate == '' ? $value[$title."_AM_time"] : ''); ?>"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            </td>
                                                                               
                                                                                <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_temp[]"  value="<?php echo ($recreate == '' ? $value[$title."_AM_temp"] : ''); ?>" placeholder="Temp."></td>

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
                                                                                    <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_time[]"  value="<?php echo ($recreate == '' ? $value[$title."_PM_time"] : ''); ?>"  >
                                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                    </div>
                                                                                </td>
                                                                              
                                                                                <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_PM_temp[]" value="<?php echo ($recreate == '' ? $value[$title."_PM_temp"] : ''); ?>" placeholder="Temp."></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td>
                                                                           <td class="innerTableColumn">
                                                                                <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                    <tr> 
                                                                                            <td class="td_label_text">Entered By</td>
            
                                                                                    </tr>
                                                                                    <tr> 
                                                                                        <td> <input class="form-control " <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_entered_by[]" value="<?php echo ($recreate == '' ? $value[$title."_entered_by"] : ''); ?>" placeholder="Entered By"></td>
        
                                                                                    </tr> 
                                                                                </table>
                                                                           </td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           </tr> 
                                                                             </table>
                                                                             </td>
                                                                             <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; } ?>
                                                                       </tbody>
                                                                     <?php } else {  ?>
                                                                     <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                      <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">Equipment Name, Unit Identification</td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> <input class="form-control category equipField" data-rel="equipField_1" data-count="1" onchange="setValue(this)" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_equipname[]"  placeholder="Equipment Name, Unit Identification"></td>
                                                                           </tr> 
                                                                             </table>
                                                                  </td>
                                                                         
                                                                         
                                                                          <td class="menuinput-width">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn">
                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                                <td class="td_label_text">Time (AM)</td>
                                                                                <td class="td_label_text">Temp. (AM)</td>

                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            </td>
                                                                           
                                                                            <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_temp[]"  placeholder="Temp."></td>

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
                                                                                <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_time[]"  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            </td>
                                     
                                                                            <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_temp[]"  placeholder="Temp."></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td> 
                                                                           </tr> 
                                                                           <tr> 
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
                                                                             <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                    </div>
                                                                        </td>
                                                                         <?php } ?>
                                                                    </tr>
                                                                      </tbody>
                                                                       <?php } ?>
                                                              
                                                            </table>
                                                            <?php } ?>
                                                       
                                                            <?php 
                                            if($table_name == "haccap_dishwashing_form"){
                                                            ?>
                                                             <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                                 <?php if(isset($rowData[$title]) && !empty($rowData[$title])) { $count = 1;?>
                                                                     <?php foreach($rowData[$title] as $key => $value) {  ?>
                                                                <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_<?php echo $count; ?>" data-count="<?php echo $count; ?>">
                                                                    <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn td_label_text">Dishwasher Name</td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> 
                                                                            <?php if($disabled != ''){ ?>
                                                                               <div class="textfieldlarge row2"><?php echo $value[$title."_name"]; ?> </div>
                                                                            <?php } else{ ?>
                                                                            <textarea class="form-control category textfieldlarge row2 equipField" <?php echo $disabled; ?>  data-rel="equipField_<?php echo $count; ?>" data-count="<?php echo $count; ?>" onchange="setValue(this)" type="text" name="<?php echo $title; ?>_name[]" placeholder="Dishwasher Name"><?php echo $value[$title."_name"]; ?></textarea></td>
                                                                            <?php } ?>
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
                                                                                        <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_time[]" value="<?php echo ($recreate == '' ? $value[$title."_AM_time"] : ''); ?>">
                                                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                        </div>
                                                                                     </td>
                                                                                    <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_field1[]"  value="<?php echo ($recreate == '' ? $value[$title."_AM_field1"] : ''); ?>" placeholder="Wash Cycle"></td>
                                                                                    <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_field2[]"  value="<?php echo ($recreate == '' ? $value[$title."_AM_field2"] : ''); ?>" placeholder="Rinse Cycle"></td>
                                                                                    <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_AM_field3[]"  value="<?php echo ($recreate == '' ? $value[$title."_AM_field3"] : ''); ?>" placeholder="Signed"></td>

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
                                                                                        <input class="form-control" <?php echo $disabled; ?> id="time" type="text" name="<?php echo $title; ?>_PM_time[]" value="<?php echo ($recreate == '' ? $value[$title."_PM_time"] : ''); ?>">
                                                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                        </div>
                                                                                         </td>
                                                                                   <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_PM_field1[]"  value="<?php echo ($recreate == '' ? $value[$title."_PM_field1"] : ''); ?>" placeholder="Wash Cycle"></td>
                                                                                   <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_PM_field2[]" value="<?php echo ($recreate == '' ? $value[$title."_PM_field2"] : ''); ?>" placeholder="Rinse Cycle"></td>
                                                                                   <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_PM_field3[]" value="<?php echo ($recreate == '' ? $value[$title."_PM_field3"] : ''); ?>" placeholder="Signed"></td>
                                                                           </tr> 
                                                                             </table>
                                                                           </td> 
                                                                           </tr> 
                                                                           <tr> 
                                                                           </tr> 
                                                                             </table>
                                                                             </td>
                                                                             <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; } ?>
                                                                       </tbody>
                                                                     <?php } else {  ?>
                                                                     <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                      <tr class="menurow">
                                                                        
                                                                        <td class="menuinput-width headCol">
                                              <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                           <tr> 
                                                                           <td class="innerTableColumn td_label_text">Dishwasher Name</td>
                                                                           </tr> 
                                                                           <tr> 
                                                                           <td> <textarea class="form-control category textfieldlarge row2 equipField" <?php echo $disabled; ?> data-rel="equipField_1" data-count="1" onchange="setValue(this)" name="<?php echo $title; ?>_name[]"  placeholder="Dishwasher Name"></textarea></td>
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

                                                                           </tr> <tr> 
                                                                                <td> 
                                                                                <div class="input-group date datetimepicker3">
                                                                                <input class="form-control " type="text" id="time" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_time[]">
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                                </td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_field1[]"  placeholder="Wash Cycle"></td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_field2[]"  placeholder="Rinse Cycle"></td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_field3[]"  placeholder="Signed"></td>
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
                                                                                <input class="form-control " type="text" id="time" <?php echo $disabled; ?> name="<?php echo $title; ?>_AM_time[]">
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                                </td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_field1[]"  placeholder="Wash Cycle"></td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_field2[]"  placeholder="Rinse Cycle"></td>
                                                                                <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_PM_field3[]"  placeholder="Signed"></td>

                                                                           </tr> 
                                                                             </table>
                                                                           </td> 
                                                                           </tr> 
                                                                           <tr> 
                                                                           </tr> 
                                                                             </table>
                                                                             </td>
                                                                             <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                    </div>
                                                                        </td>
                                                                         <?php } ?>
                                                                    </tr>
                                                                      </tbody>
                                                                       <?php } ?>
                                                              
                                                            </table>
                                                            <?php } ?>
                                                            
                                                        
                                                            <?php 
                                                                if($table_name == "haccap_production_record_time"){ ?>   
                                                                   <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                                           <?php if(isset($rowData[$title]) && !empty($rowData[$title])) { $count = 1;?>
                                                                     <?php foreach($rowData[$title] as $key => $value) {  ?>
                                                                            <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_<?php echo $count; ?>" data-count="<?php echo $count; ?>">
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
                                                                                       <td> 
                                                                                       <input class="form-control equipField" data-rel="equipField_<?php echo $count; ?>" data-count="<?php echo $count; ?>" onchange="setValue(this)" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_name[]"  placeholder="Product Name" value="<?php echo $value[$title."_name"]; ?>"></td>
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
                                                                                                <input class="form-control" <?php echo $disabled; ?> id="time" type="text" name="<?php echo $title; ?>_cooking_time[]" value="<?php echo ($recreate == '' ? $value[$title."_cooking_time"] : ''); ?>"  > 
                                                                                                 <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </td>
                                                                                            <td> <div class="input-group date datetimepicker3">
                                                                                                    <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_cooking_field1[]" value="<?php echo ($recreate == '' ? $value[$title."_cooking_field1"] : ''); ?>"  >
                                                                                                      <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                                </td>
                                                                                        </tr> 
                                                                                       <tr> 
                                                                                           <td class="td_label_text" colspan="2">Temp Of Product At End Of Cooking or Prep</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                            <td colspan="2"> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_cooking_field2[]" value="<?php echo ($recreate == '' ? $value[$title."_cooking_field2"] : ''); ?>" placeholder="Temp."></td>
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
                                                                                           <td> <div class="input-group date datetimepicker3">
                                                                                               <input class="form-control" <?php echo $disabled; ?> id="time" type="text" name="<?php echo $title; ?>_chilling_time[]" value="<?php echo ($recreate == '' ? $value[$title."_chilling_time"] : ''); ?>"  > 
                                                                                               <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                               </div>
                                                                                            </td>
                                                                                            <td colspan="2"> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field2[]" value="<?php echo ($recreate == '' ? $value[$title."_chilling_field2"] : ''); ?>" placeholder="Temp."></td>
            
                                                                                       </tr> 
                                                                                        <tr>
                                                                                            <td class="td_label_text">Time Chilling Process started of 5<sup>th</sup> hr</td>
                                                                                            <td class="td_label_text">Temp Of Product At 5<sup>th</sup> hr Of Chilling</td>
                                                                                            <td class="td_label_text">Temp Of Product At End Of 6<sup>th</sup> hr</td>
                                                                                        </tr>
                                                                                       <tr> 
                                                                                            <td> <div class="input-group date datetimepicker3">
                                                                                                <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field3[]" value="<?php echo ($recreate == '' ? $value[$title."_chilling_field3"] : ''); ?>"  >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field4[]" value="<?php echo ($recreate == '' ? $value[$title."_chilling_field4"] : ''); ?>" placeholder="Temp."></td>
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field5[]" value="<?php echo ($recreate == '' ? $value[$title."_chilling_field5"] : ''); ?>" placeholder="Temp."></td>
            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td> 
                                                                                       <td class="innerTableColumn" style="width:200px;"><br>
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Comments (Where did product go- Sandwich Display – Hot Food – Salad Display, Cool room etc...)</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_comments[]" value="<?php echo ($recreate == '' ? $value[$title."_comments"] : ''); ?>" placeholder="Comments"></td>
                                                                                          
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                                    <td class="td_label_text">Signature</td>
                    
                                                                                               </tr>
                                                                                                <tr> 
                                                                                                    <td> <input class="form-control " <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_entered_by[]" value="<?php echo ($recreate == '' ? $value[$title."_entered_by"] : ''); ?>" placeholder="Entered By"></td>
                    
                                                                                                </tr> 
                                                                                         </table>
                                                                                       </td> 
                                                                                       
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       </tr> 
                                                                                         </table>
                                                                                         </td>
                                                                                       <?php if($disabled == '') { ?>
                                                                                                  <td class="menubtns-width">
                                                                                                    <div class="ct-btns">
                                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                             <?php if($count > 1 ) { ?>
                                                                                             <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                            </td>
                                                                                       <?php } ?>
                                                                                    </tr>
                                                                     <?php $count ++; ?>
                                                                            </tbody>
                                                                             <?php } } else{ ?>
                                                                              <tbody class="contentBody" data-rel="<?php echo $title; ?>_contentBody_1" data-count="1">
                                                                                <tr class="menurow">
                                                                                    
                                                                                    <td class="menuinput-width">
                                                                                    <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       <td class="innerTableColumn"><br>
                                                                                           <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                           <tr> 
                                                                                                <td class="td_label_text">Product Name &/ or internal Batch Code Allocated</td>
            
                                                                                           </tr>
                                                                                           <tr> 
                                                                                                <td> <input class="form-control equipField" data-rel="equipField_1" data-count="1" onchange="setValue(this)" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_name[]"  placeholder="Product Name"></td>
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
                                                                                                <input <?php echo $disabled; ?> class="form-control " type="text" id="time" name="<?php echo $title; ?>_cooking_time[]"  >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td> <div class="input-group date datetimepicker3">
                                                                                                <input <?php echo $disabled; ?> class="form-control" type="text" name="<?php echo $title; ?>_cooking_field1[]"   >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                                </td>
                                                                                            
                                                                                       </tr>
                                                                                       <tr>
                                                                                           <td class="td_label_text" colspan="2">Temp Of Product At End Of Cooking or Prep</td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                            <td colspan="2"> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_cooking_field2[]"  placeholder="Temp."></td>
                                                                                            
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
                                                                                               <input class="form-control " <?php echo $disabled; ?> type="text" id="time" name="<?php echo $title; ?>_chilling_time[]"   >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                                </div>
                                                                                           </td>
                                                                                            <td colspan="2"> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field2[]"  placeholder="Temp."></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="td_label_text">Time Chilling Process started of 5<sup>th</sup> hr</td>
                                                                                            <td class="td_label_text">Temp Of Product At 5<sup>th</sup> hr Of Chilling</td>
                                                                                            <td class="td_label_text">Temp Of Product At End Of 6<sup>th</sup> hr</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td> 
                                                                                            <div class="input-group date datetimepicker3">
                                                                                                <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field3[]"    >
                                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                            </div>
                                                                                            </td>
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field4[]"  placeholder="Temp."></td>
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_chilling_field5[]"  placeholder="Temp."></td>
            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td> 
                                                                                       <td class="innerTableColumn" style="width:200px;"><br>
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                        <tr> 
                                                                                            <td class="td_label_text">Comments (Where did product go- Sandwich Display – Hot Food – Salad Display, Cool room etc...)</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_comments[]"  placeholder="Comments"></td>
                                                                                          
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Signature</td>
            
                                                                                       </tr>
                                                                                                <tr> 
                                                                                                    <td> <input class="form-control " <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_entered_by[]" placeholder="Entered By"></td>
                    
                                                                                                </tr>
                                                                                         </table>
                                                                                       </td> 
                                                                                      
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       </tr> 
                                                                                         </table>
                                                                                         </td>
                                                                                         <?php if($disabled == '') { ?>
                                                                                      <td class="menubtns-width">
                                                                                        <div class="ct-btns">
                                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                                            
                                                                                            </div>
                                                                                    </td>
                                                                                    <?php } ?>
                                                                                   
                                                                                </tr>
                                                                            </tbody>
                                                                             <?php } ?>
                                                            </table>
                                                            <?php } ?>
                                                            
                                                            <?php 
                                                                if($table_name == "haccap_calibration_form"){ ?>   
                                                                   <table class="row-border table-condensed table-bordered menuTable parent_table" id="monWeek" cellspacing="0" width="100%">
                                                                            <?php if(isset($rowData[$title]) && !empty($rowData[$title])) { $count = 1;?>
                                                                     <?php foreach($rowData[$title] as $key => $value) {  ?>
                                                                            <tbody>
                                                                                <tr class="menurow">
                                                                                    
                                                                                    <td class="menuinput-width">
                                                          <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       <td class="innerTableColumn td_label_text">Item (brand or ID)</td>
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_name[]"  placeholder="Item (brand or ID)" value="<?php echo $value[$title."_name"]; ?>"></td>
                                                                                       </tr> 
                                                                                         </table>
                                                                              </td>
                                                                                     
                                                                                     
                                                                                      <td class="menuinput-width">
                                                                                        <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       
                                                                                            
                                                                                            
                                                                                         <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                      <tr> 
                                                                                            <td class="td_label_text">Hot +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_hot[]" value="<?php echo ($recreate == '' ? $value[$title."_hot"] : ''); ?>" placeholder="Hot +/-"></td>
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Cold +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_cold[]" value="<?php echo ($recreate == '' ? $value[$title."_cold"] : ''); ?>" placeholder="Cold +/-"></td>
                                                                                            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Difference +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_difference[]" value="<?php echo ($recreate == '' ? $value[$title."_difference"] : ''); ?>" placeholder="Difference +/-"></td>
                                                                                           
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                       
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                        <tr> 
                                                                                            <td class="td_label_text">Adjustment required</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_adjustment_required[]" value="<?php echo ($recreate == '' ? $value[$title."_adjustment_required"] : ''); ?>" placeholder="Adjustment required"></td>
                                                                                           
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                       
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Final Result</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                            <td> <input class="form-control" <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_final_result[]" value="<?php echo ($recreate == '' ? $value[$title."_final_result"] : ''); ?>" placeholder="Final Result"></td>
                                                                                           
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                       <td class="innerTableColumn">
                                                                                            <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                                <tr> 
                                                                                                    <td class="td_label_text">Entered By</td>
                    
                                                                                               </tr>
                                                                                                <tr> 
                                                                                                    <td> <input class="form-control " <?php echo $disabled; ?> type="text" name="<?php echo $title; ?>_entered_by[]" value="<?php echo ($recreate == '' ? $value[$title."_entered_by"] : ''); ?>" placeholder="Entered By"></td>
                    
                                                                                                </tr> 
                                                                                            </table>
                                                                                       </td>
                                                                                        
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       </tr> 
                                                                                         </table>
                                                                                         </td>
                                                                                       <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; ?>
                                                                            </tbody>
                                                                            <?php } } else{  ?>
                                                                            <tbody>
                                                                                <tr class="menurow">
                                                                                    
                                                                                    <td class="menuinput-width">
                                                          <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       <td class="innerTableColumn td_label_text">Item (brand or ID)</td>
                                                                                       </tr> 
                                                                                       <tr> 
                                                                                       <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_name[]"  placeholder="Item (brand or ID)"></td>
                                                                                       </tr> 
                                                                                         </table>
                                                                              </td>
                                                                                     
                                                                                     
                                                                                      <td class="menuinput-width">
                                                                                        <table class="row-border table-condensed table-bordered menuTable inner_table" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                       
                                                                                            
                                                                                            
                                                                                         <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Hot +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_hot[]"  placeholder="Hot +/-"></td>
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Cold +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_cold[]"  placeholder="Cold +/-"></td>
                                                                                            
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Difference +/-</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                           <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_difference[]"  placeholder="Difference +/-"></td>
                                                                                           
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                       
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Adjustment required</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                            <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_adjustment_required[]"  placeholder="Adjustment required"></td>
                                                                                           
                                                                                       </tr> 
                                                                                         </table>
                                                                                       </td>
                                                                                       
                                                                                        <td class="innerTableColumn">
                                                                                       <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">  
                                                                                       <tr> 
                                                                                            <td class="td_label_text">Final Result</td>
            
                                                                                       </tr>
                                                                                       <tr> 
                                                                                            <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_final_result[]"  placeholder="Final Result"></td>
                                                                                           
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
                                                                            <?php } ?>
                                                            </table>
                                                            <?php } ?>
                                                            
                                                             
                                                            
                                                        </div>
                                                      </div>
                                                      <!-- #Tue -->
                                                    
                                                     <?php } ?>
                                                     
                                                     <?php 
                                                if($table_name == "haccap_food_wastage_report"){ ?>   
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn headCol" style="text-align:center;">Product Name</td>
                                                      
                                                               <?php 
                                                               $i=0;
                                                               foreach($weekdays as $title => $weekday_name) { $count = 1;  ?> 
                                                               <td class="innerTableColumn smalldayTitle" style="text-transform: uppercase; text-align:center;"><?php echo $title."<br><span>(".date('d-m-Y',strtotime($TempFormData['start_date'].' + '.$i.' day')).")</span>" ?></td>
                                                               <?php $i=$i+1; } ?>
                                                               <td class="innerTableColumn" style="text-align:center;">Total Number of Units</td>
                                                               <td class="innerTableColumn" style="text-align:center;">Price $ Per Unit</td>
                                                               <td class="innerTableColumn" style="text-align:center;">TOTAL WTD</td>
                                                               <td class="innerTableColumn" style="text-align:center;">Entered By</td>
                                                               <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            
                                                                
                                                                    <?php 
                                                                    $totalsum = '';
                                                                    foreach($TempFormData['product_wastage_data'] as $product_name => $weekday_product_data) {  ?>     
                                                                <tbody>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width headCol">
                                                                        
                                                                        <?php 
                                                                        if($disabled != ''){ echo $product_name; }else{ ?>
                                                                        <textarea class="form-control textfieldlarge row1" <?php echo $disabled; ?> name="product_name[]"  placeholder="Product Name"><?php echo $product_name;  ?></textarea>
                                                                         <?php } ?>   
                                                                        </td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                            <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="<?php echo $title; ?>_field[]"  value="<?php echo $weekday_product_data[$title.'_field']; ?>"></td>
                                                                     
                                                                       <?php } ?>
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="total_no_units[]" disabled value="<?php echo $weekday_product_data['total_no_units']; ?>"></td>
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="price_per_unit[]"  value="<?php echo "$".number_format($weekday_product_data['price_per_unit'],2); ?>"></td>
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="total_wtd[]" disabled value="<?php echo "$".number_format($weekday_product_data['total_wtd'],2); ?>"></td>
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="entered_by[]"  value="<?php echo $weekday_product_data['entered_by']; ?>"></td>
                                                                      
                                                                       <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; ?>
                                                                </tbody>
                                                                 <?php 
                                                                 $totalsum = $totalsum + $weekday_product_data['total_wtd'];
                                                                 } ?>
                                                                 
                                                                 <?php
                                                                //  echo "<pre>";print_r($TempFormData['product_wastage_data']);exit;
                                                                 ?>
                                                                 <tbody>
                                                                <tr><td colspan="10">TOTAL SALE PRICE WASTAGE AMOUNT</td><td><input class="form-control" type="text" <?php echo $disabled; ?> value="<?php echo "$".number_format($totalsum,2); ?>" style="background-color: #f00;color: #fff;"></td><td></td></tr>
                                                                
                                                                
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
                                                               <?php $i=0; foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;text-align: center;width:100px;"><?php echo $title."<br>(".date('d-m-Y',strtotime($TempFormData['start_date'].' + '.$i.' day')).")" ?></td>
                                                               <?php  $i=$i+1; } ?>
                                                               
                                                           </thead>
                                                            <tbody>
                                                                
                                                            
                                                                
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">1</td>
                                                                    <td class="menuinput-width">Ensure all the Fridge Temperature At 5˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                    
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_fridge_temp" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_fridge_temp'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                 <tr class="menurow">
                                                                    <td class="menuinput-width">2</td>
                                                                    <td class="menuinput-width">Dishwasher Empty / Cleaned Down & Switched Off</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_dishwasher" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_dishwasher'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">3</td>
                                                                    <td class="menuinput-width">Combi Oven Off & Cleaned with Door Left Open</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_combi_oven" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_combi_oven'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">4</td>
                                                                    <td class="menuinput-width">Ensure Cook Top Gas all Switched to Off Position</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cooktop_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_cooktop_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">5</td>
                                                                    <td class="menuinput-width">Ensure Cook Top Ovens Washed & Gas all Switched to Off Position</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cooktop_washed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_cooktop_washed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">6</td>
                                                                    <td class="menuinput-width">Both Hot Plates ( Grill Top Off )</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_hotplates" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_hotplates'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">7</td>
                                                                    <td class="menuinput-width">Ensue Deep Fryers Switched Off and Oil Filtered If Not Changed</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_deep_fryers_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_deep_fryers_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">8</td>
                                                                    <td class="menuinput-width">Dough Mixer Ensure Switch Off At Power Point</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_dough_mixer_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_dough_mixer_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">9</td>
                                                                    <td class="menuinput-width">Ensure Cool room Door & Light Closed & Temperature At 5˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_cool_room_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_cool_room_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">10</td>
                                                                    <td class="menuinput-width">Ensure Chest Freezer Doors Closed , Temperature At -18˚C or Below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_chest_freeser_closed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_chest_freeser_closed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">11</td>
                                                                    <td class="menuinput-width">Lights Switched Off And door Left Jarred For Air Flow. Ensure Change rooms Storage Areas Clean & Lights Off
</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_lights_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_lights_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">12</td>
                                                                    <td class="menuinput-width">Ensure Back Exit Door Closed & Locked</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_exit_door_closed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_exit_door_closed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">13</td>
                                                                    <td class="menuinput-width">Ensure Hot Boxes Washed / Switched Off & Doors Left Open</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_hot_boxes_washed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_hot_boxes_washed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">14</td>
                                                                    <td class="menuinput-width">Mixer Turned Off At P/P & Cleaned</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_mixer_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_mixer_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">15</td>
                                                                    <td class="menuinput-width">Slicer Turned Off At P/P & Cleaned</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_slicer_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_slicer_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">16</td>
                                                                    <td class="menuinput-width">Bench Tops Cleaned & Clear</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_benchtop_cleaned" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_benchtop_cleaned'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                    
                                                               
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">17</td>
                                                                    <td class="menuinput-width">Ensure Main Freezer Door & Light Closed & Temperature At -18˚C or below</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_main_freezer_closed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_main_freezer_closed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">18</td>
                                                                    <td class="menuinput-width">All Wall Power Points Switched Off</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_wall_power_point_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_wall_power_point_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">19</td>
                                                                    <td class="menuinput-width">Washed and Relined Rubbish Bins</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_rubbish_bins_washed" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_rubbish_bins_washed'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">20</td>
                                                                    <td class="menuinput-width">Ensure Lights Switched Off In Kitchen</td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>
                                                                            <td class="menuinput-width"><input type="checkbox" value="1" name="<?php echo $title; ?>_kitchen_light_off" class="<?php echo $disabled; ?>" <?php if($rowData[$title][$title.'_kitchen_light_off'] == '1'){ echo "checked"; } ?> ></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                            </tbody>
                                            </table>
                                            <?php } ?>
                                            <!-- ~~~~~~~~~~~~~~~~~~~~~-->
                                           
                                                       
                                                    </div>
                                                    <?php }else{ ?>
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
                                                     <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                     </thead>
                                                  
                                                      <?php if(!empty($rowData)){ $count = 1; foreach($rowData as $row){  ?>
                                                      <tbody>
                                                            <tr class="menurow">
                                                            <td class="menuinput-width">
                                                                <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="caliberdate[]" value="<?php echo $row['caliberdate']; ?>">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                                             
                                                              </td>
                                                            <td class="menuinput-width">
                                                            <input class="form-control" type="text" name="name[]" value="<?php echo $row['name']; ?>" <?php echo $disabled; ?> placeholder="Item (brand or ID)">
                                                            </td>
                                                            <td class="menuinput-width">
                                                             <input class="form-control" type="text" name="hot[]" value="<?php echo $row['hot']; ?>" <?php echo $disabled; ?> placeholder="Hot +/-">   
                                                            </td>
                                                            <td class="menuinput-width">
                                                             <input class="form-control" type="text" name="cold[]" value="<?php echo $row['cold']; ?>" <?php echo $disabled; ?> placeholder="Cold +/-">   
                                                            </td>
                                                            <td class="innerTableColumn">
                                                            <input class="form-control" type="text" name="difference[]" value="<?php echo $row['difference']; ?>" <?php echo $disabled; ?>  placeholder="Difference +/-">
                                                            </td>
                                                            <td class="innerTableColumn">
                                                            <input class="form-control" type="text" name="adjustment_required[]" value="<?php echo $row['adjustment_required']; ?>" <?php echo $disabled; ?> placeholder="Adjustment required">
                                                             </td>
                                                        
                                                            <td class="innerTableColumn">
                                                            <input class="form-control" type="text" name="final_result[]" value="<?php echo $row['final_result']; ?>" <?php echo $disabled; ?> placeholder="Final Result">
                                                            </td>
                                                                                                                                       
                                                            <td class="innerTableColumn">
                                                            <input class="form-control " type="text" name="entered_by[]" value="<?php echo $row['entered_by']; ?>" <?php echo $disabled; ?> placeholder="Entered By">
                                                            </td>
                                                            <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                           
                                                            </tr>  
                                                            </tbody>
                                                        <?php  $count ++; } } else{ ?>
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
                                                            <?php if($disabled == '') { ?>
                                                              <td class="menubtns-width">
                                                                <div class="ct-btns" style="margin: 6px 0;">
                                                                 <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                
                                                                </div>
                                                                </td>
                                                            <?php } ?>
                                                            </tr> 
                                                        </tbody>
                                                        <?php } ?>
                                                   
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
                                                               <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            <tbody>
                                                                
                                                            <?php if(!empty($rowData)){ $count = 1; foreach($rowData as $row){ ?>
                                                              
                                                                <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol-small">
                                                                        <?php if($disabled) {  ?>
                                                                        <?php echo $row['product_name']; ?>
                                                                        <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge" name="product_name[]" <?php echo $disabled; ?> placeholder="Product Name"><?php echo $row['product_name']; ?></textarea>

                                                                         <?php } ?>
                                                                    </td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <label class="smallLabel">AM Time</label>
                                                                           <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" id="time" type="text" value="<?php echo $row[$title.'_AM_time']; ?>" name="<?php echo $title; ?>_AM_time[]"  <?php echo $disabled; ?>  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div>
                                                                            <label class="smallLabel">PM Time</label>
                                                                            <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" type="text" value="<?php echo $row[$title.'_PM_time']; ?>" name="<?php echo $title; ?>_PM_time[]"  <?php echo $disabled; ?>  >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div>
                                                                         
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td> 
                                                                        <?php if($disabled) {  ?>
                                                                            <?php echo $row['entered_by']; ?>
                                                                        <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge" name="entered_by[]" <?php echo $disabled; ?> placeholder="Entered By"><?php echo $row['entered_by']; ?> </textarea>
                                                                        <?php } ?>    
                                                                        </td>
                                                                        <td> 
                                                                        <?php if($disabled) {  ?>
                                                                            <?php echo $row['signature']; ?>
                                                                        <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge" name="signature[]" <?php echo $disabled; ?> placeholder="signature By"><?php echo $row['signature']; ?></textarea> 
                                                                        <?php } ?>    
                                                                        </td>
                                                                      <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; ?>
                                                                <?php } }else{ ?>
                                                                    <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol-small">
                                                                         <textarea class="form-control textfieldlarge" name="product_name[]" <?php echo $disabled; ?> placeholder="Product Name"></textarea></td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" id="time" type="text" name="<?php echo $title; ?>_AM_time[]" <?php echo $disabled; ?> >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                                </div>
                                                                            
                                                                            <div class="input-group date datetimepicker3"style="margin-top: 10px;">
                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_PM_time[]" <?php echo $disabled; ?> >
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div>
                                                                        
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td> <textarea class="form-control textfieldlarge" name="entered_by[]"  placeholder="Entered By" <?php echo $disabled; ?>></textarea></td>
                                                                        <td> <textarea class="form-control textfieldlarge" name="signature[]"  placeholder="signature By" <?php echo $disabled; ?>></textarea></td>
                                                                        <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns" style="margin: 6px 0;">
                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                            
                                                                            </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                   
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                            </table>
                                            <?php }    ?>
                                            <?php if($table_name == "haccap_retention_stock_form"){  ?>  
                                                             
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn headCol-small">Equipment Name, Unit Identification</td>
                                                               <?php foreach($weekdays as $title => $weekday_name) {  ?> 
                                                               <td class="innerTableColumn" style="text-transform: uppercase;"><?php echo $title; ?></td>
                                                               <?php } ?>
                                                              
                                                               <td class="innerTableColumn">Name of checking person</td>
                                                               <td class="innerTableColumn">Signature</td>
                                                               <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            <tbody>
                                                                
                                                            <?php if(!empty($rowData)){ $count = 1; foreach($rowData as $row){ ?>
                                                              
                                                                <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width headCol-small">
                                                                        <?php if($disabled) {  ?>
                                                                        <?php echo $row['product_name']; ?>
                                                                        <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge row3" name="product_name[]" <?php echo $disabled; ?> placeholder="Product Name"><?php echo $row['product_name']; ?></textarea>

                                                                         <?php } ?>
                                                                    </td>
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <label class="smallLabel">AM Time</label>
                                                                         <div class="input-group date datetimepicker3">
                                                                             <input class="form-control" id="time" type="text" value="<?php echo $row[$title.'_AM_time']; ?>" name="<?php echo $title; ?>_AM_time[]"  <?php echo $disabled; ?>   >
                                                                         <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                          </div>   
                                                                        <label class="smallLabel">PM Time</label>
                                                                        <div class="input-group date datetimepicker3">
                                                                            <input class="form-control" type="text" value="<?php echo $row[$title.'_PM_time']; ?>" name="<?php echo $title; ?>_PM_time[]"  <?php echo $disabled; ?>   >
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                          </div> 
                                                                          <label class="smallLabel">Temp.</label>
                                                                        <input class="form-control" type="text" value="<?php echo $row[$title.'_temp']; ?>" name="<?php echo $title; ?>_temp[]"  <?php echo $disabled; ?> placeholder="Temp.">
                                                                        
                                                                        
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td>
                                                                            <?php if($disabled) {  ?>
                                                                                <?php echo $row['entered_by']; ?>
                                                                            <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge row3" name="entered_by[]" <?php echo $disabled; ?> placeholder="Entered By"><?php echo $row['entered_by']; ?></textarea>
                                                                                <?php } ?>
                                                                            </td>
                                                                        <td> 
                                                                        
                                                                            <?php if($disabled) {  ?>
                                                                                <?php echo $row['signature']; ?>
                                                                            <?php  } else { ?>
                                                                            <textarea class="form-control textfieldlarge row3" name="signature[]" <?php echo $disabled; ?> placeholder="signature By"><?php echo $row['signature']; ?></textarea>
                                                                            <?php } ?>
                                                                        </td>
                                                                      <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count ++; ?>
                                                                <?php } }else{ ?>
                                                                    <tr class="menurow">
                                                                    
                                                                    <td class="menuinput-width">
                                                                        <input class="form-control" type="text" name="product_name[]"  <?php echo $disabled; ?> placeholder="Product Name"></td>
                                                                    
                                                                    <?php foreach($weekdays as $title => $weekday_name) {  ?>    
                                                                        <td>
                                                                            <div class="input-group date datetimepicker3">
                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_AM_time[]" <?php echo $disabled; ?>>
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div>  
                                                                            <div class="input-group date datetimepicker3" style="margin-top: 10px;">
                                                                                <input class="form-control" type="text" name="<?php echo $title; ?>_PM_time[]" <?php echo $disabled; ?>>
                                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                            </div> 
                                                                        
                                                                        
                                                                        
                                                                        </td>
                                                                     
                                                                       <?php } ?>
                                                                       
                                                                        <td> <input class="form-control" type="text" name="entered_by[]" <?php echo $disabled; ?> placeholder="Entered By"></td>
                                                                        <td> <input  class="form-control" type="text" name="signature[]" <?php echo $disabled; ?> placeholder="signature By"></td>
                                                                        <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns" style="margin: 6px 0;">
                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                            
                                                                            </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                   
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                            </table>
                                            <?php }    ?>
                                            <?php if($table_name == "haccap_food_transfer_and_order_record" ){  ?>  
                                                             
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                                <td class="innerTableColumn">Date</td>
                                                    <td class="innerTableColumn">Item</td>
                                                                <td class="innerTableColumn">Price</td>
                                                                <td class="innerTableColumn">Temperature at Loading</td>
                                                                <td class="innerTableColumn">Temperature at unloading</td>
                                                                <td class="innerTableColumn">Delivery Location</td>  
                                                                <td class="innerTableColumn">Received By</td>
                                                                <td class="innerTableColumn">Deliver By</td>
                                                               <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            
                                                                
                                                            <?php if(!empty($rowData)){ $count = 1; foreach($rowData as $row){ ?>
                                                              <tbody>
                                                                <tr class="menurow">
                                                                    
                                                                    
                                                                    <td width="130px" >
                                                                        <div class="input-group  ">
                                                                            <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="item_date[]" value="<?php echo $row['item_date']; ?>">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                        </div>
                                                                    </td>
                                                        <td><input class="form-control" type="text" name="item_name[]" value="<?php echo $row['item_name']; ?>" style="width: 200px;" <?php echo $disabled; ?> placeholder="Item Name"></td>
                                                        <td><input class="form-control" type="text" name="item_price[]" value="<?php echo $row['item_price']; ?>" style="width: 75px;" <?php echo $disabled; ?> placeholder="Price"></td>
                                                        <td><input class="form-control" type="text" name="item_temp_loading[]" value="<?php echo $row['item_temp_loading']; ?>" style="width: 130px;" <?php echo $disabled; ?> placeholder="Temperature at Loading"></td>
                                                        <td><input class="form-control" type="text" name="item_temp_unloading[]" value="<?php echo $row['item_temp_unloading']; ?>" style="width: 130px;" <?php echo $disabled; ?> placeholder="Temperature at unloading"></td>
                                                        <td><input class="form-control" type="text" name="item_delivery_location[]" value="<?php echo $row['item_delivery_location']; ?>" style="width: 145px;" <?php echo $disabled; ?> placeholder="Delivery Location"></td>
                                                        <td><input class="form-control" type="text" name="item_received_by[]" value="<?php echo $row['item_received_by']; ?>" <?php echo $disabled; ?> placeholder="Received By"></td>
                                                        <td><input class="form-control" type="text" name="item_deliver_by[]" value="<?php echo $row['item_deliver_by']; ?>" style="width: 145px;" <?php echo $disabled; ?> placeholder="Deliver By"></td>
                                                                    
                                                                      <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                    </tbody>
                                                                     <?php $count ++; ?>
                                                                <?php } }else{ ?>
                                                                <tbody>
                                                                    <tr class="menurow">
                                                                    
                                                                    <td width="130px" >
                                                                        <div class="input-group  ">
                                                                            <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="item_date[]">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                        </div>
                                                                    </td>
                                                        <td><input class="form-control" type="text" name="item_name[]" style="width: 200px;" <?php echo $disabled; ?> placeholder="Item Name"></td>
                                                        <td><input class="form-control" type="text" name="item_price[]" style="width: 75px;" <?php echo $disabled; ?> placeholder="Price"></td>
                                                        <td><input class="form-control" type="text" name="item_temp_loading[]" style="width: 130px;" <?php echo $disabled; ?> placeholder="Temperature at Loading"></td>
                                                        <td><input class="form-control" type="text" name="item_temp_unloading[]" style="width: 130px;" <?php echo $disabled; ?> placeholder="Temperature at unloading"></td>
                                                        <td><input class="form-control" type="text" name="item_delivery_location[]" style="width: 145px;" <?php echo $disabled; ?> placeholder="Delivery Location"></td>
                                                        <td><input class="form-control" type="text" name="item_received_by[]" <?php echo $disabled; ?> placeholder="Received By"></td>
                                                        <td><input class="form-control" type="text" name="item_deliver_by[]" style="width: 145px;" <?php echo $disabled; ?> placeholder="Deliver By"></td>
                                                                        <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns" style="margin: 6px 0;">
                                                                             <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                            
                                                                            </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                   
                                                                </tr></tbody>
                                                            <?php } ?>
                                                            
                                            </table>
                                            <?php }    ?> 
                                            
                                                   <!--haccap_operational_incident_report form starts-->
                                              <?php if($table_name == 'haccap_operational_incident_report'){ ?>
                                              <div class="haccap-form-wrap">
                                                      <div class="col-12 col-md-6 ">
                                          <div class="field-row">
                                             <label>Corrective Action (Operational)</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['correctiveaction']; ?>" <?php echo $disabled; ?> name="correctiveaction">
                                          </div>
                                         
                                    </div>
                                      
                                      <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Date</label>
                                            <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="correctiveaction_date" value="<?php echo $TempFormData['correctiveaction_date']; ?>">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                          
                                      </div>
                                    </div>
                                     
                                     <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Time</label>
                                             <div class="input-group date datetimepicker3">
                                                                    <input class="form-control " type="text" value="<?php echo $TempFormData['correctiveaction_time']; ?>" <?php echo $disabled; ?> name="correctiveaction_time">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                                                </div> 
                                          
                                      </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Reason for Non-conformance</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['reason_for_non_conformance']; ?>" <?php echo $disabled; ?> name="reason_for_non_conformance">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Name of Company/Organisation</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['organisation']; ?>" <?php echo $disabled; ?> name="organisation">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                          <div class="field-row">
                                             <label>Name of Contact Person</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['name_of_contact_person']; ?>" <?php echo $disabled; ?> name="name_of_contact_person">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                          <div class="field-row">
                                             <label>Contact Number</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['contact_of_contact_person']; ?>" <?php echo $disabled; ?> name="contact_of_contact_person">
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Report</label>
                                            <textarea class="form-control " rows="4" <?php echo $disabled; ?> name="report"><?php echo $TempFormData['report']; ?></textarea>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                          <div class="field-row">
                                             <label>Reply To</label>
                                            <input class="form-control " type="text" name="reply_to"  value="<?php echo $TempFormData['reply_to']; ?>" <?php echo $disabled; ?>>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-3 ">
                                          <div class="field-row">
                                             <label>Date</label>
                                             <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="reply_to_date" value="<?php echo $TempFormData['reply_to_date']; ?>">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                         
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-3 ">
                                          <div class="field-row">
                                             <label>Incident Date</label>
                                             <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="incident_date" value="<?php echo $TempFormData['incident_date']; ?>">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                            
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Description of Non-conformance:</label>
                                            <label>Internal C/O </label><input class="<?php echo $disabled; ?>" value="internal" <?php if($TempFormData['description_of_non_conformance'] == 'internal'){ echo "checked"; } ?> type="radio" name="description_of_non_conformance">
                                            <label>OH&S </label><input class="<?php echo $disabled; ?>" value="ohs" type="radio" <?php if($TempFormData['description_of_non_conformance'] == 'ohs'){ echo "checked"; } ?> name="description_of_non_conformance">
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Detailed Description of Event</label>
                                            <textarea class="form-control " rows="4" <?php echo $disabled; ?> name="detailed_description_of_event"><?php echo $TempFormData['detailed_description_of_event']; ?></textarea>
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Classification:</label>
                                            <label>Urgent</label><input class="<?php echo $disabled; ?>" value="urgent" type="radio" name="classification" <?php if($TempFormData['classification'] == 'urgent'){ echo "checked"; } ?> >
                                            <label>Non-urgent</label><input class="<?php echo $disabled; ?>" value="nonurgent" type="radio" name="classification" <?php if($TempFormData['classification'] == 'nonurgent'){ echo "checked"; } ?> >
                                            <label>Ongoing</label><input class="<?php echo $disabled; ?>" value="ongoing" type="radio" name="classification" <?php if($TempFormData['classification'] == 'ongoing'){ echo "checked"; } ?> >
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Reason of Occurance & Outcome</label>
                                            <textarea class="form-control " rows="4" <?php echo $disabled; ?> name="reason_of_occurance"><?php echo $TempFormData['reason_of_occurance']; ?></textarea>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-6">
                                          <div class="field-row">
                                             <label>Date Corrective Action Taken</label>
                                             <div class="input-group  ">
                                                                    <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="date_corrective_action_taken" value="<?php echo $TempFormData['date_corrective_action_taken']; ?>">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                            
                                          </div>
                                         
                                    </div>
                                      <div class="col-12 col-md-6 ">
                                          <div class="field-row">
                                             <label>Verified By</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['verified_by']; ?>" <?php echo $disabled; ?> name="verified_by">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Results (office use only)</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['results']; ?>" <?php echo $disabled; ?> name="results">
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                             <label>Satisfactory</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['satisfactory']; ?>" <?php echo $disabled; ?> name="satisfactory">
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                             <label>Un-satisfactory</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['unsatisfactory']; ?>" <?php echo $disabled; ?> name="unsatisfactory">
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                             <label>Followup</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['followup']; ?>" <?php echo $disabled; ?> name="followup">
                                          </div>
                                         
                                    </div>
                                    
                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                             <label>Signed By</label>
                                            <input class="form-control " type="text" value="<?php echo $TempFormData['signed_by']; ?>" <?php echo $disabled; ?> name="signed_by">
                                          </div>
                                         
                                    </div>
                                            </div>
                                            <?php } ?>

                                             <?php 
                        if($table_name == "haccap_mockrecall_record"){ ?>   
                                              
                                              <div class="haccap-form-wrap">
                                                 
                                      
                                      <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Date Initiated</label>
                                            <div class="input-group  ">
                                                <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="date_initiated" value="<?php echo $TempFormData['date_initiated']; ?>">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        
                                      </div>
                                    </div>
                                     
                                     <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Time Initiated</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="time_initiated" value="<?php echo $TempFormData['time_initiated']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div> 
                                          
                                      </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Date Completed</label>
                                            <div class="input-group  ">
                                            <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="date_completed" value="<?php echo $TempFormData['date_completed']; ?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                         
                                      </div>
                                    </div>
                                     
                                     <div class="col-12 col-md-3">
                                          <div class="field-row">
                                            <label>Time Completed</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="time_completed" value="<?php echo $TempFormData['time_completed']; ?>" <?php echo $disabled; ?> >
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Description of Product or Raw Material</label>
                                            <textarea class="form-control " rows="4" name="description_of_product" <?php echo $disabled; ?> ><?php echo $TempFormData['description_of_product']; ?></textarea>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Description of Scenario</label>
                                            <textarea class="form-control " rows="4" name="description_of_scenario" <?php echo $disabled; ?>><?php echo $TempFormData['description_of_scenario']; ?></textarea>
                                          </div>
                                         
                                    </div>


                                    <div class="col-12 col-md-4 ">
                                          <div class="field-row">
                                             <label>Completed By</label>
                                            <input class="form-control " type="text" name="completed_by" value="<?php echo $TempFormData['completed_by']; ?>" <?php echo $disabled; ?>>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Date</label>
                                            <div class="input-group  ">
                                            <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="completed_by_date" value="<?php echo $TempFormData['completed_by_date']; ?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                          
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Time</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="completed_by_time" value="<?php echo $TempFormData['completed_by_time']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>

                                    <div class="col-12 col-md-12 ">
                                          <div class="field-row">
                                             <label>Reviewed by:</label>
                                            <label>Management </label><input value="management" type="radio" name="reviewed_by" class="<?php echo $disabled; ?>" <?php if($TempFormData['reviewed_by'] == 'management'){ echo "checked"; } ?>>
                                            <label>Team </label><input value="team" type="radio" name="reviewed_by" class="<?php echo $disabled; ?>" <?php if($TempFormData['reviewed_by'] == 'team'){ echo "checked"; } ?>>
                                          </div>
                                         
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Date</label>
                                            <div class="input-group  ">
                                            <input class="form-control date datetimepicker1" <?php echo $disabled; ?> type="text" name="reviewed_by_date" value="<?php echo $TempFormData['reviewed_by_date']; ?>" >
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                         
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                          <div class="field-row">
                                            <label>Time</label>
                                            <div class="input-group date datetimepicker3">
                                                <input class="form-control " type="text" name="reviewed_by_time" value="<?php echo $TempFormData['reviewed_by_time']; ?>" <?php echo $disabled; ?>>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                            </div>
                                          
                                      </div>
                                    </div>




                                    
                                            </div>
                                            <?php } ?>
                                            
                                             <?php 
                                                if($table_name == "haccap_training_record"){ 
                                                   $countj = 1;
                                                
                                                    
                                                ?> 
                                                
                                                <div class="record_wrap">
                                                    <div class="row">
                                                          <?php if($disabled == '') { ?><div class="col-lg-12"><p>Key: 0. Not Applicable/Training not required 1. Can Do Under Supervision  2. Can do without supervision 3. Can trouble shoot the risk 4. Can train others</p></div>
                                                       <?php } ?>
                                                        <div class="col-lg-12 record_table_wrap">
                                                         <table class="row-border table-condensed table-bordered menuTable parent_table thcolor" id="monWeek" cellspacing="0" width="100%">
                                                           <thead>
                                                               <td class="innerTableColumn" style="text-align:center;">Skill or Training requirements</td>
                                                               <td class="innerTableColumn" style="text-align:center;">Required Skill Level</td>
                                                               <td class="innerTableColumn" style="text-align:center;">Current Capability </td>
                                                               <td class="innerTableColumn" style="text-align:center;">Future Training required?</td>
                                                               <?php if($disabled == '') { ?>
                                                               <td class="innerTableColumn"></td>
                                                               <?php } ?>
                                                           </thead>
                                                            
                                                                
                                                                    <?php $count = 1; foreach($TempFormData['training_records'] as $training_record) {  ?>     
                                                                <tbody>
                                                                <tr class="menurow">
                                                                    <td class="menuinput-width">
                                                                        <input class="form-control" type="text" <?php echo $disabled; ?> name="skill_name[]"  placeholder="Skill or Training requirements" value="<?php echo $training_record['skill_name'];  ?>"></td>
                                                                    
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="required_skill_level[]" value="<?php echo $training_record['required_skill_level']; ?>"></td>
                                                                        <td> <input class="form-control" type="text" <?php echo $disabled; ?> name="current_capability[]"  value="<?php echo $training_record['current_capability']; ?>"></td>
                                                                        <td> <select class="form-control <?php echo $disabled; ?>" name="future_training_required[]" <?php echo $disabled; ?>>
                                                                                <option>Future Training required?</option>
                                                                                <option value="1" <?php if($training_record['future_training_required'] == '1'){ echo "selected"; } ?>>YES</option>
                                                                                <option value="0" <?php if($training_record['future_training_required'] == '0'){ echo "selected"; } ?>>NO</option>
                                                                            </select></td> 
                                                                       <?php if($disabled == '') { ?>
                                                                          <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                     <?php if($count > 1 ) { ?>
                                                                     <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               
                                                                    <?php } ?>
                                                                    </div>
                                                                        </td>
                                                                       <?php } ?>
                                                                    </tr>
                                                                     <?php $count = $count+1; ?>
                                                                <tbody>
                                                                 <?php } ?>
                                                                
                                            </table>
                                            <?php if($disabled == '') { ?>
                                            <!--<div class="menubtns-width-wrap" style="margin-left:6px">-->
                                            <!--                <div class="ct-btns">-->
                                            <!--                 <a href="javascript:void(0)" class="btn add_wrap_button" style="background-color:#16b708;color:#fff;">+</a>-->
                                            <!--                 <?php if($countj > 1 ) { ?>-->
                                            <!--                         <a href="javascript:void(0)" class="btn remove_wrap_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>               -->
                                            <!--                <?php } ?>-->
                                            <!--                </div>-->
                                            <!--            </div>-->
                                                        
                                                        <?php } ?>
                                            </div></div></div>
                                            <br><br>
                                            <?php $countj = $countj+1; ?>
                                            <?php  } ?>
                                            
                                            <?php }  ?>
                          </div>
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
                          <textarea class="form-control" rows="4" name="form_note"><?php echo $TempFormData['form_note']; ?></textarea>
                        </div>
                       
                  </div>
                  <div class="col-12 col-md-12 ">
                        <div class="field-row">
                           <label style="width:100px;">Comments</label>
                          <textarea class="form-control" rows="4" name="form_comment"><?php echo $TempFormData['form_comment']; ?></textarea>
                        </div>
                       
                  </div>
                </div>
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
            // var equipVal = $('[data-rel=equipField_'+rowcount+']').val();
            $(this).find( '.equipField' ).attr('data-count',rowcount);
            $(this).find( '.equipField' ).attr('data-rel','equipField_'+rowcount);
           
            
            // $(this).find( '.equipField' ).val(equipVal);
            
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
    
    var wrap = $( '.record_wrap' );
     $(document).on( 'click', '.add_wrap_button', function () {
    var thisRow = $( this ).closest( '.record_wrap' )[0];
    
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