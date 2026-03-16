<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">



                  
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
				    
                  <span class="text-center">
						<h3>Employee Roster Report</h3>
							</span>	
								<span class="extra_icons">
			
		<a href="javascript:capture();" ><i class="material-icons" data-toggle="tooltip" title="Download Report">&#xf090;</i></a>
			</span>
						</div>
 
<div class="container-fluid" style="background-color:#fff;">
        <div class="table-wrapper">
            
			 <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url(); ?>index.php/admin/employee_roster_reports" method="post">
									<div class="row">
									  	
									
										<div class="col-12 col-md-2">
											<input class="form-control datepicker" name="start_date" id="start_date" type="date" placeholder="Start Date">
										</div>
									
									<div class="col-12 col-md-2">
											<input class="form-control datepicker" name="end_date" id="end_date" type="date" placeholder="End Date">
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control " id="emp_email" name="emp_email"  type="text" placeholder="Empoloyee Email">
										</div>
										<div class="col-12 col-md-1">
										    <button type="submit" class="btn btn-primary"  value="Download Roster Report" >View Roster Report</button>
											
											</div>
									</div>
									
								
								</form>
							</div>
						</div> 
						</div>
						 </div>
						 
	<div class="container ct-view-roster main-container" style="width:100%;">
	    <div class="row weekday_line">
		     <div class="ct-scroll">
		         <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $empName; ?></td>
      <td><?php echo $Email; ?></td>
      <td><?php echo $start_date; ?></td>
      <td><?php echo $end_date; ?></td>
     
    </tr>
  </tbody>
</table>
	<table class="blueTable roster_records" >
   <thead>
   <tr>
  
   


  <th>Roster Name</th> <th>MON </th>  <th >TUE </th>  <th>WED </th>  <th>THU </th> <th>FRI </th> <th>SAT </th> <th>SUN </th>

</tr>
</thead>
<?php 

$week_days = array('mon','tues','wed','thus','fri','sat','sun');
$outletweek_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');;
?>
<input type="hidden" id="roster_group_id" value="<?php echo $roster_group_id; ?>">
	<?php 
if(!empty($roster)){
    
   
	foreach($roster as $row){ ?>
<?php	$CurrentRosterStartdatee = date('j F Y', strtotime($row->start_date));
        $CurrentRosterend_datee = date('j F Y', strtotime($row->end_date));
	?>
<tbody>
<tr>

<td class="start_end" ><b></a><?php echo $row->roster_name; ?><br></br>(<?php echo $CurrentRosterStartdatee ." to ".$CurrentRosterend_datee  ?>)</b>
<!--<p><span><?php // echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p>-->
</td>

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
      $time1 = strtotime($row->$start_nameofday);
      $time2 = strtotime($row->$end_nameofday);
      $break_hrs = $row->$break_nameofday;
      if($time2 !='' && $time1 !=''){
         $difference = round(abs(($time2 - $time1)) / 3600,2);
     $hr_in_min = $difference* 60;

     $difference = $hr_in_min - $break_hrs;
      $difference = floor($difference / 60).':'.($difference -   floor($difference / 60) * 60);  
      }else{
          $difference = 0;
      }
    
     ?>
      <td class="child start_height"><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i A',strtotime($row->$start_nameofday)); } ?></td>
      <td class="child start_height"><?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i A',strtotime($row->$end_nameofday)); }?></td>
      <td class="child start_height"><?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday;  } else {  echo '   '; }?></td>
      
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


</tr>

</tbody>
<?php } } ?>


</table>
         </div>
		 </div>
       </div> 
    

	


<script type="text/javascript">

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
      a.setAttribute('download', 'Roster_Employee_Report.png')
      a.setAttribute('href', image)
      a.click()
      canvas.remove()
    })
}


$( function() {
    $( "#datepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

 $( "#datepicker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
});


  } );

</script>



