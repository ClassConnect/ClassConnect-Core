<?php
require_once('core/inc/coreInc.php');
// define appid and app type
$appID = 7; $type = 2;
require_once('core/inc/app/auth/authorize.php');
requireSession();

if ($_GET['n']) {
	if ($_GET['n'] == 1) {
		// pull in our return result
		require_once('core/inc/app/searchBox/return.php');
	
	
	} elseif ($_GET['n'] == 2) {
		// view selected result
		require_once('core/inc/app/searchBox/view.php');
		
		
	} elseif ($_GET['n'] == 3) {
	// add content to filebox
	require_once('core/inc/func/app/fileBox/main.php');
	require_once('core/inc/app/searchBox/add.php');
	
	
	}
	
	
	
	
	exit();
}



$page_title = "SearchBox";
require_once('core/template/head/header.php');
?>

<script type="text/javascript" >
 $(function(){
    $("#searchBoxSub").submit(function(){
    	searchBox();
        return false;            

    });
});

// option buttons
$(document).ready(function(){  
 
		var pageSplit = self.document.location.hash.search("_");
		if (pageSplit == -1) {
			var retID = self.document.location.hash.substring(1);
			var getPage = "";
		} else {
			var retID = self.document.location.hash.substring(1, pageSplit);
			var getPage = self.document.location.hash.substring(pageSplit + 1, self.document.location.hash.length);
		}

		if (retID == 0) {
			retID = 1;
		}
		
		
	
	// if bing web search
	if (retID == 1) {
		$("#opt1").addClass('active');
	} else if (retID == 2) {
		$("#opt2").addClass('active');
	} else if (retID == 3) {
		$("#opt3").addClass('active');
	} else if (retID == 4) {
		$("#opt4").addClass('active');
	}
	
	$("input[name='type']").val(retID);
	 
	// load our query
	$("#message_wall").val(getPage);

        searchBox();
 });


function searchBox() {
if ($("#message_wall").val() != '') {

	$("#results").html('<br /><br /><br /><br /><br /><center><img src="<?php echo $imgServer; ?>sBoxLoad.gif" /></center>');
        dataString = $("#searchBoxSub").serialize();

        $.ajax({
        type: "GET",
        url: "searchBox.cc?n=1",
        data: dataString,
        success: function(data) {

               $("#results").html(data);

        }

        });


} else {
$("#results").html('<center><br /><br /><span style="font-size:20px; color:#666">Search over 400 million websites, images, videos, documents and more.</span></center>');
}

   parent.location.hash = $("input[name='type']").val() + '_' + $("#message_wall").val();
}





function addToFileBox(cType, cTitle, cDesc, cCode) {
	openBox('searchBox.cc?n=3&title='+ cTitle + '&type=' + cType + '&desc=' + cDesc + '&code=' + cCode, 350);
}


function swapSearch(id) {
$(".active").removeClass('active');
$("#opt" + id).addClass('active');
$("input[name='type']").val(id);
searchBox();
}

</script>
<form id="searchBoxSub">
    <div id="sbox_menu">
        <span id="opt1" class="item"><a href="#" onClick="swapSearch(1); return false">Websites</a></span>
        <span id="opt2" class="item"><a href="#" onClick="swapSearch(2); return false">Images</a></span>
        <span id="opt3" class="item"><a href="#" onClick="swapSearch(3); return false">Videos</a></span>
        <span id="opt4" class="item"><a href="#" onClick="swapSearch(4); return false">Documents / eBooks / Powerpoints</a></span>
    </div>
    <div id="updateBox">
<input type="text" class="inputBox" id="message_wall" name="query" style="width:770px" />
<input type="submit" name="submit" value="Search" class="postButton" />
<input type="hidden" name="type" value="1" />
</div>
</form>

<div id="results" style="margin-top:10px"></div>

<?php
require_once('core/template/foot/footer.php');
?>