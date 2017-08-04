<?php
session_start();
require_once('include/connect.php');
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $dormID = $_SESSION['dormitory'];
  $query = "UPDATE accessories set
  accs_name = '$name',
  accs_price = '$price',
  dorm_id = '$dormID'
  where accs_id = '$id'";
  $result = mysqli_query($conn,$query);
  if($result){
    header('location:accessories.php');
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=accessories.php\" />";
  }
  mysqli_close($conn);
?>
