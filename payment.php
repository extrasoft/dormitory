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
  $queryBill = "SELECT * FROM bills WHERE dorm_id = '$_SESSION[dormitory]' AND bill_status='รอการตรวจสอบ' ORDER BY bill_id DESC";
  $resultBill = mysqli_query($conn,$queryBill);
  $numBill = mysqli_num_rows($resultBill);
  $num = 1;
}
function DateThai($strDate){
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("m",strtotime($strDate));
  return "$strMonth/$strYear";
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
  <link rel="stylesheet" href="assets/bootflat/css/bootflat.css">
  <link rel="stylesheet" href="assets/media/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/mystyle.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

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
          ?>
          <div class="panel panel-primary">
            <div class="panel-heading">

              <form class="form-inline" method="post" action="" name="form2">
                <strong style="font-size:18px">
                  <span>ผู้เช่าแจ้งชำระเงิน</span>
                </strong>
              </form>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover datatable"><!--แสดงตารางพนักงาน-->
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">รอบบิล</th>
                      <th class="text-center">ห้องที่แจ้ง</th>
                      <th class="text-center">ปรับแต่ง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rowBill = mysqli_fetch_array($resultBill)){
                      $queryRoom = "SELECT * FROM room WHERE room_id = '$rowBill[room_id]'";
                      $resultRoom = mysqli_query($conn,$queryRoom);
                      $rowRoom = mysqli_fetch_array($resultRoom);
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $num++; ?></td>
                        <td class="text-center"><?php echo DateThai($rowBill['bill_month']); ?></td>
                        <td class="text-center"><?php echo $rowRoom['room_name'] ?></td>
                        <td class="text-center">
                          <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal" href="paymentEdit.php?id=<?php echo $rowBill['bill_id'];?>">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
        }else{
          echo "<h3 class=\"text-center\">กรุณาเลือกหอพักสำหรับจัดการ</h3>";
        }
        ?>

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
  <script type="text/javascript" src="assets/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/media/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/myJS.js"></script>
  <script type="text/javascript">

  $(document).ready(function() {
    $('#myModal').on('hidden.bs.modal', function () {
      $(this).removeData('bs.modal');
    });
    $('.datatable').DataTable();
  });
  </script>
  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
