<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

$queryBill = "SELECT * FROM bills WHERE room_id = '$_SESSION[roomSelect]' ORDER BY bill_id DESC";
$resultBill = mysqli_query($conn,$queryBill);
$numBill = mysqli_num_rows($resultBill);


//โหมดมิเตอร์น้ำ
$queryWaterTariff = "SELECT * FROM water_tariffs WHERE dorm_id = '$_SESSION[dormSelect]'";
$resultWaterTariff = mysqli_query($conn,$queryWaterTariff);
$rowWaterTariff = mysqli_fetch_array($resultWaterTariff);

//โหมดมิเตอร์ไฟฟ้า
$queryElectricTariff = "SELECT * FROM electric_tariffs WHERE dorm_id = '$_SESSION[dormSelect]'";
$resultElectricTariff = mysqli_query($conn,$queryElectricTariff);
$rowElectricTariff = mysqli_fetch_array($resultElectricTariff);

//ราคาอุปกรณ์ตกแต่ง
$arr = array();
$arrPrice = array();
$queryAccs = "SELECT * FROM accessories WHERE dorm_id ='$_SESSION[dormSelect]'";
$resultAccs = mysqli_query($conn,$queryAccs);
while($rowAccs = mysqli_fetch_row($resultAccs)){
  array_push($arr,$rowAccs[1]);
  array_push($arrPrice,$rowAccs[2]);
}

function DateThai($strDate){
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strMonthCut = Array("","มกราคา",
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
  return "$strMonthThai $strYear";
}
function DateEng($strDate){
  $strMonth= date("n",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate));
  $strMonthCut = Array("","January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December");
  $strMonthEng=$strMonthCut[$strMonth];
  return "$strMonthEng $strYear";
}
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
  <style media="screen">
  .table > thead > tr > th{
    border-right: 1px solid #ddd;
    border-bottom:0;
  }
  .table > tbody > tr > td{
    border-right: 1px solid #ddd;
  }
  .table > thead > tr > th:last-of-type {
    border-right: 0px;
  }
  .table > tbody > tr > td:last-of-type {
    border-right: 0px;
  }
  .panel-body {
    padding: 0;
  }
  .panel-body > .table{margin-bottom:0px;}
  </style>
