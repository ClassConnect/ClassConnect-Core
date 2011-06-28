<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');


echo '<cc:crumbs>Calendar</cc:crumbs>
<script type="text/javascript" src="' . $scriptServer . 'cal/fullcalendar.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
	
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$(\'#calendar\').fullCalendar({
			
			header: {
				left: \'prev,next today\',
				center: \'title\',
				right: \'month,agendaWeek,agendaDay\'
			},';
	if ($class_level == 3) {		
	echo 'selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var start1 = new Date(start);
				var start_hour = start1.getHours();
				var start_min = start1.getMinutes();
				var start_day = start1.getDate();
				var start_year = start1.getFullYear();
				var start_month = start1.getMonth() + 1;
				
				var end1 = new Date(end);
				var end_hour = end1.getHours();
				var end_min = end1.getMinutes();
				var end_day = end1.getDate();
				var end_year = end1.getFullYear();
				var end_month = end1.getMonth() + 1;
				
				openBox("class-fs.cc?cid=' . $class_id . '&id=" + currentApp + "&page=' . urlencode('add.php?start=') . '" + escape(start_month + "/" + start_day + "/" + start_year + " " + start_hour + ":" + start_min) + "' . urlencode('&end=') . '" + escape(end_month + "/" + end_day + "/" + end_year + " " + end_hour + ":" + end_min), 350);
				
			},
			
			eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view) {
				var hitURL = postToAPI("POST", "shiftEvent.php", currentApp, ' . $class_id . ', "eid=" + event.id + "&shiftDay=" + dayDelta + "&shiftMin=" + minuteDelta + "&allDay=" + allDay);
				$.ajax({
        			type: "GET",
       			url: hitURL,
        			success: function(data) {
        				if (data == 2) {
        					revertFunc();
        				} 
        			}
        		});
        		
			},
			
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) {

       var hitURL = postToAPI("POST", "resizeEvent.php", currentApp, ' . $class_id . ', "eid=" + event.id + "&shiftDay=" + dayDelta + "&shiftMin=" + minuteDelta);
				$.ajax({
        			type: "GET",
       			url: hitURL,
        			success: function(data) {
        				if (data == 2) {
        					revertFunc();
        				} 
        			}
        		});

        },
			
			editable: true,';
	} else {
		echo 'editable: false,';
	}
	echo 'eventClick: function(calEvent, jsEvent, view) {

        var hitURL = postToAPI("POST", "viewEvent.php", currentApp, ' . $class_id . ', "eid=" + calEvent.id);
			openBox(hitURL, 350);
    },
	
	
	
	events: "extensions/calendar/loadFeed.php?cid=' . $class_id . '",
			loading: function(bool) {
				if (bool) {
					$("#navcrumbs").html($("#navcrumbs").html() + " <img id=\"loadImg\" src=\"core/site_img/loading.gif\" style=\"height:18px\" />");
				} else {
					$(\'#loadImg\').remove();
				}
			}
			
		});
';
  if ($class_level == 3){
     echo ' $(\'span:contains(today)\').parents(\'td\').filter(\':first\').after(\'<td style="padding-left:10px" onClick="sync()"><div class="fc-state-default fc-corner-left fc-corner-right"><a id="datepicker-link" href="#" onClick="return false;"><span>sync calendars</span></a></td>\');';
  }
echo '});

function sync() {
openBox(\'/app/extensions/calendar/sync.php?cid=' . $class_id . '\', 420);
}
</script>
<style type="text/css">

	#calendar {
		width: 740px;
		margin: 0 auto;
		}

</style>
</div>

<div style="margin-left:10px">
<div id="calendar"></div>
</div>
<br /><br /><br />
<div>
';
/*<a href="#2_level/asmt.php" onClick="changePage(2, \'level/asmt.php\')">View assignment, eh?</a>*/
?>