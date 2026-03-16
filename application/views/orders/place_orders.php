    <link href="<?php echo base_url(); ?>res/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>res/bootstrap-datatable/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>res/bootstrap-datatable/css/dataTables.responsive.css" rel="stylesheet">

<body>
    
    
    <input type="hidden" id="store_force_comment">
    <div class="modal fade in" id="commentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- force place order Modal content-->
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="force_comment_form" method="post" action="#" novalidate="novalidate">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add Comments</h4>
      </div>
        <div class="modal-body">
		<div class="panel-group">
            <div class="panel panel-default">
          
            <div class="panel-body">
			   <div class="form-group">
	               
	                 <div class="col-sm-12"> Please mention the date and time the business has approved this order</div>
	              
	                
	                <div class="col-sm-12">
	                  <textarea class="form-control" name="force_comment" id="force_comment"></textarea>
	                </div>
	              </div>
			</div>
            </div>
			
	    </div>
		 </div>
        <div class="modal-footer">
		<input type="button" onclick="add_force_comment();" class="btn btn-success btncolor" value="Send Order">
          <button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
          
        </div>
        </form>
      </div>
      
    </div>
    </div>
  <ul id="ui-id-1" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="display: none;"></ul><ul id="ui-id-2" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="display: none;"></ul></div>
     <div class="overlayplaceorder" id='loader'></div>
   
    <main role="main" class="wrapper">
        <section class="header">
            <div class="bg-theme page-head">
                <h3 class="text-center">Place Orders</h3>
