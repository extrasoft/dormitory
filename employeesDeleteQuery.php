<?php
    require_once('include/connect.php');
    $emp_id = $_POST['id'];
    $query = "DELETE FROM employee WHERE emp_id = '$emp_id'";
    $result = mysqli_query($conn,$query);
    if($result){
      header("location:employees.php");
    }else{
      echo "<script>";
      echo "alert(\"mysqli_error($conn)\")";
      echo "</script>";
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=employees.php\" />";
    }
    mysqli_close($conn);
?>
