<?php
  @session_start();
  require_once('include/connect.php');
  $roomID =  $_GET['roomID'];
  $queryRoom = "SELECT room_name FROM room WHERE room_id = '$roomID'";
  $resultRoom = mysqli_query($conn,$queryRoom);
  $rowRoom = mysqli_fetch_array($resultRoom);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">ยืนยันการชำระเงิน (ห้อง <?php echo $rowRoom['room_name']; ?>)</h4>
</div>
<form class="form-horizontal" name="formAdd" action="billPaymentQuery.php" enctype="multipart/form-data" method="post">

<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
  <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> ยืนยันการชำระเงิน</button>
</div>
<input type="hidden" name="bill_id" value="<?php echo $_GET['id'];?>">
</form>

<script type="text/javascript" >
  $('#clear').click(function() {
    $('.input01').filestyle('clear');
  });
</script>
