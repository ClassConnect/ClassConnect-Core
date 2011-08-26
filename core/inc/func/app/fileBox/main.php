<?php
 
// cloud info
$cloudUser = "ericmsimons"; // username
$cloudKey = "be8dfe902754b75852bfceb3b5c9e2bb"; // api key












// read a directory
function read_dirFiles($dirID, $uid) {
	if ($dirID == 0) {
		$append = " AND filebox_content.uid = $uid";
	}
	
		$list = good_query_table("SELECT * FROM filebox_content LEFT JOIN filebox_formats ON filebox_formats.format_id = filebox_content.format WHERE filebox_content.fid = $dirID $append ORDER BY name ASC");
	
	return $list;
	
}
// end read dir


// read a directory
function read_dirFolders($dirID, $uid) {
	if ($dirID == 0) {
		$append = " AND uid = $uid";
	}
	
	$list = good_query_table("SELECT * FROM filebox_folders WHERE parent_id = $dirID $append ORDER BY name ASC");
	
	return $list;
	
}
// end read dir




// authorize a user to read a directory
function auth_dir($dirID, $uid) {
	// home directory doesn't count
	if ($dirID != 0) {
		$folder = get_dir($dirID);
		
		// if this user owns the folders
		if ($folder['uid'] == $uid) {
			return true;
		// check if this user has permission to view this
		} else {
			return false;
			
			
			// class and personal auth
			/* $access = 0;
			$cfid = $dirID;
			
			while ($access != 1 || $cfid != 0) {
				$checkPer = good_query_assoc("SELECT * FROM filebox_permissions WHERE shareid = $dirID");
				$cfid =
			}
			*/
			
			
		}
	} else {
		return true;
	}
	
	
}
// end auth dir





// authorize a user to read content
function auth_content($conID, $uid) {

		$content = get_content($conID);
		
		// if this user owns the folders
		if ($content['uid'] == $uid) {
			return true;
		// check if this user has permission to view this
		} else {
			return false;
			
		}

	
	
}
// end auth dir




// get a directory's information
function get_dir($dirID) {
	$dirID = escape($dirID);
	// home directory doesn't count
	if ($dirID != 0) {
		$folder = good_query_assoc("SELECT * FROM filebox_folders WHERE id = $dirID");
		return $folder;
	}
	
	
}
// end auth dir




//get content
function get_content($conID) {
	$conID = escape($conID);
	$result = good_query_assoc("SELECT * FROM filebox_content WHERE id = $conID");
	return $result;
	
}
// end get_content





// find a directory's path
function dirPath ($dirID) {
	$pathArray = array();
	$tempDir = $dirID;
	
	// cycle through the parents
	while ($tempDir != 0) {
		$getFolder = good_query_assoc("SELECT * FROM filebox_folders WHERE id = $tempDir LIMIT 1");
		$tempDir = $getFolder['parent_id'];
		$pathArray[] = $getFolder;
	}
	
	// flip our array so that it's in the normal order
	$pathArray = array_reverse($pathArray);
	
	return $pathArray;
	
}
//end dirPath







// create content
function create_content($fid, $uid, $format, $name, $body, $content, $ext, $file_type, $size) {
	// init errors array
	$errors = array();
	
	$fid = escape($fid);
	$uid = escape($uid);
	// check if we own this folder
	if (auth_dir($fid, $uid) == true) {
		// clean the data
		if (is_numeric($format)) {
			$format = escape($format);
		} else {
			$errors[] = 'Invalid file format.';
		}
		
		if ($name != '') {
			$name = escape($name);
		} else {
			$errors[] = 'You forgot to enter a file name.';
		}
		
		$body = escape($body);
		$content = escape($content);
		$ext = escape($ext);
		$file_type = escape($file_type);
		$size = escape($size);
		
		if (empty($errors)) {
			good_query("INSERT INTO filebox_content (format, uid, fid, name, body, content, ext, file_type, size, time_date) VALUES ('$format', '$uid', '$fid', '$name', '$body', '$content', '$ext', '$file_type', '$size', NOW() )");
			return 1;
		}
		
	
	} else {
		$errors[] = 'No permissions found for this folder.';
	}// if we own this folder
	
	return $errors;
	
}
// end create_content






