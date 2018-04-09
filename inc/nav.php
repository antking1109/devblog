<body>
    <!-- Preloader Start -->
    <div class="preloader">
        <div class="rounder"></div>
    </div>
    <!-- Preloader End -->
    <div id="main">
        <div class="container">
            <div class="row">
                <!-- About Me (Left Sidebar) Start -->
                <div class="col-md-3 col-lg-3">
                    <div class="about-fixed">
                        <div class="my-pic">
                            <?php 
                                
                             ?>
                            <img <?php if(isset($img)) {echo "src='".BASE_URL."/uploads/images/{$img}'";} else {echo "src='images/avatar.png'";} ?> alt="avatar">
                            <a href="javascript:void(0)" class="collapsed" data-target="#menu" data-toggle="collapse"><i class="icon-menu menu"></i></a>
                            <div id="menu" class="collapse">
                                <ul class="menu-link">
                                    <?php 
                                        $q = "SELECT cat_name,cat_id FROM categories";
                                        $r = mysqli_query($dbc,$q);
                                        check_query($r,$q);
                                        while($catn = mysqli_fetch_array($r)){
                                            echo "<li><a href='category.php?cid={$catn['cat_id']}&cname={$catn['cat_name']}'>".$catn['cat_name']."</a></li>";
                                        }

                                     ?>
                                </ul>
                            </div>
                        </div>
                        <div class="my-detail">
                            <div class="white-spacing">
                                <h1>TruongKen</h1>
                                <span>Web Developer</span>
                            </div>
                            <?php 
                                if(isset($_SESSION['user_id'], $_SESSION['first_name'], $_SESSION['user_level'])){
                                    switch ($_SESSION['user_level']) {
                                        case 0:
                                            # Thành viên thường
                                            echo "  <a href='edit_profile.php' target='_blank'>User Profile |</a>
                                                    <a href='change_pass.php' target='_blank'>Change Password</a><br>
                                                    <a href='logout.php' target='_blank'>Log Out</a>";
                                            break;
                                        case 2:
                                            #Admin
                                            echo "  <a href='edit_profile.php' target='_blank'>Profile |</a>
                                                    <a href='change_pass.php' target='_blank'>Change Password |</a>
                                                    <a href='admin/index.php' target='_blank'>Admin CP</a>
                                                    <a href='logout.php' target='_blank'>Log Out</a>";
                                            break;
                                        default:
                                            # code...
                                            echo " <a href='register.php' target='_blank'>Register |</a>
                                                   <a href='login.php' target='_blank'>Login</a>";
                                            break;
                                    }
                                }
                             ?>
                        </div>
                    </div>
                </div>
                <!-- About Me (Left Sidebar) End -->