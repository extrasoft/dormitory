<?php
session_start();
require_once('include/connect.php');
  $id = $_POST['id'];
  $rStatus = $_POST['rep_status'];
  $dormID = $_SESSION['dormitory'];
  $query = "UPDATE repair set
  rep_status = '$rStatus'
  where rep_id = '$id'";
  $result = mysqli_query($conn,$query);
  if($result){
    header('location:repair.php');
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=repair.php\" />";
  }
  mysqli_close($conn);
?>
