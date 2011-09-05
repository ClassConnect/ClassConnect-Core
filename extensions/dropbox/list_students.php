<?php
  // include core stuff
  require_once('../../core/inc/coreInc.php');
  // app extension file
  require_once('../core/main.php');
  // local extension file
  require_once('core/main.php');

  //I'd rather organize it this way...
  //require_once('core/list_students.js');

  echo '<script type="text/javascript" src="./extensions/dropBox/core/list_students.js"></script>';
  //only let them do dope shit if they're a teacher
  $assignment_id = $_GET['aid'];
  if($class_level == 3){
    $submitted_students = dropbox_submitted_students($assignment_id); 
    $students = getClassStudents($class_id, 1);

    if(count($students) == 0){
      echo "<div class='no_students_message'>No students have submitted this assignment</div>";
    }
    else{
      buttonize_students($students, $submitted_students);
    }
  }
?>
