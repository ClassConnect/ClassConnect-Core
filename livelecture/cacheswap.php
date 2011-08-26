<?php
// include core stuff
require_once('../core/inc/coreInc.php');
require_once('../core/inc/func/app/fileBox/main.php');
require_once('../extensions/liveLecture/core/main.php');
/*
Load a livelecture for presentation
 *
 * LID = cached
 * FID = filebox LL
 */
if (isset($_GET['fid'])) {
    if (auth_content($_GET['fid'], $user_id)) {
        $class_id = escape($_GET['classID']);
        if (checkClassOwner($class_id) == true){
            $liveLec = get_content($_GET['fid']);
            $llc_id = createLLC($liveLec['name'], $liveLec['content'], $class_id);
            
            // get students
            $students = getClassStudents($class_id, 1);
            //// loop through students array
            foreach ($students as $student) {
                $userIDs = $userIDs . $student['id'] . ',';
            }
            blastNodeification($userIDs, 5, 0, 'add');

            header('location:/app/livelecture/Presenter/index.php?lid=' . $llc_id);
            exit();
            
        } else {
            $error = 'This user is not a teacher in the provided class.';
        }
    } else {
        $error = 'Could not authorize user to access this file.';
    }

} else {
    $error = 'No file provided.';
}
echo $error;
?>
