<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>
<div id="add-new-assignment" class="lecEl fullRound">
    <img src="/app/core/site_img/gen/add_l.png" style="float:left; margin-top:-4px; height:24px; margin-right:5px">
    <div class="load_text" style="margin-top:-12px;">Add Assignment</div>
</div>
<div id="home-left">
  <div id="llheader">Assignments</div>
    <?php
      echo "<div id='teacher_assignments_list' class_id=$class_id>";
      foreach($assignments as $assignment){
        $assignment_string = '<div date="' . $assignment['date_due'] .  '" class="assignmentButton" id='. $assignment['id'] . '>';
        $assignment_string = $assignment_string . '<span class="assignment-name">' . $assignment['name'] . '</span>';
        $assignment_string = $assignment_string . '</div>';
        echo $assignment_string;
      }
    ?>
  </div>
</div>
<div id="students_list">
  <div id="llheader">Students</div>
  <div id="dropbox_students_list">
    <div id="dropbox_select_message">Click an assignment to view submissions</div>
  </div>
</div>
<span id="dropbox_buttons"><img id="edit_assignment" src="/app/core/site_img/gen/edit_assignment.png"><img id="delete_assignment" src="/app/core/site_img/gen/cross.png">
</span>
