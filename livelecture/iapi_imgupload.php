<?php
// include core stuff
require_once('../core/inc/coreInc.php');
require_once('../core/inc/func/app/fileBox/main.php');
requireSession();


//set array of allowed image types
$imgTypes = array('jpg', 'jpeg', 'png', 'gif','bmp');


if (isset($_FILES['file'])) {
if ($_FILES['file']['error'] > 0) {
  echo '{"url":""}';
  exit();
}

$ext = strtolower(substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1));
$enc_name = gen_encName($user_id, $_FILES['file']['name']);

  if (in_array(strtolower($ext), $imgTypes)) {
    $upType = 2;
    $isImg = true;
  } else {
    $upType = 1;
    $isImg = false;
  }



if ($isImg) {

	$upload_file = upload_file($_FILES['file']['tmp_name'], $enc_name, $upType, $ext);
	
	if ($upload_file == 1) {
		
	// get the extension
	$file_name = substr(substr($_FILES['file']['name'], 0, strrpos($_FILES['file']['name'], '.')), 0, 35);
	$file_size = $_FILES["file"]["size"];
	$file_type = $_FILES["file"]["type"];
	

	 // insert it as an image
	 $insertFile = create_img(0, $user_id, $file_name, $ext, $file_type, $file_size, $enc_name, $_FILES['file']['tmp_name']);
	
	// if success
	if ($insertFile == 1) {
		echo '{"url":"' . $cloudImgPub . $enc_name . '.' . $ext . '"}';
	} else {
		echo '{"url":""}';
	}
	
	
	} else {
		// throw an error in LL
		echo '{"url":""}';
	}
	
	exit();


// isimg check
} else {
		// throw an error in LL
		echo '{"url":""}';
}


} elseif (!isset($_FILES['file']) && isset($_GET['u'])) {
  echo '{"name":"Error. This file might be too big.","type":"0","size":"0"}';
  exit();
}

?>