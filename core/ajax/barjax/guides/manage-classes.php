guider.createGuider({
      buttons: [{name: "Close"},
                {name: "Next"}],
      description: "<?php 
      if ($level == 3) {
        echo 'This page allows you to create, end and view your classes. You can also add & view your schools.';
      } elseif ($level == 1) {
        echo 'This page allows you to enroll & view your classes.';
      }
      ?>",
      id: "first",
      next: "second",
      overlay: true,
      title: "Manage your classes<?php 
      if ($level == 3) {
        echo ' & schools';
      } ?>."
    }).show();


    <?php 
      if ($level == 3) {
        // TEACHERS ONLY
?>
    guider.createGuider({
      attachTo: "#manageRighter",
      buttons: [{name: "Close"},
                {name: "Next"}],
      description: "To create a class, click the 'Create New Class' button.<br /><br />To find or add a school, click the 'Find / Add School' button.",
      id: "second",
      next: "third",
      position: 9,
      title: "Create classes & add schools.",
      width: 415
    });

<?php
      } elseif ($level == 1) {
        // STUDENTS ONLY
?>
    guider.createGuider({
      attachTo: "#manageRighter",
      buttons: [{name: "Close"},
                {name: "Next"}],
      description: "If you want to enroll in a class, click the 'Enroll In A Class' button. You will need to enter the class code provided by your teacher.",
      id: "second",
      next: "third",
      position: 9,
      title: "Enroll in a class.",
      width: 415
    });
<?php
      }
      ?>


    guider.createGuider({
      attachTo: "#managebar",
      buttons: [{name: "Close"}],
      description: "<?php 
      if ($level == 3) {
        echo 'You can end a class by clicking the \"End This Class\" button. Classes that are linked to a grading period will automatically end after the grading period expires.';
      } elseif ($level == 1) {
        echo 'You can always view a list of your past, current, and future schools on this page.';
      }
      ?>",
      id: "third",
      next: "fourth",
      position: 6,
      title: "View your past, current, and future classes as well as your current and past schools.",
      width: 500
    });