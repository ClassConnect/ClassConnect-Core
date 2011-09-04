<?php
  // include core stuff
  require_once('../../core/inc/coreInc.php');
  // app extension file
  require_once('../core/main.php');
  // local extension file
  require_once('core/main.php');

  //only let them do dope shit if they're a teacher
  $assignment_id = $_GET['aid'];
  if($class_level == 3){
    $students = dropbox_submitted_students($assignment_id); 

    if(count($students) == 0){
      echo "<div class='no_students_message'>No students have submitted this assignment</div>";
    }
    else{
      foreach($students as $student){
        echo buttonize_submitted_student($student);
      }
    }
  }
?>
