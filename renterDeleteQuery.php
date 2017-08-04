<?php
    require_once('include/connect.php');
    $rent_id = $_POST['id'];
    $query = "DELETE FROM renter WHERE rent_id = '$rent_id'";
    $result = mysqli_query($conn,$query);
    if($result){
      header("location:renter.php");
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=renter.php\" />";
    }
    mysqli_close($conn);
?>
