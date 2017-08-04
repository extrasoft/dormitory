<?php
@session_start();

if(!isset($_SESSION['username']))
header("location:../login.php");

$_SESSION['dormSelect'] = $_GET['dormID'];
$_SESSION['roomSelect'] = $_GET['roomID'];

header("location:roomDetail.php");
?>
