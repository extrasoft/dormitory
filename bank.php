<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
$query = "SELECT * from bank where dorm_id = $_SESSION[dormitory]";
$result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการบัญชีธนาคาร</title>

  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootflat/css/bootflat.css">
  <link rel="stylesheet" href="assets/css/mystyle.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script language="javascript">
  var HttPRequest = false;
  function editt(aid) {
    HttPRequest = false;
    if (window.XMLHttpRequest) {
      HttPRequest = new XMLHttpRequest();
      if (HttPRequest.overrideMimeType) {
        HttPRequest.overrideMimeType('text/html');
      }
    } else if (window.ActiveXObject) {
      try {
        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
          HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {}
      }
    }

    if (!HttPRequest) {
      alert('Cannot create XMLHTTP instance');
      return false;
    }

    var url = 'bankEditForm.php';
    var pmeters="&aid="+aid;
    HttPRequest.open('POST',url,true);
    HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    HttPRequest.setRequestHeader("Content-length", pmeters.length);
    HttPRequest.setRequestHeader("Connection", "close");
    HttPRequest.send(pmeters);

    HttPRequest.onreadystatechange = function()
    {

      if(HttPRequest.readyState == 3)
      {
        document.getElementById("edit1").innerHTML = "Now is Loading...";
      }

      if(HttPRequest.readyState == 4)
      {
        document.getElementById('edit1').innerHTML = HttPRequest.responseText;
      }
    }

  }
  function deletee(aid) {
    HttPRequest = false;
    if (window.XMLHttpRequest) {
      HttPRequest = new XMLHttpRequest();
      if (HttPRequest.overrideMimeType) {
        HttPRequest.overrideMimeType('text/html');
      }
    } else if (window.ActiveXObject) {
      try {
        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        try {
          HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {}
      }
    }

    if (!HttPRequest) {
      alert('Cannot create XMLHTTP instance');
      return false;
    }

    var url = 'bankDeleteForm.php';
    var pmeters="&aid="+aid;
    HttPRequest.open('POST',url,true);
    HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    HttPRequest.setRequestHeader("Content-length", pmeters.length);
    HttPRequest.setRequestHeader("Connection", "close");
    HttPRequest.send(pmeters);

    HttPRequest.onreadystatechange = function()
    {

      if(HttPRequest.readyState == 3)
      {
        document.getElementById("delete1").innerHTML = "Now is Loading...";
      }

      if(HttPRequest.readyState == 4)
      {
        document.getElementById('delete1').innerHTML = HttPRequest.responseText;
      }
    }

  }
  </script>
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
    <div id="page-content-wrapper" style="font-size:20px;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="text-center">จัดการบัญชีธนาคาร</h3><hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
          </div>
          <div class="col-md-2">
            <button type="button" name="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalAdd">
              <i class="glyphicon glyphicon-plus"></i> <strong style="font-size:16px">เพิ่มธนาคาร</strong>
            </button>
          </div>
          <div class="col-md-5">
          </div>
        </div><br>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped">
              <tbody>
                <?php while ($rows = mysqli_fetch_row($result)) { ?>
                  <tr>
                    <td width="12%">
                      <img src="images/img-bank/<?php echo $rows[5] ?>" alt="profile" class="img-rounded" width="100px" height="100px">
                    </td>
                    <td>
                      <?php
                      echo $rows[1].' สาขา '.$rows[2].'<br />';
                      echo 'ชื่อบัญชี : '.$rows[3].'<br />';
                      echo 'เลขที่บัญชี : '.preg_replace('|^(\d{3})(\d{1})(\d{5})(\d{1})|','$1-$2-$3-$4',$rows[4]);
                      ?>
                      <div class="pull-right">
                        <button type="button" name="button" class="btn btn-xs btn-warning"
                        data-toggle="modal" data-target="#modalEdit" onclick="javascript:editt(<?php echo $rows[0];?>);">
                        <i class="glyphicon glyphicon-pencil"></i> <strong style="font-size:15px"></strong>
                      </button>
                      <button type="button" name="btnDelete" class="btn btn-xs btn-danger"
                      data-toggle="modal" data-target="#modalDelete" onclick="javascript:deletee(<?php echo $rows[0];?>);">
                      <i class="glyphicon glyphicon-trash"></i> <strong style="font-size:15px"></strong>
                    </button>
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <hr>
      <?php if(!isset($_GET['s'])) {?>
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <a href="accessories.php" role="button" class="btn btn-block btn-lg btn-primary">ยืนยัน</a>
        </div>
        <div class="col-md-3">
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<?php require_once('bankAdd.php'); ?>
<?php require_once('bankEdit.php'); ?>
<?php require_once('bankDelete.php'); ?>
<!-- jQuery -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
<script type="text/javascript" src="assets/js/myJS.js"></script>
<script type="text/javascript">
function fncSubmit(frm)
{
  if(document.forms[frm].branch.value == "")
  {
    alert('กรุณากรอก ชื่อสาขา ให้เรียบร้อย');
    document.forms[frm].branch.focus();
    return false;
  }
  else if(document.forms[frm].name.value == "")
  {
    alert('กรุณากรอก ชื่อบัญชี ให้เรียบร้อย');
    document.forms[frm].name.focus();
    return false;
  }
  else if(document.forms[frm].number.value == "")
  {
    alert('กรุณากรอก เลขที่บัญชี ให้เรียบร้อย');
    document.forms[frm].number.focus();
    return false;
  }
  return true;
}
</script>
<!-- Close Conect Mysqli -->
<?php mysqli_close($conn); ?>
</body>
</html>
