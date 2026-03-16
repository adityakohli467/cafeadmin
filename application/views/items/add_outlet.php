<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
</style>


<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3><?php if($outlet[0]->customer_user_id){ echo "Update Outlet"; }else{ echo "Add Outlet"; } ?></h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
		
			<button type="button" class="btn btn-success btn-ph" onclick="addOutlet();"><?php if($outlet[0]->customer_user_id){ echo "Update Outlet"; }else{ echo "Save Outlet"; } ?> </button>
		</div>
</div><!--.col-md-12 -->
			
<div class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			<div id="msg"></div>
			<div class="outletForm col-md-2"></div>
			<div class="outletForm col-md-8" style="margin:auto;">
			    <form id="addOutletForm">
			        <input type="hidden" name="customer_id" id="customer_id" value="<?php if($outlet[0]->customer_user_id){ echo $outlet[0]->customer_user_id; } ?>" class="form-control valid">
			         <div class="form-group">
					    <label for="username" class="col-sm-12 control-label">Outlet Name</label>
			            <div class="col-sm-12">
				            <input type="text" name="username" id="username" class="form-control valid" value="<?php if($outlet[0]->username){ echo $outlet[0]->username; } ?>">
				        </div>
				    </div>
				     
				    
			        <div class="form-group">
					    <label for="email" class="col-sm-12 control-label">Email</label>
			            <div class="col-sm-12">
				            <input type="text" name="email" id="email" class="form-control valid" value="<?php if($outlet[0]->email){ echo $outlet[0]->email; } ?>">
				        </div>
				    </div>
				    <div class="form-group">
					    <label for="password" class="col-sm-12 control-label">Password</label>
			            <div class="col-sm-12">
				            <input type="password" name="password" id="password" class="form-control valid">
				        </div>
				    </div>
			    </form>
			</div>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
		<script>
		    function addOutlet(){
            	var customer_id = $('#customer_id').val();
            	var email = $('#email').val();
            	var password = $('#password').val();
            	var username = $('#username').val();
            	
            	$.ajax({
            		type: "POST",
                    url: "<?php echo base_url();?>index.php/items/save_outlet",
                    data:{"customer_id":customer_id,"email":email,"password":password,"username":username},
                    success: function(data){
                        if(data == 'success'){
                            if(customer_id != ''){
                                $('#msg').html('<div class="hideMe"><p class="alert alert-success">Outlet updated successfully</p></div>');
                            }else{
                                $('#msg').html('<div class="hideMe"><p class="alert alert-success">Outlet added successfully</p></div>');
                            }
                        }else{
                    	 $('#msg').html('<div class="hideMe"><p class="alert alert-warning">something went wrong</p></div>');
                        }
                    }
                });
            }
		</script>
