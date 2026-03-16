<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">	<div>
        <div>
            
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>Interview Assesment</h3>
							</span>	
								<?php if($role !='employee'){ ?>
						<a class="btn btn-success btn-ph" href="<?php echo base_url(); ?>index.php/Employeedetails/interview_assesment">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xE147;</i> Add <span>New Assesment</span></div></a>
							<?php } ?>	
						
					  </div>
            
            <br>
            <div class="container">
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
                       <th class="w-130">Date Added</th>
                        <th class="w-130">Applicant Name</th>
                        <th class="w-130">Job applied for</th>
                        <th class="w-130">Interviewer 1 Status</th>
                         <th class="w-130">HR Inteview Status</th>
                         <th class="w-130">Result</th>
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
					    <td class="w-130"><?php echo $row->date_added; ?></td>
                        <td class="w-130"><?php echo $row->applicant_name; ?></td>
                        <td class="w-130"><?php echo $row->job_applied_for; ?></td>
                         <td class="w-130">
                             <input type="hidden" id="ia_id" value="<?php echo $row->interview_assesment_id ?>">
                             <select class="ia_status" id="int_status">
                             <option value="1" <?php echo ($row->int_status == 1 ? 'selected': '') ?>>Waiting</option>
                             <option value="2" <?php echo ($row->int_status == 2 ? 'selected': '') ?>>In Progress</option>
                             <option value="3" <?php echo ($row->int_status == 3 ? 'selected': '') ?>>Complete</option>
                             </select></td>
                             <td class="w-130">
                             <input type="hidden" id="ia_id" value="<?php echo $row->interview_assesment_id ?>">
                             <select class="ia_status" id="hr_status">
                             <option value="1" <?php echo ($row->hr_status == 1 ? 'selected': '') ?>>Waiting</option>
                             <option value="2" <?php echo ($row->hr_status == 2 ? 'selected': '') ?>>In Progress</option>
                             <option value="3" <?php echo ($row->hr_status == 3 ? 'selected': '') ?>>Complete</option>
                             </select></td>
                           	<td  class="text-center" style="width:80px;">
						     <?php
                            if( $row->hired == 1) {
                            ?>
                             <input type="checkbox" class="toggle-hired" id="<?php echo $row->interview_assesment_id ?>" checked data-toggle="toggle" data-on="Hired" data-off="Not hired" data-offstyle="danger" data-onstyle="success">
                          <?php } else { ?>
                          
                         <input type="checkbox" class="toggle-hired" id="<?php echo $row->interview_assesment_id ?>"  data-toggle="toggle" data-on="Hired" data-off="Not hired" data-offstyle="danger" data-onstyle="success">

                          <?php } ?>
						</td>
                       <td style="display: flex;">
                             <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_interview_assesment/<?php echo $row->interview_assesment_id; ?>/view">
                           <i class="material-icons" data-toggle="tooltip" title="View"></i></a>
                             <a href="<?php echo base_url(); ?>index.php/Employeedetails/edit_interview_assesment/<?php echo $row->interview_assesment_id; ?>/edit">
                          <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" onclick="deletemodal(<?php echo $row->interview_assesment_id; ?>)"><i class="material-icons"></i></a>
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
<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Interview Assesment</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Assesment?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_ia">
						<input type="hidden" class="btn btn-danger" value="" id="ia_id">
					</div>
				</form>
			</div>
		</div>
	</div>	
	


<script type="text/javascript">
 function deletemodal(ia_id){
        $("#ia_id").val(ia_id);
        $("#deleteEmployeeModal").modal('show');
        
    }
$(".ia_status").on('change',function(){
    var status_id = $(this).val();
      var status_type = $(this).attr('id')
    var ia_id  = $("#ia_id").val();
 console.log(status_type);
  $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/update_ia_status",
		method:"POST",
		data:{status:status_id,ia_id:ia_id,status_type:status_type},
	    success:function(data){
		swal({
          text: "Status Updated Successfuly",
          icon: "success",
          timer: 1300
          });
			}
			
	});
    
})



$( function() {
    
  
    $('.toggle-hired').change(function() {
        var interview_assesment_id = $(this).attr('id')
     if($(this).prop('checked')){
         var hired = 1;
     }else{
         var hired = 0;
     }
     
     
     	$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/update_interview_status",
		    data: {"hired":hired,"interview_assesment_id":interview_assesment_id},
		    success: function(data){
                 console.log(data);
		    }
		});
		
		
    })
 
   
    
    
    $( "#datepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

 $( "#datepicker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

  });

</script>


<script type="text/javascript">
$(document).ready(function(){
    
    
    
    
    
   
    $("#delete_ia").on('click',function(){
        var ia_id = $("#ia_id").val();
      
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/Employeedetails/delete_ia",
		    data: {"ia_id":ia_id},
		    success: function(data){
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
