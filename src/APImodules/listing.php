<?php
use App\Controller\listingController;
use App\Controller\auth;

require_once "../controllers/listingController.php";
require_once "../controllers/auth.php";

$listingControl = new listingController();
$auth = new auth();

if (!(empty($_GET["id"])||empty($_GET["token"]))) {
    $userId = $_GET["id"];
    $token = $_GET["token"];
    if($auth->authTokenById($userId,$token)){
        $result = $listingControl->getListingByUserID($userId);
        jsonResponse($result,'200','Listing sucessfully retrieved');
    }else{
        jsonResponse(null,'401','Unauthorized');
    }
}else{
    jsonResponse(null,'400','Bad Request');
}
 
 
 function jsonResponse($listing,$code,$message){
    $response["listing"] = $listing; 
    $response["status"] = ['code'=>$code, 'message'=>$message];
    $jsonResponse = json_encode($response);
    header("Content-Type: application/json");
    echo $jsonResponse;
 }