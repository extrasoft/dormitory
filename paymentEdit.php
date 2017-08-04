<?php
@session_start();
require_once('include/connect.php');

$id = $_GET['id'];
$queryView = "SELECT * FROM bills WHERE bill_id = '$id'";
$resultView = mysqli_query($conn,$queryView);
$rowView = mysqli_fetch_array($resultView);

$queryRoom = "SELECT * FROM room WHERE room_id = '$rowView[room_id]'";
$resultRoom = mysqli_query($conn,$queryRoom);
$rowRoom = mysqli_fetch_array($resultRoom);

function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("n",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","มกราคา",
  "กุมภาพันธ์",
  "มีนาคม",
  "เมษายน",
  "พฤษภาคม",
  "มิถุนายน",
  "กรกฎาคม",
  "สิงหาคม",
  "กันยายน",
  "ตุลาคม",
  "พฤศจิกายน",
  "ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "วันที่ : $strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds";
}
function DateThai2($strDate){
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("m",strtotime($strDate));
  return "$strMonth/$strYear";
}
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h5 class="modal-title" id="myModalLabel">
    ห้องที่แจ้งชำระเงิน (<?php echo $rowRoom['room_name']; ?>)
    <span class="pull-right">รอบบิล <?php echo DateThai2($rowView['bill_month']);?></span>
  </h5>
</div>
<form class="form-horizontal" name="formAdd" action="paymentEditQuery.php" enctype="multipart/form-data" method="post">
<div class="modal-body" style="margin:10px;">

      <div class="form-group">
        <label for="InputBranch">ธนาคารที่โอน : <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="InputBranch" name="bank"  placeholder="กรอกข้อมูลสาขาที่โอน" value="<?php echo $rowView['bill_bank'] ?>" disabled="">
      </div>
      <div class="form-group">
        <label for="InputBranch">สาขาที่โอน : <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="InputBranch" name="branch"  placeholder="กรอกข้อมูลสาขาที่โอน" value="<?php echo $rowView['bill_branch'] ?>" disabled="">
      </div>

      <div class="form-group">
        <label for="InputName">ชื่อผู้โอน : <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="InputName" name="name"  placeholder="กรอกข้อมูลชื่อผู้โอน" value="<?php echo $rowView['bill_name'] ?>" disabled="">
      </div>

      <div class="form-group">
        <label for="InputMoney">จำนวนเงิน : <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="InputMoney" name="money"  placeholder="กรอกจำนวนเงินที่โอน" value="<?php echo $rowView['bill_money'] ?>" disabled="">
      </div>

      <div class="form-group">
        <label for="InputMoney">วันที่โอน : <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="InputMoney" name="payment"  placeholder="กรอกวันที่โอน" value="<?php echo DateThai($rowView['bill_payment']); ?>" disabled="">
      </div>
      <div class="form-group">
        <label for="InputStatus">สถานะ : </label>
        <select class="form-control" id="InputStatus" name="bill_status">
          <option value="รอการตรวจสอบ" <?php if($rowView['bill_status']=="รอการตรวจสอบ") {echo "selected=''";} ?>>รอการตรวจสอบ</option>
          <option value="ชำระเงินเรียบร้อย" <?php if($rowView['bill_status']=="ชำระเงินเรียบร้อย") {echo "selected=''";} ?>>ชำระเงินเรียบร้อย</option>
        </select>
      </div>
      <div class="form-group">
        <?php if(!empty($rowView['bill_img'])){ ?>
        <label for='InputImage'>สลิปการโอน : </label>
        <p align="center"><img src="images/img-bill/<?php echo $rowView['bill_img'];?>" class="img-responsive" alt="Responsive image" width="50%"></p>
        <?php } ?>
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
    'placeholder' : 'รูปภาพประกอบ',
    buttonText : 'เลือกรูป',
    buttonName : 'btn-danger'
  });
  $('#clear').click(function() {
    $('.input01').filestyle('clear');
  });
</script>
