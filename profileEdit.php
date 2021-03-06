<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if($_SESSION['mem_type'] == 0){
  header("location:android/index.php");
}
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}

$queryMember = "SELECT * FROM member WHERE mem_id = '$_SESSION[id]'";
$resultMember = mysqli_query($conn,$queryMember);
$rowMember = mysqli_fetch_array($resultMember);
$numMember = mysqli_num_rows($resultMember);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการหอพัก</title>

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
<body style="padding-top: 50px;">
  <!-- Top Menu -->
  <header>
    <?php include('include/header.php'); ?>
  </header>
  <div id="wrapper">
    <!-- Sidebar Menu-->
    <?php include('include/sidebar.php'); ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <form class="form-horizontal" name="formProfile" action="profileEditQuery.php" enctype="multipart/form-data" method="post" onSubmit="JavaScript:return fncSubmit('formProfile');">
          <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:14px;">
                <p align="center">
                  <img src="images/img-member/<?php echo $rowMember['mem_img'];?>" class="img-responsive img-thumbnail" alt="Responsive image" width="200px;">
                </p>
                <div style="width:100%;padding:10px;">
                  <div class="form-group">
                    <label for="InputImage">
                      อัพโหลดรูปภาพโปรไฟล์ :
                      <button id="clear" class="btn btn-default btn-xs" type="button">
                        เคลียร์รูป
                      </button>
                    </label>
                    <input type="file" id="InputImage" name="img" class="input01" accept="images/*" capture>
                  </div>
                </div>

              </div>
              <div class="panel-body" style="font-size:14px;">
                <div style="width:100%;padding:10px;">

                  <div class="form-group">
                    <label for="InputUsername">ชื่อผู้ใช้ : </label>
                    <input type="text" class="form-control" id="InputUsername" name="uname"  placeholder="กรอกชื่อผู้ใช้" value="<?php echo $rowMember['mem_username'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="InputFirstname">ชื่อจริง : <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="InputFirstname" name="fname"  placeholder="กรอกชื่อจริง" value="<?php echo $rowMember['mem_firstname'];?>" onKeyPress="return NameCode(fname)" required>
                  </div>
                  <div class="form-group">
                    <label for="InputLastname">นามสกุล : <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="InputLastname" name="lname"  placeholder="กรอกนามสกุล" value="<?php echo $rowMember['mem_lastname'];?>" onKeyPress="return NameCode(lname)" required>
                  </div>
                  <div class="form-group">
                    <label for="InputAddress">ที่อยู่ : </label>
                    <textarea class="form-control" id="InputAddress" name="addr" rows="3" placeholder="กรอกรายละเอียดที่อยู่"><?php echo $rowMember['mem_address'];?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="InputEmail">อีเมล์ : </label>
                    <input type="email" class="form-control" id="InputEmail" name="email"  placeholder="กรอกอีเมล์" value="<?php echo $rowMember['mem_email'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="InputTel">เบอร์โทร : <span style="color:red">*</span></label>
                    <input type="tel" class="form-control" id="InputTel" name="tel"  placeholder="กรอกเบอร์โทรศัพท์มือถือ" value="<?php echo $rowMember['mem_tel'];?>" maxlength="10" pattern="^0[8-9][0-9]{8}$" onKeyPress="return isPhoneNo(tel)" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
                  <input type="hidden" name="memId" value="<?php echo $rowMember['mem_id'];?>">
                  <input type="hidden" name="imgOld" value="<?php echo $rowMember['mem_img'];?>">
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->


<!-- jQuery -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<script type="text/javascript" src="assets/js/myJS.js"></script>
<script type="text/javascript">
function fncSubmit(frm)
{
  if(document.forms[frm].pword.value == "" || (document.forms[frm].pword.value != document.forms[frm].pwordOld.value))
  {
    alert('กรุณากรอกรหัสผ่านเดิมให้ถูกต้อง');
    document.forms[frm].pword.focus();
    return false;
  }else if(document.forms[frm].pwordNew.value != document.forms[frm].pwordAgain.value){
    alert('กรุณากรอกรหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ให้ตรงกัน');
    document.forms[frm].pwordNew.focus();
    return false;
  }
  return true;
}

$('.input01').filestyle({
  'placeholder' : 'รูปภาพโปรไฟล์',
  buttonText : 'เลือกรูป',
  buttonName : 'btn-danger'
});

$('#clear').click(function() {
  $('.input01').filestyle('clear');
});
</script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
