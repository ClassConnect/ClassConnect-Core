<?php
if ( (isset($_GET['type'])) && (is_numeric($_GET['type'])) ) {
	$type = $_GET['type'];
} else {
	$type = 1;
}

if ($type == 1) {
if ( (isset($_GET['url'])) ) {
$url = strip_tags($_GET['url']);
}
if ( (isset($_GET['query'])) ) {
$query = strip_tags($_GET['query']);
}


echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>ClassConnect | Preview "' . $url . '"</title>
<link rel="stylesheet" href="' . $scriptServer . 'dynCSS.cc" type="text/css" />
<script type="text/javascript" src="' . $scriptServer . 'jquery.js"></script>
<script type="text/javascript" src="' . $scriptServer . 'jqueryUI.js"></script>
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
div{font-size:100%}
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
<div id=details>&nbsp;&nbsp;&nbsp;&nbsp;<a href="searchBox.cc#1_' . htmlentities($_GET['query']) . '" class="button">Back</a></div>
<div id="theTitle">' . htmlentities($_GET['title']) . '</div>
<td align=right valign=bottom><div style="float:right"> <a href="#" class="button" onClick="openBox(\'searchBox.cc?n=3&title=' . urlencode($_GET['title']) . '&type=' . $type . '&desc=' . urlencode($_GET['body']) . '&code=' . urlencode($url) . '&query=' . urlencode($_GET['query']) . '\', 350)"><img src="' . $imgServer . 'gen/save.png" />Bookmark URL To FileBox</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . $url . '" class="button">Remove Frame</a></div></table>
<div id=outer-separator></div>
<tr><td><iframe allowtransparency=true frameborder=0 id=webframe scrolling=auto src="' . $url . '" style="width:100%;height:100%"></iframe>
</table><div id="desc" style="display:none;"><div class="headTitle" style="font-size:16px"><div>\'' . htmlentities($_GET['title']) . '\' Description</div></div><div style="padding:3px; font-family: arial; font-size:14px">' . htmlentities($_GET['body']) . '</div><div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close</button>
</div></div><div id="dialogBox" style="display:none"></div></body>
<script>var a = document.getElementById(\'webframe\');a && a.contentWindow && a.contentWindow.focus();</script></html>';



} elseif ($type == 3) {
	if ( (isset($_GET['url'])) ) {
	$url = strip_tags($_GET['url']);
	$start = strrpos($url, 'watch?v=') + 8;
	$vid = substr($url, $start, 11);
	

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/yt_l.png" style="margin-top:3px; margin-right: 5px" /><div>' . htmlentities($_GET['title']) . '</div></div>
<iframe title="YouTube video player" width="480" height="320" src="http://www.youtube.com/embed/' . $vid . '" frameborder="0" allowfullscreen></iframe>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="openBox(\'searchBox.cc?n=3&title=' . urlencode($_GET['title']) . '&type=' . $type . '&desc=' . urlencode($_GET['body']) . '&code=' . urlencode($vid) . '&query=' . urlencode($_GET['query']) . '\', 350)" type="submit"> 
<img src="' . $imgServer . 'gen/save.png" /> Save Video To FileBox
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';

	}
	
	
	

} elseif ($type == 4) {
	if ( (isset($_GET['doc_id'])) && (isset($_GET['doc_title'])) && (is_numeric($_GET['doc_id'])) && (isset($_GET['key'])) ) {
	$doc_id = $_GET['doc_id'];
	$new = $_GET['key'];
echo '<object id="doc_' . $doc_id . '" name="doc_' . $doc_id . '" height="500" width="480" type="application/x-shockwave-flash" data="http://d1.scribdassets.com/ScribdViewer.swf" style="outline:none;" >

<param name="movie" value="http://d1.scribdassets.com/ScribdViewer.swf">

<param name="wmode" value="opaque">

<param name="bgcolor" value="#ffffff">

<param name="allowFullScreen" value="true">

<param name="allowScriptAccess" value="always">

<param name="FlashVars" value="document_id=' . $doc_id . '&access_key=' . $new . '&page=1&viewMode=list">

<embed id="doc_' . $doc_id . '" name="doc_' . $doc_id . '" src="http://d1.scribdassets.com/ScribdViewer.swf?document_id=' . $doc_id . '&access_key=' . $new . '&page=1&viewMode=list" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="500" width="480" wmode="opaque" bgcolor="#ffffff"></embed>

</object>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="openBox(\'searchBox.cc?n=3&title=' . urlencode($_GET['title']) . '&type=' . $type . '&desc=' . urlencode($_GET['body']) . '&code=' . $doc_id . '|sdoc|' . $new . '&query=' . urlencode($_GET['query']) . '\', 350);" type="submit"> 
<img src="' . $imgServer . 'gen/save.png" /> Save Document To FileBox
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>

</div>';
	
	}
	
	} else {
	echo 'error';
	}
?>