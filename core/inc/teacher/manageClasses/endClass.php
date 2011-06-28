<?php
if (isset($_POST['cid']) && is_numeric($_POST['cid'])) {
		$cid = $_POST['cid'];
		
		// make sure this person is a teacher of this class
		if (checkClassOwner($cid) == true) {
			$class = getClass($cid);
			if ($class['status'] == 1) {
				endClass($cid);
			} elseif ($class['status'] == 2) {
				restartClass($cid);
			}
			
			echo "1";
			setSession($user_id);
		}
	
exit();

}
// end POST

// get cid
if (isset($_GET['cid']) && is_numeric($_GET['cid'])) {

	$cid = $_GET['cid'];

	// make sure this person is a teacher of this class
	if (checkClassOwner($cid) == true) {

$class = getClass($cid);
			if ($class['status'] == 1) {
				$img = 'stop.png';
				$title = 'End "' . $class['name'] . '"';
				$body = 'Are you sure you want to end this class?';
				$confirm = 'Yes, end this class';
				$word = 'Ended';
			} elseif ($class['status'] == 2) {
				$img = 'update.png';
				$title = 'Reactivate "' . $class['name'] . '"';
				$body = 'Are you sure you want to reactivate this class?';
				$confirm = 'Yes, reactivate this class';
				$word = 'Reactivated';
			}


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/' . $img . '" style="margin-right:7px;margin-top:7px" /><div>' . $title . '</div></div>
<div id="failer" style="display:none;margin-top:5px;margin-left:3px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">
<form method="POST" id="ud-class" style="font-size:14px">

<p>' . $body . '</p>

<input type="hidden" name="cid" value="' . $cid  . '" />
</form>


</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="toggleClass();" style="float:right" class="button"><img src="' . $imgServer . 'gen/tick.png" />' . $confirm . '</a></div>

<script>

function toggleClass() {
        dataString = $("#ud-class").serialize();

        $.ajax({
        type: "POST",
        url: "manage-classes.cc?n=3",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
        			$("#content").slideUp(300);
               $("#failer").html(\'<div class="successbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Class ' . $word . ' Successfully</div>\').slideDown(400);
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


}

}

?>