<?php
// awesome email validation tool
function validEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}




// create user function
function createUser($auth, $requiredFields, $email, $username, $firstName, $lastName, $cell, $password, $password2, $level, $prof_icon) {
	global $dbc;
	// create errors array	
	$errors = array();
	
	
	
	// check for first name
	if ($firstName != '' && strlen($firstName) > 1) {
		$firstName = escape($firstName);
	} else {
		$errors[1] = 'No first name was entered.';
	}
	
	
	// check for last name
	if ($lastName != '') {
		$lastName = escape($lastName);
	} else {
		$errors[2] = 'No last name was entered.';
	}
	
	
	// check for email
	if ($email != '') {
		// if email present, lets validate it
		$email = escape($email);
		if (validEmail($email) != true) {
			$errors[3] = 'Email address not valid.';
		} else {
			$checkMail = good_query_assoc("SELECT * FROM users WHERE e_mail = '$email' LIMIT 1");
			if ($checkMail != false) {	
				$errors[3] = 'This email address has already been used.';
			}
		} // valid email else	
	} else {
		$errors[3] = 'No email address was entered.';
	}
	
	
	// check for cell phone
	if ($cell != '') {
		$cell = escape($cell);
	} else {
		$errors[4] = 'No cell number was entered.';
	}
	
	
	// check for last name
	if ($password != '') {
		$password = escape($password);
		$password2 = escape($password2);
		if ($password != $password2) {
			$errors[5] = 'Your passwords did not match.';
		} else {
			if (strlen($password) < 5) {
				$errors[5] = 'Your password needs to be 5 or more characters.';
			}
		}
	} else {
		$errors[5] = 'No password was entered.';
	}
	
	
	// check for level
	if ($level != '') {
		if ($auth == 1) {
			if ($level != 1 || $level != 3) {
				$errors[6] = 'User level invalid.';
			}
		}
		$level = escape($level);
	} else {
		$errors[6] = 'No user level was given.';
	}
	
	
	// check for profile icon
	if ($prof_icon != '') {
		$prof_icon = escape($prof_icon);
	} else {
		$errors[7] = 'No profile icon was chosen.';
	}
	
	
	
	
	
	// check for username
	if ($username != '') {
		// if email present, lets validate it
		$username = escape($username);
		if (strlen($username) <= 4) {
			$errors[9] = 'Username must be more than 4 characters.';
		} else {
			$checkName = good_query_assoc("SELECT * FROM users WHERE user_name = '$username' LIMIT 1");
			if ($checkName != false) {	
				$errors[9] = 'This username has already been taken.';
			}
		} // valid email else	
	} else {
		$errors[9] = 'No username was entered.';
	}
	
	
	// check if all required fields have been met
	$requiredFields = escape($requiredFields);
	$reqArr = explode(',', $requiredFields);
	$output = array();
	
	
	foreach ($reqArr as $element) {
		if (isset($errors[$element])) {
			$output[$element] = $errors[$element];
		}
	}
	
	// catch for student side, if they enter an email (not required)
	if ($errors[3] == 'This email address has already been used.' || $errors[3] == 'Email address not valid.') {
		$output[3] = $errors[3];
	}

	
	if(empty($output)) {
		// insert user into db, return user id
	$insertUser = good_query("INSERT INTO users (first_name, last_name, user_name, level, pass, e_mail, cell, prof_icon, reg_date) VALUES ('$firstName', '$lastName', '$username', '$level', SHA1('$password'), '$email', '$cell',  '$prof_icon', NOW() )");
		return 1;
		
	} else {
		return $output;
	}
	
	
	
	
} // end createUser function



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// create school function
function createSchool($auth, $requiredFields, $name, $schoolEmail, $userID, $website, $phone, $city, $zip, $country, $state) {
	global $dbc;
	
		// create errors array	
	$errors = array();
	
	
	
	// check for first name
	if ($name != '' && strlen($name) > 1) {
		$name = escape($name);
	} else {
		$errors[1] = 'No school name was entered.';
	}
	
	
	// check for email
	if ($schoolEmail != '') {
		// if email present, lets validate it
		$schoolEmail = escape($schoolEmail);
		if (validEmail($schoolEmail) != true) {
			$errors[2] = 'Email address not valid.';
		} else {
			$checkMail = good_query_assoc("SELECT * FROM school-users WHERE email = '$schoolEmail' LIMIT 1"); ///////////////////////////////////////////////////////////////////////////////
			if ($checkMail != false) {	
				$errors[2] = 'This email address has already been used.';
			}
		} // valid email else	
	} else {
		$errors[2] = 'No email address was entered.';
	}
	
	
		// check for last name
	if ($website != '') {
		$website = escape($website);
	} else {
		$errors[3] = 'No website was entered.';
	}
	
	
	// check for phone number
	if ($phone != '') {
		$phone = escape($phone);
	} else {
		$errors[4] = 'No phone number was entered.';
	}
	
	
	// check for city
	if ($city != '') {
		$city = escape($city);
	} else {
		$errors[5] = 'No city was entered.';
	}
	
	
	// check for zip
	if ($zip != '') {
		$zip = escape($zip);
	} else {
		$errors[6] = 'No zip was entered.';
	}
	
	
	// check for country
	if ($country != '') {
		$country = escape($country);
	} else {
		$errors[7] = 'No country was entered.';
	}
	
	
	// check for state
	if ($state != '') {
		$state = escape($state);
	} else {
		$errors[8] = 'No state was entered.';
	}
	
	
	// check if all required fields have been met
	$requiredFields = escape($requiredFields);
	$reqArr = explode(',', $requiredFields);
	$output = array();
	
	
	foreach ($reqArr as $element) {
		if (isset($errors[$element])) {
			$output[$element] = $errors[$element];
		}
	}

	
	if(empty($output)) {
            $userPols = escape('{
"teacher_communication":1,
"student_communication":1,
"auto_add":1,
"teach_list_type":1,
"teach_exception_list":"",
"stud_list_type":1,
"stud_exception_list":"7"
}');
             $classPols = escape('{
"auto_add":1,
"list_type":1,
"exception_list":""
}');
		// insert user into db, return user id
		$insertUser = @mysqli_query($dbc, "INSERT INTO schools (name, website, phone, city, state, zip, country, status, userPolicies, classPolicies, reg_date) VALUES ('$name', '$website', '$phone', '$city', '$state', '$zip', '$country', '1', '$userPols', '$classPols', NOW() )");
		
		// if we have standard authentication, we must create a user
		if ($auth == 1) {
			$sid = $dbc->insert_id;
			createSchoolUser($schoolEmail, 3, $userID, $sid, 1);
		}
		
		return 1;
		
	} else {
		return $output;
	}
	
	
	
	
	
	
} // end createSchool function