</head>
<body style="padding-top:<?php if(isset($_SESSION['dormSelect'])) echo "135px"; else echo "70px";?>">

  <!-- Top Menu -->
  <header>
    <?php include('include/header.php'); ?>
  </header>
  <!-- Content -->
  <div id="MainContent">
    <div class="container">
      <div class="row">
        <div class="col-md-12"><br />

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">อัพโหลดสลิปการชำระเงิน</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <?php if($numBill > 0) {?>
            <?php
            while ($rowBill = mysqli_fetch_array($resultBill)) {
              $query = "SELECT * FROM bills JOIN room ON bills.room_id =  room.room_id
              WHERE bills.bill_id ='$rowBill[bill_id]'";
              $result = mysqli_query($conn,$query);
              $row = mysqli_fetch_array($result);
              $accs = explode(",",$row['room_accessories']);

              //ค้นหามิเตอร์เดือนที่แล้ว
              $m = date("Y-m", strtotime($row['bill_month'] . " last month"));
              $queryMeter = "SELECT * FROM bills WHERE bill_month = '$m' AND room_id = '$_SESSION[roomSelect]'";
              $resultMeter = mysqli_query($conn,$queryMeter);
              $rowMeter = mysqli_fetch_array($resultMeter);

              $water = 0;
              $unitWater = 0;
              $sumWater = 0;
              $electric = 0;
              $unitElectric = 0;
              $sumElectric = 0;
              $sumAccs = 0;
              $accsPrice = "";
              $total = 0;

              ?>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <table width="100%" border="0">
                      <tr>
                        <td width="5%"><span style="font-size:32px"><?php echo date("m",strtotime($rowBill['bill_month']));?></span></td>
                        <td style="font-size:14px;padding-left:10px;">
                          <span>
                            <?php
                            $month = date("m",strtotime($rowBill['bill_month']));
                            $year = date("Y",strtotime($rowBill['bill_month']));
                            echo DateThai($rowBill['bill_month']).'<br />';
                            echo DateEng($rowBill['bill_month']);
                            ?>
                          </span>
                        </td>
                        <td>
                          <?php if($rowBill['bill_status'] == "ยังไม่ได้ชำระเงิน") {?>
                            <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#UploadSlip" href="billsUpload.php?id=<?php echo $rowBill['bill_id'];?>">
                              <span style="color:white;"><i class="glyphicon glyphicon-list-alt"></i> แจ้งชำระเงิน</span>
                            </a>
                            <?php }else{ ?>
                              <span class="pull-right" style="color:green;"><b><?php echo $rowBill['bill_status']; ?></b></span>
                              <?php } ?>
                            </td>
                          </tr>
                        </table>
                      </h3>
                    </div>
                    <div class="panel-body" style="font-size:12px;">
                      <table class="table table-striped">
                        <tr class="text-center">
                          <th>&nbsp;</th>
                          <th><center>เลขก่อนหน้า</center></th>
                          <th><center>เลขล่าสุด</center></th>
                          <th><center>หน่วยละ</center></th>
                          <th><center>หน่วยที่ใช้</center></th>
                          <th><center>จำนวนเงิน</center></th>
                        </tr>
                        <!--ค่าเช่าห้อง-->
                        <tr>
                          <td colspan="5">ค่าเช่าห้อง (Room rate)</td>
                          <td align="right"><?php echo number_format($row['room_price'],2); ?></td>
                        </tr>
                        <!--ค่าน้ำประปา-->
                        <tr>
                          <td>ค่าน้ำประปา (Water rate)
                          </td>
                          <td align="center">
                            <?php
                            if($row['bill_month'] == substr($row['room_lease'], 0, 7)){
                              echo $water=$row['room_water'];
                            }else{
                              echo $water=$rowMeter['bill_water'];
                            }
                            ?>
                          </td>
                          <td align="center" ><?php echo $row['bill_water'];?></td>
                          <td align="center"><?php if($rowWaterTariff['water_type']==3) echo $rowWaterTariff['water_price'] ?></td>
                          <td align="center"><?php echo $unitWater=$row['bill_water']-$water ?></td>
                          <td align="right"><?php
                          if($rowWaterTariff['water_type']==1){
                            echo number_format($sumWater = $rowWaterTariff['water_price'],2);
                          }else if($rowWaterTariff['water_type']==2){
                            echo number_format($sumWater = $rowWaterTariff['water_price'] * $row['room_guest'],2);
                          }else {
                            echo number_format($sumWater = $rowWaterTariff['water_price'] * $unitWater,2);
                          }
                          ?> </td>
                        </tr>
                        <!--ค่าไฟฟ้า-->
                        <tr>
                          <td>ค่าไฟฟ้า (Electrical rate)
                          </td>
                          <td align="center">
                            <?php
                            if($row['bill_month'] == substr($row['room_lease'], 0, 7)){
                              echo $electric=$row['room_electric'];
                            }else{
                              echo $electric=$rowMeter['bill_electric'];
                            }
                            ?>
                          </td>
                          <td align="center" ><?php echo $row['bill_electric'];?></td>
                          <td align="center"><?php if($rowElectricTariff['electric_type']==2) echo $rowElectricTariff['electric_price'] ?></td>
                          <td align="center"><?php echo $unitElectric=$row['bill_electric']-$electric ?></td>
                          <td align="right"><?php
                          if($rowElectricTariff['electric_type']==1){
                            echo number_format($sumElectric = $rowElectricTariff['electric_price'],2);
                          }else {
                            echo number_format($sumElectric = $rowElectricTariff['electric_price'] * $unitElectric,2);
                          }
                          ?></td>
                        </tr>
                        <tr>
                          <td colspan="5">ค่าเช่าเฟอร์นิเจอร์ (<?php echo $row['room_accessories']; ?>)</td>
                          <?php
                          foreach (array_combine($arr, $arrPrice) as $value => $valuePrice) {
                            if(in_array($value,$accs)){
                              $accsPrice.=$valuePrice.' + ';
                              $sumAccs+=$valuePrice;
                            }
                          }
                          ?>
                          <td align="right"><?php echo number_format($sumAccs,2); ?></td>
                        </tr>
                        <tr>
                          <td colspan="5">ค่าอินเทอร์เน็ต (Internet rate)</td>
                          <td align="right"><?php echo number_format($row['room_internet'],2)?></td>
                        </tr>
                        <tr>
                          <td colspan="5">ค่าที่จอดรถ (Parking rate)</td>
                          <td align="right"><?php echo number_format($row['room_parking'],2)?></td>
                        </tr>
                        <tr>
                          <td colspan="5">ส่วนลด (Discount)</td>
                          <td align="right"><?php echo number_format($row['room_discount'],2);?></td>
                        </tr>
                        <tr>
                          <td colspan="5"><strong>รวม (Total price)</strong></td>
                          <td  align="right">
                            <?php
                            $total = ($row['room_price'] + $sumWater + $sumElectric + $sumAccs + $row['room_internet']+ $row['room_parking']) - $row['room_discount'];
                            echo number_format($total,2);
                            ?>
                          </td>
                        </tr>
                      </table>

                    </div>
                  </div>
                  <?php } ?>
                  <?php }else{ echo '<h4 class=\'text-center\'>ยังไม่มีรายการบิลค่าเช่า</h4>';} ?>
                </div>
              </div>
            </div>
            <?php require_once("include/footer.php"); ?>
          </div>


          <div class="modal fade" id="UploadSlip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

              </div>
            </div>
          </div>
          <!-- jQuery -->
          <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
          <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
          <script type="text/javascript" src="../assets/js/bootstrap-filestyle.js"></script>
          <script type="text/javascript" src="../assets/js/androidMyJs.js"></script>
          <script type="text/javascript" >
          $(document).ready(function() {
            $('#UploadSlip').on('hidden.bs.modal', function () {
              $(this).removeData('bs.modal');
            });
          });
          </script>
          <!-- Close Conect Mysqli -->
          <?php mysqli_close($conn); ?>
        </body>
        </html>
