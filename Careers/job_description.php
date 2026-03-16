<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
	<link rel="stylesheet" href="/Careers/css/main.css" type="text/css" media="all"/>
<head>
    <style>
    .job-detail .content-area {
    padding: 15px 20px;
    box-shadow: 0px 0px 14px rgb(191 191 191 / 24%);
}
    </style>
    <title>Careers</title>
    </head>
<?php 
require_once 'db.php'; 
$job_id = $_GET['id'];
$sql = "select c.*,cb.branch_name as location_name from careers c left join customer_branches cb on c.branch_id  =  cb.branch_id where c.status = 1 AND c.id=".$job_id;
$job_desc = $con->query($sql);
$row = $job_desc->fetch_assoc(); ?>

	<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>
<div class="carousel-inner" style="height: 300px !important;margin-top: -22px">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>We are hiring</h1>        
           
        </hgroup>
      
      </div>
    </div>
  
  </div> 
</div>
<section class="job-detail section" style="margin-top: 60px;">
<div class="container">
<div class="row justify-content-between">
<div class="col-lg-8 col-md-12 col-xs-12">
    <a href="<?php echo $base_url; ?>Careers/"><button type="button" class="btn btn-primary btn-arrow-left">Back</button></a>
<div class="content-area">
    <h5><?php echo $row['job_name']; ?> <span style="float:right"><i class="zmdi zmdi-pin mr-2"></i> <?php echo $row['location_name']; ?></span></h5>

<h5>Job Description</h5>
<p><?php echo $row['job_desc']; ?></p>
<h5>Responsibilites</h5>
<p><?php echo $row['responsibilites']; ?></p>
<?php if($row['additional_info'] !='') {  ?>
<h5>Additional Info</h5>
<p><?php echo $row['additional_info']; ?></p>
<?php } ?>
<h6>Salary</h6>
<p><?php echo $row['salary']; ?></p>
<h6>Effective Start Date</h6>
<p><?php echo date('d-m-Y',strtotime($row['start_date'])); ?></p>
</div>
</div>
<div class="col-lg-4 col-md-12 col-xs-12">
	<div class="panel panel-default">
        	
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="save_application.php" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    		

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile No.">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>
			    				</div>
			    			</div>
			    		
			    			
			    				<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="city" id="city" class="form-control input-sm" placeholder="City">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="state" id="state" class="form-control input-sm" placeholder="State">
			    					</div>
			    				</div>
			    			</div>
			    		
			    				<div class="row">
			    				<!--  <div class="col-xs-6 col-sm-6 col-md-6">-->
			    				<!--	<div class="form-group">-->
			    				<!--		<select name="branch_id" class="form-control input-sm">-->
			    				<!--		    <option value="48">Bendigo</option> -->
			    				<!--		    <option value="60">Canterbury</option>  -->
			    				<!--		    <option value="49">Footscray</option>-->
			    				<!--		     <option value="54">Fairfield</option>-->
			    				<!--		     <option value="57">Ipswich</option>-->
			    				<!--		     <option value="58">Northshore</option>-->
			    				<!--		    <option value="55">RPA</option>-->
			    				<!--		   <option value="56">Redcliffe</option>-->
			    				<!--		   <option value="59">Westmead</option>-->
			    				<!--		   <option value="52">Williamstown</option>-->
			    				<!--		</select>-->
			    				<!--	</div>-->
			    				<!--</div>-->
			    				
			    				 <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<input type="text" name="experience" id="experience" class="form-control input-sm" placeholder="Experience">
			    					</div>
			    				</div>
			    			</div>
			    				<div class="row">
			    				    <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    					<textarea row="3" name="education" id="education" class="form-control input-sm" placeholder="Education"></textarea>
			    					</div>
			    				</div>
			    			</div>	  
			    				<div class="row">
			    				    <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    					<textarea row="3" class="form-control input-sm" name="message_to_manager" placeholder="Message to the hiring manager"></textarea>
			    					</div>
			    				</div>
			    			</div>	  
			    			<div class="row">
			    				  <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    					    <label> Attach CV</label>
			    				<input type="file" name="resume" id="resume" class="form-control input-sm">
			    					</div>
			    				</div>
			    			
			    			</div>
			    				<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    					    <label> Attach Supportive documents</label>
			    				<input type="file" name="docs" id="docs" class="form-control input-sm">
			    					</div>
			    				</div>
			    					</div>
			    					<input type="hidden" name="job_id" value="<?php echo $row['id']; ?>">
			    						<input type="hidden" name="branch_id" value="<?php echo $row['branch_id']; ?>">
			    			<input type="submit" value="Apply" class="btn btn-info btn-block" style="background-color:#125E76">
			    		</form>
			    	
	    		</div>
            </div>
</div>
</div>
</div>
</section>