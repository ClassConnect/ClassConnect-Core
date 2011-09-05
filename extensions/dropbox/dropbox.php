<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('./core/main.php');

//  Load the files from here

// if it's an external load
if (is_numeric($_GET['n'])) {
	if ($_GET['n'] == 1) {		  
			require_once('core/view.php');
		}
	}
	exit();
}

$assignment_id = $_GET['a'];
$student_id = $_GET['s'];
$fileList = dropbox_contents($assignment_id,$student_id);
?>
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
<div style="width:750px; float:left">
<div id="boxCrumbs" style="font-size:10px">
<input type="radio" id="radio1" onClick="changeDir(0)" name="radio"><label class="fbHeadLeft" for="radio1">Home</label>';
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
		echo '<a href="dropbox.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="300">';
		
	} elseif ($fEntry['format'] == 2) {
		echo '<a href="' . htmlentities(urlencode('dropbox.php?n=1&con_id=' . $fEntry['id'])) . '" target="external">';
	
	} elseif ($fEntry['format'] == 3) {
		echo '<a href="dropbox.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 4) {
		echo '<a href="' . htmlentities(urlencode('dropbox.php?n=1&con_id=' . $fEntry['id'])) . '" target="embed">';
		
	} elseif ($fEntry['format'] == 5) {
		echo '<a href="dropbox.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="480" shadow="1">';
		
	} elseif ($fEntry['format'] == 7) {
		echo '<a href="dropbox.php?dir=' . $fEntry['fid'] . '" onClick="window.location = \'/app/livelecture/Presenter/dropbox.php?fid=' . $fEntry['id'] . '&cid=' . $class_id . '\'; return false">';

	} elseif ($fEntry['format'] == 9) {
		echo '<a href="dropbox.php?n=1&con_id=' . $fEntry['id'] . '" target="dialog" width="300">';
	
	} else {
		echo '<a href="' . htmlentities(urlencode('dropbox.php?n=1&con_id=' . $fEntry['id'])) . '" target="external">';
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
	echo '<li>To add content to ShareBox, go to <a href="dropbox.php" onClick="window.location=\'filebox.cc\'">FileBox</a> and share the desired content with your classes. <a href="#" onClick="openBox(\'/app/core/ajax/barjax/echo.php?data=' . urlencode('<img src="/app/core/site_img/gen/cross.png" style="position:absolute;margin-top:-30px; margin-left:560px; border:3px solid #999; background:#eee; padding:5px; cursor:pointer" onClick="closeBox();" /><iframe width="560" height="349" src="http://www.youtube.com/embed/mf9_SqyIt1w" frameborder="0" allowfullscreen></iframe>') . '\', 560); return false">(watch a video)</a></li>';
} elseif (empty($dirList) && empty($fileList)) {
	echo '<li>No content found in this directory.</li>';
}
?>
</div> 
<br />
<br />
</div>

// activate buttons
<script type="text/javascript">
	$(function() {
		$( "#boxCrumbs" ).buttonset();
	});
</script>