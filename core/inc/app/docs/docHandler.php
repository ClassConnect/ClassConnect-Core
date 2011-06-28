<?php
// show folders
// get current folder id
if ($_GET['id'] != 0) {
	$conID = escape($_GET['id']);
} else {
	$conID = 0;
}

if (auth_content($conID, $user_id) != true) {
	exit();
}

// separate steps
if (isset($_GET['step'])) {
	if ($_GET['step'] == 1) {
		require_once('steps/check-download.php');	
		
	// download temp copy of doc
	} elseif ($_GET['step'] == 2) {
		require_once('steps/download-doc.php');	
		
	// convert document
	} elseif ($_GET['step'] == 3) {
		require_once('steps/convert-doc.php');

                     // convert document
	} elseif ($_GET['step'] == 4) {
		require_once('steps/create-doc.php');
		
	}
	
	exit();
}


$contentData = get_content($conID);
if ($contentData['format'] == 6) {
?>
<script>

$(document).ready(function() {
	window.location = "writer.php?n=2&doc_id=<?php echo $conID; ?>";
});
</script>
<div style="margin:5px">Redirecting you to Docs...<a href="writer.php?n=2&doc_id=<?php echo $conID; ?>">(no redirect?)</a></div>
<?php
} elseif ($contentData['format'] == 1) {


?>
<div class="headTitle"><img src="<?php echo $imgServer; ?>gen/w_large.png" style="margin-top:3px; margin-right: 3px" /><div>Convert Document</div></div>
<div style="margin:5px; font-size:12px">
To open this document in Docs, we have to convert it to a format that our program can understand. If you wish to continue, we will create a new document with the same name in the same directory. Your original document will remain in its original format and can still be downloaded via FileBox.
</div>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="openBox('writer.php?n=6&step=1&id=<?php echo $conID; ?>', 350)" type="submit"> 
<img src="<?php echo $imgServer; ?>gen/tick.png" /> Convert Document
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="<?php echo $imgServer; ?>gen/cross.png" /> Close
</button>
</div>


<?php
}
?>