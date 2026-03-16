<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="clear-default-text.js"></script>
<div class="container ct-timesheet" ><div class="row">

<div class="col-lg-12 ct-top">
<div class="control-group">
      <label class="control-label"><b>Select Timesheet</b></label>
      <div class="controls">
          <form id="timsheet_form" action="<?php echo base_url();?>index.php/Employeedetails/fetch_employee_for_timsheet" method="post">
       <select name="roster_list" class ='form-control' id="roster_list" onchange="this.form.submit()">
           <option  selected="selected" > Select Timesheet</option>
         <?php if(isset($all_timesheets) && !empty($all_timesheets)) { foreach($all_timesheets as $all_timesheet) {  
          $start = date("d-m-Y", strtotime($all_timesheet->start_date));
          $end = date("d-m-Y", strtotime($all_timesheet->end_date));
         ?>
         
         
        <?php  if($all_timesheet->timesheet_id == $timesheet_id)  { ?>
         <option  selected="selected" value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
		<?php } else { ?>
		<option value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
		<?php }  }} ?>
		
      </select>
      </form>
      </div>
    </div>
</div>
<div class="col-lg-12">

<div class="ct-scroll timesheet_container_div">
<table border="1" class="ct-timeset">
    	
    <thead>
        <tr class="ct-out-header">
            <th>Full Name</th>
            <th>Outlet Name</th>
            <th>MON</th>            <th>TUE</th>            <th>WED</th>            <th>THU</th>            <th>FRI</th>            <th>SAT</th>            <th>SUN</th>
            
        </tr>
    </thead>
    <tbody>
	<!-- First col-->
	<?php if(!empty($all_emps)){ ?>
		<?php foreach($all_emps as $all_emp){ $outlet_name_without_space = str_replace(' ','',$all_emp->outlet_name); 
		if($all_emp->status == "Disable"){
		    continue;
		}
		?>
		
		<tr class="parent_row">
		 
        <td><b><?php echo $all_emp->first_name.' '.$all_emp->last_name;  ?></b><input type="hidden" class="employee_id" value="<?php echo $all_emp->emp_id; ?>">
        </td>
        <td><b><?php echo $all_emp->outlet_name;  ?></b></td>
		<!-- 2nd col-->	
	
		<td>	
			<?php if(date("l") =='Monday') { ?>

       <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
            <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
       <input type="hidden" class="roster_id" value="<?php echo $all_emp->roster_id; ?>">     
        <td  style="display:none" class="monday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
        <td data-toggle="modal" data-target="#pinModal" class="monday_in_pintime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
            <?php } ?>
            
      
           
         <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="monday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="monday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="monday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="monday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
         <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none"  class="monday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="monday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
            
            </tr></tbody>


            </table>
		 <?php } ?>
		</td>
       
	
    <td>
    	<?php if(date("l") =='Tuesday') { ?>        			
  <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="tuesday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="tuesday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
            <?php } ?>
            
          
             
           <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="tuesday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="tuesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="tuesday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="tuesday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none"  class="tuesday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="tuesday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
             <?php } ?>
            
            </tr></tbody>


            </table>
     <?php } ?>
    </td>
	     
	    
        <td>
    <?php if(date("l") =='Wednesday') { ?>
  <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="wednesday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="wednesday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
               <?php } ?>
               
           
            
             <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="wednesday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="wednesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="wednesday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="wednesday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>  
            <td  style="display:none"  class="wednesday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="wednesday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
            <?php } ?>
         
            </tr></tbody>


            </table>
      <?php } ?>
    </td>
	  
        <td>
      <?php if(date("l") =='Thursday') { ?>        
        <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th><th>Break Out</th>	<th>OUT</th></tr></thead><tbody>	<tr>
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="thursday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="thursday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
            <?php } ?>
            
           
             
             <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="thursday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="thursday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="thursday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="thursday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>  
            <td  style="display:none"  class="thursday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="thursday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
             <?php } ?>
              
            </tr></tbody>


            </table>	
         <?php  } ?>	</td>
		<!-- 6th col-->
        <td>	
        <?php if(date("l") =='Friday') { ?>
          <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
            <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="friday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="friday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
            <?php } ?>
             
            
             
              <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="friday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="friday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="friday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="friday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>  
            <td  style="display:none"  class="friday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="friday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
             <?php } ?>
               
               
            </tr></tbody>


            </table>	
        <?php  } ?>
        </td>
		<!-- 7th col-->
        <td>	
        <?php if(date("l") =='Saturday') { ?>
        
          <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            <td  style="display:none" class="saturday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
            <td data-toggle="modal" data-target="#pinModal" class="saturday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
             <?php } ?>
             
          
             
              <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="saturday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="saturday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="saturday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="saturday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
             <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>  
            <td  style="display:none"  class="saturday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="saturday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
             <?php } ?>
           
            </tr></tbody>


            </table>
            
         <?php  } ?>
        </td>
		<!-- 8th col-->
        <td>	
        <?php if(date("l") =='Sunday') { ?>
          <table>	
        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
            <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
            <?php } else { ?>
            
        <td  style="display:none" class="sunday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
        <td data-toggle="modal" data-target="#pinModal" class="sunday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
             <?php } ?>
            
             
              
            <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
            <?php } else { ?>
           <td  style="display:none"  class="sunday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="sunday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
        <?php } ?>
          
         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
           <?php }else{ ?>
            <td  style="display:none"  class="sunday_breaoutktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
            <td class="sunday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
         <?php } ?>
         
         <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
            <?php } else { ?>  
            <td  style="display:none"  class="sunday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
            <td class="sunday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
              <?php } ?>
            
            </tr></tbody>


            </table>
            
         <?php  } ?>
        </td>
    </tr>
    <?php }} ?>
    </tbody>
    
