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
		$.ajax({
  			url: "writer.php?n=6&step=2&id=<?php echo $conID; ?>",
  			success: function(data){
  				if (data == 1) {
    				updateStatus(34, 'Converting document...');
    				convertDoc();
    			} else {
    				updateStatus(82, 'Cached doc already exists, creating doc...');
                                                                                    finalizeDoc();
    			}
  			}
		});
		
	}
	
	function convertDoc() {
		$.ajax({
  			url: "writer.php?n=6&step=3&id=<?php echo $conID; ?>",
  			success: function(data){
  				if (data == 1) {
    				updateStatus(82, 'Created cached conv doc, creating doc...');
                                                                                     finalizeDoc();
    			} else {
    				updateStatus(0, 'Document conversion failed.');
    			}
  			}
		});
		
	}
        function finalizeDoc() {
		$.ajax({
  			url: "writer.php?n=6&step=4&id=<?php echo $conID; ?>",
  			success: function(data){
    				updateStatus(100, 'Document created, redirecting...');
                                                                                    window.location = "writer.cc?n=2&doc_id=" + data;
    			
  			}
		});

	}
	</script>
	
<div class="headTitle"><div id="status-update">Converting Document <strong>(10%)</strong></div></div>

<div id="progressbar" style="margin:5px"></div>

<ul id="updateUL" style="font-size:12px">
<li>Downloading temporary copy of document...<img id="task-current" src="<?php echo $imgServer; ?>uploader.gif" style="margin-left:10px" /></li>
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