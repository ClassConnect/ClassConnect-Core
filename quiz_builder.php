<?php
require_once('core/inc/coreInc.php');
require_once('extensions/classPage/core/main.php');
requireSession();

require_once('core/template/head/header.php');
?>
<script type="text/javascript" src="/app/core/ajax/editor/richEdit.js"></script>
<script type="text/javascript" src="/app/core/ajax/assessment_builder.js"></script>
<script type="text/javascript" src="/app/core/ajax/scroll.js"></script>
<script type="text/javascript" src="/app/core/ajax/autogrow.js"></script>
<script type="text/javascript" src="/app/core/ajax/input.js"></script> 

<style>
#mainviewer {
    width:700px;
    float:right;
}

#mainviewer textarea{
    font-size:14px;
    font-family:arial;
}

.addMore {
    float:right;
    border:1px solid #ccc;
    padding-left:30px;
    padding-top:7px;
    padding-bottom:10px;
    margin-bottom:20px;
    font-size:16px;
    height:20px;
    width:670px;
    clear:both;
}

.selement {
    border:1px solid #ccc;
    padding:20px;
    margin-bottom:20px;
    background: #fff;

    -moz-border-radius: 5px;
    -khtml-border-radius: 5px;
    -webkit-border-radius: 5px;
}


.selement .answers{
    clear:both;
    margin-top:20px;
}
.selement .answers input{
    border:1px solid #999;
    font-size:14px;
    width:400px;
    padding:5px;
    -moz-border-radius: 0px;
    -khtml-border-radius: 0px;
    -webkit-border-radius: 0px;
}

.selement .ordnum {
    background: #000;
    padding-left:8px;
    padding-top:1px;
    padding-bottom:1px;
    padding-right:8px;
    color:#fff;
    font-size:16px;
    font-weight:bolder;
    position:absolute;
    margin-top:-30px;
    margin-left:-30px;

    -moz-border-radius: 5px;
    -khtml-border-radius: 5px;
    -webkit-border-top-right: 5px;
}

.selement .handle {
    background: #ccc;
    padding-left:2px;
    padding-top:1px;
    padding-bottom:2px;
    padding-right:2px;
    color:#fff;
    font-weight:bolder;
    float:right;
    margin-top:-20px;
    margin-right:-20px;
    cursor:pointer;

    -moz-border-radius-bottomleft: 5px;
    -khtml-border-radius-bottomleft: 5px;
    -webkit-border-bottom-left-radius: 5px;
}

.selement .points {
    float:right;
    width:100px;
    padding-top:1px;
    font-size:12px;
    margin-top:-20px;
}

.selement .pointput {
    font-size:12px;
    font-weight:bolder;
    width:30px;
    height:12px;
    text-align:center;
    margin-bottom:10px;
    margin-right:4px;
    float:left;
}

.selement .pointers {
    font-weight:bolder;
}

.selement .deler {
    font-size:12px;
    margin-top:-20px;
    margin-right:10px;
    background: #ccc;
    padding-left:5px;
    padding-top:1px;
    padding-bottom:2px;
    padding-right:5px;
    color:#fff;
    font-weight:bolder;
    float:right;
    cursor:pointer;
}

#sidepanel {
    width:170px;
    border:1px solid #ccc;
    float:left;
}

#totalPoints {
    font-size:16px;
    font-weight:bolder;
    padding:10px;

}

.answer {
    margin-top:10px;
}

.floatingPanel { position: fixed; top: 10px; }
</style>


<div style="font-size:24px; color:#666"><a href="#" onClick="create_ele(1);">Assessments</a> <img src="/app/core/site_img/main/l_arrow.png"> Quiz</div>

<div style="margin-top:20px"></div>
    <div id="sidepanel">
        <div id="totalPoints">
        </div>
        <br /><br />
        <a href="#" onClick="saveMent(); return false">Save This</a>
    </div>

<div id="mainviewer">


</div>


<div class="addMore" style="margin-bottom:200px">
    <div style="color:#666; font-weight:bolder; float:left">Add a...</div>

    <div style="margin-left:30px; color:#666; float:left; cursor:pointer" onClick="create_ele(3);"><img src="<?php echo $imgServer; ?>gen/text.png" style="margin-right:2px;margin-bottom:-2px" /> text block</div>

    <div style="margin-left:30px; color:#666; float:left; cursor:pointer" onClick="create_ele(1);"><img src="<?php echo $imgServer; ?>gen/mcq.png" style="margin-right:2px;margin-bottom:-2px" /> multiple choice</div>

</div>


<?php
require_once('core/template/foot/footer.php');
?>