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
  .panel-body {
    padding: 3px;
  }
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
        <div class="col-md-12" ><br />
          <?php if($numRepair > 0) {?>
          <?php
          while($rowRepair = mysqli_fetch_array($resultRepair)) {
            $repairIMG = explode(',',$rowRepair['rep_img']);
            $countRepair =  count($repairIMG);
          ?>

          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">
                <p>
                  <?php echo $rowRepair['rep_topic'];?>
                  <span class="pull-right" style="color:green"><?php echo $rowRepair['rep_status']?></span>
                </p>
              </h4>
            </div>
            <div class="panel-body" >
                <p><?php echo $rowRepair['rep_detail'];?></p>
                <?php
                if(!empty($rowRepair['rep_img'])){
                for ($i=0; $i < $countRepair; $i++) {
                  ?>
                <p align="center">
                  <img src="../images/img-repair/<?php echo $repairIMG[$i];?>" class="img-responsive" alt="Responsive image" width="50%">
                </p>
                <?php }} ?>
                <p style="color:gray;font-size:12px;"><?php echo DateThai($rowRepair['rep_date']);?></p>
            </div>
          </div>
          <?php } ?>
          <?php }else{ echo '<h4 class=\'text-center\'>ยังไม่มีรายการแจ้งเหตุขัดข้อง</h4>';} ?>
          <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" href="alertAdd.php">
            <i class="glyphicon glyphicon-plus"></i> <strong >แจ้งเหตุขัดข้อง</strong>
          </a>
        </div>
      </div>
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
  <script type="text/javascript" src="../assets/js/androidMyJs.js"></script>
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
