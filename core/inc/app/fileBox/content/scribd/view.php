<script>
function showVid() {
	$("#opted").fadeIn(200);
	$("#bottom").html('<button class="button" onClick="closeBox();" type="submit"><?php echo '<img src="' . $imgServer . 'gen/cross.png" />'; ?> Close</button>');
}

function showDesc() {
	$("#opted").hide();
	$("#descr").show();
}
</script>

<?php
$docInfo = explode('|sdoc|', $content['content']);
$doc_id = $docInfo[0];
$new = $docInfo[1];
echo '<div class="headTitle"><img src="' . $imgServer . 'gen/ebook.png" style="margin-top:3px; margin-right: 5px" /><div>' . $content['name'] . '</div></div>

<object id="doc_' . $doc_id . '" name="doc_' . $doc_id . '" height="500" width="480" type="application/x-shockwave-flash" data="http://d1.scribdassets.com/ScribdViewer.swf" style="outline:none;" >

<param name="movie" value="http://d1.scribdassets.com/ScribdViewer.swf">

<param name="wmode" value="opaque">

<param name="bgcolor" value="#ffffff">

<param name="allowFullScreen" value="true">

<param name="allowScriptAccess" value="always">

<param name="FlashVars" value="document_id=' . $doc_id . '&access_key=' . $new . '&page=1&viewMode=list">

<embed id="doc_' . $doc_id . '" name="doc_' . $doc_id . '" src="http://d1.scribdassets.com/ScribdViewer.swf?document_id=' . $doc_id . '&access_key=' . $new . '&page=1&viewMode=list" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="500" width="480" wmode="opaque" bgcolor="#ffffff"></embed>

</object>

<div id="opted" style="display:none; margin:10px; border: 1px solid #999; padding:5px; font-size:13px">' . $content['body'] . '</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="showVid()" type="submit"> 
<img src="' . $imgServer . 'gen/information.png" /> View Document Description
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>