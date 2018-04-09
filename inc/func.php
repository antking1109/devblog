<?php
	define('BASE_URL', getValue(1));
	//Kiểm tra kết quả truy vấn có đúng không
	function check_query($result,$query){
		global $dbc;
		if(!$result){
			echo "Truy vấn {$query} \n<br> MySQL Error: " . mysqli_error($dbc);
		}
	}
	function chuyenhuong($link = '../admin/index.php'){
		header("Location: {$link}");
		exit;
	}
	function the_excerpt($text){
		$xuly = strip_tags($text);
		if(strlen($xuly)<=400){
			return $xuly;
		}else{
			
			$cutStr = substr($xuly,0,400);
			$word = substr($cutStr,0,strrpos($cutStr," "));
			return $word;
		}
	}
	function mota($text){
		$xuly = strip_tags($text);
		if(strlen($xuly)<=150){
			return $xuly;
		}else{
			
			$cutStr = substr($xuly,0,150);
			$word = substr($cutStr,0,strrpos($cutStr," "));
			return $word;
		}
	}
	function getPageByCatId($id,$start,$limit){
		global $dbc;
		$q = "SELECT page_id,pages.user_id,page_name,content,post_on,CONCAT(first_name,last_name) AS user_name FROM pages INNER JOIN users ON pages.user_id = users.user_id INNER JOIN categories ON categories.cat_id=pages.cat_id WHERE pages.cat_id={$id} ORDER BY pages.page_id DESC LIMIT $start,$limit";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        return $r;
	}
	function getPageById($id){
		global $dbc;
		$q = "SELECT page_name,pages.user_id,content,post_on,CONCAT(first_name,last_name) AS user_name FROM pages INNER JOIN users ON pages.user_id = users.user_id INNER JOIN categories ON categories.cat_id=pages.cat_id WHERE page_id={$id}";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        return $r;
	}
	function getPage($start,$limit){
		global $dbc;
		$q = "SELECT page_id,pages.user_id,page_name, content,post_on,CONCAT(first_name,last_name) AS user_name FROM pages INNER JOIN users ON pages.user_id = users.user_id ORDER BY pages.page_id DESC LIMIT $start,$limit";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        return $r;
	}
	function getPageByAuther($auther_id,$start,$limit){
		global $dbc;
		$q = "SELECT page_id,page_name, content,post_on,CONCAT(first_name,last_name) AS user_name FROM pages INNER JOIN users ON pages.user_id = users.user_id WHERE users.user_id=$auther_id ORDER BY pages.page_id DESC LIMIT $start,$limit";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        return $r;
	}
	function getPageRand($sobv){
		global $dbc;
		$q = "SELECT page_id,page_name FROM pages ORDER BY RAND() LIMIT $sobv";
        $r = mysqli_query($dbc,$q);
        check_query($r,$q);
        return $r;
	}
	//tao pragraph tu csdl
	function the_content($text){
		return str_replace(array("\r\n","\n"),array("<p>","</p>"),$text);
	}
	function capcha(){
		$poser = array(
						1 => array('question' => 'Một cộng hai bằng mấy (Trả lời chữ số)','answer' => 3),
						2 => array('question' => 'Mười trừ sáu còn mấy (Trả lời bằng số)','answer' => 4),
						3 => array('question' => 'Mười một cộng chín bằng mấy (Trả lời bằng số)','answer' => 20),
						4 => array('question' => 'Mười trừ tám còn mấy (Trả lời bằng số)','answer' => 2),
						5 => array('question' => 'Mười cộng tám bằng mấy (Trả lời bằng số)','answer' => 18),
						6 => array('question' => 'Mười một trừ chín còn mấy (Trả lời bằng số)','answer' => 2),
						7 => array('question' => 'Chín cộng bảy bằng mấy (Trả lời bằng số)','answer' => 16),
						8 => array('question' => 'Chín trừ bảy còn mấy (Trả lời bằng số)','answer' => 2),
						9 => array('question' => 'Chín nhân bảy bằng bao nhiêu (Trả lời bằng số)','answer' => 63),
						10 => array('question' => 'Mười chia năm bằng bao nhiêu (Trả lời bằng số)','answer' => 2)
						);
		$random_key = array_rand($poser); //lấy ngẫu nhiên một key trong array 1,2,4...
		$_SESSION['q'] = $poser[$random_key];
		return $question = $poser[$random_key]['question'];
	}
	function getStartAndLimit(){
		global $dbc;
		 //Phân trang
         $limit = 4;
         if(isset($_GET['page']) && filter_var($_GET['page'],FILTER_VALIDATE_INT,array('min_range' => 1))){
            $page = $_GET['page'];
         }else{
            $page = 1;
         }
         //Lấy tổng số page
         $q = "SELECT COUNT(page_id) FROM pages";
         $r = mysqli_query($dbc,$q);
         check_query($r,$q);
         list($record) = mysqli_fetch_array($r,MYSQLI_NUM);
         if($record>$limit){
            $total_page = ceil($record/$limit);
         }else{
            $total_page = 1;
         }

         //start
         $start = ($page-1)*$limit;
         return $sr = array ('start' 		=> $start,
         					 'limit' 		=> $limit,
         					 'page' 		=> $page,
         					 'total_page'	=> $total_page
         					);
	}
	function getStartAndLimitForAdmin($query){
		global $dbc;
		 //Phân trang
         $limit = 6;
         if(isset($_GET['page']) && filter_var($_GET['page'],FILTER_VALIDATE_INT,array('min_range' => 1))){
            $page = $_GET['page'];
         }else{
            $page = 1;
         }
         //Lấy tổng số page
         $q = $query;
         $r = mysqli_query($dbc,$q);
         check_query($r,$q);
         list($record) = mysqli_fetch_array($r,MYSQLI_NUM);
         if($record>$limit){
            $total_page = ceil($record/$limit);
         }else{
            $total_page = 1;
         }

         //start
         $start = ($page-1)*$limit;
         return $sr = array ('start' 		=> $start,
         					 'limit' 		=> $limit,
         					 'page' 		=> $page,
         					 'total_page'	=> $total_page
         					);
	}

	function isLoggedIn(){
		if(!isset($_SESSION['user_id'])){
			chuyenhuong('../login.php');
		}
	}
	function isAdmin(){
		return isset($_SESSION['user_level']) && $_SESSION['user_level'] == 2;
	}
	function isAdminCP(){
		if(!isAdmin()){
			chuyenhuong('../index.php');
		}
	}
	function view_counter($pg_id){
		$ip = $_SERVER['REMOTE_ADDR'];
		global $dbc;

		//Truy vấn csdl để xem page view
		$q = "SELECT num_views FROM page_views WHERE page_id = {$pg_id}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_num_rows($r) > 0){
			//Nếu kt tồn tại thì update view
			$q = "UPDATE page_views SET num_views = (num_views +1) WHERE page_id = {$pg_id} LIMIT 1";
			$r = mysqli_query($dbc,$q);
			check_query($r,$q);
		}else{
			$q = "INSERT INTO page_views (page_id,num_views,user_ip) VALUES ({$pg_id},1,'{$ip}')";
			$r = mysqli_query($dbc,$q);
			check_query($r,$q);
		}
	}
	function view($pid){
		global $dbc;
		$q = "SELECT num_views FROM page_views WHERE page_id = {$pid}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		list($view) = mysqli_fetch_array($r,MYSQLI_NUM);
		return $view;
	}
	function fetchUser($uid){
		global $dbc;
		$q = "SELECT * FROM users WHERE user_id = {$uid}";
		$r = mysqli_query($dbc,$q);
		check_query($r,$q);
		if(mysqli_num_rows($r) == 1){
			//Neu ton tai user
			return $result = mysqli_fetch_array($r);
		}else{
			return FALSE;
		}
	}
	function isPOST(){
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}
	function getValue($op_id){
                		global $dbc;
                		$q = "SELECT option_value FROM options WHERE option_id = {$op_id}";
	                	$r = mysqli_query($dbc,$q);
	                	check_query($r,$q);
	                	list($value) = mysqli_fetch_array($r);
	                	return $value;
                	}
 ?>