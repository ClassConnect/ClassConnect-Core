<?php
if (isset($_POST['name'])) {
	$name = escape($_POST['name']);
	$body = escape($_POST['body']);
	$attempt = update_content($content['id'], $user_id, $name, $body, reverse_htmlentities($content['content']));
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


function updateUn() {
		$('#bottom').after('<img src="core/site_img/loading.gif" id="loadImgur" style="margin-right:30px; margin-bottom:4px; float:right" />');
        $('#bottom').hide();
        dataString = $("#update-un").serialize();
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=8&content_id=" + <?php echo $content['id']; ?>,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(<?php echo $content['fid']; ?>);
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


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/edit.png" style="margin-top:2px; margin-right: 5px" /><div>Update File</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="update-un" style="font-size:14px; margin-top:10px">
<strong>File Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" value="' . $content['name'] . '" maxlength="45" /><br /><br />';


if ($content['body'] == '') {
	echo '<div id="opted"><a onClick="showDesc()">Add A Description</a></div>

<div id="descr" style="display:none"> ';
} else {
	echo '<div id="descr">';
}

echo '<strong>Description</strong><br />
<textarea name="body" style="height:50px; width:215px">' . $content['body'] . '</textarea>
</div>

<input type="password" size="1" style="display:none" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="updateUn();" type="submit">
<img src="' . $imgServer . 'gen/tick.png" /> Update
</button>
<button class="button" onClick="closeBox();" type="submit">
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>