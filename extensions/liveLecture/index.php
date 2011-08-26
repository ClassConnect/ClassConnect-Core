<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

$lectures = getLLCs($class_id);

echo '<cc:crumbs>LiveLecture</cc:crumbs>';

foreach($lectures as $llc) {
    if ($llc['active'] == 1) {
        $actives .= '<div id="forumEl">';

if ($class_level == 3) {
$actives .= '<div style="float:right">
<a href="edit.php?lid=' . $llc['lid'] . '" target="dialog" width="350"><img src="' . $imgServer . 'main/stop.png" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>End</small></a>

<a href="del.php?lid=' . $llc['lid'] . '" target="dialog" width="350"><img src="' . $imgServer . 'gen/delCircle.png" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>Delete</small></a>
</div>';
}
$actives .= '<div style="margin-left:15px;margin-right:10px;margin-top:5px;margin-bottom:5px;float:left; height:40px; width:40px; border:2px solid #999" class="bevColor fullRound"><img src="' . $imgServer . 'main/play.png" width="40" height="40" /></div>

<span class="forum_head" style="cursor:pointer"><a onClick="window.location = \'/app/livelecture/Presenter/index.php?lid=' . $llc['lid'] . '\'">' . $llc['title'] . '</a></span>
<br />
    <span style="color:#666; font-size:14px">Started at ' . date("g:ia", strtotime($llc['created'])) . ' on ' . date("F jS", strtotime($llc['created'])) . '</span>
</div>


<div class="forum_foot"></div>';
        
    } else {
        $archives .=  '<div id="forumEl">';
        if ($class_level == 3) {
$archives .= '<div style="float:right">
<a href="del.php?lid=' . $llc['lid'] . '" target="dialog" width="350"><img src="' . $imgServer . 'gen/delCircle.png" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>Delete</small></a>
</div>';
}

$archives .= '<div style="margin-left:15px;margin-right:10px;margin-top:5px;margin-bottom:5px;float:left; height:40px; width:40px; border:2px solid #999" class="fullRound"><img src="' . $imgServer . 'main/time.png" width="40" height="40" /></div>

<span class="forum_head" style="cursor:pointer"><a onClick="window.location = \'/app/livelecture/Presenter/index.php?lid=' . $llc['lid'] . '\'">' . $llc['title'] . '</a></span>
<br />
    <span style="color:#999; font-size:14px">' .  date("g:ia", strtotime($llc['created'])) . ' - ' .  date("g:ia", strtotime($llc['ended'])) . ' ' .  date("F jS, Y", strtotime($llc['ended'])) . '</span>
</div>


<div class="forum_foot"></div>';
    }

}


echo '<div id="llheader" style="padding-left:15px">';
if ($class_level == 3) {
    echo '<div style="margin-top:-3px;float:right; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px;border:1px solid #999 " class="bevColor fullRound"><a href="host.php" target="dialog" width="350" style="background:none">Host A LiveLecture</a></div>';
}
    echo '<img src="' . $imgServer . 'main/alert.png" style="margin-right:5px; float:left; margin-top:1px" /> Active LiveLectures</div>';
if (!empty($actives)) {
    echo $actives;
} else {
    echo '<div style="text-align:center; color:#999; font-size:14px; padding-top:5px">No active LiveLectures found</div>';
}

echo '<div id="llheader" style="margin-top:50px; padding-left:15px">Archived LiveLectures</div>';
if (!empty($archives)) {
    echo $archives;
} else {
    echo '<div style="text-align:center; color:#999; font-size:14px; padding-top:5px">No archived LiveLectures found</div>';
}


?>