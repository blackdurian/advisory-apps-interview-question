<?php

use App\Controller\userController;
use App\Controller\auth;

require_once "../controllers/userController.php";
require_once "../controllers/auth.php";

$userControl = new userController();
$auth = new auth();

if (! (empty($_GET["email"])||empty($_GET["password"]))) {
    $email = $_GET["email"];
    $password = $_GET["password"];
    if($auth->LoginValidByHashedValue($email,$password)){
        $result = $userControl->getIdTokenByEmail($email);
        jsonResponse($result[0],"200","Access Granted");
    } else{
        jsonResponse(null,'401','Unauthorized');
    }
}else{
    jsonResponse(null,'400','Bad Request');
}

function jsonResponse($arr,$code,$message){
    $status["status"] = ['code'=>$code, 'message'=>$message];
    if(!is_null($arr)){
        $response = $arr + $status; 
    }else{
        $response = $status;
    }
    $jsonResponse = json_encode($response);
    header("Content-Type: application/json");
    echo $jsonResponse;
 }

 