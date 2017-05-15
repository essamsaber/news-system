<nav class="navbar navbar-inverse">
  <div class="containe">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">الرئيسية</a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="http://127.0.0.1/esso/truth/">معاينة الموقع</a></li>
        <li><a href="members.php?action=Manage">الأعضاء</a></li>
        <li><a href="comments.php?action=Manage">التعليقات</a></li>
        <li><a href="news.php?action=Manage">الأخبار</a></li>
        <li><a href="sections.php?action=Manage">الأقسام</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="members.php?action=edit&userid=<?php echo $_SESSION['ID'];?>">تعديل الملف الشخصي</a></li>
            <li><a href="logout.php">تسجيل الخروج</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>