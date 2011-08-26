<?php
// include core stuff
require_once('../core/inc/coreInc.php');
// include core stuff
require_once('../core/inc/func/app/fileBox/main.php');
if (!is_numeric($user_id)) {
    	echo '{"success":false,"needsLogin":true}';
exit();
}
if (auth_content($_POST['fid'], $user_id)) {
        $liveLec = get_content($_POST['fid']);
        update_content($_POST['fid'], $user_id, $liveLec['name'], '', escape($_POST['data']));
        echo '{"success":true}';
} else {
    	echo '{"success":false,"errorString":"You do not have permission to modify this file"}';

}

?>
