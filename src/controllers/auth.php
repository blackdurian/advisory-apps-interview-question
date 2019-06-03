<?php
namespace App\Controller;

require_once "userController.php";
class auth{
    function __construct() {
        $this->userControl = new userController();
    }

    function isLoginValid($email,$password){
        $isValid = false;
        $userSet = $this->userControl->getAllUser();
        if (! empty($userSet)) {
            foreach($userSet as $k => $v){
                if ($userSet[$k]['email']==$email){
                    if(password_verify($password,$userSet[$k]['encrypted_password'])){
                        $isValid = true;
                    }
                }
            }
        }
        return $isValid;
    }

    function randomToken($length){
        $length = $length/2;
        return bin2hex(random_bytes($length));
    }

    
    function LoginValidByHashedValue($email,$password){
        $isValid = false;
        $userSet = $this->userControl->getAllUser();
        if (! empty($userSet)) {
            foreach($userSet as $k => $v){
                if ($userSet[$k]['email']==$email){
                    if($password==$userSet[$k]['encrypted_password']){
                        $isValid = true;
                    }
                }
            }
        }
        return $isValid;
    }

    function authTokenById($id, $token){
        $isValid = false;
        $userSet = $this->userControl->getUserById($id);
        if($token==$userSet[0]["token"]){
            $isValid = true;
        }
        return $isValid;
    }

}