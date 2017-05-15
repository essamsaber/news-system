<?php require_once "init.php"; ?>
<?php
	if(isset($_GET['newsid']))
	{
		$newsid = $_GET['newsid'];
		if(is_numeric($newsid))
		{
			$stmt = $con->prepare("SELECT * FROM news WHERE newsID = ?");
			$stmt->execute(array($newsid));
			$row = $stmt->fetch();
?>
		<div class="wrapper col4">
		  <div id="container">
		    <div id="content">
		      <div id="featured_post"><img src="<?php echo $images_dir. $row['news_banner']; ?>" alt="" />
		       <p><h3><?php echo $row['news_title']; ?></h3><span style="color:green">الناشر</span>&nbsp;&nbsp;<i><?php echo $row['news_writer']; ?></i>&nbsp;&nbsp;<span style="color:yellow"><?php echo $row['news_date']; ?></span></p>
		        <p><?php echo $row['news_body']; ?></p>
		        <hr/>
		        <!-- -------------Show Comments Section -------------- -->
		        <center><h2>التعليقات</h2></center><br>
		        	<?php
		        	$stmt = $con->prepare("SELECT * FROM comments WHERE news_id = ? AND accepted = 1 ORDER BY commentID DESC");
		        	$stmt->execute(array($newsid));
		        	$comms = $stmt->fetchAll();
		        	?>
		        	<?php foreach($comms as $comm) {?>
		        		<p><?php echo $comm['comment_writer'] . "<br>" . $comm['comment_date']; ?></p>
		        		<p style="color: red; padding-bottom:5px;border-bottom: 1px dashed #FFFFFF"><?php echo $comm['comment_body']; ?></p>
		        	<?php }?>
				<!-- -------------End Show Comments Section -------------- -->

		        <!-- -------------Add Comment Section -------------- -->
		        	<p>اترك تعليقك</p>
		        	<form action="page.php?newsid=<?php echo $newsid; ?>" method="POST">
		        		<table border="0" dir="rtl">
		        			<tr >
		        				<td>اسمك</td>
		        				<td><input required type="text" name="name" style="border-radius:5px; width: 200px;height: 20px;"/></td>
		        			</tr>
		        			<tr>
		        				<td>التعليق</td>
		        				<td><textarea required name="comment_body" style="border-radius:5px; width: 400px; height: 200px;"></textarea></td>
		        			</tr>
		        			<tr>
		        				<td colspan="2"><center><input style="height: 30px;width: 80px; font-family: Tahoma; border-radius:3px;" type="submit" name="comment" value="ارسل تعليقك"></center></td>
		        			</tr>
		        		</table>
		        	</form>
		        	<?php
		        		if(isset($_POST['comment']))
		        		{
		        			$name = $_POST['name'];
		        			$comment_body = $_POST['comment_body'];
		        			$stmt = $con->prepare("INSERT INTO `comments`(`news_id`, `comment_writer`, `comment_body`) VALUES (?, ?, ?)");
		        			$stmt->execute(array($newsid, $name, $comment_body));
		        			echo "<center><p style='padding: 10px;border:2px dashed green';>تم إرسال التعليق وفي انتظار موافقة الإدارة</p></center>";
		        			
		        		}

		        	?>
		        <!-- -------------End Comment Section -------------- -->
		      </div>
		    </div>
		    <br class="clear" />
		  </div>
		  <br class="clear" />
		</div>	   
<?php   } 
		else
		{
			exit("عفوا لا توجد أخبار خاصة بهذا المعرف");
		}
	}
	else if($_GET['section'])
	{
		$section_id = $_GET['id'];
		if(is_numeric($section_id))
		{
			$stmt = $con->prepare("SELECT newsID, news_title FROM news WHERE section_id = ?");
			$stmt->execute(array($section_id));
			$news = $stmt->fetchAll();
			foreach ($news as $onenews) {
				echo "<center><p><a href='page.php?newsid=". $onenews['newsID'] ."'>". $onenews['news_title']."</a></p></center>";
			}
		}
		else
		{
			die("<center>عفو القسم الذي تحاول الوصول إليه غير موجود</center>");
		}
	}
	else 
	{
		header("Location: index.php");
	}
?>

<?php require_once "layout/footer.php"; ?>
