<?php
// conv our school policies from JSON
$jArr = json_decode(reverse_htmlentities($school['classPolicies']), true);

// did the user just update?
if (isset($_POST['submitted'])) {
    $autoAdd = escape($_POST['auto_add']);
    $listType = escape($_POST['applist']);
    $appList = $_POST['apps'];

    foreach ($appList as $app) {
        $total .= $app . ',';
    }
    $total = substr($total, 0, strlen($total) - 1);

    updateCPol($school['id'], $autoAdd, $listType, $total);
    setSession($user_id);
    setLocalPolicies($user_id, $school['id']);
    exit();

}

// get our list of applications
 $apps = getSchoolApps($school['id'], 1);

 if ($jArr['auto_add'] == 1) {
     $auto1 = 'checked="checked"';
 } else {
     $auto2 = 'checked="checked"';
 }


 if ($jArr['list_type'] == 1) {
     $listSel1 = 'selected="selected""';
 } else {
     $listSel2 = 'selected="selected""';
 }

 $excArray = explode(',', $jArr['exception_list']);

 
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
        url: "school-admin.cc?id=' . $school['id'] . '&s=13&n=1",
        data: dataString,
        success: function(data) {

               $("#failer").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">Class Application Policies Updated Successfully!</div>\').slideDown(400).delay(2500).slideUp(400);
      
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
<div class="headTitle"><img src="' . $imgServer . 'gen/setting.png" style="margin-right:5px;margin-top:3px" /><div>Class Application Policies</div></div>
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
<select name="applist" id="applist">
  <option value="1" ' . $listSel1 . '>Allow All</option>
  <option value="2" ' . $listSel2 . '>Deny All</option>
</select>
 for classes, except these applications:
</th>
</tr>';

foreach ($apps as $app) {
    
    if (in_array($app['id'], $excArray)) {
        $tSel = 'checked="checked"';
        $tImg = 'tick.png';
    } else {
        $tSel = '';
        $tImg = 'cross.png';
    }
if ($app['id'] != 1) {
    echo '<tr>
<td><strong><a href="#">' . $app['name'] . '</a></strong></td>
<td style="padding:0px" class="ding"><input type="checkbox" id="rad' . $app['id'] . '" name="apps[]" value="' . $app['id'] . '" ' . $tSel . '  /><label for="rad' . $app['id'] . '" class="noRound" style="width:99.5%; height:100%" onClick="updateImgs($(this))"><span class="texter"><img src="' . $imgServer . 'gen/' . $tImg . '"></span></label></td>
</tr>';
}
// check if app not class page
}



echo '</table><input type="hidden" name="submitted" value="true" /></form>


<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox(); return false" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="updateAppPolicy(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Save Application Policies</a></div>';

?>
