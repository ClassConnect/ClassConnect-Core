<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if (isset($_GET['fid']) && is_numeric($_GET['fid'])) {
	$forum_id = escape($_GET['fid']);
	
	$forumData = getForum($forum_id, $class_id);
	if ($forumData == false) {
		exit();
	}
} else {
	exit();
}

$userData = getUser($user_id);

$editorID = rand(1, 1500);

	echo '<cc:crumbs><a href="index.php">Forum</a>{crumbSplit}' . $forumData['title'] . '</cc:crumbs>
<script>
$(document).ready(function () {
	var config = {
		toolbar:
		[
			[\'Bold\', \'Italic\', \'-\', \'NumberedList\', \'BulletedList\', \'-\', \'Link\', \'Unlink\'],
			[\'UIColor\']
		]
	};

	// Initialize the editor.
	// Callback function can be passed and executed after full instance creation.
	$("textarea.tinymce").ckeditor(config);

	});
function showReply() {
	$("#clickHide").hide();
	$("#replybox").show();
	
	return false;
}

function showRepTo(id) {
	$("#showReply" + id).show();
}

function addLoad(ele) {
	$(ele).html(\'<img src="core/site_img/loading.gif" style="margin-right:15px" />\');
}
	
</script>';

if ($forumData['locked'] == 1) {
	echo '<script>
$(document).ready(function(){
		
	$(".hoverable").hover(
  function () {
    $(this).find(\'.showRep\').show();
  },
  function () {
    $(this).find(\'.showRep\').hide();
  }
);
	
});
</script>';
	
}


if ($class_level == 3) {
	echo '<script>
$(document).ready(function(){
		
	$(".hoverable").hover(
  function () {
    $(this).find(\'.showDel\').show();
  },
  function () {
    $(this).find(\'.showDel\').hide();
  }
);
	
});
</script>';
	
}
echo '<div class="info" style="margin-bottom:10px; margin-left:10px">
	' . reverse_htmlentities($forumData['body']);
	
	// if unlocked, show main reply button
	if ($forumData['locked'] == 1) {
		echo '<div id="replyarea">
	
	
		<div id="clickHide" style="border-top:1px solid #999"><a href="#" target="_blank" onClick="showReply(); return false"><div class="forum_load" style="border-bottom:none">
  <div style="padding-left:250px"><img src="' . $imgServer . 'main/forum_open.png" style="float:left; margin-top:8px; height:24px; margin-right:5px" /> <div class="load_text">Respond To Forum Thread</div></div>
    </div></a></div>
    
    
    
    </div>';
   }

	echo '</div>';
if ($forumData['locked'] == 1) {
echo '	<div id="replybox" style="display:none; margin-left:10px">
	<form method="post" action="addReply.php?fid=' . $forum_id . '" onSubmit="addLoad(\'#mainSub\')">
		<div><textarea id="elm' . $editorID . '" name="body" rows="15" cols="80" style="width: 738px" class="tinymce"></textarea></div>
		<input type="hidden" name="submitted" value="true" />

		<div style="height:45px"><div id="mainSub" style="float:right; margin-top:10px"><button type="submit" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Add Reply</button></div></div>
	</form>
	</div>';
}
	
echo '<div id="replies" style="margin-left:10px">';


$replies = getReplies($forum_id);

foreach ($replies as $reply) {
	if ($reply['rid'] == 0) {
	$temp_id = $reply['reply_id'];	
	echo '<div class="hoverable" id="box' . $temp_id . '">

<div style="clear:both; margin-top:30px">
<img src="' . $iconServer . $reply['prof_icon'] . '.png" height="40" width="40" style="float:left;border:1px solid #bbbbb7;margin-right:5px" />
<div style="float:left">
<img src="' . $imgServer . 'main/arrow-left.png" style="float:left; margin-top:10px" />
<div style="background: #eeeeea; border: 1px solid #d1d1cc; width:670px; margin-left:6px; padding:5px">

<strong>' . $reply['first_name'] . ' ' . $reply['last_name'] . '</strong> <span style="color:#666">posted at ' . date('g:i A', strtotime($reply['posted_at'])) . ' on ' . date('F j, Y', strtotime($reply['posted_at'])) . '</span><br />' . reverse_htmlentities($reply['body']) . '</div>
</div>
</div>
<div style="clear:both"></div>';

// neah neah neah
if ($class_level == 3) {
echo '<div class="showDel"><a href="delReply.php?rid=' . $reply['reply_id'] . '&fid=' . $forum_id . '" target="dialog" width="350"><img src="' . $imgServer . 'gen/delCircle.png" style="width: 16px; float:left; margin-right:4px; margin-top:2px"/> <strong>Delete</strong></a></div>';
} // class level

		// load our replies
		foreach ($replies as $trep) {
			if ($trep['rid'] == $temp_id) {

// neah neah neah
if ($class_level == 3) {
$toggle = '<div class="showDel"><a href="delReply.php?rid=' . $trep['reply_id'] . '&fid=' . $forum_id . '" target="dialog" width="350"><img src="' . $imgServer . 'gen/delCircle.png" style="width: 16px; float:left; margin-right:4px; margin-top:2px"/> <strong>Delete</strong></a></div>';
} else {
    $toggle = '';// class level
}
				
$tempStr = '<div style="clear:both; margin-top:30px; margin-left:60px">
<img src="' . $iconServer . $trep['prof_icon'] . '.png" height="40" width="40" style="float:left;border:1px solid #bbbbb7;margin-right:5px" />
<div style="float:left">
<img src="' . $imgServer . 'main/arrow-left.png" style="float:left; margin-top:10px" />
<div style="background: #eeeeea; border: 1px solid #d1d1cc; width:610px; margin-left:6px; padding:5px">

<strong>' . $trep['first_name'] . ' ' . $trep['last_name'] . '</strong> <span style="color:#666">posted at ' . date('g:i A', strtotime($trep['posted_at'])) . ' on ' . date('F j, Y', strtotime($trep['posted_at'])) . '</span><br />' . reverse_htmlentities($trep['body']) . '</div>
</div>
</div>
<div style="clear:both"></div>' . $toggle . $tempStr;

			}
		}
                echo $tempStr;
		// end get replies
		 
		echo '<div class="showRep"><a href="#" target="_blank" onClick="showRepTo(' . $reply['reply_id'] . '); return false;"><img src="' . $imgServer . 'gen/arrow_up.png" style="float:left; margin-right:4px"/> <strong>Reply</strong></a></div>

<div id="showReply' . $reply['reply_id'] . '" style="display:none">

<div style="clear:both; margin-top:20px; margin-left:60px">
<img src="' . $iconServer . $userData['prof_icon'] . '.png" height="40" width="40" style="float:left;border:1px solid #bbbbb7;margin-right:5px" />
<div style="float:left">
<img src="' . $imgServer . 'main/arrow-left.png" style="float:left; margin-top:10px" />
<div style="background: #eeeeea; border: 1px solid #d1d1cc; width:610px; margin-left:6px; padding:5px">
<form method="post" action="addReplyTo.php?rid=' . $reply['reply_id'] . '&fid=' . $forum_id . '" onSubmit="addLoad(\'#submit' . $reply['reply_id'] . '\')">
		<textarea name="body" rows="5" cols="80" style="width: 575px; margin-left:10px"></textarea>
		<input type="hidden" name="submitted" value="true" />

		<div style="height:45px"><div id="submit' . $reply['reply_id'] . '" style="float:right; margin-top:10px"> <button type="submit" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Add Reply</button></div></div>
	</form>
</div>
</div>
</div>
<div style="clear:both"></div>

</div>





</div>';

	} // if not a reply
$tempStr = '';
//end
}

if (empty($replies)) {
	echo '<div id="noReplies" class="commentbox" style="text-align:center; font-weight:bolder">We were unable to find any replies to this forum.</div>';
}

echo '</div>
    <div style="height:30px"><br /></div>';


echo '<!--[if IE 7]>
<style type="text/css">
.showDel {
margin-top: -31px;
}

.showRep {
margin-top: -31px;
}
</style>
<![endif]-->';
	


?>