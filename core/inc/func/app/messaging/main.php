<?php
// get a specified set of msgs
function get_messages($user_id, $start, $limit) {
    $messages = good_query_table("SELECT * FROM msgs_rec LEFT JOIN msgs_thread ON msgs_thread.thread_id = msgs_rec.tid  WHERE recipient_id = '$user_id' AND del = '1' ORDER BY `last_update` DESC LIMIT $start, $limit");
    return $messages;
}
// end get_messages function




// create a new message thread
function create_thread($title, $message, $uid, $user_ids) {
    global $dbc;
    $errors = array();
    
    // clean the title
    if ($title != '') {
        $title = escape($title);
    } else {
        $title = '(no subject)';
    }


    // clean the message
     if ($message != '') {
        $message = escape($message);
    } else {
        $errors[] = 'You forgot to enter a message.';
    }


    if ($user_ids == '') {
        $errors[] = 'No users selected to receive this message.';
    }

    if (empty($errors)) {
        $insertThread = @mysqli_query($dbc, "INSERT INTO msgs_thread (title, creator, created_at) VALUES ('$title', '$uid',  NOW() )");
        $thread_id = $dbc->insert_id;

        // add children recipients
        add_thread_recs($thread_id, $user_ids, '2');

        // add thread
        add_thread_message($thread_id, $uid, $message);

        // add parent recipient
        add_thread_recs($thread_id, $uid, '1');
        
        return $thread_id;
        
    } else {
        return $errors;
    }


}
// end of create_thread function



// add recipients to a thread
function add_thread_recs($thread_id, $user_ids, $status) {
    $uidArray = explode(',', $user_ids);
    foreach ($uidArray as $userID) {
        if (is_numeric($userID)) {
            good_query("INSERT INTO msgs_rec (tid, recipient_id, status, last_update, invited_at) VALUES ('$thread_id', '$userID', '$status', NOW(), NOW() )");
        }
    }
    
}
// end add_thread_recs



// add message into thread
function add_thread_message($thread_id, $user_id, $message) {
    // add message into thread
    good_query("INSERT INTO msgs_feed (sender_id, thread_id, body, sent_at) VALUES ('$user_id', '$thread_id', '$message', NOW() )");

    // alert all clients of this new change
    push_message($thread_id);
}
// end add_thread_message



// authorize a user relation to thread
function auth_thread($thread_id, $user_id) {
    $result = good_query_assoc("SELECT * FROM msgs_rec WHERE tid = '$thread_id' AND recipient_id = '$user_id' LIMIT 1");
    
    if ($result != false) {
        return true;
    } else {
        return false;
    }

}
// end auth_thread




// get thread
function get_thread($thread_id) {
    $result = good_query_assoc("SELECT * FROM msgs_thread WHERE thread_id = '$thread_id' LIMIT 1");

   return $result;

}
// end get thread



// get a message thread feed
function get_feed($thread_id) {
    $result = good_query_table("SELECT * FROM msgs_feed LEFT JOIN users ON msgs_feed.sender_id = users.id  WHERE thread_id = '$thread_id' ORDER BY `sent_at` ASC");

   return $result;

}
// end auth_thread



// get last message thread feed
function get_last_feed($thread_id) {
    $result = good_query_assoc("SELECT * FROM msgs_feed LEFT JOIN users ON msgs_feed.sender_id = users.id  WHERE thread_id = '$thread_id' ORDER BY `sent_at` DESC LIMIT 1");

   return $result;

}
// end



// get a thread's recipients
function get_recipients($thread_id) {
    $result = good_query_table("SELECT * FROM msgs_rec  LEFT JOIN users ON msgs_rec.recipient_id = users.id WHERE tid = '$thread_id'");
    return $result;
}
// end auth_thread



// alert clients of a new message
function push_message($thread_id) {
    good_query("UPDATE msgs_rec SET status = '2', del = '1', last_update = NOW() WHERE tid = $thread_id");
    $recs = get_recipients($thread_id);
    foreach ($recs as $rec) {
        $sessions = getSessions($rec['recipient_id']);
        foreach ($sessions as $session) {
            //// send nodeJS notification
            sendNodeification(2, '', $session['session_key'], '');
            }
    }
}
// end push_message


// alert clients of a new message
function mark_read($thread_id, $user_id) {
    good_query("UPDATE msgs_rec SET status = '1', del = '1' WHERE tid = $thread_id AND recipient_id = $user_id LIMIT 1");
}
// end push_message


// "delete" a thread
function mark_del($thread_id, $user_id) {
    good_query("UPDATE msgs_rec SET status = '1', del = '2' WHERE tid = $thread_id AND recipient_id = $user_id LIMIT 1");
}
// end mark_del
?>
