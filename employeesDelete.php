<?php
require_once('include/connect.php');
$query="select * from employee where emp_id = '$_GET[id]'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title" style="font-size:20px;">
      <strong>ลบข้อมูลพนักงาน</strong>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" name="formDelete" action="employeesDeleteQuery.php"
    enctype="multipart/form-data" method="post" onSubmit="JavaScript:return fncSubmit('formDelete');">
    <div class="row">
      <div class="col-md-12">
        <center>
          <h4>คุณต้องการที่จะลบข้อมูล</h4>
        </center>
        <strong style="font-size:16px">
          <?php
          echo 'ชื่อ-นามสกุล : '.$row['emp_firstname'].' '.$row['emp_lastname'].'<br />';
          echo 'เบอร์โทร : '.$row['emp_tel'].'<br />';
          echo 'ตำแหน่ง : '.$row['emp_position'].'<br />';
          echo 'เงินเดือน : '.$row['emp_salary'];
          ?>
        </strong>

      </div>
    </div>
    <hr>
    <div class="pull-right">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
      <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> ลบข้อมูล</button>
    </div>
    <input type="hidden" name="id" value="<?php echo $row['emp_id'];?>">
  </form>
</div><!-- End Panel panel-body-->
</div><!-- End Panel panel-primary-->
