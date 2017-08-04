<?php
require_once('include/connect.php');

$bill_id = $_POST['bill_id'];
$bill_payment = date("Y-m-d H:i:s");
$query = "UPDATE bills SET
 bill_status = 'ชำระเงินเรียบร้อย',
 bill_payment = '$bill_payment'
 WHERE bill_id = '$bill_id'";
 $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"ยืนยันการชำระเงินเรียบร้อย!\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bill.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bill.php\" />";
  }

  mysqli_close($conn);

  ?>
