	
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Product Categories</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="button" class="btn btn-success btn-ph" id="myBtn">Add Product Category</button>
		</div>
	</div><!--.col-md-12 -->
					
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="contact_form" method="post" action="<?php echo base_url().'index.php/items/add_item_cat'; ?>">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product Category</h4>
      </div>
        <div class="modal-body">
          
         <div class="form-group row">
			<label for="exampleInputEmail1" class="col-md-4 control-label">Category Name<span>*</span></label>
			<div class="col-md-8">
			<input type="text" class="form-control" name="cat_name" onBlur="capitalize(this)"  autocomplete="off">
		    </div>
		</div>
		<div class="form-group row">
			<label for="exampleInputEmail1" class="col-md-4 control-label">Status</label>
			<div class="col-md-8">
			<input type="radio" name="status" checked value="1">Active
			<input type="radio" name="status" value="0">In Active
		    </div>
		</div>
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success btncolor">Save</button>
          <button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
	
	<div style="background-color:#fff;" class="container-fluid main-container">
		
	<div class="col-md-12">
		
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
				<?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
				<div class='hideMe'>
					<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
				</div>
				<?php } ?>
				<?php if(null !==$this->session->userdata('error_msg')) { ?>  
				<div class='hideMe'>
					<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
				</div>
				<?php } ?>
		<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>					   
						<th class="text-left">Category Name</th>
						<th class="text-left">Status</th>
						<!--<th></th>-->
					</tr>
				</thead>
				<tbody>
				<?php foreach($item_category as $row){ ?>
					<tr class="tr">
						
						<td class="text-left"><a type="button" onClick="edit_row('<?php echo $row->category_id ?>')" id="<?php echo $row->category_id ?>" class="update_user_button" ><?php echo $row->category_name ?></a></td>
						<td class="text-left"><?php if($row->status == "1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
						<!--<td class="text-center"><a type="button" onClick="delete_row('<?php echo  $row->category_id; ?>')"><span class="glyphicon glyphicon-trash" ></span></a></td>-->
					</tr>
		        <?php } ?>
					</tbody>
					</table>
				</div>
			</div>
			</div>
		</div><!--.container-->
		<!--.table-->
		<br>

<div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="contact_form_edit" method="post" action="<?php echo base_url().'index.php/items/update_item_category'; ?>">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
        <div class="modal-body">
             <input type="hidden" id="myText1" name="id">
             <div class="form-group row">
				<label for="exampleInputEmail1" class="col-md-4 control-label">Category Name <span>*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" name="cat_name" onBlur="capitalize(this)" id="category_name"  autocomplete="off">
			    </div>
			</div>
			<div class="form-group row">
				<label for="sel1" class="col-md-4 control-label">Status</label>
				<div class="col-md-8">
					<div class="status-radio">
						<div class="product_status">
						<span><input type="radio" name="status" value="1"  >Active</span>
						<span><input type="radio" name="status" value="0"  >Disabled</span>
						</div>
                   <!--<input type="text" class="form-control" value="<?php echo $row->status; ?>" name="status"   placeholder="Enter Status" autocomplete="off">-->
					</div>
				</div>
			</div>
			
        </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-success btncolor">Save</button>
          <button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
		<!--.footer-->
	<script type="text/javascript">
	function delete_row(str){

if(confirm('Are you sure you want to delete category')){

		    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/category_delete",
        data:'id='+str,
        success: function(data){
          location.reload();
        }
       });
	}	
	}
	</script>	


<script>
	function edit_row(str){
    
		    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/edit_item_cat",
        data:'id='+str,
        success: function(data){
        	//alert(data);
			var obj = jQuery.parseJSON(data);
			 document.getElementById("myText1").value = obj.category_id;
		     document.getElementById("category_name").value = obj.category_name;
		     
			  if (obj.status == '1'){
			   $('.product_status').find(':radio[name=status][value="1"]').prop('checked', true);
			  }else{
			  $('.product_status').find(':radio[name=status][value="0"]').prop('checked', true);
			  }
			

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
			cat_name: {
                required:true
            }									
			
	},		
	messages: {
			cat_name: {
                 required:"Please provide category name"
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
			cat_name: {
                required:true
            }									
			
	},		
	messages: {
			cat_name: {
                 required:"Please provide category name"
            }	
	},

    });	
});
</script>