<input type="hidden" id="branch_budget" value="<?php echo $branch_budget;?>">
			<input type="hidden" id="orders_count" value="<?php echo $orders_count;?>">
            </div>
        </section>
        <section class="place-orders-list">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
					
                        <div class="place-orders">
                            <div class="row">
                                <div class="col-lg-12">
								<select class="table-select app-select ct-app-select" id="select_supplier_id" onchange="getSupplierItems(this)" >
										<option value="">Select Supplier</option>
										<option value="all">All Suppliers</option>
										<?php 
										if(!empty($branch_suppliers)){
										    
										  foreach($branch_suppliers as $supp){ ?>
										<option value="<?php echo $supp->supplier_id;?>"><?php echo $supp->supplier_name;?></option>
										<?php }} ?>
									</select>
									<select class="table-select app-select ct-app-select" id="select_category_id" onchange="getSupplierItems(this)" style="margin-left:5px;">
										<option value="all">All Categories</option>
										<?php 
										if(!empty($categories)){
										foreach($categories as $category){ ?>
										<option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
										<?php }} ?>
									</select>
					<div  class="dataTables_filter ct-supplier-filter"><label><input id="gsearchsimple" type="text" class="form-control input-sm" placeholder="Search Supplier Items"></label></div>
					<input type="hidden" id="supplier_id_for_search" value=''>
				
									<div class="alert alert-danger balancealert" role="alert" style="display:none;margin-top: 28px;">This branch weekly budget has exceeded, please take the approval from the business and please click <b>'Force Place Order'</b> button to send the order to the supplier.</div>
                                    <table style="width:100%" class="table table-striped" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="text-left" style="width:5%">Code</th>
												<th class="text-left" style="width:35%">Product Name</th>
												<th class="text-left" style="width:15%">Category</th>
												<th class="text-right" style="width:10%">Price/Uom</th>
												<th class="text-center" style="width:35%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="supplier_items">
                                            <tr><td colspan="5" class="text-center">Please select supplier</td><tr>
                                            <?php 
								// 			if(!empty($suppliers)){
								// 			foreach($suppliers as $supplieritems){
								// 				foreach($supplieritems as $items){
											?>
												<!--<tr class="tr">-->
												<!--	<td class="text-left"><?php echo $items->itemCode; ?></td>-->
												<!--	<td class="text-left"><?php echo $items->itemName; ?><br><small><?php echo $items->supplier_name; ?></small></td>-->
												<!--	<td class="text-left"><?php echo $items->category_name; ?></td>-->
												<!--	<td class="text-right">$<?php echo number_format($items->price,2,'.',''); ?>/<?php echo $items->uom; ?></td>-->
												<!--	<td class="text-center">-->
												<!--		<div class="handle-counter">-->
												<!--		  <button class="counter-minus btn abc order  " onclick="counterMinus(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`)" tabindex="-1" >-</button>-->
												<!--		  <input class="order" type="text"  value="0" id="<?php echo $items->itemId;?>" onchange="addItemToCart(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`);">-->
												<!--		  <button class="counter-plus btn abc order " onclick="counterAdd(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`)" tabindex="-1" >+</button>-->
												<!--		</div>-->
												<!--	</td>-->
												<!--</tr>-->
											<?php 
								// 			}}} 
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" id="right_panel" style="display:none;">
                        <div class="mPurchases">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select style="width:70%;display:none;" class="app-select" id="suppliers" onchange="getCartItems(this)"></select>
                                </div>
                            </div>
                     <div class="panel">
				<div class="gradient"></div>
			    <div class="panel-heading ph-dash" style="padding:5px;">
			    	<div class="col-md-6 text-wrap" style="line-height:24px;">
			    		<span style="display:block;font-size:17px;" id="supplier_name"></span>
			    		<span id="supp_contact_name"></span> - <span id="supp_contact_number"></span>
			    	</div>
			    	<div class="col-md-6 text-wrap" style="line-height:48px;">
			    		<div class="" style="text-align:right;font-size:20px;">Order : $<span id="order_total"></span></div>
			    		
			    	</div>
			    	 
			    </div>
			    <div class="panel-body" style="padding-top:0px;border:1px solid #1c2a48;">
			    	<div id="items">
					</div>
			    	<div style="text-align:center;">
			    	<!--<a href="javascript:void(0);" class="btn btn-cool" id="newItemBtn">Add new product</a>-->
			    	<input type="hidden" id="newItemId" value="1">
			    	</div>
			    </div>
			</div>
				<div class="panel">
				<div class="panel-body" style="padding-top:0px;padding-bottom:0px;">
					<div>
			    		<label for="comments" class="order-padding">Comments</label>
			    		<textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Delivery Instructions"></textarea>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-6">
				    		<label for="order_date" class="order-padding">Order date</label>
				    		<input type="text" class="form-control datepicker" name="order_date" id="order_date" value="<?php echo date('d-m-Y');?>">
			    		</div>
			    		<div class="col-md-6">	
				    		<label for="delivery_date" class="order-padding">Delivery date</label>
				    		<!--<select class="form-control" id="delivery_date">-->
				    		<!--</select>-->
				    		<input type="text" class="form-control datepicker" name="delivery_date" id="delivery_date" value="<?php echo date('d-m-Y', strtotime(' +1 day'));?>">
			    		</div>
			    	</div>
			    	<br>
			    	
			    	<div class="form-group" style="margin-bottom:0px;">
			    		<input style="float:left;margin-top:10px;" type="checkbox" name="favourite_order" value="1" id="favourite_order">
			    		<span style="float:left;" class="inline-label">Favourite Order</span>
			    		<input style="float:left;margin-top:10px;" type="checkbox" name="standing_order" value="1" id="standing_order">
			    		<span style="float:left;" class="inline-label">Standing Order</span>
			    		<div style="clear:both;"></div>
			    	</div>
				</div>
			</div>
                            <div class="panel email-bg" style="background-color: black;">
							<div class="panel-body" style="padding-top:15px;padding-bottom:35px;">
								<div class="row">
									<div class="col-md-12">
										<label style="color:#fff;" for="supp_email">Email</label>
										<span style="float:right;"><a style="color:#fff;" href="" class="add_field_button">Add Email</a></span>
										<input style="width:80%;" type="text" class="form-control" name="supp_email" id="supp_email" value="">
									</div>
									<div class="col-md-12">
										<label style="color:#fff;" for="supp_cc" >CC</label>
										<input style="width:80%;" type="text" class="form-control supplier_cc" name="supp_cc[]" id="supp_cc" value="">
									</div>
									
									<div class="col-md-12 input_fields_wrap"></div>
								</div>
								<div style="margin-top:20px;">
									<button class="btn btn-default button-width" onclick="removeCartItem()">Delete</button>
									<button class="btn btn-success align button-width btncolor place_orderr" onclick="placeOrder()">Send Order</button>
								</div>
								<div style="margin-top:20px;display:none" class="force_place_order">
									<button style="width:100%" class="btn btn-success align button-width btncolor place_orderr" id="force_place_order" onclick="placeOrder(this)">Force Place Order</button>
								</div>
								
								<div class="alert alert-warning" style="display:none; margin-top:15px; margin-bottom:15px;" id="budget_message">
									<span id="budget_supplier_msg"></span><br>
									<span id="budget_branch_msg"></span>
								</div>
							</div>
						</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<form role="form" class="form-horizontal" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Product</h4>
			</div>
			<div class="modal-body">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Product Details</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="product_name" class="col-sm-4 control-label">Product Name<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="product_name" id="product_name">
								</div>
							</div>
							<div class="form-group">
								<label for="product_quantity" class="col-sm-4 control-label">Quantity<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="product_quantity" id="product_quantity"  autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label for="product_price" class="col-sm-4 control-label">Price<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="product_price" id="product_price"  autocomplete="off">
								</div>
							</div>  
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btncolor" onclick="addNewProduct();">Add</button>
				<button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>
    </main>
	<br>
