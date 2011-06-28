<?php
require_once('core/inc/coreInc.php');
// decode all
$_GET["page"] = urldecode(reverse_htmlentities($_GET["page"]));

// re-encode only what is necessary
$_GET["page"] = urlencode($_GET["page"] . '&');
$_GET["page"] = str_replace('%3F', '?', $_GET["page"]);
$_GET["page"] = str_replace('%3D', '=', $_GET["page"]);
$_GET["page"] = str_replace('%26', '&', $_GET["page"]);
$_GET['appType'] = 1;

// load app loader
require_once('appLoad.php');
?>