<script type="text/javascript">
	$(function() {
		$( "#navCrumber" ).buttonset();
	});
	</script>

<div id="navCrumber">

<?php
$arrow = '<img src="/cc4/app/core/site_img/main/l_arrow.png" style="height:8px" />';

if ($_GET['id'] != 0) {
	$home_arrow = $arrow;
}
?>
<input type="radio" id="radio1" name="radio" onClick="updateFbox(0, 1)" /><label class="fbHeadLeft" for="radio1">Home</label>

<?php
//retrieve the directory ID
if (is_numeric($_GET['id'])) {
	$currentDir = $_GET['id'];
} else {
	$currentDir = 0;
}
if (auth_dir($currentDir, $user_id) == true) {
	
$dirList = dirPath($_GET['id']);
$start = 1;
foreach ($dirList as $dirRow) {
	if ($start == count($dirList)) {
		$style = ' class="fbHeadRight"';
		$checked = ' checked="checked"';
		$arrow = '';
	}
	
	echo '<input type="radio" id="rd' . $dirRow['id'] . '"  onClick="updateFbox(' . $dirRow['id'] . ', 1)" name="radio"' . $checked . ' /><label for="rd' . $dirRow['id'] . '"' . $style . '">' . $dirRow['name'] . '</label>';
	$start++;
}
}
?>
</div>