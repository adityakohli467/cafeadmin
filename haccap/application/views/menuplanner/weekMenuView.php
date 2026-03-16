
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
                   
                        <form action="<?php echo base_url() ?>index.php/menuplanner/saveWeekMenu" id="menu_add" method="post" class="form-horizontal" >
                    
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
                                    
                                    
                                    <input type="submit" class="btn btn-primary" value="Save Menu">
                                  
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
										<input class="form-control " type="text" name="week_menu_name" value="<?php echo $menuWeekplanner['week_menu_name']; ?>" readonly placeholder="">
										</div>
										<div class="col-12 col-md-3">
										     <label>Start Date</label>
											<input class="form-control " type="date" name="week_start_date" value="<?php echo $menuWeekplanner['week_start_date']; ?>" readonly placeholder="">
										</div>
                						<div class="col-12 col-md-3">
                						     <label>End Date</label>
                						<input class="form-control " type="date" name="week_end_date" value="<?php echo $menuWeekplanner['week_end_date']; ?>" readonly placeholder="">
                						</div>
									    <div class="col-12 col-md-3">
									         <label>Month</label>
									         <input class="form-control " type="text" name="week_menu_month" value="<?php echo $menuWeekplanner['week_menu_month']; ?>" readonly >
                					
                						</div>
									
									</div>
									
									
									<!--~~~~~~~~~~~~~~~~~~~~~-->
									
									<div class="create_menu_wrap mb-4">
									     <div class="row mb-4">
									        <div class="col-lg-12">
									             <?php
									             $green = 0;$amber = 0;$red = 0;$count = 0;
									             if(isset($monMenus)){ 
									                 foreach($monMenus as $monMenu){
									                 if($monMenu[0]->regular_color =='Green'){
									                     $green++;
									                 }elseif($monMenu[0]->regular_color =='Amber'){
									                     $amber++;
									                 }else{
									                     $red++;
									                 }
									                 
									                 if($monMenu[0]->large_color =='Green'){
									                     $green++;
									                 }elseif($monMenu[0]->large_color =='Amber'){
									                     $amber++;
									                 }else{
									                     $red++;
									                 }
									                
									                 $count++;
									                }
									                $totalCount = $count*2;
									                $grP = $green/$totalCount*100;
									                $rrP = $red/$totalCount*100;
									                $amP = $amber/$totalCount*100;
									                } 
									                ?>
									                
									                 <?php
									             $tu_green = 0;$tu_amber = 0;$tu_red = 0;$tu_count = 0;
									             if(isset($tueMenus)){ 
									                foreach($tueMenus as $tueMenu){ 
									                 if($tueMenu[0]->regular_color =='Green'){
									                     $tu_green++;
									                 }elseif($tueMenu[0]->regular_color =='Amber'){
									                     $tu_amber++;
									                 }else{
									                     $tu_red++;
									                 }
									                 
									                 if($tueMenu[0]->large_color =='Green'){
									                     $tu_green++;
									                 }elseif($tueMenu[0]->large_color =='Amber'){
									                     $tu_amber++;
									                 }else{
									                     $tu_red++;
									                 }
									                
									                 $tu_count++;
									                }
									                $tu_totalCount = $tu_count*2;
									                $tu_grP = $tu_green/$tu_totalCount*100;
									                $tu_rrP = $tu_red/$tu_totalCount*100;
									                $tu_amP = $tu_amber/$tu_totalCount*100;
									                } 
									                ?>
									                
									                 <?php
									             $we_green = 0;$we_amber = 0;$we_red = 0;$we_count = 0;
									             if(isset($wedMenus)){ 
									                foreach($wedMenus as $wedMenu){ 
									                 if($wedMenu[0]->regular_color =='Green'){
									                     $we_green++;
									                 }elseif($wedMenu[0]->regular_color =='Amber'){
									                     $we_amber++;
									                 }else{
									                     $we_red++;
									                 }
									                 
									                 if($wedMenu[0]->large_color =='Green'){
									                     $we_green++;
									                 }elseif($wedMenu[0]->large_color =='Amber'){
									                     $we_amber++;
									                 }else{
									                     $we_red++;
									                 }
									                
									                 $we_count++;
									                }
									                $we_totalCount = $we_count*2;
									                $we_grP = $we_green/$we_totalCount*100;
									                $we_rrP = $we_red/$we_totalCount*100;
									                $we_amP = $we_amber/$we_totalCount*100;
									                } 
									                ?>
									                <?php
									             $th_green = 0;$th_amber = 0;$th_red = 0;$th_count = 0;
									             if(isset($thuMenus)){ 
									                foreach($thuMenus as $thuMenu){
									                 if($thuMenu[0]->regular_color =='Green'){
									                     $th_green++;
									                 }elseif($thuMenu[0]->regular_color =='Amber'){
									                     $th_amber++;
									                 }else{
									                     $th_red++;
									                 }
									                 
									                 if($thuMenu[0]->large_color =='Green'){
									                     $th_green++;
									                 }elseif($thuMenu[0]->large_color =='Amber'){
									                     $th_amber++;
									                 }else{
									                     $th_red++;
									                 }
									                
									                 $th_count++;
									                }
									                $th_totalCount = $th_count*2;
									                $th_grP = $th_green/$th_totalCount*100;
									                $th_rrP = $th_red/$th_totalCount*100;
									                $th_amP = $th_amber/$th_totalCount*100;
									                } 
									                ?>
									                <?php
									             $fr_green = 0;$fr_amber = 0;$fr_red = 0;$fr_count = 0;
									             if(isset($friMenus)){ 
									                foreach($friMenus as $friMenu){
									                 if($friMenu[0]->regular_color =='Green'){
									                     $fr_green++;
									                 }elseif($friMenu[0]->regular_color =='Amber'){
									                     $fr_amber++;
									                 }else{
									                     $fr_red++;
									                 }
									                 
									                 if($friMenu[0]->large_color =='Green'){
									                     $fr_green++;
									                 }elseif($friMenu[0]->large_color =='Amber'){
									                     $fr_amber++;
									                 }else{
									                     $fr_red++;
									                 }
									                
									                 $fr_count++;
									                }
									                $fr_totalCount = $fr_count*2;
									                $fr_grP = $fr_green/$fr_totalCount*100;
									                $fr_rrP = $fr_red/$fr_totalCount*100;
									                $fr_amP = $fr_amber/$fr_totalCount*100;
									                } 
									                ?>
									                
									                <?php
									             $sa_green = 0;$sa_amber = 0;$sa_red = 0;$sa_count = 0;
									             if(isset($satMenus)){ 
									               foreach($satMenus as $satMenu){
									                 if($satMenu[0]->regular_color =='Green'){
									                     $sa_green++;
									                 }elseif($satMenu[0]->regular_color =='Amber'){
									                     $sa_amber++;
									                 }else{
									                     $sa_red++;
									                 }
									                 
									                 if($satMenu[0]->large_color =='Green'){
									                     $sa_green++;
									                 }elseif($satMenu[0]->large_color =='Amber'){
									                     $sa_amber++;
									                 }else{
									                     $sa_red++;
									                 }
									                
									                 $sa_count++;
									                }
									                $sa_totalCount = $sa_count*2;
									                $sa_grP = $sa_green/$sa_totalCount*100;
									                $sa_rrP = $sa_red/$sa_totalCount*100;
									                $sa_amP = $sa_amber/$sa_totalCount*100;
									                } 
									                ?>
									                <?php
									             $su_green = 0;$su_amber = 0;$su_red = 0;$su_count = 0;
									             if(isset($satMenus)){ 
									               foreach($satMenus as $satMenu){
									                 if($satMenu[0]->regular_color =='Green'){
									                     $su_green++;
									                 }elseif($satMenu[0]->regular_color =='Amber'){
									                     $su_amber++;
									                 }else{
									                     $su_red++;
									                 }
									                 
									                 if($satMenu[0]->large_color =='Green'){
									                     $su_green++;
									                 }elseif($satMenu[0]->large_color =='Amber'){
									                     $su_amber++;
									                 }else{
									                     $su_red++;
									                 }
									                
									                 $su_count++;
									                }
									                $su_totalCount = $su_count*2;
									                $su_grP = $su_green/$su_totalCount*100;
									                $su_rrP = $su_red/$su_totalCount*100;
									                $sv_amP = $su_amber/$su_totalCount*100;
									                } 
									                ?>
										<table class="table table-bordered record_table viewRecordTable" id="Mon_table">
										 
										  <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</th>
										      <th scope="col">Total Items (<?php  echo $totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $green; ?></td>
										      <td><?php echo number_format($grP,2); ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $amber; ?></td>
										      <td><?php echo number_format($amP,2); ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $red; ?></td>
										      <td><?php echo number_format($rrP,2); ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>     
										<table class="table table-bordered record_table viewRecordTable" id="Tue_table">
										 
										  <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</td>
										      <th scope="col">Total Items (<?php  echo $tu_totalCount; ?>)</td>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $tu_green; ?></td>
										      <td><?php echo $tu_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $tu_amber; ?></td>
										      <td><?php echo $tu_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $tu_red; ?></td>
										      <td><?php echo $tu_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
										<table class="table table-bordered record_table viewRecordTable" id="Wed_table">
										 
										 <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</th>
										      <th scope="col">Total Items (<?php  echo $we_totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr> 
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $we_green; ?></td>
										      <td><?php echo $we_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $we_amber; ?></td>
										      <td><?php echo $we_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $we_red; ?></td>
										      <td><?php echo $we_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
										<table class="table table-bordered record_table viewRecordTable" id="Thu_table">
										 <thead>
										  
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</th>
										      <th scope="col">Total Items (<?php  echo $th_totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $th_green; ?></td>
										      <td><?php echo $th_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $th_amber; ?></td>
										      <td><?php echo $th_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $th_red; ?></td>
										      <td><?php echo $th_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
										<table class="table table-bordered record_table viewRecordTable" id="Fri_table">
										 
										  <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors </th>
										      <th scope="col">Total Items (<?php  echo $fr_totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $fr_green; ?></td>
										      <td><?php echo $fr_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $fr_amber; ?></td>
										      <td><?php echo $fr_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $fr_red; ?></td>
										      <td><?php echo $fr_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
										<table class="table table-bordered record_table viewRecordTable" id="Sat_table">
										 
										  <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</th>
										      <th scope="col">Total Items (<?php  echo $sa_totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $sa_green; ?></td>
										      <td><?php echo $sa_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $sa_amber; ?></td>
										      <td><?php echo $sa_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $sa_red; ?></td>
										      <td><?php echo $sa_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
										<table class="table table-bordered record_table viewRecordTable" id="Sun_table">
										 
										  <thead>
										      <tr style="background-color: black;color: white;font-weight: bold;text-align: center;">
										     
										      <th scope="col">Colors</th>
										      <th scope="col">Total Items (<?php  echo $su_totalCount; ?>)</th>
										       <th scope="col" width="200">%</th>
										      <!--<td scope="col">Aim For</td>-->
										    </tr>
										    </thead>
										    <tbody>
										    <tr>
										      <th scope="row" style="background-color: #0DB10C;color: #fff;"><b>GREEN</b></th>
										       <td><?php echo $su_green; ?></td>
										      <td><?php echo $su_grP; ?></td>
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #FFA829;color: #fff;"><b>AMBER</b></th>
										      <td><?php echo $su_amber; ?></td>
										      <td><?php echo $su_amP; ?></td>
										      
										      <!--<td></td>-->
										    </tr>
										    <tr>
										      <th scope="row" style="background-color: #D70000;color: #fff;"><b>RED</b></th>
										       <td><?php echo $su_red; ?></td>
										      <td><?php echo $su_rrP; ?></td>
										      <!--<td></td>-->
										    </tr>
										   
										  </tbody>
										</table>
									            </div>
									            </div>
									    <div class="row">
									        <div class="col-lg-12">
									            <ul class="tabs">
									                 <li class="disable"></li>
                                                      <li class="active Mon_table" rel="Mon">Mon (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'])); ?> )</li>
                                                      <li class="Tue_table" rel="Tue">Tue (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 1 day')); ?> )</li>
                                                      <li class="Wed_table" rel="Wed">Wed (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 2 day')); ?> )</li>
                                                      <li class="Thu_table" rel="Thu">Thu (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 3 day')); ?> )</li>
                                                      <li class="Fri_table" rel="Fri">Fri (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 4 day')); ?> )</li>
                                                      <li class="Sat_table" rel="Sat">Sat (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 5 day')); ?> )</li>
                                                      <li class="Sun_table" rel="Sun">Sun (<?php echo date('d-m-Y',strtotime($menuWeekplanner['week_start_date'].' + 6 day')); ?> )</li>
                                                    </ul>
                                                    <div class="tab_container">
                                                        <!-- #Mon -->
                                                      <h3 class="d_active tab_drawer_heading" rel="Mon">Mon</h3>
                                                      <div id="Mon" class="tab_content">
                                                           <div class="ct-scroll">
			                                                 <table class="row-border table-condensed table-bordered menuTable" id="monWeek" cellspacing="0" width="100%">
                                                               
                                                                <tbody>
                                                                    
                                                                    <?php if(isset($monMenus)){ foreach($monMenus as $monMenu){ ?>
                                                                    <tr class="menurow">
                                                                        <td class="menuinput-width headCol">
                                                                            <?php echo $monMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $monMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $monMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $monMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" style="background-color:<?php echo ($monMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($monMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" type="text" name="regular_color" value="<?php echo $monMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $monMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                            <input class="form-control large_color" type="text" name="large_color" style="background-color:<?php echo ($monMenu[0]->large_color == 'Green' ? '#0DB10C' : ($monMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $monMenu[0]->large_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                           <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                           <?php echo $tueMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $tueMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $tueMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $tueMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" style="background-color:<?php echo ($tueMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($tueMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $tueMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $tueMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text"  style="background-color:<?php echo ($tueMenu[0]->large_color == 'Green' ? '#0DB10C' : ($tueMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" name="large_color" value="<?php echo $tueMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                            <?php echo $wedMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $wedMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $wedMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $wedMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" style="background-color:<?php echo ($wedMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($wedMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $wedMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $wedMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" style="background-color:<?php echo ($wedMenu[0]->large_color == 'Green' ? '#0DB10C' : ($wedMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" type="text" name="large_color" value="<?php echo $wedMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                           <?php echo $thuMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $thuMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $thuMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $thuMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" style="background-color:<?php echo ($thuMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($thuMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $thuMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $thuMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" style="background-color:<?php echo ($thuMenu[0]->large_color == 'Green' ? '#0DB10C' : ($thuMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $thuMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                       
                                                                       
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                           <?php echo $friMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $friMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $friMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $friMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" name="regular_color" style="background-color:<?php echo ($friMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($friMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $friMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $friMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" name="large_color" style="background-color:<?php echo ($friMenu[0]->large_color == 'Green' ? '#0DB10C' : ($friMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" value="<?php echo $friMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                           <?php echo $satMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $satMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $satMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $satMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">  <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" type="text" style="background-color:<?php echo ($satMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($satMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>"  name="regular_color" value="<?php echo $satMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text"  name="large" value="<?php echo $satMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" type="text" style="background-color:<?php echo ($satMenu[0]->large_color == 'Green' ? '#0DB10C' : ($satMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" name="large_color" value="<?php echo $satMenu[0]->large_color ?>" readonly placeholder="Large Color">
                                                                        </td>
                                                                         
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
                                                                        <td class="menuinput-width headCol">
                                                                            <?php echo $sunMenu[0]->menu; ?>
                                                                           
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Cuisine</span>
                                                                            <input class="form-control cuisine" type="text" name="cuisine" value="<?php echo $sunMenu[0]->cuisine ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Category</span>
                                                                            <input class="form-control category" type="text" name="category" value="<?php echo $sunMenu[0]->name ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"><span class="label_text">Regular</span>
                                                                            <input class="form-control regular" type="text" name="regular" value="<?php echo $sunMenu[0]->regular ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">   <span class="label_text">Regular Color</span>
                                                                            <input class="form-control regular_color" style="background-color:<?php echo ($sunMenu[0]->regular_color == 'Green' ? '#0DB10C' : ($sunMenu[0]->regular_color =='Amber' ? '#ffa825' : 'red') ) ?>" type="text" name="regular_color" value="<?php echo $sunMenu[0]->regular_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width"> <span class="label_text">Large</span>
                                                                            <input class="form-control large" type="text" name="large" value="<?php echo $sunMenu[0]->large ?>" readonly placeholder="">
                                                                        </td>
                                                                        <td class="menuinput-width">    <span class="label_text">Large Color</span>
                                                                            <input class="form-control large_color" style="background-color:<?php echo ($sunMenu[0]->large_color == 'Green' ? '#0DB10C' : ($sunMenu[0]->large_color =='Amber' ? '#ffa825' : 'red') ) ?>" type="text" name="large_color" value="<?php echo $sunMenu[0]->large_color ?>" readonly placeholder="">
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <?php } } else{ ?>
                                                                    <tr class="menurow">
                                                                        <td>
                                                                            <input class="form-control text-center" type="text" readonly placeholder="No Menu">
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
									<!--~~~~~~~~~~~~~~~~~~~~~-->
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
    $(document).ready(function(){
        $(".record_table:not(#Mon_table)").css("display","none");
    })
    $(".Mon_table").on("click",function(){
        $(".record_table").hide();
        $("#Mon_table").show();
    });
     $(".Tue_table").on("click",function(){
        $(".record_table").hide();
        $("#Tue_table").show();
    });
    $(".Wed_table").on("click",function(){
        $(".record_table").hide();
        $("#Wed_table").show();
    });
    $(".Thu_table").on("click",function(){
        $(".record_table").hide();
        $("#Thu_table").show();
    });
    $(".Fri_table").on("click",function(){
        $(".record_table").hide();
        $("#Fri_table").show();
    });
    $(".Sat_table").on("click",function(){
        $(".record_table").hide();
        $("#Sat_table").show();
    });
     $(".Sun_table").on("click",function(){
        $(".record_table").hide();
        $("#Sun_table").show();
    });
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