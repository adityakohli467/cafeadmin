<div class="row item">
			</div>
		
	   
	
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
	<?php echo validation_errors(); ?>
	<span>
	  		<div class="row">
  			<div class="col-md-12">
  			    	<div class="card ct-report-card">
						
							<div class="card-body">
                    	<div class="form-list">
                    	    <div class="form-item">
                    	        <a href="<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>/form1">Incoming Goods Record </a>
                    	    </div>
                    	
                    	    <div class="form-item">
                    	        <a href="<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>/form11">Food Van Temp Record </a>
                    	    </div>
                    	</div>
                    </div>
                </div>    
	    </div>
	</div>
  
   </div>
 
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
