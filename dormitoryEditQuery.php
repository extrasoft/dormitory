<?php
@session_start();
require_once('include/connect.php');

  $dom_name = $_POST['name'];
  $dom_address = $_POST['address'];
  $dom_tel = $_POST['tel'];
  $dom_email = $_POST['email'];
  $water = $_POST['water'];
  $electric = $_POST['electric'];
  $mem_id = $_SESSION['id'];
  $query = "UPDATE dormitory SET
  dorm_name = '$dom_name',
  dorm_address = '$dom_address',
  dorm_tel = '$dom_tel',
  dorm_email = '$dom_email',
  dorm_water = '$water',
  dorm_electric = '$electric',
  mem_id = '$mem_id'
  WHERE dorm_id = '$_SESSION[dormitory]'";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"แก้ไขตึกเรียบร้อย\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=dormitoryEdit.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=dormitoryEdit.php\" />";
  }
  mysqli_close($conn);
?>
