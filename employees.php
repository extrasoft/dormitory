<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}

$queryEmp = "SELECT * FROM employee WHERE mem_id = '$_SESSION[id]'";
$resultEmp = mysqli_query($conn,$queryEmp);
$numEmp = mysqli_num_rows($resultEmp);
$num = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการพนักงาน</title>

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
        <div class="panel panel-primary">
          <div class="panel-heading">

            <form class="form-inline" method="post" action="" name="form2">
              <strong style="font-size:16px">
                <span>จัดการพนักงาน</span>
                <span>
                  <a href="employeesAdd.php" class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#myModal">
                    <i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูลพนักงาน
                  </a>
                </span>
              </strong>
            </form>
          </div>
          <div class="panel-body">
            <div class="table-responsive">

              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <th class="text-center">#</th>
                  <th class="text-center">ชื่อจริง</th>
                  <th class="text-center">นามสกุล</th>
                  <th class="text-center">เบอร์โทร</th>
                  <th class="text-center">ตำแหน่ง</th>
                  <th class="text-center">เงินเดือน</th>
                  <th class="text-center" width="10%">ปรับแต่ง</th>
                </thead>
                <tbody>
                  <?php  while($row = mysqli_fetch_array($resultEmp)) { ?>
                    <tr>
                      <td class="text-center"><?php echo $num++; ?></td>
                      <td><?php echo $row['emp_firstname']; ?></td>
                      <td><?php echo $row['emp_lastname']; ?></td>
                      <td class="text-center"><?php echo $row['emp_tel']; ?></td>
                      <td class="text-center"><?php echo $row['emp_position']; ?></td>
                      <td class="text-center"><?php echo number_format($row['emp_salary']); ?></td>
                      <td class="text-center">
                        <a href="employeesEdit.php?id=<?php echo $row['emp_id'];?>" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="employeesDelete.php?id=<?php echo $row['emp_id'];?>" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal">
                          <i class="glyphicon glyphicon-trash"></i>
                        </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->

<!-- Modal Zone -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
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
});

function fncSubmit(frm)
{
  if(document.forms[frm].fname.value == "")
  {
    alert('กรุณากรอก ชื่อจริง ให้เรียบร้อย');
    document.forms[frm].fname.focus();
    return false;
  }
  else if(document.forms[frm].lname.value == "")
  {
    alert('กรุณากรอก นามสกุล ให้เรียบร้อย');
    document.forms[frm].lname.focus();
    return false;
  }
  else if(document.forms[frm].addr.value == "")
  {
    alert('กรุณากรอก ที่อยู่ ให้เรียบร้อย');
    document.forms[frm].addr.focus();
    return false;
  }
  else if(document.forms[frm].tel.value == "")
  {
    alert('กรุณากรอก เบอร์โทรศัพท์ ให้เรียบร้อย');
    document.forms[frm].tel.focus();
    return false;
  }
  else if(document.forms[frm].position.value == "")
  {
    alert('กรุณากรอก ตำแหน่ง ให้เรียบร้อย');
    document.forms[frm].position.focus();
    return false;
  }
  else if(document.forms[frm].salary.value == "")
  {
    alert('กรุณากรอก เงินเดือน ให้เรียบร้อย');
    document.forms[frm].salary.focus();
    return false;
  }
  return true;
}

$(document).ready(function() {
    $('.datatable').DataTable();
});
</script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
