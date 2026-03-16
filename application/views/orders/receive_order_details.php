		
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
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Received Orders</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<?php if($this->session->userdata('start_date') != ''){ ?>
			<a href="<?php echo base_url(); ?>index.php/orders/book_keeping">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
			<?php }else{ ?>
			<a href="<?php echo base_url(); ?>index.php/orders/orderHistory">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
			<?php } ?>
		</div>
	
	</div><!--.col-md-12 -->      		
	
	<button onclick="printContent('div1')" class="btn-primary" style="margin-left: 614px;">Print</button>
	<div class="container-fluid main-container">
		
		<div class="col-md-12">
			<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="panel" id="div1">
				<div id="order_success"></div>
				
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
				    		<div class="" style="text-align:right;font-size:20px;">Order : $<span id="order_total"></span></div>
				    	</div>
				    </div>
				    
			   
			    <div class="panel-body">
			    	<div id="items">
			    		
			    	</div>
			    	
			    	
			    	<div class="row">
			    		<div class="form-group col-md-6">
				    		<label for="deliverydate"  class="order-padding">Received date</label>
				    		<input type="text" class="form-control" id="received_date" value="<?php echo date('d-m-Y',strtotime($orders->received_on));?>" readonly>
			    		</div>
			    		<div class="form-group col-md-6">
			    			<label for="temp_record"  class="order-padding">Temperature recording</label>
			    			<input type="text" class="form-control" id="temp_record" value="<?php echo $orders->temp_recording;?>" readonly>
			    		</div>
			    		
			    		<div class="form-group col-md-6">
				    		<label for="comments" class="order-padding">Comments</label>
				    		<textarea class="form-control" rows="3" name="comments" id="comments" readonly><?php echo $orders->comments;?> </textarea>
			    		</div>
			    		<div class="form-group col-md-6">
				    		<label for="supplier_comments" class="order-padding">Supplier Comments</label>
				    		<textarea rows="3" class="form-control" name="supplier_comments" id="supplier_comments" placeholder="Supplier comments" readonly><?php echo $orders->supplier_comments;?></textarea>
			    		</div>
			    		<div class="form-group col-md-6">
				    		<label for="signature" class="order-padding">Signature</label>
				    		<textarea rows="3" class="form-control" name="signature" id="signature" readonly><?php echo $orders->signature;?></textarea>
			    		</div>
			    		<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Credits</label>
					    		<textarea class="form-control" name="credits" id="credits" rows="3" readonly><?php echo $orders->credits; ?></textarea>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Paid</label>
					    		<input type="checkbox" name="paid" id="paid" <?php if($orders->paid == "1"){ echo "checked"; }?>>
				    		</div>
				    		<div class="form-group col-md-6">
					    		<label for="Any_breakage" class="order-padding">Any Damages</label>
					    			<textarea rows="3" class="form-control" name="Any_breakage" id="Any_breakage" ><?php echo $orders->Any_breakage;?></textarea>
				    		</div>
				    		<br>
				    			<div class="form-group col-md-6">
					    		<label for="Packaged_according_to_food" class="order-padding">Packaged according to food standards</label>
					    		<input type="checkbox"  name="Packaged_according_to_food" id="Packaged_according_to_food" value="1" <?php if($orders->Packaged_according_to_food == "1"){ echo "checked"; }?> >
				    		</div>
				    		<!--	<div class="form-group col-md-6">-->
					    	<!--	<label for="Any_return" class="order-padding">Any returns</label>-->
					    	<!--	<input type="checkbox"  name="Any_return" id="Any_return" value="1" <?php if($orders->Any_return == "1"){ echo "checked"; }?> >-->
				    		<!--</div>-->
			    		<br>
			    	</div>
			    	<br>
			    	
			    	<br>
			    	<div>
			    </div>
			</div>
		</div>
		<div class="panel pn">
				<div class="panel-heading ph-dash">
					<div class="col-md-6">
					<h3 class="" style="float:left;">Damaged Invoice Copy</h3>
					</div><?php if($orders->damaged_goods_file != ''){ ?>
					<div class="col-md-2" style="text-align:right;padding-right:0px;">
						<a style="margin-top:4px;width:100%" class="btn btn-success" href="<?php echo base_url();?>assets/docs/damaged_file/<?php echo $orders->damaged_goods_file;?>" target="_blank">View</a>
					</div><?php } ?>
                </div>
			    <div class="panel-body">
			      <div class="row">
						    		<div class="col-md-12">
						    		<?php if($orders->damaged_goods_file != ''){ ?>  
										<embed src="<?php echo base_url();?>assets/docs/damaged_file/<?php echo $orders->damaged_goods_file;?>" style="width:100%;min-height:600px;" alt="No files for this Invoice" class="upload-file">
									<?php }?>
						    		</div>
						    	</div>
			   </div>
		    </div>
	</div>
	
		<div class="col-md-6">
				<div class="panel pn">
				    <div class="panel-heading ph-dash_custom">
                  <ul class="nav nav-tabs">
				    <li class="invoice_copy"><a data-toggle="tab" href="#home">Invoice</a></li>
				    <li class="invoice_copy_1"><a data-toggle="tab" href="#menu1">Invoice 1</a></li>
				    <li class="invoice_copy_2"><a data-toggle="tab" href="#menu2">Invoice 2</a></li>
				    <li class="invoice_copy_3"><a data-toggle="tab" href="#menu3">Invoice 3</a></li>
				  </ul>
                </div> 
				<div class="tab-content">
				      <div id="home" class="tab-pane fade in invoice_copy">
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
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-fieldname="invoice_copy" data-foldername="invoices"  onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
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
				   
				       <div id="menu1" class="tab-pane fade invoice_copy_1">
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
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success" data-fieldname="invoice_copy_1" data-foldername="invoices_1"  onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
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
					    <div id="menu2" class="tab-pane fade invoice_copy_2">
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
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success"  data-fieldname="invoice_copy_2" data-foldername="invoices_2" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
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
					    <div id="menu3" class="tab-pane fade invoice_copy_3">
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
									<a type="button" style="margin-top:4px;width:100%" class="btn btn-success " data-fieldname="invoice_copy_3" data-foldername="invoices_3" onClick="delete_row(this,'<?php echo  $orders->order_id ?>');">Delete</a>
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
	
        	
</div><!--.container-->
		
	<br>
