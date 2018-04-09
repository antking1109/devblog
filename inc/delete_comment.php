<?php include '../inc/connect.php'; ?>
<?php include '../inc/func.php'; ?>
<?php
	if(isset($_GET['cmt_id'],$_GET['pid'],$_GET['pname']) && filter_var($_GET['cmt_id'],FILTER_VALIDATE_INT,array('min_range' =>1))){
		$q = "DELETE FROM comments WHERE comment_id={$_GET['cmt_id']}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc)==1){
			chuyenhuong("../single.php?pid={$_GET['pid']}&pname={$_GET['pname']}");
		}
	}
 ?>