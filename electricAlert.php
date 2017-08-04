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
$queryClass = "SELECT dorm_class from dormitory where dorm_id = $_SESSION[dormitory]";
$resultClass = mysqli_query($conn,$queryClass);
$rowClass = mysqli_fetch_array($resultClass);

if(!isset($_POST['month']))
{
  $sY= date("Y")+543;
  $sM= date("m");
  $sSum = $sM.'/'.$sY;
}else{
  $subYear = substr($_POST['month'],3);
  $subYear = $subYear-543;
  $subMonth = substr($_POST['month'],0,2);
  $subSum = $subYear.'-'.$subMonth;
  $m = date("Y-m", strtotime($subSum . " last month"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>ผู้เช่าแจ้งมิเตอร์ไฟ</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
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
            <h3 class="text-center">เลือกรอบบิล</h3><hr>
            <div class="row">
              <form class="" action="" method="post" name="formBills" enctype="multipart/form-data">
                <div class="col-md-4">
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input type="text" name="month" class="form-control dmonth"
                    data-provide="datepicker" value="<?php if(isset($_POST['month'])) {echo $_POST['month'];}else{ echo $sSum;}?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-success" ><i class="glyphicon glyphicon-search"></i> เลือก</button>
                </div>
              </form>
            </div>

          </div>
        </div>
        <hr>
        <?php if(isset($_POST['month'])) {?>
        <form name="formEdit" action="meterQuery.php" enctype="multipart/form-data" method="post" >
          <div class="row">
            <div class="col-md-12">
              <?php
              $rec = 1;
              while ($classStart <= $rowClass['dorm_class']) {
                $query = "SELECT * FROM room WHERE  dorm_id = $_SESSION[dormitory] AND room_class = $classStart";
                $result = mysqli_query($conn,$query);
                ?>
                <h4>ชั้นที่ <?php echo $classStart;?></h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th class="text-center" style="background-color:grey;color:white;">ชื่อห้อง</th>
                      <th class="text-center" style="background-color:grey;color:white;">สถานะห้อง</th>
                      <th class="text-center" style="background-color:grey;color:white;">เลขมิเตอร์ที่แจ้ง</th>
                      <th class="text-center" style="background-color:grey;color:white;">รูปมิเตอร์ที่แจ้ง</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)) {
                          $queryElectric = "SELECT * FROM electric_alert WHERE aelectric_month = '$subSum' AND room_id = '$row[room_id]'";
                          $resultElectric = mysqli_query($conn,$queryElectric);
                          $numElectric = mysqli_num_rows($resultElectric);
                          $rowElectric = mysqli_fetch_array($resultElectric);
                          ?>
                          <tr>
                            <td class="text-center" style="vertical-align: middle;"><?php echo $row['room_name'] ?></td>
                            <td>
                              <center>
                                <?php
                                if($row['room_status']=="ห้องมีผู้เช่า")
                                echo "<img src=\"images/renter.png\" class=\"img-responsive\" />";
                                ?>
                              </center>
                            </td>
                            <td class="text-center">
                              <?php
                                if($numElectric > 0){
                                  echo $rowElectric['aelectric_meter'];
                                }else{
                                  echo "-";
                                }

                              ?>
                            </td>
                            <td class="text-center">
                              <?php if($rowElectric['aelectric_img'] != "") { ?>
                              <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal" href="electricAlertView.php?id=<?php echo $rowElectric['aelectric_id'];?>">
                                <i class="glyphicon glyphicon-eye-open"></i>
                              </a>
                              <?php }else{ echo "-"; } ?>
                            </td>
                          </tr>
                          <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php
                $classStart++;
              } ?>
            </div>
          </div>
        </form>
        <hr>
        <?php } ?>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Modal Zone -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>

  <script type="text/javascript"src="assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript"src="assets/js/locales/bootstrap-datepicker.th.js"></script>
  <script type="text/javascript"src="assets/js/bootstrap-datepicker-thai.js"></script>

  <script type="text/javascript" src="assets/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/media/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/myJS.js"></script>
  <script type="text/javascript">
  $('.dmonth').datepicker({
    format: "mm/yyyy",
    language: "th",
    endDate: "+Infinity",
    autoclose: true,
    startView: 1,
    minViewMode: 1,
    maxViewMode: 2

  });
  $(document).ready(function() {
    $('#myModal').on('hidden.bs.modal', function () {
          $(this).removeData('bs.modal');
    });
  });
  </script>
  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
