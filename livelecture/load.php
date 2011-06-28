<?php
// include core stuff
require_once('../core/inc/coreInc.php');
/* 
Load a livelecture for presentation
 *
 * LID = cached
 * FID = filebox LL
 */
if (isset($_GET['lid'])) {
    // include ll cache
    require_once('../extensions/liveLecture/core/main.php');
    $liveLec = getLLC($_GET['lid']);
    if (authClass($liveLec['classID'])) {
        echo $liveLec['content'];
    }



    
} elseif (isset($_GET['fid'])) {
    // include core stuff
    require_once('../core/inc/func/app/fileBox/main.php');
    if (auth_content($_GET['fid'], $user_id)) {
        $liveLec = get_content($_GET['fid']);
        echo $liveLec['content'];
    }
    
} else {
    exit();
}
?>
