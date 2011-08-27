<?php
require_once('core/inc/coreInc.php');
requireSession();


$page_title = 'Gradebook';
require_once('core/template/head/header.php');
?>
<style type="text/css">
.classList {
	cursor:pointer;color:#666;font-size:16px;border-bottom:1px solid #ccc;padding:10px;
}
.classList:hover{
	cursor:pointer;background-color:#eeeeff;
}
</style>
<div style="clear:both"></div>

<?php
if (isset($_GET['cid'])) {
	$cid = escape($_GET['cid']);
		// set our class id variable
		$classLevel = authClass($cid);
		
		// set allow flag
		if ($classLevel != false) {
			$allow = 1;
		}
	
	
	
	
	




if ($allow == 1) {
$classData = getClass($cid);
?>

<div style="height:30px;margin-bottom:10px;clear:both">

<div id="navcrumbs" style="width:740px; height:30px;"><a href="gradebook.cc">Gradebooks</a> <img src="core/site_img/main/l_arrow.png"> <?php echo $classData['name']; ?></div>

</div>

<?php
$port = 3069;
$host = $_SERVER['SERVER_NAME'];
if($host == 'ccinternal.com')
	$port = 3002;
if($host == 'ccbetadev.com')
	$port = 3001;
$url = 'http://'.$host.':'.$port.'/gradebooks/'.$_GET['cid'].'/?session_id='.session_id();
//echo '<p class="action lawsuit" style="display:none">'.$url.'</p>';
echo file_get_contents($url);




	} else {
		echo '<div id="navcrumbs" style="width:740px; height:35px">Oops! You can\'t view this gradebook. <a href="gradebook.cc">Go back.</a></div>';
	}




} else {
?>

<div style="height:30px;">

<div id="navcrumbs" style="width:740px; height:35px">Choose a class gradebook below...</div>

</div>

<?php
foreach ($myClasses as $gClass) {
	echo '<div class="classList" onclick="window.location = \'gradebook.cc?cid=' . $gClass['id'] . '\';"><img src="' . $iconServer . $gClass['prof_icon'] . '" style="height:24px;float:left;margin-right:10px" />' . $gClass['name'] . '</div>';
}



}


require_once('core/template/foot/footer.php');
?>