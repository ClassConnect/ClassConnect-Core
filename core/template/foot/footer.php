<div id="dialogBox"></div><div id="blackbox"></div><div id="clearbox"></div><div id="wizfill"></div>
<?php
// check for a wizard session
if ($_SESSION['wizard'] == 1) {
    echo '<div id="wizthing" onClick="tempEr();" class="schColor"><img src="' . $imgServer . 'main/gs.png" style="margin-left:8px;padding-top:10px" /></div>
<div id="wizpnel">
<div class="wizShade"><div class="wizLdr"><img src="' . $imgServer . 'sBoxLoad.gif" /></div></div>';


$genSty = ' style="text-decoration: line-through;"';

// show create classes
if (!empty($myClasses)) {
    $createSty = $genSty;
}
// detect if we've visited filebox
if ($_SESSION['wizViz']['filebox'] == 1) {
    $fboxSty = $genSty;
}
// detect if we've visited filebox
if ($_SESSION['wizViz']['class'] == 1) {
    $classSty = $genSty;
}
// detect if we've visited filebox
if ($_SESSION['wizViz']['presentations'] == 1) {
    $presSty = $genSty;
}
// detect if we've visited filebox
if ($_SESSION['wizViz']['writer'] == 1) {
    $docSty = $genSty;
}
// detect if we've visited filebox
if ($_SESSION['wizViz']['searchBox'] == 1) {
    $sboxSty = $genSty;
}


    echo '
<div class="wizcol wizTop">Here are the basics for getting started with ClassConnect.</div>

<div class="wizDiv"' . $createSty . '>
    <span class="wizBld">1.&nbsp;&nbsp;<a href="#" onClick="initWiz(1);">Create your classes</a></span>
    <div class="sgtx">It takes just a few clicks to create your classes. Your students can join a class by using its access code.</div>
</div>

<div class="wizDiv"' . $fboxSty . '>
    <span class="wizBld">2.&nbsp;&nbsp;<a href="#" onClick="initWiz(2);">Add & organize class content</a></span>
    <div class="sgtx">Upload files, bookmark websites, organize content into folders, and then share class content with all your classes with just a click.</div>
</div>
<div class="wizDiv"' . $classSty . '>
    <span class="wizBld">3.&nbsp;&nbsp;<a href="#" onClick="initWiz(3);">Manage a class page</a></span>
    <div class="sgtx">Your classes have their own individual "pages" where you can post updates, manage the class calendar, open forums and start lectures.</div>
</div>
<div class="wizDiv" style="font-weight:bolder;margin-top:30px">Want to try some cool tools?</div>
<div style="margin-left:20px; margin-top:5px">
    <li><a href="#" onClick="initWiz(4);"' . $presSty . '>Create & deliver an interactive lecture</a></li>
    <li><a href="#" onClick="initWiz(5);"' . $docSty . '>Create & edit documents</a></li>
    <li><a href="#" onClick="initWiz(6);"' . $sboxSty . '>Find & save content</a></li>
</div>
<div style="margin-top:60px;font-size:12px">
    <div class="wizcol wizEx"><a href="#" style="color:#fff;font-weight:bolder" onClick="endWiz();">End the \'Getting Started\' wizard</a></div>
    <div style="padding-top:5px;padding-left:17px;color:#666">Done with these steps?</div>
</div>
</div>';
echo '<script type="text/javascript" src="' . $scriptServer . 'guider.js"></script>';
echo '<script>
 $(document).ready(function() {';
require_once('core/ajax/barjax/wizard/main.php');
echo ' });</script>';
}
?>
</div><!-- wrap ends here --> 

<?php if ($extLock != 1) { ?>
<div style="clear:both; margin-top:20px"></div>
<!-- footer starts here --> 
   <div id="footpanel"> 
    <ul id="mainpanel">     
        <li><a href="msg.cc" class="home"><div style="float:left; padding-top:1px">Inbox</div> 
                <?php
$totalNot = getNumMsgs($user_id);
if ($totalNot > 0) {
    $class = 'hasMsg';
} else {
    $class = 'noMsg';
}
echo '<div id="msgCount" class="' . $class . '">' . $totalNot . '</div>';
?>    
                <small>Messages</small></a></li>
        
        <li id="calculator"><a class="calculator">Calculator <small>Calculator</small></a>
        <div class="subpanel"> 
            <h3><span> &ndash; </span> Calculator</h3>
             <ul>
           <FORM NAME="Calc" onSubmit="Calc.Input.value = eval(Calc.Input.value); return false;">
<div style="text-align:center;margin-top:5px;margin-bottom:5px">
<INPUT TYPE="text"   NAME="Input" style="width:170px">
</div>

<div style="text-align:center">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="one"   VALUE="  1  " OnClick="Calc.Input.value += '1'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="two"   VALUE="  2  " OnCLick="Calc.Input.value += '2'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="three" VALUE="  3  " OnClick="Calc.Input.value += '3'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="plus"  VALUE="  +  " OnClick="Calc.Input.value += ' + '">
</div>
<div style="text-align:center">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="four"  VALUE="  4  " OnClick="Calc.Input.value += '4'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="five"  VALUE="  5  " OnCLick="Calc.Input.value += '5'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="six"   VALUE="  6  " OnClick="Calc.Input.value += '6'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="minus" VALUE="  -  " OnClick="Calc.Input.value += ' - '">
</div>
<div style="text-align:center">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="seven" VALUE="  7  " OnClick="Calc.Input.value += '7'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="eight" VALUE="  8  " OnCLick="Calc.Input.value += '8'">
<INPUT TYPE="button"  style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="nine"  VALUE="  9  " OnClick="Calc.Input.value += '9'">
<INPUT TYPE="button"  style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="times" VALUE="  x  " OnClick="Calc.Input.value += ' * '">
</div>
<div style="text-align:center">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="clear" VALUE="  c  " OnClick="Calc.Input.value = ''">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="zero"  VALUE="  0  " OnClick="Calc.Input.value += '0'">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="DoIt"  VALUE="  =  " OnClick="Calc.Input.value = eval(Calc.Input.value)">
<INPUT TYPE="button" style="margin-right:5px; width:40px; color:#fff" class="bevColor" NAME="div"   VALUE="  /  " OnClick="Calc.Input.value += ' / '">
<div>
</FORM>
             </ul>
            </div>
        
        </li>
        
         <li id="img_search"><a class="img_search">Image Search <small>Image Search</small></a> 
        <div class="subpanel" style="width:520px"> 
            <h3><span> &ndash; </span> Image Search</h3>
             <ul>
             
             <div style="margin-top:5px; margin-left:5px; margin-bottom:10px">
             <?php
             if (checkAppPol(7, 2)) {
                 ?>
             
             <form id="imgSearcher">
             <input type="text" name="query" style="width:395px; margin-top:3px"><?php echo '<button class="button" type="submit" style="float:right"><img src="' . $imgServer . 'gen/search.png" />Search</button>';?>
             </form>
             </div>
             
            <div id="imgSearchResults" style="height:250px; text-align:center; color:#666; font-size:16px; overflow-y:scroll"><br /><br /><br /><br /><span style="font-weight:bolder">Type in a query above to find images.</span><br /><br />Click and drag an image to place it in a text area.</div>
            <?php
             } else {
                 echo '<br /><br /><center><span style="font-size:16px; text-align:center; color:#666">Image Search is not allowed by your school.</span></center><br /><br />';
             } ?>
             </ul>
            </div>
        
        </li>

        <li id="feedback"><a class="feedback">Feedback <small>Feedback</small></a>
            <div class="subpanel" style="width:400px">
            <h3><span> &ndash; </span> Send Us Feedback</h3>
             <ul >

             <div id="feedbackDiv" style="margin-top:5px; margin-left:5px;">

             
             <div style="font-size:14px; color:#666; padding:10px">Have a question, comment, or concern? We'd love to hear it! Leave your comments below and we'll respond ASAP.</div>
             <form id="feedbackForm">
                 <textarea name="body" style="width:360px; height:50px; margin-bottom:5px;margin-left:10px"></textarea><br />
             <?php echo '<button class="button" type="submit" style="float:right;margin-bottom:4px"><img src="' . $imgServer . 'gen/email.png" /> Send Feedback</button>';?>
             </form>
             </div>
<br /><br />
             </ul>
            </div>
        </li>


        <li id="helper"><a class="helper">Need help? <small>Need help?</small></a>
            <div class="subpanel" style="width:230px">
            <h3><span> &ndash; </span> Live Helper</h3>
             <ul >
             <div id="helperDiv" style="margin-top:5px; margin-left:5px;">



<br /><br />
</div>
             </ul>
            </div>
        </li>


        <li id="alertpanel"> 
            <a class="alerts">
<?php
$totalNot = getNumNotifications($user_id);
if ($totalNot > 0) {
    $class = 'hasNot';
} else {
    $class = 'noNot';
}
echo '<div id="notCount" class="' . $class . '">' . $totalNot . '</div>';
?>          
<small>Notifications</small></a> 
 
            <div class="subpanel"> 
            <h3><span> &ndash; </span>Notifications</h3> 
            <ul id="notiBar"> 
                
 
            </ul> 
            </div> 
        </li>

<?php
if (getNumLLs($user_id, $myClasses) == 0) {
    $styler = 'style="display:none"';
    } else {
        echo '<script>
 $(document).ready(function() {
   animateLL();
});

</script>';
    }
    ?>
        <li id="livelecture" class="bevColor fullRound" <?php echo $styler; ?>><a href="#" class="livelecture">You Have Active LiveLectures</a>
        <div class="subpanel" style="width:255px">
            <h3><span> &ndash; </span>Active LiveLectures</h3>
             <ul id="LLCcontent">
            <p>&nbsp;</p>
             </ul>
            </div>

        </li>
       <!--  <li id="chatpanel"> 
                        <a href="#" class="chat">Contacts (<strong>0</strong>) </a> 
            <div class="subpanel"> 
            <h3><span> &ndash; </span>Your Contacts</h3> 
 
           <ul> 
            <li><a href="#"><img src="user_img/0.png" width="22" height="22" alt="" /> John Beasly</a></li><li><a href="#"><img src="user_img/0.png" width="22" height="22" alt="" /> Tom Anderson</a></li><li><a href="#"><img src="user_img/32703.png" width="22" height="22" alt="" /> Eric Simons</a></li>            </ul>  
            </div> 
        </li>  -->
        
        
    </ul> 
</div><br /><br /> 


<!-- old footer was here --> 
<div id="growlNotify" class="jGrowl bottom-right"></div>
<iframe src="<?php echo $scriptServer; ?>ccrte.cc" width="1" height="1" style="display:none"></iframe>
<?php } ?>

<?php if ($extLock != 1) { ?>
<!-- First include the script: -->
<script type="text/javascript">
var mp_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
document.write(unescape("%3Cscript src='" + mp_protocol + "api.mixpanel.com/site_media/js/api/mixpanel.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<!-- Initialize it with your project token -->
<script type="text/javascript">
try {
    var mpmetrics = new MixpanelLib("583aeb01c87578bc7d789a522ff2347e");
} catch(err) {
    var null_fn = function () {};
    var mpmetrics = { 
        track: null_fn, 
        track_funnel: null_fn, 
        register: null_fn, 
        register_once: null_fn,
        register_funnel: null_fn,
        identify: null_fn
    };
}

mpmetrics.identify('<?php echo $user_id; ?>');
mpmetrics.name_tag('<?php echo $level . ' - ' . htmlentities($firstname) . ' ' . htmlentities($lastname); ?>');
</script>
<?php } ?>
        </body> 
</html>