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
				<h3>Outlets</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url();?>index.php/items/add_outlet"><button type="button" class="btn btn-success btn-ph">Add Outlet</button></a>
		</div>
</div><!--.col-md-12 -->
			
<div class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			<div id="msg"></div>
			
			<div>
				<form id="items" method="post">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left" width="40%">Name</th>
						<th class="text-left" width="40%">Email</th>
						<th class="text-left" width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
				    <?php if(!empty($outletmanagers)){ 
				    foreach($outletmanagers as $outlet){ ?>
				    <tr>
				        <td><?php echo $outlet->username; ?></td>
				        <td><?php echo $outlet->email; ?></td>
				        <td><a class="btn btn-primary cxs-btn c-btn btn-xs" href="<?php echo base_url();?>index.php/items/edit_outlet/<?php echo $outlet->customer_user_id; ?>">Edit</a> 
				        <button class="btn btn-danger cxs-btn c-btn btn-xs" onclick="delete_outlet(<?php echo $outlet->customer_user_id; ?>);">Delete</button></td>
				    </tr>
				    <?php } } ?>
				</tbody>
			</table>
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
		
		   function delete_outlet(id){
		       $.ajax({
        			type: "POST",
        	        url: "<?php echo base_url();?>index.php/items/delete_outlet",
        	        data:'id='+id,
        	        success: function(data){
        	        console.log(data);
        	       
        	        }
                });
		   }
		   
		</script>
