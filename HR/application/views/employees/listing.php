<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">

                  
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
				    
                  <span class="text-center">
						<h3>Reports</h3>
							</span>	
							<a class="btn btn-success btn-ph" href="#" onclick="view_all_reports()" style="position: relative !important;">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xE147;</i> View <span>Selected Reports</span></div>
						</a>
						
					    </div>

<div class="container-fluid" style="background-color:#fff;">
        <div class="table-wrapper">
            
			 <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="report_filter">
									<div class="row">
									  	
									
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
			    
            <table class="table table-striped table-hover roaster-tb" id="table">
                <thead>
                    <tr>
						<th style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th class="w-130">Start Date</th>
                        <th class="w-130">End Date</th>
						<th>Actions</th>
                    </tr>
                </thead>
                <tbody>
              
                <form id="reports_list_form" action="<?php echo base_url(); ?>index.php/admin/view_all_reports" method="post">
				   <?php  foreach($reports as $report) { ?> 
				   <tr>
                        
						<td style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox"  name="options[]" value="<?php echo $report->report_id ?>">
								<label></label>
							</span>
						</td>
                        <td class="w-130"><?php echo date("d-m-Y", strtotime($report->start_date)); ?></td>
                        <td class="w-130"><?php echo date("d-m-Y", strtotime($report->end_date)); ?></td>
						
                       <td style="display: flex;">
                            <a href="<?php echo base_url(); ?>index.php/admin/view_details_reports/<?php echo $report->report_id; ?>">
                           <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                           
                           	<?php //if($role !='employee'){ ?>
                        	<a href="<?php echo base_url(); ?>index.php/admin/view_reports"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <!--<a href="<?php echo base_url(); ?>index.php/admin/view_reports"><i class="material-icons" title="Delete">&#xE872;</i></a>-->
                       
                          <?php //} ?>
                           </td>
                      
                    </tr>
                    <?php } ?>
                    
                    </form>
                </tbody>
            </table>
			</div>	
		
            
        </div>
    </div>

	


<script type="text/javascript">


function view_all_reports(){
      if($('input[name="options[]"]:checked').length > 0){
       $("#reports_list_form").submit();    
      }else{
          alert("Please Select Reports");
      }
     
  }
$('#table').on('click', 'tr', function() {
    $(this).find('td:first :checkbox').trigger('click');
})
.on('click', ':checkbox', function(e) {
    e.stopPropagation();
    $(this).closest('tr').toggleClass('selected', this.checked);
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

$("#report_filter").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#end_date").val())=='')
			end_date='unset';
		else end_date=$("#end_date").val();
		if($.trim($("#start_date").val())=='')
			start_date='unset';
		else start_date=$("#start_date").val();
		
		
		
	window.location.href="<?php echo base_url(); ?>index.php/admin/report_filter/"+start_date+"/"+end_date;

		
});
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
