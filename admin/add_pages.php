<?php include '../admin/include/header.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php 
	isLoggedIn();
	$uid = $_SESSION['user_id'];
?>
<?php 
	if(isPOST()){
		$errors = array();
		if(empty(trim($_POST['name']))){
			$errors[] = "name";
		}else{
			$name = trim($_POST['name']);
		}
		if(empty($_POST['category']) && filter_var($_POST['category'],FILTER_VALIDATE_INT,array('min_range' => 1))){
			$errors[] = "category";
		}else{
			$cat_id = $_POST['category'];
		}
		if(empty($_POST['position']) && filter_var($_POST['position'],FILTER_VALIDATE_INT,array('min_range' => 1))){
			$errors[] = "position";
		}else{
			$position = $_POST['position'];
		}
		if(empty($_POST['nd'])){
			$errors[] = "nd";
		}else{
			$content = $_POST['nd'];
		}
		if(empty($errors)){
			$qI = "INSERT INTO pages (user_id,cat_id,page_name,content,position,post_on) VALUES ({$uid},{$cat_id},'{$name}','{$content}',{$position},NOW())";
			$rI = mysqli_query($dbc,$qI);
			check_query($rI,$qI);
			if(mysqli_affected_rows($dbc) == 1){
				$mess = "Thêm bài viết thành công.";
			}else{
				$mess = "Không thể thêm bài viết do lỗi hệ thống.";
			}
		}else{
			$mess = "Vui lòng nhập đủ các trường";
		}
	}
?>
	<div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
		            <div class="col-md-12">
						<form name="thembv" method="post">
							<fieldset>
								<legend>Thêm bài viết</legend>
								<div><label>Tên bài viết</label></div>
								<div><input type="text" name="name"></div>
								<div><label>Chuyên Mục</label></div>
								<div>
									<select name="category">
										<?php 
											$q = "SELECT cat_id,cat_name FROM categories";
											$r = mysqli_query($dbc,$q);
											check_query($r,$q);
											if(mysqli_affected_rows($dbc) >0){
												while ($cat =mysqli_fetch_array($r)) {
													echo "<option value='{$cat['cat_id']}'>".$cat['cat_name']."</option>";
												}
											}else{
												echo "<option></option>";
											}
										 ?>
									</select>
								</div>
								<div><label>Position</label></div>
								<div>
									<select name="position">
										<?php 
											$qP = "SELECT COUNT(page_id) FROM pages";
											$rP = mysqli_query($dbc,$qP);
											check_query($rP,$qP);
											if(mysqli_affected_rows($dbc) > 0){
												list($num) = mysqli_fetch_array($rP);
												for($i=1;$i<=$num+1;$i++){
													echo "<option value='{$i}'>".$i."</option>";
												}
											}
										?>
									</select>
								</div>
								<div><label>Nội dung</label></div>
								<textarea name="nd" cols="150" rows="20"></textarea>
								<input type="submit" name="submit" value="Thêm bài viết">
							</fieldset>
						</form>
		            </div>
		          </div>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>