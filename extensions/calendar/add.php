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

// if form posted
if (isset($_POST['submitted'])) {
	$start_date = $_POST['start_date'] . ' ' . $_POST['start_hour'] . ':' . $_POST['start_minute'] . $_POST['start_shift'];
	$end_date = $_POST['end_date'] . ' ' . $_POST['end_hour'] . ':' . $_POST['end_minute'] . $_POST['end_shift'];
	$attempt = createEntry($_POST['title'], $_POST['body'], 1, $_POST['type'], $class_id, $start_date, $end_date);
	if (is_numeric($attempt)) {
	// detect css class type
	if ($_POST['type'] == 1) {
		$class = 'asmtEvent';
	} elseif ($_POST['type'] == 2) {
		$class = 'projEvent';
	} elseif ($_POST['type'] == 3) {
		$class = 'testEvent';
	} elseif ($_POST['type'] == 4) {
		$class = 'eventEvent';
	}
	
		echo '<script>
		$(document).ready(function() {
		$(\'#calendar\').fullCalendar(\'renderEvent\',
						{
							id: ' . $attempt . ',
							title: "' . htmlentities($_POST['title']) . '",
							start: new Date(' . date("Y", strtotime($start_date)) . ', ' . (date("n", strtotime($start_date)) - 1) . ', ' . date("j", strtotime($start_date)) . ', ' . date("H", strtotime($start_date)) . ', ' . date("i", strtotime($start_date)) . '),
							end: new Date(' . date("Y", strtotime($end_date)) . ', ' . (date("n", strtotime($end_date)) - 1) . ', ' . date("j", strtotime($end_date)) . ', ' . date("H", strtotime($end_date)) . ', ' . date("i", strtotime($end_date)) . '),
							allDay: ';
							
							// if it's an all day event
							if (date("H", strtotime($end_date)) == '00' && date("H", strtotime($start_date)) == '00') {
								echo 'true';
							} else {
								echo 'false';
							}
							
						echo ',
className: "' . $class . '" 
}
					);
					closeBox();
		});
					</script>';
	} else {
		echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
	exit();
}


// init unix timestamp
$start = strtotime($_GET['start']);
$start_date = date('m/d/Y', $start);
$start_hour = date('g', $start);
$start_min = date('i', $start);
$start_shift = date('a', $start);

$end = strtotime($_GET['end']);
$end_date = date('m/d/Y', $end);
$end_hour = date('g', $end);
$end_min = date('i', $end);
$end_shift = date('a', $end);

// create time array
$hours = '1,2,3,4,5,6,7,8,9,10,11,12';
$hour_arr = explode(',', $hours);
// minutes array
$minutes = '00,30';
$min_arr = explode(',', $minutes);
// am pm array
$shift = 'am,pm';
$shift_arr = explode(',', $shift);

if ($start_hour == 12 && $end_hour == 12) {
	$display_tog = ';display:none';
} else {
	$display_tog = '';
}

// begin output!
echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_cal.png" style="margin-right:7px;margin-top:5px" /><div>Add Calendar Entry</div></div>
<div id="failer" style="display:none; margin: 5px"></div>
<div id="content" style="margin:5px; font-size:14px">
<form method="POST" id="add-entry">
<strong>Title</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<div id="opted" style="float:right"><a onClick="showDesc()">Add Description...</a></div><input type="text" style="width:215px" name="title" />


<div id="descr" style="display:none; margin-top:10px">
<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:300px"></textarea>
</div>
<div id="radio" style="padding-top:10px; margin-top:10px; border-top:2px solid #ccc; margin-bottom:15px">
<div style="font-size:10px; float:right">
		<input type="radio" id="radio1" name="type" value="1" checked="checked" /><label for="radio1">Assignment</label>
		<input type="radio" id="radio2" name="type" value="2" /><label for="radio2">Project</label>
		<input type="radio" id="radio3" name="type" value="3" /><label for="radio3">Test</label>
		<input type="radio" id="radio4" name="type" value="4" /><label for="radio4">Event</label>
</div>
<strong>Entry Type</strong><span style="color:#dd1100;font-style: bolder">*</span>
</div>';


echo '<div style="padding-top:10px; margin-top:10px; border-top:2px solid #ccc">
<div style="float:right; width:160px; margin-left:10px">
<strong>End</strong> <span style="color:#dd1100;font-style: bolder">*</span><input type="text" name="end_date" id="endpick" style="width:100px; margin-left:7px" value="' . $end_date . '" />

<div id="end_time" style="margin-top:4px' . $display_tog . '">
<strong>At</strong><select name="end_hour" style="margin-left:10px">';

foreach ($hour_arr as $hour) {
	if ($hour == $end_hour) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $hour . '</option>';
}

echo '</select>
<select name="end_minute">';

foreach ($min_arr as $min) {
	if ($min == $end_min) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $min . '</option>';
}

echo '</select>
<select name="end_shift">';

foreach ($shift_arr as $shift) {
	if ($shift == $end_shift) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $shift . '</option>';
}

echo '</select>
</div>

</div>

<div style="float:left; width:165px; border-right:1px solid #ccc">
<strong>Start</strong> <span style="color:#dd1100;font-style: bolder">*</span><input type="text" name="start_date" id="startpick" style="width:100px; margin-left:7px" value="' . $start_date . '" />
<div id="start_time" style="margin-top:4px' . $display_tog . '">
<strong>At</strong><select name="start_hour" style="margin-left:10px">';

foreach ($hour_arr as $hour) {
	if ($hour == $start_hour) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $hour . '</option>';
}

echo '</select>
<select name="start_minute">';

foreach ($min_arr as $min) {
	if ($min == $start_min) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $min . '</option>';
}

echo '</select>
<select name="start_shift">';

foreach ($shift_arr as $shift) {
	if ($shift == $start_shift) {
		$selectMe = ' selected';
	} else {
		$selectMe = '';
	}
	echo '<option' . $selectMe . '>' . $shift . '</option>';
}

echo '</select>
</div>


</div>
</div>

<div style="clear:both"></div>';

if ($start_hour == 12 && $end_hour == 12) {
	echo '<a href="#" class="removeTime" onClick="showTime(); return false">
<div style="background: #e1e1e1; border: 1px solid #999; font-size:14px; padding:7px; margin-top:20px">
<div style="margin-left:120px">
<img src="' . $imgServer . 'gen/time.png" style="float:left; margin-right:5px"/> Add Time
</div>
</div>
</a>';
}

echo '<input type="hidden" name="submitted" value="true" />
</form>
</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="addEntry();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Add Entry</button></div>

<script>
	$(function() {
		$( "#startpick" ).datepicker();
		$( "#endpick" ).datepicker();
		$( "#radio" ).buttonset();
	});

function showDesc() {
	$("#opted").hide();
	$("#descr").show();
}

function showTime() {
	$(".removeTime").hide();
	$("#start_time").show();
	$("#end_time").show();
}


function addEntry() {
		  dataString = $("#add-entry").serialize();
        var hitURL = postToAPI("POST", "add.php", currentApp, ' . $class_id . ', dataString);
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        
         	$("#failer").html(data).slideDown(400);
        
         	 
       }

        });
}
</script>
<div id="exec"></div>';



?>
