<?php
// define appIDs
// bing app id :)
$APPID = "2B58A36CC379B4E201BBEC225DF184E381B00ED5";
// end appID define 


// specfic substr function
function descSubstr($str) {
	if (strlen($str) >= 500) {
		$str = substr($str, 0, 500) . '...';
	}
	return $str;
}



if (is_numeric($_GET['type'])) {
	// if we retrieved a valid type
	$type = escape($_GET['type']);
} else {
	// type is 1
	$type = 1;
}


if (isset($_GET['query'])) {
	// clean query
	$query = escape($_GET['query']);
} else {
	// no query
	echo 'enter query';
	exit();
}




// define query error
$error = '<div id="noresultBox">
	<img src="' . $imgServer . 'sBox/noResults.png" style="height:50px; float:left; margin-right:10px" />
	<div style="padding-top:5px">
		<span class="title">Unable to find any results for "' . $query . '"</span><br />
		<span class="desc">Please try another search query.</span>
	</div>
	</div>';
/// end define



// bing web search
if ($type == 1) {
	$request = 'http://api.search.live.net/json.aspx?Appid=' . $APPID . '&sources=web&query=' . urlencode( $query) . '&Web.Count=10&Web.Offset=0&SafeSearchOptions=Strict';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $request );       
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$response = curl_exec( $ch );
	curl_close($ch);
	$jsonobj = json_decode($response);
	if ($jsonobj->SearchResponse->Web->Total != 0) {
	// display results...
	foreach($jsonobj->SearchResponse->Web->Results as $value)
	{
	echo '<div id="resultBox">
	
<span class="title"><a href="searchBox.cc?n=2&type=1&title=' . urlencode($value->Title) . '&body=' . urlencode(descSubstr($value->Description)) . '&url=' . urlencode($value->Url) . '&query=' . $query . '">' . $value->Title . '</a></span>

<p class="desc">' . descSubstr($value->Description) . '</p>

<span class="url">' . $value->Url . '</span>

</div>';
	}
} else {
	echo $error;
}
	
	
	
	
	
	
	
// bing image search
} elseif ($type == 2) {
	
	
		// BING IMAGES SEARCH
	$request1 = 'http://api.search.live.net/json.aspx?Appid=' . $APPID . '&sources=image&query=' . urlencode( $query) . '&Image.Count=24&Image.Offset=0&SafeSearchOptions=Strict';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $request1 );       
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$response1 = curl_exec( $ch );
	curl_close($ch);
	$jsonobj1  = json_decode($response1);
	if ($jsonobj1->SearchResponse->Image->Total != 0){

	foreach($jsonobj1->SearchResponse->Image->Results as $value)
	{
	echo('<div style="float:left; width:225px; height:200px; padding-top: 5px; padding-bottom: 5px;"><center><a href="' . $value->MediaUrl. '" target="_blank"><img src="' . $value->Thumbnail->Url. '" border="0" style="border:4px solid #CCCCCC;" /></a></center></div>');
}

	} else {
		echo $error;
	}
	









