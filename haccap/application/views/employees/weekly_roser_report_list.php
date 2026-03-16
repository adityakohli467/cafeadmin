<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">


<div class="table-title table-title1">
                <div class="row">
                  
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
				    
                  <span class="text-center">
						<h3>Roster Weekly Report</h3>
							</span>	
						</div>
                </div>
            
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
												<button class="btn btn-primary">View Roster Report</button>
											</div>
									</div>
									
								
								</form>
							</div>
						</div> 
			<div class="ct-scroll">
			    <?php if(!empty($weekly_reports)){  ?>
			 <table class="blueTable roster_records">
                <thead>
                <tr>
                <th ></th>
                <th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th>
                </tr>
                </thead>
                <tbody>
                <td style="width:85px !important"><strong>Daily Sales and Labour Cost Projections</strong></td>   
			      
			    
			         <?php  
			         $weekdays  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                           foreach($weekdays as $weekday){ ?>
                           <td>
                            <table class="sub-table">
                           <tr><td class="left-align">Sales (ex GST)</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_budget']; ?></td></tr>
                            <tr><td class="left-align">Cost</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_cost']; ?></td></tr>
                            <!-- <tr><td class="left-align">Variance</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_variance']; ?></td></tr> -->
                            <tr><td class="left-align">Hours</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_hrs_allocated']; ?></td></tr>
                            <tr><td class="left-align">Avg. Hr rate</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_average_hr_rate']; ?></td></tr>
                            <tr><td class="left-align">%</td><td class="right-align"> <?php echo $weekly_reports[$weekday.'_percentage']; ?></td></tr>
                          
                            </table>
                            </td>
                              <?php } ?>
            	   
			    
			    
			     </tbody>
            </table>
              <?php }  ?>
				</div>	
		
            
        </div>
    </div>

	


<script type="text/javascript">

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
		
		
		
	window.location.href="<?php echo base_url(); ?>index.php/admin/roster_weekly_reports/"+start_date+"/"+end_date;

		
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
