<?php 
include("../classes/methods.php");
session_start();
$userId = methods::register($_SESSION["email"], $_SESSION["fname"], $_SESSION["lname"], $_SESSION["password"]);
if ($userId === false) {
    $_SESSION["errorexsists"] = true;
    header("Location: ../index.php");
} else {
    $_SESSION["user_id"] = $userId;
    header("Location: ../home.php");
}

