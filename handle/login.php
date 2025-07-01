<?php 
include("../classes/methods.php");
session_start();

$user = methods::login($_SESSION["email"], $_SESSION["password"]);

if ($user === false) {
    $_SESSION["login_error"] = true;
    header("Location: ../index.php");
} else {
    $_SESSION["user_id"] = $user; // Assuming 'user_id' is the correct key
    header("Location: ../home.php");
}

