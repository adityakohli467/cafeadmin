<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: center;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 50%;
}
</style>		
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
    <div id="order_success"></div>
           <div class="overlayplaceorder" id='loader'></div>		
	<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3">
			<p class="page-head-p left">
				<span id="limit_message"></span>
				
			</p>
		</div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Order History</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/orders/orderHistory">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
		</div>
	
	</div><!--.col-md-12 -->
	
	
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
	                <label for="force_comment" class="col-sm-4 control-label">Please mention the date and time the business has approved this order</label>
	                <div class="col-sm-8">
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
    
    
	<div style="background-color:#fff" class="container-fluid main-container">
		<div class="row">
			<div class="col-md-12">
			<div class="col-md-8 col-sm-8">
				<?php
				if($orders->order_status == 'Sent' || $orders->order_status == 'Viewed'){
					$editable = '';
					$readonly = '';
					$datepicker = 'datepicker';
				}else{
					$editable = 'disabled';
					$readonly = 'readonly';
					$datepicker = '';
				}
				?>
				<div class="panel-body" style="overflow:hidden;padding-bottom:0;padding-top: 0;">
				
				    <select name="sorting" id="print_sorting" onchange="loadCartDetails();" class="form-control" style="float:right;width:150px;margin-left:10px;height: 26px;padding: 1px 12px 1px 5px">
				        <option value="">Sorting</option>
				        <option value="ASC">Ascending</option>
				        <option value="DESC">Descending</option>
				    </select>
			
				<button onclick="printContent('div1')" class="btn-primary" style="float: right">Print</button>
			</div>
				<div style="box-shadow:none;" class="panel panel-default">
				<div class="gradient"></div>
				<div class="panel-body" style="padding-top:8px;">
				<div class="alert alert-danger balancealert" role="alert" style="display:none;margin-top: 28px;">This branch weekly budget has exceeded, please take the approval from the business and please click <b>'Force Place Order'</b> button to send the order to the supplier.</div>

				<table id="orders-tbl" class="row-border table-condensed orders-datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left" style="width:10%">Code</th>
						<th class="text-left" style="width:45%">Product Name</th>
						<th class="text-left" style="width:15%">Category</th>
						<th class="text-right" style="width:15%">Price/Uom</th>
						<th class="text-center" style="width:15%">Quantity</th>
					</tr>
				</thead>
				<tbody id="supplier_items">
				<?php 
				$orderItems = $orderQty;
				
				foreach($suppliers as $supplieritems){
					foreach($supplieritems as $items){
						
						if(array_key_exists($items->itemId, $orderQty)){
							$order_qty = $orderQty[$items->itemId];
						}else{
							$order_qty = 0;
						}
				?>
					<tr class="tr">
						<td class="text-left"><?php echo $items->itemCode; ?></td>
						<td class="text-left"><?php echo $items->itemName; ?><br><small><?php echo $items->supplier_name; ?></small></td>
						<td class="text-left"><?php echo $items->category_name; ?></td>
						<td class="text-right"><?php echo number_format($items->price,2,'.',''); ?>/<?php echo $items->uom; ?></td>
						<td class="text-center">
							<div class="handle-counter">
							  <button <?php echo $editable;?> class="counter-minus btn abc order" onclick="counterMinus(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`)" >-</button>
							  <input <?php echo $readonly;?> class="order" type="text" value="<?php echo $order_qty; ?>" id="<?php echo $items->itemId;?>" onchange="addItemToCart(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`);">
							  <button <?php echo $editable;?> class="counter-plus btn abc order" onclick="counterAdd(this,`<?php echo $items->itemId;?>`,`<?php echo $items->supplierId;?>`,`<?php echo number_format($items->price,2,'.',''); ?>`,`<?php echo $items->supplier_name; ?>`,`<?php echo $items->itemName; ?>`)">+</button>
							</div>
						</td>
					</tr>
					
				<?php }} ?>
				</tbody>
			</table><!--.table-->
			</div>
			</div>
		</div>
		<?php 
			if($orders->order_status == 'Sent'){
				$color = "style='background-color:#e96166;float:right;font-size:20px;'";
			}else if($orders->order_status == 'Viewed'){
				$color = "style='background-color:#4b799d;float:right;font-size:20px;'";
			}else if($orders->order_status == 'Confirmed'){
				$color = "style='background-color:#c3a428;float:right;font-size:20px;'";
			}else{
				$color = "style='background-color:#319346;float:right;font-size:20px;'";
			}
			?>
		<div class="col-md-4 col-sm-4">
			<div style="margin:10px 0px 20px 0px;text-align:right;">
				<div <?php echo $color;?> class="status-color">
				<?php echo $orders->order_status;?></div>
				<div style="clear:both;"></div>
			</div>
			<div class="panel" id="div1">
				<div class="gradient"></div>
				<div class="panel-heading ph-dash" style="padding:5px;">
					
					<div class="col-md-6 text-wrap" style="line-height:24px;">
						<span style="display:block;font-size:17px;" id="supplier_name"><?php echo $orders->order_number.' '.$supplier_name;?></span>
						<span id="supp_contact_name"></span> - <span id="supp_contact_number"></span>
			    	</div>
			    	<div class="col-md-6 text-wrap" style="line-height:48px;">
						<div class="" style="text-align:right;font-size:20px;">Order : $<span id="order_total"></span></div>
							<input type="hidden" id="order_total_before_edit" value="">
					</div>
			    	<div style="clear:both;"></div>
			    </div>
			    
			    <div class="panel-body" style="padding-top:0px;border:1px solid #236ea6;">
			    	<div id="items">
			    	</div>
			    	
			    	<?php if($editable == ''){?>
			    	<!--<div style="text-align:center;">
				    	<a href="javascript:void(0);" class="btn btn-cool" id="newItemBtn">Add new product</a>
				    	<input type="hidden" id="newItemId" value="1">
			    	</div>-->
			    	<?php } ?>
			    	<!--<input type="hidden" id="newItemId" value="1">-->
			    	<!--<br>-->
			    	<!--<br>-->
			    	
			    </div>
			</div>
			<div class="panel">
				<div class="panel-body" style="padding-top:0px;padding-bottom:0px;">
				
			    	<div>
			    		<label for="comments">Comments</label>
			    		<textarea class="form-control" rows="3" name="comments" id="comments" <?php echo $readonly;?>><?php echo $orders->comments;?> </textarea>
			    	</div>
			    	<?php if($orders->order_status == 'Confirmed'){ ?>
			    	<div>
			    		<label for="supplier_comments">Supplier comments</label>
			    		<textarea class="form-control" rows="3" name="supplier_comments" id="supplier_comments" placeholder="Supplier comments" <?php echo $readonly;?>><?php echo $orders->supplier_comments;?> </textarea>
			    	</div>
			    	<?php } ?>
			    	<div class="row">
			    		<div class="col-md-6">
				    		<label for="order_date" class="order-padding">Order date</label>
				    		<input type="text" <?php echo $readonly;?> class="form-control <?php echo $datepicker;?>" name="order_date" id="order_date" value="<?php echo date('d-m-Y', strtotime($orders->order_date));?>">
			    		</div>
			    		<div class="col-md-6">	
				    		<label for="delivery_date" class="order-padding">Delivery date</label>
				    		<!--<select class="form-control" id="delivery_date">-->
				    		<!--</select>-->
				    		<input type="text" <?php echo $readonly;?> class="form-control <?php echo $datepicker;?>" name="delivery_date" id="delivery_date" value="<?php echo date('d-m-Y', strtotime($orders->delivery_date));?>">
			    		</div>
			    	</div>
			    	<br>
			    </div>
			</div>
			<div class="panel" style="background-color:#236ea6;">
				<div class="panel-body" style="padding-top:15px;padding-bottom:35px;">
			    	<div class="row">
			    		<div class="col-md-12">
				    		<label style="color:#fff;" for="supp_email">Email</label>
				    		<?php if($editable == ''){?>
				    		<span style="float:right;"><a style="color:#fff;" href="" class="add_field_button">Add Email</a></span>
				    		<?php } ?>
				    		<input style="width:80%;" type="text" <?php echo $readonly;?> class="form-control" name="supp_email" id="supp_email" value="">
				    	</div>
				    	<div class="col-md-12">
				    		<label style="color:#fff;" for="supp_cc" class="order-padding">CC</label>
				    		<input style="width:80%;" <?php echo $readonly;?> type="text" class="form-control supplier_cc" name="supp_cc[]" id="supp_cc" value="">
				    	</div>
				    	
				    	<div class="col-md-12 input_fields_wrap"></div>
				    	
			    	</div>
			    	<br>
			    	<div style="margin-top:20px;">
			    		<!--<button class="btn btn-default" onclick="removeCartItem()">Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			    		<button class="btn btn-success button-width btncolor" onclick="placeOrder()" <?php echo $editable;?>>Re-send</button>
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
</div><!--.container-->

