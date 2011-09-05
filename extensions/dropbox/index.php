<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// include core stuff
require_once('../../core/inc/func/app/fileBox/main.php');
require_once('./core/main.php');


//declare crumbs
if($_GET["ref"] == 1){

}else{
echo '<cc:crumbs>Hand-In</cc:crumbs>';

echo '<script type="text/javascript" src="./extensions/dropbox/core/main.js"></script>';
}
$assignments = dropbox_assignments();
?>

<style type="text/css">
.assignmentButton {
  height:22px;border-bottom:1px solid #ccc;padding-left:5px;cursor: pointer;margin-top:5px
}
.assignmentButton:hover {
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

.lecEl.student_selecter{
  float: right;
  width: 520px;
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

.assignments_list_bar{
  -moz-box-shadow:inset -4px 4px 10px -4px #ccc;
  -webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
  box-shadow:inset -4px 4px 10px -4px #ccc;
  width: 200px;
}

div.no_students_message{

}

div.dropbox_student_name{
  float: left;
  padding-top: 10px;
  display: inline !important;
}

span#students-header{
  margin-left: 5px;
}

div#dropbox_select_message{
  float: right;
  font-size: 20px;
  margin-right: 110px;
  margin-top: 20px;
}

div#add-new-assignment{
  width: 180px;
  height: 15px;
}

span#delete{
  float: right;
  margin-right:5px;
}

span#dropbox_buttons{
  float:right;
  margin-right:5px;
}

.file_count.dropbox_view{
  float:right;
}

.file_count.files{
  float:right;
}

.file_count {
  font-size:18px;
  padding-top:7px;
  float: right;
}

.file_count .none {
  color:#D33;
}

.file_count .amount {
  font-weight:bold;
}

div#teacher_assignments_list{
  height: 500px;
  overflow: auto;
}
</style>

<?php
//if a teacher...
echo '<span>';
if($class_level == 3) {
  require_once('teacher_view.php');
} else if ($class_level == 1) {
  require_once('student_view.php');
}
echo '</span>';
?>
