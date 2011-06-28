<?php
if (isset($_GET['s'])) {
$start = escape($_GET['start']) * 20;

$msgs = get_messages($user_id, $start, 20);

foreach ($msgs as $msg) {
    $msgData = get_last_feed($msg['tid']);
    if ($msg['status'] == 2) {
        $style='font-weight:bolder;';
    } else {
        $style = '';
    }
	    echo '<div style="clear:both; border-top:1px solid #ccc; padding-top:3px; padding-bottom:5px;' . $style . '">
<div style="width:690px"><a href="#" onClick="openBox(\'msg.cc?n=3&id=' . $msg['thread_id'] . '\', 350); return false"><img src="' . $imgServer . 'gen/close.png" style="float:right; margin-top:14px; margin-right:10px" /></a>
    <div style="float:left; width:170px; height:44px">
        <img src="' . $iconServer . $msgData['prof_icon'] . '.png" height="40" width="40" style="float:left;margin-right:5px;margin-top:2px">
        <div style="padding-top:8px"><strong>' . $msgData['first_name'] . ' ' . $msgData['last_name'] . '</strong><br />
        <span style="color:#999; font-size:9px">March 3rd at 3:10pm</span>
        </div>
    </div>
    <div style="font-size:14px; padding-top:3px">
<a href="msg.cc?n=2&id=' . $msg['thread_id'] . '">' . $msg['title'] . '</a>
    </div>

<span style="margin-top:5px; color:#999; font-size:12px">' . substr(strip_tags(reverse_htmlentities($msgData['body'])), 0, 85) . '...</span>
</div>
</div>';

}

// if no comments are found
if (empty($msgs)) {
	echo '<div class="commentbox" style="text-align:center; font-weight:bolder;clear:both; width:670px">We were unable to find any messages.</div><br /><br />';

} else {


	// display more button
	echo '<a id="loadMore" href="#"  onClick="loadComments(); return false;"><div class="comment_load" style="clear:both; width:688px">
   <div class="comment_load_text">View More Messages</div>
</div></a>';

}

exit();
} // get if s



$page_title = "Inbox";
require_once('core/template/head/header.php');
?>
 <script>
var commenterCount = 0;


function loadComments() {
$("#loadMore").html('<center><img src=\"core/site_img/loading.gif\" /></center>');

var hitURL = 'msg.cc?s=1&start=' + commenterCount;
$.ajax({
    type: "GET",
    url: hitURL,
    success: function(data) {
        $("#loadMore").remove();
        $("#inboxmain").html($("#inboxmain").html()+data);
     }

});
commenterCount++;
}


$(document).ready(function(){
    loadComments();

});

    </script>
<div style="float:left;border-right:1px solid #ccc" id="inboxmain">


<a id="loadMore" href="#"  onClick="loadComments(); return false;"><div class="comment_load" style="clear:both; width:688px">
   <div class="comment_load_text">View More Messages</div>
</div></a>


</div>


<button class="button" type="submit" onClick="openBox('msg.cc?n=1', 540)" style="-moz-border-radius-bottomleft: 0px;-khtml-border-radius-bottomleft: 0px;-webkit-border-bottom-left-radius: 0px;-moz-border-radius-topleft: 0px;-khtml-border-radius-topleft: 0px;-webkit-border-top-left-radius: 0px;"><img src="<?php echo $imgServer; ?>gen/add_mail_s.png"  /> Create New Message</button>
<div style="width:195px;margin-right:10px;padding-top:5px; float:right">Create messages by clicking the create message button above.</div>


<?php
require_once('core/template/foot/footer.php');
?>