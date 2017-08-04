<?php
session_start();
require_once('include/connect.php');
$id = $_GET['aid'];
//ส่วนของห้องนั้น
$queryRoom="select * from room where room_id = '$id'";
$resultRoom = mysqli_query($conn,$queryRoom);
$rowRoom = mysqli_fetch_array($resultRoom);
$accs = explode(",",$rowRoom['room_accessories']);
$imgs = explode(",",$rowRoom['room_img']);
$countImg = count($imgs);
$arr = array();

//ส่วนของ menu1 อนุมัติหรือยกเลิกผู้เช่าหรือเพิ่มผู้เช่า
if($rowRoom['mem_id'] != 0){
  $queryMember = "SELECT * FROM member WHERE mem_id ='$rowRoom[mem_id]'";
  $resultMember = mysqli_query($conn,$queryMember);
  $rowMember = mysqli_fetch_array($resultMember);
}else if($rowRoom['rent_id'] != 0){
  $queryRenter = "SELECT * FROM renter WHERE rent_id ='$rowRoom[rent_id]'";
  $resultRenter = mysqli_query($conn,$queryRenter);
  $rowRenter = mysqli_fetch_array($resultRenter);
}else if($rowRoom['room_status'] == 'ห้องว่าง'){
  $queryRoomEmpty = "SELECT * FROM renter WHERE mem_id='$_SESSION[id]'";
  $resultRoomEmpty = mysqli_query($conn,$queryRoomEmpty);
}

//ส่วนของ menu2 หมวดหมู่การคิดค่าน้ำ
$queryMode = "SELECT * FROM water_tariffs WHERE dorm_id ='$_SESSION[dormitory]'";
$resultMode = mysqli_query($conn,$queryMode);
$rowMode = mysqli_fetch_array($resultMode);


$queryAccs = "SELECT * FROM accessories WHERE dorm_id ='$_SESSION[dormitory]'";
$resultAccs = mysqli_query($conn,$queryAccs);
while($rowAccs = mysqli_fetch_array($resultAccs)){
  array_push($arr,$rowAccs['accs_name']);
}

?>


<div class="panel panel-primary">
  <div class="panel-heading">
    <div class="panel-title" style="font-size:20px;">
      <strong>ห้อง <?php echo $rowRoom['room_name'];?></strong>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  </div>
  <div class="panel-body">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#menu1">ข้อมูลผู้เช่า</a></li>
      <li><a data-toggle="tab" href="#menu2">สัญญาเช่า</a></li>
      <li><a data-toggle="tab" href="#menu3">ค่าบริการต่างๆ</a></li>
      <li><a data-toggle="tab" href="#menu4">รูปภาพก่อนอยู่</a></li>
    </ul>

    <div class="tab-content">

      <?php
        require_once('managementEditMenu1.php');
        require_once('managementEditMenu2.php');
        require_once('managementEditMenu3.php');
        require_once('managementEditMenu4.php');
      ?>

    </div>
  </div>

</div><!-- End Panel panel-body-->
</div><!-- End Panel panel-primary-->
<script type="text/javascript" >
$('.dmonth').datepicker({
  format: "mm/yyyy",
  language: "th",
  endDate: "+Infinity",
  startView: 1,
  minViewMode: 1,
  maxViewMode: 2

});

$('.datepicker').datepicker({
  format: "dd/mm/yyyy",
  //startDate: "-Infinity",
  //endDate: "+Infinity",
  language: "th",
  todayBtn: "linked",
  autoclose: true,
  todayHighlight: true
});


<?php if($rowRoom['room_lease'] == "") {?>
  $("#inputLease").datepicker("setDate", new Date());
<?php } ?>
<?php if($rowRoom['room_lease_end'] == "") {?>
$("#inputLeaseEnd").datepicker("setDate", new Date(new Date().setFullYear(new Date().getFullYear() + 1)));
<?php } ?>

$('.input-daterange').datepicker({
  format: "mm/yyyy",
  startView: 1,
  minViewMode: 1,
  maxViewMode: 2,
  language: "th",
  todayBtn: "linked",
  autoclose: true,
  todayHighlight: true
});


</script>
