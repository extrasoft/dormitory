<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
$queryDom = "SELECT * FROM dormitory WHERE mem_id = '$_SESSION[id]'";
$resultDom = mysqli_query($conn,$queryDom);
$rowDom = mysqli_fetch_array($resultDom);
$numDom = mysqli_num_rows($resultDom);

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
            <h3 class="text-center">กรอกข้อมูลหอพัก</h3><hr>
          </div>
        </div>
        <form name="formAdd" action="dormitoryAddQuery.php" enctype="multipart/form-data"
        method="post" onSubmit="JavaScript:return fncSubmit('formAdd');" >
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="inputname">ชื่อหอพัก <span style="color:red">*</span></label>
              <div class="input-group">
                <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" id="inputname" name="name" value="<?php if($numDom > 0 ) echo $rowDom['dorm_name']; ?>" placeholder="กรอกชื่อหอพัก">
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
                <textarea class="form-control" style="resize:none;" id="inputaddress"  rows="5" name="address" placeholder="บ้านเลขที่ / หมู่ / ซอย / ถนน / ตำบล / อำเภอ / จังหวัด / รหัสไปรษณีย์"><?php if($numDom > 0 ) echo $rowDom['dorm_address']; ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="inputTel">เบอร์โทรศัพท์มือถือ <span style="color:red">*</span></label>
              <div class="input-group">
                <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-phone"></i></span>
                <input type="tel" class="form-control" id="inputTel" maxlength="10" name="tel" placeholder="08xxxxxxxx , 09xxxxxxxx" value="<?php if($numDom > 0 ) echo $rowDom['dorm_tel']; ?>" maxlength="10" pattern="^0[8-9][0-9]{8}$" onKeyPress="return isPhoneNo(tel)" >
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputEmail">อีเมล์หอพัก</label>
              <div class="input-group">
                <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="example@email.com" value="<?php if($numDom > 0 ) echo $rowDom['dorm_email']; ?>">
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
                  <input type="radio" name="water" id="" value="no" checked=""> ไม่ใช่
                </label>
                <label class="radio-inline">
                  <input type="radio" name="water" id="" value="yes"> ใช่
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
                  <input type="radio" name="electric" id="" value="no" checked=""> ไม่ใช่
                </label>
                <label class="radio-inline">
                  <input type="radio" name="electric" id="" value="yes"> ใช่
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div id='TextBoxesGroup'>
              <div id="TextBoxDiv1">
                <div class="form-group">
                  <label for="inputC1">จำนวนห้องของชั้น 1 : </label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-th"></i></span>
                    <input type="number" class="form-control" id="inputC1" name="c[]" placeholder="กรอกจำนวนห้อง" min="1" max="100" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="button" class="btn btn-default" value="เพิ่มชั้น" id="addButton">
            <input type="button" class="btn btn-default" value="ลบชั้น" id="removeButton">
          </div>
        </div><br />
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-lg btn-primary">เพิ่มหอพัก</button>
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
$(document).ready(function(){
  var counter = 2;

  $("#addButton").click(function () {

    if(counter>99){
      alert("เพิ่มได้สูงสุด 99 ชั้น");
      return false;
    }

    var newTextBoxDiv = $(document.createElement('div'))
    .attr("id", 'TextBoxDiv' + counter);

    newTextBoxDiv.after().html(
      '<div class="form-group">' +
      '<label for="inputC' + counter + '">จำนวนห้องของชั้น '+ counter + ' :</label> ' +
      '<div class="input-group">' +
      ' <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-th"></i></span>' +
      ' <input type="number" class="form-control" name="c[]" id="inputC' + counter + '" value=""  placeholder="กรอกจำนวนห้อง" min="1" max="100" required>' +
      '</div>' +
      '</div>');

      newTextBoxDiv.appendTo("#TextBoxesGroup");

      counter++;
    });

    $("#removeButton").click(function () {
      if(counter==2){
        alert("ไม่สามารถลบชั้นได้");
        return false;
      }
      counter--;
      $("#TextBoxDiv" + counter).remove();

    });

  });
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
      alert('กรุณากรอก ที่อยู่หอพัก ให้เรียบร้อย');
      document.forms[frm].address.focus();
      return false;
    }
    else if(document.forms[frm].tel.value == "")
    {
      alert('กรุณากรอก เบอร์โทรศัพท์ ให้เรียบร้อย');
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