// yt vid search
} elseif ($type == 3) {
		// YOUTUBE VIDEO SEARCH
	$query = ereg_replace('[[:space:]]+', '/', trim($query));
	  $request = 'http://gdata.youtube.com/feeds/api/videos/-/' . $query . '?racy=exclude&max-results=10';
	  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $request );       
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$feedURL = curl_exec( $ch );
	curl_close($ch);
	$count = 0;
	if (strlen($feedURL) > 200) {
		echo '<script>
		$(document).ready(function (){ 	
		$("#resultBox a").click(function (event) 
{ 
     event.preventDefault(); 
     //here you can also do all sort of things 
});
});
		</script>';
		
		
      // read feed into SimpleXML object
      $sxml = simplexml_load_string($feedURL); 
      // iterate over entries in resultset
      // print each entry's details
      foreach ($sxml->entry as $entry) {
		  $count++;
        // get nodes in media: namespace for media information
        $media = $entry->children('http://search.yahoo.com/mrss/');
        
        // get video player URL
        $attrs = $media->group->player->attributes();
        $watch = $attrs['url']; 
        
        // get video thumbnail
        $attrs = $media->group->thumbnail[0]->attributes();
        $thumbnail = $attrs['url']; 
        
        // get <yt:duration> node for video length
        $yt = $media->children('http://gdata.youtube.com/schemas/2007');
        $attrs = $yt->duration->attributes();
        $length = $attrs['seconds']; 
        
        // get <gd:rating> node for video ratings
        $gd = $entry->children('http://schemas.google.com/g/2005'); 
        if ($gd->rating) {
          $attrs = $gd->rating->attributes();
          $rating = $attrs['average']; 
        } else {
          $rating = 0; 
        }

        // print record
		echo '<div id="resultBox">
		<a href="#" onClick="openBox(\'searchBox.cc?n=2&type=3&url=' . urlencode($watch) . '&title=' . urlencode($media->group->title) . '&body=' . urlencode(descSubstr($media->group->description)) . '&query=' . $query . '\', 480)"><img src="' . $thumbnail . '" style="border:2px solid #CCCCCC; width:200px; float:left; margin:10px" /></a>
		
		<p class="desc"><span class="title"><a href="#" onClick="openBox(\'searchBox.cc?n=2&type=3&url=' . urlencode($watch) . '&title=' . urlencode($media->group->title) . '&body=' . urlencode(descSubstr($media->group->description)) . '&query=' . $query . '\', 480)">' . $media->group->title . '</a> - (' . sprintf("%0.2f", $length/60) . ' min)</span><br />' . descSubstr($media->group->description) . '</p>
		
</div>';

      }
	  
	} else {
		echo $error;
		$var = 1;
	}
if ($var != 1) {
	if ($count == 0) {
		echo $error;
	}
}









// scribd doc search
} elseif ($type == 4) {


// scribd auth
require_once('core/ext_api/scribd/scribd.php');

$scribd_api_key = "587rozlqqshoadnqd2ldi";
$scribd_secret = "sec-1eq4aio8iq45o496vacs8bpzas"; 

$scribd = new Scribd($scribd_api_key, $scribd_secret);


$num_results = 10;
$num_start = 1; // this will bring results 10-30 back
$scope = "all"; // user (default) or all -- using test will throw an error.

echo '<script>
		$(document).ready(function (){ 	
		$("#resultBox a").click(function (event) 
{ 
     event.preventDefault(); 
     //here you can also do all sort of things 
});
});
		</script>';
if (strlen(str_replace(' ', '', $query)) > 0) {
	
		$data = $scribd->search($query, $num_results, $num_start, $scope); // returns
		$test = is_array($data) ? 1 : 2;
		
}

		if ($test == 1) {
	foreach ($data as $doc) {
		echo '<div id="resultBox">
		
		<a href="#" onClick="openBox(\'searchBox.cc?n=2&type=4&doc_id=' . $doc['doc_id'] . '&doc_title=' . urlencode($doc['title']) . '&query=' . $query . '&title=' . urlencode($doc['title']) . '&body=' . urlencode(descSubstr($doc['description'])) . '&key=' . $doc['access_key'] . '\', 480)"><img src="' . $doc['thumbnail_url'] . '" style="border:2px solid #CCCCCC;float:left; margin:10px" /></a>
		
		<p class="desc"><span class="title"><strong><a href="#" onClick="openBox(\'searchBox.cc?n=2&type=4&doc_id=' . $doc['doc_id'] . '&doc_title=' . urlencode($doc['title']) . '&query=' . $query . '&title=' . urlencode($doc['title']) . '&body=' . urlencode(descSubstr($doc['description'])) . '&key=' . $doc['access_key'] . '\', 480)">' . $doc['title'] . '</a></strong> - (' . $doc['page_count'] . ' pages)</span><br />' . descSubstr($doc['description']) . '</p></div>';
	}	
	
		} else {
			echo $error;
		}


} // type






?>