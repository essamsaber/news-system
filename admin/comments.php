<?php
session_start();
$pageTitle = "إدارة التعليقات";
if(isset($_SESSION['username']))
{
	require_once "init.php";
	$action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

	if($action == 'Manage')
	{
		$stmt = $con->prepare('SELECT * FROM comments ORDER BY commentID DESC');
		$stmt->execute();
		$comments = $stmt->fetchAll();
		if(count($comments))
		{?>
		<center>
		<table class="table table-striped">
			<tr>
				<th>الحالة</th>
				<th>الإجراء</th>
				<th>اسم المعلق</th>
				<th>التعليق</th>
			</tr>
		
		<?php foreach($comments as $comment) {?>
			<tr>
				<td><?php if($comment['accepted'] != '1') echo "<a href='?action=active&id=".$comment['commentID']."'>في انتظار الموافقة</a>"; else echo "تمت الموافقة"; ?></td>
				<td><a class="btn btn-danger" href="?action=delete&id=<?php echo $comment['commentID']; ?>">حذف</a></td>
				<td><?php echo $comment['comment_writer']; ?></td>
				<td><?php echo $comment['comment_body']; ?></td>
			</tr>	
		
		<?php
		 } 
		} 
		 else 
		 {
		 	exit("<center>عفوا لا توجد أية تعليقات</center>");
		 }	
		 ?>		
		</table>
		</center>
	<?php }
	else if($action == 'active')
	{
		$comment_id = $_GET['id'];
		if(is_numeric($comment_id))
		{

		$stmt = $con->prepare("UPDATE comments SET accepted = 1 WHERE commentID= ?");

		$stmt->execute(array($comment_id));
		header("Location: comments.php?action=Manage");
		} 
		else 
		{
			exit("<center>عفوا لا توجد تعليقات بهذا المعرف</center>");
		}
	}
	else if($action =='delete')
	{
		$comment_id = $_GET['id'];
		if(is_numeric($comment_id))
		{

		$stmt = $con->prepare("DELETE FROM comments WHERE commentID= ?");

		$stmt->execute(array($comment_id));
		header("Location: comments.php?action=Manage");
		} 
		else 
		{
			exit("<center>عفوا لا توجد تعليقات بهذا المعرف</center>");
		}
	}
	include_once $tpl . "footer.php";
}
else 
{
	header("Location: index.php");	
}
?>