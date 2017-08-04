<?php
@session_start();
require_once('../include/connect.php');

if(!isset($_SESSION['username']))
header("location:../login.php");
if(isset($_GET['logout'])){
  session_destroy();
  header("location:../login.php");
}

//Query
if(isset($_POST['txtsearch'])){

  $queryDorm = "SELECT * FROM dormitory WHERE dorm_id = '$_POST[txtsearch]'";
  $resultDorm = mysqli_query($conn,$queryDorm);
  $rowDorm = mysqli_fetch_array($resultDorm);
  $numDorm = mysqli_num_rows($resultDorm);

  $queryName = "SELECT * FROM room WHERE dorm_id = '$rowDorm[dorm_id]' AND room_status = 'ห้องว่าง'";
  $resultName = mysqli_query($conn,$queryName);
  $numName = mysqli_num_rows($resultName);

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
        <div class="col-md-12"><br />

          <div class="panel panel-info">
            <div class="panel-heading">
              <form action="#" method="post" name="formSearchDormitory">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input type="text" class="form-control" id="inputPassword" name="txtsearch" value="<?php if(isset($_POST['txtsearch'])) echo  $_POST['txtsearch']; ?>" placeholder="กรอกรหัสหอพักที่ต้องการค้นหา">
                  </div>
                </div>
                <button type="submit" name="Search" class="btn btn-success btn-block">ค้นหาหอพัก</button>
              </form>
            </div>
            <?php if(isset($_POST['txtsearch'])){  ?>
              <div class="panel-body">
                <?php if($numDorm > 0){ ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center">ข้อมูลหอพัก</h3>
                    </div>
                    <div class="panel-body">
                      <p class="text-center">
                        <strong><?php echo $rowDorm['dorm_name'];?></strong>
                      </p>
                      <hr />
                      <p>
                        ที่อยู่ : <?php echo $rowDorm['dorm_address'];?>
                      </p>
                      <p>
                        เบอร์โทร : <?php echo $rowDorm['dorm_tel'];?>
                      </p>
                      <form method="post" name="formSelectRoom" action="dormConnectQuery.php" onSubmit="JavaScript:return fncSubmit('formSelectRoom');">
                        <select class="form-control" name="class">
                          <option value="" disabled selected>เลือกชั้น</option>
                          <?php
                          for ($i=1; $i <= $rowDorm['dorm_class']; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                          }
                          ?>
                        </select>

                        <select class="form-control" name="room">
                          <option value="" disabled selected>เลือกห้อง</option>
                          <?php
                          while($rowName = mysqli_fetch_array($resultName)){
                            echo "<option value=\"$rowName[room_name]\">$rowName[room_name]</option>";
                          }
                          ?>
                        </select>
                        <button type="submit" name="Search" class="btn btn-primary btn-block">
                          <i class="glyphicon glyphicon-plus"></i> <strong >เชื่อมต่อหอพัก</strong>
                        </button>
                        <input type="hidden" name="dorm_id" value="<?php echo $rowDorm['dorm_id']; ?>">
                      </form>
                    </div>
                  </div>
                  <?php }else{ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">ข้อมูลหอพัก</h3>
                      </div>
                      <div class="panel-body">
                        <p class="text-center">
                          <strong>ไม่พบข้อมูลหอพัก</strong>
                        </p>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <?php } ?>
                </div>

              </div>
            </div>
          </div>
          <?php require_once("include/footer.php"); ?>
        </div>


        <!-- jQuery -->
        <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap-filestyle.js"></script>
        <script type="text/javascript" src="../assets/js/androidMyJs.js"></script>
        <script type="text/javascript">
        function fncSubmit(frm)
        {
          if(document.forms[frm].class.value == "")
          {
            alert('กรุณา เลือกชั้น ให้เรียบร้อย');
            return false;
          }else if(document.forms[frm].room.value == "")
          {
            alert('กรุณา เลือกห้อง ให้เรียบร้อย');
            return false;
          }
          return true;
        }
        </script>
        <!-- Close Conect Mysqli -->
        <?php mysqli_close($conn); ?>
      </body>
      </html>
