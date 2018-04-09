<?php session_start(); ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php
isLoggedIn();
	if(isPOST()){
		$target_dir = "../uploads/";
		$name = basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = is_file($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File a regular file - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not a regular file.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Xin lỗi file đã tồn tại.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		// && $imageFileType != "gif" ) {
		//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		//     $uploadOk = 0;
		// }
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		    	$q = "INSERT INTO files (name,upload_on,size) VALUES ('{$name}',NOW(),{$_FILES["fileToUpload"]["size"]})";
		    	$r = mysqli_query($dbc,$q);
		    	check_query($r,$q);
		    	if(mysqli_affected_rows($dbc) == 1){
		    		$q2 = "SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1";
		    		$r2 = mysqli_query($dbc,$q2);
		    		check_query($r2,$q2);
		    		list($id) = mysqli_fetch_array($r2);
		    		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. View info file <a href='../file.php?id={$id}'>Here</a>";
		    	}
		        
		    }else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}//END MAIN IF
?>
<form method="POST" enctype="multipart/form-data">
	<fieldset>
		<legend>Upload File</legend>
		<div><input type="file" name="fileToUpload"></div>
		<div><input type="submit" name="submit" value="UPLOAD"></div>
	</fieldset>
</form>