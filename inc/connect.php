<?php 
	$sever = "localhost";
	$username = "congdyxd_devblog";
	$pass = "11091997";
	$dbname = "congdyxd_devblog";

	$dbc = mysqli_connect($sever, $username, $pass, $dbname);
	if(!$dbc){
		die("Lỗi kết nối db: " . mysqli_connect_errno($dbc));
	}
 ?>