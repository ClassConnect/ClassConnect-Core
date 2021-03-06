<?php
// clean folder id
$_GET['fid'] = escape($_GET['fid']);

// authorize us
if (auth_dir($_GET['fid'], $user_id) == true) {
	$currentDir = get_dir($_GET['fid']);

// if they submitted a post update
if (isset($_POST['name'])) {
	$_POST['name'] = escape($_POST['name']);
	$attempt = update_dir($_GET['fid'], $_POST['name'], $user_id);
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

?>

<script>
function validateFedit() {
        $('#bottom').after('<img src="core/site_img/loading.gif" id="loadImgur" style="margin-right:30px; margin-bottom:4px; float:right" />');
        $('#bottom').hide();
        dataString = $("#update-folder").serialize();
        var fid = <?php echo $_GET['fid']; ?>;
        var pid = <?php echo $currentDir['parent_id']; ?>;
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=4&fid=" + fid,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(pid);
         } else {
         	 $("#failer").html(data).slideDown(400);
                 $('#loadImgur').remove();
                 $('#bottom').show();
         	 
         }
               
       }

        });
}

</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/addFolder.png" style="margin-top:3px; margin-right: 3px" /><div>Edit Folder</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="update-folder" style="font-size:14px; margin-top:10px">	
<strong>Folder Name: </strong> <span style="color:#dd1100;font-style: bolder">*</span> 
<input type="text" name="name" style="width:215px" maxlength="45" value="' . $currentDir['name'] . '" />
<input type="password" size="1" style="display:none" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="validateFedit();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Update Folder
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';

} // if were authorized
?>