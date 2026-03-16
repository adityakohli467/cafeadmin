<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
<div class="row item">
			</div>
			
	 <form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/create_timesheet" enctype="multipart/form-data">
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>TIMEESHEET APPROVALS</h3>
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
			        <div class="panel-body">
					
					
		<div class="control-group">
      <label class="control-label col-lg-4 col-sm-12">Select Roster</label>
      <div class="controls col-lg-8 col-sm-12">
       <select name="roster_list" class ='form-control' id="roster_list" onchange="fetch_roster(this)">
         <?php if(isset($rosters) && !empty($rosters)) { foreach($rosters as $roster) { $date = new DateTime($roster->start_date); $enddate = new DateTime($roster->end_date); $roster_name = $roster->roster_name."(". $date->format('d-m-Y')." To ".$enddate->format('d-m-Y').")";  ?>
         <?php if(isset($details[0]->role) && $details[0]->role == $roster->roster_group_id) { ?>
           <option value="<?php echo $roster->roster_group_id; ?>" selected="selected"><?php echo $roster_name; ?></option>
         <?php } else { ?>
         <option value="<?php echo $roster->roster_group_id; ?>" ><?php echo $roster_name; ?></option>
		<?php }}} ?>
      </select>
      </div>
    </div>
   
				
						
	          		</div>
        		</div>
	        </div>
	        <div class="container ct-view-roster append_view_roster" style="max-width: 1350px !important;width:100%;"></div>
	        <div class="container ct-emp-tmsht" style="max-width: 1350px !important;width:100%;">
	             <span style="text-allign:center;"><b>Employee Timesheet </b></span>
	        </div>
	        <div class="container ct-view-roster append_view_timesheet" style="max-width: 1350px !important;width:100%;"></div>
	    </div>
	</div>
  
   </div>
  </form>
  
  <div class="modal fade" id="comment" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Comment</h4>
        </div>
        <div class="modal-body">
         <p>
             <textarea name="timesheet_comment" rows="10" cols="15" placeholder="Add Comment"></textarea>
             
             </p>
        </div>
        <div class="modal-footer">
		<input type="text"  id="display_out_time" name="out_time" style="font-size:30px;border:none;width:100%">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" id="out_time" onclick="save_comment(this,'clockout')">Save</button>
          
           <input type="hidden" class="clockout">
        </div>
      </div>
    </div>
  </div>
   <!-- Add Coment Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="add_comment_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add Comment</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p><textarea rows="5" cols="40" name="comment"></textarea></p>
						<p class="text-warning"><small>Add comment for this timesheet</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-danger" value="Add" id="add_comment">
						<input type="hidden" class="btn btn-danger" value="" id="employee_timesheet_id" name="employee_timesheet_id">
						<input type="hidden" class="btn btn-danger" value="" id="employee_id" name="employee_id">
						<input type="hidden" class="btn btn-danger" value="" id="comment_status" name="status">
					</div>
				</form>
			</div>
		</div>
	</div>
  <br>
  <script>
   $(document).ready(function() { 
   
   
            $("#add_comment").on('click',function(){
             
	          var employee_timesheet_id = $("#employee_timesheet_id").val();
	          var status = $("#comment_status").val();
	          var employee_id = $("#employee_id").val();
	          var comment = $("#comment_text").val();

	           $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/update_timesheet",
		         data: 'employee_timesheet_id='+employee_timesheet_id+'&status='+status+'&comment='+comment+'&emp_id='+employee_id,
		        success: function(data){
		        swal({
                text: "Comments Added",
                 icon: "success",
          });
          location.reload();
          }
	       });
     });
     
   });
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
    
    
    $(document).ready(function(){
       
       fetch_roster_onload($("#roster_list").val()); 
  
    })
    
     function update_timesheet_status(emp_id,employee_timesheet_id,obj){
         var status_id =  $(obj).val();
         console.log(status_id);
        
          if(status_id==1){
              $msg = 'Timesheet Approved';
             
          }else if(status_id==2){
              $msg = 'Timesheet Rejected';
              
          }else if(status_id==3){
               
              $("#deleteEmployeeModal").modal('show');
              $("#comment_status").val(status_id);
              $("#employee_timesheet_id").val(employee_timesheet_id);
              $("#employee_id").val(emp_id);
          }
          else{
               $msg = 'Timesheet Pending';
          }
            $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/update_timesheet",
		        data:'employee_timesheet_id='+employee_timesheet_id+'&status='+status_id+'&emp_id='+emp_id,
		        success: function(data){
		        swal({
                text: $msg,
                 icon: "success",
                });
         
         
		        }
	       });
    }
    
  
     function fetch_roster(obj){
         var roster_group_id=  $(obj).val();
         var branch_id = "<?php echo $branch_id; ?>";
      $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/fetch_roster",
		        data:'roster_group_id='+roster_group_id+'&branch_id='+branch_id,
		        success: function(data){
		        $(".append_view_roster").html('');      
		         $(".append_view_roster").append(data);
		        }
	       });
     }
     
      function fetch_timesheet(emp_id,roster_group_id){
         $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/fetch_timesheet",
		        data:'emp_id='+emp_id+'&roster_group_id='+roster_group_id,
		        success: function(data){
		        $(".append_view_timesheet").html('');      
		         $(".append_view_timesheet").append(data);
		        }
	       });
          
       
     }
     
     function fetch_roster_onload(rsid){
         
         var branch_id = "<?php echo $branch_id; ?>";
      $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/fetch_roster",
		        data:'roster_group_id='+rsid+'&branch_id='+branch_id,
		        success: function(data){
		        $(".append_view_roster").html('');      
		         $(".append_view_roster").append(data);
		        }
	       });
     }
        
  
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
