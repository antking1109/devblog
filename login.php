<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Đăng nhập"; ?>
<?php $mota = "Dang Nhap Nick"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php 
    //XỬ LÝ ĐĂNG KÝ
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = array();
        $email = $pass = FALSE;
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email = mysqli_real_escape_string($dbc,$_POST['email']);
        }else{
            $error[] = 'email';
        }

        if(preg_match('/^[\w\'.-]{4,20}$/',trim($_POST['pass1']))){
            $password = mysqli_real_escape_string($dbc,trim($_POST['pass1']));
        }else{
            $error[] = "pass";
        }

        if($email && $password){
            //Nếu tất cả các dữ liệu được nhập vào
            $q = "SELECT user_id,first_name,user_level FROM users WHERE (email='$email' AND pass=SHA1('$password') AND active IS NULL)";
            $r = mysqli_query($dbc,$q);
            check_query($r,$q);
            if(mysqli_num_rows($r) == 1){
                list($uid,$fn,$ulv) = mysqli_fetch_array($r,MYSQLI_NUM);
                $_SESSION['user_id']    = $uid;
                $_SESSION['first_name'] = $fn;
                $_SESSION['user_level'] = $ulv;
                chuyenhuong('index.php');
            }else{
                $mess = "<p><font color='red'>Thông tin đăng nhập sai hoặc bạn chưa kích hoạt tài khoản qua email.</font></p>";
            }
        }else{
            $mess = "<p><font color='red'>Bạn vui lòng nhập đủ các thông tin.</font></p>";
        }
    }//END MAIN IF
 ?>
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2>Login</h2>
                                <a href="contact.html"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <?php if(isset($mess)) echo $mess; ?>
                                <form method="POST" name="Đăng Nhập">
                                    <table>
                                        <tr>
                                            <td>Email: </td>
                                            <td><input type="text" name="email" id="email" <?php if(isset($email)) echo "value='{$email}'"; ?>></td>
                                            <td id="check"><font color="red"><?php if(isset($error) && in_array('email',$error)) echo "Vui lòng nhập vào Email"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Password: </td>
                                            <td><input type="text" name="pass1" id="pass1" <?php if(isset($password)) echo "value='{$password}'"; ?>></td>
                                            <td id="check"><font color="red"><?php if(isset($error) && in_array('pass',$error)) echo "Vui lòng nhập vào Password"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><center><input type="submit" name="Đăng Nhập" value="Đăng Nhập"></center></td>
                                        </tr>
                                        <tr>
                                            <td><a href='retrieve_pass.php'>Quên mật khẩu</a></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>