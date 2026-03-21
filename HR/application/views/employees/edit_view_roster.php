
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
	
	
   <div class="container ct-view-roster ct-view-roster1" style="width:100%;margin:auto;">

    <div class="form-group roster-nm">
      <label for="pwd"><b>Roster Name:</b></label>
      <div class='input-group '>
                    <input type='text' class="form-control" name="roster_name" style="height: 33px;" autocomplete="off" readonly value="<?php if(isset($roster_name) && $roster_name !='') {echo $roster_name;} ?>" >
                  
        </div>
	</div>
	
    <div class="form-group roster-dt">
	<div class="dt-inner">
	<label for="pwd"><b>Start Date:</b></label>
      <div class='input-group'>
                    <input type='text' class="form-control" name="start_date" style="height: 33px;" autocomplete="off" readonly value="<?php echo $start_date; ?>" >
                   
                </div>
                </div>
                <div class="dt-inner">
      <label for="pwd"><b>End Date:</b></label>
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
<div class="container ct-view-roster ct-input" style="width:100%;">
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
                    
                    if(isset(${$weekday.'_budget'}) && ${$weekday.'_budget'} !== '' && ${$weekday.'_budget'} != 0) {    $week_budg = number_format(${$weekday.'_budget'}, 2, '.', ''); $totalSales += $week_budg;  $week_budg = "$".$week_budg; }else{  $week_budg = ''; } 
                    if(isset(${$weekday.'_cost'}) && ${$weekday.'_cost'} !== '' && ${$weekday.'_cost'} != 0) {    $week_cost = number_format(${$weekday.'_cost'}, 2, '.', ''); $totalCost += $week_cost; $week_cost = "$".$week_cost; }else{  $week_cost = ''; } 
                    if(isset(${$weekday.'_variance'}) && ${$weekday.'_variance'} !== '' && ${$weekday.'_variance'} != 0) {    $week_variance = number_format($week_variance = ${$weekday.'_variance'}, 2, '.', ''); $week_variance = "$".$week_variance; }else{  $week_variance = ''; } 
                    if(isset(${$weekday.'_percentage'}) && ${$weekday.'_percentage'} !== '' && ${$weekday.'_percentage'} != 0) { $week_percentage = number_format($week_percentage = ${$weekday.'_percentage'}, 2, '.', ''); $week_percentage = $week_percentage."%"; }else{  $week_percentage = ''; }
                    if(isset(${$weekday.'_hrs_allocated'}) && ${$weekday.'_hrs_allocated'} !== '') { $week_hrs_allocated = ${$weekday.'_hrs_allocated'};  }else{  $week_hrs_allocated = ''; }
                    if(isset(${$weekday.'_average_hr_rate'}) && ${$weekday.'_average_hr_rate'} != 0 && isset(${$weekday.'no_of_employee'}) && ${$weekday.'no_of_employee'} > 0) { $week_avg_hr_rate = ${$weekday.'_average_hr_rate'} / ${$weekday.'no_of_employee'};  
                    $extra_week_avg_hr_rate = ($week_avg_hr_rate*9.5)/100; $new_avg_hrs = $week_avg_hr_rate + $extra_week_avg_hr_rate;
                    $week_avg_hr_rate = number_format($week_avg_hr_rate, 2, '.', ''); $week_avg_hr_rate = "$".$week_avg_hr_rate; }else{  $week_avg_hr_rate = ''; } 

                    ?>
                <td>
                 <table class="sub-table">
                <tr><td class="left-align">Sales (ex GST) :</td><td class="right-align"> <?php echo $week_budg ?></td></tr>
                <tr><td class="left-align">Cost :</td><td class="right-align"> <?php echo $week_cost; ?></td></tr>
                <!-- <tr><td class="left-align">Variance :</td><td class="right-align"> <?php echo $week_variance; ?></td></tr> -->
                <tr><td class="left-align">Hours :</td><td class="right-align"> <?php echo $week_hrs_allocated; ?></td></tr>
                <?php if($this->session->userdata('supervisor') != 1) { ?>
                
                <?php } ?>
                <tr><td class="left-align">% :</td><td class="right-align"> <?php echo $week_percentage; ?></td></tr>
                <tr><td class="left-align">% :</td><td class="right-align"> <?php echo $week_percentage; ?></td></tr>
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
<div class="container ct-view-roster" style="width:100%;">
<div class="row weekday_line">
  <div class="ct-scroll">
	<table class="blueTable roster_records" >
   <thead>
   <tr>
   <?php
   $datee = new DateTime($start_date);
    $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuedate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   ?>


  <th>EMPLOYEE</th> <th>MON (<?php echo $mondate; ?> )</th>  <th >TUE (<?php echo $tuedate; ?> )</th>  <th>WED (<?php echo $weddate; ?> )</th>  <th>THU (<?php echo $thudate; ?> )</th> <th>FRI (<?php echo $fridate; ?> )</th> <th>SAT (<?php echo $satdate; ?> )</th> <th>SUN (<?php echo $sundate; ?> )</th>

