<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title" style="font-size:20px;">
            <strong>เพิ่มธนาคาร</strong>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" name="formAdd" action="bankAddQuery.php" enctype="multipart/form-data"
          method="post" onSubmit="JavaScript:return fncSubmit('formAdd');">
          <!--Row 1-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputname">เลือกบัญชีธนาคาร</label>
                <div class="input-group">
                  <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;">
                    <i class="glyphicon glyphicon-th-list"></i>
                  </span>
                  <select class="form-control" name="bank">
                    <option value="1ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                    <option value="2ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                    <option value="3ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                    <option value="4ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                    <option value="5ธนาคารออมสิน">ธนาคารออมสิน</option>
                    <option value="6ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                    <option value="7ธนาคารธนชาติ">ธนาคารธนชาติ</option>
                    <option value="8ธนาคารทหารไทย">ธนาคารทหารไทย</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
            <!--Row 2-->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputname">สาขา </label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" id="inputname" name="branch" placeholder="กรอกชื่อหอพัก" onKeyPress="return NameCode(branch)" >
                  </div>
                </div>
              </div>
            </div>
            <!--Row 3-->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputname">ชื่อบัญชี </label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" id="inputname" name="name" placeholder="กรอกชื่อบัญชี" onKeyPress="return NameCode(name)">
                  </div>
                </div>
              </div>
            </div>
            <!--Row 4-->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputname">เลขที่บัญชี </label>
                  <div class="input-group">
                    <span class="input-group-addon" style="background-color:#3bafda;border-color:#3bafda;"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="text" class="form-control" maxlength="10" id="inputname" name="number" placeholder="กรอกเลขที่บัญชี" pattern="[1-9]{1}[0-9]{9}" onKeyPress="return isPhoneNo(number)">
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
