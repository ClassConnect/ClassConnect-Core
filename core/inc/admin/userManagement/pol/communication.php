<?php
// conv our school policies from JSON
$jArr = json_decode(reverse_htmlentities($school['userPolicies']), true);

	// did the user just update?
	if (isset($_POST['teach'])) {
	$errors = array();
	$sid = $school['id'];
	if (is_numeric($_POST['teach'])) {
                        $teachComm = escape($_POST['teach']);
                   } else {
                       $errors[] = 'Invalid teacher selection.';
                   }


                   if (is_numeric($_POST['stud'])) {
                        $stuComm = escape($_POST['stud']);
                   } else {
                       $errors[] = 'Invalid student selection.';
                   }

	if (empty($errors)) {
                                     updateUPol($sid, $teachComm, $stuComm, reverse_htmlentities($jArr['auto_add']),  reverse_htmlentities($jArr['teach_list_type']),  reverse_htmlentities($jArr['teach_exception_list']),  reverse_htmlentities($jArr['stud_list_type']),  reverse_htmlentities($jArr['stud_exception_list']));
                                       setSession($user_id);
                                       setLocalPolicies($user_id, $sid);
		echo "1";
	} else { // report the errors
		echo '<div class="errorbox"><span style="font-size:14px; font-weight:bolder">Oops!</span>';
		foreach ($errors as $error) {
			echo '<li>' . $error . '</li>';
		}
		echo '</div>';
	}


exit();

}

/// load preset checks for teacher
	if ($jArr['teacher_communication'] == 1) {
		$check1 = 'checked="checked" ';

	} elseif ($jArr['teacher_communication'] == 2) {
		$check2 = 'checked="checked" ';

                } elseif ($jArr['teacher_communication'] == 3) {
                                    $check3 = 'checked="checked" ';
                }

/// load preset checks for student
	if ($jArr['student_communication'] == 1) {
		$checker1 = 'checked="checked" ';

	} elseif ($jArr['student_communication'] == 2) {
		$checker2 = 'checked="checked" ';

                } elseif ($jArr['student_communication'] == 3) {
                                    $checker3 = 'checked="checked" ';
                }

	echo '
<div class="headTitle"><img src="' . $imgServer . 'gen/setting.png" style="margin-right:5px;margin-top:3px" /><div>Communication Policies</div></div>
<div id="content" style="margin:5px">

<script type="text/javascript">

		$( "#jCatch" ).buttonset();
                $( "#jCatch1" ).buttonset();

function updateCommPolicy() {
        dataString = $("#comm-policy").serialize();


        $.ajax({
        type: "POST",
        url: "school-admin.cc?id=' . $school['id'] . '&s=9&n=4",
        data: dataString,
        success: function(data) {
        	if (data == 1) {
               $("#failer").html(\'<div class="successbox" style="text-align:center; font-weight:bolder">Communication Policies Updated Successfully!</div>\').slideDown(400).delay(2500).slideUp(400);
         } else {
         	 $("#failer").html(data).slideDown(400);

         }

       }

        });
}



	</script>

<div id="failer" style="display:none"></div>
<form id="comm-policy" method="POST">
<span style="font-size: 20px;padding-left:5px">Teacher Communications</span><br />
<div id="jCatch">
		<input type="radio" id="radio1" name="teach" value="1" ' . $check1 . '/><label for="radio1">Allow All</label>
		<input type="radio" id="radio2" name="teach" value="2" ' . $check2 . '/><label for="radio2">Only Teacher - Teacher</label>
                                    <input type="radio" id="radio3" name="teach" value="3" ' . $check3 . '/><label for="radio3">Disable Communications</label>
</div>
<p>
<strong>Allow All</strong>: Allow teachers to communicate with students & teachers.<br />
<strong>Only Teacher - Teacher</strong>: Teachers can only communicate with teachers.<br />
<strong>Disabled</strong>: Teachers cannot communicate with anyone in your school.<br />
</p>

<div style="border-bottom:1px solid #ccc; margin-bottom:10px"></div>
<div id="jCatch1">
<span style="font-size: 20px;padding-left:5px">Student Communications</span><br />
		<input type="radio" id="radio4" name="stud" value="1" ' . $checker1 . '/><label for="radio4">Allow All</label>
		<input type="radio" id="radio5" name="stud" value="2" ' . $checker2 . '/><label for="radio5">Only Teacher - Student</label>
                                    <input type="radio" id="radio6" name="stud" value="3" ' . $checker3 . '/><label for="radio6">Disable Communications</label>
</div>
<p>
<strong>Allow All</strong>: Allow students  to communicate with students & teachers.<br />
<strong>Only Teacher - Student</strong>: Students can only communicate with teachers.<br />
<strong>Disabled</strong>: Students cannot communicate with anyone in your school.<br />
</p>
	<div style="display:none"><input type="password" name="pass" /></div>
</form>
</div>

<div style="clear:both;float:right;margin-top:10px;margin-bottom:5px"><a href="#" onClick="closeBox(); return false" style="float:right" class="button"><img src="' . $imgServer . 'gen/cross.png" />Close</a><a href="#" onClick="updateCommPolicy(); return false" class="button" style="float:right"><img src="' . $imgServer . 'gen/tick.png" />Save Communication Policies</a></div>';

?>
