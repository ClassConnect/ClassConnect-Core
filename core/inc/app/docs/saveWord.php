<?php
if (isset($_GET['dl'])) {


if (auth_content($_GET['content'], $user_id)) {
$docData = get_content($_GET['content']);
   
   $chash = substr(SHA1('cc4' . date('m/d/Y/i/s') . rand(1, 9999)),0,10);
   
   header("content-type: application/msword");
	
	header('Content-Disposition: attachment; filename="' . $chash . '.doc"');

	echo str_replace('\n', "\n", reverse_htmlentities($docData['content']));
}
	exit();
}

?>
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

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/dlDoc.png" style="margin-top:3px; margin-right: 7px" /><div>Download As Word Doc</div></div>
<a href="writer.cc?n=4&content=' . urlencode(htmlentities($_GET['content'])) . '&dl=1" target="_blank"><div class="downloadButton">Create & Download Doc</div></a>
<div style="margin:5px">
<span style="font-size:14px">Click the button above to create & download your current document as a Microsoft Word Document.</a>
</div>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';
?>