</table></div></div></div></div>
 
</div>

 <div class="modal fade" id="pinModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter Your Pin Number</h4>
        </div>
        <div class="modal-body">
          <p><input type="password" id="employee_pin_entered" name="employee_pin" autocomplete="new-password">
          <input type="hidden" id="pin_emp_id">
          <input type="hidden" id="rosterID_emp">
          <input type="hidden" id="type_empclick">
          <input type="hidden" id="outletname_emp">
          <input type="hidden" id="objectreference">
          
          <input type="hidden" id="current_in_time">
          <input type="hidden" id="current_pin_time"></p>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="verify_pin()" class="btn btn-success btn-ph" id="pin_submit" data-dismiss="modal">Verify</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock In Time</h4>
        </div>
        <div class="modal-body">
          <p><button type="button" onclick="setTime_in_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLOCK IN TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text" id="display_in_time" name="in_time" style="font-size:30px;border:none;width:100%;">
		<input type="hidden" class="unique_roster_id" value="">
        <button type="button" onclick="save_record(this,'myModal')" class="btn btn-success btn-ph" id="in_time" data-dismiss="modal">Save</button>
          <input type="hidden" class="myModal">
         
        </div>
      </div>
    </div>  </div>
  
  
  
   <div class="modal fade" id="clockout" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock Out Time</h4>
        </div>
        <div class="modal-body">
         <p><button type="button" onclick="setTime_out_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLICK OUT TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text"  id="display_out_time" name="out_time" style="font-size:30px;border:none;width:100%">
			<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" id="out_time" onclick="save_record(this,'clockout')">Save</button>
          
           <input type="hidden" class="clockout">
        </div>
      </div>
    </div>
  </div>
  
  
  
   <div class="modal fade" id="break_time" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break In Time </h4>
        </div>
        <div class="modal-body">
        <button type="button" id="break_in" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">IN</button> 
       
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="break_in_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          
          
          <input type="hidden" class="break_time">
          <input type="hidden" id="type" value="break_in_time">
          
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="break_out_time" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break Out Time </h4>
        </div>
        <div class="modal-body">
       
        <button type="button" id="break_out" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">OUT</button>
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="display_break_out_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          <input type="hidden" class="break_time">
          <input type="hidden" id="type"  value="break_out_time">
        </div>
      </div>
    </div>
  </div>
  
  <script>
      setInterval(function() {
                  window.location.reload();
                }, 60000); 
  function show_modal(modal_id,emp_id,obj,roster_id,outletname=''){
      
       $("."+modal_id).val(emp_id+'_'+outletname);
      $("#"+modal_id).show();
     
      var new_class_to_enable = $(obj).attr('class');
      $(".unique_roster_id").val(roster_id);
      $("#current_in_time").val(new_class_to_enable);
      $("#breaktime_class").val(new_class_to_enable);
      $("#break_in_time,#break_out_time,#display_in_time,#display_out_time").val('');
  }
  
  function show_pin_modal(type,emp_id,class_to_enable,rosterID,outletname){
      $("#pin_emp_id").val(emp_id);
      $("#rosterID_emp").val(rosterID);
      $("#type_empclick").val(type);
      $("#outletname_emp").val(outletname);
      
      
      var new_class_to_enable = $(class_to_enable).prev('td').attr('class');
       var new_class_to_disable = $(class_to_enable).attr('class');
       $("#employee_pin_entered").val('');
      $("#current_in_time").val(new_class_to_enable);
       $("#current_pin_time").val(new_class_to_disable);
  }
  
  function verify_pin(){
     var emp_id= $("#pin_emp_id").val();
      var rosterID_emp= $("#rosterID_emp").val();
      var type_empclick= $("#type_empclick").val();
      var outletname_emp= $("#outletname_emp").val();
    
      
     var emp_pin= $("#employee_pin_entered").val();
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/verify_pin",
		method:"POST",
		data:{emp_id:emp_id,emp_pin:emp_pin},
	    success:function(data){
	        if(data=="verified"){
	           $class_to_enable = $("#current_in_time").val();
	           $class_to_disable = $("#current_pin_time").val();
	           $("."+$class_to_enable).show();
	           $("."+$class_to_disable).hide();
	           
	           
	           swal({
          text: "Your Pin has been Verified Succesfully",
          icon: "success",
          timer: 500
          }); 
	        }else{
	            
	            swal({
          text: "Incorrect Pin, Please contact your adminstrator.",
          icon: "warning",
          }); 
	        }

			}
	});
  }
  
  function save_record(obj,classname){
      
      var type = $(obj).attr("id");
      var roster_id = $(obj).prev(".unique_roster_id").val();

      var time = $(obj).val();
      var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
      var outletname = $("#outletname").val();
      
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_record",
		method:"POST",
		data:{in_time:time,type:type,emp_id:emp_id,roster_group_id:roster_group_id,outletname:outletname,roster_id:roster_id},
	    success:function(data){
	         $class_to_enable = $("#current_in_time").val();
	         $("."+$class_to_enable).html('');
	         $("."+$class_to_enable).removeAttr('data-toggle');
	         
	         if($("#out_time").val() !=''){
	           $("."+$class_to_enable).html($("#out_time").val());  
	         }else{
	            $("."+$class_to_enable).html($("#in_time").val());
	         }
	         
		  swal({
          text: "Time Recorded",
          icon: "success",
           timer: 500
          });
			}
	});
  }
  
  function save_break_record(obj,classname,td_class_name){
       
      var roster_id = $(obj).prev(".unique_roster_id").val();
      var break_in_time = $("#break_in_time").val(); 
      console.log(break_in_time);
      if(break_in_time){
       var break_time = $("#break_in_time").val();    
      }else{
          var break_time = $("#display_break_out_time").val(); 
      }
      var break_type = $("#type").val(); 
      var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
       console.log(break_type);
      if(break_type == 'break_out_time'){
         
         c = $("#"+td_class_name).val();
         $("."+$class_to_enable).html($("#display_break_out_time").val()); 
          $("."+$class_to_enable).removeAttr('data-toggle');
         
      }else{
            $("."+$class_to_enable).html($("#break_in_time").val());
            $("."+$class_to_enable).removeAttr('data-toggle');
      }
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_break_record",
		method:"POST",
		data:{break_time:break_time,break_type:break_type,roster_group_id:roster_group_id,roster_id:roster_id},
	    success:function(data){
		swal({
          text: "Break Time Recorded",
          icon: "success",
          timer: 500
          });
			}
			
	});
  }
  

  
  
function getTimeStamp_in_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

function setTime_in_time() {
    $("#display_in_time,#in_time").val(getTimeStamp_in_time()); 
}




function getTimeStamp_out_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

function setTime_out_time() {
    $("#display_out_time,#out_time").val(getTimeStamp_out_time());
}
</script>

<!--  for break time clockin and clokout record -->
  <script>


function breaksetTime_in_time(obj) {
    var id = $(obj).attr("id");
    var id = id+"_time";
  
    if(id =="break_in_time"){
        $("#break_in_time").val(getTimeStamp_in_time());
    }else if(id =="break_out_time"){
      $("#display_break_out_time").val(getTimeStamp_in_time());  
    
      
    }
    
    $("#type").val(id);
}

</script>
<style>
.material-icons{
    cursor: pointer !important;
}
</style>