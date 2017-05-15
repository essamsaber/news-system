<?php
    session_start();
    $noNavbar = "";
    $pageTitle = "تسجيل الدخول";
    require_once "init.php";
    include_once $tpl . "header.php";
    $msg ='';
    
    // Check if the user coming from HTTP Request or not
    if(isset($_POST['login']))
    {
        
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedPass = sha1($password);
        
        // Chech if the User exist in the database or not
        $stmt = $con->prepare("SELECT userID, username, password, groupID FROM users WHERE username = ? AND password = ?");
        $stmt->execute(array($username, $hashedPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0) // If the count is more than 0, this mean that the username and password is exist
        {
            $_SESSION['username'] = $username; // Register Session name
            $_SESSION['ID'] = $row['userID'];
            $_SESSION['groupID'] = $row['groupID'];  // Register Session ID

            header('Location: dashboard.php'); // Return the user to the main page
        } 
        else
        {
            $msg = '<div class="alert alert-danger" role="alert">خطأ في اسم المستخدم أو كلمة المرور</div>';
        }
        
    }
?>

    <form class="login" action="" method="POST">
        <h4 class="text-center">تسجيل دخول المدير</h4>
        <h6 class="text-center"><?php if(isset($msg)) echo $msg; ?></h6>
        <input class="form-control" type="text" name="user" placeholder="اسم المستخدم" autocomplete="off" />
        <input class="form-control" type="password" name="pass" placeholder="كلمة المرور" autocomplete="new-password" />
        <input class="btn btn-primary btn-block" type="submit" name="login" value="تسجيل الدخول"  />
    </form>

<?php include_once $tpl . "footer.php"; ?>