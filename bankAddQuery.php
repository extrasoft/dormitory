<?php
session_start();
require_once('include/connect.php');

  $bank = substr($_POST['bank'],1);
  $branch = $_POST['branch'];
  $name = $_POST['name'];
  $number = $_POST['number'];
  $img = substr($_POST['bank'], 0, 1).'.png';
  $id = $_SESSION['dormitory'];
  $query = "insert into bank values(0,
  '$bank',
  '$branch',
  '$name',
  '$number',
  '$img',
  '$id')";
  $result = mysqli_query($conn,$query);
  if($result){
    header("location:bank.php");
    echo "success";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php\" />";
  }
  mysqli_close($conn);
?>
