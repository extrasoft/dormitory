<?php
session_start();
require_once('../include/connect.php');

$message = '';
$dir_upload = '../images/img-bill/';
$max_size = 8000000;

$bill_id = $_POST['id'];
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

$bank = $_POST['bank'];
$branch = $_POST['branch'];
$name = $_POST['name'];
$money = $_POST['money'];
$payment = $_POST['payment'];
if($message == '' || $message == 'อัพโหลดสลิปสำเร็จ!'){
  $query = "UPDATE bills SET
	bill_bank = '$bank',
	bill_branch = '$branch',
	bill_name = '$name',
	bill_money = '$money',
  bill_img = '$new_name',
  bill_status = 'รอการตรวจสอบ',
	bill_payment = '$payment'
  WHERE bill_id = '$bill_id'";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>";
    echo "alert(\"แจ้งชำระเงินเรียบร้อย รอการตรวจสอบ\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bills.php\" />";
  }else{
    echo "<script>";
    echo "alert(\"$message.mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bills.php\" />";
  }
}else{
  echo "<script>";
  echo "alert(\"$message\")";
  echo "</script>";
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=bills.php\" />";
}


mysqli_close($conn);
?>
