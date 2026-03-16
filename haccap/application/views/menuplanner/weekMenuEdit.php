
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
                   
                        <form action="<?php echo base_url() ?>index.php/menuplanner/updateWeekMenu" id="menu_add" method="post" class="form-horizontal" >
                    
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Menu Planner Creation</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div>
                                    <a class="btn btn-success add-btn" href="<?php echo base_url(); ?>index.php/menuplanner/weekMenuList"><i class="mdi mdi-reply align-bottom me-1"></i> Back</a>
                                    
                                    
                                    <input type="submit" class="btn btn-primary" value="update Menu">
                                  <input class="form-control " type="hidden" name="week_menu_id" value="<?php echo $menuWeekplanner['week_menu_id']; ?>" placeholder="Menu Name">
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
									   <div class="col-12 col-md-3 ">
									       <label>Menu Name</label>
										<input class="form-control " type="text" name="week_menu_name" value="<?php echo $menuWeekplanner['week_menu_name']; ?>" placeholder="Menu Name">
										</div>
										<div class="col-12 col-md-3">
										     <label>Start Date</label>
											<input class="form-control " type="date" name="week_start_date" value="<?php echo $menuWeekplanner['week_start_date']; ?>" placeholder="Start Date">
										</div>
                						<div class="col-12 col-md-3">
                						     <label>End Date</label>
                						<input class="form-control " type="date" name="week_end_date" value="<?php echo $menuWeekplanner['week_end_date']; ?>" placeholder="End Date">
                						</div>
									    <div class="col-12 col-md-3">
									         <label>Month</label>
                						<select class="form-control " name="week_menu_month">
                						    
                						    <option value="">Select Month</option>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'January'){?> <option value="January" selected>January</option> <?php } else{ ?> <option value="January">January</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'February'){?> <option value="February" selected>February</option> <?php } else{ ?> <option value="February">February</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'March'){?> <option value="March" selected>March</option> <?php } else{ ?> <option value="March">March</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'April'){?> <option value="April" selected>April</option> <?php } else{ ?> <option value="April">April</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'May'){?> <option value="May" selected>May</option> <?php } else{ ?> <option value="May">May</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'June'){?> <option value="June" selected>June</option> <?php } else{ ?> <option value="June">June</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'July'){?> <option value="July" selected>July</option> <?php } else{ ?> <option value="July">July</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'August'){?> <option value="August" selected>August</option> <?php } else{ ?> <option value="August">August</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'September'){?> <option value="September" selected>September</option> <?php } else{ ?> <option value="September">September</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'October'){?> <option value="October" selected>October</option> <?php } else{ ?> <option value="October">October</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'November'){?> <option value="November" selected>November</option> <?php } else{ ?> <option value="November">November</option> <?php } ?>
                						    <?php if($menuWeekplanner['week_menu_month'] == 'December'){?> <option value="December" selected>December</option> <?php } else{ ?> <option value="December">December</option> <?php } ?>
                						</select>
                						</div>
									
									</div>
									<div class="create_menu_wrap">
									    <div class="row">
									        <div class="col-lg-12">
									            <ul class="tabs">
									                <li class="disable"></li>
                                                     <li class="active" rel="Mon">Mon (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'])); ?> )</li>
                                                      <li rel="Tue">Tue (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 1 day')); ?> )</li>
                                                      <li rel="Wed">Wed (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 2 day')); ?> )</li>
                                                      <li rel="Thu">Thu (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 3 day')); ?> )</li>
                                                      <li rel="Fri">Fri (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 4 day')); ?> )</li>
                                                      <li rel="Sat">Sat (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 5 day')); ?> )</li>
                                                      <li rel="Sun">Sun (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 6 day')); ?> )</li>
                                                    </ul>
                                                    <div class="tab_container">
                                                        <!-- #Mon -->
                                                      <h3 class="d_active tab_drawer_heading" rel="Mon">Mon</h3>
                                                      <div id="Mon" class="tab_content">
                                                           <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    
                                                                    <?php if(isset($monMenus)){ $i = 1; foreach($monMenus as $monMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $monMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="monWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $monMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $monMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $monMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $monMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $monMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $monMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $monMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $monMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $monMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $monMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="monWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                      </div>
                                                      <!-- #Tue -->
                                                      <h3 class="tab_drawer_heading" rel="Tue">Tue</h3>
                                                      <div id="Tue" class="tab_content">
                                                      <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="tueWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                   
                                                                    <?php if(isset($tueMenus)){ $i = 1; foreach($tueMenus as $tueMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $tueMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="tueWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $tueMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $tueMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $tueMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $tueMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $tueMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $tueMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $tueMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $tueMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $tueMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $tueMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="tueWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        </div>
                                                      <!-- #Wed -->
                                                      <h3 class="tab_drawer_heading" rel="Wed">Wed</h3>
                                                      <div id="Wed" class="tab_content">
                                                            <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="WedWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    <?php if(isset($wedMenus)){ $i = 1; foreach($wedMenus as $wedMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $wedMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="WedWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $wedMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $wedMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $wedMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $wedMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $wedMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $wedMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $wedMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $wedMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $wedMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $wedMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width  headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="WedWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                       </div>
                                                      <!-- #Thu -->
                                                      <h3 class="tab_drawer_heading" rel="Thu">Thu</h3>
                                                      <div id="Thu" class="tab_content">
                                                            <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="thuWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    <?php if(isset($thuMenus)){ $i = 1; foreach($thuMenus as $thuMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $thuMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="thuWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $thuMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $thuMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $thuMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $thuMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $thuMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $thuMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $thuMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $thuMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $thuMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $thuMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="thuWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                       </div>
                                                        
                                                        <!-- #Fri -->
                                                      <h3 class="tab_drawer_heading" rel="Fri">Fri</h3>
                                                      <div id="Fri" class="tab_content">
                                                      <div class="ct-scroll">
			                                                <table class="row-border table-condensed table-bordered menuTable" id="friWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    <?php if(isset($friMenus)){ $i = 1; foreach($friMenus as $friMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $friMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="friWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $friMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $friMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $friMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $friMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $friMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $friMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $friMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $friMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $friMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $friMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                            <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="friWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                       </div>
                                                        <!-- #Sat -->
                                                      <h3 class="tab_drawer_heading" rel="Sat">Sat</h3>
                                                      <div id="Sat" class="tab_content">
                                                     <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="satWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    <?php if(isset($satMenus)){ $i = 1; foreach($satMenus as $satMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $satMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="satWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $satMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $satMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $satMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $satMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $satMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $satMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $satMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $satMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $satMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $satMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="satWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                       </div>
                                                        <!-- #Sun -->
                                                      <h3 class="tab_drawer_heading" rel="Sun">Sun</h3>
                                                      <div id="Sun" class="tab_content">
                                                      <div class="ct-scroll">
			                                               <table class="row-border table-condensed table-bordered menuTable" id="sunWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                     <?php if(isset($sunMenus)){ $i = 1; foreach($sunMenus as $sunMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	
                                                                                	if($row->category_id == $sunMenu[0]->category){ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>" selected><?php echo $row->name; ?></option>
                                                                                	<?php } else{ ?>
                                                                                	    <option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } } ?>
                                                                            </select>
                                                                            <select class="form-control menu_list selectmenu" name="sunWeek[]" onchange="fetchMenuItems(this);">
                                                                                <option value=''>Select Menu</option>
                                                                                
                                                                                	<?php foreach($menuPlanners as $row){ 
                                                                                	    if($row->menu_category_id == $sunMenu[0]->menu_category_id){
                                                                                        	if($row->menuPlannerID == $sunMenu[0]->menuPlannerID){
                                                                                        	?>
                                                                                        	<option value="<?php echo $row->menuPlannerID ?>" selected><?php echo $row->menu; ?></option>
                                                                                        	<?php } else{ ?>
                                                                                            <option value="<?php echo $row->menuPlannerID ?>"><?php echo $row->menu; ?></option>
                                                                                	<?php } } }?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $sunMenu[0]->cuisine ?>" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $sunMenu[0]->name ?>" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $sunMenu[0]->regular ?>" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color <?php echo $sunMenu[0]->regular_color ?>" type="text" name="regular_color" value="<?php echo $sunMenu[0]->regular_color ?>" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $sunMenu[0]->large ?>" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color <?php echo $sunMenu[0]->large_color ?>" type="text" name="large_color" value="<?php echo $sunMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                    <?php if($i == '1'){ ?>
                                                                                        <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <?php $i = 0; } else{ ?>
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    <a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a>
                                                                                     <?php } ?>
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menutbth-width headCol">
                                                                           <select class="form-control selectmenu" onchange="fetchMenus(this);">
                                                                                <option value=''>Select Category</option>
                                                                                	<?php foreach($menuCategory as $row){  	?>
                                                                                	<option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option>
                                                                                	<?php } ?>
                                                                            </select>
                                                                            
                                                                            <select class="form-control menu_list selectmenu" name="sunWeek[]" onchange="fetchMenuItems(this);" style="display:none;">
                                                                                
                                                                                	
                                                                            </select>
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" readonly placeholder="Category">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" readonly placeholder="Regular">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" readonly placeholder="Regular Color">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" readonly placeholder="Large">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" readonly placeholder="Large Color">
                                                                        </td>
                                                                        <td class="menubtns-width">
                                                                            <div class="ct-btns">
                                                                                     <a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a>
                                                                                    
                                                                                     </div>
                                                                        </td>
                                                                       
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
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

<script>
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

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

 function fetchMenus(obj){
        var menuPlannerID = $(obj).val();
        var menuOptions;
        if(menuPlannerID == ''){
                var selectmenu=$(obj).closest(".menurow").find(".menu_list"); 
                selectmenu.css('display','none');
        }
        else{
            $.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/menuplanner/fetchMenus",
		    data: {"menuPlannerID":menuPlannerID},
		    success: function(data){
                 console.log(data);
                 if(data != 'No record'){
                     var data1=JSON.parse(data)
                     menuOptions+='<option value="">Select Menu</option>';
                 $.each(data1, function(i, value) {
                     menuOptions+='<option value="'+value.menuPlannerID+'">'+value.menu+'</option>';
                     
                     
                });
                
                 }
                 else{
                     menuOptions+='<option value="">No Menu</option>';
                 }
                var selectmenu=$(obj).closest(".menurow").find('.menu_list');
                selectmenu.html(menuOptions);
                selectmenu.css('display','block');
		    }
		});
        }
    }
    
    function fetchMenuItems(obj){
        var menuPlannerID = $(obj).val();
        // console.log(menuPlannerID);
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
                     selectInputcategory.val(value.name);
                     
                     var selectInputregular=$(obj).closest(".menurow").find(".regular"); 
                     selectInputregular.val(value.regular);
                     
                     var selectInputregular_color=$(obj).closest(".menurow").find(".regular_color"); 
                     selectInputregular_color.val(value.regular_color);
                     selectInputregular_color.addClass(value.regular_color);
                     
                     var selectInputlarge=$(obj).closest(".menurow").find(".large"); 
                     selectInputlarge.val(value.large);
                     
                     var selectInputlarge_color=$(obj).closest(".menurow").find(".large_color"); 
                     selectInputlarge_color.val(value.large_color);
                     selectInputlarge_color.addClass(value.large_color);
                });
                
		    }
		});
        }
        
    }
    
    $(document).on("click", ".add_field_button" , function() {
        var selectedTable=$(this).closest(".menuTable").find("tbody");
        var menuIdname = $(this).closest(".menuTable").attr('id');
        
         var tableData='<tr class="menurow"><td class="menutbth-width headCol"><select class="form-control selectmenu" onchange="fetchMenus(this);"><option value="">Select Category</option><?php foreach($menuCategory as $row){?><option value="<?php echo $row->category_id ?>"><?php echo $row->name; ?></option><?php } ?></select><select class="form-control menu_list selectmenu" name="'+menuIdname+'[]" onchange="fetchMenuItems(this);" style="display:none;"></select></td>';
         tableData +='<td class="menuinput-width"><span class="label_text">Cuisine</span><input class="form-control cuisine" type="text" name="cuisine" value="" readonly placeholder="Cuisine"></td>';
         tableData +='<td class="menuinput-width"><span class="label_text">Category</span><input class="form-control category" type="text" name="category" value="" readonly placeholder="Category"></td>';
        tableData +='<td class="menuinput-width"><span class="label_text">Regular</span><input class="form-control regular" type="text" name="regular" value="" readonly placeholder="Regular"></td>';
        tableData +='<td class="menuinput-width"><span class="label_text">Regular Color</span><input class="form-control regular_color" type="text" name="regular_color" v readonly placeholder="Regular Color"></td>';
        tableData +='<td class="menuinput-width"><span class="label_text">Large</span><input class="form-control large" type="text" name="large" value="" readonly placeholder="Large"></td>';
        tableData +='<td class="menuinput-width"><span class="label_text">Large Color</span><input class="form-control large_color" type="text" name="large_color" value="" readonly placeholder="Large Color"></td>';
        tableData +='<td class="menuinput-width"><div class="ct-btns"><a href="javascript:void(0)" class="btn add_field_button" style="background-color:#16b708;color:#fff;">+</a><a href="javascript:void(0)" class="btn remove_field_button" style="background-color:#ff5426;color:#fff;margin-left:5px;">-</a></div>';
        tableData +='</td></tr>';   
            
                selectedTable.append(tableData);
          
    });
    
    $(document).on("click", ".remove_field_button" , function() {
    
    $(this).parent().parents('.menurow').remove();
});
</script>