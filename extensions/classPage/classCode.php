<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// if this is a teacher of the class
if ($class_level == 3) {

$classData = getClass($class_id);

if (isset($_POST['saget'])) {
	$newCode = genChash($classData['name'], $classData['sid']);
	
	$update = updateClass($user_id, $class_id, $classData['name'], $classData['descripion'], $newCode, $classData['prof_icon']);
	if ($update == 1) {
		echo $newCode;
	} else {
		// report errors
	}
	exit();
}

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/access.png" style="margin-right:5px;margin-top:5px" /><div>Class Access Code</div></div>
<div id="content" style="margin:5px">

<div id="classKey" class="infobox" style="color:#333; font-size:16px; text-align:center; font-weight:bolder">' . $classData['classKey'] . '</div>
<div style="color:#666; font-size:12px; margin-top:5px">The code listed above must be given to your students in order for them to enroll in your class.<br /><br />Click the "Reset Access Code" button below to disable class signups using the access code above.</div>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/resend.png" />Reset Access Code</button></div>

<script>

function updateClass() {
		  $("#classKey").html($("#classKey").html() + "<img src=\"core/site_img/loading.gif\" height=\"18\" style=\"margin-left:4px\" />");
        var hitURL = postToAPI("POST", "classCode.php", "1", ' . $class_id . ', "saget=1");
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        	
         	$("#classKey").html(data).fadeIn(200);
         	 
       }

        });
}

</script>';


}
// teacher if

?>