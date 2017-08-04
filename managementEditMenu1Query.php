<?php
session_start();
require_once('include/connect.php');
$message = '';
//ส่วนของการอนุมัติหรือยกเลิกผู้เช่า
if($_GET['state'] == 'approve'){
  $queryApprove = "UPDATE room SET room_status = 'ห้องมีผู้เช่า' WHERE room_id = '$_GET[id]'";
  $result = mysqli_query($conn,$queryApprove);
  $message = 'อนุมัติผู้เช่าเรียบร้อย';
  if($result){
    echo "<script>";
    echo "alert(\"$message!\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
  }
}else if($_GET['state'] == 'cancel'){
  $queryApprove = "UPDATE room SET
                   room_guest = 0,
                   room_price = 0,
                   room_internet = 0,
                   room_parking = 0,
                   room_others = 0,
                   room_accessories = null,
                   room_discount = 0,
                   room_status = 'ห้องว่าง' ,
                   room_lease = null,
                   room_lease_end = null,
                   room_money = 0,
                   room_water = 0,
                   room_electric = 0,
                   room_img = null,
                   rent_id='0',
                   mem_id='0'
                   WHERE room_id = '$_GET[id]'";

  $result = mysqli_query($conn,$queryApprove);
  $message = 'ยกเลิกผู้เช่าเรียบร้อย';
  if($result){
    echo "<script>";
    echo "alert(\"$message!\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
  }

}else if($_GET['state'] == 'add'){
  $queryApprove = "UPDATE room SET room_status = 'ห้องมีผู้เช่า',rent_id='$_POST[rentID]' WHERE room_id = '$_GET[id]'";
  $result = mysqli_query($conn,$queryApprove);
  $message = 'เพิ่มผู้เช่าเรียบร้อย';
  if($result){
    echo "<script>";
    echo "alert(\"$message!\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
  }
}

?>
