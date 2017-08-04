<?php
@session_start();
$_SESSION['dormitory'] = $_GET['id'];
header('location:management.php');
?>