<!--.footer-->

<script type="text/javascript">
	var orders = {};
	var suppliers = {};
	<?php if(null !== $this->session->userdata('order_items')){ ?>
	orders = JSON.parse(<?php echo json_encode($this->session->userdata('order_items')); ?>);
	suppliers = JSON.parse(<?php echo json_encode($this->session->userdata('suppliers')); ?>);
	<?php } ?>
	
	loadCartDetails();
	// console.log(orders);
	function loadCartDetails(){
		var supId = '<?php echo $orders->supplier_id;?>';
		var order_items = JSON.parse(<?php echo json_encode($order_items); ?>);
		console.log("Order detailsss",order_items)
		orders[supId] = {};
		var items = [];
		var quantity = [];
			var statuses = [];
		var amount = [];
		var itemName = [];
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
		     var status_obj = value.status;
		    var itemName_obj = value.item_name;
		    var price_obj = value.price;
		    var uom_obj = value.uom;
		    var budget = '<?php echo $supplier_budget; ?>';//value.balance[0];
			
				statuses.push(status_obj);
			
			items.push(item_obj);
			quantity.push(qty_obj);
			amount.push(amount_obj);
			itemName.push(itemName_obj);
			itemPrice.push(price_obj);
			itemUom.push(uom_obj);
			balance.push(budget);
			
			
			
			orders[supId].status = statuses;
			
			orders[supId].item = items;
			orders[supId].qty = quantity;
			orders[supId].amount = amount;
			
			orders[supId].itemName = itemName;
			orders[supId].balance = balance;
			orders[supId].itemPrice = itemPrice;
			orders[supId].itemUom = itemUom;
		});
		
		
		var orderItems = orders[supId];
		var items_loop = orders[supId].item;
		var items = '';
		var total = 0;
		var supp_name = '<?php echo $supplier_name;?>';
		
		items+='<div class="item-row">'
					+'<div class="item-left" style="width:34%;text-align:left;">Item</div>\n'
		    		+'<div class="item-left" style="width:10%">Qty</div>\n'
		    		+'<div class="item-left" style="width:22%;text-align:right">Price</div>\n'
		    		+'<div class="item-left " style="width:12%;text-align:right">Amount</div>\n'
		    		+'<div class="item-left no-border" style="width:15%;text-align:right">Status</div>\n'
		    		+'<div style="clear:both;"></div></div>';
		$.each( items_loop, function( key, value ) {
// 			console.log(value);
			total = Number(total) + Number(orderItems.amount[key]);
			var amnt1 = orderItems.amount[key];
			var amnt2 = Number(amnt1).toFixed(2);
			var price = orderItems.itemPrice[key];
			var status = orderItems.status[key];
			var price2 = Number(price).toFixed(2);
			items+='<div class="item-row">\n'
		    		+'<div class="item-left2" style="width:34%;text-align:left;">'+orderItems.itemName[key]+'</div>\n'
		    		+'<div class="item-left-small" style="width:10%">'+orderItems.qty[key]+'/'+orderItems.itemUom[key]+'</div>\n'
		    		+'<div class="item-left2" style="width:22%;text-align:right">$'+price2+'</div>\n'
		    		+'<div class="item-left2 color"style="width:12%;text-align:right">$'+amnt2+'</div>\n'
		    		+'<div class="item-left-small no-border" style="width:15%;text-align:right">'+status+'</div>\n'
		    		+'<div style="clear:both;"></div></div>';
		});
