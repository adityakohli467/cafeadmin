 <form class="form-horizontal"  role="form" method="post" action="<?php echo base_url(); ?>index.php/forms/GlobalFormSubmit" enctype="multipart/form-data">

	
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3><?php echo $page_heading; ?></h3>
			
			</span>
		</div>
	
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">
    
    <span class="validation_text">
           <h3>	<span class="alert-warning"><?php echo  $this->session->flashdata('message'); ?></span>  </h3>
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
        	<div class="col-md-6">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			      
	          		<div class="panel-body">
	          		    
	          		    <?php 
    	          		    if(!empty($fields)){
    	          		    foreach($fields AS $field){ 
	          		    ?>
	          		    	<div class="form-group">
							<label class="col-lg-4 col-sm-12 control-label"><?php echo $field['label']; ?><span><?php if($field['required'] == '1'){ echo '*'; } ?></span></label>
							<div class="col-lg-8 col-sm-12">
							<input type="<?php echo $field['type']; ?>" class="form-control" name="<?php echo $field['name']; ?>" value="<?php if(isset($field[0]->value)){ echo $field[0]->value; } ?>"  <?php if($field['required'] == '1'){ echo 'required'; } ?> >
							</div>
						</div>
						<?php } } ?>
						<input type="hidden" name="table_name" value="<?php echo $tablename; ?>">
				 <div class="btn-div col-lg-12 col-sm-12">
			         <button type="submit" name="formSubmit" id="form_submit" class="btn btn-success btn-ph">SUBMIT</button>
					<a href="<?php echo base_url(); ?>index.php/<?php echo $cancel; ?>">
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
