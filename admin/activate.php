<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php $title = "Activate Account"; ?>
<?php 
     if(isset($_GET['x'],$_GET['y']) && filter_var($_GET['x'],FILTER_VALIDATE_EMAIL) && strlen($_GET['y']) == 32){
         $e = mysqli_real_escape_string($dbc, $_GET['x']);
         $a = mysqli_real_escape_string($dbc, $_GET['y']);

        $q = "UPDATE users SET active = NULL WHERE email = '{$e}' AND active = '{$a}' LIMIT 1";
        $r = mysqli_query($dbc,$q); check_query($r,$q);
        if(mysqli_affected_rows($dbc) == 1){
            echo "<p><font color='green'>Bạn đã kích hoạt tài khoản thành công</font>. <a href='".BASE_URL."/login.php'>Login</a>"."</p>";
        }else{
            echo "<p><font color='red'>Bạn không thể kích hoạt tài khoản vui lòng thử lại</font></p>";
         }
      }else{
            //Thông tin không đúng, chuyển hướng
            chuyenhuong();
       }
?>