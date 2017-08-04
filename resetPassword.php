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
						<form class="form-horizontal" action="resetPasswordQuery.php" enctype="multipart/form-data" method="post" role="form" name="formRegister" onSubmit="JavaScript:return fncSubmit('formRegister');">
							<div style="width:100%;padding:10px;">

								<div class="form-group">
									<label for="InputPassword">เปลี่ยนรหัสผ่านใหม่ : </label>
									<input type="password" class="form-control" id="InputPassword" name="pwordNew"  placeholder="กรอกรหัสผ่านใหม่" required>
								</div>
								<div class="form-group">
									<label for="InputPassword">ยืนยันรหัสผ่านใหม่ : </label>
									<input type="password" class="form-control" id="InputPasswordAgain" name="pwordAgain"  placeholder="กรอกรหัสผ่านใหม่อีกครั้ง" required>
								</div>

								<button type="submit" class="btn btn-primary btn-block" name="submit"><i class="glyphicon glyphicon-ok"></i> เปลี่ยนรหัสผ่านใหม่</button>
							</div>
							<input type="hidden" name="mdEmail" value="<?php echo $_GET['mail'];?>">

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
	function fncSubmit(frm)
	{
		if(document.forms[frm].pwordNew.value != document.forms[frm].pwordAgain.value){
	    alert('กรุณากรอกรหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ให้ตรงกัน');
	    document.forms[frm].pwordNew.focus();
	    return false;
	  }
	  return true;
	}
	</script>
	<?php mysqli_close($conn); ?>
</body>
</html>
