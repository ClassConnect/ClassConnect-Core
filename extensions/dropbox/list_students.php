<?php
  // include core stuff
  require_once('../../core/inc/coreInc.php');
  // app extension file
  require_once('../core/main.php');
  // local extension file
  require_once('core/main.php');
  //only let them do dope shit if they're a teacher
  $assignment_id = $_GET['id'];
  if($class_level == 3){
   $students = dropbox_submitted_students($assignment_id); 
   echo '<div id='.$assignment_id.'>';
   foreach($students as $student){
     echo '<div id=' .$student.uid. '>' . '</div>';
   }
  }


?>
