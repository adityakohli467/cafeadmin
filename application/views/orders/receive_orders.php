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
<style>
@media(max-width:768px){
    div#items {
    width: 100%;
    overflow: scroll;
    }
    .item-row {
        width: 625px;
    }
}
@media(max-width:576px){
    .item-row {
    width: 470px;
    }
}
</style>    
    <div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6 col-xs-6">
			<span class="text-center">
				<h3>Receive Order</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/orders/orderHistory">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
		</div>
	
	</div><!--.col-md-12 -->
	

<div class="container-fluid main-container">
	<div class="col-md-12">
	    <div class="row">
			<div class="col-md-7">
			    	<button onclick="printContent('div1')" class="btn-primary" style="float:right;margin-bottom:10px;">Print</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="panel" id="div1">
					<div id="order_success"></div>
					<!--<div class="panel-heading">-->
					<!--	<span style="float:left;width:70%;" class="size text-wrap" id="supplier_name"><?php echo $supplier_name;?></span>-->
					<!--	<span style="float:right;width:30%;text-align:right;" class="size text-wrap">PO - <?php echo $orders->order_number;?></span>-->
					<!--	<div style="clear:both;"></div>-->
				 <!--   </div>-->
				 <?php 
				    	
				    	if($orders->order_status == 'Sent'){
								$color = "style='background-color:#e96166;padding:0px;'";
							}else if($orders->order_status == 'Viewed'){
								$color = "style='background-color:#4b799d;padding:0px;'";
							}else if($orders->order_status == 'Confirmed'){
								$color = "style='background-color:#c3a428;padding:0px;'";
							}else{
								$color = "style='background-color:#319346;padding:0px;'";
							}
							?>
				    
				    <div class="panel-heading ph-dash" style="padding:5px;">
				    	<div class="col-md-4 text-wrap" style="line-height:24px;">
				    		<span style="display:block;font-size:17px;" id="supplier_name"><?php echo $supplier_name;?></span>
				    		<span id="supp_contact_name"></span> - <span id="supp_contact_number"></span>
				    	</div>
				    	<div class="col-md-4 text-wrap" style="line-height:24px;">
				    		<div class="" style="text-align:center;display:block;font-size:17px;"><span>PO - <?php echo $orders->order_number;?></span></div>
				    		<div <?php echo $color;?> class="status-color"><?php echo $orders->order_status; ?></div>
				    	</div>
				    	<div class="col-md-4 text-wrap" style="line-height:48px;">
				    		<div class="" style="text-align:right;font-size:20px;">Order : $<span id="order_total">00.00</span></div>
				    	</div>
				    </div>
				    
			    
				    <div class="panel-body">
				    	
				    	<div id="items">
				    	</div>
				    	
				    	<a href="javascript:void(0);" id="newItemBtn">Add new product</a>
				    	<input type="hidden" id="newItemId" value="1">
				    	<input type="hidden" id="suppliers" value="<?php echo $orders->supplier_id;?>">
				    	<br>
				    	<br>
				    	
				    	<div class="row">
				    		<div class="form-group col-md-6">
				    		<label for="deliverydate"  class="order-padding">Received date</label>
				    		<input type="text" class="form-control datepicker" id="received_date" value="<?php echo date('d-m-Y');?>">
				    		</div>
				    		<div class="form-group col-md-6">
				    			<label for="temp_record"  class="order-padding">Temperature Recording <span style="color:red">*</span></label>
				    			<input type="text" class="form-control" id="temp_record" required value="<?php echo $orders->temp_recording;?>">
				    		</div>
				    		
				    		<div class="form-group col-md-6">
					    		<label for="comments" class="order-padding">Comments</label>
					    		<textarea rows="3" class="form-control" name="comments" id="comments" ><?php echo $orders->comments;?></textarea>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Supplier Comments</label>
					    		<textarea rows="3" class="form-control" name="supplier_comments" id="supplier_comments" placeholder="Supplier comments"><?php echo $orders->supplier_comments;?></textarea>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="signature" class="order-padding">Name of the Checking Person <span style="color:red">*</span></label>
					    		<textarea rows="3" class="form-control" name="signature" id="signature" required><?php echo $orders->signature;?></textarea>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Credits</label>
					    		<textarea class="form-control" name="credits" id="credits" rows="3"><?php echo $orders->credits; ?></textarea>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Paid</label>
					    		<input type="checkbox"  name="paid" id="paid" value="1" <?php if($orders->paid == "1"){ echo "checked"; }?> >
				    		</div>
				    		
				    		
				    			<div class="form-group col-md-6">
					    		<label for="Any_breakage" class="order-padding">Any Damages</label>
					    		<textarea rows="3" class="form-control" name="Any_breakage" id="Any_breakage" ><?php echo $orders->Any_breakage;?></textarea>
				    		</div>
				    		
				    		
				    		<!--	<div class="form-group col-md-6">-->
					    	<!--	<label for="Any_breakage" class="order-padding">Any breakage</label>-->
					    	<!--	<input type="checkbox"  name="Any_breakage" id="Any_breakage" value="1" <?php if($orders->Any_breakage == "1"){ echo "checked"; }?> >-->
				    		<!--</div>-->
				    		<br>
				    			<div class="form-group col-md-6">
					    		<label for="Packaged_according_to_food" class="order-padding">Packaged according to food standards</label>
					    		<input type="checkbox"  name="Packaged_according_to_food" id="Packaged_according_to_food" value="1" <?php if($orders->Packaged_according_to_food == "1"){ echo "checked"; }?> >
				    		</div>
				    		<!--	<div class="form-group col-md-6">-->
					    	<!--	<label for="Any_return" class="order-padding">Any returns</label>-->
					    	<!--	<input type="checkbox"  name="Any_return" id="Any_return" value="1" <?php if($orders->Any_return == "1"){ echo "checked"; }?> >-->
				    		<!--</div>-->
				    	</div>
				    	<div class="row">
				    		<div class="form-group col-md-3">

				    		</div>
				    		<br><br>
					    	<button class="btn btn-success align button-width btncolor" onclick="placeOrder()">Save</button>
				    		
				    		
				    	</div>
				    	<div class="alert alert-warning" style="display:none" id="budget_message">
				    		<span id="budget_supplier_msg"></span><br>
				    		<span id="budget_branch_msg"></span>
				    	</div>
				    </div>
				</div>
				 <div class="panel pn">
					<div id="display_damaged_images">
			    <div class="panel-heading ph-dash">
			    	<div class="col-md-6">
			    	<h3 class="" style="float:left;">Damaged Goods</h3>
			    	</div>
			    	<?php if($orders->damaged_goods_file != ''){ ?>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/damaged_file/<?php echo $orders->damaged_goods_file;?>" target="_blank">View</a>
					</div>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" onClick="delete_row_damaged(<?php echo  $orders->order_id ?>);">Delete</a>
					</div>
					<?php } ?>
				</div>
			    <div class="panel-body">
			    	<div class="row">
			    		<div class="col-md-12">
			    		<?php if($orders->damaged_goods_file != ''){ ?>  
							<embed src="<?php echo base_url();?>assets/docs/damaged_file/<?php echo $orders->damaged_goods_file;?>" style="width:100%;min-height:600px;" alt="image1" class="upload-file">
						<?php }else{ ?>
			    			<form action="<?php echo base_url();?>index.php/orders/upload_damaged_file/<?php echo $orders->order_id;?>" name="damaged_invoice" id="damaged_invoice" class="dropzone" method="post" >
							</form>
						<?php } ?>
			    		</div>
			    	</div>
			     </div>
			  </div>   
		   </div>
			</div>
			<div class="col-md-5">
				<div class="panel pn">
				    <div class="panel-heading ph-dash_custom">
                  <ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#home">Invoice</a></li>
				    <li><a data-toggle="tab" href="#menu1">Invoice 1</a></li>
				    <li><a data-toggle="tab" href="#menu2">Invoice 2</a></li>
				    <li><a data-toggle="tab" href="#menu3">Invoice 3</a></li>
				  </ul>
                </div> 
				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
					<div id="display_images">
					<div class="panel-heading ph-dash">
								<div class="col-md-6">
								<h3 class="" style="float:left;">Invoice Copy</h3>
								</div>
								<?php 
										if($orders->invoice_copy != ''){
									?>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/invoices/<?php echo $orders->invoice_copy;?>" target="_blank">View</a>
								</div>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-filename="invoice_copy" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
								</div>
								<?php } ?>
								<div style="clear:both;"></div>
						    </div><br>
						    	<div class="row">
						    		<div class="col-md-12">
						    		<?php 
										if($orders->invoice_copy != ''){ 
									?>  
										<embed src="<?php echo base_url();?>assets/docs/invoices/<?php echo $orders->invoice_copy;?>"  style="width:100%;min-height:600px;" alt="image1" class="upload-file">
									<?php }else{ ?>
						    			<!-- dropzone-->
						    			<form action="<?php echo base_url();?>index.php/orders/uploadInvoice/<?php echo "invoice_copy";?>/<?php echo $orders->order_id;?>" name="invoice" id="invoice" class="dropzone" method="post" >
										</form>
									<?php } ?>
						    		</div>
						    	</div>
				   </div>
				   </div>
				   
				   <div id="menu1" class="tab-pane fade">
					      <div class="panel-heading ph-dash">
								<div class="col-md-6">
								<h3 class="" style="float:left;">Invoice Copy 1</h3>
								</div>
								<?php 
										if($orders->invoice_copy_1 != ''){
									?>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/invoices_1/<?php echo $orders->invoice_copy_1;?>" target="_blank">View</a>
								</div>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-filename="invoice_copy_1" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
								</div>
								<?php } ?>
								<div style="clear:both;"></div>
						    </div><br>
						    	<div class="row">
						    		<div class="col-md-12">
						    		<?php 
										if($orders->invoice_copy_1 != ''){ 
									?>  
										<embed src="<?php echo base_url();?>assets/docs/invoices_1/<?php echo $orders->invoice_copy_1;?>" style="width:100%;min-height:600px;" alt="image1" class="upload-file">
									<?php }else{ ?>
						    			<!-- dropzone-->
						    			<form action="<?php echo base_url();?>index.php/orders/uploadInvoice/<?php echo "invoice_copy_1";?>/<?php echo $orders->order_id;?>" name="invoice" id="invoice" class="dropzone" method="post" >
										</form>
									<?php } ?>
						    		</div>
						    	</div>
					    </div>
					    <div id="menu2" class="tab-pane fade">
					      <div class="panel-heading ph-dash">
								<div class="col-md-6">
								<h3 class="" style="float:left;">Invoice Copy 2</h3>
								</div>
								<?php 
										if($orders->invoice_copy_2 != ''){
									?>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/invoices_2/<?php echo $orders->invoice_copy_2;?>" target="_blank">View</a>
								</div>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-filename="invoice_copy_2" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
								</div>
								<?php } ?>
								<div style="clear:both;"></div>
						    </div><br>
						    	<div class="row">
						    		<div class="col-md-12">
						    		<?php 
										if($orders->invoice_copy_2 != ''){ 
									?>  
										<embed src="<?php echo base_url();?>assets/docs/invoices_2/<?php echo $orders->invoice_copy_2;?>" style="width:100%;min-height:600px;" alt="image1" class="upload-file">
									<?php }else{ ?>
						    			<!-- dropzone-->
						    			<form action="<?php echo base_url();?>index.php/orders/uploadInvoice/<?php echo "invoice_copy_2";?>/<?php echo $orders->order_id;?>" name="invoice" id="invoice" class="dropzone" method="post" >
										</form>
									<?php } ?>
						    		</div>
						    	</div>
					    </div>
					    <div id="menu3" class="tab-pane fade">
					      <div class="panel-heading ph-dash">
								<div class="col-md-6">
								<h3 class="" style="float:left;">Invoice Copy 3</h3>
								</div>
								<?php 
										if($orders->invoice_copy_3 != ''){
									?>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/invoices_3/<?php echo $orders->invoice_copy_3;?>" target="_blank">View</a>
								</div>
								<div class="col-md-2" style="text-align:right;padding-right:0px;">
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-filename="invoice_copy_3" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
								</div>
								<?php } ?>
								<div style="clear:both;"></div>
						    </div><br>
						    	<div class="row">
						    		<div class="col-md-12">
						    		<?php 
										if($orders->invoice_copy_3 != ''){ 
									?>  
										<embed src="<?php echo base_url();?>assets/docs/invoices_3/<?php echo $orders->invoice_copy_3;?>" style="width:100%;min-height:600px;" alt="image1" class="upload-file">
									<?php }else{ ?>
						    			<!-- dropzone-->
						    			<form action="<?php echo base_url();?>index.php/orders/uploadInvoice/<?php echo "invoice_copy_3";?>/<?php echo $orders->order_id;?>" name="invoice" id="invoice" class="dropzone" method="post" >
										</form>
									<?php } ?>
						    		</div>
						    	</div>
					    </div>
						</div>
				</div>
			</div>
		</div>	
	</div>	
	
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

