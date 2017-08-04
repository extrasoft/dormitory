<?php
@session_start();
require_once('include/connect.php');
if(!isset($_SESSION['username']))
header("location:login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:login.php");
}
$query = "SELECT * from accessories where dorm_id = $_SESSION[dormitory]";
$result = mysqli_query($conn,$query);
$num = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>จัดการอุปกรณ์ตกแต่งห้อง</title>

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

    var url = 'accessoriesEditForm.php';
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

    var url = 'accessoriesDeleteForm.php';
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
            <h3 class="text-center">จัดการอุปกรณ์ตกแต่งห้อง</h3><hr>
          </div>
        </div>


        <div class="row">
          <div class="col-md-5">
          </div>
          <div class="col-md-2">
            <button type="button" name="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalAdd">
              <i class="glyphicon glyphicon-plus"></i> <strong style="font-size:16px">เพิ่มอุปกรณ์</strong>
            </button>
          </div>
          <div class="col-md-5">
          </div>
        </div><br />

        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped">
              <thead>
                <th class="text-center" width="5%">#</th>
                <th class="text-center" width="70%">ชื่ออุปกรณ์</th>
                <th class="text-center" width="15%">ราคา(บาท)</th>
                <th class="text-center" width="10%">ปรับแต่ง</th>
              </thead>
              <tbody>
                <?php while ($rows = mysqli_fetch_row($result)) { ?>
                  <tr>
                    <td class="text-center">
                      <?php  echo $num++; ?>
                    </td>
                    <td>
                      <?php  echo $rows[1]; ?>
                    </td>
                    <td class="text-center">
                      <?php  echo number_format($rows[2],2); ?>
                    </td>
                    <td class="text-center">
                      <button type="button" name="button" class="btn btn-xs btn-warning"
                      data-toggle="modal" data-target="#modalEdit" onclick="javascript:editt(<?php echo $rows[0];?>);">
                      <i class="glyphicon glyphicon-pencil"></i> <strong style="font-size:15px"></strong>
                    </button>
                    <button type="button" name="btnDelete" class="btn btn-xs btn-danger"
                    data-toggle="modal" data-target="#modalDelete" onclick="javascript:deletee(<?php echo $rows[0];?>);">
                    <i class="glyphicon glyphicon-trash"></i> <strong style="font-size:15px"></strong>
                  </button>
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
            <a href="management.php" role="button" class="btn btn-block btn-lg btn-primary">ยืนยัน</a>
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
  <?php require_once('accessoriesAdd.php'); ?>
  <?php require_once('accessoriesEdit.php'); ?>
  <?php require_once('accessoriesDelete.php'); ?>
  <!-- jQuery -->
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
  <script type="text/javascript" src="assets/js/myJS.js"></script>
  <script type="text/javascript">
  function fncSubmit(frm)
  {
    if(document.forms[frm].name.value == "")
    {
      alert('กรุณากรอก ชื่ออุปกรณ์ ให้เรียบร้อย');
      document.forms[frm].name.focus();
      return false;
    }
    else if(document.forms[frm].price.value == "")
    {
      alert('กรุณากรอก ราคา ให้เรียบร้อย');
      document.forms[frm].price.focus();
      return false;
    }
    return true;
  }


  function resutName(CusID)
  {
    switch(CusID)
    {
        case "ทีวี": formAdd.name.value = "ทีวี";
          break;
        case "แอร์": formAdd.name.value = "แอร์";
          break;
        case "ตู้เย็น": formAdd.name.value = "ตู้เย็น";
          break;
        case "เฟอร์นิเจอร์": formAdd.name.value = "เฟอร์นิเจอร์";
          break;
        case "เครื่องทำน้ำอุ่น": formAdd.name.value = "เครื่องทำน้ำอุ่น";
          break;
        case "โซฟา": formAdd.name.value = "โซฟา";
          break;
        default: formAdd.name.value = "";
    }
  }

  function resutName2(CusID)
  {
    switch(CusID)
    {
        case "ทีวี": formEdit.name.value = "ทีวี";
          break;
        case "แอร์": formEdit.name.value = "แอร์";
          break;
        case "ตู้เย็น": formEdit.name.value = "ตู้เย็น";
          break;
        case "เฟอร์นิเจอร์": formEdit.name.value = "เฟอร์นิเจอร์";
          break;
        case "เครื่องทำน้ำอุ่น": formEdit.name.value = "เครื่องทำน้ำอุ่น";
          break;
        case "โซฟา": formEdit.name.value = "โซฟา";
          break;
        default: formEdit.name.value = "";
    }
  }


  </script>
  <!-- Close Conect Mysqli -->
  <?php mysqli_close($conn); ?>
</body>
</html>
