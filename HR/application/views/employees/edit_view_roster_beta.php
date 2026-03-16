
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
<style> 
 @media print { 
               .budget_inner,.cost_inner { 
                  visibility: hidden; 
               } 
            } 
             .roster_records th{
           text-align: center !important;
           font-weight: 400 !important; 
            }
</style>
<div class="overlayplaceorder" id='overlayplaceorder'></div>
	<div class="row item">
			</div>

    
    <form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_complete_roster" enctype="multipart/form-data">	

	<div  class="col-md-12 page-head border-bottom">
		<span class="text-center">
				<h3>VIEW ROSTER</h3>
			</span>
			
				<span class="extra_icons">
				<?php if($role =='manager' || $role =='admin'){ ?>
			<a href="javascript:send_email();"><i class="material-icons" data-toggle="tooltip" title="Mail">&#xe158;</i></a>
			<?php } ?>
			
			<a href="javascript:window.print();" ><i class="material-icons" data-toggle="tooltip" title="Print">&#xe8ad;</i></a>
			<a href="<?php echo base_url(); ?>index.php/admin/week_roster_download/<?php echo $roster_group_id; ?>" class="btn btn-success btn-ph" >Download <span>Excel</span></a>
			</span>
	
	</div><!--.col-md-12 -->
	
	
   <div class="container ct-view-roster1 empRosterContainer" style="width:100%;margin:auto;">

    <div class="form-group roster-nm">
      <label for="pwd"><b>Roster Name:</b></label>
      <div class='input-group '>
                    <input type='text' class="form-control" name="roster_name" style="height: 33px;" autocomplete="off" readonly value="<?php if(isset($roster_name) && $roster_name !='') {echo $roster_name;} ?>" >
                  
        </div>
	</div>
	
    <div class="form-group roster-dt">
	<div class="dt-inner">
	<label for="pwd"><b>Start date of the week :</b></label>
      <div class='input-group'>
                    <input type='text' class="form-control" name="start_date" style="height: 33px;" autocomplete="off" readonly value="<?php echo $start_date; ?>" >
                   
                </div>
                </div>
                <div class="dt-inner">
      <label for="pwd"><b>End date of the week:</b></label>
      <div class='input-group '>
                    <input type='text' class="form-control" name="end_date" style="height: 33px;" autocomplete="off" readonly value="<?php echo $end_date; ?>" >
                   
     </div>
     </div>
   
	</div>
	
	
	<?php if($role =='manager' || $role =='admin'){ ?>
	
<div class="dt-outer">
		<div class="form-group roster-dt">
		<div class="dt-inner budget_inner">
         <span class="budget_span"> Proj. Sales:  </span> <span class="budget_span_value"> <input  id="budget_input" readonly class="form-control" type="text" value="<?php echo (isset($budget) && $budget != '') ? '$'.$budget.'.00' : ''; ?>"></span>
		 </div>
          <div class="dt-inner cost_inner">
	  <span class="budget_span"> Cost:  </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="totall_cost" value="" readonly></span>
	  </div>
	  </div>
	  <div class="form-group roster-dt">
	  <!-- <div class="dt-inner">
	 <span class="budget_span">Variance: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="balance" value="" readonly></span>
	 </div> -->
	 
	 <div class="dt-inner">
	  <span class="budget_span">Hours Allocated: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="hours_worked" value="" readonly></span>
     </div>
     </div>
     </div>
	<?php } ?>
  
  
