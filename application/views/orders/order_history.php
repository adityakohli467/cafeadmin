<body>

        <section class="header">
            <div class="bg-theme page-head">
                <h3 class="text-center">Order History</h3>
            </div>
        </section>
        <section class="history-orders-filter">
            <form action="<?php echo base_url().'index.php/orders/orderHistory/'?>" method="POST" id="form_filter">
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
                    <div class="col-lg-3">
                        <label>Order Status</label>
                        <!--<select name="order_status" class="form-control" id='testSelect1'>-->
                        <!--    <option value="">Select Order Status</option>-->
                        <!--    <?php if(isset($order_status) && $order_status == 'Sent'){ ?>-->
                        <!--        <option value="Sent" selected>Sent</option>-->
                        <!--    <?php }else{ ?>-->
                        <!--    <option value="Sent">Sent</option>-->
                        <!--    <?php } ?>-->
                            
                        <!--     <?php if(isset($order_status) && $order_status == 'Viewed'){ ?>-->
                        <!--        <option value="Viewed" selected>Viewed</option>-->
                        <!--    <?php }else{ ?>-->
                        <!--    <option value="Viewed">Viewed</option>-->
                        <!--    <?php } ?>-->
                            
                        <!--     <?php if(isset($order_status) && $order_status == 'Received'){ ?>-->
                        <!--        <option value="Received" selected>Received</option>-->
                        <!--    <?php }else{ ?>-->
                        <!--    <option value="Received">Received</option>-->
                        <!--    <?php } ?>-->
                            
                        <!--     <?php if(isset($order_status) && $order_status == 'Confirmed'){ ?>-->
                        <!--        <option value="Confirmed" selected>Confirmed</option>-->
                        <!--    <?php }else{ ?>-->
                        <!--    <option value="Confirmed">Confirmed</option>-->
                        <!--    <?php } ?>-->
                        <!--</select>-->
                         <div class="multiselect">
                        <div class="selectBox" onclick="showCheckboxes()">
                          <select class="form-control">
                            <option>Select an option</option>
                          </select>
                          <div class="overSelect"></div>
                        </div>
                        <div id="checkboxes">
                          <label for="Sent" class="listSelect">
                            <input type="checkbox" class="listSelect" value="Sent" id="Sent" name="filterstatus[]" <?php if (in_array("Sent", $filterstatus)){ echo "checked"; }?> /> Sent</label>
                          <label for="Viewed" class="listSelect">
                            <input type="checkbox" class="listSelect" value="Viewed" id="Viewed" name="filterstatus[]" <?php if (in_array("Viewed", $filterstatus)){ echo "checked"; }?> /> Viewed</label>
                          <label for="Received" class="listSelect">
                            <input type="checkbox" class="listSelect" value="Received" id="Received" name="filterstatus[]" <?php if (in_array("Received", $filterstatus)){ echo "checked"; }?> /> Received</label>
                          <label for="Confirmed" class="listSelect">
                            <input type="checkbox" class="listSelect" value="Confirmed" id="Confirmed" name="filterstatus[]" <?php if (in_array("Confirmed", $filterstatus)){ echo "checked"; }?> /> Confirmed</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2">
                        
                        <input type="submit" id="filter_submit" value="Filter" class="btn btn-success" style="margin-top:26px;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <label>Weekly Budget</label>
                        <input type="text" name="site_budget" readonly class="form-control" value="$<?php if(isset($budget)){ echo $budget; } ?>">
                    </div>
                    <div class="col-lg-3">
                        <label>Budget Remaining for this Week</label>
                        <input type="text" name="site_budget" readonly class="form-control" value="$<?php if(isset($branchBudgetBalance)){ echo number_format($branchBudgetBalance,2); } ?>">
                    </div>
                    <?php if(isset($branchBudgetBalance) && $branchBudgetBalance < 0){ ?>
                    <div class="col-lg-3">
                        <label>Status</label>
                        <input type="text" disabled="" name="site_budget" readonly="" class="form-control" value="Branch Budget Exceeded" style="background-color: red;color: white;">
                    </div>
                    <?php } ?>
                     <div class="col-lg-3">
                        <label>Spent so far </label>
                        <input type="text" disabled="" name="site_budget" readonly="" class="form-control" value="<?php echo "$".$spentsofarthisweek; ?>">
                    </div>
                </div>
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
                                        <th class="text-center" style="width:100px !important">Order Date</th>
                                        <th class="text-center" style="width:100px !important">Delivery Date</th>
                                        <th class="text-center">Purchase order No.</th>
                                        <th class="text-left" style="width:115px !important">Supplier</th>
                                        <th class="text-center">Order Total </th>
                                        <th class="text-center">Order Status</th>
                                        <th class="empty"></th>
                                        <th class="text-center" style="width:72px !important">OCR Scan</th>
                                        <th class="text-center" style="width:72px !important">OCR</th>
                                        <th class="text-center">Over Budget Status</th>
                                        <!--<th class="text-center">Mail Status</th>-->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
						if(!empty($orders)){
						foreach($orders as $row){
							if($row->order_status == 'Sent'){
								$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";
							}else if($row->order_status == 'Viewed'){
							$color = "style='background-color: #3a568d;color:#fff; ' class='btn cxs-btn c-btn btn-xs btn-block'";
							}
							else if($row->order_status == 'OCR processed'){
							$color = "style='background-color: #2f2f2f;color:#fff; ' class='btn cxs-btn c-btn btn-xs btn-block'";
							}
							else if($row->order_status == 'Confirmed'){
								$color = "class='btn btn-warning cxs-btn c-btn btn-xs btn-block'";
							
							}else if($row->order_status == 'Received'){
								$color = "style='background-color: #319346;color:#fff; ' class='btn cxs-btn c-btn btn-xs btn-block'";
							}else{
								$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";
							}
								?>
							<tr class="tr">
								<td class="text-center" >
									<?php if($row->order_status == "Received"){ ?>
									<a   href="<?php echo base_url();?>index.php/orders/receiveOrderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo date('d-m-Y',strtotime($row->order_date)); ?></a>
									<?php }else if($row->order_status == "Confirmed" || $row->order_status == "Viewed"){ ?>
									<a href="<?php echo base_url();?>index.php/orders/receiveOrder/<?php echo $row->order_id;?>" class="update_user_button"><?php echo date('d-m-Y',strtotime($row->order_date)); ?></a>
									<?php }else{ ?>
									<a href="<?php echo base_url();?>index.php/orders/orderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo date('d-m-Y',strtotime($row->order_date)); ?></a>
									<?php } ?>
								</td>
								
								<td class="text-center" >
				          <a  href="#"><?php echo date('d-m-Y',strtotime($row->delivery_date)); ?></a>
							</td>
						
								
								
								<td class="text-center">
									<?php if($row->order_status == "Received"){ ?>
									<a href="<?php echo base_url();?>index.php/orders/receiveOrderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo $row->order_number; ?></a>
									<?php }else if($row->order_status == "Confirmed"){ ?>
									<a href="<?php echo base_url();?>index.php/orders/receiveOrder/<?php echo $row->order_id;?>" class="update_user_button"><?php echo $row->order_number; ?></a>
									<?php }else{ ?>
									<a href="<?php echo base_url();?>index.php/orders/orderDetails/<?php echo $row->order_id;?>" class="update_user_button"><?php echo $row->order_number; ?></a>
									<?php } ?>
								</td>
								<td class="text-left"><?php echo $row->supplier_name; ?></td>
								<td class="text-center">$<?php echo number_format($row->order_total,2,'.',''); ?></td>
								<td class="text-center"><div <?php echo $color;?> class="status-color"><?php echo $row->order_status; ?></div></td>
								<td>
									<?php if($row->order_status == "Confirmed" || $row->order_status == "Viewed"){ ?>
									<a style="color:#6a6a6a;" href="<?php echo base_url();?>index.php/orders/receiveOrder/<?php echo $row->order_id;?>">Receive</a>
									<?php } ?>
								</td>
								<?php   if($row->order_status == 'OCR processed'){ ?>
									<td class="text-center" >
						 <a   href="<?php echo base_url();?>index.php/ocr/viewOcrProcessedOrders/<?php echo $row->order_id;?>" >View Scan </a>	
						</td>
						<?php } else { ?>
						<td class="text-center" ></td>
						<?php } ?>
						
						 <td>
						<a style="color:#6a6a6a;" href="<?php echo base_url();?>index.php/ocr/fileUploadPage/<?php echo $row->order_id;?>">Scan Invoice</a>	    
						</td>
						<td class="text-center"><?php if($row->approval_status == 1){ echo "Approved"; } else if($row->approval_status == 2){ echo "Awaiting"; }else if($row->approval_status == 3){ echo "Rejected"; } else{} ?></td>
							 <?php	// if($row->mail_status == 1 ){ ?>
							<!--  <td>-->
							<!--    SENT-->
							<!--</td>-->
							<?php // }else {  ?>
							<!--<td>-->
							<!--   FAILED-->
							<!--</td>-->
						   <?php // } ?>
						  
									    
									    
									    <?php	if($row->order_status == 'Sent' || $row->order_status == 'PENDING'){ ?>
									<td>
								<a style="color:#6a6a6a;" onclick="myFunction(<?php  echo $row->order_id;?>); return false">Cancel</a>	    
									    </td>
									    <?php }else {  ?>
									    
									    <td>
								  
									    </td>
								       
								
									    <?php } ?>
									   
									    
								
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
 
 
 <div class="modal fade" id="delete_order" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="cancel_order" method="post" action="<?php echo base_url().'index.php/orders/cancelorder'; ?>">
       
        <div class="modal-body">
            <span><h3> Are you sure to delete this item?</h3></span>
          
        </div>
        
        <div class="modal-footer">
            <input type="hidden" name="order_id" id="oid" value="">
		<button type="submit" class="btn btn-success btncolor">Delete</button>
		<span  class="btn btn-success btncolor hide_modal">Cancel</span>
          
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
    </div>
    
     <div class="modal fade" id="show_force_comments" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Force Order Comments</h4>
      </div>
       
        <div class="modal-body">
          <textarea id="show_force_order_comment"></textarea>
          
          
        </div>
        
        <div class="modal-footer">
            <input type="hidden" name="order_id" id="oid" value="">
	
		<span  class="btn btn-success btncolor hide_modal">Cancel</span>
          
          
        </div>
   
      </div>
      
    </div>
  </div>
    </div>
    <!--<script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.bootstrap.min.js"></script>-->
    <!--<script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.responsive.js"></script>-->
    <script>
    //     $(document).ready(function () {
    //         $('#dataTables-example').DataTable({
			 //   "ordering": false,
    //             'paging': false,
				// 'bInfo':false,
    //             responsive: true
    //         });
    //     });

function showForceComments(comments){
    $("#show_force_order_comment").html(comments);
    $("#show_force_comments").modal();
}        
        

function myFunction(oid){
 $("#delete_order").modal();
 
 $("#oid").val(oid);
 
}

$(".hide_modal").on('click',function(){
    location.reload();
    
})
    </script>
<script>
	var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}


// $(window).click(function(e) {
//     if( e.target.className != 'overSelect' ){
//          var checkboxes = document.getElementById("checkboxes");
//         checkboxes.style.display = "none";
//         expanded = false;
//     }
    
      
// });
</script>
</body>

</html>