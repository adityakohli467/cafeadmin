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
	
	
	 <script type="text/javascript">	
		$(document).ready(function() {
			//$('#example').DataTable();
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
	</script>
    <script>

	function supplierTags(){
		var obj = JSON.parse('<?php echo json_encode($suppliers);?>');
	  	var availTags = $.map(obj, function (value, key) {
	                return {
	                    label: value.supplier_name,
	                    id: value.supplier_id
	                }
	              });
	 	return availTags;
	}
	function autoSuppliers(availTags,popupId){
  	    $(".supplier").autocomplete({
		    source: availTags,
		    change: function (event, ui){
				if (!ui.item){
					this.value = '';
				}else{
					var supplier_name = ui.item.label;
					this.value = supplier_name;
				}
		    },
	    	select: function (event, ui) {
	        	var supplier_name = ui.item.id;
	            $(this).siblings("input[type='hidden']").val(supplier_name);
	        },
	        appendTo: '#'+popupId
	    });
    }
	
  </script>	
  <script>
  function catIdTags(){
		var obj = JSON.parse('<?php echo json_encode($cat_result);?>');
	  	var catTags = $.map(obj, function (value, key) {
	                return {
	                    label: value.category_name,
	                    id: value.category_id
	                }
	              });
	 	return catTags;
	}
	function autocatId(catTags,popupId){
  	    $(".category").autocomplete({
		    source: catTags,
		    change: function (event, ui){
		      if (!ui.item){
		        this.value = '';
		      }else{
		        var category_name = ui.item.label;
		        this.value = category_name;
		      }
	    	},
	    select: function (event, ui) {
	        	var category_name = ui.item.id;
	            $(this).siblings("input[type='hidden']").val(category_name);
	        },
	        appendTo: '#'+popupId
	    });
    }
  </script>
  <script type="text/javascript">
		function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
		    theEvent.returnValue = false;
		    if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}
	</script>
</head>
<body>
	<div class="gradient"></div>

	<!--navigation-bar-->
		<nav class="navbar nav-border">
		<div class="container">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		      <a class="navbar-brand brand" href="<?php echo base_url(); ?>index.php/general">Pantry</a>
		    </div>
		     <ul class="nav navbar-nav sub-nav" >
		      <!--<li class="active border pad"><a href="<?php echo base_url(); ?>index.php/settings" tabindex="-1">Dashboard</a></li>-->
		      <?php if(!empty($menus)){
		      foreach($menus as $menu){
		      ?>
		      <li class="dropdown border">
		        <a class="dropdown-toggle dp" data-toggle="dropdown" href="<?php echo base_url(); ?>index.php/<?php echo $menu->controller; ?>"><?php echo $menu->description; ?>
		        <span class="caret"></span></a>
		        <?php if(!empty($menu->submenus)){?>
		        <ul class="dropdown-menu">
		        <?php foreach($menu->submenus as $submenu){
		        ?>
		          <li><a href="<?php echo base_url(); ?>index.php/<?php echo $submenu->controller; ?>" tabindex="-1"><?php echo $submenu->description; ?></a></li>
		        
		        <?php }?>
		        </ul>
		        <?php }?>
		      </li>
		      <?php }} ?>
		    
		    </ul>
		    <div class="navbar-header right">
		      <ul class="nav navbar-nav sub-nav">
		      	 <li class="dropdown border">
		        <a class="dropdown-toggle dp" data-toggle="dropdown" href="#">Hi,<?php echo $this->session->userdata('username');?><br><?php echo $this->session->userdata('branch_name');?>
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="<?php echo base_url(); ?>index.php/auth/change_password">Change Password</a></li>
		          <li><a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a></li>
		        </ul>
		      </li>
		      </ul>
		    </div>
		  </div><!--.container-fluid-->
		  </div><!--.container-->
		</nav>
