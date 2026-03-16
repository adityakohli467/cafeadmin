<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
<style>
    
    .ct-view-roster table tbody tr:nth-child(odd) {
    background-color: #eaf8e6 !important;
}
.ct-view-roster table>table tbody tr:nth-child(odd) {
    background-color: #eaf8e6 !important;
}
.ct-view-roster table.blueTable td, .ct-view-roster table.blueTable th {
    border: 1px solid #AAAAAA;
    padding: 2px 4px;
}

.start_height {
    height: 25px !important;
    width: 84px !important;
}
</style>

<div class="container-fluid padding-0">
    	<div  class="col-md-12 page-head border-bottom">
		
			<span class="text-center">
				<h3>TIMESHEETS</h3>
			</span>
				<?php if(($this->session->userdata('role')) !='employee'){  ?>
			<span class="extra_icons">

			<a href="javascript:window.print();" ><i class="material-icons" data-toggle="tooltip" title="Print">&#xe8ad;</i></a>
		
			<a class="btn btn-success btn-ph" onclick="download_data(1)" style="position: relative !important;">Download Excel</a>
			<a class="btn btn-success btn-ph" href="https://www.cafeadmin.com.au/HR/index.php/Employeedetails/download_textfile/<?php echo $timesheet_id; ?>/<?php echo $roster_group_id; ?>" style="position: relative !important;">Download Text</a>
			</span>
			<?php } ?>
		</div>
	
	</div>
	
	<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
	  		    <div class="col-md-6" style="font-weight: 900; margin-left: 16px;padding:10px 15px">
	  		        <span style="color: black;font-size: 17px;"><b> Timesheet Name : </b><?php  echo ucfirst($timesheet_name); ?></span> </br>
	  		        <span style="color: black;font-size: 17px;"> Date Range : From <?php echo date("d-m-Y", strtotime($start_date) ); ?> To <?php echo  date("d-m-Y", strtotime($end_date)); ?></span>
	  		        </div>

  			<div class="col-md-12">

	        <div class="container-fluid ct-view-roster append_view_timesheet">

      <div class="row weekday_line"><div class="ct-scroll">
     	<table class="blueTable" ><thead><tr>
     <th style="text-align: center;">Employee Name</th> 
     <?php  
