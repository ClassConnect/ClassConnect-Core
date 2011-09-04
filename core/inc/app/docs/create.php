<?php

if (isset($_POST['name'])) {

	if (auth_dir($_POST['target'], $user_id) != true) {
		$attempt[] = 'Unable to verify location.';
	} else {
		$attempt = create_doc($_POST['name'], '', $_POST['target'], $user_id);
	}
	
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

?>

<script>
function IsNumeric(sText)

{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
   }


 function createDoc() {
   $('#bottom').after('<img src="core/site_img/loading.gif" id="loadImgur" style="margin-right:30px; margin-bottom:4px; float:right" />');
   $('#bottom').hide();
   dataString = $("#add-doc").serialize();
   var fid = 0;
   $.ajax({
     type: "POST",
     url: "writer.cc?n=1",
     data: dataString,
     success: function(data) {
       if (IsNumeric(data)) {
         window.location = "writer.cc?n=2&doc_id=" + data;
       } else {
         $("#failer").html(data).slideDown(400);
         $('#loadImgur').remove();
         $('#bottom').show();

       }
     }
   });
 }
</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/addDoc.png" style="margin-top:3px; margin-right: 3px" /><div>Create Document</div></div>
<div id="failer" style="display:none"></div>
<script type="text/javascript" src="' . $scriptServer . 'folderPicker.js"></script>
<form method="POST" id="add-doc" style="font-size:14px">	
<div style="margin:5px; margin-left:10px">
<strong>Document Name </strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:300px" maxlength="45" />

<div style="font-size:12px;margin-top:5px"><a href="#" onClick="$(\'#file_location\').show();$(this).parent().hide();return false">Choose where to save this in FileBox</a></div>
</div>

<div id="file_location" style="display:none">
<div style="margin:5px; margin-top:20px;margin-left:10px;style="display:none">
<strong>File Location</strong>
</div>

<div id="selectBox" style="font-size:11px">



</div>
</div>
<input type="password" size="1" style="display:none" />
</form>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="createDoc();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Create Document
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>