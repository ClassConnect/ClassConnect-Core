 <?php 
// check for n
if (isset($_GET['n'])) {
		require_once('core/inc/func/user/addUser.php');
	
	if ($_GET['n'] == 1) {
		// add classes panel
		require_once('core/inc/student/manageClasses/addClass.php');
		
	} elseif ($_GET['n'] == 2) {
		// view past & future classes
		require_once('core/inc/student/manageClasses/viewToggle.php');
		
	}
exit();
} // isset n
 

$page_title = 'Manage Classes / Schools';

require_once('core/template/head/header.php');

?>
<script type="text/javascript">
    function swapThis(id) {
        $(".active").removeClass("active");
        $("#opt" + id).addClass('active');
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
swapThis(2);

});
</script>


<div style="width: 700px; padding-right:5px; float:left">


<div id="managebar">
        <span id="opt1" class="item"><a href="#" onclick="swapThis(1); return false">Past Classes</a></span>
        <span id="opt2" class="item active"><a href="#" onclick="swapThis(2); return false">Current Classes</a></span>
        <span id="opt3" class="item"><a href="#" onclick="swapThis(3); return false">Future Classes</a></span>
        <span id="opt4" class="item"><a href="#" onclick="swapThis(4); return false">Schools</a></span>
    </div>

    <div style="background-color:#f1f1ec; padding:1px; border:1px solid #BABABA;margin-top:-3px">
        <div id="classLoad" style="background-color:#fff; margin:10px; border:2px solid #ccc;padding:3px">

        </div>
    </div>

<div style="margin-bottom:100px"></div>
</div>

<div style="width: 190px; float:right" id="manageRighter">
<br />
<a href="#" onClick="openBox('manage-classes.cc?n=1', 400)" class="button" style="margin-left:10px; margin-bottom: 10px"><img src="<?php echo $imgServer; ?>gen/add.png" /> Enroll In A Class</a>


</div>

<?php
require_once('core/template/foot/footer.php');
?>