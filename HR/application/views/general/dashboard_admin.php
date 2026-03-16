
<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<span class="text-center" >
			<h3 style="font-weight: 800;">DASHBOARD</h3>
		</span>
	</div>
	<div class="btn-div col-md-3">
	</div>

</div><!--.col-md-12 -->
<div class="container-fluid main-container">
	<div class="row">

		<div class="col-lg-6 col-md-12 table100 ver2">
		    <h2 class="heading_dash">LATEST LEAVE REQUESTS </h2>
			<div class="ct-table">
          <table data-vertable="ver2" class="rec-leaves">
				<thead>
							<tr class="row100 head">
							
								<th class="column100 column2" data-column="column2"><span>Employee Name</span></th>
								<th class="column100 column3" data-column="column3"><span>Leave Type</span></th>
								<th class="column100 column4" data-column="column4"><span>Start Date</span></th>
								<th class="column100 column5" data-column="column5"><span>End Date</span></th>
								<th class="column100 column6 ct-status" data-column="column6"><span>Status</span></th>
								
							</tr>
						</thead>
				<tbody id="branch_suppliers">
				<?php
				$i = 0;
				foreach($leaves as $row){ 
				    $i++;
				    if($i < 6){
				            if($row->leave_status == 'Pending'){
								$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";								
								$btn_name = "Pending";
							}else if($row->leave_status == 'Approve'){
								$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";
								$btn_name = "Approved"; 
							}
							else if($row->leave_status == 'Comment'){
								$color = "class='btn btn-warning cxs-btn c-btn btn-xs btn-block'";
								$btn_name = "Comments Added";
							}
							if($row->leave_status == 'Reject'){
								$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";								
								$btn_name = "Rejected";
							}
				?>
					<tr class="row100">
			
		<td class="column100 column1" data-column="column1"><span><a href="<?php echo base_url(); ?>index.php/admin/manager_leave_update/<?php echo $row->leave_id ?>"><?php echo $row->first_name; ?></a></span></td>
		<td class="column100 column2" data-column="column2"><span><?php echo $row->leave_type; ?></span></td>
		<td class="column100 column3" data-column="column3"><span><?php echo  date('d-m-Y',strtotime($row->start_date)); ?></span></td>
		<td class="column100 column4" data-column="column4"><span><?php echo date('d-m-Y',strtotime($row->end_date)); ?></span></td>
								
		<td class="column100 column6 ct-status" data-column="column6"><span><div <?php echo $color; ?> class="status-color"><?php echo $btn_name;  ?></div></span></td>
							
							</tr>
				<?php } } ?>
				</tbody>
			</table>
		</div>
		</div>
				<div class="col-lg-6 col-md-12 table100 ver2">
				    <h2 class="heading_dash">LATEST ROSTERS </h2>
					<div class="ct-table">
           <table data-vertable="ver2" class="rec-roster">
				<thead>
				    
							<tr class="row100 head">
							     <th class="column100 column2" data-column="column2"><span>Roster Name</span></th>
								<th class="column100 column2" data-column="column2"><span>Start Date</span></th>
								<th class="column100 column3" data-column="column3"><span>End Date</span></th>
								<th class="column100 column4 w-70 ct-status" data-column="column4"><span>View</span></th>
								<?php if($role !='employee') { ?>                     
								<th class="column100 column5 ct-status" data-column="column5"><span>Re-Create</span></th>
									<?php } ?>
								
								
							</tr>
						</thead>
				<tbody id="branch_suppliers">
				<?php foreach($roster as $row){ ?>
					<tr class="row100">
			<td class="column100 column1" data-column="column1"><span><?php echo $row->roster_name; ?></span></td>	
		<td class="column100 column1" data-column="column1"><span><?php echo date("d-m-Y", strtotime($row->start_date)); ?></span></td>
		<td class="column100 column2" data-column="column2"><span><?php echo date("d-m-Y", strtotime($row->end_date)); ?></span></td>
<td class="column100 column3 w-70 ct-status" data-column="column3"><span>
		    <?php if($row->roster_template == 1){ ?>
                                <a href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/view">View</a>
                               <?php }else{ ?>
                               <a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/view">View</a>
                               <?php } ?>
                               
		    </span></td>			<?php if($role !='employee') { ?>
<td class="column100 column4 ct-status" data-column="column4"><span>
		    <?php if($row->roster_template == 1){ ?>
                                <a href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/recreate">Re Create</a>
                               <?php }else{ ?>
                               <a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/recreate">Re Create</a>
                               <?php } ?>
                               

		    </span></td>			<?php } ?>
								
		
							
							</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
		 
	</div>
	<div class="row">
	    
	    <div class="col-lg-6 col-md-12" style="chart-section">
						<div class="cmsp">
                            <div class="panel">
									 <h2 class="heading_dash"> ROSTER PERFORMANCE FOR THE LAST FOUR WEEKS</h2>
                                <div class="panel-body p-body">
																	
								<div class="px-4">
									<canvas style="height: 370px; width: 100%;" id="myChart3" height="400"></canvas>
								</div>
							</div>
						</div>
					</div>

					

					
				</div>
					</div>
</div>
<br>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php $colors=array(
'Week_1'=>'#ecb965',
'Week_2'=>'#f8996e',
'Week_3'=>'#fc7579',
'Week_4'=>'#fc5a85',

);?>
<script>
var ctx = document.getElementById('myChart3').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
	labels: [<?php $a=[];foreach($roster_report as $c){$a[]="'".$c['label']."'";}$label = implode(",",$a);  echo $label = str_replace('_', ' ', $label);?>],
	datasets: [{
		label: 'Weekly Benefit $',
		data: [<?php $a=[];foreach($roster_report as $c){$a[]=$c['y'];} echo $benefit = implode(",",$a);   ?>],
		backgroundColor: [
			<?php foreach($roster_report as $c) echo "'".$colors[$c['label']]."',";?>
		],
		borderWidth: 0
	}]
},
options: {
	maintainAspectRatio: false,
	legend: {
		display: true
	},
	scales: {
		xAxes: [{
			display: true
		}],
		yAxes: [{
			display: true
		}]
	},
	height:'300px',
	titles:{
		display:false
	}

}
});


</script>
<style>
.canvasjs-chart-credit{
    display:none !important;
}
</style>