<?php


use App\Controller\auth;
use App\Controller\userController;

require_once "controllers/auth.php";
require_once "controllers/userController.php";

$auth = new auth();

session_start();
 
$err_msg =  "";
$isLoggedIn = false;

if (! empty($_SESSION["user_id"])) {
    $isLoggedIn = true;
}

if ($isLoggedIn) {
  header("Location: index.php");
}


if (! empty($_POST["login"])) {   
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
 
        if($auth->isLoginValid($email,$password)){
            $userControl = new userController();
            $user = $userControl->getUserByEmail($email);
            $_SESSION["user_id"] = $user[0]["id"];
            $_SESSION["token"] = $user[0]["token"];
            $_SESSION["type"] = $user[0]["type"];
            header("Location: index.php");
        }else{
            $err_msg="Invalid Password & Username";
        }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>

    <form action= "" method="post">
        <div class="form-group <?php echo (!empty($err_msg)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="email" name="email" class="form-control"  placeholder="email@xxx.com" required="required">
        </div>
        <div class="form-group <?php echo (!empty($err_msg)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input class="form-control" type="password" name="password"  placeholder="*********" required="required">
            <span class="help-block"><?php echo $err_msg; ?></span>
        </div>
  
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="login"   value="Login">Login</button>
            <button class="btn btn-light"   type="submit" onclick="window.location='signup.php';">Sign-up</button>
        </div>
    </form>
    <h3>Admin</h3>
    <p>Email    :admin@admin.com</p>
    <p>Password :root</p>
</div>
</body>
</html>