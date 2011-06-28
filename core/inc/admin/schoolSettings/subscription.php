

<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Subscription</strong></div>
<?php
if($school['subscription'] == 0) {
	$class="errorbox";
	$body='<p style="font-size:14px">Having a ClassConnect subscription allows you to do more with our platform. You can manage administrator accounts, lock into a basic service level agreement (SLA) with us, and much much more! To request a free trial of ClassConnect\'s premium subscription, click here.</p>';
} else {
	$class="infobox";
	$body='<p style="font-size:14px">Your ClassConnect Ambassador<br />
	<span style="font-size:16px; font-weight:bolder">Eric Simons</span><br /><br />
	Email Address<br />
	<span style="font-size:16px; font-weight:bolder">ericsimons@classconnect.com</span><br /><br />
	Direct Phone Number<br />
	<span style="font-size:16px; font-weight:bolder">630-815-5680</span><br /><br />
	
	</p>';
}
?>
<div class="<?php echo $class; ?>" style="font-size:18px;text-align:center">You have <strong><?php echo $school['subscription'];?> days</strong> remaining in your subscription.</div>
<?php echo $body; ?>
	
	
	<form id="updater" method="POST"><div style="display:none"><input type="password" name="pass" /></div></form>
	
<div id="failer" style="display:none"></div>