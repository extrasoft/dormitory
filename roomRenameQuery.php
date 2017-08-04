<?php
@session_start();
require_once('include/connect.php');
  $query = "SELECT room_id FROM room WHERE  dorm_id = $_SESSION[dormitory]";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_row($result)){
    $newName = $_POST['name'.$row[0]];
    if (!empty($_POST['name'.$row[0]])) {
      $query2 = "UPDATE room set
      room_name = '$newName'
      where room_id = $row[0] AND dorm_id = $_SESSION[dormitory]";
      $result2 = mysqli_query($conn,$query2);
    }
  }
  echo "<script>";
  echo "alert(\"เปลี่ยนชื่อห้องเรียบร้อย\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=roomRename.php\" />";
  mysqli_close($conn);
?>
