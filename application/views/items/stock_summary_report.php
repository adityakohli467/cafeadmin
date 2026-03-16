<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Stock Summary Report</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url();?>index.php/items/exportStockSummaryReport"><button type="button" class="btn btn-success btn-ph">Export to excel</button></a>
			<button type="button" class="btn btn-success btn-ph" onclick="window.print();">Print</button>
		</div>
</div><!--.col-md-12 -->
			
<div style="background-color:#fff" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			
			<div>
			<!-- supplier loop -->
			<?php 
			foreach($supplier_items as $supplier){
			?>
			<table style="border: 2px solid #236ea6;" class="row-border text margin-top" cellspacing="0" width="65%" style="">
				<tr class="head">
					<td colspan="2" class=""><?php echo $supplier->supplier_name;?></td>
				</tr>
				
				<tr class="head-2">
					<td>Category</td>
					<td class="text-center">Total</td>
				</tr>
				<!-- category loop -->
				<?php 
				$totalAmount = 0;
				foreach($supplier->categories as $category){
					$amount = 0;
					foreach($category['items'] as $items){
						$amount = $amount+$items;
					}
					
					$totalAmount = $totalAmount+$amount;
				?>
				<tr>
					<td style="width:70%;"><?php echo $category['category_name'];?></td>
					<td class="text-center" style="width:30%;"><div class="price-border">$<?php echo number_format($amount, '2','.','');?></div></td>
				</tr>
			
				
				<?php } ?>
				<tr class="custom-total">
					<td class="total text-right" style="width:70%;">Group Total</td>
					<td class="text-right total"style="width:30%;">$<?php echo number_format($totalAmount, '2','.','');?></td>
				</tr>
				
				<!-- category loop end -->
			</table>
			
			<!-- supplier loop end -->
			<?php }?>
			
		
			</div>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		