<!-- Modal -->
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
				<button type="button" class="btn btn-success btncolor" onclick="addNewProduct();">Save</button>
				<button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>
		
	<br>
	
	 
      
      
<!--.footer-->
<script>
$(document).ready(function(){
    $("#newItemBtn").click(function(){
        $("#myModal").modal();
    });
    
      
});

</script>
<script type="text/javascript">
	var orders = {};
	var suppliers = {};
	<?php if(null !== $this->session->userdata('order_items')){ ?>
	orders = JSON.parse(<?php echo json_encode($this->session->userdata('order_items')); ?>);
	suppliers = JSON.parse(<?php echo json_encode($this->session->userdata('suppliers')); ?>);
	<?php } ?>
// console.log(orders);
	loadCartDetails();
	
	function loadCartDetails(){
	    
	  
		var supId = '<?php echo $orders->supplier_id;?>';
		var order_items = JSON.parse(<?php echo json_encode($order_items); ?>);
		
		var sortorder=$('#print_sorting').val();
		if( sortorder=='ASC'){
		   
		    order_items.sort((a, b) => {
            // return a.item_name - b.item_name;
            let fa = a.item_name.toLowerCase(),
            fb = b.item_name.toLowerCase();
    
            if (fa < fb) {
                return -1;
            }
            if (fa > fb) {
                return 1;
            }
            return 0;
        });
		}
		else if(sortorder=='DESC'){
		     
		    order_items.sort((a, b) => {
            // return a.item_name - b.item_name;
            let fa = a.item_name.toLowerCase(),
            fb = b.item_name.toLowerCase();
    
            if (fa < fb) {
                return -1;
            }
            if (fa > fb) {
                return 1;
            }
            return 0;
        });
		    order_items.reverse();
		}
		else{}
		
        
        console.log(order_items);
        
		orders[supId] = {};
		
		var items = [];
		var quantity = [];
		var amount = [];
		var itemName = [];
		var Item_category = [];
		var itemPrice = [];
		var balance = [];
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/getSupplierBudget",
	        data:'supplier_id='+supId,
	        success: function(data){
	        	var obj = JSON.parse(data);
        		balance.push(obj.balance);
        		orders[supId].balance = balance;
        		$('#supp_email').val(obj.supplier_email);
        		$('#supp_cc').val(obj.supplier_cc);
        		$('#supp_contact_name').html(obj.contact_name);
	        	$('#supp_contact_number').html(obj.contact_number);
	        }
        });
        
        	
	    
		$.each( order_items, function( key, value ) {
		     
			var item_obj = value.item_id;
			var qty_obj = value.quantity;
		    var amount_obj = value.amount;
		    var itemName_obj = value.item_name;
		    var itemPrice_obj = value.price;
		     var Item_category_obj = value.Item_category;
		    var budget = '<?php echo $supplier_budget; ?>';//value.balance[0];
			 
			items.push(item_obj);
			quantity.push(qty_obj);
			amount.push(amount_obj);
			itemName.push(itemName_obj);
		     Item_category.push(Item_category_obj);
			itemPrice.push(itemPrice_obj);
			balance.push(budget);
			
			orders[supId].item = items;
			orders[supId].qty = quantity;
			orders[supId].amount = amount;
			orders[supId].itemName = itemName;
			orders[supId].Item_category = Item_category;
			orders[supId].itemPrice = itemPrice;
			orders[supId].balance = balance;
		});
		
		var orderItems = orders[supId];
		var items_loop = orders[supId].item;
		var items = '';
		var total = 0;
		var supp_name = '<?php echo $supplier_name;?>';
			
		$.each( items_loop, function( key, value ) {
			
			total = Number(total) + Number(orderItems.amount[key]);
			var o_amount1 = Number(orderItems.amount[key]);
			var order_amount1 = o_amount1.toFixed(2);
			var itemPrice1 = orderItems.itemPrice[key];
			var itemPrice2 = Number(itemPrice1).toFixed(2);
			var status = '<?php echo $editable; ?>';
			if(status == ''){
				var deleteOpt = '<a onclick="deleteCartItem(`'+value+'`,`'+supId+'`,`'+itemPrice2+'`,`'+supp_name+'`,`'+orderItems.itemName[key]+'`)"><span class="glyphicon glyphicon-trash"></span></a>';
			}else{
				var deleteOpt = '&nbsp;';
			}
			    		
			items+='<div class="item-row padding-row-big" style="margin-left:-25px;margin-right:-25px;"><div class="text-wrap padding-tb padding-sides">'+orderItems.itemName[key]+'</div>\n'
				    		+'<div class="text-wrap padding-tb padding-sides"><b>Cat : </b>'+orderItems.Item_category[key]+'</div>'
				    		+'<div class="item-left">Qty: '+orderItems.qty[key]+'</div>\n'
				    		+'<div class="item-right2 color">$'+order_amount1+'</div>  \n'
				    		
				    		+'<div class="item-right3">'+deleteOpt+'</div>\n'
				    		+'<div style="clear:both;"></div></div>';
		});
		
		$('#items').html(items);
		$('#order_total').html(Number(total).toFixed(2));
		$("#order_total_before_edit").val(Number(total).toFixed(2));
		
	}
	
	function addItemToCart(e,itemId, supId, price, supName, itemName){
		
		var inc = $('#'+itemId).val();
		if(inc > 0){
			$(e).closest('.counter-minus').removeAttr('disabled');
		}
		addToCart(itemId, supId, price, supName, itemName);
		
	}
	
	function counterAdd(e,itemId, supId, price, supName, itemName){
		var qty = $('#'+itemId).val();
		var inc = Number(qty) + Number(1);
		$('#'+itemId).val(inc);
		
		if(inc > 0){
			$(e).closest('.counter-minus').removeAttr('disabled');
		}
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
		var rate = price;
		var amount_cal = rate*qty;
		var items = [];
		var quantity = [];
		var amount = [];
		var itemName = [];
		var itemPrice = [];
		var balance = [];
			
		if (!(supId in orders)){
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
		        		balance.push(obj.balance);
		        		orders[supId].balance = balance;
		        		$('#supp_email').val(obj.supplier_email);
		        		$('#supp_cc').val(obj.supplier_cc);
		        		$('#supp_contact_name').html(obj.contact_name);
	        			$('#supp_contact_number').html(obj.contact_number);
			        }
		        });
			}
		}
		 //console.log(orders);
		if (supId in orders){
			if (orders[supId].item){
				var item_obj = orders[supId].item;
			    var qty_obj = orders[supId].qty;
			    var price_obj = orders[supId].itemPrice;
			    var amount_obj = orders[supId].amount;
			    var itemName_obj = orders[supId].itemName;
			    var budget = orders[supId].balance[0];
				
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
							//removeCartItem(supId);
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
		}
	}
	
	function getCartItems(e, supId = null){
		if(supId != null){
			var supplierId = supId;
		}else{
			var supplierId = $(e).val();
		}
		
		if(supplierId != null){
			// var supplier_name =  suppliers[supplierId];//$("option:selected",e).text(); 
	
			// $('#supplier_name').html(supplier_name);
			var supplier_name = '<?php echo $supplier_name;?>';
			var order_items = orders[supplierId];
			var items_loop = orders[supplierId].item;
			var items = '';
			var total = 0;
					
			$.each( items_loop, function( key, value ) {
				//console.log(value);
				total = Number(total) + Number(order_items.amount[key]);
				var o_amount2 = Number(order_items.amount[key]);
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
	
	function arrayToObjectString(arr) {
  var returnSrt = "{";
  for (var key in arr) {
    returnSrt += "\"" + key + "\" : \"" + arr[key] + "\"";
    returnSrt += ","
  }
  returnSrt = returnSrt.substring(0, returnSrt.length - 1) + "}";

  return returnSrt;
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
	    
	    getBranchOrderTotalFromDeliverDate().then(function(balanceThisWeek) {
		// console.log(orders);
		var order_id = '<?php echo $orders->order_id; ?>';
		var supplier = '<?php echo $orders->supplier_id; ?>';//$('#suppliers').val();
		var order_number = '<?php echo $orders->order_number; ?>';
	
		 var oldjson = JSON.stringify( orders );
	     var json = encodeURIComponent(oldjson);
	     var order_total_before_edit = $("#order_total_before_edit").val();
	     var order_total = $('#order_total').html();
	     
	     
	     if(order_total_before_edit > order_total){
	        var extra_amount =  order_total_before_edit  - order_total;
	     }else if(order_total_before_edit < order_total){
	       var extra_amount =  order_total  - order_total_before_edit;
	     }else{
	         var extra_amount = 0;
	     }
	   
	   var button_clicked = $(obj).attr('id');
	   var  store_force_comment = $("#store_force_comment").val();

	
	 
	  if(store_force_comment == '' ||  store_force_comment == 'undefined'){
	      console.log("765");
		if(Number(extra_amount) >= Number(balanceThisWeek) && button_clicked !='force_place_order'){
		    console.log("767");
		    $(".balancealert").show();
		    $(".force_place_order").show();
		    $("html, body").animate({
            scrollTop: 0
            }, 1000); 
		    return false;
		}else{
		
		    if(Number(extra_amount) >= Number(balanceThisWeek) && (store_force_comment == '') ){
		         console.log("777");
		        $("#commentModal").modal();
		        return false;
		    }
		      
		}
	 }
	 
		var delivery_date = $('#delivery_date').val();
		var order_date = $('#order_date').val();
		var comments = $('#comments').val();
		
		var supp_email = $('#supp_email').val();
		var cc_mails = [];
		$('input[name^="supp_cc"]').each(function() {
		    cc_mails.push($(this).val());
		});
		var supp_cc = JSON.stringify( cc_mails );
		
		
		var budget_balance = Number('<?php echo $supplier_budget;?>');//orders[supplier].balance;
		
		
		//orders count
		var orders_count = '<?php echo $orders_count;?>';//$('#orders_count').val();
		var limit = '<?php echo $orders_limit;?>';
			
		var balance = Number(limit) - Number(orders_count);
	
		if(balance > 0){
		    	 console.log("807");
			if(budget_balance >= Number(order_total)){
			    	 console.log("809");
				$.ajax({
					type: "POST",
			        url: "<?php echo base_url();?>index.php/orders/updateOrder",
			        data:'supplier_id='+supplier+'&store_force_comment='+store_force_comment+'&order='+json+'&delivery_date='+delivery_date+'&comments='+comments+'&order_id='+order_id+'&order_date='+order_date+'&supp_email='+supp_email+'&supp_cc='+supp_cc+'&order_number='+order_number,
			           beforeSend: function(){
                       $("#loader").show();
                        },
			        success: function(data){
			        
			        	if(data == 'success'){
			        	var msg = '<div class="hideMe"><p class="alert alert-success">Order updated successfully</p></div>';
			        	window.location.href = "<?php echo base_url();?>index.php/orders/orderHistory";
			        	}
			        },
			         complete:function(data){
                     $("#loader").hide();
                       }
		        });
			}else{
			     console.log("829");
				$('#limit_message').html('Budget limit reached');
			}
		}else{
		    
			// alert('orders reached');
			$('#limit_message').html('Orders limit reached');
			
		}
	    }).catch(function(err) {
  // Run this when promise was rejected via reject()
  console.log(err)
})
	}
	
	
	
	function addNewProduct(){
		var supId = '<?php echo $orders->supplier_id; ?>';
		var product_name = $('#product_name').val();
		var product_quantity = $('#product_quantity').val();
		var product_price = $('#product_price').val();
		var supName = '<?php echo $supplier_name;?>';
		
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
	            dateFormat: "dd-mm-yy"
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
		            $(wrapper).append('<div style="margin:10px 0px;"><input style="width:80%; float:left;" type="text" class="form-control supplier_cc" name="supp_cc[]"/><span style="float:left;" class="inline-label"><a href="#" style="color:#fff;" class="remove_field"><span class="glyphicon glyphicon-trash"></span></a></span><div style="clear:both;"></div></div>'); //add input box
		        }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent().parent('div').remove(); x--;
		    })
		});
		
			function printContent(el){    var restorepage = document.body.innerHTML;    var printcontent = document.getElementById(el).innerHTML;    document.body.innerHTML = printcontent;    window.print();    document.body.innerHTML = restorepage;   }

	</script>