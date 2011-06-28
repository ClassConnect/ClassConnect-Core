<?php
$content_id = escape($_GET['content_id']);

// if we have authorization
if (auth_content($content_id, $user_id) == true) {



if (isset($_POST['password'])) {
	$attempt = delete_content($content_id, $user_id);
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



	// get the content info
	$content = get_content($content_id);
?>

<script>
function deleteContent() {
        dataString = $("#delete-content").serialize();
        $.ajax({
        type: "POST",
        url: "filebox.cc?n=9&content_id=" + <?php echo $content['id']; ?>,
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               closeBox();
               updateFbox(<?php echo $content['fid']; ?>);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}


</script>

<?php


echo '<div class="headTitle"><img src="' . $imgServer . 'gen/del_l.png" style="margin-top:5px; margin-right: 5px" /><div>Delete \'' . $content['name'] . '\'</div></div>
<div id="failer" style="display:none"></div>
<div id="content" style="margin:5px">
<form method="POST" id="delete-content" style="font-size:14px; margin-top:10px">	
Are you sure you want to delete \'' . $content['name'] . '\'?

<input type="password" name="password" size="1" style="display:none" value="submit" />
</form>
</div>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="deleteContent();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Confirm & Delete
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';




	
} else {
	echo 'Cannot verify permissions. Please try again.';
	exit();
}

?>