<!-- Subscribe Form Start -->
                        
                    <!-- Footer Start -->
                    <div class="col-md-12 page-body margin-top-50 footer">
                        <footer>
                            <ul class="menu-link">
                                <ul class="menu-link">
                                    <li><a href="index.php">Home</a></li>
                                    <?php 
                                        $q = "SELECT cat_name,cat_id FROM categories";
                                        $r = mysqli_query($dbc,$q);
                                        check_query($r,$q);
                                        while($catn = mysqli_fetch_array($r)){
                                            echo "<li><a href='category.php?cid={$catn['cat_id']}&cname={$catn['cat_name']}'>".$catn['cat_name']."</a></li>";
                                        }

                                     ?>
                                </ul>
                            </ul>
                            <p>© Copyright 2018. All rights reserved</p>
                            <!-- UiPasta Credit Start -->
                            <div class="uipasta-credit">Design By <a href="http://fb.com/truongvp97" target="_blank">TruongKen</a></div>
                            <!-- UiPasta Credit End -->
                        </footer>
                    </div>
                    <!-- Footer End -->
                </div>
                <!-- Blog Post (Right Sidebar) End -->
            </div>
        </div>
    </div>
    <!-- Back to Top Start -->
    <a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
    <!-- Back to Top End -->
    <!-- All Javascript Plugins  -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugin.js"></script>
    <script type="text/javascript" src="js/check_form.jquery.js"></script>
    <!-- Main Javascript File  -->
    <script type="text/javascript" src="js/scripts.js"></script>
</body>

</html>