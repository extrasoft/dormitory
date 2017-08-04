<?php
session_start();
require_once('include/connect.php');

$queryCheck = "SELECT * FROM member WHERE mem_username='$_POST[uname]' OR mem_email='$_POST[email]'";
$resultCheck = mysqli_query($conn,$queryCheck);
$rowCheck = mysqli_num_rows($resultCheck);
if($rowCheck > 0){
  echo '<script>';
  echo 'alert("มีผู้ใช้ Username หรือ Email นี้แล้วกรุณาเปลี่ยนใหม่!")';
  echo '</script>';
  echo "<script language='javascript'>history.back()</script>";
}else{
  $message = '';
  $dir_upload = 'images/img-member/';
  $max_size = 8000000;
  $file = $_FILES['img'];

  $new_name='';

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
  $mem_time = date("Y-m-d");
  $mem_username = $_POST['uname'];
  $mem_password = md5($_POST['uname']+$_POST['pword']+$mem_time);
  $mem_firstname = $_POST['fname'];
  $mem_lastname = $_POST['lname'];
  $mem_address = $_POST['addr'];
  $mem_email = $_POST['email'];
  $mem_emailMD5 = md5($_POST['email']);
  $mem_tel = $_POST['tel'];
  $mem_img = ($new_name != '') ? $new_name : '0.png';
  $mem_type = $_POST['memtype'];

  if($message == '' || $message == 'อัพโหลดสำเร็จ'){
    $query = "INSERT INTO member values(0,
      '$mem_username',
      '$mem_password',
      '$mem_firstname',
      '$mem_lastname',
      '$mem_address',
      '$mem_email',
      '$mem_emailMD5',
      '$mem_tel',
      '$mem_img',
      '$mem_type',
      '$mem_time')";
      $result = mysqli_query($conn,$query);
      if($result){
        echo '<script>';
        echo 'alert("สมัครสมาชิกสำเร็จ!")';
        echo '</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
      }else{
        echo "<script>";
        echo "alert(\"mysqli_error($conn)\")";
        echo "</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
      }
    } else {
      echo "<script>";
      echo "alert(\"$message\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=register.php\" />";
    }
}



  mysqli_close($conn);
  ?>
