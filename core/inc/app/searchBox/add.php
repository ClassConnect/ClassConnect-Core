<?php
if (isset($_POST['name'])) {
	$name = escape($_POST['name']);
	$type = escape($_POST['type']);
	$code = escape($_POST['code']);
	$body = escape($_POST['body']);
	$target_id = escape($_POST['target']);
	
	if ($type == 1) {
		$newType = 2;
	} elseif($type == 3) {
		$newType = 3;
	} elseif($type == 4) {
	 	$newType = 5;
	 }
	
	$attempt = create_content($target_id, $user_id, $newType, $name, $body, $code, '', '', '');

	if ($attempt == 1) {
		echo '1';
	} else {
		echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	



	exit();
}
// if add request





echo '<script>

function addsearchCon() {
	dataString = $("#add-content").serialize();
	 $.ajax({
        type: "POST",
        url: "searchBox.cc?n=3",
        data: dataString,
        success: function(data) {
        		if (data == 1) {
        			$("#mainCon").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">Content Saved Successfully!</div>\');
        			setTimeout(function() {closeBox()} , 1500);
        		} else {
               $("#failer").html(data);
            }

        }

        });
	
}


	</script>';

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/save_l.png" style="margin-top:4px; margin-right: 5px" /><div>Save Content</div></div>
<div id="mainCon">
<script type="text/javascript" src="' . $scriptServer . 'folderPicker.js"></script>
<form method="GET" id="add-content" style="font-size:14px">

<div id="failer" style="margin-top:5px; margin-left:3px; margin-right:3px"></div>

<div style="margin-left:5px; margin-top:5px">
<strong>File Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:335px" maxlength="45" value="' . $_GET['title'] . '" /><br /><br />

<textarea name="code" style="display:none">' . $_GET['code'] . '</textarea>

<input type="hidden" name="type" value="' . $_GET['type'] . '" />

<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:335px">' . $_GET['desc'] . '</textarea>

</div>
<div style="margin-top:10px; font-weight:bolder; border-bottom:2px solid #999">&nbsp;&nbsp;Choose Folder</div>
<div id="selectBox" style="font-size:11px">



</div>

</form>
<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="addsearchCon();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Save Content
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>

</div>';	





?>