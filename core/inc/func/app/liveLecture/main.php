<?php
// create a presentation
function createPresentation($fid, $title, $userID) {
    $errors = array();
    
    if ($title != '') {
        $title = escape($title);
    } else {
        $errors[] = 'No title was entered.';
    }
    
    if (!is_numeric($userID)) {
        $errors[] = 'User ID is not valid.';
    }

     if (!is_numeric($fid)) {
        $errors[] = 'No folder chosen.';
    }

    if (empty($errors)){
     $insertPres = @mysqli_query($dbc, "INSERT INTO filebox_content (format, uid, fid, name, content, time_date) VALUES ('7', '$userID', '$fid', '$title', '$body', NOW() )");
     $doc_id = $dbc->insert_id;
     return $doc_id;

    } else {
        return $errors;
    }
}
// end createPresentation



?>
