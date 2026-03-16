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

<div class="container content">
  
<br/>
<div class="col-md-4">  
  <p id="message_box" style="display:none">Order Status Updated successfully</p>
  <form action="#"  class="form-horizontal" id="modifyOrderStatus">
   <div class="control-group">
      <label class="control-label">Order No</label>
      <div class="controls">
        <input type="text" name="order_number" id="order_number" class ='form-control'  placeholder="Enter Purchase order number">
      </div>
    </div>
    
    
     <div class="control-group emp_id_show">
      <label class="control-label">Select Order Status</label>
      <div class="controls">
        <select name="order_status" class="table-select app-select ct-app-select" style="width: 100% !important;">
            <option value="Sent">Sent </option>
            <option value="Viewed">Viewed </option>
            <option value="Confirmed">Confirmed </option>
           <option value="Received">Received </option>
            </select>
      </div>
    </div>
   
    <div class="form-actions">
        
       <a href="#" id="find_emp" onclick="modifyOrderStatus()" >Update </a>
    </div>
  </form>
  </div>
</div> 
<style type="text/css">
  label.error{
    color:red;
  }
</style>
<script type="text/javascript">

function modifyOrderStatus(){
    	var form = $("#modifyOrderStatus");
	    var formdata =  form.serialize();
	   
		 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/orders/modifyOrderStatus",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
                 success: function(response){
                     
                     if(response=="success"){
                  
                     $("#message_box").css("display","block");
                     setTimeout(function() { $("#message_box").css("display","none"); }, 1000);
                      
                     }else{
                  
                     }
                     
                 }
		 });
                 
                 
                 
    
}
  $('#form_registration').validate({
    rules:{
     
      email:{
        required:true,
        email:true,
        remote:{type:'post',url:'<?php echo base_url() ?>index.php/auth/email_check',async:false}
      },
      
    },
    messages:{
    
      email:{
        required:"Please Enter Email",
        email:"Invalid Email Id",
        remote :"Email already Exists"
      },
     
    }

  });
</script>