<?php
// include core stuff
require_once('../core/inc/coreInc.php');
 require_once('tokbox/OpenTokSDK.php');
 require_once('../extensions/liveLecture/core/main.php');


if (isset($_GET['lid'])) {
    // include ll cache
    $liveLec = getLLC($_GET['lid']);
    if (authClass($liveLec['classID'])) {
        if (isset($liveLec['video_key'])) {
            $a = new OpenTokSDK(API_Config::API_KEY,API_Config::API_SECRET);
            $token = $a->generate_token();
            header('Content-type: application/json');
            echo '{"session":"' . $liveLec['video_key'] . '", "token":"' . $token . '"}';
        }
    }
}

?>
