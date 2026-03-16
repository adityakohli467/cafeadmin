<style>
    input.btn.btn-success {
    margin-top: 15px;
    margin-left: auto;
    height: auto;
}
.panel {
    padding: 30px 21px;
}
</style>
	<div  class="col-md-12 page-head border-bottom">
		
			<span class="text-center">
				<h3>EMPLOYEE JOB DESCRIPTION</h3>
			</span>
		
      
	</div><!--.col-md-12 -->
<div class="container-fluid main-container">
	
  		<div class="row">
  			
        	<div class="col-lg-6 col-md-12">
        	    <div class="panel pn">
        	    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_employee_job_desc" enctype="multipart/form-data">
                <?php foreach($employee as $row){ ?>
                <input type="hidden" name="emp_id" value="<?php echo $row->emp_id; ?>">
                <div class="form-group">
							<label for="job-desc" class="col-sm-4 control-label"><b>Upload Job Description:</b></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" id="job-desc" name="job_desc">
							</div>
				</div>
                
                <?php } ?>
                <input type="submit" value="Update" class="btn btn-success">
                </form>	
                </div>
             </div>
        </div>
</div>
        	    
