<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
requireSession();
// local extension file
require_once('core/main.php');

$class_id = escape($_GET['cid']);
// if this is a teacher of the class
if (authClass($class_id)) {

if (isset($_POST['submitted'])) {
    $parent = getAllEntries($class_id);
    foreach ($_POST['selClasses'] as $tempID) {
        if (authClass($tempID)) {
            // main copy code...BEGIN
            $tempCopy = getAllEntries($tempID);
            
            // loop through all parent events
            foreach ($parent as $master) {
                $insert = true;
                foreach ($tempCopy as $slave) {
                    if (($slave['title'] == $master['title']) && (date("Y-m-d", strtotime($slave['start_date'])) == date("Y-m-d", strtotime($master['start_date'])))) {
                        $insert = false;
                    }
                }

                if ($insert == true) {
                    createEntry($master['title'], $master['body'], 1, $master['type'], $tempID, $master['start_date'], $master['end_date']);
                }

            }


        }
    }
    echo '1';
exit();
}



echo '<div class="headTitle"><img src="' . $imgServer . 'gen/sync.png" style="margin-right:8px;margin-top:5px" /><div>Sync Class Calendars</div></div>
<div id="failer" style="display:none;margin-top:1px;margin-left:1px;margin-right:1px;margin-bottom:5px"></div>
<div id="content" style="margin:5px">
<form method="POST" id="class-list">

<div style="float:right; width:210px;font-size:14px;padding-right:5px;">
Choose the classes that you want to sync this calendar with.<br />
<span style="font-size:10px; color:#999">Calendar entries will be transferred over if there is not an entry in the selected class bearing the same title and start date.</span>
</div>

<div id="yourClasses" style="width:190px;margin-top:10px;">';
foreach ($myClasses as $checkd) {
    if ($checkd['id'] != $class_id) {
        echo '<div style="margin-bottom:5px"><input type="checkbox" id="check' . $checkd['id'] . '" value="' . $checkd['id'] . '" name="selClasses[]" /><label class="fullRound" for="check' . $checkd['id'] . '" style="width:170px">' . $checkd['name'] . '</label></div>';
    }
}

echo '</div>
<input type="hidden" name="submitted" value="true" />
</form>
</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button class="button" type="submit" onClick="closeBox();" style="float:right"><img src="' . $imgServer . 'gen/cross.png" />Close</button><button class="button" type="submit" onClick="syncCals();" style="float:right" id="removeButton"><img src="' . $imgServer . 'gen/tick.png" />Sync Calendars</button></div>

<script>


function syncCals() {
        dataString = $("#class-list").serialize();
        $("#content").html("<br /><center><img src=\"/app/core/site_img/loading.gif\" /></center><br />");
        $.ajax({
        type: "POST",
        data: dataString,
        url: "/app/extensions/calendar/sync.php?cid=' . $class_id . '",
        success: function(data) {
        $("#removeButton").remove();
        	$("#content").html("<div class=\"successbox\" style=\"font-weight:bolder; text-align:center\">Calendars synced successfully!</div>");

       }

        });
}

$(function() {
    $( "#yourClasses" ).buttonset();
});

</script>';



}
// teacher end
?>