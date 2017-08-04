<?php
@session_start();
require_once('../include/connect.php');

$id = $_GET["id"];

$queryBank="SELECT * FROM bank";
$resultBank = mysqli_query($conn,$queryBank);
$rowBank = mysqli_fetch_row($resultBank);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">แจ้งชำระเงิน</h4>
</div>
<form class="form-horizontal" name="formEdit" action="billsUploadQuery.php" enctype="multipart/form-data" method="post">
  <div class="modal-body" style="margin:10px;">
    <div class="form-group">
      <label for="InputBank">ธนาคารที่โอน : </label>
      <select class="form-control" id="InputBank" name="bank">
        <option value="ธนาคารกรุงเทพ" <?php if($rowBank[1]=='ธนาคารกรุงเทพ') {echo "selected=''";} ?>>ธนาคารกรุงเทพ</option>
        <option value="ธนาคารกสิกรไทย" <?php if($rowBank[1]=='ธนาคารกสิกรไทย') {echo "selected=''";} ?>>ธนาคารกสิกรไทย</option>
        <option value="ธนาคารกรุงศรี" <?php if($rowBank[1]=='ธนาคารกรุงศรี') {echo "selected=''";} ?>>ธนาคารกรุงศรี</option>
        <option value="ธนาคารกรุงไทย" <?php if($rowBank[1]=='ธนาคารกรุงไทย') {echo "selected=''";} ?>>ธนาคารกรุงไทย</option>
        <option value="ธนาคารออมสิน" <?php if($rowBank[1]=='ธนาคารออมสิน') {echo "selected=''";} ?>>ธนาคารออมสิน</option>
        <option value="ธนาคารไทยพาณิชย์" <?php if($rowBank[1]=='ธนาคารไทยพาณิชย์') {echo "selected=''";} ?>>ธนาคารไทยพาณิชย์</option>
        <option value="ธนาคารธนชาติ" <?php if($rowBank[1]=='ธนาคารธนชาติ') {echo "selected=''";} ?>>ธนาคารธนชาติ</option>
        <option value="ธนาคารทหารไทย" <?php if($rowBank[1]=='ธนาคารทหารไทย') {echo "selected=''";} ?>>ธนาคารทหารไทย</option>
      </select>
    </div>

    <div class="form-group">
      <label for="InputBranch">สาขาที่โอน : <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="InputBranch" name="branch"  placeholder="กรอกข้อมูลสาขาที่โอน" required>
    </div>

    <div class="form-group">
      <label for="InputName">ชื่อผู้โอน : <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="InputName" name="name"  placeholder="กรอกข้อมูลชื่อผู้โอน" required>
    </div>

    <div class="form-group">
      <label for="InputMoney">จำนวนเงิน : <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="InputMoney" name="money"  placeholder="กรอกจำนวนเงินที่โอน" maxlength="9" required>
    </div>

    <div class="form-group">
      <label for="InputMoney">วันที่โอน : <span style="color:red">*</span></label>
      <input type="datetime-local" class="form-control" id="InputMoney" name="payment"  placeholder="กรอกวันที่โอน" required>
    </div>

    <div class="form-group">
      <label for="InputImage">
        อัพโหลดสลิปการโอน : <span style="color:red">*</span>
        <button id="clear" class="btn btn-default btn-xs" type="button">
          เคลียร์รูป
        </button>
      </label>
      <input type="file" id="InputImage" name="img" class="input01" accept="images/*" capture>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
    <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
  </div>
  <input type="hidden" name="id" value="<?php echo $id;?>">
</form>

<script type="text/javascript" >
$('.input01').filestyle({
  'placeholder' : 'อัพโหลดสลิปการโอน',
  buttonText : 'เลือกรูป',
  buttonName : 'btn-danger'
});
</script>
