<?php
// get a cached livelecture
function getLLC($ll_id) {
    global $dbc;
    $ll_id = escape($ll_id);
    $r = @mysqli_query($dbc, "SELECT * FROM livelec_cache WHERE lid = $ll_id LIMIT 1");
    $llData = mysqli_fetch_array($r, MYSQLI_BOTH);
    return $llData;
}
// end function


// get all cached livelectures for this class
function getLLCs($class_id) {
    $class_id = escape($class_id);
    $llData = good_query_table("SELECT * FROM livelec_cache WHERE classID = $class_id ORDER BY `active`, `created` DESC");
    return $llData;
}
// end function


// get all cached livelectures for this class
function setTBsession($ll_id, $sessionID) {
    $ll_id = escape($ll_id);
    good_query("UPDATE livelec_cache SET video_key = '$sessionID' WHERE lid = $ll_id");
    return 1;
}
// end function


// get all cached livelectures for this class
function archiveLLC($ll_id) {
    $ll_id = escape($ll_id);
    good_query("UPDATE livelec_cache SET active = 2, ended = NOW() WHERE lid = $ll_id");
    return 1;
}
// end function


// delete a cached livelecture
function delLLC($ll_id) {
        good_query("DELETE FROM livelec_cache WHERE lid = $ll_id LIMIT 1");
        return 1;
}
// end delLLC


function createLLC($title, $content, $classID) {
    global $dbc;
    $insertDoc = @mysqli_query($dbc, "INSERT INTO livelec_cache (title, content, classID, created) VALUES ('$title', '$content', '$classID', NOW() )");
    $llc_id = $dbc->insert_id;
    return $llc_id;
}

?>
