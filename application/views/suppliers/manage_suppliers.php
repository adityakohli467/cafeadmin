<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
</style>	
	
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Approved Suppliers List</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/suppliers/add_suppliers">
			<button type="button" class="btn btn-success btn-ph" id="myBtn">Add Supplier</button></a>
			<button type="button" class="btn btn-success btn-ph" onclick="export_data()">Export Suppliers</button>
		</div>
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
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
			<?php 
			$cls = '';
			if($user_group == 'Super Admin'){
				$cls = 'table-up';
			?>
			<select class="table-select app-select" onchange="getBranchSuppliers(this)" style="width:20%;">
				<option value="all">All Branches</option>
				<?php 
				if(!empty($branches)){
					foreach($branches as $branch){ ?>
					<option value="<?php echo $branch->branch_id;?>"><?php echo $branch->branch_name;?></option>
				<?php }} ?>
			</select>
			
			<?php } ?>
			<div class="<?php echo $cls;?>">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left">Supplier Name</th>
						<th class="text-left">Contact Person Name</th>
						<th class="text-center">Contact Number</th>
						<th class="text-left">Email</th>
						<th class="text-center">Items</th>
						<th class="text-center">HACCP Expiry Date</th>
						<th class="text-center">CFR Expiry Date</th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				    <?php 
				    // echo "<pre>";
				    // print_r($suppliers);
				    // exit;
				    
				    ?>
				<?php foreach($suppliers as $row){
				    
			
				if($user_group != 'Super Admin' && $row->name == 'Super Admin'){
					//if($row->name == 'Super Admin'){
				
						?>
					<tr class="tr">
						<td class="text-left"><a  href="<?php echo base_url(); ?>index.php/suppliers/edit_suppliers/<?php echo $row->supplier_id; ?>" ><?php echo $row->supplier_name; ?></td>
						<td class="text-left"><?php echo $row->first_name; ?></td>
						<td class="text-center"><?php echo $row->mobile; ?></td>
						<td class="text-left"><?php echo $row->email; ?></td>
						<td class="text-center"><a href="<?php echo base_url(); ?>index.php/suppliers/supplier_items/<?php echo $row->supplier_id; ?>">items</td>
						<td class="text-center"><?php echo "dattt ".date('d-m-Y',$row->haccp_expiry_date); ?></td>
						<td class="text-center"><?php echo "dattt ".date('d-m-Y',$row->cfr_expiry_date); ?></td>
					</tr>
				<?php
					//}
				}else{ 	
				?>
					<tr class="tr">
						<td class="text-left"><a  href="<?php echo base_url(); ?>index.php/suppliers/edit_suppliers/<?php echo $row->supplier_id; ?>" ><?php echo $row->supplier_name; ?></a></td>
						<td class="text-left"><?php echo $row->first_name; ?></td>
						<td class="text-center"><?php echo $row->mobile; ?></td>
						<td class="text-left"><?php echo $row->email; ?></td>
						<td class="text-center"><a href="<?php echo base_url(); ?>index.php/suppliers/supplier_items/<?php echo $row->supplier_id; ?>">items</td>
						<td class="text-center">
					<?php echo ($row->haccp_expiry_date !='' ? date('d-m-Y',strtotime($row->haccp_expiry_date)) : ''); ?>
						</td>
						
							<td class="text-center">
					<?php echo ($row->cfr_expiry_date !='' ? date('d-m-Y',strtotime($row->cfr_expiry_date)) : ''); ?>
						</td>
					</tr>
				<?php }} ?>
				</tbody>
			</table>
			</div>
		</div>
		</div>
		</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->
<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete supplier')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/suppliers_delete",
		        data:'id='+str,
		        success: function(data){
		          location.reload();
		        }
	       });
		}	
	}
</script>	

<script type="text/javascript">
$(document).ready(function() { 
    $("#contact_form").validate({
		ignore: "input[type='text']:hidden",
		rules: {
			route: {
				required:true
			}									
		},		
		messages: {
			route: {
				required:"Please enter route name"
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
			route: {
                required:true
            }									
			
	},		
	messages: {
			route: {
                 required:"Please enter route name"
            }	
	},

    });	
   
});
 function export_data(){ 
 
    $.ajax({
       type:"post",
       url:"<?php echo base_url();?>index.php/suppliers/export_suppliers",
       success: function(data){
	window.open(this.url,'_blank' );
       }
      }) ;  
     
    }
</script>
<script>
	function getBranchSuppliers(e){
		var branch_id = $(e).val();
		if(branch_id == 'all'){
			location.reload();
		}else{
			$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/suppliers/getBranchSuppliers",
		        data:'branch_id='+branch_id,
		        success: function(data){
		        	// alert(data);
		        	$('#branch_suppliers').html(data);
		        }
	        });
		}
		
	}
</script>
