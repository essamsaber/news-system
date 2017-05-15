<?php
session_start();
$pageTitle = 'إدارة الأخبار';

if(isset($_SESSION['username'])) {

	require_once "init.php";
	$action = $_GET['action'];
##########################  If there is no processing like add, edit, delete ############################	
		if($action == 'Manage') 
		{
			$stmt = $con->prepare("SELECT * FROM news INNER JOIN sections ON news.section_id=sections.sectionID ORDER BY newsID DESC");
			$stmt->execute();
			$rows = $stmt->fetchAll();
			?> 
			<center>
				<table class='table table-striped'>
					<tr>
						<td><a class='btn btn-success' href='?action=add'>إضافة خبر جديد</a></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th>الإجراء</th>
						<th>تاريخ النشر</th>
						<th>اسم الناشر</th>
						<th>التصنيف</th>
						<th>عنوان الخبر</th>
					</tr>
					<?php foreach($rows as $row) { ?>
					<tr>
						<td><a class="btn btn-danger" href='?action=delete&newsid=<?php echo $row["newsID"]; ?>'>حذف</a> <a class="btn btn-warning" href='?action=edit&newsid=<?php echo $row["newsID"]; ?>'>تعديل</a></td>
						<td><?php echo $row['news_date']; ?></td>
						<td><?php echo $row['news_writer']; ?></td>
						<td><?php echo $row['section_name']; ?></td>
						<td><?php echo $row['news_title']; ?></td>
					</tr>
					<?php } ?>
					
				</table>
			</center>
			<?php 			
		}
##########################  If there add processing ############################	
		else if($action == 'add')
		{?>
			<h1 class="text-center">إضافة خبر جديد</h1>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="?action=add">
				<div class="form-group">
					<div class="col-sm-10">
						<input required class="form-control" type="text" name="news_title" autocomplete="off" />
					</div>
					<label class="col-sm-2 control-label">عنوان الخبر</label>					
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						<textarea name="news_body" id="news_body"></textarea>
					</div>
					<label class="col-sm-2 control-label">نص الخبر</label>					
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						<input id='news_image' type="file" name="news_banner" />
					</div>
					<label class="col-sm-2 control-label">صورة الخبر</label>					
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						<select name="section_name" style="float: right; width: 150px; direction: rtl;">
						<?php  
							$stmt = $con->prepare("SELECT * FROM sections");
							$stmt->execute();
							$rows = $stmt->fetchAll();
							foreach($rows as $row) { 
						?>
							<option value="<?php echo $row['sectionID']; ?>"><?php echo $row['section_name']; ?></option>
						<?php } ?>
						</select>
					</div>
					<label class="col-sm-2 control-label">القسم</label>					
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						<input required class="form-control" type="text" value="<?php echo $_SESSION['username']; ?>" name="news_writer" autocomplete="off" />
					</div>
					<label class="col-sm-2 control-label">كاتب الخبر</label>					
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="submit" name="add" value="إضافة الخبر" class="btn btn-primary " />
					</div>
				</div>
			</form>
		<?php
			if(isset($_POST['add']))
				{
					$check_image_type = $_FILES['news_banner']['type'];
					$explode = explode('/', $check_image_type);
					$image_type = $explode[1];
					$image_size = $_FILES['news_banner']['size'];
					$image_tmp_name = $_FILES['news_banner']['tmp_name'];
					$image_name = uniqid(). $_FILES['news_banner']['name'];
					if(!$image_type == 'png' || !$image_type == 'jpeg')
					{
						die("<center>الامتدادات المدعومة هي png, jpeg فقط</center>");
					}
					else
					{
						if(is_uploaded_file($image_tmp_name))
						{
							$result = move_uploaded_file($image_tmp_name, $photos_dir.basename($image_name));
							$news_section 	= $_POST['section_name'];
							$news_title 	= $_POST['news_title'];
							$news_body 		= $_POST['news_body'];
							$news_writer 	= $_POST['news_writer'];

							$stmt = $con->prepare("INSERT INTO news (`section_id`, `news_title`,`news_body`,`news_writer`, `news_banner`) VALUES (?, ?, ?, ?, ?)");
							$stmt->execute(array($news_section, $news_title, $news_body, $news_writer, $image_name));
							header("Location:news.php?Manage");
						}
						
					}					
				}
		}
##########################  End add processing ############################	

########################## Start edit processing ############################			
		else if($action == 'edit')
		{
			$news_id = $_GET['newsid'];
			if(is_numeric($news_id))
			{
				$stmt = $con->prepare("SELECT * FROM news WHERE newsID = ?");
				$stmt->execute(array($news_id));
				$onerow  = $stmt->fetch();

				?>
				<h1 class="text-center">تعديل خبر</h1>
				<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
					<div class="form-group">
						<div class="col-sm-10">
							<input type="hidden" name="news_id" value="<?php echo $_GET['newsid']; ?>" />
							<input required class="form-control" type="text" name="news_title" value="<?php echo $onerow['news_title']; ?>" /> 
						</div>
						<label class="col-sm-2 control-label">عنوان الخبر</label>					
					</div>
					<div class="form-group">
						<div class="col-sm-10">
							<textarea name="news_body" id="news_body"><?php echo $onerow['news_body']; ?></textarea>
						</div>
						<label class="col-sm-2 control-label">نص الخبر</label>					
					</div>					
					<div class="form-group">
						<div class="col-sm-10">
							<select name="section_name" style="float: right; width: 150px; direction: rtl;">
							<?php  
								$stmt = $con->prepare("SELECT * FROM sections");
								$stmt->execute();
								$rows = $stmt->fetchAll();
								foreach($rows as $row) { 
							?>
								<option <?php if($onerow['section_id'] == $row['sectionID']) echo "selected"; ?> value="<?php echo $row['sectionID']; ?>"><?php echo $row['section_name']; ?></option>
							<?php } ?>
							</select>
						</div>
						<label class="col-sm-2 control-label">القسم</label>					
					</div>
					<div class="form-group">
						<div class="col-sm-10">
							<input required class="form-control" type="text" value="<?php echo $onerow['news_writer']; ?>" name="news_writer" autocomplete="off" />
						</div>
						<label class="col-sm-2 control-label">كاتب الخبر</label>					
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input type="submit" name="update" value="حفظ التعديلات" class="btn btn-primary " />
						</div>
					</div>
				</form>
				<?php
					if(isset($_POST['update']))
					{
						$news_section = $_POST['section_name'];
						$news_title = $_POST['news_title'];
						$news_body  = $_POST['news_body'];						
						$news_writer = $_POST['news_writer'];
						$news_id = $_POST['news_id'];

						$stmt = $con->prepare("UPDATE news SET section_id = ?, news_title = ?, news_body = ?, news_writer = ? WHERE newsID = ?");
						$stmt->execute(array($news_section, $news_title, $news_body, $news_writer, $news_id));
						echo '<div class="alert alert-success" role="alert">تم تعديل الخبر بنجاح</div>';
						echo '<meta http-equiv="refresh" content="1">';
					}
				?>
				<?php
			}
			else 
			{
				die("<center>عفوا لا توجد أي أخبار متصلة بهذا المعرف</center>");
			}
		}
########################## End edit processing ############################	

########################## Start delete processing ############################		
		else if($action =='delete')
		{
			$news_id = $_GET['newsid']; 
			if(is_numeric($news_id))
			{
				$stmt = $con->prepare("DELETE FROM news WHERE newsID = ?");
				$stmt->execute(array($news_id));
				header("Location: news.php?action=Manage");
			}
			else
			{
				exit('عفوا لا يوجد خبر بهذا المعرف');
			}
		}		
########################## End delete processing ############################
########################## In case no GET request ############################
		else
		{
			header("Location: news.php?action=Manage");
		}		
} else {
	header("Location:index.php");
}

require_once $tpl . "footer.php";
