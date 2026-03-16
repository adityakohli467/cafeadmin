<?php $userId = $this->session->userdata('user_id'); ?>
<!-- header_End -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Content_right -->
<div class="padding-0 page-head border-bottom ct-reports">
    <div class="container padding-0">
<div style="margin-bottom:0px;" class="col-md-12 ct-reports-title">
		
			<span class="text-center">
				<h3>Reports</h3>
			</span>
				
	</div>
</div>
</div>
            <!-- Section -->
			<div class="container">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card ct-report-card">
							<hr>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/admin/generate_report" method="POST">
									<div class="form-group row">
										<label class="col-sm-3 control-label text-right">Date From</label>
										<div class="col-sm-6">
											<input type="text" class="form-control datepicker" name="date_from" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 control-label text-right">Date To</label>
										<div class="col-sm-6"> 
											<input type="text" class="form-control datepicker" name="date_to" required>
										</div>
									</div>
									<div class="ct-report-btn">
										<button type="submit" class="btn btn-success btn-ph">Generate <i class="fa fa-bar-chart"></i>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--Report widget end-->
				</div>
			</div>
			<!-- Section_End -->
		

</div>
<script>
	$(function(){
		$(".datepicker").datetimepicker({
			format:'DD-MM-YYYY'
		})	
	})
</script>