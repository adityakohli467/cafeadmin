
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">

<style>
.ct-table, .ct-scroll {
    overflow: auto;
}
.ct-outlet{
min-width:80px;
}

@media (min-width: 1200px){
.roster-dt input.form-control, .roster-nm input.form-control {
    width: 100% !important; 
    font-size: 13px;
}
}
 .roster_records th{
           text-align: center !important;
           font-weight: 400 !important; 
            }
.ct-scroll .customReportDisplayTable thead th {

    padding: 0.75rem !important;
    text-align: center !important;
}
.ct-scroll table thead th {
    background-color: #042462 !important;
    width: 100px;
}
.ct-scroll .customReportDisplayTable tbody th,.ct-scroll .customReportDisplayTable tbody td {
    padding: 0.75rem !important;
    text-align: center !important;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-size: 1rem;
    line-height: 1.5;
    color: #000000;
}
.ct-scroll .customReportDisplayTable tbody th {
    padding: 0.75rem !important;
    text-align: center !important;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.5;
    color: #000000;
}
body .roster-nm input.form-control{
        margin-left: 10px !important;
  
    border-radius: 7px !important;
    color: black !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    border-bottom: 0px !important;
    padding: 10px !important;
}
</style>
<div class="overlayplaceorder" id='overlayplaceorder'></div>
	<div class="main-container">
	<div class="row item">
			</div>

	<div  class="col-md-12 page-head border-bottom">
		<span class="text-center">
				<h3>VIEW ROSTER</h3>
			</span>
			<?php if($role =='manager' || $role =='admin'){ ?>
				<span class="extra_icons">
				<a href="javascript:send_email();"><i class="material-icons" data-toggle="tooltip" title="Mail">&#xe158;</i></a>
				<a href="javascript:capture();" ><i class="material-icons" data-toggle="tooltip" title="Download page image">&#xf090;</i></a>
		         <a href="javascript:window.print();" ><i class="material-icons" data-toggle="tooltip" title="Print">&#xe8ad;</i></a>
		         <a onclick="save_weekly_report()" href="#" ><i class="material-icons" data-toggle="tooltip" title="Save weekly report">&#xe161;</i></a>
			</span>
	 <?php } ?>
	</div><!--.col-md-12 -->
	<?php $week_days = array('mon','tues','wed','thus','fri','sat','sun'); $count = 0; 
	$outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
	<?php 	foreach($roster as $key=>$roster_value){ 

	
	?>
   <div class="container ct-view-roster ct-view-roster1 ct-all" style="width:100%;">
 
		<div class="form-group roster-nm">
    		<div class="dt-inner">
             <span class="budget_span"> Roster Name:  </span> <span class="budget_span_value"> <input  id="budget_input_<?php echo $key?>" readonly class="form-control week_roster_name" type="text" value="<?php echo (isset($roster_value[0]->roster_name)) ? $roster_value[0]->roster_name : ''; ?>"></span>
    		 </div>
		</div>
		
		<div class="form-group roster-dt">
        	<div class="dt-inner">
                 <span class="budget_span"> Start Date:  </span> <span class="budget_span_value"> <input  id="start_<?php echo $key?>" readonly class="form-control roster_start_date" type="text" value="<?php echo (isset($roster_value[0]->start_date)) ? $roster_value[0]->start_date : ''; ?>"></span>
        	</div>
    	    <div class="dt-inner">
             <span class="budget_span"> End Date:  </span> <span class="budget_span_value"> <input  id="end_<?php echo $key?>" readonly class="form-control roster_end_date" type="text" value="<?php echo (isset($roster_value[0]->end_date)) ? $roster_value[0]->end_date : ''; ?>"></span>
    		 </div>
		</div>
		<?php if($role =='manager' || $role =='admin'){ ?>
		 <?php if($count < 1){ ?>
		 
		 <div class="form-group roster-dt">
    		<div class="dt-inner">
             <span class="budget_span"> Proj. Sales:  </span> <span class="budget_span_value"> <input  id="budget_input_<?php echo $key?>" readonly class="form-control" type="text" value="<?php echo (isset($budget) && $budget != '') ? '$'.$budget.'.00' : ''; ?>"></span>
    		 </div>
            <div class="dt-inner">
        	  <span class="budget_span"> Cost:  </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="totall_cost_<?php echo $key?>" value="<?php echo (isset($week_earning)) ? '$'.$week_earning : ''; ?>" readonly></span>
        	</div>
	    </div>
	  
     <?php } ?>
      <?php } ?>
    
 <?php if($role =='manager' || $role =='admin'){ ?>
		 <?php if($count < 1){ ?>
	    <div class="dt-outer">
        	  <div class="form-group roster-dt">
            	  <!-- <div class="dt-inner">
            	 <span class="budget_span">Variance: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="balance_<?php echo $key?>" value="<?php echo "$".$variance; ?>" readonly></span>
            	 </div>  -->
            	 
            	 <div class="dt-inner">
            	  <span class="budget_span">Hours Allocated: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="hours_worked_<?php echo $key?>" value="<?php echo (isset($total_hrs_of_all_emp_of_this_roster)) ? $total_hrs_of_all_emp_of_this_roster : ''; ?>" readonly></span>
            
                 </div>
                 </div>
        </div> 
        <div class="form-group roster-nm">
                 <div class="dt-inner">
            	  <span class="budget_span">Budget/Cost Percentage: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="Percentage_<?php echo $key?>" value="<?php echo (isset($percenatge)) ? $percenatge. ' %' : ''; ?>" readonly></span>
                 </div> 
            </div>
    
     <?php } ?>
      <?php } ?>
    
</div>
<?php if($role =='manager' || $role =='admin'){ ?>
		 <?php if($count < 1){ ?>
		 <div class="container">
<div class="form-group roster-nm">
                 <div class="dt-inner">
            	  <span class="budget_span">Search</span> <span class="Emp_name_search"> 
            	  <input class="form-control" type="text" id="search-box" placeholder="Search Emp. Name" autocomplete="off">
            	  <div id="suggesstion-box"></div>
            	  </span>
              <a onClick="window.location.reload();">clear</a>
                 </div> 
            </div>
            </div>
               <?php } } ?>
<!-- monthly budget -->
<?php if($role =='manager' || $role =='admin'){ 
    if($count < 1){ 
?>
<div class="container ct-view-roster" style="width:100%;">
    <div class="row weekday_line">
        <div class="ct-scroll">
        <form id="weekly_report">
            
            <table class="table-striped table-bordered customReportDisplayTable">
                <thead>
                <tr>
                <th></th>
                <th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th><th>Total</th>
                </tr>
                </thead>
                <tbody>
                <!--<td style="width:85px !important"><strong>Daily Sales and Labour Cost Projections</strong></td>-->
               
                <?php
                     $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                     $totalSales = 0;
                     $totalCost = 0;
                     
                     $WeeklyReportData = array();
                    foreach($weekdays as $weekday){
                    $index_name = $weekday.'_budget';
                    
                    if(${$weekday.'_budget'} !='') {    $week_budg = number_format(${$weekday.'_budget'}, 2, '.', ''); $totalSales += $week_budg;  $week_budg = $week_budg; }else{  $week_budg = ''; } 
                    if(${$weekday.'_cost'} !='') {    $week_cost = number_format(${$weekday.'_cost'}, 2, '.', ''); $totalCost += $week_cost; $week_cost = "$".$week_cost; }else{  $week_cost = ''; } 
                    if(${$weekday.'_cost'} !='') {    $weekLabour_cost = number_format(${$weekday.'_cost'}, 2, '.', ''); $labourCost = ($weekLabour_cost*10.5)/100; $superTen = $labourCost;  $LabourCost = $weekLabour_cost + $labourCost; }else{  $LabourCost = ''; $superTen = ''; } 
                    if(${$weekday.'_variance'} !='') {    $week_variance = number_format($week_variance = ${$weekday.'_variance'}, 2, '.', ''); $week_variance = "$".$week_variance; }else{  $week_variance = ''; } 
                    if(${$weekday.'_hrs_allocated'} !='') { $week_hrs_allocated = ${$weekday.'_hrs_allocated'};  }else{  $week_hrs_allocated = ''; }
                    if(${$weekday.'_average_hr_rate'} !='') { $week_avg_hr_rate = ${$weekday.'_average_hr_rate'} / ${$weekday.'no_of_employee'};  
                    $extra_week_avg_hr_rate = ($week_avg_hr_rate*9.5)/100; $new_avg_hrs = $week_avg_hr_rate + $extra_week_avg_hr_rate;
                    $week_avg_hr_rate = number_format($week_avg_hr_rate, 2, '.', ''); $week_avg_hr_rate = "$".$week_avg_hr_rate; }else{  $week_avg_hr_rate = ''; } 
                    
                    if(isset($week_budg)){
                       $WeeklyReportData[$weekday.'_budget'] = $week_budg;
                    }
                    if(isset($week_cost)){
                       $WeeklyReportData[$weekday.'_cost'] = $week_cost;
                    }
                     if(isset($superTen)){
                       $WeeklyReportData[$weekday.'_superten'] = $superTen;
                    }
                    if(isset($LabourCost)){
                       $WeeklyReportData[$weekday.'_LabourCost'] = $LabourCost;
                    }
                    if(isset($week_variance)){
                       $WeeklyReportData[$weekday.'_variance'] = $week_variance;
                    }
                    if(isset($LabourCost) && isset($superTen) && isset($week_budg)){
                        $week_percentage =  ($LabourCost + $superTen)/$week_budg;
                       $WeeklyReportData[$weekday.'_percentage'] = $week_percentage;
                    }
                    if(isset($week_budg)){
                       $WeeklyReportData[$weekday.'_hrs_allocated'] = $week_hrs_allocated;
                    }
                    
                   
                    ?>
                    
                    <input type="hidden" name="<?php echo $weekday.'_sales' ?>" value="<?php echo $week_budg; ?>">
                            <input type="hidden" name="<?php echo $weekday.'_cost' ?>" value="<?php echo $week_cost; ?>">
                            <input type="hidden" name="<?php echo $weekday.'_variance' ?>" value="<?php echo $week_variance; ?>">
                            <input type="hidden" name="<?php echo $weekday.'_percentage' ?>" value="<?php echo $week_percentage; ?>">
                            <input type="hidden" name="<?php echo $weekday.'_hrs_allocated' ?>" value="<?php echo $week_hrs_allocated; ?>">
                            <input type="hidden" name="<?php echo $weekday.'_avg_hrs' ?>" value="<?php echo $week_avg_hr_rate; ?>">
                            
            	    <?php } ?>
            	    
            <tr>
            <th >Sales (ex GST)</th>
            <?php foreach($weekdays as $weekday){ ?>
            <td><?php echo $WeeklyReportData[$weekday.'_budget']; ?></td>
               <?php } ?>
             <td class="right-align"> <?php echo "$".$totalSales ?></td>  
            </tr>
            
             <tr>
            <th >Hours</th>
            <?php foreach($weekdays as $weekday){ ?>
            <td><?php echo $WeeklyReportData[$weekday.'_hrs_allocated']; ?></td>
               <?php } ?>
            <td class="right-align"> <?php echo $total_hrs_of_all_emp_of_this_roster ?></td>   
            </tr>
            
             <tr>
            <th >Cost</th>
            <?php foreach($weekdays as $weekday){ ?>
            <td><?php echo $WeeklyReportData[$weekday.'_cost']; ?></td>
               <?php } ?>
            <td class="right-align"> <?php echo "$".$totalCost ?></td>   
            </tr>
              <tr>
            <th >Super (10.5%)</th>
            <?php $allDaySuperTen = 0; foreach($weekdays as $weekday){ ?>
            <td><?php echo number_format($WeeklyReportData[$weekday.'_superten'],2);  $allDaySuperTen +=$WeeklyReportData[$weekday.'_superten']; ?></td>
               <?php } ?>
            <td class="right-align"> <?php echo "$".number_format($allDaySuperTen,2) ?></td>   
            </tr>
              <tr>
            <th >Labour Cost</th>
            <?php $allDayLabourcost = 0; foreach($weekdays as $weekday){ ?>
            <td><?php echo number_format($WeeklyReportData[$weekday.'_LabourCost'],2);  $allDayLabourcost +=$WeeklyReportData[$weekday.'_LabourCost']; ?></td>
               <?php } ?>
            <td class="right-align"> <?php echo "$".number_format($allDayLabourcost,2) ?></td>   
            </tr>
            
            
             <tr>
            <th >Percentage</th>
            <?php 
            $allDayPErcentage = 0;
            foreach($weekdays as $weekday){
           $todaysPercentage =  ($WeeklyReportData[$weekday.'_budget']*$WeeklyReportData[$weekday.'_percentage'])/100;
           (float)$allDayPErcentage += (float)$todaysPercentage;
           ?>
            <td><?php echo number_format($todaysPercentage,2)."%";  ?></td>
               <?php } ?>
            <td class="right-align"> <?php  echo number_format($allDayPErcentage,2)."%"; ?></td>   
            </tr>
                   
                          
                         
                          
                            
            	   <!-- <td>-->
                <!-- <table class="sub-table">-->
                <!--<tr><td class="left-align">Super (10.5%)  :</td><td class="right-align"> <?php $labourCost = (($totalCost*10.5)/100)+$totalCost; echo number_format(($totalCost*10.5)/100,2) ?></td></tr>-->
                <!-- <tr><td class="left-align">Labour Cost  :</td><td class="right-align"> <?php echo "$".number_format($labourCost,2) ?></td></tr>-->
                <!-- </table>-->
                <!--</td>-->
            	    
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>    
<br>
<?php } } ?> 
<?php
     $datee = new DateTime($roster_value[0]->start_date);
     $mondate =  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuedate =  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   ?>
<div class="container ct-view-roster ct-input" style="width:100%;">
<div class="row weekday_line">
<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_multiple_roster" enctype="multipart/form-data">
<?php if($role =='manager' || $role =='admin'){ ?>
 <div style="margin:0 0 25px 0;display: flex;" class="hidethesebtn">
        <input type="submit" value="Update" class="btn btn-success btn-ph btn-height ">
        <a class="btn btn-success btn-ph btn-height" onclick='make_field_editable(this)' >Edit</a>
    </div>
    <?php } ?>
  <div class="ct-scroll">
  
	<table class="blueTable roster_records">
   <thead class="loaded_header">
   <tr>
  <th>EMPLOYEE</th> <th>MON (<?php echo $mondate; ?> )</th>  <th >TUE (<?php echo $tuedate; ?> )</th>  <th>WED (<?php echo $weddate; ?> )</th>  <th>THU (<?php echo $thudate; ?> )</th> <th>FRI (<?php echo $fridate; ?> )</th> <th>SAT (<?php echo $satdate; ?> )</th> <th>SUN (<?php echo $sundate; ?> )</th>
</tr>
</thead>
<tbody class="nonfilter_result_rosterEmp">

<?php 


foreach($roster_value as $row){ ?>

    <input type='hidden' class="form-control" name="roster_id[]" value="<?php echo $row->roster_id; ?>" >
	<input type='hidden' class="form-control" name="roster_group_id" value="<?php echo $row->roster_group_id; ?>" >
	<input type='hidden' class="form-control" name="edit_view_all_roster" id="roster_group_id" value='<?php echo $all_roster_group_ids; ?>' >
	
<tr>
<td class="start_end" style="width:85px !important"><b></a><?php echo $row->emp_name; ?></b> <p><?php echo "( ".$row->emp_type. " )"; ?></p><p><span><?php echo $row->emp_hours_worked_this_week; ?></span></p></td>

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
      <?php $start_name = $week_days[$i].'_start[]'; ?>
      <?php $end_name = $week_days[$i].'_end[]'; ?>
      <?php $break_name = $week_days[$i].'_break[]'; ?>
      <?php $outlet_name = $week_days[$i].'_layout[]'; ?>
      <?php $end_nameofday = $week_days[$i].'_end_time'; ?>
      <?php $break_nameofday = $week_days[$i].'_break_time'; ?>
       <?php $layout_nameofday = $outletweek_days[$i].'_layout'; ?>
     
      <?php 
      $time1 = strtotime($row->$start_nameofday);
      $time2 = strtotime($row->$end_nameofday);
      $break_hrs = $row->$break_nameofday;
      if($time2 !='' && $time1){
       $difference = round(abs(($time2 - $time1)) / 3600,2);
     $hr_in_min = $difference* 60;
     $difference = $hr_in_min - $break_hrs;
      $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);    
      }else{
          $difference = 0;
      }
    
     ?>
     
      <td class="child start_height date datetimepicker3">
     
      <input class="editable_field" readonly type='text' name="<?php echo $start_name;  ?>" value="<?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i',strtotime($row->$start_nameofday)); } ?>">
     </td>
      
      <td class="child start_height date datetimepicker3">
      <input  class="editable_field" type='text' readonly name="<?php echo $end_name;  ?>" value="<?php if($row->$end_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i',strtotime($row->$end_nameofday)); }?>">
      </td>
      
      <td class="child start_height">
     <input  class="editable_field" type='text' readonly name="<?php echo $break_name;  ?>" value="<?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday ;  } else {  echo '   '; }?>"> 
      </td>
      
      <td class="child start_height"><?php echo $difference; ?></td>
     
   </tr>
   <tr>
        <td colspan="4" class="child ct-font-td">Outlet</td>
    </tr>
    
   <tr>      
        <td colspan="4" class="child start_height ct-outlet">
        <input class="editable_field" type='text' readonly name="<?php echo $outlet_name;  ?>" value="<?php if(!empty($row->$layout_nameofday)) { echo $row->$layout_nameofday;  } else {  echo '   '; }?>">
    </td>
    </tr>
   </table>
   </td>
   <?php } ?>
   
