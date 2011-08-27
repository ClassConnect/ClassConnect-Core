<script>


function submitFile() {
	var value = $('input[name=target]:checked').val();
	var classID = $('input[name=class]:checked').val();
    if (value != undefined) {
    	openBox('presentations.cc?n=7&cid=' + classID + '&fid=' + value,350);
    }
        
}

 $(document).ready(function() {
   $( "#classButtons" ).buttonset();
 });

</script>
<?php

	echo '<div class="headTitle"><div>Host LiveLecture</div></div>
<div id="failer" style="display:none"></div>
<script type="text/javascript" src="' . $scriptServer . 'filePicker.js"></script>
<form method="POST" id="add-doc">

<div style="font-size:14px;font-weight:bolder;margin:5px;margin-left:10px">Choose a class</div>
<div id="classButtons" style="padding:5px">';
foreach ($myClasses as $teClass) {
    echo '<input type="radio" name="class" id="classOpt' . $teClass['id'] . '" value="' . $teClass['id'] . '" /><label for="classOpt' . $teClass['id'] . '" class="fullRound" style="margin-left:7px; margin-bottom:4px;width:155px">' . $teClass['name'] . '</label>';
}

echo '</div>
<div style="font-size:14px;font-weight:bolder;margin:5px;margin-top:10px;margin-left:10px">Choose a lecture</div>
<div id="selectBox" font-size="font-size:11px">



</div>
<div id="contentAllow" style="display:none">
7
</div>

<input type="password" size="1" style="display:none" />
</form>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="submitFile();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Host Lecture
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>