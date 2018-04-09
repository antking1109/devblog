<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <?php 
                	isLoggedIn();
                	
                 ?>
                 <form method="post">
                 	<fieldset>
                 		<legend>Option System</legend>
                 		<?php 
                 			if(isPOST()){
                 				$dem = 0;
                 				if(empty($_POST['url'])){
                 					$dem++;
                 				}else{
                 					$_url = $_POST['url'];
                 				}
                 				if(empty($_POST['name'])){
                 					$dem++;
                 				}else{
                 					$_name = $_POST['name'];
                 				}
                 				if(empty($_POST['mota'])){
                 					$dem++;
                 				}else{
                 					$_mt = $_POST['mota'];
                 				}

                 				if($dem!=0){
                 					echo "Vui lòng nhập đủ các trường.";
                 				}else{
                 					$q = "UPDATE options SET option_value='{$_url}' WHERE option_id=1";
                 					$q2 = "UPDATE options SET option_value='{$_name}' WHERE option_id=2";
                 					$q3 = " UPDATE options SET option_value='{$_mt}' WHERE option_id=3";
                 					$r = mysqli_query($dbc,$q);
                 					$r2 = mysqli_query($dbc,$q2);
                 					$r3 = mysqli_query($dbc,$q3);
                 					check_query($r,$q);
                 					check_query($r2,$q2);
                 					check_query($r3,$q3);
                 					if(mysqli_affected_rows($dbc)>0){
                 						echo "Thay đổi thành công.";
                 					}else{
                 						echo "Lỗi.";
                 					}

                 				}
                 			}
                 		?>
                 		<div><label>Site Url</label></div>
                 		<div><input type="text" name="url" <?php 
                 			$url = getValue(1);
                 			if(isset($url)){
                 				echo "value='".$url."'";
                 			}
                 		?>></div>
                 		<div><label>Site Name</label></div>
                 		<div><input type="text" name="name" <?php 
                 			$name = getValue(2);
                 			if(isset($name)){
                 				echo "value='".$name."'";
                 			}
                 		?>></div>
                 		<div><label>Site Description</label></div>
                 		<div><input type="text" name="mota" <?php 
                 			$mt = getValue(3);
                 			if(isset($mt)){
                 				echo "value='".$mt."'";
                 			}
                 		?>></div>
                 		<div><input type="submit" name="submit" value="SAVE"></div>
                 	</fieldset>
                 </form>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>