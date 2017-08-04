<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
$classStart = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการชื่อห้อง</title>

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
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-center">แก้ไขชื่อห้องพัก</h3><hr>
          </div>
        </div>
        <form name="formEdit" action="roomRenameQuery.php" enctype="multipart/form-data" method="post" >
        <div class="row">
          <div class="col-md-12">
            <?php
            while ($classStart <= $_SESSION['dormClass']) {
              $query = "SELECT * FROM room WHERE  dorm_id = $_SESSION[dormitory] AND room_class = $classStart";
              $result = mysqli_query($conn,$query);
              ?>
              <h4>ชั้นที่ <?php echo $classStart;?></h4>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <th class="text-center">ชื่อห้อง</th>
                  <th class="text-center">ชื่อห้องที่ต้องการแก้ไข</th>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_row($result)) {
                    ?>
                    <tr>
                      <td class="text-center" style="vertical-align: middle;"><?php echo $row[2] ?></td>
                      <td>
                        <input type="text" class="form-control" name="name<?php echo $row[0];?>" placeholder="กรอกชื่อห้องที่ต้องการแก้ไข">
                      </td>
                    </tr>
                    <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <?php
            $classStart++;
            } ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-2">
              <button type="submit" name="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalAdd">
                <i class="glyphicon glyphicon-plus"></i> <strong style="font-size:16px">เปลี่ยนชื่อห้อง</strong>
              </button>
            </div>
            <div class="col-md-5">
            </div>
          </div>
          </form>
          <hr>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <a href="waterTariffs.php" role="button" class="btn btn-block btn-lg btn-primary">หน้าถัดไป</a>
            </div>
            <div class="col-md-3">
            </div>
          </div>
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
