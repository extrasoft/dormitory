<div id="menu3" class="tab-pane fade">
  <!--ค่าบริการ-->
  <div id="service">
    <div class="row">
      <div class="col-md-12">
        <h4>ค่าบริการต่างๆ</h4>
        <table class="table">
          <tbody>
            <tr>
              <td width="50%">
                <?php
                echo 'ค่าห้อง : '.$rowRoom['room_price'].'<br />';
                echo 'ค่าที่จอดรถ : '.$rowRoom['room_parking'].'<br />';
                echo 'อุปกรณ์ตกแต่งห้อง : '.$rowRoom['room_accessories'].'<br />';
                ?>
              </td>
              <td width="50%">
                <?php
                echo 'ค่าอินเทอร์เน็ต : '.number_format($rowRoom['room_internet'],2).'<br />';
                echo 'ค่าบริการอื่นๆ : '.number_format($rowRoom['room_others'],2).'<br />';
                ?>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <button type="submit" name="button" class="btn btn-primary btn-block" onclick="$('#service').hide();$('#serviceEdit').show();">
              <i class="glyphicon glyphicon-list-alt"></i> <strong style="font-size:16px">แก้ไขค่าบริการ</strong>
            </button>
          </div>
          <div class="col-md-4">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--แก้ไขค่าบริการ-->
  <div id="serviceEdit" style="display: none;">
    <form class="" action="managementEditMenu3Query.php" method="post">
      <div class="row">
        <div class="col-md-12">
          <h4>ค่าบริการต่างๆ</h4><hr />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPrice">ค่าห้อง <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                  <input type="number" class="form-control" id="inputPrice" name="room_price" placeholder="กรอกค่าห้อง" min="1.0" step="0.1" value="<?php echo $rowRoom['room_price'];?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputInternet">ค่าอินเทอร์เน็ต <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                  <input type="number" class="form-control" id="inputInternet" name="room_internet" placeholder="กรอกค่าอินเทอร์เน็ต" min="0.00" step="0.01" value="<?php echo $rowRoom['room_internet'];?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLeaseEnd">ค่าที่จอดรถ <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                  <input type="number" class="form-control" id="inputParking" name="room_parking" placeholder="กรอกค่าที่จอดรถ" min="0.0" step="0.1" value="<?php echo $rowRoom['room_parking'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputOthers">ค่าบริการอื่นๆ <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                  <input type="number" class="form-control" id="inputOthers" name="room_others" placeholder="กรอกค่าบริการอื่นๆ" min="0.0" step="0.1" value="<?php echo $rowRoom['room_others'];?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-inline" style="font-size:16px;">
                <label for="inputAccessories">อุปกรณ์ตกแต่ง <span style="color:red">*</span></label><br />
                <span>
                  <?php
                  foreach ($arr as $value) {
                    echo '<label class="checkbox-inline">';
                    if(in_array($value,$accs)){
                      echo "<input type='checkbox' name='room_accessories[]' value='$value' checked> $value ";
                    }else{
                      echo "<input type='checkbox' name='room_accessories[]' value='$value'> $value ";
                    }
                    echo '</label>';
                  }
                  ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-md-5">
        </div>
        <div class="col-md-2">
          <button type="button" name="button" class="btn btn-danger btn-xs" onclick="$('#serviceEdit').hide();$('#service').show();">
            <i class="glyphicon glyphicon-plus"></i> ยกเลิก
          </button>
        </div>
        <div class="col-md-5">
        </div>
      </div>
      <hr>
      <div class="pull-right">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
        <button type="submit" class="btn btn-primary" name="submit" onclick="$('#Hello2').show();$('#Hello1').hide();"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
        <input type="hidden" name="room_id" value="<?php echo $rowRoom['room_id']; ?>">
      </div>
    </form>
  </div>
</div>
