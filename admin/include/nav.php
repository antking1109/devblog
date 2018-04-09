<?php 
    if ($_SESSION['first_name']) {
        $name = $_SESSION['first_name'];
        $uid = $_SESSION['user_id'];
    }
 ?>
<body>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="container-fluid">
                <div class="navbar-header"><a href="index.php" class="navbar-brand"></a>
                </div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav navbar-right be-user-nav">
                        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="assets/img/avatar.png" alt="Avatar"><span class="user-name"><?php if(isset($name)) echo $name; ?></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li>
                                    <div class="user-info">
                                        <div class="user-name"><?php if(isset($name)) echo $name; ?></div>
                                        <div class="user-position online">Online</div>
                                    </div>
                                </li>
                                <li><a href="../edit_profile.php"><span class="icon mdi mdi-face"></span> Account</a></li>
                                <li><a href="../logout.php"><span class="icon mdi mdi-power"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>