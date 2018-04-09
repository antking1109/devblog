<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Đổi mật khẩu"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
    <?php  
        isLoggedIn();
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Bat dau xu ly form
            $error = array();

            //Kiểm tra currenpass
            if(isset($_POST['current_pass']) && preg_match('/^[\w\'.-]{4,20}$/',trim($_POST['current_pass']))){
                $current_pass = mysqli_real_escape_string($dbc, trim($_POST['current_pass']));
                //Kiểm tra pass nhập vào đúng hay không
                $q = "SELECT first_name FROM users WHERE user_id={$_SESSION['user_id']} AND pass=SHA1('{$current_pass}')";
                $r = mysqli_query($dbc,$q);
                check_query($r,$q);
                if(mysqli_affected_rows($dbc) == 1){
                    //Nếu pass đúng
                    if(isset($_POST['pass1']) && preg_match('/^[\w\'.-]{4,20}$/',trim($_POST['pass1']))){
                        
                        if(isset($_POST['pass2']) && $_POST['pass1'] == $_POST['pass2']){
                            $password = mysqli_real_escape_string($dbc, trim($_POST['pass1']));

                            $q = "UPDATE users SET pass = SHA1('{$password}') WHERE user_id = {$_SESSION['user_id']} LIMIT 1";
                            $r = mysqli_query($dbc,$q);
                            check_query($r,$q);
                            if(mysqli_affected_rows($dbc) == 1){
                                $mess = "<p><font color='green'>Bạn đã thay đổi mật khẩu thành công.</font></p>";
                            }else{
                                $mess = "<p><font color='red'>Không thể thay đổi mật khẩu do lỗi truy vấn CSDL.</font></p>";
                            }
                        }else{
                            $error[] = "pass2";
                        }
                    }else{
                        $error[] = "pass1";
                    }
                }else{
                    //Pass sai
                    $error[] = "ecp";
                }
            }else{
                $error[] = "current_pass";
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
                                            <td>Mật Khẩu Hiện Tại: </td>
                                            <td><input type="text" name="current_pass" <?php if(isset($current_pass)) echo "value='{$current_pass}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('current_pass',$error)) echo "Vui lòng nhập vào Mật khẩu hiện tại"; ?><?php if(isset($error) && in_array('ecp',$error)) echo "Mật khẩu bạn nhập chưa đúng"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Mật Khẩu Mới: </td>
                                            <td><input type="text" name="pass1" <?php if(isset($password)) echo "value='{$password}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('pass1',$error)) echo "Vui lòng nhập vào Password"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td>Xác Nhận Mật Khẩu: </td>
                                            <td><input type="text" name="pass2" <?php if(isset($password)) echo "value='{$password}'"; ?>></td>
                                            <td><font color="red"><?php if(isset($error) && in_array('pass2',$error)) echo "2 mật khẩu không khớp"; ?></font></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><center><input type="submit" name="Đổi Mật Khẩu" value="Đổi Mật Khẩu"></center></td>
                                        </tr>
                                        
                                    </table>
                                </form>
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>