<?php

if (isset($_GET['password'])) {

// clean dir ids
$_GET['ids'] = escape($_GET['ids']);

// clean content ids
$_GET['cids'] = escape($_GET['cids']);
	

del_dir($_GET['ids'], $user_id);

delete_content($_GET['cids'], $user_id);

echo '1';

exit();
} // if move request here

?>

<script>
var origFolder = getCurrentFolder();

function submitDelete() {
 dataString = $("#delete-content").serialize();
var totalStr = '';
				for(var i=0; i<activeFolders.length; i++) {
        			totalStr += activeFolders[i] + ',';
    			}
    			var totalCon = '';
				for(var i=0; i<activeFiles.length; i++) {
        			totalCon += activeFiles[i] + ',';
    			}
 $.ajax({
   type: "GET",
   url: "filebox.cc?n=12&ids=" + totalStr + "&cids=" + totalCon,
   data: dataString,
   success: function(msg){
   	if (msg == 1) {
   		closeBox();
   		updateFbox(origFolder);
   	}
   }
 });	

}


</script>

<?php


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/del_l.png" style="margin-top:5px; margin-right: 5px" /><div>Delete Selected Content</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="delete-content" style="font-size:14px; margin-top:10px">	
Are you sure you want to delete this content?

<input type="password" name="password" size="1" style="display:none" value="submit" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="submitDelete();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Confirm & Delete
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';

?>