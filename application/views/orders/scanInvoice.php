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
.item-row div{
    font-size: 11px !important;
}
</style>    
    <div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6 col-xs-6">
			<span class="text-center">
				<h3>OCR Scan Result</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/orders/orderHistory">
			    	<a class="btn btn-primary  btn-ph" style="padding: 13px 16px"  href="<?php echo base_url();?>/<?php echo $targetFile; ?>" target="_blank">View Invoice</a>
				<a  href="<?php echo base_url().'index.php/orders/orderHistory' ?>" class="btn btn-ph btn-ph-cancel" >Back</a>
				<button onclick="printContent('div1')" class="btn btn-ph" style="color:black ">Print</button>
			</a>
		</div>
	
	</div><!--.col-md-12 -->
	

<div class="container-fluid main-container" style="max-width: 1562px !important" >
	<div class="col-md-12">
	    
	   
		<div class="row" >
	<table class="table  table-dark">
  <thead >
    <tr>
     <th style="background-color: #d5d4d4; color : black;padding-left: 120px;font-size: 18px;font-weight: 600;" scope="col">Original Order</th>
      <th style="background-color: #d5d4d4; color : black;padding-left: 360px;font-size: 18px;font-weight: 600;" scope="col">Ocr Order</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
       <div >
				<div class="panel">
					<div id="order_success"></div>
				
				    <div class="panel-heading ph-dash" style="padding:5px;background-color: #63357c;">
				    	<div class="col-md-4 text-wrap" style="line-height:24px;">
				    		<span class="text-wrap" style="display:block;font-size:12px;" id="supplier_name"><?php echo (isset($supplier_name) ? $supplier_name : '');?></span>
				    	</div>
				    	<div class="col-md-4 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;"><span>PO - <?php echo (isset($orders->order_number) ? $orders->order_number : '');?></span></div>
				    		<div  style="padding-left: 28px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo (isset($orders->order_status) ? $orders->order_status : ''); ?></div>
				    	</div>
				    	<div class="col-md-4 text-wrap" style="line-height:48px;">
				    		<div class="" style="text-align:right;font-size:12px;">Order : $<span id="order_total">00.00</span></div>
				    	</div>
				    </div>
				     <div class="panel-body">
			    	<div id="items">
			    		
			    	</div>
			    	</div>
				</div>
			
			</div>   
      </td>
      <td>
       <div >
				<div class="panel">
					<div id="order_success"></div>
			
				   <div class="panel-heading ph-dash" style="padding:5px;background-color: #63357c;">
				    
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:10px;"><span>Supplier Name</span></div>
				    		<div  style="padding-left: 4px;background-color: #8a6d3b;display:block;font-size:10px;"><?php echo (isset($invoiceData['supplierName']) ? $invoiceData['supplierName'] : ''); ?></div>
				    	</div>
				    	
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;"><span>PO</span></div>
				    		<div  style="padding-left: 18px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo (isset($invoiceData['purchaseOrderNo']) ? $invoiceData['purchaseOrderNo'] : ''); ?></div>
				    	</div>
				    	
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;"><span>Invoice No.</span></div>
				    		<div  style="padding-left: 18px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo (isset($invoiceData['invoiceId']) ? $invoiceData['invoiceId'] : ''); ?></div>
				    	</div>
				    	
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;"><span>Invoice Date</span></div>
				    		<div  style="padding-left: 14px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo (isset($invoiceData['invoiceDate']) ? $invoiceData['invoiceDate'] : ''); ?></div>
				    	</div>
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;"><span>Order Total</span></div>
				    		<div  style="padding-left: 18px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo "$".(isset($invoiceData['invoiceTotal']) ? $invoiceData['invoiceTotal'] : ''); ?></div>
				    	</div>
				    	<div class="col-md-2 text-wrap" style="line-height:24px;">
				    		<div  style="display:block;font-size:12px;font-weight:600"><span>GST</span></div>
				    		<div  style="padding-left: 18px;background-color: #8a6d3b;display:block;font-size:12px;"><?php echo (isset($invoiceData['gst']) ? $invoiceData['gst'] : ''); ?></div>
				    	</div>
				    	
				    	
				    </div>
				    
				    <?php 
				    $purchase_value = (isset($invoiceData['invoiceTotal']) ? $invoiceData['invoiceTotal'] : ''); // Replace this with your dynamic value
                    $tax_paid = (isset($invoiceData['gst']) ? $invoiceData['gst'] : '');
                    $frePurchase = $purchase_value - ($tax_paid / 0.1 * 1.1);
                    $gstPurchase = $purchase_value - $frePurchase;

				    ?>
				<div class="panel-body">
				<div id="itemsScanned">
			    <div class="item-row">
				<div class="item-left" style="width:10%;text-align:left;">Supplier Name</div>
		    	<div class="item-left" style="width:28%">GST Code</div>
		    	<div class="item-left" style="width:7%;text-align:center;">Purchase Value</div>
		    	<div class="item-left" style="width:7%;text-align:center">Tax Paid</div>
		    	
		    		<div class="item-left" style="width:7%;">FRE Purchase</div>
		    	<div class="item-left" style="width:10%;text-align:center">GST Purchase</div>
		    	<div class="item-left no-border" style="width:10%;">GL Category</div>
		    	<div class="item-left no-border" style="width:12%;">GL Code</div>
		    	<div style="clear:both;"></div></div>
		    	
		    	 <div class="item-row ItelListingAll">
		    	<div class="item-left-small" style="width:10%;text-align:left;word-wrap: break-word;"><?php echo (isset($invoiceData['supplierName']) ? $invoiceData['supplierName'] : ''); ?></div>
		    	<div class="item-left-small" style="width:28%;word-wrap: break-word;"> GST </div>
		    	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo (isset($invoiceData['invoiceTotal']) ? $invoiceData['invoiceTotal'] : ''); ?></div>
		    	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo (isset($invoiceData['gst']) ? $invoiceData['gst'] : '00.00'); ?></div>
		    	
		    	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo number_format($frePurchase,2); ?></div>
		    	<div class="item-left-small" style="width:10%;text-align:center;word-wrap: break-word;"><?php  echo number_format($gstPurchase,2); ?></div>
		    	<div class="item-left-small" style="width:10%;text-align:right;word-wrap: break-word;"><?php  echo (isset($gl_category) &&  $gl_category !== '' ? $gl_category : '--'); ?></div>
		    	<div class="item-left-small " style="width:12%;text-align:right;word-wrap: break-word;"><?php  echo (isset($gl_code) &&  $gl_code !== '' ? $gl_code : '--'); ?></div>
		    	<div style="clear:both;"></div>
		    	</div>
		    	

                
		    	
		    	
			    	</div>
			 <!--   	<div id="itemsScanned">-->
			 <!--   	<div class="item-row">-->
				<!--<div class="item-left" style="width:10%;text-align:left;">Item Code</div>-->
		  <!--  	<div class="item-left" style="width:28%">Desc</div>-->
		  <!--  	<div class="item-left" style="width:7%;text-align:center;">Qty</div>-->
		  <!--  	<div class="item-left" style="width:7%;text-align:center">Unit Price</div>-->
		  <!--  		<div class="item-left" style="width:7%;">Item Total</div>-->
		  <!--  	<div class="item-left" style="width:10%;text-align:center">Item Gst</div>-->
		  <!--  	<div class="item-left no-border" style="width:10%;">Account</div>-->
		  <!--  	<div class="item-left no-border" style="width:12%;">Account Name</div>-->
		  <!--  	<div class="item-left no-border" style="width:9%;">Tax Code</div>-->
		  <!--  	<div style="clear:both;"></div></div>-->

                
    <!--              <?php  if(!empty($invoiceData['Items'])){ ?>-->
    <!--              <?php foreach($invoiceData['Items'] as $Itemcode => $Item) {  ?>-->
    <!--              <div class="item-row ItelListingAll">-->
		  <!--  	<div class="item-left-small" style="width:10%;text-align:left;word-wrap: break-word;"><?php echo ($viewPage == true ? $Item->itemCode : $Itemcode); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:28%;word-wrap: break-word;"> <?php  echo (isset($Item->ItemsDescr) && $Item->ItemsDescr !== '' ? $Item->ItemsDescr : '--'); ?> </div>-->
		  <!--  	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo (isset($Item->ItemsQty) && $Item->ItemsQty !== '' ? $Item->ItemsQty : '--'); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo (isset($Item->ItemsUnitPrice) && $Item->ItemsUnitPrice !== '' ? $Item->ItemsUnitPrice : '--'); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:7%;text-align:center;"><?php  echo (isset($Item->ItemsTotal) && $Item->ItemsTotal !== '' ? $Item->ItemsTotal : '--'); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:10%;text-align:center;word-wrap: break-word;"><?php  echo (isset($Item->ItemsTax) && $Item->ItemsTax !== '' ? $Item->ItemsTax : '--'); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:10%;text-align:right;word-wrap: break-word;"><?php  echo (isset($Item->account) &&  $Item->account !== '' ? $Item->account : '--'); ?></div>-->
		  <!--  	<div class="item-left-small " style="width:12%;text-align:right;word-wrap: break-word;"><?php  echo (isset($Item->account_name) &&  $Item->account_name !== '' ? $Item->account_name : '--'); ?></div>-->
		  <!--  	<div class="item-left-small" style="width:9%;text-align:right;word-wrap: break-word;"><?php  echo (isset($Item->tax_code) &&  $Item->tax_code !== '' ? $Item->tax_code : '--'); ?></div>-->
		  <!--  	<div style="clear:both;"></div>-->
		  <!--  	</div>	-->
		  <!--  	<?php } ?>-->
		  <!--  	<?php } ?>-->
		    	
		    	
			 <!--   	</div>-->
			    	
			    	</div>
			    </div>
			
			</div>   
      </td>
    </tr> 
  </tbody>
