<?php
//retrieve the directory ID
if (is_numeric($_GET['id'])) {
	$currentDir = $_GET['id'];
} else {
	$currentDir = 0;
}


// load up
if (auth_dir($currentDir, $user_id) == true) {

	$dirList = read_dirFolders($currentDir, $user_id);
	
	$fileList = read_dirFiles($currentDir, $user_id);
	
	if (empty($dirList) && empty($fileList)) {
		$emptyMsg = "No content found.";
	}

// no permissions
} else {
	$emptyMsg = "No pemissions found for this folder.";
}
?>

<script type="text/javascript">
$(function() {
		// creates the selected variable
		// we are going to be storing the selected objects in here
		var selected = $([]), offset = {top:0, left:0};
		// console.log will outout
		// Object length=0 prevObject=Object jquery=1.2.6
	/*	console.log("This is the value of selected when it is created " +selected + ""); */
	
				
<?php foreach ($dirList as $temperd) {
	echo '$("#fo' . $temperd['id'] . '").droppable({
			drop: function( event, ui ) {
				var totalStr = \'\';
				for(var i=0; i<activeFolders.length; i++) {
        			totalStr += activeFolders[i] + \',\';
    			}
    			var totalCon = \'\';
				for(var i=0; i<activeFiles.length; i++) {
        			totalCon += activeFiles[i] + \',\';
    			}

 $.ajax({
   type: "GET",
   url: "filebox.cc?n=6&fid=' . $temperd['id'] . '&ids=" + totalStr + "&cids=" + totalCon,
   success: function(msg){

   }
 });	
    			
    			
    			
			}
		});';
	
}		
?>

				
		// declare draggable UI and what we are going to be doing on start
		$("#selectable1 li").draggable({
			start: function(ev, ui) {
				allowRM = false;
				$(this).is(".ui-selected") || $(".ui-selected").removeClass("ui-selected");
				 /*console.log("The value of 'this' currently is: "+this); */
				
				selected = $(".ui-selected").each(function() {

					var el = $(this);
					/* console.log("The value of el is: "+el); */
					el.data("offset", el.offset());
					$(this).addClass("trans");
				});
			/*	console.log("The new value of selected is now "+selected); */
				offset = $(this).offset();
			/*	console.log("The value of top value is "+offset.top+" and the left value is "+offset.left); */
			},
			drag: function(ev, ui) {
				// create two new variables
				// dt and dl, subract the ui.position and the offset position
				var dt = ui.position.top - offset.top, dl = ui.position.left - offset.left;
			   /* console.log("The value of dt is "+dt+" and is equal to "+ui.position.top+" - "+offset.top); */
			  /*  console.log("The value of dl is "+dl+" and is equal to "+ui.position.left+" - "+offset.left); */
			  /*  console.log("The value of ui.position.top is "+ui.position.top); */
			  /*  console.log("The value of ui.position.left is "+ui.position.left); */
			  /*  console.log("The value of offset.top is "+offset.top); */
			  /*  console.log("The value of offset.left is "+offset.left); */
				
				// take all the elements that are selected expect $("this"), which is the element being dragged and loop through each.
				selected.not(this).each(function() {
					// create the variable for we don't need to keep calling $("this")
					// el = current element we are on
					// off = what position was this element at when it was selected, before drag
					var el = $(this), off = el.data("offset");
					el.css({top: offset.top + dt, left: off.left + dl});
					
			    });
				
			},
			stop: function(ev, ui){
			updateFbox(self.document.location.hash.substring(1));
				
				
			}
		});
		
	});
	</script>
<?php


// if it's empty
if (isset($emptyMsg)) {
	echo '<li>' . $emptyMsg . '</li>';
}

foreach ($dirList as $entry) {
	echo '<li id="fo' . $entry['id'] . '" onMouseDown="setMe(1, ' . $entry['id'] . ')" onClick="unSetMe(1, ' . $entry['id'] . ')" onDblClick="updateFbox(' . $entry['id'] . ')">
<div class="createDate">' . date('F j, Y', strtotime($entry['time_date'])) . '</div>
<div class="options">
<span class="optImg">
<a onClick="openBox(\'filebox.cc?n=13&parent=' . $currentDir . '&ids=' . $entry['id'] . '\', 350)">
<img src="' . $imgServer . 'fileBox/share.png" style="margin-right:10px" />
<small>Sharing</small>
</a>
</span>

<span class="optImg">
<a onClick="openBox(\'filebox.cc?n=4&fid=' . $entry['id'] . '\', 350)">
<img src="' . $imgServer . 'fileBox/edit.png" style="margin-right:10px" />
<small>Edit</small>
</a>
</span>

<span class="optImg">
<a onClick="openBox(\'filebox.cc?n=5&fid=' . $entry['id'] . '\', 350)">
<img src="' . $imgServer . 'fileBox/close.png" />
<small>Delete</small>
</a>
</span>

</div>
<div class="fileType">Folder</div>

<div class="fileName"><img src="' . $imgServer . 'fileBox/folder.png" style="float:left;margin-right:5px" />' . $entry['name'] . '</div>


</li>';
}


foreach ($fileList as $fEntry) {
	if ($fEntry['format'] == 1) {
		$fEntry['name'] = $fEntry['name'] . '.' . $fEntry['ext'];
		$fEntry['format_name'] = strtoupper($fEntry['ext']) . ' ' . $fEntry['format_name'];
	}
	
	echo '<li id="f' . $fEntry['id'] . '" onMouseDown="setMe(2, ' . $fEntry['id'] . ')" onClick="unSetMe(2, ' . $fEntry['id'] . ')" onDblClick="viewContent(' . $fEntry['format'] . ', ' . $fEntry['id'] . ')">
<div class="createDate">' . date('F j, Y', strtotime($fEntry['time_date'])) . '</div>
<div class="options">
<span class="optImg">
<a onClick="openBox(\'filebox.cc?n=13&parent=' . $currentDir . '&cids=' . $fEntry['id'] . '\', 350)">
<img src="' . $imgServer . 'fileBox/share.png" style="margin-right:10px" />
<small>Sharing</small>
</a>
</span>

<span class="optImg">
<a onClick="updateContent(' . $fEntry['format'] . ', ' . $fEntry['id'] . ')">
<img src="' . $imgServer . 'fileBox/edit.png" style="margin-right:10px" />
<small>Edit</small>
</a>
</span>

<span class="optImg">
<a onClick="openBox(\'filebox.cc?n=9&content_id=' . $fEntry['id'] . '\', 300)">
<img src="' . $imgServer . 'fileBox/close.png" />
<small>Delete</small>
</a>
</span>

</div>
<div class="fileType">' . $fEntry['format_name'] . '</div>

<div class="fileName"><img src="' . $imgServer . 'fileBox/formats/' . $fEntry['icon'] . '.png" style="float:left;margin-right:5px" />' . $fEntry['name'] . '</div>


</li>';
}
?>