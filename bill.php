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

function DateThai2($strDate){
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
  return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds";
}
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
                <div class="col-md-1">
                  <button type="submit" class="btn btn-success btn-block" ><i class="glyphicon glyphicon-search"></i> เลือก</button>
                </div>
              </form>
            </div>

          </div>
        </div>
        <hr>
        <?php if(isset($_POST['month'])) {?>

            <div class="row">
              <div class="col-md-12">
                <?php
                while ($classStart <= $rowClass['dorm_class']) {
                  if(isset($_POST['month'])){
                  $query = "SELECT * FROM bills JOIN room ON bills.room_id =  room.room_id
                            WHERE bills.bill_month ='$subSum'
                            AND  room.dorm_id = $_SESSION[dormitory]
                            AND  room.room_class = $classStart
                            ORDER BY room.room_name ASC";
                  $result = mysqli_query($conn,$query);
                  }
                  ?>
                  <h4>ชั้นที่ <?php echo $classStart;?></h4>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                      <thead>
                        <th class="text-center" style="background-color:grey;color:white;">ชื่อห้อง</th>
                        <th class="text-center" style="background-color:grey;color:white;">สถานะ</th>
                        <th class="text-center" style="background-color:grey;color:white;">วันที่จดมิเตอร์</th>
                        <th class="text-center" style="background-color:grey;color:white;">สถานะบิล</th>
                        <th class="text-center" style="background-color:grey;color:white;">วันที่ชำระบิล</th>
                        <th class="text-center" style="background-color:grey;color:white;">ปริ้นรายงาน</th>
                      </thead>
                      <tbody>
                          <?php
                          while($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                              <td align="center">
                                <?php echo $row['room_name']; ?>
                              </td>
                              <td align="center">
                                <?php
                                if($row['room_status']=="ห้องมีผู้เช่า")
                                echo "<img src=\"images/renter.png\" class=\"img-responsive\" />";
                                ?>
                              </td>

                              <td align="center" >
                                <?php echo DateThai($row['bill_note']); ?>
                              </td>
                              <td align="center">
                                <?php echo $row['bill_status']; ?>
                              </td>
                              <td align="center" >
                                <?php
                                if($row['bill_payment'] != ""){
                                  echo DateThai2($row['bill_payment']);;
                                }else{
                                  echo "-";
                                }
                                ?>
                              </td>
                              <td align="center" width="30%">
                                <a href="invoice.php?id=<?php echo $row['bill_id'];?>" role="button" class="btn btn-primary" target="_blank">
                                  <i class="glyphicon glyphicon-print"></i> ปริ้นใบแจ้งหนี้/ใบเสร็จรับเงิน
                                </a>
                                <a href="billPayment.php?id=<?php echo $row['bill_id']?>&roomID=<?php echo $row['room_id'];?>" class="btn btn-success" data-toggle="modal" data-target="#myModal" >
                                  <i class="glyphicon glyphicon-plus"></i> ชำระเงินเรียบร้อย
                                </a>
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
      $('.datatable').DataTable();
    });
    </script>
    <!-- Close Conect Mysqli -->
    <?php mysqli_close($conn); ?>
  </body>
  </html>
