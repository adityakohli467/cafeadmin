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
.timesheet-btns {
    margin: 15px 0;
    display: flex;
    gap: 10px;
    padding: 12px 12px;
}
.btn-sm{
    padding: 0.25rem 0.5rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
    border-radius: 0.2rem !important;  
}
</style>

<div class="container-fluid padding-0">
    	<div  class="col-md-12 page-head border-bottom">
			<span class="text-center">
				<h3>TIMESHEETS</h3>
			</span>
				<?php if(($this->session->userdata('role')) !='employee'){  ?>
			<span class="extra_icons">
			    
			    <button onClick="DownloadButtonFUn()" class="btn btn-success btn-ph">Download Casual Emp</button>
			     <button onClick="DownloadButtonFUn2()" class="btn btn-success btn-ph">Download Text</button>
			      <a href="#" id="printT"><i class="material-icons" data-toggle="tooltip" title="Print">&#xe8ad;</i></a>
			</span>
			
			<?php } ?>
			
		</div>
					
	</div>
	
	<div class="container-fluid main-container">
	   
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
	  		    <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?>
	  		    <div class="col-md-12">
	  		        <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							
							<div class="card-body">
								<form id="employee_filters" action="<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $timesheet_id; ?>/<?php echo $roster_group_id; ?>" method="post">
									<div class="row">
									   <div class="col-12 col-md-2 ">
										<input class="form-control" name="emp_name" type="text" placeholder="Emp. Name" value="<?php echo  (isset($filter_emp_name) && $filter_emp_name !='' ? $filter_emp_name : '')  ?>">
										</div>
										<!--<div class="col-12 col-md-2">-->
										<!--<select class="form-control"  name="timesheet_status">-->
										<!-- <option value="" selected="selected">-- Select timesheet type --</option>-->
										<!--<option value="0" >Pending</option>-->
										<!--<option value="1">Approve</option>-->
										<!--<option value="2">Reject</option>-->
										<!--<option value="3" >Comments</option></select>-->
										<!--</div>-->
						<div class="col-12 col-md-2">
					<select class="form-control filter_employee_type"  name="employee_type">
					    <option <?php echo  ($filter_emp_type ==''  ? 'selected' : '')  ?> value="">-- Select employee type --</option>
										<option <?php echo  (isset($filter_emp_type) && $filter_emp_type =='full_time' ? 'selected' : '')  ?> value="full_time" >Full time</option>
										<option <?php echo  (isset($filter_emp_type) && $filter_emp_type =='casual' ? 'selected' : '')  ?> value="casual">Casual</option>
									</select>
						</div>
							<div class="col-12 col-md-1">	<button class="btn btn-success">Filter</button></div>
							</div>
								</form>
							</div>
						</div>
	  		        </div>
	  		        <?php } ?>
	  		    

  			<div class="col-md-12" id="printAbleArea">
  			    
  			 <div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-wrap align-items-center" style="font-weight: 600; ">
                <span style="color: black; font-size: 12px;"><b>Timesheet Name:</b> <?php  echo ucfirst($timesheet_name); ?></span>
                <span style="color: black; font-size: 12px; margin-left: 18px;">Date Range: From <?php echo date("d-m-Y", strtotime($start_date) ); ?> To <?php echo  date("d-m-Y", strtotime($end_date)); ?></span>
                <span style="color: black; font-size: 12px; margin-left: 18px;">Total Hours of this timesheet: <?php echo ((isset($employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet']) ? $employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet'] : '')) ?></span>
            </div>
        </div>
    </div>