// update content
function update_content($conID, $uid, $name, $body, $content) {
	// init errors array
	$errors = array();
	
	$uid = escape($uid);
	// check if we own this folder
	if (auth_content($conID, $uid) == true) {
		
		if ($name != '') {
			$name = escape($name);
		} else {
			$errors[] = 'You forgot to enter a file name.';
		}
		
		$body = escape($body);
		$content = escape($content);
		$ext = escape($ext);
		$file_type = escape($file_type);
		$size = escape($size);
		
		if (empty($errors)) {
			good_query("UPDATE filebox_content SET name = '$name', body = '$body', content = '$content', time_date = NOW() WHERE id = $conID LIMIT 1");
			return 1;
		}
		
	
	} else {
		$errors[] = 'No permissions found for this file.';
	}// if we own this folder
	
	return $errors;
}
// end update content



// delete content
function delete_content($conIDs, $uid) {
	
	// clean our dir ids
	$conIDs = escape($conIDs);
	// turn our ids into an array
	$conArray = explode(',', $conIDs);
	
	foreach($conArray as $conID) {
		// loop through our array of dir ids
		if (is_numeric($conID)) {
		// if the dir id is numeric, append the update query
			good_query("DELETE FROM filebox_content WHERE id = $conID AND uid = $uid LIMIT 1");
                                                        good_query("DELETE FROM filebox_permissions WHERE share_id = $conID AND share_type = 2");
		}
			
	}
	return 1;
}
// end delete content



// create bookmark
function create_bookmark($fid, $uid, $name, $url, $body) {
	// init errors array
	$errors = array();
	
		// empty URL?
		if ($url == '') {
			$errors[] = 'You forgot to enter a URL.';
		}
	
		// check for http in URL
		if ((strpos($url, 'http://') !== false) || (strpos($url, 'https://') !== false)) {
			$url = escape($url);
		} else {
			$url = escape('http://' . $url);
		}
		
		
		if (empty($errors)) {
			$add = create_content($fid, $uid, 2, $name, $body, $url, '', '', '');
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		}
		
	
	return $errors;
	
}
// end create_bookmark



// create bookmark
function create_gdoc($fid, $uid, $name, $url, $body) {
	// init errors array
	$errors = array();
	
		// empty URL?
		if ($url == '') {
			$errors[] = 'You forgot to enter a URL.';
		}
	
		// check for http in URL
		if ((strpos($url, 'http://') !== false) || (strpos($url, 'https://') !== false)) {
			$url = escape($url);
		} else {
			$url = escape('http://' . $url);
		}
		
		
		if (empty($errors)) {
			$add = create_content($fid, $uid, 8, $name, $body, $url, '', '', '');
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		}
		
	
	return $errors;
	
}
// end create_bookmark



// create bookmark
function update_bookmark($conID, $uid, $name, $url, $body) {
	// init errors array
	$errors = array();
	
		// empty URL?
		if ($url == '') {
			$errors[] = 'You forgot to enter a URL.';
		}
	
		// check for http in URL
		if ((strpos($url, 'http://') !== false) || (strpos($url, 'https://') !== false)) {
			$url = escape($url);
		} else {
			$url = escape('http://' . $url);
		}
		
		
		if (empty($errors)) {
			$add = update_content($conID, $uid, $name, $body, $url);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		}
		
	
	return $errors;
	
}
// end create_bookmark



// generate a random file name
function gen_encName($uid, $name) {
	$enc_name = SHA1(date('m/d/Y/i/s') . $uid . $name . rand(1, 999999));
	return $enc_name;
}
//end random generate


// create file
function create_file($fid, $uid, $name, $ext, $file_type, $size, $enc_name) {
	// init errors array
	$errors = array();
	
		// empty name?
		if ($name == '') {
			$name = 'tempfile';
		}

			$add = create_content($fid, $uid, 1, $name, $body, $enc_name, $ext, $file_type, $size);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		
	
	return $errors;
	
}
// end create_bookmark



// create file
function create_img($fid, $uid, $name, $ext, $file_type, $size, $enc_name, $imgFile) {
	// init errors array
	$errors = array();
	global $cloudImgPub;
	$imgData = getimagesize($imgFile);
	
		// empty name?
		if ($name == '') {
			$name = 'tempfile';
		}

			$add = create_content($fid, $uid, 9, $name, $body, $cloudImgPub . $enc_name . '.' . $ext, $ext, $imgData[0], $imgData[1]);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		
	
	return $errors;
	
}
// end create_bookmark





