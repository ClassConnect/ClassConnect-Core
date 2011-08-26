<?php
require_once('core/inc/coreInc.php');
require_once('extensions/classPage/core/main.php');
requireSession();


function genDay($position) {
 global $myClasses;
 global $user_id;
 global $imgServer;

 if (isset($position)) {
     if ($position > 0) {
         $position = '+' . $position;
     }
     $dayStr = $position . ' day';
     $ts = strtotime($dayStr, date('U'));
     $agenda = todayAgenda($user_id, $myClasses, $ts);
     $now = $ts;
     
 } else {
    $agenda = todayAgenda($user_id, $myClasses);
    $now = date('U');
 }

$total .= '<div class="head"><span style="float:right">
            <a href="#" onClick="window.print()"><img src="' . $imgServer . 'gen/print.png" style="width:16px; height:16px; padding-top:3px; margin-right:5px"/></a>
            <a href="#" onClick="swapDay(' . ($position - 1) . ')"><img src="' . $imgServer . 'gen/left.png" style="width:16px; height:16px; padding-top:3px; margin-right:-4px"/></a>
            <a href="#" onClick="swapDay(' . ($position + 1) . ')"><img src="' . $imgServer . 'gen/right.png" style="width:16px; height:16px; padding-top:3px"/></a>
</span>Your agenda for ' . date("l, F jS", $now) . '</div>
    <table id="agenda">
<tr>
    <th style="border-left:none">&nbsp;</th>
  <th>Assignments</th>
  <th>Projects</th>
  <th>Tests</th>
  <th>Events</th>
</tr>';

foreach ($myClasses as $cls) {
    $tests = ''; $projects = ''; $events = ''; $asmts = '';
    foreach ($agenda as $entry) {
        if ($cls['id'] == $entry['class_id']) {

        if ($entry['type'] == 1){
            $asmts .= ' <div class="asmtEvent" style="color:#fff; border-top:1px solid #999; width:100%"><span style="padding-left:4px"><a href="#" title="<strong>' . $entry['title'] . '</strong><br /><br />' . $entry['body'] . '">' . substr($entry['title'], 0, 12) . '...</a></span></div>';
        } elseif ($entry['type'] == 2){
            $projects .= ' <div class="projEvent" style="color:#fff; border-top:1px solid #999; width:100%"><span style="padding-left:4px"><a href="#" title="<strong>' . $entry['title'] . '</strong><br /><br />' . $entry['body'] . '">' . substr($entry['title'], 0, 12) . '...</a></span></div>';
        } elseif ($entry['type'] == 3){
            $tests .= ' <div class="testEvent" style="color:#fff; border-top:1px solid #999; width:100%"><span style="padding-left:4px"><a href="#" title="<strong>' . $entry['title'] . '</strong><br /><br />' . $entry['body'] . '">' . substr($entry['title'], 0, 12) . '...</a></span></div>';
        } elseif ($entry['type'] == 4){
            $events .= ' <div class="eventEvent" style="color:#fff; border-top:1px solid #999; width:100%"><span style="padding-left:4px"><a href="#" title="<strong>' . $entry['title'] . '</strong><br /><br />' . $entry['body'] . '">' . substr($entry['title'], 0, 12) . '...</a></span></div>';
        }

        }

    }


    $total .= '<tr>
<td  style="border-left:none; color:#666; width:80px; padding:5px">' . $cls['name'] . '</td>';

$total .= '<td style="width:95px;vertical-align:top">
    ' . $asmts . '

</td>

<td style="width:95px;vertical-align:top">
    ' . $projects . '

</td>

<td style="width:95px;vertical-align:top">
    ' . $tests . '

</td>

<td style="width:95px;vertical-align:top">
    ' . $events . '

</td>

</tr>';
}


$total .= '</table>
    <script>
        $(document).ready(function()
{
onRun();

});
</script>';

return $total;
}

