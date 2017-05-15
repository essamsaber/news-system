<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>جريدة الحقيقة الإلكترونية</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div class="fl_left">
      <img src="images/demo/Logo-01.png">
    </div>
    <div class="fl_right"><a href="#"><img src="images/demo/images.png" alt="" /></a></div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
      	<li class="active"><a href="index.php">الرئيسية</a></li>	
        <?php 
          $stmt = $con->prepare("SELECT * FROM sections");
          $stmt->execute();
          $sections = $stmt->fetchAll();
        ?>							
        <?php foreach($sections as $section) {?>
          <li><a href="page.php?section=economic&id=<?php echo $section['sectionID']; ?>"><?php echo $section['section_name']; ?></a></li>
        <?php }?>	
        <li class="active"><a href="admin/index.php">دخول الإدارة</a></li>
      </ul>
    </div>
    <div id="search">
      <form action="search.php" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" name="search" value="... ابحث عن خبر"  onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="بحث" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->