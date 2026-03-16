<body>
<section class="header">
            <div class="bg-theme page-head">
                <h3 class="text-center">OCR Order</h3>
            </div>
        </section>
        <section class="history-orders-filter">
            <form action="<?php echo base_url().'index.php/ocr/orderListing/'?>" method="POST" id="form_filter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <label>From</label>
                        <input type="date" name="from-date" class="form-control" value="<?php if(isset($fromDate)){ echo $fromDate; } ?>">
                        <span id="err_msg" style="color:#ff0"></span>
                    </div>
                    <div class="col-lg-3">
                        <label>To</label>
                        <input type="date" name="to-date" class="form-control" value="<?php if(isset($toDate)){ echo $toDate; } ?>">
                    </div>
                   
                    <div class="col-lg-2">
                        
                        <input type="submit" id="filter_submit" value="Filter" class="btn btn-success" style="margin-top:26px;">
                    </div>
                </div>
                <br>
                
            </div>
            </form>
        </section>
        <section class="history-orders-list">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
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
                        <div class="history-orders">
                            <table style="width:100%" class="table table-striped datatable" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th class="text-center">Order Id</th>
                                        <th class="text-center" style="width:100px !important">Order Date</th>
                                        <th class="text-center">Purchase order No.</th>
                                        <th class="text-left" style="width:115px !important">Supplier</th>
                                        <th class="text-center">Order Total </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
						if(!empty($orders)){
						foreach($orders as $row){	?>
							<tr class="tr">
								<td class="text-center" ><?php echo $row->order_id; ?>	</td>
								<td class="text-center" ><?php echo $row->invoiceDate; ?>	</td>
							   <td class="text-center"><?php echo $row->purchaseOrderNo; ?></td>
								<td class="text-left"><?php echo $row->supplierName; ?></td>
								<td class="text-center">$<?php echo number_format($row->invoiceTotal,2,'.',''); ?></td>
								<td class="text-center">
								    
							<a class="btn btn-primary" style="padding: 5px 16px;"  href="<?php echo base_url();?>index.php/ocr/viewOcrProcessedOrders/<?php echo $row->order_id;?>">
							    View
							</a>
                            </td>
				           </tr>
						<?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
 
 

     
    </div>
   
</body>

</html>