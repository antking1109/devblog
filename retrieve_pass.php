<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Quên Mật Khẩu"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2>Lấy lại mật khẩu</h2>
                                <a href="contact.html"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <!-- Blog Post Start -->
                               <?php 
                                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                                        $uid = false;
                                        $mess = array();
                                        if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                                            $e = mysqli_escape_string($dbc, $_POST['email']);
                                            $q = "SELECT user_id FROM users WHERE email='{$e}'";
                                            $r = mysqli_query($dbc,$q);
                                            check_query($r,$q);
                                            if(mysqli_num_rows($r) == 1){
                                                list($uid) = mysqli_fetch_array($r);
                                            }
                                        }else{
                                            $mess[] = "<p>Vui lòng điền email.</p>";
                                        }

                                        if($uid){
                                            //Nếu tồn tại uid
                                            $temp_pass = substr(md5(uniqid(rand(),true)),3,10);

                                            //update csdl với pass tạm thời
                                            $q = "UPDATE users SET pass = SHA1('$temp_pass') WHERE user_id = $uid LIMIT 1";
                                            $r = mysqli_query($dbc,$q);
                                            check_query($r,$q);
                                            if(mysqli_affected_rows($dbc) == 1){
                                                $body = "Mật khẩu của bạn đã đươc đổi thạm thời thành: $temp_pass  . Bạn vui lòng sử dụng email và mật khẩu mới để đăng nhập website.";
                                                if(mail($e, "Mat Khau Moi", $body, "FROM: localhost")){
                                                    $mess[] = "<p>Mật khẩu thay đổi thành công. Bạn vui lòng kiểm tra email để nhận mật khẩu mới.</p>";
                                                }else{
                                                    $mess[] = "<p>Không thể gửi mail đến cho bạn. Rất xin lỗi vì sự cố này.</p>";
                                                }
                                            }else{
                                                $mess[] = "<p>Không thể đổi mật khẩu do lỗi hệ thống</p>";
                                            }

                                        }else{
                                            $mess[] = "<p>Bạn vui lòng nhập vào email.</p>";
                                        }
                                    }//END MAIN IF
                                ?>
                                <?php
                                    if(isset($mess)){
                                        foreach ($mess as $m) {
                                            echo $m;
                                        }
                                    }
                                ?>
                                <form name="laylaimk" method="post">
                                    Nhập địa chỉ email cần lấy lại mật khẩu<br>
                                    <input type="text" name="email"><br>
                                    <input type="submit" name="laymk" value="Lấy lại mật khẩu"><br>
                                </form>
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>