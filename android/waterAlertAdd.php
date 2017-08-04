<?php
//$id = $_GET['id'];
function DateThai($strDate){
  $strDay = date("d",strtotime($strDate));
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth = date("n",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","มกราคม",
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
  return "$strMonthThai $strYear";
}
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">แจ้งมิเตอร์น้ำประจำเดือน <?php echo DateThai($_GET['month']); ?></h4>
</div>
<form class="form-horizontal" name="formAdd" action="waterAlertAddQuery.php" enctype="multipart/form-data" method="post">
<div class="modal-body" style="margin:10px;">

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="InputTopic">เลขมิเตอร์ : </label>
        <input type="text" class="form-control" id="InputTopic" name="meter"  placeholder="กรอกข้อมูลเลขมิเตอร์ที่จะแจ้ง" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="InputImage">
          อัพโหลดรูปภาพประกอบ :
          <button id="clear" class="btn btn-default btn-xs" type="button">
            เคลียร์รูป
          </button>
        </label>
        <input type="file" id="InputImage" name="img" class="input01" accept="images/*" capture>
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
  <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
</div>
  <input type="hidden" name="month" value="<?php echo $_GET['month'];?>">
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
