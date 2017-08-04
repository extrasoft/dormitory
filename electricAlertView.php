<?php
session_start();
require_once('include/connect.php');

$id = $_GET['id'];
$query = "SELECT * FROM electric_alert WHERE aelectric_id = '$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">ดูรูปภาพที่ผู้เช่าแจ้ง</h4>
</div>
  <div class="modal-body" style="margin:10px;">
    <p align="center"><img src="images/img-electricAlert/<?php echo $row['aelectric_img'];?>" class="img-responsive" alt="Responsive image"></p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
  </div>

<script type="text/javascript" >
$('#clear').click(function() {
  $('.input01').filestyle('clear');
});
</script>
