<?php
$sid = $school['id'];
// load pages
if (isset($_GET['n']) && is_numeric($_GET['n'])) {
	
	if ($_GET['n'] == 1) {
		if (isset($_POST['name'])) {
		$throw = createGP($sid, $_POST['name'], $_POST['start'], $_POST['end']);
		if ($throw == 1) {
			echo "1";
		} else {
			echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($throw as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
		}
		exit();	
		}
		
	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_l.png" style="margin-right:5px;margin-top:2px" /><div>Create New Grading Period</div></div>
<div id="content" style="margin:5px">
	<div id="failer" style="display:none"></div>
<form method="POST" id="create-gp" style="font-size:14px; padding-top:3px">

<div style="width:220px;float:left">
<strong>Grading Period Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">Example: 1st Semester Fall 2011</span>
</div>

<div style="width:240px; float:right">
<strong>Start / End Dates</strong><br />
<input type="text" name="start" id="startpick" style="width:100px" /> to <input type="text" name="end" id="endpick" style="width:100px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">Start and end dates are not required. You must manually end grading periods if dates are not provided.</span>
</div>

<div style="display:none"><input type="password" name="saget" /></div>
<br /><br/>
</form>

<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="createGP();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />Create Grading Period</a></div>

</div>';

echo '
<script>
	$(function() {
		$( "#startpick" ).datepicker();
		$( "#endpick" ).datepicker();
	});
	</script>


<script type="text/javascript">
// function for submitting the school signup form
function createGP() {
        dataString = $("#create-gp").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=12&n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#content").html(\'<div class="successbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Grading Period Created Successfully!</div>\').slideDown(400);
               setTimeout("closeBox(); swapPage(12)" , 2200);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}
</script>';
} elseif ($_GET['n'] == 2) {
		if (isset($_POST['name'])) {
		$throw = updateGP($_GET['gid'], $sid, $_POST['name'], $_POST['start'], $_POST['end']);
		if ($throw == 1) {
			echo "1";
		} else {
			echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($throw as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
		}
		exit();	
		}
		
	$gPer = getGP($_GET['gid']);
	if ($gPer != false) {	
	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/update.png" style="margin-right:7px;margin-top:5px" /><div>Update Grading Period</div></div>
<div id="content" style="margin:5px">
	<div id="failer" style="display:none"></div>
<form method="POST" id="create-gp" style="font-size:14px; padding-top:3px">

<div style="width:220px;float:left">
<strong>Grading Period Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" value="' . $gPer['name'] . '" /><br />
<span style="font-size:9px; font-style: italic; color: #666">Example: 1st Semester Fall 2011</span>
</div>

<div style="width:240px; float:right">
<strong>Start / End Dates</strong><br />
<input type="text" name="start" id="startpick" style="width:100px" value="' . formatGP($gPer['start']) . '" /> to <input type="text" name="end" id="endpick" style="width:100px" value="' . formatGP($gPer['end']) . '" /><br />
<span style="font-size:9px; font-style: italic; color: #666">Start and end dates are not required. You must manually end grading periods if dates are not provided.</span>
</div>

<div style="display:none"><input type="password" name="saget" /></div>
<br /><br/>
</form>

<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="createGP();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />Update Grading Period</a></div>

</div>';

echo '
<script>
	$(function() {
		$( "#startpick" ).datepicker();
		$( "#endpick" ).datepicker();
	});
	</script>


<script type="text/javascript">
// function for submitting the school signup form
function createGP() {
        dataString = $("#create-gp").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=12&n=2&gid=' . $_GET['gid'] . '",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#content").html(\'<div class="successbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Grading Period Updated Successfully!</div>\').slideDown(400);
               setTimeout("closeBox(); swapPage(12)" , 2200);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}
</script>';
} // gper not = false
	

} // n ==

exit();
}


?>

<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Grading Periods</strong></div>

<div style="width:450px; float:left; margin-right: 10px">

<script>
	$(function() {
		$( "#accordion" ).accordion({ active: 1, autoHeight: false });
	});
	</script>





<div id="accordion">
	<h3><a href="#">Past Grading Periods</a></h3>
	<div>
	<?php
	$getGP = getGPs($sid, 1);
	foreach ($getGP as $period) {
		echo '<div style="padding-bottom:5px;padding-top:5px; border-bottom: 1px solid #ccc"><span style="float:right; color: #999">' . formatGP($period['start']) . ' - ' . formatGP($period['end']) . '</span>' . $period['name'] . ' <a href="#" style="color:#ff0000" onClick="openBox(\'school-admin.cc?id=' . $school['id'] . '&s=12&n=2&gid=' . $period['id'] . '\', 500)">(manage)</a></div>';
	}
	if (empty($getGP)) {
		echo '<div style="margin-top:5px; margin-bottom:5px; color: #666">Unable to find any past grading periods.</div>';
	}
	?>
	</div>
	
	
	<h3><a href="#">Current Grading Periods</a></h3>
	<div>
	<?php
	$getGP = getGPs($sid, 2);
	foreach ($getGP as $period) {
		echo '<div style="padding-bottom:5px;padding-top:5px; border-bottom: 1px solid #ccc"><span style="float:right; color: #999">' . formatGP($period['start']) . ' - ' . formatGP($period['end']) . '</span>' . $period['name'] . ' <a href="#" style="color:#ff0000" onClick="openBox(\'school-admin.cc?id=' . $school['id'] . '&s=12&n=2&gid=' . $period['id'] . '\', 500)">(manage)</a></div>';
	}
	if (empty($getGP)) {
		echo '<div style="margin-top:5px; margin-bottom:5px; color: #666">Unable to find any current grading periods.</div>';
	}
	?>
	</div>
	
	
	<h3><a href="#">Future Grading Periods</a></h3>
	<div>
	<?php
	$getGP = getGPs($sid, 3);
	foreach ($getGP as $period) {
		echo '<div style="padding-bottom:5px;padding-top:5px; border-bottom: 1px solid #ccc"><span style="float:right; color: #999">' . formatGP($period['start']) . ' - ' . formatGP($period['end']) . '</span>' . $period['name'] . ' <a href="#" style="color:#ff0000" onClick="openBox(\'school-admin.cc?id=' . $school['id'] . '&s=12&n=2&gid=' . $period['id'] . '\', 500)">(manage)</a></div>';
	}
	if (empty($getGP)) {
		echo '<div style="margin-top:5px; margin-bottom:5px; color: #666">Unable to find any future grading periods.</div>';
	}
	?>
	</div>
</div>


</div>
<a href="#" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=12&n=1', 500)" class="button"><img src="<?php echo $imgServer; ?>gen/add.png" /> Create Grading Period</a>