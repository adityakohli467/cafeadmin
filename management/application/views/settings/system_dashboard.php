		<div class="container main-container">

<h3>SYSTEM DASHBOARD</h3>


					</div>

	
		</div><!--.container-->
		<!--.table-->
		<br>

		<!--.footer-->
<script>
    function getcategory(e){
		
	var  company_name= $(e).val();
	
	//alert(supplierId);
        $.ajax({
            url: '<?php echo base_url(''); ?>index.php/sales/get_categories',
            type: "POST",
            data:'supplierId='+company_name,
             success: function (data) {
				
         	 $("#categoryId").val(data);
            }
        });
};
</script>
	<script type="text/javascript">
	function delete_row(str){
if(confirm('DO u want to Delete Order')){
		    $.ajax({
		
		type: "POST",
        url: "<?php echo base_url();?>index.php/sales/order_row_del",
        data:'id='+str,

        success: function(data){
          location.reload();
        }
       });
	}	
	}
	</script>	

	<script type="text/javascript">
	function edit_row(str){

		    $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>index.php/sales/order_row_get",
        data:'id='+str,
        success: function(data){
  
			var obj = jQuery.parseJSON(data);
			
	        document.getElementById("myText9").value = obj.orderId;
			document.getElementById("myText1").value = obj.orderNo;
			document.getElementById("myText2").value = obj.customerId;
			document.getElementById("myText3").value = obj.route;
			document.getElementById("myText88").value = obj.orderDate;
			document.getElementById("myText4").value = obj.deliveryDate;
        }
       });
		
	}
	</script>
		
		<script type="text/javascript">
			
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();   
		});

		</script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<script>
$("#updateModal").modal({
    show: false
});

$(".update_user_button").click(function () {
    $("#updateModal").modal();

});
</script>

<script type="text/javascript">
	$(document).ready(function() { 
    $("#contact_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			name: {
                required: true,
            },
            picture: {
                required: true,
            }										
			
	},		
	messages: {
			name: {
                 required:"Please enter department name"
            },
			picture: {
                 required:"Please upload image"
            }	
	},

    });	
});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#contact_form_edit").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			name: {
                required: true,
            }			
			
	},		
	messages: {
			name: {
                 required:"Please enter  department name"
            }		
	},

    });	
});
</script>
