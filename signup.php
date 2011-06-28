<?php
$cryptinstall="crypt/cryptographp.fct.php";
include $cryptinstall;
require_once('core/inc/coreInc.php');
$page_title = 'Sign Up';
// pull in signup api file
require_once('core/inc/func/user/addUser.php');

// if this user is verified, send him home
if ($status == 2 && !isset($_GET['h'])) {
		header('location:home.cc');
}

// redirect if student
if ($level == 1) {
	header('location:enroll.cc');
}

// check if there is a post
if(isset($_GET['s']) && is_numeric($_GET['s'])) {
	if ($_GET['s'] == 1) { // if it's signup request...
		
	if (chk_crypt($_POST['code'])) { // proceed only if the captcha is correct
	
	// take the array of post variables and if they aren't set, set them to ''
	$postArray = 'email,firstName,lastName,pass1,pass2';
	$postArray = explode(',', $postArray);
	foreach($postArray as $ele) {
		if (!isset($_POST[$ele])) {
			$_POST[$ele] = '';
		}
	}
	
	// add the user!
	$tryAdd = createUser(2, '1,2,3,5,6', $_POST['email'], '', $_POST['firstName'], $_POST['lastName'], '', $_POST['pass1'], $_POST['pass2'], 3, 0);
	
	// if the insert succeeded, return 1
	if ($tryAdd == 1) {
		echo "1";
	} else { //if the insert failed...
		echo '<div class="errorbox" style="width: 300px;margin-top:100px"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($tryAdd as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
	// captcha catch
	} else {
    echo '<div class="errorbox" style="width: 300px;margin-top:100px"><span style="font-size:14px; font-weight:bolder">Oops!</span><li>You entered the captcha incorrectly.</li></div>';
   }


} elseif ($_GET['s'] == 2) { // user signed up; show the authentication screen
	if (checkSession() == false) {
		if (isset($_POST['email'])) {
	$email1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['email'])));
	$password1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['pass1'])));
	$user1 = userLogin($email1, $password1);
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
include('core/inc/user/var_set.php');
echo $alert . '<div class="infobox" style="width: 575px">Welcome to ClassConnect, ' . $firstname . '! In order to keep ClassConnect secure, we require teachers to verify their school email address. Use the tool below to find (or add) your school.</div>

<div id="query-left" style="float:left; width:240px;padding-top:10px;border-right: 1px solid #999;">
Enter school name, city or ZIP code.<br />
<input type="text" id="schoolsearch" name="schoolsearch" style="width:150px; padding:5px; float:left" /><button class="button" type="submit" onClick="searchSchool()">Search</button><br /><br />

<div style="text-align:center; font-size: 12px; font-weight: bolder;padding-top:10px">Can\'t find your school?</div>
<button class="button" onClick="schoolForm()" type="submit" style="margin-left: 40px"> 
Create A New School
</button>

<br /><br />
<span style="font-size:10px"><a href="logout.cc">Logout and finish this later.</a></span>

</div>


<div id="query-right" style="float:right; width:350px; padding-left:5px"><br /><br /><p style="color:#999">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search for your school using the text box.</p>

