<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}

if(isset($_SESSION['dormitory'])){
  $queryRepair = "SELECT * FROM repair WHERE dorm_id = '$_SESSION[dormitory]' ORDER BY rep_id DESC";
  $resultRepair = mysqli_query($conn,$queryRepair);
  $numRepair = mysqli_num_rows($resultRepair);

  $queryUpView = "UPDATE repair SET rep_view='yes'";
  $resultUpView = mysqli_query($conn,$queryUpView);
}
function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("n",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","มกราคม",
  "กุมภาพันธ์",
  "มีนาคม",
  "เมษายน",
  "พฤษภาคม",
  "มิถุนายน",
  "กรกฎาคม",
  "สิงหาคม",
  "กันยายน",
  "ตุลาคม",
  "พฤศจิกายน",
  "ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear <br />เวลา $strHour:$strMinute:$strSeconds";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการผู้เช่า</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootflat/css/bootflat.css">
  <link rel="stylesheet" href="assets/media/css/dataTables.bootstrap.min.css">
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
        <div class="panel panel-primary">
          <div class="panel-heading">

            <form class="form-inline" method="post" action="" name="form2">
              <strong style="font-size:18px">
                <span>รายการแจ้งซ่อม</span>
              </strong>
            </form>
          </div>
          <div class="panel-body">
            <div class="table-responsive">

              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <th class="text-center" width="10%">รหัสการแจ้งซ่อม</th>
                  <th class="text-center">หัวข้อที่แจ้ง</th>
                  <th class="text-center">วันที่แจ้ง</th>
                  <th class="text-center">สถานะ</th>
                  <th class="text-center">ห้องที่แจ้ง</th>
                  <th class="text-center">ปรับแต่ง</th>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_array($resultRepair)) {
                    $queryRoom = "SELECT * FROM room WHERE room_id = '$row[room_id]'";
                    $resultRoom = mysqli_query($conn,$queryRoom);
                    $rowRoom = mysqli_fetch_array($resultRoom);
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $row['rep_id']; ?></td>
                      <td><?php echo $row['rep_topic']; ?></td>
                      <td class="text-center"><?php echo DateThai($row['rep_date']);?></td>
                      <td class="text-center" style="<?php if($row['rep_status']=="กำลังดำเนินการแก้ไข") { ?> color:red; <?php }else{ ?> color:green; <?php } ?>">
                        <?php  echo $row['rep_status']; ?>
                      </td>
                      <td class="text-center"><?php  echo $rowRoom['room_name']; ?></td>
                      <td class="text-center">
                        <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal" href="repairView.php?id=<?php echo $row['rep_id'];?>">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal" href="repairEdit.php?id=<?php echo $row['rep_id'];?>">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /#page-content-wrapper -->
    </div><!-- /#wrapper -->

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
    <script type="text/javascript" src="assets/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/media/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/myJS.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#myModal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
      });
      $('.datatable').DataTable();
    });
    </script>
    <!-- Close Conect Mysqli -->
    <?php mysqli_close($conn); ?>
  </body>
  </html>
