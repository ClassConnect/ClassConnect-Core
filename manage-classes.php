<?php
require_once('core/inc/coreInc.php');
requireSession();

// if the user is a student
if ($level == 1) {
	require_once('core/inc/student/manageClasses/index.php');

// if the user is a teacher
} elseif ($level == 3) {
	require_once('core/inc/teacher/manageClasses/index.php');
}
 
?>