// 		console.log(items);
		$('#items').html(items);
		$('#order_total').html(Number(total).toFixed(2));
		
	}
	
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
	   dictDefaultMessage:"Drop invoice here",
	   acceptedFiles :"image/jpg,image/jpeg,image/png,application/pdf"
	};
	
	//delete invoice copy
	
	$('.deleteFile').click(function(){
		if(confirm('Are you sure you want to delete file')){
			var order_id = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/orders/deleteInvoice",
				data:"order_id="+order_id,
				success: function(data){
					// alert(data);
					location.reload();
				}
			});
		}
	});   
	
	$(document).ready(function(){
	    var activeTab = localStorage.getItem('activeTab');
	    		$(".nav-tabs").find(".active").removeClass('active');
	    			$(".tab-content").find(".active").removeClass('active');
	    			
		$(".nav-tabs").find("."+activeTab).addClass('active');
		$(".tab-content").find("."+activeTab).addClass('active in');
		
		
	});  
	
function delete_row(obj,order_id){
		if(confirm('Are you sure you want to delete file')){
		var fieldname = $(obj).attr('data-fieldname');
		var foldername = $(obj).attr('data-foldername');
		localStorage.setItem('activeTab', fieldname);
		
              $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/orders/deleteInvoice",
				data:"order_id="+order_id+'&field_name='+fieldname+'&foldername='+foldername,
				success: function(data){
					// alert(data);
					location.reload();
				}
			});
		}
}
	
	function printContent(el){    var restorepage = document.body.innerHTML;    var printcontent = document.getElementById(el).innerHTML;    document.body.innerHTML = printcontent;    window.print();    document.body.innerHTML = restorepage;   }
</script>

    <style>
    	.dropzone{
    		min-height:70px;
    		padding:0px 0px;
    	}
    </style>