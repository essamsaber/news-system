<?php
session_start();
$pageTitle = "إدارة العضويات";
if(isset($_SESSION['username']))
{
	require_once "init.php";
	$action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
	// Vew the main page of members  
	if($action == 'Manage')
	{
		$stmt = $con->prepare("SELECT userID, username, fullname FROM users");
		$stmt->execute();
		$rows = $stmt->fetchAll(); ?>
	
		<div class="container">
		<center>
			<table class="table table-striped">
				<tr>
					<th>الإجراء</th>
					<th>الاسم الحقيقي</th>
					<th>اسم الدخول</th>
					<th>المعرف</th>
				</tr>
				<?php
					foreach($rows as $row) { ?>
					<tr>
						<td><a class="btn btn-danger" href='?action=delete&userid=<?php echo $row["userID"]; ?>'>حذف</a> <a class="btn btn-warning" href='?action=edit&userid=<?php echo $row["userID"]; ?>'>تعديل</a></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['userID']; ?></td>	
					</tr>	
					<?php }
				?>
					<tr>
						<td><a class='btn btn-success' href='?action=add'>إضافة مستخدم جديد</a></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			</table>
		</center>
		</div>
	<?php 
	}
	// Edit a certain member ************************************************************************
	else if($action == 'edit')
	{ 
		$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
		$stmt = $con->prepare("SELECT * FROM users WHERE userID = ?");
		$stmt->execute(array($userid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count > 0)
		{
	?>
		<!-- Begin Edit Form -->
				<h1 class="text-center">تعديل بيانات العضو</h1><br>
				<div class="container">
					<form class="form-horizontal" method="POST" action="?action=update">
						<!-- Hidden input that will hold the id value -->
						<input type="hidden" name="userID" value="<?php if(isset($row['userID'])) echo $row['userID']; ?>">
						<!-- Start Username Input -->
						<div class="form-group">
							<div class="col-sm-10">
								<input required class="form-control" type="text" name="username" value="<?php if(isset($row['username'])) echo $row['username']; ?>" autocomplete="off" />
							</div>
							<label class="col-sm-2 control-label">اسم الدخول</label>					
						</div>
						<!-- End Username Input -->

						<!-- Start Password Input -->
						<div class="form-group">						
							<div class="col-sm-10">
								<input type="hidden" name="oldpassword" value="<?php if(isset($row['password'])) echo $row['password']; ?>" />
								<input type="password" name="newpassword" class="form-control" autocomplete="new-password" />
							</div>
							<label class="col-sm-2 control-label">كلمة المرور</label>
						</div>
						<!-- End Username Input -->

						<!-- Start Email Input -->
						<div class="form-group">						
							<div class="col-sm-10">
								<input required type="email" name="email" value="<?php if(isset($row['email'])) echo $row['email']; ?>" class="form-control" autocomplete="off" />
							</div>
							<label class="col-sm-2 control-label">البريد الإلكتروني</label>
						</div>
						<!-- End Email Input -->

						<!-- Start Fullname Input -->
						<div class="form-group">						
							<div class="col-sm-10">
								<input required type="text" name="fullname" value="<?php if(isset($row['fullname'])) echo $row['fullname']; ?>" class="form-control"  autocomplete="off" />
							</div>
							<label class="col-sm-2 control-label">الاسم الحقيقي</label>
						</div>
						<!-- End Fullname Input -->
						
						<!-- Start Button Input -->
						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<input type="submit" name="update" value="تحديث البيانات" class="btn btn-primary " />
							</div>
						</div>
						<!-- End Button Input -->
					</form>	
				</div>
			<!-- End Edit Form -->		
  <?php }
  		else
  		{
  			exit('<center> لا يوجد أعضاء بهذا الرقم</center>');
  		}

		
 	}

 	else if($action == 'update') // Update page ************************************************
 	{
 		echo "<h1 class='text-center'>تحديث معلومات العضو</h1>";
 		if(isset($_POST['update']))
 		{
 			$userid = $_POST['userID'];
 			$username = $_POST['username'];
 			$email = $_POST['email'];
 			$fullname = $_POST['fullname'];

 			$pass = '';
 			if(empty($_POST['newpassword']))
 			{
 				$pass = $_POST['oldpassword'];
 			}
 			else
 			{
 				$pass = sha1($_POST['newpassword']);
 			}
 			$stmt = $con->prepare("UPDATE users SET username = ?, password = ?, email = ?, fullname= ? WHERE userID = ?");
 			$stmt->execute(array($username, $pass, $email, $fullname, $userid));
 			exit('<center>تم تحديث بيانات العضو بنجاح</center>'); 

 		}
 		else
 		{
 			exit('<center>عفوا لا تستطيع الدخول لهذه الصفحة بطريقة مباشرة</center>');
 		}
 	}  			// End update page  ****************************************************************

	// Delete a certain member      ****************************************************************
	else if($action == 'delete')
	{
		$userid = $_GET['userid'];
		if(is_numeric($userid)) {
			$stmt = $con->prepare("DELETE FROM users WHERE userID = ?");
			$stmt->execute(array($userid));
			header("Location: members.php");
		} else {
			exit('لا يوجد أعضاء بهذا الرقم');
		}
	}
	// End delete a certain member ****************************************************************
	
	else if($action == 'add')
	{ ?>
		<!-- ******************** Begin Add Form ******************** -->    
		<h1 class="text-center">إضافة عضو جديد</h1><br>
		<div class="container">
			<form class="form-horizontal" method="POST" action="?action=add">
				<!-- Start Username Input -->
				<div class="form-group">
					<div class="col-sm-10">
						<input required class="form-control" type="text" name="username" class="form-control" autocomplete="off" />
					</div>
					<label class="col-sm-2 control-label">اسم الدخول</label>					
				</div>
				<!-- End Username Input -->

				<!-- Start Password Input -->
				<div class="form-group">						
					<div class="col-sm-10">
						<input type="password" name="password" class="form-control" autocomplete="new-password" />
					</div>
					<label class="col-sm-2 control-label">كلمة المرور</label>
				</div>
				<!-- End Username Input -->

				<!-- Start Email Input -->
				<div class="form-group">						
					<div class="col-sm-10">
						<input required type="email" name="email" value="" class="form-control" autocomplete="off" />
					</div>
					<label class="col-sm-2 control-label">البريد الإلكتروني</label>
				</div>
				<!-- End Email Input -->

				<!-- Start Fullname Input -->
				<div class="form-group">						
					<div class="col-sm-10">
						<input required type="text" name="fullname" value="" class="form-control" autocomplete="off" />
					</div>
					<label class="col-sm-2 control-label">الاسم الحقيقي</label>
				</div>
				<!-- End Fullname Input -->
				
				<!-- Start Button Input -->
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="submit" name="add" value="إضافة" class="btn btn-primary " />
					</div>
				</div>
				<!-- End Button Input -->
			</form>	
		</div>
	<!-- ******************** End Add Form ******************** -->			
	<?php 
			if(isset($_POST['add']))
			{
				$username = $_POST['username'];
				$password = sha1($_POST['password']);
				$email = $_POST['email'];
				$fullname = $_POST['fullname'];

				$stmt = $con->prepare("INSERT INTO users (`username`, `password`, `email`, `fullname`) VALUES (?, ?, ?, ?)");
				$stmt->execute(array($username, $password, $email, $fullname));
				if($stmt->rowCount() > 0)
				{
					header("Location: members.php");
				}
				else 
				{
					exit("<center>حدث خطأ أثناء إضافة العضو يرجى إعادة المحاولة مرة أخرى</center>");
				}
			}
		}

	include_once $tpl . "footer.php";
}
else
{
	header("Location: index.php");
}
?>