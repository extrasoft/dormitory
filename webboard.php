<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if($_SESSION['mem_type'] == 0){
  header("location:android/index.php");
}
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}

if(isset($_SESSION['dormitory'])){
$queryTopic = "SELECT * FROM topic JOIN member ON topic.mem_id = member.mem_id WHERE topic.dorm_id = '$_SESSION[dormitory]' ORDER BY topic.topic_id DESC";
$resultTopic = mysqli_query($conn,$queryTopic);
$numTopic = mysqli_num_rows($resultTopic);
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
  return "เมื่อ : $strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการหอพัก</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/bootflat/css/bootflat.css">
  <link rel="stylesheet" href="assets/css/mystyle.css">
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

        <?php
          if(isset($_SESSION['dormitory'])){
          while ($rowTopic = mysqli_fetch_array($resultTopic)) {
        ?>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="webboardDetail.php?id=<?php echo $rowTopic['topic_id'];?>"><span style="font-size:14px;"><?php echo $rowTopic['topic_topic'];?></span></a>
            </h4>
          </div>
          <div class="panel-body" style="font-size:12px;">
              <span>โดย : <?php if ($rowTopic['mem_type'] == 1) echo 'เจ้าของหอพัก'; else echo $rowTopic['mem_username'];?></span>
              <span class="pull-right" style="color:gray;">อ่าน <?php echo $rowTopic['topic_view']; ?> ครั้ง <br /> ตอบ <?php echo $rowTopic['topic_reply']; ?> ครั้ง</span>
              <p style="color:gray;"><?php echo DateThai($rowTopic['topic_date']);?></p>
          </div>
        </div>
        <?php } ?>
        <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" href="topicAdd.php">
          <i class="glyphicon glyphicon-plus"></i> <strong >ตั้งกระทู้สอบถาม</strong>
        </a>
        <?php
            }else{
              echo "<h3 class=\"text-center\">กรุณาเลือกหอพักสำหรับจัดการ</h3>";
            }
        ?>
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
<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/locales/bootstrap-datepicker.th.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker-thai.js"></script>
<script type="text/javascript" src="assets/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/media/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/myJS.js"></script>
<script type="text/javascript" >
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