if (isset($_GET['n'])) {
    if ($_GET['n'] == 1) {
        echo genDay(escape($_GET['pos']));
    } elseif ($_GET['n'] == 2) {
        if ($level == 3) {
        require_once('extensions/classPage/core/main.php');
        $message = escape($_POST['message']);
        $classList = $_POST['classes'];

        foreach ($classList as $classID) {
            if (authClass($classID)) {
                addComment($message, $user_id, 3, $classID);
                $classData = getClass($classID);
                //// send notification
                sendClassNotification($classID, $classData['name'] . ' has just posted a <a href="class.cc?id=' . $classID . '">new update.</a>');
            }
        }


       echo '1';

        } // level == 3
    }
exit();
}

$page_title = "Home";
$scriptArr[] = $scriptServer . 'qtip.js';
require_once('core/template/head/header.php');

if (empty($myClasses)) {
    if ($level == 3) {
        
    echo '
    <center><br /><br /><br /><br /><br /><div style="border:1px solid #999; padding:30px; background-color:#eeeeee; width:540px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: -2px 0 2px #999; -webkit-box-shadow: 0 0 2px #999; box-shadow: 0 0 4px #999;"><span style="font-size:26px; font-weight:bolder; color:#666">Welcome to ClassConnect, ' . $firstname . '!</span>

    <p id="reShow" style="font-size:16px">';

    if ($_SESSION['wizard'] == 1) {
        echo 'Use the panel on the right to get started!';
    } else {

        echo '<a class="button" href="#" style="margin-left:110px" onClick="initWiz();$(this).parent().after(\'<br /><br /><img id=\\\'RMimg\\\' src=\\\'/app/core/site_img/loading.gif\\\' />\');$(this).parent().hide();">Need help getting started with ClassConnect?</a><br />';
    }

    echo '</p></div></center>';

    } elseif ($level == 1) {
        echo '
    <center><br /><br /><br /><br /><br /><div style="border:1px solid #999; padding:30px; background-color:#eeeeee; width:540px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: -2px 0 2px #999; -webkit-box-shadow: 0 0 2px #999; box-shadow: 0 0 4px #999;"><span style="font-size:26px; font-weight:bolder; color:#666">Welcome to ClassConnect, ' . $firstname . '!</span>

    <p id="reShow" style="font-size:14px">Looks like you aren\'t enrolled in any classes! To enroll in a class, go to the <a href="manage-classes.cc">Manage Classes / Schools</a> oage.</p></div></center>';
    }
} else {

$upcomingWeek = weekAgenda($user_id, $myClasses);
?>

<div id="home-left">
    <h1>Upcoming</h1>

 <?php
 $orgev = array();
 $today = date("Y-m-d");
 
 foreach ($upcomingWeek as $item) {
     $startDate = date("Y-m-d", strtotime($item['start_date']));
     $endDate = date("Y-m-d", strtotime($item['end_date']));
     foreach ($myClasses as $tempClass) {
         if ($tempClass['id'] == $item['class_id']) {
             $classData = $tempClass;
         }
     }
     if ($item['type'] == 2) {
         $typer = 'Project';
     } elseif ($item['type'] == 3) {
         $typer = 'Test';
     }

     if ($item['body'] != '') {
         $item['body'] = '<br /><br />' . $item['body'];
     }

     if ($startDate >= $today) {
         if ($startDate == $endDate) {
             $orgev[$endDate] .= '"' . $item['title'] . '(--)<strong>' . $item['title'] . '</strong><br /><span style=\'font-size:9px\'>' . $typer . ' - ' . $classData['name'] . '</span>' . $item['body'];
         } else {
             $orgev[$startDate] .= '"' . $item['title'] . ' (start)(--)<strong>' . $item['title'] . '</strong><br /><span style=\'font-size:9px\'>' . $typer . ' - ' . $classData['name'] . '</span>' . $item['body'];
             $orgev[$endDate] .= '"' . $item['title'] . ' (end)(--)<strong>' . $item['title'] . '</strong><br /><span style=\'font-size:9px\'>' . $typer . ' - ' . $classData['name'] . '</span>' . $item['body'];
         }

     } elseif ($endDate >= $today) {
         $orgev[$endDate] .= '"' . $item['title'] . ' (end)(--)<strong>' . $item['title'] . '</strong><br /><span style=\'font-size:9px\'>' . $typer . ' - ' . $classData['name'] . '</span>' . $item['body'];
     }
 }

ksort($orgev);
 foreach ($orgev as $key => $eventer) {
     echo '<div style="margin-top:10px; margin-left:3px; color:#666; border-bottom:1px solid #ccc;margin-bottom:5px; font-size:12px">' . date("l, F jS", strtotime($key)) . '</div>
         <div class="eventsList">';
     $str = explode('"', $eventer);
     foreach ($str as $data) {
         $cleanData = explode('(--)', $data);
         if ($cleanData[0] != '') {
            if (strpos($cleanData[1], 'Project')) {
                $image = 'project.png';
            } else {
                $image = 'paper.png';
            }

            echo '<li style="margin-bottom:4px"><a href="#" title="' . $cleanData[1] . '"><img src="' . $imgServer . 'main/' . $image . '" style="float:left; margin-right:5px; margin-left:5px" />' . $cleanData[0] . '</a></li>';
         }
     }
     echo '</div>';
 }


 if(empty($upcomingWeek)){
     echo '<p style="color:#999">No upcoming tests / projects found</p>';
 }
 ?>


</div>

<div id="home-main">
<?php if($level == 3) { ?>
<!--[if IE 7]><style type="text/css">
.addStatus{
            margin-right:95px;
        }
#message_wall {
    margin-left:-12px;
}
        </style>
<![endif]--> 
    <div class="addStatusBox">


<form method="POST" action="home.cc?n=2" id="update-status">

<div id="updateBox" style="width:435px;margin-left:13px;margin-top:10px;clear:both">
<input type="text" class="inputBox" id="message_wall" name="message" value=" post an update to your classes..." style="color:#999;font-style:italic;width:422px" onClick="$(this).attr('style', 'width:422px'); if ($(this).val() == ' post an update to your classes...') { $(this).val(''); }" /><br />
<input type="submit" name="submit" value="Submit" class="postButton" style="float:right; margin-top:10px; margin-right:-5px" />
</div>

<div style="margin-top:5px">
<div class="addStatus genButBkg">Choose classes...</div>
    <div class="chooseClassesBox">
    <div style="float:left; margin-left:1px;margin-top:-4px; background:#fff;height:4px; width:115px;"></div>
        <div id="classButtons" style="padding:5px">
 <?php
foreach ($myClasses as $teClass) {
    echo '<input type="checkbox" name="classes[]" id="classOpt' . $teClass['id'] . '" value="' . $teClass['id'] . '" /><label for="classOpt' . $teClass['id'] . '" class="fullRound" style="margin-left:7px; margin-bottom:4px;width:175px">' . $teClass['name'] . '</label>';
}
?>
</div>


    </div>
</div>

</form>
        <div style="clear:both"></div>
    </div>

<div style="background-color:#ccc;height:1px;width:498px;margin-left:-25px;margin-bottom:20px"></div>
<?php } ?>
    <div id="agendaview">

