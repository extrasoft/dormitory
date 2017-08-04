<?php
session_start();
require_once('include/connect.php');

$message = '';
$dir_upload = 'images/img-member/';
$max_size = 8000000;
$file = $_FILES['img'];

$new_name='';

if($file['name'] != ""){
  if ($file['size'] <= $max_size && $file['size'] > 0) {
    $new_name = time() . '-' . $file['name'];
    $copied = copy($file['tmp_name'] , $dir_upload . $new_name);
    if ($copied) {
      $message = 'อัพโหลดสำเร็จ';
    } else {
      $message = 'อัพโหลดผิดพลาด!';
    }
  }else if($file['name'] == ""){
    $message = '';
  }else {
    $message = 'อัพโหลดผิดพลาดขนาดไฟล์รูปใหญ่กว่า 8mb กรุณาทำการอัพโหลดใหม่อีกครั้ง';
  }
}else{
  $new_name= $_POST['imgOld'];
}


$mem_id = $_POST['memId'];
$mem_firstname = $_POST['fname'];
$mem_lastname = $_POST['lname'];
$mem_address = $_POST['addr'];
$mem_tel = $_POST['tel'];
$mem_img = $new_name;

if($message == '' || $message == 'อัพโหลดสำเร็จ'){
  $query = "UPDATE member SET
    mem_firstname = '$mem_firstname',
    mem_lastname = '$mem_lastname',
    mem_address = '$mem_address',
    mem_tel = '$mem_tel',
    mem_img = '$mem_img'
    WHERE mem_id = '$mem_id'";

    $result = mysqli_query($conn,$query);
    if($result){
      echo '<script>';
      echo 'alert("แก้ไขโปรไฟล์สำเร็จ!")';
      echo '</script>';
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=profileEdit.php\" />";
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=profileEdit.php\" />";
    }
  } else {
    echo "<script>";
    echo "alert(\"$message\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=profileEdit.php\" />";
  }

  mysqli_close($conn);
  ?>
