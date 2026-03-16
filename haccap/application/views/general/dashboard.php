
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
<div class="container-fluid main-container emp-dashboard">
	<div class="row">

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
				<?php if(!empty($roster)){ foreach($roster as $row){ ?>
					<tr class="row100">
		<td class="column100 column1" data-column="column1"><span><?php echo $row->roster_name; ?></span></td>		
		<td class="column100 column1" data-column="column1"><span><?php echo date("d-m-Y", strtotime($row->start_date)); ?></span></td>
		<td class="column100 column2" data-column="column2"><span><?php echo date("d-m-Y", strtotime($row->end_date)); ?></span></td>
		<td class="column100 column3 w-70 ct-status" data-column="column3"><span><a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/view" class="btn btn-success cxs-btn c-btn btn-xs btn-block">View</a></span></td>
			<?php if($role !='employee') { ?>
		<td class="column100 column4 ct-status" data-column="column4"><span><a href="<?php echo base_url(); ?>index.php/admin/re_create_roster/<?php echo $row->roster_group_id ?>" class="btn btn-success cxs-btn c-btn btn-xs btn-block">Recreate</a></span></td>
			<?php } ?>
								
		
							
							</tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
		</div>
		<div class="col-lg-6 col-md-12 table100 ver2">
				    <h2 class="heading_dash">ROSTERS ALLOCATION REPORT</h2>
					<div class="ct-table">
               <table data-vertable="ver2" class="rec-roster">
    				<thead>
    				    
							<tr class="row100 head">
							    <th class="column100 column2" data-column="column2"><span>Roster Name</span></th>
								<th class="column100 column2" data-column="column2"><span>Hours Allocated</span></th>
								<?php if($role !='employee') { ?>                     
								<th class="column100 column5 ct-status" data-column="column5"><span>Total Earned</span></th>
									<?php } ?>
								
								
							</tr>
						</thead>
				<tbody id="branch_suppliers">
			  <?php if(!empty($employee_hrs_records)) {  ?>
     <?php foreach($employee_hrs_records as $employee_hrs) {  ?>
					<tr class="row100">
		<td class="column100 column1" data-column="column1"><span><?php  $input = $employee_hrs['label'];  echo $output = str_replace('_', ' ', $input);?></span></td>		
		<td class="column100 column1" data-column="column1"><span><?php echo $employee_hrs['hrs_worked']; ?></span></td>
		<?php if($role !='employee') { ?>
		<td class="column100 column4 ct-status" data-column="column4"><span><?php echo $employee_hrs['earned']; ?></span></td>
			<?php } ?>
								
		
							
							</tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
		</div>
		<!-- <div class="col-lg-6 col-md-12" style="chart-section">
	         <h2 class="heading_dash">ROSTERS ALLOCATION REPORT </h2>
						<div class="cmsp">
                            <div class="panel">
                                
                                <div class="panel-body p-body">
							
							 <div class="row weekday_line">
  <table class="table table-dark emp-graph rec-roster">
  <thead>
    <tr class="head">
      <th scope="col"><b>Last 4 Weeks</b></th>
      <th scope="col"><b>Hours Allocated</b></th>
      <?php if($role !='employee') { ?>
      <th scope="col"><b>Total Earned</b></th>
     <?php } ?>
    </tr>
  </thead>
  <tbody>
       <?php if(!empty($employee_hrs_records)) {  ?>
     <?php foreach($employee_hrs_records as $employee_hrs) {  ?>
    <tr>
     
      <td > <b><?php  $input = $employee_hrs['label'];  echo $output = str_replace('_', ' ', $input);?></b></td>
   <td> <b><?php echo $employee_hrs['hrs_worked']; ?></b></td>
   <?php if($role !='employee') { ?>
   <td> <b><?php echo $employee_hrs['earned']; ?></b></td>
   <?php } ?>
    </tr>
   <?php } }?>
  </tbody>
</table>

	
    </div>										
								
							</div>
						</div>
					</div>

					

					

					</div>-->
					
					</div>
			
			<?php if($role =='employee') { ?> 

			<div class="row">
			<div class="col-lg-6 col-md-12 table100 ver2">
				    <h2 class="heading_dash">LATEST TIMESHEET </h2>
					<div class="ct-table">
           <table data-vertable="ver2" class="rec-roster">
				<thead>
				    
							<tr class="row100 head">
							    <th class="column100 column2" data-column="column2"><span>Timesheet Name</span></th>
								<th class="column100 column2" data-column="column2"><span>Timesheet Week	</span></th>
								<th class="column100 column4 w-70 ct-status" data-column="column4"><span>View</span></th>
							
								
								
							</tr>
						</thead>
				<tbody id="branch_suppliers">
				<?php if(!empty($timesheets)){ foreach($timesheets as $row){ ?>
					<tr class="row100">
		<td class="column100 column1" data-column="column1"><span><?php echo $row->timesheet_name; ?></span></td>		
		<td class="column100 column1" data-column="column1"><span><?php echo "( From ".$row->start_date." To ".$row->end_date.")"; ?></span></td>
		<td class="column100 column2" data-column="column2"><span><a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>">
                             <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a></span></td>
	
			
								
		
							
							</tr>
				<?php } }?>
				</tbody>
			</table>
		</div>
		</div>
		 <?php } ?>
		 
		 <div class="col-lg-6 col-md-12 table100 ver2">
		    <h2 class="heading_dash">RECENT LEAVE ACTIVITY</h2>
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
			
		<td class="column100 column1" data-column="column1"><span><a href="<?php echo base_url(); ?>index.php/employees/leave_history"><?php echo $row->first_name; ?></a></span></td>
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
	</div>
	<div class="row">
	    
	   
</div>
<br>

