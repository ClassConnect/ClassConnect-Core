<?php
require_once('core/inc/coreInc.php');
require_once('core/inc/func/app/fileBox/main.php');
requireSession();

if (is_numeric($_GET['n'])) {
	// retrieve dir listing
	if ($_GET['n'] == 1) {
		require_once('core/inc/app/fileBox/index.php');
		
	// retrieve breadcrumbs
	} elseif ($_GET['n'] == 2) {
		require_once('core/inc/app/fileBox/crumbs.php');
	
	// add a folder
	} elseif ($_GET['n'] == 3) {
		require_once('core/inc/app/fileBox/addFolder.php');
	
	// edit a folder
	} elseif ($_GET['n'] == 4) {
		require_once('core/inc/app/fileBox/editFolder.php');
	
	// edit a folder
	} elseif ($_GET['n'] == 5) {
		require_once('core/inc/app/fileBox/delFolder.php');
	
	// move folder/s
	} elseif ($_GET['n'] == 6) {
		require_once('core/inc/app/fileBox/moveFolders.php');
	
	// add content
	} elseif ($_GET['n'] == 7) {
		require_once('core/inc/app/fileBox/addContent.php');
		
	// edit content
	} elseif ($_GET['n'] == 8) {
		require_once('core/inc/app/fileBox/editContent.php');
		
	// delete content
	} elseif ($_GET['n'] == 9) {
		require_once('core/inc/app/fileBox/deleteContent.php');
		
	// view content
	} elseif ($_GET['n'] == 10) {
		require_once('core/inc/app/fileBox/viewContent.php');
		
	// move content
	} elseif ($_GET['n'] == 11) {
		require_once('core/inc/app/fileBox/moveBatch.php');
		
	// delete batch content
	} elseif ($_GET['n'] == 12) {
		require_once('core/inc/app/fileBox/deleteBatch.php');
		
	// share batch content
	} elseif ($_GET['n'] == 13) {
		require_once('core/inc/app/fileBox/batchSharing.php');
		
	}
	exit();
}
 
$page_title = 'FileBox';

$scriptArr[] = $scriptServer . 'fileBox.js';
require_once('core/template/head/header.php');

?>
<style type="text/css">
.floatingPanel { position: fixed; top: 10px; }
</style>


<!--[if IE 7]><style type="text/css">
#selectable1{
			font-size: 12px;
			margin-left:-17px;
		}</style>
<![endif]-->





<div id="fboxLeft">
<div id="barRighter">
<div id="addContenter" class="tabbed" onClick="sdContent()"><img src="<?php echo $imgServer; ?>gen/addContent.png" style="float:left; margin-right:5px; height:18px"/> Add Content</div>

<div id="addOpt" style="display:none">
<div class="subTabbed" onClick="addFolder()"><img src="<?php echo $imgServer; ?>gen/addFolder.png" style="float:left; margin-right:5px; height:18px"/>Create Folder</div>
<div class="subTabbed" onClick="addContent(1, 300)"><img src="<?php echo $imgServer; ?>gen/upload_l.png" style="float:left; margin-right:5px; height:18px"/>Upload Files</div>
<div class="subTabbed" onClick="addContent(2, 250)"><img src="<?php echo $imgServer; ?>gen/web_l.png" style="float:left; margin-right:5px; height:18px"/>Bookmark URL</div>
<div class="subTabbed" onClick="addContent(3, 250)"><img src="<?php echo $imgServer; ?>gen/yt_l.png" style="float:left; margin-right:5px; height:18px"/>Add YouTube Video</div>
<div class="subTabbed" onClick="addContent(4, 250)"><img src="<?php echo $imgServer; ?>gen/embed_l.png" style="float:left; margin-right:5px; height:18px"/>Add Embed Code</div>
</div>

<div id="leftDesc" style="padding:5px">
<li style="margin-bottom:3px; list-style:none">Add folders, files, websites, videos and more using the button above.</li>
<li style="padding-top:3px; margin-bottom: 3px; border-top:1px solid #ccc; list-style:none">Click multiple items for batch moving, deleting and sharing.</li>
<li style="padding-top:3px; margin-bottom: 3px; border-top:1px solid #ccc; list-style:none">Double click an item to open it.</li>
</div>

<div id="subShare" class="tabbed" onClick="sharingBox()" style="display:none"><img src="<?php echo $imgServer; ?>fileBox/share.png" style="float:left; margin-right:5px; height:18px"/> Share Selected Items</div>

<div id="subMove" class="tabbed" onClick="openBox('filebox.cc?n=11', 350)" style="display:none"><img src="<?php echo $imgServer; ?>gen/move_l.png" style="float:left; margin-right:5px; height:18px"/> Move Selected Items</div>

<div id="subDel" class="tabbed tabbedBottom" onClick="openBox('filebox.cc?n=12', 350)" style="display:none"><img src="<?php echo $imgServer; ?>gen/delCircle.png" style="float:left; margin-right:5px; height:18px"/> Delete Selected Items</div>





</div>
</div>


<div id="fboxContent">

<div id="boxCrumbs" style="font-size:10px">
		
</div>

<div id="fbHead" style="font-size:12px">
<div class="createDate">Creation Date</div>
<div class="options">Options</div>
<div class="fileType">File Type</div>
<div class="fileName">Filename</div>

</div>

<div id="selectable1">


 
</div> 
<br /><br />
</div>

<?php
require_once('core/template/foot/footer.php');
?>