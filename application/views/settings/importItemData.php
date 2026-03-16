	<form action="<?php echo base_url(''); ?>index.php/items/importCsvToDb" method="post" enctype="multipart/form-data">
				<div class="form-group mb-3">
					<div class="mb-3">
						<input type="file" name="itemdata" class="form-control" id="file">
					</div>					   
				</div>
				<div class="d-grid">
					<input type="submit" name="submit" value="Upload CSV" class="btn btn-dark" />
				</div>
			</form>