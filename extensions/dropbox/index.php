<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('../../core/inc/func/app/fileBox/main.php');
require_once('./core/main.php');


//declare crumbs
echo '<cc:crumbs>DropBox</cc:crumbs>';

echo '<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>';
$assignments = dropbox_assignments();

//if a teacher...
echo '<span>';
if($class_level == 3){
  $assignments_div = '<div id="teacher_assignments_list">';
  foreach($assignments as $assignment){
    //setup div
    $assignment_string = '<div id='. $assignment['id'] . '>';
    $assignment_string = $assignment_string . '<span class="assignment-name">' . $assignment['name'] . '</span>';
    $assignment_string = $assignment_string . '</div>';
    echo $assignment_string;
  }

  //div to inject student list into
  echo '<div id="dropbox_students_list"></div>';
  echo '</div>';
}

//if a student...
else if ($class_level == 1){
  $assignments_div = '<div id="student_assignments_list"></div>';
}

echo '</span>';
?>
