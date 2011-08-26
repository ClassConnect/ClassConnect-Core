<?php
require_once('core/inc/coreInc.php');
requireSession();
// define appid and app type
$appID = 8; $type = 2;
require_once('core/inc/app/auth/authorize.php');
require_once('core/inc/func/app/fileBox/main.php');
require_once('core/inc/func/app/pres/main.php');


if (is_numeric($_GET['n'])) {
	// create pres popup
	if ($_GET['n'] == 1) {
		require_once('core/inc/app/pres/create.php');

  // edit existing pres
  } elseif ($_GET['n'] == 3) {
    require_once('core/inc/app/pres/fboxppt.php');

  // edit existing pres
  } elseif ($_GET['n'] == 4) {
    require_once('core/inc/app/pres/conv.php');


	// edit existing pres
	} elseif ($_GET['n'] == 5) {
		require_once('core/inc/app/pres/open.php');

	// convert docs to html
	} elseif ($_GET['n'] == 6) {
		require_once('core/inc/app/pres/docHandler.php');

  // convert docs to html
  } elseif ($_GET['n'] == 7) {
    require_once('core/inc/app/pres/hostLecture.php');

  } elseif ($_GET['n'] == 8) {
    require_once('core/inc/app/pres/chooseHost.php');
		
	}
	exit();
}


$page_title = 'Lectures';
$recentFiles = getRecentFiles($user_id, 7, 10);
require_once('core/template/head/header.php');
?>
<script type="text/javascript">
setvar = false;
function openLec(lid) {
  if (setvar == false) {
    window.location = 'livelecture/Editor/index.php?fid=' + lid;
  } else {
    setvar = false;
  }
}


$(document).ready(function(){
$('.hostLecBut').click(function() {
          if ($(this).hasClass('genButBkgAct')) {
            $(this).removeClass('genButBkgAct');
            $(this).addClass('genButBkg');
            $(this).removeClass('lecButAct');
            $(this).parent().find('.chooseClassBox').slideUp(100);
            // slide up main box
           } else {
        $(this).addClass('genButBkgAct');
        $(this).removeClass('genButBkg');
        $(this).addClass('lecButAct');
        $(this).parent().find('.chooseClassBox').slideDown(100);
        // slide box down
           }
        });
$('.chooseClassBox').click(function() {
  setvar = true;
});

});
</script>

<style type="text/css">
.lecButton {
  height:40px;border-bottom:1px solid #ccc;padding-left:5px;cursor: pointer;margin-top:5px
}
.lecButton:hover {
    opacity:0.75;
  filter:alpha(opacity=75);
}
.genButBkg:hover {
  -moz-box-shadow: 0 0 2px #333;
  -webkit-box-shadow: 0 0 2px #333;
  box-shadow: 0 0 2px #333;
}
.lecEl {
  height:40px;
  border:1px solid #ccc;
  padding:10px;
  cursor: pointer;
  margin-top:10px;
}
.lecEl:hover {
  background: #f4f4f4;
}
.lecButAct {
  background-color: #fff;
}
.chooseClassBox {
position:absolute; width:200px;  border:1px solid #999; background:#fff; display:none;
margin-top:5px;
margin-left:-65px;
cursor:default;
}
.cLister {
  font-size:13px;font-weight:bolder;padding:10px;
  cursor:pointer;
  border-top:1px solid #ccc;
}
.cLister:hover {
  background:#e1e1e1;
}
.hostLecBut {
  border:1px solid #999;
  font-size:13px;margin-top:5px;width:125px;padding:5px
}
</style>

<div id="home-left" style="-moz-box-shadow:inset -4px 4px 10px -4px #ccc;
-webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
box-shadow:inset -4px 4px 10px -4px #ccc;">
    <h1 style="-moz-box-shadow:inset -4px 4px 10px -4px #ccc;
-webkit-box-shadow:inset -4px 4px 10px -4px #ccc;
box-shadow:inset -4px 4px 4px -3px #ccc;">Get started with Lectures</h1>
	<div class="lecButton" onClick="openBox('presentations.php?n=1', 350); return false">
	<img src="<?php echo $imgServer; ?>gen/addlecture.png" style="width:32px;float:left;margin-right:8px" />
       <div style="font-size:13px">Create Lecture</div>
       <div style="font-size:12px; color:#999; margin-top:-3px">Build a lecture from scratch.</div>
    </div>

    <div class="lecButton" onClick="openBox('presentations.php?n=5', 350); return false">
	<img src="<?php echo $imgServer; ?>gen/openlecture.png" style="width:32px;float:left;margin-right:8px" />
       <div style="font-size:13px">Open Lecture</div>
       <div style="font-size:12px; color:#999; margin-top:-3px">Open an existing lecture.</div>
    </div>

    <div class="lecButton" onClick="openBox('presentations.php?n=4', 350); return false">
	<img src="<?php echo $imgServer; ?>gen/convppt.png" style="width:32px;float:left;margin-right:8px" />
       <div style="font-size:13px">Import PowerPoint</div>
       <div style="font-size:12px; color:#999; margin-top:-3px">Enhance existing PPT files.</div>
    </div>

<?php
if ($level == 3) {
?>
    <div class="lecButton" onClick="openBox('presentations.php?n=8', 350); return false">
	<img src="<?php echo $imgServer; ?>gen/livelecture.png" style="width:32px;float:left;margin-right:8px" />
       <div style="font-size:13px">Host LiveLecture</div>
       <div style="font-size:12px; color:#999; margin-top:-3px">Host an interactive lecture.</div>
    </div>
<?php
}
?>

</div>

<div style="float:right; width:670px">
<div style="font-size:22px; color:#666; margin-bottom:15px">Recent lectures</div>
<?php
foreach ($recentFiles as $file) {
    echo '<div class="lecEl fullRound" onClick="openLec(' . $file['id'] . ');">';
    if ($level == 3) {
    echo '<div style="float:right;">
      <div class="genButBkg fullRound hostLecBut" onClick="setvar = true;"><img src="' . $imgServer . 'gen/livelecture.png" style="width:16px;float:left;margin-right:7px;margin-top:2px;margin-left:3px" />Host this lecture</div>
      <div class="chooseClassBox fullRound">
        <div style="width:135px;background:#fff;height:4px;margin-top:-1px;border-right:1px solid #999;margin-right:-1px;float:right"></div><div style="padding:9px;color:#666;clear:both;font-size:12px;font-style:italic">choose a class to host this lecture</div>';

foreach ($myClasses as $classer) {
  echo '<div class="cLister" onClick="openBox(\'presentations.cc?n=7&cid=' . $classer['id'] . '&fid=' . $file['id'] . '\',350);$(this).parent().parent().find(\'.hostLecBut\').click();setvar = true;"><img src="' . $iconServer . $class['prof_icon'] . '" style="width:20px;float:left;margin-right:5px" />' . $classer['name'] . '</div>';
}


      echo '</div>
    </div>';
  }
   echo '<img src="' . $imgServer . 'gen/lecture.png" style="float:left;width:40px;margin-right:10px" /><span style="font-size:14px">' . $file['name'] . '</span><br />
           <span style="font-size:11px; color:#999">' . date("g:ia F jS, Y", strtotime($file['time_date'])) . '</span><br />
            </div>';
}

if(empty($recentFiles)){
    echo '<p style="color:#999;font-size:16px;text-align:center">You don\'t have any recent lectures!<br />Create a new lecture or import a PowerPoint to get started!</p>';
}
?>


</div>
<?php
require_once('core/template/foot/footer.php');
?>