</div>
	<?php if($role =='manager' || $role =='admin'){ ?>
<div class="container ct-view-roster ct-input empRosterContainer" style="width:100%;">
    <div class="row weekday_line">
        <div class="ct-scroll">
        
            <table class="blueTable roster_records">
                <thead>
                <tr>
                <th ></th>
                <th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th><th>Total</th>
                </tr>
                </thead>
                <tbody>
                <td style="width:85px !important"><strong>Daily Sales and Labour Cost Projections</strong></td>
                <?php
                    $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                      $totalSales = 0;
                     $totalCost = 0;
                    foreach($weekdays as $weekday){
                    $index_name = $weekday.'_budget';
                    
                    if(${$weekday.'_budget'} !='') {    $week_budg = number_format(${$weekday.'_budget'}, 2, '.', ''); $totalSales += $week_budg;  $week_budg = "$".$week_budg; }else{  $week_budg = ''; } 
                    if(${$weekday.'_cost'} !='') {    $week_cost = number_format(${$weekday.'_cost'}, 2, '.', ''); $totalCost += $week_cost; $week_cost = "$".$week_cost; }else{  $week_cost = ''; } 
                    if(${$weekday.'_variance'} !='') {    $week_variance = number_format($week_variance = ${$weekday.'_variance'}, 2, '.', ''); $week_variance = "$".$week_variance; }else{  $week_variance = ''; } 
                    if(${$weekday.'_percentage'} !='') { $week_percentage = number_format($week_percentage = ${$weekday.'_percentage'}, 2, '.', ''); $week_percentage = $week_percentage."%"; }else{  $week_percentage = ''; }
                    if(${$weekday.'_hrs_allocated'} !='') { $week_hrs_allocated = ${$weekday.'_hrs_allocated'};  }else{  $week_hrs_allocated = ''; }
                    if(${$weekday.'_average_hr_rate'} !='') { $week_avg_hr_rate = ${$weekday.'_average_hr_rate'} / ${$weekday.'no_of_employee'};  
                    $extra_week_avg_hr_rate = ($week_avg_hr_rate*9.5)/100; $new_avg_hrs = $week_avg_hr_rate + $extra_week_avg_hr_rate;
                    $week_avg_hr_rate = number_format($week_avg_hr_rate, 2, '.', ''); $week_avg_hr_rate = "$".$week_avg_hr_rate; }else{  $week_avg_hr_rate = ''; } 

                    ?>
                <td>
                 <table class="sub-table">
                <tr><td class="left-align">Sales (ex GST) </td><td class="right-align"> <?php echo $week_budg ?></td></tr>
                <tr><td class="left-align">Cost </td><td class="right-align"> <?php echo $week_cost; ?></td></tr>
                <!-- <tr><td class="left-align">Variance :</td><td class="right-align"> <?php echo $week_variance; ?></td></tr> -->
                <tr><td class="left-align">Hours </td><td class="right-align"> <?php echo $week_hrs_allocated; ?></td></tr>
                <?php if($this->session->userdata('supervisor') != 1) { ?>
                <tr><td class="left-align">Avg. Hrs </td><td class="right-align"> <?php echo $week_avg_hr_rate; ?></td></tr>
                <?php } ?>
                <tr><td class="left-align">% </td><td class="right-align"> <?php echo $week_percentage; ?></td></tr>
                <input type="hidden" id="sales" value="<?php echo ${$weekday.'_budget'}; ?>">
                <input type="hidden" id="cost" value="<?php echo ${$weekday.'_cost'}; ?>">
                <input type="hidden" id="variance" value="<?php echo ${$weekday.'_variance'}; ?>">
                <input type="hidden" id="percentage" value="<?php echo ${$weekday.'_percentage'}; ?>">
                <input type="hidden" id="hrs_allocated" value="<?php echo ${$weekday.'_hrs_allocated'}; ?>">
                <input type="hidden" id="avg_hrs" value="<?php echo ${$weekday.'_average_hr_rate'}; ?>">
                </table>
                </td>
	    <?php } ?>   
	    
	           <td>
                 <table class="sub-table">
                <tr><td class="left-align">Total Sales (ex GST) :</td><td class="right-align"> <?php echo "$".$totalSales ?></td></tr>
                <tr><td class="left-align">Hours :</td><td class="right-align"> <?php echo $total_hrs_of_all_employee ?></td></tr>
                <tr><td class="left-align">Cost  :</td><td class="right-align"> <?php echo "$".$totalCost ?></td></tr>
                <tr><td class="left-align">Super (10.5%)  :</td><td class="right-align"> <?php $labourCost = (($totalCost*10.5)/100)+$totalCost; echo number_format(($totalCost*10.5)/100,2) ?></td></tr>
                 <tr><td class="left-align">Labour Cost  :</td><td class="right-align"> <?php echo "$".number_format($labourCost,2) ?></td></tr>
                 </table>
                </td>
       
 </tbody>
            </table>
        </div>
    </div>
</div>    
<br>
	<?php } ?>


