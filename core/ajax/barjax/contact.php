<?php
$cryptinstall="crypt/cryptographp.fct.php";
include $cryptinstall;
require_once('../../inc/coreInc.php');

$body = escape($_GET['body']);

if (isset($_GET['body'])) {
    mail('ericsimons@es40.net', 'Internal Contact: ' . $firstname . ' ' . $lastname . ', UID: ' . $user_id, $body, "From: support@classconnect.com");
}

?>

<div style="padding:10px; color:#666; font-size:16px; text-align:center"><br />Thanks! We'll be in touch shortly :)</div>