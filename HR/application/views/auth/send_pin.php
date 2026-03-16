<style>
.control-group {
    margin-bottom: 8px;
}

#find_emp {
display: block;
    width: 115px;
    height: 32px;
    background: #4ea6af;
    padding: 4px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    line-height: 25px;
}
#message_box{
    
    background: #03A9F4;
    height: 34px;
    opacity: 0.9;
    border: 1px solid;
    text-align: center;
    padding: 5px;
    width: 350px;
    font-weight: 600;
    border-radius: 17px;
    font-size: 16px;
}
</style>
<div class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Send PIN</h3>
			</span>
		</div>
	
	</div>
<div class="container content">
    <div id='loader' style='display: none;'>
  <img src="<?php echo base_url() ?>images/ajax-loader.gif" width='32px' height='32px'>
</div>
<br/>
<div class="col-md-4"> 
<div class="Userpanel">
      <div class="Userpanel-body">
      <p id="message_box" style="display:none">Email has been sent successfully</p>
      <form action="#"  class="form-horizontal" id="form_find_emp">
       <div class="control-group">
          <label class="control-label">Email</label>
          <div class="controls">
            <input type="text" name="employee_email" id="email" class ='form-control'  placeholder="Enter Email">
          </div>
        </div>
        
        
        
       
        <div class="form-actions">
            
           <a href="#" id="find_emp" onclick="find_emp_id()" >Send Pin</a>
        </div>
      </form>
  </div>
  </div>
  </div>
</div> 
<style type="text/css">
  label.error{
    color:red;
  }
</style>
<script type="text/javascript">

function find_emp_id(){
    	var form = $("#form_find_emp");
	    var formdata =  form.serialize();
	   
		 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/admin/send_pin_email",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
                 success: function(response){
                     
                     if(response=="Sent"){
                     $("#emp_id").val('');
                      $("#find_emp").html(" ");
                    
                     $("#message_box").css("display","block");
                     setTimeout(function() { $("#message_box").css("display","none"); }, 1000);
                      
                     }
                     
                 }
		 });
                 
                 
                 
    
}
 
</script>