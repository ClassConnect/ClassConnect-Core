<?php
require_once('core/inc/coreInc.php');
$page_title = 'Enroll';
// pull in signup api file
require_once('core/inc/func/user/addUser.php');

// if this user is verified, send him home
if ($status == 2) {
		header('location:home.cc');
}

// check if there is a post
if(isset($_GET['s']) && is_numeric($_GET['s'])) {
	if ($_GET['s'] == 1) { // if it's signup request...
		
	
	// take the array of post variables and if they aren't set, set them to ''
	$postArray = 'email,firstName,lastName,pass1,pass2,username';
	$postArray = explode(',', $postArray);
	foreach($postArray as $ele) {
		if (!isset($_POST[$ele])) {
			$_POST[$ele] = '';
		}
	}
	
	// add the user!
	$tryAdd = createUser(2, '1,2,5,6,9', $_POST['email'], $_POST['username'], $_POST['firstName'], $_POST['lastName'], '', $_POST['pass1'], $_POST['pass2'], 1, 0);
	
	// if the insert succeeded, return 1
	if ($tryAdd == 1) {
		echo "1";
	} else { //if the insert failed...
		echo '<div class="errorbox" style="width: 270px;margin-top:100px; margin-left:35px"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($tryAdd as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	

	
} elseif ($_GET['s'] == 2) { // school signup page
if (checkSession() == false) {
		if (isset($_POST['username'])) {
	$username1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['username'])));
	$password1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['pass1'])));
	$user1 = userLogin($username1, $password1);
	if ($user1 != false) {
		// if a session isn't set for this user, let's start one
			setSession($user1['id']);
                                                        setLocalPolicies($user1['id'], 0);
	} else {
			$alert = '<div class="errorbox" style="width: 575px; text-align: center; font-weight: bolder">Account Creation Failed</div>';
	}
	} // if post email=
}
if (checkSession() == true) {

// if a new school POST has been attempted
if (isset($_POST['classKey'])) { 

$authCode = checkCode($_POST['classKey']);
if ($authCode != false) {
	$enroll = enrollStudent($user_id, $authCode['id']);
	if ($enroll == true) {
		$attempt = createSchoolUser('', 1, $user_id, $authCode['sid'], 2);	
		activateUser($user_id);
		echo "1";
	} else {
		echo '<div class="errorbox" style="width: 575px; text-align: center; font-weight: bolder">You are already enrolled in this class.</div>';
	}
} else { // code not found 
	echo '<div class="errorbox" style="width: 575px; text-align: center; font-weight: bolder">Invalid Class Code.</div>';
	
}


exit();
} // end POST add school


	// find school in db, pull info, etc
	$school = getSchool($_GET['id']);
	echo '<div id="failer" style="margin-bottom:10px"></div>
	<div style="float:right; width:310px;padding-top:10px">Please enter your <strong>class code</strong> given to you by your teacher.<br /><br /></div>
	<form method="POST" id="class-code-signup">
	
<strong>Class Code</strong><br />
<input type="text" name="classKey" style="width:255px" /><br />
<span style="font-size:12px; font-style: italic; color: #666">10 digit code. <strong>ie: 1sd8hhv9zz</strong></span><br /><br >
<input type="hidden" name="sid" value="' . $school['id'] . '" />
<a href="#" onClick="submitCode()" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Add Class & Verify Account</a>
<div style="display:none"><input type="password" name="pass" /></div>

</form>
<br /><br />
			<div style="font-size:10px;padding-top:5px"><a href="logout.cc">Logout and finish this later.</a></div>';

	
} // if session


} elseif ($_GET['s'] == 3) {
if (checkSession() == true) {
	
setSession($user_id);
setLocalPolicies($user_id, 0);
echo '<div class="successbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Account Created Successfully!</div>
			Welcome to ClassConnect, ' . $firstname . '! You can now login to ClassConnect. Upon logging in you will be able to enroll in any additional classes that you may have.<br />
			<a href="home.cc" class="button" style="margin-top:10px;margin-left:150px"><img src="' . $imgServer . 'gen/key.png" /> Click Here To Login To ClassConnect!</a><br /><br />
			<div style="font-size:10px;padding-top:5px"><a href="logout.cc">Logout and finish this later.</a></div>';
			
}// check session
} // s received
exit();	
} // if s

// remove bottom bar js and header divs
$extLock = 1;
// load signup JS
$scriptArr[] = $scriptServer . 'enroll.js';


// handle sessions
if (checkSession() == true) {
	// if the user is already verified
	
	$initJS = '<script type="text/javascript">
 $(document).ready(function(){  
 verifyCode();
 })
</script>';

}

require_once('core/template/head/header.php');

echo $initJS;
?>
<div id="lightbox-panel">   
    <a href="http://www.classconnect.com" target="_blank"><img src="core/site_img/logo.png" style="float:left" border="0" /></a>
<div id="panel-title" style="font-size: 23px;color:#666666;margin-top:5px;"><img src="core/site_img/main/l_arrow.png" style="padding-left:10px; padding-right:10px" />Student Enrollment</div>


<div id="main-block" style="margin-top:20px">
<div id="cont-right" style="float:right; width:350px">
    <div class="signupBoxer">

        <span style="font-size:14px">Already have an account?</span><br />
        <a href="login.cc" style="font-size:12px"> Login to ClassConnect.</a>

        <div style="clear:both; margin-top:20px"></div>

        <span style="font-size:14px">Are you a teacher?</span><br />
        <a href="signup.cc" style="font-size:12px">Signup as a teacher!</a>

    </div>
</div>




<form method="POST" id="signup-form" style="margin-left:20px;margin-bottom:40px">
<strong>First Name</strong> <br />
<input type="text" name="firstName" style="width:215px" /><br /><br/>

<strong>Last Name</strong> <br />
<input type="text" name="lastName" style="width:215px" /><br /><br/>

<strong>Username</strong> <br />
<input type="text" name="username" style="width:215px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">You'll use this to login. <strong>ex: BobSaget22</strong></span>
<div id="hidersa" style="font-size:9px">
<a href="#" onClick="$('#emailfield').show(); $('#hidersa').hide();">Add an email address for login support</a>
</div>
<br />



<div id="emailfield" style="display:none"><br />
<strong>Email Address</strong><br />
<input type="text" name="email" style="width:215px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">Not required but it allows you to reset your password.</span><br /><br />
</div>

<strong>Password</strong> <br />
<input type="password" name="pass1" style="width:215px" /><br /><br/>

<strong>Confirm Password</strong> <br />
<input type="password" name="pass2" style="width:215px" /><br /><br/>

<button class="button" type="submit" style="margin-left:20px"> 
<img src="<?php echo $imgServer; ?>gen/tick.png" /> Create Your Account!
</button>
</form>



</div><!-- main -->
</div><!-- /lightbox-panel -->  
<div id="lightbox"></div><!-- /lightbox -->  
<?php
require_once('core/template/foot/foot.php');
?>