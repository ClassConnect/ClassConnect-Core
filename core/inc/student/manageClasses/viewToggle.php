<?php
if ($_GET['v'] == 1) {
	$listClasses = getEnrolledClasses($user_id, 1);
	foreach ($listClasses as $classEl) {
	if ($classEl['gp'] != 0) {
		$fill = '<span style="font-size:14px; color: #999">' . date('m/d/Y', strtotime($classEl['start'])) . ' - ' . date('m/d/Y', strtotime($classEl['end'])) . '</span>';
	} else {
		$fill = '<span style="font-size:14px; color: #999">Active since ' . date('m/d/Y', strtotime($classEl['reg_date'])) . '</span>';
	}
	echo '<div style="height:50px; border-bottom: 1px solid #ccc; margin-top:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder">' . $classEl['name'] . '</span><br />
' . $fill . '
</div>


</div>';
}

if (empty($listClasses)) {
    echo '<div style="font-size:16px; color: #666;text-align:center;margin-top:20px">You have no past classes.</div>';
}



// if we want to view the future...
} elseif ($_GET['v'] == 2) {
	$listClasses = getEnrolledClasses($user_id, 2);
	foreach ($listClasses as $classEl) {
	if ($classEl['gp'] != 0) {
		$fill = '<span style="font-size:14px; color: #999">' . date('m/d/Y', strtotime($classEl['start'])) . ' - ' . date('m/d/Y', strtotime($classEl['end'])) . '</span>';
	} else {
		$fill = '<span style="font-size:14px; color: #999">Active since ' . date('m/d/Y', strtotime($classEl['reg_date'])) . '</span>';
	}
	echo '<div style="height:50px; border-bottom: 1px solid #ccc; margin-top:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder"><a href="class.cc?id=' . $classEl['id'] . '">' . $classEl['name'] . '</a></span><br />
' . $fill . '
</div>


</div>';
}

if (empty($listClasses)) {
    echo '<div style="font-size:16px; color: #666;text-align:center;margin-top:20px">You have no current classes.</div>';
}

} elseif ($_GET['v'] == 3) {
    	$listClasses = getEnrolledClasses($user_id, 3);
	foreach ($listClasses as $classEl) {
	if ($classEl['gp'] != 0) {
		$fill = '<span style="font-size:14px; color: #999">' . date('m/d/Y', strtotime($classEl['start'])) . ' - ' . date('m/d/Y', strtotime($classEl['end'])) . '</span>';
	} else {
		$fill = '<span style="font-size:14px; color: #999">Active since ' . date('m/d/Y', strtotime($classEl['reg_date'])) . '</span>';
	}
	echo '<div style="height:50px; border-bottom: 1px solid #ccc; margin-top:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder"><a href="class.cc?id=' . $classEl['id'] . '">' . $classEl['name'] . '</a></span><br />
' . $fill . '
</div>


</div>';
}

if (empty($listClasses)) {
    echo '<div style="font-size:16px; color: #666;text-align:center;margin-top:20px">You have no future classes.</div>';
}
} elseif ($_GET['v'] == 4) {
    $listSchools = getSchools($user_id);

// if no schools are found
if (empty($listSchools)) {
	echo '<div style="height:50px; border-bottom: 1px solid #ccc; margin-top:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder">Unable to find any schools.</span><br />
</div>


</div>';
}

foreach ($listSchools as $schoolEl) {
	if ($schoolEl['verified'] == 2) {
		$temp = '<span style="font-size:14px; color: #999"><img src="' . $imgServer . 'gen/tick.png" /> Active since ' . date('m/d/Y', strtotime($schoolEl['reg_date'])) . '</span>';
	} elseif ($schoolEl['verified'] == 3) {
		$temp = '<span style="font-size:14px; color: #999"><img src="' . $imgServer . 'gen/cross.png" /> Joined ' . date('m/d/Y', strtotime($schoolEl['reg_date'])) . '. No longer active.</span>';
	} elseif ($schoolEl['verified'] == 1) {
		$temp = '<span style="font-size:14px; color: #999"><img src="' . $imgServer . 'gen/cross.png" /> Joined ' . date('m/d/Y', strtotime($schoolEl['reg_date'])) . '. Not yet verified.</span>';
	}

	// type
	if ($schoolEl['type'] == 3) {
		$userType = 'Teacher';
	} elseif ($schoolEl['type'] == 4) {
		$userType = 'Administrator';
	}

	echo '<div style="height:50px; border-bottom: 1px solid #ccc; margin-top:5px">

<div style="float:left">
<span style="font-size:16px; font-weight:bolder"><a href="school.cc?id=' . $schoolEl['id'] . '">' . $schoolEl['name'] . '</a></span><br />
' . $temp . '
</div>

<div style="font-size:16px; float:right; text-align:right">
<strong>' . $userType . '</strong><br />
' . $schoolEl['email'] . '
</div>

</div>';
}
}


?>