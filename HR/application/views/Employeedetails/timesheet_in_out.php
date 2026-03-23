<div class="container ct-timesheet mt-5" ><div class="row">
<input type="hidden" id="logoutLink" data-href="<?php echo base_url();?>index.php/auth/logout">
<div class="col-5 ct-top mb-3 mt-3">
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
		<?php
	
		$today_date = date("d-m-Y");
		if (strtotime($today_date) >= strtotime($start) && strtotime($today_date) <= strtotime($end)) {
		    $selected="selected";
		}else{
		    $selected = "";
		}
		?>
		<option <?php echo $selected; ?> value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
		<?php }  }} ?>
		
      </select>
      </form>
      </div>
    </div>
</div>
<div class="col-4 ct-top mt-4">
    <button onclick="RefreshLocalStorge()" class=" btn-success ">Refresh</button>
    </div>
<div class="col-3 ct-top mt-3">
    <label class="control-label"><b>Search Employee</b></label>
    <input type="text" id="employee_search" class="form-control" placeholder="Search Employee Name...">
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
            <td class="monday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="tuesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="wednesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="thursday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="friday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="saturday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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
            <td class="sunday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
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

 <div class="modal fade" id="pinModal" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog" style="width:420px;margin-top:10%;">
      <div class="modal-content" style="border-radius:8px;border:none;box-shadow:0 8px 30px rgba(0,0,0,0.12);overflow:hidden;">
        <div class="modal-header" style="text-align:center;border-bottom:1px solid #f1f1f1;padding:18px 20px;position:relative;">
          <button type="button" class="close" onclick="closeModal('pinModal')" data-dismiss="modal" style="position:absolute;right:20px;top:18px;font-size:20px;color:#999;opacity:1;">&times;</button>
          <h4 class="modal-title" style="font-weight:700;font-size:18px;color:#1A1C20;margin:0;">Enter Your Pin Number</h4>
        </div>
        <div class="modal-body" style="padding:30px 40px;text-align:center;background:#fff;">
          <p style="color:#888;font-size:14px;margin-bottom:20px;">Please enter your 4-digit security PIN to log your attendance.</p>
          <input type="password" id="employee_pin_entered" name="employee_pin" maxlength="4" autocomplete="new-password" placeholder="••••" style="width:100%;max-width:240px;text-align:center;font-size:28px;font-weight:700;letter-spacing:0.8em;padding:14px 10px;border:2px solid #22C55E;border-radius:8px;outline:none;background:#F8FAFC;color:#1A1C20;display:block;margin:0 auto;">
          <input type="hidden" id="pin_emp_id">
          <input type="hidden" id="rosterID_emp">
          <input type="hidden" id="type_empclick">
          <input type="hidden" id="outletname_emp">
          <input type="hidden" id="objectreference">
          <input type="hidden" id="current_in_time">
          <input type="hidden" id="current_pin_time">
        </div>
        <div class="modal-footer" style="border-top:1px solid #f1f1f1;background:#f9fafb;padding:18px 40px;text-align:center;">
          <button type="button" onclick="verify_pin()" class="btn btn-success btn-ph" id="pin_submit" data-dismiss="modal" style="width:100%;max-width:240px;background:#22C55E;border:none;color:#fff;font-weight:600;padding:12px 20px;border-radius:8px;font-size:16px;box-shadow:0 4px 14px rgba(34,197,94,0.39);margin:0 auto;display:block;">Verify</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="myModal" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="closeModal('myModal')" class="close" data-dismiss="modal">&times;</button>
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
  
  
  
   <div class="modal fade" id="clockout" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="closeModal('clockout')" class="close" data-dismiss="modal">&times;</button>
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
  
  
  
   <div class="modal fade" id="break_time" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="closeModal('break_time')" data-dismiss="modal">&times;</button>
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
  
  
  <div class="modal fade" id="break_out_time" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="closeModal('break_out_time')" data-dismiss="modal">&times;</button>
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
    //   setInterval(function() {
    //               window.location.reload();
    //   }, 60000); 
  var requestInProgress = false;

  // Auto-reload at 1:00 AM daily so new timesheets (e.g. created Friday night) appear on Monday
  (function scheduleAutoReload() {
      var now = new Date();
      var target = new Date(now);
      target.setHours(1, 0, 0, 0);
      if (target <= now) {
          target.setDate(target.getDate() + 1);
      }
      var ms = target - now;
      setTimeout(function() {
          window.location.reload();
      }, ms);
  })();
  
  function show_modal(modal_id,emp_id,obj,roster_id,outletname=''){
      if(requestInProgress) return;
      
       $("."+modal_id).val(emp_id+'_'+outletname);
      $("#"+modal_id).show();
     
      var new_class_to_enable = $(obj).attr('class');
      $(".unique_roster_id").val(roster_id);
      $("#current_in_time").val(new_class_to_enable);
      $("#breaktime_class").val(new_class_to_enable);
      $("#break_in_time,#break_out_time,#display_in_time,#display_out_time").val('');
  }
  function closeModal(modal_id){
    $("#"+modal_id).hide();  
  }
  
  function show_pin_modal(type,emp_id,class_to_enable,rosterID,outletname){
      if(requestInProgress) return;
      
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
     if(requestInProgress) return;
     requestInProgress = true;
     $("#pin_submit").prop('disabled', true);
     
     var emp_id= $("#pin_emp_id").val();
      var rosterID_emp= $("#rosterID_emp").val();
      var type_empclick= $("#type_empclick").val();
      var outletname_emp= $("#outletname_emp").val();
       console.log("e==t  -> " + type_empclick);
      
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
        
        if(type_empclick=="break_out_time" || type_empclick=="break_in_time"){
            
            save_break_record(type_empclick,rosterID_emp,emp_id);
        }else{
            save_record(type_empclick,rosterID_emp,emp_id,outletname_emp);
        }
        
	        }else if(data=='sessionexpired'){
	            requestInProgress = false;
	            $("#pin_submit").prop('disabled', false);
	            window.location='<?php echo base_url('index.php/auth/login/timesheet'); ?>'
	            
	            }else{
	            requestInProgress = false;
	            $("#pin_submit").prop('disabled', false);
	            swal({
          text: "Incorrect Pin, Please contact your adminstrator.",
          icon: "warning",
          }); 
	        }

			},
		error:function(){
		    requestInProgress = false;
		    $("#pin_submit").prop('disabled', false);
		    swal({ text: "Network error. PIN verification failed. Please check your connection and try again.", icon: "error" });
		}
	});
  }
  
  function revertCellSwap(){
      var cls_icon = $("#current_in_time").val();
      var cls_pin = $("#current_pin_time").val();
      if(cls_icon) $("." + cls_icon).hide();
      if(cls_pin) $("." + cls_pin).show();
  }
  
  function save_record(classname,roster_id,emp_id,outletname){
      
     
     
    //   var time = $(obj).val();
    if(classname == "myModal"){
         setTime_in_time();
          var time = $("#in_time").val();
           var type = "in_time";
    }else if(classname == "clockout"){
        setTime_out_time();
          var time = $("#out_time").val();
          var type = "out_time";
    }
   
   
    //   var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
    //   var outletname = $("#outletname").val();
      
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_record",
		method:"POST",
		data:{in_time:time,type:type,emp_id:emp_id,roster_group_id:roster_group_id,outletname:outletname,roster_id:roster_id},
	    success:function(response){
	        requestInProgress = false;
	        $("#pin_submit").prop('disabled', false);
	        if(response =='sessionexpired'){
	            revertCellSwap();
	            swal({ text: "Your session has expired. Please login again.", icon: "error" }).then(function(){ window.location.href = "<?php echo base_url();?>index.php/auth/homepage"; });
	            return;
	        }else if(response =='Early'){
	            revertCellSwap();
	             swal({
          text: "Login time not must not exceed 15 mins as per your rosterd time.Please Try again in some time.",
          icon: "warning",
           timer: 3300
          });
	        }else if(response =='already_recorded'){
	            revertCellSwap();
	            swal({ text: "This time entry has already been recorded.", icon: "warning" });
	        }else if(response =='on_break'){
	            revertCellSwap();
	            swal({ text: "You are currently on break. Please end your break before clocking out.", icon: "warning" });
	        }else if(response =='saved'){
	         $class_to_enable = $("#current_in_time").val();
	         $("."+$class_to_enable).html('');
	         $("."+$class_to_enable).removeAttr('data-toggle');
	         
	         if($("#out_time").val() !=''){
	           $("."+$class_to_enable).html($("#out_time").val());  
	         }else{
	            $("."+$class_to_enable).html($("#in_time").val());
	         }
	         
		  swal({
          text: "Time Recorded Successfully",
          icon: "success",
           timer: 1300
          });
	        }else{
	            revertCellSwap();
	            swal({ text: "Failed to save time. Please try again.", icon: "error" });
	        }
			},
		error:function(){
		    requestInProgress = false;
		    $("#pin_submit").prop('disabled', false);
		    revertCellSwap();
		    swal({ text: "Network error. Time was NOT saved. Please check your connection and try again.", icon: "error" });
		}
	});
  }
  
  function save_break_record(break_type,roster_id,emp_id){
       
     
      var break_time = getTimeStamp_in_time();
   
      var roster_group_id = $("#roster_list").val();
     
      var current_class = $("#current_in_time").val();
      var $el_to_update = $("."+ current_class);
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_break_record",
		method:"POST",
		data:{break_time:break_time,break_type:break_type,roster_group_id:roster_group_id,roster_id:roster_id,emp_id:emp_id},
	    success:function(data){
	        requestInProgress = false;
	        $("#pin_submit").prop('disabled', false);
	        if(data =='sessionexpired'){
	            revertCellSwap();
	            swal({ text: "Your session has expired. Please login again.", icon: "error" }).then(function(){ window.location.href = "<?php echo base_url();?>index.php/auth/homepage"; });
	            return;
	        }else if(data =='already_recorded'){
	            revertCellSwap();
	            swal({ text: "This break time has already been recorded.", icon: "warning" });
	        }else if(data =='saved'){
	            $el_to_update.html(break_time);
	            $el_to_update.removeAttr('data-toggle');
			swal({
              text: "Break Time Recorded Successfully",
              icon: "success",
              timer: 1300
              });
	        }else{
	            revertCellSwap();
	            swal({ text: "Failed to save break time. Please try again.", icon: "error" });
	        }
			},
		error:function(){
		    requestInProgress = false;
		    $("#pin_submit").prop('disabled', false);
		    revertCellSwap();
		    swal({ text: "Network error. Break time was NOT saved. Please check your connection and try again.", icon: "error" });
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
<script>
$('#employee_search').on('keyup', function(){
    var val = $(this).val().toLowerCase();
    $('.parent_row').each(function(){
        var name = $(this).find('td:first').text().toLowerCase();
        $(this).toggle(name.indexOf(val) > -1);
    });
});
</script>
<script>
  
    
    window.onload = function() {
        reloadAfterTenHrs();
        startSessionCheck();
    };
    
    function reloadAfterTenHrs() {
        
    let timeUntilReload = 10 * 60 * 60 * 1000;
    
    setTimeout(function() {
    localStorage.removeItem("formSubmitted");    
     location.reload();
    }, timeUntilReload);
 }

function RefreshLocalStorge(){
   localStorage.removeItem("formSubmitted"); 
   setTimeout(function(){
    location.reload();   
   },2000)
}

var sessionExpired = false;
function startSessionCheck(){
    setInterval(function(){
        if(sessionExpired) return;
        $.ajax({
            url: "<?php echo base_url();?>index.php/Employeedetails/check_session_alive",
            method: "POST",
            timeout: 5000,
            success: function(data){
                if(data.trim() === 'expired'){
                    sessionExpired = true;
                    showSessionExpiredOverlay();
                }
            }
        });
    }, 30000);
}

function showSessionExpiredOverlay(){
    // Disable all clickable elements
    $('.parent_row td').off('click').removeAttr('onclick').removeAttr('data-toggle').removeAttr('data-target');
    $('.btn').prop('disabled', true);
    // Close any open modals
    $('.modal').modal('hide');
    // Show full-screen overlay
    $('body').append(
        '<div id="session-expired-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.75);z-index:99999;display:flex;align-items:center;justify-content:center;">' +
        '<div style="background:#fff;border-radius:12px;padding:40px 50px;text-align:center;box-shadow:0 8px 30px rgba(0,0,0,0.3);">' +
        '<h3 style="color:#dc3545;margin-bottom:15px;">Session Expired</h3>' +
        '<p style="color:#555;font-size:16px;margin-bottom:25px;">You have been logged out from another tab.<br>Time recording is disabled until you log in again.</p>' +
        '<button onclick="window.location.href=\'' + $("#logoutLink").data("href") + '\'" class="btn btn-success" style="padding:12px 30px;font-size:16px;border-radius:8px;">Log In Again</button>' +
        '</div></div>'
    );
}
</script>


