<?php
@session_start();
require_once('include/connect.php');

$id = $_GET['id'];
$queryView = "SELECT * FROM repair WHERE rep_id = '$id'";
$resultView = mysqli_query($conn,$queryView);
$rowView = mysqli_fetch_array($resultView);
$repairIMG = explode(',',$rowView['rep_img']);
$countView =  count($repairIMG);

$queryRoom = "SELECT * FROM room WHERE room_id = '$rowView[room_id]'";
$resultRoom = mysqli_query($conn,$queryRoom);
$rowRoom = mysqli_fetch_array($resultRoom);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">ห้องที่แจ้ง <?php echo $rowRoom['room_name']; ?></h4>
</div>

<div class="modal-body" style="margin:10px;">

      <div class="form-group">
        <label for="InputTopic">ชื่อหัวข้อ : </label>
        <input type="text" class="form-control" id="InputTopic" name="rep_topic"  placeholder="กรอกข้อมูลหัวข้อที่จะแจ้ง" value="<?php echo $rowView['rep_topic'];?>" disabled="">
      </div>
      <div class="form-group">
        <label for="InputDetail">รายละเอียด :</label>
        <textarea class="form-control" id="InputDetail" name="rep_detail" rows="3" required placeholder="กรอกรายละเอียดที่จะแจ้ง" disabled=""><?php echo $rowView['rep_detail'];?></textarea>
      </div>
      <div class="form-group">
        <label for="InputDate">วันที่แจ้ง : </label>
        <input type="text" class="form-control" id="InputDate" name="rep_date"  placeholder="กรอกข้อมูลหัวข้อที่จะแจ้ง" value="<?php echo date("d/m/Y : H:i:s",strtotime($rowView['rep_date']));?>" disabled="">
      </div>
      <div class="form-group">
        <label for="InputDate">สถานะ : </label>
        <input type="text" class="form-control" id="InputDate" name="rep_date"  placeholder="กรอกข้อมูลหัวข้อที่จะแจ้ง" value="<?php echo $rowView['rep_status'];?>" disabled="">
      </div>
      <div class="form-group">
        <?php
          if(!empty($rowView['rep_img'])){
            echo "<label for='InputImage'>รูปภาพประกอบ : </label>";
          for ($i=0; $i < $countView; $i++) {
        ?>
        <p align="center"><img src="images/img-repair/<?php echo $repairIMG[$i];?>" class="img-responsive" alt="Responsive image" width="50%"></p>
        <?php }} ?>
      </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
</div>
  <input type="hidden" name="id" value="<?php echo $id;?>">

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
