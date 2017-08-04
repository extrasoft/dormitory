<?php
@session_start();
require_once('include/connect.php');
//print_r($_POST['name']);
//print_r($_POST['id']);
$name = $_POST['name'];
$id = $_POST['id'];
$count = count($_POST['id']);
for ($i=0; $i < $count; $i++) {
  if(!empty($name[$i])){
    $query = "UPDATE room set
    room_name = '$name[$i]'
    where room_id = $id[$i]";
    $result = mysqli_query($conn,$query);
  }
}
  echo "<script>";
  echo "alert(\"เปลี่ยนชื่อห้องเรียบร้อย\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=roomRenameEdit.php\" />";
  mysqli_close($conn);
?>
