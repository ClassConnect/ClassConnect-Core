<?php
$sid = $school['id'];
if (isset($_GET['n']) && is_numeric($_GET['n'])) {

if ($_GET['n'] == 1) {
    require_once('pol/applications.php');

}

exit();
} // isset and is_numeric n

?>


<div id="navcrumbs"><a href="school.cc?id=<?php echo $school['id']; ?>"><?php echo $school['name']; ?></a> <img src="<?php echo $imgServer; ?>main/l_arrow.png" /> <strong>Class Policies</strong></div>

<p style="padding-top:10px; border-top:1px solid #ccc">
    <img src="<?php echo $imgServer; ?>main/apps.png" style="float:left; margin-left:7px;  margin-top:4px; margin-right:13px" />
    <span style="font-size: 20px"><a href="#" onClick="openBox('school-admin.cc?id=<?php echo $school['id']; ?>&s=13&n=1', 450); return false">Applications</a></span><br />
    <span style="font-size:14px; color: #666">Set policies for class based applications such as the Forum and Calendar.</span>
</p>





