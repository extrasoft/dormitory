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
$rowClass = mysqli_fetch_row($resultClass);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการห้องพัก</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/media/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/mystyle.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style media="screen">
  .slider-size {
    height: 500px;
  }
  </style>
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
        <div class="row">
          <div class="col-md-12">
            <h3 class="text-center">จัดการห้องพัก</h3><hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php
            $sub = 0;
            while ($classStart <= $rowClass[0]) {
              $query = "SELECT * FROM room WHERE  dorm_id = $_SESSION[dormitory] AND room_class = $classStart";
              $result = mysqli_query($conn,$query);
              $numRow = mysqli_num_rows($result);
              ?>
              <h4>ชั้นที่ <?php echo $classStart;?></h4>
              <table width="100%">
              <?php
              for($r=1;$r<=$numRow;$r++){
                $sub++;
                if($sub % 5 == 1) echo "<tr>";
                $row = mysqli_fetch_array($result);
                if($row['room_status']=="ห้องว่าง"){
                  $imgStatus = '1';
                }else if($row['room_status']=="ห้องมีผู้เช่า" && $row['rent_id'] != 0){
                  $imgStatus = '2';
                }else if($row['room_status']=="ห้องมีผู้เช่า" && $row['mem_id'] != 0){
                  $imgStatus = '3';
                }else{
                  $imgStatus = '4';
                }
                ?>
                <td align="center">
                <?php echo $row[2].'<br />'; ?>
                <a data-toggle="modal" data-target="#myModal" href="managementEditForm.php?aid=<?php echo $row[0];?>">
                  <img src="images/img-status/<?php echo $imgStatus.'.png';?>" style="margin:0px 15px 30px 15px;"class="img-responsive img-rounded" />
                </a>
                </td>
                <?php
                if($sub % 5 == 0) echo "</tr>";
                }
              ?>
              </table>
              <?php
              $classStart++;
            }
            ?>
          </div>
        </div>

      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Modal Zone -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">

          </div>
      </div>
  </div>

  <!-- jQuery -->
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/js/locales/bootstrap-datepicker.th.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker-thai.js"></script>
  <script type="text/javascript" src="assets/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/media/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/myJS.js"></script>
  <script type="text/javascript">

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
