<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php
isLoggedIn();
	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range' => 1))){
		//Nếu tồn tại id
		$q = "SELECT first_name,last_name,email,user_level FROM users WHERE user_id = {$_GET['id']}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_affected_rows($dbc) == 1){
			list($fn,$ln,$email,$lv) = mysqli_fetch_array($r);
			if(isPOST()){
				//Nếu được submit
				$errors = array();
				if(preg_match('/^[\w]{2,20}$/i',trim($_POST['fn']))){
					$fn = trim($_POST['fn']);
				}else{
					$errors[] = "fn";
				}
				if(preg_match('/^[\w]{2,20}$/i',trim($_POST['ln']))){
					$ln = trim($_POST['ln']);
				}else{
					$errors[] = "ln";
				}
				if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
					$email = $_POST['email'];
				}else{
					$errors[] = "email";
				}
				if (isset($_POST['lv']) && filter_var($_POST['lv'],FILTER_VALIDATE_INT,array('min_range' => 1))) {
					$lv = $_POST['lv'];
				}else{
					$errors[] = "lv";
				}

				if(empty($errors)){
					$q = "UPDATE users SET first_name = '{$fn}', last_name='{$ln}', email = '{$email}', user_level = $lv WHERE user_id = {$_GET['id']} LIMIT 1";
					$r = mysqli_query($dbc,$q);
					check_query($r,$q);
					if(mysqli_affected_rows($dbc) == 1){
						$mess = "Lưu thành công.";
					}else{
						$mess = "Không thể thay đổi do lỗi hệ thống.";
					}
				}
			}

		}else{
			$mess = "Không tồn tại user";
		}
	}else{
		chuyenhuong('manage_user.php');
	}//END MAIN IF
?>
<div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
                	<div class="col-md-12">
						<form method="POST">
							<fieldset>
								<legend>Edit User</legend>
								<?php if(isset($mess)) echo $mess; ?>
								<div><label>First Name: <?php if(isset($errors) && in_array('fn',$errors)) echo "Vui lòng nhập first name" ?></label></div>
								<div><input type="text" name="fn" <?php if(isset($fn)) echo "value='".$fn."'"; ?>></div>
								<div><label>Last Name: <?php if(isset($errors) && in_array('ln',$errors)) echo "Vui lòng nhập last name" ?></label></div>
								<div><input type="text" name="ln" <?php if(isset($ln)) echo "value='".$ln."'"; ?>></div>
								<div><label>Email: <?php if(isset($errors) && in_array('email',$errors)) echo "Vui lòng nhập email" ?></label></div>
								<div><input type="text" name="email" <?php if(isset($email)) echo "value='".$email."'"; ?>></div>
								<div><label>Level: <?php if(isset($errors) && in_array('lv',$errors)) echo "Vui lòng chọn" ?></label></div>
								<div>
									<select name="lv">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
									</select>
								</div>
								<div><input type="submit" name="submit" value="Save"></div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
</div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>