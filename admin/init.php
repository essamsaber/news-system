<?php
// Include database connect file
include_once "connect.php";

// Routes
$tpl = "includes/templates/";   // Template route
$func = "includes/functions/";
$css = "layout/css/";   // Css route
$js = "layout/js/"; // Js route
$fonts = "layout/fonts/";
$tiny = "layout/tinymce/";
$photos_dir = "layout/img/";

// Include the functions that we need to use
include_once $func. "functions.php";

// Include the important files
include_once $tpl. "header.php";


// Include the navbar in all pages except the login page
if(!isset($noNavbar)){require_once $tpl."navbar.php";}