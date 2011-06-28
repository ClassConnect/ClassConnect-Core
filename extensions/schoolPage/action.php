<?php 
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/schoolMain.php');
// local extension file
require_once('core/main.php');



// if class comment
if ($_GET['n'] == 1) {
	
	
if (isset($_POST['message'])) {
	$message = escape($_POST['message']);
	addComment($message, $user_id, $class_level, $school_id);
} 
?>

<cc:inline>
<?php if ($message != '') { 
if (checkSchoolAdmin($school_id, $user_id)) {
		$cssClass = 'darkcommentbox';
		$cssClass2 = 'darkcommentfooter';

		$schoolData = getSchool($school_id);
		// send notification
		sendSchoolNotification($school_id, $schoolData['name'] . ' has just posted a <a href="school.cc?id=' . $school_id . '">new update.</a>');
		
		$append = '$(\'#latestBox\').hide(); $(\'#latestBox\').html(\'<span class="status">' . $message . '</span><br /><span class="posted_at">posted at ' . date('g:i A') . ' on ' . date('F j, Y') . '</span>\').fadeIn(400);';
		
	} else {
		$cssClass = 'commentbox';
		$cssClass2 = 'commentfooter';
	}
	
$me = getSchool($school_id);
?>
<script type="text/javascript">

$(document).ready(function(){  

var message_wall = $('#message_wall').attr('value');


$("#class_comments").prepend("<div style=\"clear:both;display:none;margin-top:10px; margin-bottom:25px\"><img src=\"<?php echo $imgServer . 'client_img/school/' . $me['settingLogo']; ?>\" height=\"40\" width=\"40\" style=\"float:left;border:1px solid #bbbbb7;margin-right:5px\" /><div style=\"float:left\"><img src=\"<?php echo $imgServer; ?>main/arrow-left.png\" style=\"float:left; margin-top:10px\" /><div style=\"background: #eeeeea; border: 1px solid #d1d1cc; width:670px; margin-left:6px; padding:5px\"><strong><?php echo $me['name']; ?></strong> <span style=\"color:#666\"><?php echo 'posted at ' . date('g:i A') . ' on ' . date('F j, Y'); ?></span><br /><?php echo $message; ?></div></div></div><div style=\"clear:both; height:25px\"></div>");
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
if (checkSchoolAdmin($school_id, $user_id)) {
if (isset($_POST['commentID'])) {
	$commentID = escape($_POST['commentID']);
	removeComment($commentID, $school_id);
	echo '1';
} 
}


// load comments
} elseif ($_GET['n'] == 3) { 

$start = escape($_POST['start']) * 20;

$comments = getComments($school_id, $start, 20);

$schoolData = getSchool($school_id);

$count = 1;

foreach ($comments as $comment) {
    if ($count == 1) {
        $margin = '10';
    } else {
        $margin = '25';
    }


        $bbotom = 'border-bottom: 1px solid #d1d1cc;';
    

    echo '<div id="comment' . $comment['comment_id'] . '" style="clear:both;margin-top:' . $margin . 'px;margin-bottom:10px">

<img src="' . $imgServer . 'client_img/school/' . $schoolData['settingLogo'] . '" height="40" width="40" style="float:left;border:1px solid #bbbbb7;margin-right:5px" />
<div style="float:left">
<img src="' . $imgServer . 'main/arrow-left.png" style="float:left; margin-top:10px" />
<div style="background: #eeeeea; border-left: 1px solid #d1d1cc;border-right: 1px solid #d1d1cc;border-top: 1px solid #d1d1cc; ' . $bbotom.  'width:670px; margin-left:6px; padding:5px" ' . $border . '>';
    // show delete if teacher
if (checkSchoolAdmin($school_id, $user_id)) {
	echo '<span style="float:right; font-weight:bolder; color:#fff; padding-top:0px; padding-bottom:0px; padding-left:5px; padding-right:5px; border:1px solid #666" class="bevColor"><a href="#" class="delMe" target="_blank" onClick="deleteComment(' . $comment['comment_id'] . ');return false;">X</a></span>';
}

echo '<strong>' . $schoolData['name'] . '</strong> <span style="color:#666">posted at ' . date('g:i A', strtotime($comment['date_posted'])) . ' on ' . date('F j, Y', strtotime($comment['date_posted'])) . '</span><br />' . $comment['body'] . '</div>
</div>
</div>
<div style="clear:both"></div>';


$count++;
}

// if no comments are found
if (empty($comments)) {
	echo '<div id="noComments" class="commentbox" style="text-align:center; font-weight:bolder;margin-top:20px; width:715px">We were unable to find any updates for this school.</div>';
	
} else {
	
	
	// display more button
	echo '<a id="loadMore" href="#" target="_blank" onClick="loadComments(); return false;"><div class="comment_load" style="clear:both; margin-top:20px">
   <div class="comment_load_text">View More Comments</div>
    </div></a>';
	
}












}// get n ?>