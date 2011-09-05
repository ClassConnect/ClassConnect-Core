<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>
<?php
  if(isset($_GET['aid'])){
    $_string = "last_clicked=" . "'" . $_GET['aid'] . "'";
  }
?>
<div id="home-left" style="-moz-box-shadow:inset -4px 4px 10px -4px #ccc;
-webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
box-shadow:inset -4px 4px 10px -4px #ccc;">
  <?php 
  /*
  <div id="add-new-assignment" class="lecEl fullRound">
    <img src="/app/core/site_img/gen/add_l.png" style="float:left; margin-top:-4px; height:24px; margin-right:5px">
    <div class="load_text" style="margin-top:-12px;">Add Assignment</div>
  </div>
  */
  ?>
    <?php
      echo "<div id='add-new-assignment' class='genButBkg noRound hostLecBut' style='width: 189px; margin-top: 0px;'><img src='/app/core/site_img/gen/addContent.png' style='float:left; margin-top:-2px; height:24px; margin-right:5px'>Add DropBox</div>";
      echo "<div id='teacher_assignments_list' class_id=$class_id $_string>";
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
  <div id="llheader" style="width: 540px; float: right;"><span id="students-header">Submissions</span></div>
  <div id="dropbox_students_list">
    <div id="dropbox_select_message">Click an assignment to view submissions</div>
    <div id="dropbox_new_message">or click <span id="here_link"><a>here</a></span> to add an assignment</div>
  </div>
</div>
<span id="dropbox_buttons"><img id="edit_assignment" src="/app/core/site_img/gen/edit_assignment.png"><img id="delete_assignment" src="/app/core/site_img/gen/cross.png">
</span>
