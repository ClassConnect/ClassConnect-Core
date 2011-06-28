<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

if (isset($_GET['fid']) && is_numeric($_GET['fid']) && isset($_GET['rid']) && is_numeric($_GET['rid'])) {
	$forum_id = escape($_GET['fid']);
	$reply_id = escape($_GET['rid']);
	
	$forumData = getForum($forum_id, $class_id);
	if ($forumData == false) {
		exit();
	}
	
} else {
	exit();
}

if (isset($_POST['submitted']) && $forumData['locked'] == 1) {
	   addReplyTo($reply_id, $forum_id, $user_id, '<p>' . $_POST['body'] . '</p>');
?>

<cc:redirect>
forum.php?fid=<?php echo $forum_id; ?>
</cc:redirect>
	
<?php	
	exit();
} else {
	echo '<center><br /><br /><span style="font-size:16px; font-weight:bolder; color: #999">Oops! This forum is locked and cannot be edited.</span></center>';
}









?>