<?php
session_start();
require_once('include/connect.php');

$subDay = substr($_POST['par_date'],0,2);
$subMonth = substr($_POST['par_date'],3,2);
$subYear = substr($_POST['par_date'],6,4)-543;

$par_id = $_POST['par_id'];
$par_name = $_POST['name'];
$par_addr = $_POST['detail'];
$par_date = $subYear.'-'.$subMonth.'-'.$subDay;
$dorm_id = $_SESSION['dormitory'];

  $query = "UPDATE parcel SET
    par_name = '$par_name',
    par_address = '$par_addr',
    par_date = '$par_date'
    WHERE par_id = '$par_id'";
    $result = mysqli_query($conn,$query);

    if($result){
      echo "<script>";
      echo "alert(\"แก้ไขข้อมูลพัสดุสำเร็จ!\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=parcel.php\" />";
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=parcel.php\" />";
    }

  mysqli_close($conn);
  ?>
