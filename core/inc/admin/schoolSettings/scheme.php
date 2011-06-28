<?php
$sid = $school['id'];
if (isset($_GET['n']) && is_numeric($_GET['n'])) {

if ($_GET['n'] == 1) {
	if (isset($_POST['color'])) {
		$color = escape($_POST['color']);
		$update = good_query("UPDATE schools SET settingColor='$color' WHERE id = $sid LIMIT 1");
		echo "1";
                                     setSession($user_id);
                                     setLocalPolicies($user_id, $sid);
		exit();
	}
	// display color wheel
	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/flag.png" style="margin-right:5px" /><div>Choose Your School Color</div></div>
<div id="content" style="margin:5px">
	<div id="failer" style="display:none"></div>
	<div style="float:right; width:390px">
<p style="font-size:14px; margin-top:20px">Use the color wheel to choose your school\'s color. Below is a preview of your selected color scheme when in use.</p>

<div id="colorme" style="background: ' . $school['settingColor'] . '">Example Of School Color</div>

<div style="margin-top:40px;margin-left:20px"><a href="#" onClick="updateColor(); return false" class="button" style="margin-top:10px"><img src="' . $imgServer . 'gen/tick.png" />Save & Apply School Color Scheme</a><a href="#" onClick="window.location.reload(); return false" class="button" style="margin-top:10px"><img src="' . $imgServer . 'gen/cross.png" />Close</a></div>
	</div>
	
<script type="text/javascript" src="' . $scriptServer . 'wheel/wheel.js"></script>
<div id="colorpicker"></div>

<form method="POST" id="color-update"><input type="text" id="color" name="color" value="' . $school['settingColor'] . '" style="margin-left:40px;width:100px" /><div style="display:none"><input type="password" name="pass" /></div></form>

<script type="text/javascript">
  $(document).ready(function() {
    $(\'#colorpicker\').farbtastic(\'#color, #colorme\');
  });
</script>
</div>';
} elseif ($_GET['n'] == 2) {
	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/flag.png" style="margin-right:5px" /><div>Change Your School Logo</div></div>
<div id="content" style="margin:5px">
<iframe src="school-admin.cc?id=' . $school['id'] . '&s=5&n=3" style="width:470px; height:70px" frameborder="0" scrolling="no"></iframe>

<div style="clear:both;float:right"><a href="#" onClick="window.location.reload();return false" class="button" style="margin-top:10px;margin-bottom:5px"><img src="' . $imgServer . 'gen/cross.png" />Close</a></div>

</div>';
} elseif ($_GET['n'] == 3) {
require_once('core/inc/thumb/ThumbLib.inc.php');
 		
		if (isset($_FILES['upload'])) {
		$ext = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
		// Validate the type. Should be JPEG or PNG.
		if ($ext == 'png' || $ext == 'jpg' || $ext == 'gif') {
			// Move the file over.
			$filename = SHA1($school['id'] . date('m/d/Y/i/s')) . '.' . $ext;

			if (move_uploaded_file ($_FILES['upload']['tmp_name'], 'core/site_img/client_img/school/' . $filename)) {
				$thumb = PhpThumbFactory::create('core/site_img/client_img/school/' . $filename); 
				$thumb->resize(200, 30)->save('core/site_img/client_img/school/' . $filename);
				list($width, $height, $type, $attr) = getimagesize('core/site_img/client_img/school/' . $filename);
				unlink ('core/site_img/client_img/school/' . $school['settingLogo']);
				$update = good_query("UPDATE schools SET settingLogo = '$filename', logoHeight='$height' WHERE id = $sid LIMIT 1");
                                                                          setSession($user_id);
				setLocalPolicies($user_id, $sid);
				$school['settingLogo'] = $filename;
				
				// Delete the file if it still exists:
				if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
					unlink ($_FILES['upload']['tmp_name']);
				}
			}
		}
			
	} // End of isset($_FILES['upload']) IF.
	
	
	
	
	
	echo '<img src="' . $imgServer . 'client_img/school/' . $school['settingLogo'] . '" style="border: 2px solid #ccc; float:left" />
<div style="float:right; border-left:1px solid #CCC; padding-left:5px">
<form enctype="multipart/form-data" action="school-admin.cc?id=' . $school['id'] . '&s=5&n=3" method="post" style="font-family:arial; font-size:14px; font-weight:bolder; color: #333">
<input type="file" name="upload" /><br /><input type="submit" value="Upload Logo" />
</form></div>';
}	

exit();
} // isset and is_numeric n

?>
<script type="text/javascript">
// function for submitting the school signup form
function updateColor() {
        dataString = $("#color-update").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=<?php echo $school['id']; ?>&s=5&n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html('<div class="successbox" style="width: 567px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Color Updated Successfully!</div>').slideDown(400).delay(1800).slideUp(400);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}
</script>


<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Logo / Color Scheme</strong></div>
<div style="height:20px"></div>
<div class="colorswap fullRound" style="margin-left:20px" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=5&n=1', 600);">
    <img src="<?php echo $imgServer; ?>main/colors.png" style="float:left; margin-right:5px" />
    <span style="font-size:16px; color:#666">Change School Color</span><br /><br />
    Our designers built ClassConnect to accomodate virtually any school color. Use our beautiful color picker to choose your school color.
</div>
<div class="colorswap fullRound" style="margin-left:20px" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=5&n=2', 485);">
    <img src="<?php echo $imgServer; ?>main/up.png" style="float:left; margin-right:5px" />
    <span style="font-size:16px; color:#666">Upload School Logo</span><br /><br />
    Upload your school logo to be showcased at the top left hand corner of the site, on your vanity domain page, and on your school page!
</div>
