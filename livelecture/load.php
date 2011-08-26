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
    // if this is a class load
    if (isset($_GET['cid'])) {
        $class_id = $_GET['cid'];
        $content_id = $_GET['fid'];
        $permissions = get_permissions(escape($content_id), null);
        // if we have authorization
        if (is_grandfather($permissions, $class_id, 1) || is_permitted($permissions, 1, $content_id, $class_id, 1)) {
            // get the content info
            $r = @mysqli_query($dbc, "SELECT * FROM filebox_content WHERE id = " . $_GET['fid'] . " LIMIT 1");
            $content = mysqli_fetch_array($r, MYSQLI_BOTH);
            echo $content['content'];
        }
        // if this is a user load
    } elseif (auth_content($_GET['fid'], $user_id)) {
        $r = @mysqli_query($dbc, "SELECT * FROM filebox_content WHERE id = " . $_GET['fid'] . " LIMIT 1");
        $liveLec = mysqli_fetch_array($r, MYSQLI_BOTH);
        echo $liveLec['content'];
    }
    
} else {
    exit();
}
?>
