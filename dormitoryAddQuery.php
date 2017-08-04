<?php
@session_start();
require_once('include/connect.php');

  $dom_name = $_POST['name'];
  $dom_address = $_POST['address'];
  $dom_tel = $_POST['tel'];
  $dom_email = $_POST['email'];
  $water = $_POST['water'];
  $electric = $_POST['electric'];
  $dom_class = count($_POST["c"]);
  $dom_room = implode(",",$_POST["c"]);
  $mem_id=$_SESSION['id'];
  $query = "insert into dormitory values(0,
  '$dom_name',
  '$dom_address',
  '$dom_tel',
  '$dom_email',
  '$dom_class',
  '$dom_room',
  '$water',
  '$electric',
  '$mem_id')";
  $result = mysqli_query($conn,$query);
  if($result){
    $id = mysqli_insert_id($conn);
    $nameClass = 1;
    $nameRoomStart = 101;
    for($r=0;$r<$dom_class;$r++)
    {
      $nameRoom = $nameRoomStart;
    	for ($c=0; $c < $_POST["c"][$r]; $c++) {
        $query2 = "insert into room values(0,
        '$nameClass',
        '$nameRoom',
        0,0,0,0,0,'',0,
        'ห้องว่าง',
        '',
        '',0,0,0,
        '',
        '$id',0,0)";

        $result2 = mysqli_query($conn,$query2);
        $nameRoom++;
    	}
      $nameClass += 1;
      $nameRoomStart += 100;
    }
    $_SESSION['dormitory'] = $id;
    $_SESSION['dormClass'] = $dom_class;

    echo "<script>";
    echo "alert(\"เพิ่มตึกใหม่เรียบร้อย\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=roomRename.php\" />";

  }else{
    echo "<script>";
    echo "alert(\"mysqli_error($conn)\")";
    echo "</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=dormitoryAdd.php\" />";
  }
  mysqli_close($conn);
?>
