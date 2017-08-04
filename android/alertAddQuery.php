<?php
session_start();
require_once('../include/connect.php');

$message = '';
$dir_upload = '../images/img-repair/';
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


$repair_topic = $_POST['topic'];
$repair_detail = $_POST['detail'];
$repair_img = implode(",",$arr);
$repair_date = date("Y-m-d H:i:s");
$room_id = $_SESSION['roomSelect'];
$dorm_id = $_SESSION['dormSelect'];

if($message == '' || $message == 'อัพโหลดสำเร็จ'){
  $query = "INSERT INTO repair VALUES(0,
    '$repair_topic',
    '$repair_detail',
    '$repair_img',
    '$repair_date',
    'รอการตรวจสอบ',
    '$room_id',
    '$dorm_id')";

    $result = mysqli_query($conn,$query);
    if($result){
      echo '<script>';
      echo 'alert("แจ้งเหตุขัดข้องสำเร็จ!")';
      echo '</script>';
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=alert.php\" />";
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=alert.php\" />";
    }

  } else {
    echo "<script>";
    echo "alert(\"$message\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=alert.php\" />";
  }

  mysqli_close($conn);
  ?>
