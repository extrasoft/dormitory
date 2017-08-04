<?php
session_start();
require_once('include/connect.php');

$message = '';
$dir_upload = 'images/img-room/';
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

$room_id = $_POST['room_id'];
$room_img = implode(",",$arr);

if($message == '' || $message == 'อัพโหลดสำเร็จ'){
	$query = "UPDATE room set
	room_img = '$room_img'
	where room_id = '$room_id'";
	$result = mysqli_query($conn,$query);
	if($result){
	  echo "<script>";
	  echo "alert(\"อัพโหลดสำเร็จ\")";
	  echo "</script>";
	  echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";

	}else{
	  echo "<script>";
	  echo "alert(\"mysqli_error($conn)\")";
	  echo "</script>";
	  echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
	}
} else {
    echo "<script>";
    echo "alert(\"$message\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=management.php\" />";
  }

mysqli_close($conn);
?>
