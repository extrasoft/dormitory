<?php
@session_start();
require_once('../include/connect.php');

$memID = $_SESSION['id'];
$dormID = $_POST['dorm_id'];
$class = $_POST['class'];
$room = $_POST['room'];

$query = "UPDATE room SET
room_status = 'กำลังตรวจสอบ',
mem_id = '$memID'
WHERE dorm_id = '$dormID'
AND room_name = '$room'";
$result = mysqli_query($conn,$query);
if($result){
  echo "<script>";
  echo "alert(\"ร้องขอการเชื่อมต่อหอพักเรียบร้อย รอการยืนยันจากเจ้าของหอพัก\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\" />";
}else{
  echo "<script>";
  echo "alert(\"mysqli_error($conn)\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
}
?>
