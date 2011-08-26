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

<div id="home-left">
    <h1>Recent Documents</h1>

<?php
foreach ($recentFiles as $file) {
    echo '<div style="height:40px;border-bottom:1px solid #ccc;padding-left:5px;cursor: pointer;" onClick="window.location = \'writer.php?n=2&doc_id=' . $file['id'] . '\';">
       <span style="font-size:13px">' . $file['name'] . '</span><br />
           <span style="font-size:12px; color:#999">' . date("g:ia F jS, Y", strtotime($file['time_date'])) . '</span><br />
            </div>';
}

if(empty($recentFiles)){
    echo '<p style="color:#999">No recent documents found</p>';
}
?>

</div>

<div style="float:right; width:670px">
<div  style="font-size:22px; color:#666; margin-bottom:15px">Welcome To Docs</div>
    <div id="createDoc" style="width:300px; float:left" class="colorswap fullRound" onClick="openBox('writer.php?n=1', 350); return false">
<span style="font-size:18px">Create Document</span><br />
<span style="color:#999; font-size:13px">Start a brand new document using Docs. You can edit, view, print and download this document from any internet enabled computer or device.</span>

    </div>

<div id="openDoc" style="width:300px; float:right" class="colorswap fullRound" onClick="openBox('writer.php?n=5', 350); return false">
<span style="font-size:18px">Open Document</span><br />
<span style="color:#999; font-size:13px">Have an existing document? Our software can open ClassConnect documents as well as a slew of other file types including .doc, .docx, .odt,  and more!</span>

</div>
    
</div>
<?php
require_once('core/template/foot/footer.php');
?>