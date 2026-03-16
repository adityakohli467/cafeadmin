     <link href="<?php echo base_url(); ?>res/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>res/bootstrap-datatable/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>res/bootstrap-datatable/css/dataTables.responsive.css" rel="stylesheet">

<body>

    <main role="main" class="wrapper">
        <section class="header">
            <h3 class="text-center">Supplier Expenditure</h3>
            <div class="bg-theme page-head">
                <h4 class="text-center">Please choose the location to check the supplier expenditure</h4>
            </div>
        </section>
        <section class="history-orders-filter mgmt-orders-filter">
            <form action="<?php echo base_url().'index.php/general/orders/'?>" method="POST" id="form_filter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mrgn-bt">
                        <label>Location</label>
                        <select class="form-control" name="branch_id" id="branchID" required>
                             <option value="">Select Location</option>
                            <?php if(!empty($branches_list)){ 
                                $branchName =''; 
                            foreach($branches_list as $branch){
                            if($branch->branch_id == $branch_id){
                            ?>
                                <option value="<?php echo $branch->branch_id; ?>" selected><?php echo $branch->branch_name; ?></option>
                                
                                <?php $branchName=$branch->branch_name;
                                }else{ ?>
                                <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                    
                    
                     <div class="col-lg-3 mrgn-bt">
                        <label>Supplier</label>
                        <select class="form-control" name="supplier_id" id="supplierID">
                             <?php if(!empty($suppliers)){ 
                                $supplierName =''; ?>
                                <option value="">Select Supplier</option>
                           <?php foreach($suppliers as $supplier){
                            if($supplier->supplier_id == $supplier_id){
                            ?>
                                <option value="<?php echo $supplier->supplier_id; ?>" selected><?php echo $supplier->supplier_name; ?></option>
                                
                                <?php $supplierName=$supplier->supplier_name;
                                }else{ ?>
                                <option value="<?php echo $supplier->supplier_id; ?>"><?php echo $supplier->supplier_name; ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                    
                    
                    <div class="col-lg-3 mrgn-bt">
                        <label>From</label>
                        <input type="date" name="from-date" class="form-control" value="<?php if(isset($fromDate)){ echo $fromDate; } ?>">
                        <span id="err_msg" style="color:#ff0"></span>
                    </div>
                    
                    
                    <div class="col-lg-3 mrgn-bt">
                        <label>To</label>
                        <input type="date" name="to-date" class="form-control" value="<?php if(isset($toDate)){ echo $toDate; } ?>">
                    </div>
                    
                    
                    
                   
                    
                    
                    <div class="col-lg-3 mrgn-bt">
                        <label>Status</label>
                        <select name="order_status" class="form-control">
                            <option value="">Select Status</option>
                            <?php if(isset($order_status) && $order_status == 'Sent'){ ?>
                                <option value="Sent" selected>Sent</option>
                            <?php }else{ ?>
                            <option value="Sent">Sent</option>
                            <?php } ?>
                            
                             <?php if(isset($order_status) && $order_status == 'Viewed'){ ?>
                                <option value="Viewed" selected>Viewed</option>
                            <?php }else{ ?>
                            <option value="Viewed">Viewed</option>
                            <?php } ?>
                            
                             <?php if(isset($order_status) && $order_status == 'Received'){ ?>
                                <option value="Received" selected>Received</option>
                            <?php }else{ ?>
                            <option value="Received">Received</option>
                            <?php } ?>
                            
                             <?php if(isset($order_status) && $order_status == 'Confirmed'){ ?>
                                <option value="Confirmed" selected>Confirmed</option>
                            <?php }else{ ?>
                            <option value="Confirmed">Confirmed</option>
                            <?php } ?>
                        </select>
                    </div>
                     
                    
                    <div class="col-lg-2 mrgn-bt">
                        
                        <input type="submit" id="filter_submit" value="Filter" class="btn btn-success" style="margin-top:30px;">
                    </div>
                    
                    
                    
                    
                </div>
            </div>
            </form>
        </section>
        <?php if(isset($branch_id)){?>
        <section class="history-orders-list mgmt-orders-list">
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
                            <table style="width:100%" class="table table-striped" id="dataTables-example">
                                <thead>
                                    <tr>
                                      <th class="text-left">Supplier</th>
                                        <th class="text-left">Date From and To</th>
                                      
                                        <th class="text-left">Total Expenditure</th>
                                          <th class="text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
							<tr class="tr">
								
							  	<td class="text-left"><?php if(isset($supplierName) && $supplierName !=''){ echo $supplierName; } else{ echo 'All'; } ?></td>
								<td class="text-left"><?php if(isset($fromDate) && isset($toDate)){  
								
								$fromDate = strtotime($fromDate);
								$todatee = strtotime($toDate);
								$todatee = date('d-m-y',$todatee);
							       $fromDate=	date('d-m-y',$fromDate);
								echo $fromDate.' TO '. $todatee; 
								    
								}else{ echo "All"; } 
								
								?></td>
									<td class="text-left">$<?php echo number_format($total,2,'.',''); ?></td>
								<td class="text-left"><?php if(isset($order_status)){ echo $order_status; } else{ echo 'All'; } ?></td>
							
							
							
							</tr>
                                </tbody>
                            </table>
                        </div>
                        <!--<div class="history-orders large-hide">-->
                        <!--    <table style="width:100%" class="table table-striped" id="dataTables-example">-->
                        <!--        <thead>-->
                                    
                        <!--               <tr> <th class="text-left">Location</th><td class="text-left"><?php echo $branchName; ?></td></tr>-->
                        <!--                <tr><th class="text-left">Date From and To</th><td class="text-left"><?php if(isset($fromDate) && isset($toDate)){ echo $fromDate.' TO '.$toDate; }else{ echo "All"; } ?></td></tr>-->
                        <!--                <tr><th class="text-left">Status</th> 	<td class="text-left"><?php if(isset($order_status)){ echo $order_status; } else{ echo 'All'; } ?></td></tr>-->
                        <!--                <tr><th class="text-left">Supplier</th>	<td class="text-left"><?php if(isset($supplierName) && $supplierName !=''){ echo $supplierName; } else{ echo 'All'; } ?></td></tr>-->
                        <!--                <tr><th class="text-left">Total</th>	<td class="text-left">$<?php echo number_format($total,2,'.',''); ?></td></tr>-->
                                    
                        <!--        </thead>-->
                        <!--        <tbody>-->
                            
                        <!--        </tbody>-->
                        <!--    </table>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </main>
 
 
 <div class="modal fade" id="delete_order" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     <form role="form" class="form-horizontal" id="cancel_order" method="post" action="<?php echo base_url().'index.php/orders/cancelorder'; ?>">
       
        <div class="modal-body">
            <span><h3> Are you sure to delete this item?</h3></span.
          
          
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
    <script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>res/bootstrap-datatable/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
			    "ordering": false,
                'paging': false,
				'bInfo':false,
                responsive: true
            });
            
            $('#branchID').change(function() 
		{  
		var id = $(this).val();
			url = "<?php echo base_url().'index.php/general/fetchSuppliers/'?>"; 
				$.ajax({
				type:"POST",
				url: url, 
				dataType:"json",
				data: {"id":id}, 
				success: function(data) { 
						// var batches = JSON.parse(data);

					console.log(data);
					if(data){
						var supplierOption = '<option value="">Select Supplier</option>';
						$.each(data,function(index,value){
								// console.log(value.id);
								supplierOption += '<option value="'+value.supplier_id+'">'+value.supplier_name+'</option>';
						});
						
					}
					else{
						var supplierOption = '<option>No Supplier</option>';
					}
					$('#supplierID').html(supplierOption);
					// console.log(batchesOption);
					} 
				});
		});
        });
        
        

function myFunction(oid){
 $("#delete_order").modal();
 
 $("#oid").val(oid);
 
}

$(".hide_modal").on('click',function(){
    location.reload();
    
})
    </script>
 
    
</body>

</html>