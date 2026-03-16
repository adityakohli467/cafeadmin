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


<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Stock Entry</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="button" class="btn btn-success btn-ph" onclick="clearStock();">Clear Stock</button>
			<button type="button" class="btn btn-success btn-ph" onclick="updateStock();">Save</button>
		</div>
</div><!--.col-md-12 -->
			
<div  style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			<div id="msg"></div>
			<select class="table-select app-select" id="supplier_id" onchange="getSupplierItems()" style="width:20%;">
				<?php 
				if(!empty($suppliers)){
					foreach($suppliers as $supp){ ?>
					<option value="<?php echo $supp->supplier_id;?>"><?php echo $supp->supplier_name;?></option>
				<?php }} ?>
			</select>
			
			<div class="table-up">
				<form id="items" method="post">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left" width="20%">Quantity</th>
						<th class="text-left" width="50%">Supplier Name</th>
						<th class="text-left" width="10%">Category</th>
						<th class="text-right" width="10%">Price</th>
						<th class="text-right" width="10%">Total Amout</th>
					</tr>
				</thead>
				<tbody id="supplier_items">
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
$(document).ready(function(){
    getSupplierItems();
});

function getSupplierItems(){
	var supId = $('#supplier_id').val();
	
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/getSupplierItemsStock",
        data:'supplier_id='+supId,
        success: function(data){
        	 //alert(data);
        	$('#supplier_items').html(data);
        }
    });
}

function updateStock(){
	var details = $('#items').serialize();
	
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/updateItemsStock",
        data:details,
        success: function(data){
        	 $('#msg').html('<div class="hideMe"><p class="alert alert-success">Stock updated successfully</p></div>');
        }
    });
}

function clearStock(){
	$('.stock_quantity').val('0');
	updateStock();
}

function calculateTotal(e,itemId,price){
	var qty = $(e).val();
	var total = Number(qty) * Number(price);
	var amount = Number(total).toFixed(2);
	$('#totalAmount-'+itemId).html('$'+amount);
}

	
</script>