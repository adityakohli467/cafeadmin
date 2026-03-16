
	<div class="row item">
			</div>
			
			<form class="form-horizontal" id="employee_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/create_role" enctype="multipart/form-data">

	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>ADD ROLE</h3>
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    <span class="validation_text">
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title"><b>ROLE DETAILS</b></h3>
			        </div>
	          		<div class="panel-body">
						<div class="form-group">
							<label for="businessname" class="col-lg-4 col-sm-12 control-label">Role Name:<span>*</span></label>
							<div class="col-lg-8 col-sm-12">
		                   <input type="text" class="form-control" name="role_name"  autocomplete="off" required >
							</div>
						</div>
						
						
						<div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="contact_submit" id="contact_submit" class="btn btn-success btn-ph">ADD</button>
					<a href="<?php echo base_url(); ?>index.php/admin/manage_employee">
						<button type="button"  class="btn btn-ph btn-ph-cancel btn-success">CANCEL</button>
					</a>
		            </div>
		
		
					
					
	          		</div>
        		</div>
	        </div>
	    </div>
	</div>
  
   </div>
  </form>
  <br>
  <script>
$(function() {
        $('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startDate: '-3d'
        });
    });
</script>

	<style>
 	label.error, label>span{
 		color:red;
 	}
 	.validation_text p{
 	 color: red;
    font-size: 15px;
    font-weight: 600;
 	}
    </style>
</body>
</html>
