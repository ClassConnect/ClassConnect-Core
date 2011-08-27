<?php
// core includes
require_once('../core/inc/coreInc.php');

$cleanClass = array();
foreach ($myClasses as $cclass) {
	$temp = array();
	$temp['id'] = $cclass['id'];
	$temp['name'] = $cclass['name'];
	$temp['icon'] = $iconServer . $cclass['prof_icon'];
	$cleanClass[] = $temp;
}
echo json_encode($cleanClass);

?>