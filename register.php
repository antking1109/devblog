<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Đăng Ký Tài Khoản"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php 
    //XỬ LÝ ĐĂNG KÝ
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = array();
        $fn = $ln = $email = $password = FALSE;
        if(preg_match('/^[\w\'.-]{2,20}$/i',trim($_POST['fn']))){
            $fn = mysqli_real_escape_string($dbc,trim($_POST['fn']));
        }else{
            $error[] = 'fn';
        }

        if(preg_match('/^[\w\'.-]{2,20}$/i',trim($_POST['ln']))){
            $ln = mysqli_real_escape_string($dbc,trim($_POST['ln']));
        }else{
            $error[] = 'ln';
        }

        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email = mysqli_real_escape_string($dbc,$_POST['email']);
        }else{
            $error[] = 'email';
        }

        if(preg_match('/^[\w\'.-]{4,20}$/',trim($_POST['pass1']))){
            if($_POST['pass1'] == $_POST['pass2']){
                $password = mysqli_real_escape_string($dbc,trim($_POST['pass1']));
            }else{
                $error[] = 'pass not match';
            }
        }else{
            $error[] = "pass";
        }

        if($fn && $ln && $email && $password){
            //Nếu tất cả các dữ liệu được nhập vào
            $q = "SELECT user_id FROM users WHERE email = '{$email}'";
            $r = mysqli_query($dbc,$q);
            check_query($r,$q);
            if(mysqli_num_rows($r) == 0){
                //Nếu email nhập không tồn tại trong database
                //
                //
                //Tạo active key
                $a = md5(uniqid(rand(), true));

                //Chèn giá trị vào CSDL
                //
                $q = "INSERT INTO users (first_name,last_name,email,pass,active,registration_date) VALUES ('{$fn}','{$ln}','{$email}',SHA1('$password'),'{$a}',NOW())";
                $r = mysqli_query($dbc,$q);
                check_query($r,$q);

                if(mysqli_affected_rows($dbc) == 1){
                    //Nếu thêm thành công thì gửi email cho người dùng
                    $body = "Cảm ơn bạn đã đăng ký tài khoản. Một email đã được gửi về địa chỉ email của bạn. Bạn vui lòng truy cập và xác nhận email. \n \n";
                    $body.= BASE_URL . "/admin/activate.php?x=".urlencode($email)."&y={$a}";
                    if(mail($_POST['email'],'Xac nhan dang ky tai khoan tai DevBlog',$body, 'FROM: localhost')){
                        $mess =  "<p><font color='green'>Bạn đã đăng ký tài khoản thành công. Vui lòng kích hoạt email để sử dụng tài khoản.</font></p>";
                    }else{
                        $mess = "<p><font color='red'>Không thể gửi email xác nhận cho bạn. Rất xin lỗi về sự bất tiện này.</font></p>";
                    }

                }
            }else{
                    //Nếu mail tồn tại
                    $mess = "<p><font color='red'>Email đã tồn tại trong hệ thống.</font></p>";
            }
        }else{
            //Nếu một trong các dữ liệu không được nhập
            $mess = "<p><font color='red'>Vui lòng điền đầy đủ thông tin.</font></p>";
        }//END IF CHECK DATA
    }//END MAIN IF
 ?>
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2>Register</h2>
                                <a href="contact.html"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <?php if(isset($mess)) echo $mess; ?>
                                <form method="POST" name="Đăng Ký">
                                    <table>
                                        <tr>
                                            <td>First Name: </td>
                                            <td><input type="text" name="fn" <?php if(isset($fn)) echo "value='{$fn}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('fn',$error)) echo "Vui lòng nhập vào First Name"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name: </td>
                                            <td><input type="text" name="ln"  <?php if(isset($ln)) echo "value='{$ln}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('ln',$error)) echo "Vui lòng nhập vào Last Name"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td><input type="text" name="email" <?php if(isset($email)) echo "value='{$email}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('email',$error)) echo "Vui lòng nhập vào Email"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Password: </td>
                                            <td><input type="text" name="pass1" <?php if(isset($password)) echo "value='{$password}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('pass',$error)) echo "Vui lòng nhập vào Password"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Confirm Password: </td>
                                            <td><input type="text" name="pass2" <?php if(isset($password)) echo "value='{$password}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('pass not match',$error)) echo "Mật khẩu nhập lại không khớp"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><center><input type="submit" name="Đăng Ký" value="Đăng ký"></center></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>