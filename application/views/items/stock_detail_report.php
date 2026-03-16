<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Stock Detailed Report</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url();?>index.php/items/exportStockDetailedReport"><button type="button" class="btn btn-success btn-ph">Export to excel</button></a>
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
			$grand_gtotal = 0;
			foreach($supplier_items as $supplier){
			?>
			<table style="border: 2px solid #236ea6;" class="row-border text margin-top" cellspacing="0" width="100%" style="">
				<tr class="head">
					<td colspan="4"><span class=""><?php echo $supplier->supplier_name;?></span></td>
				</tr>
				<!-- category loop -->
				<?php foreach($supplier->categories as $category){ ?>
				
			
				<tr class="head-2">
					<td width="60%"><div class="cat-border"><?php echo $category['category_name'];?></div>Item Name</td>
					<td class="text-center" width="10%">Qty</td>
					<td class="text-center" width="15%">Unit Cost</td>
					<td class="text-right" width="15%">Current Value</td>
				</tr>
					<!-- items loop -->
					<?php 
					$totalAmount = 0;
					foreach($category['items'] as $items){
						$amount = ($items->price * $items->stock_quantity);
						$totalAmount = $totalAmount+$amount;
					?>
					<tr>
						<td width="60%" ><?php echo $items->itemName;?></td>
						<td class="text-center"  width="10%"><?php echo $items->stock_quantity;?></td>
						<td class="text-center" width="15%"><div class="price-border">$<?php echo number_format($items->price,'2','.','');?></div></td>
						<td class="text-right" width="15%">$<?php echo number_format($amount, '2','.','');?></td>
					</tr>
					<?php } ?>
					<!-- items loop end-->
				<tr class="custom-total">
					<td colspan="2"></td>
					<td class="text-right">Total</td>
					<td class="text-right">$<?php echo number_format($totalAmount,'2','.','');?></td>
					
					<?php $grand_gtotal = $grand_gtotal+$totalAmount;?>
				</tr>
				<?php } ?>
				<!-- category loop end -->
			</table>
			
			<!-- supplier loop end -->
			<?php }?>
				<div style="background-color:#236ea6;color:#fff;">
					<h4 class="text-right total">Grand Total &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<?php echo number_format($grand_gtotal,'2','.','');?></h4>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<script>
			
			function print_report(){
				//alert('hii');
			  var mywindow = window.open('', 'PRINT', 'height=400,width=600');
			  mywindow.document.write('<html><head><title>' + document.title  + '</title>');
			  mywindow.document.write('</head><body >');
			  mywindow.document.write('<h1>' + document.title  + '</h1>');
			  mywindow.document.write(document.getElementById('print_orders').innerHTML);
			  mywindow.document.write('</body></html>');
			  mywindow.document.close(); // necessary for IE >= 10
			  mywindow.focus(); // necessary for IE >= 10*/
			  //mywindow.close();
			  mywindow.print();
			  return true;
			}
		</script>