<?php
session_start();
require_once('include/connect.php');

$message = '';
$dir_upload = 'images/img-parcel/';
$max_size = 8000000;
$file = $_FILES['img'];
$count = (count($file['name']));
//print_r($file);
$arr = array();
$new_name="";

for ($i=0; $i < $count; $i++) {
  if ($file['size'][$i] <= $max_size && $file['size'][$i] > 0) {
    $new_name = time() . '-' . $file['name'][$i];
    $copied = copy($file['tmp_name'][$i], $dir_upload . $new_name);
    array_push($arr,$new_name);
    if ($copied) {
      $message = 'อัพโหลดสำเร็จ';
    } else {
      $message = 'อัพโหลดผิดพลาด!';
    }
  }else if($file['name'][$i] == ""){
    $message = '';
  }else {
    $message = 'อัพโหลดผิดพลาดขนาดไฟล์รูปใหญ่กว่า 8mb กรุณาทำการอัพโหลดใหม่อีกครั้ง';
  }
}
$subDay = substr($_POST['par_date'],0,2);
$subMonth = substr($_POST['par_date'],3,2);
$subYear = substr($_POST['par_date'],6,4)-543;

$par_name = $_POST['name'];
$par_addr = $_POST['detail'];
$par_date = $subYear.'-'.$subMonth.'-'.$subDay;
$par_img = implode(",",$arr);
$dorm_id = $_SESSION['dormitory'];

if($message == '' || $message == 'อัพโหลดสำเร็จ'){

  $query = "INSERT INTO parcel VALUES(0,
    '$par_name',
    '$par_addr',
    '$par_date',
    '$par_img',
    '$dorm_id')";
    $result = mysqli_query($conn,$query);
    if($result){
      echo "<script>";
      echo "alert(\"เพิ่มข้อมูลพัสดุสำเร็จ!\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=parcel.php\" />";
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=parcel.php\" />";
    }
  } else {
    echo "<script>";
    echo "alert(\"$message\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=parcel.php\" />";
  }

  mysqli_close($conn);
  ?>
