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
        dropbox_add_assignment($_name, $_due);
        exit();
      }

    }
  }

?>
<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>

<?php
  echo "<div id='$class_id' class='headTitle'><div>Add Assignment</div></div>";
  if(count($errors)){
    echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
    foreach ($errors as $error){
      echo '<li>' . $error . '</li>';
    }
    echo '</div>';
  }
?>

<div id="content" style="margin:5px; font-size:14px">
  <form method="post" id="add_assignment_form">
    <span style="font-size:14px; font-weight:bolder">Assignment Name</span>
    <br />
    <input type="text" name="assignment_name" style="width:300px;font-size:14px;padding:4px" /><br /> <br />
    <span style="font-size:14px; font-weight:bolder">Due Date</span>
    <br / >
    <input type="text" id="assignment_date_due" name="assignment_date_due" style="width:200px;font-size:14px;padding:4px" /><br /> <br />
    <input type="hidden" name="submitted" value="true"/>
  </form>

<?php
echo '<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" style="float:right" id="add_assignment_submit"><img src="' . $imgServer . 'gen/tick.png" />Add Entry</button></div>';
?>
</div>
