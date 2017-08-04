<?php
    require_once('include/connect.php');
    $repd_id = $_POST['id'];
    $query = "DELETE FROM repair_detail WHERE repd_id = '$repd_id'";
    $result = mysqli_query($conn,$query);
    if($result){
      header("location:repairDetail.php");
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=repairDetail.php\" />";
    }
    mysqli_close($conn);
?>
