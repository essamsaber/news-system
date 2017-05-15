<?php
session_start();
$pageTitle = 'إدارة الأقسام';

if(isset($_SESSION['username'])) {
	require_once 'init.php';

	$action = $_GET['action'];
// Start Manage Section
	if($action == 'Manage') {
		$stmt = $con->prepare("SELECT * FROM sections");
		$stmt->execute();
		$rows = $stmt->fetchAll();
	?>	
	<center>
	<table class="table table-striped">
		<tr>
			<th>الإجراء</th>
			<th>اسم القسم</th>
			<th>المعرف</th>
		</tr>
		<?php foreach($rows as $row) { ?>
		<tr>
			<td><a class="btn btn-danger" href='?action=delete&sectionid=<?php echo $row["sectionID"]; ?>'>حذف</a> <a class="btn btn-warning" href='?action=edit&sectionid=<?php echo $row["sectionID"]; ?>'>تعديل</a></td>
			<th><?php echo $row['section_name']; ?></th>
			<th><?php echo $row['sectionID']; ?></th>
		</tr>
		<?php } ?>
		<tr>
			<td><a class='btn btn-success' href='?action=add'>إضافة قسم جديد</a></td>
			<td></td>
			<td></td>
		</tr>		
	</table>
	</center>
	<?php } else if($action == 'add') { ?>
		<h1 class="text-center">إضافة قسم جديد</h1>
		<form class="form-horizontal" method="POST" action="?action=add">
			<div class="form-group">
				<div class="col-sm-10">
					<input required class="form-control" type="text" name="section_name" autocomplete="off" />
				</div>
				<label class="col-sm-2 control-label">اسم القسم</label>					
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input type="submit" name="add" value="إضافة" class="btn btn-primary " />
				</div>
			</div>
		</form>
		<?php
			if(isset($_POST['add'])) {
				$section_name = $_POST['section_name'];
				$stmt = $con->prepare("INSERT INTO sections (`section_name`) VALUES (?)");
				$stmt->execute(array($section_name));
				header("Location: sections.php?action=Manage");
			}
		?>
	<?php 
	} else if($action == 'edit') { 
		$section_id = $_GET['sectionid'];
		$stmt = $con->prepare("SELECT * FROM sections WHERE sectionID = ?");
		$stmt->execute(array($section_id));
		$row = $stmt->fetch();
		?>
		<h1 class="text-center">تعديل قسم</h1>
		<form class="form-horizontal" method="POST" action="?action=edit">
			<div class="form-group">
				<div class="col-sm-10">
					<input type="hidden" name="section_id" value="<?php echo $row['sectionID']; ?>" />
					<input required class="form-control" type="text" value="<?php echo $row['section_name']; ?>" name="section_name" autocomplete="off" />
				</div>
				<label class="col-sm-2 control-label">اسم القسم</label>					
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input type="submit" name="update" value="تحديث" class="btn btn-primary " />
				</div>
			</div>
		</form>
	<?php
		if(isset($_POST['update']))
		{
			$section_name = $_POST['section_name'];
			$section_id = $_POST['section_id'];
			$stmt = $con->prepare("UPDATE sections SET section_name = ? WHERE sectionID = ?");
			$stmt->execute(array($section_name, $section_id));
			header("Location: sections.php?action=Manage");
		}
	} else if($action == 'delete') {
		$section_id = $_GET{'sectionid'};
		if(is_numeric($section_id)) {
			$stmt = $con->prepare("DELETE FROM sections WHERE sectionID = ?");
			$stmt->execute(array($section_id));
			header('Location: sections.php?action=Manage');
		} else {
			exit("<center>عفوا لا يوجد أقسام بهذا المعرف</center>");
		}
	} else {
		header('Location: sections.php?action=Manage');
	}

	require_once $tpl .'footer.php';


} else {
	header('Location: index.php');
}
