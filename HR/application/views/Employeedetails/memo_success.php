<script>
var role_id = "<?php echo $role_id; ?>"
swal({
  
  text: "Do you want to send the mail to all the Employees?",
  
  buttons: {
    
    catch: {
      text: "Send",
      value: "<?php echo $branch_id; ?>",
    }
    
  },
})
.then(value => {
  
             $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/Employeedetails/send_email_to_all_employee",
		        data:'id='+value+'&role_id='+role_id,
		        success: function(data){
		          return true;
		        }
	       });
 
  
})
.then(results => {
  window.location = "<?php echo $link; ?>";
});

</script>