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
  return true;
}

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
   *  SELECT dropbox_assignments.*, COUNT(dropbox_content.filebox_id) AS num_files
   *  FROM dropbox_assignments
   *  JOIN dropbox_content
   *    ON dropbox_assignments.id = dropbox_content.assignment_id
   *  WHERE class_id = $class_id
   *    AND dropbox_content.student_id = $student_id
   *  GROUP BY id
  /*/
  $ret = array();
  $assignments = good_query_table("SELECT id, COUNT(dropbox_content.filebox_id) AS num_files FROM dropbox_assignments JOIN dropbox_content ON dropbox_assignments.id = dropbox_content.assignment_id WHERE class_id = $class_id AND dropbox_content.student_id = $student_id GROUP BY id");
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
   *  SELECT filebox_content.id,filebox_content.name,filebox_content.format,filebox_formats.format_name,filebox_formats.icon
   *  FROM dropbox_content
   *  JOIN filebox_content
   *    ON filebox_content.id = dropbox_content.filebox_id
   *  JOIN filebox_formats
   *    ON filebox_content.format = filebox_formats.format_id
   *  WHERE assignment_id = $assignment_id
   *    AND student_id = $student_id
  /*/
  return good_query_table("SELECT filebox_content.id,filebox_content.name,filebox_content.format,filebox_formats.format_name,filebox_formats.icon FROM dropbox_content JOIN filebox_content ON filebox_content.id = dropbox_content.filebox_id JOIN filebox_formats ON filebox_content.format = filebox_formats.format_id WHERE assignment_id = $assignment_id AND student_id = $student_id");
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
function dropbox_set_contents($assignment_id,$student_id,$files)
{
  global $dbc;
  global $user_id;
  global $class_id;
  
  if(!_dropbox_authorize_content($assignment_id,$student_id))
    return false;
  mysqli_autocommit($dbc, false);
  /*/
   *  DELETE FROM dropbox_content 
   *  WHERE assignment_id = $assignment_id 
   *    AND student_id = $student_id
  /*/
  $query = "DELETE FROM dropbox_content WHERE assignment_id = $assignment_id AND student_id = $student_id";
  mysqli_query($dbc, $query);
  
  //  Ha! I bet you though there would be a comment here! Well it's a dynamic 
  //  query so FUCK YOU!
  $query = "INSERT INTO dropbox_content (assignment_id,student_id,filebox_id) VALUES ";
  $length = count($files);
  for($i = 0 ; $i < $length ; $i++)
  {
    $file = $files[$i];
    $query .= '('.$assignment_id.','.$student_id.','.$file.')';
    if($i != ($length-1))
      $query .= ", ";
  }
  //  If the length is 0, then we get a invalid query, which means that
  //  nothing changes. So if length is 0, don't bother submitting the query
  if($length != 0)
    mysqli_query($dbc,$query);
  
  mysqli_commit($dbc);
  mysqli_autocommit($dbc, true);
  
  return true;
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
  $query = "SELECT DISTINCT users.id, COUNT(dropbox_content.filebox_id) AS num_content  FROM dropbox_content JOIN users ON users.id = dropbox_content.student_id WHERE dropbox_content.assignment_id = $assignment_id";
  $students = good_query_table($query);
  $ret = array();
  foreach($students as $student)
    $ret[$student['id']] = $student['num_content'];
  return $ret;
}

function buttonize_submitted_student($student){
  $_student_string = "<div class='assignmentButton' id=" . $student['id'] . ">";
  $_student_string .= $student['first_name']. " " . $student['last_name']. "</div>";
  return $_student_string;
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
