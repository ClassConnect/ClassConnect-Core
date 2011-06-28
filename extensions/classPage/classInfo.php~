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
	// clean variables
	$name = escape($_POST['name']);
	$body = escape($_POST['body']);
	
	$update = updateClass($user_id, $class_id, $name, $body, $classData['classKey'], $classData['prof_icon']);
	if ($update == 1) {
		echo '1';
	} else {
		// report errors
	}
	exit();
}

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/edit.png" style="margin-right:5px;margin-top:5px" /><div>Update Class Info</div></div>
<div id="failer" style="display:none;margin-top:1px;margin-left:1px;margin-right:1px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">
<form method="POST" id="update-class" style="font-size:14px">

<strong>Class Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" value="' . $classData['name'] . '" /><br /><br />


<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:215px">' . $classData['description'] . '</textarea>

<div style="display:none"><input type="password" name="saget" value="sag" /></div>



</form>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="updateClass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Update Class</button></div>

<script>


function updateClass() {
        dataString = $("#update-class").serialize();
        var hitURL = postToAPI("POST", "classInfo.php", "1", ' . $class_id . ', dataString);
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        	if (data == 1) {
        		$.ajax({
        		type: "GET",
        		url: "extensions/core/setSession.php",
        		success: function(data2) {
        		
        		
        		
        			$("#content").slideUp(300);
               $("#failer").html(\'<div class="successbox" style="margin-top:2px; margin-bottom:3px; text-align:center; font-weight:bolder">Class Updated Successfully!</div>\').slideDown(400);
               $("#bottom").html(\'<a href="class.cc?id=' . $class_id . '" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a>\').slideDown(400);
               
            }
            
            });   
               
               
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}

</script>';


}
// teacher if

?>