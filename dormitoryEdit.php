<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
$query = "SELECT * FROM dormitory WHERE dorm_id = '$_SESSION[dormitory]'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>แก้ไขข้อมูลหอพัก</title>

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
<body style="padding-top: 50px; font-family: 'promptregular', sans-serif;">
  <!-- Top Menu -->
  <header>
    <?php include('include/header.php'); ?>
  </header>
  <div id="wrapper">
    <!-- Sidebar Menu-->
    <?php include('include/sidebar.php'); ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" style="font-size:16px;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-center">ข้อมูลหอพัก</h3><hr>
          </div>
        </div>
        <form name="formAdd" action="dormitoryEditQuery.php" enctype="multipart/form-data"
        method="post" onSubmit="JavaScript:return fncSubmit('formAdd');" >
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="inputname">ชื่อหอพัก <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" id="inputname" name="name" placeholder="กรอกชื่อหอพัก" value="<?php echo $row['dorm_name']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="inputAddress">ที่อยู่หอพัก <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-home"></i></span>
                  <textarea class="form-control" style="resize:none;" id="inputaddress"  rows="5" name="address" placeholder="บ้านเลขที่ / หมู่ / ซอย / ถนน / ตำบล / อำเภอ / จังหวัด / รหัสไปรษณีย์"><?php echo $row['dorm_address']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="inputTel">เบอร์โทร <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-phone"></i></span>
                  <input type="tel" class="form-control" id="inputTel" maxlength="10" name="tel" placeholder="08xxxxxxxx , 09xxxxxxxx" value="<?php echo $row['dorm_tel']; ?>" maxlength="10" pattern="^0[8-9][0-9]{8}$" onKeyPress="return isPhoneNo(tel)" >
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail">อีเมล์</label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" id="inputEmail" name="email" placeholder="example@email.com" value="<?php echo $row['dorm_email']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputWater">ให้ผู้เช่าอาศัยแจ้งเลขมิเตอร์น้ำมายังระบบเอง</label>
                <div class="input-group">
                  <label class="radio-inline">
                    <input type="radio" name="water" value="no" <?php if($row['dorm_water']=="no") {echo "checked=''";} ?> > ไม่ใช่
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="water" value="yes" <?php if($row['dorm_water']=="yes") {echo "checked=''";} ?> > ใช่
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputElectric">ให้ผู้เช่าอาศัยแจ้งเลขมิเตอร์ไฟฟ้ามายังระบบเอง</label>
                <div class="input-group">
                  <label class="radio-inline">
                    <input type="radio" name="electric" id="" value="no" <?php if($row['dorm_electric']=="no") {echo "checked";} ?>> ไม่ใช่
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="electric" id="" value="yes" <?php if($row['dorm_electric']=="yes") {echo "checked";} ?>> ใช่
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-block btn-lg btn-primary">แก้ไขข้อมูลหอพัก</button>
            </div>
            <div class="col-md-3">
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
  <script type="text/javascript" src="assets/js/myJS.js"></script>
  <script type="text/javascript">

  function fncSubmit(frm)
  {
    if(document.forms[frm].name.value == "")
    {
      alert('กรุณากรอก ชื่อหอพัก ให้เรียบร้อย');
      document.forms[frm].name.focus();
      return false;
    }
    else if(document.forms[frm].address.value == "")
    {
      alert('กรุณากรอก Address ให้เรียบร้อย');
      document.forms[frm].address.focus();
      return false;
    }
    else if(document.forms[frm].tel.value == "")
    {
      alert('กรุณากรอก Telephone ให้เรียบร้อย');
      document.forms[frm].tel.focus();
      return false;
    }
    return true;
  }
  </script>
  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
