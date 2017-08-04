
<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title" style="font-size:20px;">
      <strong>เพิ่มข้อมูลพนักงาน</strong>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" name="formAdd" action="employeesAddQuery.php" enctype="multipart/form-data"
    method="post" onSubmit="JavaScript:return fncSubmit('formAdd');">
    <!--Row 1-->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputFirstname" class="col-sm-3 control-label">ชื่อจริง : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-king"></i></span>
              <input type="text" class="form-control" id="inputFirstname" name="fname" placeholder="ชื่อจริง" onKeyPress="return NameCode(fname)">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputLastname" class="col-sm-3 control-label">นามสกุล : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-queen"></i></span>
              <input type="text" class="form-control" id="inputLastname" name="lname" placeholder="นามสกุล" onKeyPress="return NameCode(lname)">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Row 2-->
    <div class="row">
      <div class="col-md-9">
        <div class="form-group">
          <label for="inputAddress" class="col-sm-2 control-label">ที่อยู่ : </label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
              <textarea class="form-control" rows="4" id="inputAddress" name="addr" placeholder="ที่อยู่ปัจจุบัน"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Row 3-->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputEmail" class="col-sm-3 control-label">อีเมล์ : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="example@email.com">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputTelephone" class="col-sm-3 control-label">เบอร์โทร : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
              <input type="tel" class="form-control" id="InputTel" name="tel" placeholder="08xxxxxxxx , 09xxxxxxxx" maxlength="10"
              pattern="^0[8-9][0-9]{8}$" onKeyPress="return isPhoneNo(tel)" >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Row 4-->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputPosition" class="col-sm-3 control-label">ตำแหน่ง : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-king"></i></span>
              <input type="text" class="form-control" id="inputPosition" name="position" placeholder="ตำแหน่ง" onKeyPress="return NameCode(position)">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputSalary" class="col-sm-3 control-label">เงินเดือน : </label>
          <div class="col-sm-9">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-bitcoin"></i></span>
              <input type="number" class="form-control" id="inputSalary" name="salary" min="0"  placeholder="เงินเดือน">
            </div>
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
</div><!-- End Modal Dialog -->
</div><!-- End Modal -->
<script type="text/javascript">
function KeyCode(objId)
  {
    if (event.keyCode >= 48 && event.keyCode<=57 || event.keyCode >= 65 && event.keyCode<=90 || event.keyCode>=97 && event.keyCode<=122) //48-57(ตัวเลข) ,65-90(Eng ตัวพิมพ์ใหญ่ ) ,97-122(Eng ตัวพิมพ์เล็ก) ,161-206(Th ตัวอักษรไทย)
    {
      return true;
    }
    else
    {
      alert("กรอกได้เฉพาะตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น [A-Z],[a-z],[0-9]");
      return false;
    }
  }

  function NameCode(objId)
  {
    if ((event.keyCode >= 48 && event.keyCode<=57)) //48-57(ตัวเลข) ,65-90(Eng ตัวพิมพ์ใหญ่ ) ,97-122(Eng ตัวพิมพ์เล็ก) ,161-206(Th ตัวอักษรไทย)
    {
      alert("กรอกได้เฉพาะตัวอักษรภาษาไทยหรือภาษาอังกฤษเท่านั้น [A-Z],[a-z],[ก-ฮ]");
      return false;
    }
    else
    {
      return true;
    }
  }

  function isPhoneNo(input){
    if ((event.keyCode >= 48 && event.keyCode<=57))
    {
      return true;
    }
    else
    {
      alert("กรอกเบอร์โทรศัพท์ได้เฉพาะตัวเลขเท่านั้น [0-9]");
      return false;
    }
  }
</script>
