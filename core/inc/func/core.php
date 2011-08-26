<?php
//////////////////////////////////// - CLASSCONNECT 4.0 : ROADMAP ECHO - ////////////////////////////////////
// This file contains ClassConnect's core functionality. Enjoy!
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Non-user specific functions (login, sessions, etc)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// login user via email/username and password
function userLogin($identity, $password) {
	$errors = array();	
	
	if ($identity != '') {
		$identity = escape($identity);
	} else {
		$errors[1] = 'No username was entered.';
	}
	
	if ($password != '') {
		$password = escape($password);
	} else {
		$errors[1] = 'No password was entered.';
	}
	if (empty($errors)) {
		$user = good_query_assoc("SELECT * FROM users LEFT JOIN school_users ON school_users.uid = users.id WHERE users.pass = SHA1('$password') AND (users.user_name = '$identity' OR users.e_mail = '$identity' OR school_users.email='$identity') LIMIT 1");
                // update last_login
                 good_query("UPDATE users SET last_login = NOW() WHERE id = " . $user['id']);
		return $user;
	} else {
		return false;
	}
} // end userLogin


// check if this unverified user has an outstanding unverified school link
function checkUnverified($uid) {
		$linked = good_query_table("SELECT * FROM school_users WHERE uid = '$uid'");
		if ($linked == false) { // if there is no record of linked schools
				return false; // not verified, no school associations
			} else { // if we have schools they are enrolled in
				return true;
			}
}


// get a user's information
function getUser($userid) {
	$row = good_query_assoc("SELECT * FROM users WHERE id = '$userid' LIMIT 1");
	return $row;
} // end getUser


// get a list of users
function getUsers($userIDs) {
    $uidArray = explode(',', $userIDs);
    foreach($uidArray as $uid) {
        if (is_numeric($uid)) {
            $tot .= $uid . ', ';
        }
    }
    $rows = good_query_table("SELECT * FROM users WHERE id IN ($tot 0)");
    return $rows;
}
// end getUsers

// get a user's email addresses
function getUserEmails($userid) {
	$emails = array();
	$row = good_query_assoc("SELECT * FROM users WHERE id = '$userid' LIMIT 1");
	$emails[] = $row['e_mail'];
	$linkedEmails = good_query_table("SELECT * FROM school_users WHERE uid = '$userid'");
	foreach ($linkedEmails as $user) {
		if ($user['email'] != '') {
			$emails[] = $user['email'];
		}
	}
	
	return $emails;
} // end getUserEmails


// If login success, set session variables
function setSession($userid) {
	// retrieve user information
	$row = getUser($userid);
	// retrieve user's classes
	if ($row['level'] == 1) {
		$classes = getEnrolledClasses($row['id'], 2);
	} elseif ($row['level'] == 3) {
		$classes = getClasses($row['id'], 2);
	}
	
	$schools = getVerifiedSchools($userid);

                   if (!isset($_SESSION['session_key'])) {
                        setNodeSession($userid, session_id());
                   }
                   
	$_SESSION['session_key'] = session_id();
	
	// set session variables
	$_SESSION['user_id'] = $row['id'];
	$_SESSION['first_name'] = $row['first_name'];
	$_SESSION['last_name'] = $row['last_name'];
    $_SESSION['prof_icon'] = $row['prof_icon'];
	$_SESSION['level'] = $row['level'];
	$_SESSION['classes'] = $classes;
	$_SESSION['schools'] = $schools;
	$_SESSION['status'] = $row['verified'];
	
} // end setSession


// set node session
function setNodeSession($userID, $sessID) {
	good_query("INSERT INTO users_keys (session_key, uid, start_time) VALUES ('$sessID', '$userID', NOW() )");
}




// This function will get the user's theme
function setLocalPolicies($userID, $sid) {

    // set generic theme and settings
    		$localPol['id'] = 0;
    		$localPol['name'] = 'ClassConnect';
            $localPol['settingLogo'] = 'cc.png';
            $localPol['logoHeight'] = '30';
            $localPol['settingColor'] = '#f50b00';
            $localPol['userPolicies'] = '{
"teacher_communication":1,
"student_communication":1,
"auto_add":1,
"teach_list_type":1,
"teach_exception_list":"",
"stud_list_type":1,
"stud_exception_list":"7"
}';
            $localPol['classPolicies'] = '{
"auto_add":1,
"list_type":1,
"exception_list":""
}';

            
    if (isset($sid) && $sid != 0) {
        // check if we're an active member of this school
      if (checkSchoolLink($sid, $userID) == true) {
            foreach($_SESSION['schools'] as $school) {
                if ($school['id'] == $sid) {
                    $localPol = $school;
                }
            }
        }
        
    } else {
        if (isset($_SESSION['schools'][0])) {
            $localPol = $_SESSION['schools'][0];
        }
    }

    $_SESSION['theme'] = $localPol;
} // end checkClassOwner


