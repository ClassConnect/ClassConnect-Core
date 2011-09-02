<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('../../core/inc/func/app/fileBox/main.php');
require_once('./core/main.php');


//declare crumbs
echo '<cc:crumbs>DropBox</cc:crumbs>';

echo '<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>';
$assignments = dropbox_assignments();
?>

<style type="text/css">
.lecButton {
  height:40px;border-bottom:1px solid #ccc;padding-left:5px;cursor: pointer;margin-top:5px
}
.lecButton:hover {
    opacity:0.75;
  filter:alpha(opacity=75);
}
.genButBkg:hover {
  -moz-box-shadow: 0 0 2px #333;
  -webkit-box-shadow: 0 0 2px #333;
  box-shadow: 0 0 2px #333;
}
.lecEl {
  height:40px;
  border:1px solid #ccc;
  padding:10px;
  cursor: pointer;
  margin-top:10px;
}
.lecEl:hover {
  background: #f4f4f4;
}
.lecButAct {
  background-color: #fff;
}
.chooseClassBox {
position:absolute; width:200px;  border:1px solid #999; background:#fff; display:none;
margin-top:5px;
margin-left:-65px;
cursor:default;
}
.cLister {
  font-size:13px;font-weight:bolder;padding:10px;
  cursor:pointer;
  border-top:1px solid #ccc;
}
.cLister:hover {
  background:#e1e1e1;
}
.hostLecBut {
  border:1px solid #999;
  font-size:13px;margin-top:5px;width:125px;padding:5px
}
</style>

<?php
//if a teacher...
echo '<span>';
if($class_level == 3){
  require_once('./teacher_view.php');
}

//if a student...
else if ($class_level == 1){
  $assignments_div = '<div id="student_assignments_list"></div>';
}

echo '</span>';
?>
