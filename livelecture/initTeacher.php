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
        if ($liveLec['video_key'] == '') {
            $pass = true;
            $a = new OpenTokSDK(API_Config::API_KEY,API_Config::API_SECRET);
            try {
                $sessionID = $a->create_session('127.0.0.1')->getSessionId();
            } catch(OpenTokException $e) {
                $pass = false;
            }
            if ($pass) {
                // insert
                setTBsession($_GET['lid'], $sessionID);
                $token = $a->generate_token();
                echo '{"session":"' . $sessionID . '", "token":"' . $token . '"}';
            }
        } else {
            $a = new OpenTokSDK(API_Config::API_KEY,API_Config::API_SECRET);
             $token = $a->generate_token();
             echo '{"session":"' . $liveLec['video_key'] . '", "token":"' . $token . '"}';
        }
    }
}



} // check level
?>