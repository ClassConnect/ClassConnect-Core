<?php
// pull in generic calls
require_once('../../core/inc/coreInc.php');
// get the functions for this api call
require_once('../../core/inc/func/user/addUser.php');
// get api specific functions
require_once('../apiCore.php');

if ($appVer == true) {
	echo "THE CODE WORKS!";
} else {
	echo "Your application couldn't be verified.";
}

?>