<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
<style>
    table.table td.action-icons a {
    color: #000;
}
 table.table td.action-icons a:hover {
    color: #FFC107;
}
</style>	      
				<div style="margin-bottom:0px;float:none" class="col-md-12 page-head border-bottom">
                		<span class="text-center">
                				<h3><?php echo $heading; ?></h3>
                			</span>
                		
                			<a href="<?php echo base_url(); ?>index.php/forms/addRecipe/<?php echo $recipe_type; ?>">
                			<button type="button" class="btn btn-success btn-ph">Add New</button></a>
                		
                	</div>
           
            <br>
	<div class="container-fluid">
        <div class="table-wrapper">
           <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="menu_filters">
									<div class="row">
									    
									   <div class="col-12 col-md-2 ">
									       
										    <input class="form-control " id="recipe_name" type="text" placeholder="Recipe Name">
										</div>
										
										<div class="col-12 col-md-1">
												<button class="btn btn-success">Go</button>
											</div>
									</div>
								</form>
							</div>
						</div> 
			<div class="ct-scroll">
            <table class="table table-striped table-hover roaster-tb">
                <thead>
                    <tr>
					
						<th style="width:60%;">Recipe Name</th>
						<th style="width:10%;">Status</th>
						<th style="width:15%;">Recreate</th>
                        <th style="width:15%;" class="text-center">Action</th>
                           
                    </tr>
                </thead>
                <tbody id="formRow">
                	<?php 
				$i = 0;
				if(!empty($recipes)){
				foreach($recipes as $row){ ?>
			
                    <tr>
						
							<td><div class="col-sm-8">
			                <?php if(isset($row->recipe_name)){ echo $row->recipe_name; } ?>
								
							</div></td>
							<td><?php if(isset($row->status) && $row->status == '1'){ echo 'Active'; }else{  echo 'Deactive'; }?></td>
							<td class="text-center"><a class="btn btn-success" href="<?php echo base_url(); ?>index.php/forms/recreateRecipe/<?php echo $row->haacp_recipe_form_id ?>">Recreate</a></td>
							
                        	<td class="text-center action-icons">
                        	    <a class="edit" href="<?php echo base_url(); ?>index.php/forms/viewRecipe/<?php echo $row->haacp_recipe_form_id ?>"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp;&nbsp;
                        	   <a class="edit" href="<?php echo base_url(); ?>index.php/forms/editRecipe/<?php echo $row->haacp_recipe_form_id ?>"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp;&nbsp;
                       <a class="delete" onClick="deletemodal(<?php echo $row->haacp_recipe_form_id ?>)"  ><span class="glyphicon glyphicon-trash"></span></a> 
                      
                        </td>
                        
                       
                    </tr>
                    <?php }  }
                    else{ ?>
                    <tr><td colspan="4" align="center">No Record Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
			</div>	
			<input type="hidden" value="<?php echo $table_name; ?>" class="table_name">
			<div class="clearfix">
                <div class="hint-text"><?php  echo $result_count; ?></div>
                 <?php echo $this->pagination->create_links(); ?>
            </div>
            
            
        </div>
    </div>
<br>
		<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Recipe</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete this Recipe ?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_document">
						<input type="hidden" class="btn btn-danger" value="" id="delete_document_id">
						<input type="hidden" class="btn btn-danger" value="" id="table_name">
					</div>
				</form>
			</div>
		</div>
	</div>
	


<script type="text/javascript">

function deletemodal(document_id){
        var tablename = $(".table_name").val();
        $("#delete_document_id").val(document_id);
         $("#table_name").val(tablename);
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
		var tablename = $("#table_name").val();
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/forms/record_delete",
		    data: {"id":data1,"tablename":tablename},
		    success: function(data){
                //   alert(data);
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
<script>

	$("#menu_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#recipe_name").val())=='')
			recipe_name='';
		else recipe_name=$("#recipe_name").val();
	
		
		var recipe_type = "<?php echo $recipe_type ?>";
		
		$.ajax({
				type: "POST",
		        url: "<?php echo base_url(); ?>index.php/forms/filterForm",
		        data:'recipe_name='+recipe_name+'&recipe_type='+recipe_type,
		        success: function(data){
		        $("#formRow").html('');
		        $("#formRow").append(data);
		        }
	        });

});
</script>