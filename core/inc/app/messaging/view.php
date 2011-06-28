<?php
$thread_id = escape($_GET['id']);
if (auth_thread($thread_id, $user_id) != true) {
    $page_title = "Error";
    require_once('core/template/head/header.php');
    echo '<br /><center><span style="font-size:20px; color:#999; font-weight:bolder">Oops! This page does not exist.</span></center>';
    require_once('core/template/foot/footer.php');
    exit();
}

if (isset($_POST['bodyer'])) {
    $body = escape($_POST['bodyer']);
    if ($body != '') {
     add_thread_message($thread_id, $user_id, $body);
    }
}
// get thread name
$threadData = get_thread($thread_id);
$page_title = $threadData['title'];

// mark this message as read
mark_read($thread_id, $user_id);

 // load message feed
$feedData = get_feed($thread_id);

// get the recipients of this thread
$recipients = get_recipients($thread_id);

$scriptArr[] = $scriptServer . 'editor/richEdit.js';
require_once('core/template/head/header.php');
// top bar
echo '<script>$().ready(function() {
		$(\'textarea.tinymce\').tinymce({
			// Location of TinyMCE script
			script_url : \'' . $scriptServer . 'editor/tiny_mce.js\',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "cut,copy,paste,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,forecolor,backcolor,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,sub,sup,hr,image,charmap,emotions,iespell,media",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true


		});
	});


$(document).ready(function(){
		//get the top offset of the target anchor
		var target_offset = $("#bottom").offset();
		var target_top = target_offset.top;

		//goto that anchor by setting the body scroll top to anchor top
		$("html, body").animate({scrollTop:target_top}, 500);

});

</script>';
echo '<span style="font-size:24px; color:#666"><a href="msg.cc">Inbox</a> <img src="' . $imgServer . 'main/l_arrow.png" /> ' . $threadData['title'] . '</span>';

foreach ($recipients as $rece) {
    $totalRec .= $rece['first_name'] . ' ' . $rece['last_name'] . ', ';
}

echo '<div class="infobox"><strong>Recipients:</strong> ' . substr($totalRec, 0, strlen($totalRec) - 2) . '</div>';
// display feed
foreach ($feedData as $feed) {
    echo '<div style="width:900px; padding-top:5px; padding-bottom:5px; border-bottom:1px solid #ccc">
        <img src="' . $iconServer . $feed['prof_icon'] . '.png" height="40" width="40" style="float:left;margin-right:5px;margin-top:2px">
        <div style="padding-top:8px; font-size:13px"><strong>' . $feed['first_name'] . ' ' . $feed['last_name'] . '</strong>&nbsp;&nbsp;<span style="color:#999">March 3rd at 3:10pm</span></div>

        ' . reverse_htmlentities($feed['body']) . '
    </div>';
}

echo '
<form action="msg.cc?n=2&id=' . $thread_id . '" method="POST"><div><textarea id="temp2" name="bodyer" style="width:900px" class="tinymce"></textarea></div>
<button class="button" type="submit" style="float:right;-moz-border-radius-topleft: 0px;-khtml-border-radius-topleft: 0px;-webkit-border-top-left-radius: 0px;-moz-border-radius-topright: 0px;-khtml-border-radius-topright: 0px;-webkit-border-top-right-radius: 0px;margin-right:0px"><img src="' . $imgServer . 'gen/add_mail_s.png" /> Send Message</button>
 </form>
 <div id="bottom"><br /></div>';



require_once('core/template/foot/footer.php');
?>