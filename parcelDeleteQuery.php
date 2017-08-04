<?php
session_start();
require_once('include/connect.php');

$par_id = $_POST['par_id'];

$query = "DELETE FROM parcel
WHERE par_id = '$par_id'";
$result = mysqli_query($conn,$query);
if($result){
  echo "<script>";
  echo "alert(\"ลบข้อมูลสำเร็จ!\")";
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
