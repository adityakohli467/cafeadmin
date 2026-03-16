<style>
.dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: right;
}
.dataTables_filter label {
    color: #6C6E7A;
    width: 30%;
}
.toggle.btn {
    width: 100px !important;
    margin: auto;
}
table.dataTable thead th {
    position: relative;
    padding: 4px 14px 4px 4px;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_desc:after{
    right: 0;
    content: "\e313";
    font-family: 'icomoon';
    font-weight: 900;
    font-size: 1rem;
    position: absolute;
    bottom: 50%;
    transform: translateY(80%);
    display: block;
    opacity: .3;
}

table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before{
    right: 0;
    content: "\e313";
    font-family: 'icomoon';
    font-weight: 900;
    font-size: 1rem;
    position: absolute;
    top: 50%;
    transform: translateY(-80%) rotate(180deg);
    display: block;
    opacity: .3;
}
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:after{
    opacity: 1;
}
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc{
    background-image:none;
}
table.dataTable thead th {
    font-size: 13px;
}
#preLoader {
    position: fixed;
    top: 0;
    left: 0;
    display: none;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background-color: #000000a3;
    z-index: 9999;
}
#preLoader.show{
    display: flex !important;
}
</style>
<div id="preLoader" style="display:none;"><img src="<?php echo base_url(); ?>assets/pre-loader/loader-11.svg"></div>
	<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
			<span class="text-center">
				<h3>EMPLOYEE INDUCTION</h3>
			</span>
		<?php  if(isset($type) && $type !='employee') { ?>
			<a href="<?php echo base_url(); ?>index.php/admin/add_employee">
			<button type="button" class="btn btn-success btn-ph"><i class="glyphicon glyphicon-plus"></i> Add <span>Employee</span></button></a> 
			
			<a href="<?php echo base_url(); ?>index.php/admin/download_employee_list">
			<button type="button" class="btn btn-success btn-ph"><i class="glyphicon glyphicon-save"></i><span>Download</span> Excel</button></a> 
			
				<a href="<?php echo base_url(); ?>index.php/admin/download_employee_report">
			<button type="button" class="btn btn-success btn-ph"><i class="glyphicon glyphicon-save"></i><span>Download</span> Employee report</button></a> 
			<?php } ?>
		
	</div>
	<!--.col-md-12 -->
	<input type="hidden" value="<?php echo $ex_employee_listing; ?>" id="ex_employee_listing">		
<div style="background-color:#fff;" class="container-fluid main-container ct-mngemp">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
			    
			      <div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="employee_filters">
									<div class="row">
									   <div class="col-12 col-md-2 ">
										<input class="form-control " id="name" type="text" placeholder="Name">
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control " id="phone" type="text" placeholder="Phone">
										</div>
						<div class="col-12 col-md-2">
						<input class="form-control " id="email" type="text" placeholder="Email">
						</div>
									
									
										<div class="col-12 col-md-1">
												<button class="btn btn-success">Go</button>
											</div>
									</div>
								</form>
							</div>
						</div> 
						
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
				<div class="ct-scroll">
			<table id="example" class="row-border table-condensed " cellspacing="0" width="100%">
				<thead>
					<tr style="height: 49px !important;">
						<th class="text-left">Employee Name</th>						
						<th class="text-left">Email Address</th>
						<th class="text-center">Phone</th>
						<th class="text-center">Employee Type</th>
						<th class="text-center">DOB</th>
						<th class="text-center">Effective Start Date</th>
						<th class="text-center">Status</th>
						<th class="text-center">Vaccinated</th>
						<th class="text-center">Email View </th>
						<?php  if(isset($type) && $type !='employee') { ?>
					    <th class="text-center">Fingerprint Auth.</th>
					    <?php } ?>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody id="branch_suppliers">
				<?php foreach($employees as $row){ 
				if($row->agree_terms_one == '1' && $row->agree_terms_two == '1' && $row->agree_terms_three == '1'){
				$color = "class='btn btn-success cxs-btn c-btn btn-xs btn-block'";						
				$btn_name = "Completed";
				}	
				else if($row->tracking_mail == 'Yes'){
				$color = "class='btn drakBlueBtn cxs-btn c-btn btn-xs btn-block'";						
				$btn_name = "In Progress";
				}
				
				else{
				$color = "class='btn btn-danger cxs-btn c-btn btn-xs btn-block'";
				$btn_name = "Not Started";
				} ?>
				<tr class="tr" style="height: 49px !important;">
				<td class="text-left"><a style="text-decoration: underline;" href="<?php echo base_url(); ?>index.php/admin/update_employee/<?php echo $row->emp_id ?>"><?php echo $row->first_name.' '.$row->last_name; ?></a></td>
						<td class="text-left"><?php echo $row->email; ?></td>
						<td class="text-center"><?php echo $row->phone; ?></td>
							<td class="text-center" style="text-transform: uppercase;"><?php echo $row->employee_type; ?></td>
							<td class="text-center" style="white-space: nowrap;"><?php if($row->dob == '00-00-0000' || $row->dob == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->dob)); } ?></td>
							<td class="text-center"><?php if($row->effective_start_date == '00-00-0000' || $row->effective_start_date == '0000-00-00'){ echo ""; }else{ echo date("d-m-Y",strtotime($row->effective_start_date)); } ?></td>
						<td class="text-center"><div <?php echo $color; ?> class="status-color"><?php echo $btn_name;  ?></div></td>
						<?php if($row->vaccination_certificate !='') {  ?>
						<td class="text-center" style="text-transform: uppercase;">Yes</td>
						<?php } else { ?>
						<td class="text-center" style="text-transform: uppercase;">No</td>
						<?php }  ?> 
							
						<td class="text-center"><?php if($row->tracking_mail != ''){ echo $row->tracking_mail; }else{ echo 'No'; }  ?></td>
							<?php  if(isset($type) && $type !='employee') { ?>
						<td  class="text-center" style="width:150px;">
						     <?php
                            if( $row->fingerprint_auth_status == 1) {
                            ?>
                             <input type="checkbox" class="toggle-demo" id="<?php echo $row->emp_id ?>" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">
                          <?php } else { ?>
                          
                         <input type="checkbox" class="toggle-demo" id="<?php echo $row->emp_id ?>"  data-toggle="toggle" data-on="Enable" data-off="Disabled" data-offstyle="danger" data-onstyle="success">

                          <?php } ?>
						</td>
					
						<th class="text-center">
						    <?php if(isset($row->status) && $row->status == 0){ ?>
						        <a><button style="white-space: nowrap;" type="button" onClick="revert_delete_row(<?php echo  $row->emp_id ?>);"><span class="glyphicon glyphicon-remove"></span> Revert</button></a>
						    <?php } else{ ?>
						    <a><button type="button" onClick="delete_row(<?php echo  $row->emp_id ?>);"><span class="glyphicon glyphicon-remove"></span>Delete</button></a>
						    <?php } ?>
						    </th>
				<?php } ?>
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
		
		<!--.footer-->
