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

  //รายละเอียดตึก
  $queryDorm = "SELECT * FROM dormitory WHERE dorm_id = '$_SESSION[dormitory]'";
  $resultDorm = mysqli_query($conn,$queryDorm);
  $rowDorm = mysqli_fetch_array($resultDorm);
  $numRoom = explode(",",$rowDorm['dorm_room']);
  $num = 1;
  $sumRoom = 0;
  $totalAccs = 0;

  $arr = array();
  $arrPrice = array();
  //ราคาอุปกรณ์ตกแต่ง
  $queryAccs = "SELECT * FROM accessories WHERE dorm_id ='$_SESSION[dormitory]'";
  $resultAccs = mysqli_query($conn,$queryAccs);
  while($rowAccs = mysqli_fetch_array($resultAccs)){
    array_push($arr,$rowAccs['accs_name']);
    array_push($arrPrice,$rowAccs['accs_price']);
  }

  if (isset($_POST['month'])) {
    //นับจำนวนบิล
    $queryNumBill = "SELECT * FROM bills  WHERE bill_month = '$subSum' AND dorm_id = '$_SESSION[dormitory]'";
    $resultNumBill = mysqli_query($conn,$queryNumBill);
    $countNumBill = mysqli_num_rows($resultNumBill);

    //ออกบิล
    $queryBill = "SELECT * FROM bills  WHERE bill_month = '$subSum' AND bill_status='ชำระเงินเรียบร้อย' AND dorm_id = '$_SESSION[dormitory]'";
    $resultBill = mysqli_query($conn,$queryBill);
    $numBill = mysqli_num_rows($resultBill);

    while($rowBill = mysqli_fetch_array($resultBill)){
      $totalAccs = 0;
      $queryRoomAccs = "SELECT room_accessories FROM room WHERE room_id = '$rowBill[room_id]'";
      $resultRoomAccs = mysqli_query($conn,$queryRoomAccs);
      $rowRoomAccs = mysqli_fetch_array($resultRoomAccs);
      $roomAccsDetail = explode(",",$rowRoomAccs['room_accessories']);

      foreach (array_combine($arr, $arrPrice) as $value => $valuePrice) {
        if(in_array($value,$arr)){
          $totalAccs+=$valuePrice;
        }
      }
    }


    //นับสถานะบิล
    $queryBillStatus = "SELECT bill_status,COUNT(bill_status) AS Status FROM bills where bill_month='$subSum' AND dorm_id='$_SESSION[dormitory]' GROUP BY bill_status";
    $resultBillStatus = mysqli_query($conn,$queryBillStatus);

    //นับสถานะผู้เช่าแจ้งเหตุขัดข้อง
    $queryRepairStatus = "SELECT rep_status,COUNT(rep_status) AS Status FROM repair where rep_date LIKE '%$subSum%' AND dorm_id='$_SESSION[dormitory]' GROUP BY rep_status";
    $resultRepairStatus = mysqli_query($conn,$queryRepairStatus);

    //นับสถานะรายการแจ้งซ่อมอุปกรณ์ในแต่ละเดือน
    $queryRepairDetailStatus = "SELECT COUNT(repd_id) AS Status FROM repair_detail where repd_date LIKE '%$subSum%' AND mem_id='$_SESSION[id]'";
    $resultRepairDetailStatus = mysqli_query($conn,$queryRepairDetailStatus);
    $rowRepairDetailStatus = mysqli_fetch_array($resultRepairDetailStatus);

    //นับจำนวนค่าซ่อม
    $queryRepair = "SELECT SUM(repd_price) AS total , repd_amount AS amount FROM repair_detail WHERE repd_date LIKE '%$subSum%' AND mem_id = '$_SESSION[id]'";
    $resultRepair = mysqli_query($conn,$queryRepair);
    $rowRepair = mysqli_fetch_array($resultRepair);

    //นับจำนวนค่าอินเทอร์เน็ต
    $queryInternet = "SELECT SUM(room_internet) AS internet FROM room WHERE dorm_id = '$_SESSION[dormitory]'";
    $resultInternet = mysqli_query($conn,$queryInternet);
    $rowInternet = mysqli_fetch_array($resultInternet);

    //นับจำนวนเงินพนักงาน
    $queryEmp = "SELECT SUM(emp_salary) AS salary FROM employee WHERE mem_id = '$_SESSION[id]'";
    $resultEmp = mysqli_query($conn,$queryEmp);
    $rowEmp = mysqli_fetch_array($resultEmp);

    //คำนวณรายรับรายจ่าย
    $queryIncome = "SELECT SUM(room.room_price) AS roomprice,
                           SUM(room.room_parking) AS parking
                    FROM room JOIN bills ON room.room_id = bills.room_id
                    WHERE bills.bill_month='$subSum' AND bills.bill_status = 'ชำระเงินเรียบร้อย' AND bills.dorm_id = '$_SESSION[dormitory]'";
    $resultIncome = mysqli_query($conn,$queryIncome);
    $rowIncome = mysqli_fetch_array($resultIncome);
  }
}

