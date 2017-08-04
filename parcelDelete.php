<?php
session_start();
require_once('include/connect.php');

$id = $_GET['id'];
$query = "SELECT * FROM parcel WHERE par_id = '$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">ลบข้อมูลพัสดุ</h4>
</div>
<form class="form-horizontal" name="formAdd" action="parcelDeleteQuery.php" enctype="multipart/form-data" method="post">
  <div class="modal-body" style="margin:10px;">
    <center>
      <h4>คุณต้องการจะลบข้อมูลจริงหรือไม่ ?</h4>
    </center>
    <strong style="font-size:16px">
      <?php
      echo 'ชื่อ-นามสกุลผู้รับ : '.$row['par_name'].'<br />';
      echo 'รายละเอียด : '.$row['par_address'];
      ?>
    </strong>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
    <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> ลบข้อมูล</button>
  </div>
  <input type="hidden" name="par_id" value="<?php echo $row['par_id'];?>">
</form>

<script type="text/javascript" >
$('#clear').click(function() {
  $('.input01').filestyle('clear');
});
</script>
