<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$error = array();
		if(empty($_POST['name'])){
			$error[] = 'name';
		}else{
			$name = htmlentities($_POST['name']);
		}
		if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$email = $_POST['email'];
		}else{
			$error[]= 'email';
		}
		if(empty($_POST['ndcmt'])){
			$error[]='ndcmt';
		}else{
			$text = $_POST['ndcmt'];
		}
		if(isset($_POST['check']) && $_POST['check']!=$_SESSION['q']['answer']){
			$error[]='check';
		}else{
			$check = $_POST['check'];
		}
		if(empty($error)){
			$q = "INSERT INTO comments(page_id,auther,email,comment,comment_date) VALUES ($pid,'$name','$email','$text',NOW())";
			$r = mysqli_query($dbc,$q);
			check_query($r,$q);
			if(mysqli_affected_rows($dbc) == 1){
				$mess 	= "Cảm ơn bạn đã bình luận.";
			}else{
				$mess = "Bạn không thể thêm comment do lỗi hệ thống.";
			}
		}else{
			$mess = "Bạn vui lòng nhập đủ nội dung.";
		}
	}
 ?>
 <?php 
	$q = "SELECT comment_id,auther,comment,comment_date FROM comments WHERE page_id = $pid";
	$r = mysqli_query($dbc,$q);
	check_query($r,$q);
	if(mysqli_affected_rows($dbc)>0){
		while ($cmt = mysqli_fetch_array($r)) {
			echo "<b>{$cmt['auther']}</b> ({$cmt['comment_date']})";
			if(isAdmin()){
				echo "<a href='inc/delete_comment.php?cmt_id={$cmt['comment_id']}&pid={$pid}&pname={$pname}'><font color='red'>Delete</font></a>";
			}
			echo "<div class='container'>
			  <div class='dialogbox'>
			    <div class='body'>
			      <span class='tip tip-up'></span>
			      <div class='message'>
			        <span>{$cmt['comment']}</span>
			      </div>
			    </div>
			  </div>
			</div>";
		}
	}
 ?>
 <div id="comment_form">
	<h4>Để Lại Bình Luận</h4>
	<span>
		<?php if(isset($mess)){
				echo "<font color='red'><b>".$mess."</b></font>";
			  }
		?>
		
	</span>
	<form name="cmt" method="post">
		<span>
			<font color="red">
				<?php if (isset($error) && in_array("name",$error)) {
					echo "Vui lòng nhập tên bạn.";
				} ?>
			</font>
		</span>
		<div>
			<input type="text" name="name" id="name" <?php if(isset($name)) {echo "value='".$name."'";}else{echo "placeholder='Name'";} ?>>
		</div>
		<span>
			<font color="red">
				<?php 
					if(isset($error) && in_array("email",$error)){
						echo "Vui lòng nhập email.";
					}
				 ?>
			</font>
		</span>
		<div>
			<input type="email" name="email" id="email" <?php if(isset($email)) {echo "value='".$email."'";}else{echo "placeholder='Email'";} ?>>
		</div>
		<p>Nội dung:</p>
			<span>
				<font color="red">
					<?php 
						if(isset($error) && in_array("ndcmt",$error)){
							echo "Vui lòng nhập nội dung comment.";
						}
					 ?>
				</font>
			</span>
		<div>
			
			<textarea rows="10" name="ndcmt" id="textarea_full"><?php if(isset($text)) {echo $text;}?></textarea>
		</div>
		
		<span>
			<font color="red">
				<?php 
					if(isset($error) && in_array("check",$error)){
						echo "Vui lòng trả lời đúng câu hỏi.";
					}
				 ?>
			</font>
		</span>
		<p><?php echo capcha(); ?></p>
		<div>
			
			<input type="text" name="check" <?php if(isset($check)) {echo "value='".$check."'";} else{echo "planceholder='Trả lời'";}?> >
		</div>
		<div>
			<input type="submit" name="submit" value="Add Comment">
		</div>
	</form>
	
</div>
