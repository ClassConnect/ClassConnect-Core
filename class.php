<?php
require_once('core/inc/coreInc.php');
requireSession();

// get class ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	// set our class id variable
	$class_id = $_GET['id'];
	$classLevel = authClass($class_id);
	
	// set allow flag
	if ($classLevel != false) {
		$allow = 1;
	}
	
	
	
	
}
// end get class ID



if ($allow == 1) {
	$classData = getClass($class_id);
	$page_title = $classData['name'];

// load class page JS
$scriptArr[] = $scriptServer . 'classPage.js';
require_once('core/template/head/header.php');
// display class page HTML (JS hits it later)
?>
	<script type="text/javascript">
	var CKEDITOR_BASEPATH = '<?php echo $scriptServer; ?>ckedit/';
	</script>
	<script type="text/javascript" src="<?php echo $scriptServer; ?>ckedit/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo $scriptServer; ?>ckedit/adapters/jquery.js"></script>

<script type="text/javascript" >
var className = "<?php echo $classData['name']; ?>";
var classID = "<?php echo $classData['id']; ?>";
var appType = 1;
<?php
if ($classLevel == 3) {
?>
$(document).ready(function(){
	$("#classImg a").click(function(){
		return false;
	});	
		
	$("#classImg").hover(
  function () {
    $('#iconFloat').show();
  },
  function () {
    $('#iconFloat').hide();
  }
);
	
});
<?php	
}
?>
</script>

 <div id="class_sidebar">
<div id="classImg" style="width:128px; height:128px;  margin-left:10px; margin-bottom:5px">
<div id="changeImg" style="background: url(<?php echo $iconServer . $classData['prof_icon']; ?>)" class="classimg">
<div id="iconFloat" class="iconFloater"><a href="#" onClick="openBox('appLoad.cc?appType=1&cid=<?php echo $class_id; ?>&id=1&page=chooseIcon.php', 500)">Change Icon</a></div>
</div>
</div> 
 
<?php
// if this class isn't linked to a school
if ($classData['sid'] == 0) {
	$jArr = json_decode(reverse_htmlentities($theme['classPolicies']), true);
	$apps = getClassApps($jArr['list_type'], $jArr['exception_list']);

// if there is a school
} else {
	$thisSchool = getSchoolSession($classData['sid']);
	$jArr = json_decode(reverse_htmlentities($thisSchool['classPolicies']), true);
	$apps = getClassApps($jArr['list_type'], $jArr['exception_list']);
}
foreach ($apps as $app) {
    // <img src=" $imgServer; client_img/user/java.png" height="12" style="float:left; padding-top:4px; padding-right:3px;" />
    echo '<a href="#' . $app['id'] . '" onclick="selectApp(' . $app['id'] . ')"><li id="app' . $app['id'] . '">&nbsp;' . $app['name'] . '</li></a>';

}


?>
       </div>

<div id="main_wrap"><div id="navcrumbs" style="width:740px; height:35px;margin-left:10px"></div>
       <div id="class_main">
       
</div>
</div><!-- main_wrap -->

<?php
require_once('core/template/foot/footer.php');

// no permissions for this class found
} else {
	$page_title = 'Error';
	require_once('core/template/head/header.php');
	echo '<br /><center><span style="font-size:20px; color:#999; font-weight:bolder">Oops! This page does not exist.</span></center>';
	require_once('core/template/foot/footer.php');
}
?>