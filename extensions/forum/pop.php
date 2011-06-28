<?php
// include core stuff
require_once('../../core/inc/coreInc.php');


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/add_l.png" style="margin-right:5px;margin-top:2px" /><div>Example Pop Up Box</div></div>
<div id="content" style="margin:5px">
This is an example pop up box.

</div>

<div id="bottom" style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><button onClick="closeBox();" type="submit" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</button></div>';

?>