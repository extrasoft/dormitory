<?php
session_start();
require_once('include/connect.php');

  $name = $_POST['name'];
  $price = $_POST['price'];
  $id = $_SESSION['dormitory'];
  $query = "insert into accessories values(0,
  '$name',
  '$price',
  '$id')";
  $result = mysqli_query($conn,$query);
  if($result){
    header("location:accessories.php");
    echo "success";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=accessories.php\" />";
  }
  mysqli_close($conn);
?>
