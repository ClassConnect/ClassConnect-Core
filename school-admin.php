<?php
require_once('core/inc/coreInc.php');
requireSession();

// get school id
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
	$sid = $_GET['id'];
}

// if this user has access to this school
if (checkSchoolLink($sid) == true) {
	$school = getSchool($sid);
} else {
	$page_title = "Error 404";
	require_once('core/template/head/header.php');
	echo '<br /><br /><br /><br /><div class="infobox" style="text-align:center"><strong>Uh oh!</strong> Either this page doesn\'t exist or you don\'t have permission to view it.</div>';
	require_once('core/template/foot/footer.php');
	exit();
}

// check if our account is an admin for this school
if (checkSchoolAdmin($sid) != true) {
	$page_title = "Authentication Error";
	require_once('core/template/head/header.php');
	echo '<br /><br /><br /><br /><div class="infobox" style="text-align:center"><strong>You\'re not an administrator of this school.<br /></strong>To become an administrator of this school, simply send us an email at support@classconnect.com or give us a call at (866) 844-5250.</div>';
	require_once('core/template/foot/footer.php');
	exit();
}


// ajax load dependencies, grabs id and then REQUIRES accordingly
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$incID = escape($_GET['s']);
	// set include url
	$incURL = 'core/inc/admin/';
	
	// load basic dashboard
	if ($incID == 1) {
		require_once($incURL . 'schoolInfo/dashboard.php');	
		
	// load basic info
	} elseif ($incID == 2) {
		require_once($incURL . 'schoolInfo/basicInfo.php');
	
	// load event calendar
	} elseif ($incID == 3) {
		require_once($incURL . 'schoolInfo/eventCal.php');
	
	// load filebox
	} elseif ($incID == 4) {
		require_once($incURL . 'schoolInfo/filebox.php');
	
	// load logo / color scheme
	} elseif ($incID == 5) {
		require_once($incURL . 'schoolSettings/scheme.php');
		
	// load vanity url
	} elseif ($incID == 6) {
		require_once($incURL . 'schoolSettings/vanity.php');
		
	// load subscription
	} elseif ($incID == 7) {
		require_once($incURL . 'schoolSettings/subscription.php');
	
	// load vanity url
	} elseif ($incID == 8) {
		require_once($incURL . 'userManagement/manage.php');	
		
	// load vanity url
	} elseif ($incID == 9) {
		require_once($incURL . 'userManagement/policies.php');
	
	// load sso/ldap
	} elseif ($incID == 10) {
		require_once($incURL . 'userManagement/sso.php');	
		
	// load grading periods
	} elseif ($incID == 12) {
		require_once($incURL . 'classManagement/periods.php');

                // load grading periods
	} elseif ($incID == 13) {
		require_once($incURL . 'classManagement/policies.php');
	
	}





//exit script here
exit();	
}


$page_title = $school['name'];

//load menu js
$scriptArr[] = $scriptServer . 'sdmenu.js';
require_once('core/template/head/header.php');

?>
<script type="text/javascript">
function swapPage(pageID) {
$("#adminPanel").html('<br /><br /><br /><center><img src="/app/core/site_img/load.gif" /></center>');
$.ajax({
   type: "GET",
   url: "school-admin.cc?id=<?php echo $school['id']; ?>&s="+pageID,
   success: function(msg){
     $("#adminPanel").html(msg);
   }
 });

    
}

function updatePage(purl) {
$.ajax({
   type: "GET",
   url: purl,
   success: function(msg){
     $("#adminPanel").html(msg);
   }
 });

    
}



$(document).ready(function() {
    myMenu = new SDMenu("my_menu");
	myMenu.init();
});




 function getCurrentFolder() {
	if (self.document.location.hash.substring(1) != 0) {
 		return self.document.location.hash.substring(1);
 	} else {
 		return 1;
 	}
} // end get

 $(document).ready(function(){
 	var pid = getCurrentFolder();
 	swapPage(pid);
 });
	</script>
	

<div style="float: left" id="my_menu" class="sdmenu">
    <div class="collapsed">
        <span>School Information</span>
        <a href="#1" id="xoar1" onClick="swapPage(1)">School Dashboard</a>
        <a href="#2" id="xoar2" onClick="swapPage(2)">Basic Information</a>
        <!-- <a href="#3" onClick="swapPage(3)">Event Calendar</a> -->
      <!--   <a href="#4" onClick="swapPage(4)">School FileBox</a> -->
      </div>
      <div class="collapsed">
        <span>School Settings</span>
        <a href="#5" id="xoar5" onClick="swapPage(5)">Logo / Color Scheme</a>
        <a href="#6" id="xoar6" onClick="swapPage(6)">Vanity URL</a>
        <a href="#7" id="xoar7" onClick="swapPage(7)">Subscription</a>
      </div>
      <div class="collapsed">
        <span>User Management</span>
        <a href="#8" id="xoar8" onClick="swapPage(8)">Manage Accounts</a>
        <a href="#9" id="xoar9" onClick="swapPage(9)">User Policies</a>
        <a href="#10" id="xoar10" onClick="swapPage(10)">Configure LDAP (SSO)</a>
      </div>
      <div class="collapsed">
        <span>Class Management</span>
      <!--   <a href="#11" onClick="swapPage(11)">Manage Classes</a> -->
        <a href="#12" id="xoar12" onClick="swapPage(12)">Manage Grading Periods</a>
         <a href="#13" id="xoar13" onClick="swapPage(13)">Class Policies</a>
      <!--   <a href="#">Import / Export Courses</a> -->
      </div>
    </div>
    
<div id="adminPanel">

</div>

<?php
require_once('core/template/foot/footer.php');
?>