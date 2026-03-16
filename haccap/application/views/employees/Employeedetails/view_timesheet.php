<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
 
	<div class="container-fluid padding-0">
	    <div class="table-title">
                <div class="row">
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>TIMESHEETS</h3>
							</span>	
						
					
					  </div>
                </div>
            </div>
        <div class="table-wrapper">
           <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="timesheet_filters">
									<div class="row">
									  	
										<div class="col-12 col-md-2">
											<input class="form-control" id="timesheet_name" type="text" placeholder="Timesheet Name">
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control datepicker" id="start_date" type="date" placeholder="Start Date">
										</div>
									
									<div class="col-12 col-md-2">
											<input class="form-control datepicker" id="end_date" type="date" placeholder="End Date">
									</div>
										<div class="col-12 col-md-1">
												<button class="btn btn-primary">Go</button>
										</div>
									</div>
									
								
								</form>
							</div>
						</div>
			<div class="ct-scroll">
            <table class="table table-striped table-hover roaster-tb">
                <thead>
                    <tr>
						<th style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th class="w-130">Timesheet Name</th>
                        <th class="w-130">Timesheet Week</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
				$i = 0;
					if(!empty($record_data)){
					  
				foreach($record_data as $row){ ?>
			
                    <tr>
						<td style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?php echo $row->timesheet_name; ?></td>
                       	<td><?php echo "( From ".date("d-m-Y", strtotime($row->start_date))." To ".date("d-m-Y", strtotime($row->end_date)).")"; ?></td>
                       <td style="display: flex;">
                           <?php if(isset($row->multiple_roster_group_id) && $row->multiple_roster_group_id != '') {  ?>
                       <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>/multiple">
                             <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                           <?php } else { ?>
                             <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>">
                             <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                            <?php }  ?>
                         
                        </td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
			</div>	
			<div class="clearfix">
                <div class="hint-text"><?php  echo $result_count; ?></div>
                 <?php echo $this->pagination->create_links(); ?>
            </div>
            
            
        </div>
    </div>
	<!-- Edit Modal HTML -->
	
	


<script type="text/javascript">


$("#timesheet_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#end_date").val())=='')
			end_date='unset';
		else end_date=$("#end_date").val();
		if($.trim($("#start_date").val())=='')
			start_date='unset';
		else start_date=$("#start_date").val();
		if($.trim($("#timesheet_name").val())=='')
			timesheet_name='unset';
		else timesheet_name=$("#timesheet_name").val();
		
		
	window.location.href="<?php echo base_url(); ?>index.php/employeedetails/timesheet_filters/"+start_date+"/"+end_date+"/"+timesheet_name;

		
});


$( function() {
    $( "#datepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

 $( "#datepicker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
});


  } );

</script>


<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});


</script>
