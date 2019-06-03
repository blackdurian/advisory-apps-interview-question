<?php


use App\Controller\auth;
use App\Controller\userController;

require_once "controllers/auth.php";
require_once "controllers/userController.php";

$auth = new auth();
$userControl = new userController();

$err_msg =  "";

if (isset($_POST["Submit"])&&$_POST["Submit"]=='Sign-up') {   

    if(!(empty($_POST["email"])
        ||empty($_POST["password"])  
        ||empty($_POST["confirm_password"])
        ||empty($_POST["type"])
        )
        ){

        if($_POST["password"]==$_POST["confirm_password"]){
            $currentId= $userControl->getMaxId();
            $newId = $currentId[0]["id"] + 1;
            $email = trim($_POST["email"]);
            $password =password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
            $token = $auth->randomToken(32);
            $type = $_POST["type"];
            //Add User
            $userControl->addUser($newId,$email,$password,$token,$type);
            //set session
            session_start();
            $_SESSION["user_id"] = $newId ;
            $_SESSION["token"] = $token;
            $_SESSION["type"] = $type;
            header("Location: index.php");

        }else{
            $err_msg="confirm password doesn't match!";
        }
    }else{
        $err_msg="Input cannot be empty";
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
    <h2>Sign-up</h2>

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
        <div class="form-group <?php echo (!empty($err_msg)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="confirm_password"  placeholder="*********" required="required">
            <span class="help-block"><?php echo $err_msg; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($err_msg)) ? 'has-error' : ''; ?>">
            <input type="radio" name="type" value="a"> Admin
            <input type="radio" name="type" value="u"> User
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="Submit" value="Sign-up">Sign-up</button>
            <button class="btn btn-light"  onclick="window.location='login.php';">Cancel</button>
        </div>
    </form>

</div>
</body>
</html>