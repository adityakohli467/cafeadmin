<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
	<div>
        <div>
           
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>MEMO</h3>
							</span>	
						
						
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
                        <th class="w-130">Memo Name</th>
                          <th class="w-130">Employee Name</th>
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
						<td><?php echo $row->subject; ?></td>
                        	<td><?php echo $row->emp_name; ?></td>
                       <td style="display: flex;">
                       <a href="<?php echo base_url(); ?>index.php/Employeedetails/add_memo/<?php echo $row->memo_id ?>">
                           <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                           
                        </td>
                    </tr>
                    <?php }  }?>
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
