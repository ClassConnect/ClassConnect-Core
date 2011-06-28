<?php
// core includes
require_once('../core/inc/coreInc.php');
// filebox includes
require_once('../core/inc/func/app/fileBox/main.php');



// main file type
$type = '2,3';
$typeArr = explode(',', $type);


if (isset($_GET['fid'])) {


// get current folder id
if ($_GET['fid'] != 0) {
    $curDir = escape($_GET['fid']);

} else {
    $curDir = 0;

}


// make sure we can authorize this...
if (auth_dir($curDir, $user_id) == true) {
    
    // init our initial arrays
    $return = array();
    $folders = array();
    $files = array();

   if ($curDir != 0) {
       $current_folder = get_dir($curDir);
       $return['parent_id'] = $current_folder['parent_id'];
   } else {
       $return['parent_id'] = 0;
   }

    $dirList = read_dirFolders($curDir, $user_id);
    foreach ($dirList as $dir) {
        $fol_dat = array();
        $fol_dat['id'] = $dir['id'];
        $fol_dat['name'] = $dir['name'];
        $folders[] = $fol_dat;
    }
    $fileList = read_dirFiles($curDir, $user_id);
    foreach ($fileList as $file) {
        if (in_array($file['format'], $typeArr)) {
            $fil_dat = array();
            $fil_dat['id'] = $file['id'];
            $fil_dat['name'] = $file['name'];
            $fil_dat['type'] = $file['format'];
            $fil_dat['type_icon_url'] = 'http://www.classconnect.com/app/core/site_img/fileBox/formats/' . $file['icon'] . '.png';
            $fil_dat['content'] = $file['content'];
            $files[] = $fil_dat;
        }

    }


$return['folders'] = $folders;
$return['files'] = $files;

echo json_encode($return);

}


exit();
}
// issett ID
?>