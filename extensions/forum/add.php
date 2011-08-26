<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if ($class_level == 3) {
	
// if submitted
if (isset($_POST['submitted'])) {
	$attempt = createForum($class_id, $_POST['title'], $_POST['body']);
	if ($attempt == 1) {
		$classData = getClass($class_id);
		// send notification
		sendClassNotification($class_id, $classData['name'] . ' has just opened a new <a href="class.cc?id=' . $class_id . '#3">forum thread.</a>');
		echo '<cc:redirect>index.php</cc:redirect>';
	} else {
		echo '<cc:inline><script>
		$(document).ready(function(){  
		$("#failer").html(\'';
		
		foreach($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}


		echo '\');
		$("#failer").fadeIn(200);
		});
		</script></cc:inline>';
	}
	
	exit();
}

$editorID = rand(1, 1500);


echo '<cc:crumbs><a href="index.php">Forum</a>{crumbSplit}Create Thread</cc:crumbs>
<script type="text/javascript">
$(document).ready(function () {
	var config = {
		toolbar:\'genToolbar\'
	};

	// Initialize the editor.
	// Callback function can be passed and executed after full instance creation.
	$("textarea.tinymce").ckeditor(config);

	});
</script>
<div id="failer" class="errorbox" style="text-align:center; font-weight:bolder; display:none; margin-bottom:5px; margin-left:10px"></div>
<form method="post" action="add.php" style="margin-left:20px">
<span style="font-size:14px; font-weight:bolder">Forum Title</span><br />
<input type="text" name="title" style="width:300px;font-size:14px;padding:4px" class="noRound" /><br /><br />

<span style="font-size:14px; font-weight:bolder">Forum Description</span><br />
		<div id="showSwapper">
			<textarea id="elmadd' . $editorID . '" name="body" rows="15" cols="80" style="width: 700px" class="tinymce"></textarea>
		</div>

<input type="hidden" name="submitted" value="true" />

		<div style="float:right; margin-top:10px"><button class="button" type="reset" name="reset"><img src="' . $imgServer . 'gen/resend.png" /> Reset</button> <button type="submit" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Create Thread</button></div>

</form>';



}

?>