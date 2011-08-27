<?php
if ($_SESSION['wizViz'][$final] != 1 || $_SESSION['wizardStep'] == 2) {
?>
  guider.createGuider({
      buttons: [{name: "Close"},{name: "Next"}],
      description: "FileBox allows you to store & share files, YouTube videos, website bookmarks, and more. Watch the quick video below!<br /><br /><iframe width=\"380\" height=\"250\" src=\"http://www.youtube.com/embed/mf9_SqyIt1w\" frameborder=\"0\" allowfullscreen></iframe>",
      
      id: "first",
      next: "second",
      overlay: true,
      title: "This is your FileBox."
    }).show();
  guider.createGuider({
      buttons: [{name: "Close"}],
      description: "Add and organize class content using FileBox. When you're ready to move on, click the 'Getting Started' tab on the right!",
      
      id: "second",
      next: "third",
      title: "Your turn!"
    });
<?php               
// leave this step
$_SESSION['wizardStep'] = 20;
// set that we've viewed this page
$_SESSION['wizViz'][$final] = 1;
}
?>