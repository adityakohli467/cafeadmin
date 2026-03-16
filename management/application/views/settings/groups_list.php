<div class="container main-container">
	<div class="row item">
		<?php if(@$message){ ?>
		  <div class="alert alert-danger hideMe">
		      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      <?php echo $message;?>
		      </div>
		  <?php } ?>
		<?php if(null !==$this->session->userdata('success_msg')) { ?>  
		<div class='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?></p>
		</div>
		<?php } ?>
		<?php if(null !==$this->session->userdata('error_msg')) { ?>  
		<div class='hideMe'>
		<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
		</div>
		<?php } ?>
		<div class="col-md-12">
			<h5 class="page-head">Groups List</h5>
			<div class="btn-div">
				<button type="button" class="btn btn-success btn-ph" id="addGroup">Add Group</button>
			</div>


  <!-- Modal -->
  <div class="modal fade" id="addGroupModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="addgroup_form" method="post" action="<?php echo base_url().'index.php/settings/add_group'; ?>" enctype="multipart/form-data">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Group</h4>
      </div>
        <div class="modal-body">
          
                                 <div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Group Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="name" onBlur="capitalize(this)"   autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Alias Name</label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="alias_name"   autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Description</label>
									<div class="col-md-8">
									<textarea class="form-control" colspan="5" onBlur="capitalize(this)" name="description"></textarea>
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Clearance Level <span>*</span></label>
									<div class="col-md-8">
									<select class="form-control" name="clear">
									<option value="">Select</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									</select>
								    </div>
								</div>
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success">Save</button>
          <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
				</div><!--.col-md-12 -->
			</div>
	<!--.row -->

				<hr>

		<!--.table-->

		<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
					   
						<th class="text-left">Group Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($groups as $row){ ?>
					<tr class="tr">
					
						<td class="text-left"><a type="button" onClick="edit_row(<?php echo  $row->id ?>);" class="update_user_button" value="${user.id}" ><?php echo $row->name ?></a></td>
						<td class="text-center"><a type="button" onClick="delete_row(<?php echo  $row->id ?>);"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
		        <?php } ?>
					</tbody>
					</table>
		</div><!--.container-->
		<!--.table-->
		<br>
		 <div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     <form role="form" id="group_edit_form" method="post" action="<?php echo base_url().'index.php/settings/submit_update_group'; ?>" enctype="multipart/form-data">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Group</h4>
      </div>
        <div class="modal-body">
                                 <input type="hidden" id="myText1" name="id">
                                <div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Group Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="name" onBlur="capitalize(this)" id="myText2"  autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Alias Name</label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="alias_name" id="myText6"   autocomplete="off">
								    </div>
								    </div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Description</label>
									<div class="col-md-8">
                                 <textarea class="form-control" colspan="5" name="description" onBlur="capitalize(this)" id="myText3"></textarea>
								 </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Clearance Level <span>*</span></label>
									<div class="col-md-8">
									<select class="form-control" name="clear" id="myText4">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								    </div>
								</div>
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success">Save</button>
          <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      </div>
    </div>

		<!--.footer-->
<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete group')){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/settings/group_row_del",
				data:'id='+str,
				success: function(data){
					location.reload();
				}
			});
		}	
	}
</script>	

<script type="text/javascript">
	function edit_row(str){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>index.php/settings/group_row_get",
			data:'id='+str,
			success: function(data){
			var obj = jQuery.parseJSON(data);
				document.getElementById("myText1").value = obj.id;
				document.getElementById("myText2").value = obj.name;
				document.getElementById("myText6").value = obj.aliasName;
				document.getElementById("myText3").value = obj.description;
				document.getElementById("myText4").value = obj.clearanceLevel;
			}
		});
	}
</script>
		
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});
</script>
<script>
$(document).ready(function(){
    $("#addGroup").click(function(){
        $("#addGroupModal").modal();
    });
});
</script>
<script>
$("#updateModal").modal({
    show: false
});

$(".update_user_button").click(function () {
    $("#updateModal").modal();
});
</script>

<script type="text/javascript">
	$(document).ready(function() { 
    $("#addgroup_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			name: {
                required: true,
            },
            clear: {
                required: true,
            }
			
		},		
		messages: {
			name: {
	            required:"Please enter group name"
	        },
	        clear: {
	            required:"Please select clearnce level"
	        }
		},

    });	
});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#group_edit_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			name: {
                required: true,
            },
            clear: {
                required: true,
            }
			
	},		
	messages: {
			name: {
                 required:"Please enter group name"
            },
	        clear: {
	            required:"Please select clearnce level"
	        }
	},

    });	
});
</script>
