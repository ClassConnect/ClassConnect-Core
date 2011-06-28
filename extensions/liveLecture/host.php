<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');
if ($class_level != 3) {
    exit();
}
echo '
    <script>
function hostLecture() {
if ($("input[name=target]:checked").val() != undefined) {
    window.location = "livelecture/cacheswap.cc?classID=' . $class_id . '&fid=" + $("input[name=target]:checked").val();
} else {
$("#failer").html(\'<div class="errorbox" style="font-weight:bolder; text-align:center;">You forgot to choose a presentation.</div>\');
}

}
    </script>
<div class="headTitle"><img src="' . $imgServer . 'main/mic.png" style="margin-top:3px; margin-right: 9px" /><div>Host A LiveLecture</div></div>
<script type="text/javascript" src="' . $scriptServer . 'filePicker.js"></script>

<form method="GET" id="move-content">
<div id="failer" style="border-bottom:2px solid #999;"><div style="font-size:14px; color:#999; padding:5px; font-style:italic">choose a presentation...</div></div>
<div id="selectBox">



</div>
<div id="contentAllow" style="display:none">
7
</div>
<div id="addAllow" style="display:none">
</div>
</form>
<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="hostLecture();" type="submit">
<img src="' . $imgServer . 'gen/tick.png" /> Host LiveLecture
</button>
<button class="button" onClick="closeBox();" type="submit">
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';	
?>
