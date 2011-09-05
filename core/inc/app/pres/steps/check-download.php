<?php
$contentData = get_content($conID);
if ($contentData['format'] == 1) {


	echo '<div class="headTitle"><img src="' . $imgServer . 'gen/convppt.png" style="margin-top:3px; margin-right: 7px;width:32px" /><div>Import PowerPoint</div></div>';

echo '<div class="wizard-steps">
  <div class="completed-step"><a href="#" class="beginning completed"><img src="' . $imgServer . 'gen/upload.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Upload</a></div>
  <div class="active-step"><a href="#" class="current"><img src="' . $imgServer . 'gen/conv.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Convert</a></div>
  <div><a href="#" class="end"><img src="' . $imgServer . 'gen/tick.png" style="float:left;width:18px;margin-top:3px;margin-right:5px" /> Open Lecture</a></div>
</div>';

?>

<script>
	$(document).ready(function() {
		downloadDoc();
	});
	function downloadDoc() {
		$.ajax({

  			url: "presentations.php?n=6&step=2&id=<?php echo $conID; ?>",
  			success: function(data){
  				
  				$('.current').addClass('completed').removeClass('current');
  				$('.end').addClass('current');
  				window.location = "livelecture/Editor/index.php?fid=" + data;
  			}
		});
		
	}
	
	</script>

<center><br /><br />Converting your presentation (this might take a minute)...<br /><img src="<?php echo $imgServer; ?>loading.gif" /><br /><br /></center>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="closeBox();" type="submit"> 
<img src="<?php echo $imgServer; ?>gen/cross.png" /> Cancel Conversion
</button>
</div>

<div id="codeHere" style="display:none"></div>

<?php
}
?>