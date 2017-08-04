<?php
@session_start();
require_once('include/connect.php');

$dormID = $_SESSION['dormitory'];
$roomID = $_POST['roomID'];
$water = $_POST['water'];
$elec = $_POST['elec'];
$month = $_POST['month'];
$billsNote = date("Y-m-d");
$billStatus = 'ยังไม่ได้ชำระเงิน';
$count = count($_POST['roomID']);

for ($i=0; $i < $count; $i++) {
  $queryMeter = "SELECT * FROM bills WHERE bill_month = '$month' AND room_id = '$roomID[$i]'";
  $resultMeter = mysqli_query($conn,$queryMeter);
  $rowMeter = mysqli_fetch_array($resultMeter);
  if($rowMeter['room_id'] != $roomID[$i]){
    if($water[$i]!="" && $elec[$i]!=""){
      $query = "INSERT INTO bills values (0,
      '$month',
      '$water[$i]',
      '$elec[$i]',
      '$billsNote',
      NULL,NULL,NULL,NULL,NULL,
      '$billStatus',
      NULL,
      '$roomID[$i]',
      '$dormID')";
      $result = mysqli_query($conn,$query);
    }
  }else if($rowMeter['room_id'] == $roomID[$i] && ($rowMeter['bill_water'] != $water[$i] || $rowMeter['bill_electric'] != $elec[$i])){
    if($water[$i]!="" && $elec[$i]!=""){
      $query = "UPDATE bills set
      bill_water = '$water[$i]',
      bill_electric = '$elec[$i]',
      bill_note = '$billsNote'
      where bill_id = '$rowMeter[bill_id]'";
      $result = mysqli_query($conn,$query);
    }
  }
}
echo "<script>";
echo "alert(\"บันทึกเลขมิเตอร์เรียบร้อย!\")";
echo "</script>";
echo "<meta http-equiv=\"refresh\" content=\"0;URL=meter.php\" />";

mysqli_close($conn);

?>
