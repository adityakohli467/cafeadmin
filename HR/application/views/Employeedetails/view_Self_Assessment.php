<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
	<div>
        <div>
            
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>PERFORMANCE SELF ASSESSMENT</h3>
							</span>	
						<?php if($role =='employee'){ ?>
						<a class="btn btn-success btn-ph" href="<?php echo base_url(); ?>index.php/Employeedetails/Self_Assessment">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xE147;</i> <span>Add New Request</span></div></a>
							<?php } ?>		
						
					  </div>
            
            <div class="container main-container">
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
                        <th class="w-130">Employee Name</th>
                        <th class="w-130">Completed Date</th>
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
						<td><?php echo $row->emp_name; ?></td>
                        <td class="w-130"><?php echo date("d-m-Y", strtotime($row->completed_date)); ?></td>
                       <td style="display: flex;">
                           	<?php if($role =='employee'){ ?>
                       <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_Self_Assessment/<?php echo $row->Employee_Self_Assessment_id ?>/view">
                           <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                           <?php }else { ?>
                            <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_Self_Assessment/<?php echo $row->Employee_Self_Assessment_id ?>/edit">
                           <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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
    </div>
	<!-- Edit Modal HTML -->
	
	


<script type="text/javascript">

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
