<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');

echo '<cc:crumbs>Attendance</cc:crumbs>';

$port = 3069;
$host = $_SERVER['SERVER_NAME'];
if($host == 'ccinternal.com')
	$port = 3002;
if($host == 'ccbetadev.com')
	$port = 3001;
$url = 'http://'.$host.':'.$port.'/attendance/'.$class_id.'/?session_id='.session_id();
//echo '<p class="action lawsuit" style="display:none">'.$url.'</p>';
echo file_get_contents($url);



?>