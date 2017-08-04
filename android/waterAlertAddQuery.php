<?php
@session_start();
require_once('../include/connect.php');

$message = '';
$dir_upload = '../images/img-waterAlert/';
$max_size = 8000000;

$file = $_FILES['img'];
$new_name = "";

if ($file['size'] <= $max_size && $file['size'] > 0) {
	$new_name = time() . '-' . $file['name'];
	$copied = copy($file['tmp_name'], $dir_upload . $new_name);
	if ($copied) {
		$message = 'อัพโหลดสลิปสำเร็จ!';
	} else {
		$message = 'อัพโหลดผิดพลาด!';
	}
}else if($file['name'] == ""){
	$message = '';
} else {
	$message = 'อัพโหลดผิดพลาดขนาดไฟล์รูปใหญ่กว่า 8mb กรุณาทำการอัพโหลดใหม่อีกครั้ง';
}

$month = $_POST['month'];
$meter = $_POST['meter'];

if($message == '' || $message == 'อัพโหลดสลิปสำเร็จ!'){
	$query = "INSERT INTO water_alert VALUES(0,
		'$month',
		'$meter',
		'$new_name',
		'$_SESSION[roomSelect]',
		'$_SESSION[id]',
		'$_SESSION[dormSelect]')";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"แจ้งเลขมิเตอร์เรียบร้อย รอการตรวจสอบ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterAlert.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"$message.mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterAlert.php\" />";
  }
}else{
  echo "<script>";
  echo "alert(\"$message\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=waterAlert.php\" />";
}


mysqli_close($conn);
?>
