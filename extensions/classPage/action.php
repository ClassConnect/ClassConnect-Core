<?php 
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');



// if class comment
if ($_GET['n'] == 1) {
	
	
if (isset($_POST['message'])) {
	$message = escape($_POST['message']);
	$comment_id = addComment($message, $user_id, $class_level, $class_id);
} 
?>

<cc:inline>
<?php if ($message != '') { 

if ($class_level == 3) {
		$border = 'class=\"borderColor\"';
		$bbotom = '';

		$classData = getClass($class_id);
		// send notification
		sendClassNotification($class_id, $classData['name'] . ' has just posted a <a href="class.cc?id=' . $class_id . '">new update.</a>');
		
		$append = '$(\'#latestBox\').hide(); $(\'#latestBox\').html(\'<span class="status">' . $message . '</span><br /><span class="posted_at">posted at ' . date('g:i A') . ' on ' . date('F j, Y') . '</span>\').fadeIn(400);';
		
	} else {
		$border = '';
        $bbotom = 'border-bottom: 1px solid #d1d1cc;';
	}
	
$me = getUser($user_id);
?>
<script type="text/javascript">

$(document).ready(function(){  

var message_wall = $('#message_wall').attr('value');


$("#class_comments").prepend("<div id=\"comment<?php echo $comment_id; ?>\" style=\"clear:both;display:none;margin-top:10px\"><img src=\"<?php echo $iconServer . $me['prof_icon']; ?>.png\" height=\"40\" width=\"40\" style=\"float:left;border:1px solid #bbbbb7;margin-right:5px\" /><div style=\"float:left\"><img src=\"<?php echo $imgServer; ?>main/arrow-left.png\" style=\"float:left; margin-top:10px\" /><div style=\"background: #eeeeea; border-left: 1px solid #d1d1cc;border-right: 1px solid #d1d1cc;border-top: 1px solid #d1d1cc; <?php echo $bbotom; ?> width:670px; margin-left:6px; padding:5px\" <?php echo $border; ?>><?php
if ($class_level == 3) {
	echo '<span style=\"float:right; font-weight:bolder; color:#fff; padding-top:0px; padding-bottom:0px; padding-left:5px; padding-right:5px; border:1px solid #666\" class=\"bevColor\"><a href=\"#\" class=\"delMe\" target=\"_blank\" onClick=\"deleteComment(' . $comment_id . ');return false;\">X</a></span>';
} ?><strong><?php echo $me['first_name'] . ' ' . $me['last_name']; ?></strong> <span style=\"color:#666\"><?php echo 'posted at ' . date('g:i A') . ' on ' . date('F j, Y'); ?></span><br /><?php echo $message; ?></div></div></div><div style=\"clear:both; height:10px\"></div>");
$("#class_comments div:first").slideDown();

$('#message_wall').val('');

$('#noComments').remove();

<?php echo $append; ?>

});
</script>

<?php } ?>
</cc:inline>


<?php 
// de;ete comment
} elseif ($_GET['n'] == 2) { 
if ($class_level == 3) {
if (isset($_POST['commentID'])) {
	$commentID = escape($_POST['commentID']);
	removeComment($commentID, $class_id);
	echo '1';
} 
}


// load comments
} elseif ($_GET['n'] == 3) { 

$start = escape($_POST['start']) * 20;

$comments = getComments($class_id, $start, 20);

$count = 1;

foreach ($comments as $comment) {
    if ($count == 1) {
        $margin = '10';
    } else {
        $margin = '25';
    }

    if ($comment['level'] == 3) {
        $border = 'class="borderColor"';
        $bbotom = '';
    } else {
        $border = '';
        $bbotom = 'border-bottom: 1px solid #d1d1cc;';
    }

    echo '<div id="comment' . $comment['comment_id'] . '" style="clear:both;margin-top:' . $margin . 'px;margin-bottom:10px">

<img src="' . $iconServer . $comment['prof_icon'] . '.png" height="40" width="40" style="float:left;border:1px solid #bbbbb7;margin-right:5px" />
<div style="float:left">
<img src="' . $imgServer . 'main/arrow-left.png" style="float:left; margin-top:10px" />
<div style="background: #eeeeea; border-left: 1px solid #d1d1cc;border-right: 1px solid #d1d1cc;border-top: 1px solid #d1d1cc; ' . $bbotom.  'width:670px; margin-left:6px; padding:5px" ' . $border . '>';
    // show delete if teacher
if ($class_level == 3) {
	echo '<span style="float:right; font-weight:bolder; color:#fff; padding-top:0px; padding-bottom:0px; padding-left:5px; padding-right:5px; border:1px solid #666" class="bevColor"><a href="#" class="delMe" target="_blank" onClick="deleteComment(' . $comment['comment_id'] . ');return false;">X</a></span>';
}

echo '<strong>' . $comment['first_name'] . ' ' . $comment['last_name'] . '</strong> <span style="color:#666">posted at ' . date('g:i A', strtotime($comment['date_posted'])) . ' on ' . date('F j, Y', strtotime($comment['date_posted'])) . '</span><br />' . $comment['body'] . '</div>
</div>
</div>
<div style="clear:both"></div>';


$count++;
}

// if no comments are found
if (empty($comments)) {
	echo '<div id="noComments" class="commentbox" style="text-align:center; font-weight:bolder;margin-top:20px; width:718px">We were unable to find any comments for this class.</div>';
	
} else {
	
	
	// display more button
	echo '<a id="loadMore" href="#" target="_blank" onClick="loadComments(); return false;"><div class="comment_load" style="clear:both; margin-top:20px">
   <div class="comment_load_text">View More Comments</div>
    </div></a>';
	
}












}// get n ?>