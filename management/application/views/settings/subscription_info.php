	
  <?php if(null !==$this->session->userdata('subscription_msg')) { ?>  
	<div class='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('subscription_msg'); ?></p>
	</div>
  <?php } ?>
    
    <form class="form-horizontal" id="customer_add" role="form" method="post" action="<?php echo base_url(); ?>index.php/settings/subscription_update" enctype="multipart/form-data">
	<div class="col-md-12 page-head border-bottom">
		<span class="span-20 left border-right">
			<h3>Subscriptions</h3>
		</span>
		<div class="btn-div">
					<button type="submit" class="btn btn-success btn-ph">Save</button>
		</div>
	</div><!--.col-md-12 -->


<div class="container-fluid main-container">

		<?php $today = date('Ym'); ?>
		<div class="row">
		   <div class="col-md-12">
        	<div class="col-md-3">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Base Plan</h3>
			        </div>
	          		<div class="panel-body">
	          			<div class="form-group">
								<label class="col-sm-4 control-label">Package</label>
							        <div class="col-sm-8">
							        <select class="form-control" name="package" onchange="changePackage(this)">
										<?php 
										if(!empty($packages)){
											foreach($packages as $package){ ?>
												<option value="<?php echo $package->package_id;?>" <?php if($package->package_id == $customer_package->package_id){ echo 'selected';} ?>><?php echo $package->package_name;?></option>
										<?php 
											}
										}
										?>
									</select>
							    	</div>
						</div>
						<div class="sub-align">
							Price  <span id="base_package_amount">$<?php echo number_format($customer_package->package_amount,2,'.','');?></span>
							<input type="hidden" name="package_total" id="package_total" value="<?php echo $customer_package->package_amount; ?>">
						</div>
						<!--<div class="col-md-12">
							<h3  id="base_package_amount"><span class="sub-total"> Price </span>$<?php echo number_format($customer_package->package_amount,2,'.','');?></h3>
							<input type="hidden" name="package_total" id="package_total" value="<?php echo $customer_package->package_amount; ?>">
						</div>-->
						<div class="col-md-12 sub-total">
							<?php if($customer_package->status == 'Due' || $customer_package->status == 'Expired'){?>
							<button type="button" class="btn btn-success button-width btncolor">Pay Now</button>
							<?php } ?>
							
							<?php 
							if($customer_package->status != 'Trail' || $customer_package->status == 'Expired'){
	          					$status_access = 'disabled';
	          				}else{
	          					$status_access = '';
	          				}
							?>
						</div>
	          		</div>
        		</div>
	        </div>
	        <div class="col-md-2">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Addon Users</h3>
			        </div>
	          		<div class="panel-body" id="users_panel">
	          			<div class="padding">
          				<?php if(!empty($addons)){ ?>
          					<span>$<?php echo $addons->u_amount;?> / <?php echo $addons->users;?> Users</span>
          				<?php }
          				$additional_users = $customer_package->no_of_users - $customer_package->base_users;
          				if($additional_users > 0){
          					$ext_users = $additional_users;
          				}else{
          					$ext_users = 0;
          				}
          				$user_updated_on = $customer_package->user_updated_on;
          				$user_update = '';
          				if($user_updated_on != '0000-00-00 00:00:00'){
          					$user_update = date('Ym', strtotime($user_updated_on));
          				}
          				
          				if($user_update != '' && $user_update == $today){
          					$user_access = 'disabled';
          				}else{
          					$user_access = '';
          				}
          				
          				?></div>
						<div class="handle-counter">
						  <button type="button" <?php echo $user_access;?> <?php echo $status_access;?> class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`user`,`<?php echo $addons->u_amount;?>`,`<?php echo $addons->users;?>`)" >-</button>
						  <input class="order" type="text" value="<?php echo $ext_users;?>" id="user_addon" name="user_addon">
						  <button type="button" <?php echo $user_access;?> <?php echo $status_access;?> class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`user`,`<?php echo $addons->u_amount;?>`,`<?php echo $addons->users;?>`)">+</button>
						</div>
						<div class="sub-align">
							Monthly cost <span id="user_monthly_cost">$<?php echo (($ext_users/$addons->users) * $addons->u_amount);?></span>
							<input type="hidden" id="user_monthly_amount" value="<?php echo (($ext_users/$addons->users) * $addons->u_amount);?>" name="user_monthly_amount">
						</div>
	          		</div>
        		</div>
	        </div>
	        <div class="col-md-2">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Addon Branches</h3>
			        </div>
	          		<div class="panel-body" id="branch_panel">
	          			<div class="padding">
						<?php if(!empty($addons)){ ?>
          					<span>$<?php echo $addons->b_amount;?> / <?php echo $addons->branches;?> Branches</span>
          				<?php }
          				
          				$additional_branches = $customer_package->no_of_branches - $customer_package->base_branches;
          				if($additional_branches > 0){
          					$ext_branches = $additional_branches;
          				}else{
          					$ext_branches = 0;
          				}
          				
          				$branch_updated_on = $customer_package->branch_updated_on;
          				$branch_update = '';
          				if($branch_updated_on != '0000-00-00 00:00:00'){
          					$branch_update = date('Ym', strtotime($branch_updated_on));
          				}
          				
          				if($branch_update != '' && $branch_update == $today){
          					$branch_access = 'disabled';
          				}else{
          					$branch_access = '';
          				}
          				?>
	          			</div>
						<div class="handle-counter">
						  <button type="button" <?php echo $branch_access;?> <?php echo $status_access;?> class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`branch`,`<?php echo $addons->b_amount;?>`,`<?php echo $addons->branches;?>`)" >-</button>
						  <input class="order" type="text" value="<?php echo $ext_branches;?>" id="branch_addon" name="branch_addon">
						  <button type="button" <?php echo $branch_access;?> <?php echo $status_access;?> class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`branch`,`<?php echo $addons->b_amount;?>`,`<?php echo $addons->branches;?>`)">+</button>
						</div>
						<div class="sub-align">
							Monthly cost <span id="branch_monthly_cost">$<?php echo (($ext_branches/$addons->branches) * $addons->b_amount);?></span>
							<input type="hidden" id="branch_monthly_amount" value="<?php echo (($ext_branches/$addons->branches) * $addons->b_amount);?>" name="branch_monthly_amount">
						</div>
	          		</div>
        		</div>
	        </div>
	        <div class="col-md-2">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Addon Orders</h3>
			        </div>
	          		<div class="panel-body" id="orders_panel">
	          			<div class="padding">
						<?php if(!empty($addons)){ ?>
          					<span>$<?php echo $addons->o_amount;?> / <?php echo $addons->orders;?> Orders</span>
          				<?php }
          				
          				$additional_orders = $customer_package->no_of_orders - $customer_package->base_orders;
          				if($additional_orders > 0){
          					$ext_orders = $additional_orders;
          				}else{
          					$ext_orders = 0;
          				}
          				
          				$order_updated_on = $customer_package->order_updated_on;
          				$order_update = '';
          				if($order_updated_on != '0000-00-00 00:00:00'){
          					$order_update = date('Ym', strtotime($order_updated_on));
          				}
          				
          				if($order_update != '' && $order_update == $today){
          					$order_access = 'disabled';
          				}else{
          					$order_access = '';
          				}
          				?>
	          			</div>
						<div class="handle-counter">
						  <button type="button" <?php echo $order_access;?> <?php echo $status_access;?> class="counter-minus btn btn-primary abc" onclick="counterMinus(this,`order`,`<?php echo $addons->o_amount;?>`,`<?php echo $addons->orders;?>`)" >-</button>
						  <input class="order" type="text" value="<?php echo $ext_orders;?>" id="order_addon" name="order_addon">
						  <button type="button" <?php echo $order_access;?> <?php echo $status_access;?> class="counter-plus btn btn-primary abc" onclick="counterAdd(this,`order`,`<?php echo $addons->o_amount;?>`,`<?php echo $addons->orders;?>`)">+</button>
						</div>
						<div class="sub-align">
							Monthly cost <span id="order_monthly_cost">$<?php echo (($ext_orders/$addons->orders) * $addons->o_amount);?></span>
							<input type="hidden" id="order_monthly_amount" value="<?php echo (($ext_orders/$addons->orders) * $addons->o_amount);?>" name="order_monthly_amount">
						</div>
	          		</div>
        		</div>
	        </div>
	        <div class="col-md-3">
	        	<div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Monthly Total</h3>
			        </div>
	          		<div class="panel-body" id="total_panel">
	          			<div><?php 
							$basetotal = $customer_package->package_amount;
							$user = ($ext_users / $addons->users) * $addons->u_amount;
							$branch = ($ext_branches/$addons->branches) * $addons->b_amount;
							$orders = ($ext_orders/$addons->orders) * $addons->o_amount;
							$total = $basetotal+$user+$branch+$orders;
							?></div>
	          			<div class="sub-align">
							Total Amount <span id="total_plan" class="sub-total color">$<?php echo number_format($total, '2','.',''); ?></span>
							<input type="hidden" name="total_plan_amount" id="total_plan_amount" value="<?php echo $total;?>">
						</div>
						<!--<div>
							Total Amount
							<?php 
							$basetotal = $customer_package->package_amount;
							$user = ($ext_users / $addons->users) * $addons->u_amount;
							$branch = ($ext_branches/$addons->branches) * $addons->b_amount;
							$orders = ($ext_orders/$addons->orders) * $addons->o_amount;
							$total = $basetotal+$user+$branch+$orders;
							?>
							<h3 id="total_plan" class="sub-total color">$<?php echo number_format($total, '2','.',''); ?></h3>
							<input type="hidden" name="total_plan_amount" id="total_plan_amount" value="<?php echo $total;?>">
						</div>-->
	          		</div>
        		</div>
	        </div>
	    </div>
	</div>