// Create user-school identity function
function createSchoolUser($email, $type, $uid, $sid, $verified) {
	
	$errors = array();
	if ($type != 1) {
	// check for email
	if ($email != '') {
		// if email present, lets validate it
		$email = escape($email);
		if (validEmail($email) != true) {
			$errors[1] = 'Email address not valid.';
		} else {
			$checkMail = good_query_assoc("SELECT * FROM school_users WHERE email = '$email' LIMIT 1"); ///////////////////////////////////////////////////////////////////////////////
			if ($checkMail != false) {	
				$errors[1] = 'This email address has already been used.';
			}
		} // valid email else	
	} else {
		$errors[1] = 'No email address was entered.';
	}
	
	$school = getSchool($sid);
	// if auth type is url only
	if ($school['authType'] == 2) {
		$emailURL = substr($email, strpos($email, '@') + 1, strlen($email));
		if ($emailURL != $school['emailUrl']) {
			$errors[1] = 'This is not a ' . $school['name'] . ' email address.';
		}
	
	// if auth type is white list
	} elseif ($school['authType'] == 3) {
		$whiteEmails = explode(',', str_replace(" ", "", strtolower(preg_replace("/[^a-zA-Z0-9@.,-_+\s]/", "", $school['whiteEmails']))) );
		foreach ($whiteEmails as $emailAdd) {
			if ($emailAdd == strtolower($email)) {
                                                            $pass = 1;
			}
	}
                        if ($pass != 1) {
                            $errors[1] = 'This email address has not been allowed ' . $school['name'] . '.';
                        }
	
	// if auth type is not allowed
	} elseif ($school['authType'] == 4) {	
		$errors[1] = 'Registration for this school is closed. Contact a school admin for assistance.';
	}
	
	} // teacher and admin email only
	
	
	// if there are errors
	if (!empty($errors)) {
		return $errors;
	} else {
		$code = SHA1($email . $id . date('m/d/Y/i/s') . 'cc4');
		$insert = good_query("INSERT INTO school_users (email, type, uid, sid, verified, code, reg_date) VALUES ('$email', $type, '$uid', '$sid', $verified, '$code', NOW() )");
		sendActivation($firstname, $code, $email);
		return 1;
	}
}




// Send teacher an email with activation link function
function sendActivation($first_name, $code, $email) {
	$body = "Hello $first_name,\n
	Please visit the link below to activate your ClassConnect account.\n\n
	
	http://www.classconnect.com/app/signup.cc?s=7&h=$code \n\n
	
	If you encounter any problems, feel free to reply to this email and we'll assist you in any way possible!\n\n
	
	Sincerely,\n
	The ClassConnect Support Team";
	mail($email, 'Activate Your ClassConnect Account', $body, "From: support@classconnect.com");
	
}



// function we execute when a user is verified
function activateLinkedUser($linkedUID) {
	good_query("UPDATE school_users SET verified = 2 WHERE lid = $linkedUID");
}

// function we execute when a user is verified
function activateUser($uid) {
	good_query("UPDATE users SET verified = 2 WHERE id = $uid");
}

?>