<?php require_once 'db.php'; ?>
<?php 
    // Pagination code
    $per_page_record = 8;
     if (isset($_GET["page"])) {    
     $page  = $_GET["page"];    
        }else {    
    $page=1;
        }
      $start_from = ($page-1) * $per_page_record;
      $sql = "select c.*,cb.branch_name as location_name from careers c left join customer_branches cb on c.branch_id  =  cb.branch_id where c.status = 1 LIMIT $start_from, $per_page_record";
    $job_posts = $con->query($sql);
  ?>
  <title>Careers</title>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  
	<link rel="stylesheet" href="/Careers/css/main.css" type="text/css" media="all"/>
	<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>
<div class="carousel-inner" style="height: 300px !important;margin-top: -22px">
    <div class="item slides active">
      <div class="slide-bg slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>We are hiring</h1>        
           
        </hgroup>
      
      </div>
    </div>
  <button type="button" class="btn btn-primary btn-banner" data-toggle="modal" data-target="#exampleModal">HR Complaints/Reports</button>
  </div> 
</div>
<div class="fluid-container" style="margin-top: 60px;">
         <div class="row">
              <div><a href="https://www.cafeadmin.com.au/"><button type="button" class="btn btn-primary btn-arrow-left">Back</button>   
              </a>
              
              </div>
                  <div class="col">
                        <h3 style="text-align:center"><b>APPLY NOW</b></h3></br>
        <div class="panel panel-default">
           
			 			<div class="panel-body">
			 			  
			    		<form role="form" method="POST" action="save_application.php" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" required placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" required placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    		

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="mobile" id="mobile" class="form-control input-sm" required  placeholder="Mobile No.">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" required placeholder="Email Address">
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
			    				  <div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<select name="branch_id" class="form-control input-sm" required>
			    						      <option>Select location</option> 
			    						    <option value="48">Bendigo</option> 
			    						    <option value="60">Canterbury</option>  
			    						    <option value="49">Footscray</option>
			    						     <option value="54">Fairfield</option>
			    						     <option value="57">Ipswich</option>
			    						     <option value="58">Northshore</option>
			    						    <option value="55">RPA</option>
			    						   <option value="56">Redcliffe</option>
			    						   <option value="59">Westmead</option>
			    						   <option value="52">Williamstown</option>
			    						</select>
			    					</div>
			    				</div>
			    				
			    				 <div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="experience" id="experience" required class="form-control input-sm" placeholder="Experience Years">
			    					</div>
			    				</div>
			    			</div>
			    				<div class="row">
			    				    <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    					<textarea row="3" name="education" id="education" required class="form-control input-sm" placeholder="Education"></textarea>
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
			    				  	<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label> Attach CV</label>
			    				<input type="file" name="resume" id="resume" class="form-control input-sm" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label> Attach Supportive documents</label>
			    				<input type="file" name="docs" id="docs" class="form-control input-sm">
			    					</div>
			    				</div>
			    			</div>	  
			    			
			    			
			    			<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <p>
                <img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA">
                <a href="#" onclick="this.previousElementSibling.src='captcha.php?'+Math.random(); return false;">Refresh</a>
            </p>
            <input type="text" name="captcha" class="form-control input-sm" required placeholder="Enter CAPTCHA">
            <small style="color:red">Please enter the digits shown above</small>
        </div>
    </div>
</div>

			    			<input type="submit" value="Apply" class="btn btn-info btn-block" style="background-color:#125E76">
			    		</form>
			    	
	    		</div>
            </div>
            </div>
                 <div class="col">
                       <h3 style="text-align:center"><b>VACANCIES</b></h3></br>
                <div class="col-lg-10 mx-auto">
                    <div class="career-search mb-60">

                      

                        <div class="filter-result">
                          
   <?php if ($job_posts->num_rows > 0) { 
   while($row = $job_posts->fetch_assoc()) { ?>
                            <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                                <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                  
                                    <div class="job-content">
                                      
                                    <p> <i class="zmdi zmdi-pin mr-2"></i> <?php echo $row["location_name"]; ?></p>
                                    <p><b><?php echo $row["job_name"]; ?></b></p>
                                      <p>Start Date : <?php echo date('d-m-Y',strtotime($row["start_date"])); ?></p>
                                      </div>
                                </div>
                                <div class="job-right my-4 flex-shrink-0">
                                    <a href="job_description.php?id=<?php echo $row["id"]; ?>" class="btn d-block w-100 d-sm-inline-block btn-light" >View</a>
                                </div>
                            </div>
<?php } } ?>
                     
                        </div>
                    </div>