<script>
$(document).ready(function(){
        $("#newItemBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<!--.footer-->
<script type="text/javascript">
	var orders = {};
	var suppliers = {}
		console.log('<?php echo $this->session->userdata('order_items'); ?>');
	<?php if(null !== $this->session->userdata('order_items')){ ?>
	orders = JSON.parse('<?php echo $this->session->userdata('order_items'); ?>');
	suppliers = JSON.parse('<?php echo $this->session->userdata('suppliers'); ?>');
	<?php } ?>
	

	loadCartDetails();
	
	//console.log(orders);
	function loadCartDetails(){
		//session details loading
		if(jQuery.isEmptyObject(orders)){
			$('#right_panel').hide();
		}else{
			$('#right_panel').show();
			var cartoptions = '';
			$.each( suppliers, function( key, value ) {
				cartoptions+='<option value="'+key+'">'+value+'</option>';
				
				$.each( orders[key].item, function( key1, value1 ) {
					$('#'+orders[key].item[key1]).val(orders[key].qty[key1]);
				});
			});
			
			$('#suppliers').html(cartoptions);
			var balance = [];
			var supplier_id = $('#suppliers').val();
			$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/orders/getSupplierBudget",
		        data:'supplier_id='+supplier_id,
		        success: function(data){
		        	var obj = JSON.parse(data);
                                var bal_string = String(obj.balance);
		        	balance.push(bal_string);
		        	orders[supplier_id].balance = balance;
	        		$('#supp_email').val(obj.supplier_email);
	        		$('#supp_cc').val(obj.supplier_cc);
	        		$('#supp_contact_name').html(obj.contact_name);
	        		$('#supp_contact_number').html(obj.contact_number);
		        }
	        });
			
			// getSupplierSchedules(supplier_id);
			
			var supplier_name = suppliers[supplier_id];
			$('#supplier_name').html(supplier_name);
			
			var order_items = orders[supplier_id];
			var items_loop = orders[supplier_id].item;
			
			var items = '';
			var total = 0;
			
			$.each( items_loop, function( key, value ) {
				
				total = total + order_items.amount[key];
				var o_amount1 = order_items.amount[key];
				var order_amount1 = o_amount1.toFixed(2);
				var itemPrice1 = order_items.itemPrice[key];
				var itemPrice2 = Number(itemPrice1).toFixed(2);
				 
				  items+='<div class="item-row padding-row-big" style="margin-left:-25px;margin-right:-25px;"><div class="text-wrap padding-tb padding-sides">'+order_items.itemName[key]+'</div>\n'
				    		+'<div class="item-left">Qty: '+order_items.qty[key]+'</div>\n'
				    		+'<div class="item-right2 color">$'+order_amount1+'</div>\n'
				    		+'<div class="item-right3"><a onclick="deleteCartItem(`'+value+'`,`'+supplier_id+'`,`'+itemPrice2+'`,`'+supplier_name+'`,`'+order_items.itemName[key]+'`)"><span class="glyphicon glyphicon-trash"></span></a></div>\n'
				    		+'<div style="clear:both;"></div></div>';
				  
			});
			
			var budget_balance = orders[supplier_id].balance;
			var branch_budget = $('#branch_budget').val();
			
			//check supplier budget
			if(budget_balance < total && branch_budget < total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
				$('#budget_branch_msg').html('Branch weekly budget reached ($'+branch_budget+' remaining)');
			}else if(budget_balance >= total && branch_budget < total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('');
				$('#budget_branch_msg').html('Branch weekly budget reached ($'+branch_budget+' remaining)');
			}else if(budget_balance < total && branch_budget >= total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
				$('#budget_branch_msg').html('');
			}else{
				$('#budget_message').hide();
				$('#budget_supplier_msg').html('');
				$('#budget_branch_msg').html('');
			}
			
			// console.log(items);
			$('#items').html(items);
			var order_total1 = total.toFixed(2);
			$('#order_total').html(order_total1);
		}
		//session ends
	}
	
	// function getSupplierSchedules(supId){
	$('#gsearchsimple').keyup(function(){
	    var query = $('#gsearchsimple').val();
	    var supId = $('#supplier_id_for_search').val();
	   if(supId !=''){
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/getproducts_suppliers",
	        data:'supplier_id='+supId+'&search='+query,
	        success: function(data){
	     	$('#supplier_items').html('');
	        	$('#supplier_items').html(data);
	        }
        });
	   }
	    });
	// }
	
	function delete_row(str){
		if(confirm('Are you sure you want to delete supplier')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/suppliers_delete",
		        data:'id='+str,
		        success: function(data){
		        	location.reload();
		        }
	       });
		}	
	}
	
	function addItemToCart(e,itemId, supId, price, supName, itemName){
		
		var inc = $('#'+itemId).val();
		if(inc > 0){
			$(e).closest('.counter-minus').removeAttr('disabled');
		}
		addToCart(itemId, supId, price, supName, itemName);
		
	}
	
	function counterAdd(e,itemId, supId, price, supName, itemName){
			var supId = $('#select_supplier_id').val();
	
		if(supId == 'all'){
		    alert("Please select a supplier name before searching for the products or adding them to the cart.");
		    return false;
		}
		var qty = $('#'+itemId).val();
		var inc = Number(qty) + Number(1);
		$('#'+itemId).val(inc);
		
		if(inc > 0){
			$(e).closest('.counter-minus').removeAttr('disabled');
		}
			console.log('sup== '+supId);
		addToCart(itemId, supId, price, supName, itemName);
	}
	
	function counterMinus(e,id, supId, price, supName, itemName){
		
		var qty = $('#'+id).val();
		var inc = Number(qty) - Number(1);
		if(inc < 0){
			//$('#'+id).val(inc);
			//$(e).attr('disabled','disabled');
		}else{
			$('#'+id).val(inc);
		}
		addToCart(id, supId, price, supName, itemName);
	}
	
	function addToCart(itemId, supId, price, supName, item_name, quantity=null){
		if(quantity == null){
			var qty = $('#'+itemId).val();
		}else{
			var qty = quantity;
		}
			console.log("452");
		var rate = price;
		var amount_cal = rate*qty;
		var items = [];
		var quantity = [];
		var amount = [];
		var itemName = [];
		var itemPrice = [];
		var balance = [];
		
		if (!(supId in orders)){
		    	console.log(supId);
		    	console.log(orders);
		    		console.log(suppliers);
			if(qty > 0){
				orders[supId] = {};
				suppliers[supId] = supName;
				//first time adding
				$('#right_panel').show();
				$.ajax({
					type: "POST",
			        url: "<?php echo base_url();?>index.php/orders/getSupplierBudget",
			        data:'supplier_id='+supId,
			        success: function(data){
			            
		        		var obj = JSON.parse(data);
		        		var bal_string = String(obj.balance);
		        		console.log("2121 =  "+bal_string);
		        		balance.push(bal_string);
		        		orders[supId].balance = balance;
		        		$('#supp_email').val(obj.supplier_email);
		        		$('#supp_cc').val(obj.supplier_cc);
		        		$('#supp_contact_name').html(obj.contact_name);
	        			$('#supp_contact_number').html(obj.contact_number);
	        				
			        }
		        });
			}
		}
		
	
		if (supId in orders){
			if (orders[supId].item){
			    
				var item_obj = orders[supId].item;
			    var qty_obj = orders[supId].qty;
			    var price_obj = orders[supId].itemPrice;
			    var amount_obj = orders[supId].amount;
			    var itemName_obj = orders[supId].itemName;
			 //   var budget = orders[supId].balance[0];
				
				
				if(jQuery.inArray(itemId, item_obj) >= 0){
					var index = jQuery.inArray(itemId, item_obj);
					if(qty > 0){
						qty_obj[index] = qty;
						amount_obj[index] = amount_cal;
						itemName_obj[index] = item_name;
						price_obj[index] = price;
					}else{
						item_obj.splice(index,1);
						qty_obj.splice(index,1);
						amount_obj.splice(index,1);
						itemName_obj.splice(index,1);
						price_obj.splice(index,1);
						
						if(orders[supId].item.length == 0){
							// alert('remove');
							removeCartItem(supId);
						}
					}
				}
				else{
					items = item_obj;
					quantity = qty_obj;
					amount = amount_obj;
					itemName = itemName_obj;
					itemPrice = price_obj;
					//balance check for existing items
					items.push(itemId);
					quantity.push(qty);
					amount.push(amount_cal);
					itemName.push(item_name);
					itemPrice.push(price);
					
					orders[supId].item = items;
					orders[supId].qty = quantity;
					orders[supId].amount = amount;
					orders[supId].itemName = itemName;
					orders[supId].itemPrice = itemPrice;
					
				}
				
			}else{
				if(qty > 0){
					items.push(itemId);
					quantity.push(qty);
					amount.push(amount_cal);
					itemName.push(item_name);
					itemPrice.push(price);
					
					orders[supId].item = items;
					orders[supId].qty = quantity;
					orders[supId].amount = amount;
					orders[supId].itemName = itemName;
					orders[supId].itemPrice = itemPrice;
				}
			}
			
			if (supId in orders){
				if (orders[supId].item){
					getCartItems('',supId);
				}
			}
			//console.log(orders);
			//session storing
		
				var oldjson = JSON.stringify( orders );
	     var json = encodeURIComponent(oldjson);
			var sup = JSON.stringify(suppliers);
			//console.log(json);
			$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/orders/orderSession",
		        data:'order='+json+'&suppliers='+sup,
		        success: function(data){
		            //console.log(data);
		        }
	        });
        
			var options = '';
			$.each( suppliers, function( key, value ) {
				options+='<option value='+key+'>'+value+'</option>';
			});
			$('#suppliers').html(options);
		}
	}
	
	function getCartItems(e, supId = null){
		if(supId != null){
			var supplierId = supId;
		}else{
			var supplierId = $(e).val();
		}
		
		if(supplierId != null){
			var supplier_name =  suppliers[supplierId];//$("option:selected",e).text(); 
	
			$('#supplier_name').html(supplier_name);
		
			var order_items = orders[supplierId];
			var items_loop = orders[supplierId].item;
			var items = '';
			var total = 0;
			
					
			$.each( items_loop, function( key, value ) {
				//console.log(value);
				total = Number(total) + Number(order_items.amount[key]);
				var o_amount2 = order_items.amount[key];
				var order_amount2 = o_amount2.toFixed(2);
				var itemPrice3 = order_items.itemPrice[key];
				var itemPrice4 = Number(itemPrice3).toFixed(2);
				
				items+='<div class="item-row padding-row-big" style="margin-left:-25px;margin-right:-25px;"><div class="text-wrap padding-tb padding-sides">'+order_items.itemName[key]+'</div>\n'
				    		+'<div class="item-left">Qty: '+order_items.qty[key]+'</div>\n'
				    		+'<div class="item-right2 color">$'+order_amount2+'</div>\n'
				    		+'<div class="item-right3"><a onclick="deleteCartItem(`'+value+'`,`'+supplierId+'`,`'+itemPrice4+'`,`'+supplier_name+'`,`'+order_items.itemName[key]+'`)"><span class="glyphicon glyphicon-trash"></span></a></div>\n'
				    		+'<div style="clear:both;"></div></div>';
				    		
				
			});
			//get emails
			$.ajax({
					type: "POST",
			        url: "<?php echo base_url();?>index.php/orders/getSupplierBudget",
			        data:'supplier_id='+supplierId,
			        success: function(data){
		        		var obj = JSON.parse(data);
		        		$('#supp_email').val(obj.supplier_email);
		        		$('#supp_cc').val(obj.supplier_cc);
		        		$('#supp_contact_name').html(obj.contact_name);
	        			$('#supp_contact_number').html(obj.contact_number);
			        }
		        });
			// getSupplierSchedules(supplierId);
			
			var budget_balance = orders[supplierId].balance;
			var branch_budget = $('#branch_budget').val();
			
			if(budget_balance < total && branch_budget < total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
				$('#budget_branch_msg').html('Branch weekly budget reached ($'+branch_budget+' remaining)');
			}else if(budget_balance >= total && branch_budget < total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('');
				$('#budget_branch_msg').html('Branch weekly budget reached ($'+branch_budget+' remaining)');
			}else if(budget_balance < total && branch_budget >= total){
				$('#budget_message').show();
				$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
				$('#budget_branch_msg').html('');
			}else{
				$('#budget_message').hide();
				$('#budget_supplier_msg').html('');
				$('#budget_branch_msg').html('');
			}
			
			$('#items').html(items);
			var order_total2 = total.toFixed(2);
			$('#order_total').html(order_total2);
		}else{
			$('#items').html('');
			$('#supplier_name').html('');
			$('#order_total').html('');
		}
	}
	
	//remove from cart
	function removeCartItem(supId=null){
		if(supId != null){
			var supplier_id = supId;
		}else{
			var supplier_id = $('#suppliers').val();
		}
		delete orders[supplier_id];
		delete suppliers[supplier_id];
		
		if(jQuery.isEmptyObject(orders)){
			$('#right_panel').hide();
		}
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/clearSession",
	        data:'supplier_id='+supplier_id,
	        success: function(data){
	        	// alert(data);
	        }
        });
        
		var options = '';
		$.each( suppliers, function( key, value ) {
			options+='<option value='+key+'>'+value+'</option>';
		});
		
		$('#suppliers').html(options);
		
		var suppId = $('#suppliers').val();
		getCartItems('',suppId);
	}
	
	function add_force_comment(){
	   
	    var force_comment = $('#force_comment').val();
	     $("#store_force_comment").val(force_comment);
	     $("#commentModal .close").click();
	     placeOrder();
	    
	}
	