</div>   

	   
	  
	    
	        <div class="container-fluid ct-view-roster append_view_timesheet">

      <div class="row weekday_line"><div class="ct-scroll">
          <?php if(isset($filter_ersult_empId) && $filter_ersult_empId == 'false')  { ?>
         <h3> NO EMPLOYEE FOUND </h3>
          <?php } else { ?>
        <form class="form-inline updateTimeSheetForm" action="<?php echo base_url(); ?>index.php/Employeedetails/update_multiple_timesheet" enctype="multipart/form-data">  
     	 <input type="hidden" name="roster_group_id" value="<?php echo $roster_group_id; ?>">
     	<table class="blueTable" >
     	    <thead>
     	        <tr>
     <th style="text-align: center;"><a style="color: white;" href="#" class="sortType" >Employee Name<span class="material-icons" title="Sort">arrow_drop_down</span></a></th> 
         
     <?php  
     $weekwiseTotal= array();
     // Header dates are derived from the timesheet's fixed start_date so they never shift on filter
     for($count = 0; $count < 7; $count++) {
         $col_date = date("d-m-Y", strtotime($start_date.' +'.$count.' day'));
         $col_day  = strtoupper(date('D', strtotime($start_date.' +'.$count.' day')));
     ?>
  <th style="text-align: center;"> <?php echo $col_date.'('.$col_day.')'; ?>
        </th>
     <?php } ?>
     <th style="text-align: center;">Comments</th><th style="text-align: center;" class="w-100">Status</th> <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?> 
     <th style="text-align: center;">Action</th> <?php } ?>
     </tr></thead>
  <?php if(!empty($employee_weekly_timesheet_details) ){   ?>
      <tbody>
     <?php
     unset($employee_weekly_timesheet_details['total_hrs_of_all_employees_of_this_timesheet']);
     foreach($employee_weekly_timesheet_details as $employee_weekly_timesheet_detail){    ?>
     
      
         <input type="hidden" name="timesheet_id" value="<?php echo $employee_weekly_timesheet_detail[0]['timesheet_id']?>">
        
        <tr class="no_of_row"><td class="start_end emp_name"><b> <?php echo $employee_weekly_timesheet_detail[0]['employee_name']; ?> </b></br> <?php echo "( ".$employee_weekly_timesheet_detail['total_hrsworked_this_week']."  )"; ?></td>
        <input type="hidden" name="roster_id[]" value="<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>">
         
       <?php
      $loop_count = 0;
      for ($i = 0; $i < 7; $i++) { ?>
      <input type="hidden" name="employee_timesheet_id[]" value="<?php  echo $employee_weekly_timesheet_detail[$i]['employee_timesheet_id']; ?>">
    <?php $dayKey = date('D', strtotime($employee_weekly_timesheet_detail[$loop_count]['date'])); $weekwiseTotal[$dayKey] = ($weekwiseTotal[$dayKey] ?? 0) +  $employee_weekly_timesheet_detail[$loop_count]['total_hrsworked_this_day'];  ?>  
    <?php $readonly = ($employee_weekly_timesheet_detail[0]['in_verify'] == 1) ? 'readonly' : ''; ?>

        <td class="start_end">
            <table><tr>
         <td class="child">In</td> 
         <td class="child">Out</td> 
         </tr>
     <tr>
     <td class="child start_height date datetimepicker3"> <input class="editable_field" <?php echo $readonly ?>  type="text" name="in_time[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['in_time'])); } else { echo ''; } ?>"> </td>
     <td class="child start_height date datetimepicker3"> <input class="editable_field" <?php echo $readonly ?> type="text" name="out_time[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['out_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['out_time']));} else { echo ''; } ?>"></td>

       </tr>
       <tr>
           <td class="child ct-font-td">Break In</td>
         <td class="child ct-font-td">Break Out</td>
       </tr>
       <tr>
            <td class="child start_height date datetimepicker3"><input class="editable_field"  <?php echo $readonly ?> type="text" name="break_in_time[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_in_time'] !='') { echo date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_in_time'])); } else { echo ''; } ?>"></td>
            <td class="child start_height date datetimepicker3"><input class="editable_field" <?php echo $readonly ?>  type="text" name="break_out_time[]" value="<?php if($employee_weekly_timesheet_detail[$loop_count]['break_out_time'] !='') { echo  date("H:i", strtotime($employee_weekly_timesheet_detail[$loop_count]['break_out_time'])); } else { echo ''; } ?>"></td>
       </tr>
       <tr>
            <td colspan="2" class="child ct-font-td">Outlet</td>  
       </tr>
       <tr>
            <td colspan="2" class="child start_height"><input class="editable_field" type="text" <?php echo $readonly ?> name="outletname[]" value="<?php echo $employee_weekly_timesheet_detail[$loop_count]['outletname']; ?>"></td>
       </tr>
        <?php  $loop_count++;  ?>
       </table></td>
      <?php  } ?>
     
      <td> <?php echo  $employee_weekly_timesheet_detail[0]['comment']; ?> </td>
      
    <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?> 
    <?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){ ?>
    <td><button type="button" class="btn btn-success btn-sm approvedBtn" onclick="submitTimesheetForm('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this,false)">Pending</button>
     <?php }else{  ?>
   <td><button type="button" class="btn btn-success btn-sm approvedBtn" onclick="submitTimesheetForm('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this,false)">Approved</button>  </td>
      <?php } ?>
  <!--<?php  if($employee_weekly_timesheet_detail[0]['in_verify'] == 0){ ?>-->
  <!--      <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option value="3" data-toggle="modal"  >Comments</option><option value="0" selected="selected">Pending</option><option value="1">Approve</option><option value="2">Reject</option></select></td>-->
  <!--<?php }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 1){  ?>-->
  <!--  <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option value="3" data-toggle="modal"  >Comments</option><option value="0" >Pending</option><option value="1" selected="selected">Approve</option><option value="2">Reject</option></select></td>-->
  <!-- <?php    }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 2){ ?>-->
  <!--  <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option  value="3" data-toggle="modal"  >Comments</option><option value="0" >Pending</option><option value="1" >Approve</option><option value="2" selected="selected">Reject</option></select></td>-->
  <!--    <?php }else{ ?>-->
  <!--  <td><select class="status_chnage" onchange="update_timesheet_status('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this)" name="timesheet_status"><option selected="selected" value="3" data-toggle="modal"  >Comments</option><option value="0" >Pending</option><option value="1" >Approve</option><option value="2" >Reject</option></select></td>-->
 
  <!--    <?php } ?>-->
       <?php }else { ?>
       <?php  if($employee_weekly_timesheet_detail[0][''] == 0){ ?>
       <td class="w-100"> <span style="font-weight:800; font-size : 16px">Pending</span> </td>
       <?php }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 1){  ?>
       <td class="w-100"> <span style="font-weight:800; font-size : 16px">Approved</span></td>
        <?php    }elseif($employee_weekly_timesheet_detail[0]['in_verify'] == 2){ ?>
       <td class="w-100"><span style="font-weight:800; font-size : 16px">Rejected  </span></td>
        <?php }else{ ?>
        <td class="w-100"> <span style="font-weight:800; font-size : 16px">Comments Added </span></td>
        <?php } ?>
        
        <?php } ?>
      
     <?php if($this->session->userdata('role') !='employee' && $user_id != 257  && $user_id != 258) {  ?> 
      <td>
       <div class="timesheet-btns gap-2">   
       <button class="btn btn-success btn-sm" type="button" onclick="showCommentModal('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>')"> Add Comment</button>
       <button class="btn btn-danger btn-sm editBtn" type="button" onclick='make_field_editable(this)'> Edit</button> 
       <button class="btn-secondary btn-sm updateBtn" type="button" onclick="submitTimesheetForm('<?php echo $employee_weekly_timesheet_detail[0]['employee_id']; ?>','<?php echo $employee_weekly_timesheet_detail[0]['employee_timesheet_id']; ?>',this,true)"> Update</button> 
       <button class="btn btn-warning btn-sm" type="button" onclick="fetch_roster_of_timesheet('<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>')"> Roster</button>
       </div>
    <!--<div class="timesheet-btns">-->
        <!--<button type="submit" class="btn btn-success btn-ph submitTSForm" ><span class="material-icons" title="Save">system_update_alt</span></button>-->
    <!--    <a class="btn btn-success btn-ph" onclick='make_field_editable(this)'><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>-->
    <!--    <a class="btn btn-success btn-ph" onclick="fetch_roster_of_timesheet('<?php  echo $employee_weekly_timesheet_detail[0]['roster_id']; ?>')"><i class="material-icons" data-toggle="tooltip" title="View Roster">remove_red_eye</i></a>-->
    <!--</div>-->
    </td>
    
    <?php } ?>
           
         </tr>
         
          <?php $nameOfDay = array(); } ?>
        
          <tr>
            <td>Day Wise Total Hrs</td>
            <?php  foreach($weekwiseTotal as $wtotal) { ?>
            <td><?php echo $wtotal.' Hrs' ?></td>
            <?php } ?>
            
            <td></td>
            <td></td>
            <td></td>
              </tr>
            
         </tbody>
       <?php } ?>
        </table>
        </form>
          <?php }  ?>
        </div>
	    </div>
	</div>
   </div>
   
    	<div id="roster_data" class="modal fade">
		<div class="modal-dialog" style="max-width: 95%;width: 100%;">
			<div class="modal-content">
			
					<div class="modal-header">						
						<h4 class="modal-title">Roster Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body append_roster">
  					
					
					</div>
					<div class="modal-footer">

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
  					<div class="form-group">
						<p><textarea rows="5" cols="45" name="comment" id="comment_text" class="form-control"></textarea></p>
						<p class="text-warning"><small>Add comment for this timesheet</small></p>
					</div>
					</div>
					<div class="modal-footer">
					
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-success" id="add_comment">Add</button>
						<input type="hidden" class="btn btn-danger" value="" id="employee_timesheet_id" name="employee_timesheet_id">
						<input type="hidden" class="btn btn-danger" value="" id="employee_id" name="employee_id">
						<input type="hidden" class="btn btn-danger" value="" id="comment_status" name="status">
					
					</div>
				</form>
			</div>
		</div>
	</div>
   <script>
   function DownloadButtonFUn(){
        window.location.href = "<?php echo base_url('index.php/Employeedetails/download_textfile/'); ?><?php echo $timesheet_id; ?>/<?php echo $roster_group_id; ?>/casual";
   }
   function DownloadButtonFUn2(){
        window.location.href = "<?php echo base_url('index.php/Employeedetails/download_textfile/'); ?><?php echo $timesheet_id; ?>/<?php echo $roster_group_id; ?>";
   }
   $('a.sortType').click(function() { 
    
   var sortType = localStorage.getItem("sortType");
   
   if(sortType == 'SORT_DESC'){
        localStorage.setItem("sortType", "SORT_ASC");
        $(this).html('Employee Name<span class="material-icons" title="Sort">arrow_drop_down</span>')
    }else{
         localStorage.setItem("sortType", "SORT_DESC");
          $(this).html('Employee Name<span class="material-icons" title="Sort">arrow_drop_up</span>')
    }
    var filter_employee_type  = $(".filter_employee_type").val();
    console.log(filter_employee_type);
    
     var sortType = localStorage.getItem("sortType");
    window.location.href = "<?php echo base_url(); ?>index.php/Employeedetails/edit_timesheet/<?php echo $timesheet_id; ?>/<?php echo $roster_group_id; ?>/"+sortType+"/"+filter_employee_type;
    return false; 
});

    $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm'
                });
     function fetch_roster_of_timesheet(roster_id){
         console.log(roster_id);
          $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/fetch_roster_of_timesheet",
		         data: 'roster_id='+roster_id,
		        success: function(data){
		       
		       $("#roster_data").modal('show'); 
		        $(".append_roster").html(data);
          }
	       });
     }             
   function make_field_editable(obj){
$(obj).parents(".no_of_row").find(".editable_field").removeAttr("readonly");
$(obj).parents(".no_of_row").find(".start_height ").css("border","2px solid #1b1818");
$(obj).parents(".no_of_row").find(".editable_field:first").focus();
$(obj).parents(".no_of_row").find(".approvedBtn").html("Pending");
// $(".updateBtn").show();
$(".editBtn").hide();

}
   $(document).ready(function() { 
    //  $(".updateBtn").hide();
     $("#add_comment").on('click',function(){
             
	          let employee_timesheet_id = $("#employee_timesheet_id").val();
	          let status = $("#comment_status").val();
	          let employee_id = $("#employee_id").val();
	          let comment = $("#comment_text").val();
	           let btnText = $(this);   
	
	           $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/update_timesheet",
		         data: 'employee_timesheet_id='+employee_timesheet_id+'&status='+status+'&comment='+comment+'&emp_id='+employee_id,
		        success: function(data){
		        btnText.html("Comment Added");
        //   location.reload();
          }
	       });
     });
      });
    function  showCommentModal(emp_id,employee_timesheet_id){
        $("#deleteEmployeeModal").modal('show');
              $("#comment_status").val(3);
              $("#employee_timesheet_id").val(employee_timesheet_id);
              $("#employee_id").val(emp_id); 
    }
   function update_timesheet_status(emp_id,employee_timesheet_id,obj){
       
         let status_id =  1;
            $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/update_timesheet",
		        data:'employee_timesheet_id='+employee_timesheet_id+'&status='+status_id+'&emp_id='+emp_id,
		        success: function(data){
		        }
	       });
    }
    
    function submitTimesheetForm(emp_id,employee_timesheet_id,obj,justSave){
      $(obj).html("Loading...");
      let row = $(obj).closest('.no_of_row');
      let formData = row.find('input, select').serialize();
      formData += '&' + $('input[name="roster_group_id"]').serialize();
      formData += '&' + $('input[name="timesheet_id"]').serialize();
     
      formData += '&ajaxSubmit=true';
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/Employeedetails/update_multiple_timesheet',
        data: formData,
        success: function(response) {
            if(justSave == false){
            update_timesheet_status(emp_id,employee_timesheet_id,obj)    
            $(obj).html("Approved");
            }else{
            $(obj).html("Update");  
            //  $(".updateBtn").hide();
            }
        $(".editBtn").show();    
        $(obj).closest(".no_of_row").find(".editable_field").prop("readonly", true);
        $(obj).closest(".no_of_row").find(".start_height").css("border", "");
       $(obj).closest(".no_of_row").find(".editable_field").blur();
        },
        error: function(xhr, status, error) {
         $(obj).html("Error Occured");
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

 		$("#printT").click(function(){ 
 		 let printContents = document.getElementById('printAbleArea').innerHTML;
        let originalContents = document.body.innerHTML;
	 $(".blueTable").css("width","142%");
     document.body.innerHTML = printContents;

     window.print();
    
     document.body.innerHTML = originalContents;   
 	$(".blueTable").css("width","100%"); 	    
 		    
 		    
 		    
 	
 		
 		
 		}) 				 			
 				
   </script>