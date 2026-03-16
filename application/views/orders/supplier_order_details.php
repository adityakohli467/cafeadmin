<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cafe Admin</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.jpg" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
	</script> 
  
</head>
<body>
	<div class="gradient"></div>

	<!--navigation-bar-->
		<nav class="navbar navbar-default nav-border">
		  <div class="container-fluid">
		    <div class="navbar-header border-right">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
    			</button>
		    
		    	<a class="navbar-brand" href="#"><img style="width: 145px;" src="<?php echo base_url() ?>images/image1.png"></img> </a>
		    	
		    </div>
		    
		  </div><!--.container-fluid-->
		</nav>
	
  
	<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Order Details</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
		
		</div>
	
	</div><!--.col-md-12 -->
	
	<div class="container-fluid main-container">
		<div class="col-sm-12 col-md-6">
		<div class="row">
		    <div class="top_title"> <span>Please click on the <span class="conform_ord">CONFIRM ORDER</span> button below for the order to be processed.</span></div>
			<div class="panel" >
					<?php 
				    	
			    	if($order->order_status == 'Sent'){
							$color = "style='background-color:#e96166;padding:0px;'";
						}else if($order->order_status == 'Viewed'){
							$color = "style='background-color:#4b799d;padding:0px;'";
						}else if($order->order_status == 'Confirmed'){
							$color = "style='background-color:#c3a428;padding:0px;'";
						}else{
							$color = "style='background-color:#319346;padding:0px;'";
						}
					?>
					<?php 
				    		$total = 0;
				    		if(!empty($order_items)){
				    			foreach($order_items as $items){
				    				$total = $total + $items->amount;
				    		?>
				    			<?php } } ?>
			    
			     <div class="panel-heading ph-dash" style="padding:5px;">
			    	<div class="col-md-4 text-wrap" style="line-height:48px;">
			    		<span style="font-size:20px;" id="supplier_name"><?php echo $branch_details->branch_name;?></span>
			    		
			    	</div>
			    	<div class="col-md-4 text-wrap" style="line-height:48px;">
			    		<div class="" style="text-align:center;font-size:20px;"><span>PO - <?php echo $order->order_number;?></span></div>
			    	</div>
			    	<div class="col-md-4 text-wrap" style="line-height:48px;">
			    		<div class="" style="text-align:right;font-size:20px;">Order : $<span id="order_total"><?php echo number_format($total,2,'.','');?></span></div>
			    		
			    	</div>
			    </div>
				    
			    <div class="panel-body">
			    	<div class="row" style="margin-top:-15px;margin-bottom:20px;">
				    	<div class="col-md-6 col-sm-6" style="display:inline-block;">
				    		<p class="margin-0"><?php echo $branch_details->unit;?> <?php echo $branch_details->street;?></p>
				    		<p class="margin-0"><?php echo $branch_details->suburb;?></p>
				    		<p class="margin-0"><?php echo $branch_details->state;?> - <?php echo $branch_details->postcode;?></p>
				    		<p class="margin-0"><?php echo $order->first_name.' '.$order->last_name;?></p>
				    		<!--<p class="margin-0"><?php //echo $order->phone;?></p>-->
				    			<p class="margin-0"><?php echo "1800 692 283";?></p>
				    	</div>
				    	<div class="col-md-6 col-sm-6" style="display:inline-block;">
				    		<b><?php echo $supplier->supplier_name;?></b>
				    		<p class="margin-0"><?php echo $supplier->unit_number;?> <?php echo $supplier->street;?></p>
				    		<p class="margin-0"><?php echo $supplier->suburb;?></p>
				    		<p class="margin-0"><?php echo $supplier->state;?> - <?php echo $supplier->postcode;?></p>
				    		<p class="margin-0"><?php echo $supplier->first_name;?></p>
				    		<p class="margin-0"><?php echo $supplier->customer_number;?>  <?php echo $supplier->mobile;?></p>
				    	</div>
			    	</div>
			    	<form action="<?php echo base_url();?>index.php/orders/confirmOrder" method="post" name="supplier_form">
			    		
			    		<div style="margin-top:30px;">
			    			<div class="items-scroll-wrapper">
			    			<div class="item-row">
			    			    <?php if($items->itemCode !='') { ?>
			    			    <div class="item-left" style="width:15%;text-align:left;">Item Code</div>	
			    			    <?php } ?>
				    			<div class="item-left" style="width:45%;text-align:left;">Item</div>
				    			<div class="item-left" style="width:10%">Qty</div>	
				    			<div class="item-left" style="width:10%;text-align:right">Price</div>
				    			<div class="item-left no-border" style="width:15%;text-align:right">Amount</div>
				    			<div style="clear:both;"></div>
				    		</div>
				    		<?php 
				    		$total = 0;
				    		if(!empty($order_items)){
				    			foreach($order_items as $items){
				    				$total = $total + $items->amount;
				    		?>
				    		
				    		<div class="item-row">
				    		 <div class="item-left-small" style="width:15%;text-align:left;"><?php echo $items->itemCode;?></div>
				    		<div class="item-left2" style="width:45%;text-align:left;"><?php echo $items->item_name;?></div>
				    		<div class="item-left-small" style="width:10%"><?php echo $items->quantity;?></div>
				    		<div class="item-left-small" style="width:10%;text-align:right">$<?php echo number_format($items->price,'2','.','');?></div>
				    		<div class="item-left2 color no-border"style="width:15%;text-align:right"><?php echo '$'.number_format($items->amount, 2, '.', '');?></div>
				    		<div style="clear:both;"></div></div>
				    		
	    		
				    		<?php } } ?>
				    	</div>
				    	</div>
				    	<br>
				    	
				    	<div class="row">
				    		<div class="form-group col-md-6">
					    		<label for="order_date" class="order-padding">Order date</label>
					    		<input class="form-control" type="text" value="<?php echo date('d-m-Y', strtotime($order->order_date));?>" readonly>
				    		</div>
				    		<div class="form-group col-md-6">	
					    		<label for="delivery_date" class="order-padding">Delivery date</label>
					    		<input class="form-control" type="text" value="<?php echo date('d-m-Y', strtotime($order->delivery_date));?>" readonly>
				    		</div>
				    	
					    	<div class="form-group col-md-6">
					    		<label for="comments" class="order-padding">Comments</label>
					    		<textarea rows="3" class="form-control" name="comments" id="comments" placeholder="Delivery Instructions" readonly><?php echo $order->comments;?></textarea>
					    		<br>
					    	</div>
					    	<div class="form-group col-md-6">
					    		<label for="supplier_comments" class="order-padding">Supplier Comments</label>
					    		<textarea rows="3" class="form-control" name="supplier_comments" id="supplier_comments" placeholder="Supplier Comments"><?php echo $order->supplier_comments;?></textarea>
					    		<br>
					    	</div>
				    	</div>
				    	<div>
				    		<input type="hidden" name="order_id" value="<?php echo $order->order_id;?>">
				    		<button type="submit" class="btn btn-success align button-width btncolor" >CONFIRM ORDER</button>
				    	</div>
				    	<br><br>
				    	<?php if(null !==$this->session->userdata('update_sucess_msg')) { ?>  
							<div class='hideMe'>
								<p class="alert alert-success"><?php echo $this->session->flashdata('update_sucess_msg'); ?></p>
							</div>
					      <?php } ?>
					      <?php if(null !==$this->session->userdata('update_error_msg')) { ?>  
							<div class='hideMe'>
								<p class="alert alert-danger"><?php echo $this->session->flashdata('update_error_msg'); ?></p>
							</div>
					      <?php } ?>
			    	</form>
				    	
			    </div>
			</div>
		</div>
		
	</div>
	</div>
	<br>
		<footer class="footer">
		<div id="footer" class="foot-border">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand" href="#"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img> </a>
		    </div>
		    <ul class="nav navbar-nav navbar-right foot-nav">
		      <!--<li><a href="#" data-toggle="modal" data-target="#Modal">For application support please click here</a></li>-->
		      
		      </ul>
		  </div>
		<div class="container-fluid foot-row">
			  	<div class="foot-left">
			  		<p class="text-muted credit">&copy; <?php echo Date('Y'); ?> AARIA</p>
			  	</div>
			  	<div class="foot-right">
			  		<p class="text-muted credit">Application developed and maintained by AARIA</p>
			  	</div>
		</div>
		<div class="gradient"></div>
		</div>
	</footer>
	
	<style>
 	label.error, label>span{
 		color:red;
 	}
 	
 	/* Mobile responsive styles for supplier order details */
 	@media (max-width: 768px) {
 		.top_title {
 			font-size: 14px;
 			height: auto;
 			padding: 10px 5px;
 			line-height: 1.4;
 		}
 		.panel-heading.ph-dash {
 			padding: 8px 5px !important;
 		}
 		.panel-heading.ph-dash > div[class*="col-md"] {
 			width: 100%;
 			float: none;
 			text-align: center !important;
 			line-height: 32px !important;
 		}
 		.panel-heading.ph-dash > div[class*="col-md"]:last-child {
 			border-top: 1px solid rgba(255,255,255,0.2);
 			padding-top: 5px;
 		}
 		/* Item rows - horizontal scroll wrapper */
 		.items-scroll-wrapper {
 			width: 100%;
 			overflow-x: auto;
 			-webkit-overflow-scrolling: touch;
 		}
 		.items-scroll-wrapper .item-row {
 			min-width: 480px;
 		}
 		/* Address blocks stack vertically */
 		.row > div[class*="col-md-6"][style*="display:inline-block"],
 		.row > div[class*="col-sm-6"][style*="display:inline-block"] {
 			width: 100% !important;
 			display: block !important;
 			margin-bottom: 15px;
 		}
 		/* Form fields full width */
 		.form-group[class*="col-md-6"] {
 			width: 100%;
 			padding-left: 15px;
 			padding-right: 15px;
 		}
 		/* Button full width */
 		.btn.button-width {
 			width: 100%;
 			margin-bottom: 10px;
 		}
 		/* Main container padding */
 		.main-container {
 			padding: 0 5px;
 		}
 		.main-container > .col-sm-12 {
 			padding: 0;
 		}
 		/* Page heading */
 		.page-head h3 {
 			font-size: 18px;
 		}
 		.page-head > div[class*="col-md"] {
 			width: 100%;
 			text-align: center;
 		}
 		/* Footer */
 		.foot-border .navbar-header,
 		.foot-border .foot-nav {
 			float: none;
 			text-align: center;
 		}
 		.foot-left, .foot-right {
 			float: none;
 			text-align: center;
 		}
 	}
 	
 	@media (max-width: 480px) {
 		.top_title {
 			font-size: 12px;
 		}
 		.panel-heading.ph-dash span,
 		.panel-heading.ph-dash div {
 			font-size: 16px !important;
 		}
 		#order_total {
 			font-size: 16px;
 		}
 	}
    </style>
</body>
</html>