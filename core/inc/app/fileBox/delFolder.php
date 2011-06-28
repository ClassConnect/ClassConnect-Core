<?php
// clean folder id
$_GET['fid'] = escape($_GET['fid']);

// authorize us
if (auth_dir($_GET['fid'], $user_id) == true) {
	$currentDir = get_dir($_GET['fid']);

// if they submitted a post update
if (isset($_POST['password'])) {
	$attempt = del_dir($_GET['fid'], $user_id);
	echo '1';
	
	exit();
}

?>

<script>
function validateDelete() {
        dataString = $("#delete-folder").serialize();
        var fid = <?php echo $_GET['fid']; ?>;
        var pid = <?php echo $currentDir['parent_id']; ?>;
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=5&fid=" + fid,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(pid);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}

</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/del_l.png" style="margin-top:6px; margin-right: 5px" /><div>Delete Folder</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="delete-folder" style="font-size:14px; margin-top:10px">	
Are you sure you want to delete \'' . $currentDir['name'] . '\' and all files/folders contained in it?
<input type="password" size="1" style="display:none" name="password" value="hello" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="validateDelete();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Confirm & Delete Folder
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';

} // if were authorized
?>