function getBranchOrderTotalFromDeliverDate() {
  return new Promise(function(resolve, reject) {
    $.ajax({
     url: "<?php echo base_url();?>index.php/orders/getBranchOrderTotalFromDeliverDate",
	        data:'delivery_date='+$("#delivery_date").val(),
	        type:'POST',
	        success: function(res){
	          	var balanceThisWeek = Number(res);
	          	resolve(balanceThisWeek)
	          	console.log(typeof balanceThisWeek);
	          	
	        },
      error: function(err) {
        reject(err) // Reject the promise and go to catch()
      }
    });
  });
}


	//place order
	function placeOrder(obj){

 $(".place_orderr").attr("disabled", true);
getBranchOrderTotalFromDeliverDate().then(function(balanceThisWeek) {
  // Run this when your request was successful
 
	    	// check if this branch exceed weekly budget
		var order_total = $('#order_total').html();
       // once placxe order button clicked make it didsabled
       
		
		var button_clicked = $(obj).attr('id');
	 var  store_force_comment = $("#store_force_comment").val();
	
	  if(store_force_comment == '' ||  typeof store_force_comment == 'undefined'){
	    
		if(Number(order_total) >= Number(balanceThisWeek) && button_clicked !='force_place_order'){
		  //  console.log("727");
		    $(".balancealert").show();
		    $(".force_place_order").show();
		    $("html, body").animate({
            scrollTop: 0
            }, 1000);
            
             $(".place_orderr").attr("disabled", false);
		    return false;
		}else{
		
		    if(Number(order_total) >= balanceThisWeek && (store_force_comment == '')){
		        $("#commentModal").modal();
		         $(".place_orderr").attr("disabled", false);
		        return false;
		    }
		      
		}
	 }
		
		var supplier = $('#suppliers').val();
		var json = encodeURIComponent(JSON.stringify(orders));
				
		var delivery_date = $('#delivery_date').val();
		var order_date = $('#order_date').val();
		var comments = $('#comments').val();
		var supp_email = $('#supp_email').val();
		var cc_mails = [];
		$('input[name^="supp_cc"]').each(function() {
		    cc_mails.push($(this).val());
		});
		
		
		var supp_cc = JSON.stringify( cc_mails );
		
		var fav_order = document.getElementById("favourite_order").checked;
		if(fav_order == true){
			var faourite = 1;
		}else{
			var faourite = 0;
		}
		
		var stand_order = document.getElementById("standing_order").checked;
		if(stand_order == true){
			var standing = 1;
		}else{
			var standing = 0;
		}
		
	
		var budget_balance = orders[supplier].balance;
		var branch_budget = $('#branch_budget').val();
		
		//orders count
		var orders_count = $('#orders_count').val();
		var limit = '<?php echo $orders_limit; ?>';
		
	
		
		
		//alert(orders_count+'/'+limit);
		var balance = Number(limit) - Number(orders_count);
		//alert(balance+'/'+budget_balance);
		
		// check this its a bug afetr fix remove thbis liene commment
// 		var s = JSON.stringify(budget_balance);
// var d = JSON.parse(s);

	var budget_balance = 10000;
		if(balance > 0){
			if(budget_balance >= Number(order_total)){
			     
			     console.log("818"+budget_balance);
				$.ajax({
					type: "POST",
			        url: "<?php echo base_url();?>index.php/orders/placeOrders",
			        data:'supplier_id='+supplier+'&store_force_comment='+store_force_comment+'&order='+json+'&delivery_date='+delivery_date+'&comments='+comments+'&fav_order='+faourite+'&standing_order='+standing+'&order_date='+order_date+'&supp_email='+supp_email+'&supp_cc='+supp_cc,
			         beforeSend: function(){
                       $("#loader").show();
                        },
			        success: function(data){
			         //   alert(data);
			        	var obj = JSON.parse(data);
			        	if(obj.message == 'success'){
			        		$('#branch_budget').val(obj.balance);
			        		$('#orders_count').val(obj.orders_balance);
			        		removeCartItem(supplier);
			        		
			        		window.location.href = "<?php echo base_url();?>index.php/orders/orderHistory";
			        	}else{
			        		alert(obj.message);
			        	}
			        },
			        complete:function(data){
                     $("#loader").hide();
                       }
		        });
			}else{
				// alert('budget reached');
				if(budget_balance < Number(order_total) && branch_budget < Number(order_total)){
					$('#budget_message').show();
					$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
					$('#budget_branch_msg').html('Branch weekly budget reached ($'+branch_budget+' remaining)');
				}else if(budget_balance < Number(order_total) && branch_budget >= Number(order_total)){
					$('#budget_message').show();
					$('#budget_supplier_msg').html('Supplier weekly budget reached ($'+budget_balance+' remaining)');
					$('#budget_branch_msg').html('');
				}else{
					$('#budget_message').hide();
					$('#budget_supplier_msg').html('');
					$('#budget_branch_msg').html('');
				}
			}
		}else{
			// alert('orders reached');
			$('#limit_message').html('Orders limit reached');
			$('#subscription').show();
		}
}).catch(function(err) {
  // Run this when promise was rejected via reject()
   $(".place_orderr").attr("disabled", false);
  console.log(err)
})


	  
	    
	}
	
	function getSupplierItems(e){
	    alert("Warning Message: If you are choosing a different supplier name without placing the previous order, please ensure to delete the items in the cart of the previous supplier.");
	   
		var supId = $('#select_supplier_id').val();
		if(supId != ''){
    		$("#supplier_id_for_search").val(supId);
    		var catId = $('#select_category_id').val();
    		$.ajax({
    			type: "POST",
    	        url: "<?php echo base_url();?>index.php/orders/getSupplierItems",
    	        data:'supplier_id='+supId+'&category_id='+catId,
    	        success: function(data){
    	        	// alert(data);
    	        	$('#supplier_items').html(data);
    	        }
            });
    	}
    	else{
    	    $('#supplier_items').html('<tr><td colspan="5" class="text-center">Please select supplier</td><tr>');
    	}
	}
	
	function addNewProduct(){
		var supId = $('#suppliers').val();
		var product_name = $('#product_name').val();
		var product_quantity = $('#product_quantity').val();
		var product_price = $('#product_price').val();
		var supName = $('#supplier_name').html();
		
		
		if(product_name == ''){
			var name_error = 1;
			$('#product_name').css('border-color','red');
		}else{
			var name_error = 0;
			$('#product_name').css('border-color','#ccc');
		}
		if(product_quantity == ''){
			var qty_error = 1;
			$('#product_quantity').css('border-color','red');
		}else{
			var qty_error = 0;
			$('#product_quantity').css('border-color','#ccc');
		}
		if(product_price == ''){
			var price_error = 1;
			$('#product_price').css('border-color','red');
		}else{
			var price_error = 0;
			$('#product_price').css('border-color','#ccc');
		}
		
		if(name_error == 0 && qty_error == 0 && price_error == 0){
			var newItemId = $('#newItemId').val();
			var itemId = 'M'+newItemId;
			addToCart(itemId, supId, product_price, supName, product_name, product_quantity);
			var newId = Number(newItemId)+1;
			$('#newItemId').val(newId);
			
			$("#myModal .close").click();
		}
	}
	
	function deleteCartItem(id, supId, price, supName, itemName){
		
		if (confirm("Are you sure you want to delete") == true) {
	        
	        $('#'+id).val('0');
	        addToCart(id, supId, price, supName, itemName);
	    }
		
	}
	</script>
	
	<script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
	        $('.datepicker').datepicker({
	            dateFormat: "dd-mm-yy",
				minDate: 0
	        });
        });
    </script>
    <script type="text/javascript">	
		$(document).ready(function() {
			$('.orders-datatable').DataTable( {
		        'paging':false,
		        'bInfo':false,
		        'autoWidth':false,
		        
		        "columnDefs": [
				    { "width": "10%", "targets": 0 },
				    { "width": "32.5%", "targets": 1 },
				    { "width": "10%", "targets": 2 },
				    { "width": "12.5%", "targets": 3 },
				    { "width": "20%", "targets": 4 }
				  ]
		    } );
		} );
	</script> 
	
	<script>
		$(document).ready(function() {
		    var max_fields      = 10; //maximum input boxes allowed
		    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		    var add_button      = $(".add_field_button"); //Add button ID
		    
		    var x = 1; //initlal text box count
		    $(add_button).click(function(e){ //on add input button click
		        e.preventDefault();
		        if(x < max_fields){ //max input box allowed
		            x++; //text box increment
		            $(wrapper).append('<div style="margin:10px 0px;"><input style="width:80%; float:left;" type="text" class="form-control supplier_cc" name="supp_cc[]"/><span style="float:left;" class="inline-label"><a href="#" class="remove_field" style="color:#fff;"><span class="glyphicon glyphicon-trash"></span></a></span><div style="clear:both;"></div></div>'); //add input box
		        }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent().parent('div').remove(); x--;
		    })
		});
	</script>
		<script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
			    "ordering": false,
                'paging': false,
				'bInfo':false,
				'searching': false,
				"language": {
                    "search": "Search All Items "
                     },
                responsive: true
            });
        });
    </script>

</body>

</html>