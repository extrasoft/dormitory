<?php

  $querySide = "select * from member where mem_id = '$_SESSION[id]'";
  $resultSide = mysqli_query($conn,$querySide) or die(mysql_error());
  $rowSide = mysqli_fetch_array($resultSide);

  if(isset($_SESSION['dormitory'])){
    $queryDorms = "SELECT * FROM dormitory WHERE dorm_id= '$_SESSION[dormitory]'";
    $resultDorms = mysqli_query($conn,$queryDorms);
    $rowDorms = mysqli_fetch_array($resultDorms);

  $queryCountRepair = "SELECT count(rep_status) AS count from repair where dorm_id = $_SESSION[dormitory] AND rep_status != 'ดำเนินการเสร็จสิ้น'";
  $resultCountRepair = mysqli_query($conn,$queryCountRepair);
  $rowCountRepair = mysqli_fetch_array($resultCountRepair);

  $queryCountBill = "SELECT count(bill_status) AS count from bills where dorm_id = $_SESSION[dormitory] AND bill_status='รอการตรวจสอบ'";
  $resultCountBill = mysqli_query($conn,$queryCountBill);
  $rowCountBill = mysqli_fetch_array($resultCountBill);
  }
?>
<div id="sidebar-wrapper" class="side-menu">
  <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">
            <li style="background-color:#fdfdfd;height:90px;">
              <div class="row">
                <div class="pull-left" style="padding:15px 0px 10px 10px">
                  <img src="images/img-member/<?php echo $rowSide['mem_img'] ?>" alt="profile" class="img-circle" width="50px" height="50px">
                </div>
                <div class="text-center" style="padding-top:15px;">
                  <p><strong style="color:#3bafda"><?php echo $rowSide['mem_firstname'].' '. $rowSide['mem_lastname'];?></strong></p>
                  <button type="button" class="btn btn-success btn-xs" onclick="window.location.href='profileEdit.php'" >
                    <i class="glyphicon glyphicon-tasks"></i> แก้ไข
                  </button>&nbsp;
                  <button type="button" class="btn btn-danger btn-xs" onclick="window.location.href='?logout'" >
                    <i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a>
                  </button>
                </div>
              </div>
            </li>
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-user"></span> ข้อมูลผู้เช่าอาศัย / พนักงาน <span class="caret"></span>
                </a>
                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="renter.php"><span class="glyphicon glyphicon-list-alt"></span> จัดการผู้เช่าอาศัย</a></li>
                            <li><a href="employees.php"><span class="glyphicon glyphicon-list-alt"></span> จัดการพนักงาน</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl2">
                    <span class="glyphicon glyphicon-home"></span> หอพัก <span class="caret"></span>
                </a>
                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="dormitoryAdd.php"><span class="glyphicon glyphicon-plus"></span> เพิ่มตึกใหม่</a></li>
                            <?php if(isset($_SESSION['dormitory'])){ ?>
                            <li><a href="management.php"><span class="glyphicon glyphicon-xbt"></span> จัดการห้องพัก</a></li>
                            <li><a href="meter.php"><span class="glyphicon glyphicon-th-large"></span> จดมิเตอร์</a></li>
                            <li><a href="bill.php"><span class="glyphicon glyphicon-send"></span> ออกบิล</a></li>
                            <li><a href="dormitoryEdit.php"><span class="glyphicon glyphicon-home"></span> จัดการข้อมูลตึก</a></li>
                            <li><a href="roomRenameEdit.php"><span class="glyphicon glyphicon-xbt"></span> จัดการชื่อห้อง</a></li>
                            <li><a href="waterTariffsEdit.php"><span class="glyphicon glyphicon-tint"></span> จัดการคิดค่าน้ำ</a></li>
                            <li><a href="electricTariffsEdit.php"><span class="glyphicon glyphicon-fire"></span> จัดการคิดค่าไฟฟ้า</a></li>
                            <li><a href="bank.php?s=1"><span class="glyphicon glyphicon-th-large"></span> จัดการบัญชีธนาคาร</a></li>
                            <li><a href="accessories.php?s=1"><span class="glyphicon glyphicon-th-large"></span> จัดการอุปกรณ์ตกแต่งห้อง</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </li>
            <?php if(isset($_SESSION['dormitory'])){ ?>
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl3">
                    <span class="glyphicon glyphicon-wrench"></span> ผู้เช่าแจ้งเหตุขัดข้อง <span class="pull-right caret"></span>
                    <span class="pull-right badge badge-warning"><?php echo $rowCountRepair['count'];?></span>
                </a>
                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li>
                              <a href="repair.php">
                                <span class="glyphicon glyphicon-pushpin"></span> รายการแจ้งเหตุขัดข้อง
                                <span class="pull-right badge badge-info"><?php echo $rowCountRepair['count'];?></span>
                              </a>
                            </li>
                            <li><a href="repairDetail.php"><span class="glyphicon glyphicon-tasks"></span> รายการอุปกรณ์ที่ใช้ซ่อม</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
              <a href="payment.php">
                <span class="glyphicon glyphicon-picture"></span> ผู้เช่าแจ้งชำระเงิน
                <span class="pull-right badge badge-success"><?php echo $rowCountBill['count'];?></span>
              </a>
            </li>
            <?php if($rowDorms['dorm_water'] == 'yes') { ?>
            <li><a href="waterAlert.php"><span class="glyphicon glyphicon-tint"></span> ผู้เช่าแจ้งมิเตอร์น้ำ</a></li>
            <?php }if($rowDorms['dorm_electric'] == 'yes') { ?>
            <li><a href="electricAlert.php"><span class="glyphicon glyphicon-fire"></span> ผู้เช่าแจ้งมิเตอร์ไฟ</a></li>
            <?php } ?>
            <li><a href="parcel.php"><span class="glyphicon glyphicon-envelope"></span> แจ้งพัสดุที่มาส่ง</a></li>
            <li><a href="webboard.php"><span class="glyphicon glyphicon-calendar"></span> กระดานข่าว</a></li>
            <li><a href="income.php"><span class="glyphicon glyphicon-calendar"></span> สรุปรายรับ-รายจ่าย</a></li>
            <?php } ?>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
</div>
