<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<span class="text-center">
			<h3>Dashboard</h3>
		</span>
	</div>
	<div class="btn-div col-md-3">
	</div>

</div><!--.col-md-12 -->
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-lg-6">
				    <?php 
				 $userlevel = $this->session->userdata('clearance_level');
		          if($userlevel !=1){ ?>
				    
                        <div class="recent-orders">
                            <div class="panel">
                                <div class="panel-heading p-head">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <h3 class="panel-title">Recent Orders</h3>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="text-right">
                                                <a type="button" href="<?php echo base_url(); ?>index.php/orders" class="btn btn-default cxs-btn c-btn btn-xs btn-block">New Order </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body p-body">
								<?php foreach($last_orders as $orders){
			          			if($orders->order_status == 'Sent'){
									$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";
								}else if($orders->order_status == 'Viewed'){
									$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";
								}else if($orders->order_status == 'Confirmed'){
									$color = "class='btn btn-warning cxs-btn c-btn btn-xs btn-block'";
								}else{
									$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";
								}
			          			?>
                                    <div class="row single-item">
                                        <div class="col-xs-4">
                                            <div class="rate">$<?php echo number_format($orders->order_total,2,'.','');?></div>
                                        </div>
                                        <div class="col-xs-4 text-left">
                                            <div class="huge">
                                              <?php if($orders->order_status == "Received"){ ?>
									<a href="<?php echo base_url();?>index.php/orders/receiveOrderDetails/<?php echo $orders->order_id;?>" class="update_user_button"><?php echo $orders->order_number; ?></a>
									<?php }else if($orders->order_status == "Confirmed"){ ?>
									<a href="<?php echo base_url();?>index.php/orders/receiveOrder/<?php echo $orders->order_id;?>" class="update_user_button"><?php echo $orders->order_number; ?></a>
									<?php }else{ ?>
									<a href="<?php echo base_url();?>index.php/orders/orderDetails/<?php echo $orders->order_id;?>" class="update_user_button"><?php echo $orders->order_number; ?></a>
									<?php } ?>
                                            </div>
                                            <div><?php echo $orders->supplier_name;?></div>
                                        </div>
                                        <div class="col-xs-4 text-right">
                                            <button type="button" <?php echo $color; ?> ><?php echo $orders->order_status;?> </button>
                                        </div>
                                    </div>
								<?php } ?>
                                </div>
                            </div>
                            <?php }  ?>
                        </div>
                    </div>
                    <div class="col-md-6">
						<div class="cmsp">
                            <div class="panel">
                                <div class="panel-heading p-head">
                                    <h3 class="panel-title">Total Monthly Purchases</h3>
                                </div>
                                <div class="panel-body p-body">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
					</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4">
                        <div class="f-orders">
                            <div class="panel">
                                <div class="panel-heading p-head">
                                    <h3 class="panel-title">Favourite Orders</h3>
                                </div>
                                <div class="panel-body p-body">
								<?php foreach($fav_orders as $favorder){ ?>
                                    <div class="row single-item">
                                        <div class="col-xs-4">
                                            <div class="rate">$<?php echo number_format($favorder->order_total,2,'.','');?></div>
                                        </div>
                                        <div class="col-xs-4 text-left">
                                            <div class="huge">
                                                <a href="<?php echo base_url(); ?>index.php/orders/orderDetails/<?php echo $favorder->order_id;?>"><?php echo $favorder->order_number;?></a>
                                            </div>
                                            <div><?php echo $favorder->supplier_name;?></div>
                                        </div>
                                    </div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="cmsp">
                            <div class="panel">
                                <div class="panel-heading p-head">
                                    <h3 class="panel-title">Current Month Supplier Purchases</h3>
                                </div>
                                <div class="panel-body p-body">
                                    <div id="donutchart" width="100%" height="100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="cmcp">
                            <div class="panel">
                                <div class="panel-heading p-head">
                                    <h3 class="panel-title">Current Month Category Purchases</h3>
                                </div>
                                <div class="panel-body p-body">
                                    <div id="donutchart_2" width="100%" height="100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
			
		</div>
	</div>
</div>
<br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
<script>
//last year purchase orders graph
$.ajax({
	type: "POST",
	url: "<?php echo base_url();?>index.php/orders/getLastYearOrders",
	data:'',
	success: function(data){
	    //alert(data);
		var obj = JSON.parse(data);
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: obj.labels,
		        datasets: [{
		            label: 'Total Purchases',
		            data: obj.order,
		            backgroundColor:'#9acd32'
		        }]
		    },
		   
		    options: {
		    	animation:{
		    		"duration": 1,
		    		"onComplete": function() {
			        var chartInstance = this.chart,
			          ctx = chartInstance.ctx;
			
			        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
			        ctx.textAlign = 'center';
			        ctx.textBaseline = 'bottom';
			
			        this.data.datasets.forEach(function(dataset, i) {
			          var meta = chartInstance.controller.getDatasetMeta(i);
			          meta.data.forEach(function(bar, index) {
			            var data = dataset.data[index];
			            ctx.fillText(data, bar._model.x, bar._model.y - 5);
			          });
			        });
			      }
		    	},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                },
		                gridLines: {
				          drawOnChartArea: false
				        }
		            }],
		            xAxes: [{
				        gridLines: {
				          drawOnChartArea: false
				        }
				      }]
		        }
		    }
		});
	}
});


//supplier budget - monthly wise
$.ajax({
	type: "POST",
	url: "<?php echo base_url();?>index.php/orders/getSupplierLastMonth",
	data:'',
	success: function(data){
		console.log(data);
		var obj = JSON.parse(data);
		var orders = obj.order_totals;
		
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable(orders);
			var options = {
			pieHole: 0.4,
			};
			
			var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart.draw(data, options);
		}
	}
});

//category wise items totals
$.ajax({
	type: "POST",
	url: "<?php echo base_url();?>index.php/orders/getPurchaseOrdersByCategory",
	data:'',
	success: function(data){
		console.log(data);
		var obj = JSON.parse(data);
		var orders = obj.categories;
		
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable(orders);
			var options = {
			pieHole: 0.4,
			};
			
			var chart = new google.visualization.PieChart(document.getElementById('donutchart_2'));
			chart.draw(data, options);
		}
	}
});

</script>