<?php
require_once('include/connect.php');
  $query="select * from accessories where accs_id = '$_POST[aid]'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_row($result);
?>
  <!--Row 1-->
  <div class="row">
    <div class="col-md-12">
          <strong style="font-size:16px">
              <?php
              echo 'ชื่ออุปกรณ์ตกแต่ง : '.$row[1].'<br />';
              echo 'ราคา : '.$row[2].' บาท';
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
