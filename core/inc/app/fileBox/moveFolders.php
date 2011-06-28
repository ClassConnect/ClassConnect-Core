<?php
// clean folder id
$_GET['fid'] = escape($_GET['fid']);

// clean dir ids
$_GET['ids'] = escape($_GET['ids']);

// clean content ids
$_GET['cids'] = escape($_GET['cids']);

move_dir($_GET['ids'], $_GET['fid'], $user_id);

move_content($_GET['cids'], $_GET['fid'], $user_id);
	



?>