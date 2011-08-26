<?php
if (isset($_POST['submitted'])) {
    foreach($_POST['select3'] as $id) {
        $tempID .= $id . ',';
    }
     $attempt = create_thread($_POST['subject'], $_POST['body'], $user_id, $tempID);

     if (is_numeric($attempt)) {
         echo $attempt;
     } else {
         echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
         foreach ($attempt as $error) {
             echo '<li>' . $error . '</li>';
             }
          echo '</div>';
     }
     exit();
}
echo '<script type="text/javascript" src="' . $scriptServer . 'autocomp.js"></script>';
echo '<script type="text/javascript" src="' . $scriptServer . 'editor/richEdit.js"></script>
<script type="text/javascript">
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
	$().ready(function() {
		$(\'textarea.tinymce\').tinymce({
			// Location of TinyMCE script
			script_url : \'' . $scriptServer . 'editor/tiny_mce.js\',

    setup: function(ed){
                    ed.onInit.add(function(ed) {
                       $("#loading_gfx").hide();
                       $("#showSwapper").show();
                    });
                 },

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "cut,copy,paste,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,forecolor,backcolor,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,sub,sup,hr,image,charmap,emotions,iespell,media",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true


		});
	});

$(document).ready(function(){
                $("#select3").fcbkcomplete({
                    json_url: "core/ajax/barjax/autofeed.php",
                    cache: true,
                    addontab: true,
                    height: 2
                });
});

function createMsg() {
        dataString = $("#msg").serialize();

        $.ajax({
        type: "POST",
        url: "msg.cc?n=1",
        data: dataString,
        success: function(data) {
            if (isNumber(data)) {
                window.location.reload(true);
             } else {
             $("#failer").html(data).slideDown(200);
             }
       }

        });
}
</script>';
?>
<div class="headTitle"><img src="<?php echo $imgServer; ?>gen/add_mail.png" style="margin-right:10px; margin-top:2px" /><div>New Message</div></div>
<div id="failer" style="display:none"></div>
  <form id="msg" accept-charset="utf-8" style="margin:10px">
       <span style="font-size:16px">To</span>
            <select id="select3" name="select3">

            </select>
            <br/>
              <span style="font-size:16px">Subject</span><br />
            <input type="text"  class="subjecter" name="subject" maxlength="60" />
            <br/><br/>
            <span style="font-size:16px">Message</span><br />
            <?php echo '<div id="loading_gfx"><img src="' . $imgServer . 'loading.gif" /></div>'; ?>
            <div id="showSwapper" style="display:none"><textarea id="temp1" name="body" style="width: 510px" class="tinymce"></textarea></div>
            <input type="hidden" name="submitted" value="true" />
        </form>
<div style="float:right; margin:5px">
     <button class="button" type="submit" onClick="createMsg();"><img src="<?php echo $imgServer; ?>gen/tick.png" />Send Message</button>
    <button class="button" type="submit" onClick="closeBox();"><img src="<?php echo $imgServer; ?>gen/cross.png" />Close</button>
</div>