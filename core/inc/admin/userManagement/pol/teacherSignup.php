<?php
	// did the user just update?
	if (isset($_POST['authType'])) {
	$errors = array();
	$sid = $school['id'];
	$authType = escape($_POST['authType']);
	$whiteEmails = escape($_POST['whiteEmails']);
	$emailUrl = escape($_POST['emailUrl']);

	if ($authType == 2 && strlen($emailUrl) == 0) {
		$errors[] = "Please enter your school URL.";
	}

	if (empty($errors)) {
		$update = good_query("UPDATE schools SET authType = '$authType', whiteEmails='$whiteEmails', emailUrl='$emailUrl'  WHERE id = $sid LIMIT 1");
		echo "1";
	} else { // report the errors
		echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($errors as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}


exit();

}


	// load individual account creation options
	if (isset($_GET['i'])) {
		if ($_GET['i'] == 1) {
			echo '<p style="font-size:14px">
Allow teachers to sign up by using a school email address. All school email addresses <strong>must end</strong> with your website URL.</p>
<div class="infobox" style="text-align:center"><span style="font-size:16px">teachername@<input type="text" id="emailUrl" name="emailUrl" maxlength="100" style="width:200px;font-size:14px" value="' . $school['emailUrl'] . '" /></span></div>
<br />';
		} elseif ($_GET['i'] == 2) {
			echo '<p style="font-size:14px">
Only allow certain email addresses to create teacher accounts.<br /><br />
<strong>Enter list of permitted emails below, separated by commas.</strong><br />
<span style="font-size:10px; color:#666">ex: teacher1@schoolname.edu, teacher2@schoolname.edu, teacher3@schoolname.edu</span><br />
<textarea name="whiteEmails" style="height:100px; width:465px">'  .$school['whiteEmails'] . '</textarea>

</p>';
		} elseif ($_GET['i'] == 3) {
			echo '<p style="font-size:12px">This feature will <strong>block</strong> teachers from <strong>creating accounts</strong> underneath your school.<br />
			This is particularly useful if your school is using single sign on (SSO) authentication; it will disable teachers from accidentally creating duplicate accounts.</p>';
		}

		exit();
	}

	if ($school['authType'] == 1 || $school['authType'] == 2) {
		$check1 = 'checked="checked" ';
		$onLoad = '1';
	} elseif ($school['authType'] == 3) {
		$check2 = 'checked="checked" ';
		$onLoad = '2';
	} elseif ($school['authType'] == 4) {
		$check3 = 'checked="checked" ';
		$onLoad = '3';
	}
	echo '
<div class="headTitle"><img src="' . $imgServer . 'gen/setting.png" style="margin-right:5px;margin-top:3px" /><div>Teacher Signup Policies</div></div>
<div id="content" style="margin:5px">

<script type="text/javascript">

		$( "#jCatch" ).buttonset();
function swapNode(node) {
$.ajax({
   type: "GET",
   url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=1&i="+node,
   success: function(msg){
     $("#opter").html(msg);
   }
 });


}


function updatePolicy() {
        dataString = $("#teach-policy").serialize();


        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">Teacher Policies Updated Successfully!</div>\').slideDown(400).delay(2500).slideUp(400);
         } else {
         	 $("#failer").html(data).slideDown(400);

         }

       }

        });
}


function ieLoad(id) {
	swapNode(id);
}


 $(document).ready(function(){
swapNode(' . $onLoad . ');
 })
	</script>

<div id="failer" style="display:none"></div>
<span style="font-size: 20px;padding-left:5px">Account Creation</span><br />
<form id="teach-policy" method="POST">
<div id="jCatch">
		<input type="radio" id="radio1" onClick="ieLoad(1)" name="authType" value="2" ' . $check1 . '/><label for="radio1">Require School Email</label>
		<input type="radio" id="radio2" onClick="ieLoad(2)" name="authType" value="3" ' . $check2 . '/><label for="radio2">Set Permitted Emails</label>
		<input type="radio" id="radio3" onClick="ieLoad(3)" name="authType" value="4" ' . $check3 . '/><label for="radio3">Account Creation Disabled</label><br />
		<div id="opter"></div>
	</div>
	<div style="display:none"><input type="password" name="pass" /></div>
</form>


<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox(); return false" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="updatePolicy(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Save Teacher Policies</a></div>

</div>';

?>