<?php  
    echo genDay();
?>
    </div>

<div style="margin-top:20px; padding:5px; text-align:right"><a href="manage-classes.cc" style="color:#999; font-style:italic; text-decoration: underline">Add & manage your classes...</a></div>
</div>



<div id="home-right">
<?php if($level == 1) { ?>
    <h1>Latest Updates</h1>
<?php
foreach ($myClasses as $tClass) {
    $update = getUpdate($tClass['id']) ;
    if ($update['body'] != '') {
        $text = substr($update['body'], 0, 60) . '...';
    } else {
        $text = '<span style="color:#999">No updates found for this class.</span>';
    }
    echo '<div id="statusWrapper">
        <div class="homeStatus" onClick="window.location = \'class.cc?id=' . $tClass['id'] . '\';">

<img src="' . $iconServer . $tClass['prof_icon'] . '" style="width:24px; height:24px; float:left; margin-right:4px; margin-top:6px"/>
        <span style="font-size:12px; color:#666">' . $tClass['name'] . '</span><br /><span id="classText' . $tClass['id'] . '">' . $text . '</span>


</div>
</div>';
}

if (empty($myClasses)) {
    echo '<p style="color:#999">No classes found</p>';
}


?>
<?php } elseif($level == 3) { ?>
<h1>Do you like ClassConnect?</h1>
<div style="padding-left:10px;padding-top:10px;font-size:12px;color:#666;line-height:100%">
Invite your colleagues to use ClassConnect in their classroom!
<button class="button" type="submit" style="margin-top:10px;margin-left:15px" onClick="openBox('/app/core/ajax/barjax/invite.cc',450);">
<img src="<?php echo $imgServer; ?>gen/email.png"> Invite colleagues</button>
</div>

<h1 style="margin-top:80px">Need help?</h1>
<div style="padding-left:10px;padding-top:7px;font-size:11px;color:#666;line-height:120%">Use our <a href="#" onClick="initWiz();$(this).parent().after('<center><img id=\\\'RMimg\\\' src=\'/app/core/site_img/loading.gif\' style=\'padding-top:15px\' /></center>');$(this).parent().hide();">interactive tutorial</a> to learn how to use features on ClassConnect.<br /><br />
You can also contact us by either emailing <a href="mailto:support@classconnect.com">support@classconnect.com</a> or by calling (866) 844-5250! 
</div>
<?php } ?>
</div>

