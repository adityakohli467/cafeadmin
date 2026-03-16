<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<div class="row item">
			</div>
			
	 <form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/create_timesheet" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>ADD TIMEESHEET</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b> Add Timesheet:</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Timesheet Name:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
							   
								<input type="text" required class="form-control" name="timesheet_name" value="<?php if(isset($details[0]->subject)){ echo $details[0]->subject; } ?>" autocomplete="off" required >
							</div>
						</div>
						
						
					
		<div class="control-group">
      <label class="control-label col-lg-4 col-sm-12">Select Roster</label>
      <div class="controls col-lg-8 col-sm-12">
       <select name="roster_list[]" class ='form-control selectpicker' id="roster_list" multiple data-live-search="true" required>
         <?php if(isset($rosters) && !empty($rosters)) { foreach($rosters as $roster) { $date = new DateTime($roster->start_date); $enddate = new DateTime($roster->end_date); $roster_name = $roster->roster_name."(". $date->format('d-m-Y')." To ".$enddate->format('d-m-Y').")";  ?>
         <?php if(isset($details[0]->role) && $details[0]->role == $roster->roster_group_id) { ?>
           <option value="<?php echo $roster->roster_group_id; ?>" selected="selected"><?php echo $roster_name; ?></option>
         <?php } else { ?>
         <option value="<?php echo $roster->roster_group_id; ?>" ><?php echo $roster_name; ?></option>
		<?php }}} ?>
      </select>
      </div>
    </div>
    <div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">CREATE</button>
					<a href="<?php echo base_url(); ?>index.php/Employeedetails/view_timesheet">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		              </div>
				
						
	          		</div>
        		</div>
	        </div>
	       
	    </div>
	</div>
  
   </div>
  </form>
  <br>
  <script>
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    
  $('select').selectpicker();
        
  
</script>

	<style>
 	label.error, label>span{
 		color:red;
 	}
 	.validation_text p{
 	 color: red;
    font-size: 15px;
    font-weight: 600;
 	}
    </style>
</body>
</html>
