<?php
require_once('core/inc/coreInc.php');
requireSession();

// get school id
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
	$sid = $_GET['id'];
}

// if this user has access to this school
if (checkSchoolLink($sid) == true) {
	$thisSchool = getSchool($sid);
} else {
	echo "Critical Error";
	exit();
}
// check if our account is an admin for this school
$tempSchool = getSchoolSession($sid);
if ($tempSchool['subscription'] == 0) {
	if ($tempSchool['type'] == 3 || $tempSchool['type'] == 4) {
		$isAdmin = true;
	}
} else {
	if ($tempSchool['type'] == 4) {
		$isAdmin = true;
	}
}

if (!isset($tempSchool)) {
	$page_title = "Authentication Error";
	require_once('core/template/head/header.php');
	echo '<br /><br /><br /><br /><div class="infobox" style="text-align:center"><strong>You haven\'t verified your email address for this school.<br /></strong>Click the confirmation link in the email we sent you. Need help? Email us at support@classconnect.com or give us a call at (866) 844-5250.</div>';
	require_once('core/template/foot/footer.php');
	exit();
}

 
$page_title = $thisSchool['name'];
$scriptArr[] = $scriptServer . 'classPage.js';
require_once('core/template/head/header.php');

?>
<script type="text/javascript" >
var className = "<img src=\"<?php echo $imgServer; ?>client_img/school/<?php echo $thisSchool['settingLogo']; ?>\" style='margin-right:10px;float:left; padding-top:2px' /><?php echo $thisSchool['name'] ?>";
var classID = "<?php echo $sid; ?>";
var appType = 3;
</script>



 <div id="class_sidebar">
<a href="#1" onclick="selectApp(1)"><li id="app1">&nbsp;School Page</li></a>
<a href="#10" onclick="selectApp(10)"><li id="app10">&nbsp;School Info</li></a>
<?php if ($isAdmin) { ?>
<a href="school-admin.cc?id=<?php echo $sid; ?>"><li>&nbsp;Admin Panel</li></a>
<?php } ?>
       </div>

<div id="main_wrap"><div id="navcrumbs" style="width:740px; height:35px;margin-left:10px"></div>
       <div id="class_main">

</div>
</div><!-- main_wrap -->


<?php
require_once('core/template/foot/footer.php');
?>