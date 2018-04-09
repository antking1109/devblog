<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php 
                    if(isset($_GET['pid'],$_GET['pname']) && filter_var($_GET['pid'],FILTER_VALIDATE_INT,array('min_range'=>1))){
                        $pid = $_GET['pid'];
                        $pname = $_GET['pname'];
                        $get = getPageById($pid);
                        $posts= array();
                                    if(mysqli_affected_rows($dbc) >0){
                                    $data = mysqli_fetch_array($get);
                                    $title = $data['page_name'];
                                    $mota = mota($data['content']);
                                    $posts[] = array(
                                    			'name' => $data['page_name'],
                                                'user_id' => $data['user_id'],
                                    			'content' => $data['content'],
                                    			'author' => $data['user_name'],
                                    			'date' => $data['post_on']
                                    		);

                                }
                    }else{
                        chuyenhuong('404.html');
                    }
                 ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
                
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                            	<a href="/" title="Trở lại trang chủ"><h2>Back Home</h2></a>
                                <a href="http://fb.com/truongvp97"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                            	<div class="col-md-12 blog-post">
                            	
                                
                                <!-- Post Headline Start -->
                                <div class="post-title">
                                    <h1><?php if(isset($pname)) echo $pname; ?></h1> 
                                   </div>
                                   <!-- Post Headline End -->
                                    
                                <?php

                                    view_counter($pid);
                                    $view = view($pid);
                                    foreach ($posts as $post) {
                                        echo "<div class='post-info'>
                                    <span>{$post['date']} / by <a href='author.php?author_id={$post['user_id']}&author_name={$post['author']}' target='_blank'>{$post['author']}</a> / Lượt xem: {$view}</span>
                                   </div>"."<p>".the_content($post['content'])."</p>";
                                        }

                                 ?>
                                 <div class="about-author margin-top-70 margin-bottom-50">
                                    <?php 
                                        $user       = fetchUser($post['user_id']);
                                     ?>
                                    <div class="picture">
                                      <img <?php if(isset($user['avatar'])) {echo "src='".BASE_URL."/uploads/images/{$user['avatar']}'";} else {echo "src='images/avatar.png'";} ?> class="img-responsive" alt="">
                                     </div>
                                   
                                    <div class="c-padding">
                                       <h3>Article By <?php echo "<a href='author.php?author_id={$post['user_id']}&author_name={$post['author']}' target='_blank'>{$post['author']}</a>"; ?></h3>
                                       <p><?php if(isset($user['bio'])){echo $user['bio'];} else {echo "Một thành viên chăm đăng bài của blog.";} ?></p>
                                      </div>
                                    </div>
                                    <!-- Post Author Bio Box End -->
                                    <!-- You May Also Like Start -->
                                  <div class="you-may-also-like margin-top-50 margin-bottom-50">
                                    <h3>Bạn có thể thích</h3>
                                     <div class="row">
                                 	<?php
                                 		$r = getPageRand(3);
                                 		while ($c = mysqli_fetch_array($r)) {
                                 			echo "<div class='col-md-4 col-sm-6 col-xs-12'>
                                      <a href='single.php?pid={$c['page_id']}&pname={$c['page_name']}'><p>{$c['page_name']}</p></a>
                                     </div>";
                                 		}
                                 	 ?>
                                    
                                    </div>
                                  </div>
                                  <?php include 'inc/comment_form.php' ?>
                                  <!-- You May Also Like End -->
                             </div>
                             <!-- Post Author Bio Box Start -->
                                  
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>