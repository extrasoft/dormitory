<?php
session_start();
require_once('include/connect.php');

  $mode = $_POST['mode'];
  $name = $_POST['name'];
  $dom = $_SESSION['dormitory'];

  $query = "insert into water_tariffs values(0,
  '$mode',
  '$name',
  '$dom')";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"เพิ่มค่าน้ำสำเร็จ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricTariffs.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterTariffs.php\" />";
  }
  mysqli_close($conn);

?>