<div class="container ct-view-roster empRosterContainer">
<div class="row weekday_line">
  <div class="ct-scroll">
         <?php
      $datee = new DateTime($start_date);
    $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuedate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   
                       ?>
       <table id="week_days" class="weekday_line rosterEmp viewRosterEmp">
                <thead>
                    <tr class="signleCol"> 
                    	<th> <?php // echo $month; ?></th>
                    	<th> Mon (<?php echo $mondate; ?>)</th>   
                    	<th> Tue (<?php echo $tuedate; ?>)</th>  
                    	<th> Wed (<?php echo $weddate; ?>)</th>  
                    	<th> Thu  (<?php echo $thudate; ?>)</th>  
                    	<th> Fri (<?php echo $fridate; ?>)</th>  
                    	<th> Sat (<?php echo $satdate; ?>)</th>  
                    	<th> Sun (<?php echo $sundate; ?>)</th>  
                         	<th> </th>
                    	<th> </th>  
                    </tr>
                    

                </thead>
                	<tbody class="rosterRecord">
                	     <tr>
                        
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr> 
                                	<th class="empName">Employee</th>
                            	    </tr>
                                    </table>
                            </td> 
                            
                            <?php 
                            $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                            
                            for ($i = 0; $i < 7; $i++) {
                            ?>
                              <td class="colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr><th class="rosterTime">Time</th><th class="rosterhrs">Hrs</th></tr>
                                   
                                </table>
                              </td>   
                            
                            
                            <?php } ?>
                             
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr> 
                                	<th>Department</th>
                                
                            	    </tr>
                                    </table>
                            </td> 
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr> 
                                	<th>Total Hrs</th>
                                
                            	    </tr>
                                    </table>
                            </td> 
                        </tr>
                	   <?php 

                        $week_days = array('mon','tues','wed','thus','fri','sat','sun');
                        $outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                        ?>
                        <input type="hidden" id="roster_group_id" value="<?php echo $roster_group_id; ?>">
                        	<?php foreach($roster as $row){ ?>
                        <tr class="employeeRole">
                        
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    
                                    <tr>
                                    <td class="empName">
                                        <?php if($row->emp_name != '') {  $strEmp = $row->emp_name; }else{ $strEmp = ''; } 
                                        
                                        // $empSubstr = substr($strEmp,0,12);
                                        $empSubstr = stristr($strEmp," ",true); ?>
                                        
                                        <span class="tooltip"><p class="empFieldName text_overflow_Name"><b><?php echo $strEmp; ?></b></p><span class="roleName"><?php echo $row->role_name; ?></span>
            								  <span class="tooltiptext">
            								      <b><?php echo $strEmp; ?></b>
            								  <p><?php echo "( ".str_replace('_', ' ', $row->emp_type). " )"; ?><br><span><?php echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p>
            								  </span>
            							</span>
                                      
                                    </td>
                                    
                                </tr></table>
                            </td> 
                            <?php  for ($i = 0; $i < 7; $i++) { 
                            
                                $start_nameofday = $week_days[$i].'_start_time';
                                $end_nameofday = $week_days[$i].'_end_time'; 
                                $break_nameofday = $week_days[$i].'_break_time'; 
                                $layout_nameofday = $outletweek_days[$i].'_layout'; 
                                
                                
                               $time1 = strtotime($row->$start_nameofday);
$time2 = strtotime($row->$end_nameofday);
$break_hrs = $row->$break_nameofday; // Assuming $break_hrs is in minutes

if ($time2 != '' && $time1 != '') {
    // Check if the end time is less than the start time (which means it crosses midnight)
    if ($time2 < $time1) {
        // Add one day to the end time
        $time2 = strtotime('+1 day', $time2);
    }

    // Calculate the difference in seconds
    $difference_in_seconds = $time2 - $time1;

    // Convert the difference to minutes
    $difference_in_minutes = round($difference_in_seconds / 60, 2);

    // Subtract the break hours (break time is in minutes)
    $difference_in_minutes -= $break_hrs;

    // Convert the remaining minutes into hours and minutes format
    $hours = floor($difference_in_minutes / 60);
    $minutes = $difference_in_minutes % 60;

    // Format the time difference as HH:MM
    $difference = sprintf('%02d:%02d', $hours, $minutes);
} else {
    $difference = '00:00'; // Default if no valid times are provided
}

                                
                            ?>
                              <td class="colPadding0"> 
                                <table class="innerTable greenbackground">
                                    <tr>
                                        <td  class="rosterTime">
                                            <?php if($row->$start_nameofday != 0 && $row->$end_nameofday != 0) {?>
                                                <span class="tooltip">
                                                <?php echo date ('H:i',strtotime($row->$start_nameofday)); ?>
                                                -
                                                <?php echo date ('H:i',strtotime($row->$end_nameofday)); ?>
                                                <?php if($row->$break_nameofday > 0) { echo '('.$row->$break_nameofday.')';  } else {  echo '   '; }?>
                                                <span class="tooltiptext">
                                                    <table border="0" style="border: 0 !important;">
                                                        <tbody><tr>
                                                            <td style="border: 0!important;border-right: 1px solid #ccc  !important;">Start<br><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i A',strtotime($row->$start_nameofday)); } ?></td>
                                                            <td style="border: 0 !important;border-right: 1px solid #ccc  !important;">Finish<br><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i A',strtotime($row->$end_nameofday)); }?></td>
                                                            <td style="border: 0 !important;">Break<br><?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday;  } else {  echo '   '; }?></td>
                                                        </tr></tbody>
                                                    </table>
                                                </span>
                                                </span>
                                            <?php } ?>
                                            <br>
                                            <?php if($row->$layout_nameofday != '') {  $str = $row->$layout_nameofday; }else{ $str = ''; } 
                                        
                                            // $outletSubstr = substr($str,0,8);
                                            if ($str !=''){ ?>
                                            <span class="tooltip text_overflow_Name"><?php echo $str; ?>
                								  <span class="tooltiptext">Outlet - New : <?php echo $str; ?></span>
                							</span>
                							<?php } ?>
                                            </td>
                                        
                                        <td class="rosterhrs"><?php echo $difference; ?></td>
                                        
                                    </tr> 
                                </table>
                              </td>  
                              <?php } ?>
                            
                            <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                    
                                    <tr>
                                    <td class="roster_department">
                                       <?php echo $row->roster_department; ?>
                                    </td>
                                     
                                </tr></table>
                            </td> 
                            
                             <td class="ct-w colPadding0"> 
                                <table class="innerTable greenbackground">
                                     <tr>
                                   <td>
                                    <?php echo $row->emp_hours_worked_this_week.' Hrs'; ?>
                                    </td>
                                </tr></table>
                            </td> 
                             
                        </tr>
                        <input type="hidden" id="total_hrs_of_all_employee" value='<?php echo $total_hrs_of_all_employee; ?>'>
                        <input type="hidden" id="total_cost" value='<?php echo $week_earning; ?>'>
                        <input type="hidden" id="total_budget" value="<?php echo $budget; ?>">
                        <?php } ?>
                
                </tbody>

        </table>
        

<div>
	</br>
	
    </div>
    </div>
</form>
  <br>
	
</body>
<script>
function send_email(){

var roster_group_id = $("#roster_group_id").val();
    

   $.ajax({
		url:"<?php echo base_url();?>index.php/admin/send_email",
		method:"POST",
		data:{roster_group_id:roster_group_id},
		beforeSend: function(){
        $("#overlayplaceorder").show();
        },
	    success:function(data){
		swal("Email sent succesfully", {
         buttons: {
           ok: "Ok",
    
  },
})
			},
			complete:function(data){
         $("#overlayplaceorder").hide();
        }
	})

}
var budget = Number.parseFloat($("#total_budget").val());
var cost = Number.parseFloat($("#total_cost").val());
var balance = Number(budget) - Number(cost) ;
var balance = Math.abs(balance);


$("#totall_cost").val('$'+cost.toFixed(2));
if(Number(budget) < Number(cost)){
$("#balance").val('- $'+balance.toFixed(2));
}else{
$("#balance").val('$'+balance.toFixed(2));
}

$("#hours_worked").val($("#total_hrs_of_all_employee").val());

</script>
</html>
