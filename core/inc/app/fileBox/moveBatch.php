<?php
if (isset($_GET['target'])) {

// clean dir ids
$_GET['ids'] = escape($_GET['ids']);

// clean content ids
$_GET['cids'] = escape($_GET['cids']);
	

move_dir($_GET['ids'], $_GET['target'], $user_id);

move_content($_GET['cids'], $_GET['target'], $user_id);

echo '1';

exit();
} // if move request here

echo '<script>
var origFolder = getCurrentFolder();
function resetFolder() {
	parent.location.hash = origFolder;
}


function submitMove() {
 dataString = $("#move-content").serialize();
var totalStr = \'\';
				for(var i=0; i<activeFolders.length; i++) {
        			totalStr += activeFolders[i] + \',\';
    			}
    			var totalCon = \'\';
				for(var i=0; i<activeFiles.length; i++) {
        			totalCon += activeFiles[i] + \',\';
    			}
 $.ajax({
   type: "GET",
   url: "filebox.cc?n=11&ids=" + totalStr + "&cids=" + totalCon,
   data: dataString,
   success: function(msg){
   	if (msg == 1) {
   		closeBox();
   		updateFbox(origFolder);
   	}
   }
 });

}

	</script>';

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/move_l.png" style="margin-top:3px; margin-right: 5px" /><div>Move Content</div></div>
<script type="text/javascript" src="' . $scriptServer . 'folderPicker.js"></script>

<form method="GET" id="move-content">
<div id="selectBox">



</div>
</form>
<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="submitMove();" onMouseUp="resetFolder();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Move To Selected Folder
</button>
<button class="button" onClick="closeBox();" onMouseUp="resetFolder();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';	




?>