<?php
$sid = $school['id'];
if (isset($_GET['n']) && is_numeric($_GET['n'])) {

if ($_GET['n'] == 1) {
    require_once('pol/teacherSignup.php');
	
} elseif ($_GET['n'] == 2) {
    require_once('pol/studentSignup.php');

 } elseif ($_GET['n'] == 3) {
    require_once('pol/signupSwap.php');

 } elseif ($_GET['n'] == 4) {
    require_once('pol/communication.php');

 } elseif ($_GET['n'] == 5) {
    require_once('pol/applications.php');

}

exit();
} // isset and is_numeric n

?>


<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>User Policies</strong></div>

<p style="padding-top:10px; border-top:1px solid #ccc">
    <img src="<?php echo $imgServer; ?>main/signup.png" style="float:left; margin-top:5px; margin-right:10px" />
    <span style="font-size: 20px"><a href="#" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=9&n=3', 518); return false">Account Creation</a></span><br />
    <span style="font-size:14px; color: #666">Configure how your students and teachers create their ClassConnect accounts.</span>
</p>

<p style="padding-top:10px; border-top:1px solid #ccc">
    <img src="<?php echo $imgServer; ?>main/comm.png" style="float:left;  margin-right:10px" />
    <span style="font-size: 20px"><a href="#" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=9&n=4', 450); return false">Communication</a></span><br />
    <span style="font-size:14px; color: #666">Set policies for user-to-user communication on ClassConnect.</span>
</p>

<p style="padding-top:10px; border-top:1px solid #ccc">
    <img src="<?php echo $imgServer; ?>main/apps.png" style="float:left; margin-left:7px;  margin-top:4px; margin-right:13px" />
    <span style="font-size: 20px"><a href="#" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=9&n=5', 450); return false">Applications</a></span><br />
    <span style="font-size:14px; color: #666">Set policies for user based applications such as SearchBox and FileBox.</span>
</p>





