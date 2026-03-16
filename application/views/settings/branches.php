	
	<!--<?php if(null !==$this->session->userdata('sucess_msg')) { ?>  
	<div class='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
	</div>
	<?php } ?>
	<?php if(null !==$this->session->userdata('error_msg')) { ?>  
	<div class='hideMe'>
		<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
	</div>
	<?php } ?>-->
	
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-3">
			<p class="page-head-p left">
				<span id="limit_message"></span>
				<a id="subscription" style="display:none" href="<?php echo base_url(); ?>index.php/settings/subscriptions">add Branch</a>
			</p>
		</div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Sites</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="button" onclick="addBranch()" class="btn btn-success btn-ph">Add Site</button>
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
			<table  class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Site Name</th>
						<th class="text-left">Site Budget</th>
						<th class="text-right">Street</th>
						<th class="text-left">Suburb</th>
						<th class="text-left">State</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($branches as $row){ ?>
					<tr class="tr">
						<td class="text-left"><a  href="<?php echo base_url(); ?>index.php/settings/edit_branch/<?php echo $row->branch_id; ?>" ><?php echo $row->branch_name; ?></a></td>
						<td class="text-letf">&#36;<?php  echo number_format($row->branch_budget, 2, '.', ''); ?></td>
						<td class="text-right"><?php echo $row->street; ?></td>
						<td class="text-left"><?php echo $row->suburb; ?></td>
						<td class="text-left"><?php echo $row->state; ?></td>
						<td class="text-center">
							<!--<a type="button" onClick="delete_row(<?php echo  $row->branch_id; ?>);"><span class="glyphicon glyphicon-trash"></span></a>--></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	</div><!--.container-->
		<!--.table-->
		<br>
		<!--.footer-->

	<script type="text/javascript">
			
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();   
		});
		
		function addBranch(){
			var limit = '<?php echo $max_limit; ?>';
			var count = '<?php echo $branch_count; ?>';
			var balance = Number(limit) - Number(count);
			
			if(balance > 0){
				window.location.href ='<?php echo base_url(); ?>index.php/settings/add_branch';
			}else{
				$('#limit_message').html('Active sites limit reached');
				$('#subscription').show();
			}
		}

	</script>
    <script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete site')){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/settings/customer_branch_delete",
				data:'id='+str,
				success: function(data){
					location.reload();
				}
			});
		}	
	}
	</script>

