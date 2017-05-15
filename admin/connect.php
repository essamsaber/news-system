<?php
    $dsn = 'mysql:host=127.0.0.1;dbname=truth';
    $user = 'root';
    $pass = '';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    
    try
    {
        $con = new PDO ($dsn, $user, $pass, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e)
    {
        die('Failed to Connect '. $e->getMessage());
    }