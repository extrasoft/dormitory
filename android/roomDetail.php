<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

$queryDorm = "SELECT * FROM dormitory WHERE dorm_id = '$_SESSION[dormSelect]'";
$resultDorm = mysqli_query($conn,$queryDorm);
$rowDorm = mysqli_fetch_array($resultDorm);
$numDorm = mysqli_num_rows($resultDorm);

$queryRoom = "SELECT * FROM room WHERE room_id = '$_SESSION[roomSelect]'";
$resultRoom = mysqli_query($conn,$queryRoom);
$rowRoom = mysqli_fetch_array($resultRoom);
$numRoom = mysqli_num_rows($resultRoom);

$queryBank = "SELECT * FROM bank WHERE dorm_id = '$_SESSION[dormSelect]'";
$resultBank = mysqli_query($conn,$queryBank);
$numBank = mysqli_num_rows($resultBank);

//ส่วนของ menu2 หมวดหมู่การคิดค่าน้ำ
$queryMode = "SELECT * FROM water_tariffs WHERE dorm_id ='$_SESSION[dormSelect]'";
$resultMode = mysqli_query($conn,$queryMode);
$rowMode = mysqli_fetch_array($resultMode);

function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("n",strtotime($strDate));
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
          <div class="panel panel-info">

            <div class="panel-heading">
              <h3 class="panel-title text-center">ข้อมูลหอพัก</h3>
            </div>
            <div class="panel-body">
              <p class="text-center">
                <strong><?php echo $rowDorm['dorm_name'];?></strong>
              </p>
              <hr />
              <p>
                ที่อยู่ : <?php echo $rowDorm['dorm_address'];?>
              </p>
            </div>

            <div class="panel-heading">
              <h3 class="panel-title text-center">ติดต่อหอพัก</h3>
            </div>
            <div class="panel-body">
              <p>
                เบอร์โทร : <?php echo $rowDorm['dorm_tel'];?>
              </p>
            </div>

            <div class="panel-heading">
              <h3 class="panel-title text-center">บัญชีธนาคารสำหรับชำระค่าเช่าห้อง</h3>
            </div>
            <div class="panel-body">
              <?php if($numBank > 0) {?>
              <table class="table table-bordered table-striped">
                <tbody>
                  <?php while ($rows = mysqli_fetch_row($resultBank)) { ?>
                    <tr>
                      <td width="12%">
                        <img src="../images/img-bank/<?php echo $rows[5]; ?>" alt="profile" class="img-rounded" width="100px" height="100px">
                      </td>
                      <td>
                        <?php
                          echo $rows[1].' สาขา '.$rows[2].'<br />';
                          echo 'ชื่อบัญชี '.$rows[3].'<br />';
                          echo 'เลขที่บัญชี '.$rows[4];
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php }else{ echo '<h4>ไม่พบข้อมูลธนาคาร</h4>'; } ?>
            </div>

            <div class="panel-heading">
              <h3 class="panel-title text-center">สัญญาเช่า</h3>
            </div>
            <div class="panel-body">
              <p>วันเริ่มสัญญาเช่า : <?php if(!empty($rowRoom['room_lease'])) { echo DateThai($rowRoom['room_lease']); }else{ echo '-'; }?></p>
              <p>วันสิ้นสุดสันญาเช่า : <?php if(!empty($rowRoom['room_lease_end'])) { echo DateThai($rowRoom['room_lease_end']); }else{ echo '-'; }?></p>
              <p>เงินประกันห้อง : <?php if(!empty($rowRoom['room_money'])) { echo $rowRoom['room_money']; }else{ echo '-'; }?> บาท</p>
              <p>เลขมิเตอร์น้ำ(เข้าพัก) : <?php if(!empty($rowRoom['room_water'])) { echo $rowRoom['room_water']; }else{ echo '-'; }?> หน่วย</p>
              <p>เลขมิเตอร์ไฟ(เข้าพัก) : <?php if(!empty($rowRoom['room_electric'])) { echo $rowRoom['room_electric']; }else{ echo '-'; }?> หน่วย</p>
            </div>

            <div class="panel-heading">
              <h3 class="panel-title text-center">รายละเอียดห้องพัก</h3>
            </div>
            <div class="panel-body">
              <p>ชื่อห้องพัก : <?php echo $rowRoom['room_name'];?></p>
              <?php if($rowMode['water_type'] == 2) {?>
              <p>ผู้อยู่อาศัย : <?php if(!empty($rowRoom['room_guest'])) { echo $rowRoom['room_guest']; }else{ echo '-'; }?> คน</p>
              <?php } ?>
              <p>ค่าห้อง : <?php if(!empty($rowRoom['room_price'])) { echo number_format($rowRoom['room_price'],2); }else{ echo '-'; }?> บาท</p>
              <p>ค่าอินเทอร์เน็ต : <?php if(!empty($rowRoom['room_internet'])) { echo number_format($rowRoom['room_internet'],2); }else{ echo '-'; }?> บาท</p>
              <p>ค่าที่จอดรถ : <?php echo number_format($rowRoom['room_parking']); ?> บาท</p>
              <p>อุปกรณ์ตกแต่งห้อง : <?php if(!empty($rowRoom['room_accessories'])) { echo $rowRoom['room_accessories']; }else{ echo '-'; }?></p>
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
</script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
