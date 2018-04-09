<?php session_start(); ?>
<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php 
	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range' => 1))){
		$q = "SELECT * FROM files WHERE file_id={$_GET['id']}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc) ==1){
			list($id,$name,$time,$size) = mysqli_fetch_array($r);
			$path = "/uploads/".$name;
			$url = BASE_URL."/uploads/".$name;
		}else{
			chuyenhuong('index.php');
		}
	}else{
		chuyenhuong('index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Info File</title>
</head>
<body>
	<table>
		<label>Thông Tin Tệp Tin</label>
		<hr>
		<tr>
			<td>Name: </td>
			<td><?php echo $name; ?></td>
		</tr>
		<tr>
			<td>Upload On: </td>
			<td><?php echo $time; ?></td>
		</tr>
		<tr>
			<td>Size: </td>
			<td><?php echo $size; ?></td>
		</tr>
		<tr>
			<td>URL: </td>
			<td><textarea cols="100"><?php echo $url; ?></textarea></td>
		</tr>
		<?php 
			if(isAdmin()){
				echo "<tr>";
				echo "<td><a href='../xuly/delete_file.php?id=$id'><font color='red'>DELETE</font></a></td><td><a href='../admin/'>ADMIN CP</a></td>";
				echo "</tr>";
			}
		 ?>
	</table>
	<br>
	<hr>
	<br>
	<br>
	<br>
	<form method="post">
		<fieldset>

		    <script>
		        function tai_lai_trang(){
		            location.reload();
		        }
		    </script>
			<legend>Đổi Tên File</legend>
			<?php 
				if(isAdmin()){
if(isPOST()){
					$newname = $_POST['newname'];
					$qc = "SELECT * FROM files WHERE name='{$newname}'";
					$rc = mysqli_query($dbc,$qc);
					check_query($rc,$qc);
					if(mysqli_num_rows($rc) >0){
						//nếu tồn tại file
						echo "File đã tồn tại vui lòng chọn tên khác.";
					}else{
						$newpath = "/uploads/".$newname;
						rename($_SERVER['DOCUMENT_ROOT'].$path,$_SERVER['DOCUMENT_ROOT'].$newpath);
						$q2 = "UPDATE files SET name='{$newname}' WHERE file_id=$id";
						$r2 = mysqli_query($dbc,$q2);
						check_query($r2,$q2);
						if(mysqli_affected_rows($dbc) == 1){
							echo "Thay đổi tên thành công. <a href='file.php?id=$id'>Tải lại trang để cập nhật thông tin mới.</a>";
						}else{
							echo "Lỗi không thể đổi tên.";
						}
					}
				}}else{echo "Bạn không có quyền.";}
			?>
			<div>Tên mới: </div>
			<div><input type="text" name="newname"></div>
			<div><input type="submit" name="submit" value="ĐỔI TÊN"></div>
		</fieldset>
		
	</form>
</body>
</html>