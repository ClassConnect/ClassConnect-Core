<script>
x = true;
function launchLec() {
	if(x == true) {
		window.location = 'livelecture/cacheswap.cc?classID=<?php echo $_GET['cid']; ?>&fid=<?php echo $_GET['fid']; ?>';
	}
}
 $(document).ready(function() {
   setTimeout("launchLec();",1000);
 });
</script>
<?php

	echo '<div style="margin-top:20px;font-size:14px">
<center><img src="' . $imgServer . 'sBoxLoad.gif" style="margin-bottom:10px" /><br />
Initializing lecture & notifying students...
</center>
</div>

<br />
<div style="float:left;padding-left:10px;font-size:12px;color:#999">Not redirected? <a href="livelecture/cacheswap.cc?classID=' . $_GET['cid'] . '&fid=' . $_GET['fid'] . '">Click here.</a></div>

<div style="float:right;margin-bottom:4px">
<button class="button" onClick="x = false;closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Cancel
</button>
</div>';


?>