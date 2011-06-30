<?php
// exit for students
if (isset($_GET['classIDs']) && $level == 1) {
    exit();
}

if ($level == 3) {

// clean parent id
$_GET['parent'] = escape($_GET['parent']);

if (!is_numeric($_GET['parent'])) {
	$_GET['parent'] = 0;
}

// clean dir ids
$_GET['ids'] = escape($_GET['ids']);

// clean content ids
$_GET['cids'] = escape($_GET['cids']);


$singlePers = array();
$parentPers = array();

// make our dirIDs into an array
$dirIDs = explode(',', $_GET['ids']);

$conIDs = explode(',', $_GET['cids']);










if (isset($_GET['classIDs'])) {
	$idArray = explode(',', $_GET['classIDs']);
	
	foreach($idArray as $classKey) {
            if (authClass($classKey)) {
		if(is_numeric($classKey)) {
			if (isset($_GET['class' . $classKey])) {
			// insert dir permissions
			foreach($dirIDs as $dirID) {
				if (is_numeric($dirID)) {
					add_permission(1, $dirID, $classKey, 1, $user_id);
				}
			}
	// insert file permissions
	foreach($conIDs as $conID) {
		if (is_numeric($conID)) {
		add_permission(2, $conID, $classKey, 1, $user_id);
		}
	}

// send a notification for new content added
$cdata = getClassSession($classKey);
sendClassNotification($classKey, $cdata['name'] . ' has just shared new content with your class in <a href="class.cc?id=' . $cdata['id'] . '#4">ShareBox</a>.');

// if no class key, delete
} else {
	
	
	
	foreach($dirIDs as $dirID) {
				if (is_numeric($dirID)) {
					del_permission(1, $dirID, $classKey, 1, $user_id);
				}
			}
	// insert file permissions
	foreach($conIDs as $conID) {
		if (is_numeric($conID)) {
		del_permission(2, $conID, $classKey, 1, $user_id);
		}
	}
			}
			
			
			
		} // is_numeric
            }
	} // foreach
	
	
echo '1';
exit();
}

}










// do a single search for all pers on our folders
foreach($dirIDs as $dirID) {
	if (is_numeric($dirID)) {
	$perArray = get_single_per(null, $dirID);
	foreach($perArray as $folderArray) {
			$singlePers[] = $folderArray;
	}
	}
}


// do a single search for all pers on our content
foreach($conIDs as $conID) {
	if (is_numeric($conID)) {
	$perConArray = get_single_per($conID, null);
	foreach($perConArray as $fileArray) {
			$singlePers[] = $fileArray;
	}
	}
}


// go up through our parent dir and get existing permissions
$parentArray = get_permissions(null, $_GET['parent']);
	foreach($parentArray as $grandfatherArray) {
			$parentPers[] = $grandfatherArray;
	}




if (auth_dir($_GET['parent'], $user_id) == true) {


// is_permitted($totalPers, $share_type, $share_id, $suid, $si_type)

echo '<script>
$( "#contents" ).buttonset();
var pid = ' . $_GET['parent'] . ';
function updateSharing() {
        dataString = $("#update-sharing").serialize();
        $.ajax({
        type: "GET",
        url: "filebox.cc?n=13&ids=' . $_GET['ids'] . '&cids=' . $_GET['cids'] . '",
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

';

echo '<div class="headTitle"><img src="' . $imgServer . 'gen/share_l.png" style="margin-right: 5px" /><div>Set Sharing Permissions</div></div>
<form method="GET" id="update-sharing">
<div id="failer"></div>
<div style="margin:5px; font-size:10px">Select which classes can access this content. Remember, when sharing a folder, all content in every subfolder will be able to be accessed as well.</div>
<div id="contents">
';
if ($level == 3) {
foreach($myClasses as $cur_class) {
	// if this class is not grandfathered by a parent dir
	if (is_grandfather($parentPers, $cur_class['id'], 1) == false) {
		
		$bool_select = is_selected($conIDs, $dirIDs, $singlePers, $cur_class['id'], 1);
		if ($bool_select == 2) {
			$checked = 'checked';
		}
		echo '<input type="checkbox" id="check' . $cur_class['id'] . '" name="class' . $cur_class['id'] . '" value="' . $cur_class['id'] . '"' . $checked . ' /><label for="check' . $cur_class['id'] . '" class="fullRound" style="width:160px; margin-top:5px; margin-left:10px">' . $cur_class['name'] . '</label>';
	$totalCID = $totalCID . $cur_class['id'] . ',';
	} else {
		// grandfathered in
		echo '<div style="float:left;color:#fff; height:25px; width:160px; margin-top:5px; margin-left:10px; background-color:#666; text-align:center; line-height:100%" class="fullRound"><strong>' . $cur_class['name'] . '</strong><br /><span style="font-size:10px; color:#ccc">is shared via a parent folder.</span></div>';
	}
	
	// reset checked variable
	$checked = '';
}
}

echo '
<input type="hidden" name="classIDs" value="' . $totalCID . '" />
</form>


</div>
<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="updateSharing();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Update Sharing Permissions
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';	
} // auth Dir





?>