<script>
    function onRun() {
       $('#agenda a[title]').qtip({
   style: {
      classes: 'ui-tooltip-dark'
   }
   });


   $('#home-left a[title]').qtip({
   style: {
      classes: 'ui-tooltip-dark'
   },
   position: {
      my: 'center left',  // Position my top left...
      at: 'center right'
   }
   });


   $(".homeStatus").hover(
    	//	In
    	function() {
$(this).addClass('floatingStatus');
    	},
    	//	Out
    	function(){
$(this).removeClass('floatingStatus');
    	}
    );

}

    $(document).ready(function(){
onRun();
initStatFunc();
statText = $(".addStatusBox").html();


});



    function swapDay(dir) {
    $("#agendaview").html('<div class="dayLoader"><img src="<?php echo $imgServer; ?>sBoxLoad.gif" /></div>' + $("#agendaview").html());
        $.ajax({
        type: "GET",
        url: 'home.cc?n=1&pos=' + dir,
        success: function(conf) {
               $("#agendaview").html(conf).fadeIn(200);
        }

        });


    }


function initStatFunc() {
     $(function(){
        $("#update-status").submit(function(){
            message = $("#message_wall").val();
            $("input:checkbox[name='classes\\[\\]']:checked").each(function () {
            $("#classText" + $(this).val()).html(message);
             });
            dataString = $("#update-status").serialize();
            $(".addStatusBox").html('<br /><br /><center><img src="<?php echo $imgServer; ?>loading.gif" /></center><br /><br />');
            $.ajax({
            type: "POST",
            url: "home.cc?n=2",
            data: dataString,
            success: function(data) {
                $(".addStatusBox").html(statText);
                $(".addStatusBox").prepend('<div id="successleave" class="successbox" style="text-align:center;width:420px;margin-left:15px">Your update has been sent successfully!</div>');
                $("#successleave").delay(1100).slideUp(300);
                initStatFunc();

            }

            });

            return false;

        });
    });


            $('.addStatus').click(function() {
          if ($(this).hasClass('addStatusActive')) {
            $(this).removeClass('addStatusActive');
            $('.chooseClassesBox').hide();
            $(this).addClass('genButBkg');
            $(this).removeClass('genButBkgAct');
           } else {
        $(this).addClass('addStatusActive');
        $('.chooseClassesBox').show();
        $(this).removeClass('genButBkg');
        $(this).addClass('genButBkgAct');
           }
        });

        $( "#classButtons" ).buttonset();
}
    
</script>
<?php
}
require_once('core/template/foot/footer.php');
?>