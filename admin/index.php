<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <?php 
                	isLoggedIn();
                 ?>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>