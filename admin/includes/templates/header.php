<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php getTitle(); ?></title>
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $css; ?>backend.css" />
        <script type="text/javascript" src="<?php echo $tiny; ?>tinymce.min.js"></script>
        <script>tinymce.init({selector: '#news_body'});
  </script>             
    </head>
    <body>
    <div class="container">
