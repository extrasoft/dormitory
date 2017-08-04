<?php
session_start();
require_once('include/connect.php');
  $id = $_POST['id'];
  $mode = $_POST['mode'];
  $price = $_POST['name'];
  $dom = $_SESSION['dormitory'];

  $query = "UPDATE water_tariffs SET
  water_type = '$mode',
  water_price = '$price',
  dorm_id = '$dom'
  WHERE water_id = '$id'";
  $result = mysqli_query($conn,$query);

  if($result){
    echo "<script>";
    echo "alert(\"แก้ไขค่าน้ำสำเร็จ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterTariffsEdit.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterTariffsEdit.php\" />";
  }

  mysqli_close($conn);

?>
