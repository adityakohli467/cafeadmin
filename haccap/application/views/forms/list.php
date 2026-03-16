<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
				<div style="margin-bottom:0px;float:none" class="col-md-12 page-head border-bottom">
                		<span class="text-center">
                			<h3><?php echo $page_heading; ?></h3>
                				
                			</span>
                			<a href="<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>">
                			<button type="button" class="btn btn-success btn-ph"><?php echo $button_heading; ?></button></a>
                	</div>  <br>
	<div class="container-fluid">
	    <h3>	<span class="alert-success"><?php echo  $this->session->flashdata('message'); ?></span>  </h3>
        <div class="table-wrapper">
			<div class="ct-scroll">
            <table class="table table-striped table-hover roaster-tb">
                <thead>
                    <tr>
						<th style="width:50px;"><span class="custom-checkbox"><input type="checkbox" id="selectAll"><label for="selectAll"></label></span>	</th>
						<th>Activity</th>
                        <th>Recorded Date</th>
                        <th>Recorded By</th>
                        <th>Recorded At</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                	<?php 
				$i = 0;
				if(!empty($reviews)){
				foreach($reviews as $row){ ?>
                    <tr>
						<td style="width:50px;"> <span class="custom-checkbox"><input type="checkbox" id="checkbox1" name="options[]" value="1">	<label for="checkbox1"></label>	</span></td>
						<td><div class="col-sm-8"> 	<?php echo (isset($row->activity) ? $row->activity : ''); ?> </div></td>
		                <td><div class="col-sm-8"> 	<?php echo (isset($row->whenRecorded) ? $row->whenRecorded : ''); ?> </div></td> 
						<td><div class="col-sm-8"> 	<?php echo (isset($row->whoRecorded) ? $row->whoRecorded : ''); ?> </div></td>
						<td><div class="col-sm-8"> 	<?php echo (isset($row->whereRecorded) ? $row->whereRecorded : ''); ?> </div></td>
                      <td><a href="<?php echo base_url(); ?>index.php/forms/view_review/<?php echo $row->id ?>"><span class="material-icons">visibility</span> </a> <a href="<?php echo base_url(); ?>index.php/forms/view_review/<?php echo $row->id ?>/edit">  <span class="material-icons">edit</span> </a>  <a href="#" onClick="deletemodal(<?php echo $row->id ?>)"  ><span class="material-icons">delete</span></a>  </td>
                    </tr>
                    <?php }  }  else{ ?>
                    <tr><td colspan="5" align="center">No Record Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
			</div>	
			<div class="clearfix">
                <p style=" font-size: 14px;font-weight: 600;"><?php echo $links; ?></p>
            </div>
        </div>
    </div>
<br>
<input type="hidden" class="table_name" value="<?php echo $tablename; ?>">
		<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Review</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete this Review ?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_review">
						<input type="hidden" class="btn btn-danger" value="" id="review_id">
						<input type="hidden" class="btn btn-danger" value="" id="table_name">
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">

function deletemodal(id){
        var table_name = $(".table_name").val();
        $("#review_id").val(id);
         $("#table_name").val(table_name);
        $("#deleteEmployeeModal").modal('show');
       
        
    }

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
    
    
    
    $("#delete_review").on('click',function(){
        
        var data1 = $("#review_id").val();
		var tablename = $("#table_name").val();
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/forms/delete_review",
		    data: {"id":data1,"table_name":tablename},
		    success: function(data){
                   //alert(data);
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
