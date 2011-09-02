<div id="teacher_assignments_list">
<?php
  foreach($assignments as $assignment){
    //setup div
    $assignment_string = '<div id='. $assignment['id'] . '>';
    $assignment_string = $assignment_string . '<span class="assignment-name">' . $assignment['name'] . '</span>';
    $assignment_string = $assignment_string . '</div>';
    echo $assignment_string;
  }
?>
<div id="dropbox_students_list"></div>
</div>
