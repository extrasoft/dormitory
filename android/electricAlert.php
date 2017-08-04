<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

$queryRepair = "SELECT * FROM repair
WHERE dorm_id = '$_SESSION[dormSelect]'
AND room_id = '$_SESSION[roomSelect]'";
$resultRepair = mysqli_query($conn,$queryRepair);
$numRepair = mysqli_num_rows($resultRepair);

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
  return "เมื่อ : $strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds";
}

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
  <title>ระบบจัดการหอพัก</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="../assets/css/androidMystyle.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style media="screen">
  .panel-body {
    padding: 3px;
  }
  </style>
</head>
<body style="margin-top:<?php if(isset($_SESSION['dormSelect'])) echo "135px"; else echo "70px";?>">

  <!-- Top Menu -->
  <header>
    <?php include('include/header.php'); ?>
  </header>
  <!-- Content -->
  <div id="MainContent">
    <div class="container">
      <div class="row">
        <div class="col-md-12"><br />
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
              <div class="col-md-2">
                <button type="submit" class="btn btn-success btn-block" ><i class="glyphicon glyphicon-search"></i> เลือก</button>
              </div>
            </form>
          </div>

        </div>
      </div>
      <hr>
      <?php
      if(isset($_POST['month'])) {
        $queryelectric = "SELECT * FROM electric_alert WHERE aelectric_month = '$subSum' AND room_id = '$_SESSION[roomSelect]' AND mem_id='$_SESSION[id]'";
        $resultelectric = mysqli_query($conn,$queryelectric);
        $numelectric = mysqli_num_rows($resultelectric);
        $rowelectric = mysqli_fetch_array($resultelectric);
        ?>
          <div class="row">
            <div class="col-md-12">
              <?php if($numelectric > 0) {?>
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <p>เลขมิเตอร์ที่แจ้ง : <?php echo $rowelectric['aelectric_meter'];?></p>
                    </h4>
                  </div>
                  <div class="panel-body" style="font-size:14px;color:grey;">
                    <p align="center">
                      <?php if(!empty($rowelectric['aelectric_img'])) {?>
                      <img src="../images/img-electricAlert/<?php echo $rowelectric['aelectric_img'];?>" class="img-responsive" alt="Responsive image" >
                      <?php } ?>
                    </p>
                  </div>
                </div>
                <a class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal"
                href="electricAlertEdit.php?id=<?php echo $rowelectric['aelectric_id'];?>&month=<?php echo $subSum;?>">
                  <i class="glyphicon glyphicon-pencil"></i> <strong >แก้ไขมิเตอร์ที่แจ้ง</strong>
                </a>
                <?php }else{ ?>
                  <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"
                  href="electricAlertAdd.php?month=<?php echo $subSum;?>">
                    <i class="glyphicon glyphicon-plus"></i> <strong >แจ้งมิเตอร์</strong>
                  </a>
                  <?php } ?>
            </div>
          </div>
        <hr>
        <?php } ?>
      </div>
      <?php require_once("include/footer.php"); ?>
    </div>

    <!-- Modal Zone -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-filestyle.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../assets/js/locales/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="../assets/js/androidMyJs.js"></script>
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
