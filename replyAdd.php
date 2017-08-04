<?php
$id = $_GET['id'];
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">แสดงความคิดเห็น</h4>
</div>
<form class="form-horizontal" name="formAdd" action="replyAddQuery.php" enctype="multipart/form-data" method="post"
onSubmit="JavaScript:return fncSubmit('formAdd');">
<div class="modal-body" style="margin:10px;">

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="InputDetail">รายละเอียด :</label>
        <textarea class="form-control" id="InputDetail" name="detail" rows="3" required placeholder="กรอกรายละเอียดที่จะสอบถาม"></textarea>
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
        <input type="file" id="InputImage" name="img[]" multiple="multiple" class="input01" accept="images/*" capture>
      </div>
    </div>
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
