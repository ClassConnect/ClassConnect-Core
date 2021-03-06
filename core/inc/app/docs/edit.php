<?php
if (isset($_GET['doc_id'])) {
	$doc_id = escape($_GET['doc_id']);
} else {
	exit();
}

if (auth_content($doc_id, $user_id)) {
	$docData = get_content($doc_id);

} else {
	require_once('core/template/head/header.php');
	echo '<br /><br /><center><span style="font-size:20px; color: #999">You don\'t have permission to view this document.</span></center>';
	require_once('core/template/foot/footer.php');
	exit();
}

$page_title = 'Edit ' . $docData['name'];
$scriptArr[] = $scriptServer . 'editor/richEdit.js';
require_once('core/template/head/header.php');
?>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo $scriptServer; ?>editor/tiny_mce.js',

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
			theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,forecolor,backcolor,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,sub,sup,hr,image,charmap,emotions,iespell,media,|,insertdate,inserttime,pagebreak,|,preview,fullscreen",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			save_onsavecallback: short_save
});
});
	
	
	
$(document).ready(function() {
	$(function() {
		// Here we have the auto_save() function run every 30 secs
		// We also pass the argument 'editor_id' which is the ID for the textarea tag
		setInterval("auto_save('elm1')",90000);
	});
});
	
	


function short_save() {
	auto_save('elm1');
	return false;
}	
	
	


function dlDoc() {
                     short_save();
	openBox('writer.php?n=4&content=<?php echo $doc_id; ?>', 350);
}

	
	
// autosave
function auto_save(editor_id) {
	$('#updater').html('<div class="infobox" style="float:right; padding-top:2px; padding-bottom:2px">Saving document to FileBox...</div>');
	// First we check if any changes have been made to the editor window
	if(tinyMCE.getInstanceById(editor_id).isDirty()) {
		// If so, then we start the auto-save process
		// First we get the content in the editor window and make it URL friendly
		var content = tinyMCE.get(editor_id);
		var notDirty = tinyMCE.get(editor_id);
		content = escape(content.getContent());
		content = content.replace("+", "%2B");
		content = content.replace("/", "%2F");
		// We then start our jQuery AJAX function
		$.ajax({
			url: "writer.php?n=3", // the path/name that will process our request
			type: "POST", 
			data: "content=" + content + "&doc_id=" + <?php echo $doc_id; ?>, 
			success: function(msg) {
				notDirty.isNotDirty = true;
				$('#updater').html('<div class="successbox" style="padding-top:2px; padding-bottom:2px">Document Saved Successfully!</div>');
				
				setTimeout("$('#updater').html('')",1250);
				// Here we reset the editor's changed (dirty) status
				// This prevents the editor from performing another auto-save
				// until more changes are made
			}
		});
	// If nothing has changed, don't do anything
	} else {
		$('#updater').html('');
		return false;
	}
}



function printIt() {
	tinyMCE.getInstanceById('elm1').getWin().print();
}


function checkDiff(e) {
	if(tinyMCE.getInstanceById('elm1').isDirty()) {
	return "You have unsaved progress. Are you sure you want to exit?";

}

}

window.onbeforeunload=checkDiff;
</script>



<div style=" width:900px; height:28px; float:left">
<div id="updater" style="float:right"></div>
<button id="saver" class="button" type="submit" onClick="auto_save('elm1')" style="-webkit-border-bottom-left-radius: 0px;-moz-border-radius-bottomleft: 0px;-khtml-border-radius-bottomleft: 0px;-webkit-border-bottom-right-radius: 0px;-moz-border-radius-bottomright: 0px;-khtml-border-radius-bottomright: 0px;-moz-border-radius-topright: 0px;-khtml-border-radius-topright: 0px;-webkit-border-top-right-radius: 0px;"><img src="<?php echo $imgServer; ?>gen/save.png" /> Save</button>

<button class="button" type="submit" onClick="dlDoc()" style="margin-left:-7px; -webkit-border-bottom-left-radius: 0px;-moz-border-radius-bottomleft: 0px;-khtml-border-radius-bottomleft: 0px;-moz-border-radius-topleft: 0px;-khtml-border-radius-topleft: 0px;-webkit-border-top-left-radius: 0px;-webkit-border-bottom-right-radius: 0px;-moz-border-radius-bottomright: 0px;-khtml-border-radius-bottomright: 0px;-moz-border-radius-topright: 0px;-khtml-border-radius-topright: 0px;-webkit-border-top-right-radius: 0px;"><img src="<?php echo $imgServer; ?>gen/word.png" /> Download</button>

<button class="button" type="submit" onClick="printIt();" style="margin-left:-7px; -webkit-border-bottom-left-radius: 0px;-moz-border-radius-bottomleft: 0px;-khtml-border-radius-bottomleft: 0px;-moz-border-radius-topleft: 0px;-khtml-border-radius-topleft: 0px;-webkit-border-top-left-radius: 0px;-webkit-border-bottom-right-radius: 0px;-moz-border-radius-bottomright: 0px;-khtml-border-radius-bottomright: 0px;"><img src="<?php echo $imgServer; ?>gen/print.png" /> Print</button>

</div>
		<div id="loading_gfx"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><center><img src="<?php echo $imgServer; ?>load.gif" /></center></div>
		<div id="showSwapper" style="clear:both;display:none">
			<textarea id="elm1" name="body" style="width: 900px; height:600px" class="tinymce"><?php echo $docData['content']; ?></textarea>
		</div>


<?php
require_once('core/template/foot/footer.php');
?>