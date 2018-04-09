<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php 
isLoggedIn();
	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=> 1))){
		$id = $_GET['id'];
		$q = "SELECT page_name,position,content FROM pages WHERE page_id={$id} limit 1";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if($page = mysqli_fetch_array($r)){
			$page_name = $page['page_name'];
			$page_pos = $page['position'];
			$page_content = $page['content'];
		}
	}else{
		chuyenhuong('view_pages.php');
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$error = array();
		if(empty($_POST['name'])){
			$error[] = "name";
		}else{
			$name = mysqli_real_escape_string($dbc,strip_tags($_POST['name']));
		}
		if(isset($_POST['position']) && filter_var($_POST['position'],FILTER_VALIDATE_INT,array('min_range' => 1))){
			$pos = $_POST['position'];
		}else{
			$error[] = "position";
		}
		if(empty($_POST['content'])){
			$error[] = "content";
		}else{
			$content = $_POST['content'];
		}
		if(empty($error)){
			$q = "UPDATE pages SET page_name='{$name}', content='{$content}', position='{$pos}' WHERE page_id = {$id}";
	    	$r = mysqli_query($dbc,$q);
	    	check_query($r,$q);
	    	if(mysqli_affected_rows($dbc) == 1){
	    		$mess = "<div role='alert' class='alert alert-success alert-icon alert-dismissible'>
	                    <div class='icon'><span class='mdi mdi-check'></span></div>
	                    <div class='message'>
	                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Sửa bài viết thành công.
	                    </div>
	                  </div>";
	    	}else{
	    		$mess = "<div role='alert' class='alert alert-warning alert-icon alert-dismissible'>
	                    <div class='icon'<span class='mdi mdi-alert-triangle'></span></div>
	                    <div class='message'>
	                      <button type='button' data-dismiss='alert' aria-label='Close' class='close'><span aria-hidden='true' class='mdi mdi-close'></span></button>Không thể sửa bài viết do lỗi
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

	}
 ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
		            <div class="col-md-12">
			              <div class="panel panel-default panel-border-color panel-border-color-primary">
			              	<?php if(isset($mess)){ echo $mess;} ?>
			                <div class="panel-heading panel-heading-divider">Chỉnh sửa bài viết<span class="panel-subtitle"><?php 	if(isset($page_name)) echo htmlentities($page_name); ?></span></div>
			                <div class="panel-body">
			                  <form action="" style="border-radius: 0px;" class="form-horizontal group-border-dashed" method="post">
			                  	<?php if(isset($error) && in_array("name",$error)) echo "<div class='form-group'><center><font color='red'>Vui lòng điền tên bài viết. </font></center></div>"; ?>
			                    <div class="form-group">

			                      <label class="col-sm-3 control-label">Tên bài viết</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" name="name" <?php 
			                        		if(!isset($error)){
			                        				if(isset($page_name)) echo "value='".htmlentities($page_name)."'";
			                        		}else{
			                        			if(isset($name)){
			                        				echo "value='".$name."'";
			                        			}
			                        		}
			                        		 ?>>
			                        		
			                      </div>
			                    </div>
			                    <?php if(isset($error) && in_array("position",$error)) echo "<div class='form-group'><font color='red'>Vui lòng chọn position.</font></div>"; ?>
			                    <div class="form-group">
			                      <label class="col-sm-3 control-label">Position</label>
			                      <div class="col-sm-6">
			                        <select class="form-control" name="position">
			                          <?php 
			                          	$q_pos = "SELECT COUNT(*) FROM pages";
			                          	$r_pos = mysqli_query($dbc,$q_pos);
			                          	check_query($r_pos,$q_pos);
			                          	list($num) = mysqli_fetch_array($r_pos,MYSQLI_NUM);
			                          	for ($i=1; $i <= $num; $i++) { 
			                          		# code...
			                          		echo "<option value='{$i}'";
			                          		if(!isset($error)){
			                          			if($i == $page_pos){
			                          				echo "selected = '{$i}'";
			                          			}
			                          		}else{
			                        			if(isset($pos)){
			                        				echo $pos;
			                        			}
			                        		}
			                          		echo ">{$i}</option>";
			                          	}
			                          ?>
			                        </select>
			                      </div>
			                    </div>
			                    <?php if(isset($error) && in_array("content",$error)) echo "<div class='form-group'><font color='red'>Vui lòng điền nội dung.</font></div>"; ?>
			                    <div class="form-group">
			                      <label class="col-sm-3 control-label">Nội dung</label>
			                      <div class="col-sm-6">
			                        <textarea class="form-control" rows="20" name="content"><?php 
			                        		if(!isset($error)){
			                        			if(isset($page_content)) echo $page_content;
			                        		} else{
			                        			if(isset($content)){
			                        				echo $content;
			                        			}
			                        		}
			                        	?></textarea>
			                      </div>
			                    </div>
			                    <div class="col-sm-offset-5 col-sm-10">
			                    	<button class="btn btn-space btn-success hover" name="addcate" type="submit">Sửa bài viết</button>
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