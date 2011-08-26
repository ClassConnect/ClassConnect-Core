<?php
require_once('core/inc/coreInc.php');
requireSession();

if (isset($_GET['n']) && is_numeric($_GET['n'])) {
    if ($_GET['n'] == 1) {
        require_once('core/inc/user/settings/chooseIcon.php');

    } elseif ($_GET['n'] == 2) {
       require_once('core/inc/user/settings/password.php');

    } elseif ($_GET['n'] == 3) {
       require_once('core/inc/user/settings/contact.php');

    }

    exit();
}
$userData = getUser($user_id);
$page_title = "Account Settings";
$scriptArr[] = $scriptServer . 'input.js';
require_once('core/template/head/header.php');
?>
<script>
    $(document).ready(function(){
    $( "#mobEn" ).buttonset();
    $( "#emEn" ).buttonset();
	$("#classImg a").click(function(){
		return false;
	});

	$("#classImg").hover(
  function () {
    $('#iconFloat').show();
  },
  function () {
    $('#iconFloat').hide();
  }
);

});
$(function() {
// number input
$("#mobile").mask("(999) 999-9999");

});




function updateSettings() {
		  dataString = $("#update-settings").serialize();
        $.ajax({
        type: "POST",
        url: "settings.cc?n=3",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
                $("#failer1").html('<div class="successbox" style="text-align:center">Email & Mobile Settings Updated Successfully!</div>').fadeIn(300).delay(2000).fadeOut(300);
                } else {
                $("#failer1").html(data).fadeIn(300).delay(2000).fadeOut(300);
                }


       }

        });




}
</script>
<style type="text/css">
.accordian {
	width: 980px;
  margin-left:-40px;
  clear:both;
}

.accordian li {
	list-style-type: none;
	padding: 5px;
}

.dimension {

}

.even, .odd {
	font-weight: bold;
	padding-left: 10px;
}

.even {
	border: 1px solid #d8d8d8;
	background-color: #ececec;
}
.odd {
	border: 1px solid #d8d8d8;
	background-color: #ececec;
}
</style>
<div id="failer1" style="float:right; display:none"></div>

<div class="accordian">
	<ul>
		<li class="odd"><img src="<?php echo $imgServer; ?>gen/basic.png" style="float:left; margin-right:5px" /> Basic Settings</li>
		<li>
<div style="float:right; width:740px">

    <div style="float:right; width:400px; font-size:14px; border-left:1px solid #ccc; padding-left:50px; padding-top:30px; padding-bottom:40px">
     <span style="color:#666; font-size:20px">Want to export your data?</span><br />Email support@classconnect.com and we will send you a CSV file of your data within 1-2 business days.
</div>

    <br /><br /><span style="color:#666; font-size:20px"><?php echo $firstname . ' ' . $lastname; ?></span>
<br /><a href="#" class="button" onClick="openBox('settings.cc?n=2', 250)"><img src="<?php echo $imgServer; ?>gen/resend.png" /> Reset Password</a>




</div>

<div id="classImg" style="width:128px; height:128px; border:2px solid #e1e1e1; margin-left:5px; margin-bottom:5px">
<div id="changeImg" style="background: url(<?php echo $iconServer . $userData['prof_icon']; ?>.png)" class="classimg">
<div id="iconFloat" class="iconFloater"><a href="#" onClick="openBox('settings.cc?n=1', 500)">Change Icon</a></div>
</div>
</div>

              


                </li>


                
		<li class="odd" style="margin-top:10px"><img src="<?php echo $imgServer; ?>gen/contact.png" style="float:left; margin-right:5px" /> Email & Mobile Settings</li>
		<li><form action="#" id="update-settings">

                     <div style="float:left; width:470px; border-right:1px solid #ccc; padding-right:5px; margin-right:5px">
                          <img src="<?php echo $imgServer; ?>gen/email_l.png" style="float:left; margin-right:5px" />
                        <div style="margin-top:7px">
                        <span style="font-size:16px; font-weight:bolder; line-height:0.5">Email Settings</span><br /><span style="color: #999; margin-top:-5px">Set up your email address & opt in to receive email notifications.</span>
                        </div><br />

                         <div style="float:left; margin-left:30px">
<strong>Primary Email Address</strong><br />
                    <input type="text"  name="email" size="30" value="<?php echo $userData['e_mail']; ?>" />
                        </div>


                <div id="emEn" style="float:right; margin-right:50px">
                    <strong>Email Notifications</strong><br />
		<input type="radio" id="radio3" name="email_swap" value="1"<?php if($userData['email_active'] == 1) { echo ' checked="checked"'; } ?> /><label for="radio3">Enabled</label>
		<input type="radio" id="radio4" name="email_swap" value="0"<?php if($userData['email_active'] == 0) { echo ' checked="checked"'; } ?> /><label for="radio4">Disabled</label>
	</div>
                         </div>


                    <div style="width:400px; float:right">
                        <img src="<?php echo $imgServer; ?>gen/phone.png" style="float:left" />
                        <div style="margin-top:7px">
                        <span style="font-size:16px; font-weight:bolder; line-height:0.5">Mobile Settings</span><br /><span style="color: #999; margin-top:-5px">Set up your mobile phone to receive text messages of your assignments.</span>
                        </div><br />

                        <div style="float:left; margin-left:50px">
<strong>Cell Phone Number</strong><br />
                    <input type="text" id="mobile" name="cell" size="12" value="<?php echo $userData['cell']; ?>" />
                        </div>


                <div id="mobEn" style="float:right; margin-right:50px">
                    <strong>Mobile Notifications</strong><br />
		<input type="radio" id="radio1" name="cell_swap" value="1"<?php if($userData['cell_active'] == 1) { echo ' checked="checked"'; } ?>  /><label for="radio1">Enabled</label>
		<input type="radio" id="radio2" name="cell_swap" value="0"<?php if($userData['cell_active'] == 0) { echo ' checked="checked"'; } ?> /><label for="radio2">Disabled</label>
	</div>
                    </div>

                   <input type="hidden" name="submitted" value="true" />
                    </form>
<div style="clear:both;margin-left:370px; padding-top:20px"><button class="button" type="submit" onClick="updateSettings()"><img src="<?php echo $imgServer; ?>gen/save.png" /> Save Email & Mobile Settings</button></div>
            
           </li>

                

	</ul>
</div>

<?php
require_once('core/template/foot/footer.php');
?>