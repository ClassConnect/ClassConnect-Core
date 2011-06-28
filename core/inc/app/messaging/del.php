<?php
$thread_id = escape($_GET['id']);
if (auth_thread($thread_id, $user_id) != true) {
    $page_title = "Error";
    require_once('core/template/head/header.php');
    echo '<br /><center><span style="font-size:20px; color:#999; font-weight:bolder">Oops! This page does not exist.</span></center>';
    require_once('core/template/foot/footer.php');
    exit();
}

if (isset($_POST['submitted'])) {
    mark_del($thread_id, $user_id);
    header('location:msg.cc');

     exit();
}

?>
<div class="headTitle"><img src="<?php echo $imgServer; ?>gen/del_mail.png" style="margin-right:10px; margin-top:2px" /><div>Delete Message</div></div>
<div id="failer" style="display:none"></div>
  <form action="msg.cc?n=3&id=<?php echo $thread_id; ?>" method="POST">
      <div style="margin:10px">
       <span style="font-size:14px">Are you sure you want to delete this thread?</span><br />
       <span style="color:#666; font-size:12px">This thread will reappear in your inbox if another recipient of this thread sends a message.</span>
            <input type="hidden" name="submitted" value="true" />
      </div>
<div style="float:right; margin:5px">
     <button class="button" type="submit"><img src="<?php echo $imgServer; ?>gen/tick.png" />Confirm Delete</button>
    <button class="button" type="submit" onClick="closeBox(); return false"><img src="<?php echo $imgServer; ?>gen/cross.png" />Close</button>
</div>
</form>