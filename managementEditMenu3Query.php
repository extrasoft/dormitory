<?php
session_start();
require_once('include/connect.php');
$room_id = $_POST['room_id'];
$room_price = $_POST['room_price'];
$room_internet = $_POST['room_internet'];
$room_parking = $_POST['room_parking'];
$room_others = $_POST['room_others'];
$room_accessories = '';
if(!empty($_POST['room_accessories'])){
  $room_accessories = implode(",",$_POST['room_accessories']);
}
$query = "UPDATE room set
room_price = '$room_price',
room_internet = '$room_internet',
room_parking = '$room_parking',
room_others = '$room_others',
room_accessories = '$room_accessories'
where room_id = '$room_id'";
$result = mysqli_query($conn,$query);

if($result){
  echo "<script>";
  echo "alert(\"บันทึกข้อมูลสำเร็จ!\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";

}else{
  echo "<script>";
  echo "alert(\"mysqli_error($conn)\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
}

mysqli_close($conn);
?>
