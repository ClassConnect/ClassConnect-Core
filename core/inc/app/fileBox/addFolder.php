<?php
if (isset($_POST['name'])) {
	$attempt = create_dir($_GET['fid'], $_POST['name'], $user_id);
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
function validateFolder() {
        dataString = $("#add-folder").serialize();
        var fid = <?php echo $_GET['fid']; ?>;
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=3&fid=" + fid,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(fid);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}

</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/addFolder.png" style="margin-top:3px; margin-right: 3px" /><div>Add Folder</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="add-folder" style="font-size:14px; margin-top:10px">	
<strong>Folder Name: </strong> <span style="color:#dd1100;font-style: bolder">*</span> 
<input type="text" name="name" style="width:215px" maxlength="45" />
<input type="password" size="1" style="display:none" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="validateFolder();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Create Folder
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>