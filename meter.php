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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จดมิเตอร์</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
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
        <form name="formEdit" action="meterQuery.php" enctype="multipart/form-data" method="post" >
          <div class="row">
            <div class="col-md-12">
              <?php
              $rec = 1;
              while ($classStart <= $rowClass['dorm_class']) {
                $query = "SELECT * FROM room WHERE  dorm_id = $_SESSION[dormitory] AND room_class = $classStart";
                $result = mysqli_query($conn,$query);
                ?>
                <h4>ชั้นที่ <?php echo $classStart;?></h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th class="text-center" colspan="2"></th>
                      <th class="text-center" colspan="3" style="background-color:#3bafda;color:white;"><i class="glyphicon glyphicon-tint"></i> ค่าน้ำ</th>
                      <th class="text-center" colspan="3" style="background-color:red;color:white;"><i class="glyphicon glyphicon-fire"></i> ค่าไฟ</th>
                    </thead>
                    <thead>
                      <th class="text-center" style="background-color:grey;color:white;">ชื่อห้อง</th>
                      <th class="text-center" style="background-color:grey;color:white;">สถานะ</th>
                      <th class="text-center" style="background-color:grey;color:white;">เลขก่อนหน้า</th>
                      <th class="text-center" style="background-color:grey;color:white;">เลขล่าสุด</th>
                      <th class="text-center" style="background-color:grey;color:white;">หน่วยที่ใช้</th>
                      <th class="text-center" style="background-color:grey;color:white;">เลขก่อนหน้า</th>
                      <th class="text-center" style="background-color:grey;color:white;">เลขล่าสุด</th>
                      <th class="text-center" style="background-color:grey;color:white;">หน่วยที่ใช้</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)) {
                          $queryMeterCurrent = "SELECT * FROM bills WHERE bill_month = '$subSum' AND room_id = '$row[room_id]'";
                          $resultMeterCurrent = mysqli_query($conn,$queryMeterCurrent);
                          $rowMeterCurrent = mysqli_fetch_array($resultMeterCurrent);
                          if(isset($_POST['month'])){
                            //หาบิลของเดือนที่แล้ว
                            $queryMeter = "SELECT * FROM bills WHERE bill_month = '$m' AND room_id = '$row[room_id]'";
                            $resultMeter = mysqli_query($conn,$queryMeter);
                            $rowMeter = mysqli_fetch_array($resultMeter);
                            $water = 0;
                            $elec = 0;
                          }
                          ?>
                          <tr>
                            <input type="hidden" name="roomID[]" value="<?php echo $row['room_id']; ?>">
                            <td class="text-center" style="vertical-align: middle;"><?php echo $row['room_name'] ?></td>
                            <td>
                              <center>
                                <?php
                                if($row['room_status']=="ห้องมีผู้เช่า")
                                echo "<img src=\"images/renter.png\" class=\"img-responsive\" />";
                                ?>
                              </center>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                              <?php


                              if($subSum == substr($row['room_lease'], 0, 7)){
                                $water = $row['room_water'];
                                echo $water.'<br /><span style="color:red;font-size:14px;">เลขมิเตอร์แรกเข้า</span>';
                              } else if($row['room_id'] == $rowMeter['room_id']) {
                                $water = $rowMeter['bill_water'];
                                echo $water;
                              }else{
                                $water = 0;
                                echo $water;
                              }
                              ?>
                            </td>
                            <td width=20%>
                              <input type="number" class="form-control" min="<?php echo $water+1;?>"  name="water[]" size="15" <?php if($row['room_status']=="ห้องว่าง" || $row['room_status']=="กำลังตรวจสอบ" || $water=="") echo 'readOnly';?>
                              value="<?php if($row['room_id'] == $rowMeterCurrent['room_id'] && $row['room_status'] == 'ห้องมีผู้เช่า') { echo $rowMeterCurrent['bill_water'];}?>" placeholder="กรอกมิเตอร์ค่าน้ำล่าสุด"
                              onkeyup="digitsOnly(this);doCalSum(<?php echo $rec; ?>, this.value, <?php echo $water;?>)" required />
                            </td>
                            <td class="text-center" id="cl<?php echo $rec; ?>" style="vertical-align: middle;">
                              <span id="spnSum<?php echo $rec; ?>" valign="middle">0</span>
                                <input type="hidden" id="hdnSum<?php echo $rec; ?>" value="" />
                            </td>
                            <td class="text-center">
                              <?php
                              if($subSum == substr($row['room_lease'], 0, 7)){
                                $elec = $row['room_electric'];
                                echo $elec.'<br /><span style="color:red;font-size:14px;">เลขมิเตอร์แรกเข้า</span>';
                              } else if($row['room_id'] == $rowMeter['room_id']) {
                                $elec = $rowMeter['bill_electric'];
                                echo $elec;
                              }else{
                                $elec = 0;
                                echo $elec;
                              }
                              ?>
                            </td>
                            <td width=20%>
                              <input type="number" class="form-control" min="<?php echo $elec+1;?>"  name="elec[]" size="15" <?php if($row['room_status']=="ห้องว่าง" || $row['room_status']=="กำลังตรวจสอบ" || $elec=="") echo 'readOnly';?>
                              value="<?php if($row['room_id'] == $rowMeterCurrent['room_id'] && $row['room_status'] == 'ห้องมีผู้เช่า') { echo $rowMeterCurrent['bill_electric'];}?>" placeholder="กรอกมิเตอร์ค่าไฟล่าสุด"
                              onkeyup="digitsOnly(this);doCalSum2(<?php echo $rec; ?>,this.value, <?php echo $elec;?>)" required/>
                            </td>
                            <td class="text-center" id="cl2<?php echo $rec; ?>" style="vertical-align: middle;">
                              <span id="spnSum2<?php echo $rec; ?>">0</span>
                                <input type="hidden" id="hdnSum2<?php echo $rec; ?>" value="" />
                            </td>
                          </tr>
                          <?php
                          $rec++;
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
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                <i class="glyphicon glyphicon-saved"></i> <strong style="font-size:16px">บันทึก</strong>
              </button>
            </div>
            <div class="col-md-3">
            </div>
          </div>
          <input type="hidden" name="month" value="<?php if(isset($_POST['month'])) echo $subSum;?>">
        </form>
        <hr>
        <?php } ?>
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

  function doCalSum(Record, Qty, Price){
    var Sum;
    var Qs
    if(Qty != ""){
      Sum = parseInt(Qty) - parseInt(Price);
    }else{
      Sum = 0;
    }
    document.getElementById("hdnSum" + Record).value = Sum;
    document.getElementById("spnSum" + Record).innerHTML = Sum;
    if(Sum < 0 || parseInt(Qty) == parseInt(Price)){
      document.getElementById("cl" + Record).style.fontWeight = "bold";
      document.getElementById("cl" + Record).style.color = "white";
      document.getElementById("cl" + Record).style.backgroundColor = "#ED5565";
    }else if(Sum > 0){
      document.getElementById("cl" + Record).style.fontWeight = "bold";
      document.getElementById("cl" + Record).style.color = "white";
      document.getElementById("cl" + Record).style.backgroundColor = "#A0D468";
    }else{
      document.getElementById("cl" + Record).style.fontWeight = "";
      document.getElementById("cl" + Record).style.color = "black";
      document.getElementById("cl" + Record).style.backgroundColor = "white";
    }
  }
  function doCalSum2(Record, Qty, Price){
    var Sum;
    var Qs
    if(Qty != ""){
      Sum = parseInt(Qty) - parseInt(Price);
    }else{
      Sum = 0;
    }
    document.getElementById("hdnSum2" + Record).value = Sum;
    document.getElementById("spnSum2" + Record).innerHTML = Sum;
    if(Sum < 0 || parseInt(Qty) == parseInt(Price)){
      document.getElementById("cl2" + Record).style.fontWeight = "bold";
      document.getElementById("cl2" + Record).style.color = "white";
      document.getElementById("cl2" + Record).style.backgroundColor = "#ED5565";
    }else if(Sum > 0){
      document.getElementById("cl2" + Record).style.fontWeight = "bold";
      document.getElementById("cl2" + Record).style.color = "white";
      document.getElementById("cl2" + Record).style.backgroundColor = "#A0D468";
    }else{
      document.getElementById("cl2" + Record).style.fontWeight = "";
      document.getElementById("cl2" + Record).style.color = "black";
      document.getElementById("cl2" + Record).style.backgroundColor = "white";
    }
  }
  function digitsOnly(obj){
    var regExp = /[0-9]$/;
    if(!regExp.test(obj.value)){
      obj.value = obj.value.substring(0, obj.value.length -1);
      return false;
    }
  }
  </script>
  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
