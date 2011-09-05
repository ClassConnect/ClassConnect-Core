<?php
if ($content['file_type'] > 900) {
	$content['file_type'] = 900;
}
?>
<script type="text/javascript">
$(document).ready(function() {
	var boxWidth = <?php echo $content['file_type']; ?>;
    var boxMargin = boxWidth/2 + 6;
	var append = "";
	boxMargin = -boxMargin;
	$("#dialogBox").width(boxWidth);
	$("#dialogBox").margin({left: boxMargin});
});

function showDesc() {
	$("#opted").fadeIn(200);
	$("#bottom").html('<button class="button" onClick="closeBox();" type="submit"><?php echo '<img src="' . $imgServer . 'gen/cross.png" />'; ?> Close</button>');
}
</script>

<?php
echo '<img src="' . $content['content'] . '" width="' . $content['file_type'] . '" />

<div id="opted" style="display:none; margin:10px; border: 1px solid #999; padding:5px; font-size:13px">' . $content['body'] . '</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">';

if ($content['body'] != '') {
echo '<button class="button" onClick="showDesc()" type="submit"> 
<img src="' . $imgServer . 'gen/information.png" /> View File Description
</button>';	

}
echo '<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>