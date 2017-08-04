<?php
require_once('include/connect.php');
  $query="select * from repair_detail where repd_id = '$_GET[id]'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_array($result);
?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title" style="font-size:20px;">
            <strong>ลบข้อมูลรายละเอียดการซ่อม</strong>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" name="formDelete" action="repairDetailDeleteQuery.php"
          enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-12">
              <center>
                <h4>คุณต้องการที่จะลบข้อมูล</h4>
              </center>
              <strong style="font-size:16px">
                <?php
                echo 'ชื่ออุปกรณ์ : '.$row['repd_name'].'<br />';
                echo 'ราคา : '.$row['repd_price'].' บาท<br />';
                echo 'จำนวน : '.$row['repd_amount'].' ชิ้น';
                ?>
            </div>
          </div>
            <hr>
            <div class="pull-right">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
              <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> ลบข้อมูล</button>
            </div>
            <input type="hidden" name="id" value="<?php echo $row[0];?>">
          </form>
        </div><!-- End Panel panel-body-->
      </div><!-- End Panel panel-primary-->
