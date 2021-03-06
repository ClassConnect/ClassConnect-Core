<?php
// include core stuff
require_once('../../../core/inc/coreInc.php');
// app extension file
require_once('../../core/schoolMain.php');
// local extension file
require_once('../core/main.php');

$data = getSchool($school_id);

echo '<cc:crumbs>School Information</cc:crumbs>';

echo '<div style="margin-left:10px; float:right; width:370px; overflow:hidden">
<span style="color:#333; font-size:18px; font-weight:bolder">Location</span><br />
<br />
<div style="margin-top:-6px"><span style="font-size:16px">' . $data['city'] . '<br />' . $data['state'] . ' ' . $data['zip'] . '<br />' . $data['country'] . '</span></div>

</div>


<div style="margin-left:10px; float:left; width:350px; border-right:1px solid #ccc; overflow:hidden">
<span style="color:#333; font-size:18px; font-weight:bolder">Contact Info</span><br />
<br /><span style="color:#666; font-size:16px;line-height:0.5">website</span><br />
<span style="font-size:16px">';
if (isset($data['website'])) {
	if (strpos($data['website'], 'http://') === false) {
		$prepender = 'http://';
	}
	echo '<a href="' . $prepender . $data['website'] . '" target="_blank">' . $data['website'] . '</a>';
} else {
	echo 'none available.';
}

echo '</span><br /><br />

<span style="color:#666; font-size:16px;line-height:0.5">phone</span><br />
<span style="font-size:16px">';
if (isset($data['phone'])) {
	echo $data['phone'];
} else {
	echo 'none available.';
}
echo '</span><br /><br />

<span style="color:#666; font-size:16px;line-height:0.5">description</span><br />
<span style="font-size:16px">';

if (isset($data['body'])) {
	echo $data['body'];
} else {
	echo 'none available.';
}

echo '</span><br /><br />

</div>';
?>
