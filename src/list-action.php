<?php

use App\Controller\listingController;

require_once "controllers/listingController.php";


session_start();

//todo define cookie
$isLoggedIn = false;

if (! empty($_SESSION["user_id"]) && ! empty($_SESSION["token"])){
    $isLoggedIn = true;
    $user_id = $_SESSION["user_id"];
    $token= $_SESSION["token"]; 
    $type = $_SESSION["type"];
}
  
if(!$isLoggedIn){
    header("Location: login.php");
}


if(isset($_GET['action'])){
    $action = $_GET['action'];    
}else{
    header("Location: index.php");
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
 }

 switch($action){
    case 'delete':
        $listing = new listingController();
        $listing->deleteListingByID($id);
        $heading = "";
 
        header("Location: index.php");
        break;
    case 'edit':
        $listing = new listingController();    
        $heading = "Edit Listing";
        $preInput = $listing->getListingByID($id);
       break;
    case 'add':
        $heading = "Add Listing";   
        $listing = new listingController(); 
        $currentId = $listing->getMaxId();
        break;
    default:
        $heading = "";
        header("Location: index.php");
  }

  
if(isset($_POST['is_submit'])&& $_POST['is_submit']=='Submit'){
    $list_name = $_POST['list_name'];
    $distance = $_POST['distance'];
    if($action=='edit'){
        $listing->editListingByID($list_name,$distance,$user_id,$id);
        header("Location: index.php");
    }
    if($action=='add'){
        $newId = $currentId[0]['id'] + 1;
        $listing->addNewListing($newId,$list_name,$distance,$user_id);
        header("Location: index.php");
    }
}
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Part-B</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 700px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="card-body">
        <h4 class="card-title"><?php echo $heading?></h4>
        <br>
        <form class="form-sample" action="" method="post">                                              
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" >List Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="list_name" value="<?php if($action=="edit"){echo $preInput[0]['list_name'];}?>" 
                required="required">
                </div>
            </div>               
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Distance</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="distance" value="<?php if($action=="edit"){echo $preInput[0]['distance'];}?>" 
                required="required">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="is_submit" value="Submit"> 
                <input type="button" class="btn btn-light" onclick="window.location='index.php';" value="Cancel" > 
            </div>
        </form>
    </div>
</div>
</body>
</html>