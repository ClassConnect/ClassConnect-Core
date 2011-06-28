<?php
// include core stuff
require_once('../../core/inc/coreInc.php');
// app extension file
require_once('../core/main.php');
// local extension file
require_once('core/main.php');

echo '<cc:crumbs>Forum</cc:crumbs>
		  
  <div class="listView">';
    if ($class_level == 3) {
  echo '<a href="add.php"><div class="forum_load" style="border: 1px solid #999">
  <div style="padding-left:250px"><img src="' . $imgServer . 'gen/add_l.png" style="float:left; margin-top:8px; height:24px; margin-right:5px" /> <div class="load_text">Create Forum Thread</div></div>
    </div></a>';
    }
   echo '<div style="clear:left"></div>';
   
   // load our forums
   $forums = listForums($class_id);
   foreach($forums as $forum) {
   	if ($forum['locked'] == 1) {
   		$img = 'forum_open.png';
   		$lockTog = 'Lock';
   		$togImg = 'lock_s.png';
   	} else {
   		$img = 'forum_lock.png';
   		$lockTog = 'Unlock';
   		$togImg = 'unlock_s.png';
   	}
   	echo '<div id="forumEl">';
   	
if ($class_level == 3) {
echo '<div style="float:right">
<a href="edit.php?fid=' . $forum['forum_id'] . '"><img src="' . $imgServer . 'gen/change.png" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>Edit</small></a> 

<a href="lockTog.php?fid=' . $forum['forum_id'] . '" target="dialog" width="350"><img src="' . $imgServer . 'main/' . $togImg . '" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>' . $lockTog . '</small></a> 

<a href="del.php?fid=' . $forum['forum_id'] . '" target="dialog" width="350"><img src="' . $imgServer . 'gen/delCircle.png" height="16" style="padding:3px; border: 1px solid #ccc; margin-top:3px; margin-right:3px" border="0" /><small>Delete</small></a>
</div>';
}   	
   	
   	 
echo '<div style="margin-left:10px;margin-right:10px;margin-top:5px;margin-bottom:5px;float:left; height:40px; width:40px; background: url(\'' . $imgServer . 'main/' . $img . '\');"></div><span class="forum_head"><a href="forum.php?fid=' . $forum['forum_id'] . '">' . $forum['title'] . '</a></span>
<br />
    <div class="forum_peek">' . substr(strip_tags(reverse_htmlentities($forum['body'])), 0, 100) . '...</div>
</div>';

   
   		echo '<div class="forum_foot"></div>';
   	
   	
   }

	// if no forums
	if (empty($forums)) {
		echo '<div style="text-align:center; padding-top:10px; padding-bottom:10px; font-size:14px">No forums were found for this class.</div>';
		
	}

echo '</div>';
?>