</tr>
</thead>
<?php 

$week_days = array('mon','tues','wed','thus','fri','sat','sun');
$outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');;
?>
<input type="hidden" id="roster_group_id" value="<?php echo $roster_group_id; ?>">
	<?php 

	foreach($roster as $row){ ?>
<tbody>
<tr>

<td class="start_end" style="width:85px !important"><b></a><?php echo $row->emp_name; ?></b><p><?php echo "( ".str_replace('_', ' ', $row->emp_type). " )"; ?></p> <p><span><?php echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p></td>

<?php  for ($i = 0; $i < 7; $i++) { ?>
<td class="start_end">
<table class="sub-table">
<tr>
      <td class="child">Start</td>
      <td class="child">End</td>
      <td class="child">Break</td>
       <td class="child">Hrs</td>
      </tr>
<tr>
      <?php $start_nameofday = $week_days[$i].'_start_time'; ?>
      <?php $end_nameofday = $week_days[$i].'_end_time'; ?>
      <?php $break_nameofday = $week_days[$i].'_break_time'; ?>
       <?php $layout_nameofday = $outletweek_days[$i].'_layout'; ?>
    <?php 
$raw_start = $row->$start_nameofday ?? '';
$raw_end = $row->$end_nameofday ?? '';
$time1 = ($raw_start !== '' && $raw_start !== '0' && $raw_start !== 0) ? strtotime($raw_start) : false;
$time2 = ($raw_end !== '' && $raw_end !== '0' && $raw_end !== 0) ? strtotime($raw_end) : false;
$break_hrs = $row->$break_nameofday ?? 0;

if ($time1 !== false && $time2 !== false) {
    // Check if the end time is less than the start time (crosses midnight)
    if ($time2 < $time1) {
        // Add one day to the end time
        $time2 = strtotime('+1 day', $time2);
    }

    // Calculate the difference in seconds
    $difference_in_seconds = $time2 - $time1;

    // Convert seconds to hours
    $difference_in_hours = round($difference_in_seconds / 3600, 2);

    // Convert hours to minutes
    $hr_in_min = $difference_in_hours * 60;

    // Subtract break hours (which is in minutes)
    $difference = $hr_in_min - $break_hrs;

    // Convert minutes back to hours and minutes format (HH:MM)
    $hours = floor($difference / 60);
    $minutes = $difference - ($hours * 60);
    
    // Format the time as HH:MM
    $difference = sprintf('%02d:%02d', $hours, $minutes);
} else {
    $difference = '00:00'; // Default value if the time inputs are not set
}
?>

      <td class="child start_height"><?php if(empty($raw_start) && empty($raw_end)) { echo '   ';  } else {   echo date ('H:i A',strtotime($raw_start)); } ?></td>
      <td class="child start_height"><?php if(empty($raw_start) && empty($raw_end)) {  echo '   '; } else {   echo date ('H:i A',strtotime($raw_end)); }?></td>
      <td class="child start_height"><?php if(($row->$break_nameofday ?? 0) > 0) { echo $row->$break_nameofday;  } else {  echo '   '; }?></td>
      
      <td class="child"><?php echo $difference; ?></td>
      <!--<td class="child"><b><?php //echo "$ ".$total_pay; ?></b></td>-->
    
   </tr>
   <tr>
    <td colspan="4" class="child ct-font-td">Outlet</td>
   </tr>
   <tr>
   
   <td colspan="4" class="child start_height" style="word-wrap: break-all"><?php if(!empty($row->$layout_nameofday)) { echo $row->$layout_nameofday;  } else {  echo '   '; }?></td>
   
   </tr>
   </table></td>
   
  <?php } ?>
  <!--<td>-->
  <!--<?php // echo $week_earning; ?>-->
  <!--</td>-->

</tr>

</tbody>
<?php } ?>

<input type="hidden" id="total_hrs_of_all_employee" value='<?php echo $total_hrs_of_all_employee; ?>'>
<input type="hidden" id="total_cost" value='<?php echo $week_earning; ?>'>
<input type="hidden" id="total_budget" value="<?php echo $budget; ?>">
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
