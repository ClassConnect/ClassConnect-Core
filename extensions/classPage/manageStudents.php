<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

// if this is a teacher of the class
if ($class_level == 3) {

if (isset($_GET['p'])) {
	// reset password
	if ($_GET['p'] == 1) {
		$tuser_id = escape($_GET['uid']);
		
		// new password submitted
		if (isset($_POST['saget'])) {
			
		if ($_POST['pass'] != '' && authClassStudent($class_id, $tuser_id) != false) {
		$password = escape($_POST['pass']);
		setPassword($tuser_id, $password);
		sendPasswordEmail($tuser_id);
		echo '1';
		exit();	
		} else {
			// error msg here
			echo '';
			exit();
		}
		
		}
		
		echo '<div class="headTitle"><img src="' . $imgServer . 'gen/update.png" style="margin-right:5px;margin-top:5px" /><div>Reset Password</div></div>
<div id="failer" style="display:none;margin-top:1px;margin-left:1px;margin-right:1px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">

<form method="POST" id="update-pswd" style="font-size:14px; padding-top:3px">
<strong>New Password</strong><br />
<input type="text" name="pass" style="width:215px" />
<div style="display:none"><input type="password" name="saget" value="sag" /></div>
</form>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="resetPass();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Reset Password</button></div>



<script type="text/javascript">
// function for submitting the school signup form
function resetPass() {
		  dataString = $("#update-pswd").serialize();
        var hitURL = postToAPI("POST", "manageStudents.php?p=1&uid=' . $tuser_id . '", "1", ' . $class_id . ', dataString);
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        	if (data == 1) {
        		$("#content").html(\'<div class="successbox" style="text-align:center; font-weight: bolder">Password Reset Successfully!</div>\');
        		$("#bottom").html(\'<button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button>\');
        	}
               
       }

        });
        
        
        
        
}
</script>';
	} elseif ($_GET['p'] == 2) {
		$tuser_id = escape($_GET['uid']);
		$studentInfo = getUser($tuser_id);
		
		// new password submitted
		if (isset($_POST['saget'])) {
			
		if (authClassStudent($class_id, $tuser_id) != false) {
		deleteEnrollment($tuser_id, $class_id);
		echo '1';
		exit();	
		} else {
			// error msg here
			echo '';
			exit();
		}
		
		}
		
		echo '<div class="headTitle"><img src="' . $imgServer . 'gen/delCircle.png" style="margin-right:5px;margin-top:3px" /><div>Remove From Class</div></div>
<div id="failer" style="display:none;margin-top:1px;margin-left:1px;margin-right:1px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">

<form method="POST" id="update-pswd" style="font-size:14px; padding-top:3px">
Are you sure you want to remove ' . $studentInfo['first_name'] . ' ' . $studentInfo['last_name'] . ' from this class?
<div style="display:none"><input type="password" name="saget" value="sag" /></div>
</form>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="removeStudent();" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Confirm Removal</button></div>



<script type="text/javascript">
// function for submitting the school signup form
function removeStudent() {
		  dataString = $("#update-pswd").serialize();
        var hitURL = postToAPI("POST", "manageStudents.php?p=2&uid=' . $tuser_id . '", "1", ' . $class_id . ', dataString);
        $.ajax({
        type: "GET",
        url: hitURL,
        success: function(data) {
        	if (data == 1) {
        		$("#content").html(\'<div class="successbox" style="text-align:center; font-weight: bolder">Student Removed Successfully</div>\');
        		$("#bottom").html(\'<button class="button" type="submit" onClick="updateClose();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button>\');
        	}
               
       }

        });
        
        
        
        
}



function updateClose() {
	 changePage(currentApp, \'manageStudents.php\');
	 closeBox();
}
</script>';
		
		
		
	}

exit();
}



echo '<cc:crumbs><a href="#1" onclick="selectApp(1)">{className}</a>{crumbSplit}Manage Students</cc:crumbs>';

$students = getClassStudents($class_id, 1);

foreach ($students as $student) {
	echo '<div style="height:26px; border-bottom: 1px solid #efefef; margin-top:5px; padding:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder; padding-left:5px">' . $student['first_name'] . ' ' . $student['last_name'] . '</span>
</div>

<div style="float:right">
<a href="manageStudents.php?p=1&uid=' . $student['id'] . '" class="button" target="dialog" width="250"><img src="' . $imgServer . 'gen/resend.png" />Reset Password</a>
<a href="manageStudents.php?p=2&uid=' . $student['id'] . '" class="button" target="dialog" width="300"><img src="' . $imgServer . 'gen/cross.png" />Remove From Class</a>
</div>


</div>';
	
}

if (empty($students)) {
	echo '<div style="height:26px; border-bottom: 1px solid #ccc; margin-top:5px; padding:5px; font-size:14px; text-align:center">

You currently have no students in this class. Give your students the <a href="classCode.php" target="dialog" width="300">class access code</a> to sign up.


</div>';
	
}






}
// end teacher check
?>