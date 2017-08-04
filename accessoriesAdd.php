
<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title" style="font-size:20px;">
            <strong>เพิ่มอุปกรณ์ตกแต่งห้อง</strong>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" name="formAdd" action="accessoriesAddQuery.php" enctype="multipart/form-data"
          method="post" onSubmit="JavaScript:return fncSubmit('formAdd');">
          <!--Row 1-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputname"> ชื่ออุปกรณ์</label>
                <div class="form-inline">
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">
                      <i class="glyphicon glyphicon-th-list"></i>
                    </span>
                    <select class="form-control" name="lmName1" OnChange="resutName(this.value);">
                      <option value="">เลือกอุปกรณ์ตกแต่งห้อง</option>
                      <option value="ทีวี">ทีวี</option>
                      <option value="แอร์">แอร์</option>
                      <option value="ตู้เย็น">ตู้เย็น</option>
                      <option value="เฟอร์นิเจอร์">เฟอร์นิเจอร์</option>
                      <option value="เครื่องทำน้ำอุ่น">เครื่องทำน้ำอุ่น</option>
                      <option value="โซฟา">โซฟา</option>
                    </select>
                  </div> หรือ
                    <input type="text" class="form-control" id="inputname" name="name" placeholder="กรอกชื่ออุปกรณ์ตกแต่งห้อง" onKeyPress="return NameCode(name)">
                </div>
              </div>
            </div>
          </div>
          <!--Row 2-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputprice">ราคา <span style="color:red">(บาท)</span></label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-bitcoin"></i></span>
                  <input type="number" class="form-control" id="inputMonth" name="price" min="1.0" step="0.1" placeholder="ยกตัวอย่าง เช่น ราคาหัวละ 100 บาท">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">฿</span>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
            <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
          </div>
        </form>
      </div><!-- End Panel panel-body-->
    </div><!-- End Panel panel-primary-->
  </div><!-- End Modal Content -->
</div><!-- End Modal Dialog -->
</div><!-- End Modal -->
