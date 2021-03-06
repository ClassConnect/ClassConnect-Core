<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if ($class_level == 3) {


if (isset($_GET['fid']) && is_numeric($_GET['fid'])) {
	$forum_id = escape($_GET['fid']);
	// get the forum data
	$forumData = getForum($forum_id, $class_id);

	if ($forumData == false) {
		exit();
	}
	
} else {
	exit();
}


// if submitted
if (isset($_POST['submitted'])) {
	$attempt = updateForum($forum_id, $class_id, $_POST['title'], $_POST['body']);
	if ($attempt == 1) {
		$classData = getClass($class_id);
		// send notification
		sendClassNotification($class_id, $classData['name'] . ' has just updated <a href="class.cc?id=' . $class_id . '#3_forum.php?fid=' . $forum_id . '">a forum thread.</a>');
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
echo '<cc:crumbs><a href="index.php">Forum</a>{crumbSplit}Edit "' . $forumData['title'] . '"</cc:crumbs>
<script type="text/javascript" src="' . $scriptServer . 'editor/richEdit.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$(\'textarea.tinymce\').tinymce({
			// Location of TinyMCE script
			script_url : \'' . $scriptServer . 'editor/tiny_mce.js\',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,forecolor,backcolor,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,sub,sup,hr,image,charmap,emotions,iespell,media,|,insertdate,inserttime,pagebreak,preview,fullscreen",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			content_css : "' . $scriptServer . 'dynCSS.cc"


		});
	});
</script>
<div id="failer" class="errorbox" style="text-align:center; font-weight:bolder; display:none; margin-bottom:5px"></div>
<form method="post" action="edit.php?fid=' . $forum_id . '">
<span style="font-size:14px; font-weight:bolder">Forum Title</span><br />
<input type="text" name="title" style="width:215px" value="' . $forumData['title'] . '" /><br /><br />

<span style="font-size:14px; font-weight:bolder">Forum Description</span><br />
		<div>
			<textarea id="elm1" name="body" rows="15" cols="80" style="width: 750px" class="tinymce">' . $forumData['body'] . '</textarea>
		</div>

<input type="hidden" name="submitted" value="true" />

		<div style="float:right; margin-top:10px"><button class="button" type="reset" name="reset"><img src="' . $imgServer . 'gen/resend.png" /> Reset</button> <button type="submit" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Update Thread</button></div>

</form>';



}

?>