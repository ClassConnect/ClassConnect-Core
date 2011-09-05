<script type="text/javascript">
function select_files(assignment)
{
  var url = postToAPI("GET", "student_files.php", currentApp, classID,"a="+assignment);
  openBox(url,350,false);
}
</script>
<style>
</style>
<div style="padding:5px">
<?php
$assignments = dropbox_assignments();
$counts = dropbox_submitted_count($user_id);
foreach ($assignments as $assignment) {
  $num = $counts[$assignment['id']];
  if($num == NULL)
    $num = 0;
?>
  <div class="lecEl fullRound" onClick="select_files(<?= $assignment['id'] ?>);">
    <div class="file_count" style="float:right;">
      <span class="<?= $num == 0 ? 'none' : '' ?>"><span class="amount"><?= $num ?></span> <?= ($num == 1) ? 'file' : 'files' ?> submitted</span>
    </div>
    <img src="<?= $imgServer ?>gen/dropbox_submit.png" style="float:left;width:40px;margin-right:10px" />
    <span style="font-size:14px"><?= $assignment['name'] ?></span>
    <br />
    <span style="font-size:11px; color:#999">Due <?= date("F jS, Y", strtotime($assignment['date_due'])) ?></span>
    <br />
  </div>
<?php
}
if(empty($assignments)){
  echo '<p style="color:#999;font-size:16px;text-align:center">Your teacher has not added any assignments</p>';
}
?>
</div>
