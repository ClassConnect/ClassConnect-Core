<?php
///////// WELCOME to openSearch. providing search results since 2011
// (C) 2011 ClassConnect Fucking Technologies. Eric Simons.

// load our typical bullshit
require_once('core/inc/coreInc.php');

// i just feel like cussing in all the comments...its been a long day. sorry. fuck you.
if(isset($_GET['node'])) {
	// clean that bitch and set it as a variable 
	$node = escape($_GET['node']);
}


///////// BEGIN page node detection. fuck you.


if($node == 1) {
// check if there is a post
if(!empty($_GET['q'])) {
    $q = escape($_GET['q']);
    $results = good_query_table("SELECT * FROM schools WHERE name LIKE '%$q%' OR city LIKE '%$q%' OR zip LIKE '%$q%' AND status != '1' LIMIT 5");
    foreach($results as $result){
        $final[] = array(
        	 'id'=>$result['id'],
          'name'=>$result['name'],
          'city'=>$result['city'],
          'state'=>$result['state'],
          'zip'=>$result['zip'],
          'country'=>$result['country']
        );
    }

    //using JSON to encode the array
    echo json_encode($final);
}

} elseif($node == 2) {

// check if there is a post
if(!empty($_GET['q']) || !empty($_GET['school'])) {
    $q = escape($_GET['usersearch']);
    $sid = escape($_GET['school']);
    $userTypes = array();
    // load our optons...
    if (!empty($_GET['students'])) {
    	$userTypes[] = 1;
    }
    	
    
    // check teachers
    if (!empty($_GET['teachers'])) {
    	$userTypes[] = 3;
    }
    
    // check admins
    if (!empty($_GET['administrators'])) {
    	$userTypes[] = 4;
    }    
    
    // check verified
    if (!empty($_GET['verified'])) {
    	$ver = 2;
    } else {
    	$ver = 1;
    }
    
    $typeOr = '';
    // generate or query
    foreach ($userTypes as $type) {
    	$typeOr .= 'school_users.type = ' . $type . ' OR ';
    }
    
    if ($typeOr != '') {
    	$placer = '(' . substr($typeOr, 0, strlen($typeOr) - 4) . ') AND';
    }
    
    
    // check if this faggot is part of the school. if not, HI SCHOOLOGY. NICE TRY YOU FAGGOT SHITS.
if (checkSchoolLink($sid) == true) {
	$school = getSchool($sid);
} else {
	echo "Critical Error";
	exit();
}
	
    $results = good_query_table("SELECT users.first_name, users.last_name, users.id, school_users.email FROM users LEFT JOIN school_users ON users.id = school_users.uid WHERE school_users.sid = $sid AND $placer school_users.verified = $ver AND (users.first_name LIKE '%$q%' OR users.last_name LIKE '%$q%' OR school_users.email LIKE '%$q%') LIMIT 20");
    foreach($results as $result){
        $final[] = array(
        	 'id'=>$result['id'],
          'first_name'=>$result['first_name'],
          'last_name'=>$result['last_name'],
          'school_email'=>$result['email'],
        );
    }

    //using JSON to encode the array
    echo json_encode($final);
}
	
}
?>