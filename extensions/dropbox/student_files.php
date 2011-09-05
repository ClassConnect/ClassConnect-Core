<?php
require_once('../../core/inc/coreInc.php');
require_once('../core/main.php');
require_once('./core/main.php');
if(isset($_POST['assignment_id']))
{
  dropbox_remove_files($_POST['assignment_id'],$user_id,explode(',',escape($_POST['remove_list'])));
  dropbox_add_files($_POST['assignment_id'],$user_id,explode(',',escape($_POST['file_list'])));
  exit();
}
$files = dropbox_contents($_GET['a'],$user_id)
?>
<style>
.actions{
  padding-top:10px;
  padding-bottom:5px;
  float:right; 
}
</style>
<script type="text/javascript" src="<?= $scriptServer ?>filePicker.js"></script>
<script type="text/javascript">
  $("#files").filePicker({
    allowedContentTypes:[1,2,3,4,5,6,7,8,9],
    allowMultiple:true,
    filesChangedCallback:function(files){
      var $list = $("#file_list");
      var table = document.createElement('table');
      var length = files.length;
      for(var i = 0 ; i < length ; i++)
      {
        var file = files[i];
        var row = document.createElement('tr');
        row.innerHTML = '<td><img src="'+file.icon+'" style="height:12px; float:left; margin-right:5px; margin-top:2px">'+file.filename+'</td>';
        table.appendChild(row);
      }
      if(length == 0)
      {
        $("#file_list").html('<h5>No files selected</h5>');
        $("#file_list_input").attr('value',"");
      }
      else
      {
        $("#file_list").html($(table).html());
        var id_array = [];
        for(var i = 0 ; i < length ; i++)
        {
          id_array.push(files[i].id);
        }
        $("#file_list_input").attr('value',id_array.join(','));
      }
    }
  });
  function submit_files()
  {
    $('.actions').after('<img src="core/site_img/loading.gif" id="loadImgur" style="margin-right:30px; margin-bottom:4px; float:right" />');
    $('.actions').hide();
    $.ajax({
      type: "GET",
      url: postToAPI("POST", "student_files.php", currentApp, <?= $class_id ?>, $("#file_form").serialize()),
      success: function(data) {
        closeBox();
        changePage(currentApp,"index.php");
      }
    });
  }
  function remove_file(file_id)
  {
    var $element = $("#current_"+file_id),
        $input = $("#file_remove_input");
    if($input.attr('value') == "")
      $input.attr('value',file_id);
    else
      $input.attr('value',$input.attr('value')+","+file_id);
    $element.hide();
  }
</script>
<div class="headTitle">
  <img src="/app/core/site_img/gen/upload_l.png" style="margin-top:2px; margin-right: 5px">
  <div>Choose Files</div>
</div>
<div id="files"></div>
<div style="border-top:1px solid #CCC; width:100%"></div>
<form id="file_form" method="POST">
  <h1>Currently on this assignment</h1>
  <div id="current_file_list">
    <table style="width:100%; padding:5px;">
      <tbody>
        <?php foreach($files as $file) { ?>
          <tr id="current_<?= $file['id'] ?>">
            <td>
              <div style="float:right" onclick="remove_file(<?= $file['id'] ?>)">
                <a>remove</a>
              </div>
              <img src="/app/core/site_img/fileBox/formats/<?= $file['icon'] ?>.png" style="height:12px; float:left; margin-right:5px; margin-top:2px" />
              <?= $file['name'] ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <h1>Files to add</h1>
  <div id="file_list" style="margin:5px"></div>
  <input id="assignment_id" type="hidden" name="assignment_id" value="<?= $_GET['a'] ?>"/>
  <input id="file_list_input" type="hidden" name="file_list" value="" />
  <input id="file_remove_input" type="hidden" name="remove_list" value="" />
</form>
<div class="actions">
  <button class="button" onclick="submit_files();">
    <img src="/app/core/site_img/gen/tick.png">Add Files
  </button>
  <button class="button" onclick="closeBox();">
    <img src="/app/core/site_img/gen/cross.png">Cancel
  </button>
</div>