<style>
    .mb-1{
        margin-bottom: 0.5rem;
    }
    .form-inline .form-control {
        width: 100%;
    }
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    @media(max-width: 767px){
        .panel-body {
            padding: 25px 0;
        }
    }
</style>
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
		<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/orders/purchase_orders_submit" enctype="multipart/form-data">		
            <div class="row">
                <div class="col-md-2 mb-1">
                <input type="text" class="form-control datepicker" placeholder="Start Date" name="start_date" id="start_date" value="<?php echo $start_date; ?>" style="height:37px;border-radius:0px;width:100%;">
                </div>
                <div class="col-md-2 mb-1">
                <input type="text" class="form-control datepicker"  placeholder="End Date" name="end_date" id="end_date" value="<?php echo $end_date; ?>" style="height:37px;border-radius:0px;width:100%;">
                </div>
                <div class="col-md-3 mb-1">
                <select class="form-control table-select app-select" name="supplier" id="supplier" >
                	<option value="">All Suppliers</option>
                	<?php foreach($suppliers as $supp){ ?>
                	<option value="<?php echo $supp->supplier_id; ?>" <?php if($sup_id_book == $supp->supplier_id){echo "selected";} ?>><?php echo $supp->supplier_name; ?></option>
                	<?php } ?>
                </select>
                </div>
                <div class="col-md-2 mb-1">
                <button type="button" style="border-radius:0px;height:37px;width:100%;" id="submitFormData" onclick="SubmitFormData();" value="Submit" class="btn btn-success">Submit</button>
            	</div>
            </div>
            <div class="row">	
            	<div class="col-md-2 mb-1">
                <button style="border-radius:0px;height:37px;width:100%;display:none;" type="button" id="reports_print" onclick="PrintElem('#results')"  class="btn btn-success">Print</button>
                </div>
                <div class="col-md-2 mb-1">
                <a style="border-radius:0px;height:37px;width:100%;display:none;" type="button" id="reports_excel"  class="btn btn-success reports_excel_link">Export to Excel</a>
                </div>
            </div>
        	<div style="clear:both;"></div>
         </form> <hr>
         <div id="results" class="table-responsive"></div>
		</div>
		</div>
			
		</div>
	</div><!--.container-->
		
		<!--.table-->
		<br>
	<script>
$(document).ready(function() { 
	var start_date = $("#start_date").val();
	//alert(start_date);
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
	if(start_date != '' || end_date != '' || supplier != ''){
    	  
    	  $.post("<?php echo base_url(); ?>index.php/orders/submit_book_keeping", { start_date: start_date, end_date: end_date, supplier: supplier},
		    function(data) {
		    	//alert(data);
				 $('#results').html(data);
				 $('.datatable').DataTable( {
			        'paging':true,
			        'bInfo':false
			     } );
			     $('#reports_print').show();
			     $('#reports_excel').show();
		    });
    
}
});
</script>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
		    dateFormat: 'dd-mm-yy'
		});
    }); 
    
	</script>
	<script>
function SubmitFormData() {
    //var time_period = $("#time_period").val();
    var start_date = $("#start_date").val();
    
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
    //var category = $("#category").val();
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