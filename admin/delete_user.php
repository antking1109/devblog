<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php 
	isLoggedIn();
	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range' => 1))){
		$q = "DELETE FROM users WHERE user_id = {$_GET['id']}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc) == 1){
			chuyenhuong('manage_user.php');
		}else{
			echo "Lỗi";
		}
	}
 ?>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>