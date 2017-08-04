<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}

$queryRepair = "SELECT * FROM repair_detail WHERE mem_id = '$_SESSION[id]'";
$resultRepair = mysqli_query($conn,$queryRepair);
$numRepair = mysqli_num_rows($resultRepair);
$num = 1;

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

  <title>จัดการรายการซ่อม</title>

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
        <div class="panel panel-primary">
          <div class="panel-heading">

            <form class="form-inline" method="post" action="" name="form2">
              <strong style="font-size:16px">
                <span>จัดการรายละเอียดการซ่อม</span>
                <span>
                  <a href="repairDetailAdd.php" class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#myModal">
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
                  <th class="text-center">ชื่ออุปกรณ์</th>
                  <th class="text-center">ราคา(บาท)</th>
                  <th class="text-center">จำนวน(ชิ้น)</th>
                  <th class="text-center">วันที่ซื้อ</th>
                  <th class="text-center">พนักงานผู้ซ่อม</th>
                  <th class="text-center">รหัสใบแจ้งซ่อม</th>
                  <th class="text-center" width="10%">ปรับแต่ง</th>
                </thead>
                <tbody>
                  <?php
                    while($row = mysqli_fetch_array($resultRepair)) {
                      $queryEmp = "SELECT * FROM employee WHERE emp_id = '$row[emp_id]'";
                      $resultEmp = mysqli_query($conn,$queryEmp);
                      $rowEmp = mysqli_fetch_array($resultEmp);
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $num++; ?></td>
                      <td><?php echo $row['repd_name']; ?></td>
                      <td class="text-center"><?php echo number_format($row['repd_price'],2); ?></td>
                      <td class="text-center"><?php echo $row['repd_amount']; ?></td>
                      <td class="text-center"><?php echo DateThai($row['repd_date']); ?></td>
                      <td class="text-center"><?php if(!empty($row['emp_id'])) { echo $rowEmp['emp_firstname'].' '.$rowEmp['emp_lastname'];}else{ echo '-'; } ?></td>
                      <td class="text-center"><?php if(!empty($row['rep_id'])) {echo $row['rep_id'];}else{ echo '-'; } ?></td>
                      <td class="text-center">
                        <a href="repairDetailEdit.php?id=<?php echo $row['repd_id'];?>" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="repairDetailDelete.php?id=<?php echo $row['repd_id'];?>" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal">
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
    </div>
  </div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->

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
