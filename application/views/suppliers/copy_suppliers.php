<style>
#submit{
    width: 83px;
    background-color: #5aef6c;
    height: 42px;
    font-weight: 800;
}
</style>	
	

<div style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
		
		</div>
		</div>
	<span style="font-weight: 800;"> Copy From</span>
		<select class="table-select app-select" style="width:20%;" id="copy_from">
				<option value="all">Copy Suppliers From</option>
				<?php 
				if(!empty($branches_list)){
					foreach($branches_list as $branch){ ?>
					<option value="<?php echo $branch->branch_id;?>"><?php echo $branch->branch_name;?></option>
				<?php }} ?>
			</select>
			
				<span id="suppliers_list_span" style="font-weight: 800;"> Select Suppliers </span>
		<select class="table-select app-select" style="width:20%;" id="suppliers_list" >
				
			
			</select>
			
		 <span style="font-weight: 800;"> Copy To</span>
			<select class="table-select app-select" style="width:20%;" id="copy_to">
				<option value="all">Copy Suppliers To</option>
				<?php 
				if(!empty($branches_list)){
					foreach($branches_list as $branch){ ?>
					<option value="<?php echo $branch->branch_id;?>"><?php echo $branch->branch_name;?></option>
				<?php }} ?>
			</select>
		
			
			<button id="submit" onclick="copyBranchSuppliers()"> Copy </button>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
	



<script>
     $('#copy_from').change(function() {
  
      if($(this).val() !=''){
    	$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/fetch_suppliers",
		       data: {suupid: $(this).val()},
		        success: function(response){
		      $("#suppliers_list").html('');
		      response = JSON.parse(response);
		      $("#suppliers_list").append('<option value="all">All Suppliers</option>');
		        $.each(response,function(key, value)
                {

                    $("#suppliers_list").append('<option value=' + value.supplier_id + '>' + value.supplier_name + '</option>');
                });
		        	
		        }
	        });
      }
});

	function copyBranchSuppliers(){
	    
	    
	    var copy_from = $("#copy_from").val();
	    var copy_to = $("#copy_to").val();
	    var suppliers_list = $("#suppliers_list").val();
	    
	    
		
		if(copy_from != '' && copy_to !=''){
		
	
			$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/copy_suppliers",
		       data: {copy_from: copy_from, copy_to: copy_to,suppliers_list: suppliers_list},
		        success: function(data){
		        swal("Data Copied !");
		        	
		        }
	        });
		}
		
	}
</script>
