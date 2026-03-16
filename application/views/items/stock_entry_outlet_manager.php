<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
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
			
			 <div class="row">
			 <div class="col-12">    
			<div class="table-up table-responsive " style="width: 100%;">
			   <form id="items" method="post">
			<table id="" class="row-border table-condensed table table-bordered" cellspacing="0" width="100%" style="table-layout:fixed;">
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
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
<div id="loader" class="loader"></div>
		
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


$(document).ready(function(){
    getSupplierItems();
    $(document).ready(function() {
			$('.datatableSE').DataTable( {
		        'paging':false,
		        'order': [[2, 'desc']],
		        'bInfo':false,
		        "pageLength" : 10
		    } );
		} );
});

function getSupplierItems(){
	var supId = $('#supplier_id').val();
	$('#loader').show();
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/getSupplierItemsStock",
        data:'supplier_id='+supId,
        success: function(data){
        	 //alert(data);
        	$('#supplier_items').html(data);
        	$('#loader').hide();
        }
    });
}

function updateStock(){
    	$('#loader').show();
	let details = $('#items').serialize();
	let supId = $('#supplier_id').val();
	$.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/items/updateItemsStock",
         data:'supplier_id='+supId+'&'+details,
        success: function(data){
            	$('#loader').hide();
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