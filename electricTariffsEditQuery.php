<?php
session_start();
require_once('include/connect.php');

$id = $_POST['id'];
$mode = $_POST['mode'];
$price = $_POST['name'];
$dom = $_SESSION['dormitory'];

$query = "UPDATE electric_tariffs SET
electric_type = '$mode',
electric_price = '$price',
dorm_id = '$dom'
WHERE electric_id = '$id'";
$result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"แก้ไขค่าไฟสำเร็จ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricTariffsEdit.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricTariffsEdit.php\" />";
  }
  mysqli_close($conn);

?>
