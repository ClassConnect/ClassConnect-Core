<?php
if (isset($_FILES['file'])) {
	$enc_name = gen_encName($user_id, $_FILES['file']['name']);
	$upload_file = upload_file($_FILES['file']['tmp_name'], $enc_name);
	
	if ($upload_file == 1) {
		
	// get the extension
	$ext = strtolower(substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1));
	$file_name = substr(substr($_FILES['file']['name'], 0, strrpos($_FILES['file']['name'], '.')), 0, 45);
	$file_size = $_FILES["file"]["size"];
	$file_type = $_FILES["file"]["type"];
	
	// insert it into the database
	$insertFile = create_file($fid, $user_id, $file_name, $ext, $file_type, $file_size, $enc_name);
	
	// if success
	if ($insertFile == 1) {
		echo '{"name":"'.$file_name.'.' . $ext . '","type":"'.$_FILES['file']['type'].'","size":"'.$_FILES['file']['size'].'"}';
	} else {
		echo '{"name":"Error. Please try again.","type":"0","size":"0"}';
	}
	
	
	} else {
		echo '{"name":"Error. Please try again.","type":"0","size":"0"}';
	}
	
	exit();
}




echo '<script src="' . $scriptServer . 'upload/jquery.fileupload.js"></script>
<script src="' . $scriptServer . 'upload/jquery.fileupload-ui.js"></script>';
?>
<style>
.file_upload {
  position: relative;
  overflow: hidden;
  direction: ltr;
  cursor: pointer;
  text-align: center;
  color: #333;
  font-weight: bold;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  width: 100%;
  height: 30px;
  line-height: 30px;
  background: palegreen;
  border: 1px solid limegreen;
}

.file_upload_small {
  width: 100%;
  height: 30px;
  line-height: 30px;
  font-size: auto;
  background: palegreen;
  border: 1px solid limegreen;
}

.file_upload_large {
  width: 100%;
  height: 150px;
  line-height: 150px;
  font-size: 20px;
  background: palegreen;
  border: 1px solid limegreen;
}

.file_upload_highlight {
  background: lawngreen;
}

.file_upload input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  border: 300px solid transparent;
  opacity: 0;
  -ms-filter: 'alpha(opacity=0)';
  filter: alpha(opacity=0);
  -o-transform: translate(-300px, -300px) scale(10);
  -moz-transform: translate(-800px, 0) scale(10);
  cursor: pointer;
}

.file_upload iframe, .file_upload button {
  display: none;
}

.file_upload_progress .ui-progressbar-value {
  background: url(pbar-ani.gif);
}

.file_upload_progress div {
  width: 150px;
  height: 15px;
}

.file_upload_cancel div {
  cursor: pointer;
}
</style>



<script>
$(function () {
    $('.upload').fileUploadUI({
        uploadTable: $('.upload_files'),
        downloadTable: $('.download_files'),
        buildUploadRow: function (files, index) {
            var file = files[index];
            return $('<tr><td>' + file.name.substr(0,42) + '<\/td>' +
                    '<td class="file_upload_progress"><img src="<?php echo $imgServer; ?>uploader.gif" style="margin-left:10px; margin-right:10px" /><\/td>' +
                    '<td class="file_upload_cancel">' +
                    '<div class="ui-state-default ui-corner-all ui-state-hover" title="Cancel">' +
                    '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
                    '<\/div><\/td><\/tr>');
        },
        buildDownloadRow: function (file) {
            return $('<tr><td>' + file.name + '<\/td><\/tr>');
        }
    });
});


function finishUpload() {
	updateFbox(<?php echo $fid; ?>);
	closeBox();
	
}

</script>

<?php


echo '
<div class="headTitle"><img src="' . $imgServer . 'gen/upload_l.png" style="margin-top:2px; margin-right: 5px" /><div>Upload Files</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form class="upload" action="filebox.cc?n=7&cType=' . $cType . '&fid=' . $fid . '" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" multiple>
    <button>Upload</button>
    <div>Add / Drag Files To Upload</div>
</form>
<table class="upload_files"></table>
<table class="download_files"></table>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="finishUpload();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Finish & Add Files
</button>
</div>';


?>