<?php
session_start();
require_once('include/connect.php');
$emp_id = $_POST['id'];
$emp_firstname = $_POST['fname'];
$emp_lastname = $_POST['lname'];
$emp_address = $_POST['addr'];
$emp_email = $_POST['email'];
$emp_tel = $_POST['tel'];
$emp_position = $_POST['position'];
$emp_salary = $_POST['salary'];
$mem_id = $_SESSION['id'];

$query = "UPDATE employee set
emp_firstname = '$emp_firstname',
emp_lastname = '$emp_lastname',
emp_address = '$emp_address',
emp_email = '$emp_email',
emp_tel = '$emp_tel',
emp_position= '$emp_position',
emp_salary = '$emp_salary'
where emp_id = '$emp_id'";

$result = mysqli_query($conn,$query);
if($result){
  header("location:employees.php");
}else{
  echo "<script>";
  echo "alert(\"mysqli_error($conn)\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=employees.php\" />";
}

mysqli_close($conn);
?>
