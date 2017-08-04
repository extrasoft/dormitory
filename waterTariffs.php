<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการค่าน้ำ</title>

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
          <div class="col-lg-12">
            <h3 class="text-center">เลือกการคิดบริการค่าน้ำ</h3><hr>
          </div>
        </div>
        <center>
        <form name="formTariffs" action="" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-inline">
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">
                    <i class="glyphicon glyphicon-tint"></i>
                  </span>
                  <select class="form-control" name="modeWater">
                    <option value="1" <?php if(isset($_POST['modeWater']) && $_POST['modeWater'] == '1') echo 'selected';?>>1.คิดแบบเหมาจ่ายรายเดือน</option>
                    <option value="2" <?php if(isset($_POST['modeWater']) && $_POST['modeWater'] == '2') echo 'selected';?>>2.คิดแบบเหมาจ่ายรายหัว</option>
                    <option value="3" <?php if(isset($_POST['modeWater']) && $_POST['modeWater'] == '3') echo 'selected';?>>3.คิดตามจริง</option>
                  </select>
                </div>
                <input type="submit" class="btn btn-default" name="water" value="เลือกหมวด" id="addButton">
              </div>
            </div>
          </div>
        </form>
        </center>
        <form name="formTariffsAdd" action="waterTariffsQuery.php" enctype="multipart/form-data" method="post">
        <?php
        if(isset($_POST['water'])){
          if ($_POST['modeWater']== 1 ) {
        ?>
          <hr>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputMonth">ราคาต่อเดือน <span style="color:red">(บาท)</span></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="number" class="form-control" id="inputMonth" name="name" min="1.0" step="0.1" placeholder="ยกตัวอย่าง เช่น ราคาเดือนละ 100 บาท" required>
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">฿</span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
            </div>
          </div>
        <?php }else if($_POST['modeWater'] == 2){ ?>
            <hr>
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputMonth">ราคาหัวละ <span style="color:red">(บาท)</span></label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="number" class="form-control" id="inputMonth" name="name" min="1.0" step="0.1" placeholder="ยกตัวอย่าง เช่น ราคาหัวละ 100 บาท" required>
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">฿</span>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              </div>
            </div>
        <?php }else if($_POST['modeWater'] == 3){ ?>
            <hr>
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputMonth">ราคาหน่วยละ <span style="color:red">(บาท)</span></label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="number" class="form-control" id="inputMonth" name="name" min="1.0" step="0.1" placeholder="ยกตัวอย่าง เช่น ราคาหน่วยละ 5.5 บาท" required>
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">฿</span>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              </div>
            </div>
        <?php } ?>
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-lg btn-primary">ยืนยัน</button>
            <input type="hidden" name="mode" name="" value="<?php echo $_POST['modeWater']; ?>">
          </div>
          <div class="col-md-3">
          </div>
        </div>
        <?php } ?>
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

  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
