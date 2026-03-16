<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
.stockEntryTable div#example_filter {
    display: none !important;
}
.app-input{
	width: 100%;
	background-color: white;
	border: 1px solid #dbdbdb;
	border-radius: 0px;
	display: inline-block;
	font: inherit;
	line-height: 1.5em;
	padding: 0.5em 3.5em 0.7em 1em;
	margin: 0;      
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	-webkit-appearance: none;
	-moz-appearance: none;
}
.theadclass th{
    background-color: #563d7c !important;
    color: white !important;
    align-content: center !important;
}

.loader {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    left: 50%;
    top: 50%;
    width: 60px;
    height: 60px;
    margin: -30px 0 0 -30px;
    border: 8px solid #f3f3f3; /* Light grey */
    border-top: 8px solid #3498db; /* Blue */
    border-radius: 50%;
    animation: spin 2s linear infinite;
}

/* Spin animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.dimmed-background {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    z-index: 9998; /* One less than the loader to ensure it's behind the loader */
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
			<button type="button" class="btn btn-danger btn-ph" onclick="downloadStock();">Download  Report</button>
			<button type="button" class="btn btn-success btn-ph" onclick="updateStock();">Save</button>
		</div>
</div><!--.col-md-12 -->
			
<div  style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			<div id="msg"></div>
			
			 <div class="row">
		    <div class="col-md-6">
			    <div class="input-group" style="margin-bottom:20px;width: 50%;">
			<input type="text" id="searchBox" class="form-control" placeholder="Search by item name...">
			</div>
			</div>
			 <div class="col-md-6">
			<div class="input-group" style="margin-bottom:20px;width: 50%;">
			<select class="table-select app-select form-control" id="supplier_id" onchange="getSupplierItems()" >
				<?php 
				if(!empty($suppliers)){
					foreach($suppliers as $supp){ ?>
					<option value="<?php echo $supp->supplier_id;?>"><?php echo $supp->supplier_name;?></option>
				<?php }} ?>
			</select>
			</div>
		</div>	
			</div>
			
			<!--<input type="text" placeholder="Search Product" class="table-select app-input" id="productSearch" onchange="getSupplierItems()" style="width:20%">-->
			

			<div class="stockEntryTable table-responsive">
				<form id="items" method="post">
			<table id="" class="row-border table-bordered table" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead class="theadclass">
					<tr>
					   
						<th class="text-left" width="40%">Item Name</th>
						<th class="text-left" width="20%">Price</th>
					    <?php 
				if(!empty($outletmanagers)){
					foreach($outletmanagers as $outletmanager){ ?>
					<th class="text-left" width="20%"><?php echo $outletmanager->username;?></th>
				<?php }} ?>
						
						<th class="text-left" width="10%">Total Stock</th>
						<!--<th class="text-right" width="10%">Price</th>-->
						<th class="text-right" width="20%">Total Amout</th>
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
	<div id="loader" class="loader"></div>	
	<div id="dimmed-background" class="dimmed-background"></div>
<script>
$(document).ready(function() {
    // Bind an event handler to the search box
    $('#searchBox').on('keyup', function() {
        // Get the search term
        var searchTerm = $(this).val().toLowerCase();
        
        // Iterate over each row in the table body
        $('#supplier_items tr').each(function() {
            // Get the item name text
            var itemName = $(this).find('td.itemName').text().toLowerCase();
            
            // Check if the item name contains the search term
            if (itemName.indexOf(searchTerm) !== -1) {
                // Show the row if it matches the search term
                $(this).show();
            } else {
                // Hide the row if it doesn't match the search term
                $(this).hide();
            }
        });
    });
});
function showLoader() {
    document.getElementById('loader').style.display = 'block';
    document.getElementById('dimmed-background').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
    document.getElementById('dimmed-background').style.display = 'none';
}
$(document).ready(function(){
    getSupplierItems();
});

function getSupplierItems(){
	var supId = $('#supplier_id').val();
	showLoader();
// 	$('#loader').show();
	if(typeof $('#StockItemsOfOutlet').val() == 'undefined'){
	   var OutletId = ''; 
	}else{
	    var OutletId = $('#StockItemsOfOutlet').val();
	}
	if($('#productSearch').val() == ''){
	   var productName = ''; 
	}else{
	    var productName = $('#productSearch').val();
	}
	
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/getSupplierItemsStockAllOutlet",
        data:'supplier_id='+supId,
        success: function(data){
        	 //alert(data);
        	$('#supplier_items').html(data);
        		hideLoader();
        }
    });
}



function updateStock(){
    showLoader()
	var details = $('#items').serialize();
	var supId = $('#supplier_id').val();
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/updateItemsStockFromAdmin",
        // data:details,
         data:'supplier_id='+supId+'&'+details,
        success: function(data){
            	hideLoader();
        	 $('#msg').html('<div class="hideMe"><p class="alert alert-success">Stock updated successfully</p></div>');
        }
    });
}

function clearStock(){
	$('.stock_quantity').val('0');
	$('.itemTotalAmount').html('$0.00');
	updateStock();
}

function calculateTotal(e,itemId,price){
	var qty = $(e).val();
	var total = Number(qty) * Number(price);
	var amount = Number(total).toFixed(2);
	$('#totalAmount-'+itemId).html('$'+amount);
}

function downloadStock(){
  let supId = $('#supplier_id').val();  
  window.location.href= "<?php echo base_url();?>index.php/items/download_stoke_entry_report/"+supId
}
	
</script>