<div class="modal fade" id="myModal_edit" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<form role="form" class="form-horizontal" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Product</h4>
			</div>
			<div class="modal-body">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">Product Details</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="edit_product_name" class="col-sm-4 control-label">Product Name<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="edit_product_name" id="edit_product_name">
								</div>
							</div>
							<div class="form-group">
								<label for="edit_product_quantity" class="col-sm-4 control-label">Quantity<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="edit_product_quantity" id="edit_product_quantity"  autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label for="edit_product_price" class="col-sm-4 control-label">Price<span>*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="edit_product_price" id="edit_product_price"  autocomplete="off">
									<input type="hidden" name="edit_item_id" id="edit_item_id" value="">
								</div>
							</div>  
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btncolor" onclick="updateProduct();">Save</button>
				<button type="button" class="btn btn-default btn-default pull-right" data-dismiss="modal">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>


        	
</div><!--.container-->
		
	<br>
<!--.footer-->
<script type="text/javascript">
	function delete_row(el,str){
	   
	    var field_name = $(el).attr("data-filename"); 
	     console.log(field_name);
if(confirm('Are you sure you   want to delete file')){
	      $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/orders/deleteInvoice",
				data: {order_id: str, field_name: field_name},
				success: function(data){
					location.reload();
				}
			});   
}	
	}
	</script>
