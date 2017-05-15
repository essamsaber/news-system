<?php require_once "init.php"; ?>
<div class="wrapper col4">
  <div id="container">
  <?php
    $stmt = $con->prepare("SELECT `newsID`, `section_id`, `news_title`, SUBSTRING(`news_body`, 1, 600) AS body , `news_date`, `news_writer`, `news_banner` FROM `news` ORDER BY newsID DESC LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch();
  ?>
    <div id="content">
      <div id="featured_post"><img src="<?php echo $images_dir. $row['news_banner']; ?>" alt="" />
        <p><h3><?php echo $row['news_title']; ?></h3></p>
        <p><?php echo $row['body']; ?></p>
        <a href="page.php?newsid=<?php echo $row['newsID']; ?>">.... اقرأ المزيد</a>
      </div>
      <div id="hpage_latest">
      <?php
        $stmt = $con->prepare("SELECT `newsID`, `section_id`, `news_title`, SUBSTRING(`news_body`, 1, 400) AS body , `news_date`, `news_writer`, `news_banner` FROM `news` ORDER BY newsID DESC LIMIT 3");
        $stmt->execute();
        $rows = $stmt->fetchAll();
      ?>
        <ul>
        <?php foreach($rows as $row) {?>
          <li><img src="<?php echo $images_dir. $row['news_banner']; ?>" alt="" />
            <p><?php echo $row['body']; ?></p>
            <p class="readmore"><a href="page.php?newsid=<?php echo $row['newsID']; ?>">.... اقرأ المزيد</a></p>
          </li>
        <?php }?>
        </ul>
        <br class="clear" />
      </div>
    </div>
    <div id="column">
      <?php
        $stmt = $con->prepare("SELECT `newsID`, `section_id`, `news_title`, SUBSTRING(`news_body`, 1, 300) AS body , `news_date`, `news_writer`, `news_banner` FROM `news` ORDER BY newsID DESC LIMIT 5");
        $stmt->execute();
        $latestnews = $stmt->fetchAll();
      ?>
      <ul id="latestnews">
      <?php foreach($latestnews as $latest){ ?>
        <li><img src="<?php echo $images_dir.$latest['news_banner']; ?>" alt="" />
          <p>
            <strong><a href="page.php?newsid=<?php echo $latest['newsID']; ?>"><?php echo $latest['news_title']; ?></a></strong> 
            <?php echo $latest['body'];?>
          </p>
        </li>
      <?php }?>        
      </ul>
    </div>
    <br class="clear" />
  </div>
  <br class="clear" />
</div>
<!-- ####################################################################################################### -->

<?php require_once "layout/footer.php"; ?>
