<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">


<div class="table-title table-title1">
                <div class="row">
                  
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
				    
                  <span class="text-center">
						<h3>MANAGE JOB APPLICATIONS</h3>
							</span>	
				
					
					    </div>
                </div>
            
</div>
<div class="container-fluid" style="background-color:#fff;">
        <div class="table-wrapper">
            
			 <!--<div class="card card-shadow mb-4" style="margin-bottom: 20px;">-->
				<!--			<div class="card-header">-->
				<!--				<h3 class="card-title">Filters</h3>-->
				<!--			</div>-->
				<!--			<div class="card-body">-->
				<!--				<form id="roster_filters">-->
				<!--					<div class="row">-->
									  	
				<!--						<div class="col-12 col-md-2">-->
				<!--							<input class="form-control" id="roster_name" type="text" placeholder="Roster Name">-->
				<!--						</div>-->
				<!--						<div class="col-12 col-md-2">-->
				<!--				   <input class="form-control datepicker" id="start_date" type="date" placeholder="Start Date">-->
				<!--						</div>-->
				<!--					<div class="col-12 col-md-2">-->
				<!--				   <input class="form-control datepicker" id="end_date" type="date" placeholder="End Date">-->
				<!--					</div>-->
				<!--				 <div class="col-12 col-md-1">-->
				<!--				  <button class="btn btn-primary">Go</button>-->
				<!--				 </div>-->
				<!--					</div>-->
									
								
				<!--				</form>-->
				<!--			</div>-->
				<!--		</div> -->
			<div class="ct-scroll">
			  <?php if($this->session->flashdata('success') !=''){ ?>
			  <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?> </div>
<?php } ?>  
            <table class="table table-striped table-hover roaster-tb" id="table">
                <thead>
                    <tr>
					 <th class="w-130">Applicant Name</th>
                        <th class="w-130">Job Applied For</th>
					    <th class="w-130">Experince</th>
					    <th class="w-130">City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
               
                	<?php 
				$i = 0;
				if(isset($applications) && !empty($applications) && is_array($applications)){
				foreach($applications as $row){ ?>
				    
				   <tr>
                   <td style="width:150px;"><?php echo $row->first_name; ?></td>
                        <td class="w-130"><?php echo $row->job_name; ?></td>
                        <td class="w-130"><?php echo $row->experience; ?></td>
                        <input type="hidden" id="applicant_mail" value="<?php echo $row->email; ?>">
						<td><?php echo $row->city; ?></td>
					
                       <td style="display: flex;">
                            <a href="<?php echo base_url(); ?>index.php/admin/view_applicants_data/<?php echo $row->applicants_details_id ?>/view">
                           <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                            <a href="#" onClick="deletemodal(<?php echo $row->applicants_details_id ?>)"  ><i class="material-icons">&#xE872;</i></a>
                            <?php
                            if( $row->status == 1) {
                            ?>
                             <input type="checkbox" class="toggle-demo" id="<?php echo $row->applicants_details_id ?>" checked data-toggle="toggle" data-on="Accept" data-off="Reject" data-offstyle="danger" data-onstyle="success">
                          <?php } else { ?>
                          
                         <input type="checkbox" class="toggle-demo" id="<?php echo $row->applicants_details_id ?>"  data-toggle="toggle" data-on="Accept" data-off="Reject" data-offstyle="danger" data-onstyle="success">

                          <?php } ?>
                        
                        </td>
                      
                    </tr>
                     <?php } 
                     }?>
                    
                </tbody>
            </table>
			</div>	
			<?php if(isset($result_count) && $result_count !='') { ?>
			<div class="clearfix">
                <div class="hint-text"><?php  echo $result_count; ?></div>
                 <?php echo $this->pagination->create_links(); ?>
            </div>
            <?php } ?>
            
        </div>
    </div>
	<!-- Edit Modal HTML -->
	
	
	<!-- Delete Modal HTML -->
	<div id="deleteApplicantModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Job</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Job?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_applicant">
						<input type="hidden" class="btn btn-danger" value="" id="delete_id">
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">


 $(function() {
    $('.toggle-demo').change(function() {
        var id = $(this).attr('id')
     if($(this).prop('checked')){
         var status = 1;
     }else{
         var status = 0;
     }
     var applicant_mail = $("#applicant_mail").val();
     
     	$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/employeedetails/update_applicants_details",
		    data: {"status":status,"id":id,"applicant_mail":applicant_mail},
		    success: function(data){
                 console.log(data);
		    }
		});
		
		
    })
  })

   function deletemodal(id){
        $("#delete_id").val(id);
        $("#deleteApplicantModal").modal('show');
        
    }
    
$(document).ready(function() { 
    
   
    $("#delete_applicant").on('click',function(){
        
        var id = $("#delete_id").val();
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/employeedetails/delete_row",
		    data: {"id":id},
		    success: function(data){
               
                 location.reload();
		    }
		});
        
    });
    
});
</script>

<script type="text/javascript">


// $("#roster_filters").on('submit',function(e){
// 		e.preventDefault();
// 		if($.trim($("#end_date").val())=='')
// 			end_date='unset';
// 		else end_date=$("#end_date").val();
// 		if($.trim($("#start_date").val())=='')
// 			start_date='unset';
// 		else start_date=$("#start_date").val();
// 		if($.trim($("#roster_name").val())=='')
// 			roster_name='unset';
// 		else roster_name=$("#roster_name").val();
		
		
// 	window.location.href="<?php echo base_url(); ?>index.php/admin/roster_filter/"+start_date+"/"+end_date+"/"+roster_name;

		
// });
</script>
<script type="text/javascript">

</script>
