<?php
session_start();
require_once('include/connect.php');

  $emp_firstname = $_POST['fname'];
  $emp_lastname = $_POST['lname'];
  $emp_address = $_POST['addr'];
  $emp_email = $_POST['email'];
  $emp_tel = $_POST['tel'];
  $mem_id = $_SESSION['id'];

  $query = "insert into renter values(0,
  '$emp_firstname',
  '$emp_lastname',
  '$emp_address',
  '$emp_email',
  '$emp_tel',
  '$mem_id')";
  $result = mysqli_query($conn,$query);
  if($result){
    header("location:renter.php");
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=renter.php\" />";
  }
  mysqli_close($conn);
?>
