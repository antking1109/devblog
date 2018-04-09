<?php include '../admin/include/header.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>


<?php
	isLoggedIn();
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
			$q = "INSERT INTO categories(cat_name,user_id,position) VALUES('$name',{$_SESSION['user_id']},'$pos')";
			$r = mysqli_query($dbc,$q);
			check_query($r,$q);
			if(mysqli_affected_rows($dbc) == 1){
				$mess = "<div role='alert' class='alert alert-success alert-icon alert-dismissible'>
                    <div class='icon'><span class='mdi mdi-check'></span></div>
                    <div class='message'>
                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Thêm chuyên mục thành công.
                    </div>
                  </div>";
			}else{
				$mess = "<div role='alert' class='alert alert-warning alert-icon alert-dismissible'>
                    <div class='icon'<span class='mdi mdi-alert-triangle'></span></div>
                    <div class='message'>
                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Không thể thêm chuyên mục vô csdl do lỗi
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

		              	<?php if(isset($mess)){ echo $mess."<br>";} ?>
		                <div class="panel-body">
		                  <form action="" style="border-radius: 0px;" class="form-horizontal group-border-dashed" method="post">
		           
		                  		<?php if(isset($error) && in_array("name",$error)) echo "<div class='form-group'><center><font color='red'>Vui lòng điền tên chuyên mục. </font></center></div>"; ?>
		                    <div class="form-group">
		                    	
		                      <label class="col-sm-3 control-label">Tên chuyên mục:</label>
		                      <div class="col-sm-6">
		                        <input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])) echo strip_tags($_POST['name']); ?>">
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
		                          			for($i = 1; $i <= $num+1; $i++){
		                          				echo "<option values='{$i}' ";
		                          				if(isset($_POST['position']) && $_POST['position'] == $i){
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
		                    	<button class="btn btn-space btn-success hover" name="addcate" type="submit">Thêm chuyên mục</button>
		                    </div>
		                  </form>
		                </div>
		              </div>
		            </div>
		          </div>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>