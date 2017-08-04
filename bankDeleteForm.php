<?php
require_once('include/connect.php');
  $query="select * from bank where bank_id = '$_POST[aid]'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_row($result);
?>
  <!--Row 1-->
  <div class="row">
    <div class="col-md-12">
      <strong style="font-size:16px">
          <?php
          echo 'ธนาคาร : '.$row[1].' สาขา '.$row[2].'<br />';
          echo 'ชื่อบัญชี : '.$row[3].'<br />';
          echo 'เลขที่บัญชี : '.preg_replace('|^(\d{3})(\d{1})(\d{5})(\d{1})|','$1-$2-$3-$4',$row[4]);
          ?>
      </strong>
    </div>
  </div>
  <hr>
  <div class="pull-right">
    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
    <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> ลบข้อมูล</button>
  </div>
  <input type="hidden" name="id" value="<?php echo $row[0];?>">
