		
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
	
	<div class="col-md-12 page-head border-bottom">
		<span class="text-center">
			<h3>Standing Orders</h3>
		</span>
	</div><!--.col-md-12 -->
				
	<div  style="background-color:#fff" class="container-fluid main-container">
		<div class="col-md-12">
			<div style="box-shadow:none;" class="panel panel-default">
				<div class="gradient"></div>
				<div class="panel-body">
					<table class="row-border table-condensed datatable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-center">Order Date</th>
								<th class="text-center">Purchase order No.</th>
								<th class="text-left">Supplier</th>
								<th class="text-right">Order Total</th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if(!empty($orders)){
						foreach($orders as $row){
							if($row->order_status == 'Sent'){
								$color = "style='color:#29cad2;text-transform:uppercase;'";
							}else if($row->order_status == 'Viewed'){
								$color = "style='color:#236ea6;text-transform:uppercase;'";
							}else if($row->order_status == 'Confirmed'){
								$color = "style='color:#2a1ab9;text-transform:uppercase;'";
							}else{
								$color = "style='color:#3f9601;text-transform:uppercase;'";
							}
								?>
							<tr class="tr">
								<td class="text-center"><a href="<?php echo base_url();?>index.php/orders/standingOrderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo date('d-m-Y',strtotime($row->order_date)); ?></a></td>
								<td class="text-center"><a href="<?php echo base_url();?>index.php/orders/standingOrderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo $row->order_number; ?></a></td>
								<td class="text-left"><?php echo $row->supplier_name; ?></td>
								<td class="text-right">$<?php echo number_format($row->order_total, '2','.',''); ?></td>
								
								<td class="text-center">
									<a type="button" onClick="delete_row(<?php echo  $row->order_id; ?>);"><span class="glyphicon glyphicon-remove"></span></a>
								</td>
							</tr>
						<?php }} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
<script type="text/javascript">
	function delete_row(str){

if(confirm('Are you sure you want to remove from standing orders')){
		    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/orders/standing_order_update",
        data:'id='+str,
        success: function(data){
        	//alert(data);
          location.reload();
        }
       });
	}	
	}
	</script>
