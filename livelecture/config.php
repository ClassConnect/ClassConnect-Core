<?php
// include core stuff
require_once('../core/inc/coreInc.php');
// include ll cache
require_once('../extensions/liveLecture/core/main.php');

/* 
config file for presentation mode
 */
header('Content-type: application/json');
$liveLec = getLLC($_GET['lid']);
if (authClass($liveLec['classID'])) {

    if ($level == 1) {
        $isTeacher = 'false';
    } elseif ($level == 3) {
        $isTeacher = 'true';
    }

    if ($liveLec['active'] == 1) {
        $RTE = 'true';
    } else {
        $RTE = 'false';
    }

    if ($liveLec['video_key'] == '') {
        $video = 'false';
    } else {
        $video = 'true';
    }
    
    echo '{"allow":true,"isTeacher":' . $isTeacher . ',"RTEEnabled":' . $RTE . ',"uid":"' . session_id() . '","firstName":"' . $firstname . '","lastName":"' . $lastname . '","videoEnabled":' . $video  . '}';
} else {
    // if they're not allowed
    echo '{"allow":false}';
}
?>