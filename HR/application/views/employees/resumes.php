
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
		<span class="text-center">
				<h3>Resumes</h3>
			</span>
			<a href="<?php echo base_url('index.php/admin/resume_form'); ?>">
			<button type="button" class="btn btn-success btn-ph">Add Resume</button></a>
		
			
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container ct-section">
	<div class="col-md-12">
		<div style="box-shadow:none;" class="panel panel-default">
			<div class="gradient"></div>
			<div class="panel-body">
				<div class="card card-shadow mb-4" style="margin-bottom: 20px;">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="resume_filters">
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
						
						<?php if($this->session->userdata('sucess_msg') != '') { ?>  
				<div class='hideMe'>
					<p class="alert alert-success"><?php echo $this->session->flashdata('sucess_msg'); ?></p>
				</div>
				<?php } ?>
				<?php if($this->session->userdata('error_msg') != '') { ?>  
				<div class='hideMe'>
					<p class="alert alert-danger"><?php echo $this->session->flashdata('error_msg'); ?></p>
				</div>
				<?php } ?>
				
				
				<div class="ct-scroll">
			<table id="example" class="row-border table-condensed datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-left">Name</th>						
						<th class="text-left">Email</th>						
						<th class="text-left">Phone</th>						
						<th class="text-center">Job role</th>
					
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody id="resume_wrap">
				<?php 
    				if(!empty($resumes)){
    				foreach($resumes as $row){ ?>
    					<tr class="tr">
    						<td class="text-left"><?php echo $row->candidate_name; ?></td>
    						<td class="text-left"><?php echo $row->email; ?></td>
    						<td class="text-left"><?php echo $row->phone; ?></td>
    						<td class="text-center"><?php echo $row->job_role; ?></td>
    					    
    						<th class="text-center"><a href="<?php echo base_url(); ?>index.php/admin/resume_view/<?php echo $row->resume_id;?>"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;
    						 <a href="<?php echo base_url(); ?>index.php/admin/resume_form/<?php echo $row->resume_id;?>"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;
    						<a href="<?php echo base_url(); ?>index.php/admin/resume_del/<?php echo $row->resume_id;?>"><span class="glyphicon glyphicon-trash"></span></a></th>
    					</tr>
				<?php } } ?>
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
    	$("#resume_filters").on('submit',function(e){
	    
		e.preventDefault();
	
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
		        url: "<?php echo base_url();?>index.php/admin/resumes",
		        data:'candidate_name='+name+'&phone='+phone+'&email='+email,
		        success: function(data){
		            console.log(data);
		            if(data){
		                var htmlData = '';
		            var resumesData = JSON.parse(data)
		            resumesData.forEach(val => {
		                htmlData +='<tr class="tr">';
    						htmlData +='<td class="text-left">'+val.candidate_name+'</td>';
    						htmlData +='<td class="text-left">'+val.email+'</td>';
    						htmlData +='<td class="text-left">'+val.phone+'</td>';
    						htmlData +='<td class="text-center">'+val.job_role+'</td>';
    					    
    						htmlData +='<th class="text-center"><a href="<?php echo base_url(); ?>index.php/admin/resume_view/'+val.resume_id+'"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;';
    						 htmlData +='<a href="<?php echo base_url(); ?>index.php/admin/resume_form/'+val.resume_id+'"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;';
    						htmlData +='<a href="<?php echo base_url(); ?>index.php/admin/resume_del/'+val.resume_id+'"><span class="glyphicon glyphicon-trash"></span></a></th>';
    					htmlData +='</tr>';
		            });
		        
		        }else{
		            htmlData +='<tr class="tr"><td colspan="5" class="text-center">No record found</td></tr>';
		        }
		        $("#resume_wrap").html(htmlData);
		        }
	        });

});
</script>
