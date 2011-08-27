<?php
if ($_SESSION['wizViz'][$final] != 1 || $_SESSION['wizardStep'] == 6) {
?>
  guider.createGuider({
      buttons: [{name: "Close"}, {name: "Next"}],
      description: "SearchBox has access to over 400 million pieces of educational content. Watch the quick video below!<br /><br /><iframe width=\"380\" height=\"250\" src=\"http://www.youtube.com/embed/ERpNWANHK9w\" frameborder=\"0\" allowfullscreen></iframe>",
      id: "first",
      next: "second",
      overlay: true,
      title: "Find & save educational content."
    }).show();

  guider.createGuider({
      buttons: [{name: "Close"}],
      description: "Search for content and then save it directly to FileBox. When you're ready to move on, click the 'Getting Started' tab on the right!",
      id: "second",
      title: "Your turn!"
    });
<?php               
// leave this step
$_SESSION['wizardStep'] = 20;
// set that we've viewed this page
$_SESSION['wizViz'][$final] = 1;
}
?>