</table>
	</div>
	
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
					    		<label for="paid" class="order-padding">Paid</label>
					    		<input type="checkbox"  name="paid" id="paid" value="1" <?php if($orders->paid == "1"){ echo "checked"; }?> >
				    		</div>
				    		
				    		
				    			<div class="form-group col-md-6">
					    		<label for="Any_breakage" class="order-padding">Any Damages</label>
					    		<textarea rows="3" class="form-control" name="Any_breakage" id="Any_breakage" ><?php echo $orders->Any_breakage;?></textarea>
				    		
				    		<br>
				    			<div class="form-group col-md-6">
					    		<label for="Packaged_according_to_food" class="order-padding">Packaged according to food standards</label>
					    		<input type="checkbox"  name="Packaged_according_to_food" id="Packaged_according_to_food" value="1" <?php if($orders->Packaged_according_to_food == "1"){ echo "checked"; }?> >
				    		</div>
				    		<br>	</br>
				    	<button class="btn btn-success align button-width btncolor updatedOrder" onclick="updateOrderData()">Save</button>
				    	</div>
				    	
	</div>	
	</div>

         



<script type="text/javascript">
	var orders = {};
		function printContent(el){ 
// 		    var restorepage = document.body.innerHTML;
// 		    var printcontent = document.getElementById(el).innerHTML;
// 		document.body.innerHTML = printcontent; 
		window.print(); 
// 		document.body.innerHTML = restorepage;
		}

	<?php if(null !== $this->session->userdata('order_items')){ ?>
	orders = JSON.parse('<?php echo $this->session->userdata('order_items'); ?>');
	<?php } ?>
	
	loadCartDetails();

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
		var itemCode = [];
			

        
		$.each( order_items, function( key, value ) {
			var item_obj = value.item_id;
			var qty_obj = value.quantity;
		    var amount_obj = value.amount;
		    var itemName_obj = value.item_name;
		     var itemCode_obj = value.itemCode;
		    var itemStatus_obj = value.status;
		    var price_obj = value.price;
		    var uom_obj = value.uom;
		  
			
			items.push(item_obj);
			quantity.push(qty_obj);
			amount.push(amount_obj);
			itemName.push(itemName_obj);
			itemStatus.push(itemStatus_obj);
			itemPrice.push(price_obj);
			itemUom.push(uom_obj);
		    itemCode.push(itemCode_obj)
			
			orders[supId].item = items;
			orders[supId].qty = quantity;
			orders[supId].amount = amount;
			orders[supId].itemName = itemName;
			orders[supId].itemCode = itemCode;
			orders[supId].itemStatus = itemStatus;
		
			orders[supId].itemPrice = itemPrice;
			orders[supId].itemUom = itemUom;
		});
		
		
		var orderItems = orders[supId];
		var items_loop = orders[supId].item;
		var items = '';
		var total = 0;
		var supp_name = '<?php echo $supplier_name;?>';
	
		items+='<div class="item-row">'
			        +'<div class="item-left" style="width:12%">Item Code</div>\n'
					+'<div class="item-left" style="width:42%;text-align:left;">Item</div>\n'
		    		+'<div class="item-left" style="width:9%">Qty</div>\n'
		    		+'<div class="item-left" style="width:17%;text-align:right">Price</div>\n'
		    		+'<div class="item-left no-border" style="width:20%;text-align:right">Amount</div>\n'
		    		+'<div style="clear:both;"></div></div>';
		$.each( items_loop, function( key, value ) {
			
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
			items+='<div class="item-row ItelListingAll">'
		        	+'<div class="item-left2" style="width:12%;text-align:left;word-wrap: break-word;">'+orderItems.itemCode[key]+'</div>\n'
		    		+'<div class="item-left2" style="width:42%;text-align:left;word-wrap: break-word;">'+orderItems.itemName[key]+'</div>\n'
		    		+'<div class="item-left-small" style="width:9%">'+orderItems.qty[key]+'/'+orderItems.itemUom[key]+'</div>\n'
		    		+'<div class="item-left2" style="width:17%;text-align:right">$'+price2+'</div>\n'
		    		+'<div class="item-left2 color"style="width:20%;text-align:right">$'+amnt2+'</div>\n'
		    		// +'<div class="item-left-small no-border"><input type="checkbox" name="received_items[]" value="'+value+'"></div>\n'
		    		+'<div style="clear:both;"></div></div>';
		});
