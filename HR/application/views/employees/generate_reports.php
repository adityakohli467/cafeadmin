<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">

	<div class="row item">
			</div>

    
  <!--<form action="<?php echo base_url();?>index.php/admin/update_report" method="POST">-->
	<div  class="col-md-12 page-head border-bottom">
		<span class="text-center">
				<h3>Generate Reports</h3>
			</span>
			
				<a class="btn btn-success btn-ph" onclick="update_data()" style="position: relative !important;">Update</a>
						
				<!--<a class="btn btn-success btn-ph" onclick="export_data()" style="position: relative !important;">Export</a>-->
	
	</div><!--.col-md-12 -->


<div class="container ct-view-roster" style="max-width: 1350px !important;width:100%;">
<div class="row weekday_line">
  <div class="ct-scroll">
      <?php if(!isset($blank)) { ?>
     
    <form class="form-horizontal" id="report_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/add_report" enctype="multipart/form-data">
         <label>Report Name</label><input class="form-control" type="text" name="report_name" placeholder="Report name">
	<table class="blueTable" >
       <thead>
            <?php $week_days = array('mon','tues','wed','thus','fri','sat','sun'); ?>
           <tr>
               <th></th>
               <?php for($i=0;$i<7;$i++) { ?>
                <th style="text-align: center;"><?php echo strtoupper($week_days[$i]); ?></th>  
                <?php } ?>
                <th style="text-align: center;">TOTAL</th>
           </tr>
        </thead>
    
 
     <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
      <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
     
        <tbody>
            <tr>
                <th style="text-align: center; width: 30px;">SALES</th>
                <?php for($i=0;$i<7;$i++) { ?>
                 <td><input type="text" name="<?php echo $week_days[$i]; ?>_sales" value=""></td>
                <?php } ?>
             <td><input type="text" name="total_sales" value=""></td>
            </tr>
              <tr>
             <th style="text-align: center; width: 30px;">Catering Sales</th>.
              <?php for($i=0;$i<7;$i++) { ?>
             <td><input type="text" name="<?php echo $week_days[$i]; ?>_catering_sales" value=""></td>
              <?php } ?>
             <td><input type="text" name="total_catering_sales" value=""></td>
           
            </tr>
             <tr>
             <th style="text-align: center;">GST Free Sales </th>
              <?php for($i=0;$i<7;$i++) { ?>
                 <td><input type="text" name="<?php echo $week_days[$i]; ?>_sales_gst" value=""></td>
                <?php } ?>
             <td><input type="text" name="total_sales_gst" value=""></td>
           
            </tr>
             <tr>
             <th style="text-align: center;">Hours</th>
             <?php for($i=0;$i<7;$i++) { ?>
                <td><?php echo $total_hrs[$week_days[$i]]; ?><input type="hidden" name="<?php echo $week_days[$i]; ?>_hrs" value="<?php echo $total_hrs[$week_days[$i]]; ?>"></td>
            <?php } ?>
             <td><?php echo $total_hrsof_all_day; ?><input type="hidden" name="total_hrs" value="<?php echo $total_hrsof_all_day; ?>"></td>
             
            </tr>
             <tr>
             <th style="text-align: center;">Average H/R </th>
            <?php for($i=0;$i<7;$i++) { ?>
            <td><?php echo "$".$averate_rate[$week_days[$i]]; ?><input type="hidden" name="<?php echo $week_days[$i]; ?>_avg_rate" value="<?php echo $averate_rate[$week_days[$i]]; ?>"></td>
            <?php } ?>
            <td><?php echo "$". array_sum($averate_rate); ?><input type="hidden" name="total_avg_rate" value="<?php echo array_sum($averate_rate); ?>"></td>
             
            </tr>
             <tr>
             <th style="text-align: center;">Labour Cost </th>
              <?php for($i=0;$i<7;$i++) { ?>
            <td><?php echo "$".number_format($total_cost[$week_days[$i]],2); ?><input type="hidden" name="<?php echo $week_days[$i]; ?>_total_cost" value="<?php echo $total_cost[$week_days[$i]]; ?>"></td>
            <?php } ?>
             <td><?php echo "$".number_format(array_sum($total_cost),2); ?><input type="hidden" name="total_cost" value="<?php echo array_sum($total_cost); ?>"></td>
            
            </tr>
             <tr>
             <th style="text-align: center;">Labour %</th>
              <?php for($i=0;$i<7;$i++) { ?>
              <td></td>
                <?php } ?>
             <td></td>
            </tr>
          
          
        </tbody>
        </form>
  <?php } ?>
    </table>
  </div>
</div>
</div>
<script>

function update_data(){
    document.getElementById('report_add').submit();
return false;
  
}
</script>
</body>
</html>

