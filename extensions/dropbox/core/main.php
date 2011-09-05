<?php
/*/
 *  Throughout this file, if a SQL query is over 80 characters long, I will
 *  include a comment with a nicely formatted version of the query.
/*/

function _dropbox_authorize_content($assignment_id,$student_id)
{
  global $user_id;
  global $class_id;
  global $class_level;
  //  Any student other than the user is not allowed to see the content
  if($user_id != $student_id && $class_level == 1)
    return false;
  //  We know that the teacher is part of the class, make sure the assignment is part of it as well
  $result = good_query("SELECT id FROM dropbox_assignments WHERE id = $assignment_id AND class_id = $class_id");
  return (mysqli_num_rows($result) == 1);
}

// function dropbox_allowed_content($content_id)
// {
//   global $user_id;
//   "SELECT cid FROM class_teachers JOIN dropbox_assignments ON dropbox_assignments.class_id = class_teachers.cid JOIN dropbox_content ON dropbox_content.assignment_id = dropbox_assignments.id WHERE class_teachers.uid = 89 AND dropbox_content.filebox_id = 1888";
// }

/*/
 *  Parameters
 *    none
 *
 *  Returns
 *    an array of 'dropbox_assignment' rows, as returned by mysqli_fetch_array
/*/
function dropbox_assignments()
{
  global $class_id;
  /*/
   *  SELECT *
   *  FROM dropbox_assignments
   *  WHERE class_id = $class_id
  /*/
  return good_query_table("SELECT * FROM dropbox_assignments WHERE class_id = $class_id");
}

/*/
 *  Parameters
 *    $student_id: the id of the student for whom you want to get the number
 *                 of files
 *
 *  Returns
 *    A dictionary with the keys being the assignment id and the values being
 *    the number of files given for that assignment
/*/
function dropbox_submitted_count($student_id)
{
  global $class_id;
  /*/
   *  SELECT dropbox_assignments.id, COUNT(dropbox_content.id) AS num_files
   *  FROM dropbox_assignments
   *  JOIN dropbox_content
   *    ON dropbox_assignments.id = dropbox_content.assignment_id
   *  WHERE class_id = $class_id
   *    AND dropbox_content.student_id = $student_id
   *  GROUP BY id
  /*/
  $ret = array();
  $assignments = good_query_table("SELECT dropbox_assignments.id, COUNT(dropbox_content.id) AS num_files FROM dropbox_assignments JOIN dropbox_content ON dropbox_assignments.id = dropbox_content.assignment_id WHERE class_id = $class_id AND dropbox_content.student_id = $student_id GROUP BY id");
  foreach($assignments as $assignment)
  {
    $ret[$assignment['id']] = $assignment['num_files'];
  }
  return $ret;
}

/*/
 *  Parameters
 *    $name: the name of the class. Cannot be null
 *    $date_due: the due date of the assignment. Can be null
 *
 *  Returns
 *    If the assignment was added, returns the new assignment's id. If not
 *    returns false
/*/
function dropbox_add_assignment($name,$date_due)
{
  global $dbc;
  global $class_id;
  global $class_level;
  if($class_level != 3)
    return false;
  $name = mysqli_real_escape_string($dbc,$name);
  $date_due = mysqli_real_escape_string($dbc,$date_due);
  /*/
   *  INSERT INTO dropbox_assignments (class_id,name,date_due)
   *  VALUES ($class_id, '$name', DATE('$date_due'))
  /*/
  good_query("INSERT INTO dropbox_assignments (class_id,name,date_due) VALUES ($class_id,'$name',DATE('$date_due'))");
  return mysqli_insert_id($dbc);
}

/*/ 
 *  Parameters
 *    $assignment_id: the id of the assignment to update. Cannot be null
 *    $name: the new name of the assignment. If null, the name will not change
 *    $date_due: the new due date of the assignment. If null, the due date will
 *               not change
 *
 *  Returns
 *    true if the assignment with id $assignment_id has been updated to reflect
 *    $name and $date_due
/*/
function dropbox_update_assignment($assignment_id, $name, $date_due)
{
  global $class_id;
  global $class_level;
  if($class_level != 3)
    return false;
  if(!$name && !$date_due)
    return true;
  global $dbc;
  $name = mysqli_real_escape_string($dbc,$name);
  $date_due = mysqli_real_escape_string($dbc,$date_due);
  $query = "UPDATE dropbox_assignments SET";
  if($name)
  {
    $query .= " name = '$name'";
    if($date_due)
      $query .= ",";
  }
  if($date_due)
    $query .= " date_due = '$date_due'";
  $query .= " WHERE id = $assignment_id AND class_id = $class_id";
  good_query($query);
  return (mysqli_affected_rows($dbc) != 0);
}

/*/
 *  Parameters
 *    $assignment_id: the id of the assignment to be deleted
 *
 *  Returns
 *    true if the assignment represented by $assignment_id no longer exists.
 *    false otherwise.
/*/
function dropbox_delete_assignment($assignment_id)
{
  global $class_id;
  global $class_level;
  if($class_level != 3)
    return false;
  global $dbc;
  /*/
   *  DELETE FROM dropbox_assignments
   *  WHERE id = $assignment_id AND class_id = $class_id
  /*/
  good_query("DELETE FROM dropbox_assignments WHERE id = $assignment_id AND class_id = $class_id");
  return (mysqli_affected_rows($dbc) != 0);
}

function dropbox_view_content($content_id,$assignment_id,$student_id)
{
  global $class_id;
  global $class_level;
  if($class_level != 3)
    return NULL;
  /*/
   *  
  /*/
  $result = good_query_table("SELECT * FROM dropbox_content WHERE id = $content_id AND assignment_id = $assignment_id AND student_id = $student_id");
  if(count($result) != 1)
    return NULL;
  return $result[0];
}