// 		console.log(items);
		$('#items').html(items);
		$('#order_total').html(Number(total).toFixed(2));
		
	}
	</script>
	<script type="text/javascript">
  
  	function updateOrderData(){
  	    $(".updatedOrder").html("Loading...");
		let order_id = '<?php echo $orders->order_id; ?>';
		
		let received_date = $('#received_date').val();
		let comments = $('#comments').val();
		let supplier_comments = $('#supplier_comments').val();
		let temp_record = $('#temp_record').val();
		let signature = $('#signature').val();
		let credits = $('#credits').val();
		let paid = $('#paid').val();
        let Any_return = '';
		let Packaged_according_to_food = $('#Packaged_according_to_food').val();
		let Any_breakage = $('#Any_breakage').val();
	
		
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/ocr/updateReceiveOrderFromScanOcrPage",
	        data:'supplier_comments='+supplier_comments+'&received_date='+received_date+'&comments='+comments+'&order_id='+order_id+'&temp_record='+temp_record+'&signature='+signature+'&credits='+credits+'&paid='+paid+'&Any_return='+Any_return+'&Packaged_according_to_food='+Packaged_according_to_food+'&Any_breakage='+Any_breakage,
	        success: function(data){
	       
	        	window.location = "<?php echo base_url();?>index.php/orders/orderHistory";
	        }
        });
			
	}   
     
     
       
        
     
	Dropzone.options.invoice = {
		maxFiles: 1,
	    paramName: "file", // The name that will be used to transfer the file
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
	
	
	
	
    </script>
   
    
    
    