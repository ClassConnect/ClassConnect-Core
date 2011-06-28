 <?php 
// check for n
if (isset($_GET['n'])) {
	if ($_GET['n'] == 1) {
		// add classes panel
		require_once('core/inc/teacher/manageClasses/createClass.php');
		
	} elseif ($_GET['n'] == 2) {
		// view past & future classes
		require_once('core/inc/teacher/manageClasses/viewToggle.php');
		
	} elseif ($_GET['n'] == 3) {
		// end/restart class
		require_once('core/inc/teacher/manageClasses/endClass.php');
		
	} elseif ($_GET['n'] == 4) {
		// manage schools
		require_once('core/inc/func/user/addUser.php');
		require_once('core/inc/teacher/manageClasses/manageSchools.php');
		
	}
	
exit();
} // isset n
 

$page_title = 'Manage Classes / Schools';

require_once('core/template/head/header.php');

?>
<script type="text/javascript" >
    function swapThis(id, obj) {
        $("#managebar li").removeClass("active");
        obj.addClass("active");
$("#classLoad").html('<br /><br /><center><img src="/app/core/site_img/loading.gif" /></center>');
        $.ajax({
        type: "GET",
        url: "manage-classes.php?n=2&v=" + id,
        success: function(data) {
        		$("#classLoad").html(data);

        }

        });
        
    }

$(document).ready(function(){
swapThis(2, $("#origLI"));

});
</script>


<div style="width: 700px; padding-right:5px; border-right:1px solid #ccc; float:left">

<div id="managebar">
    <li onClick="swapThis(1, $(this))">Past Classes</li>
    <li id="origLI" class="active" onClick="swapThis(2, $(this))">Current Classes</li>
    <li onClick="swapThis(3, $(this))">Future Classes</li>
    <li onClick="swapThis(4, $(this))">Schools</li>

</div>

    <div id="classLoad" style="margin-top:5px">

    </div>


<div style="margin-bottom:100px"></div>
</div>

<div style="width: 190px; float:right" id="manageRighter">
<br />
<a href="#" onClick="openBox('manage-classes.cc?n=1', 500)" class="button" style="margin-left:10px; margin-bottom: 10px"><img src="<?php echo $imgServer; ?>gen/add.png" /> Create New Class</a>
<a href="#" onClick="openBox('manage-classes.cc?n=4&s=2&sd=1', 610)" class="button" style="margin-left:10px"><img src="<?php echo $imgServer; ?>gen/search.png" /> Find / Add School</a>


</div>

<?php
require_once('core/template/foot/footer.php');
?>