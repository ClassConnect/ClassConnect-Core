<?php
$content_id = escape($_GET['content_id']);

// if we have authorization
if (auth_content($content_id, $user_id) == true) {
	// get the content info
	$content = get_content($content_id);
} else {
	echo 'Cannot verify permissions. Please try again.';
	exit();
}

// if were uploading files
if ($content['format'] == 1) {
	require_once('core/inc/app/fileBox/content/files/view.php');

// if were adding a website
} elseif ($content['format'] == 2) {
echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>ClassConnect | Preview "' . $content['name'] . '"</title>
<link rel="stylesheet" href="' . $cssServer . 'main.css" type="text/css" />
<script type="text/javascript" src="' . $scriptServer . 'jquery.js"></script>
<script type="text/javascript" src="' . $scriptServer . 'siteFunctions.js"></script>
<script>
function showDesc() {
	var boxWidth = 400;
	var boxMargin = boxWidth/2 + 6;
	var append = "";
	boxMargin = -boxMargin;
	$("#dialogBox").width(boxWidth);
	$("#dialogBox").margin({left: boxMargin});
	$("#dialogBox").html($("#desc").html()).fadeIn(300);
}
</script>
<style>
html{height:100%}
body{margin:0;font-family: arial;font-size:12px;height:100%;overflow:hidden}
a,a:visited{color:#00c}
div{font-size:130%}
#details{float:left;margin-top:10px; margin-left:20px}
#details p{padding:0;margin:0 0 2px}
img{border:none}
#outer-separator{clear:both;width:100%;margin:0 0 0;padding:0;font-size:1px;overflow:hidden}
#theTitle {
	font-size:20px;
	margin-top:13px;
	color: #666;
}
table{font-size:100%}
#changeMe {
	background: #CCC url(' . $imgServer . 'header/bkg.png) repeat-x;
	padding-bottom:10px;
	border-bottom:1px solid #999;
	}</style>

</head>
<body>
<table cellpadding=0 cellspacing=0 height="100%" width="100%"><tr height="1%"><td style="top:0;width:100%">


<table cellpadding=0 cellspacing=0 width="100%" id="changeMe"><tr><td>
<div id=details>&nbsp;&nbsp;&nbsp;&nbsp;<a href="filebox.cc#' . $content['fid'] . '" class="button">Back</a></div>
<div id="theTitle">' . $content['name'] . '</div>
<td align=right valign=bottom><div style="float:right"> <a href="#" class="button" onClick="showDesc()">Description</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . reverse_htmlentities($content['content']) . '" class="button">Remove Frame</a></div></table>
<div id=outer-separator></div>
<tr><td><iframe allowtransparency=true frameborder=0 id=webframe scrolling=auto src="' . reverse_htmlentities($content['content']) . '" style="width:100%;height:100%"></iframe>
</table><div id="desc" style="display:none;"><div class="headTitle" style="font-size:16px"><div>\'' . $content['name'] . '\' Description</div></div><div style="padding:3px; font-family: arial; font-size:14px">' . $content['body'] . '</div><div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close</button>
</div></div><div id="dialogBox" style="display:none"></div></body>
<script>var a = document.getElementById(\'webframe\');a && a.contentWindow && a.contentWindow.focus();</script></html>';

// if were adding a youtube video
} elseif ($content['format'] == 3) {
	require_once('core/inc/app/fileBox/content/youtube/view.php');

// if were viewing an embed object
} elseif ($content['format'] == 4) {
	
	echo reverse_htmlentities($content['content']);

// if were viewing a scribd doc
} elseif ($content['format'] == 5) {
	require_once('core/inc/app/fileBox/content/scribd/view.php');

// if were viewing a gdoc
} elseif ($content['format'] == 8) {
	require_once('core/inc/app/fileBox/content/gapp/view.php');
	
}



?>