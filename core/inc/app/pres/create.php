<?php

if (isset($_POST['name'])) {

	if (auth_dir($_POST['target'], $user_id) != true) {
		$attempt[] = 'Unable to verify location.';
	} else {
		$attempt = create_pres($_POST['name'], '', $_POST['target'], $user_id);
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
        dataString = $("#add-doc").serialize();
        var fid = 0;
        $.ajax({
        type: "POST",
        url: "presentations.cc?n=1",
        data: dataString,
        success: function(data) {
        	if (IsNumeric(data)) {
               window.location = "livelecture/Editor/index-debug.html?fid=" + data;
         } else {
         	 $("#failer").html(data).slideDown(400);
         	 
         }
               
       }

        });
}

</script>
<?php

	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/addDoc.png" style="margin-top:3px; margin-right: 3px" /><div>Create Presentation</div></div>
<div id="failer" style="display:none"></div>
<script type="text/javascript" src="' . $scriptServer . 'folderPicker.js"></script>
<form method="POST" id="add-doc" style="font-size:14px">	
<div style="margin:5px">
<strong>Presentation Name </strong> <span style="color:#dd1100;font-style: bolder">*</span><br />
<input type="text" name="name" style="width:300px" maxlength="45" />

<br /><br /><strong>File Location </strong> <span style="color:#dd1100;font-style: bolder">*</span> 
</div>
<div id="selectBox" style="font-size:11px">



</div>
<input type="password" size="1" style="display:none" />
</form>


<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="createDoc();" type="submit"> 
<img src="' . $imgServer . 'gen/tick.png" /> Create Presentation
</button>
<button class="button" onClick="closeBox();" type="submit"> 
<img src="' . $imgServer . 'gen/cross.png" /> Close
</button>
</div>';


?>