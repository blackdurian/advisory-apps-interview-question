<?php
session_start();
//Clear Session
$_SESSION["user_id"] = "";
session_destroy();

header("Location: login.php");
?>