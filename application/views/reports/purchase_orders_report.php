<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
	<div class="col-md-3">
	
	</div>
	<div class="col-md-6">
		<span class="text-center">
			<h3>Purchase Orders Expenditure Report</h3>
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
		<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/reports/purchase_orders_submit" enctype="multipart/form-data">		
            <div class="col-md-2">
            <select class="table-select app-select" name="time_period" id="time_period" onchange="custom_dates();">
            	<option value="alltime">All Time</option>
            	<option value="lastweek">Last Week</option>
            	<option value="fortnight">Fortnight</option>
            	<option value="lastmonth">Last Month</option>
            	<option value="custom">Custom Dates</option>
            </select>
            </div>
            <div class="col-md-2 start_date_div" style="display:none;">
            <input type="text" class="form-control datepicker" placeholder="Start Date" name="start_date" id="start_date" style="height:37px;border-radius:0px;width:100%;">
            </div>
            <div class="col-md-2 start_date_div" style="display:none;">
            <input type="text" class="form-control datepicker"  placeholder="End Date" name="end_date"  id="end_date" style="height:37px;border-radius:0px;width:100%;">
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
            <select class="table-select app-select" name="category" id="category" >
            	<option value="">All Status</option>
            	<option value="Sent">Sent</option>
            	<option value="Viewed">Viewed</option>
            	<option value="Confirmed">Confirmed</option>
            	<option value="Received">Received</option>
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
         <div id="results"></div>
		</div>
		</div>
			
		</div>
	</div><!--.container-->
		
		<!--.table-->
		<br>
	
<script type="text/javascript">
	$(document).ready(function() { 
    $("#contact_form_edit").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			supplier_id: {
	                required:true
	            },
				item_name: {
	                required:true
	            },
	            category: {
	                required:true
	            },
	            price: {
	                required:true
	            }									
			
	},		
	messages: {
			supplier_id: {
                 required:"Please provide supplier"
            },
			item_name: {
                 required:"Please provide Product name"
            },
            category: {
                 required:"Please provide category"
            },
            price: {
                 required:"Please provide price"
            }	
	},

    });	
});
</script>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
		    dateFormat: 'dd-mm-yy'
		});
    }); 
    
    function custom_dates(){
    	var time_period = $("#time_period").val();
    	if(time_period == 'custom'){
    		$(".start_date_div").show();
    	}else{
    		$(".start_date_div").hide();
    	}
    }
	</script>
	<script>
function SubmitFormData() {
    var time_period = $("#time_period").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var supplier = $("#supplier").val();
    var category = $("#category").val();
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
    
                 if(time_period == ''){
			     	var time_period_1 = 'false';
			     }else{
			     	var time_period_1 = time_period;
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
			     
			     if(category == ''){
			     	var category_1 = 'false';
			     }else{
			     	var category_1 = category;
			     }
			     
			     var url="<?php echo base_url();?>index.php/reports/purchase_download"+"/"+time_period_1+"/"+start_date_1+"/"+end_date_1+"/"+supplier_1+"/"+category_1;                
			     $('.reports_excel_link').attr('href',url);
    
    if(error != 'True' && error2 != 'True'){
    
    	$.post("<?php echo base_url(); ?>index.php/reports/purchase_orders_submit", { time_period: time_period,start_date: start_date, end_date: end_date, supplier: supplier, category: category },
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