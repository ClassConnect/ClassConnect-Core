<?php
if (isset($_POST['doc_id']) && isset($_POST['content'])) {
	$doc_id = escape($_POST['doc_id']);
	$content = escape($_POST['content']);
	$content = str_replace('\n', "\n", $content);
} else {
	exit();
}

if (auth_content($doc_id, $user_id)) {
	$docData = get_content($doc_id);
	update_content($doc_id, $user_id, $docData['name'], '', $content);
	echo '1';
} else {
	exit();
}


?>