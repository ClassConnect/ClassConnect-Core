<?php
require_once('core/inc/coreInc.php');
$page_title = 'Reset Your Password';

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
	if (!isset($_POST['email']) || $_POST['email'] == '') {
		$attempt = false;
	} else {

	$attempt = resetPassStream($_POST['email']);
        }
	if ($attempt != false) {
                        $errorBox = '<div class="successbox" style="width: 575px; text-align: center; font-weight: bolder">Password reset successfully. Check your email.</div>';
            } else {
		$errorBox = '<div class="errorbox" style="width: 575px; text-align: center; font-weight: bolder">Invalid email entered. Try again.</div>';
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
<?php echo $swap; ?><img src="core/site_img/main/l_arrow.png" style="padding-left:10px; padding-right:10px" /><img src="core/site_img/gen/lock.png" width="20" style=" padding-right:10px" />Reset Password</div>
<div id="main-block" style="margin-top:10px">
<?php echo $errorBox; ?>
<div id="cont-right" style="float:left; width:280px; border-right: 1px solid #ccc;">
<form method="POST" action="reset_password.cc" style="padding-left:20px; padding-top:15px">
<strong>Email Address</strong><br />
<input type="text" name="email" style="width:215px" /><br />

<input type="hidden" name="submitted" value="submitted" />
<button class="button" type="submit" style="margin-left:20px; margin-top:10px">
<img src="<?php echo $imgServer; ?>gen/resend.png" /> Reset Your Password
</button>
</form>
<br /><br /><br />
</div>
<div id="cont-left" style="float:right; width:298px; padding-top:10px"><div style="height:5px"></div>
<span style="font-size: 14px;color:#666666">Enter an email address associated with your ClassConnect account where we can send you your password & username.<br /><a href="login.cc">Login to ClassConnect.</a></span>
<br />
</div>




</div><!-- main -->
</div><!-- /lightbox-panel -->
<div id="lightbox"></div><!-- /lightbox -->
<?php
require_once('core/template/foot/foot.php');
?>