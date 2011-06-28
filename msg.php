<?php
require_once('core/inc/coreInc.php');
require_once('core/inc/func/app/messaging/main.php');
requireSession();

if (is_numeric($_GET['n'])) {
    // create doc popup
    if ($_GET['n'] == 1) {
        require_once('core/inc/app/messaging/create.php');

    // view message thread
    } elseif ($_GET['n'] == 2) {
        require_once('core/inc/app/messaging/view.php');

    // view message thread
    } elseif ($_GET['n'] == 3) {
        require_once('core/inc/app/messaging/del.php');
        
    }
        exit();
        
} else {
     require_once('core/inc/app/messaging/inbox.php');
}


?>