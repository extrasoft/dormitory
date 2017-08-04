<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="#menu-toggle" class="navbar-brand" id="menu-toggle">
        <i class="glyphicon glyphicon-menu-hamburger" style="font-size:22px;"></i>
      </a>
      <?php
        if(isset($_SESSION['dormitory'])) {
          $queryDormName = "SELECT dorm_name FROM dormitory WHERE dorm_id = '$_SESSION[dormitory]'";
          $resultDormName = mysqli_query($conn,$queryDormName);
          $rowDormName = mysqli_fetch_array($resultDormName);
          echo "<a href=\"index.php\" class=\"navbar-brand\">$rowDormName[dorm_name]</a>";
        }else{
          echo "<a href=\"index.php\" class=\"navbar-brand\">ระบบจัดการหอพัก</a>";
        }
      ?>
    </div>

    <div class="collapse navbar-collapse" id="mynavbar-collapse">
      <!--เมนูด้านซ้าย
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a></li>
      </ul>

      เมนูด้านขวา
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="images/1.jpg" alt="profile" class="img-circle" width="20px" height="20px">  Thanapon Yenjam <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">ส่วนของสมาชิก</li>
            <li><a href="#"><i class="glyphicon glyphicon-log-in"></i> เข้าสู่ระบบ</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-tasks"></i> สมัครสมาชิก</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a></li>
          </ul>
        </li>
      </ul>
      -->
    </div>

  </div>
</nav>
