<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Sửa Thông Tin"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php 
	isLoggedIn();
	$user 		= fetchUser($_SESSION['user_id']);
	$avt 		= $user['avatar'];
	$fn 		= $user['first_name'];
	$ln 		= $user['last_name'];
	$email 		= $user['email'];
	$website 	= $user['website'];
	$bio		= $user['bio'];
?>
 <?php 
 	//Check form
 	if(isPOST()){
 		$errors = array();
 		$trimmed = array_map("trim",$_POST);
 		if(preg_match('/^[\w]{2,15}$/i', $trimmed['fn'])){
 			$fn = $trimmed['fn'];
 		}else{
 			$errors[] = 'fn';
 		}

 		if(preg_match('/^[\w]{2,15}$/i',$trimmed['ln'])){
 			$ln = $trimmed['ln'];
 		}else{
 			$errors[] = 'ln';
 		}

 		if(isset($trimmed['email']) && filter_var($trimmed['email'],FILTER_VALIDATE_EMAIL)){
 			$email = $trimmed['email'];
 		}else{
 			$errors[] = 'email';
 		}

 		$website = (isset($trimmed['website'])) ? $trimmed['website'] : NULL;
 		$bio 	 = (isset($trimmed['bio'])) ? $trimmed['bio'] : NULL;

 		if(empty($errors)){
 			//Nếu không có lỗi update csdl
 			$q = "UPDATE users SET first_name = ?, last_name = ?, email = ?, website = ?, bio = ? WHERE user_id = ? LIMIT 1";
 			$stmt = mysqli_prepare($dbc,$q);
 			mysqli_stmt_bind_param($stmt, "sssssi", $fn, $ln, $email, $website, $bio, $_SESSION['user_id']);
 			mysqli_stmt_execute($stmt) or die("MySQL Error: $q" . mysqli_stmt_error($stmt));

 			if(mysqli_stmt_affected_rows($stmt) > 0){
 				$mess = "<font color='green'>Update thành công.</font>";
 			}else{
 				$mess = "<font color='red'>Không thể update do lỗi hệ thống.</font>";
 			}
 		}
 	}
?>
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2>User Profile</h2>
                                <a href="contact.html"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <form method="POST" name="Đăng Ký" action="xuly/avatar.php" enctype="multipart/form-data">
                                    <fieldset>
                                    	<legend>Avatar</legend>
                                    	<div>
                                    		<img <?php if(isset($avt)) {echo "src='".BASE_URL."/uploads/images/{$avt}'";} else {echo "src='images/avatar.png'";} ?> alt="avatar" class = "avatar" width="100" height="100" />
                                    		<p>
                                    			Vui lòng chọn một ảnh JPEG hoặc PNG để sử dụng làm avatar.
                                    		</p>
                                    		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                                    		<input type="file" name="avt">
                                    		<p><input type="submit" name="submit" value="Thay Avatar"></p>
                                    	</div>
                                    </fieldset>
                                </form>
                                <form method="post">
                                	<fieldset>
                                		<span><?php if (isset($mess)) {
                                			echo $mess;
                                		} ?></span>
                                		<legend>User Info</legend>
                                		<div>
                                			<label>First Name: </label>
                                			<input type="text" name="fn" <?php if(isset($fn)) echo "value='".$fn."'"; ?>>
                                			<span><?php if(isset($errors) && in_array("fn",$errors)) echo "Vui lòng nhập Firt Name"; ?></span>
                                		</div>
                                		<div>
                                			<label>Last Name: </label>
                                			<input type="text" name="ln" <?php if(isset($ln)) echo "value='".$ln."'"; ?>>
                                			<span><?php if(isset($errors) && in_array("ln",$errors)) echo "Vui lòng nhập Last Name"; ?></span>
                                		</div>
                                	</fieldset>
                                	<fieldset>
                                		<legend>Contact Info</legend>
                                		<div>
                                			<label>Email: </label>
                                			<input type="text" name="email" <?php if(isset($email)) echo "value='".$email."'"; ?>>
                                			<span><?php if(isset($errors) && in_array("website",$errors)) echo "Vui lòng nhập Website"; ?></span>
                                		</div>
                                		<div>
                                			<label>Website: </label>
                                			<input type="text" name="website" <?php if(isset($website)) echo "value='".$website."'"; ?>>
                                		</div>
                                	</fieldset>
                                	<fieldset>
                                		<legend>About Yourself</legend>
                                		<div>
                                			<textarea name="bio" cols="50" rows="20"><?php if(isset($bio)) echo $bio; ?></textarea>
                                		</div>
                                	</fieldset>
                                	<div>
                                		<input type="submit" name="submit" value="Save Changes">
                                	</div>
                                </form>
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>