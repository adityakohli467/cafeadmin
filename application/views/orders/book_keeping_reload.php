<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
	<div class="col-md-3">
	
	</div>
	<div class="col-md-6">
		<span class="text-center">
			<h3>Bookkeeping</h3>
		</span>
	</div>
	<div class="btn-div col-md-3">
		
	</div>
</div><!--.col-md-12 -->
	
  <!-- Modal -->

<div style="background-color:#fff" class="container-fluid main-container">
		
	<div class="col-md-12">
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
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
		<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/orders/submit_book_keeping" enctype="multipart/form-data">		
            <div class="col-md-2">
            <input type="text" class="form-control datepicker" placeholder="Start Date" name="start_date" id="start_date"  style="height:37px;border-radius:0px;width:100%;">
            </div>
            <div class="col-md-2">
            <input type="text" class="form-control datepicker"  placeholder="End Date" name="end_date" id="end_date" style="height:37px;border-radius:0px;width:100%;">
            </div>
            <div class="col-md-2">
            <select class="table-select app-select" name="supplier" id="supplier" >
            	<option value="">All Suppliers</option>
            	<?php foreach($suppliers as $supp){ ?>
            	<option value="<?php echo $supp->supplier_id; ?>"><?php echo $supp->supplier_name; ?></option>
            	<?php } ?>
            </select>
            </div>
            <div class="col-md-2">
            <button type="button" style="border-radius:0px;height:37px;width:100%;" id="submitFormData" onclick="SubmitFormData();" value="Submit" class="btn btn-success">Submit</button>
        	</div>
        	<div class="col-md-2">
            <button style="border-radius:0px;height:37px;width:100%;display:none;" type="button" id="reports_print" onclick="PrintElem('#results')"  class="btn btn-success">Print</button>
            </div>
            <div class="col-md-2">
            <a style="border-radius:0px;height:37px;width:100%;display:none;" type="button" id="reports_excel"  class="btn btn-success reports_excel_link">Export to Excel</a>
            </div>
        	<div style="clear:both;"></div>
         </form> <hr>
         <?php if($this->session->userdata('start_date') != ''){ ?>
         <table class="row-border table-condensed datatable" cellspacing="0" width="100%" id="results">
				<thead>
					<tr>
						        <th class="text-center">Order Date</th>
								<th class="text-center">Purchase order No.</th>
								<th class="text-left">Supplier</th>
								<th class="text-right">Order Total</th>
								<th class="text-center">Order Status</th>
								<th></th>
					</tr>
				</thead>
				<tbody >';
			    <?php foreach($orders as $row){
			    	if($row->book_keeping == 'Entered'){
								$color = "style='background-color:#319346;'";
							}else{
								$color = "style='background-color:#337ab7;'";
							} ?>
	
					      <tr class='tr'>
								<td class='text-center'>
									<a href="<?php echo base_url('');?>index.php/orders/receiveOrderDetails/<?php echo $row->order_id; ?>"     class='update_user_button'><?php echo date('d-m-Y',strtotime($row->order_date)); ?></a>
								</td>
								<td class='text-center'>
									<a href="<?php echo base_url('');?>index.php/orders/receiveOrderDetails/<?php echo $row->order_id; ?>" class='update_user_button'><?php echo $row->order_number; ?></a>
								</td>
								<td class='text-left'><?php echo $row->supplier_name; ?></td>
								<td class='text-right'>$<?php echo number_format($row->order_total,2,'.',''); ?></td>
								<td class='text-center'><div class='status-color' style='background-color:#319346;'><?php echo $row->order_status; ?></div></td>
								<td class='text-center'><a type='button' onclick='change_status(<?php echo $row->order_id; ?>);'><div <?php echo $color; ?> class='status-color'><?php echo $row->book_keeping; ?></div></a></td>
							    
							</tr>
			        <?php  } ?>
			    </tbody>
			    <tfoot><tfoot></tfoot>
			    </table>
         <?php }else{ ?>
         <div id="results"></div>
         <?php } ?>
		</div>
		</div>
			
		</div>
	</div><!--.container-->
		
		<!--.table-->
		<br>
	
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
		    dateFormat: 'dd-mm-yy'
		});
    }); 
    
	</script>
	<script>
