<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
	<div>
        <div>
          
				<div style="margin-bottom:0px;" class="col-md-12 page-head">
                  <span class="text-center">
						<h3>DOCUMENTS</h3>
							</span>	
						
						
					  </div>
            <div class="container main-container">
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
						<th>Document Name</th>
						<th>Document File </th>
                        <th>Document ID</th>
                        <th>Action</th>
                           
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
							<td><div class="col-sm-8">
				<input type="text"  readonly class="form-control"  name="doc_name"  autocomplete="off" required value="<?php if(isset($row->doc_name)){ echo $row->doc_name; } ?>">
								
							</div></td>
							
                        
						<td><div class="col-sm-8">
								<!--<input type="file" class="form-control" name="incident_file">-->
								<?php if((isset($row->document_name)) && ($row->document_name !='') && (file_exists("./uploaded_files/".$row->document_name))) {  ?>
							    <a style="width:36%;" class="btn btn-success" href="<?php echo base_url();?>uploaded_files/<?php echo $row->document_name; ?>" target="_blank">View</a>
								 <?php } ?>
							</div></td>
							
						<td style="display: flex;">
                       <?php  echo $row->document_id;?>   
                        </td>
                        	<td>
                        	    <?php if($role !="employee") { ?>
                       <a href="#" onClick="deletemodal(<?php echo $row->document_id ?>)"  ><i class="material-icons">&#xE872;</i></a> 
                       <?php } ?>
                        </td>
                        
                       
                    </tr>
                    <?php }  }?>
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

		<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Document</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete this Document ?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_document">
						<input type="hidden" class="btn btn-danger" value="" id="delete_document_id">
					</div>
				</form>
			</div>
		</div>
	</div>
	


<script type="text/javascript">

function deletemodal(document_id){
        $("#delete_document_id").val(document_id);
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
    
    
    
    $("#delete_document").on('click',function(){
        
        var data1 = $("#delete_document_id").val();
		
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/delete_document",
		    data: {"id":data1},
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
