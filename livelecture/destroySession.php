<?php
// include core stuff
require_once('../core/inc/coreInc.php');
require_once('tokbox/OpenTokSDK.php');
require_once('../extensions/liveLecture/core/main.php');

// check levle
if ($level == 3) {



if (isset($_GET['lid'])) {
    header('Content-type: application/json');
    // include ll cache
    $liveLec = getLLC($_GET['lid']);
    if (authClass($liveLec['classID'])) {
        if ($liveLec['video_key'] != '') {
            setTBsession($_GET['lid'], "");
            echo '{"success":true}';
        }
    }
}



} // check level
?>
