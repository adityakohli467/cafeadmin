<!DOCTYPE html> 
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>HACCP</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <style>
        @font-face{
          font-family:'Glyphicons Halflings';
          src:url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot");
          src:url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot?#iefix") format("embedded-opentype"),
          url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff2") format("woff2"),
          url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff") format("woff"),
          url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.ttf") format("truetype"),
          url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular") format("svg")
        }
    </style>
    <script src="https://www.cafeadmin.com.au/haccap/assets/js/jquery-1.9.1.min.js"></script>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
    <!-- script file for fingerprint-->
	<script src="<?php echo base_url(); ?>assets/js/scripts/CloudABIS-ScanR.js"></script>
	<!--<script src="<?php //echo base_url(); ?>assets/js/scripts/CloudABIS-Helper.js"></script>-->
    
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
     <!-- Bootstrap Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   
    
    <!--<link href="<?php echo base_url(""); ?>haccp-assets/css/custom.css" rel="stylesheet" type="text/css" />-->
	<!--<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  -->
 <!--   <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
 <!-- Layout config Js -->
    <script src="<?php echo base_url(""); ?>haccp-assets/js/layout.js"></script>
   
    <!-- Icons Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css--><link href="<?php echo base_url(""); ?>haccp-assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(""); ?>haccp-assets/css/style.css" rel="stylesheet" type="text/css" />

	 <script type="text/javascript">	
		$(document).ready(function() {
		
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
<style>
    [data-layout=horizontal] .navbar-menu {
        -webkit-box-shadow: none;
        box-shadow: none;
        margin-top: 0;
        position: relative;
        left: 0;
        right: 0;
        bottom: 0;
        border-right: 0;
    }
    [data-layout=horizontal] .navbar-menu .navbar-nav .nav-link {
        color: #000;
        padding: .75rem 19px .75rem 15px;
    }
    .topbar-user {
        min-width: 134px;
        padding: 5px;
    }
    .topbar-user .dropdown-menu-end {
        right: 0;
        top: 100%;
    }
    h6.dropdown-header {
        margin-bottom: 8px;
    }
    [data-layout=horizontal] .navbar-menu .navbar-nav .nav-item:hover>.nav-link[data-bs-toggle=collapse]:after,
    [data-layout=horizontal] .navbar-nav .nav-item:hover>.nav-link{
        color: #f3e000 !important;
    }
    [data-layout=horizontal] .menu-dropdown {
        min-width: max-content;
    }
    [data-layout=horizontal] .navbar-nav .menu-dropdown .nav-item {
        border-bottom: 1px solid #f7f7f7b8;
    }
    [data-layout=horizontal] .navbar-nav .menu-dropdown .nav-item:last-child {
        border-bottom: 0;
    }
    
    [data-layout=horizontal] .page-content {
        padding: 0;
    }
    [data-layout=horizontal] .page-title-box {
        margin: 0;
    }
    .dashboard_forms .btn {
        text-transform: uppercase;
    }
    .page-title {
        margin-bottom: 25px;
    }
    div#layout-wrapper {
        padding-bottom: 60px;
    }
    label.error, label>span{
        color:red;
  }

  /* for tabs */
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px;
	border-bottom: 1px solid #333;
	width: 100%;
}

ul.tabs li {
	float: left;
	margin: 0;
	cursor: pointer;
	padding: 0px 6px;
	height: 31px;
	line-height: 31px;
	border-top: 1px solid #333;
	border-left: 1px solid #333;
	border-bottom: 1px solid #333;
	background-color: #000000;
	color: #ffffff;
	overflow: hidden;
	position: relative;
	text-transform: uppercase;
	font-size: 11px;
    font-weight: 600;
}

