<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php $title = "Log Out"; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2>Log Out</h2>
                                <a href="contact.html"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <!-- Blog Post Start -->
                               <?php 
                                    if(!isset($_SESSION['first_name'])){
                                        //Nếu chưa đăng nhập
                                        chuyenhuong('index.php');
                                    }else{
                                        $_SESSION = array(); //xóa hết array của session
                                        echo "<p><font color='green'>Bạn đã đăng xuất thành công.</font> <a href='index.php'>Quay lại trang chủ</a></p>";
                                    }
                                ?>
                                  
                            </div>
                        </div>
                        <?php include 'inc/footer.php'; ?>