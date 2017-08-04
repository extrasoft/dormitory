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

$queryDorm = "SELECT * FROM dormitory WHERE mem_id = '$_SESSION[id]' ORDER BY dorm_id ASC";
$resultDorm = mysqli_query($conn,$queryDorm);
$numDorm = mysqli_num_rows($resultDorm);

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
        <?php
          while($rowDorm = mysqli_fetch_array($resultDorm)) {
            $dormRoom = explode(',',$rowDorm['dorm_room']);
        ?>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <?php echo $rowDorm['dorm_name'];?>
              <a href="setDormitory.php?id=<?php echo $rowDorm['dorm_id'];?>"
                name="button" class="btn btn-warning btn-xs pull-right">
                <i class="glyphicon glyphicon-list-alt"></i> จัดการ
              </a>
            </h4>
          </div>
          <div class="panel-body">
            <p><b>ที่อยู่</b> : <?php echo $rowDorm['dorm_address'];?></p>
            <p><b>เบอร์โทร่</b> : <?php echo $rowDorm['dorm_tel'];?></p>
            <p><b>จำนวนชั้น</b> : <?php echo $rowDorm['dorm_class'];?></p>
            <?php for ($i=0; $i < $rowDorm['dorm_class']; $i++) { ?>
              <p><b>ชั้นที่่</b> <?php echo $i+1; ?> : <?php echo $dormRoom[$i];?> ห้อง</p>
            <?php } ?>
            <p><b>รหัสการเชื่อมต่อ</b> : <span style="color:red"><?php echo $rowDorm['dorm_id'];?></span></p>
          </div>
        </div>
        <?php } ?>
        <a class="btn btn-success btn-block"  href="dormitoryAdd.php">
          <i class="glyphicon glyphicon-plus"></i> <strong >เพิ่มหอพัก</strong>
        </a>
      </div>
    </div>
  </div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->


<!-- jQuery -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<script type="text/javascript" src="assets/js/myJS.js"></script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
