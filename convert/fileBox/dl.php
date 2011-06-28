<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// include core stuff
require_once('../../core/inc/func/app/fileBox/main.php');

$content_id = escape($_GET['con_id']);
$class_id = escape($_GET['cid']);
if (!authClass($class_id)) {
    echo 'Oops! Looks like you clicked a bad link.';
    exit();
}
$permissions = get_permissions($content_id, null);
if (is_grandfather($permissions, $class_id, 1) || is_permitted($permissions, 1, $content_id, $class_id, 1)) {
$content = get_content($content_id);
// download request
if (isset($_GET['dl'])) {
		header("content-type: " . $content['file_type']);

		header('Content-Disposition: attachment; filename="' . $content['name'] . '.' . $content['ext'] . '"');

		header('content-length: ' . $content['size']);

		readfile($cloudServer . $content['content']);

	exit();
}
}
?>