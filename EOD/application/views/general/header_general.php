<!DOCTYPE html> 
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>EOD</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    
    <script src="<?php echo base_url('haccap/assets/js/jquery-1.9.1.min.js'); ?>"></script>
    
   
    
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Layout config Js -->
    <script src="<?php echo base_url(""); ?>haccp-assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url(""); ?>haccp-assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(""); ?>haccp-assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?php echo base_url(""); ?>haccp-assets/css/custom.css" rel="stylesheet" type="text/css" />-->
	<!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(""); ?>haccp-assets/libs/multi.js/multi.min.css" />
    <!-- autocomplete css -->
    <link rel="stylesheet" href="<?php echo base_url(""); ?>haccp-assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">
	
<style>
    .txt-uppercase{
        text-transform: uppercase;
    }
    table thead th, table thead th {
        text-transform: capitalize;
    }
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
        color: #f36422 !important;
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
	border: 1px solid #333;
	border-top: none;
	clear: both;
	float: left;
	width: 100%;
	background: #fff;
	overflow: auto;
}

.tab_content {
	padding: 0px;
	display: none;
}

.tab_drawer_heading { display: none; }

.ct-table, .ct-scroll {
    overflow: auto;
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
.ct-scroll table tbody tr:nth-child(even),
.ct-scroll table.inner_table table tbody tr:nth-child(odd){
    background-color: #f9f9f9;
}
table.ct-ag-tb tbody tr:nth-child(even),
.ct-scroll table.inner_table table tbody tr:nth-child(even){
    background-color: #fff !important;
}
.ct-view-roster table tbody tr:nth-child(even) {
    background-color: #fff !important;
}
.ct-view-roster table tbody tr:nth-child(odd) {
    background-color: #fff !important;
}
.ct-view-roster table .sub-table tbody tr:nth-child(odd) {
    background-color: #f9f9f9 !important;
}
.ctm-roster table tbody tr:nth-child(even) {
    background-color:#f9f9f9 !important;
}
.ctm-roster table tbody tr:nth-child(odd) {
    background-color: #fff !important;
}

.ct-scroll table thead th{
    background-color: #000;
	color:#fff;
}
.smallLabel {
    font-size: 10px;
    width: 100%;
    margin-bottom: 0;
    color: #a3a3a3;
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
    min-height: 52px;
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
label {
    font-weight: 600;
    text-transform: capitalize;
}
td.menuinput-width {
    padding: 5px;
}
/*media-queries*/
@media(min-width:768px){
   ul.tabs {
    display: flex;
    justify-content: flex-start;
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
    width: 278px !important;
    min-width: 278px;
}
td.headCol-small {
    width: 190px !important;
    min-width: 190px;
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
                            <img src="<?php echo base_url() ?>haccp-assets/images/logo/image1.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>haccp-assets/images/logo/image1.png" alt="" height="25">
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
                              
                            if($menu->role != 'disabled'){
                            if($this->session->userdata('role') != 'Prep Area'){
                        ?>
                        <li class="nav-item">
                            <?php if(!empty($menu->submenus)){ ?>
                            <a class="nav-link menu-link" href="#sidebar_<?php echo $countmenu;?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <span class="d-flex"><span data-key="t-dashboards" class="fs-12"><?php echo strtoupper($menu->description ?? ''); ?></span></span>
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
                                <span class="d-flex"> <span data-key="t-dashboards" class="fs-12"><?php echo strtoupper($menu->description ?? ''); ?></span></span>
                            </a>
                            <?php } }?>
                            
                           
                        </li> <!-- end Dashboard Menu -->
                         <?php $countmenu++; } } } ?>
                        

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
                                        <?php $parts = explode(" ", $this->session->userdata('username') ?? '');
                                        $firstName = $parts[0];
                                        ?>
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $firstName;?></span>
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
       
        
        
