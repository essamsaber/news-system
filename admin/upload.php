<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include "init.php";
if(isset($_POST['upload']))
{
	$check_image_type = $_FILES['image']['type'];
	$explode = explode('/', $check_image_type);
	$image_type = $explode[1];
	$image_size = $_FILES['image']['size'];
	$image_tmp_name = $_FILES['image']['tmp_name'];
	$image_name = uniqid(). $_FILES['image']['name'];
	if(is_uploaded_file($image_tmp_name))
	{
		$result = move_uploaded_file($image_tmp_name, $photos_dir.basename($image_name));
		

	}
}
?>
<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="image">
	<input type="submit" name="upload">
</form>

</body>
</html>