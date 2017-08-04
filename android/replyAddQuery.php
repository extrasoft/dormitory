<?php
session_start();
require_once('../include/connect.php');

$message = '';
$dir_upload = '../images/img-reply/';
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

$reply_detail = $_POST['detail'];
$reply_img = implode(",",$arr);
$reply_date = date("Y-m-d H:i:s");
$topic_id = $_POST['id'];
$mem_id = $_SESSION['id'];
$dorm_id = $_SESSION['dormSelect'];

if($message == '' || $message == 'อัพโหลดสำเร็จ'){
  $query = "INSERT INTO reply VALUES(0,
    '$reply_detail',
    '$reply_img',
    '$reply_date',
    '$topic_id',
    '$mem_id',
    '$dorm_id')";
    $result = mysqli_query($conn,$query);
    if($result){
      $query2 = "UPDATE topic SET
                 topic_reply=topic_reply+1,
                 topic_view=topic_view-1
                 WHERE topic_id='$topic_id'";
      $result2 = mysqli_query($conn,$query2);
      echo '<script>';
      echo 'alert("แสดงความคิดเห็นสำเร็จ!")';
      echo '</script>';
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=webboardDetail.php?id=$topic_id\" />";
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=webboardDetail.php?id=$topic_id\" />";
    }
  } else {
    echo "<script>";
    echo "alert(\"$message\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=webboardDetail.php?id=$topic_id\" />";
  }

  mysqli_close($conn);
  ?>
