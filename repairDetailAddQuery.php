<?php
session_start();
require_once('include/connect.php');

$subDay = substr($_POST['rDate'],0,2);
$subMonth = substr($_POST['rDate'],3,2);
$subYear = substr($_POST['rDate'],6,4)-543;

  $repd_name = $_POST['name'];
  $repd_price = $_POST['price'];
  $repd_amount = $_POST['amount'];
  $repd_date = $subYear.'-'.$subMonth.'-'.$subDay;
  $emp_id = $_POST['empID'];
  $rep_id = $_POST['repID'];
  $mem_id = $_SESSION['id'];
  $query = "insert into repair_detail values(0,
  '$repd_name',
  '$repd_price',
  '$repd_amount',
  '$repd_date',
  '$emp_id',
  '$rep_id',
  '$mem_id')";

  $result = mysqli_query($conn,$query);
  if($result){
    header("location:repairDetail.php");
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=repairDetail.php\" />";
  }

  mysqli_close($conn);
?>
