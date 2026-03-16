<style>
.uploadBtn{
    margin-left: 20px !important;
    background-color: #510451 !important;
    border: none !important;
}
.custom-file-input{
    padding: 20px !important;
}
.alert{
    padding: 10px !important;
    margin-right: 14px !important;
    margin-top: 20px !important;
}
</style>
<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6 col-xs-6">
			<span class="text-center">
				<h3>OCR Scan</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<a href="<?php echo base_url(); ?>index.php/orders/orderHistory">
				<button type="button"  class="btn btn-ph btn-ph-cancel">Back</button>
			</a>
		</div>
	
	</div><!--.col-md-12 -->
<div class="container-fluid main-container" style="margin-top: 100px;">
    <div class="overlayplaceorder" id='loader'></div>
	<div class="col-md-12">
 <div class="row">
     <div class="col-md-6">
	            
	         <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Instructions</h3>
			        	<p>Please follow the below instrctions to process the OCR scan</p>
			        	<ul>
			        	    <li><b>Step 1: </b> Upload the invoice or take a picture of the invoice with your phone.
			        	    [Please ensure the invoice is completely captured].</li>
			        	    <li>
			        	        <b>Step 2:</b> View Invoice to ensure the complete invoice info is captured in the Step 1
			        	        </li>
			        	         <li>
			        	             <b>Step 3:</b> Click on the OCR Scan button to process the invoice
			        	             </li>
			        	    </ul>
			        </div>
	          		<div class="panel-body">
	          		
			</div>
			</div>	
			</div>	
	        <div class="col-md-6">
	            
	         <div class="panel pn">
	        		<div class="gradient"></div>
			        <div class="panel-heading">
			        	<h3 class="panel-title">Upload Invoice</h3>
			        	<?php if(isset($sucessMsg) && $sucessMsg !== ''){ ?>
			        	<div class="alert alert-success">
                        <strong>Success!</strong> <?php echo $sucessMsg; ?>
                       </div>
                       <?php } ?>
                       <?php if(isset($errorFileUpload) && $errorFileUpload !== ''){ ?>
                      <div class="alert alert-danger">
                       <strong>Failed!</strong><?php echo $errorFileUpload; ?>
			        </div>
			        <?php } ?>
			        </div>
	          		<div class="panel-body">
	          		<div class="form-group">
	          		    <?php if(!isset($sucessMsg) && $sucessMsg == ''){ ?>   
	            <form enctype='multipart/form-data' id="uploadInvForm" action="<?php echo base_url();?>index.php/ocr/uploadInvoiceToLocalSyetm/<?php echo $order_id;?>"   method="post" >
			<div class="custom-file">
            <input type="file" class="custom-file-input" name="invoice" id="customFile" multiple="multiple" >
           <button type="submit" value="Upload" class="btn btn-primary uploadBtn">Upload</button>
          </div>
			</form>
			<?php } ?>
			<?php if(isset($targetFile) && $targetFile !== '' && isset($order_id) && $order_id !== ''){  ?>
			<div style="margin-top:10px;display:flex">
			<a class="btn btn-primary uploadBtn"  href="<?php echo base_url();?>/<?php echo $targetFile; ?>" target="_blank">View Invoice</a>
			<form id="uploadOcrForm" method="post"  action="<?php echo base_url();?>index.php/ocr/UploadApiToOcr/<?php echo $order_id;?>" style="width:30px">
			    <input type="hidden" name="targetFile" value="<?php echo $targetFile; ?>">
			     <button type="submit" value="Upload" class="btn btn-primary uploadBtn"  >OCR Scan</button>
			    </form>
			</div>
			 <?php } ?>
			</div>
			</div>
			</div>	
			</div>	
	        	</div>	
	        	</div>
	        	</div>
	        	<script>
	        	function warningMsg(){
	        	    alert("pl");
	        	}
	        	$(document).ready(function(){
  $("#uploadInvForm").on("submit", function(){
    $("#loader").fadeIn();
  });
   $("#uploadOcrForm").on("submit", function(){
    $("#loader").fadeIn();
  });
});
	        	</script>
	        