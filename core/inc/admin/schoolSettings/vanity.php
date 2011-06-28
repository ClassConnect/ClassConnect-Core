<?php
$sid = $school['id'];
if (isset($_GET['n']) && is_numeric($_GET['n'])) {

if ($_GET['n'] == 1) {
	$errors = array();

	if ($_POST['vanity'] != '') {
		$vanity = escape($_POST['vanity']);
		
		if ($vanity == $school['settingDomain'] && $vanity != '') {
		$errors[] = 'You already own this vanity URL.';
		} else {
			if (ctype_alnum($vanity) == false) {
				$errors[] = 'URL can only contain alphanumeric characters. (A-Z & 0-9)';
			} else {
				// check if this domain is taken
				$testURL = good_query_assoc("SELECT * FROM schools WHERE settingDomain = '$vanity' LIMIT 1");
				if ($testURL != false) {
					$errors[] = 'This vanity URL has already been taken.';
				}
			}
		}
		
	} else {
		$errors[] = 'You forgot to enter your desired vanity URL.';
	}
	
	

	if (empty($errors)) {
		$update = good_query("UPDATE schools SET settingDomain = '$vanity' WHERE id = $sid LIMIT 1");
		echo "1";
	} else {
		echo '<div class="errorbox" ><span style="font-size:14px; font-weight:bolder">Oops!</span>';
			foreach ($errors as $error) {
				echo '<li>' . $error . '</li>';
			}
		echo '</div>';
	
	}
	
	
	
} // if n
exit();
} // if n numeric
?>
<script type="text/javascript">
// function for submitting the school signup form
function updateVanity() {
        dataString = $("#updater").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=<?php echo $school['id']; ?>&s=6&n=1",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html('<div class="successbox" style="text-align:center; font-weight:bolder">Vanity URL Updated Successfully!</div>').slideDown(400).delay(2500).slideUp(400);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}
</script>

<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>School Vanity URL</strong></div>

<?php
if ($school['settingDomain'] != 'null') {
    echo '<div id="hideMeNow" class="infobox" style="font-size:18px"><a href="#" onClick="$(\'#hideMeNow\').hide(); $(\'#vanityPop\').show(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/edit_s.png" />Edit Vanity URL</a>http://<strong>' . $school['settingDomain'] . '</strong>.classconnect.com</div><div style="display:none"><input type="password" name="pass" /></div>';
    $before = '<div id="vanityPop" style="display:none">';
    $after = '</div>';
} else {
    $school['settingDomain'] = '';
}

echo $before . '<form id="updater" method="POST"><div class="infobox" style="font-size:18px"><a href="#" onClick="updateVanity(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Update Vanity URL</a>http://<input type="text" name="vanity" maxlength="40" value="' . $school['settingDomain'] . '" style="font-size:18px;width:250px; border-top:none;border-left:none;border-right:none;text-align:center;font-weight:bolder" />.classconnect.com </div><div style="display:none"><input type="password" name="pass" /></div></form>' . $after;

?>
	
<div id="failer" style="display:none"></div>

<br/><br />
<span style="font-size:16px; color: #666">What is a vanity URL?</span><br />
<span style="font-size:14px">A vanity URL is a unique web address. On ClassConnect, a vanity URL is a subdomain name that is chosen by a school's administrators (ex: http://<strong>your-school-name</strong>.classconnect.com). When students / teachers visit this URL, they are shown your school logo, name and color scheme instead of the default ClassConnect scheme.</span>




















