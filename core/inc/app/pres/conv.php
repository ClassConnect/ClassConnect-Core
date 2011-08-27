<?php
// if its the upload page
if (isset($_GET['uper'])) {
	if (isset($_FILES['file'])) {
		require_once('core/inc/func/app/fileBox/main.php');
		$enc_name = gen_encName($user_id, $_FILES['file']['name']);
		$ext = strtolower(substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1));
		$upload_file = upload_file($_FILES['file']['tmp_name'], $enc_name, 1, $ext);

		if ($upload_file == 1) {
		
	// get the extension
	$file_name = substr(substr($_FILES['file']['name'], 0, strrpos($_FILES['file']['name'], '.')), 0, 35);
	$file_size = $_FILES["file"]["size"];
	$file_type = $_FILES["file"]["type"];
	
    // insert it as a regular file
    $insertDoc = @mysqli_query($dbc, "INSERT INTO filebox_content (format, uid, fid, name, content, ext, file_type, size, time_date) VALUES ('1', '$user_id', '0', '$file_name', '$enc_name', '$ext', '$file_type', '$file_size', NOW() )");
	$doc_id = $dbc->insert_id;
  
	
		echo '<script language="javascript" type="text/javascript">window.top.window.openBox("presentations.cc?n=6&id=' . $doc_id . '", 350);</script>';
	
	
	}

	}


	exit();
}

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/convppt.png" style="margin-top:3px; margin-right: 7px;width:32px" /><div>Import PowerPoint</div></div>

<script type="text/javascript">
function submitFile() {
	if ($("#fileTest").val()) {
		$("#hideForm").hide();
		$("#hideForm").after(\'<center><br /><br />Uploading your presentation...<br /><img src="' . $imgServer . 'loading.gif" /><br /><br /></center>\');
	} else {
		return false;
	}
}
</script>
<div id="failer" style="display:none"></div>';

echo '<div class="wizard-steps">
  <div class="completed-step"><a href="#" class="beginning current"><img src="' . $imgServer . 'gen/upload.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Upload</a></div>
  <div class="active-step"><a href="#"><img src="' . $imgServer . 'gen/conv.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Convert</a></div>
  <div><a href="#" class="end"><img src="' . $imgServer . 'gen/tick.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Open Lecture</a></div>
</div>';

echo '
<form id="hideForm" action="presentations.cc?n=4&uper=1" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="submitFile();">
<div style="margin-left:10px;margin-top:60px;border:1px solid #ccc;margin-right:10px">
<div style="color:#333;font-size:14px;background:#fff;margin-top:-10px;margin-left:10px;width:150px;padding-left:5px">Upload a presentation</div>
<center><input name="file" type="file" id="fileTest" style="border:none;font-size:12px;margin-top:5px;margin-bottom:10px" /></center>
</div>
<div style="margin-left:15px;margin-top:10px;margin-right:10px"><strong>Note:</strong> Only text will be converted. Both your PowerPoint file and your converted Lecture will be saved in your FileBox.</div>
<iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>

<div id="bottom" style="margin-top:15px; margin-bottom:5px; float:right">
<button class="button" type="submit"> 
<img src="' . $imgServer . 'gen/upload.png" /> Upload & Convert Presentation
</button>
<a href="#" class="button" onClick="closeBox();return false"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</a>
</div>
</form>';


?>