<?php

  function DateThai($strDate){
    $strDay = date("d",strtotime($strDate));
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth = date("m",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    return "$strDay/$strMonth/$strYear";
  }
?>
<div id="menu2" class="tab-pane fade">
  <!--สัญญาเช่า-->
  <div id="lease">
    <div class="row">
      <div class="col-md-12">
        <h4>ข้อมูลสัญญาเช่า</h4><hr>
        <div class="row">
          <div class="col-md-6">
            <?php
            echo 'วันที่ทำสัญญา : ';
              if($rowRoom['room_lease']!=""){ echo DateThai($rowRoom['room_lease']); }
            echo '<br />';
            echo 'เลขมิเตอร์น้ำประปา(เข้าพัก)  : '.$rowRoom['room_water'].'<br />';
            echo 'เงินประกันห้อง : '.number_format($rowRoom['room_money'],2).'<br />';
            ?>
          </div>
          <div class="col-md-6">
            <?php

            echo 'วันที่สิ้นสุดสัญญา : ';
            if($rowRoom['room_lease_end']!=""){ echo DateThai($rowRoom['room_lease_end']); }
            echo '<br />';
            echo 'เลขมิเตอร์ไฟฟ้า(เข้าพัก)  : '.$rowRoom['room_electric'].'<br />';
            if($rowMode['water_type'] == 2){
              echo 'จำนวนผู้เข้าพัก : '.$rowRoom['room_guest'].'<br />';
            }

            ?>
          </div>
        </div>
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
        <button type="submit" name="button" class="btn btn-primary btn-block" onclick="$('#lease').hide();$('#leaseEdit').show();">
          <i class="glyphicon glyphicon-list-alt"></i> <strong style="font-size:16px">แก้ไขสัญญาเช่า</strong>
        </button>
      </div>
      <div class="col-md-4">
      </div>
    </div>
    <br><br>
  </div>
  <!--แก้ไขสัญญาเช่า-->
  <div id="leaseEdit" style="display: none;">
    <form class="" action="managementEditMenu2Query.php" method="post">

      <div class="row">
        <div class="col-md-12">
          <h4>ข้อมูลสัญญา</h4><hr />
          <div class="input-daterange" id="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputLease">วันที่ทำสัญญา <span style="color:red">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control datepicker" id="inputLease" name="room_lease" value="<?php if($rowRoom['room_lease'] != "") echo DateThai($rowRoom['room_lease']);?>" data-provide="datepicker" data-date-language="th-th" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputLeaseEnd">วันที่สิ้นสุดสัญญา <span style="color:red">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control datepicker" id="inputLeaseEnd" name="room_lease_end" value="<?php if($rowRoom['room_lease_end'] != "") echo DateThai($rowRoom['room_lease_end']);?>" data-provide="datepicker" data-date-language="th-th" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputWater">เลขมิเตอร์น้ำประปา(เข้าพัก) <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-tint"></i></span>
                  <input type="number" class="form-control" id="inputWater" name="room_water" min="1" max="99999" placeholder="กรอกเลขมิเตอร์น้ำประปา(เข้าพัก)" value="<?php echo $rowRoom['room_water'];?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputElectric">เลขมิเตอร์ไฟฟ้า(เข้าพัก) <span style="color:red">*</span></label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-fire"></i></span>
                  <input type="number" class="form-control" id="inputElectric" name="room_electric" min="1" max="99999" placeholder="กรอกเลขมิเตอร์์ไฟฟ้า(เข้าพัก)" value="<?php echo $rowRoom['room_electric'];?>" required>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputMoney">เงินประกันห้อง </label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                  <input type="number" class="form-control" id="inputMoney" name="room_money" min="0.0" step="0.1" placeholder="กรอกเงินประกันห้อง" value="<?php echo $rowRoom['room_money'];?>">
                </div>
              </div>
            </div>
            <?php if($rowMode['water_type'] == 2) {?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputGuest">จำนวนผู้เข้าพัก <span style="color:red">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon" ><i class="glyphicon glyphicon-home"></i></span>
                    <select class="form-control" name="room_guest">
                      <?php for ($i=1; $i <= 10; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if($rowRoom['room_guest']=="$i") {echo "selected=''";} ?>><?php echo $i; ?></option>
                        <?php  } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-2">
              <button type="button" name="button" class="btn btn-danger btn-xs" onclick="$('#leaseEdit').hide();$('#lease').show();">
                <i class="glyphicon glyphicon-plus"></i> ยกเลิก
              </button>
            </div>
            <div class="col-md-5">
            </div>
          </div>
          <hr>
          <div class="pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
            <button type="submit" class="btn btn-primary" name="submit"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
            <input type="hidden" name="room_id" value="<?php echo $rowRoom['room_id']; ?>">
          </div>
        </form>
      </div>
    </div>
