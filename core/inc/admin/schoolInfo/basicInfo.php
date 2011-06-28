<?php
if (isset($_POST['name'])) {
	$errors = array();
	$sid = $school['id'];
	$website = escape($_POST['website']);
	$phone = escape($_POST['phone']);
	$body = escape($_POST['body']);
	$city = escape($_POST['city']);
	$zip = escape($_POST['zip']);
	
	if ($_POST['name'] != '') {
		$name = escape($_POST['name']);
	} else {
		$errors[] = 'You forgot to enter you school name.';
	}

	
	if ($_POST['country'] != '') {
		$country = escape($_POST['country']);
	} else {
		$errors[] = 'Please select your country.';
	}
	
	if ($_POST['state'] != '') {
		$state = escape($_POST['state']);
	} else {
		$errors[] = 'Please select your state.';
	}
	
	if (empty($errors)) {
		$update = good_query("UPDATE schools SET name = '$name', website='$website', phone='$phone', body='$body', city='$city', zip='$zip', country='$country', state='$state' WHERE id = $sid LIMIT 1");
		echo "1";
		setSession($user_id);
	} else { // report the errors
		echo '<div class="errorbox" style="width: 470px;"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($errors as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}	
	
	
exit();

}


?>
<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Basic Information</strong></div>

<script type="text/javascript">
// function for submitting the school signup form
function updateSchool() {
        dataString = $("#school-update").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=<?php echo $school['id']; ?>&s=2",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html('<div class="successbox" style="width: 470px;margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">School Info Updated Successfully!</div>').slideDown(400).delay(1800).slideUp(400);
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}



var postState = '<?php echo $school['state']; ?>'; var postCountry = '<?php echo $school['country']; ?>';
<?php  require_once('core/ajax/states.js'); ?>
</script>
<form method="POST" id="school-update" style="font-size:14px">	
<div id="failer" style="display:none"></div>
<div id="cont-left" style="float:left; width:240px;padding-top:10px;border-right: 1px solid #999;">
<strong>School Name</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:215px" value="<?php echo $school['name']; ?>" /><br /><br/>

<strong>School Website</strong><br />
<input type="text" name="website" style="width:215px" value="<?php echo $school['website']; ?>" /><br /><br/>

<strong>Phone Number</strong><br />
<input type="text" name="phone" style="width:215px" value="<?php echo $school['phone']; ?>" /><br /><br />

<strong>School Description</strong><br />
<textarea name="body" style="height:50px; width:215px"><?php echo $school['body']; ?></textarea>
</div>

<div id="cont-right" style="float:left; width:260px;padding-top:10px;padding-left:25px">
<strong>City</strong><br />
<input type="text" name="city" style="width:215px" value="<?php echo $school['city']; ?>" /><br /><br/>

<strong>ZIP</strong><br />
<input type="text" name="zip" style="width:215px" value="<?php echo $school['zip']; ?>" /><br /><br/>

<strong>Country</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<div>
<select id="countrySelect" name="country" onchange="populateState()"></select><br /><br>

<strong>State</strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<select id="stateSelect" name="state"></select>
</div>
<a href="#" onClick="updateSchool()" class="button" style="margin-top:20px"><img src="<?php echo $imgServer; ?>gen/save.png" /> Save Basic School Information</a>
<script type="text/javascript">initCountry('US'); </script>

</div>

</form>