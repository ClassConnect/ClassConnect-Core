<?php require_once('foot.php'); ?>
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
        
        <li id="calculator"><a href="#" class="calculator">Calculator <small>Calculator</small></a>
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
        
         <li id="img_search"><a href="#" class="img_search">Image Search <small>Image Search</small></a> 
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

        <li id="feedback"><a href="#" class="feedback">Feedback <small>Feedback</small></a>
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


        <li id="helper"><a href="#" class="helper">Need help? <small>Need help?</small></a>
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
        	<a href="#" class="alerts">
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
<div id="growlNotify" class="jGrowl bottom-right"></div>
<?php if ($extLock != 1) { ?>
<iframe src="<?php echo $scriptServer; ?>ccrte.cc" width="1" height="1" style="display:none"></iframe>
<?php } ?>


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
mpmetrics.name_tag('<?php echo htmlentities($firstname) . ' ' . htmlentities($lastname); ?>');
mpmetrics.track("Button clicked"); 
</script>
        </body> 
</html>