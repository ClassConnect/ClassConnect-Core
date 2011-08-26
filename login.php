<?php
require_once('core/inc/coreInc.php');
$page_title = 'Login';
// pull in signup api file
require_once('core/inc/func/user/addUser.php');

if (checkSession() == true) {
	// if this user is verified, send him home
	if ($status == 1) {
		
		if ($level == 1) {
			header('location:enroll.cc');
		} else {
			header('location:signup.cc');
		} 
	
	// if the user is verified, send them home
	} elseif ($status == 2) {
		header('location:home.cc');
	}

} // if there is a prev session detected

if (isset($_POST['submitted'])) {
	if (!isset($_POST['identity'])) {
		$_POST['identity'] == '';
	}
	if (!isset($_POST['pass'])) {
		$_POST['pass'] == '';
	}
	$user = userLogin($_POST['identity'], $_POST['pass']);
	if ($user != false) {
		// kill any existing sessions
		killSession();
		setSession($user['id']);
                                     $themeData =  getVanityScheme();

                                     if (!isset($themeData['swap'])) {
                                         $scid = $themeData['id'];
                                     } else {
                                         $scid = 0;
                                     }

                                     setLocalPolicies($user['id'], $scid);
		header('location:home.cc');
	} else {
		$errorBox = '<div class="errorbox" style="width: 575px; text-align: center; font-weight: bolder">Login Attempt Failed</div>';
	}
	
} // isset POST submitted

// remove bottom bar js and header divs
$extLock = 1;
// load signup JS
$scriptArr[] = $scriptServer . 'login-gen.js';
$themeData =  getVanityScheme();
require_once('core/template/head/header.php');
if ($themeData['swap'] == 1) {
    $swap = '<a href="http://www.classconnect.com" target="_blank"><img src="core/site_img/logo.png" style="margin-right:10px;float:left" /></a><div id="panel-title" style="font-size: 23px;color:#666666;margin-top:5px;">';
} else {
    $swap = '<img src="core/site_img/client_img/school/' . $themeData['settingLogo'] . '" style="margin-top:7px;margin-right:10px;float:left" />
<div id="panel-title" style="font-size: 23px;color:#666666;margin-top:5px;">' . $themeData['name'];
}
?>

<div id="lightbox-panel">   
<?php echo $swap; ?><img src="core/site_img/main/l_arrow.png" style="padding-left:10px; padding-right:10px" /><img src="core/site_img/gen/lock.png" width="20" style=" padding-right:10px" />Login</div>
<div id="main-block" style="margin-top:10px">
<?php echo $errorBox; ?>
<div id="cont-right" style="float:left; width:280px; border-right: 1px solid #ccc;">
<form method="POST" action="login.cc" style="padding-left:20px; padding-top:15px">
<strong>Email/Username</strong><br />
<input type="text" name="identity" style="width:215px" /><br /><br/>

<strong>Password</strong><br />
<input type="password" name="pass" style="width:215px" /><br /><br/>

<input type="hidden" name="submitted" value="submitted" />
<button class="button" type="submit"> 
<img src="<?php echo $imgServer; ?>gen/key.png" /> Login To ClassConnect
</button>
</form>

</div>
<div id="cont-left" style="float:right; width:298px; padding-top:10px">
<span style="font-size: 18px;color:#666666">Need A ClassConnect Account?</span>
<a href="enroll.cc" class="button"><img src="<?php echo $imgServer; ?>gen/student.png" />Student Signup</a><a href="signup.cc" class="button"><img src="<?php echo $imgServer; ?>gen/teacher.png" />Teacher Signup</a><br /><br /><br /><br />
<span style="font-size: 18px;color:#666666">Forgot Your Username/Password?</span> 
<a href="reset_password.cc" class="button"><img src="<?php echo $imgServer; ?>gen/resend.png" /> Reset Password</a> <a href="contact_support.cc" class="button"><img src="<?php echo $imgServer; ?>gen/email.png" /> Email Support</a>
<br /><br /><br /><br />
</div>




</div><!-- main -->
</div><!-- /lightbox-panel -->  
<div id="lightbox"></div><!-- /lightbox -->  
<?php
require_once('core/template/foot/foot.php');
?>