</tr>
  <?php $count++; } ?>

</tbody>
<tbody id="filter_result_rosterEmp">
    
</tbody>
</table>

    </div>
    	
	</form>

    </div>
    </div>
    <?php } ?>

  <br>
</div>	
</body>
<script>
function capture() {
  const captureElement = document.querySelector('.main-container')
  html2canvas(captureElement)
    .then(canvas => {
      canvas.style.display = 'none'
      document.body.appendChild(canvas)
      return canvas
    })
    .then(canvas => {
      const image = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream')
      const a = document.createElement('a')
      a.setAttribute('download', 'Roster_Employee_Details.png')
      a.setAttribute('href', image)
      a.click()
      canvas.remove()
    })
}



// AJAX call for autocomplete 
$(document).ready(function(){

	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url:"<?php echo base_url();?>index.php/admin/selectEmployeeName",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectEmployeeName(empfull_name) {
    
    var RGID='<?php echo $all_roster_group_ids; ?>';
    var name_ID = empfull_name.split('_');
    var EMPID = name_ID[0];

$("#search-box").val(name_ID[1]);
$("#suggesstion-box").hide();

$.ajax({
		type: "POST",
		url:"<?php echo base_url();?>index.php/admin/fetchemp",
		data:'RGID='+RGID+'&EMPID='+EMPID,
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
		    
			$("#filter_result_rosterEmp").html(data);
		    $(".nonfilter_result_rosterEmp").css("display","none");
		    $(".hidethesebtn").css("display","none");
		  //  $(".ct-all").css("display","none");
		 
		}
		});

}

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

function save_weekly_report(){
   var roster_start_date = $(".roster_start_date").val();
   var roster_end_date = $(".roster_end_date").val();
   var week_roster_name = $(".week_roster_name").val();
   var form_data = $('#weekly_report').serialize();
   
   console.log(form_data);
      $.ajax({
		url:"<?php echo base_url();?>index.php/admin/save_weekly_report",
		method:"POST",
		data : $('#weekly_report').serialize()+"&start_date="+roster_start_date+"&end_date="+roster_end_date+"&week_roster_name="+week_roster_name,
	    success:function(data){
	      swal({
                text: "Roster Weekly Report Saved !",
                 icon: "success",
          });

			}
	});
}


 $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm'
                });
                
function make_field_editable(obj){
$(obj).parents(".weekday_line").find(".editable_field").removeAttr("readonly");
$(obj).parents(".weekday_line").find(".start_height ").css("border","2px solid #1b1818");
$(obj).parents(".weekday_line").find(".editable_field:first").focus();

}

var budget = Number.parseFloat($("#total_budget").val());
var cost = Number.parseFloat($("#total_cost").val());
var balance = Number(budget) - Number(cost) ;

$("#totall_cost").val('$'+cost.toFixed(2));
if(Number(budget) < Number(cost)){
$("#balance").val('<font color="red">$'+balance.toFixed(2)+'</font>');
}else{
$("#balance").val('$'+balance.toFixed(2));
}

$("#hours_worked").val($("#total_hrs_of_all_employee").val());

</script>
</html>
