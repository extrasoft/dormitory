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
$queryParcel = "SELECT * FROM parcel WHERE dorm_id = '$_SESSION[dormitory]'";
$resultParcel = mysqli_query($conn,$queryParcel);
$numParcel = mysqli_num_rows($resultParcel);
$num = 1;
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
  return "$strDay $strMonthThai $strYear";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการพัสดุ</title>

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
        <?php if(isset($_SESSION['dormitory'])){ ?>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <form class="form-inline" method="post" action="" name="form2">
              <strong style="font-size:16px">
                <span>จัดการพัสดุ</span>
                <span>
                  <a class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#myModal" href="parcelAdd.php">
                    <i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล
                  </a>
                </span>
              </strong>
            </form>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <th class="text-center">#</th>
                  <th class="text-center">ชื่อผู้รับ</th>
                  <th class="text-center">วันที่รับพัสดุ</th>
                  <th class="text-center" width="15%">ปรับแต่ง</th>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_array($resultParcel)) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $num++; ?></td>
                      <td><?php echo $row['par_name']; ?></td>
                      <td class="text-center"><?php echo DateThai($row['par_date']); ?></td>
                      <td class="text-center">
                        <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal" href="parcelView.php?id=<?php echo $row['par_id'];?>">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal" href="parcelEdit.php?id=<?php echo $row['par_id'];?>">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal" href="parcelDelete.php?id=<?php echo $row['par_id'];?>">
                          <i class="glyphicon glyphicon-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
            }else{
              echo "<h3 class=\"text-center\">กรุณาเลือกหอพักสำหรับจัดการ</h3>";
            }
           ?>
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
      $('.datatable').DataTable();
    });
    </script>
    <!-- Close Conect Mysqli -->
    <?php mysqli_close($conn); ?>
  </body>
  </html>
