<script>
function showDesc() {
	$("#opted").fadeIn(200);
	$("#bottom").html('<button class="button" onClick="closeBox();" type="submit"><?php echo '<img src="' . $imgServer . 'gen/cross.png" />'; ?> Close</button>');
}
</script>
<style>
.downloadButton {
	margin:5px; padding:10px; font-size:18px; text-align:center; color:#fff; background:  url(<?php echo $imgServer; ?>gen/green_button.png) repeat-x;
	font-weight: bolder;
	border: 1px solid #666;
	/*--Top left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	/*--Top left rounded corner--*/
	-moz-border-radius-topleft: 5px;
	-khtml-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Top right rounded corner--*/
	-moz-border-radius-topright: 5px;
	-khtml-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
}
.downloadButton a{
	color: #fff;
}
</style>

<?php


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/download_l.png" style="margin-top:3px; margin-right: 5px" /><div>' . $content['name'] . '.' . $content['ext'] . '</div></div>

<a href="/app/extensions/dropBox/dl.php?con_id=' . $content['id'] . '&cid=' . $class_id . '&s='.$student_id.'&a='.$assignment_id.'&dl=1" target="_blank"><div class="downloadButton">Download This File</div></a>

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