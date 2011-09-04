<?php
require_once('core/inc/coreInc.php');
requireSession();
// define appid and app type
$appID = 9; $type = 2;
require_once('core/inc/app/auth/authorize.php');
require_once('core/inc/func/app/fileBox/main.php');
require_once('core/inc/func/app/docs/main.php');


if (is_numeric($_GET['n'])) {
	// create doc popup
	if ($_GET['n'] == 1) {
		require_once('core/inc/app/docs/create.php');
		
	// edit existing document
	} elseif ($_GET['n'] == 2) {
		require_once('core/inc/app/docs/edit.php');
		
	// save doc
	} elseif ($_GET['n'] == 3) {
		require_once('core/inc/app/docs/save.php');
		
	// dl word doc
	} elseif ($_GET['n'] == 4) {
		require_once('core/inc/app/docs/saveWord.php');
		
	// convert docs to html
	} elseif ($_GET['n'] == 5) {
		require_once('core/inc/app/docs/convertDoc.php');
		
	// convert docs to html
	} elseif ($_GET['n'] == 6) {
		require_once('core/inc/app/docs/docHandler.php');
		
	}
	exit();
}


$page_title = 'Docs';
$recentFiles = getRecentFiles($user_id, 6, 10);
require_once('core/template/head/header.php');
?>
<script>
setvar = false;
function openDoc(did) {
  if (setvar == false) {
    window.location = '/app/writer.php?n=2&doc_id=' + did;
  } else {
    setvar = false;
  }
}
$('.chooseClassBox').click(function() {
  setvar = true;
});
</script>
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
//  TODO: Mark a difference between opening a doc and converting a word/openoffice doc
?>
<div id="home-left" style="-moz-box-shadow:inset -4px 4px 10px -4px #ccc;
-webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
box-shadow:inset -4px 4px 10px -4px #ccc;">
<h1 style="-moz-box-shadow:inset -4px 4px 10px -4px #ccc;
-webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
box-shadow:inset -4px 4px 4px -3px #ccc;">Get started with Docs</h1>
  <div class="lecButton" onClick="openBox('writer.php?n=1', 350); return false">
    <img src="<?= $imgServer ?>gen/addDoc.png" style="width:32px;float:left;margin-right:8px" />
    <div style="font-size:13px">Create Document</div>
    <div style="font-size:12px; color:#999; margin-top:-3px">Create a new document.</div>
  </div>

  <div class="lecButton" onClick="openBox('writer.php?n=5', 350); return false">
    <img src="<?= $imgServer ?>gen/opendoc.png" style="width:32px;float:left;margin-right:8px" />
    <div style="font-size:13px">Open Document</div>
    <div style="font-size:12px; color:#999; margin-top:-3px">Open an existing document.</div>
  </div>

  <!-- <div class="lecButton" onClick="openBox('writer.php?n=4', 350); return false">
    <img src="<?= $imgServer ?>gen/convdoc.png" style="width:32px;float:left;margin-right:8px" />
    <div style="font-size:13px">Import from Word</div>
    <div style="font-size:12px; color:#999; margin-top:-3px">Converts .doc, .docx, or .odt</div>
  </div> -->
</div>
<div style="float:right; width:670px">
  <div style="font-size:22px; color:#666; margin-bottom:15px">Recent documents</div>
  <?php foreach ($recentFiles as $file) { ?>
      <div class="lecEl fullRound" onClick="openDoc(<?= $file['id'] ?>);">
        <img src="<?= $imgServer ?>gen/document.png" style="float:left;width:40px;margin-right:10px" /><span style="font-size:14px"><?= $file['name'] ?></span>
        <br />
        <span style="font-size:11px; color:#999"><?= date("g:ia F jS, Y", strtotime($file['time_date'])) ?></span>
        <br />
      </div>
  <?php } ?>
  <?php if(empty($recentFiles)) { ?>
      <p style="color:#999;font-size:16px;text-align:center">You don't have any recent lectures!<br />Create a new lecture or import a PowerPoint to get started!</p>
  <?php } ?>
  </div>
</div>
<?php
require_once('core/template/foot/footer.php');
?>