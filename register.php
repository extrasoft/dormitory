<?php
@session_start();
require_once('include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>จัดการพนักงาน</title>

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
						<div class="panel-title text-center" style="font-size:25px;">สมัครสมาชิก</div>
					</div>
					<div class="panel-body" >
						<form class="form-horizontal" action="registerQuery.php" enctype="multipart/form-data" method="post" role="form" name="formRegister">
							<div style="width:100%;padding:10px;">

								<div class="form-group">
									<label for="InputUsername">ชื่อผู้ใช้ : <span style="color:red">*</span></label>
									<input type="text" class="form-control" id="InputUsername" name="uname"  placeholder="กรอกชื่อผู้ใช้สำหรับเข้าสู่ระบบ" onKeyPress="return KeyCode(uname)"   required>
								</div>
								<div class="form-group">
									<label for="InputPassword">รหัสผ่าน : <span style="color:red">*</span></label>
									<input type="password" class="form-control" id="InputPassword" name="pword"  placeholder="*************" required>
								</div>
								<div class="form-group">
									<label for="InputFirstname">ชื่อจริง : <span style="color:red">*</span></label>
									<input type="text" class="form-control" id="InputFirstname" name="fname"  placeholder="กรอกชื่อจริง" onKeyPress="return NameCode(fname)" required>
								</div>
								<div class="form-group">
									<label for="InputLastname">นามสกุล : <span style="color:red">*</span></label>
									<input type="text" class="form-control" id="InputLastname" name="lname"  placeholder="กรอกนามสกุล" onKeyPress="return NameCode(lname)"  required>
								</div>
								<div class="form-group">
									<label for="InputAddress">ที่อยู่ : </label>
									<textarea class="form-control" id="InputAddress" name="addr" rows="3" placeholder="กรอกรายละเอียดที่อยู่"></textarea>
								</div>
								<div class="form-group">
									<label for="InputEmail">อีเมล์ : <span style="color:red">*</span></label>
									<input type="email" class="form-control" id="InputEmail" name="email"  placeholder="example@email.com" value="" required>
								</div>
								<div class="form-group">
									<label for="InputTel">เบอร์โทรศัพท์มือถือ : <span style="color:red">*</span></label>
									<input type="tel" class="form-control" id="InputTel" name="tel"  placeholder="08xxxxxxxx , 09xxxxxxxx" maxlength="10" pattern="^0[8-9][0-9]{8}$" onKeyPress="return isPhoneNo(tel)" required>
									<!-- pattern="^0[8-9][0-9]{8}$" -->
								</div>
								<div class="form-group">
									<label for="InputImage">
										อัพโหลดรูปภาพโปรไฟล์ :
										<button id="clear" class="btn btn-default btn-xs" type="button">
											เคลียร์รูป
										</button>
									</label>
									<input type="file" id="InputImage" name="img" class="input01" accept="images/*" capture>
								</div>
								<div class="form-group">
									<label >รูปแบบสมาชิก : <span style="color:red">*</span></label><br />
									<p align="center">
										<label class="radio-inline">
											<input type="radio" name="memtype" id="inlineRadio1" value="1" checked> เจ้าของหอพัก
										</label>
										<label class="radio-inline">
											<input type="radio" name="memtype" id="inlineRadio2" value="0"> ผู้เช่าอาศัย
										</label>
									</p>

								</div>
								<button type="submit" class="btn btn-primary btn-block" name="submit" ><i class="glyphicon glyphicon-ok"></i> สมัครสมาชิก</button>
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
	<script type="text/javascript" src="assets/js/myJS.js"></script>
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
