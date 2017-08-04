<?php
@session_start();
require_once('include/connect.php');

if(isset($_POST['email'])){
	$query = "SELECT * FROM member WHERE mem_email = '$_POST[email]'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result);
	$num = mysqli_num_rows($result);
	if($row <= 0){
		echo '<script>';
		echo 'alert("ไม่พบข้อมูลอีเมล์นี้ในระบบ กรุณาตรวจสอบอีเมล์ที่ใช้ในการสมัครอีกครั้ง!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=forgetPassword.php\" />";
	}else{
		echo '<script>';
		echo "alert(\"ระบบกำลังส่งลิ้งค์ในการเปลี่ยนรหัสผ่านใหม่ไปยังอีเมล์ $_POST[email] \\nกรุณาตรวจสอบใน จดหมายขาเข้า หรือ อีเมล์ขยะ !\")";
		echo '</script>';
		//echo "Your password send successful.<br>Send to mail : ".$_POST['email'];

		$m = md5($_POST['email']);
		$link = "<a href='http://www.doteamwork.com/resetPassword.php?mail=".$m."'>คลิกที่นี่</a>";
		$strTo = $_POST['email'];
		$strSubject = "www.doteamwork.com กำหนดรหัสผ่านใหม่";
		$strHeader  = 'MIME-Version: 1.0' . "\r\n";
		$strHeader  .= "Content-type: text/html; charset=UTF-8\n"; // or UTF-8 //
		$strHeader  .= "From: admin@doteamwork.com\nReply-To: ".$_POST['email'];
		$strMessage = "สวัสดีคุณ : ".$row['mem_firstname']." ".$row['mem_lastname'].'<br />';
		$strMessage .= "คุณได้ทำการขอการกำหนดรหัสผ่านใหม่<br />";
		$strMessage .= "ถ้านี่เป็นความผิดพลาด ก็ไม่ต้องสนใจอีเมล์นี้และจะไม่มีอะไรเกิดขึ้น<br />";
		$strMessage .= "==================================================<br />";
		$strMessage .= "เพื่อกำหนดรหัสผ่านใหม่กรุณา : ".$link."<br>";
		$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);
	}
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ลืมรหัสผ่าน</title>

	<link rel="icon" type="image/png" href="icons/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootflat/css/bootflat.css">
	<link rel="stylesheet" href="assets/css/mystyle.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body style="background-color:#f5f5f5;">
  <div class="container">
		<div class="row">
			<div  class="mainbox col-md-6 col-md-offset-3">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title text-center" style="font-size:25px;">ลืมรหัสผ่าน</div>
					</div>
					<div class="panel-body" >
						<form class="form-horizontal" action="" enctype="multipart/form-data" method="post" role="form" name="formRegister" >
							<div style="width:100%;padding:10px;">

								<div class="form-group">
									<label for="InputEmail">กรอกอีเมล์ที่ใช้สมัคร  : <span style="color:red">*</span></label>
									<input type="email" class="form-control" id="InputEmail" name="email"  placeholder="กรอกอีเมล์" value="" required="">
								</div>
								<button type="submit" class="btn btn-primary btn-block" name="submit"><i class="glyphicon glyphicon-ok"></i> ดำเนินการ</button>
							</div>


						</form>
					</div>
				</div>
			</div>
		</div>
  </div>


  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
	<script type="text/javascript">

	$('.input01').filestyle({
		'placeholder' : 'รูปภาพประกอบ',
		buttonText : 'เลือกรูป',
		buttonName : 'btn-danger'
	});

	$('#clear').click(function() {
		$('.input01').filestyle('clear');
	});
	</script>
	<?php mysqli_close($conn); ?>
</body>
</html>