// This function will detect is the user is logged in
function checkSession() {
	// detect if user_id session is set
	if (!isset($_SESSION['user_id'])) {
		// return null
		return false;
	} else {
		//return true
		return true;
	}
} // end checkSession


// check if they are logged in; if not, redirect
function requireSession($reqLev) {
	global $level;
	global $status;
	if (checkSession() == true) {
	// if this user is not verified, detect level
	if ($status == 1) {
			header('location:/app/signup.cc');
	
	// if the user is verified, send them home
	} elseif ($status == 2) {
		if (is_numeric($reqLev)) {
			if ($level != $reqLev) {
				header('location:/app/home.cc');
			}
		}
	}
	
	} else { // if there is a prev session detected
		header('location:/app/login.cc');
	}

} // end requireSession


// This function will kill a user's session
function killSession() {
	// detect if user_id session is set
	if (isset($_SESSION['user_id'])) {
		$sessionKey = session_id();
		
		$_SESSION = array();
		session_destroy();
		setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);
		
		good_query("DELETE FROM users_keys WHERE session_key = '$sessionKey' LIMIT 1");	
		}
} // end killSession


// reverse html stripping (use for embed codes, etc
function reverse_htmlentities($mixed)
{
    $htmltable = get_html_translation_table(HTML_ENTITIES);
    foreach($htmltable as $key => $value)
    {
        $mixed = ereg_replace(addslashes($value),$key,$mixed);
    }
    return $mixed;
}
// end reverse html entities


// get a school  from the session
function getSchoolSession($sid) {
    global $mySchools;
    foreach ($mySchools as $school) {
        if ($school['id'] == $sid) {
            return $school;
        }
    }
}
// end getSchoolSession





// get list of allowed contacts
function getFellows() {
    global $level;
    global $user_id;
    global $myClasses;
    global $mySchools;
    
    if ($level == 3) {


$str = '';
foreach($mySchools as $school) {
    $jArr = json_decode(reverse_htmlentities($school['userPolicies']), true);
    // only add class if the teach_comm setting is 1
    if ($jArr['teacher_communication'] == 1){
        $myUsers = good_query_table("SELECT * FROM users LEFT JOIN school_users ON users.id = school_users.uid WHERE school_users.sid = " . $school['id']);

    } elseif ($jArr['teacher_communication'] == 2){
    	$myUsers = good_query_table("SELECT * FROM users LEFT JOIN school_users ON users.id = school_users.uid WHERE (school_users.type = 3 OR school_users.type = 4) AND school_users.sid = " . $school['id']);

    } elseif ($jArr['teacher_communication'] == 3){
    	$myUsers = array();

    }


	foreach ($myUsers as $usr) {
    	$fillArray[$usr['id']] = $usr;

	}
}

// if this user doesn't have any schools
if (empty($mySchools) || empty($fillArray)) {
	foreach($myClasses as $class) {

          $str = $str . $class['id'] . ', ';


	}

	// load students in
	$myStudents = good_query_table("SELECT * FROM users LEFT JOIN class_students ON users.id = class_students.uid WHERE class_students.cid IN (" . $str . "0) AND class_students.uid != $user_id");
	foreach ($myStudents as $student) {
	    $fillArray[$student['id']] = $student;

	}
}


// load for students
} elseif ($level == 1) {


$str = '';
foreach($myClasses as $class) {
    $school =  getSchoolSession($class['sid']);
    $jArr = json_decode(reverse_htmlentities($school['userPolicies']), true);
    // only add class if the teach_comm setting is 1
    if ($jArr['student_communication'] == 1){
          $str = $str . $class['id'] . ', ';
          $tStr = $tStr . $class['id'] . ', ';
    } elseif ($jArr['student_communication'] == 2){
          $tStr = $tStr . $class['id'] . ', ';
    } else {
    	$str = $str . $class['id'] . ', ';
    	$tStr = $tStr . $class['id'] . ', ';
    }
}

// load students in
$myStudents = good_query_table("SELECT * FROM users LEFT JOIN class_students ON users.id = class_students.uid WHERE class_students.cid IN (" . $str . "0) AND class_students.uid != $user_id");

// load teachers in
$myTeachers = good_query_table("SELECT * FROM users LEFT JOIN class_teachers ON users.id = class_teachers.uid WHERE class_teachers.cid IN (" . $tStr . "0)");

foreach ($myStudents as $student) {
    $fillArray[$student['id']] = $student;

}

foreach ($myTeachers as $teacher) {
    $fillArray[$teacher['id']] = $teacher;

}


}
// end if

return $fillArray;

}
// end getFellows



