<?php
require_once('include/connect.php');
  $query="select * from bank where bank_id = '$_POST[aid]'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_row($result);
?>
<!--Row 1-->
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="inputname">เลือกบัญชีธนาคาร</label>
      <div class="input-group">
        <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">
          <i class="glyphicon glyphicon-th-list"></i>
        </span>
        <select class="form-control" name="bank">
          <option value="1ธนาคารกรุงเทพ" <?php if($row[1]=='ธนาคารกรุงเทพ') {echo "selected=''";} ?>>ธนาคารกรุงเทพ</option>
          <option value="2ธนาคารกสิกรไทย" <?php if($row[1]=='ธนาคารกสิกรไทย') {echo "selected=''";} ?>>ธนาคารกสิกรไทย</option>
          <option value="3ธนาคารกรุงศรี" <?php if($row[1]=='ธนาคารกรุงศรี') {echo "selected=''";} ?>>ธนาคารกรุงศรี</option>
          <option value="4ธนาคารกรุงไทย" <?php if($row[1]=='ธนาคารกรุงไทย') {echo "selected=''";} ?>>ธนาคารกรุงไทย</option>
          <option value="5ธนาคารออมสิน" <?php if($row[1]=='ธนาคารออมสิน') {echo "selected=''";} ?>>ธนาคารออมสิน</option>
          <option value="6ธนาคารไทยพาณิชย์" <?php if($row[1]=='ธนาคารไทยพาณิชย์') {echo "selected=''";} ?>>ธนาคารไทยพาณิชย์</option>
          <option value="7ธนาคารธนชาติ" <?php if($row[1]=='ธนาคารธนชาติ') {echo "selected=''";} ?>>ธนาคารธนชาติ</option>
          <option value="8ธนาคารทหารไทย" <?php if($row[1]=='ธนาคารทหารไทย') {echo "selected=''";} ?>>ธนาคารทหารไทย</option>
        </select>
      </div>
    </div>
  </div>
</div>
  <!--Row 2-->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputname">สาขา </label>
        <div class="input-group">
          <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-home"></i></span>
          <input type="text" class="form-control" id="inputname" name="branch" value="<?php echo $row[2];?>" onKeyPress="return NameCode(branch)">
        </div>
      </div>
    </div>
  </div>
  <!--Row 3-->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputname">ชื่อบัญชี </label>
        <div class="input-group">
          <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" class="form-control" id="inputname" name="name" value="<?php echo $row[3];?>" onKeyPress="return NameCode(name)">
        </div>
      </div>
    </div>
  </div>
  <!--Row 4-->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="inputname">เลขที่บัญชี </label>
        <div class="input-group">
          <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-calendar"></i></span>
          <input type="text" class="form-control" maxlength="10" id="inputname" name="number"  value="<?php echo $row[4];?>" pattern="[1-9]{1}[0-9]{9}" onKeyPress="return isPhoneNo(number)">
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
