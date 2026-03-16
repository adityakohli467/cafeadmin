<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>HRM</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
      <!--header menu design -->
   <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/menu_design/css/bootstrap.min.css">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/menu_design/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/menu_design/css/owl.carousel.min.css">
 <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url(""); ?>assets/menu_design/css/style.css">
    <!--end menu design -->   
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
<!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">-->
<!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/html2canvas.min.js"></script>  
  
  <!--<script src="vendor/jquery/jquery-3.2.1.min.js"></script>-->
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>

<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
  <!-- for toggle ON and OFF button the js and css-->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>  
  <script>
  $(document).ready(function(){
  let header = $(".sticky-wrapper").outerHeight();
  var sticky_title = $(".page-head").outerHeight();
  var total_height = parseInt(sticky_title)+90;
  console.log('sticky_title'+sticky_title);
  console.log('total_height'+total_height);
  $('body').css('padding-top',total_height+'px');
  $('.page-head').css('top',header+'px');
  });
  
  $(window).scroll(()=>{var windowTop=$(window).scrollTop();
  
//   windowTop>80?$('.page-head-sticky').addClass('sticky'):$('.page-head-sticky').removeClass('sticky');
  
  let header = $(".sticky-wrapper").outerHeight();
  if(windowTop>80){
      $('.page-head').addClass('isActive');
      $('.page-head').css('top',header+'px');
    } else{
        $('.page-head').removeClass('isActive');
        $('.page-head').css('top','98px');
    }
   
  });
  </script>
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
    
  
  $(document).ready(function() {
    var formSubmitted = localStorage.getItem("formSubmitted");
    if (!formSubmitted) {
        $('#loader-wrapperTS').show();
        // Submit the form and hide the loader once the form submission is complete
        var rosterForm = document.getElementById("roster_list");
        if (rosterForm) {
            rosterForm.form.submit();
        }
        localStorage.setItem("formSubmitted", true);
    }
});

// Hide the loader once all content including images, stylesheets, and scripts are loaded
$(window).on('load', function() {
    $('#loader-wrapperTS').hide();
});
        
  </script>
  
  <style>
   .page-head {
    	z-index: 9900;
    	position:fixed;
    	top:91px;
    	left:0;
    	width: 100%;
    }
    .site-navbar, .sticky-wrapper {
        z-index: 9999;
        position:fixed;
        top:0;
        left:0;
        background-color: #f4f4f4;
    }
    .container.ct-view-roster1,.ctm-roster,.empRosterContainer,.main-container{
        padding-top: 28px;
    }
@media(max-width: 600px){
.page-head {
    display: flex;
    align-items: center;
    justify-content:space-between;
    padding: 10px 15px;
    flex-wrap: wrap;
}

.page-head span {
    text-align: left !important;
    width: 39% !important;
}
.page-head span.extra_icons {
    width: 20% !important;
}
.page-head h3 {
    display: inline-block;
    text-align: left !important;
    font-size: 16px;
    margin: 0;
}
.page-head button{
    padding: 8px 12px !important;
    height: unset;
    display: flex !important;
    align-items: center;
    justify-content: center;
    font-size:14px;
}
.page-head button, .page-head a {
    padding: 6px 8px !important;
    height: unset;
    display: flex !important;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    margin:4px 4px 4px 0;
}
.page-head button span,
.page-head a span{
    display:none;
}
.page-head .container {
    background: unset;
}
table thead th:last-child {
    min-width: 60px !important;
}
.controls.checkboxGroup .checkbox {
    width: 50%;
}
div::empty{
    display:none;
}
.site-mobile-menu {
    top: 0;
    width: 300px;
    position: fixed;
    right: 0;
    z-index: 99999;
}
table .glyphicon,
.page-head button .glyphicon {
    right: unset;
    top: unset;
    
}
.page-head button .glyphicon,
.page-head a .glyphicon {
    font-size: 10px;
    margin-right: 5px;
    /*top: -2px;*/
}
.page-head a .material-icons {
    font-size: 14px;
    margin-right: 5px;
}
.card {
    position: relative;
    top: 15px;
    margin-bottom: 35px !important;
}
.table100.ver2 .rec-leaves td, .table100.ver2 .rec-leaves th , table th{
    min-width: 100px;
    width:100px;
}
#order_filters input.form-control {
    width: 100% !important;
}
a.btn {
    min-width: 50px !important;
}
    }
@media(max-width:414px){
.controls.checkboxGroup .checkbox {
    width: 100%;
}
    }
  </style>
  
  <style>
  #loader-wrapperTS {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7); /* Dimmed background */
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
}

