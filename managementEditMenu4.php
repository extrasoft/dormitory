<div id="menu4" class="tab-pane fade">
  <!--รูปก่อนอยู่-->
  <div id="img">
    <div class="row">
      <div class="col-md-12">
        <?php if(!empty($rowRoom['room_img'])) { ?>
          <div class="jumbotron">
            <div id="mycarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                for ($i=0; $i < $countImg; $i++) {
                  echo "<li data-target='#mycarousel' data-slide-to='$i' class='active'></li>";
                }
                ?>
              </ol>
              <div class="carousel-inner slider-size">
                <?php
                for ($i=0; $i < $countImg; $i++) {
                  if($i==0)
                  {
                    echo "<div class='item active'><img src='images/img-room/$imgs[$i]' class=\"img-responsive\" width=\"100%\"/></div>";
                  }else {
                    echo "<div class='item'><img src='images/img-room/$imgs[$i]' class=\"img-responsive\" width=\"100%\"/></div>";
                  }
                }
                ?>
              </div>
              <!--ลูกศร ซ้าย-ขวา -->
              <a class="left carousel-control" href="#mycarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#mycarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>
          </div>
          <?php } ?>
          <br /><br />
          <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <button type="submit" name="button" class="btn btn-primary btn-block" onclick="$('#img').hide();$('#imgAdd').show();">
                <i class="glyphicon glyphicon-list-alt"></i> <strong style="font-size:16px">เพิ่มรูปภาพก่อนอยู่</strong>
              </button>
            </div>
            <div class="col-md-4">
            </div>
          </div>
          <br /><br />
        </div>
      </div>
    </div>
    <!--รูปก่อนอยู่ Edit-->
    <div id="imgAdd" style="display: none;">
      <form class="" action="managementEditMenu4Query.php" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-md-12">
            <h5>เพิ่มรูปภาพก่อนอยู่</h5><hr />
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="InputImage">
                อัพโหลดรูปภาพประกอบ :
                <button id="clear" class="btn btn-default btn-xs" type="button">
                  เคลียร์รูป
                </button>
              </label>
              <input type="file" id="InputImage" name="img[]" multiple="multiple" class="input01" accept="images/*" capture>
            </div>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-5">
          </div>
          <div class="col-md-2">
            <button type="button" name="button" class="btn btn-danger btn-xs" onclick="$('#imgAdd').hide();$('#img').show();">
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
  <script type="text/javascript" >
    $('.input01').filestyle({
      'placeholder' : 'รูปภาพประกอบ',
      buttonText : 'เลือกรูป',
      buttonName : 'btn-danger'
    });
    $('#clear').click(function() {
      $('.input01').filestyle('clear');
    });
  </script>