// update file
function update_file($conID, $uid, $name, $body, $content) {
	// init errors array
	$errors = array();
	
		// empty name?
		if ($name == '') {
			$errors[] = 'You forgot to enter a file name.';
		}

if (empty($errors)) {
			$add = update_content($conID, $uid, $name, $body, $content);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
}
		
	
	return $errors;
	
}
// end update_file





// upload file to rackspace cloud
function upload_file($localfile, $enc_name, $type, $ext) {
// get cloud files ext
require_once('core/ext_api/cloudFiles/cloudfiles.php');
global $cloudUser;
global $cloudKey;
global $cloudBucket;
global $cloudImgBucket;
global $cloudImgPub;
	
	// Connect to Rackspace
$auth = new CF_Authentication($cloudUser, $cloudKey);
$auth->authenticate();
$conn = new CF_Connection($auth);
 
if ($type == 1) {
	// Get the container we want to use
	$container = $conn->get_container($cloudBucket);
	// create object
	$object = $container->create_object($enc_name);
} elseif ($type == 2) {
	// choose img container
	$container = $conn->get_container($cloudImgBucket);
	// create object
	$object = $container->create_object($enc_name . '.' . $ext);
}

 
// upload file to Rackspace
$object->load_from_filename($localfile);

return 1;
}
// end file upload





// create youtube video
function create_ytvideo($fid, $uid, $name, $url, $body) {
	// init errors array
	$errors = array();
	
		// empty URL?
		if ($url == '') {
			$errors[] = 'You forgot to enter a URL.';
		} else {
			$start = strrpos($url, 'watch?v=') + 8;
			$vid = substr($url, $start, 11);
			if ($vid == '') {
				$errors[] = 'You entered an invalid video URL.';
			}
			
		}
		
		
		if (empty($errors)) {
			$add = create_content($fid, $uid, 3, $name, $body, $vid, '', '', '');
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		}
		
	
	return $errors;
	
}
// end create_ytvideo





// update file
function update_ytvideo($conID, $uid, $name, $body, $vidID) {
	// init errors array
	$errors = array();
	
		// empty name?
		if ($name == '') {
			$errors[] = 'You forgot to enter a file name.';
		}

if (empty($errors)) {
			$add = update_content($conID, $uid, $name, $body, $vidID);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
}
		
	
	return $errors;
	
}
// end update_file






// create embed
function create_embed($fid, $uid, $name, $code, $body) {
	// init errors array
	$errors = array();
	
		// empty URL?
		if ($code == '') {
			$errors[] = 'You forgot to enter an embed code.';
		}
		
		
		if (empty($errors)) {
			$add = create_content($fid, $uid, 4, $name, $body, $code, '', '', '');
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
			
		}
		
	
	return $errors;
	
}
// end create_embed





// update embed
function update_embed($conID, $uid, $name, $body, $code) {
	// init errors array
	$errors = array();
	
		// empty name?
		if ($code == '') {
			$errors[] = 'You forgot to enter an embed code.';
		}

if (empty($errors)) {
			$add = update_content($conID, $uid, $name, $body, $code);
			if ($add == 1) {
				return 1;
			} else {
				return $add;
			}
}
		
	
	return $errors;
	
}
// end update_embed





// create a directory
function create_dir($parentID, $name, $uid) {
	$errors = array();
	$parentID = escape($parentID);
	if (auth_dir($parentID, $uid) == true) {
		if ($name != '') {
			$name = escape($name);
		} else {
			$errors[] = 'You forgot to enter a folder name.';
		}
		
		
	} else {
		$errors[] = 'You don\'t have permission to edit in this folder.';
	}
	
	if (empty($errors)) {
		good_query("INSERT INTO filebox_folders (parent_id, uid, name, time_date) VALUES ('$parentID', '$uid', '$name', NOW() )");
		return 1;
	} else {
		return $errors;
	}
	
}
// end create dir