// check if a certain application is allowed with the session policies
function checkAppPol($appID, $type) {
    global $theme;
    global $level;
    
    if ($type == 1) {
        // class policies
        $cP = json_decode(reverse_htmlentities($theme['classPolicies']), true);
        // ummm....not sure if this instance will ever happn. lets just return false for the time being
        return false;

        
    } elseif ($type == 2) {
        // decode user policies
        $uP = json_decode(reverse_htmlentities($theme['userPolicies']), true);

        if ($level == 1) {
            $list_type = $uP['stud_list_type'];
            $exceptions = $uP['stud_exception_list'];
        } elseif ($level == 3) {
            $list_type = $uP['teach_list_type'];
            $exceptions = $uP['teach_exception_list'];
        }
        // load app array
        $appArr = explode(',', $exceptions);

        if ($list_type == 1) {
            if (!in_array($appID, $appArr)) {
                return true;
            } else {
                return false;
            }
        } elseif ($list_type == 2) {
             if (in_array($appID, $appArr)) {
                return true;
            } else {
                return false;
            }
        }

    }
    
}
// end checkAppPol


// get data via vanity URL
function getVanityScheme() {
    // check for subdomain
    $domainarray = explode('.', $_SERVER['HTTP_HOST']);
$index=count($domainarray)-1;
$domainname= $domainarray[$index-1].".".$domainarray[$index];
$subdomainname="";
for($i=0;$i<$index-1;$i++)
{
if($subdomainname=="")
{
$subdomainname=$domainarray[$i];
}
else
{
$subdomainname=$subdomainname.".".$domainarray[$i];
}

}
// end magical check subdomain code

    $testURL = good_query_assoc("SELECT * FROM schools WHERE settingDomain = '$subdomainname' LIMIT 1");

    if ($testURL == false) {
        $temp['swap'] = 1;
        $temp['name'] = 'ClassConnect';
        $temp['settingLogo'] = 'core/site_img/logo.png';
        $temp['settingColor'] = '#af0101';
        return $temp;
    } else {
        return $testURL;
    }
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END non-user specific functions (login, etc)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
















/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// User generic functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


// update a user's data
function updateUser($userID, $prof, $number, $nstatus, $email, $estatus) {
    $prof = escape($prof);
    $number = escape($number);
    $nstatus = escape($nstatus);
    $email = escape($email);
    $estatus = escape($estatus);

    if ( filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
			$errors[] = 'Email address not valid.';
		} else {
			$checkMail = good_query_assoc("SELECT * FROM users WHERE e_mail = '$email' AND id != '$userID'  LIMIT 1");
			if ($checkMail != false) {
				$errors[] = 'This email address has already been used.';
			}
		} // valid email else

    if (empty($errors)) {
    good_query("UPDATE users SET e_mail = '$email', email_active = '$estatus', cell = '$number', cell_active = '$nstatus', prof_icon = '$prof' WHERE id = $userID");
    return 1;
    } else {
        return $errors;
    }
}
// end updateUser


// get user & reset password
function resetPassStream($email) {
    $email = escape($email);
    $user = good_query_assoc("SELECT * FROM users LEFT JOIN school_users ON school_users.uid = users.id WHERE (users.e_mail = '$email' OR school_users.email='$email') LIMIT 1");
    if ($user != false) {
        $chash = substr(SHA1($email . date('m/d/Y/i/s') . 'cc4'),0,7);
        setPassword($user['id'], $chash);
        sendPasswordEmail($user['id'], $chash);
        return true;
    } else {
        return false;
    }

}


// Reset password function
function setPassword($userID, $password) {
	$enc_pass  = SHA1($password);
	good_query("UPDATE users SET pass = '$enc_pass' WHERE id = $userID");
}
// end resetPassword function


// Reset password function
function sendPasswordEmail($userID, $password) {
	$user = getUser($userID);
	$body = "Hello " . $user['first_name'] . ",\n
Your ClassConnect password has been reset. You can now login using your email/username and new password listed below.\n\n
	
Your new password: $password \n
Your username: " . $user['user_name'] . "\n\n

Login using your email/username and password at http://www.classconnect.com. If you encounter any problems, feel free to reply to this email and we'll assist you in any way possible!\n\n
	
Sincerely,\n
The ClassConnect Support Team";
	$emails = getUserEmails($userID);
	
	foreach ($emails as $address) {
		mail($address, 'ClassConnect Account Password Reset', $body, "From: support@classconnect.com");
	}

}
// end resetPassword function










// send notification function
function sendNotification($appID, $userIDs, $content) {
	$usersData = getUsers($userIDs);
                   foreach ($usersData as $user) {
                       if ($user['email_active'] == 1) {
                           // send email
                           $message = "Hello " . $user['first_name'] . ",\n
                               You have received a new notification on ClassConnect.\n\n\" " . $content . "\n\nClassConnect Support Team";
                           mail($user['e_mail'], "New ClassConnect Notification", $message, "From: support@classconnect.com");
                       }
                   }
	$uidArray = explode(',', $userIDs);
	foreach ($uidArray as $userID) {
		if (is_numeric($userID)) {
			$cleanContent = escape($content);
			good_query("INSERT INTO notifications (user_id, appID, content, sent_at) VALUES ('$userID', '$appID', '$cleanContent', NOW() )");
			$sessions = getSessions($userID);
			foreach ($sessions as $session) {
				// send nodeJS notification
				$contentVar = str_replace('"', '_dq_', $content);
				sendNodeification(1, $appID, $session['session_key'], $contentVar);
			}
			
		}
	}
	
	
}
// end sendNotification function



// send notification to entire class
function sendClassNotification($classID, $data) {
	// get all students in this class
		$students = getClassStudents($classID, 1);
	
		// loop through students array
		foreach ($students as $student) {
			$userIDs = $userIDs . $student['id'] . ',';
		}
		// send notification
		sendNotification(1, $userIDs, $data);
	
	
}
// end



// send notification to entire class
function blastNodeification($userIDs, $type, $appID, $data) {
$userArr = explode(',', $userIDs);
 foreach ($userArr as $userID) {
        $sessions = getSessions($userID);
        foreach ($sessions as $session) {
            //// send nodeJS notification
            sendNodeification($type, $appID, $session['session_key'], $data);
            }
    }

}
// end



// send notification to entire school
function sendSchoolNotification($schoolID, $data) {
	// get all students in this class
		$students = getSchoolUsers($schoolID);
	
		// loop through students array
		foreach ($students as $student) {
			$userIDs = $userIDs . $student['id'] . ',';
		}
		// send notification
		sendNotification(1, $userIDs, $data);
	
	
}
// end



// get active sessions
function getSessions($userID) {
	$sessionArray = good_query_table("SELECT * FROM users_keys WHERE uid = '$userID'");
	return $sessionArray;
}
// end getSessions




// send nodeJS notification to channel
function sendNodeification($type, $appID, $channelID, $data) {
	global $nodeServer;
	// hit node server
	$nodeURL = $nodeServer . '?type=' . urlencode($type) . '&appID=' . urlencode($appID) . '&channel=' . urlencode($channelID) . '&data=' . urlencode($data);
	file_get_contents($nodeURL);
}
// end sendNodeification



// get number of unread notifications
function getNumNotifications($userID) {
	$totalUnread = good_query_table("SELECT * FROM notifications WHERE user_id = '$userID' AND viewed = '1'");
	return count($totalUnread);
}
// end num notifications



// get number of unread msgs
function getNumMsgs($userID) {
	$totalUnread = good_query_table("SELECT * FROM msgs_rec WHERE recipient_id = '$userID' AND status = '2'");
	return count($totalUnread);
}
// end num msgs



// get notifications
function getNotifications($userID, $limit) {
	$total= good_query_table("SELECT * FROM notifications WHERE user_id = '$userID' ORDER BY `sent_at` DESC LIMIT $limit");
	return $total;
}
// end num notifications




// get notifications
function clearNotifications($userID) {
	$total= good_query("UPDATE notifications SET viewed = '2' WHERE user_id = '$userID' AND viewed = '1'");
}
// end num notifications



// get number of open livelecturs
function getNumLLs($userID, $classes) {
    if ($classes == 0) {
        $userData = getUser($userID);
        if ($userData['level'] == 1) {
              $classes = getEnrolledClasses($userData['id'], 2);
        } elseif ($userData['level'] == 3) {
            $classes = getClasses($userData['id'], 2);
        }
    }

    foreach ($classes as $class) {
        $str .= $class['id'] . ', ';
    }

    $totalUnread = good_query_table("SELECT * FROM livelec_cache WHERE active = '1' AND classID IN ($str 0)");
    return count($totalUnread);
}
// end num msgs



// get open livelecturs
function getOpenLLs($userID, $classes) {
    if ($classes == 0) {
        $userData = getUser($userID);
        if ($userData['level'] == 1) {
              $classes = getEnrolledClasses($userData['id'], 2);
        } elseif ($userData['level'] == 3) {
            $classes = getClasses($userData['id'], 2);
        }
    }

    foreach ($classes as $class) {
        $str .= $class['id'] . ', ';
    }

    $totalUnread = good_query_table("SELECT * FROM livelec_cache WHERE active = '1' AND classID IN ($str 0)");
    return $totalUnread;
}
// end num msgs



// get today's agenda
function todayAgenda($userID, $classes, $timestamp) {
    // if no class session data, get the user's classes from DB
    if ($classes == 0) {
        $userData = getUser($userID);
        if ($userData['level'] == 1) {
              $classes = getEnrolledClasses($userData['id'], 2);
        } elseif ($userData['level'] == 3) {
            $classes = getClasses($userData['id'], 2);
        }
    }

    foreach ($classes as $class) {
        $str .= $class['id'] . ', ';
    }

    if (isset($timestamp)) {
        $todayDate = date("Y-m-d", $timestamp);
    } else {
        $todayDate = date("Y-m-d");
    }
    $finalData = good_query_table("SELECT * FROM calendar_entries WHERE client_type = 1 AND class_id IN ($str 0) AND  (start_date <=  '$todayDate' AND end_date >= '$todayDate')");

    return $finalData;

    
}
// end todayAgenda



// get week's agenda
function weekAgenda($userID, $classes) {
    // if no class session data, get the user's classes from DB
    if ($classes == 0) {
        $userData = getUser($userID);
        if ($userData['level'] == 1) {
              $classes = getEnrolledClasses($userData['id'], 2);
        } elseif ($userData['level'] == 3) {
            $classes = getClasses($userData['id'], 2);
        }
    }

    foreach ($classes as $class) {
        $str .= $class['id'] . ', ';
    }

    $finalData = good_query_table("SELECT * FROM calendar_entries WHERE client_type = 1 AND (type = 2 OR type = 3) AND class_id IN ($str 0) AND ((`end_date` BETWEEN NOW() AND NOW() + INTERVAL 7 DAY) OR (`start_date` BETWEEN NOW() AND NOW() + INTERVAL 7 DAY))");

    return $finalData;


}
// end weekAgenda


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END user generic functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
























/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// STUDENT specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This function will redirect the user if they are not a student
function checkStudent() {
	if ($level != 1) {
		return false;
	} else {
		return true;
	}
} // end checkStudent


// This function will retrieve the classes a student is enrolled in
function getEnrolledClasses($studentid, $type) {
	if ($type == 1) {
		// if type is in past
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.end_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_students ON classes.id = class_students.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_students.uid = $studentid AND ((grading_periods.end < '" . date('Y-m-d') . "') OR classes.status = 2) ORDER BY grading_periods.start ASC");
	} elseif ($type == 2) {
		// select current classes
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_students ON classes.id = class_students.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_students.uid = $studentid AND classes.status = 1 AND ((grading_periods.start <= '" . date('Y-m-d') . "' AND grading_periods.end >= '" . date('Y-m-d') . "') OR classes.gp = 0) ORDER BY grading_periods.start, classes.name ASC");
	} elseif ($type == 3) {
		//if type == future
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_students ON classes.id = class_students.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_students.uid = $studentid AND classes.status = 1 AND (grading_periods.start > '" . date('Y-m-d') . "') ORDER BY grading_periods.start ASC");
	}
	return $myClasses;
} // end getEnrolledClasses


// This function will check if a student is enrolled in a class
function checkEnrollment($classid) {
	global $myClasses;
	$bool = false;
	foreach($myClasses as $class) {
		if ($class['id'] == $classid) {
			$bool = true;
		} // if
	} // foreach loop
	return $bool;
} // end checkEnrollment

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END student specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////












/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This function will validate a class code
function checkCode($key) {
	$codeCheck = good_query_assoc("SELECT * FROM classes WHERE classKey = '$key'");
	return $codeCheck;
} // end checkCode


// enroll student in a class
function enrollStudent($uid, $cid) {
	// see if they are either enrolled or banned from this class
	$check = good_query_assoc("SELECT * FROM class_students WHERE uid = '$uid' AND cid = '$cid'");
	if ($check != false) {
		return false;
	}
	// insert into class
	$classes = good_query("INSERT INTO class_students (uid, cid, reg_date) VALUES ('$uid', '$cid', NOW() )");
	return true;

} // end enrollStudent


// delete student's enrollment
function deleteEnrollment($uid, $cid) {
	good_query("DELETE FROM class_students WHERE uid = '$uid' AND cid = '$cid' LIMIT 1");
	
}
// end delete enrollment

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END class specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////











/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// TEACHER specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This function will redirect the user if they are not a teacher
function checkTeacher() {
	if ($level != 3) {
		return false;
	} else {
		return true;
	}
} // end checkTeacher


// This function will retrieve the classes a teacher owns
function getClasses($teacherid, $type) {
	if ($type == 1) {
		// if type is in past
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.end_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_teachers ON classes.id = class_teachers.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_teachers.uid = $teacherid AND ((grading_periods.end < '" . date('Y-m-d') . "') OR classes.status = 2) ORDER BY grading_periods.start ASC");
	} elseif ($type == 2) {
		// select current classes
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_teachers ON classes.id = class_teachers.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_teachers.uid = $teacherid AND classes.status = 1 AND ((grading_periods.start <= '" . date('Y-m-d') . "' AND grading_periods.end >= '" . date('Y-m-d') . "') OR classes.gp = 0) ORDER BY grading_periods.start, classes.name ASC");
	} elseif ($type == 3) {
		//if type == future
		$myClasses = good_query_table("SELECT classes.name, classes.id, classes.prof_icon, classes.sid, classes.reg_date, classes.gp, classes.status, grading_periods.start, grading_periods.end FROM classes LEFT JOIN class_teachers ON classes.id = class_teachers.cid LEFT JOIN grading_periods ON classes.gp = grading_periods.id WHERE class_teachers.uid = $teacherid AND classes.status = 1 AND (grading_periods.start > '" . date('Y-m-d') . "') ORDER BY grading_periods.start ASC");
	}
	return $myClasses;
} // end getClasses


// This function will check if a teacher owns this class
function checkClassOwner($classid) {
	global $user_id;
	global $myClasses;
    global $level;
	$bool = false;
	foreach($myClasses as $class) {
		if ($class['id'] == $classid) {
			$bool = true;
		} // if
	} // foreach loop
	
	// if it's false, lets check for non-current classes
	if ($bool == false) {
		$test = good_query_assoc("SELECT * FROM class_teachers WHERE uid = '$user_id' AND cid = '$classid' LIMIT 1");
		if ($test == true) {
			$bool = true;
		}
	}

    if ($level != 3) {
        $bool = false;
    }
	
	return $bool;
} // end checkClassOwner

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END teacher specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////












/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SCHOOL specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// get an schools's information
function getSchool($schoolID) {
	$row = good_query_assoc("SELECT * FROM schools WHERE id = '$schoolID' LIMIT 1");
	return $row;
} // end getApp


// This function will retrieve the schools a user is enrolled in
function getSchools($userID, $type) {
	$mySchools = good_query_table("SELECT * FROM schools LEFT JOIN school_users ON schools.id = school_users.sid WHERE school_users.uid = $userID ORDER BY school_users.reg_date DESC");
	return $mySchools;
} // end getEnrolledClasses


// This function will retrieve the schools a verified user is enrolled in
function getVerifiedSchools($userID) {
	$mySchools = good_query_table("SELECT * FROM schools LEFT JOIN school_users ON schools.id = school_users.sid WHERE school_users.uid = $userID AND school_users.verified = 2 ORDER BY school_users.reg_date DESC");
	return $mySchools;
} // end getVerifiedSchools


// This function will check if a user is linked to a school
function checkSchoolLink($schoolID, $userID, $sessOn) {
	global $mySchools;
	global $user_id;

                  if (isset($userID)) {
                      $user_id = $userID;
                  }
                  
	$bool = false;
	foreach($mySchools as $school) {
		if ($school['id'] == $schoolID) {
			$bool = true;
		} // if
	} // foreach loop
	if ($bool == false) {
		$findSchool = good_query_assoc("SELECT * FROM school_users WHERE uid = $user_id AND sid = $schoolID LIMIT 1");
		if ($findSchool != false) {
			$bool = true;
		}
		
	}
	
	return $bool;
} // end checkSchoolLink


// This function will check if a user is the admin of a school
function checkSchoolAdmin($sid, $userID) {
	global $mySchools;
	$bool = false;
	foreach($mySchools as $school) {
		if ($school['id'] == $sid) {

				// if teacher level is 4
				if ($school['type'] == 4) {
					$bool = true;
				}
			

		} // if
	} // foreach loop
        if (empty($mySchools)) {
            $tempSchool = getSchool($sid);
            if ($tempSchool['subscription'] == 0) {
                $type = 3;
            } else {
                $type = 4;
            }
            $findSchool = good_query_assoc("SELECT * FROM school_users WHERE uid = $userID AND sid = $sid AND type = $type LIMIT 1");
            if ($findSchool != false) {
                $bool = true;
            } else {
                $bool = false;
            }
        }
	return $bool;
} // end checkSchoolLink


// This function creates grading periods
function createGP($sid, $name, $start, $end) {
	$errors = array();
	// check for first name
	if ($sid != '') {
		$sid = escape($sid);
	} else {
		$errors[] = 'No school ID given.';
	}
	
	// check for first name
	if ($name != '') {
		$name = escape($name);
	} else {
		$errors[] = 'No name was entered.';
	}
	
	// check for start
	if ($start != '' && strlen($start) > 1) {
		$start_date = escape($start);
	}
	
	// check for end
	if (isset($start_date)) {
		if ($end != '' && strlen($end) > 1) {
			if ($end > $start) {
				$end_date = escape($end);
			} else {
				$errors[] = 'End date must be after the start date.';
			}
		} else {
			$errors[] = 'No end date was entered.';
		}
		}
		
	if (empty($errors)) {
		
		if (!isset($end_date)) {
			$start_date = '01/01/2001';
			$end_date = '01/01/2013';
		}
		
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		
		
		good_query("INSERT INTO grading_periods (name, start, end, sid, reg_date) VALUES ('$name', '$start_date', '$end_date', '$sid', NOW() )");
		return 1;
	} else {
		return $errors;
	}
	
}
// end createGP function


// This function creates grading periods
function updateGP($gpid, $sid, $name, $start, $end) {
	$errors = array();
	// check for first name
	if ($sid != '') {
		$sid = escape($sid);
	} else {
		$errors[] = 'No school ID given.';
	}
	
	// check for first name
	if ($name != '') {
		$name = escape($name);
	} else {
		$errors[] = 'No name was entered.';
	}
	
	// check for start
	if ($start != '' && strlen($start) > 1) {
		$start_date = escape($start);
	}
	
	// check for end
	if (isset($start_date)) {
		if ($end != '' && strlen($end) > 1) {
			if ($end > $start) {
				$end_date = escape($end);
			} else {
				$errors[] = 'End date must be after the start date.';
			}
		} else {
			$errors[] = 'No end date was entered.';
		}
		}
		
	if (empty($errors)) {
		
		if (!isset($end_date)) {
			$start_date = '01/01/2001';
			$end_date = '01/01/2013';
		}
		
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		
		good_query("UPDATE grading_periods SET name='$name', start='$start_date', end='$end_date' WHERE sid = $sid AND id = $gpid");
		return 1;
	} else {
		return $errors;
	}
	
}
// end createGP function


// This function will retrieve the grading periods for a school
function getGPs($sid, $type) {
	if ($type == 1) {
		$append = "end < '" . date('Y-m-d') . "'";
	} elseif ($type == 2) {
		$append = "start <= '" . date('Y-m-d') . "' AND end >= '" . date('Y-m-d') . "'";
	} elseif ($type == 3) {
		$append = "start > '" . date('Y-m-d') . "'";
	}
	
	$gps = good_query_table("SELECT * FROM grading_periods WHERE sid = $sid AND $append ORDER BY `start` ASC");
	return $gps;
} // end getGps


// This function will retrieve a grading period
function getGP($gpid) {
	$gps = good_query_assoc("SELECT * FROM grading_periods WHERE id = $gpid LIMIT 1");
	return $gps;
} // end getGps


// this function makes our dates uniform
function formatGP($str) {
	$ret = date('m/d/Y', strtotime($str));
	return $ret;
}
//end formatGP


// create class function
function createClass($name, $body, $sid, $gp, $userID) {
	global $dbc;
	$errors = array();
	
	if (checkSchoolLink($sid) != true && $sid != 0) {
		$errors[] = 'Not valid school.';
	}
	
	// check for first name
	if ($sid != '') {
		$sid = escape($sid);
	} else {
		$sid = 0;
	}
	
	// check for first name
	if ($name != '') {
		$name = escape($name);
	} else {
		$errors[] = 'No class name was entered.';
	}
	
	$body = escape($body);
	
	// check for first name
	if ($gp != '') {
		$gp = escape($gp);
	} else {
		$gp = 0;
	}
		
	if (empty($errors)) {
		$chash = genChash($name, $sid);
		$insertClass = @mysqli_query($dbc, "INSERT INTO classes (name, description, classKey, sid, gp, reg_date) VALUES ('$name', '$body', '$chash', '$sid', '$gp',  NOW() )");
		if (is_numeric($userID)) {
			$cid = $dbc->insert_id;
			addClassTeacher($userID, $cid, 2);
		}
		return 1;
	} else {
		return $errors;
	}
}
// end add class function


// update class function
function updateClass($uid, $cid, $name, $body, $code, $icon) {
	$errors = array();
	// check for class name
	if ($name != '') {
		$name = escape($name);
	} else {
		$errors[] = 'No class name was entered.';
	}
	
	$body = escape($body);
	$code = escape($code);
	
	// if empty errors, insert into db
	if (empty($errors)) {
		good_query("UPDATE classes SET name = '$name', description = '$body', classKey='$code', prof_icon='$icon' WHERE id = $cid LIMIT 1");
		return 1;
	}
	
	return $errors;
	
}
// end updateClass


// generate clas hash function
function genChash($name, $sid) {
	$chash = substr(SHA1($name . date('m/d/Y/i/s') . $sid . rand(1, 9999)),0,10);
	return $chash;
}
// end genChash function


// end class function
function endClass($cid) {
	good_query("UPDATE classes SET status = '2', end_date = NOW() WHERE id = $cid");
}
// end endClass function


// restart  class function
function restartClass($cid) {
	good_query("UPDATE classes SET status = '1' WHERE id = $cid");
}
// restart class function


// getClass function
function getClass($cid) {
	$class = good_query_assoc("SELECT * FROM classes WHERE id = $cid LIMIT 1");
	return $class;
}
// end getClass function


// getClassSession function
function getClassSession($cid) {
	global $myClasses;
	foreach ($myClasses as $classer) {
		if ($classer['id'] == $cid) {
			return $classer;
		}
	}

	return false;
}
// end getClass function


// addClassTeacher function
function addClassTeacher($uid, $cid, $master) {
	if ($master != 2) {
		$master = 1;
	}
	good_query("INSERT INTO class_teachers (uid, cid, master, reg_date) VALUES ('$uid', '$cid', '$master',  NOW() )");
	
}
//end addClassTeacher function


// auth class function
function authClass($class_id) {
	global $level;
	// if they're a teacher
	if ($level == 3) {
		// verify this teacher owns this class
		if (checkClassOwner($class_id) == true) {
			return 3;
		} else {
			// no enrollment or ownership
			return false;
		}
	
	// if they're a student
	} elseif ($level == 1) {
		if (checkEnrollment($class_id) == true) {
			return 1;
		} else {
		// no enrollment or ownership
		return false;
	}
	
	
	}

}
// end auth class



// get students in class
function getClassStudents($classID, $status) {
	$list = good_query_table("SELECT * FROM class_students LEFT JOIN users ON users.id = class_students.uid WHERE cid = $classID AND status = $status");
	return $list;
}
// end getClassStudents


// get teachers in class
function getClassTeachers($classID) {
	$list = good_query_table("SELECT * FROM class_teachers LEFT JOIN users ON users.id = class_teachers.uid WHERE cid = $classID");
	return $list;
}
// end getClassTeachers


// authorize student
function authClassStudent($classID, $uid) {
	$list = good_query_assoc("SELECT * FROM class_students LEFT JOIN users ON users.id = class_students.uid WHERE cid = $classID AND uid = $uid LIMIT 1");
	return $list;
}
// end getClassStudents


// get students in class
function getSchoolUsers($schoolID) {
	$list = good_query_table("SELECT users.first_name, users.last_name, users.id, school_users.email FROM users LEFT JOIN school_users ON users.id = school_users.uid WHERE school_users.sid = $schoolID AND school_users.verified = 2");
	return $list;
}
// end getClassStudents


// package a school's class policies
function updateCPol($sid, $autoAdd, $listType, $exceptions) {
    $jStr = '{
"auto_add":' . $autoAdd . ',
"list_type":' . $listType . ',
"exception_list":"' . addslashes($exceptions) . '"
}';
    $update = good_query("UPDATE schools SET classPolicies = '$jStr'  WHERE id = $sid LIMIT 1");
}
// end updateCPol