function SubmitFormData() {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
    var error = 'False';
    var error2 = 'False';
    if(start_date != ''){
    	if(end_date != ''){
    		var error = 'False';
    	}else{
    		var error = 'True';
    	}
    }
    if(end_date != ''){
    	if(start_date != ''){
    		var error2 = 'False';
    	}else{
    		var error2 = 'True';
    	}
    }
    
			     
			     if(start_date == ''){
			     	var start_date_1 = 'false';
			     }else{
			     	var start_date_1 = start_date;
			     }
			     
			     if(end_date == ''){
			     	var end_date_1 = 'false';
			     }else{
			     	var end_date_1 = end_date;
			     }
			     
			     if(supplier == ''){
			     	var supplier_1 = 'false';
			     }else{
			     	var supplier_1 = supplier;
			     }
			     
			     
			     var url="<?php echo base_url();?>index.php/orders/bookkeeping_download"+"/"+start_date_1+"/"+end_date_1+"/"+supplier_1;                
			     $('.reports_excel_link').attr('href',url);
    
    if(error != 'True' && error2 != 'True'){
    
    	$.post("<?php echo base_url(); ?>index.php/orders/submit_book_keeping", { start_date: start_date, end_date: end_date, supplier: supplier},
		    function(data) {
		    	//alert(data);
				 $('#results').html(data);
				 $('.datatable').DataTable( {
			        'paging':false,
			        'bInfo':false
			     } );
			     $('#reports_print').show();
			     $('#reports_excel').show();
		    });
    }else{
    	if(error == 'True'){
    		//alert('ed');
	    	$("#end_date").css('border-color','red');
    	}
    	if(error2 == 'True'){
    		//alert('sd');
	    	$("#start_date").css('border-color','red');
    	}	
    }
}	
</script>

	<script>
function change_status(str) {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
    //alert(start_date);
    var error = 'False';
    var error2 = 'False';
    if(start_date != ''){
    	if(end_date != ''){
    		var error = 'False';
    	}else{
    		var error = 'True';
    	}
    }
    if(end_date != ''){
    	if(start_date != ''){
    		var error2 = 'False';
    	}else{
    		var error2 = 'True';
    	}
    }
			     if(start_date == ''){
			     	var start_date_1 = 'false';
			     }else{
			     	var start_date_1 = start_date;
			     }
			     
			     if(end_date == ''){
			     	var end_date_1 = 'false';
			     }else{
			     	var end_date_1 = end_date;
			     }
			     
			     if(supplier == ''){
			     	var supplier_1 = 'false';
			     }else{
			     	var supplier_1 = supplier;
			     }
			     
			     var url="<?php echo base_url();?>index.php/reports/purchase_download"+"/"+start_date_1+"/"+end_date_1+"/"+supplier_1;                
			     $('.reports_excel_link').attr('href',url);
    
    if(error != 'True' && error2 != 'True'){
    
    	$.post("<?php echo base_url(); ?>index.php/orders/change_status_book", { order_id: str, start_date: start_date, end_date: end_date, supplier: supplier},
		    function(data) {
		    	//alert(data);
				 $('#results').html(data);
				 $('.datatable').DataTable( {
			        'paging':false,
			        'bInfo':false
			     } );
			     $('#reports_print').show();
			     $('#reports_excel').show();
		    });
    }else{
    	if(error == 'True'){
    		//alert('ed');
	    	$("#end_date").css('border-color','red');
    	}
    	if(error2 == 'True'){
    		//alert('sd');
	    	$("#start_date").css('border-color','red');
    	}	
    }
}	
</script>
<script type="text/javascript">
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'new div', 'height=400,width=600');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>
	<script>
function book_button_back(str) {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
    //alert(start_date);
    var error = 'False';
    var error2 = 'False';
    if(start_date != ''){
    	if(end_date != ''){
    		var error = 'False';
    	}else{
    		var error = 'True';
    	}
    }
    if(end_date != ''){
    	if(start_date != ''){
    		var error2 = 'False';
    	}else{
    		var error2 = 'True';
    	}
    }
			     if(start_date == ''){
			     	var start_date_1 = 'false';
			     }else{
			     	var start_date_1 = start_date;
			     }
			     
			     if(end_date == ''){
			     	var end_date_1 = 'false';
			     }else{
			     	var end_date_1 = end_date;
			     }
			     
			     if(supplier == ''){
			     	var supplier_1 = 'false';
			     }else{
			     	var supplier_1 = supplier;
			     }
    
    if(error != 'True' && error2 != 'True'){
    
    	$.post("<?php echo base_url(); ?>index.php/orders/receiveOrderDetails_bookkeeping", { order_id: str, start_date: start_date, end_date: end_date, supplier: supplier},
		    function(data) {
		    	//alert(data);
				 $('#results').html(data);
				 $('.datatable').DataTable( {
			        'paging':false,
			        'bInfo':false
			     } );
			     $('#reports_print').show();
			     $('#reports_excel').show();
		    });
    }else{
    	if(error == 'True'){
    		//alert('ed');
	    	$("#end_date").css('border-color','red');
    	}
    	if(error2 == 'True'){
    		//alert('sd');
	    	$("#start_date").css('border-color','red');
    	}	
    }
}	
</script>