.tab_last { border-right: 1px solid #333; }

ul.tabs li:hover {
	background-color: #ffdb57;
	color: #333;
}

ul.tabs li.active {
    background-color: #ffdb57;
    color: #333;
    border-bottom: 1px solid #ffdb57;
    display: block;
}

.tab_container {
	border: 1px solid #ccc;
	border-top: none;
	clear: both;
	float: left;
	width: 100%;
	background: #fff;
	overflow: visible;
}

.tab_content {
	padding: 0px;
	display: none;
}

.tab_drawer_heading { display: none; }

.ct-table, .ct-scroll {
    /*overflow: auto;*/
    overflow: visible;
}

.timesheet_container_div{
    overflow: scroll !important;
    margin-bottom: 100px !important;
}
input.form-control.Green {
    background-color: #0DB10C !important;
}
input.form-control.Amber {
    background-color: #FFA829 !important;
}
input.form-control.Red {
    background-color: #D70000 !important;
}
/*.ct-scroll table tbody tr:nth-child(even),*/
/*.ct-scroll table.inner_table table tbody tr:nth-child(odd){*/
/*    background-color: #f9f9f9;*/
/*}*/
/*table.ct-ag-tb tbody tr:nth-child(even),*/
/*.ct-scroll table.inner_table table tbody tr:nth-child(even){*/
/*    background-color: #fff !important;*/
/*}*/
/*.ct-view-roster table tbody tr:nth-child(even) {*/
/*    background-color: #fff !important;*/
/*}*/
/*.ct-view-roster table tbody tr:nth-child(odd) {*/
/*    background-color: #fff !important;*/
/*}*/
/*.ct-view-roster table .sub-table tbody tr:nth-child(odd) {*/
/*    background-color: #f9f9f9 !important;*/
/*}*/
/*.ctm-roster table tbody tr:nth-child(even) {*/
/*    background-color:#f9f9f9 !important;*/
/*}*/
/*.ctm-roster table tbody tr:nth-child(odd) {*/
/*    background-color: #fff !important;*/
/*}*/

/*.ct-scroll table thead th{*/
/*    background-color: #000;*/
/*	color:#fff;*/
/*}*/
.smallLabel {
    font-size: 10px;
    width: 100%;
    margin-bottom: 0;
    color: #878686;
    font-weight: 500;
}
.smallLabel-inline {
    font-size: 10px;
    margin-bottom: 0;
    color: #878686;
    font-weight: 500;
}
.textfieldlarge.row3 {
    min-height: 163px;
}
.smalldayTitle span{
    font-size:9px;
}
.textfieldlarge.row1 {
    min-height: 32px;
    height: 32px;
}
.textfieldlarge.row2 {
    min-height: 88px;
}
.quipname{
    min-height: 40px;
    display:flex;
    align-items:center;
}
.headCol input{
    font-size: 13px;
}
input.form-control {
    font-size: 14px;
}
.textfieldlarge {
    min-height: 105px;
    padding: 5px;
    font-size: 14px;
    border-radius:0;
}
/*media-queries*/
@media(min-width:768px){
    ul.tabs {
        display: flex;
        justify-content: space-between;
    }
    ul.tabs li {
    	
    	width: 14%;
    }
    li.disable {
        pointer-events: none;
        width: 278px !important;
        min-width: 278px;
    }
    td.headCol {
        width: 250px !important;
        min-width: 250px;
    }
    td.headCol-small {
        width: 130px !important;
        min-width: 130px;
    }
}
@media(max-width: 1280px){
    .quipname{
        min-height: 26px;
    }
    input.form-control {
        font-size: 12px;
        padding: 6px 20px 6px 2px !important;
        height: 28px;
    }
    span.input-group-addon {
        height: 28px !important;
    }
    .textfieldlarge {
        min-height: 95px;
        font-size:13px;
    }
    .smalldayTitle span {
        font-size: 8px;
    }
   
}
@media(max-width: 1280px){
    ul.tabs li {
        font-size: 11px;
    }
    li.disable {
        pointer-events: none;
        width: 200px !important;
        min-width: 200px;
    }
    td.headCol{
        width: 200px !important;
        min-width: 200px;
    }
    td.headCol-small {
        width: 175px !important;
        min-width: 175px;
    }
}
@media screen and (max-width: 767px) {
	.tabs {
		display: none;
	}
	.tab_drawer_heading {
		background-color: #000000;
		color: #fff;
		border-top: 1px solid #333;
		margin: 0;
		padding: 5px 20px;
		display: block;
		cursor: pointer;
		font-size: 20px;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.d_active {
		background-color: #ffdb57;
		color: #000000;
	}
	
}
@media (min-width: 1024.1px){
.page-content-inner {
    margin-top: 45px;
}
}
@media(max-width: 1024px){
    .main-content {
        padding-top: 82px;
    }
    [data-layout=horizontal] .menu .navbar-menu {
    display: block;
    max-height: 100vh;
    overflow-y: auto;
    padding-left: 0;
    position: fixed;
    left: 0;
    top: 60px;
}
[data-layout=horizontal] .menu .navbar-menu .navbar-nav>li:nth-of-type(2)>.nav-link.menu-link {
    padding: .75rem 19px .75rem 15px;
}
.topbar-user .dropdown-menu-end.show {
    display: block;
}
.card-header .row {
    display: flex;
    flex-wrap: nowrap;
    width: 100%;
    max-width: 100%;
    justify-content: space-between;
}
.card-header .row * {
    width: auto;
}
th.sort {
    padding-right: 28px;
}
}
td.menubtns-width {
    width: 92px;
}
.input-group .form-control.date .input-group-addon {
    cursor: pointer;
}
body {
    font-family: "Inter",sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #f2f2f7;
}
*{
     font-family: "Inter",sans-serif;
}
.btn {
    font-size: 13px;
}
.navbar-menu .navbar-nav .nav-sm .nav-link {
    font-size: 13px;
}
.dropdown-header{
    font-size:13px;
}
.btn {
    white-space: normal;
}
.input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon{
    width: 1%;
    white-space: nowrap;
    vertical-align: middle;
}
.input-group-addon span.glyphicon {
    top: 50%;
    right: 6px;
    transform: translateY(-50%);
    cursor: pointer;
}
.dataTables_wrapper ul.pagination {
    justify-content: end;
}
.active>.page-link, .page-link.active {
    background-color: rgb(47,156,219);
    border-color: rgb(47,156,219);
}
table.dataTable > thead .sorting:before, table.dataTable > thead .sorting_asc:before, table.dataTable > thead .sorting_asc_disabled:before, table.dataTable > thead .sorting_desc:before, table.dataTable > thead .sorting_desc_disabled:before {
    right: 0.8rem;
}
table.dataTable > thead .sorting:after, table.dataTable > thead .sorting_asc:after, table.dataTable > thead .sorting_asc_disabled:after, table.dataTable > thead .sorting_desc:after, table.dataTable > thead .sorting_desc_disabled:after {
    right: 0.8rem;
}
.dataTables_length select.form-select {
    width: 77px;
    margin: 0 5px;
}   
td.dataTables_empty {
    display: none !important;
}
.table-card td.sort, .table-card th.sort{
    padding-right: 25px;
}
.table thead th, .table thead td {
    font-size: 12px;
    font-weight: 600;
}
td.innerTableColumn {
    border: 0;
}
table {
    border-color: #e9ebec;
}
.weekdays-cols{
    width:100px;
    min-width:100px;
    max-width:100px;
}
.weekdays-cols-data input {
    padding: 4px !important;
    font-size:12px;
}
@media(min-width: 600px){
    #customerTable_length label {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    div#customerTable_filter label {
        display: flex;
        align-items: center;
    }
    input.form-control.form-control-sm {
        width: 200px;
        margin: 0 5px;
    }
    div#customerTable_wrapper>.row:first-child {
        flex-direction: row-reverse;
    }
}
@media(min-width:1024px){
    .table-responsive {
        overflow-x: hidden;
    }
    
}
@media(max-width:767px){
    table#customerTable {
        width: 780px;
    }
}
</style>
<script>
$(document).ready(function(){
    $("#topnav-hamburger-icon").click(function(){
        
        $("body").toggleClass('menu');
    });
});
</script>
</head>
<body>
	<!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <?php   $role = $this->session->userdata('role'); if($role=='employee') { ?>
                    <a href="<?php echo base_url(); ?>index.php/general/dashboard" class="logo logo-dark">
                        <?php }else{ ?>
                    <a href="<?php echo base_url(); ?>index.php/general" class="logo logo-dark">
                        <?php } ?>
                        <span class="logo-sm">
                            <img src="<?php echo base_url() ?>images/image1.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>images/image1.png" alt="" height="25">
                        </span>
                    </a>

                    
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

            </div>
            <div class="app-menu navbar-menu">
             <div id="scrollbar">
                <div class="">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <?php 
                            if(!empty($menus)){  
                            $user_id = $this->session->userdata('user_id');
                           $countmenu=1;
                            $userlevel = $this->session->userdata('clearance_level');
                            foreach($menus as $menu){ 
                              
                        
                            if($this->session->userdata('role') != 'Prep Area'){
                        ?>
                        <li class="nav-item">
                            <?php if(!empty($menu->submenus)){ ?>
                            <a class="nav-link menu-link" href="#sidebar_<?php echo $countmenu;?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <span class="d-flex"><span data-key="t-dashboards" class="fs-12"><?php echo Strtoupper($menu->description); ?></span></span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebar_<?php echo $countmenu;?>">
                                <ul class="nav nav-sm flex-column">
                                    <?php foreach($menu->submenus as $submenu){  ?>
                     
                                    <?php 
                                    if($user_id == 265 || $user_id == 266){ 
                                    if(($submenu->submenu_id != 45 && $submenu->submenu_id != 57 )){ ?>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link" data-key="t-analytics"> <?php echo $submenu->description; ?> </a>
                                    </li>
                                     <?php } } else{ ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link" data-key="t-crm"> <?php echo $submenu->description; ?> </a>
                                    </li>
                                         
                                    <?php } ?>
                                      
                                        <?php }  ?>
                                   
                                </ul>
                            </div>
                            <?php  }else { ?>
                            <a class="nav-link menu-link" href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>">
                                <span class="d-flex"> <span data-key="t-dashboards" class="fs-12"><?php echo Strtoupper($menu->description); ?></span></span>
                            </a>
                            <?php } }?>
                            
                           
                        </li> <!-- end Dashboard Menu -->
                         <?php $countmenu++; } } ?>
                        

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
            <div class="d-flex align-items-center">
                <ul  class="navbar-nav dropdown ms-sm-3 header-item topbar-user">
                    <li class="nav-item">
                           
                            <a class="nav-link menu-link" href="#userDropdown" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <span class="d-flex align-items-center">
                                    <i class="bx bxs-user-circle fs-24"></i>
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $this->session->userdata('username');?></span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><i class="mdi mdi-google-maps fs-12"></i> <?php echo $this->session->userdata('branch_name');?></span>
                                    </span>
                                </span>
                            </a>
                            <div class="collapse menu-dropdown dropdown-menu-end" id="userDropdown">
                                <ul class="nav nav-sm flex-column p-3">
                                  
                                    <li class="nav-item">
                                        <h6 class="dropdown-header">Welcome <?php echo $this->session->userdata('username');?>!</h6>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/auth/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                                    
                
            </div>
        </div>
    </div>
</header>
         <!-- ========== App Menu ========== -->
       
        
        
