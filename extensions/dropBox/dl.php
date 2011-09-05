<?php
// include core stuff
require_once('../../core/inc/coreInc.php');

require_once('core/main.php');

//  Set the class level to 3, just for dropbox_view_content to get off my ass
$class_level = 3;
$class_id = escape($_GET['cid']);
$student_id = escape($_GET['s']);
$assignment_id = escape($_GET['a']);
$content_id = escape($_GET['con_id']);
if (!authClass($class_id)) {
    echo 'Oops! Looks like you clicked a bad link.';
    exit();
}

$content = dropbox_view_content($content_id,$assignment_id,$student_id);

if($content == NULL)
  exit();

// download request
if (isset($_GET['dl'])) {
  header("content-type: " . $content['file_type']);
  header('Content-Disposition: attachment; filename="' . $content['name'] . '.' . $content['ext'] . '"');
  header('content-length: ' . $content['size']);
  readfile($cloudServer . $content['content']);
  exit();
}
?>