#loaderTS {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #3498db;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  </style>
</head>
  <body>
 
   <div id="loader-wrapperTS">
    <div id="loaderTS"></div>
  </div>

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header id="mainHeader" class="site-navbar js-sticky-header site-navbar-target" role="banner">
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
      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-md-6 d-xl-block">
            <h1 class="mb-0 site-logo">

 <?php   if($role=='employee') { ?>
    <a href="<?php echo base_url(); ?>index.php/general/dashboard"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img><span class="text-primary"></span> </a>

    <?php }else{ ?>
    <a href="<?php echo base_url(); ?>index.php/general"><img style="width: 175px;" src="<?php echo base_url() ?>images/image1.png"></img><span class="text-primary"></span> </a>

      <?php } ?>      
              </h1>
              
              
              
       
          </div>
          <div class="col-6 col-md-6 d-xl-block top-navbar mb-flex">
              <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>
             <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu top-menu js-clone-nav mr-auto d-lg-block mb-flex">
         <li class="dt-menu">
    <a href="<?php echo base_url(); ?>index.php/general" class="nav-link"><span class="material-icons" style="font-size: 20px;">location_on</span> <?php echo $this->session->userdata('branch_name');?></a>
    </li>
 <?php if(!isset($timesheet_login)) {  ?>
     <li class="has-children mb-hide"><a href="#" class="nav-link" data-toggle="dropdown">  <span class="material-icons">notifications</span>
         <span class="badge badge-info" style="background-color: #4caf50;"><?php echo (!empty( $notifications_count[0]['total_count']) ?  $notifications_count[0]['total_count'] : ''); ?></span>
          </a>
          <ul class="dropdown">
               <?php  if(!empty($notifications)) { foreach($notifications as $notification){  ?>
                <li  ><a class="nav-link" href=""><?php  echo $notification->description;    ?></a></li>
            <?php  } } ?>
            </ul>
          </li>
      <?php } ?>        
         <li class="has-children mb-hide"><a href="#" class="nav-link" data-toggle="dropdown">  <span class="material-icons">person</span></a>
          <ul class="dropdown">
                <li><a class="nav-link" href="">Hi <?php echo $this->session->userdata('username');?><br><?php echo $this->session->userdata('branch_name');?></a></li>
              <!-- <li><a href="<?php echo base_url(); ?>index.php/settings/updateDetails">My Details</a></li> -->
              <li><a class="nav-link" href="<?php echo base_url(); ?>index.php/auth/logout">LOGOUT</a></li>
            </ul>
          </li>
                
    
          
              </ul>
            </nav>
          </div>

          <div class="col-12 col-md-12 d-xl-block dt-menu ">
            <nav class="site-navigation position-relative text-right br-top" role="navigation">

              <ul class="site-menu main-nav main-menu js-clone-nav mr-auto d-lg-block <?php echo (!empty($menus) && sizeof($menus) < 4 ? 'small_menu_design' : '') ?>">

<?php 
       if(!empty($menus)){  
       $user_id = $this->session->userdata('user_id');
       $userlevel = $this->session->userdata('clearance_level');
       foreach($menus as $menu){ ?>
       <?php if(!empty($menu->submenus)){ ?>
             <li class="has-children <?php echo (sizeof($menus) < 4 ? 'small_menu_design_items' : '') ?>">
                 <a href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>"   class="nav-link mb-dropdown-menu" data-toggle="dropdown"><?php echo strtoupper($menu->description ?? ''); ?></a> 
                  <ul class="dropdown">
                     <?php foreach($menu->submenus as $submenu){ 
                      if($user_id == 265 || $user_id == 266){ 
            if(($submenu->submenu_id != 45 && $submenu->submenu_id != 57 )){ ?>
              <li><a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link <?php echo $submenu->submenu_id; ?>" ><?php echo $submenu->description; ?></a></li>
            <?php } }else { ?> 
              <li><a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" class="nav-link"><?php echo $submenu->description; ?></a></li>
                    <?php }  } ?> 
                  </ul>
                </li>
                <?php } else { ?>
        <li class="<?php echo (sizeof($menus) < 4 ? 'small_menu_design_items' : '') ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>" class="nav-link"><?php echo strtoupper($menu->description ?? ''); ?></a></li>
             
                <?php } } } ?> 
         
        
                
    
          
              </ul>
            </nav>
          </div>

        </div>
      </div>
      
    </header>

    
    <!--<script src="<?php echo base_url(""); ?>assets/menu_design/js/bootstrap.min.js"></script>-->
    <script src="<?php echo base_url(""); ?>assets/menu_design/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url(""); ?>assets/menu_design/js/main.js"></script>
  </body>
</html>
