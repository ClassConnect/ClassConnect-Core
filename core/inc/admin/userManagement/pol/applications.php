<?php
// conv our school policies from JSON
$jArr = json_decode(reverse_htmlentities($school['userPolicies']), true);

// did the user just update?
if (isset($_POST['submitted'])) {
    $autoAdd = escape($_POST['auto_add']);
    $studApps = $_POST['studapps'];
    $teachApps = $_POST['teachapps'];
    $studList = escape($_POST['studlist']);
    $teachList = escape($_POST['teachlist']);

    foreach ($teachApps as $app) {
        $teachExc .= $app . ',';
    }
    $teachExc = substr($teachExc, 0, strlen($teachExc) - 1);

     foreach ($studApps as $apper) {
        $studExc .= $apper . ',';
    }
    $studExc = substr($studExc, 0, strlen($studExc) - 1);
    updateUPol($school['id'], $jArr['teacher_communication'], $jArr['student_communication'], $autoAdd, $teachList, $teachExc, $studList, $studExc);
    setSession($user_id);
    setLocalPolicies($user_id, $school['id']);

    echo '1';
    
    exit();

}

// get our list of applications
 $apps = getSchoolApps($school['id'], 2);

 if ($jArr['auto_add'] == 1) {
     $auto1 = 'checked="checked"';
 } else {
     $auto2 = 'checked="checked"';
 }

 if ($jArr['teach_list_type'] == 1) {
     $teach1 = 'selected="selected""';
 } else {
     $teach2 = 'selected="selected""';
 }

 if ($jArr['stud_list_type'] == 1) {
     $stud1 = 'selected="selected""';
 } else {
     $stud2 = 'selected="selected""';
 }

 $teachArray = explode(',', $jArr['teach_exception_list']);
 $studArray = explode(',', $jArr['stud_exception_list']);

 
	echo '<script>
var tickImg = \'<img src="' . $imgServer . 'gen/tick.png">\';
var crossImg = \'<img src="' . $imgServer . 'gen/cross.png">\';


function updateImgs(obj) {

if ($(obj).find(".texter").html() == tickImg) {
    $(obj).find(".texter").html(crossImg);
} else {
    $(obj).find(".texter").html(tickImg);
}

}

$( ".ding" ).buttonset();
$( "#auto" ).buttonset();

function updateAppPolicy() {
        dataString = $("#app-pol").serialize();


        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=5",
        data: dataString,
        success: function(data) {

               $("#failer").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">User Application Policies Updated Successfully!</div>\').slideDown(400).delay(2500).slideUp(400);
      

       }

        });
}


</script>
<style type="text/css">
#apps-table {
    border: 1px solid #999;
    border-collapse:collapse;
    width:450px;
}
#apps-table th{
    padding-top:5px;
    padding-bottom:5px;
    padding-left:9px;
    padding-right:9px;
    border: 1px solid #999;
}
#apps-table td{
    padding: 5px;
     border: 1px solid #999;
}
#apps-table .define {
    background-color: #e1e1e1;
}

</style>
<div class="headTitle"><img src="' . $imgServer . 'gen/setting.png" style="margin-right:5px;margin-top:3px" /><div>User Application Policies</div></div>
    <form id="app-pol">
    
<div id="auto" style="margin:5px">
<div id="failer" style="display:none"></div>
<span style="font-size:16px">Auto-Add Applications</span><br />
		<input type="radio" id="radio1" name="auto_add" value="1" ' . $auto1 . '  /><label for="radio1">Enabled</label>
		<input type="radio" id="radio2" name="auto_add" value="2" ' . $auto2 . '  /><label for="radio2">Disabled</label>
	</div>

<br /><br />

<table id="apps-table">
<tr class="define" >
  <th>Application Name</th>
  <th>
<select name="studlist" id="studlist" onchange="updateImgs()">
  <option value="1" ' . $stud1 . '>Allow All</option>
  <option value="2" ' . $stud2 . '>Deny All</option>
</select>
for  students,<br />except these applications:
</th>
  <th>
<select name="teachlist" id="teachlist" onchange="updateImgs()">
  <option value="1" ' . $teach1 . '>Allow All</option>
  <option value="2" ' .$teach2 . '>Deny All</option>
</select>
for teachers,<br />except these applications:
</th>
</tr>';

foreach ($apps as $app) {
    
    if (in_array($app['id'], $teachArray)) {
        $tSel = 'checked="checked"';
        $tImg = 'tick.png';
    } else {
        $tSel = '';
        $tImg = 'cross.png';
    }

    if (in_array($app['id'], $studArray)) {
        $sSel = 'checked="checked"';
        $sImg = 'tick.png';
    } else {
        $sSel = '';
        $sImg = 'cross.png';
    }
    echo '<tr>
<td><strong><a href="#">' . $app['name'] . '</a></strong></td>
<td style="padding:0px" class="ding"><input type="checkbox" id="rad' . $app['id'] . '" name="studapps[]" value="' . $app['id'] . '" ' . $sSel . '  /><label for="rad' . $app['id'] . '" class="noRound" style="width:99%; height:100%" onClick="updateImgs($(this))"><span class="texter"><img src="' . $imgServer . 'gen/' . $sImg . '"></span></label></td>
<td style="padding:0px" class="ding"><input type="checkbox" id="teach' . $app['id'] . '"name="teachapps[]" value="' . $app['id'] . '" ' . $tSel . ' /><label for="teach' . $app['id'] . '" class="noRound" style="width:99%; height:100%" onClick="updateImgs($(this))"><span class="texter"><img src="' . $imgServer . 'gen/' . $tImg . '"></span></label></td>
</tr>';
}



echo '</table><input type="hidden" name="submitted" value="true" /></form>


<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox(); return false" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="updateAppPolicy(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Save Application Policies</a></div>';

?>
