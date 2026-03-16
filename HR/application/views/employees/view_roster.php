
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/fullcalendar/fullcalendar.min.css">
<script type="text/javascript" src="<?php echo base_url(""); ?>assets/fullcalendar/lib/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fullcalendar/lib/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar.min.js"></script>
<script>

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "<?php echo base_url(); ?>index.php/admin/get_emp_roster/<?php echo $emp_id; ?>",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Enter Start time and End time:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var emp_id = <?php echo $emp_id; ?>;
                $.ajax({
                    url: '<?php echo base_url();?>index.php/admin/insert_roster',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&emp_id=' + emp_id,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
			
            if (deleteMsg) {				
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>index.php/admin/delete_roster",
                    data: "&id=" + event.id,
                    success: function (response) {
						//alert(response);
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

<style>

#calendar {
    width: 600px;
    margin: 0 auto;
}

.response {
    height: 40px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>
</head>
<div style="margin-bottom:0px;" class="col-md-12 page-head border-bottom">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<span class="text-center">
				
			</span>
		</div>
		<div class="btn-div col-md-3">
					<a href="<?php echo base_url();?>index.php/admin/roster_emp_table">
						<button type="button"  class="btn btn-ph btn-ph-cancel">BACK</button>
					</a>
		</div>
	</div><!--.col-md-12 -->
			
<div style="background-color:#fff;" class="container-fluid main-container">
	<div class="col-md-12">

		<div class="row">
		<div class="col-md-12">
	        	<div class="panel pn">
	        		<div class="gradient"></div>

	          		<div class="panel-body">
					     
						<div class="response"></div>
                       <div id='calendar'></div>
	          		</div>
        		</div>
				</div>
	        </div>
		
		</div>
	</div>



</html>