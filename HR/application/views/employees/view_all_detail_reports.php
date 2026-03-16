<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">

	<div class="row item">
			</div>

    
 <form action="<?php echo base_url();?>index.php/admin/update_report" method="POST">
	<div  class="col-md-12 page-head border-bottom">
		<span class="text-center">
				<h3>Reports  Data</h3>
			</span>
			
				<!--<a class="btn btn-success btn-ph" onclick="update_data()" style="position: relative !important;">Update</a>-->
						
				<!--<a class="btn btn-success btn-ph" onclick="export_data()" style="position: relative !important;">Export</a>-->
	
	</div>


<div class="container ct-view-roster" style="max-width: 1350px !important;width:100%;">
    <?php foreach($all_reports as $all_report){  ?>
    <div class="inner_content">
    <h4> <span>Report Name : <?php echo $all_report->report_name; ?></span> </h4>
    <h4> <span>From <?php echo date("d-m-Y", strtotime($all_report->start_date));  ?> </span> To  <?php echo date("d-m-Y", strtotime($all_report->end_date));  ?> </h2>
<div class="row weekday_line">
  <div class="ct-scroll">
	<table class="blueTable" style="box-shadow: 5px 5px #607D8B;">
       <thead>
           <tr>
               <?php $week_days = array('mon','tues','wed','thus','fri','sat','sun'); ?>
               <th></th>
               <?php for($i=0;$i<7;$i++) { ?>
                <th style="text-align: center;"><?php echo strtoupper($week_days[$i]); ?></th>  
                <?php } ?>
                <th style="text-align: center;">TOTAL</th>
                <th style="text-align: center;">TOTALS</th>
                 <th style="text-align: center;">VALUE</th>
              
                
           </tr>
        </thead>
<?php if(!isset($blank)) { ?> 

 
     <input type="hidden" name="start_date" value="<?php echo $all_report->start_date; ?>">
      <input type="hidden" name="end_date" value="<?php echo  $all_report->end_date; ?>">
        <tbody>
            <tr class="report_data">
             <th style="text-align: center; width: 30px;">SALES</th>
              <?php for($i=0;$i<7;$i++) {  ?>
             <td><?php if(isset($all_report->sales[$week_days[$i]]) && $all_report->sales[$week_days[$i]] !=0 && $all_report->sales[$week_days[$i]] != '') {  echo "$".$all_report->sales[$week_days[$i]]; } ?></td>
              <?php } ?>
             <td><input type="text" readonly name="total_sales" value="<?php  echo "$".number_format($all_report->sales['total_sales'],2); ?>"></td>
             <td><b>Sales</b></td>
             <td><?php  echo "$".number_format($all_report->sales['total_sales'],2); ?></td>
            </tr>
            
            <tr class="report_data">
            <th style="text-align: center; width: 30px;">CATERING SALES</th>
              <?php for($i=0;$i<7;$i++) {  ?>
              <td><?php if(isset($all_report->catering_sales[$week_days[$i]]) && $all_report->catering_sales[$week_days[$i]] !=0 && $all_report->catering_sales[$week_days[$i]] != '') {  echo "$".$all_report->catering_sales[$week_days[$i]]; } ?></td>
              <?php } ?>
             <td><input type="text" readonly  value="<?php  echo "$".number_format($all_report->catering_sales['total_catering_sales'],2); ?>"></td>
               <td><b>Catering Sales</b></td>
             <td><?php   echo "$".number_format($all_report->catering_sales['total_catering_sales'],2); ?></td>
            </tr>
            
             <tr class="report_data">
             <th style="text-align: center;">GST Free Sales</th>
             
             <?php for($i=0;$i<7;$i++) {  ?>
             <td><?php if(isset($all_report->sales_gst[$week_days[$i]]) && $all_report->sales_gst[$week_days[$i]] !=0 && $all_report->sales_gst[$week_days[$i]] != '') {  echo "$".$all_report->sales_gst[$week_days[$i]]; } ?></td>
                 <?php } ?>
             <td><input type="text" readonly name="total_sales_gst" value="<?php if($all_report->sales_gst['total_sales_gst'] !=0 && $all_report->sales_gst['total_sales_gst'] != '') { echo "$".number_format($all_report->sales_gst['total_sales_gst'],2); } ?>"></td>
               <td><b>Catering Sales</b></td>
             <td><?php  echo "$".number_format($all_report->catering_sales['total_catering_sales'],2); ?></td>
             

            </tr>
             <tr class="report_data">
             <th style="text-align: center;">Hours</th>
             <?php for($i=0;$i<7;$i++) {  ?>
             <td><?php if(isset($all_report->hours[$week_days[$i]]) && $all_report->hours[$week_days[$i]] !=0 && $all_report->hours[$week_days[$i]] != '') {  echo $all_report->hours[$week_days[$i]]; } ?></td>
                 <?php } ?>
          
             <td><?php if($all_report->hours['total_hrs'] !=0 && $all_report->hours['mon'] != '') { echo $all_report->hours['total_hrs']; } ?></td>
             
          <td><b>Total</b></td>
             <td><?php $total_sales_catering  = $all_report->catering_sales['total_catering_sales'] + $all_report->sales['total_sales']; echo "$".number_format($total_sales_catering,2);  ?></td>
             
             
            </tr>
             <tr class="report_data">
             <th style="text-align: center;">Average H/R</th>
             <?php for($i=0;$i<7;$i++) {  ?>
             <td><?php if(isset($all_report->average_hours[$week_days[$i]]) && $all_report->average_hours[$week_days[$i]] !=0 && $all_report->average_hours[$week_days[$i]] != '') {  echo $all_report->average_hours[$week_days[$i]]; } ?></td>
                 <?php } ?>
             <td><?php if($all_report->average_hours['total_averate_rate'] !=0 && $all_report->average_hours['total_averate_rate'] != '') { echo $all_report->average_hours['total_averate_rate']; } ?></td>
             
              <td><b>Sales Less Gst</b></td>
             <td><?php  echo "$".number_format($all_report->sales_gst['total_sales_gst'],2); ?></td>
             
           
            </tr>
             <tr class="report_data">
             <th style="text-align: center;">Labour Cost </th>
              <?php for($i=0;$i<7;$i++) {  ?>
             <td><?php if(isset($all_report->labour_cost[$week_days[$i]]) && $all_report->labour_cost[$week_days[$i]] !=0 && $all_report->labour_cost[$week_days[$i]] != '') {  echo "$".$all_report->labour_cost[$week_days[$i]]; } ?></td>
                 <?php } ?>
             <td><?php if($all_report->labour_cost['total_labour_cost'] !=0 && $all_report->labour_cost['total_labour_cost'] != '') {  echo "$".number_format($all_report->labour_cost['total_labour_cost'],2); } ?></td>
              <td><b>Labour Cost</b></td>
             <td><?php echo "$".number_format($all_report->labour_cost['total_labour_cost'],2); ?></td>
            </tr>
             <tr class="report_data">
             <th style="text-align: center;">Labour %</th>
          <?php for($i=0;$i<7;$i++) {  ?>
    <td><?php if(isset($all_report->labour_percent[$week_days[$i]]) && $all_report->labour_percent[$week_days[$i]] !=0 && $all_report->labour_percent[$week_days[$i]] != '') { echo number_format($all_report->labour_percent[$week_days[$i]],2)."%"; } ?></td>
          <?php } ?>
    <td><?php if(isset($all_report->labour_percent['mon']) && $all_report->labour_percent['total_percentage'] !=0 && $all_report->labour_percent['total_percentage'] != '') { echo number_format($all_report->labour_percent['total_percentage'],2)."%";  } ?></td>
             <td></td>
             <td></td>
            </tr>
            
           
        </tbody>
     
  <?php } ?>
    </table>
  </div>
</div>
</div></br></br>
<?php } ?>
</div>
<style>
.report_data td{
       text-align: left !important;
}
</style>
<script>

function update_data(){
    
    
    document.getElementById('report_add').submit();
return false;
  
}
function export_data(){
var report_id = "<?php echo $report_id; ?>";

      $.ajax({
		url:"<?php echo base_url();?>index.php/admin/export_report",
		method:"POST",
		data:{
		    report_id:report_id,
		   
		    },
	    success: function () {
            window.open(this.url,'_blank' );
        }
        });
    
}
</script>
</body>
</html>

