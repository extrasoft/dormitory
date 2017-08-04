<?php
require_once('include/connect.php');
  $id = $_POST['id'];
  $query = "DELETE FROM bank where bank_id = '$id'";
  $result = mysqli_query($conn,$query);
  if($result){
    header('location:bank.php');
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php\" />";
  }
  mysqli_close($conn);
?>