<script type="text/javascript">
	function delete_row_damaged(str){
if(confirm('Are you sure you   want to delete file')){
	      $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/orders/deleteInvoice_damaged",
				data:"order_id="+str,
				success: function(data){
					location.reload();
				}
			});   
}	
	}
	</script>
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
	orders = JSON.parse('<?php echo $this->session->userdata('order_items'); ?>');
	
	suppliers = JSON.parse('<?php echo $this->session->userdata('suppliers'); ?>');
	<?php } ?>
	
	loadCartDetails();
	// console.log(orders);
	function loadCartDetails(){
		var supId = '<?php echo $orders->supplier_id;?>';
		var order_items = JSON.parse('<?php echo $order_items; ?>');
		var order_id = '<?php echo $orders->order_id;?>';
	
		orders[supId] = {};
		var items = [];
		var quantity = [];
		var amount = [];
		var itemName = [];
		var itemStatus = [];
		var itemPrice = [];
		var itemUom = [];
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
		    var itemStatus_obj = value.status;
		    var price_obj = value.price;
		    var uom_obj = value.uom;
		    var budget = '<?php echo $supplier_budget; ?>';//value.balance[0];
			
			items.push(item_obj);
			quantity.push(qty_obj);
			amount.push(amount_obj);
			itemName.push(itemName_obj);
			itemStatus.push(itemStatus_obj);
			itemPrice.push(price_obj);
			itemUom.push(uom_obj);
			balance.push(budget);
			
			orders[supId].item = items;
			orders[supId].qty = quantity;
			orders[supId].amount = amount;
			orders[supId].itemName = itemName;
			orders[supId].itemStatus = itemStatus;
			orders[supId].balance = balance;
			orders[supId].itemPrice = itemPrice;
			orders[supId].itemUom = itemUom;
		});
		
		
		var orderItems = orders[supId];
		var items_loop = orders[supId].item;
		var items = '';
		var total = 0;
		var supp_name = '<?php echo $supplier_name;?>';
		
		items+='<div class="item-row"><div class="item-left-small no-border" style="width:12%">&nbsp;</div>\n'
					+'<div class="item-left" style="width:22%;text-align:left;">Item</div>\n'
		    		+'<div class="item-left" style="width:19%">Qty</div>\n'
		    		+'<div class="item-left" style="width:19%;text-align:right">Price</div>\n'
		    		+'<div class="item-left no-border" style="width:18%;text-align:right">Amount</div>\n'
		    		+'<div class="item-left-small no-border ">Appr/Reject<br><input type="checkbox" id="check_accept_all">/<input type="checkbox" id="check_reject_all"></div>\n'
		    		+'<div style="clear:both;"></div></div>';
		$.each( items_loop, function( key, value ) {
			//console.log(value);
			total = Number(total) + Number(orderItems.amount[key]);
			var amnt1 = orderItems.amount[key];
			var amnt2 = Number(amnt1).toFixed(2);
			var price = orderItems.itemPrice[key];
			var price2 = Number(price).toFixed(2);
			var checked = '';
			if(orderItems.itemStatus[key] == 'Approved'){
			    var checked = 'checked'
			}
			if(orderItems.itemStatus[key] == 'Rejected'){
			    var checked_Rejected = 'checked'
			}
			items+='<div class="item-row ItelListingAll"><div class="item-left-small" style="width:12%"><a style="padding:0 5px;" onclick="getOrderItemDetails(`'+value+'`);"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;</a><a style="padding:0 5px;" onclick="deleteCartItem(`'+value+'`,`'+order_id+'`)"><span class="glyphicon glyphicon-trash"></span></a></div>\n'
		    		+'<div class="item-left2" style="width:22%;text-align:left;">'+orderItems.itemName[key]+'</div>\n'
		    		+'<div class="item-left-small" style="width:19%">'+orderItems.qty[key]+'/'+orderItems.itemUom[key]+'</div>\n'
		    		+'<div class="item-left2" style="width:19%;text-align:right">$'+price2+'</div>\n'
		    		+'<div class="item-left2 color"style="width:18%;text-align:right">$'+amnt2+'</div>\n'
		    		// +'<div class="item-left-small no-border"><input type="checkbox" name="received_items[]" value="'+value+'"></div>\n'
		    		+'<div class="item-left-small no-border" style="width:4%;text-align:right"><input class="status_prd appr_status" type="checkbox" id="'+value+'" name="Approved_'+value+'" value="Approved" '+checked+'></div>\n'
		    		+'<div class="item-left-small no-border" style="width:4%;text-align:right"><input class="status_prd reject_status" type="checkbox" id="'+value+'" name="Rejected_'+value+'" value="Rejected"'+checked_Rejected+'></div>\n'
		    		+'<div style="clear:both;"></div></div>';
		});
