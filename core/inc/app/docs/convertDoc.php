<script>


function submitFile() {
	var value = $('input[name=target]:checked').val();
    if (value != undefined) {
    	openBox('writer.php?n=6&id=' + value, 350);
    }
        
}

</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/w_large.png" style="margin-top:3px; margin-right: 3px" /><div>Open Document From File</div></div>
<div id="failer" style="display:none"></div>
<script type="text/javascript" src="' . $scriptServer . 'filePicker.js"></script>
<form method="POST" id="add-doc">

<div id="selectBox" font-size="font-size:11px">



</div>
<div id="contentAllow" style="display:none">
1,6
</div>
<div id="addAllow" style="display:none">
doc,odt,ott,rtf,txt
</div>

<input type="password" size="1" style="display:none" />
</form>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="submitFile();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Open Document
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>