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
	if ($_GET['step'] == 2) {
		require_once('steps/download-doc.php');	
		
	// convert document
	}
	
	exit();
}


$contentData = get_content($conID);
if ($contentData['format'] == 7) {
?>
<script>

$(document).ready(function() {
	window.location = "livelecture/Editor/index.php?fid=<?php echo $conID; ?>";
});
</script>
<div style="margin:5px">Redirecting you to Lectures...<a href="livelecture/Editor/index.php?fid=<?php echo $conID; ?>">(no redirect?)</a></div>
<?php
} elseif ($contentData['format'] == 1) {

require_once('steps/check-download.php');	


}
?>