<?php
// if a new school POST has been attempted
if (isset($_POST['classKey'])) { 

$authCode = checkCode($_POST['classKey']);
if ($authCode != false) {
	$enroll = enrollStudent($user_id, $authCode['id']);

	if ($enroll == true) {
		
		// check if this student is already part of the school
		if (checkSchoolLink($authCode['sid']) == false) {
			// add them as a student
			$attempt = createSchoolUser('', 1, $user_id, $authCode['sid'], 2);
		}
		setSession($user_id);
		echo "1";
	} else {
		echo '<div class="errorbox" style="margin:5px; text-align: center; font-weight: bolder">You are already enrolled in this class.</div>';
	}
} else { // code not found 
	echo '<div class="errorbox" style="margin:5px; text-align: center; font-weight: bolder">Invalid Class Code.</div>';
	
}


exit();
} // end POST add school

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_l.png" style="margin-right:5px;margin-top:2px" /><div>Enroll In A Class</div></div>
<div id="failer" style="margin-bottom:10px"></div>
<div id="content" style="margin:5px">
	<span style="font-size:14px">Please enter your <strong>class code</strong> given to you by your teacher.</span><br /><br />
	<form method="POST" id="class-code-signup">

<div class="infobox">	
<strong>Class Code</strong><br />
<input type="text" name="classKey" id="classKey" style="width:255px" /><br />
<span style="font-size:12px; font-style: italic; color: #666">10 digit code. <strong>ex: 1sd8hhv9zz</strong>
<div style="display:none"><input type="password" name="pass" /></div>
</div>

</form></div>';

echo '<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="submitCode()" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Enroll In Class</a></div>

<script>
$( "#jCatch" ).buttonset();


function submitCode() {
        dataString = $("#class-code-signup").serialize();

        $.ajax({
        type: "POST",
        url: "manage-classes.cc?n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
        			$("#content").slideUp(300);
               $("#failer").html(\'<div class="successbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Enrolled In Class Successfully!  <a href="#" onClick="addAnother();">Add another class.</a></div>\').slideDown(400);
               $("#bottom").html(\'<a href="manage-classes.php" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a>\').slideDown(400);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}


function addAnother() {
	$("#failer").slideUp(300);
	$("#content").slideDown(300);
	$("#classKey").val("");
	$("#bottom").html(\'<a href="manage-classes.php" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="submitCode();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />Enroll In Class</a>\').slideDown(400);
}
</script>';


?>