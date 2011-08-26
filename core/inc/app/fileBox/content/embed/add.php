<?php
if (isset($_POST['name'])) {
	$name = escape($_POST['name']);
	$code = escape($_POST['code']);
	$body = escape($_POST['body']);
	$attempt = create_embed($fid, $user_id, $name, $code, $body);
	if ($attempt == 1) {
		echo '1';
	} else {
		echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($attempt as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}
	
	exit();
}

?>

<script>
function showDesc() {
	$("#opted").hide();
	$("#descr").show();
}


function addEmbed() {
		$('#bottom').after('<img src="core/site_img/loading.gif" id="loadImgur" style="margin-right:30px; margin-bottom:4px; float:right" />');
        $('#bottom').hide();
        dataString = $("#add-embed").serialize();
        var fid = <?php echo $fid; ?>;
        var cType = <?php echo $cType; ?>;
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=7&cType=" + cType + "&fid=" + fid,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(fid);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 $('#loadImgur').remove();
             $('#bottom').show();
         	 
         }
               
       }

        });
}


</script>

<?php


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/embed_l.png" style="margin-top:4px; margin-right: 3px" /><div>Add Embed Code</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="add-embed" style="font-size:14px; margin-top:10px">	
<strong>File Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" maxlength="45" /><br /><br />

<strong>Embed Code</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<textarea name="code" style="height:50px; width:215px"></textarea><br /><br />

<div id="opted"><a onClick="showDesc()">Add A Description</a></div>

<div id="descr" style="display:none"> 
<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:215px"></textarea>
</div>

<input type="password" size="1" style="display:none" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="addEmbed();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Add Embed
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>