		<div class="container main-container">
		<div class="row item">
<?php if(null !==$this->session->userdata('feedback')) { ?>  
<div class='hideMe'>
<p class="alert alert-success"><?php echo $this->session->flashdata('feedback'); ?></p>
</div>
	  
  <?php } ?>
					<div class="col-md-12">
					<h5 class="page-head">Modules List</h5>
					<div class="btn-div">
					
					<button type="button" class="btn btn-success" id="myBtn">Add Module</button>
					</div>

			  <!-- Modal -->
		    

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="contact_form" method="post" action="<?php echo base_url().'index.php/settings/add_module'; ?>" enctype="multipart/form-data">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Module</h4>
      </div>
        <div class="modal-body">
          
                                 <div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Module Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="moduleName"    autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Controller Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="controller"  autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Alias Name</label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="alias_name"    autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Upload image</label>
									<div class="col-md-8">
									<input type="file" class="form-control" name="picture">
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

			<!-- Modal -->

			<!--page-header-->

				<hr>

		<!--.table-->

		<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
					   
						<th class="text-left">Module Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($modules as $row){ ?>
					<tr class="tr">
					
						<td class="text-left"><a type="button" onClick="edit_row(<?php echo  $row->moduleId ?>);" class="update_user_button" value="${user.id}" ><?php echo $row->moduleName ?></a></td>
						<td class="text-center"><a type="button" onClick="delete_row(<?php echo  $row->moduleId ?>);"><span class="glyphicon glyphicon-remove"></span></a></td>
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
     <form role="form" id="contact_form_edit" method="post" action="<?php echo base_url().'index.php/settings/submit_update_module'; ?>" enctype="multipart/form-data">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Module</h4>
      </div>
        <div class="modal-body">
                                 <input type="hidden" id="myText1" name="id">
                                 <div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Module Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="moduleName" id="myText2" autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label">Controller Name <span>*</span></label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="controller"  id="myText3" autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Alias Name</label>
									<div class="col-md-8">
									<input type="text" class="form-control" name="alias_name" id="myText7"  autocomplete="off">
								    </div>
								</div>
								<div class="form-group row">
								 <label for="exampleInputEmail1" class="col-md-4 control-label why">Image</label>
								 <div class="col-md-8">
                                 <input type="hidden" id="myText5">
                                 <img src="" id="nameimage">
								<div id="imageLoad"></div>
                                 </div>
								 
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Upload Image</label>
									<div class="col-md-8">
									<input type="file" class="form-control" name="picture" id="myText5">
								    </div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-md-4 control-label why">Clearance Level <span>*</span></label>
									<div class="col-md-8">
									<select class="form-control" name="clear" id="myText6">
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
if(confirm('Are you sure you want to delete module')){
		    $.ajax({
		
		type: "POST",
        url: "<?php echo base_url();?>index.php/settings/module_row_del",
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
        url: "<?php echo base_url();?>index.php/settings/module_row_get",
        data:'id='+str,
        success: function(data){

			var obj = jQuery.parseJSON(data);
	
		
			document.getElementById("myText1").value = obj.moduleId;
			document.getElementById("myText2").value = obj.moduleName;
			document.getElementById("myText3").value = obj.controller;
			document.getElementById("myText6").value = obj.clearanceLevel;
			document.getElementById("myText7").value = obj.aliasName;
			var val=document.getElementById("myText5").value = obj.image;
			


            var one="<?php echo base_url(); ?>images/modules/";	
           var two=one+val;
		   
		   			document.getElementById("nameimage").src=two;

//alert(two);exit;



   // var img = document.createElement("img");
    //img.src = two;
	//document.getElementById("imageLoad").appendChild(img);



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
    $("#myBtn").click(function(){
        $("#myModal").modal();
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
    $("#contact_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			moduleName: {
                required: true,
            },
            controller :{
            	 required: true,
            },
            clear: {
                required: true,
            }
			
	},		
	messages: {
			moduleName: {
                 required:"Please enter module name"
            },
            controller :{
            	  required:"Please enter controller name"
            },
            clear: {
                 required:"Please select clearance level"
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
			moduleName: {
                required: true,
            },
            controller :{
            	 required: true,
            },
            clear: {
                required: true,
            }
	},		
	messages: {
			moduleName: {
                 required:"Please enter module name"
            },
            controller :{
            	  required:"Please enter controller name"
            },
            clear: {
                 required:"Please select clearance level"
            }		
	},

    });	
});
</script>
