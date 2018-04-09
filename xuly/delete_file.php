<?php session_start(); ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php 
	if (isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range' => 1))) {
		$id = $_GET['id'];
		$q1 = "SELECT name FROM files WHERE file_id = $id";
		$r1 = mysqli_query($dbc,$q1);
		check_query($r1,$q1);
		list($name) = mysqli_fetch_array($r1);
		$path = $_SERVER['DOCUMENT_ROOT']."/uploads/".$name;


		$q = "DELETE FROM files WHERE file_id = $id";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc) == 1){
			unlink($path);
			chuyenhuong('../admin/view_files.php');
		}
	}
?>