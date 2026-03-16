<!DOCTYPE html> 
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>HRM</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>assets/css/main.css">
	
   <!-- script file for fingerprint-->
	<script src="<?php echo base_url(); ?>assets/js/scripts/CloudABIS-ScanR.js"></script>
	<!--<script src="<?php //echo base_url(); ?>assets/js/scripts/CloudABIS-Helper.js"></script>-->
    
    
	<!--====-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	
	
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	
	
	<!--<script src="vendor/jquery/jquery-3.2.1.min.js"></script>-->
<!--===============================================================================================-->
	<!--<script src="<?php echo base_url(); ?>assets/js/popper.js"></script>-->

<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<!--===============================================================================================-->
	<script src=""<?php echo base_url(); ?>assets/js/main.js"></script>
	<!--for toggle ON and OFF button the js and css-->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>	
	
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false,
		        "order": [[ 0, "ASC" ]]
		    } );
		    
		    
		  
		    //set cookie for fingerprint device setup
		    
		     var engineName = "FPFF02";
            var deviceName = "Secugen";
            var templateFormat = "ISO";
		        setCookie("CSDeviceName", deviceName, 7);
                setCookie("CABEngineName", engineName, 7);
                setCookie("CSTempalteFormat", templateFormat, 7);
                
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
                
		} );
	</script>
</head>
<body>
	<div class="gradient"></div>
<?php $role = $this->session->userdata('role'); 

$CI =& get_instance();
$CI->load->model('admin_model');
if($role=='employee') {
    $notifications = $CI->admin_model->fetch_employee_notifications();
   $notifications_count = $CI->admin_model->fetch_notifications_count_emp();
}else if($role !=''){
$notifications = $CI->admin_model->fetch_manager_notifications();  
$notifications_count = $CI->admin_model->fetch_notifications_count();
}
?> 




	<!--navigation-bar-->
		<nav class="navbar navbar-default nav-border">
		  <div class="container-fluid">
		    <div class="navbar-header border-right">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
    			</button>
		    <?php 	 if($role=='employee') { ?>
		<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general/dashboard"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img></a>
	   	<?php }else{ ?>
		<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img></a>		 
	   <?php } ?>			
		</div>
		    
		 <div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav sub-nav" style="font-size:13px" >
		  <?php 
		   if(!empty($menus)){  
		   $user_id = $this->session->userdata('user_id');
		   $userlevel = $this->session->userdata('clearance_level');
		   foreach($menus as $menu){ ?>
		  <li class="dropdown border ">
		    		 <?php if(!empty($menu->submenus)){ ?>
		<a href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>"   data-toggle="dropdown"><?php echo Strtoupper($menu->description); ?><span class="caret"></span></a> 
		<ul class="dropdown-menu">
				    <?php foreach($menu->submenus as $submenu){ 
				
				    if($user_id == 265 || $user_id == 266){ 
				    if(($submenu->submenu_id != 45 && $submenu->submenu_id != 57 )){ ?>
		    		  <li><a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>"  tabindex="-1" class="<?php echo $submenu->submenu_id; ?>"><?php echo $submenu->description; ?></a></li>		 
		    		<?php } } else{ ?>
		    		<li><a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>"  tabindex="-1"><?php echo $submenu->description; ?></a></li>		
		    		<?php } ?>
		    		  
		    		    <?php }  ?>
		    		</ul>	
				     <?php 	}else { ?>
				   <a href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>"   ><?php echo Strtoupper($menu->description); ?></a>  
				     <?php } }?>
		    		</li>
		    	   <?php } ?>
		</ul>
		<ul class="nav navbar-nav sub-nav right">
			 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="material-icons">notifications</span>
          <span class="badge badge-info" style="background-color: #4caf50;"><?php echo (!empty( $notifications_count[0]['total_count']) ?  $notifications_count[0]['total_count'] : ''); ?></span>
        </a>
        <div class="dropdown-main_container dropdown-menu" aria-labelledby="navbarDropdown">
		              <div class="dropdown-header">
		                <span class="triangle"></span>
		                <span class="heading">Notifications</span>
		              </div>
        <div class="dropdown-body">
            <?php  if(!empty($notifications)) { foreach($notifications as $notification){  ?>
		              <div class="notification new ng-scope ng-animate ng-enter ng-enter-active">
		                  <div class="notification-text">
		                     <span class="highlight"><?php  echo $notification->description;    ?></span>
		                  </div>
		                </div>
		                 <?php  } } ?>
         </div>
          </div>
         </li> 
			<li class="dropdown border">
		    	       <a href="<?php echo base_url(); ?>index.php/general" style="display:flex;align-items:center;"><span class="material-icons" style="font-size: 20px;">location_on</span> <?php echo $this->session->userdata('branch_name');?></a>
		    	   </li>
			<li class="dropdown account-btn">
						<a class="dropdown-toggle dp" style="padding: 5px 15px;" data-toggle="dropdown" href="#"><span class="material-icons">person</span>
						<span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
						    <li><a href="">Hi <?php echo $this->session->userdata('username');?><br><?php echo $this->session->userdata('branch_name');?></a></li>
							<!-- <li><a href="<?php echo base_url(); ?>index.php/settings/updateDetails">My Details</a></li> -->
							<li><a href="<?php echo base_url(); ?>index.php/auth/logout">LOGOUT</a></li>
						</ul>
					</li>
		</ul>
		    </div>
	</div>
		</nav>
