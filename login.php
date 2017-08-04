<?php
@session_start();
require_once('include/connect.php');
if(isset($_POST['login'])){
	$username = $_POST['uname'];
	$password = md5($_POST['pword']);
  $query = "select * from member where mem_username = '$username' and mem_password = '$password'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rs = mysqli_fetch_array($result);
  if($rs){
    $_SESSION['id'] = $rs[0];
    $_SESSION['username'] = $rs[1];
    $_SESSION['fname'] = $rs[3];
    $_SESSION['lname'] = $rs[4];
    $_SESSION['image'] = $rs[8];
		$_SESSION['mem_type'] = $rs['mem_type'];
		if($_SESSION['mem_type'] == 1){
			header("location:index.php");
		}else {
			header("location:android/index.php");
		}
  }else{
    echo "<div class='container'>";
    echo "<div class='alert alert-warning  alert-dismissible' role='alert'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    echo "<strong>Warning!</strong> เข้าสู่ระบบผิดพลาด กรุณาตรวจสอบ Username หรือ Password ใหม่อีกครั้ง";
    echo "</div>";
    echo "</div>";
  }
}
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
			<div style="margin-top:0px;" class="mainbox col-md-6 col-md-offset-3">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title text-center" style="font-size:25px;">
							<p align="center">
								<img src="images/dorm.png" class="img-responsive" alt="Responsive image" width="70%">
							</p>
						</div>
					</div>
					<div style="padding-top:0px" class="panel-body" >
						<form class="form-horizontal" action="" method="post" role="form" name="formLogin" onSubmit="JavaScript:return fncSubmit('formLogin');" >
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user" ></i></span>
								<input type="text" class="form-control input-lg" name="uname" placeholder="Username">
							</div>
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control input-lg" name="pword" placeholder="Password">
							</div>
								<button type="submit" name="login" class="btn btn-lg btn-primary btn-block">เข้าสู่ระบบ</button>
						</form>
						<p align="right" style="font-size:16px;color:grey"><a href="forgetPassword.php">ลืมรหัสผ่าน ?</a></p>

						<div class="heading-line">&nbsp;หรือ&nbsp;</div>
						<br />
						<p align="center" style="font-size:16px;color:grey">สมัครสมาชิกใหม่ <a href="register.php">คลิกที่นี่</a></p>
					</div>
				</div>
			</div>
		</div>
  </div>


  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function fncSubmit(frm)
	{
		if(document.forms[frm].uname.value == "")
		{
			alert('กรุณากรอก Username ให้เรียบร้อย');
			document.forms[frm].uname.focus();
			return false;
		}else if(document.forms[frm].pword.value == "")
		{
			alert('กรุณากรอก Password ให้เรียบร้อย');
			document.forms[frm].pword.focus();
			return false;
		}
		return true;
	}
	</script>
	<?php mysqli_close($conn); ?>
</body>
</html>