<script>
		     $(function() {
    $('.toggle-demo').change(function() {
        var emp_id = $(this).attr('id')
     if($(this).prop('checked')){
         var fingerprint_auth_status = 1;
     }else{
         var fingerprint_auth_status = 0;
     }
     
     
     	$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
		    url: "<?php echo base_url(); ?>index.php/admin/update_fingerprint_auth_status",
		    data: {"fingerprint_auth_status":fingerprint_auth_status,"emp_id":emp_id},
		    success: function(data){
                 console.log(data);
		    }
		});
		
		
    })
  })
</script>
<script type="text/javascript">
	function delete_row(str){
		if(confirm('Are you sure you want to delete the employee details')){
		    $('#preLoader').addClass('show');
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/employees/employee_delete",
		        data:'id='+str,
		        success: function(data){
		          location.reload();
		        }
	       });
		}	
	}
	function revert_delete_row(str){
		if(confirm('Are you sure you want to revert deleted employee details')){
		    $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/employees/revert_deleted_emp",
		        data:'id='+str,
		        success: function(data){
		          location.reload();
		        }
	       });
		}	
	}
</script>	



<script>

	$("#employee_filters").on('submit',function(e){
	    
		e.preventDefault();
		var is_ex_employee_listing = $('#ex_employee_listing').val();
		console.log(is_ex_employee_listing);
		if($.trim($("#name").val())=='')
			name='unset';
		else name=$("#name").val();
	
		if($.trim($("#phone").val())=='')
			phone='unset';
		else phone=$("#phone").val();
		
		if($("#email").val()=='')
			email='unset';
		else email=$("#email").val();
		
		$.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/employee_filter",
		        data:'name='+name+'&phone='+phone+'&email='+email+'&is_ex_employee_listing='+is_ex_employee_listing,
		        success: function(data){
		        $("#branch_suppliers").html('');
		        $("#branch_suppliers").append(data);
		        }
	        });

});
</script>
<script>
    $(document).ready(function () {
       $('#example').DataTable({
            "paging": false,
            "searching": false,
            "aaSorting": [],
              columnDefs: [{
              orderable: false,
              targets: 2,
              },
              {
              orderable: false,
              targets: 4,
              },
              {
              orderable: false,
              targets: 7,
              },
              {
              orderable: false,
              targets: 8,
              },
              {
              orderable: false,
              targets: 9,
              }
              ]
          });
        // $('.dataTables_length').addClass('bs-select');
    });
</script>
