<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">


				<div style="margin-bottom:0px;" class="col-md-12 page-head">
				    
                  <span class="text-center">
						<h3>MANAGE ROSTERS</h3>
							</span>	
						<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
						<a class="btn btn-success btn-ph" href="<?php echo base_url(); ?>index.php/admin/roster_emp_table2_beta" title="Add Roster Using New Template" style="position: relative !important;">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xE147;</i> New <span>Template</span></div></a>
					
					
						<a class="btn btn-success btn-ph" href="<?php echo base_url(); ?>index.php/admin/roster_emp_table2" title="Add Roster Using Old Template" style="position: relative !important;">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xE147;</i> Old <span>Template</span></div></a>
					
						<a class="btn btn-success btn-ph" href="#" onclick="view_all_roster()" style="position: relative !important;">
						<div style="display:flex;align-items:center;"><i class="material-icons">&#xe417;</i> View <span>Selected Roster</span></div>
						</a>
							<?php } ?>
					    </div>

<div class="container-fluid" style="background-color:#fff;">
        <div class="table-wrapper">
            
			 <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="roster_filters">
									<div class="row">
									  	
										<div class="col-12 col-md-2">
											<input class="form-control" id="roster_name" type="text" placeholder="Roster Name">
										</div>
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
						<th>Roster Name</th>
							<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                        <th>Re Create</th>
                        	<?php } ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <form id="roster_list_form" action="<?php echo base_url(); ?>index.php/admin/view_all_roster" method="post">
                	<?php 
				$i = 0;
				if(isset($roster) && !empty($roster)){
				foreach($roster as $row){ ?>
				    
				   <tr>
                        
						<td style="width:50px;">
							<span class="custom-checkbox">
								<input type="checkbox"  name="options[]" value="<?php echo $row->roster_group_id ?>">
								<label></label>
							</span>
						</td>
                        <td class="w-130"><?php echo date("d-m-Y", strtotime($row->start_date)); ?></td>
                        <td class="w-130"><?php echo date("d-m-Y", strtotime($row->end_date)); ?></td>
						<td><?php echo $row->roster_name; ?></td>
							<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                        <td>
                           <?php if($row->roster_template == 1){ ?>
                                <a href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/recreate">Re Create</a>
                               <?php }else{ ?>
                               <a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/recreate">Re Create</a>
                               <?php } ?>
                            </td>
                         <?php } ?>
                       <td style="display: flex;">
                           <?php if($row->roster_template == 1){ ?>
                                <a href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/view"><i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a></a>
                            <?php }else{ ?>
                                <a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/view">
                                <i class="material-icons" data-toggle="tooltip" title="View">&#xe417;</i></a>
                            <?php } ?>
                            
                            
                           	<?php if($role !='employee' && $user_id != 265  && $user_id != 266){ ?>
                           	<?php if($row->roster_template == 1){ ?>
                            	<a href="<?php echo base_url(); ?>index.php/admin/week_roster_beta/<?php echo $row->roster_group_id ?>/edit">
                               <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <?php }else{ ?>
                            	<a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php echo $row->roster_group_id ?>/edit">
                               <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <?php } ?>
                            <a href="#" onClick="deletemodal(<?php echo $row->roster_group_id ?>)"  ><i class="material-icons">&#xE872;</i></a>
                            <?php
                            if( $row->roster_status == 1) {
                            ?>
                             <input type="checkbox" class="toggle-demo" id="<?php echo $row->roster_group_id ?>" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">
                          <?php } else { ?>
                          
                         <input type="checkbox" class="toggle-demo" id="<?php echo $row->roster_group_id ?>"  data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">

                          <?php } ?>
                          <?php } ?>
                           <!--<a href="<?php echo base_url(); ?>index.php/admin/week_roster/<?php // echo $row->roster_id ?>/delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>-->
                        </td>
                      
                    </tr>
                     <?php } 
                     }?>
                     </form> 
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
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Roster</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Roster?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_roster">
						<input type="hidden" class="btn btn-danger" value="" id="delete_roster_id">
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">


 $(function() {
    $('.toggle-demo').change(function() {
        var roster_group_id = $(this).attr('id')
     if($(this).prop('checked')){
         var roster_status = 1;
     }else{
         var roster_status = 0;
     }
     
     
     	$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/update_roster_status",
		    data: {"roster_status":roster_status,"id":roster_group_id},
		    success: function(data){
                 console.log(data);
		    }
		});
		
		
    })
  })

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
  function view_all_roster(){
      if($('input[name="options[]"]:checked').length > 0){
       $("#roster_list_form").submit();    
      }else{
          alert("Please Select Roster");
      }
     
  }
  
   function deletemodal(roster_group_id){
        $("#delete_roster_id").val(roster_group_id);
        $("#deleteEmployeeModal").modal('show');
        
    }
    
$(document).ready(function() { 
    
   
    $("#delete_roster").on('click',function(){
        
        var data1 = $("#delete_roster_id").val();
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/delete_roster",
		    data: {"id":data1},
		    success: function(data){
                   //alert(data);
                 location.reload();
		    }
		});
        
    });
    
    
    $("#contact_form").validate({
		ignore: "input[type='text']:hidden",
		rules: {
			route: {
				required:true
			}									
		},		
		messages: {
			route: {
				required:"Please enter route name"
			}	
		},

    });	
});
</script>

<script type="text/javascript">



	$(document).ready(function() { 
    $("#contact_form_edit").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			route: {
                required:true
            }									
			
	},		
	messages: {
			route: {
                 required:"Please enter route name"
            }	
	},

    });	
});

$("#roster_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#end_date").val())=='')
			end_date='unset';
		else end_date=$("#end_date").val();
		if($.trim($("#start_date").val())=='')
			start_date='unset';
		else start_date=$("#start_date").val();
		if($.trim($("#roster_name").val())=='')
			roster_name='unset';
		else roster_name=$("#roster_name").val();
		
		
	window.location.href="<?php echo base_url(); ?>index.php/admin/roster_filter/"+start_date+"/"+end_date+"/"+roster_name;

		
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
