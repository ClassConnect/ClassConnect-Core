<?php
// create error handler
function customError($errno, $errstr)
  {
  //echo "<b>Error:</b> [$errno] $errstr";
  }

//set error handler
set_error_handler("customError");

session_start();
// GLOBAL SITE VARIABLES //
require_once('site/serverConfig.php');
/// Set session variables for easy access <-- hehehehehehehehe
require_once('user/var_set.php');
// Include DB connection and query functions
require_once('data/connect.php');
// Include core site functions
require_once('func/core.php');
// get cloud files ext
require_once('site/cloudFiles/cloudfiles.php');
?>