/*/
 *  Parameters
 *    $assignment_id: the assignment for which the contents should be retrieved
 *    $student_id: the student whose files we will be retrieving
 *
 *  Returns
 *    An array of files (as represented by the filebox_content)
/*/
function dropbox_contents($assignment_id,$student_id)
{
  global $class_id;
  global $class_level;
  
  if(!_dropbox_authorize_content($assignment_id,$student_id))
    return NULL;
  
  /*/
   *  SELECT *
   *  FROM dropbox_content
   *  JOIN filebox_formats
   *    ON filebox_formats.format_id = dropbox_content.format
   *  WHERE assignment_id = $assignment_id
   *    AND student_id = $student_id
  /*/
  return good_query_table("SELECT dropbox_content.*, filebox_formats.format_name, filebox_formats.icon FROM dropbox_content JOIN filebox_formats ON filebox_formats.format_id = dropbox_content.format WHERE assignment_id = $assignment_id AND student_id = $student_id");
}

/*/
 *  Parameters
 *    $assignment_id: the assignment to update
 *    $student_id: the student to update
 *    $files: an array of arrays, the deeper of which having two keys, the id
 *            and the type (1 for file, and a 2 for folder)
 *
 *  Returns
 *    true or false, based on whether it succeeded
/*/
function dropbox_add_files($assignment_id,$student_id,$file_ids)
{
  global $user_id;
  global $class_id;
  //  The only person who can set the content is the user
  if($student_id != $user_id)
    return false;
  $ids = implode(",",$file_ids);
  $files = good_query_table("SELECT * FROM filebox_content WHERE id IN ($ids) AND uid = $student_id");
  
  //  Ha! I bet you though there would be a comment here! Well it's a dynamic 
  //  query so FUCK YOU!
  $query = "INSERT INTO dropbox_content (format,student_id,assignment_id,name,body,content,ext,file_type,size,time_date) VALUES ";
  $value_string_array = array();
  foreach($files as $file)
  {
    $value_string_array[] = "({$file['format']},$student_id,$assignment_id,'{$file['name']}','{$file['body']}','{$file['content']}','{$file['ext']}','{$file['file_type']}','{$file['size']}',NOW())";
  }
  $query .= implode(",",$value_string_array);
  good_query($query);
  
  return true;
}

function dropbox_remove_files($assignment_id,$student_id,$file_ids)
{
  global $dbc;
  global $user_id;
  global $class_id;
  if($student_id != $user_id)
    return false;
  $ids = implode(",",$file_ids);
  good_query("DELETE FROM dropbox_content WHERE id IN ($ids) AND student_id = $student_id AND assignment_id = $assignment_id");
  return (mysqli_affected_rows($dbc) != 0);
}

/*/
 *  Parameters
 *    $assignment_id: the assignment to query
 *
 *  Returns
 *    an array of dictionaries. Dictionary has keys 'id','first_name',
 *    'last_name', and 'num_content'
/*/
function dropbox_submitted_students($assignment_id)
{
  /*/
   *  SELECT DISTINCT users.id, COUNT(dropbox_content.filebox_id) AS num_content 
   *  FROM dropbox_content 
   *  JOIN users 
   *    ON users.id = dropbox_content.student_id 
   *  WHERE dropbox_content.assignment_id = $assignment_id
  /*/
  $query = "SELECT DISTINCT users.id, COUNT(dropbox_content.id) AS num_content  FROM dropbox_content JOIN users ON users.id = dropbox_content.student_id WHERE dropbox_content.assignment_id = $assignment_id";
  $students = good_query_table($query);
  $ret = array();
  foreach($students as $student)
    $ret[$student['id']] = $student['num_content'];
  return $ret;
}

function buttonize_students($students, $submitted_details){
  $deadbeats = array();
  //show students that have submitted stuff first
  foreach($students as $student){
    $id = $student['id'];
    if(!$submitted_details[$id]){
      $deadbeats[] = $student;
    }
    else{
      $submitted_files = $submitted_details[$id];
      $_student_string = "<div class='lecEl fullRound student_selecter' id=" . $id . ">";
      $_student_string .= "<img src='/app/core/site_img/gen/dropbox_view.png' style='float:left;width:40px;margin-right:10px' />";
      $_student_string .= "<div class='dropbox_student_name'>" . $student['first_name']. " " . $student['last_name'] . "</div>";
      if($submitted_files == 1){
        $_student_string .= "<div class='file_count files'><span class='amount'>$submitted_files</span> file submitted</div>". "</div>";
      }
      else{
        $_student_string .= "<div class='file_count files'><span class='amount'>$submitted_files</span> files submitted</div>". "</div>";
      }
      echo $_student_string;
    }
  }
  //display students that haven't submitted files for the assignment
  foreach($deadbeats as $student){
    $id = $student['id'];
    $_student_string = "<div class='lecEl fullRound student_selecter' float='right' id=" . $id . ">";
    $_student_string .= "<img src='/app/core/site_img/gen/dropbox_view.png' style='float:left;width:40px;margin-right:10px' />";
    $_student_string .= "<div class='dropbox_student_name'>" . $student['first_name']. " " . $student['last_name'] . "</div>";
    $_student_string .= "<div class='file_count dropbox_view'><span class='none'>No files submitted</span></div>". "</div>";
    echo $_student_string;
  }
}


function check_date_format($date){
  $dateparts = preg_split("-", $date);
  return checkdate($dateparts[1], $dateparts[2], $dateparts[0]);
}


function dropbox_get_assignment($aid)
{
  global $class_id;
  return good_query_table("SELECT * FROM dropbox_assignments WHERE class_id = $class_id AND id = $aid");
}
?>
