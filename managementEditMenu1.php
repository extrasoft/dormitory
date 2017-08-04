
<div id="menu1" class="tab-pane fade in active">
  <!--มีผู้เช่าแล้ว-->
  <div id="rentYes">
    <?php if($rowRoom['room_status']=="ห้องมีผู้เช่า" && $rowRoom['rent_id'] != 0 ) { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="12%">
                <img src="images/img-member/0.png" alt="profile" class="img-rounded" width="100px" height="100px">
              </td>
              <td>
                ชื่อ-นามสกุล : <?php echo $rowRenter['rent_firstname'].' '.$rowRenter['rent_lastname'];?><br />
                ที่อยู่ : <?php echo $rowRenter['rent_address'];?><br />
                อีเมล์ : <?php echo $rowRenter['rent_email'];?><br />
                เบอร์โทร : <?php echo $rowRenter['rent_tel'];?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="pull-right">
        <a class="btn btn-danger" href="managementEditMenu1Query.php?id=<?php echo $rowRoom['room_id'];?>&state=cancel"
          onclick="return confirm('<?php echo 'วันที่หมดสัญญาเช่า : '.$rowRoom['room_lease_end'].' \\nยืนยันการยกเลิกผู้เช่า'?>')">
          <i class="glyphicon glyphicon-remove"></i> <strong>ยกเลิกผู้เช่า</strong>
        </a>
      </p>
    <?php } else if($rowRoom['room_status']=="กำลังตรวจสอบ" || ($rowRoom['room_status']=="ห้องมีผู้เช่า" && $rowRoom['mem_id'] != 0 )) { ?>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tbody>
              <?php if($rowRoom['room_status']=="กำลังตรวจสอบ") {?>
                <tr>
                  <td colspan="2"><span style="font-size:16;"><b>ร้องขอการเชื่อมต่อห้องพัก</b></span></td>
                </tr>
              <?php } ?>
                <tr>
                  <td width="12%">
                    <img src="images/img-member/<?php echo $rowMember['mem_img'];?>" alt="profile" class="img-rounded" width="100px" height="100px">
                  </td>
                  <td>
                    ชื่อ-นามสกุล : <?php echo $rowMember['mem_firstname'].' '.$rowMember['mem_lastname'];?><br />
                    ที่อยู่ : <?php echo $rowMember['mem_address'];?><br />
                    อีเมล์ : <?php echo $rowMember['mem_email'];?><br />
                    เบอร์โทร : <?php echo $rowMember['mem_tel'];?>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
          <?php if($rowRoom['room_status']=="กำลังตรวจสอบ") { ?>
            <p class="pull-right">
              <a class="btn btn-danger" href="managementEditMenu1Query.php?state=cancel&id=<?php echo $rowRoom['room_id'];?>">
                <i class="glyphicon glyphicon-remove"></i> <strong>ปฏิเสธ</strong>
              </a>
              <a class="btn btn-primary" href="managementEditMenu1Query.php?state=approve&id=<?php echo $rowRoom['room_id'];?>">
                <i class="glyphicon glyphicon-ok"></i> <strong>อนุมัติ</strong>
              </a>
            </p>
          <?php }else{?>
            <p class="pull-right">

              <a class="btn btn-danger" href="managementEditMenu1Query.php?state=cancel&id=<?php echo $rowRoom['room_id'];?>"
                onclick="return confirm('<?php echo 'วันที่หมดสัญญาเช่า : '.$rowRoom['room_lease_end'].' \\nยืนยันการยกเลิกผู้เช่า'?>')">
                <i class="glyphicon glyphicon-remove"></i> <strong>ยกเลิกผู้เช่า</strong>
              </a>
            </p>
          <?php } ?>
    <?php }else{ ?>
            <br><br>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <button type="submit" name="button" class="btn btn-primary btn-block" onclick="$('#rentYes').hide();$('#rentNo').show();">
                      <i class="glyphicon glyphicon-plus"></i> <strong style="font-size:16px">เพิ่มผู้เช่า</strong>
                    </button>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
            <br><br>
    <?php } ?>
  </div>
              <!--ยังไม่มีผู้เช่า-->
              <div id="rentNo" style="display: none;">
                <form class="" action="managementEditMenu1Query.php?state=add&id=<?php echo $rowRoom['room_id'];?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="inputAddress">ผู้เช่า <span style="color:red">*</span></label>
                        <div class="input-group">
                          <span class="input-group-addon" >
                            <i class="glyphicon glyphicon-user"></i>
                          </span>

                          <select class="form-control" name="rentID">
                            <?php while($rowRoomEmpty = mysqli_fetch_array($resultRoomEmpty)){ ?>
                              <option value="<?php echo $rowRoomEmpty['rent_id'];?>">
                                <?php echo $rowRoomEmpty['rent_firstname'].' '.$rowRoomEmpty['rent_lastname'].' '.$rowRoomEmpty['rent_tel']; ?>
                              </option>
                            <?php } ?>
                            </select>
                            <input type="hidden" name="room_id" value="<?php echo $row[0];?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col-md-5">
                      </div>
                      <div class="col-md-2">
                          <button type="button" name="button" class="btn btn-danger btn-xs" onclick="$('#rentNo').hide();$('#rentYes').show();">
                            <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
                          </button>
                      </div>
                      <div class="col-md-5">
                      </div>
                    </div>
                    <hr>
                    <div class="pull-right">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิด</button>
                      <button type="submit" class="btn btn-primary" name="submit" onclick="$('#Hello2').show();$('#Hello1').hide();"><i class="glyphicon glyphicon-ok"></i> บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
<script type="text/javascript">
function myFunction() {
    confirm("Press a button!");
}
</script>