// edit a directory
function update_dir($dirID, $name, $uid) {
		$errors = array();
	$dirID = escape($dirID);
	if (auth_dir($dirID, $uid) == true) {
		if ($name != '') {
			$name = escape($name);
		} else {
			$errors[] = 'You forgot to enter a folder name.';
		}
		
		
	} else {
		$errors[] = 'You don\'t have permission to edit this folder.';
	}
	
	if (empty($errors)) {
		good_query("UPDATE filebox_folders SET name = '$name' WHERE id = $dirID LIMIT 1");
		return 1;
	} else {
		return $errors;
	}
	
	
	
}
// end read dir




// function to delete a full directory
function del_dir($dirIDs, $uid) {
	
	// clean our dir ids
	$dirIDs = escape($dirIDs);
	// turn our ids into an array
	$dirArray = explode(',', $dirIDs);
	
	// loop through our array of dir ids
	foreach($dirArray as $folderID) {
	
		if (auth_dir($folderID, $uid) == true && $folderID != 0) {
			// get rid of the current directory
			good_query("DELETE FROM filebox_folders WHERE id = '$folderID' AND uid = '$uid' LIMIT 1");
		
			// delete all virtual files in this folder
			good_query("DELETE FROM filebox_content WHERE fid = '$folderID' AND uid = '$uid'");
                        
		good_query("DELETE FROM filebox_permissions WHERE share_id = $folderID AND share_type = 1");
			// retrieve all folders in this folder
			$listFolders = good_query_table("SELECT * FROM filebox_folders WHERE uid = '$uid' AND parent_id = '$folderID'");				
		
      	foreach ($listFolders as $row) {
        		del_dir($row['id'], $uid);
      	}
        	

		} // if this user is not authorized
	
	} // for each dir id received

} // end full directory delete


// move directories
function move_dir($dirIDs, $locationID, $uid) {
	
if (auth_dir($locationID, $uid) == true) {
	
	// clean our dir ids
	$dirIDs = escape($dirIDs);
	// turn our ids into an array
	$dirArray = explode(',', $dirIDs);
	
	// loop through our array of dir ids
	foreach($dirArray as $dirID) {
		// if the dir id is numeric, append the update query
		if (is_numeric($dirID) && ($dirID != $locationID)) {
			$allowMove = true;
			$tempDir = $locationID;
			// cycle through the parents
			while ($tempDir != 0) {
				if ($tempDir == $dirID) {
					$allowMove = false;
				}
				$getFolder = get_dir($tempDir);
				$tempDir = $getFolder['parent_id'];
			}

			// if we aren't moving this to a child
			if ($allowMove == true){
				good_query("UPDATE filebox_folders SET parent_id = '$locationID' WHERE id = $dirID AND uid = $uid LIMIT 1");
			}

		}
			
	}

} // if the location is verified
	
	
}
// end move dir




// move contents
function move_content($contentIDs, $locationID, $uid) {

if (auth_dir($locationID, $uid) == true) {
	
	// clean our dir ids
	$contentIDs = escape($contentIDs);
	// turn our ids into an array
	$conArray = explode(',', $contentIDs);
	
	// loop through our array of dir ids
	foreach($conArray as $conID) {
		// if the dir id is numeric, append the update query
		if (is_numeric($conID)) {
			good_query("UPDATE filebox_content SET fid = '$locationID' WHERE id = $conID AND uid = $uid LIMIT 1");
		}
			
	}

} // if the location is verified
	
	
}
// end move contents




// get a single object's sharing permissions
function get_single_per($conID, $dirID) {
	$permArray = array();
	
	// if it's a file
	if ($conID != null) {
		$conID = escape($conID);
		$filePerm = good_query_table("SELECT * FROM filebox_permissions WHERE share_id = $conID AND share_type = 2");
		foreach($filePerm as $fileRow) {
			$permArray[] = $fileRow;
		}
	}
	
	
	
	
	if ($dirID != null) {
		$dirID = escape($dirID);
		$folderPerm = good_query_table("SELECT * FROM filebox_permissions WHERE share_id = $dirID AND share_type = 1");
		foreach($folderPerm as $folderRow) {
			$permArray[] = $folderRow;
		}
	}
	
	return $permArray;
	
}
// end





