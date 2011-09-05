<?php
  // include core stuff
  require_once('../../core/inc/coreInc.php');
  // app extension file
  require_once('../core/main.php');
  // local extension file
  require_once('core/main.php');

  if($class_level == 3){
    dropbox_delete_assignment($_POST['aid']);
  }
?>
