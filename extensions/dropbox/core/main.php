<?php

/*/
 *  Parameters
 *    none
 *
 *  Returns
 *    an array of 'dropbox_assignment' rows, as returned by mysqli_fetch_array
/*/
function dropbox_assignments()
{
  return good_query_table("SELECT * \
                           FROM dropbox_assignments \
                           WHERE class_id = $class_id");
}

/*/
 *  Parameters
 *    $name: the name of the class. Cannot be null
 *    $date_due: the due date of the assignment. Can be null
 *
 *  Returns
 *    true or false, based on whether it succeeded
/*/
function dropbox_add_assignment($name,$date_due)
{
  if($class_level != 3)
    return false;
  $name = mysqli_real_escape_string($name);
  $date_due = mysqli_real_escape_string($date_due);
  good_query("INSERT INTO dropbox_assignments (class_id,name,date_due) \
              VALUES ($class_id,'$name','$date_due')");
  return true
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
  if($class_level != 3)
    return false;
  if(!$name && !$date_due)
    return true;
  global $dbc;
  $query = "UPDATE dropbox_assignments SET";
  if($name)
  {
    $query += " name = '$date_due'";
    if($date_due)
      $query += ",";
  }
  if($date_due)
    $query += " date_due = '$date_due'";
  $query += " WHERE id = $assignment_id AND class_id = $class_id";
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
  if($class_level != 3)
    return false;
  global $dbc;
  good_query("DELETE FROM dropbox_assignments WEHRE id = $assignment_id AND class_id = $class_id");
  return (mysqli_affected_rows($dbc) != 0);
}

/*/
 *  Parameters
 *    $assignment_id: the assignment for which the contents should be retrieved
 *    $student_id: the student whose files we will be retrieving
 *
 *  Returns
 *    An array with two keys: 'files' and 'folders'. The value of those keys
 *    will be arrays 'filebox_content'/'filebox_folder' rows (respectively)
 *    from the database (as they are retrieved by mysqli_fetch_array). If the
 *    current user does not have permission to see the content, returns null
/*/
function dropbox_contents($assignment_id,$student_id)
{
  if($class_level != 3)
    return null;
  //  Wow, I hate when I have to write queries like that. 
  $query = "SELECT filebox_id, filebox_type \
            FROM dropbox_content \
            JOIN dropbox_assignments \
            ON dropbox_content.assignment_id = dropbox_assignments.id \
            WHERE dropbox_assignments.class_id = $class_id \
              AND assignment_id = $assignment_id \
              AND student_id = $student_id";
  $contents = good_query_table($query);
  $file_query = "SELECT * FROM filebox_content WHERE id IN (";
  $folder_query = "SELECT * FROM filebox_folders WHERE id IN (";
  foreach($contents as $content)
  {
    if($contents["filebox_type"] == 1)
      $file_query += $contents["filebox_id"];
    else
      $folder_query += $contents["filebox_id"];
  }
  $files = good_query_table($file_query);
  $folders = good_query_table($folder_query);
  return array('files' => $files, 'folders' => $folders);
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
  if($class_level != 3)
    return false;
  
  global $dbc;
  mysqli_autocommit($dbc, false);

  //  Delete all the current content
  $query = "DELETE FROM dropbox_content \
            WHERE assignment_id = $assignment_id \
              AND student_id = $student_id";
  mysqli_query($dbc, $query);

  $query = "INSERT INTO dropbox_content (assignment_id,student_id,filebox_id,filebox_type) VALUES ";
  $length = count($files);
  for($i = 0 ; $i < $length ; $i++)
  {
    $query += '('.$assignment_id.','.$student_id.','.$files["id"].','.$files["type"].')'
    if($i != ($length-1))
      $query += ", "
  }
  mysqli_query($dbc,$query);

  mysqli_commit($dbc);
  mysqli_autocommit($dbc, true);
}

/*/
 *  Parameters
 *    $assignment_id: the assignment to query
 *
 *  Returns
 *    an array of 'user' rows from the database, as they are retrieved via
 *    mysqli_fetch_array()
/*/
function dropbox_submitted_students($assignment_id)
{
  $query = "SELECT DISTINCT users.* \
            FROM dropbox_content \
            JOIN users ON users.id = dropbox_content.student_id \
            WHERE dropbox_content.assignment_id = $assignment_id";
  return good_query_table($query);
}

?>