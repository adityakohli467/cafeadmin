<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
 <div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>TIMESHEETS</h3>
							</span>	
			<?php if(($this->session->userdata('role')) !='employee'){  ?>
			<span class="extra_icons">
			  <button onClick="ButtonFunctions()" class="btn btn-success btn-ph"><i class="glyphicon glyphicon-save"></i><span>Download</span> Fortnight Txt</button>
			</span>
				<span class="extra_icons">
			  <button onClick="downloadTotalHours()" class="btn btn-success btn-ph"><i class="glyphicon glyphicon-save"></i><span>Download Total</span> Hours</button>
			</span>
			
			<?php } ?>
					
					  </div>
	<div class="container-fluid padding-0">
	    
				
               
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
									<?php if($role  !='employee') {  ?>
									<div class="col-12 col-md-2">
											<select class="form-control" id="exEmployee">
											    <option>Select Ex-Employee</option>
											    <?php foreach($exEmployees as $exEmp){ ?>
											    <?php if($exEmp->emp_id  == $selected_exEmployees ) {  ?>
											    <option selected="selected" value="<?php echo $exEmp->emp_id ?>"><?php echo $exEmp->first_name.' '.$exEmp->last_name; ?></option>
											    <?php }else { ?>
											        <option value="<?php echo $exEmp->emp_id ?>"><?php echo $exEmp->first_name.' '.$exEmp->last_name; ?></option>
											    <?php  } } ?>
											    </select>
									</div>
									 <?php  }  ?>
								
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
				
				function print_date_range($row) {
    if (!empty($row->start_date)) {
        return "( From " . date("d-m-Y", strtotime($row->start_date)) . " To " . date("d-m-Y", strtotime($row->end_date)) . " )<br>";
    } else {
        // Extract date from timesheet_name
        if (preg_match('/\d{2}\/\d{2}\/\d{4}/', $row->timesheet_name, $matches)) {
            $date_str = $matches[0];
            $start_date = DateTime::createFromFormat('d/m/Y', $date_str);
            $end_date = clone $start_date;
            $end_date->modify('+6 days');

            return "( From " . $start_date->format('d-m-Y') . " To " . $end_date->format('d-m-Y') . " )<br>";
        }
    }
}

					if(!empty($record_data)){
					  
				foreach($record_data as $row){ ?>
			
                    <tr>
						<td style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox" class="timesheetIds" name="options[]" value="<?php echo $row->timesheet_id; ?>_<?php echo $row->roster_group_id ?>">
								<label for="timesheetIds"></label>
							</span>
						</td>
						<td><?php echo $row->timesheet_name; ?></td>
					<?php if($row->timesheet_id == '1376') { ?>
			<td><?php echo "( From 2024-06-03 To 2024-06-09)"; ?></td>		
					<?php }else{  ?>
			<td><?php echo print_date_range($row); ?></td>		
					<?php }  ?>
                       	
                       <td style="display: flex;">
                           <?php if(isset($row->multiple_roster_group_id) && $row->multiple_roster_group_id != '') {  ?>
                       <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>/multiple">
                             <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                           <?php } else { ?>
                             <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $row->timesheet_id ?>/<?php echo $row->roster_group_id ?>">
                             <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                            <?php }  ?>
                        <?php if($role  !='employee') {  ?>
                        <a href="#" onClick="deletemodal(<?php echo $row->timesheet_id ?>)"  ><i class="material-icons">&#xE872;</i></a>
                        <a href="#" onClick="refreshTimesheet(<?php echo $row->timesheet_id ?>)"  ><i class="material-icons">&#xe028;</i></a>
                        <?php } ?>
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
	<!-- Delete Modal HTML -->
	
		<div id="deleteTimesheetModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Timesheet</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Timesheet?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_timesheet">
						<input type="hidden" class="btn btn-danger" value="" id="delete_timesheet_id">
					</div>
				</form>
			</div>
		</div>
	</div>


<script type="text/javascript">

function ButtonFunctions(){
    var TimehseetId = [];
    var RosterGroupId= [];
    $('.timesheetIds:checked').each(function() {
        var tidandRosterId = $(this).val();
        const TidRid = tidandRosterId.split("_");
      
        TimehseetId.push(TidRid[0])
        RosterGroupId.push(TidRid[1])
       
    });
    var TImeIDS = TimehseetId.join();
     var RGIDS = RosterGroupId.join();
//   alert("<?php echo base_url('HR/index.php/Employeedetails/download_FortnightTextfile/'); ?>"+TImeIDS+"/"+RGIDS)
 window.location.href = "<?php echo base_url('HR/index.php/Employeedetails/download_FortnightTextfile'); ?>?TimehseetIds="+TImeIDS+"&RGId="+RGIDS;

}
function downloadTotalHours(){
    var TimehseetId = [];
    var RosterGroupId= [];
    $('.timesheetIds:checked').each(function() {
        var tidandRosterId = $(this).val();
        const TidRid = tidandRosterId.split("_");
      
        TimehseetId.push(TidRid[0])
        RosterGroupId.push(TidRid[1])
       
    });
    var TImeIDS = TimehseetId.join();
     var RGIDS = RosterGroupId.join();
//   alert("<?php echo base_url('HR/index.php/Employeedetails/download_FortnightTextfile/'); ?>"+TImeIDS+"/"+RGIDS)
 window.location.href = "<?php echo base_url('HR/index.php/Employeedetails/download_total_hours'); ?>?TimehseetIds="+TImeIDS+"&RGId="+RGIDS;

}

 function deletemodal(timesheet_id){
        $("#delete_timesheet_id").val(timesheet_id);
        $("#deleteTimesheetModal").modal('show');
        
    }
    function refreshTimesheet(timesheet_id){
        
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/fixing_timesheet",
		    data: {"timesheet_id":timesheet_id},
		    success: function(data){
                   alert("Timesheet Fixed");
                 location.reload();
		    }
		});
        
    }
    
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
		
		if($.trim($("#exEmployee").val())=='')
			exEmployee='unset';
		else exEmployee=$("#exEmployee").val();
		
		
	window.location.href="<?php echo base_url(); ?>index.php/employeedetails/timesheet_filters/"+start_date+"/"+end_date+"/"+timesheet_name+"/"+exEmployee;

		
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
    
    
    
    
       
    $("#delete_timesheet").on('click',function(){
        
        var data1 = $("#delete_timesheet_id").val();
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/employeedetails/delete_timesheet",
		    data: {"id":data1},
		    success: function(data){
                   //alert(data);
                 location.reload();
		    }
		});
        
    });
    
    
    
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