</div><!--.container-->
</form>
<br>
<script>
	function counterAdd(e,type, amount, interval){
		
		if(type == 'user'){
			var qty = $('#user_addon').val();
			var inc = Number(qty) + Number(interval);
			$('#user_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#user_monthly_cost').html('$'+monthly);
			$('#user_monthly_amount').val(monthly);
			
		}else if(type == "branch"){
			var qty = $('#branch_addon').val();
			var inc = Number(qty) + Number(interval);
			$('#branch_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#branch_monthly_cost').html('$'+monthly);
			$('#branch_monthly_amount').val(monthly);
			
		}else if(type == "order"){
			var qty = $('#order_addon').val();
			var inc = Number(qty) + Number(interval);
			$('#order_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#order_monthly_cost').html('$'+monthly);
			$('#order_monthly_amount').val(monthly);
		}
		
		var useraddon_amount = $('#user_monthly_amount').val();
		var branchaddon_amount = $('#branch_monthly_amount').val();
		var orderaddon_amount = $('#order_monthly_amount').val();
		var package_total = $('#package_total').val();
		
		var total_plan = Number(useraddon_amount)+Number(branchaddon_amount)+Number(orderaddon_amount)+Number(package_total);
		
		$('#total_plan').html('$'+total_plan);
		$('#total_plan_amount').val(total_plan);
	}
	
	function counterMinus(e,type, amount, interval){
		
		if(type == 'user'){
			var qty = $('#user_addon').val();
			var inc = Number(qty) - Number(interval);
			$('#user_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#user_monthly_cost').html('$'+monthly);
			$('#user_monthly_amount').val(monthly);
			
		}else if(type == "branch"){
			var qty = $('#branch_addon').val();
			var inc = Number(qty) - Number(interval);
			$('#branch_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#branch_monthly_cost').html('$'+monthly);
			$('#branch_monthly_amount').val(monthly);
			
		}else if(type == "order"){
			var qty = $('#order_addon').val();
			var inc = Number(qty) - Number(interval);
			$('#order_addon').val(inc);
			var monthly = (inc/interval)*amount;
			$('#order_monthly_cost').html('$'+monthly);
			$('#order_monthly_amount').val(monthly);
		}
		
		var useraddon_amount = $('#user_monthly_amount').val();
		var branchaddon_amount = $('#branch_monthly_amount').val();
		var orderaddon_amount = $('#order_monthly_amount').val();
		var package_total = $('#package_total').val();
		
		var total_plan = Number(useraddon_amount)+Number(branchaddon_amount)+Number(orderaddon_amount)+Number(package_total);
		$('#total_plan').html('$'+total_plan);
		$('#total_plan_amount').val(total_plan);
	}
	
	function changePackage(e){
		var packageid = $(e).val();
		$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/settings/getPackageDetails",
	        data:'package_id='+packageid,
	        success: function(data){
	        	var obj = JSON.parse(data);
				$('#users_panel').html(obj.user_panel);
				$('#branch_panel').html(obj.branch_panel);
				$('#orders_panel').html(obj.orders_panel);
				$('#total_panel').html(obj.total_panel);
				var pckg_amount = obj.package_amount;
				$('#base_package_amount').html(pckg_amount);
				$('#package_total').val(pckg_amount);
	        }
        });
	}
</script>