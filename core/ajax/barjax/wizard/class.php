<?php
if ($_SESSION['wizViz'][$final] != 1 || $_SESSION['wizardStep'] == 3) {
?>
origApper = 1;

guider.createGuider({
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(1); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "<?php 
      if ($level == 3) {
        echo 'You can manage students, update the class calendar, create forums, share files, and open LiveLectures using this page.';
      } elseif ($level == 1) {
        echo 'You can view the class calendar, participate in forums, access class files, and view LiveLectures using this page.';
      }
      ?>",
      id: "first",
      next: "second",
      overlay: true,
      title: "This is a class page."
    }).show();


    <?php 
      if ($level == 3) {
        // TEACHERS ONLY
?>
    guider.createGuider({
      attachTo: "#app1",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(2); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Use the class page to update & communicate with your class. You can also edit the class name & description, view the class code (students need this to enroll), and manage students.",
      id: "second",
      next: "third",
      position: 7,
      title: "Your class homepage.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app2",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(3); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Simply click a day in the calendar to add an assignment, project, test or event. You can view the calendar in month, week and day views using the buttons at the top right.<br /><br />You can also sync this class calendar with your other classes, eliminating the need to enter in events multiple times. <?php echo '<a href=\"#\" onClick=\"openBox(\'/app/core/ajax/barjax/echo.php?data=' . urlencode('<img src="/app/core/site_img/gen/cross.png" style="position:absolute;margin-top:-30px; margin-left:560px; border:3px solid #999; background:#eee; padding:5px; cursor:pointer" onClick="closeBox();" /><iframe width="560" height="349" src="http://www.youtube.com/embed/aqM9c83vgt4" frameborder="0" allowfullscreen></iframe>') . '\', 560, 1); return false\">(watch a video)</a>'; ?>",
      id: "third",
      next: "fourth",
      position: 7,
      title: "Your class calendar.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app3",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(4); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Create forums for your students to communicate in. You can lock and delete forums at any time. Students cannot delete replies they have posted which ensures good behavior. <?php echo '<a href=\"#\" onClick=\"openBox(\'/app/core/ajax/barjax/echo.php?data=' . urlencode('<img src="/app/core/site_img/gen/cross.png" style="position:absolute;margin-top:-30px; margin-left:560px; border:3px solid #999; background:#eee; padding:5px; cursor:pointer" onClick="closeBox();" /><iframe width="560" height="349" src="http://www.youtube.com/embed/Ai6o0edLH-Q" frameborder="0" allowfullscreen></iframe>') . '\', 560, 1); return false\">(watch a video)</a>'; ?>",
      id: "fourth",
      next: "fifth",
      position: 7,
      title: "Class forums for collaboration.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app4",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(5); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Upload, bookmark and organize your class content in <a href=\"filebox.cc\">FileBox</a> and then share it with your classes. Students can see the content you share in their class' ShareBox. <?php echo '<a href=\"#\" onClick=\"openBox(\'/app/core/ajax/barjax/echo.php?data=' . urlencode('<img src="/app/core/site_img/gen/cross.png" style="position:absolute;margin-top:-30px; margin-left:560px; border:3px solid #999; background:#eee; padding:5px; cursor:pointer" onClick="closeBox();" /><iframe width="560" height="349" src="http://www.youtube.com/embed/mf9_SqyIt1w" frameborder="0" allowfullscreen></iframe>') . '\', 560, 1); return false\">(watch a video)</a>'; ?>",
      id: "fifth",
      next: "sixth",
      position: 7,
      title: "Share files, websites and more.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app5",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(11); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Open lectures you've created using ClassConnect and deliver them directly to students along with an optional video stream. <?php echo '<a href=\"#\" onClick=\"openBox(\'/app/core/ajax/barjax/echo.php?data=' . urlencode('<img src="/app/core/site_img/gen/cross.png" style="position:absolute;margin-top:-30px; margin-left:560px; border:3px solid #999; background:#eee; padding:5px; cursor:pointer" onClick="closeBox();" /><iframe width="560" height="349" src="http://www.youtube.com/embed/wf3VAMMMwzM" frameborder="0" allowfullscreen></iframe>') . '\', 560, 1); return false\">(watch a video)</a>'; ?>",
      id: "sixth",
      next: "sev",
      position: 7,
      title: "Deliver lectures in real time.",
      width: 400
    });

    guider.createGuider({
      attachTo: "#app11",
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper); guider.next();\">Next</a><a class=\"guider_button\" style=\"float:right\" onClick=\"selectApp(origApper);guider.hideAll();\">Close</a>",
      description: "Create DropBoxes where students can upload files, videos, websites, and more.",
      id: "sev",
      next: "eig",
      position: 7,
      title: "Allow students to turn in work.",
      width: 400
    });

  guider.createGuider({
      buttons: [],
      buttonCustomHTML: "<br /><a class=\"guider_button\" style=\"float:right\" onClick=\"guider.hideAll();\">Close</a>",
      description: "Send out the first class update, add events to the calendar, or open a class forum. When you're ready to move on, click the 'Getting Started' tab on the right!",
      id: "eig",
      title: "Your turn!"
    });
<?php
      }
?>

<?php               
// leave this step
$_SESSION['wizardStep'] = 20;
// set that we've viewed this page
$_SESSION['wizViz'][$final] = 1;
}
?>