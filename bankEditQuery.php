<?php
session_start();
require_once('include/connect.php');
  $id = $_POST['id'];
  $bank = substr($_POST['bank'],1);
  $branch = $_POST['branch'];
  $name = $_POST['name'];
  $number = $_POST['number'];
  $img = substr($_POST['bank'], 0, 1).'.png';
  $dormID = $_SESSION['dormitory'];
  $query = "UPDATE bank set
  bank_bank = '$bank',
  bank_branch = '$branch',
  bank_name = '$name',
  bank_number = '$number',
  bank_img = '$img',
  dorm_id = '$dormID'
  where bank_id = '$id'";
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
