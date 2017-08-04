<?php
@session_start();
require_once('../include/connect.php');

$message = '';
$dir_upload = '../images/img-electricAlert/';
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

$id = $_POST['id'];
$month = $_POST['month'];
$meter = $_POST['meter'];
$nameImg = $_POST['nameImg'];

$img = $new_name == ""?$nameImg:$new_name;

if($message == '' || $message == 'อัพโหลดสลิปสำเร็จ!'){
	$query = "UPDATE electric_alert SET
		aelectric_meter = '$meter',
		aelectric_img = '$img'
		WHERE aelectric_id = '$id'";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"แก้ไขเลขมิเตอร์เรียบร้อย รอการตรวจสอบ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricAlert.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"$message.mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricAlert.php\" />";
  }
}else{
  echo "<script>";
  echo "alert(\"$message\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=electricAlert.php\" />";
}


mysqli_close($conn);
?>