if(!empty($employee_weekly_timesheet_details)){
     foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet){ ?>
   <?php    for($count = 0;$count < 7;$count++ ) {  ?>
        <th style="text-align: center;"> <?php echo date("d-m-Y", strtotime($employee_weekly_timesheet[$count]['date'])).'('.strtoupper(date('D', strtotime($employee_weekly_timesheet[$count]['date']))).')'; ?>
        </th>
     <?php } break; ?>
     <?php } } ?>
     <th style="text-align: center;">Comments</th><th style="text-align: center;" class="w-100">Status</th> <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?> 
     <th style="text-align: center;">Action</th> <?php } ?>
     </tr></thead>
  <?php if(!empty($employee_weekly_timesheet_details) ){  ?>
      <tbody>
      
        <?php  foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet_detail){    ?>
 
      <form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employeedetails/update_multiple_timesheet" enctype="multipart/form-data">
         <input type="hidden" name="timesheet_id" value="<?php echo $employee_weekly_timesheet_detail[0]['timesheet_id']?>">
         <input type="hidden" name="roster_group_id" value="<?php echo $roster_group_id; ?>">
        <tr class="no_of_row"><td class="start_end emp_name"><b> <?php echo $employee_weekly_timesheet_detail[0]['employee_name']; ?> </b></br> <?php echo "( ".$employee_weekly_timesheet_detail['total_hrsworked_this_week']." Hrs )"; ?></td>
       
        <input type="hidden" name="roster_id[]" value="<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>">
       <?php
  
        
    
        $loop_count = 0;
      for ($i = 0; $i < 7; $i++) { ?>
          
        <td class="start_end"><table><tr>
         <td class="child">In</td> 
         <td class="child">Out</td> 
         </tr>
     <tr>
     <td class="child start_height date datetimepicker3"> <input class="editable_field" readonly="" type="text" name="in_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['in_time'])); } else { echo ''; } ?>"> </td>
     <td class="child start_height date datetimepicker3"> <input class="editable_field" readonly="" type="text" name="out_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['out_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['out_time']));} else { echo ''; } ?>"></td>

       </tr>
       <tr>
           <td class="child ct-font-td">Break In</td>
         <td class="child ct-font-td">Break Out</td>
       </tr>
       <tr>
            <td class="child start_height date datetimepicker3"><input class="editable_field" readonly="" type="text" name="break_in_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_in_time'])); } else { echo ''; } ?>"></td>
            <td class="child start_height date datetimepicker3"><input class="editable_field" readonly="" type="text" name="break_out_time@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_out_time'] !='') { echo  date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_out_time'])); } else { echo ''; } ?>"></td>
       </tr>
       <tr>
            <td colspan="2" class="child ct-font-td">Outlet</td>  
       </tr>
       <tr>
            <td colspan="2" class="child start_height"><input class="editable_field" readonly="" type="text" name="outletname@<?php echo $employee_weekly_timesheet_detail[$loop_count]['date']; ?>[]" value="<?php echo $employee_weekly_timesheet_detail[$loop_count]['outletname']; ?>"></td>
       </tr>
        <?php  $loop_count++;  ?>
       </table></td>
      <?php  } ?>
      
      <td> <?php echo  $employee_weekly_timesheet_detail[0]['comment']; ?> </td>
      
    <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?>    
  <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){ ?>
        <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option value="3" data-toggle="modal"  >Comment</option><option value="0" selected="selected">Pending</option><option value="1">Approve</option><option value="2">Reject</option></select></td>
  <?php }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 1){  ?>
    <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option value="3" data-toggle="modal"  >Comment</option><option value="0" >Pending</option><option value="1" selected="selected">Approve</option><option value="2">Reject</option></select></td>
   <?php    }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 2){ ?>
    <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option  value="3" data-toggle="modal"  >Comment</option><option value="0" >Pending</option><option value="1" >Approve</option><option value="2" selected="selected">Reject</option></select></td>
      <?php }else{ ?>
    <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option selected="selected" value="3" data-toggle="modal"  >Comment</option><option value="0" >Pending</option><option value="1" >Approve</option><option value="2" >Reject</option></select></td>
 
      <?php } ?>
       <?php }else { ?>
       <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){ ?>
       <td class="w-100"> <span style="font-weight:800; font-size : 16px">Pending</span> </td>
       <?php }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 1){  ?>
       <td class="w-100"> <span style="font-weight:800; font-size : 16px">Approved</span></td>
        <?php    }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 2){ ?>
       <td class="w-100"><span style="font-weight:800; font-size : 16px">Rejected  </span></td>
        <?php }else{ ?>
        <td class="w-100"> <span style="font-weight:800; font-size : 16px">Comment Added </span></td>
        <?php } ?>
        
        <?php } ?>
      
     <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?> 
      <td><div class="timesheet-btns">
        <button type="submit" class="btn btn-success btn-ph" ><span class="material-icons">system_update_alt</span></button>
        <a class="btn btn-success btn-ph" onclick='make_field_editable(this)'><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
    </div></td>
    <?php } ?>
           
         </tr>
         </form>
          <?php $nameOfDay = array(); } ?>
         </tbody>
       <?php } ?>
        </table>
        </div>
	    </div>
	</div>
   </div>
   
    
  <!-- Add Coment Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="add_comment_form" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add Comment</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p><textarea rows="5" cols="45" name="comment" id="comment_text"></textarea></p>
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
   <script>
    $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm'
                });
                
   function make_field_editable(obj){
$(obj).parents(".no_of_row").find(".editable_field").removeAttr("readonly");
$(obj).parents(".no_of_row").find(".start_height ").css("border","2px solid #1b1818");
$(obj).parents(".no_of_row").find(".editable_field:first").focus();

}
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
		            
                text: "Comment Added",
                 icon: "success",
          });
          location.reload();
          }
	       });
     });
     
   });
    
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
    
    function download_data(type_of_file){
       var tid=  '<?php echo $timesheet_id; ?>';
        var rgid = '<?php echo $roster_group_id; ?>';
        var mul = '<?php echo $roster_group_id; ?>';
      if(type_of_file==2){
          var methodname = 'download_textfile';
      }else{
        var methodname  = 'download_excel';
      }
      $.ajax({
		url:"<?php echo base_url();?>index.php/employeedetails/"+methodname,
		method:"POST",
		data:'tid='+tid+'&rgid='+rgid+'&mul='+mul,
	    success: function () {
            window.open(this.url,'_blank' );
        }
        });
    
}
   </script>