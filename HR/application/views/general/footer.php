	<footer class="footer">
		<div id="footer" class="foot-border">
		  <div class="container-fluid">
		    <div class="navbar-header left">
		     	<span> CAFEADMIN @Maintained by AARIA </span>
		      
		      
		    </div>
		    
		    <ul class="nav navbar-nav navbar-right foot-nav">
		      <!--<li><a href="#" data-toggle="modal" data-target="#Modal">For application support please click here</a></li>-->
		      
		      </ul>
		  </div>
		<!--<div class="container-fluid foot-row">-->
		<!--	  	<div class="foot-left">-->
		<!--	  		<p class="text-muted credit">&copy; <?php echo Date('Y'); ?> Skyward One</p>-->
		<!--	  	</div>-->
		<!--	  	<div class="foot-right">-->
		<!--	  		<p class="text-muted credit">Application developed and maintained by Skyward One</p>-->
		<!--	  	</div>-->
		<!--</div>-->
		<div class="gradient"></div>
		
		</div>
	
	</footer>
	
	<style>
 	label.error, label>span{
 		color:red;
 	}
 	.glyphicon.normal-left-spinner {
    -webkit-animation: glyphicon-spin-l 2s infinite linear;
    animation: glyphicon-spin-l 2s infinite linear;
}
@-webkit-keyframes glyphicon-spin-l {
    0% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }

    100% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
}

@keyframes glyphicon-spin-l {
    0% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }

    100% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
}
    </style>
<script>
<?php if($this->session->userdata('role') == 'employee'){ ?>
    $(document).ready(function(){
        
        function checkAuth() {
          $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/checkAuth",
		        
		        success: function(data){
		        	// alert(data);
		        	if(data == 'success'){
		        	    window.location.href = '<?php echo base_url();?>index.php/auth/logout';
		        	}
		        	
		        }
	       });
          setTimeout(function() {checkAuth()}, 50000);
        }
        checkAuth();
    });
    <?php } ?>

      $(".btn").not(".dropdown-toggle,.btn-dark").on('click',function(){
      var title = $(this).html();
      $(this).html('<i class="btn-loader glyphicon glyphicon-repeat normal-left-spinner"></i>');
      $(this).attr("title","Loading....");
      setTimeout(function(){ $('.btn-loader').replaceWith(title); }, 3000);
   
     
  })
 </script>
</body>
</html>