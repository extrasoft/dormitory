<?php
   $serverName = "localhost";
   $userName = "root";
   $userPassword = "root";
   $dbName = "dormitory";
	 $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
	}
  mysqli_set_charset($conn,"utf8");
  date_default_timezone_set('Asia/Bangkok');
?>
