<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<meta name="Description" content="App." />
<meta name="Keywords" content="keywords." />
<meta name="Distribution" content="Global" /> 
<meta name="Robots" content="index,follow" /> 
<link rel="stylesheet" href="<?php echo $scriptServer; ?>dynCSS.cc" type="text/css" />
<script type="text/javascript" src="<?php echo $scriptServer; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo $scriptServer; ?>siteFunctions.js"></script>
<script type="text/javascript" src="<?php echo $scriptServer; ?>menuSys.js"></script>
<script type="text/javascript" src="<?php echo $scriptServer; ?>growl.js"></script>
<script type="text/javascript" src="<?php echo $scriptServer; ?>jqueryUI.js"></script>
<?php if ($extLock != 1) { ?>
<script type="text/javascript" src="<?php echo $scriptServer; ?>footPanel.js"></script>
<?php }
foreach ($scriptArr as $script) {
	echo '<script type="text/javascript" src="' . $script . '"></script>';
}
?>
 
<title>ClassConnect | <?php echo $page_title; ?></title>	
 
</head> 
 
<body> 
<!-- wrap starts here --> 
<div id="wrap"> 

<?php if ($extLock != 1) { ?>
 
		<!-- header --> 
		<div id="header">
       
<ul class="topnav">
<?php
$padding = round((40 - $theme['logoHeight'])/2, 0);
?>
<li class="logo"><img src="<?php echo $imgServer; ?>client_img/school/<?php echo $theme['settingLogo']; ?>" style="padding-left:2px;padding-top:<?php echo $padding; ?>px" /></li>
<li style="border-left:1px solid #999"><a href="home.cc">Home</a></li>
<li>
<div>
	<a class="getme" href="#"><img src="<?php echo $imgServer; ?>header/classes.png" style="float:left;height:20px;padding-right:5px;padding-top:2px;" /> Classes</a> 
	<ul class="subnav">
    	<?php
		foreach($myClasses as $class) {
			echo '<li><a href="class.cc?id=' . $class['id'] . '"><img src="' . $iconServer . $class['prof_icon'] . '" style="float:left;height:20px;padding-right:5px;" />' . $class['name'] . '</a></li>';
		} 
		if (empty($myClasses)) {
			echo '<li><a href="#">No Active Classes Found</a></li>';
		}		
		?>
    </ul>
</div>
</li>

<li>
<div>
	<a class="getme" href="#"><img src="<?php echo $imgServer; ?>header/horn.png" style="float:left;height:20px;padding-right:5px;padding-top:2px;" /> Schools</a> 
	<ul class="subnav">
    	<?php
		foreach($mySchools as $school_ID) {
			echo '<li><a href="school.cc?id=' . $school_ID['id'] . '"><img src="' . $imgServer . 'client_img/school/' . $school_ID['settingLogo'] . '" style="float:left;height:20px;padding-right:5px;padding-top:2px;" />' . $school_ID['name'] . '</a></li>';
		} 
		if (empty($mySchools)) {
			echo '<li><a href="#">No Active Classes Found</a></li>';
		}		
		?>
    </ul>
</div>
</li>

<li><div><a class="getme" href="#"><img src="<?php echo $imgServer; ?>header/apps.png" style="float:left;height:20px;padding-right:5px;padding-top:2px;" /> Apps</a>
<ul class="subnav">
<li><a href="filebox.cc">
        <img src="<?php echo $imgServer; ?>header/fbox.png" style="float:left;height:20px;padding-right:5px;" />
        <div style="margin-top:-5px; margin-bottom:-5px; margin-left:30px; width:137px">FileBox
        <div style="color:#666; font-size:10px;margin-top:-5px">Store files, videos, and more.</div></div>
    </a></li>
<li><a href="searchBox.cc">
        <img src="<?php echo $imgServer; ?>header/sbox.png" style="float:left;height:20px;padding-right:5px;margin-top:-1px" />
         <div style="margin-top:-5px; margin-bottom:-5px; margin-left:30px; width:137px">SearchBox
        <div style="color:#666; font-size:10px;margin-top:-5px">Educational search engine.</div></div>

    </a></li>
<li><a href="writer.cc">
        <img src="<?php echo $imgServer; ?>header/docs.png" style="float:left;height:20px;padding-right:5px;" />
           <div style="margin-top:-5px; margin-bottom:-5px; margin-left:30px; width:137px">Docs
        <div style="color:#666; font-size:10px;margin-top:-5px">Create & edit documents.</div></div>
    </a></li>
<li><a href="presentations.cc">
         <img src="<?php echo $imgServer; ?>header/presentation.png" style="float:left;height:20px;padding-right:5px;margin-top:-1px" />
           <div style="margin-top:-5px; margin-bottom:-5px; margin-left:30px; width:137px">Presentations
       <div style="color:#666; font-size:10px;margin-top:-5px">Create & edit presentations.</div></div>
</a></li>
        </ul></div></li>
<li><div><a class="getme" href="#"><img src="<?php echo $imgServer; ?>header/settings.png" style="float:left;height:20px;padding-right:5px;padding-top:2px;" /> Settings</a>

<ul class="subnav">
    <li><a href="settings.cc">Account Settings</a></li>
   <li><a href="manage-classes.cc">Manage Classes / Schools</a></li>
</ul>
</div></li>

<li style="float:right;border-right:none;border-left:1px solid #999"><a href="logout.cc"><img src="<?php echo $imgServer; ?>header/logout.png" style="float:left;height:20px;padding-right:5px;padding-top:2px;" /> Logout</a></li>
</ul>
       
       </div><!-- header end -->
<?php } ?>