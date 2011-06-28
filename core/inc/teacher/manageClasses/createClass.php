<?php

if (isset($_POST['name'])) {
	$errors = array();
	$name = escape($_POST['name']);
	$body = escape($_POST['body']);
	$sid = escape($_POST['sid']);
	$gp = escape($_POST['gpid']);
	
	if ($_POST['name'] != '') {
		$name = escape($_POST['name']);
	} else {
		$errors[] = 'You forgot to enter your class name.';
	}
	
	
	if ($_POST['sid'] != '') {
		$sid = escape($_POST['sid']);
	} else {
		$errors[] = 'You forgot to choose a school.';
	}


	if (empty($errors)) {
		createClass($name, $body, $sid, $gp, $user_id);
		echo "1";
		setSession($user_id);
	} else { // report the errors
		echo '<div class="errorbox" style="width: 470px;"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($errors as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}	
	
	
exit();

}

// load grading periods
if ($_GET['ni'] == 1) {
		$sid = escape($_GET['id']);
		$current = getGPs($sid, 2);
		$future = getGPs($sid, 3);
		echo '<div style="font-size:12px; font-weight:bolder; color:#999">Current Grading Periods</div>';
		foreach($current as $gp) {
			echo '<input type="radio" name="gpid" value="' . $gp['id'] . '" /> ' . $gp['name'] . '<br />';
		}
		
		if (empty($current)) {
			echo '<i>No current grading periods found.</i><br />';
		}
		
		echo '<div style="font-size:12px; font-weight:bolder; color:#999">Future Grading Periods</div>';
		foreach($future as $gp) {
			echo '<input type="radio" name="gpid" value="' . $gp['id'] . '" /> ' . $gp['name'] . '<br />';
		}
		
		if (empty($future)) {
			echo '<i>No future grading periods found.</i><br />';
		}
		echo '<br />';
		exit();
}
	
	
echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_l.png" style="margin-right:5px;margin-top:2px" /><div>Create New Class</div></div>
<div id="failer" style="display:none;margin-top:5px;margin-left:3px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">
<form method="POST" id="create-class" style="font-size:14px">

<div style="width: 250px; float:right">
<strong>Select School</strong> <span style="color:#dd1100;font-style: bolder">*</span>
';
echo '<div id="jCatch" style="margin-bottom:20px">';
foreach($mySchools as $school) {
	
	echo '<input type="radio" id="radio' . $school['id'] . '" onClick="swapGP(' . $school['id'] . ')" name="sid" value="' . $school['id'] . '" /><label for="radio' . $school['id'] . '" style="font-size:12px; margin-bottom:10px">' . $school['name'] . '</label><br />';
} 
if (empty($mySchools)) {
	echo 'No schools found. You must add or find your school before you can create classes.';
}		
echo '</div>';

echo '<strong>Choose Grading Period</strong>
<div id="gp">
<span style="font-style:italic; color:#999">You must select your school first!</span>
</div>';

echo '</div>

<div style="width:225px; padding-right:5px; border-right:1px solid #ccc">
<strong>Class Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">ex: Biology Period 1</span><br /><br />


<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:215px"></textarea>

<div style="display:none"><input type="password" name="saget" /></div>
<br /><br/>
</div>


</form>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="createClass();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />Create Class</a></div>

<script>
$( "#jCatch" ).buttonset();


function swapGP(node) {
$.ajax({
   type: "GET",
   url: "manage-classes.cc?n=1&ni=1&id="+node,
   success: function(msg){
     $("#gp").html(msg);
   }
 });

    
}


function createClass() {
        dataString = $("#create-class").serialize();

        $.ajax({
        type: "POST",
        url: "manage-classes.cc?n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
        			$("#content").slideUp(300);
               $("#failer").html(\'<div class="successbox" style="width: 470px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Class Created Successfully! <a href="#" onClick="addAnother();">Add another class.</a></div>\').slideDown(400);
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
	$("#bottom").html(\'<a href="manage-classes.php" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="createClass();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />Create Class</a>\').slideDown(400);
}
</script>';


?>