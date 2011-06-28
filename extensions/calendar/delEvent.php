<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// if not a teacher
if ($class_level != 3) {
	exit();
}


$eid = escape($_POST['eid']);
// get event data
$eventData = getEvent($eid, $class_id);

// if this event doesn't exist for this class...
if ($eventData == false) {
	exit();
}

// if form posted
if (isset($_POST['submitted'])) {
	delEvent($eid);
	echo '<script>
		$(document).ready(function() {
		$(\'#calendar\').fullCalendar(\'removeEvents\', ' . $eid . ');
		closeBox();
		});
					</script>';
	exit();
}



// begin output!
echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_cal.png" style="margin-right:7px;margin-top:5px" /><div>Delete Calendar Entry</div></div>
<div id="failer" style="display:none; margin: 5px"></div>
<div id="content" style="margin:5px; font-size:14px">
Are you sure you want to delete "' . $eventData['title'] . '"?
</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="delEntry();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Delete Event</button></div>

<script>



function delEntry() {
        var hitURL = postToAPI("POST", "delEvent.php", currentApp, ' . $class_id . ', "eid=' . $eid . '&submitted=true");
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        
         	$("#failer").html(data).slideDown(400);
        
         	 
       }

        });
}
</script>';



?>