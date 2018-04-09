<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php 
isLoggedIn();
	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1))){

		$id = $_GET['id'];
		$q_lay = "SELECT cat_name,position FROM categories WHERE cat_id={$id}";
		$r_lay = mysqli_query($dbc,$q_lay);
		check_query($r_lay,$q_lay);
		if($lay = mysqli_fetch_array($r_lay)){
			$lay_name = $lay['cat_name'];

			$lay_pos = $lay['position'];
		}
	}else{
		chuyenhuong('view_categories.php');
	}
		if($_SERVER['REQUEST_METHOD'] == 'POST'){ //Gía trị tồn tại xử lý form

			$error = array();
			if(empty($_POST['name'])){
				$error[] = "name";
				
			}else
			{
				
				$name = mysqli_real_escape_string($dbc,strip_tags($_POST['name']));
				//mysqli_real_escape_string để bỏ các ký tự đặc biệt
				//strip_tags để loại bỏ các thẻ html khỏi chuỗi
			}
			if(isset($_POST['position']) && filter_var($_POST['position'],FILTER_VALIDATE_INT,array('min_range' => 1))){
				$pos = $_POST['position'];
			}else{
				$error[] = "position";
			}
			if(empty($error)){
				$q = "UPDATE categories SET cat_name = '{$name}', position = {$pos}, user_id = 1 WHERE cat_id = {$id}";
				$r = mysqli_query($dbc,$q);
				check_query($r,$q);
				if(mysqli_affected_rows($dbc) == 1){
					$mess = "<div role='alert' class='alert alert-success alert-icon alert-dismissible'>
	                    <div class='icon'><span class='mdi mdi-check'></span></div>
	                    <div class='message'>
	                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Sửa chuyên mục thành công.
	                    </div>
	                  </div>";
				}else{
					$mess = "<div role='alert' class='alert alert-warning alert-icon alert-dismissible'>
	                    <div class='icon'<span class='mdi mdi-alert-triangle'></span></div>
	                    <div class='message'>
	                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Không thể sửa chuyên mục vô csdl do lỗi
	                    </div>
	                  </div>";
				}

			}else{
				$mess = "<div role='alert' class='alert alert-warning alert-icon alert-dismissible'>
	                    <div class='icon'<span class='mdi mdi-alert-triangle'></span></div>
	                    <div class='message'>
	                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Vui lòng điền đầy đủ các thông tin.
	                    </div>
	                  </div>";
			}

		}//end Nếu người dùng ấn vô Thêm chuyên mục
 ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
		            <div class="col-md-12">
		              <div class="panel panel-default panel-border-color panel-border-color-primary">

		              	<?php if(isset($mess)){ echo $mess."<br>". "<button class='btn btn-space btn-default'><i class='icon icon-left mdi mdi-globe'></i> <a href='view_categories.php'>Quay Lại: Quản Lý Chuyên Mục</a></button>";} ?>
		                <div class="panel-body">
		                  <form action="" style="border-radius: 0px;" class="form-horizontal group-border-dashed" method="post">
		           
		                  		<?php if(isset($error) && in_array("name",$error)) echo "<div class='form-group'><center><font color='red'>Vui lòng điền tên chuyên mục. </font></center></div>"; ?>
		                    <div class="form-group">
		                    	
		                      <label class="col-sm-3 control-label">Tên chuyên mục:</label>
		                      <div class="col-sm-6">
		                        <input type="text" class="form-control" name="name" value="<?php if(isset($lay_name)) echo strip_tags($lay_name); ?>">
		                      </div>
		                    </div>
		                    <?php if(isset($error) && in_array("position",$error)) echo "<div class='form-group'><font color='red'>Vui lòng chọn position.</font></div>"; ?>
		                    <div class="form-group">
		                    	
		                      <label class="col-sm-3 control-label">Position:</label>
		                      <div class="col-sm-6">
		                        <select class="form-control" name="position">
		                          <?php
		                          		$q = "SELECT COUNT(cat_id) AS dem FROM categories";
		                          		$r = mysqli_query($dbc,$q);
		                          		check_query($r,$q);
		                          		if(mysqli_num_rows($r) == 1){
		                          			list($num) = mysqli_fetch_array($r,MYSQLI_NUM);
		                          			for($i = 1; $i <= $num; $i++){
		                          				echo "<option values='{$i}' ";
		                          				if(isset($lay_pos) && $lay_pos == $i){
		                          					echo "selected='selected'";
		                          				}
		                          				echo ">".$i. "</option>";
		                          			}
		                          		}
		                           ?>
		                        </select>
		                      </div>
		                    </div>
		                    <div class="col-sm-offset-5 col-sm-10">
		                    	<button class="btn btn-space btn-success hover" name="addcate" type="submit">Sửa chuyên mục</button>
		                    </div>
		                  </form>
		                </div>
		              </div>
		            </div>
		          </div>
            </div>
        </div>
}
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>