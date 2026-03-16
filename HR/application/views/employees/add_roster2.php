<style>
.col-md-1 {
    width: 6.333333%;
}
.form-inline .form-control2 {
	font-family: inherit;
	line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        font-size: 13px;
    border-radius: 3px;
    width: 70px;

}
</style>
	<div class="row item">
			</div>
		
	<div  class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				<h3>Add Employee</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
			<button type="submit" name="contact_submit"  class="btn btn-success btn-ph">Save</button>
					<a href="http://www.sugarinc.in/codiad/workspace/hr/index.php/admin/manage_employee">
						<button type="button"  class="btn btn-ph btn-ph-cancel">Cancel</button>
					</a>
		</div>
	</div><!--.col-md-12 -->
<div class="container">
  
  <form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/submit_roster" enctype="multipart/form-data">
  <div class="row">
    <div class="form-group">
      <label for="pwd">Start Date:</label>
      <input type="text" class="form-control datepicker" placeholder="Enter Start date" name="start_date" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="pwd">End Date:</label>
      <input type="text" class="form-control datepicker" placeholder="Enter End date" name="end_date" autocomplete="off">
    </div>
	</div><br>
	<div class="row">    
	<div class="form-row">
    <div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputCity">
    </div>
    <div class="form-group col-md-1">
      <select id="inputState" class="form-control2">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputZip">
    </div>
	<div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputCity">
    </div>
    <div class="form-group col-md-1">
      <select id="inputState" class="form-control2">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputZip">
    </div>
	<div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputCity">
    </div>
    <div class="form-group col-md-1">
      <select id="inputState" class="form-control2">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputZip">
    </div>
	<div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputCity">
    </div>
    <div class="form-group col-md-1">
      <select id="inputState" class="form-control2">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-1">
      <input type="text" class="form-control2" id="inputZip">
    </div>
	
    </div>
	</div><br>
	<div class="row">
    <div class="form-group">
      <label for="email">Employee:</label>
      <select id="myInput" name="emp_id[]" class="form-control">
	  <option value="">Select</option>
	  <?php foreach($employees as $row){ ?>
	     <option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name; ?></option>
	  <?php } ?>
	  </select>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Monday start time" name="monday_start[]">
	  <input type="text" class="form-control" placeholder="Monday end time" name="monday_end[]">
	  <input type="text" class="form-control" placeholder="Monday break time" name="monday_break[]">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Tuesday start time" name="tuesday_start[]">
	  <input type="text" class="form-control" placeholder="Tuesday end time" name="tuesday_end[]">
	  <input type="text" class="form-control" placeholder="Tuesday break" name="tuesday_break[]">
    </div>
    <span><a  href="" class="add_field_button">Add</a></span>
	</div><br>
	<div class="col-md-12 input_fields_wrap"></div>
	<button type="submit" value="submit">submit</button>
  </form>
</div>
  <br>

<script>
		$(document).ready(function() {
			
		    var max_fields      = 10; //maximum input boxes allowed
		    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		    var add_button      = $(".add_field_button"); //Add button ID
		    
		    var x = 1; //initlal text box count
		    $(add_button).click(function(e){ //on add input button click
		        e.preventDefault();
		        if(x < max_fields){ //max input box allowed
		            x++; //text box increment
		            $(wrapper).append('<div class="row"><label for="email">Employee:</label><select class="form-control" name="emp_id[]"><?php foreach($employees as $row){ ?><option value="<?php echo $row->emp_id; ?>"><?php echo $row->first_name; ?></option><?php } ?></select><input type="text" class="form-control" placeholder="Monday start time" name="monday_start[]"><input type="text" class="form-control" placeholder="Monday end time" name="monday_end[]"><input type="text" class="form-control" placeholder="Monday break time" name="monday_break[]"><input type="text" class="form-control" placeholder="Tuesday start time" name="tuesday_start[]"><input type="text" class="form-control" placeholder="Tuesday end time" name="tuesday_end[]"><input type="text" class="form-control" placeholder="Tuesday break" name="tuesday_break[]"></div>'); //add input box
		        }
		    });
		    
		});
	</script>
	<script type="text/javascript">
	$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d',
	minDate: 0
});
</script>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
</body>
</html>
