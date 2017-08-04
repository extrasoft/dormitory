<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

$id = $_GET['id'];

$queryTopic = "SELECT * FROM topic JOIN member ON topic.mem_id = member.mem_id WHERE topic.dorm_id = '$_SESSION[dormSelect]' AND topic.topic_id = '$id'";
$resultTopic = mysqli_query($conn,$queryTopic);
$rowTopic = mysqli_fetch_array($resultTopic);
$numTopic = mysqli_num_rows($resultTopic);
$topicIMG = explode(',',$rowTopic['topic_img']);
$countTopic =  count($topicIMG);


$queryReply = "SELECT * FROM reply JOIN member ON reply.mem_id = member.mem_id
               WHERE reply.dorm_id = '$_SESSION[dormSelect]'
               AND reply.topic_id = '$id'";

$resultReply = mysqli_query($conn,$queryReply);
$numReply = mysqli_num_rows($resultReply);
$num = 1;

$queryUpView = "UPDATE topic SET topic_view=topic_view+1 WHERE topic_id='$id'";
$resultUpView = mysqli_query($conn,$queryUpView);

function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("n",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
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
          <!--ส่วนของหัวข้อ-->
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a href="#"><span style="font-size:14px;"><?php echo $rowTopic['topic_topic'];?></span></a>

              </h4>
            </div>
            <div class="panel-body" style="font-size:12px;">
                <p><?php echo $rowTopic['topic_detail'];?></p>
                <?php
                  if(!empty($rowTopic['topic_img'])){
                  for ($i=0; $i < $countTopic; $i++) {
                ?>
                <p align="center"><img src="../images/img-topic/<?php echo $topicIMG[$i];?>" class="img-responsive" alt="Responsive image" width="50%"></p>
                <?php }} ?>
                <span>โดย : <?php if ($rowTopic['mem_type'] == 1) echo 'เจ้าของหอพัก'; else echo $rowTopic['mem_username'];?></span>
                <span class="pull-right" style="color:gray;">อ่าน <?php echo $rowTopic['topic_view']; ?> ครั้ง <br /> ตอบ <?php echo $rowTopic['topic_reply']; ?> ครั้ง</span>
                <p style="color:gray;"><?php echo DateThai($rowTopic['topic_date']);?></p>
            </div>
          </div>
          <!--ส่วนของคอมเม้น-->
          <?php
          while($rowReply = mysqli_fetch_array($resultReply)) {
            $replyIMG = explode(',',$rowReply['reply_img']);
            $countReply =  count($replyIMG);
          ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <p style="font-size:14px;"><?php echo 'ความคิดเห็นที่ : '.$num++;?></p>
              </h4>
            </div>
            <div class="panel-body" >
                <p><?php echo $rowReply['reply_detail'];?></p>
                <?php
                if(!empty($rowReply['reply_img'])){
                for ($i=0; $i < $countReply; $i++) {
                  ?>
                <p align="center"><img src="../images/img-reply/<?php echo $replyIMG[$i];?>" class="img-responsive" alt="Responsive image" width="50%"></p>
                <?php }} ?>
                <span style="color:gray;font-size:12px;">โดย : <?php if ($rowReply['mem_type'] == 1) echo 'เจ้าของหอพัก'; else echo $rowReply['mem_username'];?></span>
                <p style="color:gray;font-size:12px;"><?php echo DateThai($rowReply['reply_date']);?></p>
            </div>
          </div>
          <?php } ?>
          <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" href="replyAdd.php?id=<?php echo $id;?>">
            <i class="glyphicon glyphicon-plus"></i> <strong >แสดงความคิดเห็น</strong>
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
            //Content Will show Here
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
