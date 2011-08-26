<?php
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
		$email1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['email'])));
		$password1 = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['pass1'])));
		$user1 = userLogin($email1, $password1);
		activateUser($user1['id']);
		setSession($user1['id']);
        setLocalPolicies($user1['id'], 0);
        // init wizard on signup
        $_SESSION['wizard'] = 1;
		$_SESSION['wizardStep'] = 0;
		$_SESSION['wizViz'] = array();
		// send 'personalized' email
        mail($user1['e_mail'], "ClassConnect - Follow up", "Hi there,\n\nI just wanted to check in to see if you need any help getting started or have any initial questions. If you're good for now, feel free to contact me at any point in the process at vic@classconnect.com and I'd be happy to help you out.\n\nThanks,\nVic", "From: vic@classconnect.com");
	} else { //if the insert failed...
		echo '<div class="errorbox" style="width: 270px;margin-top:100px; margin-left:35px"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($tryAdd as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
	
// auth email hashcodes
} elseif ($_GET['s'] == 7) {
	$code = escape($_GET['h']);
	$select = good_query_assoc("SELECT * FROM school_users WHERE code = '$code' LIMIT 1");
	if ($select != false) {
		activateLinkedUser($select['lid']);
		setSession($select['uid']);
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
<div id="lightbox-panel">   
<a href="http://www.classconnect.com" target="_blank"><img src="core/site_img/logo.png" style="float:left" border="0" /></a>
<div id="panel-title" style="font-size: 23px;color:#666666;margin-top:5px;"><img src="core/site_img/main/l_arrow.png" style="padding-left:10px; padding-right:10px" />Teacher & Admin Signup</div>


<div id="main-block" style="margin-top:20px">
<div id="cont-right" style="float:right; width:350px">
    <div class="signupBoxer">
            
        <span style="font-size:14px">Already have an account?</span><br />
        <a href="login.cc" style="font-size:12px"> Login to ClassConnect.</a>

        <div style="clear:both; margin-top:20px"></div>

        <span style="font-size:14px">Are you a student?</span><br />
        <a href="enroll.cc" style="font-size:12px">Signup as a student!</a>

    </div>
</div>




<form method="POST" id="signup-form" style="margin-left:20px;margin-bottom:40px">
<strong>First Name</strong> <br />
<input type="text" name="firstName" style="width:215px" /><br /><br/>

<strong>Last Name</strong> <br />
<input type="text" name="lastName" style="width:215px" /><br /><br/>

<strong>Email Address</strong> <br />
<input type="text" name="email" style="width:215px" /><br /><br/>

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