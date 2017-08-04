<?php

$queryLogin = "SELECT * FROM member WHERE mem_id = '$_SESSION[id]' ";
$resultLogin = mysqli_query($conn,$queryLogin);
$rowLogin = mysqli_fetch_array($resultLogin);


?>
<nav class="navbar navbar-default navbar-fixed-top">
  <!--Menu Bar-->
  <div class="container brand">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle navbar-left collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <?php
          if(isset($_SESSION['dormSelect'])) {
            $queryDormName = "SELECT * FROM dormitory WHERE dorm_id = '$_SESSION[dormSelect]'";
            $resultDormName = mysqli_query($conn,$queryDormName);
            $rowDormName = mysqli_fetch_array($resultDormName);
            echo $rowDormName['dorm_name'];


          }else{
            echo "ระบบจัดการหอพัก";
          }
        ?>

      </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><i class="glyphicon glyphicon-wrench"></i> &nbsp;เลือกหอพัก</a></li>
        <?php
        if(isset($_SESSION['dormSelect'])){
        if($rowDormName['dorm_water'] == 'yes') { ?>
        <li><a href="waterAlert.php"><span class="glyphicon glyphicon-tint"></span> แจ้งเลขมิเตอร์น้ำ</a></li>
        <?php }if($rowDormName['dorm_electric'] == 'yes') { ?>
        <li><a href="electricAlert.php"><span class="glyphicon glyphicon-fire"></span> แจ้งเลขมิเตอร์ไฟ</a></li>
        <?php }} ?>
        <li>
          <hr>
        </li>
        <li><a href="profile.php"><i class="glyphicon glyphicon-wrench"></i> &nbsp;แก้ไขโปรไฟล์</a></li>
        <li><a href="?logout"><i class="glyphicon glyphicon-log-out"></i> &nbsp;ออกจากระบบ</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
  <?php if(isset($_SESSION['dormSelect'])) {?>
  <!--Tool Bar-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" style="background-color:#F1F1F1;padding:10px 0px 10px 0px;">
        <table width="100%" border="0">
          <tr>
            <td width="20%" align="center" valign="top">
              <a href="roomDetail.php">
                <img src="../images/profile.png" class="img-responsive" alt="" width="40px">
                <span style="font-size:14px;">ข้อมูลห้อง</span>
              </a>

            </td>
            <td width="20%" align="center" valign="top">
              <a href="bills.php">
                <img src="../images/bill.png" class="img-responsive " alt="" width="40px">
                <span style="font-size:14px">บิลค่าเช่า</span>
              </a>
            </td>
            <td width="20%" align="center" valign="top">
              <a href="webboard.php">
                <img src="../images/webboard.png" class="img-responsive " alt="" width="40px">
                <span style="font-size:14px">กระดานข่าว</span>
              </a>
            </td>
            <td width="20%" align="center" valign="top">
              <a href="parcel.php">
                <img src="../images/parcel.png" class="img-responsive " alt=""width="40px">
                <span style="font-size:14px">รับพัสดุ</span>
              </a>
            </td>
            <td width="20%" align="center" valign="top">
              <a href="alert.php">
                <img src="../images/alert.png" class="img-responsive " alt=""width="40px">
                <span style="font-size:14px">แจ้งเหตุ</span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
</nav>
