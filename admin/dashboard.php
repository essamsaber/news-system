<?php
session_start();
$pageTitle = 'الرئيسية';
if(isset($_SESSION['username']))
{
	require_once "init.php";

		echo "<br><br><br><h1 class='text-center'>مرحبا بك في لوحة تحكم الإدارة</h1>";
	include_once $tpl . "footer.php";
}
else
{
	header("Location: index.php");
}