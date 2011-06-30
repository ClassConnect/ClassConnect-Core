<?php
require_once('core/inc/coreInc.php');
// define appid and app type
$appID = 8; $type = 2;
require_once('core/inc/app/auth/authorize.php');
require_once('core/inc/func/app/fileBox/main.php');
require_once('core/inc/func/app/pres/main.php');
requireSession();


if (is_numeric($_GET['n'])) {
	// create pres popup
	if ($_GET['n'] == 1) {
		require_once('core/inc/app/pres/create.php');

	// edit existing pres
	} elseif ($_GET['n'] == 5) {
		require_once('core/inc/app/pres/open.php');

	// convert docs to html
	} elseif ($_GET['n'] == 6) {
		require_once('core/inc/app/pres/docHandler.php');
		
	}
	exit();
}


$page_title = 'Presentations';
$recentFiles = getRecentFiles($user_id, 7, 10);
require_once('core/template/head/header.php');
?>

<div id="home-left">
    <h1>Recent Presentations</h1>

<?php
foreach ($recentFiles as $file) {
    echo '<div style="height:40px;border-bottom:1px solid #ccc;padding-left:5px;cursor: pointer;" onClick="window.location = \'livelecture/Editor/index.php?fid=' . $file['id'] . '\';">
       <span style="font-size:13px">' . $file['name'] . '</span><br />
           <span style="font-size:12px; color:#999">' . date("g:ia F jS, Y", strtotime($file['time_date'])) . '</span><br />
            </div>';
}

if(empty($recentFiles)){
    echo '<p style="color:#999">No recent presentations found</p>';
}
?>

</div>

<div style="float:right; width:670px">
<div style="font-size:22px; color:#666; margin-bottom:15px">Welcome To Presentations</div>
    <div id="createPres" style="width:300px; float:left" class="colorswap fullRound" onClick="openBox('presentations.php?n=1', 350); return false">
<span style="font-size:18px">Create Presentation</span><br />
<span style="color:#999; font-size:13px">Start a brand new document using Presentations. You can edit, view, and print this presentation from any internet enabled computer or device.</span>

    </div>

<div id="openPres" style="width:300px; float:right" class="colorswap fullRound" onClick="openBox('presentations.php?n=5', 350); return false">
<span  style="font-size:18px">Open Presentation</span><br />
<span style="color:#999; font-size:13px">Have an existing presentation? Use our Presentation Editor to edit, save, and present your work.</span>

</div>

</div>
<?php
require_once('core/template/foot/footer.php');
?>