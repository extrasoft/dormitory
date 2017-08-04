<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

$queryName = "SELECT * FROM room JOIN dormitory ON room.dorm_id = dormitory.dorm_id WHERE room.mem_id = '$_SESSION[id]'";
$resultName = mysqli_query($conn,$queryName);
$numName = mysqli_num_rows($resultName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบจัดการหอพัก</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/androidMystyle.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body style="padding-top:<?php if(isset($_SESSION['dormSelect'])) echo "135px"; else echo "65px";?>">

  <!-- Top Menu -->
  <header>
    <?php include('include/header.php'); ?>
  </header>
  <!-- Content -->
  <div id="MainContent">
    <div class="container">
      <div class="row">
        <div class="col-md-12"><br />
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><b>รายการห้องพักของผู้เช่า</b></h3>
            </div>
            <div class="panel-body">
              <?php while ($rowName = mysqli_fetch_array($resultName)) { ?>
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title"><b><?php echo $rowName['dorm_name'].' (ห้อง '.$rowName['room_name'].')';?></b></h3>
                </div>
                <div class="panel-body">
                  <?php
                    echo '<b>ที่อยู่</b> : '.$rowName['dorm_address'].'<br />';
                    echo '<b>เบอร์โทร</b> : '.$rowName['dorm_tel'];
                    if($rowName['room_status'] == "ห้องมีผู้เช่า") {
                  ?>
                  <p>
                    <a href="main.php?dormID=<?php echo $rowName['dorm_id'];?>&roomID=<?php echo $rowName['room_id'];?>"
                      name="button" class="btn btn-success btn-xs pull-right"
                       >
                      <i class="glyphicon glyphicon-list-alt"></i> จัดการ
                    </a>
                  </p>
                  <?php
                }else if($rowName['room_status'] == "กำลังตรวจสอบ"){
                    echo "<p>
                            <b style='color:red' class='pull-right'>รอการยืนยันจากเจ้าของหอพัก</b>
                          </p>";
                  }
                  ?>
                </div>
              </div>
              <?php } ?>
              <a href="dormConnect.php" class="btn btn-primary btn-block">
                <i class="glyphicon glyphicon-plus"></i> <strong >เชื่อมต่อหอพัก</strong>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php require_once("include/footer.php"); ?>
  </div>


  <!-- jQuery -->
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap-filestyle.js"></script>
  <script type="text/javascript" src="../assets/js/androidMyJs.js"></script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
