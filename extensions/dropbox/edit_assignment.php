<?php
  // include core stuff
  require_once('../../core/inc/coreInc.php');
  // app extension file
  require_once('../core/main.php');
  // local extension file
  require_once('core/main.php');

  if($class_level == 3){
    if(isset($_POST['submitted'])){
      $errors = array();
      $_name = $_POST['assignment_name'];
      $_due = $_POST['assignment_date_due'];
      $_aid = $_POST['aid'];

      //name validation
      if(!strlen($_name)){
       $errors[] = "Please enter an assignment name."; 
      }

      if($_due == ''){
        $errors[] = "Please enter a date.";
      }
      else{
        if(check_date_format($_due)){
          $errors[] = "Please enter a valid date.";
        }
      }

      //if everything is going as planned...
      if(count($errors) == 0){
        dropbox_update_assignment($_aid, $_name, $_due);
        exit();
      }

    }
  }

?>
<script type="text/javascript" src="./extensions/dropBox/core/main.js"></script>

<?php
  echo "<div id='$class_id' class='headTitle'><div>Edit Assignment</div></div>";
  if(count($errors)){
    echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
    foreach ($errors as $error){
      echo '<li>' . $error . '</li>';
    }
    echo '</div>';
  }
  $aid = $_GET['aid'];
  $name = $_GET['name'];
  $date = $_GET['date'];
?>

<div id="content" style="margin:5px; font-size:14px">
  <form method="post" id="edit_assignment_form">
    <span style="font-size:14px; font-weight:bolder">Assignment Name</span>
    <br />
<?php
echo "<input type='text' value='$name' name='assignment_name' style='width:300px;font-size:14px;padding:4px' />"
?>
     <br /> <br />
    <span style="font-size:14px; font-weight:bolder">Due Date</span>
    <br / >
<?php
   echo "<input type='text' value='$date' id='assignment_date_due' name='assignment_date_due' style='width:200px;font-size:14px;padding:4px' /><br /> <br />";

?>
    <input type="hidden" name="submitted" value="true"/>
<?php
  echo "<input type='hidden' name='aid' value=$aid>";
?>
  </form>

<?php
echo '<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" style="float:right" id="edit_assignment_submit"><img src="' . $imgServer . 'gen/tick.png" />Add Entry</button></div>';
?>
</div>
