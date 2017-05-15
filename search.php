<?php require_once "init.php"; ?>
<?php
	if(isset($_POST['search']))
	{
		$word = $_POST['search'];
		if(is_string($word))
		{
			$stmt = $con->prepare("SELECT newsID, news_title FROM news WHERE news_title = ?");
			$stmt->execute(array($word));
			$result = $stmt->fetch();
			echo "<br><center><a href='page.php?newsid=".$result['newsID']."'>".$result['news_title']."</a></center>";
 		}
		else 
		{
			die("<br><center>لا توجد نتيجة للبحث</center>");
		}

	}
	else 
	{
		die("<br><center>عفوا لم تدخل كلمة للبحث</center>");
	}
?>
<?php require_once "layout/footer.php"; ?>