function DateThai($strDate)
{

  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];

  return "$strMonthThai $strYear";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>สรุปรายรับ-รายจ่าย</title>

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
        <?php if(isset($_SESSION['dormitory'])){ ?>
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-center">เลือกรอบเดือน</h3><hr>
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
              <!--รายละเอียดตึก-->
              <div class="col-md-4">
                <div class="panel panel-info">
                  <div class="panel-heading"><strong>รายละเอียดตึก</strong></div>
                  <table class="table table-bordered" width="100%" cellpadding="5">
                    <tbody>
                      <tr>
                        <td align="right">ชื่อตึก</td>
                        <td><?php echo $rowDorm['dorm_name'] ?></td>
                      </tr>
                      <tr>
                        <td align="right">จำนวนชั้น</td>
                        <td><?php echo $rowDorm['dorm_class'] ?></td>
                      </tr>
                      <?php
                      foreach ($numRoom as $value) {
                        ?>
                        <tr>
                          <td align="right"><?php echo 'ชั้นที '.$num; ?></td>
                          <td><?php echo $value.' ห้อง'; ?></td>
                        </tr>
                        <?php
                        $sumRoom+=$value;
                        $num++;
                      }
                      ?>
                      <tr>
                        <td align="right"><strong>รวมจำนวนห้อง</strong></td>
                        <td><?php echo $sumRoom.' ห้อง'; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--รายการชำระเงิน-->
              <div class="col-md-4">
                <div class="panel panel-warning">
                  <div class="panel-heading"><strong>รายการชำระเงิน</strong></div>
                  <table class="table table-bordered" width="100%" cellpadding="5">
                    <tbody>
                      <tr>
                        <td align="right" width="50%">ออกบิลแล้ว</td>
                        <td><?php echo $countNumBill.' รายการ' ;?></td>
                      </tr>
                      <?php while($rowBillStatus = mysqli_fetch_array($resultBillStatus)) {?>
                        <tr>
                          <td align="right" width="50%"><?php echo $rowBillStatus['bill_status'];?></td>
                          <td><?php echo $rowBillStatus['Status'].' รายการ'; ?></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!--รายการซ่อม-->
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading"><strong>รายการแจ้งเหตุขัดข้องจากผู้เช่า</strong></div>
                    <table class="table table-bordered" width="100%" cellpadding="5">
                      <tbody>
                        <?php while($rowRepairStatus = mysqli_fetch_array($resultRepairStatus)) {?>
                          <tr>
                            <td align="right" width="50%"><?php echo $rowRepairStatus['rep_status'];?></td>
                            <td><?php echo $rowRepairStatus['Status'].' รายการ'; ?></td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td align="right" width="50%"><?php echo 'รายการอุปกรณ์ที่ใช้ซ่อม';?></td>
                            <td><?php echo $rowRepairDetailStatus['Status'].' รายการ'; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div><!--End Row-->


              <div class="row">
                <!--รายรับ-->
                <div class="col-md-6">
                  <div class="panel panel-success">
                    <div class="panel-heading"><strong>รายรับ</strong></div>
                    <table class="table table-bordered" width="100%" cellpadding="5">
                      <tbody>
                        <tr>
                          <td align="right" width="50%">ค่าห้องพัก</td>
                          <td><?php echo number_format($rowIncome['roomprice'],2).' บาท'; ?></td>
                        </tr>
                        <tr>
                          <td align="right" width="50%">ค่าอุปกรณ์ตกแต่งห้อง</td>
                          <td><?php echo number_format($totalAccs,2).' บาท'; ?></td>
                        </tr>
                        <tr>
                          <td align="right" width="50%">ค่าที่จอดรถ</td>
                          <td><?php echo number_format($rowIncome['parking'],2).' บาท'; ?></td>
                        </tr>
                        <tr>
                          <td align="right"><strong>รวมรายรับ</strong></td>
                          <td><?php echo number_format($income = $rowIncome['roomprice'] + $rowIncome['parking'] + $totalAccs,2).' บาท'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!--รายจ่าย-->
                <div class="col-md-6">
                  <div class="panel panel-danger">
                    <div class="panel-heading"><strong>รายจ่าย</strong></div>
                    <table class="table table-bordered" width="100%" cellpadding="5">
                      <tbody>
                        <tr>
                          <td align="right" width="50%">เงินเดือนพนักงาน</td>
                          <td><?php echo number_format($rowEmp['salary'],2).' บาท' ?></td>
                        </tr>
                        <tr>
                          <td align="right" width="50%">ค่าอินเทอร์เน็ต</td>
                          <td><?php echo number_format($rowInternet['internet'],2).' บาท'; ?></td>
                        </tr>
                        <tr>
                          <td align="right" width="50%">ค่าซ่อมบำรุง</td>
                          <td><?php echo number_format($rowRepair['total'] * $rowRepair['amount'],2).' บาท'; ?></td>
                        </tr>
                        <tr>
                          <td align="right"><strong>รวมรายจ่าย</strong></td>
                          <td><?php echo number_format($expends = $rowEmp['salary']+($rowRepair['total']*$rowRepair['amount'])+$rowInternet['internet'],2).' บาท'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!--End Row-->
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h3 class="text-center">สรุปผลกำไรเดือน <?php echo DateThai($subSum);?>  = <?php echo number_format($income - $expends,2).' บาท'; ?></h3></div>
                  </div>
                </div>
              </div>
              <hr>
              <?php }}else{
                echo "<h3 class=\"text-center\">กรุณาเลือกหอพักสำหรับจัดการ</h3>";
              } ?>
            </div>
          </div>
          <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->

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
          $('.datatable').DataTable();
        });
        </script>
        <!-- Close Conect Mysqli -->
        <?php mysqli_close($conn); ?>
      </body>
      </html>
