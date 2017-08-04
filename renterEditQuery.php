<?php
session_start();
require_once('include/connect.php');
$rent_id = $_POST['id'];
$rent_firstname = $_POST['fname'];
$rent_lastname = $_POST['lname'];
$rent_address = $_POST['addr'];
$rent_email = $_POST['email'];
$rent_tel = $_POST['tel'];
$mem_id = $_SESSION['id'];

$query = "UPDATE renter set
rent_firstname = '$rent_firstname',
rent_lastname = '$rent_lastname',
rent_address = '$rent_address',
rent_email = '$rent_email',
rent_tel = '$rent_tel'
where rent_id = '$rent_id'";
$result = mysqli_query($conn,$query);
if($result){
  header("location:renter.php");
  echo "success";
}else{
  echo "<script>";
  echo "alert(\"mysqli_error($conn)\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=renter.php\" />";
}

mysqli_close($conn);
?>
