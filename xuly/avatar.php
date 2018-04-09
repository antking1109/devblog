<?php session_start(); ?>
<?php include '../inc/connect.php'; ?>
<?php include '../inc/func.php'; ?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_FILES['avt'])){
			//Tạo một array trống cho errors
			$errors = array();

			//Tạo một array, để kiểm tra xem file upload có thuộc dạng cho phép
			$allowed = array('image/jpeg', 'image/jpg', 'image/png', 'image/x-png');
			//Kiểm tra xem file upload có nằm trong định dangnj cho phép
			if(in_array(strtolower($_FILES['avt']['type']), $allowed)){
				//Nếu có trong đinh dạng cho phép
				$explode = explode('.', $_FILES['avt']['name']);
				$ext = end($explode);
				$renamed = uniqid(rand(),true).'.'.$ext;
				if(!move_uploaded_file($_FILES['avt']['tmp_name'], "../uploads/images/".$renamed)){
					$errors[] = "<p><font color='red'>Sever problem</font></p>";
				}
			}else{
				//File update khong thuoc dinh dang
				$errors[] = "<p><font color='red'>File không thuộc định dạng cho phép vui lòng nhập lại.</font></p>";
			}
		}//END isset $_FILES

		//Check for an error
		if($_FILES['avt']['error'] >0){
			$errors[] = "<p><font color='red>The file could not be uploaded because: <strong></font></p>";
			//Print the message based on the error
			switch ($_FILES['avt']['error']) {
				case 1:
					# code...
					$errors[].= "The file exeeds the upload_max_filesize setting in php.ini";
					break;
				case 2:
					$errors[].= "The file exeeds the MAX_FILE_SIZE in HTML form";
					break;
				case 3:
					$errors[].= "The was partially uploaded";
					break;
				case 4:
					$errors[].= "No file was uploaded";
					break;
				case 6:
					$errors[].= "No temporary folder was available";
					break;
				case 7:
					$errors[].= "Unable to write to the disk";
					break;
				case 8:
					$errors[].= "File upload stopped";
					break;
				default:
					# code...
					$errors[].= "a system error has occured.";
					break;
			}

			//Xóa file đã được upload và tồn tại trong thư mục tạm
			if(isset($_FILES['avt']['tmp_name']) && is_file($_FILES['avt']['tmp_name']) && file_exists($_FILES['avt']['tmp_name'])){
				unlink($_FILES['avt']['tmp_name']);
			}
		}
	}//END main if
	if(empty($errors)){
		$q = "UPDATE users SET avatar = '{$renamed}' WHERE user_id = {$_SESSION['user_id']} LIMIT 1";
		$r = mysqli_query($dbc, $q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc)>0){
			chuyenhuong('../edit_profile.php');
		}
	}
	foreach ($errors as $error) {
		# code...
		echo $error;
	}
?>