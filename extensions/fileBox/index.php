<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('../../core/inc/func/app/fileBox/main.php');

// get the dir id
if (isset($_GET['dir']) & is_numeric($_GET['dir'])) {
	$dirID = escape($_GET['dir']);
// set it to home as fallback
} else {
	$dirID = 0;
}

// if it's an external load
if (is_numeric($_GET['n'])) {
	// view content
	if ($_GET['n'] == 1) {
		if (isset($_GET['con_id'])) {
			
			$permissions = get_permissions(escape($_GET['con_id']), null);
			require_once('core/view.php');
			
		}

	}

	exit();
}

// declare crumbs
echo '<cc:crumbs>ShareBox</cc:crumbs>';

// load filebox JS
echo '<script type="text/javascript" src="' . $scriptServer . 'class/fbox.js"></script>';


if ($dirID == 0) {
	// allow access 
	$allow = true;
	// get dir list
	$dirList = get_home_dirs($class_id);
	// get file list
	$fileList = get_home_content($class_id);
	
	
} else {
	$permissions = get_permissions(null, $dirID);

$allowed = false;
foreach ($permissions as $per) {
	if ($per['suid'] == $class_id) {
		$allow = true;
		$end_per = $per['share_id'];
	}
}

	
	
	$dirList = read_dirFolders($dirID, $user_id);
	
	$fileList = read_dirFiles($dirID, $user_id);
}

if ($allow) {
// load gen filebox template
echo '<!--[if IE 7]><style type="text/css">
#selectable2{
			font-size: 12px;
			margin-left:-17px;

		}
#selectable2 li{
			margin-top:-10px;

		}</style>
<![endif]-->
<div style="width:750px"; float:left">

<div id="boxCrumbs" style="font-size:10px">
<input type="radio" id="radio1" onClick="changeDir(0)" name="radio"><label class="fbHeadLeft" for="radio1">Home</label>';

// print out our breadcrumbs
$list = dirPath($dirID);
$start = 1;
$total = count($list);
foreach ($list as $dirRow) {
	if ($dirRow['id'] == $end_per) {
			$end = 1;
	} else {
		if ($end != 1) {
			$total -= 1;
		}
	}
	
	if ($end == 1) {

	if ($start == $total) {
		$style = ' class="fbHeadRight"';
		$checked = ' checked="checked"';
		$arrow = '';
	}
	
	echo '<input type="radio" id="rd' . $dirRow['id'] . '"  onClick="changeDir(' . $dirRow['id'] . ')" name="radio"' . $checked . ' /><label for="rd' . $dirRow['id'] . '"' . $style . '">' . $dirRow['name'] . '</label>';
	$start++;
	}
}


echo '</div>

<div id="fbHead2" style="font-size:12px">
<div class="createDate">Creation Date</div>
<div class="fileType">File Type</div>
<div class="fileName">Filename</div>

</div>

<div id="selectable2">';

// print out all of the directories
foreach ($dirList as $entry) {
	echo '<a href="index.php?dir=' . $entry['id'] . '"><li>
<div class="fileName"><img src="' . $imgServer . 'fileBox/folder.png" style="float:left;margin-right:5px" />' . $entry['name'] . '</div>

<div class="fileType">Folder</div>

<div class="createDate">' . date('F j, Y', strtotime($entry['time_date'])) . '</div>


</li></a>';
}



foreach ($fileList as $fEntry) {
	if ($fEntry['format'] == 1) {
		$fEntry['name'] = $fEntry['name'] . '.' . $fEntry['ext'];
		$fEntry['format_name'] = strtoupper($fEntry['ext']) . ' ' . $fEntry['format_name'];
	}
	
	// different viewing options
	if ($fEntry['format'] == 1) {
		echo '<a href="index.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="300">';
		
	} elseif ($fEntry['format'] == 2) {
		echo '<a href="' . htmlentities(urlencode('index.php?n=1&con_id=' . $fEntry['id'])) . '" target="external">';
	
	} elseif ($fEntry['format'] == 3) {
		echo '<a href="index.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 4) {
		echo '<a href="' . htmlentities(urlencode('index.php?n=1&con_id=' . $fEntry['id'])) . '" target="embed">';
		
	} elseif ($fEntry['format'] == 5) {
		echo '<a href="index.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 7) {
		echo '<a href="#" onClick="window.location = \'/app/livelecture/Presenter/index-debug.html?fid=' . $fEntry['id'] . '&cid=' . $class_id . '\'">';
	
	} else {
		echo '<a href="' . htmlentities(urlencode('index.php?n=1&con_id=' . $fEntry['id'])) . '" target="external">';
	}
	
	echo '<li>
	
<div class="fileName"><img src="' . $imgServer . 'fileBox/formats/' . $fEntry['icon'] . '.png" style="float:left;margin-right:5px" />' . $fEntry['name'] . '</div>

<div class="fileType">' . $fEntry['format_name'] . '</div>

<div class="createDate">' . date('F j, Y', strtotime($fEntry['time_date'])) . '</div>


</li></a>';
}


if (empty($dirList) && empty($fileList)) {
	echo '<li>No content found in this directory.</li>';
}

echo '</div> 
<br /><br />
</div>';

// activate buttons
echo '<script type="text/javascript">
	$(function() {
		$( "#boxCrumbs" ).buttonset();
	});
	</script>';

// allow not = true
} else {
	echo '<center>You do not have permission to view this content</center>';
}

?>