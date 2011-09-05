<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('./core/main.php');

$assignment_id = $_GET['a'];
$student_id = $_GET['s'];

// if it's an external load
if (is_numeric($_GET['n'])) {
	if ($_GET['n'] == 1) {		  
		require_once('core/view.php');
	}
	exit();
}
//  Load the files from here
$fileList = dropbox_contents($assignment_id,$student_id);
$student = getUser($student_id);
?>
<!--[if IE 7]><style type="text/css">
#selectable2{
			font-size: 12px;
			margin-left:-17px;

		}
#selectable2 li{
			margin-top:-10px;

		}</style>
<![endif]-->
<cc:crumbs><a href="index.php?aid=<?= $assignment_id ?>">Hand-In</a>{crumbSplit}<?= $student['first_name'].' '.$student['last_name'] ?></cc:crumbs>
<div style="width:750px; float:left">
<div id="boxCrumbs" style="font-size:10px">
<input type="radio" id="radio1" onClick="changeDir(0)" name="radio"><label class="fbHeadLeft" for="radio1">Home</label>
<?php
// print out our breadcrumbs
//  TODO: Make some decent breadcrumbs for the dropbox.
//  Maybe have one that goes back to assignment list and one that has the
//  name of the current student?
$list = array();
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
?>
</div>

<div id="fbHead2" style="font-size:12px">
<div class="createDate">Creation Date</div>
<div class="fileType">File Type</div>
<div class="fileName">Filename</div>

</div>

<div id="selectable2">
<?php
foreach ($fileList as $fEntry) {
	// does this file still exist?
	if ($fEntry['time_date'] != '') {

	if ($fEntry['format'] == 1) {
		$fEntry['name'] = $fEntry['name'] . '.' . $fEntry['ext'];
		$fEntry['format_name'] = strtoupper($fEntry['ext']) . ' ' . $fEntry['format_name'];
	}
	
	// different viewing options
	if ($fEntry['format'] == 1) {
		echo '<a href="dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="300">';
		
	} elseif ($fEntry['format'] == 2) {
		echo '<a href="' . htmlentities(urlencode('dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'])) . '" target="external">';
	
	} elseif ($fEntry['format'] == 3) {
		echo '<a href="dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 4) {
		echo '<a href="' . htmlentities(urlencode('dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'])) . '" target="embed">';
		
	} elseif ($fEntry['format'] == 5) {
		echo '<a href="dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 7) {
		echo '<a href="dropbox.php?a='.$assignment_id.'&s='.$student_id.'&dir=' . $fEntry['fid'] . '" onClick="window.location = \'/app/livelecture/Presenter/index.php?fid=' . $fEntry['id'] . '&cid=' . $class_id . '\'; return false">';

	} elseif ($fEntry['format'] == 9) {
		echo '<a href="dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="300">';
	
	} else {
		echo '<a href="' . htmlentities(urlencode('/dropbox.php?a='.$assignment_id.'&s='.$student_id.'&n=1&con_id=' . $fEntry['id'])) . '" target="external">';
	}
	?>
<li>
<div class="fileName"><img src="<?= $imgServer ?>fileBox/formats/<?= $fEntry['icon'] ?>.png" style="float:left;margin-right:5px" /><?= $fEntry['name'] ?></div>
<div class="fileType"><?= $fEntry['format_name'] ?></div>
<div class="createDate"><?= date('F j, Y', strtotime($fEntry['time_date'])) ?></div>
</li></a>
<?php
// detect if this file still exists
}

// end loop
}

if (empty($dirList) && empty($fileList) && $dirID == 0 && $class_level == 3) {
	echo '<li>Your student has not shared any files with you</li>';
} elseif (empty($dirList) && empty($fileList)) {
	echo '<li>No content found in this directory.</li>';
}
?>
</div> 
<br />
<br />
</div>
<script type="text/javascript">
	$(function() {
		$( "#boxCrumbs" ).buttonset();
	});
</script>