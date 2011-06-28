<?php
	// did the user just update?
	if (isset($_POST['studAuth'])) {
	$errors = array();
	$sid = $school['id'];
	$studAuth = escape($_POST['studAuth']);

	if (empty($errors)) {
		$update = good_query("UPDATE schools SET studAuth = '$studAuth'  WHERE id = $sid LIMIT 1");
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
Allow students to sign up by using a class code provided by their teacher.</p>
<br />';
		} elseif ($_GET['i'] == 2) {
			echo '<p style="font-size:12px">This feature will <strong>block</strong> students from <strong>creating accounts</strong> underneath your school.<br />
			This is particularly useful if your school is using single sign on (SSO) authentication; it will disable students from accidentally creating duplicate accounts.</p>';
		}

		exit();
	}

	if ($school['studAuth'] == 1) {
		$check1 = 'checked="checked" ';
		$onLoad = '1';
	} elseif ($school['studAuth'] == 2) {
		$check2 = 'checked="checked" ';
		$onLoad = '2';
	}

	echo '
<div class="headTitle"><img src="' . $imgServer . 'gen/setting.png" style="margin-right:5px;margin-top:3px" /><div>Student Singup Policies</div></div>
<div id="content" style="margin:5px">

<script type="text/javascript">

		$( "#jCatch" ).buttonset();
function swapNode(node) {
$.ajax({
   type: "GET",
   url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=2&i="+node,
   success: function(msg){
     $("#opter").html(msg);
   }
 });


}


function updateStudPolicy() {
        dataString = $("#stud-policy").serialize();


        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=2",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">Student Policies Updated Successfully!</div>\').slideDown(400).delay(2500).slideUp(400);
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
<form id="stud-policy" method="POST">
<div id="jCatch">
		<input type="radio" id="radio1" onClick="ieLoad(1)" name="studAuth" value="1" ' . $check1 . '/><label for="radio1">Require Class Code</label>
		<input type="radio" id="radio3" onClick="ieLoad(2)" name="studAuth" value="2" ' . $check2 . '/><label for="radio3">Account Creation Disabled</label><br />
		<div id="opter"></div>
	</div>
	<div style="display:none"><input type="password" name="pass" /></div>
</form>


<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox(); return false" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="updateStudPolicy(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Save Student Policies</a></div>

</div>';

?>
