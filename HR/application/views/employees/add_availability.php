
<div class="container">
    <?php $dayName = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun'); ?>
      <?php $dayNamelabel = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
      <form method="post" action="<?php echo base_url() ?>index.php/employees/add_availability" class="availability_form">
    <div class="card">
  <h5 class="card-header">Add Your Availability ( <?php echo $Mondate ?> To <?php echo $Sundate ?> )
  </br>
  <small style="color:black">
      Please check the checkboxes for the days you are available and please mention the times available in the comments section (Example 9am-6pm).
      </small>
      <button type="submit"  class="btn btn-success btn-ph" style="float: right;">Update</button>
  </h5>
  <div class="card-body">
      <?php if($success_message !='') {  ?>
         <a href="#" class="badge badge-danger hide_aftr_sometime" style="width: 68%;background-color: #32b64f;"><?php echo $success_message; ?></a>
      <?php } ?>
   
            
      <?php for($day = 0; $day < 7; $day++) {  ?>
         <div class="row day_wise_row">
       <div class="col-10">
           <div class="row">
               
        <div class="col-2 for_pd"> 
           <b><?php  echo $dayNamelabel[$day]; ?></b>
        </div>
            
        <div class="col-2 for_pd"> 
         <div class="form-check">
            <?php if($emp_availability[$dayName[$day].'_avail'] =='') {  ?>
            <input class="form-check-input" name="<?php  echo $dayName[$day]; ?>_avail" type="checkbox"  value="<?php echo ${$dayName[$day].'date'}; ?>">
            <?php }else{ ?>
            <input class="form-check-input" name="<?php  echo $dayName[$day]; ?>_avail" type="checkbox" checked="checked" value="<?php echo ${$dayName[$day].'date'}; ?>">
            <?php } ?>
           
        </div>
        </div>
         
       <div class="col-6 for_pd"> 
        <div class="form-group">
        <?php if($emp_availability[$dayName[$day].'_comment'] !='') {  ?>
          <input type="text" class="form-control" name="<?php  echo $dayName[$day]; ?>_comment" value="<?php echo $emp_availability[$dayName[$day].'_comment']; ?>">
            <?php }else{ ?>
          <input type="text" class="form-control" name="<?php  echo $dayName[$day]; ?>_comment" placeholder="Comments">
            <?php } ?>    
        </div>
       </div>
       
       </div>
     </div>  
  </div>
      <?php } ?>
      <input type="hidden" name="EmpId" value="<?php echo $employeeID; ?>">
    
    
    
   
  </div>
</div>
 </form>
</div>
<script>
setInterval(()=> {  $(".hide_aftr_sometime").fadeOut(); }, 1500);

</script>
<style>
.for_pd{
    padding-top: 22px;
}
.mleft{
        margin-left: -3px;
    margin-bottom: 30px;
}
.input_width{
        width: 53% !important;
}
.input_design{
    border :none;
    box-shadow :none;
}
.availability_form{
  margin-bottom: 30px;  
}
.day_wise_row{
    height: 60px;
}
.btn{
    padding-top: 3px;
}
</style>

