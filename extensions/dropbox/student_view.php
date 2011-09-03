<script type="text/javascript">
function select_files(assignment)
{
  var url = postToAPI("GET", "student_files.php", currentApp, classID,"a="+assignment);
  openBox(url,350,false);
}
</script>
<div style="padding:5px">
<?php
$assignments = dropbox_assignments();
foreach ($assignments as $assignment) {
?>
  <div class="lecEl fullRound" onClick="select_files(<?= $assignment['id'] ?>);">
  <img src="<?= $imgServer ?>gen/dropbox_submit.png" style="float:left;width:40px;margin-right:10px" /><span style="font-size:14px"><?= $assignment['name'] ?></span><br />
    <span style="font-size:11px; color:#999">Due <?= date("F jS, Y", strtotime($assignment['date_due'])) ?></span><br />
  </div>
<?php
}
if(empty($assignments)){
  echo '<p style="color:#999;font-size:16px;text-align:center">Your teacher has not added any assignments</p>';
}
?>
</div>