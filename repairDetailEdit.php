<?php
session_start();
require_once('include/connect.php');
$query="select * from repair_detail where repd_id = '$_GET[id]'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("m",strtotime($strDate));

  return "$strDay/$strMonth/$strYear";
}
?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title" style="font-size:20px;">
      <strong>แก้ไขข้อมูลรายละเอียดการแจ้งซ่อม</strong>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" name="formEdit" action="repairDetailEditQuery.php" enctype="multipart/form-data" method="post">
      <!--Row 1-->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputName" class="col-sm-3 control-label">ชื่ออุปกรณ์ : </label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-king"></i></span>
                <input type="text" class="form-control" id="inputName" name="name" placeholder="กรอกชื่ออุปกรณ์" value="<?php echo $row['repd_name']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputPrice" class="col-sm-3 control-label">ราคา : </label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-queen"></i></span>
                <input type="number" class="form-control" id="inputPrice" name="price" min="0.00" step="0.01" value="<?php echo $row['repd_price']; ?>" placeholder="ราคา" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Row 2-->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputAmount" class="col-sm-3 control-label">จำนวน : </label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-king"></i></span>
                <input type="number" class="form-control" id="inputAmount" name="amount" min="1"  placeholder="กรอกจำนวนอุปกรณ์" value="<?php echo $row['repd_amount']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputDate" class="col-sm-3 control-label">วันที่ซ่อม : </label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-queen"></i></span>
                <input type="text" class="form-control datepicker" id="inputDate" name="rDate" data-provide="datepicker" value="<?php if($row['repd_date'] != "") { echo DateThai($row['repd_date']);} ?>" data-date-language="th-th" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Row 3-->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputEmail" class="col-sm-4 control-label">เจ้าหน้าที่ที่ซ่อม : </label>
            <div class="input-group">
              <span class="input-group-addon" >
                <i class="glyphicon glyphicon-th-list"></i>
              </span>
              <?php
              $query2 = "select * from employee where mem_id = '$_SESSION[id]'";
              $result2 = mysqli_query($conn,$query2);
              ?>
              <select class="form-control" name="empID">
                <option value=""></option>
                <?php while($row2 = mysqli_fetch_row($result2)){ ?>
                  <option value="<?php echo $row2[0]; ?>" <?php if($row[5]==$row2[0]) {echo "selected=''";} ?>><?php echo $row2[1].' '.$row2[2]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!--Row 4-->
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputEmail" class="col-sm-4 control-label">รหัสใบแจ้งซ่อม : </label>
              <div class="input-group">
                <span class="input-group-addon" >
                  <i class="glyphicon glyphicon-th-list"></i>
                </span>
                <?php
                $query3 = "select * from repair where dorm_id = '$_SESSION[dormitory]'";
                $result3 = mysqli_query($conn,$query3);
                ?>
                <select class="form-control" name="repID">
                  <option value=""></option>
                  <?php while($row3 = mysqli_fetch_row($result3)){ ?>
                    <option value="<?php echo $row3[0] ?>" <?php if($row[6]==$row2[0]) {echo "selected=''";} ?>><?php echo $row3[0].' '.$row3[1]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <hr>
          <div class="pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
            <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
          </div>
          <input type="hidden" name="id" value="<?php echo $row[0];?>">
        </form>
      </div><!-- End Panel panel-body-->
    </div><!-- End Panel panel-primary-->
    <script type="text/javascript" >
    $('.datepicker').datepicker({
      format: "dd/mm/yyyy",
      //startDate: "-Infinity",
      //endDate: "+Infinity",
      language: "th",
      todayBtn: "linked",
      autoclose: true,
      todayHighlight: true
    });
    <?php if($row['repd_date'] == "") {?>
    $("#inputDate").datepicker("setDate", new Date());
    <?php } ?>

    </script>
