<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">
<style>
    .table input.text {
    background-color: #fff;
    border: 1px solid #ccc !important;
}
table.table tr th, table.table tr td {
    padding: 12px 10px;
}
</style>	      
				<div style="margin-bottom:0px;float:none" class="col-md-12 page-head border-bottom">
                		<span class="text-center">
                				<h3><?php echo $page_heading; ?></h3>
                			</span>
                		
                			
                		
                	</div>
           
            <br>
	<div class="container-fluid">
        <div class="table-wrapper">
           
			<div class="ct-scroll">
            <table class="table table-striped table-hover roaster-tb">
                <thead>
                    <tr>
						
						<th>Date</th>
						<th>Supplier Name</th>
                        <th>Invoice OR POD No:</th>
                        <th>Temperature of product.</th>
                        <th>Comments</th>  
                        <th>Signature</th>
                        <th>Order Status</th>
                        <th>Received By Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
				$i = 0;
				if(!empty($result)){
				foreach($result as $row){ ?>
			
                    <tr>
						<td width="130px" ><?php if(isset($row->order_date)){ echo date('d-m-Y',strtotime($row->order_date)); } ?></td>
						<td><?php if(isset($row->supplier_name)){ echo $row->supplier_name; } ?></td>
						<td><?php if(isset($row->order_number)){ echo $row->order_number; } ?></td>
						<td><?php if(isset($row->temp_recording)){ echo $row->temp_recording; } ?></td>
						<td><?php if(isset($row->comments)){ echo $row->comments; } ?></td>
						<td><?php if(isset($row->signature)){ echo $row->signature; } ?></td>
						<td><?php if(isset($row->order_status)){ echo $row->order_status; } ?></td>
						<td><input class="text" type="text" id="received_name<?php echo $row->order_id; ?>" name="received_name" value="<?php if(isset($row->received_name)){ echo $row->received_name; } ?>" ></td>
						<td><input class="text" type="date" id="received_date<?php echo $row->order_id; ?>" name="received_date" value="<?php if(isset($row->received_date)){ echo $row->received_date; } ?>" style="width: 145px;"></td>
						<td><input class="text" type="time" id="received_time<?php echo $row->order_id; ?>" name="received_time" value="<?php if(isset($row->received_time)){ echo $row->received_time; } ?>" style="width: 110px;"></td>
					
                        <td><input type="button" onclick="update_order('<?php echo $row->order_id; ?>')" class="btn btn-success btn-ph" value="Update" name="haccap_approve" id="<?php echo $row->order_id; ?>" ></td>
                       
                    </tr>
                    <?php }  }
                    else{ ?>
                    <tr><td colspan="8" align="center">No Record Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
			</div>	
			<div class="clearfix">
                <div class="hint-text"><?php  echo $result_count; ?></div>
                 <?php echo $this->pagination->create_links(); ?>
            </div>
            
            
        </div>
    </div>
<br>



<script type="text/javascript">



$( function() {
    $( "#datepicker" ).datepicker({
    dateFormat: 'dd-mm-yy'
});

 $( "#datepicker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
});


  } );

</script>
<script type="text/javascript">
    function update_order(order_id){
        
        var received_name = $('#received_name'+order_id).val();
        var received_date = $('#received_date'+order_id).val();
        var received_time = $('#received_time'+order_id).val();
// 		var haccap_approve='';
//           if($('#' + order_id).is(":checked")){
//             haccap_approve=1;
//           }
//           else{
//             haccap_approve=0;
//           }
        //   console.log(order_id);
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/<?php echo $controller_name; ?>",
		    data: {"order_id":order_id,"received_name":received_name,"received_date":received_date,"received_time":received_time},
		    success: function(data){
                 
                 location.reload();
		    }
		});
        
    }

</script>