// 		console.log(items);
		$('#items').html(items);
		$('#order_total').html(Number(total).toFixed(2));
		
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
		var itemUom = [];
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
		        		balance.push(data);
		        		orders[supId].balance = balance;
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
			    var amount_obj = orders[supId].amount;
			    var itemName_obj = orders[supId].itemName;
			    var budget = orders[supId].balance[0];
			    var price_obj = orders[supId].itemPrice;
		    	var uom_obj = orders[supId].itemUom;
				
				if(jQuery.inArray(itemId, item_obj) >= 0){
					var index = jQuery.inArray(itemId, item_obj);
					if(qty > 0){
						qty_obj[index] = qty;
						amount_obj[index] = amount_cal;
						itemName_obj[index] = item_name;
						price_obj[index] = price;
						uom_obj[index] = 'pcs';
					}else{
						item_obj.splice(index,1);
						qty_obj.splice(index,1);
						amount_obj.splice(index,1);
						itemName_obj.splice(index,1);
						price_obj.splice(index,1);
						uom_obj.splice(index,1);
					}
				}
				else{
					items = item_obj;
					quantity = qty_obj;
					amount = amount_obj;
					itemName = itemName_obj;
					itemPrice = price_obj;
					itemUom = uom_obj;
					//balance check for existing items
					items.push(itemId);
					quantity.push(qty);
					amount.push(amount_cal);
					itemName.push(item_name);
					itemPrice.push(price);
					itemUom.push('pcs');
					
					orders[supId].item = items;
					orders[supId].qty = quantity;
					orders[supId].amount = amount;
					orders[supId].itemName = itemName;
					orders[supId].itemPrice = itemPrice;
					orders[supId].itemUom = itemUom;
					
				}
				
			}else{
				if(qty > 0){
					items.push(itemId);
					quantity.push(qty);
					amount.push(amount_cal);
					itemName.push(item_name);
					itemPrice.push(price);
					itemUom.push('pcs');
					
					orders[supId].item = items;
					orders[supId].qty = quantity;
					orders[supId].amount = amount;
					orders[supId].itemName = itemName;
					orders[supId].itemPrice = itemPrice;
					orders[supId].itemUom = itemUom;
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
		
		var order_id = '<?php echo $orders->order_id;?>';
		if(supplierId != null){
			var supplier_name =  suppliers[supplierId];//$("option:selected",e).text(); 
	
			$('#supplier_name').html(supplier_name);
		
			var order_items = orders[supplierId];
			var items_loop = orders[supplierId].item;
			var items = '';
			var total = 0;
			items+='<div class="item-row"><div class="item-left-small no-border" style="width:12%">&nbsp;</div>\n'
					+'<div class="item-left" style="width:22%;text-align:left;">Item</div>\n'
		    		+'<div class="item-left" style="width:19%">Qty</div>\n'
		    		+'<div class="item-left" style="width:19%;text-align:right">Price</div>\n'
		    		+'<div class="item-left no-border" style="width:18%;text-align:right">Amount</div>\n'
		    		+'<div class="item-left-small no-border">&nbsp;</div>\n'
		    		+'<div style="clear:both;"></div></div>';
			$.each( items_loop, function( key, value ) {
				//console.log(value);
				var amnt3 = order_items.amount[key];
				var amnt4 = Number(amnt3).toFixed(2);
				var price3 = order_items.itemPrice[key];
				var price4 = Number(price3).toFixed(2);
				
				total = Number(total) + Number(order_items.amount[key]);
				// var amnt3 = order_items.amount[key];
						
			    items+='<div class="item-row"><div class="item-left-small" style="width:12%"><a style="padding:0 5px;" onclick="getOrderItemDetails(`'+value+'`);"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;<a style="padding:0 5px;" onclick="deleteCartItem(`'+value+'`,`'+order_id+'`)"><span class="glyphicon glyphicon-trash"></span></a></div>\n'
		    		+'<div class="item-left2" style="width:22%;text-align:left;">'+order_items.itemName[key]+'</div>\n'
		    		+'<div class="item-left-small" style="width:19%">'+order_items.qty[key]+'/'+order_items.itemUom[key]+'</div>\n'
		    		+'<div class="item-left2" style="width:19%;text-align:right">$'+price4+'</div>\n'
		    		+'<div class="item-left2 color"style="width:18%;text-align:right">$'+amnt4+'</div>\n'
		    		+'<div class="item-left-small no-border"><input type="checkbox" name="received_items[]" value="'+value+'"></div>\n'
		    		+'<div style="clear:both;"></div></div>';
				
			});
			
			console.log(items);
			//get delivery dates
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
			$('#order_total').html(Number(total).toFixed(2));
		}else{
			$('#items').html('');
			$('#supplier_name').html('');
			$('#order_total').html('');
		}
	}
	
	
	
	//place order
	function placeOrder(){
		var order_id = '<?php echo $orders->order_id; ?>';
		var supplier = '<?php echo $orders->supplier_id; ?>';//$('#suppliers').val();
		
	    var json =	encodeURIComponent(JSON.stringify(orders));
		
	
		var received_date = $('#received_date').val();
		var comments = $('#comments').val();
		var temp_record = $('#temp_record').val();
		var signature = $('#signature').val();
		var credits = $('#credits').val();
		var paid = $('#paid').val();
		
		if(temp_record == '' || signature == ''){
		    alert("Please enter temperature recording , name of the checking person and approve/reject for each products before clicking on the receive button.");
		    return false;
		}
// 		var Any_return = $('#Any_return').val();
        var Any_return = '';
		var Packaged_according_to_food = $('#Packaged_according_to_food').val();
		var Any_breakage = $('#Any_breakage').val();
		
		var val = [];
        $('.status_prd:checked').each(function(i){
          val[i] = $(this).val();
        });
        var received_items = JSON.stringify( val );
        
        // for validating if all the checkbox corresponding to each prdct for approve and reject has been checked 
     var all_items_count = $("#items .ItelListingAll").length;
    
 
        
     var selected_item_for_approved_rejected = [];
     var checked_item_count = 0;
$('.ItelListingAll input:checked').each(function() {
    selected_item_for_approved_rejected.push($(this).attr('name'));
    checked_item_count ++;
});

if(checked_item_count != all_items_count){
    console.log(selected_item_for_approved_rejected);
    alert("Please enter temperature recording , name of the checking person and approve/reject for each products before clicking on the receive button.");
     return false;
}



        
       
		var order_total = $('#order_total').html();
		var budget_balance = Number('<?php echo $supplier_budget;?>');//orders[supplier].balance;
		var branch_budget = Number('<?php echo $branch_budget;?>');//$('#branch_budget').val();
		
		//orders count
		var orders_count = '<?php echo $orders_count;?>';//$('#orders_count').val();
		var limit = '<?php echo $orders_limit;?>';
			
		var balance = Number(limit) - Number(orders_count);
		
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/updateReceiveOrder",
	        data:'supplier_id='+supplier+'&order='+json+'&selected_item_for_approved_rejected='+selected_item_for_approved_rejected+'&received_date='+received_date+'&comments='+comments+'&order_id='+order_id+'&received_items='+received_items+'&temp_record='+temp_record+'&signature='+signature+'&credits='+credits+'&paid='+paid+'&Any_return='+Any_return+'&Packaged_according_to_food='+Packaged_according_to_food+'&Any_breakage='+Any_breakage,
	        success: function(data){
	        	// if(data == 'success'){
	        	// 	var msg = '<div class="hideMe"><p class="alert alert-success">Order updated successfully</p></div>';
	        	// 	$('#order_success').html(msg);
	        	// }
	        	window.location = "<?php echo base_url();?>index.php/orders/orderHistory";
	        }
        });
			
	}
	
	function addNewProduct(){
		
		var product_name = $('#product_name').val();
		var product_quantity = $('#product_quantity').val();
		var product_price = $('#product_price').val();
		var amount = product_price * product_quantity;
		var supName = '<?php echo $supplier_name;?>';
		var order_id = '<?php echo $orders->order_id; ?>';
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
			
			var product_details = [
		      {order_id : order_id,customer_id:14,item_name:product_name,quantity:product_quantity,price:product_price,amount:amount}
		      ];
		      
		      
		      	$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/addNewProduct",
	        data:{product_details:product_details},
	      
	        success: function(data){
	            var supId = $('#suppliers').val(); 
	        	addToCart(itemId, supId, product_price, supName, product_name, product_quantity);
	            location.reload();
	        }
        });
			
		
			var newId = Number(newItemId)+1;
			$('#newItemId').val(newId);
			
			$("#myModal .close").click();
		}
		
		
	}
	
	function getOrderItemDetails(itemId){
		
		$("#myModal_edit").modal();
	    
		var supplierId = $('#suppliers').val();
		var order_items = orders[supplierId];
		var items_loop = orders[supplierId].item;
		var items = '';
		var total = 0;
		$.each( items_loop, function( key, value ) {
			//console.log(value);
			if(value == itemId){
				var itemName = order_items.itemName[key];
				var itemQty = order_items.qty[key];
				var itemPrice = order_items.itemPrice[key];
				
				$('#edit_product_name').val(itemName);
				$('#edit_product_quantity').val(itemQty);
				$('#edit_product_price').val(itemPrice);
				$('#edit_item_id').val(itemId);
			}
			
		});
	}
	function updateProduct(){
		var supId = $('#suppliers').val();
		var product_name = $('#edit_product_name').val();
		var product_quantity = $('#edit_product_quantity').val();
		var product_price = $('#edit_product_price').val();
		var order_item_id = $('#edit_item_id').val();
		var supName = '<?php echo $supplier_name;?>';
		var order_id = '<?php echo $orders->order_id; ?>';
		var amount = product_quantity * product_price;
		  var product_details = [
		      {item_name:product_name,quantity:product_quantity,price:product_price,amount:amount}
		      ];

		
		
		if(product_name == ''){
			var name_error = 1;
			$('#edit_product_name').css('border-color','red');
		}else{
			var name_error = 0;
			$('#edit_product_name').css('border-color','#ccc');
		}
		if(product_quantity == ''){
			var qty_error = 1;
			$('#edit_product_quantity').css('border-color','red');
		}else{
			var qty_error = 0;
			$('#edit_product_quantity').css('border-color','#ccc');
		}
		if(product_price == ''){
			var price_error = 1;
			$('#edit_product_price').css('border-color','red');
		}else{
			var price_error = 0;
			$('#edit_product_price').css('border-color','#ccc');
		}
		
		if(name_error == 0 && qty_error == 0 && price_error == 0){
			var edit_itemId = $('#edit_item_id').val();
			var item_obj = orders[supId].item;
		    var qty_obj = orders[supId].qty;
		    var amount_obj = orders[supId].amount;
		    var itemName_obj = orders[supId].itemName;
		    var itemPrice_obj = orders[supId].itemPrice;
		    var itemUom_obj = orders[supId].itemUom;
		    var budget = orders[supId].balance[0];
			
			if(jQuery.inArray(edit_itemId, item_obj) >= 0){
				var index = jQuery.inArray(edit_itemId, item_obj);
				item_obj.splice(index,1);
				qty_obj.splice(index,1);
				amount_obj.splice(index,1);
				itemName_obj.splice(index,1);
				itemPrice_obj.splice(index,1);
				itemUom_obj.splice(index,1);
			}
			
			var itemId = edit_itemId;
			
			
			
// 			addToCart(itemId, supId, product_price, supName, product_name, product_quantity);
			
			
		}
			$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/update_product_in_order",
	        data:{order_item_id:order_item_id,order_id:order_id,product_details:product_details},
	      
	        success: function(data){
	        	location.reload();
	        }
        });
        
        $("#myModal_edit .close").click();
		
		
	}
	
	function deleteCartItem(order_item_id, orderId){
		
		
		if (confirm("Are you sure you want to delete") == true) {
	       
	       
	       	
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/update_product_in_order",
	        data:'order_item_id='+order_item_id+'&order_id='+orderId,
	        success: function(data){
	        	location.reload();
	        }
        });
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
        
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
	Dropzone.options.invoice = {
		maxFiles: 1,
	    paramName: "file",
	    resizeWidth: 1920,
	    resizeHeight: 1920,
	    resizeQuality: 0.75,
	    resizeMethod: 'contain',
	    accept: function(file, done) {
		    console.log("uploaded");
		    done();
		},
		init: function() {
		    this.on("maxfilesexceeded", function(file){
		        alert("No more files please!");
		    });
		},
	    renameFile: function (file) {
	  	var ext = file.name.split('.').pop();
            return file.name ="invoice-<?php echo trim($orders->order_number);?>." + ext;
        },
        
	    maxFilesize: 10, // MB
	    dictDefaultMessage:"Drop invoice here",
	    acceptedFiles :"image/jpg,image/jpeg,image/png,application/pdf",
	    success: function(file, response){
                location.reload();
            }
	};
	Dropzone.options.damaged_invoice = {
		maxFiles: 1,
	    paramName: "file",
	    resizeWidth: 1920,
	    resizeHeight: 1920,
	    resizeQuality: 0.75,
	    resizeMethod: 'contain',
	    accept: function(file, done) {
		    console.log("uploaded");
		    done();
		},
		init: function() {
		    this.on("maxfilesexceeded", function(file){
		        alert("No more files please!");
		    });
		},
	    renameFile: function (file) {
	  	var ext = file.name.split('.').pop();
            return file.name ="invoice-<?php echo trim($orders->order_number);?>." + ext;
        },
        
	    maxFilesize: 10, // MB
	    dictDefaultMessage:"Drop invoice here",
	    acceptedFiles :"image/jpg,image/jpeg,image/png,application/pdf",
	    success: function(file, response){
	    	location.reload();
            }
	};
	
	function printContent(el){    var restorepage = document.body.innerHTML;    var printcontent = document.getElementById(el).innerHTML;    document.body.innerHTML = printcontent;    window.print();    document.body.innerHTML = restorepage;   }
    </script>
    <script>
    
    $('.status_prd').on( 'click', function() {
        var order_id = '<?php echo $orders->order_id;?>';
        var status='';
        var item_id=$(this).attr('id');
        var status_type=$(this).val();
        
        console.log(item_id);
        if(status_type == 'Approved'){
            if($(this).is(":checked")){
              var status='Approved';
            }
            else{
              status='';
            }
        }
        else{
            if($(this).is(":checked")){
              var status='Rejected';
            }
        }
        
        // console.log(status);
        $.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/updateOrderItemStatus",
	        data:'order_id='+order_id+'&item_id='+item_id+'&status='+status,
	        success: function(data){
	            if(status_type == 'Rejected'){
	                location.reload();
	            }
	        	
	        }
        });
    });
    $("#check_accept_all").on('change',function(e){
        var ids = [];
        var order_id = '<?php echo $orders->order_id;?>';
        
		if($("#check_accept_all").is(":checked")){
			$(".appr_status").prop('checked',true);
			$(".reject_status").prop('checked',false);
			
			var status = 'Approved';
			
		}else{
			$(".appr_status").prop('checked',false);
			var status = '';
		}
		
		$(".appr_status").each(function(){
		    ids.push($(this).prop('id'));
		});
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/updateOrderItemStatus",
	        data:'order_id='+order_id+'&ids='+ids+'&status='+status,
	        success: function(data){
	            
	        	
	        }
        });
                
	});
	$("#check_reject_all").on('change',function(e){
	    var ids = [];
        var order_id = '<?php echo $orders->order_id;?>';
		if($("#check_reject_all").is(":checked")){
			$(".reject_status").prop('checked',true);
			$(".appr_status").prop('checked',false);
			var status = 'Rejected';
		}
		else{
			$(".reject_status").prop('checked',false);
			var status = '';
		}
		
		$(".reject_status").each(function(){
		    ids.push($(this).prop('id'));
		});
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/orders/updateOrderItemStatus",
	        data:'order_id='+order_id+'&ids='+ids+'&status='+status,
	        success: function(data){
	            
	        	
	        }
        });
	});
 
    </script>
    
    
    