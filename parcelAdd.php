<?php

  function DateThai($strDate){
    $strDay = date("d",strtotime($strDate));
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth = date("m",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    return "$strDay/$strMonth/$strYear";
  }
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลพัสดุ</h4>
</div>
<form class="form-horizontal" name="formAdd" action="parcelAddQuery.php" enctype="multipart/form-data" method="post">
  <div class="modal-body" style="margin:10px;">
    <div class="form-group">
      <label for="InputName">ชื่อผู้รับ : </label>
      <input type="text" class="form-control" id="InputName" name="name"  placeholder="กรอกข้อมูลชื่อผู้รับ" required>
    </div>
    <div class="form-group">
      <label for="InputDetail">รายละเอียด :</label>
      <textarea class="form-control" id="InputDetail" name="detail" rows="3" placeholder="กรอกรายละเอียดที่อยู่ผู้รับ"></textarea>
    </div>
    <div class="form-group">
      <label for="InputDate">วันที่รับพัสดุ : </label>
      <input type="text" class="form-control datepicker" id="InputDate" name="par_date" value="" data-provide="datepicker" data-date-language="th-th" required>
    </div>
    <div class="form-group">
      <label for="InputImage">
        อัพโหลดรูปภาพประกอบ :
        <button id="clear" class="btn btn-default btn-xs" type="button">
          เคลียร์รูป
        </button>
      </label>
      <input type="file" id="InputImage" name="img[]" multiple="multiple" class="input01" accept="images/*" capture>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
    <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
  </div>
</form>

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

$("#InputDate").datepicker("setDate", new Date());

$('.input01').filestyle({
  'placeholder' : 'รูปภาพประกอบ',
  buttonText : 'เลือกรูป',
  buttonName : 'btn-danger'
});

$('#clear').click(function() {
  $('.input01').filestyle('clear');
});
</script>
