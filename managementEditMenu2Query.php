<?php
session_start();
require_once('include/connect.php');

$subDay = substr($_POST['room_lease'],0,2);
$subMonth = substr($_POST['room_lease'],3,2);
$subYear = substr($_POST['room_lease'],6,4)-543;


$subDayEnd = substr($_POST['room_lease_end'],0,2);
$subMonthEnd = substr($_POST['room_lease_end'],3,2);
$subYearEnd = substr($_POST['room_lease_end'],6,4)-543;

$room_id = $_POST['room_id'];
$room_lease = $subYear.'-'.$subMonth.'-'.$subDay;
$room_lease_end = $subYearEnd.'-'.$subMonthEnd.'-'.$subDayEnd;
$room_money = $_POST['room_money'];
$room_water = $_POST['room_water'];
$room_electric = $_POST['room_electric'];
if(!empty($_POST['room_guest'])){
  $room_guest = $_POST['room_guest'];
}else{
  $room_guest = 0;
}

$query = "UPDATE room set
room_guest = '$room_guest',
room_lease = '$room_lease',
room_lease_end = '$room_lease_end',
room_money = '$room_money',
room_water = '$room_water',
room_electric = '$room_electric'
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
