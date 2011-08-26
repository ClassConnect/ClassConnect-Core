<?php
// load pages
if (isset($_GET['n']) && is_numeric($_GET['n'])) {
	
	if ($_GET['n'] == 1) {
	$sid = $school['id'];
	$uid = $_GET['uid'];
	$user = good_query_assoc("SELECT * FROM users LEFT JOIN school_users ON users.id = school_users.uid WHERE school_users.sid = $sid AND users.id = $uid LIMIT 1");
	if ($user != false) {
		if ($_POST['pass'] != '') {
		$password = escape($_POST['pass']);
		setPassword($uid, $password);
		sendPasswordEmail($uid, $password);
		echo "1";
		exit();	
		}
		
	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/edit.png" style="margin-right:5px;margin-top:5px" /><div>Manage "' . $user['first_name'] . ' ' . $user['last_name'] . '"</div></div>
<div id="content" style="margin:5px">
	<div id="failer" style="display:none"></div>
<form method="POST" id="update-user" style="font-size:14px; padding-top:3px">
<strong>Reset Password</strong><br />
<a href="#" onClick="resetPass();" style="float:right" class="button"><img src="' . $imgServer . 'gen/resend.png" />Reset Password</a>
<input type="text" name="pass" style="width:215px" />
<div style="display:none"><input type="password" name="saget" /></div>
<br /><br/>
</form>

<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox();" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a></div>

</div>';

echo '<script type="text/javascript">
// function for submitting the school signup form
function resetPass() {
        dataString = $("#update-user").serialize();

        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=8&n=1&uid=' . $uid . '",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html(\'<div class="successbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">User Updated Successfully!</div>\').slideDown(400).delay(1800).slideUp(400);
         } else {
         	 $("#failer").html(\'<div class="errorbox" style="margin-top:10px; margin-bottom:10px; text-align:center; font-weight:bolder">Please Enter A Valid Password!</div>\').slideDown(400);
         	 
         }
               
       }

        });
}
</script>';
	}// user != false

} // n == 1

exit();
}


?>

<script type="text/javascript">

$('#user-search').submit(function() {

$('#showresults').html('<br /><br /><br /><center><img src="/app/core/site_img/loading.gif" /></center>');

// THis needs to be changed to the location of the search.php file
dataString = $("#user-search").serialize();
request = $.ajax({
  url: "openSearch.cc?node=2",
  dataType: 'json',
  data: dataString,
  success: function(msg){
  		showResults(msg,$("#usersearch").val());
  	}
});
return false;
});

function showResults(data, highlight){
            if (data == null) {
            resultHtml = '<br /><br /><br /><center><span style="color:#666; font-size:16px">No users found. Try another search term.</span></center>';
            } else {
           var resultHtml = '';
            $.each(data, function(i,item){
                resultHtml+='<div style="border-bottom: 1px solid #ccc; margin-bottom:4px">';
                // show name
                resultHtml+='<div style="font-size:16px; font-weight:bolder; color:#333; padding-left:10px; padding-top:4px;"><a href="#" onClick="openBox(\'school-admin.cc?id=<?php echo $school['id']; ?>&s=8&n=1&uid='+item.id+'\', 400)">'+item.first_name.replace(highlight, '<span class="highlight">'+highlight+'</span>')+' '+item.last_name.replace(highlight, '<span class="highlight">'+highlight+'</span>')+'</a></div>';
                // email line
                resultHtml+='<div style="font-size:14px; color:#999; padding-left:10px; padding-bottom:4px">'+item.school_email.replace(highlight, '<span class="highlight">'+highlight+'</span>')+'</div>';
                
                resultHtml+='</div>';
            });
}
            $('div#showresults').html(resultHtml);
        }





$( "#opt" ).buttonset();
</script>


<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Manage Users</strong></div>

<form id="user-search" method="GET" action="#">
<div style="float:left; width:300px">
<span style="font-size: 20px">Find Users</span><br />
<input type="text" id="usersearch" name="usersearch" style="width:200px; padding:5px; float:left" /><button class="button" type="submit">Search</button>
</div>
<div id="opt">
<span style="font-size: 20px">Show me users that are...</span><br />
	<input type="checkbox" id="check1" name="verified" value="1" checked="checked" /><label for="check1">Verified</label>
	<input type="checkbox" id="check2" name="students" value="1" /><label for="check2">Students</label>
	<input type="checkbox" id="check3" name="teachers" value="1" /><label for="check3">Teachers</label>
	<input type="checkbox" id="check4"name="administrators" value="1" /><label for="check4">Administrators</label>
</div>
<input type="hidden" name="school" value="<?php echo $school['id']; ?>" />
</form>

<div id="showresults" style="margin-top:10px; border-top:2px solid #ccc; padding-bottom:10px;clear:both">
<br /><br /><br /><center><span style="color:#999; font-size:16px">Search for users using their name, email address or username.</span></center>
</div>