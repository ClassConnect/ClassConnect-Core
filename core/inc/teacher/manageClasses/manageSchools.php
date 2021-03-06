<?php
if (isset($_GET['sd'])) {
	require_once('schoolInc.php');
	exit();
}
// check if there is a post
if(isset($_GET['s']) && is_numeric($_GET['s'])) {

if ($_GET['s'] == 2) { // user signed up; show the authentication screen


include('core/inc/user/var_set.php');
echo '<div id="query-left" style="float:left; width:240px;padding-top:10px;border-right: 1px solid #999;">
Enter school name, city or ZIP code.<br />
<input type="text" id="schoolsearch" name="schoolsearch" style="width:150px; padding:5px; float:left" /><button class="button" type="submit" onClick="searchSchool()">Search</button><br /><br />

<div style="text-align:center; font-size: 12px; font-weight: bolder;padding-top:10px">Can\'t find your school?</div>
<button class="button" onClick="schoolForm()" type="submit" style="margin-left: 40px"> 
Create A New School
</button>

</div>


<div id="query-right" style="float:right; width:350px; padding-left:5px"><br /><br /><p style="color:#999">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search for your school using the text box.</p>

</div>

<div style="float:right;clear:both;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a></div>';


	
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
	if (checkSchoolLink($_GET['id']) == false) {
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

</form>
<div style="clear:both;height:3px">&nbsp;</div>';
} else { // if this user is already a part of the school
		echo '<div id="failer"></div>
	<div class="errorbox" style="margin-top:10px; margin-bottom:10px">Woops! You\'re already an active teacher at ' . $school['name'] . '.</div>

<a href="#" onClick="verifySchool()" class="button"><img src="' . $imgServer . 'gen/back.png" /> Find Another School</a>

<div style="clear:both;height:3px">&nbsp;</div>';
	
}


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
<div style="float:right; padding-right:90px; margin-bottom:5px">
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
			Please check your <strong>school email</strong> and click the link to verify your account. Upon verifying your account, you will join your school\'s ClassConnect network.<br />
			<div style="float:right"><a href="manage-classes.cc" style="margin-top:10px" class="button"><img src="' . $imgServer . 'gen/cross.png" /> Close</a></div><br /><br />';


// email reset
} elseif ($_GET['s'] == 5) {
	if (checkUnverified($user_id) == true) {
		$linkData = good_query_assoc("SELECT * FROM school-users WHERE uid = '$user_id' LIMIT 1");
		sendActivation($firstname, $linkdata['code']);
		echo '<div class="successbox" style="width: 580px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder"><img src="' . $imgServer . 'gen/resend.png" /> Email Activation Link Sent Successfully</div>';
	}

// activate email
}
exit();	
} // if s

?>