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


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/yt_l.png" style="margin-top:3px; margin-right: 5px" /><div>' . $content['name'] . '</div></div>
<iframe title="YouTube video player" width="480" height="320" src="http://www.youtube.com/embed/' . $content['content'] . '" frameborder="0" allowfullscreen></iframe>

<div id="opted" style="display:none; margin:10px; border: 1px solid #999; padding:5px; font-size:13px">' . $content['body'] . '</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="showVid()" type="submit"> 
<img src="' . $imgServer . 'gen/information.png" /> View Video Description
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>