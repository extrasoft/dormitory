<?php
session_start();
require_once('include/connect.php');

$bill_id = $_POST['id'];
$status = $_POST['bill_status'];
$bill_payment = date("Y-m-d H:i:s");

$query = "UPDATE bills SET
bill_status = '$status'
WHERE bill_id = '$bill_id'";
$result = mysqli_query($conn,$query);
if($result){
	echo "<script>";
	echo "alert(\"ยืนยันการชำระเงินเรียบร้อย\")";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=payment.php\" />";
}else{
	echo "<script>";
	echo "alert(\"$message.mysqli_error($conn)\")";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=payment.php\" />";
}

mysqli_close($conn);
?>
