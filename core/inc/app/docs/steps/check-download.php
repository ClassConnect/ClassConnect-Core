<?php
$contentData = get_content($conID);
if ($contentData['format'] == 1) {
?>

<script>
	$(function() {
		$("#progressbar").progressbar({
			value: 10
		});
		downloadDoc();
	});
	
	function updateStatus(number, textData) {
		$('#status-update').html('Converting Document <strong>(' + number + '%)</strong>');
		$("#progressbar").progressbar({
			value: number
		});
		$("#task-current").remove();
		$('#updateUL').append('<li>' + textData + '<img id="task-current" src="<?php echo $imgServer; ?>uploader.gif" style="margin-left:10px" /></li>');
		
	}
	
	function downloadDoc() {
		updateStatus(34, 'Converting your document...');
		$.ajax({
  			url: "writer.php?n=6&step=2&id=<?php echo $conID; ?>",
  			success: function(data){
  				window.location = "writer.cc?n=2&doc_id=" + data;
  			}
		});
		
	}
	
	</script>
	
<div class="headTitle"><div id="status-update">Converting Document <strong>(10%)</strong></div></div>

<div id="progressbar" style="margin:5px"></div>

<ul id="updateUL" style="font-size:12px">
<li>Connecting to conversion server...<img id="task-current" src="<?php echo $imgServer; ?>uploader.gif" style="margin-left:10px" /></li>
</ul>

<div id="bottom" style="margin-top:10px; margin-bottom:5px; float:right">
<button class="button" onClick="closeBox();" type="submit"> 
<img src="<?php echo $imgServer; ?>gen/cross.png" /> Cancel Conversion
</button>
</div>

<div id="codeHere" style="display:none"></div>

<?php
}
?>