<?php 
$query = "SELECT COUNT(*) FROM careers";     
        $rs_result = mysqli_query($con, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
 $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";   
        echo "<nav aria-label='Page navigation example'><ul class='pagination'>";
  if($page>=2){   
            echo "<li class='page-item'><a class='page-link' href='index.php?page=".($page-1)."'>  Prev </a><li>";   
        }   
          for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<li class='page-item'><a class='page-link active' href='index.php?page="  
                                                .$i."'>".$i." </a><li>";   
          }               
          else  {   
              $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>   
                                                ".$i." </a><li>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<li class='page-item'><a class='page-link' href='index.php?page=".($page+1)."'>  Next </a><li>";   
        } 
         echo "</ul></nav>";
?>
                   
                    <!-- END Pagination -->
                </div>
                </div>
               
             </div>

        </div>
        
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <div> <h5 class="modal-title" id="exampleModalLabel">HR Complaints/Reports</h5>
       <p>If you are experiencing any issues or would like to give a feedback, please submit your message. The information will be private and confidential.</p></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<form role="form" method="POST" action="save_complaint.php" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" required placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" required placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    		

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="mobile" id="mobile" class="form-control input-sm" required  placeholder="Mobile No.">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" required placeholder="Email Address">
			    			</div>
			    				</div>
			    			</div>
			    		    <div class="row">
			    				  <div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<select name="branch_id" class="form-control input-sm" required>
			    						      <option>Select location</option> 
			    						    <option value="48">Bendigo</option> 
			    						    <option value="60">Canterbury</option>  
			    						    <option value="49">Footscray</option>
			    						     <option value="54">Fairfield</option>
			    						     <option value="57">Ipswich</option>
			    						     <option value="58">Northshore</option>
			    						    <option value="55">RPA</option>
			    						   <option value="56">Redcliffe</option>
			    						   <option value="59">Westmead</option>
			    						   <option value="52">Williamstown</option>
			    						</select>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<textarea name="message" id="message" class="form-control input-sm" required  placeholder="Message"></textarea>
			    					</div>
			    				</div>
			    				
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
                                        <p><input type="text" size="6" maxlength="5" name="captcha" value=""><br>
                                        <small style="color:red">Please copy the digits</small></p>
			    					</div>
			    				</div>
			    				
			    			</div>
			    			 
			    			 
			    			  
			    			<input type="submit" value="Submit" id="submit_form" class="btn btn-info btn-block" style="background-color:#125E76">
			    		</form>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>
 <?php if(isset($_GET['success'])) {
     if($_GET['success']=='success1'){
        $msg = "Thank you for applying with us, we will get back to you shortly";
        $icon = "success";
        }
        else if($_GET['success']=='success2'){
            $msg = "Thank you for submitting your Feedback, we will get back to you shortly";
            $icon = "success";
        }
        else if($_GET['success']=='fileerror'){
         $msg = "Your file was not uploaded.Please try again";
         $icon = "warning";
        }else{
         $msg = "Form not submitted";
         $icon = "warning";
        }  
        ?>
        <script>
	    swal({
         text: '<?php echo $msg ?>',
         icon: '<?php echo $icon ?>',
          }).then((value) => {
          
          window.location = "https://www.cafeadmin.com.au/Careers/";
           
    });</script>
<?php }  ?>
<script>
     $("#submit_form").on('click',function(){
    var captch_value = $("[name='captcha']").val();
    if(captch_value == '') {
      alert('Please enter the four digit number for authentication');
      $("[name='captcha']").focus();
      return false;
    }
   
});
</script>
