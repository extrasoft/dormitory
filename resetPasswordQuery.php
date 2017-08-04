<?php
session_start();
require_once('include/connect.php');

$mem_password = md5($_POST['pwordNew']);

$query = "UPDATE member SET mem_password = '$mem_password' WHERE mem_emailMD5='$_POST[mdEmail]'";
$result = mysqli_query($conn,$query);
if($result){
  echo '<script>';
  echo 'alert("เปลี่ยนรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบ!")';
  echo '</script>';
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
}else{
  echo "<script>";
  echo "alert(\"mysqli_error($conn)\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
}

mysqli_close($conn);
?>