</div>';
} // check session

	
} elseif ($_GET['s'] == 3) { // school signup page

// if a new school email POST has been attempted
if (isset($_POST['semail'])) {
	$email = escape($_POST['semail']);
	$sid = escape($_POST['sid']);
	$attempt = createSchoolUser($email, 3, $user_id, $sid, 1);	
	if ($attempt == 1) {		
		echo "1";
	} else {
		echo '<div class="errorbox" style="width: 580px;margin-top:10px;margin-bottom:10px">';
		foreach ($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
exit();
} 

// if a new school POST has been attempted
if (isset($_POST['name'])) { 
$postArray = 'name,email,website,phone,city,zip,country,state';
	$postArray = explode(',', $postArray);
	foreach($postArray as $ele) {
		if (!isset($_POST[$ele])) {
			$_POST[$ele] = '';
		}
	}


$tryCreate = createSchool(1, '1,2,7,8', $_POST['name'], $_POST['email'], $user_id, $_POST['website'], $_POST['phone'], $_POST['city'], $_POST['zip'], $_POST['country'], $_POST['state']);

if ($tryCreate == 1) {
		echo "1";
	} else { //if the insert failed...
		echo '<div class="errorbox" style="width: 580px;margin-top:10px"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($tryCreate as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
exit();
} // end POST add school


if (is_numeric($_GET['id']) || is_numeric($_POST['sid'])) {
	// find school in db, pull info, etc
	$school = getSchool($_GET['id']);
	echo '<div id="failer"></div>
	<div style="float:right; width:310px;padding-top:10px">Please enter your <strong>school email address</strong> given to you by ' . $school['name'] . '.<br /><br /></div>
	<form method="POST" id="school-email-signup">
	
<strong>School Email Address</strong><br />
<input type="text" name="semail" style="width:255px" /><br />
<span style="font-size:12px; font-style: italic; color: #666">ex: yourname@yourschool.edu</span><br /><br >
<input type="hidden" name="sid" value="' . $school['id'] . '" />
<a href="#" onClick="verifySchool()" class="button"><img src="' . $imgServer . 'gen/cross.png" /> Cancel</a>
<a href="#" onClick="submitEmail()" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Submit & Verify Email</a>
<div style="display:none"><input type="password" name="pass" /></div>

</form>';

} else {
	// add school panel
	echo '<script type="text/javascript" src="' . $scriptServer . 'states.js"></script><form method="POST" id="school-signup">	
<div id="failer"></div>
<div id="cont-left" style="float:left; width:240px;padding-top:10px;border-right: 1px solid #999;">
<strong>School Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" /><br /><br/>

<strong>Your School Email Address</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="email" style="width:215px" /><br />
<span style="font-size:9px; font-style: italic; color: #666">ex: yourname@yourschool.edu</span><br /><br />

<strong>School Website</strong><br />
<input type="text" name="website" style="width:215px" /><br /><br/>

<strong>Phone Number</strong><br />
<input type="text" name="phone" style="width:215px" /><br /><br />

</div>

<div id="cont-right" style="float:left; width:240px;padding-top:10px;padding-left:25px">
<strong>City</strong><br />
<input type="text" name="city" style="width:215px" /><br /><br/>

<strong>ZIP</strong><br />
<input type="text" name="zip" style="width:215px" /><br /><br/>

<strong>Country</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<div>
<select id="countrySelect" name="country" onchange="populateState()"></select><br /><br>

<strong>State</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<select id="stateSelect" name="state"></select><br /><br />

<script type="text/javascript">initCountry(\'US\'); </script>
</div>
</div>

<div style="clear:both"></div><br />
<div style="float:right; padding-right:90px">
<a href="#" onClick="verifySchool()" class="button"><img src="' . $imgServer . 'gen/cross.png" /> Cancel</a>
<a href="#" onClick="submitSchool()" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Create School & Verify Email</a>
</div>
</form>';
}
	
	
	
	
} elseif ($_GET['s'] == 4) {
	if (is_numeric($_GET['t'])) {
		if ($_GET['t'] == 1) {
			$msgbox = '<div class="successbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Account Created Successfully!</div>';
		} elseif ($_GET['t'] == 2) {
			$msgbox = '<div class="errorbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">School Email Not Activated</div>';
		} elseif ($_GET['t'] == 3) {
		 	$msgbox = '<div class="successbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">School Email Changed Successfully</div>';
		} // if t == x
	}
		echo '<div id="msgbox">' . $msgbox . '</div>
			Welcome to ClassConnect, ' . $firstname . '! Please check your <strong>school email</strong> and click the link to verify your account. Upon verifying your account, you will be able to login to
			ClassConnect.<br />
			<a href="#" onClick="requestEmail();" class="button" style="margin-top:10px; margin-left:100px"><img src="' . $imgServer . 'gen/resend.png" /> Resend Email Link</a> <a href="#" onClick="showchangeEmail();" class="button" style="margin-top:10px"><img src="' . $imgServer . 'gen/change.png" /> Change School Email Address</a><br /><br />
			<div style="font-size:10px;padding-top:5px"><a href="logout.cc">Logout and finish this later.</a></div>';


// email reset
} elseif ($_GET['s'] == 5) {
	if (checkUnverified($user_id) == true) {
		$linkData = good_query_assoc("SELECT * FROM school_users WHERE uid = '$user_id' LIMIT 1");
		sendActivation($firstname, $linkData['code'], $linkData['email']);
		echo '<div class="successbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder"><img src="' . $imgServer . 'gen/resend.png" /> Email Activation Link Sent Successfully</div>';
	}

// change email
} elseif ($_GET['s'] == 6) {	
	if (checkUnverified($user_id) == true) {

// if a new school email POST has been attempted
if (isset($_POST['semail'])) {
	$email = escape($_POST['semail']);
	$sid = escape($_POST['sid']);
	
	
	$attempt = createSchoolUser($email, 3, $user_id, $sid, 1);	
	if ($attempt == 1) {
		good_query("DELETE FROM school_users WHERE uid = '$user_id' AND email != '$email'");		
		echo "1";
	} else {
		echo '<div class="errorbox" style="width: 580px;margin-top:10px;margin-bottom:10px">';
		foreach ($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
exit();
} 
		
		
		
	$linkData = good_query_assoc("SELECT * FROM school_users WHERE uid = '$user_id' LIMIT 1");
	// find school in db, pull info, etc
	$school = getSchool($linkData['sid']);
	echo '<div id="failer"></div>
	<div style="float:right; width:310px;padding-top:10px">Please enter your <strong>school email address</strong> given to you by ' . $school['name'] . '.<br /><br /></div>
	<form method="POST" id="school-email-signup">
	
<strong>School Email Address</strong><br />
<input type="text" name="semail" style="width:255px" value="' . $linkData['email'] . '" /><br />
<span style="font-size:12px; font-style: italic; color: #666">ex: yourname@yourschool.edu</span><br /><br >
<input type="hidden" name="sid" value="' . $school['id'] . '" />
<a href="#" onClick="allowLogin(2)" class="button"><img src="' . $imgServer . 'gen/cross.png" /> Cancel</a>
<a href="#" onClick="changeEmail()" class="button"><img src="' . $imgServer . 'gen/tick.png" /> Change School Email</a>
<div style="display:none"><input type="password" name="pass" /></div>

</form>';
		
	}
	
// auth email hashcodes
} elseif ($_GET['s'] == 7) {
	$code = escape($_GET['h']);
	$select = good_query_assoc("SELECT * FROM school_users WHERE code = '$code' LIMIT 1");
	if ($select != false) {
		activateLinkedUser($select['lid']);
		activateUser($select['uid']);
		setSession($select['uid']);
                                     setLocalPolicies($select['uid'], 0);
		header('location:home.cc');
	} else {
		header('refresh: 0; url=signup.php');
	}
	
	
} // s received
exit();	
} // if s

// remove bottom bar js and header divs
$extLock = 1;
// load signup JS
$scriptArr[] = $scriptServer . 'signUp.js';


// handle sessions
if (checkSession() == true) {
	// if the user is already verified
	
	$initJS = '<script type="text/javascript">
 $(document).ready(function(){  ';
	if (checkUnverified($user_id) == true) {
		// if their account is waiting for activation
		$initJS .= 'allowLogin(2);';
	} else {
		// if their account has no pending school links to it
		$initJS .= 'verifySchool();';
	}
$initJS .= '})
</script>';

}
$themeData =  getVanityScheme();
require_once('core/template/head/header.php');

echo $initJS;
?>
<script>
    	$(function() {
                $( "#progressbar > div" ).addClass('bevColor');
	});
</script>
<div id="lightbox-panel">   
<a href="http://www.classconnect.com" target="_blank"><img src="core/site_img/logo.png" style="float:left" border="0" /></a>
<div id="panel-title" style="font-size: 23px;color:#666666;margin-top:5px;"><img src="core/site_img/main/l_arrow.png" style="padding-left:10px; padding-right:10px" />Teacher & Admin Signup</div>

<div id="progressbar"></div>

<div id="main-block" style="margin-top:10px">
<div id="cont-right" style="float:right; width:350px">
    <div class="signupBoxer">
            
        <span style="font-size:14px">Already have an account?</span><br />
        <a href="login.cc" style="font-size:12px"> Login to ClassConnect.</a>

        <div style="clear:both; margin-top:20px"></div>

        <span style="font-size:14px">Are you a student?</span><br />
        <a href="enroll.cc" style="font-size:12px">Signup as a student!</a>

    </div>
</div>




<form method="POST" id="signup-form">
<strong>First Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="firstName" style="width:215px" /><br /><br/>

<strong>Last Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="lastName" style="width:215px" /><br /><br/>

<strong>Email Address</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="email" style="width:215px" /><br /><br/>

<strong>Password</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="password" name="pass1" style="width:215px" /><br /><br/>

<strong>Confirm Password</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="password" name="pass2" style="width:215px" /><br /><br/>
<?php dsp_crypt(0,1); ?>
<strong>Enter The Code:<span style="color:#dd1100;font-style: bolder">*</span> <input type="text" name="code" style="width:100px" /><br /><br />
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