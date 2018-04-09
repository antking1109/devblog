<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php
isLoggedIn();
  if (isset($_GET['id'],$_GET['name']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1))) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['rad4']) && $_POST['rad4'] == 'co'){
        $q = "DELETE FROM categories WHERE cat_id={$id}";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        if(mysqli_affected_rows($dbc) == 1){
          $mess = "Xóa thành công.";
        }else{
          $mess = "Không thể xóa do lỗi.";
        }
      }else{
        $mess = "";
      }
    }
  }else{
      chuyenhuong('view_categories.php');
    }
 ?>
        <div class="be-content">
            <div class="main-content container-fluid">
          <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-body">
          <form action="" class="form-horizontal group-border-dashed" method="post">
            <?php
               if(isset($mess)) {
                  echo "<div class='form-group'>
                          {$mess}<br>
                          <button class='btn btn-space btn-default'><i class='icon icon-left mdi mdi-globe'></i> <a href='view_categories.php'>Quay Lại: Quản Lý Chuyên Mục</a></button>
                        </div>";
                  exit;
              }
            ?>
            
              <div class="form-group">
                      <label class="col-sm-3 control-label">Bạn muốn xóa chuyên mục <b><?php if(isset($name)) echo $name; ?></b> ?</label>
                      <div class="col-sm-6">
                        <div class="be-radio be-radio-color has-success inline">
                          <input type="radio" checked="" name="rad4" id="rad34" value="co">
                          <label for="rad34">Xóa</label>
                        </div>
                        <div class="be-radio be-radio-color has-warning inline">
                          <input type="radio" name="rad4" id="rad35" value="khong">
                          <label for="rad35">Không</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3"></div>
                      <div class="col-sm-6"><button type="submit" class="btn btn-space btn-primary" name="delete">Xác nhận</button></div>
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