// get permissions for an object
function get_permissions($conID, $dirID) {
	$permArray = array();
	if ($conID != null) {
		$conID = escape($conID);
		$filePerm = good_query_table("SELECT * FROM filebox_permissions WHERE share_id = $conID AND share_type = 2");
		foreach($filePerm as $fileRow) {
			$permArray[] = $fileRow;
		}
		$contentData = get_content($conID);
		$dirID = $contentData['fid'];
	}
	
	$tempDir = $dirID;
	
	// cycle through the parents
	while ($tempDir != 0) {
		// get permissions for this folder
		$folderPerm = good_query_table("SELECT * FROM filebox_permissions WHERE share_id = $tempDir AND share_type = 1");
		// loop through array of results
		foreach($folderPerm as $folderRow) {
			$permArray[] = $folderRow;
		}
		// retrieve this folder's info
		$getFolder = get_dir($tempDir);
		$tempDir = $getFolder['parent_id'];
	}
	
	return $permArray;
}
// end check permissions





// check if an element is in the permissions array
function is_permitted($array, $share_type, $share_id, $suid, $si_type) {
	
	foreach($array as $permission) {
		if (($permission['suid'] == $suid) && ($permission['si_type'] == $si_type) && ($permission['share_type'] == $share_type) && ($permission['share_id'] == $share_id)) {
			return true;
		}	
	}
	
	// no permissions found?
	return false;
}
// end





// check suid against grandfather
function is_grandfather($array, $suid, $si_type) {
	$final = false;
	foreach($array as $permission) {
		if ($permission['suid'] == $suid && $permission['si_type'] == $si_type) {
			$final = true;
		}
	}

return $final;
	
}
// end



// see if this object should have a selected or unselected as default
function is_selected($conArray, $folArray, $array, $suid, $si_type) {
	$countSet = 0;
	$countUnset = 0;
	foreach ($conArray as $conID) {
		if (is_numeric($conID)) {
			if (is_permitted($array, 2, $conID, $suid, 1)) {
				$countSet++;
			} else {
				$countUnset++;
			}
			
		}
		
	}
	
	foreach ($folArray as $dirID) {
		if (is_numeric($dirID)) {
			if (is_permitted($array, 1, $dirID, $suid, 1)) {
				$countSet++;
			} else {
				$countUnset++;
			}
			
		}
		
	}
	
	// time to return our results
	// if all results are unset
	if ($countSet == 0 && $countUnset != 0) {
		return 1;
	
	// if there are only set items
	} elseif ($countSet != 0 && $countUnset == 0) {
		return 2;
		
	// if there is a random mix, don't show anything but warn them
	} else {
		return 3;
	}

}
/// end




// add a permission
function add_permission($share_type, $share_id, $suid, $si_type, $uid) {
	if ($share_type == 1) {
		$ver = auth_dir($share_id, $uid);
	} else {
		$ver = auth_content($share_id, $uid);
	}
	
	if ($ver == true) {
		// delete any existing
		del_permission($share_type, $share_id, $suid, $si_type, $uid);
	
		// insert our new one!
		good_query("INSERT INTO filebox_permissions (share_id, uid, suid, share_type, si_type, reg_date) VALUES ('$share_id', '$uid', '$suid', '$share_type', '$si_type', NOW() )");
	}
}

// remove a permission
function del_permission($share_type, $share_id, $suid, $si_type, $uid) {
	if ($share_type == 1) {
		$ver = auth_dir($share_id, $uid);
	} else {
		$ver = auth_content($share_id, $uid);
	}
	
	if ($ver == true) {
	good_query("DELETE FROM filebox_permissions WHERE share_type = '$share_type' AND share_id = '$share_id' AND suid = '$suid' AND si_type = '$si_type' AND uid = '$uid' LIMIT 1");
	}
}











// class only functions

// get home dirs
function get_home_dirs($classID) {
	$home = good_query_table("SELECT * FROM filebox_permissions LEFT JOIN filebox_folders ON filebox_permissions.share_id = filebox_folders.id WHERE si_type = '1' AND share_type = '1' AND suid = '$classID' ORDER BY `share_type` ASC, `reg_date` DESC");
	
	return $home;
}
// end get homedirs function




// get home dirs
function get_home_content($classID) {
	$home = good_query_table("SELECT * FROM filebox_permissions LEFT JOIN filebox_content ON filebox_permissions.share_id = filebox_content.id LEFT JOIN filebox_formats ON filebox_formats.format_id = filebox_content.format WHERE si_type = '1' AND share_type = '2' AND suid = '$classID' ORDER BY `share_type` ASC, `time_date` DESC");
	
	return $home;
}
// end get home content 
?>