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
				<h3>Users List</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/settings/users">
			<button type="button" class="btn btn-success btn-ph" id="myBtn">Add User</button></a>
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
		
			<?php } ?>
			<div class="<?php echo $cls;?>">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%" style="table-layout:fixed;">
				<thead>
					<tr>
						<th class="text-left">Name</th>
						<th class="text-left">Email</th>
						<th class="text-center">User Type</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				    <?php 
				    // echo "<pre>";
				    // print_r($suppliers);
				    // exit;
				    
				    ?>
				<?php foreach($users as $row){
				    
        			if($row->group_id == "3"){ $type="Admin";  
					    }else if($row->group_id == "8"){ $type="Manager";   
					    }else if($row->group_id == "2"){ $type="User";   
					    }else if($row->group_id == "9"){ $type="Accounts";   
					    }else{
					        $type="";
					  }
        			?>
					<tr class="tr">
						<td class="text-left"><?php echo $row->first_name.' '.$row->last_name; ?></td>
						<td class="text-left"><?php echo $row->email; ?></td>
						<td class="text-center"><?php echo $type; ?></td>
						<td class="text-center"><?php if($row->active == '1'){ echo 'Active';}else{ echo "InActive"; } ?></td>
						<td class="text-center"><a  href="<?php echo base_url(); ?>index.php/settings/users/<?php echo $row->customer_user_id; ?>"><button type"button" class="btn btn-primary cxs-btn c-btn btn-xs" >Edit</button></a>&nbsp;&nbsp;
						<a  href="<?php echo base_url(); ?>index.php/settings/user_view/<?php echo $row->customer_user_id; ?>"><button type"button" class="btn btn-primary cxs-btn c-btn btn-xs" >View</button></a></td>
					</tr>
				<?php } ?>
				
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