// package a school's user policies
function updateUPol($sid, $teachComm, $stuComm, $autoAdd, $teachListType, $teachExceptions, $studListType, $studExceptions) {
    $jStr = '{
"teacher_communication":' . $teachComm . ',
"student_communication":' . $stuComm . ',
"auto_add":' . $autoAdd . ',
"teach_list_type":' . $teachListType . ',
"teach_exception_list":"' . addslashes($teachExceptions) . '",
"stud_list_type":' . $studListType . ',
"stud_exception_list":"' . addslashes($studExceptions) . '"
}';
   $update = good_query("UPDATE schools SET userPolicies = '$jStr'  WHERE id = $sid LIMIT 1");
}
// end updateUPol


// get list of possible applications for a school
function getSchoolApps($schoolID, $type) {
    $type = escape($type);
    
    if ($type==1) {
        $q = 'isClass = 1';
    } elseif ($type == 2) {
        $q = 'isUser = 1';
    }

    $list = good_query_table("SELECT * FROM applications WHERE $q AND public = 2");
    return $list;
}
// end getSchoolApps


// get an array of apps separated by commas
function getClassApps($list_type, $csv) {
    $csv = explode(',', escape($csv));

    if ($list_type == 1) {
        $clause = "NOT IN";
    } elseif ($list_type == 2) {
        $clause = "IN";
        $tot = '1, ';
    }

    foreach ($csv as $num) {
        if (is_numeric($num)) {
            $tot .= $num . ', ';
        }
    }

    if ($tot == ', ') {
        $tot = '';
    }

    $list = good_query_table("SELECT * FROM applications WHERE id $clause (" . $tot . "0) AND type = 1 AND public = 2");
    return $list;
}
// end getSchoolApps


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END school specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////












/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// APPLICATION specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// get an application's information
function getApp($appID) {
	$row = good_query_assoc("SELECT * FROM applications WHERE id = '$appID' LIMIT 1");
	return $row;
} // end getApp






// authorize session
function authSession($sessionID) {
	$data = good_query_assoc("SELECT * FROM users_keys WHERE session_key = '$sessionID' LIMIT 1");
	return $data;
}
// end authSession





// check class relation via API
function authClassRelationship($userID, $classID) {
	// check if they're a teacher
	$test = good_query_assoc("SELECT * FROM class_teachers WHERE uid = '$userID' AND cid = '$classID' LIMIT 1");
	if ($test == true) {
		return 3;
	}
	
	// if they're a student
	$test2 = good_query_assoc("SELECT * FROM class_students WHERE uid = '$userID' AND cid = '$classID' LIMIT 1");
	if ($test2 == true) {
		return 1;
	}
	
	
	return false;
	
}
// end end authClassRelationship





// get latest files
function getRecentFiles($user_id, $file_type, $count) {
    $array = good_query_table("SELECT * FROM filebox_content WHERE uid = $user_id AND format = $file_type ORDER BY `time_date` DESC LIMIT $count");
    return $array;
}
// getRecentFiles

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// END application specific functions
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>