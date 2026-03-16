<!DOCTYPE html>
<html>
	<head>
	<title>Pantry</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>

	<style>
	label.error{
		color:red !important;
	}
	</style>

</head>
<body>
	<div class="gradient"></div>
		<nav class="navbar navbar-default nav-border">
		  <div class="container-fluid">
		    <div class="navbar-header border-right">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
    			</button>
		    
		    	<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img> </a>
		    	
		    </div>
		    
		    <div class="collapse navbar-collapse" id="myNavbar">
		    	
				<ul class="nav navbar-nav sub-nav right">
					<li class="dropdown border-left account-btn">
						<a class="dropdown-toggle dp" style="padding: 5px 15px;" data-toggle="dropdown" href="#">Hi, <?php echo $this->session->userdata('username');?><br><?php echo $this->session->userdata('branch_name');?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<!--<li><a href="<?php echo base_url(); ?>index.php/settings/updateDetails">My Details</a></li>-->
							<li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
		    </div>
		      

		  </div><!--.container-fluid-->
		</nav>
<div class="col-md-12 page-head border-bottom">
	<span class="span-20 left border-right">
		<h3>Company Details</h3>
	</span>
</div><!--.col-md-12 -->

<div class="container-fluid main-container">
	<div class="col-md-12">
		<div class="row item">
			  <div class="col-md-3 col-sm-3"></div>
			  <div class="col-md-6 col-sm-4">
			  	  
			  	<div class="panel">
			  		<div class="panel-head">Company Details</div>
			  		<div class="panel-body">
			  			<?php if(null !==$this->session->userdata('sucess_msg')) { ?>
					  <div class="alert alert-success">
					   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					   <?php echo $this->session->userdata('sucess_msg');?>
					   </div>
					  <?php } ?>
					  
			  			<form method="post" class="additional_form" action="<?php echo base_url() ?>index.php/settings/updateCompanyDetails" id="additional_form">
					    <div class="col-md-6">
						    <div class="form-group">
						      <div class="col-md-12">
						        <label>First Name</label>
						        <input type="text" name="first_name" id="first_name" value="<?php echo $user_details->first_name;?>" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						        <label>Last Name</label>
						        <input type="text" name="last_name" id="last_name" value="<?php echo $user_details->last_name;?>" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-8">
						        <label>Email</label>
						        <input type="text" name="email" id="email" value="<?php echo $user_details->email;?>" class ='form-control' <?php if($user_details->email_verification == '1'){ echo "disabled"; } ?> >
						      </div>
						      <div class="col-md-4">
						      	<span class="caret"></span>
						      	<?php if($user_details->email_verification == '0') { ?>
						        <a onclick="resendLink(<?php echo $user_details->customer_user_id;?>)">click here</a> To resend link
						        <?php } ?>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						        <label>Mobile</label>
						        <input type="text" name="mobile" id="mobile" value="<?php echo $user_details->mobile;?>" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						        <label>Branch Name</label>
						        <input type="text" name="business_name" id="branch_name" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>Brand Name</label>
						        <input type="text" name="brand_name" id="brand_name" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>ABN</label>
						        <input type="text" name="abn" id="abn" class ='form-control'>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>Website</label>
						        <input type="text" name="website" id="website" class ='form-control'>
						      </div>
						    </div>
					    </div>
					    <div class="col-md-6">
					    	
					    	<div class="form-group">
						      <div class="col-md-12">
						     	<label>Unit No.</label>
						        <input type="text" name="unit" id="unit" class ='form-control' placeholder="" value="">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>Street</label>
						        <input type="text" name="street" id="street" class ='form-control' placeholder="" value="">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>Suburb</label>
						        <input type="text" name="suburb" id="suburb" class ='form-control' placeholder="" value="">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>Postcode</label>
						        <input type="text" name="postcode" id="postcode" class ='form-control' placeholder="" value="">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-md-12">
						     	<label>State</label>
						        <select name="state" id="state" class ='form-control'>
						        	<option value="victoria">Victoria</option>
						        </select>
						      </div>
						    </div>
						    <div class="form-group">
						     <div class="col-md-12">
						      <input type="hidden" name="user_id" id="user_id" class ='form-control' value="<?php echo $this->session->userdata['user_id'] ?>">
						     </div>
						    </div>
						</div>
					 	<div class="auth-btn-div">
						    <button type="submit" class="btn btn-success">Save</button>
						    
						</div>
					   
					    	<div class="clearfix"></div>
					    
					  </form>
					
			  		</div>
			  	</div>
			  
			  </div>
			 <div class="col-md-3 col-sm-3"></div>
		</div>
	</div>
</div>
	<br>
	<footer class="footer">
		<div id="footer" class="foot-border">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/skyward_logo.png"></img> </a>
		    </div>
		      <ul class="nav navbar-nav navbar-right foot-nav">
		      <!--<li><a href="#" data-toggle="modal" data-target="#Modal">For application support please click here</a></li>-->
		      </ul>
		  </div>
		<div class="container-fluid foot-row">
			  	<div class="foot-left">
			  		<p class="text-muted credit">&copy; <?php echo Date('Y'); ?> Sugarinc NS Pvt Ltd.</p>
			  	</div>
			  	<div class="foot-right">
			  		<p class="text-muted credit">Application developed and maintained by Sugarinc NS Pvt Ltd.</p>
			  	</div>
		</div>
		<div class="gradient"></div>
		</div>
	</footer>

	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
 
 <script>
 $('.datepicker-dob').datepicker({
	    dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '-55:-18'
 });
</script>
<script type="text/javascript">
	$('.datepicker-min').datepicker({
		dateFormat: 'dd-mm-yy',
		minDate: 1, // 0 days offset = today
	});
</script>
<script type="text/javascript">
	$(document).ready(function() { 
    $("#enquiry_form").validate({
      ignore: "input[type='text']:hidden",
	    rules: {
			message: {
                required:true
            },	
          
	},		
	messages: {
			message: {
                 required:"Please enter message"
            },
		
	},

    });	
	
});

function resendLink(cusId){
    	$.ajax({
			type: "POST",
	        url: "<?php echo base_url();?>index.php/settings/resendActivation",
	        data:'customer_user_id='+cusId,
	        success: function(data){
	          alert(data);
	        }
        });
    }
</script>	

		
<script type="text/javascript">
  $('#additional_form').validate({
    rules:{
      first_name:{
        required:true
      },
      email:{
        required:true,
        email:true
      },
      mobile:{
        required:true
      },
      branch_name:{
        required:true
      }
      
    },
    messages:{
      first_name:{
        required:"Please provide first name"
      },
      email:{
        required:"Please provide email",
        email:"Please provide valid email"
      },
      mobile:{
        required:"Please provide mobile number"
      },
      branch_name:{
        required:"Please provide branch name"
      }
    }

  });
</script>
</body>
</html>
